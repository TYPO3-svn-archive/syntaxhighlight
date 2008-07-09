<?php
if (!defined ('TYPO3_MODE')) die ('Access denied.');

	// add plugin
t3lib_extMgm::addPlugin(Array('LLL:EXT:syntaxhighlight/language/db.xml:tt_content.list_type_controller', $_EXTKEY.'_controller', t3lib_extMgm::extRelPath($_EXTKEY).'ext_icon.gif'), 'list_type');

	// remove fields
t3lib_div::loadTCA('tt_content');
$TCA['tt_content']['types']['list']['subtypes_excludelist'][$_EXTKEY.'_controller'] = 'layout,select_key,pages,recursive';

	// flexform
$TCA['tt_content']['types']['list']['subtypes_addlist'][$_EXTKEY.'_controller'] = 'pi_flexform';
t3lib_extMgm::addPiFlexFormValue($_EXTKEY.'_controller', 'FILE:EXT:'.$_EXTKEY.'/flexform/flexform_code.xml');

	// add static files
t3lib_extMgm::addStaticFile($_EXTKEY, 'controller/static/', 'Syntax Highlighter');
t3lib_extMgm::addStaticFile($_EXTKEY, 'controller/static/css/', 'Syntax Highlighter css');
	
	// add pageTSconfig
t3lib_extMgm::addPageTSConfig('<INCLUDE_TYPOSCRIPT: source="FILE:EXT:syntaxhighlight/res/pageTSconfig.txt">');

if (TYPO3_MODE=='BE') {
		// include API for flexform
	include_once(t3lib_extMgm::extPath($_EXTKEY).'api/class.syntaxhighlightAPI.php');   
}  
?>