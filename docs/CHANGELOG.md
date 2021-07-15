## [Version 0.9.7](_#Version-0.9.7)



### General changes
* Updated to support PHP/7.4.x [undef]
* Updated to support PHP/8.0.x [undef]
* Requires a `Maniaplanet Dedicated Server` build `2019-10-24_16_00 (Linux)` / `2019-10-23_20_00 (Windows)` or higher [undef]
* Redirect chat command "/jukebox display" to "/elist jukebox" which is the replacement [undef]
* ManiaScript: Changed all deprecated `Player.Login` (which is marked deprecated) to MP4 `Player.User.Login` [undef]
* ManiaScript: Changed all deprecated `InputPlayer.Login` (which is marked deprecated) to MP4 `InputPlayer.User.Login` [undef]
* ManiaScript: Changed all deprecated `CurrentLocalDateText` (which is marked deprecated) to MP4 `System.CurrentLocalDateText` [undef]
* Added a check for a path separator for `<default_maplist>` in `config/UASECO.xml` [undef]
* Removed dependence from the setup of `<autosave_matchsettings>` from `config/rasp.xml` for the chat command `/admin shuffle` or `/admin shufflemaps` [undef]
* Added the current `Ladder`-setup into the ABOUT section of the UASECO lofgile [undef]
* Added DateTime on logfile entries for `webrequest.php` [undef]
* Updated `includes/musicserver/getid3` to version `1.9.19` (thanks [James Heinrich](https://github.com/JamesHeinrich/getID3)) [undef]
* Added multilanguage support to `plugins/plugin.customize_quit_dialog.php` [aca]
* Added multilanguage support to `plugins/plugin.donate.php` [aca]
* Add selection (by mouse) of map author for filtering at `/elist` from `plugins/plugin.records_eyepiece.php` [undef]
* Changed the location and structure of the multilanguage files, now they are stored in `newinstall/locales/LANG/<plugin-name>.xml`, were `LANG` is e.g. `en` (english), `de` (german)... and each file only contains the language of the folder it is in [aca, undef]
* Added multilanguage support to `plugins/plugin.info_bar.php` [undef]
* Added multilanguage support to `plugins/plugin.round_points.php`[aca]
* Added multilanguage support to `plugins/plugin.rounds.php` [aca]
* Added mulitlanguage support to `plugins/chat.rasp.php` [aca]
* Added mulitlanguage support to `plugins/chat.record_relations.php` [aca]
* Added mulitlanguage support to `plugins/plugin.map.php` [aca]
* Added mulitlanguage support to `plugins/plugin.music_server.php` [aca]
* Added mulitlanguage support to `plugins/plugin.muting.php` [aca]
* Added mulitlanguage support to `plugins/plugin.rasp.php` [aca]
* Added mulitlanguage support to `plugins/plugin.rasp_jukebox.php` [aca]
* Added mulitlanguage support to `plugins/plugin.rasp_karma.php` [aca]
* Moved `newinstall/database/readme.txt` to `docs/DATABASE-IMPORT.md` and updated it [undef]
* Updated `docs/Dedicated-Server/Modescript-Settings.md` [undef]
* Added the check for minimum/maximum required version of UASECO for plugins (only Dependence::REQUIRED is used, all other dependencies are ignored) [undef]
* Added a map difficulty display into the MapWidget from Records-Eyepiece (only shown if the map is available at ManiaExchange) (thanks L3cKy) [undef]
* Renamed constant `MANIAPLANET_BUILD` to `DEDICATED_SERVER_BUILD` [undef]
* Renamed constant `MANIAPLANET_BUILD_POSIX` to `DEDICATED_SERVER_BUILD_POSIX` [undef]
* Renamed constant `MANIAPLANET_BUILD_WINDOWS` to `DEDICATED_SERVER_BUILD_WINDOWS` [undef]
* Added constant `UASECO_BRANCH` [undef]
* Renamed Class name `XmlParser` to `XmlParserCustom`, because `XmlParser` is in PHP/8.x a reserved name [undef]


### Changes at config files
* Updated `<client_dialog>` the link to the download page in `newinstall/config/UASECO.xml` [undef]
* Updated `<client_error>` the link to the download page in `newinstall/config/UASECO.xml` [undef]
* Removed `<message_cannot_find_autosave_matchsettings>` in `newinstall/locales/LANG/chat.admin.xml` [undef]
* Removed `<message_autosave_matchsettings_not_set_or_jukebox_disabled>` in `newinstall/locales/LANG/chat.admin.xml` [undef]
* Removed `<autosave_matchsettings>` in `newinstall/config/rasp.xml` [undef]
* Added `<autosave_maplist>` in `newinstall/config/UASECO.xml` (on default `false`) [undef]
* Changed `<ui_properties><spectator_info><pos><y>` from `-68.0` to `-82.0` in `newinstall/config/modescript_settings.xml` [undef]
* Changed `<images><maniakarma_logo>` to new URL in `newinstall/config/mania_karma.xml` [undef]
* Added `<disable_give_up>` to `<modesetup><labs>` in `newinstall/config/modescript_settings.xml` [undef]
* Added `<use_custom_points_repartition>` to `<modesetup><team>` in `newinstall/config/modescript_settings.xml` [undef]
* Added `<cumulate_points>` to `<modesetup><team>` in `newinstall/config/modescript_settings.xml` [undef]
* Added `<rounds_per_map>` to `<modesetup><team>` in `newinstall/config/modescript_settings.xml` [undef]
* Added `<maps_per_match>` to `<modesetup><team>` in `newinstall/config/modescript_settings.xml` [undef]
* Added `<use_tie_break>` to `<modesetup><team>` in `newinstall/config/modescript_settings.xml` [undef]
* Updated `<entry>` lines from `Laps.Script.txt` and `Chase.Script.txt` with the current script versions in `newinstall/config/modescript_settings.xml` [undef]
* Added `<use_clublinks>` to `<modebase>` in `newinstall/config/modescript_settings.xml` [undef]
* Added `<use_clublinks_sponsors>` to `<modebase>` in `newinstall/config/modescript_settings.xml` [undef]
* Added `<neutral_emblem_url>` to `<modebase>` in `newinstall/config/modescript_settings.xml` [undef]
* Added `<script_environment>` to `<modebase>` in `newinstall/config/modescript_settings.xml` [undef]
* Added `<is_channel_server>` to `<modebase>` in `newinstall/config/modescript_settings.xml` [undef]
* Added `<hide_opponents>` to `<modebase>` in `newinstall/config/modescript_settings.xml` [undef]
* Changed `<modesetup><team><use_custom_points_repartition>` (and documentation above too) from `[10, 6, 4, 3, 2, 1]` to `false` in `newinstall/config/modescript_settings.xml` [undef]
* Added `<matchmaking><matchmaking_match_servers>` in `newinstall/config/modescript_settings.xml` [undef]
* Added `<matchmaking><lobby_aggressive_transfer>` in `newinstall/config/modescript_settings.xml` [undef]
* Added `<matchmaking><kick_timed_out_players>` in `newinstall/config/modescript_settings.xml` [undef]
* Added `<modesetup><timeattack><force_laps_number>` in `newinstall/config/modescript_settings.xml` [undef]
* Added `newinstall/locales/LANG/plugin.customize_quit_dialog.xml` [aca]
* Removed `<messages>` from `newinstall/config/donate.xml` [aca]
* Added `newinstall/locales/LANG/plugin.donate.xml` [aca]
* Added `<message_donation_label>` and `<message_top_dons_window_title>` in `newinstall/locales/LANG/plugin.donate.xml` [aca]
* Delete `newinstall/locales/LANG/common.xml` and moved the content into the related plugins/classes... [aca]
* Moved all `<label>`s from `newinstall/config/info_bar.xml` into `newinstall/locales/en/plugin.info_bar.xml` and `newinstall/locales/de/plugin.info_bar.xml` and named them accordently (e.g. <label_*>) [undef]
* Removed `<messages>` from `newinstall/config/local_records.xml` [aca]
* Added `newinstall/locales/en/plugin.local_records.xml` and  `newinstall/locales/de/plugin.local_records.xml` [aca]
* Moved `<messages><chat_prefix_replacement>` to `<chat_prefix_replacement>` in `newinstall/config/UASECO.xml` [undef]
* Removed `<messages>` from `newinstall/config/UASECO.xml` [aca, undef]
* Renamed `<stripling_path>` to `<status_path>` and changed the content from `cache/stripling.xml` to `cache/status.xml` in `newinstall/config/UASECO.xml` [undef]
* Added `newinstall/locales/en/uaseco.xml` and  `newinstall/locales/de/uaseco.xml` [undef]
* Added russian translation into `newinstall/locales/ru/` (thanks [Romnickol](https://github.com/Romnickol/UASECO/tree/master/newinstall/locales)) [aca]
* Removed `<messages>` from `newinstall/config/round_points.xml` [aca]
* Added `newinstall/locales/en/plugin.round_points.xml` and  `newinstall/locales/de/plugin.round_points.xml` [aca]
* Added `newinstall/locales/en/plugin.rounds.xml` and `newinstall/locales/de/plugin.rounds.xml` [aca]
* Removed `<messages>` from `newinstall/config/music_server.xml` and `newinstall/config/rasp.xml` [aca]
* Added `newinstall/locales/en/chat.rasp.xml` [aca]
* Added `newinstall/locales/en/plugin.map.xml` [aca]
* Added `newinstall/locales/en/plugin.music_server.xml` [aca]
* Added `newinstall/locales/en/plugin.muting.xml` [aca]
* Added `newinstall/locales/en/plugin.rasp_jukebox.xml` [aca]
* Added `newinstall/locales/en/plugin.rasp_karma.xml` [aca]
* Added `newinstall/config/class_window.xml` [undef]
* Added `<media>*` to `newinstall/config/mania_exchange.xml` [undef]
* Updated `newinstall/config/effect_studio/countdown-3-2-1-GO!.xml`, now you can change the sizes of the 3-2-1-GO! graphics by changing the values at `SizeGfx*` [undef]
* Added `<images><diffculty>*` to `newinstall/config/records_eyepiece.xml` [undef]
* Added `<enable_url_test>` to `newinstall/config/music_server.xml` [undef]
* Replaced all `Zeit:` with `⏰` `newinstall/locales/de/local_records.xml` [undef]
* Replaced all `Time:` with `⏰` `newinstall/locales/en/local_records.xml` [undef]


### Bug fixes
* Fixed [PHP Notice] Undefined variable: uid on line 870 in file `plugins/chat.admin.php` (thanks hackie, fiendy) [undef]
* Fixed display of the wrong juked map in the `NextMapWidget` (thanks hackie, speedychris) [undef]
* Fixed `RoundScoreWidget`: the Playernames flowed out of the screen (thanks hacki65) [undef]
* Fixed [PHP Notice] Undefined property: Player::$player on line 196 in file `plugins/plugin.rounds.php` [undef]
* Fixed [PHP Notice] Undefined property: Player::$player on line 197 in file `plugins/plugin.rounds.php` [undef]
* Fixed bug when using `/admin add ID` which shows `Unknown` instead of the map name, happens only for previously added maps (thanks hackie, cockneyrebel) [undef]
* Fixed [PHP Notice] Undefined index:  on line 13985 in file `plugins/plugin.records_eyepiece.php` (thanks cockneyrebel) [undef]
* Fixed [PHP Notice] Undefined index:  on line 13988 in file `plugins/plugin.records_eyepiece.php` (thanks cockneyrebel) [undef]
* Fixed links to external resources at the WindowClass (https://github.com/undeflabs/UASECO/issues/41) (thanks BestNoob) [undef]
* Fixed visible widgets of `<warmup>` from `<ui_properties>` when visibility was set to `false` in combination with RecordsEyepiece and the enabled <spectator_info_widget> [undef]
* Fixed wrong gamemode output when switching gamemodes `plugins/plugin.modescript_handler.php` [undef]
* Fixed Warning: mysqli::stat(): Couldn't fetch Database in `includes/core/database.class.php` on line 305 [undef]
* Fixed [PHP Warning] count(): Parameter must be an array or an object that implements Countable on line 3677 in file `plugins/plugin.records_eyepiece.php` with GameMode `Laps.Script.txt` [undef]
* Fixed [PHP Notice] Undefined index: checkpointid on line 8466 in file `plugins/plugin.records_eyepiece.php` with GameMode `Laps.Script.txt` [undef]
* Fixed [PHP Notice] Undefined index: score_plain on line 8466 in file `plugins/plugin.records_eyepiece.php` with GameMode `Laps.Script.txt` [undef]
* Fixed [PHP Notice] Undefined index: checkpointid on line 8467 in file `plugins/plugin.records_eyepiece.php` with GameMode `Laps.Script.txt` [undef]
* Fixed [UASECO Exception] Error returned: "Wrong setting type for 'S_DisableGiveUp'" [-1000] at GbxRemote::query() for method "SetModeScriptSettings" with arguments [undef]
* Fixed that <chat_prefix_replacement> sometimes was not used when using non-enlish setting (e.g. german) [aca, undef]
* Fixed [PHP Notice] Undefined offset: 0 on line 479 in file `/includes/core/window.class.php` [undef]
* Fixed ERROR [108, 29] syntax error, unexpected MANIASCRIPT_EQUAL from `/includes/core/dialog.class.php` [undef]
* Fixed [PHP Warning] Illegal offset type on line 149 in file `/includes/core/locales.class.php` [undef]
* Fixed [PHP Notice] Undefined offset: 19343 on line 150 in file `/includes/core/locales.class.php` [undef]
* Fixed several links in the markdown files `docs/UASECO` for the website [undef]
* Fixed [PHP Notice] Trying to access array offset on value of type null on line 1781 in file `includes/core/helper.class.php` [undef]
* Fixed [PHP Notice] Trying to access array offset on value of type null on line [413,414,417,426,427,428,429,430,431,432,433,435,436,437,438,440,441] in file `includes/core/player.class.php` [undef]
* Fixed [PHP Notice] Trying to access array offset on value of type bool on line [4992,5000,5008] in file `plugins/plugin.records_eyepiece.php` (thanks mooseman2099) [undef]
* Fixed [PHP Warning] fopen(https://api.mania-exchange.com/tm/tracks/list/latest): failed to open stream: HTTP request failed! HTTP/1.1 500 Internal Server Error on line 223 in file `includes/maniaexchange/mxinfosearcher.inc.php` [undef]
* Fixed [PHP Notice] Trying to access array offset on value of type null on line 184 in file `/includes/core/maphistory.class.php` [undef]
* Fixed HTTPS URLs can not be used for `plugin.music_server.php` (thanks MadMatt01) [undef]
* Fixed [PHP Notice] Undefined index: Answer on line 2269 in file `plugins/plugin.records_eyepiece.php` [undef]





***





## [Version 0.9.6](_#Version-0.9.6)



### General changes

* Requires `PHP/7.2.x` or higher, because active support has been droped for older releases
* Requires a `Maniaplanet Dedicated Server` build `2019-02-11_21_00 (Linux)` / `2019-02-11_21_48 (Windows)` or higher
* The logfile from UASECO has been renamed to `2018-11-16-uaseco-current.txt` or `2018-11-16-14-31-12-uaseco.txt` for older logfiles
* The `webrequest.php` uses an own logfile named `2018-11-16-webrequest-current.txt` or `2018-11-16-14-31-12-webrequest.txt` for older logfiles (thanks Shrike)
* Changed `newinstall/webrequest.sh` and `newinstall/webrequest.bat` by adding an own logfile (thanks fiendy)
* Changed `newinstall/uaseco.sh` and `newinstall/uaseco.bat` to redirect errors into normal logfile from UASECO
* Added a better error diagnostic message in `includes/core/locales.class.php`
* Added support for songs with space in the filename for `plugin/plugin.music_server.php` (thanks Phenom1994)
* Updated to the [gbxdatafetcher/2.11](https://www.xaseco.org/tools.php) (thanks Xymph)
* Updated to the ModeScriptApi version [2.5.0](https://github.com/maniaplanet/script-xmlrpc/releases)
* Added a map list progress indicator for the logfile while starting sequence
* Updated `plugins/plugin.round_autoend.php` to work also while a WarmUp is running (thanks speedychris)
* Added some optimations into `includes/core/playerlist.class.php` (thanks brakerb)
* Updated `includes/musicserver/getid3` to version `1.9.15` (thanks [James Heinrich](https://github.com/JamesHeinrich/getID3))
* Changed parameter structure of the events `onPlayerFinishPrefix`, `onPlayerFinish` and `onPlayerFinishPostfix`
* Replaced PHP equality operators (`==` and `!=`) with identical operators (`===` and `!==`) for a performance gain (initiated by C-Lodder)[https://github.com/undeflabs/UASECO/pull/32]
* Added a check for obviously wrong port setups of `config/UASECO.xml` `<dedicated_server><port>`
* Chat commands `/admin listmasters`, `/admin listadmins` and `/admin listops` from `plugins/chat.admin.php` has been replaced by `/masteradmins`, `/admins` and `/operators` from `plugins/chat.server.php`
* Changed behavior of `webrequest.php` that now verifies TLS/SSL-Certificates instead of ignoring them
* Added the plugin list with versions into the ABOUT and DEBUG header (which has been re-ordered too) in the logfile
* Changed return value from method `getPlayerNickname` from class `PlayerList`, it now returns a boolean `false` instead of a string `Unknown` when a nickname can not be found
* F9 functionality in Records-Eyepiece has been "fixed", also the storage of the settings in the Tachometer plugin (thanks reaby for the tip)
* Change all deprecated `CMlEvent` to the new `CMlScriptEvent` in all core files and plugins
* Improved reset of the default client UI on `shutdown` (e.g. crash, `/admin shutdown`, ...) of UASECO
* Removed the Up-to-date check from `plugins/plugin.mania_karma.php` because it is a default plugin of UASECO


### Changes at config files

* Added missing `<modesetup><chase><warm_up_duration>` from 0.9.5 release in `newinstall/config/modescript_settings.xml` (thanks speedychris)
* Added missing `<modesetup><chase><warm_up_number>` from 0.9.5 release in `newinstall/config/modescript_settings.xml` (thanks speedychris)
* Changed `&` to `&amp;` in `<messages><cheater_blacklisted_and_banned>` at `newinstall/config/welcome_center.xml` (thanks aca)
* Change all `-----` to `=====` in `newinstall/config/tachometer/template_classic.xml` to make them XML compatible (thanks aca)
* Change all `-----` to `=====` in `newinstall/config/customize_quit_dialog/default.xml` to make them XML compatible (thanks aca)
* Added `<sounds><enabled>` in `newinstall/config/tachometer.xml` to enable or disable sounds by default (wished by hacki65)
* Added new entry `Stadium SUPER Trucks` at `<points_systems><system>` in `newinstall/config/round_points.xml`
* Changed `<settings><replay><posx>` from `-120.95` to `-121.3` in `newinstall/config/pay2play.xml` (thanks hacki65)
* Changed `<settings><replay><posy>` from `81.1875` to `81` in `newinstall/config/pay2play.xml` (thanks hacki65)
* Changed `<settings><skip><posx>` from `-108.949` to `-109.3` in `newinstall/config/pay2play.xml` (thanks hacki65)
* Changed `<settings><skip><posy>` from `81.1875` to `81` in `newinstall/config/pay2play.xml` (thanks hacki65)
* Changed `<settings><style><background_focus>` from `004B7D99` to `0099FFFF` in `newinstall/config/pay2play.xml` (thanks hacki65)
* Changed all `<entry>Modes/TrackMania/` lines with official modescripts at `<scripts>` in `newinstall/config/modescript_settings.xml`
* Added `<modebase><respawn_behaviour>` in `newinstall/config/modescript_settings.xml`
* Added `<ui_properties><scorestable>` in `newinstall/config/modescript_settings.xml`
* Added `<ui_properties><viewers_count>` in `newinstall/config/modescript_settings.xml`
* Updated `<scripts><*>` in `newinstall/config/modescript_settings.xml` to require the actual versions
* Added `<message_warmup_round_end>` in `newinstall/locales/plugin.round_autoend.xml`
* Removed `<modebase><scores_table_style_path>` from `newinstall/config/modescript_settings.xml`, because this has been removed from the game with MP4
* Moved the plugin `chat.help.php` into the required section in `newinstall/config/plugins.xml` (thanks speedychris)
* Moved the plugin `plugin.map.php`, `plugin.panels.php` and `plugin.rasp.php` into the `Optional plugins` section in `newinstall/config/plugins.xml`
* Splited the section `Required plugins` into `Minimal required plugins` and `Maximal required plugins` in `newinstall/config/plugins.xml`
* Changed `<message_nextenv_failed>`, `<message_activate_localrecords>` and `<message_activate_addthis>` in `newinstall\locales\chat.admin.xml`
* Added `<message_activate_rasp>` in `newinstall\locales\chat.admin.xml`
* Updated/removed (because they are gone) links to documentations from nadeo in `newinstall/config/modescript_settings.xml`
* Updated `newinstall/config/panels/AdminBottomCenter.xml`, `newinstall/config/panels/AdminBottomCenterWide.xml` and `newinstall/config/panels/AdminCallVote.xml` to ManiaLink Version 3
* Updated `newinstall/locales/chat.server.xml` with `no_operators_configured`, `no_admins_configured` and `no_masteradmins_configured`
* Changed `<ui_properties><checkpoint_time><pos><y>` from `25.8` to `-68.8` in `newinstall/config/modescript_settings.xml`
* Changed `<ui_properties><checkpoint_time><pos><y>` from `-8.0` to `0.0` in `newinstall/config/modescript_settings.xml`
* Renamed `<ui_properties><warmup>` to `<ui_properties><warm_up>` in `newinstall/config/modescript_settings.xml`
* Removed `<uptodate_*>` from `newinstall/config/mania_karma.xml`
* Removed `<uptodate_check>` and `<uptodate_info>` from `newinstall/config/mania_karma.xml`
* Removed `<ipaddress>` from `newinstall/config/UASECO.xml` at `<masteradmins>` and complete functionality
* Removed `<auto_admin_addip>` from `newinstall/config/UASECO.xml` and complete functionality
* Removed `<ipaddress>` from `newinstall/config/adminops.xml` at `<admins>` and `<operators>` and complete functionality


### Bug fixes

* Fixed [UASECO Exception] Error returned: "Invalid Manialink page: XML Error at [NUM, NUM]: Parsing attribute " ATTRIBUTE " [-1000] at GbxRemote::query() for method "SendDisplayManialinkPageToLogin" with arguments[...] in `plugins/plugin.records_eyepiece.php` (thanks rasmusdk)
* Fixed setting `<settings><display>` to `0` in `config/autotime.xml` does still display the message in the chat (thanks rasmusdk)
* Fixed PHP Parse error:  syntax error, unexpected '$rank' (T_VARIABLE) in `plugins/chat.rasp_nextrank.php` on line 124 (thanks aca)
* Fixed [PHP Warning] Invalid argument supplied for foreach() on line 951 in file `plugins/plugin.modescript_handler.php` (thanks lyovav)
* Fixed Wrong Time in the chat with the plugin.autotime.php and configured bronze time (thanks Flighthigh)
* Fixed [PHP Notice] Undefined offset: 1 on line 632 in file `includes/core/helper.class.php` (thanks Plateo)
* Fixed [PHP Notice] Trying to get property of non-object on line 970 in file `plugins/plugin.modescript_handler.php` (thanks hackie)
* Fixed [PHP Notice] Undefined offset: 0 on line 8471 in file `plugins/plugin.records_eyepiece.php` (thanks Tavernicole)
* Fixed [PHP Warning] end() expects parameter 1 to be array, string given on line 1207 in file `plugins/plugin.checkpoints.php` (thanks fl3kzZ, endbase, aca)
* Fixed not working `/infobar reload` (thanks hackie)
* Fixed [PHP Warning] Declaration of Database::query($sql) should be compatible with mysqli::query($query, $resultmode = NULL) in `includes/core/database.class.php` on line 431 (thanks hacki65)
* Fixed [PHP Warning] array_key_exists(): The first argument should be either a string or an integer on line 709 in file path to `plugins/plugin.rasp_jukebox.php` (thanks hackie)
* Fixed `strippling.xml` which holds the wrong map because of the too early call of the function `reportServerInfo()` at `loadingMap()` in `uaseco.php` (thanks hacki65)
* Fixed multiple encoded special chars in windows and in Records Eyepiece (thanks hackie)
* Fixed [UASECO Exception] Error returned: "Wrong setting type for `S_RespawnBehaviour`" [-1000] at GbxRemote::query() for method `SetModeScriptSettings` with arguments: (thanks hackie)
* Fixed not working Dedimania link in the Dedimania Window which does load in the internal ManialinkBrowser instead of the external Browser (thanks Guenni71)
* Fixed players with only numbers as login lets the LiveRankingWidget from `plugins/plugin.records_eyepiece.php` display wrong sorting and multiple entrys (thanks speedychris, endbase and special thanks to NADEO)
* Fixed RankingList lost PID from players when using `$aseco->server->rankings->update()`
* Fixed displaying of the CurrentMapWidget from score while in race after using "/replay" (thanks aca)
* Fixed LastNextCurrentWindow does not display the correct next map when changing the Jukebox (thanks aca)
* Fixed adding a map at score the CurrentMapWidget does not display the correct map (thanks speedychris)
* Fixed wrong display of songs with spaces, `%20` instead of " " in `plugins/plugin.music_server.php` (thanks speedychris)
* Fixed several password representations in the logfile with a mask `******` (thanks xenicle)
* Fixed [PHP Notice] Undefined index: TMLOGIN on line 166 in file `plugins/chat.server.php` (thanks xenicle)
* Fixed [PHP Warning] in_array() expects parameter 2 to be array, null given on line 9650 in file `plugins/plugin.records_eyepiece.php` (thanks hacki65)
* Fixed [UASECO Warning] [Rasp] ERROR: Could not insert time! ((1452) Cannot add or update a child row: a foreign key constraint fails (\`DB\`.\`uaseco_times\`, CONSTRAINT \`uaseco_times_ibfk_2\` FOREIGN KEY (\`PlayerId\`) REFERENCES \`uaseco_players\` (\`PlayerId\`) ON DELETE CASCADE ON UPDATE CASCADE)) (thanks hackie)
* Fixed chat command `/elist` can not juke maps, only see `-` instead of `+` (thanks hackie)
* Fixed RASP does not display correct ranking (thanks hacki65)
* Fixed [PHP Notice] Trying to get property of non-object on line 102 in file `includes/core/map.class.php` (thanks Snorfold)
* Fixed <placement>'s from Records-Eyepiece with chat-commands does not call the given chat command (thanks RelaxedRacer)
* Fixed [PHP Notice] Undefined variable: message on line 133 in file `plugins/plugin.local_records.php` (thanks RelaxedRacer)
* Fixed PHP Warning] file_get_contents(https://www.UASECO.org/usagereport.php): failed to open stream: HTTP request failed! HTTP/1.1 500 Internal Server Error on line 196 in file `webrequest.php` (thanks RelaxedRacer)
* Fixed LiveRankingsWidget shows time from a map before after leaving and returning later and server stays empty meanwhile (thanks endbase, hackie, Flighthigh)
* Fixed CheckpointsTimeDiffWidget without tracking if <auto_enable_cps> and <auto_enable_dedicps> is set to `false` in `config/checkpoints.xml` (thanks hacki65)
* Fixed [PHP Warning] array_key_exists(): The first argument should be either a string or an integer on line 288 in file `plugins/plugin.rasp_jukebox.php`
* Fixed Records-Eyepiece `MoreRankingWindow` which sometimes show one page more then required (thanks hacki65)
* Fixed [PHP Warning] Illegal string offset 'SONG' on line 147 in file `plugins/plugin.music_server.php`
* Fixed [PHP Notice] Undefined variable: import_done on line 980 in file `plugins/plugin.mania_karma.php` (thanks endbase)
* Fixed [PHP Notice] Undefined variable: api on line 3600 in file `plugins/plugin.mania_karma.php` (thanks endbase)
* Fixed [PHP Notice] Undefined variable: authcode on line 3602 in file `plugins/plugin.mania_karma.php` (thanks endbase)
* Fixed the view of the ConnectionStatusWidget when the Widget himself is disabled for the current GameMode (thanks hacki65)
* Fixed the request to export the Karma votes, also when the export was already done in `plugins/plugin.mania_karma.php` (thanks RelaxedRacer)





***





## [Version 0.9.5](_#Version-0.9.5)



### General changes

* Requires a `Maniaplanet Dedicated Server` build `2017-05-31_23_00` or higher
* Optimized again the map name handling: a map with a name like `ÐĘЯЯ@   MiNi LoL   21-5-17` results into a filename like `derra-mini-lol-21-5-17_121209.Map.gbx` instead of `de-mini-lol-21-5-17_121209.Map.gbx` (thanks askuri)
* Added `$map->name_slug` to class `includes/core/map.class.php` which holds the slugified version of a map name
* Added `$player->nickname_stripped` to class `includes/core/player.class.php` which holds the format and color stripped version of a nickname
* Added `$player->nickname_slug` to class `includes/core/player.class.php` which holds the slugified version of a nickname
* ManiaScript: Changed all deprecated `InputPlayer.Login` (which is marked deprecated) to MP4 update new `InputPlayer.User.Login`
* Added new event `onPlayerFinishPostfix` which is triggered after `onPlayerFinish`
* The chat command `/admin shutdown` (and `/admin shutdownall`) stores now all player settings into the database
* Removed chat command `/ranks` from `chat.player_infos.php`, because `plugin/plugin.records_eyepiece.php` has a better list with `/estat topranks`
* Added method `getFormatedRank()` in `includes/core/player.class.php`
* Removed method `getRank()` from `plugin/plugin.rasp.php` (replaced by `getFormatedRank()` from `includes/core/player.class.php`)
* Turned `Top Rankings Window`, `Dedimania Records Window`, `Local Records Window`, `Live Rankings Window`, `Top Continent Window` from `plugin.records_eyepiece.php` into the class window style
* Changed some `sprintf("%.1f"...)` to `$aseco->formatFloat()` in `plugin.records_eyepiece.php` (thanks elie520)
* No local- and dedimania-records while within warm-up to prevent cheats, because of method "GetValidationReplay" returns "Not in race.", which means the race can not be validated


### Changes at config files

* Changed the files in `newinstall/config/effect_studio/` to make them XML compatible (thanks aca)
* Changed `&` to `&amp;` in all `<info_messages><messages>` at `newinstall/config/welcome_center.xml` (thanks aca)
* Added `newinstall/locales/plugin.info_bar.xml`
* Added chat command `/infobar reload` in `plugins/plugin.info_bar.php` (suggested by perre.vl)
* Added `Rounds.Script.txt`, `TimeAttack.Script.txt`, `Team.Script.txt`, `Laps.Script.txt`, `Cup.Script.txt`, `TeamAttack.Script.txt` and `Chase.Script.txt` to `<scripts>` in `newinstall/config/modescript_settings.xml` for checking the version
* Added trailing `/` in `<dedicated_installation>` from `newinstall/config/UASECO.xml` (thanks Shrike)
* Added `<modesetup><timeattack><warm_up_duration>` in `newinstall/config/modescript_settings.xml`
* Added `<modesetup><timeattack><warm_up_number>` in `newinstall/config/modescript_settings.xml`
* Added `<modesetup><team><warm_up_duration>` in `newinstall/config/modescript_settings.xml`
* Added `<modesetup><team><warm_up_number>` in `newinstall/config/modescript_settings.xml`
* Removed `<modesetup><team><use_player_clublinks>` in `newinstall/config/modescript_settings.xml`
* Added `<modesetup><laps><warm_up_duration>` in `newinstall/config/modescript_settings.xml`
* Added `<modesetup><laps><warm_up_number>` in `newinstall/config/modescript_settings.xml`
* Added `<modesetup><cup><warm_up_number>` in `newinstall/config/modescript_settings.xml`
* Added `<modesetup><cup><max_players_per_team>` in `newinstall/config/modescript_settings.xml`
* Added `<modesetup><cup><min_players_per_team>` in `newinstall/config/modescript_settings.xml`
* Added `<modesetup><chase><warm_up_duration>` in `newinstall/config/modescript_settings.xml`
* Added `<modesetup><chase><warm_up_number>` in `newinstall/config/modescript_settings.xml`
* Removed `<modesetup><chase><use_player_clublinks>` in `newinstall/config/modescript_settings.xml`


### Bug fixes

* Fixed [PHP Notice] Undefined property: stdClass::$best on line 645 in file `plugins/plugin.checkpoints.php` (thanks phantom)
* Fixed always return in `includes/core/plugin.class.php` in the method `getPlayerData()` which causes "You need to finish this map at least 1 time before being able to vote" in ManiaKarma and maybe more (thanks endbase for the research)
* Fixed wrong calculation of a player ranking average (thanks rasmusdk)
* Fixed missing `)` in `plugins/chat.record_relations.xml` (thanks aca)
* Fixed [UASECO Exception] Error returned: "" [0] at GbxRemote::query() for method "SendDisplayManialinkPage" (thanks lyovav)
* Fixed wrong rank counting in a private function `_getPlayerRankingById()` at `includes/core/player.class.php` (thanks rasmusdk)
* Fixed a mem leak: placed wrong the mem freeing function of a sql resource at `includes/core/player.class.php` and `includes/core/playerlist.class.php` (maybe related to [speedychris report](https://forum.maniaplanet.com/viewtopic.php?p=286526#p286526))
* Fixed wrong storage of records in TimeAttack.Script.txt and multilaps map, the last checkpoint (the finishline) has not been stored (thanks speedychris)
* Fixed the RoundScoreWidget always displays the players best race time, instead of the current time of the round (thanks speedychris)
* Fixed chat command `/dedicps` was not registered the right way
* Fixed [PHP Warning] explode() expects parameter 2 to be string, array given on line 1208 in file `plugins/plugin.checkpoints.php` (thanks elie520)
* Fixed messed up positions of the default HUD elements after a ModeScript and map change
* Fixed buggy welcome message since the rank calculation changes (thanks rasmusdk)
* Fixed adding maps with `/admin add ID` does not setup a database ID which causes no records and mania karma endless loading (thanks mistertl)
* Fixed [PHP Notice] Undefined variable: gd on line 710 in file `uaseco.php` (thanks soehest)
* Fixed message `Adding missing trailing "/"` for `<mapimages_path>` and `<dedicated_installation>` (thanks Shrike)
* Fixed the WarmUp widget stays on the screen thoughout all the following non warm-up rounds (thanks elie520)
* Fixed the forced autoend of a round if all players have finished the round, but the timeout has reached while showing the score





***





## [Version 0.9.4](_#Version-0.9.4)



### General changes

* Added new event `onPlayerRoundFinish` for use in rounds based ModeScripts and the RoundScoreWidget of `plugin.records_eyepiece.php`
* Added the RoundScoreWidget to be hidden/shown when pressing the F9 key of `plugin.records_eyepiece.php` (thanks elie520)
* The TimeDiff Widget of `plugin.checkpoints.php` reload when the player drove an new record and shows the next better local-, dedimania-record or personal best
* Better map name handling, now a map name like `ÐĘЯЯ@   MiNi LoL   21-5-17` results into a filename like `de-mini-lol-21-5-17_121209.Map.gbx` instead of `_121209.Map.gbx` (thanks phantom)
* Added `$aseco->environments` which holds an array of environments, currently 'Canyon', 'Stadium', 'Valley' and 'Lagoon'
* Map that are added from ManiaExchange (by e.g. `/admin add ID`) will now be separated into separate folders on disk, named as the map environment
* Added support for [AdminServ](https://forum.maniaplanet.com/viewtopic.php?f=261&t=29509) callback `AdminServ.Map.Added` when a map has been added and `AdminServ.Map.Deleted` when a map has been removed
* Added properties `$player->server_rank`, `$player->server_rank_total` and `$player->server_rank_average` to [Class Player](https://www.uaseco.org/development/classes/player.php)
* Added property `$aseco->db->settings` to `includes/core/database.class.php`
* Renamed property `$aseco->db->db_type` in `$aseco->db->type` from `includes/core/database.class.php`
* Renamed property `$aseco->db->db_version` in `$aseco->db->version` from `includes/core/database.class.php`
* Renamed property `$aseco->db->db_version_full` in `$aseco->db->version_full` from `includes/core/database.class.php`
* Turned more windows from `plugin.records_eyepiece.php` into the class window style


### Changes at config files

* Updated the links to the official documentation in `newinstall/config/modescript_settings.xml`, all updated links are starting with `www.maniaplanet.com/documentation/`
* Moved `<modebase><warm_up_duration>` to `<modesetup><rounds><warm_up_duration>` and changed the description too in `newinstall/config/modescript_settings.xml`
* Added `<modesetup><rounds><warm_up_number>` in `newinstall/config/modescript_settings.xml`
* Added extra 7 seconds to the `plugins/plugin.round_autoend.php` because sometimes the round was forced to end while showing the scoretable
* Updated `newinstall/locales/plugin.round_autoend.xml` with several entries
* Added `<messages><chat_prefix_replacement>` in `newinstall/config/UASECO.xml`
* Changed `<message_autosave_matchsettings_not_set_or_jukebox_disabled>` in `newinstall/locales/chat.admin.xml`
* Renamed tag `<message_ban_masteradmin>` to `<message_ban_any_admin>` into `newinstall/locales/chat.admin.xml`
* Removed `<min_rank>` from `newinstall/config/rasp.xml`
* Added `<server_rank_min_records>` to `newinstall/config/UASECO.xml`


### Bug fixes

* Fixed wrong ordering in the `RoundScore` Widget from `plugin.records_eyepiece.php`, only tested with `Rounds.Script.txt` (thanks elie520, speedychris)
* Fixed not updating `LiveRanking` Widget from `plugin.records_eyepiece.php` (thanks speedychris)
* Fixed in a multilap map only the first run will receive a record in `plugin.modescript_handler.php` (thanks speedychris)
* Fixed [PHP Warning] explode() expects parameter 2 to be string, array given on line 103 in file `plugins/plugin.round_points.php` (thanks speedychris)
* Fixed [PHP Warning] array_map(): Argument #2 should be an array on line 103 in file `plugins/plugin.round_points.php` (thanks speedychris)
* Fixed [PHP Notice] Undefined index: truffeltje on line 2339 in file `plugins/plugin.mania_karma.php` (thanks phantom)
* Fixed wrong firing of `onPlayerFinish` in `Rounds.Script.txt` on a multilap map before all required laps has been driven
* Fixed showing and loading the wrong next map after changing the next map with "/admin replay" or by jukeboxing a map (thanks elie520, phantom)
* Fixed ModeScript changes require to change the map twice to take account (thanks maxi031, elie520)
* Fixed double information after `/admin erase ID` (thanks phantom)
* Fixed `/admin erase ID` does not change the MapList too (thanks phantom)
* Fixed the clickbuttons `/admin panel list` (thanks Mysticman, rasmusdk)
* Fixed ManiaScript parts in `plugin.records_eyepiece.php` which causes Widgets to be displayed only in parts while restarting
* Fixed [PHP Notice] Undefined index: SCALE on line 13999 in file `plugins/plugin.records_eyepiece.php` (thanks phantom)
* Fixed emoji "speech bubble" - which replaces `»` in chat message - was replacing `»` everywhere and not only at the beginning of a chat message, e.g. in map names, nicknames... (thanks reaby)
* Fixed [PHP Notice] Undefined property: stdClass::$tracking on line 1657 in file `plugins/plugin.dedimania.php` (thanks lyovav)
* Fixed wrong (old) map size check on `/admin addlocal ID` in `plugins/chat.admin.php`
* Fixed `/xlist` contains map with all environments on a `TMStadium` Title only dedicated server
* Fixed and optimized the map list refresh, now the thumbnails of a map is only stored on disk, when the thumbnail not already exists
* Fixed [PHP Warning] get_class() expects parameter 1 to be object, boolean given on line 322 in file `includes/core/plugin.class.php` (thanks phantom)
* Fixed [UASECO Warning] Country::countryToIoc(): Could not map country: Bosnia and Herzegovina (thanks lyovav)
* Fixed getting the message `Congratulations, you won your NUM. race!` even if you are playing alone (thanks rasmusdk)
* Fixed wrong ordering of the server rank (players with same average now ordered by `PlayerId`) and optimized the rank calculation, also reduced the required SQL queries to get the results
* Fixed team colors are wrong in RoundScore from `plugin.records_eyepiece.php` (thanks elie520)
* Fixed [PHP Notice] Undefined variable: admin on line 4385 in file `plugins/chat.admin.php` with `/admin addlocal {filename}` (thanks Tavernicole)
* Fixed Fuel and Water display blinking when time is nearly over in `plugins/plugin.tachometer.php`





***





## [Version 0.9.3](_#Version-0.9.3)



### General changes

* Requires a `Maniaplanet Dedicated Server` build `2017-05-22_21_00` or higher
* Added FTP support into the WebRequestWorker `webrequest.php`
* Added support for multiple instances of a WebRequestWorker `webrequest.php`, which has (currently) to be started manually (thanks oliverde8)
* Added check for an existing WebRequestWorker worker(s), if none can be found start is aborted (thanks oliverde8)
* Added the function to `/admin add 120328` to save the map as `Whatever_120328.Map.gbx` instead of (currently) `w-eve_120328.Map.gbx` on linux or `_120328.Map.gbx` on windows (thanks Phantom)
* Renamed constant in UASECO from `API_VERSION` to `XMLRPC_API_VERSION`
* Added constant in UASECO `MODESCRIPT_API_VERSION`
* Added chat command `/modescript reload` to reload the `config/modescript_settings.xml`
* Added a check if a player is a MasterAdmin, to prevent a MasterAdmin/Admin/Operator ban (thanks L3cKy)
* Updated to the gbxdatafetcher/2.10 which includes the `Lagoon` support (thanks Xymph)
* Added `Lagoon` support into `plugin.records_eyepiece.php`
* Added checks for trailing slashes at `<mapimages_path>` and `<dedicated_installation>` from `config/UASECO.xml` (thanks Tavernicole)


### Changes at config files

* Added new properties `<ui_properties><spectator_info>` into `newinstall/config/modescript_settings.xml`
* Added new properties `<modesetup><rounds><rounds_per_map>` into `newinstall/config/modescript_settings.xml`
* Added new properties `<modesetup><rounds><maps_per_match>` into `newinstall/config/modescript_settings.xml`
* Added new tag `<window_ui_properties>` into `newinstall/locales/plugin.modescript_settings.xml`
* Added new locales `newinstall/locales/plugin.modescript_settings.xml`
* Added new tag `<message_ban_masteradmin>` into `newinstall/locales/chat.admin.xml`
* Changed URLs of `<images><mood>`, `<images><environment><enabled>`, `<images><environment><focus>` and added `Lagoon` at `newinstall/config/records_eyepiece.xml`
* Removed tag group `<images><environment><logos>` at `newinstall/config/records_eyepiece.xml`


### Bug fixes

* Fixed wrong named function from `destruct()` to `__destruct()` in `includes/core/webrequest.class.php`
* Fixed instant exit from `webrequest.php` after `/admin shutdown` (because of the existing file `worker.suicide`)
* Reverted `/list` back to the `plugin.rasp_jukebox.php` to enable `/admin remove 1` (thanks Tavernicole)
* Fixed [UASECO Exception] Error returned: "Value of type INT supplied where type STRING was expected." [-501] at GbxRemote::query() for method "TriggerModeScriptEventArray" with arguments: "/setrpoints 6,5,4,3,2,1,0" (thanks mangoara)
* Fixed [PHP Notice] iconv(): Detected an illegal character in input string on line 137 in file `/includes/core/helper.class.php` (thanks Phantom)
* Fixed [PHP Notice] Undefined index: Records on line 1157 in file `plugins/plugin.checkpoints.php` (thanks elie520)
* Fixed [Plugin] » Can not register chat command "/elist" because callback Method "chat_elist()" of class "PluginRecordsEyepiece" is not callable, ignoring! (thanks ramires)
* Fixed ManiaScript ERR [30, 69] Persistent storage limit reached. MusicWidget ()::Main() [30, 69], by disable persistent storage
* Fixed Checkpoint TimeDiffWidget is displaying a time from the map that was loaded before, if you have not already a Personal Best time on the current map (thanks elie520)
* Fixed [PHP Notice] Trying to get property of non-object on line 767 in file `plugins/plugin.modescript_handler.php` (thanks SSM.Speed...)





***





## [Version 0.9.2](_#Version-0.9.2)



### General changes

* Requires a `Maniaplanet Dedicated Server` build `2017-05-12_21_00` or higher
* wget is no longer required, it is replaced by the `includes/webrequest.php` (which has to be started as separate process)
* Added new method `$aseco->generateManialinkId()` at class `UASECO`
Added the command `/tachometer reload` to `plugins/plugin.tachometer.php`
* Added an new Dialog Class, with this you can setup dialogs to ask the player to confirm
  * New file added `includes/core/dialog.class.php`
  * New file added `newinstall/locales/class.dialog.xml`
  * New file added `docs/UASECO/Classes/Dialog/Methods.md`
  * New file added `docs/UASECO/Classes/Dialog/Properties.md`
* Changed class `MXInfoSearcher` to load 200 maps on `/xlist`
* Changed the amount of maps from `15` to `20` on each page at `/xlist`
* Minor ManiaScript odds and sods
* Changed `plugin.message_log.php` to Manialink V3
* Added support for TLS/SSL URLs for songs in `plugin.music_server.php`


### Changes at config files

* Changed the URLs to [ManiaCDN](https://about.maniacdn.net/) in the `newinstall/config/tachometer.xml`
* Changed the URLs to [ManiaCDN](https://about.maniacdn.net/) in the `newinstall/config/tachometer/template_classic.xml`
* Changed inside `newinstall/config/donate.xml` at `<messages><payment>` the content (removed a space) for the new Class Dialog
* Changed inside `newinstall/config/records_eyepiece.xml` at `<scoretable_lists><top_active_players><entries>` from `7` to `6`
* Changed inside `newinstall/config/records_eyepiece.xml` at `<scoretable_lists><top_winning_payouts><enabled>` from `false` to `true`
* Changed inside `newinstall/config/records_eyepiece.xml` at `<scoretable_lists><top_winning_payouts><pos_y>` from -11.775 to `-38.5875`
* Changed inside `newinstall/config/records_eyepiece.xml` at `<scoretable_lists><top_winning_payouts><entries>` from `7` to `6`


### Bug fixes

* Fixed deformated Window from `/admin pay PLAYER AMOUNT` window has been updated to the Manialink version 3
* Fixed wrong versions check from `/uptodate`
* Fixed [PHP Notice]: Undefined index: `UI_PROPERTIES` in `/plugins/plugin.modescript_handler.php` on line 918 (thanks Krill)
* Fixed hiding/showing of Records-Eyepiece Widgets by pressing `F9` (thanks phantom, elie520)
* Fixed ManiaScript ERR [171, 95] Out of bounds access at [NUM] at CheckpointTimeDiff ()::Main() [171, 95]
* Fixed ManiaScript ERR [45, 82] Persistent storage limit reached at Tachometer ()::Main() [45, 82], by disable persistent storage
* Fixed missing image from `plugin.customize_quit_dialog.php` (server side)
* Fixed missing images from `plugin.welcome_center.php` (server side)
* Fixed [PHP Fatal Error] Uncaught Error: Cannot use object of type WebRequestConstruct as array in `/plugins/plugin.mania_karma.php`:3854
* Fixed [MusicServer] webrequest->get(): 404 - The given URL could not be found! (thanks MfGLucker)
* Changed line-endings in `newinstall/uaseco.bat` into DOS format and redirecting errors to `nul`
* Fixed vote buttons are not able to click in `/plugins/plugin.mania_karma.php`
* Fixed missing send of `<ui_properties><live_info>` from the file `newinstall/config/modescript_settings.xml` to the dedicated server
* Fixed the LiveRanking Widget of `plugin.records_eyepiece.php` which does not update after the second run (thanks mixnetwork, orangina, Lutzif3r)




***





## [Version 0.9.1](_#Version-0.9.1)



### General changes

* Possible speed-up because of the test of improved times before triggering the event `onPlayerRankingUpdated`
* `/admin shutdown` resets the HUD to the default values taken from `UI2.Script.txt`


### Changes at config files

* Added inside `newinstall/config/UASECO.xml` at `<settings>` the new `<automatic_refresh_maplist>`
* Added inside `newinstall/config/modescript_settings.xml` at `<ui_properties>` the new `<live_info>`
* Changed inside `newinstall/config/modescript_settings.xml` at `<ui_properties>` every position X, Y and Z to the MP4 defaults from UI2.Script.txt (thanks micmo)
* Changed inside `newinstall/config/modescript_settings.xml` at `<modesetup>` the entry `<timeattack>` from `3600` (1 hour) to `300` (5 min.) (thanks lyovav)
* Added inside `newinstall/config/records_eyepiece.xml` at `<ui_properties>` following new `<position>`, `<speed_and_distance>`, `<personal_best_and_rank>`, `<checkpoint_list>`, `<countdown>` and `<chrono>`
* Changed inside `newinstall/config/records_eyepiece.xml` at `<winning_payout><widget>` the `<pos_x>` and `<pos_y>`


### Bug fixes

* [UASECO Exception] Error returned: "" [0] at GbxRemote::query() for method "SendDisplayManialinkPageToLogin" with arguments:  (thanks lyovav)
* [PHP Notice] Undefined property: stdClass::$best on line 533 in file `/plugin.checkpoints.php` (thanks lyovav)
* [PHP Notice] Undefined property: stdClass::$tracking on line 1657 in file `/plugins/plugin.dedimania.php` (thanks lyovav)
* [PHP Notice] Undefined offset: 1 on line 412 in file `/includes/core/window.class.php` (thanks lyovav)
* [PHP Notice] Undefined offset: 2 on line 412 in file `/includes/core/window.class.php` (thanks lyovav)
* [PHP Notice] Undefined index: planets on line 125 in file `/includes/core/locales.class.php`
* [PHP Warning] Invalid argument supplied for foreach() on line 180 in file `/includes/core/message.class.php`
* [UASECO Warning] Country::countryToIoc(): Could not map country: South Korea: Renamed `Korea` to `South Korea` in `includes/core/country.class.php` (thanks lyovav)
* Syntax error: `EOF in backquote substitution`, `Error in command substitution` or `newline unexpected (expecting word)` in `includes/core/webrequest.class.php` (thanks lyovav)
* [PHP Warning] file_get_contents(): failed to open stream: Connection timed out on line 156 in file `/includes/core/webrequest.class.php` (thanks Tavernicole)
* [PHP Notice] Undefined variable: `http_response_header` on line 159 in file `/includes/core/webrequest.class.php` (thanks Tavernicole)
* [PHP Warning] Invalid argument supplied for `foreach()` on line 159 in file `/includes/core/webrequest.class.php` (thanks Tavernicole)
* [PHP Notice] Undefined offset: `1` on line 534 in file `/includes/core/webrequest.class.php` (thanks Tavernicole)





***





## [Version 0.9.0](_#Version-0.9.0)



### Notes

* Third-party Plugins for XAseco2 are NOT compatible without changes (see `Differences between XAseco2 and UASECO` below)!
* A database from XAseco2/1.03 is NOT compatible with UASECO, convert a XAseco2 database with `newinstall/database/convert-xaseco2-to-uaseco.php`!
* Plugin `plugin.manialinks.php` (formerly `manialinks.inc.php`) is deprecated and get removed in the near future! Use [Class Window](http://www.uaseco.org/development/classes/window.php) instead.
* Plugin `plugin.panels.php` and related files in the folder `config/panels` (or `newinstall/config/panels`) are deprecated and get removed in the near future!
* All RASP Plugins will be replaced and removed in the near future!
* `includes/core/webaccess.class.php` (formerly `webaccess.inc.php`) has been removed, use [Class WebRequest](http://www.uaseco.org/development/classes/webrequest.php) instead!



### Requirements

* Full details at [installation (linux)](https://www.uaseco.org/documentation/installation.php)
* Requires `PHP/5.6.0` or higher (`7.x.x` recommended for performance gain)
* Requires `MySQL/5.1.0` or higher or `MariaDB/5.5.20` or higher
* Requires a Maniaplanet dedicated Server build `2017-05-03_21_00` or higher with API-Version `2013-04-16` or higher
* Requires now the installation of `wget`:
 * Linux: `sudo apt-get install wget` (or a similar command related to your distribution) and make sure it is in the path.
 * Windows: [Download wget for Windows](http://gnuwin32.sourceforge.net/packages/wget.htm) (Binaries as ZIP-File) [direct link to the download](http://downloads.sourceforge.net/gnuwin32/wget-1.11.4-1-bin.zip) and copy `bin\wget.exe` to `includes\wget.exe`.



### Changes

* Admins are now able to setup the PHP `memory_limit` (default is set to `256 MB`) and `script_timeout` (default is set to `120 seconds`) within the UASECO.xml
* Added many new callback events like `onPlayerStartCountdown`, `onPlayerStartLine`, `onPlayerFinishLine`, `onPlayerRespawn`, `onBeginPodium`... [see documentation for details](http://www.uaseco.org/development/events.php#Description)
* Included support for Modescript Gamemodes from the `Maniaplanet/3` and `Maniaplanet/4` update, e.g. `TimeAttack.Script.txt`, `Rounds.Script.txt`...
* Included Database support into controller and changed all MySQL statements from `MySQL Extension` to `MySQL Improved Extension` (mysqli)
* The database default storing engine has been changed from MyISAM to InnoDB with foreign key constraints
* The database tablenames now have a prefix, to have the possibility to use only one database for multiple UASECO installations
* Took some classes/ideas from MPAseco/0.83 and Aseco/2.2.0c
* Splitted types.inc.php into single file classes
* Extended class Player
* Extended class PlayerList
* Extended class Server
* Extended class Gameinfo
* Extended class Map
* Extended class Record
* Extended class RecordList
* Extended class Server
* Added class BaseClass
* Added class Dependence
* Added class Continent
* Added class Country
* Added class Locales (thanks to askuri)
* Added class Helper (which holds the most UASECO Methods)
* Added class MapList
* Added class MapHistory
* Added class Message (thanks to askuri)
* Added class Database (mysqli)
* Added class PlayList
* Added class Plugin
* Added class Ranking
* Added class RankingList
* Added class Webrequest (for asynchronous and synchronous HTTP GET-, POST- and HEAD-Requests)
* Added class Window
* Added class WindowList
* Added new RoundsPointSystem `High Score`, based upon `MotoGP` * 10
* Rewritten all Plugins into a own class and documented all dependencies
* Merged several Plugins into one Plugin
* Renamed several Plugins
* Included the updated `GBX Data Fetcher module` v2.9 from 2017-02-03 created by Xymph
* Added [GbxRemote version from 2016-01-20](https://github.com/maniaplanet/dedicated-server-api)
* Distinguish local records between Gamemodes: local records made in `TimeAttack` are not available when the dedicated is running in `Rounds` and vice versa
* Moved the content of the Map history file from RASP into the Database table `maphistory` (and removed functions... from the Plugins)
* Added Support for the following Gamemodes:
 * [Knockout.Script.txt](https://forum.maniaplanet.com/viewtopic.php?f=9&t=31243)
 * [Doppler.Script.txt](https://forum.maniaplanet.com/viewtopic.php?f=9&t=30463)
* Changed PHP 4 style constructors for PHP/7.x.x deprecated warnings: Methods with the same name as their class will not be constructors in a future version of PHP
* Added [memleak fixes presented by Bueddl](http://www.tm-forum.com/viewtopic.php?p=231206#p231206)
* Removed plugin `chat.last_win.php` and included his function into `windowlist.class.php`



### Bugfix (in XAseco2)

* `includes/xmlparser.inc.php`: Changed to make sure that `0` values from `<tags>` in XML files are not interpreted as `false` and are stored too
* `includes/web_access.inc.php`: [PHP Notice] Undefined offset: 0 on line 1184 till 1190
* `plugins/chat.server.php`: Changed forgotten changes for `Gameinfo::*` constants



### Differences between XAseco2 and UASECO

* All XML configuration files has to be located into the `config` folder
* All `mysql_*()` does not work anymore, use `$aseco->db->*` instead (e.g. `$res = $aseco->db->query($sql)`), see http://www.php.net/manual/en/class.mysqli.php and http://www.uaseco.org/development/classes/database.php
* Added constants `Gameinfo::TEAM_ATTACK` and `Gameinfo::CHASE`
* Added `$aseco->server->rankings->ranking_list[]` which holds the current ranking for all Players in all Gamemodes (no need to call the Method `GetCurrentRanking`)
* Added `$aseco->server->maps->map_list[]` which holds all Maps from the dedicated Server (no need to call the Method `GetMapList`)
* Added `$aseco->server->players->getPlayerById()`
* Added `$aseco->server->players->getPlayerByPid()`
* Changed the callback handler of a registered chat command, it has now four parameter instead of two: ($aseco, $login, $chat_command, $chat_parameter)
* Changed `quotedString()` to `$aseco->db->quote()`
* Changed `validateUTF8String()` to `$aseco->validateUTF8String()`
* Changed `stripNewlines()` to `$aseco->stripNewlines()`
* Changed `formatText()` to `$aseco->formatText()`
* Changed `stripSizes()` to `$aseco->stripSizes()`
* Changed `stripNewlines()` to `$aseco->stripNewlines()`
* Changed `bool2text()` to `$aseco->bool2string()`
* Changed and renamed `mapCountry()` to `$aseco->country->countryToIoc()`
* Changed and renamed `continent2cid()` to `$aseco->continent->continentToAbbreviation()`
* Changed and renamed `cid2continent()` to `$aseco->continent->abbreviationToContinent()`
* Changed and renamed `stripColors()` to `$aseco->stripStyles()`
* Changed and renamed `file_exists_nocase()` to `$aseco->fileExistsNoCase()`
* Changed F7 (to hide some Widgets) to F9, because Nadeo uses F7 for the Buddy list now
* Event parameters has been changed for many events, more details: http://www.uaseco.org/development/events.php
* Event `onCheckpoint` to `onPlayerCheckpoint`
* Event `onChat` splitted into `onServerChat` and `onPlayerChat` (no need to check for a Server message at `onPlayerChat`)
* Event `onRestartMap` removed and renamed `onRestartMap2` to `onRestartMap` (there is no more a difference between the restarts)
* Event `onLoadingMap` is send after `$aseco->server->maps->current` is updated (which is fired before `onBeginMap`)
* Event `onBeginMap` is fired after `onLoadingMap`
* Event `onBeginMap1` and `onBeginMap2` has been removed
* Event `onEndMap1` renamed to `onEndMapPrefix`
* Event `onDediRecsLoaded` renamed to `onDedimaniaRecordsLoaded`
* Event `onMaplistChanged` renamed to `onMapListChanged` (uppercase `L`)
* Event `onPlayerConnect2` renamed to `onPlayerConnectPostfix`
* Event `onPlayerFinish1` renamed to `onPlayerFinishPrefix`
* Event `onPlayerManialinkPageAnswer`: Handling of Manialink actions and identificators has been changed, more details: http://www.uaseco.org/development/manialinks.php#Identifications
* Event `onPlayerInfoChanged` does not send anymore the struct from the dedicated as parameter, now only send the login of that Player (the struct is changed at the Player object)
* Event `onManualFlowControlTransition` has been removed, because that Callback (TrackMania.ManualFlowControlTransition) is not part of the API-Version 2013-04-16
* Merged `formatTime()` and `formatTimeH()` to only `$aseco->formatTime()`
* Merged chat.songmod.php, plugin.map.php and plugin.rasp_nextmap.php together
* Moved `$aseco->xml_parser` to `$aseco->parser` and renamed the method `parseXML()` to `xmlToArray()` and `parseArray()` to `arrayToXml()`
* Moved `$aseco->server->map` to `$aseco->server->maps->current`
* Moved `$aseco->records` from controller into Local Records Plugin
* Moved `$aseco->rasp` from controller into the RASP Plugins
* Moved `$aseco->getPlayerId()` to `$aseco->server->players->getPlayerIdByLogin()`
* Moved `$aseco->getPlayerNick()` to `$aseco->server->players->getPlayerNickname()`
* Moved `$aseco->getPlayerParam()` to `$aseco->server->players->getPlayerParam()`
* Renamed `config/config.xml` to `config/UASECO.xml`
* Renamed constants `Gameinfo::RNDS` to `Gameinfo::ROUNDS`, `Gameinfo::TA` to `Gameinfo::TIME_ATTACK`
* Renamed `$aseco->server->players->getPlayer()` to `$aseco->server->players->getPlayerByLogin()`
* Renamed `$aseco->ip_match()` to `$aseco->matchIP()`
* Renamed `$aseco->server->serverlogin` to `$aseco->server->login`
* Renamed `$player->isspectator` to `$player->is_spectator`
* Renamed `$player->isofficial` to `$player->is_official`
* Renamed `$player->isreferee` to `$player->is_referee`
* Renamed `$player->ladderrank` to `$player->ladder_rank`
* Renamed `$player->ladderscore` to `$player->ladder_score`
* Renamed `$player->lastmatchscore` to `$player->last_match_score`
* Renamed `$player->nbwins` to `$player->nb_wins`
* Renamed `$player->nbdraws` to `$player->nb_draws`
* Renamed `$player->nblosses` to `$player->nb_losses`
* Renamed `$player->timeplayed` to `$player->time_played`
* Renamed `$player->newwins` to `$player->new_wins`
* Renamed `$player->teamid` to `$player->team_id`
* Remamed `$map->authorscore` to `$map->author_score` ($map = includes/core/map.class.php)
* Remamed `$map->authortime` to `$map->author_time` ($map = includes/core/map.class.php)
* Renamed `$aseco->isOperatorL()` to `$aseco->isOperatorByLogin()`
* Renamed `$aseco->isAdminL()` to `$aseco->isAdminByLogin()`
* Renamed `$aseco->isMasterAdminL()` to `$aseco->isMasterAdminByLogin()`
* Renamed `$aseco->isAnyAdminL()` to `$aseco->isAnyAdminByLogin()`
* Renamed `$aseco->allowOpAbility()` to `$aseco->allowOperatorAbility()`
* Removed constant `Gameinfo::STNT` and support for the related Gamemode
* Removed `manialinks.inc.php`, moved parts from it into the related Plugins and replaced the `Window` with the new class `window.class.php`
* Removed Plugin `plugin.matchsave.php`, and related files `matchsave.xml`, `html.tpl` and `text.tpl`
* Removed Jfreu-Plugins `jfreu.chat.php`, `jfreu.lite.php` and `jfreu.plugin.php` with all related files (`plugin.welcome_center.php` replaces `jfreu.lite.php`)
* Removed `plugin.styles.php` and related files in the folder `config/styles`
* Removed `addChatCommand()` and added `$this->registerChatCommand()` (in Class Plugin)
* Removed `$aseco->server->getGame()`, because in Maniaplanet it was useless
* Removed `$aseco->isSpectator($player)`, use `$player->getSpectatorStatus()` instead
* Removed <custom_ui> handling (deprecated) and replaced by <ui_properties> from modescript_settings.xml, more details: http://forum.maniaplanet.com/viewtopic.php?p=228997#p228997
* Removed chat command `/admin listdupes`, because the Database column has unique key
* Removed all donate panels (`Donate*.xml`) from `config/panels`
* Removed all records panels (`Records*.xml`) from `config/panels`
* Removed all vote panels (`Vote*.xml`) from `config/panels`
* Removed `http_get_file()`, use `$aseco->webaccess->request()` instead
* Removed chat command `/top10` from plugin.rasp.php, use `/top100` instead
* Removed chat command `/clans` and `/topclans` from chat.player_infos.php
* Removed the event onStatusChangeTo[1-4,6], because with the ModeScripts we have now more detailed callbacks
* The default database charset is `utf8mb4` and collate `utf8mb4_unicode_ci`
* The folder `panels` has been moved into the `config` folder
* The folder `styles` has been moved into the `config` folder
* PLEASE NOTE: I only hope that this list are all differences, but I am not really sure about this. I was starting too late to write this list, sorry!



### Differences between the database from XAseco2 and UASECO

* PLUGIN AUTHORS NOTE:
 * For each SQL-Query you have to add `%prefix%` before all tablenames, e.g. to access `players` you have to write `%prefix%players`
 * The connection has enabled autocommit, if you need to insert a bulk of data you can disable autocommit, more details: http://dev.mysql.com/doc/refman/5.7/en/commit.html
* Table `maps`:
 * Renamed `Id` to `MapId`
* Table `players`:
 * Renamed `Id` to `PlayerId`
 * Renamed `NickName` to `Nickname`
 * Renamed `UpdatedAt` to `LastVisit`
 * Removed `Game`
 * Removed `TeamName`
* Table `players_extra` has been removed:
 * Moved `Cps` to `settings` table and get stored into serialized `Value`
 * Moved `DediCps` to `settings` table and get stored into serialized `Value`
 * Moved `Donations` to `players` table
 * Moved `Style` to `settings` table and get stored into serialized `Value`
 * Moved `Panels` to `settings` table and get stored into serialized `Value`
 * Moved `PanelBG` to `settings` table and get stored into serialized `Value`
* Table `records`:
 * Removed `Id`
 * Added `GamemodeId`
* Table `rs_karma` renamed to `ratings`
 * Removed `Id`
* Table `rs_rank` renamed to `rankings`
 * Renamed `Avg` to `Average`
* Table `rs_times` renamed to `times`
 * Removed `Id`
 * Added `GamemodeId`
* Added Table `maphistory`
* Added Table `playlist`
