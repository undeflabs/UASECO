<?php
/*
 * Class: MapList
 * ~~~~~~~~~~~~~~
 * » Stores information about all Maps on the dedicated server and provides several
 *   functions for sorting.
 *
 * ----------------------------------------------------------------------------------
 * Author:	undef.de
 * Date:	2014-10-09
 * Copyright:	2014 by undef.de
 * ----------------------------------------------------------------------------------
 *
 * LICENSE: This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 * ----------------------------------------------------------------------------------
 *
 * Dependencies:
 *  - includes/core/map.class.php
 *  - includes/core/gbxdatafetcher.class.php
 *
 */


/*
#///////////////////////////////////////////////////////////////////////#
#									#
#///////////////////////////////////////////////////////////////////////#
*/

class MapList {
	public $map_list;						// Holds the whole map list with all installed maps
	public $current;						// Holds the current map object
	public $previous;						// Holds the previous map object

	public $max_age_mxinfo	= 86400;				// Age max. 86400 = 1 day
	public $size_limit	= 2097152;				// 2048 kB: Changed map size limit to 2MB: http://forum.maniaplanet.com/viewtopic.php?p=212999#p212999

	private $moods		= array(
		'Sunrise',
		'Day',
		'Sunset',
		'Night',
	);


	/*
	#///////////////////////////////////////////////////////////////////////#
	#									#
	#///////////////////////////////////////////////////////////////////////#
	*/

	public function __construct () {
		$this->map_list = array();
		$this->current = false;
		$this->previous = false;
	}

	/*
	#///////////////////////////////////////////////////////////////////////#
	#									#
	#///////////////////////////////////////////////////////////////////////#
	*/

	public function getMapByUid ($uid) {
		if (isset($this->map_list[$uid])) {
			return $this->map_list[$uid];
		}
		else {
//			trigger_error('[MapList] getMapByUid(): Can not find map with uid "'. $uid .'" in map_list[]', E_USER_WARNING);
			return new Map(null, null);
		}
	}

	/*
	#///////////////////////////////////////////////////////////////////////#
	#									#
	#///////////////////////////////////////////////////////////////////////#
	*/

	public function removeMapByUid ($uid) {
		if (isset($this->map_list[$uid])) {
			unset($this->map_list[$uid]);
			return true;
		}
		else {
			return false;
		}
	}

	/*
	#///////////////////////////////////////////////////////////////////////#
	#									#
	#///////////////////////////////////////////////////////////////////////#
	*/

	public function getMapById ($id) {
		foreach ($this->map_list as $map) {
			if ($map->id == $id) {
				return $map;
			}
		}
//		trigger_error('[MapList] getMapByFilename(): Can not find map with ID "'. $id .'" in map_list[]', E_USER_WARNING);
		return new Map(null, null);
	}

	/*
	#///////////////////////////////////////////////////////////////////////#
	#									#
	#///////////////////////////////////////////////////////////////////////#
	*/

	public function getMapByFilename ($filename) {
		foreach ($this->map_list as $map) {
			if ($map->filename == $filename) {
				return $map;
			}
		}
//		trigger_error('[MapList] getMapByFilename(): Can not find map with filename "'. $filename .'" in map_list[]', E_USER_WARNING);
		return new Map(null, null);
	}

	/*
	#///////////////////////////////////////////////////////////////////////#
	#									#
	#///////////////////////////////////////////////////////////////////////#
	*/

	public function removeMapByFilename ($filename) {
		foreach ($this->map_list as $map) {
			if ($map->filename == $filename) {
				unset($this->map_list[$map->uid]);
				return true;
			}
		}
		return false;
	}

	/*
	#///////////////////////////////////////////////////////////////////////#
	#									#
	#///////////////////////////////////////////////////////////////////////#
	*/

	public function getPreviousMap () {
		return $this->previous;
	}

	/*
	#///////////////////////////////////////////////////////////////////////#
	#									#
	#///////////////////////////////////////////////////////////////////////#
	*/

	public function getCurrentMap () {
		return $this->current;
	}

	/*
	#///////////////////////////////////////////////////////////////////////#
	#									#
	#///////////////////////////////////////////////////////////////////////#
	*/

	public function getNextMap () {
		global $aseco;

		$uid = false;
		if (isset($aseco->plugins['PluginRaspJukebox']->jukebox) && count($aseco->plugins['PluginRaspJukebox']->jukebox) > 0) {
			foreach ($aseco->plugins['PluginRaspJukebox']->jukebox as $map) {
				// Need just the next juke'd Map Information, not more
				$uid = $map->uid;
				break;
			}
			unset($map);
		}
		else {
			// Get next map using 'GetNextMapInfo' list method
			$response = $aseco->client->query('GetNextMapInfo');
			$uid = $response['UId'];
			unset($response);
		}

		return $this->getMapByUid($uid);
	}

	/*
	#///////////////////////////////////////////////////////////////////////#
	#									#
	#///////////////////////////////////////////////////////////////////////#
	*/

	public function count () {
		return count($this->map_list);
	}

	/*
	#///////////////////////////////////////////////////////////////////////#
	#									#
	#///////////////////////////////////////////////////////////////////////#
	*/

	public function readMapList () {
		global $aseco;

		// Init
		$this->map_list = array();

		// Get the MapList from Server
		$maplist = array();
		$newlist = array();
		$done = false;
		$size = 50;
		$i = 0;
		while (!$done) {
			try {
				// GetMapList response: Name, UId, FileName, Environnement, Author, GoldTime, CopperPrice, MapType, MapStyle.
				$newlist = $aseco->client->query('GetMapList', $size, $i);
				if (!empty($newlist)) {
					// Add the new Maps
					$maplist = array_merge($maplist, $newlist);

					if (count($newlist) < $size) {
						// Got less than $size maps, might as well leave
						$done = true;
					}
					else {
						$i += $size;
					}
					$newlist = array();
				}
				else {
					$done = true;
				}
			}
			catch (Exception $exception) {
				$aseco->console('[Admin] Exception occurred: ['. $exception->getCode() .'] "'. $exception->getMessage() .'" - GetMapList: Error getting the current map list from the dedicated Server!');
				$done = true;
				break;
			}
		}
		unset($newlist);

		// Load map infos from Database for all maps
		$uids = array();
		foreach ($maplist as $map) {
			$uids[] = $aseco->mysqli->quote($map['UId']);
		}
		$dbinfos = $this->getDatabaseMapInfos($uids);

		// Calculate karma for each map in database
		$karma = $this->calculateRaspKarma();


		$database = array();
		$database['insert'] = array();
		$database['update'] = array();
		foreach ($maplist as $mapinfo) {
			// Setup from database, if not present, add this to the list for adding into database
			if (isset($dbinfos[$mapinfo['UId']]) && !empty($dbinfos[$mapinfo['UId']]['filename'])) {
				// Create and setup dummy Map with data from the database
				$map			= new Map(null, null);
				$map->id		= $dbinfos[$mapinfo['UId']]['id'];
				$map->uid		= $dbinfos[$mapinfo['UId']]['uid'];
				$map->filename		= $dbinfos[$mapinfo['UId']]['filename'];
				$map->name		= $dbinfos[$mapinfo['UId']]['name'];
				$map->name_stripped	= $dbinfos[$mapinfo['UId']]['name_stripped'];
				$map->comment		= $dbinfos[$mapinfo['UId']]['comment'];
				$map->author		= $dbinfos[$mapinfo['UId']]['author'];
				$map->author_nickname	= $dbinfos[$mapinfo['UId']]['author_nickname'];
				$map->author_zone	= $dbinfos[$mapinfo['UId']]['author_zone'];
				$map->author_continent	= $dbinfos[$mapinfo['UId']]['author_continent'];
				$map->author_nation	= $dbinfos[$mapinfo['UId']]['author_nation'];
				$map->author_score	= $dbinfos[$mapinfo['UId']]['author_score'];
				$map->author_time	= $dbinfos[$mapinfo['UId']]['author_time'];
				$map->goldtime		= $dbinfos[$mapinfo['UId']]['goldtime'];
				$map->silvertime	= $dbinfos[$mapinfo['UId']]['silvertime'];
				$map->bronzetime	= $dbinfos[$mapinfo['UId']]['bronzetime'];
				$map->nblaps		= $dbinfos[$mapinfo['UId']]['nblaps'];
				$map->multilap		= $dbinfos[$mapinfo['UId']]['multilap'];
				$map->nbcheckpoints	= $dbinfos[$mapinfo['UId']]['nbcheckpoints'];
				$map->cost		= $dbinfos[$mapinfo['UId']]['cost'];
				$map->environment	= $dbinfos[$mapinfo['UId']]['environment'];
				$map->mood		= $dbinfos[$mapinfo['UId']]['mood'];
				$map->type		= $dbinfos[$mapinfo['UId']]['type'];
				$map->style		= $dbinfos[$mapinfo['UId']]['style'];
				$map->validated		= $dbinfos[$mapinfo['UId']]['validated'];
				$map->exeversion	= $dbinfos[$mapinfo['UId']]['exeversion'];
				$map->exebuild		= $dbinfos[$mapinfo['UId']]['exebuild'];
				$map->modname		= $dbinfos[$mapinfo['UId']]['modname'];
				$map->modfile		= $dbinfos[$mapinfo['UId']]['modfile'];
				$map->modurl		= $dbinfos[$mapinfo['UId']]['modurl'];
				$map->songfile		= $dbinfos[$mapinfo['UId']]['songfile'];
				$map->songurl		= $dbinfos[$mapinfo['UId']]['songurl'];
			}
			else {
				// Retrieve MapInfo from GBXInfoFetcher
				$gbx = $this->parseMap($aseco->server->mapdir . $mapinfo['FileName']);

				// Create Map object
				$map = new Map($gbx, $mapinfo['FileName']);

				if (!empty($dbinfos[$mapinfo['UId']])) {
					// Update this Map in the database
					$database['update'][] = $map;
				}
				else {
					// Add this new Map to the database
					$database['insert'][] = $map;
				}
			}


			// Add calculated karma to map
			if ( isset($karma[$map->uid]) ) {
				$map->karma = $karma[$map->uid];
			}
			else {
				$map->karma = array(
					'value'	=> 0,
					'votes'	=> 0,
				);
			}


			// Add to the Maplist
			if ($map->uid) {
				$this->map_list[$map->uid] = $map;
			}
		}
		unset($maplist, $dbinfos);


		// Add Maps that are not yet stored in the database
		foreach ($database['insert'] as $map) {
			$new = $this->insertMapIntoDatabase($map);

			// Update the Maplist
			if ($new->uid) {
				$this->map_list[$new->uid] = $new;
			}
		}

		// Update Maps that are not up-to-date in the database
		foreach ($database['update'] as $map) {
			$result = $this->updateMapInDatabase($map);

			// Update the Maplist
			if ($result) {
				$this->map_list[$map->uid] = $map;
			}
		}
		unset($database);


		// Find the current running map
		$this->current = $this->getCurrentMapInfo();
	}

	/*
	#///////////////////////////////////////////////////////////////////////#
	#									#
	#///////////////////////////////////////////////////////////////////////#
	*/

	public function insertMapIntoDatabase ($map) {
		global $aseco;

		// `NbLaps` and `NbCheckpoints` only accessible with the ListMethod 'GetCurrentMapInfo'
		// and when the Map is actual loaded, update where made at $this->getCurrentMapInfo().
		// But in Maps with chunk version 13 (0x03043002), these information are accessible (newer Maps).
		$query = "
		INSERT INTO `maps` (
			`Uid`,
			`Filename`,
			`Name`,
			`Comment`,
			`Author`,
			`AuthorNickname`,
			`AuthorZone`,
			`AuthorContinent`,
			`AuthorNation`,
			`AuthorScore`,
			`AuthorTime`,
			`GoldTime`,
			`SilverTime`,
			`BronzeTime`,
			`Environment`,
			`Mood`,
			`Cost`,
			`Type`,
			`Style`,
			`MultiLap`,
			`NbLaps`,
			`NbCheckpoints`,
			`Validated`,
			`ExeVersion`,
			`ExeBuild`,
			`ModName`,
			`ModFile`,
			`ModUrl`,
			`SongFile`,
			`SongUrl`
		)
		VALUES (
			". $aseco->mysqli->quote($map->uid) .",
			". $aseco->mysqli->quote($map->filename) .",
			". $aseco->mysqli->quote($map->name) .",
			". $aseco->mysqli->quote($map->comment) .",
			". $aseco->mysqli->quote($map->author) .",
			". $aseco->mysqli->quote($map->author_nickname) .",
			". $aseco->mysqli->quote($map->author_zone) .",
			". $aseco->mysqli->quote($map->author_continent) .",
			". $aseco->mysqli->quote($map->author_nation) .",
			". $map->author_score .",
			". $map->author_time .",
			". $map->goldtime .",
			". $map->silvertime .",
			". $map->bronzetime .",
			". $aseco->mysqli->quote($map->environment) .",
			". $aseco->mysqli->quote( (in_array($map->mood, $this->moods) ? $map->mood : 'unknown') ) .",
			". $map->cost .",
			". $aseco->mysqli->quote($map->type) .",
			". $aseco->mysqli->quote($map->style) .",
			". $aseco->mysqli->quote( (($map->multilap == true) ? 'true' : 'false') ) .",
			". (($map->nblaps > 1) ? $map->nblaps : 0) .",
			". $map->nbcheckpoints .",
			". $aseco->mysqli->quote( (($map->validated == true) ? 'true' : (($map->validated == false) ? 'false' : 'unknown')) ) .",
			". $aseco->mysqli->quote($map->exeversion) .",
			". $aseco->mysqli->quote($map->exebuild) .",
			". $aseco->mysqli->quote($map->modname) .",
			". $aseco->mysqli->quote($map->modfile) .",
			". $aseco->mysqli->quote($map->modurl) .",
			". $aseco->mysqli->quote($map->songfile) .",
			". $aseco->mysqli->quote($map->songurl) ."
		);
		";

		$aseco->mysqli->query($query);
		if ($aseco->mysqli->affected_rows === -1) {
			trigger_error('[MapList] Could not insert map in database: ('. $aseco->mysqli->errmsg() .')'. CRLF .' with statement ['. $query .']', E_USER_WARNING);
			return new Map(null, null);
		}
		else {
			$map->id = (int)$aseco->mysqli->lastid();
			return $map;
		}
	}

	/*
	#///////////////////////////////////////////////////////////////////////#
	#									#
	#///////////////////////////////////////////////////////////////////////#
	*/

	private function updateMapInDatabase ($map) {
		global $aseco;

		$query = "
		UPDATE `maps`
		SET
			`Filename` = ". $aseco->mysqli->quote($map->filename) .",
			`Name` = ". $aseco->mysqli->quote($map->name) .",
			`Comment` = ". $aseco->mysqli->quote($map->comment) .",
			`Author` = ". $aseco->mysqli->quote($map->author) .",
			`AuthorNickname` = ". $aseco->mysqli->quote($map->author_nickname) .",
			`AuthorZone` = ". $aseco->mysqli->quote($map->author_zone) .",
			`AuthorContinent` = ". $aseco->mysqli->quote($map->author_continent) .",
			`AuthorNation` = ". $aseco->mysqli->quote($map->author_nation) .",
			`AuthorScore` = ". $map->author_score .",
			`AuthorTime` = ". $map->author_time .",
			`GoldTime` = ". $map->goldtime .",
			`SilverTime` = ". $map->silvertime .",
			`BronzeTime` = ". $map->bronzetime .",
			`Environment` = ". $aseco->mysqli->quote($map->environment) .",
			`Mood` = ". $aseco->mysqli->quote( (in_array($map->mood, $this->moods) ? $map->mood : 'unknown') ) .",
			`Cost` = ". $map->cost .",
			`Type` = ". $aseco->mysqli->quote($map->type) .",
			`Style` = ". $aseco->mysqli->quote($map->style) .",
			`MultiLap` = ". $aseco->mysqli->quote( (($map->multilap == true) ? 'true' : 'false') ) .",
			`NbLaps` = ". (($map->nblaps > 1) ? $map->nblaps : 0) .",
			`NbCheckpoints` = ". $map->nbcheckpoints .",
			`Validated` = ". $aseco->mysqli->quote( (($map->validated == true) ? 'true' : (($map->validated == false) ? 'false' : 'unknown')) ) .",
			`ExeVersion` = ". $aseco->mysqli->quote($map->exeversion) .",
			`ExeBuild` = ". $aseco->mysqli->quote($map->exebuild) .",
			`ModName` = ". $aseco->mysqli->quote($map->modname) .",
			`ModFile` = ". $aseco->mysqli->quote($map->modfile) .",
			`ModUrl` = ". $aseco->mysqli->quote($map->modurl) .",
			`SongFile` = ". $aseco->mysqli->quote($map->songfile) .",
			`SongUrl` = ". $aseco->mysqli->quote($map->songurl) ."
		WHERE `Uid` = ". $aseco->mysqli->quote($map->uid) ."
		LIMIT 1;
		";

		$aseco->mysqli->query($query);
		if ($aseco->mysqli->affected_rows === -1) {
			trigger_error('[MapList] Could not update map in database: ('. $aseco->mysqli->errmsg() .')'. CRLF .' with statement ['. $query .']', E_USER_WARNING);
			return false;
		}
		else {
			return true;
		}
	}

	/*
	#///////////////////////////////////////////////////////////////////////#
	#									#
	#///////////////////////////////////////////////////////////////////////#
	*/

	private function getDatabaseMapInfos ($uids) {
		global $aseco;

		$data = array();

		// Read Map infos
		$query = "
		SELECT
			`Id`,
			`Uid`,
			`Filename`,
			`Name`,
			`Comment`,
			`Author`,
			`AuthorNickname`,
			`AuthorZone`,
			`AuthorContinent`,
			`AuthorNation`,
			`AuthorScore`,
			`AuthorTime`,
			`GoldTime`,
			`SilverTime`,
			`BronzeTime`,
			`Environment`,
			`Mood`,
			`Cost`,
			`Type`,
			`Style`,
			`MultiLap`,
			`NbLaps`,
			`NbCheckpoints`,
			`Validated`,
			`ExeVersion`,
			`ExeBuild`,
			`ModName`,
			`ModFile`,
			`ModUrl`,
			`SongFile`,
			`SongUrl`
		FROM `maps`
		WHERE `Uid` IN (". implode(',', $uids) .");
		";

		$res = $aseco->mysqli->query($query);
		if ($res) {
			if ($res->num_rows > 0) {
				while ($row = $res->fetch_array()) {
					$data[$row['Uid']] = array(
						'id'			=> (int)$row['Id'],
						'uid'			=> $row['Uid'],
						'filename'		=> $row['Filename'],
						'name'			=> $row['Name'],
						'name_stripped'		=> $aseco->stripColors($row['Name'], true),
						'comment'		=> $row['Comment'],
						'author'		=> $row['Author'],
						'author_nickname'	=> $row['AuthorNickname'],
						'author_zone'		=> $row['AuthorZone'],
						'author_continent'	=> $row['AuthorContinent'],
						'author_nation'		=> $row['AuthorNation'],
						'author_score'		=> $row['AuthorScore'],
						'author_time'		=> $row['AuthorTime'],
						'goldtime'		=> $row['GoldTime'],
						'silvertime'		=> $row['SilverTime'],
						'bronzetime'		=> $row['BronzeTime'],
						'nblaps'		=> (int)$row['NbLaps'],
						'multilap'		=> $aseco->string2bool($row['MultiLap']),
						'nbcheckpoints'		=> (int)$row['NbCheckpoints'],
						'cost'			=> $row['Cost'],
						'environment'		=> $row['Environment'],
						'mood'			=> $row['Mood'],
						'type'			=> $row['Type'],
						'style'			=> $row['Style'],
						'validated'		=> $aseco->string2bool($row['Validated']),
						'exeversion'		=> $row['ExeVersion'],
						'exebuild'		=> $row['ExeBuild'],
						'modname'		=> $row['ModName'],
						'modfile'		=> $row['ModFile'],
						'modurl'		=> $row['ModUrl'],
						'songfile'		=> $row['SongFile'],
						'songurl'		=> $row['SongUrl'],
					);
				}
			}
			$res->free_result();
		}
		else {
			trigger_error('[MapList] Could not query map datas: ('. $aseco->mysqli->errmsg() .')'. CRLF .' for statement ['. $query .']', E_USER_WARNING);
		}
		return $data;
	}

	/*
	#///////////////////////////////////////////////////////////////////////#
	#									#
	#///////////////////////////////////////////////////////////////////////#
	*/

	// http://forum.maniaplanet.com/viewtopic.php?p=219824#p219824
	// The_Big_Boo: Because Windows doesn't support UTF-8 filenames natively but the API used in the
	// dedicated server has some workaround which needs the UTF-8 BOM to be prepended.
	// = stripBOM() on filenames for PHP
	public function parseMap ($file) {
		global $aseco;

		$gbx = new GBXChallMapFetcher(true, false, false);
		try {
			if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
				$gbx->processFile(iconv('UTF-8', 'ISO-8859-1//TRANSLIT', $aseco->stripBOM($file)));
			}
			else {
				$gbx->processFile($aseco->stripBOM($file));
			}
		}
		catch (Exception $e) {
			trigger_error('[MapList] Could not read Map ['. $aseco->stripBOM($file) .']: '. $e->getMessage(), E_USER_WARNING);

			// Ignore if Map could not be parsed
			return false;
		}
		return $gbx;
	}

	/*
	#///////////////////////////////////////////////////////////////////////#
	#									#
	#///////////////////////////////////////////////////////////////////////#
	*/

	public function getCurrentMapInfo () {
		global $aseco;

		$response = $aseco->client->query('GetCurrentMapInfo');

		// Get Map from map_list[]
		$map = $this->getMapByUid($response['UId']);

		// Update 'NbLaps' and 'NbCheckpoints' for current Map from $response,
		// this is required for old Maps (e.g. early Canyon beta or converted TMF Stadium)
		$map->nblaps = $response['NbLaps'];
		$map->nbcheckpoints = $response['NbCheckpoints'];

		// Store updated 'NbLaps' and 'NbCheckpoints' into database
		$this->updateMapInDatabase($map);

		return $map;
	}

	/*
	#///////////////////////////////////////////////////////////////////////#
	#									#
	#///////////////////////////////////////////////////////////////////////#
	*/

	private function calculateRaspKarma () {
		global $aseco;

		// Calculate the local Karma like RASP/Karma
		$data = array();
		$query = "
		SELECT
			`m`.`Uid`,
			SUM(`k`.`Score`) AS `Karma`,
			COUNT(`k`.`Score`) AS `Count`
		FROM `rs_karma` AS `k`
		LEFT JOIN `maps` AS `m` ON `m`.`Id` = `k`.`MapId`
		GROUP BY `k`.`MapId`;
		";

		$res = $aseco->mysqli->query($query);
		if ($res) {
			if ($res->num_rows > 0) {
				while ($row = $res->fetch_object()) {
					$data[$row->Uid]['value'] = $row->Karma;
					$data[$row->Uid]['votes'] = $row->Count;
				}
			}
			$res->free_result();
		}
		return $data;
	}
}

?>
