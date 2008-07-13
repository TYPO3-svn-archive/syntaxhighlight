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


/**
 * Hooks for the 'syntaxhighlight' extension.
 *
 * @author	Steffen Kamper <info@sk-typo3.de>
 * @package	TYPO3
 * @subpackage	syntaxhighlight
 */
class tx_syntaxhighlightHooks {

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
	 * Function called from tcemain when saving CE
	 *
	 * @param  array   $incomingFieldArray:  field data
	 * @param  array   $table:  table
	 * @param  array   $id:  uid of record
	 * @param  array   $pObj:    parent object
	 * @return 
	 */
	function processDatamap_preProcessFieldArray(&$incomingFieldArray, $table, $id, $pObj)  {
		if($table == 'tt_content' && $incomingFieldArray['list_type'] == 'syntaxhighlight_controller') {

				// get language to save it to BE_USER-Session
			$language = $incomingFieldArray['pi_flexform']['data']['sDEF']['lDEF']['language']['vDEF'];
				// save language to usersession
			$beUserSession = array_unique(array_merge(array($language), (array) $GLOBALS['BE_USER']->uc['syntaxhighlighter_languages']));
			$GLOBALS['BE_USER']->uc['syntaxhighlighter_languages'] = $beUserSession;

				// get labelMode to save it to BE_USER-Session
			$labelMode = $incomingFieldArray['pi_flexform']['data']['sDEF']['lDEF']['labelMode']['vDEF'];
				// save labelMode to usersession
			$beUserSession = array($labelMode);
			$GLOBALS['BE_USER']->uc['syntaxhighlighter_labelMode'] = $beUserSession;

			$GLOBALS['BE_USER']->writeUC();
		}
	}
	
	
	/**
	 * Fetch the default plugin configuration
	 *
	 * @return array  $result:  the configuration array
	 */
	public function checkInclusion($params, &$pObj) {
		include_once(t3lib_extMgm::extPath('syntaxhighlight').'controller/class.tx_syntaxhighlight_controller.php');
	}
	
}

if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/syntaxhighlight/api/class.syntaxhighlightAPI.php'])	{
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/syntaxhighlight/api/class.syntaxhighlightAPI.php']);
}
?>
