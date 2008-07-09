<?php
if (!defined ('TYPO3_MODE')) 	die ('Access denied.');

	// Registering the Definition List plugin for htmlArea RTE (rtehtmlarea):
$TYPO3_CONF_VARS['EXTCONF']['rtehtmlarea']['plugins']['Codebox'] = array();
$TYPO3_CONF_VARS['EXTCONF']['rtehtmlarea']['plugins']['Codebox']['objectReference'] = 'EXT:'.$_EXTKEY.'/Codebox/class.tx_rtehtmlarea_codebox.php:&tx_rtehtmlarea_codebox';

$extConf = unserialize($_EXTCONF);    // unserializing the configuration so we can use it here:
$TYPO3_CONF_VARS['EXTCONF']['rtehtmlarea']['plugins']['Codebox']['addIconsToSkin'] = $extConf['addIconsToSkin'] ? $extConf['addIconsToSkin'] : 1;
$TYPO3_CONF_VARS['EXTCONF']['rtehtmlarea']['plugins']['Codebox']['disableInFE'] =  $extConf['disableInFE'] ? $extConf['disableInFE'] : 0;

	// Hook for the page module used for preview of content
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['cms/layout/class.tx_cms_layout.php']['list_type_Info']['syntaxhighlight_controller'][] = 'EXT:syntaxhighlight/api/class.syntaxhighlightAPI.php:tx_syntaxhighlightAPI->getExtensionSummary';

	// Hook for the TV page module used for preview of content
$TYPO3_CONF_VARS['EXTCONF']['templavoila']['mod1']['renderPreviewContentClass'][] = 'EXT:syntaxhighlight/api/class.syntaxhighlightAPI.php:tx_syntaxhighlightAPI';

	// Additional RTE transformation configuration
t3lib_extMgm::addPageTSConfig('<INCLUDE_TYPOSCRIPT: source="FILE:EXT:' . $_EXTKEY . '/res/pageTSConfig.txt">');

	// register ajax call
$TYPO3_CONF_VARS['BE']['AJAX']['tx_syntaxhighlight_controller::highlightRTE'] = 'typo3conf/ext/syntaxhighlight/controller/class.tx_syntaxhighlight_controller.php:tx_syntaxhighlight_controller->highlightRTE';
?>
