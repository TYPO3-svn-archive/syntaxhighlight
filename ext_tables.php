<?php
if (!defined ('TYPO3_MODE')) 	die ('Access denied.');

t3lib_div::loadTCA('tt_content');
$TCA['tt_content']['types']['list']['subtypes_excludelist'][$_EXTKEY.'_pi1']='layout,select_key,pages,recursive';
#pi_flexform
$TCA['tt_content']['types']['list']['subtypes_addlist'][$_EXTKEY.'_pi1']='pi_flexform';
# Wir definieren die Datei, die unser Flexform Schema enthält
t3lib_extMgm::addPiFlexFormValue($_EXTKEY.'_pi1', 'FILE:EXT:'.$_EXTKEY.'/flexform/flexform_code.xml');

t3lib_extMgm::addPlugin(Array('LLL:EXT:syntaxhighlight/language/locallang_db.xml:tt_content.list_type_pi1', $_EXTKEY.'_pi1'),'list_type');

t3lib_extMgm::addStaticFile($_EXTKEY,"pi1/static/","CodeBox");

if (TYPO3_MODE=="BE")    {
    include_once(t3lib_extMgm::extPath($_EXTKEY).'api/class.syntaxhighlightAPI.php');   
}  

?>
