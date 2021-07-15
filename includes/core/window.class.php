<?php
/*
 * Class: Window
 * ~~~~~~~~~~~~~
 * » Provides a comfortable, configurable styled Manialink window.
 *
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
 *  - includes/core/windowlist.class.php
 *
 */


/*
#///////////////////////////////////////////////////////////////////////#
#									#
#///////////////////////////////////////////////////////////////////////#
*/

class Window extends BaseClass {
	public $config;
	public $layout;
	public $settings;
	public $content;
	public $script;


	/*
	#///////////////////////////////////////////////////////////////////////#
	#									#
	#///////////////////////////////////////////////////////////////////////#
	*/

	public function __construct ($unique_manialink_id = false) {
		global $aseco;

		$this->setAuthor('undef.de');
		$this->setVersion('1.0.13');
		$this->setBuild('2020-07-20');
		$this->setCopyright('2014 - 2020 by undef.de');
		$this->setDescription(new Message('class.window', 'window_description'));

		// Read Configuration
		if (!$this->config = $aseco->parser->xmlToArray('config/class_window.xml', true, true)) {
			trigger_error('[ClassWindow] Could not read/parse config file "config/class_window.xml"!', E_USER_ERROR);
		}
		$this->config = $this->config['SETTINGS'];
		unset($this->config['SETTINGS']);


		// Empty content by default
		$this->content = array(
			'title'					=> '',
			'data'					=> array(),
			'page'					=> 0,
			'maxpage'				=> 0,
			'about_title'				=> '',
			'about_link'				=> '',
			'button_title'				=> '',
			'button_link'				=> '',
			'option_button'				=> '',
		);

		// Setup defaults
		$this->layout = array(
			'position' => array(
				'x' 				=> -102.5,
				'y' 				=> 57.28125,
				'z' 				=> 20.0,
			),
			'title' => array(
				'icon' => array(
					'style'			=> 'Icons64x64_1',
					'substyle'		=> 'ToolLeague1',
				),
			),
			'heading' => array(
				'textcolor'			=> 'FFFFFFFF',
				'backgroundcolor'		=> '0099FFDD',
			),
			'highlite' => array(
				'self'				=> '66880077',
				'other'				=> '88000077',
			),
			'backgrounds' => array(
				'main'				=> '032942F0',
				'content'			=> 'FFFFFF33',
				'columns'			=> 'FFFFFF33',

				'title_default'			=> '000000AA',
				'title_focus'			=> '000000CC',

				'header_button_default'		=> 'EEEEEEFF',
				'header_button_focus'		=> '0099FFFF',

				'pagination_disabled'		=> 'DDDDDD88',
				'pagination_default'		=> '0099FFFF',
				'pagination_focus'		=> 'DDDDDDFF',

				'option_button_background'	=> 'DDDDDDFF',
				'option_button_default'		=> '0099FFFF',
				'option_button_focus'		=> '82AB05FF',

				'link_button_default'		=> '0099FFFF',
				'link_button_focus'		=> '82AB05FF',

				'link_label_default'		=> 'FFFFFF33',
				'link_label_focus'		=> '0099FFFF',

				'about_button_disabled'		=> 'FFFFFF33',
				'about_button_default'		=> 'FFFFFF33',
				'about_button_focus'		=> '0099FFFF',
			),
		);

		$this->settings = array(
			'id'					=> 'TheWindowFromClassWindow',
			'timeout'				=> 0,
			'hideclick'				=> false,
			'stripcodes'				=> false,
			'columns'				=> 2,
			'mode'					=> 'columns',			// 'columns' or 'pages'
			'add_background'			=> false,			// Include a background for 'pages'? 'columns' will get them by default!
			'widths'				=> array(),			// Inner columns
			'halign'				=> array(),			// Inner columns
			'heading'				=> array(),			// Inner columns
			'textcolors'				=> array(),			// array('RRGGBBAA', [...])
		);

		$this->script = array(
			'functions'				=> '',
			'declarations'				=> '',
			'mainloop'				=> '',
			'events' => array(
				'mouse_click'			=> '',
				'mouse_over'			=> '',
				'key_press'			=> '',
			),
		);

		if ($unique_manialink_id === true) {
			// Generate unique ID
			$this->settings['id'] = $aseco->generateManialinkId();
		}
		else if ($unique_manialink_id !== false) {
			// Use given ID
			$this->settings['id'] = $unique_manialink_id;
		}
	}

	/*
	#///////////////////////////////////////////////////////////////////////#
	#									#
	#///////////////////////////////////////////////////////////////////////#
	*/

	public function send ($player, $timeout = 0, $hideclick = false) {
		global $aseco;

		$aseco->windows->send($this, $player, $timeout, $hideclick);
	}

	/*
	#///////////////////////////////////////////////////////////////////////#
	#									#
	#///////////////////////////////////////////////////////////////////////#
	*/

	public function setContent ($param = array()) {
		global $aseco;

		if (isset($param['title']) && $param['title']) {
			$this->content['title'] = $aseco->handleSpecialChars($aseco->formatColors($param['title']));
		}
		if (isset($param['data']) && $param['data']) {
			$this->content['data'] = $param['data'];
		}
		if (isset($param['page']) && $param['page'] > 0) {
			$this->content['page'] = $param['page'];
		}

		if (isset($param['mode']) && in_array($param['mode'], array('columns', 'pages'))) {
			$this->settings['mode'] = $param['mode'];
		}
		if (isset($param['add_background']) && $param['add_background']) {
			$this->settings['add_background'] = $aseco->string2bool($param['add_background']);
		}
	}

	/*
	#///////////////////////////////////////////////////////////////////////#
	#									#
	#///////////////////////////////////////////////////////////////////////#
	*/

	public function setFooter ($param = array()) {
		global $aseco;

		if (isset($param['about_title']) && $param['about_title']) {
			$this->content['about_title'] = $aseco->handleSpecialChars($aseco->formatColors($param['about_title']));
		}
		if (isset($param['about_link']) && $param['about_link']) {
			$this->content['about_link'] = $param['about_link'];
		}

		if (isset($param['button_title']) && $param['button_title']) {
			$this->content['button_title'] = $aseco->handleSpecialChars($aseco->formatColors($param['button_title']));
		}
		if (isset($param['button_link']) && $param['button_link']) {
			$this->content['button_link'] = $param['button_link'];
		}

		if (isset($param['option_button']) && $param['option_button']) {
			$this->content['option_button'] = $param['option_button'];
		}
	}

	/*
	#///////////////////////////////////////////////////////////////////////#
	#									#
	#///////////////////////////////////////////////////////////////////////#
	*/

	public function setManiascript ($param = array()) {

		if (isset($param['functions']) && $param['functions']) {
			$this->script['functions'] = $param['functions'];
		}
		if (isset($param['declarations']) && $param['declarations']) {
			$this->script['declarations'] = $param['declarations'];
		}
		if (isset($param['mainloop']) && $param['mainloop']) {
			$this->script['mainloop'] = $param['mainloop'];
		}

		if (isset($param['mouse_click']) && $param['mouse_click']) {
			$this->script['events']['mouse_click'] = $param['mouse_click'];
		}
		if (isset($param['mouse_over']) && $param['mouse_over']) {
			$this->script['events']['mouse_over'] = $param['mouse_over'];
		}
		if (isset($param['key_press']) && $param['key_press']) {
			$this->script['events']['key_press'] = $param['key_press'];
		}
	}

	/*
	#///////////////////////////////////////////////////////////////////////#
	#									#
	#///////////////////////////////////////////////////////////////////////#
	*/

	public function setColumns ($param = array()) {

		// Check for min. and max. values
		if (isset($param['columns']) && $param['columns']) {
			if ($param['columns'] < 1) {
				$param['columns'] = 1;
			}
			else if ($param['columns'] > 6) {
				$param['columns'] = 6;
			}
			$this->settings['columns'] = $param['columns'];
		}

		// Make sure there is min. one alignment
		if (isset($param['halign']) && count($param['halign']) > 0) {
			$this->settings['halign'] = $param['halign'];
		}

		// Make sure there is min. one width
		if (isset($param['widths']) && count($param['widths']) > 0) {
			$this->settings['widths'] = $param['widths'];
		}

		// Make sure there is min. one text color
		if (isset($param['textcolors']) && count($param['textcolors']) > 0) {
			$this->settings['textcolors'] = $param['textcolors'];
		}

		// Make sure there is min. one heading
		if (isset($param['heading']) && count($param['heading']) > 0) {
			$this->settings['heading'] = $param['heading'];
		}
	}

	/*
	#///////////////////////////////////////////////////////////////////////#
	#									#
	#///////////////////////////////////////////////////////////////////////#
	*/

	public function setStyles ($param = array()) {

		// Title
		if (isset($param['icon']) && $param['icon']) {
			list($this->layout['title']['icon']['style'], $this->layout['title']['icon']['substyle']) = explode(',', $param['icon']);
			$this->layout['title']['icon']['style'] = trim($this->layout['title']['icon']['style']);
			$this->layout['title']['icon']['substyle'] = trim($this->layout['title']['icon']['substyle']);
		}

		// Heading
		if (isset($param['textcolor']) && $param['textcolor']) {
			$this->layout['heading']['textcolor'] = $param['textcolor'];
		}
		if (isset($param['backgroundcolor']) && $param['backgroundcolor']) {
			$this->layout['heading']['backgroundcolor'] = $param['backgroundcolor'];
		}
	}

	/*
	#///////////////////////////////////////////////////////////////////////#
	#									#
	#///////////////////////////////////////////////////////////////////////#
	*/

	public function buildColumns ($login) {
		global $aseco;

		// Headings handling?
		$headings = false;
		if (count($this->settings['heading']) > 0) {
			$headings = true;
		}

		// Total width
		$frame_width = 200.0;

		// Build column background
		$outer_gap = 2.5;
		$column_width = (($frame_width - (($this->settings['columns'] - 1) * $outer_gap)) / $this->settings['columns']);
		$xml = '<frame pos="0 0" z-index="0.01">';
		foreach (range(0, ($this->settings['columns'] - 1)) as $i) {
			$xml .= '<quad pos="'. ($i * ($column_width + $outer_gap)) .' 0" z-index="0.01" size="'. $column_width .' 90" bgcolor="'. $this->layout['backgrounds']['columns'] .'"/>';
		}
		$xml .= '</frame>';

		// Include rows
		if (count($this->content['data']) > 0) {

			// Prepared settings
			$entries = 0;
			$row = 0;
			$offset = 0;
			$line_height = 3.5;			// Default
			if ($headings === true) {
				$line_height = 3.4;		// Reduced because of the heading
				$xml .= '<frame pos="2.5 -1.6" z-index="0.01">';
				foreach (range(0, ($this->settings['columns'] - 1)) as $i) {
					$innercol = 0;
					$last_element_width = 0;
					for ($j = 0; $j <= count($this->settings['heading']) - 1; $j++) {
						$inner_width	= ($column_width - $outer_gap);
						$element_width	= (($inner_width / 100) * $this->settings['widths'][$innercol]);
						$textcolor	= ((isset($this->layout['heading']['textcolor'][$innercol])) ? $this->layout['heading']['textcolor'][$innercol] : end($this->layout['heading']['textcolor']));
						$text		= strtoupper((isset($this->settings['heading'][$innercol])) ? $this->settings['heading'][$innercol] : end($this->settings['heading']));
						$sizew		= $element_width;
						$posx		= ($last_element_width + $offset) + ($sizew / 2.2);

						$xml .= '<label pos="'. $posx .' -0.3" z-index="0.04" size="'. (($sizew / 100) * 145) .' '. $line_height .'" class="labels" halign="center" valign="center2" textcolor="'. $textcolor .'" scale="0.65" text="'. $text .'"/>';

						$last_element_width += $element_width;
						$innercol ++;
					}

					// Add header background color
					$xml .= '<quad pos="'. ($offset - 2.5) .' 1.6" z-index="0.03" size="'. ($column_width ) .' 4" bgcolor="'. $this->layout['heading']['backgroundcolor'] .'"/>';

					$offset += (($frame_width + $outer_gap) / $this->settings['columns']);
				}
				$xml .= '</frame>';
				$xml .= '<frame pos="2.5 -4.5" z-index="0.01">';
			}
			else {
				$xml .= '<frame pos="2.5 -1.5" z-index="0.01">';
			}


			// Mark current connected Players
			$players = array();
			foreach ($aseco->server->players->player_list as $p) {
				$players[] = $p->login;
			}
			unset($p);

			$row = 0;
			$offset = 0;
			$xml .= '<frame pos="-2.5 0" z-index="0.01">';
			for ($i = ($this->content['page'] * ($this->settings['columns'] * 25)); $i < (($this->content['page'] * ($this->settings['columns'] * 25)) + ($this->settings['columns'] * 25)); $i ++) {
				// Is there an entry to display?
				if (!isset($this->content['data'][$i])) {
					break;
				}

				foreach ($this->content['data'][$i] as $value) {
					if (is_array($value) && isset($value['login'])) {
						if ($value['login'] === $login) {
							$xml .= '<quad pos="'. $offset .' -'. ($line_height * $row) .'" z-index="0.06" size="'. $column_width .' 3.2" bgcolor="'. $this->layout['highlite']['self'] .'"/>';
						}
						else if (in_array($value['login'], $players)) {
							$xml .= '<quad pos="'. $offset .' -'. ($line_height * $row) .'" z-index="0.06" size="'. $column_width .' 3.2" bgcolor="'. $this->layout['highlite']['other'] .'"/>';
						}
					}
				}
				$row ++;

				// Check last row, setup next column
				if ($row >= 25) {
					$offset += (($frame_width + $outer_gap) / $this->settings['columns']);
					$row = 0;
				}
			}
			$xml .= '</frame>';
			unset($players);


			// Build the entries
			$entries = 0;
			$row = 0;
			$offset = 0;
			$inner_gap = 0.625;
			for ($i = ($this->content['page'] * ($this->settings['columns'] * 25)); $i < (($this->content['page'] * ($this->settings['columns'] * 25)) + ($this->settings['columns'] * 25)); $i ++) {
				// Is there an entry to display?
				if (!isset($this->content['data'][$i])) {
					break;
				}

				$innercol = 0;
				$last_element_width = 0;
				foreach ($this->content['data'][$i] as $value) {
					$inner_width	= ($column_width - $outer_gap);
					$element_width	= (($inner_width / 100) * $this->settings['widths'][$innercol]);

					if (is_array($value) && isset($value['image']) && !empty($value['image'])) {
						$posx = ($last_element_width + $offset);
						if (isset($this->settings['halign'][$innercol])) {
							if (strtolower($this->settings['halign'][$innercol]) === 'center') {
								$posx += ($element_width / 2);
							}
							else if (strtolower($this->settings['halign'][$innercol]) === 'right') {
								$posx += $element_width;
							}
						}
						$xml .= '<quad pos="'. $posx .' -'. ($line_height * $row) .'" z-index="0.07" size="3.2 3.2" halign="'. $this->settings['halign'][$innercol] .'" image="'. $value['image'] .'"/>';
					}
					else {
						// Setup <label...>
						$textcolor	= ((isset($this->settings['textcolors'][$innercol])) ? $this->settings['textcolors'][$innercol] : end($this->settings['textcolors']));
						$sizew		= ($element_width - ($inner_gap / 2));
						$posx		= (($inner_gap / 2) + $last_element_width + $offset);
						$posy		= -($line_height * $row + 1.45);
						if (isset($this->settings['halign'][$innercol]) && strtolower($this->settings['halign'][$innercol]) === 'center') {
							$posx += ($sizew / 2);
						}
						else if (isset($this->settings['halign'][$innercol]) && strtolower($this->settings['halign'][$innercol]) === 'right') {
							$posx += ($sizew - $inner_gap);
						}

						$xml .= '<label pos="'. $posx .' '. $posy .'" z-index="0.07" size="'. $sizew .' 3.2" class="labels" halign="'. (isset($this->settings['halign'][$innercol]) ? $this->settings['halign'][$innercol] : 'left') .'" valign="center2" scale="0.9"';
						if (is_array($value)) {
							if (isset($value['action']) && !empty($value['action']) && isset($value['title'])) {
								$xml .= ' action="'. $value['action'] .'" focusareacolor1="'. $this->layout['backgrounds']['link_label_default'] .'" focusareacolor2="'. $this->layout['backgrounds']['link_label_focus'] .'"';
								$xml .= ' textcolor="'. $textcolor .'" text="'. $this->normalizeString($value['title']) .'"/>';
							}
							else if (isset($value['login']) && isset($value['nickname'])) {
								$xml .= ' textcolor="'. $textcolor .'" text="'. $this->normalizeString($value['nickname']) .'"/>';
							}
						}
						else {
							$xml .= ' textcolor="'. $textcolor .'" text="'. $this->normalizeString($value) .'"/>';
						}
					}
					$last_element_width += $element_width + $inner_gap;
					$innercol ++;
				}
				$row ++;
				$entries ++;

				// Check last row, setup next column
				if ($row >= 25) {
					$offset += (($frame_width + $outer_gap) / $this->settings['columns']);
					$row = 0;
				}

				// Break if max. amount of entries reached
				if ($entries >= (25 * $this->settings['columns'])) {
					break;
				}
			}
			$xml .= '</frame>';
		}
		return $xml;
	}

	/*
	#///////////////////////////////////////////////////////////////////////#
	#									#
	#///////////////////////////////////////////////////////////////////////#
	*/

	public function buildPages () {

		if (isset($this->content['data'][$this->content['page']])) {
			return $this->content['data'][$this->content['page']];
		}
	}

	/*
	#///////////////////////////////////////////////////////////////////////#
	#									#
	#///////////////////////////////////////////////////////////////////////#
	*/

	public function buildButtons () {
		global $aseco;

		if ($this->settings['mode'] === 'columns') {
			$totalentries			= count($this->content['data']);
			$this->content['maxpage']	= ceil($totalentries / ($this->settings['columns'] * 25)) - 1;
		}
		else if ($this->settings['mode'] === 'pages') {
			$this->content['maxpage']	= count($this->content['data']) - 1;
		}

		// Check if not more then 'maxpage' are given
		if ($this->content['page'] > $this->content['maxpage']) {
			$this->content['page'] = $this->content['maxpage'];
		}

		// Previous buttons
		$buttons = '<frame pos="167.5 -102" z-index="0.04">';
		if ($this->content['page'] > 0) {
			// First
			$buttons .= '<frame pos="0 0" z-index="0.05">';
			$buttons .= '<quad pos="0 0" z-index="0.01" size="5 5" bgcolor="'. $this->layout['backgrounds']['pagination_default'] .'" bgcolorfocus="'. $this->layout['backgrounds']['pagination_focus'] .'" id="ClassWindowButtonPrevFirst" ScriptEvents="1"/>';
			$buttons .= '<quad pos="0 0" z-index="0.02" size="5 5" image="'. $this->config['MEDIA'][0]['ARROW_PREV_FIRST'][0] .'"/>';
			$buttons .= '</frame>';

			// Previous (-2)
			$buttons .= '<frame pos="6 0" z-index="0.05">';
			$buttons .= '<quad pos="0 0" z-index="0.01" size="5 5" bgcolor="'. $this->layout['backgrounds']['pagination_default'] .'" bgcolorfocus="'. $this->layout['backgrounds']['pagination_focus'] .'" id="ClassWindowButtonPrevTwo" ScriptEvents="1"/>';
			$buttons .= '<quad pos="0 0" z-index="0.02" size="5 5" image="'. $this->config['MEDIA'][0]['ARROW_PREV_TWO'][0] .'"/>';
			$buttons .= '</frame>';

			// Previous (-1)
			$buttons .= '<frame pos="12 0" z-index="0.05">';
			$buttons .= '<quad pos="0 0" z-index="0.01" size="5 5" bgcolor="'. $this->layout['backgrounds']['pagination_default'] .'" bgcolorfocus="'. $this->layout['backgrounds']['pagination_focus'] .'" id="ClassWindowButtonPrev" ScriptEvents="1"/>';
			$buttons .= '<quad pos="0 0" z-index="0.02" size="5 5" image="'. $this->config['MEDIA'][0]['ARROW_PREV'][0] .'"/>';
			$buttons .= '</frame>';
		}
		else {
			// First
			$buttons .= '<frame pos="0 0" z-index="0.05">';
			$buttons .= '<quad pos="0 0" z-index="0.01" size="5 5" bgcolor="'. $this->layout['backgrounds']['pagination_disabled'] .'"/>';
			$buttons .= '</frame>';

			// Previous (-2)
			$buttons .= '<frame pos="6 0" z-index="0.05">';
			$buttons .= '<quad pos="0 0" z-index="0.01" size="5 5" bgcolor="'. $this->layout['backgrounds']['pagination_disabled'] .'"/>';
			$buttons .= '</frame>';

			// Previous (-1)
			$buttons .= '<frame pos="12 0" z-index="0.05">';
			$buttons .= '<quad pos="0 0" z-index="0.01" size="5 5" bgcolor="'. $this->layout['backgrounds']['pagination_disabled'] .'"/>';
			$buttons .= '</frame>';
		}

		// Next buttons
		if (($this->content['page'] + 1) <= $this->content['maxpage']) {
			// Next (+1)
			$buttons .= '<frame pos="18 0" z-index="0.05">';
			$buttons .= '<quad pos="0 0" z-index="0.01" size="5 5" bgcolor="'. $this->layout['backgrounds']['pagination_default'] .'" bgcolorfocus="'. $this->layout['backgrounds']['pagination_focus'] .'" id="ClassWindowButtonNext" ScriptEvents="1"/>';
			$buttons .= '<quad pos="0 0" z-index="0.02" size="5 5" image="'. $this->config['MEDIA'][0]['ARROW_NEXT'][0] .'"/>';
			$buttons .= '</frame>';

			// Next (+2)
			$buttons .= '<frame pos="24 0" z-index="0.05">';
			$buttons .= '<quad pos="0 0" z-index="0.01" size="5 5" bgcolor="'. $this->layout['backgrounds']['pagination_default'] .'" bgcolorfocus="'. $this->layout['backgrounds']['pagination_focus'] .'" id="ClassWindowButtonNextTwo" ScriptEvents="1"/>';
			$buttons .= '<quad pos="0 0" z-index="0.02" size="5 5" image="'. $this->config['MEDIA'][0]['ARROW_NEXT_TWO'][0] .'"/>';
			$buttons .= '</frame>';

			// Last
			$buttons .= '<frame pos="30 0" z-index="0.05">';
			$buttons .= '<quad pos="0 0" z-index="0.01" size="5 5" bgcolor="'. $this->layout['backgrounds']['pagination_default'] .'" bgcolorfocus="'. $this->layout['backgrounds']['pagination_focus'] .'" id="ClassWindowButtonNextEnd" ScriptEvents="1"/>';
			$buttons .= '<quad pos="0 0" z-index="0.02" size="5 5" image="'. $this->config['MEDIA'][0]['ARROW_NEXT_LAST'][0] .'"/>';
			$buttons .= '</frame>';
		}
		else {
			// First
			$buttons .= '<frame pos="18 0" z-index="0.05">';
			$buttons .= '<quad pos="0 0" z-index="0.01" size="5 5" bgcolor="'. $this->layout['backgrounds']['pagination_disabled'] .'"/>';
			$buttons .= '</frame>';

			// Previous (-2)
			$buttons .= '<frame pos="24 0" z-index="0.05">';
			$buttons .= '<quad pos="0 0" z-index="0.01" size="5 5" bgcolor="'. $this->layout['backgrounds']['pagination_disabled'] .'"/>';
			$buttons .= '</frame>';

			// Previous (-1)
			$buttons .= '<frame pos="30 0" z-index="0.05">';
			$buttons .= '<quad pos="0 0" z-index="0.01" size="5 5" bgcolor="'. $this->layout['backgrounds']['pagination_disabled'] .'"/>';
			$buttons .= '</frame>';
		}
		$buttons .= '</frame>';

		return $buttons;
	}

	/*
	#///////////////////////////////////////////////////////////////////////#
	#									#
	#///////////////////////////////////////////////////////////////////////#
	*/

	public function buildWindow ($login) {

		// Placeholder:
		// - %content%
		// - %buttons%
		// - %maniascript%

		// Begin Window
		$xml = '<manialink id="'. $this->settings['id'] .'" name="ClassWindow" version="3">';
		$xml .= '<stylesheet>';
		$xml .= '<style class="labels" textsize="1" scale="1" textcolor="FFFF"/>';
		$xml .= '</stylesheet>';
		$xml .= '<frame pos="'. $this->layout['position']['x'] .' '. $this->layout['position']['y'] .'" z-index="'. $this->layout['position']['z'] .'" id="ClassWindow">';	// BEGIN: Window Frame
		$xml .= '<quad pos="0 -8" z-index="0.01" size="205 100.5" bgcolor="'. $this->layout['backgrounds']['main'] .'" id="ClassWindowBody" ScriptEvents="1"/>';

		// Title
		$xml .= '<quad pos="0 0" z-index="0.04" size="205 8" bgcolor="'. $this->layout['backgrounds']['title_default'] .'" bgcolorfocus="'. $this->layout['backgrounds']['title_focus'] .'" id="ClassWindowTitle" ScriptEvents="1"/>';
		$xml .= '<quad pos="2.5 -1.075" z-index="0.05" size="5.5 5.5" style="'. $this->layout['title']['icon']['style'] .'" substyle="'. $this->layout['title']['icon']['substyle'] .'"/>';
		$xml .= '<label pos="8 -2.575" z-index="0.05" size="188.5 3.75" class="labels" textsize="2" scale="1" textcolor="'. $this->layout['heading']['textcolor'] .'" textfont="Oswald" text="'. $this->content['title'] .'"/>';

		// Minimize Button
		$xml .= '<frame pos="190 0.125" z-index="0.05">';
		$xml .= '<quad pos="2.25 -2.4" z-index="0.02" size="3.75 3.75" bgcolor="'. $this->layout['backgrounds']['header_button_default'] .'" bgcolorfocus="'. $this->layout['backgrounds']['header_button_focus'] .'" id="ClassWindowMinimize" ScriptEvents="1"/>';
		$xml .= '<quad pos="2.25 -2.4" z-index="0.03" size="3.75 3.75" image="'. $this->config['MEDIA'][0]['BUTTON_MINIMIZE'][0] .'"/>';
		$xml .= '</frame>';

		// Close Button
		$xml .= '<frame pos="196 0.125" z-index="0.05">';
		$xml .= '<quad pos="2.25 -2.4" z-index="0.02" size="3.75 3.75" bgcolor="'. $this->layout['backgrounds']['header_button_default'] .'" bgcolorfocus="'. $this->layout['backgrounds']['header_button_focus'] .'" id="ClassWindowClose" ScriptEvents="1"/>';
		$xml .= '<quad pos="2.25 -2.4" z-index="0.03" size="3.75 3.75" image="'. $this->config['MEDIA'][0]['BUTTON_CLOSE'][0] .'"/>';
		$xml .= '</frame>';

		// Content
		$xml .= '<frame pos="2.5 -10.5" z-index="0.05">';
		if ($this->settings['add_background'] === true) {
			$xml .= '<quad pos="0 0" z-index="0" size="200 90" bgcolor="'. $this->layout['backgrounds']['content'] .'"/>';
		}
		$xml .= '%content%';
		$xml .= '</frame>';

		// Page info
		if ($this->content['maxpage'] > 0) {
			$xml .= '<frame pos="188 -3" z-index="0.05">';
			$xml .= '<label pos="0 0" z-index="0.02" size="35 3.75" class="labels" halign="right" textsize="1" scale="0.9" textcolor="FFFFFFDD" text="'. (new Message('class.window', 'header_page'))->finish($login) .' '. ($this->content['page'] + 1) .' '. (new Message('class.window', 'header_of'))->finish($login) .' '. ($this->content['maxpage'] + 1) .'"/>';
			$xml .= '</frame>';
		}

		// About
		if (!empty($this->content['about_title'])) {
			$xml .= '<frame pos="16 -104.4" z-index="0.06">';
			$xml .= '<label pos="0 0" z-index="0.03" size="45 3.75" class="labels" halign="center" valign="center2" textsize="1" scale="0.6" textcolor="FFFFFFDD"';
			if (!empty($this->content['about_link'])) {
				$protocol = explode('://', $this->content['about_link']);
				$attr = 'manialink';
				if ($protocol[0] === 'manialink') {
					$attr = 'manialink';
					$this->content['about_link'] = str_replace(array('manialink://', 'manialink:///:'), $this->content['about_link']);
				}
				else if (in_array($protocol[0], array('http', 'https', 'ftp', 'ftps', 'ts3server', 'mumble'))) {
					$attr = 'url';
				}
				else {
					$attr = 'action';
				}
				$xml .= ' focusareacolor1="'. $this->layout['backgrounds']['about_button_default'] .'" focusareacolor2="'. $this->layout['backgrounds']['about_button_focus'] .'" '. $attr .'="'. $this->content['about_link'] .'"';
			}
			else {
				$xml .= ' focusareacolor1="'. $this->layout['backgrounds']['about_button_default'] .'" focusareacolor2="'. $this->layout['backgrounds']['about_button_disabled'] .'" action="WindowList?Action=IGNORE"';
			}
			$xml .= ' text="'. $this->content['about_title'] .'"/>';
			$xml .= '</frame>';
		}

		// Button
		if (!empty($this->content['button_title']) && !empty($this->content['button_link'])) {
			$protocol = explode('://', $this->content['button_link']);
			$attr = 'manialink';
			if ($protocol[0] === 'manialink') {
				$attr = 'manialink';
				$this->content['button_link'] = str_replace(array('manialink://', 'manialink:///:'), $this->content['button_link']);
			}
			else if (in_array($protocol[0], array('http', 'https', 'ftp', 'ftps', 'ts3server', 'mumble'))) {
				$attr = 'url';
			}
			else {
				$attr = 'action';
			}
			$xml .= '<frame pos="101.5 -104.4" z-index="0.04">';
			$xml .= '<label pos="0 0" z-index="0.02" size="75 4.875" class="labels" halign="center" valign="center2" textsize="1" scale="0.8" focusareacolor1="'. $this->layout['backgrounds']['link_button_default'] .'" focusareacolor2="'. $this->layout['backgrounds']['link_button_focus'] .'" '. $attr .'="'. $this->content['button_link'] .'" text="'. $this->content['button_title'] .'"/>';
			$xml .= '</frame>';
		}


		// Options Button
		if (is_array($this->content['option_button'])) {
			$xml .= '<frame pos="155.5 -102" z-index="1.00">';
			$xml .= ' <frame pos="0 0" z-index="0.05">';
			$xml .= '  <quad pos="0 0" z-index="0.01" size="5 5" bgcolor="'. $this->layout['backgrounds']['pagination_default'] .'" bgcolorfocus="'. $this->layout['backgrounds']['pagination_focus'] .'" id="ClassWindowButtonOptions" ScriptEvents="1"/>';
			$xml .= '  <quad pos="0 0" z-index="0.02" size="5 5" image="'. $this->config['MEDIA'][0]['ARROW_UP'][0] .'"/>';
			$xml .= ' </frame>';

			$line = 0;
			$gap = 0.5;
			$height = 3.8;
			$xml .= ' <frame pos="0 '. ((($height + $gap) * count($this->content['option_button'])) + ($gap * 2)) .'" z-index="0.10" id="ClassWindowFrameButtonOptions" hidden="true">';
			$xml .= '  <quad pos="0 0" z-index="0.01" size="47 '. ((($height + $gap) * count($this->content['option_button'])) + $gap) .'" bgcolor="'. $this->layout['backgrounds']['option_button_background'] .'"/>';
			$xml .= '  <frame pos="0 -'. (($height / 2) + $gap) .'" z-index="0.10">';
			foreach ($this->content['option_button'] as $entry) {
				$protocol = explode('://', $entry[1]);
				$attr = 'manialink';
				if ($protocol[0] === 'manialink') {
					$attr = 'manialink';
					$this->content['button_link'] = str_replace(array('manialink://', 'manialink:///:'), $this->content['button_link']);
				}
				else if (in_array($protocol[0], array('http', 'https', 'ftp', 'ftps', 'ts3server', 'mumble'))) {
					$attr = 'url';
				}
				else {
					$attr = 'action';
				}
				$xml .= '<label pos="'. $gap .' -'. (($height + $gap) * $line) .'" z-index="0.02" size="46 '. $height .'" class="labels" valign="center2" textsize="1" scale="1" focusareacolor1="'. $this->layout['backgrounds']['option_button_default'] .'" focusareacolor2="'. $this->layout['backgrounds']['option_button_focus'] .'" '. $attr .'="'. $entry[1] .'" text=" '. $entry[0] .'"/>';
				$line += 1;
			}
			$xml .= '  </frame>';
			$xml .= ' </frame>';

			$xml .= '</frame>';
		}
		else {
			// Required to keep the ManiaScript valid on declare
			$xml .= ' <frame pos="0 0" z-index="0.10" id="ClassWindowFrameButtonOptions" visible="false"></frame>';
		}

		// Navigation Buttons
		$xml .= '%buttons%';

		// Footer
		$xml .= '</frame>';				// END: Window Frame
		$xml .= '%maniascript%';			// Maniascript
		$xml .= '</manialink>';

		return $xml;
	}

	/*
	#///////////////////////////////////////////////////////////////////////#
	#									#
	#///////////////////////////////////////////////////////////////////////#
	*/

	public function buildManiascript () {
$maniascript = <<<EOL
<script><!--
 /*
 * ==================================
 * Author:	undef.de
 * Website:	http://www.uaseco.org
 * Class:	window.class.php
 * License:	GPLv3
 * ==================================
 */
#Include "TextLib" as TextLib
#Include "MathLib" as MathLib
Void ClassWindowWipeOut (Text ChildId) {
	declare CMlFrame ClassWindowFrame <=> (Page.GetFirstChild(ChildId) as CMlFrame);
	if (ClassWindowFrame != Null) {
		declare Real EndPosnX = 0.0;
		declare Real EndPosnY = 0.0;
		declare Real PosnDistanceX = (EndPosnX - ClassWindowFrame.RelativePosition_V3.X);
		declare Real PosnDistanceY = (EndPosnY - ClassWindowFrame.RelativePosition_V3.Y);

		while (ClassWindowFrame.RelativeScale > 0.0) {
			ClassWindowFrame.RelativePosition_V3.X += (PosnDistanceX / 20);
			ClassWindowFrame.RelativePosition_V3.Y += (PosnDistanceY / 20);
			ClassWindowFrame.RelativeScale -= 0.05;
			yield;
		}
		ClassWindowFrame.Unload();

//		// Disable catching ESC key
//		EnableMenuNavigationInputs = False;
	}
}
Void ClassWindowMinimize (Text ChildId) {
	declare CMlFrame ClassWindowFrame <=> (Page.GetFirstChild(ChildId) as CMlFrame);
	if (ClassWindowFrame != Null) {
		declare Real PosnDistanceX = ({$this->layout['position']['x']} - ClassWindowFrame.RelativePosition_V3.X);
		declare Real PosnDistanceY = ({$this->layout['position']['y']} - ClassWindowFrame.RelativePosition_V3.Y);

		while (ClassWindowFrame.RelativeScale > 0.2) {
			ClassWindowFrame.RelativePosition_V3.X += (PosnDistanceX / 16);
			ClassWindowFrame.RelativePosition_V3.Y += (PosnDistanceY / 16);
			ClassWindowFrame.RelativeScale -= 0.05;
			yield;
		}
	}
}
Void ClassWindowMaximize (Text ChildId) {
	declare CMlFrame ClassWindowFrame <=> (Page.GetFirstChild(ChildId) as CMlFrame);
	if (ClassWindowFrame != Null) {
		declare Real EndPosnX = {$this->layout['position']['x']};
		declare Real EndPosnY = {$this->layout['position']['y']};
		declare Real PosnDistanceX = (EndPosnX - ClassWindowFrame.RelativePosition_V3.X);
		declare Real PosnDistanceY = (EndPosnY - ClassWindowFrame.RelativePosition_V3.Y);

		while (ClassWindowFrame.RelativeScale < 1.0) {
			ClassWindowFrame.RelativePosition_V3.X += (PosnDistanceX / 16);
			ClassWindowFrame.RelativePosition_V3.Y += (PosnDistanceY / 16);
			ClassWindowFrame.RelativeScale += 0.05;
			yield;
		}
	}
}

// Custom functions
{$this->script['functions']}

main () {
	declare CMlFrame ClassWindowFrame		<=> (Page.GetFirstChild("ClassWindow") as CMlFrame);
	declare CMlFrame ClassWindowFrameButtonOptions	<=> (Page.GetFirstChild("ClassWindowFrameButtonOptions") as CMlFrame);

	declare Boolean ClassWindowMoveWindow = False;
	declare Boolean ClassWindowIsMinimized = False;
	declare Real ClassWindowMouseDistanceX = 0.0;
	declare Real ClassWindowMouseDistanceY = 0.0;

	// Custom declarations
	{$this->script['declarations']}

//	// Enable catching ESC key
//	EnableMenuNavigationInputs = True;

	while (True) {
		yield;
		if (ClassWindowMoveWindow == True) {
			ClassWindowFrame.RelativePosition_V3.X = (ClassWindowMouseDistanceX + MouseX);
			ClassWindowFrame.RelativePosition_V3.Y = (ClassWindowMouseDistanceY + MouseY);
		}
		if (MouseLeftButton == True) {
			if (PendingEvents.count > 0) {
				foreach (Event in PendingEvents) {
					if (Event.ControlId == "ClassWindowTitle") {
						ClassWindowMouseDistanceX = (ClassWindowFrame.RelativePosition_V3.X - MouseX);
						ClassWindowMouseDistanceY = (ClassWindowFrame.RelativePosition_V3.Y - MouseY);
						ClassWindowMoveWindow = True;
					}
				}
			}
		}
		else {
			ClassWindowMoveWindow = False;
		}

		// Custom main loop
		{$this->script['mainloop']}

		foreach (Event in PendingEvents) {
			switch (Event.Type) {
				case CMlScriptEvent::Type::MouseClick : {
					if (Event.ControlId == "ClassWindowButtonOptions") {
						if (ClassWindowFrameButtonOptions.Visible == True) {
							ClassWindowFrameButtonOptions.Visible = False;
						}
						else {
							ClassWindowFrameButtonOptions.Visible = True;
						}
					}

					if (Event.ControlId == "ClassWindowButtonPrevFirst") {
						TriggerPageAction("WindowList?Action=ClassWindowPageFirst&X="^ ClassWindowFrame.RelativePosition_V3.X ^"&Y="^ ClassWindowFrame.RelativePosition_V3.Y);
					}
					else if (Event.ControlId == "ClassWindowButtonPrevTwo") {
						TriggerPageAction("WindowList?Action=ClassWindowPagePrevTwo&X="^ ClassWindowFrame.RelativePosition_V3.X ^"&Y="^ ClassWindowFrame.RelativePosition_V3.Y);
					}
					else if (Event.ControlId == "ClassWindowButtonPrev") {
						TriggerPageAction("WindowList?Action=ClassWindowPagePrev&X="^ ClassWindowFrame.RelativePosition_V3.X ^"&Y="^ ClassWindowFrame.RelativePosition_V3.Y);
					}
					else if (Event.ControlId == "ClassWindowButtonNext") {
						TriggerPageAction("WindowList?Action=ClassWindowPageNext&X="^ ClassWindowFrame.RelativePosition_V3.X ^"&Y="^ ClassWindowFrame.RelativePosition_V3.Y);
					}
					else if (Event.ControlId == "ClassWindowButtonNextTwo") {
						TriggerPageAction("WindowList?Action=ClassWindowPageNextTwo&X="^ ClassWindowFrame.RelativePosition_V3.X ^"&Y="^ ClassWindowFrame.RelativePosition_V3.Y);
					}
					else if (Event.ControlId == "ClassWindowButtonNextEnd") {
						TriggerPageAction("WindowList?Action=ClassWindowPageLast&X="^ ClassWindowFrame.RelativePosition_V3.X ^"&Y="^ ClassWindowFrame.RelativePosition_V3.Y);
					}
					else if (Event.ControlId == "ClassWindowClose") {
						ClassWindowWipeOut("ClassWindow");
					}
					else if (Event.ControlId == "ClassWindowMinimize" && ClassWindowIsMinimized == False) {
						Audio.PlaySoundEvent(CAudioManager::ELibSound::ShowMenu, 0, 1.0);
						ClassWindowMinimize("ClassWindow");
						ClassWindowIsMinimized = True;
					}
					else if (Event.ControlId == "ClassWindowBody" && ClassWindowIsMinimized == True) {
						Audio.PlaySoundEvent(CAudioManager::ELibSound::HideMenu, 0, 1.0);
						ClassWindowMaximize("ClassWindow");
						ClassWindowIsMinimized = False;
					}

					// Custom MouseClick
					{$this->script['events']['mouse_click']}
				}
				case CMlScriptEvent::Type::MouseOver : {
					if (
						Event.ControlId == "ClassWindowClose" ||
						Event.ControlId == "ClassWindowMinimize" ||
						Event.ControlId == "ClassWindowButtonPrevFirst" ||
						Event.ControlId == "ClassWindowButtonPrevTwo" ||
						Event.ControlId == "ClassWindowButtonPrev" ||
						Event.ControlId == "ClassWindowButtonNext" ||
						Event.ControlId == "ClassWindowButtonNextTwo" ||
						Event.ControlId == "ClassWindowButtonNextEnd"

					) {
						Audio.PlaySoundEvent(CAudioManager::ELibSound::Valid, 2, 1.0);
					}

					// Custom MouseOver
					{$this->script['events']['mouse_over']}
				}
				case CMlScriptEvent::Type::KeyPress : {
					if (Event.KeyName == "Home") {
						TriggerPageAction("WindowList?Action=ClassWindowPageFirst&X="^ ClassWindowFrame.RelativePosition_V3.X ^"&Y="^ ClassWindowFrame.RelativePosition_V3.Y);
					}
					else if (Event.KeyName == "End") {
						TriggerPageAction("WindowList?Action=ClassWindowPageLast&X="^ ClassWindowFrame.RelativePosition_V3.X ^"&Y="^ ClassWindowFrame.RelativePosition_V3.Y);
					}
					else if (Event.KeyName == "Prior") {
						TriggerPageAction("WindowList?Action=ClassWindowPagePrev&X="^ ClassWindowFrame.RelativePosition_V3.X ^"&Y="^ ClassWindowFrame.RelativePosition_V3.Y);
					}
					else if (Event.KeyName == "Next") {
						TriggerPageAction("WindowList?Action=ClassWindowPageNext&X="^ ClassWindowFrame.RelativePosition_V3.X ^"&Y="^ ClassWindowFrame.RelativePosition_V3.Y);
					}
					else if (Event.KeyName == "Cut") {		// CTRL + X
						ClassWindowWipeOut("ClassWindow");
					}
					else if (Event.KeyName == "NumpadSubstract" && ClassWindowIsMinimized == False) {
						if (ClassWindowFrame != Null) {
							Audio.PlaySoundEvent(CAudioManager::ELibSound::ShowMenu, 0, 1.0);
							ClassWindowMinimize("ClassWindow");
							ClassWindowIsMinimized = True;
						}
					}
					else if (Event.KeyName == "NumpadAdd" && ClassWindowIsMinimized == True) {
						if (ClassWindowFrame != Null) {
							Audio.PlaySoundEvent(CAudioManager::ELibSound::HideMenu, 0, 1.0);
							ClassWindowMaximize("ClassWindow");
							ClassWindowIsMinimized = False;
						}
					}

					// Custom KeyPress
					{$this->script['events']['key_press']}
				}
			}
		}
	}
}
--></script>
EOL;
		return $maniascript;
	}

	/*
	#///////////////////////////////////////////////////////////////////////#
	#									#
	#///////////////////////////////////////////////////////////////////////#
	*/

	public function normalizeString ($string) {
		global $aseco;

		if ($this->settings['stripcodes'] === true) {
			// Remove all formating codes
			$string = $aseco->stripStyles($string);
		}
		else {
			// Remove links, e.g. "$(L|H|P)[...]...$(L|H|P)"
			$string = preg_replace('/\${1}(L|H|P)\[.*?\](.*?)\$(L|H|P)/i', '$2', $string);
			$string = preg_replace('/\${1}(L|H|P)\[.*?\](.*?)/i', '$2', $string);
			$string = preg_replace('/\${1}(L|H|P)(.*?)/i', '$2', $string);

			// Remove $S (shadow)
			// Remove $H (manialink)
			// Remove $W (wide)
			// Remove $I (italic)
			// Remove $L (link)
			// Remove $O (bold)
			// Remove $N (narrow)
			$string = preg_replace('/\${1}[SHWILON]/i', '', $string);
		}

		return $aseco->handleSpecialChars($string);
	}
}

?>
