<?php
/***************************************************************
*  Copyright notice
*
*  (c) 2004 Michiel Roos (typo3@meyson.nl)
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
 * Class that adds the wizard icon.
 *
 * @author  Michiel Roos <typo3@meyson.nl>
 */
class tx_syntaxhighlight_controller_wizicon {
	function proc($wizardItems) {
		global $LANG;
		$LL = $this->includeLocalLang();

		$wizardItems['plugins_tx_syntaxhighlight_controller'] = array(
			'icon' => t3lib_extMgm::extRelPath('syntaxhighlight').'icon/ce_wiz.gif',
			'title' => $LANG->getLLL('title', $LL),
			'description' => $LANG->getLLL('description', $LL),
			'params' => '&defVals[tt_content][CType]=list&defVals[tt_content][list_type]=syntaxhighlight_controller'
		);

		return $wizardItems;
	}

	function includeLocalLang() {
		$llFile = t3lib_extMgm::extPath('syntaxhighlight').'language/db.xml';
		return t3lib_div::readLLXMLfile($llFile, $GLOBALS['LANG']->lang);
	}
}

if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/syntaxhighlight/controller/class.tx_syntaxhighlight_controller_wizicon.php']) {
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/syntaxhighlight/controller/class.tx_syntaxhighlight_controller_wizicon.php']);
}
?>
