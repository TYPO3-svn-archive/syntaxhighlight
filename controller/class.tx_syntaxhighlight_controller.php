<?php
/***************************************************************
*  Copyright notice
*
*  (c) 2005 Steffen Kamper (steffen@dislabs.de)
*  All rights reserved
*
*  This script is part of the TYPO3 project. The TYPO3 project is
*  free software; you can redistribute it and/or modify
*  it under the terms of the GNU General Public License as published by
*  the Free Software Foundation; either version 2 of the License, or
*  (at your option) any later version.
*
*  The GNU General Public License can be found at
*  http://www.gnu.org/copyleft/gpl.html.
*
*  This script is distributed in the hope that it will be useful,
*  but WITHOUT ANY WARRANTY; without even the implied warranty of
*  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
*  GNU General Public License for more details.
*
*  This copyright notice MUST APPEAR in all copies of the script!
***************************************************************/
/**
 * Plugin 'Controller' for the 'syntaxhighlight' extension.
 *
 * @author	Steffen Kamper <steffen@dislabs.de>
 */

require_once(t3lib_extMgm::extPath('geshilib') . 'res/geshi.php');
require_once(t3lib_extMgm::extPath('syntaxhighlight') . 'api/class.syntaxhighlightAPI.php');

class tx_syntaxhighlight_controller {
	var $prefixId = 'tx_syntaxhighlight_controller';	// Same as class name
	var $scriptRelPath = 'controller/class.tx_syntaxhighlight_controller.php';	// Path to this script relative to the extension dir.
	var $extKey = 'syntaxhighlight';	// The extension key.


	/**
	 * Initialize
	 *
	 * @return	void
	 */
	function init($conf) {
		$this->conf = $conf;
		$this->languages = tx_syntaxhighlightAPI::getLanguages();
	}


	/**
	 * Get configuration from the pi_flexform of the tt_content record
	 *
	 * @return	array		Configuration array
	 */
	function getFlexformConf() {
			// parse XML data into php array
		$data = t3lib_div::xml2array($this->cObj->data['pi_flexform']);

		$config['alternateLines'] = $data['data']['sDEF']['lDEF']['alternateLines']['vDEF'];
		$config['code']           = $data['data']['sDEF']['lDEF']['code']['vDEF'];
		$config['height']         = $data['data']['sDEF']['lDEF']['height']['vDEF'];
		$config['label']          = $data['data']['sDEF']['lDEF']['label']['vDEF'];
		$config['language']       = $data['data']['sDEF']['lDEF']['language']['vDEF'];
		$config['lineNumbers']    = $data['data']['sDEF']['lDEF']['lineNumbers']['vDEF'];
		$config['startLine']      = $data['data']['sDEF']['lDEF']['startLine']['vDEF'];
		$config['width']          = $data['data']['sDEF']['lDEF']['width']['vDEF'];
		return array_merge($this->conf, $config);
	}


	/**
	 * Main entry point, called by TS
	 *
	 * @param  string  $content: any previous content
	 * @param  array   $conf:    TS configuration array
	 * @return string  $content: The previous content plus the highlighted text
	 */
	function main($content, $conf)	{

		$this->init($conf);
		$config = $this->getFlexformConf();

			// override Setup ?
		$width  = ($config['width']) != '' ? $config['width'] : $conf['width'];
		$height = ($config['height']) != '' ? $config['height'] : $conf['height'];

			// create css-inline
		$iewidth = $width - 5; // fix for IE
		$config['inlineTitle'] = 'width:'.$iewidth.'px !important; width /**/:'.$width.'px;';
		$config['inlineCode']  = 'width:'.$width.'px; height:'.$height.'px;';

		$content .= $this->doHighlight($config);

		return $content;
	}


	/**
	 * Highlight code
	 *
	 * @param   array  $config:  configuration and code
	 * @return	string $content: highlighted code
	 */
	function doHighlight($config) {

		if (in_array($config['language'], $this->languages)) {
			$geshi = new GeSHi($config['code'], $config['language'], '');

			if ($config['lineNumbers']) {
				if (intval($config['alternateLines']) > 0) {
					$geshi->enable_line_numbers(GESHI_FANCY_LINE_NUMBERS, $config['alternateLines']);
				}
				$geshi->set_line_style('background: #fcfcfc;', 'background: #fdfdfd;');
			}

			$startLine = $config['startLine'];
			if ($startLine == '' || !is_int(@intval($startLine))) $startLine = 1;
			$geshi->start_line_numbers_at($startLine);

			$geshi->set_link_target('_blank');
			$geshi->enable_classes(true);
			if ($config['useGeshiCSS']) {
				$GLOBALS['TSFE']->additionalCSS[] = $geshi->get_stylesheet();
			}

			$completeCode = $geshi->parse_code();

		} else {
 			$completeCode = 'Language "' . $config['language'] . '" not found';
		}

		if ($config['label'] == '') {
			$geshi->set_language($config['language']);
			$config['label'] = $geshi->get_language_name();
		}

		$content  = '<div class="CodeBox" id="' . uniqid('cb_') . '">';
		$content .= '<div class="CodeBoxTitel"' . ($config['inlineTitle'] ? ' style="'.$config['inlineTitle'] : '') . '">' . $config['label'] . '</div>';
		$content .= '<div class="CodeBoxCode"' . ($config['inlineCode'] ? ' style="'.$config['inlineCode'] : '') . '">' . $completeCode . '</div></div>';
		return $content;
	}


	/**
	 * AJAX call from the RTE
	 *
	 * @return	string $content: highlighted code
	 */
	function highlightRTE() {
		$config['code']        = strtr(t3lib_div::_GP('content'), array('&quot;' => '"'));
		$config['label']       = t3lib_div::_GP('title') ? t3lib_div::_GP('title') : $config['language'];
		$config['language']    = t3lib_div::_GP('language');
		$config['lineNumbers'] = t3lib_div::_GP('lineNumbers');
		$config['startLine']   = t3lib_div::_GP('start');

		$this->languages = tx_syntaxhighlightAPI::getLanguages();
		$content = $this->doHighlight($config);
		echo $content;
		exit;
	}

}

if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/syntaxhighlight/controller/class.tx_syntaxhighlight_controller.php'])	{
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/syntaxhighlight/controller/class.tx_syntaxhighlight_controller.php']);
}
?>
