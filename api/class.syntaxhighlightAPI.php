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
		if (TYPO3_MODE=='BE') {
			$usedLanguages = (array) $GLOBALS['BE_USER']->uc['syntaxhighlighter_languages'];
		} else {
			$usedLanguages = array();
		}
		
		foreach($array as $key => $val) {
			$lang = substr($val, 0, -4);
			if (!in_array($lang, $usedLanguages)) {
				$languages[] = $lang;
			}
		}
		
		return array_merge($usedLanguages, $languages);
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
	 * $result = tx_syntaxhighlightAPI::highlight($text, $language);
	 * 
	 * Would you like a own configuration do this
	 * 
	 * $conf = tx_syntaxhighlightAPI::getDefaultConfig();
	 * $conf['OPTION'] = VALUE;
	 * 
	 * $result = tx_syntaxhighlightAPI::highlight($text, $language, $conf);
	 *
	 * @param  string  $text:     the text you want to highlight
	 * @param  sring   $language: the language
	 * @param  array   $conf: 	  configuration array
	 * @return string  $result:   the highlighted text
	 */
	public function highlight($text, $language, $conf=NULL) {

		require_once(t3lib_extMgm::extPath('geshilib') . 'res/geshi.php');

		$geshi = new GeSHi($text, $language, '');
			// no conf given, use plugin conf
		if (is_null($conf)) {
			$conf = tx_syntaxhighlightAPI::getDefaultConfig();
		}
			// proceed conf
		if (intval($conf['lineNumbers']) > 0) {
			if (intval($conf['alternateLines']) > 0) {
				$geshi->enable_line_numbers(GESHI_FANCY_LINE_NUMBERS, $conf['alternateLines']);
			}
			else {
				$geshi->enable_line_numbers(GESHI_NORMAL_LINE_NUMBERS);
			}
			$geshi->set_line_style('background: #fcfcfc;', 'background: #fdfdfd;');
		}

		$geshi->start_line_numbers_at(intval($conf['startLine']) < 1 ? 1 : intval($conf['startLine']));

		$geshi->set_link_target('_blank');

		if (TYPO3_MODE == 'FE') {
				// overall style
			$geshi->enable_classes(true);
			if ($conf['style.']['overall']) {
				$geshi->set_overall_style($conf['style.']['overall'], (bool) $conf['style.']['overallMerge']);
			}
				// line number style
			if ($conf['style.']['lineNumbers.']['normal'] && $conf['style.']['lineNumbers.']['fancy']) {
				$geshi->set_line_style($conf['style.']['lineNumbers.']['normal'], $conf['style.']['lineNumbers.']['fancy']);
			}
				// keyword group style
			if ($conf['style.']['keyword.']) {
				for ($i = 1; $i < 5; $i++) {
					if ($conf['style.']['keyword.']['set'.$i.'.']['value']) {
						$geshi->set_keyword_group_style($i, $conf['style.']['keyword.']['set'.$i.'.']['value'], (bool) $conf['style.']['keyword.']['set'.$i.'.']['merge']);
					}
				}
			}
				// comment style
			if ($conf['style.']['comment.']) {
				for ($i = 1; $i < 4; $i++) {
					if ($conf['style.']['comment.']['set'.$i.'.']['value']) {
						$geshi->set_comments_style($i, $conf['style.']['comment.']['set'.$i.'.']['value'], (bool) $conf['style.']['comment.']['set'.$i.'.']['merge']);
					}
				}
				if ($conf['style.']['comment.']['multiline.']['value']) {
					$geshi->set_comments_style('MULTI', $conf['style.']['comment.']['multiline.']['value'], (bool) $conf['style.']['comment.']['multiline.']['merge']);
				}
			}
				// other styles
			if ($conf['style.']['escape.']) {
				$geshi->set_escape_characters_style($conf['style.']['escape.']['value'], (bool) $conf['style.']['escape.']['merge']);
			}
			if ($conf['style.']['symbol.']) {
				$geshi->set_symbols_style($conf['style.']['symbol.']['value'], (bool) $conf['style.']['symbol.']['merge']);
			}
			if ($conf['style.']['string.']) {
				$geshi->set_strings_style($conf['style.']['string.']['value'], (bool) $conf['style.']['string.']['merge']);
			}
			if ($conf['style.']['number.']) {
				$geshi->set_numbers_style($conf['style.']['number.']['value'], (bool) $conf['style.']['number.']['merge']);
			}
			if ($conf['style.']['method.']) {
				for ($i = 1; $i < 11; $i++) {
					if ($conf['style.']['method.']['set'.$i.'.']['value']) {
						$geshi->set_methods_style($i, $conf['style.']['method.']['set'.$i.'.']['value'], (bool) $conf['style.']['method.']['set'.$i.'.']['merge']);
					}
				}
			}
			if ($conf['style.']['regexp.']) {
				for ($i = 1; $i < 11; $i++) {
					if ($conf['style.']['regexp.']['set'.$i.'.']['value']) {
						$geshi->set_regexps_style($i, $conf['style.']['regexp.']['set'.$i.'.']['value'], (bool) $conf['style.']['regexp.']['set'.$i.'.']['merge']);
					}
				}
			}
				// add css to the page
			if ($conf['useGeshiCSS']) {
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


	/**
	 * Fetch the default plugin configuration
	 *
	 * @return array  $result:  the configuration array
	 */
	public function getDefaultConfig() {
		return $GLOBALS['TSFE']->tmpl->setup['plugin.']['tx_syntaxhighlight_controller.'];
	}
	
}

if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/syntaxhighlight/api/class.syntaxhighlightAPI.php'])	{
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/syntaxhighlight/api/class.syntaxhighlightAPI.php']);
}
?>
