<?php
/***************************************************************
*  Copyright notice
*
*  (c) 2008 Stanislas Rolland <typo3(arobas)sjbr.ca>
*  All rights reserved
*
*  This script is part of the Typo3 project. The Typo3 project is
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
 * Definition List plugin for htmlArea RTE
 *
 * @author Stanislas Rolland <typo3(arobas)sjbr.ca>
 *
 * TYPO3 SVN ID: $Id: class.tx_rtehtmlarea_definitionlist.php  $
 *
 */

require_once(t3lib_extMgm::extPath('rtehtmlarea').'class.tx_rtehtmlareaapi.php');

class tx_rtehtmlarea_syntaxhighlight extends tx_rtehtmlareaapi {

	protected $extensionKey = 'syntaxhighlight';				// The key of the extension that is extending htmlArea RTE
	protected $pluginName = 'syntaxHighlight';				// The name of the plugin registered by the extension
	protected $relativePathToLocallangFile = 'plugin/rtehtmlarea/syntaxHighlight/locallang.xml';			// Path to this main locallang file of the extension relative to the extension dir.
	protected $relativePathToSkin = 'plugin/rtehtmlarea/syntaxHighlight/skin/htmlarea.css';	// Path to the skin (css) file relative to the extension dir.
	protected $relativePathToPluginDirectory = 'plugin/rtehtmlarea/syntaxHighlight/';	// Path to the directory containing the directory containing the plugin, relative to the extension dir
	protected $htmlAreaRTE;						// Reference to the invoking object
	protected $thisConfig;						// Reference to RTE PageTSConfig
	protected $toolbar;						// Reference to RTE toolbar array
	protected $LOCAL_LANG; 						// Frontend language array
	
	protected $pluginButtons = 'syntaxhighlight';
		
	protected $convertToolbarForHtmlAreaArray = array (
		'syntaxhighlight'	=> 'syntaxHighlight',
		);
	
	
	/**
	 * Return JS configuration of the htmlArea plugins registered by the extension
	 *
	 * @param	integer		Relative id of the RTE editing area in the form
	 *
	 * @return string		JS configuration for registered plugins
	 *
	 * The returned string will be a set of JS instructions defining the configuration that will be provided to the plugin(s)
	 * Each of the instructions should be of the form:
	 * 	RTEarea['.$RTEcounter.'].buttons.button-id.property = "value";
	 */
	public function buildJavascriptConfiguration($RTEcounter) {
		global $TSFE, $LANG;
		
		$registerRTEinJavascriptString = '';
		
		/*
		$button = 'syntaxhighlight';
		if (in_array($button, $this->toolbar)) {
			if (!is_array( $this->thisConfig['buttons.']) || !is_array( $this->thisConfig['buttons.'][$button.'.'])) {
					$registerRTEinJavascriptString .= '
			RTEarea['.$RTEcounter.'].buttons.'. $button .' = new Object();';
			}
			#$registerRTEinJavascriptString .= 'RTEarea['.$RTEcounter.'].buttons.'. $button .'.pathUserModule = "res/rte_syntaxhighlight.php";';
			
		}
		*/
		return $registerRTEinJavascriptString;
	}
	
	
} // end of class

if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/syntaxhighlight/plugin/htmlarea/syntaxHighlight/class.tx_rtehtmlarea_syntaxhighlight.php']) {
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/syntaxhighlight/plugin/htmlarea/syntaxHighlight/class.tx_rtehtmlarea_syntaxhighlight.php']);
}

?>
