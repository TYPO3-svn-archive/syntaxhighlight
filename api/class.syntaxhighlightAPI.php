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
			if (substr($language, 0, 7) == '--div--') {
				$p = explode(';',$language);
				$params['items'][$language][0] = $p[1];
				$params['items'][$language][1] = $p[0];
			} else {
						// use geshi for the language name			
					$geshi->set_language($language);

						// Workaround for Geshi bug
						// http://sourceforge.net/tracker/index.php?func=detail&aid=2014123&group_id=114997&atid=670231
					if (preg_match('/.*-brief/', $language)) {
						$params['items'][$language][0] = $geshi->get_language_name() . ' brief';
					} else {
						$params['items'][$language][0] = $geshi->get_language_name();
					}
					$params['items'][$language][1] = $language;
			}
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
		$tempFile = PATH_site.'typo3temp/geshi_language_file.tmp';
		if (file_exists($tempFile)) {
			$array = unserialize(file_get_contents($tempFile));
		} else {
			$array = t3lib_div::getFilesInDir(t3lib_extMgm::extPath('geshilib') . 'res/geshi/', 'php');
			file_put_contents($tempFile, serialize($array));
		}
		
		if (TYPO3_MODE=='BE') {
			$usedLanguages = (array) $GLOBALS['BE_USER']->uc['syntaxhighlighter_languages'];
		} else {
			$usedLanguages = array();
		}
		if(count($usedLanguages) > 0) {
			$usedLanguages = array_merge(array('--div--;lastused'), $usedLanguages, array('--div--;general'));
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

			// only set link target if present
		if ($conf['linkTarget'] != '') {
			$geshi->set_link_target($conf['linkTarget']);
		}

		if (TYPO3_MODE == 'FE') {
				// overall style
			$geshi->enable_classes(true);

			if ($conf['style.'][$language.'.']['overall']) {
				$geshi->set_overall_style($conf['style.'][$language.'.']['overall'], (bool) $conf['style.'][$language.'.']['overallMerge']);
			}
				// line number style
			if ($conf['style.'][$language.'.']['lineNumbers.']['normal'] && $conf['style.'][$language.'.']['lineNumbers.']['fancy']) {
				$geshi->set_line_style($conf['style.'][$language.'.']['lineNumbers.']['normal'], $conf['style.'][$language.'.']['lineNumbers.']['fancy']);
			}
				// keyword group style
			if ($conf['style.'][$language.'.']['keyword.']) {
				for ($i = 0; $i < 10; $i++) {
					if ($conf['style.'][$language.'.']['keyword.']['set'.$i.'.']['value']) {
						$geshi->set_keyword_group_style($i, $conf['style.'][$language.'.']['keyword.']['set'.$i.'.']['value'], (bool) $conf['style.'][$language.'.']['keyword.']['set'.$i.'.']['merge']);
					}
				}
			}
				// comment style
			if ($conf['style.'][$language.'.']['comment.']) {
				for ($i = 0; $i < 4; $i++) {
					if ($conf['style.'][$language.'.']['comment.']['set'.$i.'.']['value']) {
						$geshi->set_comments_style($i, $conf['style.'][$language.'.']['comment.']['set'.$i.'.']['value'], (bool) $conf['style.'][$language.'.']['comment.']['set'.$i.'.']['merge']);
					}
				}
				if ($conf['style.'][$language.'.']['comment.']['multiline.']['value']) {
					$geshi->set_comments_style('MULTI', $conf['style.'][$language.'.']['comment.']['multiline.']['value'], (bool) $conf['style.'][$language.'.']['comment.']['multiline.']['merge']);
				}
			}
				// other styles
			if ($conf['style.'][$language.'.']['escape.']) {
				$geshi->set_escape_characters_style($conf['style.'][$language.'.']['escape.']['value'], (bool) $conf['style.'][$language.'.']['escape.']['merge']);
			}
			$geshi->set_brackets_highlighting(false);
			if ($conf['style.'][$language.'.']['symbol.']) {
				for ($i = 0; $i < 5; $i++) {
					if ($conf['style.'][$language.'.']['symbol.']['set'.$i.'.']['value']) {
						$geshi->set_symbols_style($conf['style.'][$language.'.']['symbol.']['set'.$i.'.']['value'], (bool) $conf['style.'][$language.'.']['symbol.']['set'.$i.'.']['merge'], $i);
					}
				}
			}
			if ($conf['style.'][$language.'.']['string.']) {
				$geshi->set_strings_style($conf['style.'][$language.'.']['string.']['value'], (bool) $conf['style.'][$language.'.']['string.']['merge']);
			}
			if ($conf['style.'][$language.'.']['number.']) {
				$geshi->set_numbers_style($conf['style.'][$language.'.']['number.']['value'], (bool) $conf['style.'][$language.'.']['number.']['merge']);
			}
			if ($conf['style.'][$language.'.']['method.']) {
				for ($i = 0; $i < 2; $i++) {
					if ($conf['style.'][$language.'.']['method.']['set'.$i.'.']['value']) {
						$geshi->set_methods_style($i, $conf['style.'][$language.'.']['method.']['set'.$i.'.']['value'], (bool) $conf['style.'][$language.'.']['method.']['set'.$i.'.']['merge']);
					}
				}
			}
			if ($conf['style.'][$language.'.']['regexp.']) {
				for ($i = 0; $i < 10; $i++) {
					if ($conf['style.'][$language.'.']['regexp.']['set'.$i.'.']['value']) {
						$geshi->set_regexps_style($i, $conf['style.'][$language.'.']['regexp.']['set'.$i.'.']['value'], (bool) $conf['style.'][$language.'.']['regexp.']['set'.$i.'.']['merge']);
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
				<p style="background-color:#eee;margin-bottom:4px;">Language: ###TITLE###</p>
				###TEXT### </div>';
		}
		
		$style = '';
		switch ($conf['labelmode']) {
			case 0:
				$title = $language;
				break;
			case 1:
				$title = $conf['label'];
				break;
			case 2:
				$title = '';
				$style = ' style="display:none;"';
		}
		
		$result = strtr($conf['template'], array(
			'###TITLESTYLE###' => $style,
			'###TITLE###' => $title,
			'###TEXT###'  => $content
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
