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
 * Plugin 'CodeBox' for the 'syntaxhighlight' extension.
 *
 * @author	Steffen Kamper <steffen@dislabs.de>
 */

if(!defined('PATH_tslib')) {
	//ajax call
	if (!defined('PATH_thisScript')) define('PATH_thisScript',str_replace('//','/', str_replace('\\','/', (php_sapi_name()=='cgi'||php_sapi_name()=='xcgi'||php_sapi_name()=='isapi' ||php_sapi_name()=='cgi-fcgi')&&((!empty($_SERVER['ORIG_PATH_TRANSLATED'])&&isset($_SERVER['ORIG_PATH_TRANSLATED']))?$_SERVER['ORIG_PATH_TRANSLATED']:$_SERVER['PATH_TRANSLATED'])? ((!empty($_SERVER['ORIG_PATH_TRANSLATED'])&&isset($_SERVER['ORIG_PATH_TRANSLATED']))?$_SERVER['ORIG_PATH_TRANSLATED']:$_SERVER['PATH_TRANSLATED']):((!empty($_SERVER['ORIG_SCRIPT_FILENAME'])&&isset($_SERVER['ORIG_SCRIPT_FILENAME']))?$_SERVER['ORIG_SCRIPT_FILENAME']:$_SERVER['SCRIPT_FILENAME']))));
	if (!defined('PATH_site')) define('PATH_site', dirname(dirname(dirname(dirname(dirname(dirname(dirname(PATH_thisScript))))))).'/');
	if (!defined('PATH_t3lib')) define('PATH_t3lib', PATH_site.'t3lib/');
	define('PATH_typo3conf', PATH_site.'typo3conf/');
	define('TYPO3_mainDir', 'typo3/');
	if (!defined('PATH_typo3')) define('PATH_typo3', PATH_site.TYPO3_mainDir);
	if (!defined('PATH_tslib')) {
		if (@is_dir(PATH_site.'typo3/sysext/cms/tslib/')) {
			define('PATH_tslib', PATH_site.'typo3/sysext/cms/tslib/');
		} elseif (@is_dir(PATH_site.'tslib/')) {
			define('PATH_tslib', PATH_site.'tslib/');
		}
	}
}

require_once(PATH_tslib.'class.tslib_pibase.php');
require_once(t3lib_extMgm::siteRelPath('geshilib') . 'res/geshi.php');
require_once(t3lib_extMgm::siteRelPath('syntaxhighlight') . 'class.flexfunctions.php');

class tx_syntaxhighlight_pi1 extends tslib_pibase {
	var $prefixId = 'tx_syntaxhighlight_pi1';		// Same as class name
	var $scriptRelPath = 'pi1/class.tx_syntaxhighlight_pi1.php';	// Path to this script relative to the extension dir.
	var $extKey = 'syntaxhighlight';	// The extension key.
	
	
	
	function init($conf) {
		$this->conf=$conf;
		$this->pi_setPiVarDefaults();
		$this->pi_loadLL();
		$this->pi_USER_INT_obj=1;	// Configuring so caching is not expected. This value means that no cHash params are ever set. We do this, because it's a USER_INT object!
		$this->languages = tx_flexfunctions::getLanguages();
		
	}
	
	function getFlexformConf() {
		// parse XML data into php array
		$this->pi_initPIflexForm(); 
		
		$config['label'] = $this->pi_getFFvalue($this->cObj->data['pi_flexform'], 'cLabel', 'sVIEW');
		$config['lang'] = $this->pi_getFFvalue($this->cObj->data['pi_flexform'], 'cLang', 'sVIEW');
		$config['code'] = $this->pi_getFFvalue($this->cObj->data['pi_flexform'], 'cCode', 'sVIEW');
		$config['numbers'] = $this->pi_getFFvalue($this->cObj->data['pi_flexform'], 'cNumbers', 'sVIEW');
		$config['width'] = $this->pi_getFFvalue($this->cObj->data['pi_flexform'], 'cWidth', 'sVIEW');
		$config['height'] = $this->pi_getFFvalue($this->cObj->data['pi_flexform'], 'cHeight', 'sVIEW');
		
		return array_merge($this->conf, $config);
	}
	/**
	 * [Put your description here]
	 */
	function main($content,$conf)	{
		
		$this->init($conf);
		$config = $this->getFlexformConf();
		
		
		
		//override Setup ?
		$width= ($config['width'])!='' ? $config['width'] : $conf['width'];
		$height= ($config['height'])!='' ? $config['height'] : $conf['height'];
		if($config['label']=='') $config['label']=$this->pi_getLL($config['lang']);
		
		//create css-inline
		$iewidth=$width-5; //fix for IE
		$config['inlineTitle']='width:'.$iewidth.'px !important;width /**/:'.$width.'px;';
		$config['inlineCode']='width:'.$width.'px;height:'.$height.'px;';
		
		//create preview
		$config['preview']='Language: '.$config['lang']."\n".htmlentities(substr($config['code'],0,120));
		$config['bodytext']=$this->cObj->data['bodytext'];
		if($config['bodytext']!=$config['preview']) {
			#copy the code to bodytext for preview in BE
			//$GLOBALS['TYPO3_DB']->debugOutput = true;
			#$res = $GLOBALS['TYPO3_DB']->exec_UPDATEquery('tt_content','uid='.$this->cObj->data['uid'],array('bodytext'=>$config['preview'])); 
		}
		
		$content = $this->doHighlight($config);
		
		
		return $this->pi_wrapInBaseClass($content);
	}
	
	
	function doHighlight($config) {
		t3lib_div::debug($config,'debug'); 
		if(in_array($config['lang'], $this->languages)) {
			$geshi = new GeSHi($config['code'], $config['lang'], '');

			if($config['numbers']) {
				$geshi->enable_line_numbers(GESHI_FANCY_LINE_NUMBERS,$config['alternateLines']);	
				$geshi->set_line_style('background: #fcfcfc;', 'background: #fdfdfd;');
			}

			$start_line = $config['startline'];
			if ($start_line == '' || !is_int(@intval($start_line))) $start_line = 1;
			$geshi->start_line_numbers_at($start_line);

			$geshi->set_link_target('_blank'); 
			$geshi->enable_classes(true);
			$GLOBALS['TSFE']->additionalCSS[] = $geshi->get_stylesheet(); 
#t3lib_div::debug($geshi,'debug'); 
			error_reporting(0);
			$completeCode = $geshi->parse_code(); 
				
		} else {
 			$completeCode='Language "' . $config['lang'] . '" not found';
		}
		
		$content = '<div class="CodeBox" id="'.uniqid('cb_').'">';	
		$content.='<div class="CodeBoxTitel"'.($config['inlineTitle'] ? ' style="'.$config['inlineTitle'] : '').'">'.$config['label'].'</div>';
		$content.='<div class="CodeBoxCode"'.($config['inlineCode'] ? ' style="'.$config['inlineCode'] : '').'">'.$completeCode.'</div></div>';
		return $content;
	}
	
		// ajax call from rte
	function highlightRTE() {
        $config['code'] = strtr(t3lib_div::_GP('content'),array(
        	'&quot;' => '"'
        ));
        
        $config['lang'] = t3lib_div::_GP('language');
		$config['numbers'] = t3lib_div::_GP('linenumbers');
        $config['label'] = t3lib_div::_GP('title') ? t3lib_div::_GP('title') : $config['lang'];
        $config['startline'] = t3lib_div::_GP('start');
		
		$content = $this->doHighlight($config);
		echo $content;
		exit;
	}
	
}



if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/syntaxhighlight/pi1/class.tx_syntaxhighlight_pi1.php'])	{
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/syntaxhighlight/pi1/class.tx_syntaxhighlight_pi1.php']);
}

?>