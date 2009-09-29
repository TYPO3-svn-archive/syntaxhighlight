<?php
if (!defined ('TYPO3_MODE')) 	die ('Access denied.');

	// Registering the Definition List plugin for htmlArea RTE (rtehtmlarea):
#$TYPO3_CONF_VARS['EXTCONF']['rtehtmlarea']['plugins']['syntaxHighlight'] = array();
#$TYPO3_CONF_VARS['EXTCONF']['rtehtmlarea']['plugins']['syntaxHighlight']['objectReference'] = 'EXT:'.$_EXTKEY.'/plugin/rtehtmlarea/class.tx_rtehtmlarea_syntaxhighlight.php:&tx_rtehtmlarea_syntaxhighlight';

$extConf = unserialize($_EXTCONF);    // unserializing the configuration so we can use it here:
#$TYPO3_CONF_VARS['EXTCONF']['rtehtmlarea']['plugins']['syntaxHighlight']['addIconsToSkin'] = $extConf['addIconsToSkin'] ? $extConf['addIconsToSkin'] : 1;
#$TYPO3_CONF_VARS['EXTCONF']['rtehtmlarea']['plugins']['syntaxHighlight']['disableInFE'] =  $extConf['disableInFE'] ? $extConf['disableInFE'] : 0;

	// Hook for the page module used for preview of content
$TYPO3_CONF_VARS['SC_OPTIONS']['cms/layout/class.tx_cms_layout.php']['list_type_Info']['syntaxhighlight_controller'][] = 'EXT:syntaxhighlight/hooks/class.syntaxhighlightHooks.php:tx_syntaxhighlightHooks->getExtensionSummary';

	// Hook for the TV page module used for preview of content
$TYPO3_CONF_VARS['EXTCONF']['templavoila']['mod1']['renderPreviewContentClass'][] = 'EXT:syntaxhighlight/hooks/class.syntaxhighlightHooks.php:tx_syntaxhighlightHooks';

	// Hook for class inclusion check
$TYPO3_CONF_VARS['SC_OPTIONS']['tslib/class.tslib_fe.php']['isOutputting'][] = 'EXT:syntaxhighlight/hooks/class.syntaxhighlightHooks.php:tx_syntaxhighlightHooks->checkInclusion';

	// Hook in tcemain before saving data
$TYPO3_CONF_VARS['SC_OPTIONS']['t3lib/class.t3lib_tcemain.php']['processDatamapClass'][] = 'EXT:syntaxhighlight/hooks/class.syntaxhighlightHooks.php:tx_syntaxhighlightHooks';

	// Additional RTE transformation configuration
#t3lib_extMgm::addPageTSConfig('<INCLUDE_TYPOSCRIPT: source="FILE:EXT:' . $_EXTKEY . '/res/pageTSConfig.txt">');

	// register ajax call
#$TYPO3_CONF_VARS['BE']['AJAX']['tx_syntaxhighlight_controller::highlightRTE'] = 'typo3conf/ext/syntaxhighlight/controller/class.tx_syntaxhighlight_controller.php:tx_syntaxhighlight_controller->highlightRTE';
?>
