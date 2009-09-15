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
 * @author  Steffen Kamper <steffen@dislabs.de>
 */

require_once(t3lib_extMgm::extPath('syntaxhighlight') . 'api/class.syntaxhighlightAPI.php');

class tx_syntaxhighlight_controller {
	var $prefixId = 'tx_syntaxhighlight_controller'; // Same as class name
	var $scriptRelPath = 'controller/class.tx_syntaxhighlight_controller.php'; // Path to this script relative to the extension dir.
	var $extKey = 'syntaxhighlight';  // The extension key.
	var $pi_checkCHash = true;        // Enable cHash check.
	var $lang;    // array with lang labels
	var $langKey; // holds the language key or 'default'
	
	/**
	 * Initialize
	 *
	 * @return  void
	 */
	function init($conf) {
		$this->conf = $conf;
		$this->languages = tx_syntaxhighlightAPI::getLanguages();
			// read LL-file
		$this->langKey = $GLOBALS['TSFE']->config['config']['language'] ? $GLOBALS['TSFE']->config['config']['language'] : 'default';
		$this->lang = t3lib_div::readLLfile(t3lib_extMgm::extPath($this->extKey) . 'language/controller.xml', $this->langKey, $GLOBALS['TSFE']->renderCharset);
		
		/*$this->piVars = t3lib_div::GParrayMerged($this->prefixId);
		if ($this->pi_checkCHash && count($this->piVars)) {
			$GLOBALS['TSFE']->reqCHash();
		}*/
	}


	/**
	 * Main entry point, called by TS
	 *
	 * @param  string  $content: any previous content
	 * @param  array   $conf:    TS configuration array
	 * @return string  $content: The previous content plus the highlighted text
	 */
	function main($content, $conf) {
		
		$this->init($conf);
		$config = $this->getFlexformConf();
		$content .= $this->doHighlight($config);
		
		return $content;
	}


	/**
	 * Highlight code
	 *
	 * @param   array  $config:  configuration and code
	 * @return  string $content: highlighted code
	 */
	function doHighlight($config) {

		if (in_array($config['language'], $this->languages)) {
			$config['template']  = str_replace('###ID###', 'cb' . $this->cObj->data['uid'], $config['template']);

			$get = t3lib_div::_GET('tx_syntaxhighlight_controller');
			if ($get['showTextSource']) {
				$sourceId = (int)$get['showTextSource'];
			}

			$configuration = array();
			$configuration['parameter'] = $GLOBALS['TSFE']->id;
			if ($sourceId === (int)$this->cObj->data['uid']) {
				$textArea = '<textarea name="clippyTextArea" rows="5" cols="40">'.$config['code'].'</textarea>';
				$config['template']  = str_replace('###TEXT_SOURCE_LINK###', $this->cObj->typolink($this->getLL('hideTextSource'), $configuration).$textArea, $config['template']);
			} else {
				if (TYPO3_MODE == 'FE') {
					$configuration['additionalParams'] = '&'.$this->prefixId.'[showTextSource]='.$this->cObj->data['uid'];
					$configuration['useCacheHash'] = true;
					$configuration['section'] = 'src_cb' . $this->cObj->data['uid'];
					$config['template'] = str_replace('###TEXT_SOURCE_LINK###', $this->cObj->typolink($this->getLL('showTextSource'), $configuration), $config['template']);
				}
			}

			$content = tx_syntaxhighlightAPI::highlight($config['code'], $config['language'], $config);
				// TODO . . . this is for the RTE from which we cannot call setJS. It 
				// complains: Fatal error: Call to a member function setJS() on a 
				// non-object
			if (TYPO3_MODE == 'FE') {
				$GLOBALS['TSFE']->setJS($this->extKey, '
				function tx_syntaxhighlightGetText(listId) {
					/*global document*/
					var t = \'\';
					var oUl = document.getElementById(\'text_\'+listId);
					try {
						for (var i in oUl.childNodes) {
							var x = oUl.childNodes[i];
							if (x.innerText !== undefined) {
								t += x.innerText;
							}
						}
					} catch (e) {
						for (var i in oUl.childNodes) {
							var x = oUl.childNodes[i];
							if (x.innerText !== \'undefined\') {
								t += x.innerText;
							}
						}
					}
					return t.toString();
				}
				function tx_syntaxhighlightCopyTextFlash(listId) {
					/*global document, tx_syntaxhighlightGetText*/
					var flashCopier = \'flashCopier_\'+listId;
					if(!document.getElementById(flashCopier)) {
						var divHolder = document.createElement(\'div\');
						divHolder.id  = flashCopier;
						document.body.appendChild(divHolder);
					}
					document.getElementById(flashCopier).innerHTML = \'\';
					var divInfo = \'<object type="application/x-shockwave-flash" width="0" height="0" data="/typo3conf/ext/syntaxhighlight/res/_clipboard.swf"> <param name="movie" value="/typo3conf/ext/syntaxhighlight/res/_clipboard.swf"/> <param name="FlashVars" value="clipboard=\'+encodeURIComponent(tx_syntaxhighlightGetText(listId))+\'"/> </object>\';
					document.getElementById(flashCopier).innerHTML = divInfo;
					document.getElementById(\'clippyText_\'+listId).style.display=\'none\';
					document.getElementById(\'clippyCopyLink_\'+listId).innerHTML = \''.$this->getLL('text_copied_to_clipboard').'\';
				}
				function tx_syntaxhighlightHasFlash() {
					/*global navigator, window, ActiveXObject*/
					var plugin = (navigator.mimeTypes && navigator.mimeTypes["application/x-shockwave-flash"]) ? navigator.mimeTypes["application/x-shockwave-flash"].enabledPlugin : 0;
					if (plugin !== 0) {
						var words = navigator.plugins["Shockwave Flash"].description.split(" ");
						for (var i = 0; i < words.length; ++i) {
							if (isNaN(parseInt(words[i], 10))) {
								continue;
							}
							var pluginVersion = words[i]; 
						}
						if (pluginVersion !== 0) {
							return true;
						}
					} else {
						if (window.ActiveXObject) {
							var control = null;
							try {
								control = new ActiveXObject(\'ShockwaveFlash.ShockwaveFlash\');
							} catch (e) {
								return false;
							}
							if (control !== null) {
								return true;
							}
						}
					}
				}
				function tx_syntaxhighlightCopyTextClipboardData(listId) {
					/*global document, tx_syntaxhighlightGetText*/
					document.getElementById(\'clippyText_\'+listId).style.display = \'block\';
					document.getElementById(\'clippyTextArea_\'+listId).value = tx_syntaxhighlightGetText(listId);
					var range = null;
					if (document.getElementById(\'clippyTextArea_\'+listId).createTextRange) {
						range = document.getElementById(\'clippyTextArea_\'+listId).createTextRange();
					} else if (document.getElementById(\'clippyTextArea_\'+listId).clipboardData) {
						range = document.getElementById(\'clippyTextArea_\'+listId).clipboardData();
					}
					if (range !== null) {
						range.execCommand(\'copy\');
						document.getElementById(\'clippyText_\'+listId).style.display=\'none\';
						document.getElementById(\'clippyCopyLink_\'+listId).innerHTML = \''.$this->getLL('text_copied_to_clipboard').'\';
						return true;
					}
					return false;
				}
				function tx_syntaxhighlightSelectText(listId) {
					/*global document, tx_syntaxhighlightCopyTextClipboardData, tx_syntaxhighlightCopyTextFlash, tx_syntaxhighlightGetText, tx_syntaxhighlightHasFlash */

						// Try the flash copy to clipboard first
					if (tx_syntaxhighlightHasFlash()) {
						tx_syntaxhighlightCopyTextFlash(listId);

						// Exploder and Opera can also do direct copy, but Exploder wants 
						// an affirmation, that is why we tried flash first
					} else if (tx_syntaxhighlightCopyTextClipboardData(listId)) {
						return;

						// Fallback to showing the textarea with the selected text
					} else {
						// Fallback to showing the textarea with the selected text
						document.getElementById(\'clippyText_\'+listId).style.display = \'block\';
						document.getElementById(\'clippyTextArea_\'+listId).value = tx_syntaxhighlightGetText(listId);
						document.getElementById(\'clippyTextArea_\'+listId).focus();
						document.getElementById(\'clippyTextArea_\'+listId).select();
					}
				}
				if(!document.all) {
					try {
						if((typeof HTMLElement !== undefined) && (HTMLElement.prototype.__defineGetter__ !== undefined)) {
							HTMLElement.prototype.__defineGetter__("innerText", function() {
								var r = this.ownerDocument.createRange();
								r.selectNodeContents(this);
								return r.toString();
								}
							);
						}
					}
					catch (e) {
						// exploder 5 does not get the undefined undefined ;-)
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
	 * @return  string $content: highlighted code
	 */
	function highlightRTE() {
		  // Initialize configuration
		$configuration['template']       = '<div class="tx-syntaxhighlight" id="' . uniqid('cb') . '"><div class="title">###TITLE###</div><div class="text">###TEXT###</div></div>';
		$configuration['code']           = t3lib_div::_GP('content');
		$configuration['label']          = t3lib_div::_GP('title');
		$configuration['language']       = t3lib_div::_GP('language');
		$configuration['lineNumbers']    = t3lib_div::_GP('lineNumbers');
		$configuration['alternateLines'] = t3lib_div::_GP('alternateLines');
		$configuration['startLine']      = t3lib_div::_GP('start');
		
		  // Sanitize input
		$configuration['code']           = strtr($configuration['code'], array('&quot;' => '"'));
		$configuration['language']       = preg_replace('/[^0-9a-z-]/', '', $configuration['language']);
		$configuration['label']          = $configuration['label'] ? $configuration['label'] : ucfirst($configuration['language']);
		$configuration['alternateLines'] = (int)$configuration['alternateLines'];
		$configuration['lineNumbers']    = (int)$configuration['lineNumbers'];
		$configuration['startLine']      = (int)$configuration['startLine'];

		if ($configuration['language']) {
			$beUserSession = array_unique(array_merge(array($configuration['language']), $GLOBALS['BE_USER']->uc['syntaxhighlighter_languages']));
			$GLOBALS['BE_USER']->uc['syntaxhighlighter_languages'] = $beUserSession;
			$GLOBALS['BE_USER']->writeUC();
		}
		
		$this->languages = tx_syntaxhighlightAPI::getLanguages();
		$content = $this->doHighlight($configuration);
		echo $content;
		exit;
	}
	
	/**
	 * Get configuration from the pi_flexform of the tt_content record
	 *
	 * @return  array  Configuration array
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

			// TODO We need nicer config merging . . . 
		if ($config['labelMode'] == 0) {
			unset($config['labelMode']);
		}
		return array_merge($this->conf, $config);
	}
	
	/**
	 * Get LL-label
	 *
	 * @param   string  $label:  name of label
	 * @return  string  label
	 */
	function getLL($label) {
		return $this->lang[$this->langKey][$label] ?  $this->lang[$this->langKey][$label] :  $this->lang['default'][$label];
	}
}

if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/syntaxhighlight/controller/class.tx_syntaxhighlight_controller.php']) {
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/syntaxhighlight/controller/class.tx_syntaxhighlight_controller.php']);
}
?>
