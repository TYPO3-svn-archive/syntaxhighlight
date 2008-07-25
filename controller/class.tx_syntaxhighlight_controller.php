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

require_once(t3lib_extMgm::extPath('syntaxhighlight') . 'api/class.syntaxhighlightAPI.php');

class tx_syntaxhighlight_controller {
	var $prefixId = 'tx_syntaxhighlight_controller';	// Same as class name
	var $scriptRelPath = 'controller/class.tx_syntaxhighlight_controller.php';	// Path to this script relative to the extension dir.
	var $extKey = 'syntaxhighlight';	// The extension key.
	var $lang;	// array with lang labels
	var $langKey;	// holds the language key or 'default'
	
	/**
	 * Initialize
	 *
	 * @return	void
	 */
	function init($conf) {
		$this->conf = $conf;
		$this->languages = tx_syntaxhighlightAPI::getLanguages();
			// read LL-file
		$this->langKey = $GLOBALS['TSFE']->config['config']['language'] ? $GLOBALS['TSFE']->config['config']['language'] : 'default';
		$this->lang = t3lib_div::readLLfile(t3lib_extMgm::extPath($this->extKey) . 'language/controller.xml', $this->langKey, $GLOBALS['TSFE']->renderCharset);
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
			$config['template']  = str_replace('###ID###', 'cb' . $this->cObj->data['uid'], $config['template']);
			$content = tx_syntaxhighlightAPI::highlight($config['code'], $config['language'], $config);
				// TODO . . . this is for the RTE from which we cannot call setJS. It 
				// complains: Fatal error: Call to a member function setJS() on a 
				// non-object
			if (TYPO3_MODE == 'FE') {
				$GLOBALS['TSFE']->setJS($this->extKey, '
				function tx_syntaxhighlightSelectText(listId) {
					var t = \'\';
					var oUl = document.getElementById(\'text_\'+listId);
					for (var i in oUl.childNodes){
						var x = oUl.childNodes[i];
						if (x.innerText !== undefined){
							t = t + "\n" + x.innerText;
						}
					}
						
					if (document.getElementById(\'clippyText_\'+listId).style.display == \'none\') {
						//document.getElementById(\'clippyText_\'+listId).style.display = \'block\';
						document.getElementById(\'clippyTextArea_\'+listId).value = t.toString();
						document.getElementById(\'clippyTextArea_\'+listId).focus();
						//document.getElementById(\'clippyTextArea_\'+listId).select();
						if (document.getElementById(\'clippyTextArea_\'+listId).createTextRange) {
							var range = document.getElementById(\'clippyTextArea_\'+listId).createTextRange();
							if (range && bodyloaded==1)
								range.execcommand(\'copy\');
						document.getElementById(\'clippyTextArea_\'+listId).value = t.toString();
						} else {
							var flashcopier = \'flashcopier\';
							if(!document.getElementById(flashcopier)) {
								var divholder = document.createElement(\'div\');
								divholder.id = flashcopier;
								document.body.appendChild(divholder);
							}
							document.getElementById(flashcopier).innerHTML = \'\';
							var divinfo = \'<embed src="/typo3conf/ext/syntaxhighlight/res/_clipboard.swf" FlashVars="clipboard=\'+encodeURIComponent(document.getElementById(\'clippyTextArea_\'+listId).value)+\'" width="0" height="0" type="application/x-shockwave-flash"></embed>\';
							document.getElementById(flashcopier).innerHTML = divinfo;
						}
					}
					else{
						document.getElementById(\'clippyText_\'+listId).style.display=\'none\';
					}
				}
				if(!document.all) {
					if((typeof HTMLElement !== undefined) && (HTMLElement.prototype.__defineGetter__ !== undefined)) {
						HTMLElement.prototype.__defineGetter__("innerText", function() {
							var r = this.ownerDocument.createRange();
							r.selectNodeContents(this);
							return r.toString();
							}
						);
					}
				}
				');
			}
		} else {
 			$content = sprintf($this->getLL('language_not_found'), $config['language']);
		}
		
		return $content;
	}


	/**
	 * AJAX call from the RTE
	 *
	 * @return	string $content: highlighted code
	 */
	function highlightRTE() {
		$config['template']    = '<div class="tx-syntaxhighlight" id="' . uniqid('cb') . '"><div class="title">###TITLE###</div><div class="text">###TEXT###</div></div>';
		$config['code']        = strtr(t3lib_div::_GP('content'), array('&quot;' => '"'));
		$config['label']       = t3lib_div::_GP('title') ? t3lib_div::_GP('title') : $config['language'];
		$config['language']    = t3lib_div::_GP('language');
		$config['lineNumbers'] = t3lib_div::_GP('lineNumbers');
		$config['startLine']   = t3lib_div::_GP('start');
		
		if ($config['language']) {
			$beUserSession = array_unique(array_merge(array($config['language']), $GLOBALS['BE_USER']->uc['syntaxhighlighter_languages']));
			$GLOBALS['BE_USER']->uc['syntaxhighlighter_languages'] = $beUserSession;
			$GLOBALS['BE_USER']->writeUC();
		}
		
		$this->languages = tx_syntaxhighlightAPI::getLanguages();
		$content = $this->doHighlight($config);
		echo $content;
		exit;
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
		$config['labelMode']      = $data['data']['sDEF']['lDEF']['labelMode']['vDEF'];
		$config['language']       = $data['data']['sDEF']['lDEF']['language']['vDEF'];
		$config['lineNumbers']    = $data['data']['sDEF']['lDEF']['lineNumbers']['vDEF'];
		$config['startLine']      = $data['data']['sDEF']['lDEF']['startLine']['vDEF'];
		$config['width']          = $data['data']['sDEF']['lDEF']['width']['vDEF'];

			// We need nicer config merging . . . 
		if ($config['labelMode'] == 0) {
			unset($config['labelMode']);
		}
		return array_merge($this->conf, $config);
	}
	
	/**
	 * Get LL-label
	 *
	 * @param   string  $label:  name of label
	 * @return	string		label
	 */
	function getLL($label) {
		return $this->lang[$this->langKey][$label] ?  $this->lang[$this->langKey][$label] :  $this->lang['default'][$label];
	}
}

if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/syntaxhighlight/controller/class.tx_syntaxhighlight_controller.php'])	{
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/syntaxhighlight/controller/class.tx_syntaxhighlight_controller.php']);
}
?>
