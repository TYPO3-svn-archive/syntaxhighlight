<?php
if (!defined ('TYPO3_MODE')) 	die ('Access denied.');

  ## Extending TypoScript from static template uid=43 to set up userdefined tag:
t3lib_extMgm::addTypoScript($_EXTKEY,'editorcfg','
	tt_content.CSS_editor.ch.tx_syntaxhighlight_controller = < plugin.tx_syntaxhighlight_controller.CSS_editor
',43);


t3lib_extMgm::addPItoST43($_EXTKEY,'controller/class.tx_syntaxhighlight_controller.php','_controller','list_type',0);

/**
 * Registering the Definition List plugin for htmlArea RTE (rtehtmlarea):
 */

$TYPO3_CONF_VARS['EXTCONF']['rtehtmlarea']['plugins']['Codebox'] = array();
$TYPO3_CONF_VARS['EXTCONF']['rtehtmlarea']['plugins']['Codebox']['objectReference'] = 'EXT:'.$_EXTKEY.'/Codebox/class.tx_rtehtmlarea_codebox.php:&tx_rtehtmlarea_codebox';

$_EXTCONF = unserialize($_EXTCONF);    // unserializing the configuration so we can use it here:

$TYPO3_CONF_VARS['EXTCONF']['rtehtmlarea']['plugins']['Codebox']['addIconsToSkin'] = $_EXTCONF['addIconsToSkin'] ? $_EXTCONF['addIconsToSkin'] : 1;
$TYPO3_CONF_VARS['EXTCONF']['rtehtmlarea']['plugins']['Codebox']['disableInFE'] =  $_EXTCONF['disableInFE'] ? $_EXTCONF['disableInFE'] : 0;

	// Additional RTE transformation configuration
t3lib_extMgm::addPageTSConfig('<INCLUDE_TYPOSCRIPT: source="FILE:EXT:' . $_EXTKEY . '/res/pageTSConfig.txt">');

	// register ajax call
$TYPO3_CONF_VARS['BE']['AJAX']['tx_syntaxhighlight_controller::highlightRTE'] = 'typo3conf/ext/sk_codebox/controller/class.tx_syntaxhighlight_controller.php:tx_syntaxhighlight_controller->highlightRTE';

?>
