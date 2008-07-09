<?php
/***************************************************************
*  Copyright notice
*
*  (c) 2008 Steffen Kamper <info@sk-typo3.de>
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

require_once(t3lib_extMgm::extPath('geshilib') . 'res/geshi.php');

/**
 * API Class for the 'syntaxhighlight' extension.
 *
 * @author	Steffen Kamper <info@sk-typo3.de>
 * @package	TYPO3
 * @subpackage	syntaxhighlight
 */
class tx_syntaxhighlightAPI {

	/**
	 * itemsProcFunc for syntaxhighlight in flexform
	 *
	 * @param  array  $params: flexform params
	 * @param  array  $conf: flexform conf
	 * @return
	 */
	public function getFlexFormLanguages($params, $conf) {
		$languages = $this->getLanguages();
		$geshi = new GeSHi('bash', '');
		foreach($languages as $language) {
			$geshi->set_language($language);

				// Workaround for Geshi bug
				// http://sourceforge.net/tracker/index.php?func=detail&aid=2014123&group_id=114997&atid=670231
			if (preg_match('/.*-brief/', $language)) {
				$params['items'][$language][0] = $geshi->get_language_name() . ' brief';
			}
			else {
				$params['items'][$language][0] = $geshi->get_language_name();
			}
			$params['items'][$language][1] = $language;
		}
		return $languages;
	}


	/**
	 * return a list of available language files in current geshilib
	 *
	 * @return  array  $languages:  An array of languages
	 */
	public function getLanguages() {
		// read syntax files
		$array = t3lib_div::getFilesInDir(t3lib_extMgm::extPath('geshilib') . 'res/geshi/', 'php');
		foreach($array as $key => $val) {
			$languages[] = substr($val, 0, -4);
		}
		return $languages;
	}


	/**
	 * Function called from TV, used to generate preview of this plugin
	 *
	 * @param  array   $row:        tt_content table row 
	 * @param  string  $table:      usually tt_content
	 * @param  bool    $alreadyRendered:  To let TV know we have successfully 
	 *                                    rendered a preview
	 * @return object  $reference:  Uh . . . TODO
	 */
	public function renderPreviewContent_preProcess ($row, $table, &$alreadyRendered, &$reference) {
		if ($row['CType'] == 'list' && $row['list_type'] == 'syntaxhighlight_controller') {
			$data = t3lib_div::xml2array($row['pi_flexform']);
			if (is_array($data)) {
				$text     = $data['data']['sDEF']['lDEF']['code']['vDEF'];
				$language = $data['data']['sDEF']['lDEF']['language']['vDEF'];
			}
			if (!$text) {
				$content = $GLOBALS['LANG']->sL('LLL:EXT:syntaxhighlight/language/controller.xml:no_content');
			} else {
				$content = tx_syntaxhighlightAPI::highlight($text, $language);
				$alreadyRendered = true;
			}
			return $reference->link_edit($content, $table, $row['uid']);
		}
	}


	/**
	 * Function called from page view, used to generate preview of this plugin
	 *
	 * @param  array   $params:  flexform params
	 * @param  array   $pObj:    parent object
	 * @return string  $result:  the hghlighted text
	 */
	public function getExtensionSummary($params, &$pObj) {

		if ($params['row']['CType'] == 'list' && $params['row']['list_type'] == 'syntaxhighlight_controller') {
			$data = t3lib_div::xml2array($params['row']['pi_flexform']);
			if (is_array($data)) {
				$text     = $data['data']['sDEF']['lDEF']['code']['vDEF'];
				$language = $data['data']['sDEF']['lDEF']['language']['vDEF'];
			}
			if (!$text) {
				$result = $GLOBALS['LANG']->sL('LLL:EXT:syntaxhighlight/language/controller.xml:no_content');
			} else {
				$result = tx_syntaxhighlightAPI::highlight($text, $language);
			}
		}
		return $result;
	}


	/**
	 * Call this function from your extension: 
	 * $result = tx_syntaxhighlightAPI::highlight($text, $language, $conf);
	 *
	 * @param  string  $text:     the text you want to highlight
	 * @param  sring   $language: the language
	 * @return string  $result:   the highlighted text
	 */
	public function highlight($text, $language, $conf=NULL) {

		require_once(t3lib_extMgm::extPath('geshilib') . 'res/geshi.php');

		$geshi = new GeSHi($text, $language, '');
			// no conf given, use plugin conf
		if (is_null($conf)) {
			$conf = $this->getDefaultConfig();
		}
			// proceed conf
		if (intval($conf['lineNumbers']) > 0) {
			if (intval($conf['alternateLines']) > 0) {
				$geshi->enable_line_numbers(GESHI_FANCY_LINE_NUMBERS, $conf['alternateLines']);
			}
			$geshi->set_line_style('background: #fcfcfc;', 'background: #fdfdfd;');
		}

		$geshi->start_line_numbers_at(intval($conf['startLine']) < 1 ? 1 : intval($conf['startLine']));

		$geshi->set_link_target('_blank');
		$geshi->enable_classes(true);

		if (TYPO3_MODE=='FE') {
				// add css to the page
			if ($config['useGeshiCSS']) {
				$GLOBALS['TSFE']->additionalCSS[] = $geshi->get_stylesheet();
			}
		}
		
		$content = $geshi->parse_code();

		if (!$conf['template']) {
				// use standard template for BE preview
			$conf['template'] = '<div style="max-width:300px;height:120px;background-color:#fefefe;overflow:auto;">
				<p style="background-color:#eee;margin-bottom:4px;">Language: ###LANGUAGE###</p>
				###CODE### </div>';
		}
		$result = strtr($conf['template'], array(
			'###LANGUAGE###' => $language,
			'###CODE###'     => $content
		));
		return $result;
	}

	public function getDefaultConfig() {
		return $GLOBALS['TSFE']->tmpl->setup['plugin.']['tx_syntaxhighlight_controller.'];
	}
	
	
}

if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/syntaxhighlight/api/class.syntaxhighlightAPI.php'])	{
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/syntaxhighlight/api/class.syntaxhighlightAPI.php']);
}
?>
