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
	 * @param	array		$params: flexform params
	 * @param	array		$conf: flexform conf
	 * @return	
	 */
	public function getFlexFormLanguages($params, $conf) {
		$languages = $this->getLanguages();
		$geshi = new GeSHi('bash', '');
		foreach($languages as $language) {
			$geshi->set_language($language);
	    $params['items'][$language][0] = $geshi->get_language_name();
	    $params['items'][$language][1] = $language;
		}
		return $languages;
	}

	public function getLanguages() {
		// read syntax files
		$array = t3lib_div::getFilesInDir(t3lib_extMgm::extPath('geshilib').'res/geshi/','php');
		foreach($array as $key => $val) {
			$languages[] = substr($val,0,-4);
		}
		return $languages;
	}
}
?>