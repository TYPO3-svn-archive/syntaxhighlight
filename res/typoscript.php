<?php
/*************************************************************************************
 * typoscript.php
 * --------
 * Author: Jan-Philipp Halle (typo3@jphalle.de)
 * Copyright: (c) 2005 Jan-Philipp Halle (http://www.jphalle.de/)
 * Release Version: 1.0.0.0
 * CVS Revision Version: $Revision: 0.0 $
 * Date Started: 2005/07/29
 * Last Modified: $Date: 2005/07/29 18:00:00 $
 *
 * TypoScript language file for GeSHi.
 *
 * CHANGES
 * -------
 * 2005/07/29 (1.0.0)
 *  -  First Release
 *
 * TODO (updated 2004/07/14)
 * -------------------------
 * <things-to-do>
 *
 *************************************************************************************
 *
 *     This file is part of GeSHi.
 *
 *   GeSHi is free software; you can redistribute it and/or modify
 *   it under the terms of the GNU General Public License as published by
 *   the Free Software Foundation; either version 2 of the License, or
 *   (at your option) any later version.
 *
 *   GeSHi is distributed in the hope that it will be useful,
 *   but WITHOUT ANY WARRANTY; without even the implied warranty of
 *   MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *   GNU General Public License for more details.
 *
 *   You should have received a copy of the GNU General Public License
 *   along with GeSHi; if not, write to the Free Software
 *   Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
 *
 ************************************************************************************/


$language_data = array (
	'LANG_NAME' => 'TypoScript',
	'COMMENT_SINGLE' => array(1  => '//', 2 => '####', 3 => '# *'),
	'COMMENT_MULTI' => array('/*' => '*/'),
	'CASE_KEYWORDS' => GESHI_CAPS_NO_CHANGE,
	'QUOTEMARKS' => array("", ""),
	'ESCAPE_CHAR' => '',
	'KEYWORDS' => array(
			// Conditions: http://support.typo3.org/documentation/tsref/conditions/
		1 => array(
			'browser',
			'compatVersion',
			'dayofmonth',
			'dayofweek',
			'device',
			'globalString',
			'globalVars',
			'hostname',
			'hour',
			'ip',
			'language',
			'loginuser',
			'minute',
			'month',
			'PIDinRootline',
			'PIDupinRootline',
			'system',
			'treelevel',
			'useragent',
			'userFunc',
			'usergroup',
			'version'
			),

			// Functions: http://support.typo3.org/documentation/tsref/functions/
		2 => array(
			'addParams',
			'encapsLines',
			'filelink',
			'HTMLparser',
			'HTMLparser_tags',
			'if',
			'imageLinkWrap',
			'imgResource',
			'makelinks',
			'numRows',
			'parseFunc',
			'select',
			'split',
			'stdWrap',
			'tableStyle',
			'tags',
			'textStyle',
			'typolink'
			),
	
			// Toplevel objects: http://support.typo3.org/documentation/tsref/tlo-objects/
		3 => array(
			'CARRAY',
			'CONFIG',
			'CONSTANTS',
			'FE_DATA',
			'FE_TABLE',
			'FRAME',
			'FRAMESET',
			'META',
			'PAGE',
			'plugin'
			),

	  	// Content Objects (cObject) : http://support.typo3.org/documentation/tsref/cobjects/
	  4 => array(
			'CASE',
			'CLEARGIF',
			'COA',
			'COA_INT',
			'COBJ_ARRAY',
			'COLUMNS',
			'CONTENT',
			'CTABLE',
			'EDITPANEL',
			'FILE',
			'FORM',
			'HMENU',
			'HRULER',
			'HTML',
			'IMAGE',
			'IMG_RESOURCE',
			'IMGTEXT',
			'LOAD_REGISTER',
			'MULTIMEDIA',
			'OTABLE',
			'PHP_SCRIPT',
			'PHP_SCRIPT_EXT',
			'PHP_SCRIPT_INT',
			'RECORDS',
			'RESTORE_REGISTER',
			'SEARCHRESULT',
			'TEMPLATE',
			'TEXT',
			'USER',
			'USER_INT'
			),
		
			// GIFBUILDER: http://support.typo3.org/documentation/tsref/gifbuilder/
		5 => array(
			'GIFBUILDER',
			),
		
			// GIFBUILDER: http://support.typo3.org/documentation/tsref/gifbuilder/
		6 => array(
			'ADJUST',
			'BOX',
			'CROP',
			'EFFECT',
			'EMBOSS',
			//'IMAGE',
			'IMGMAP',
			'OUTLINE',
			'SCALE',
			'SHADOW',
			//'TEXT',
			'WORKAREA'
			),
		
			// MENU Objects: http://support.typo3.org/documentation/tsref/menu/
		7 => array(
			'GMENU',
			'GMENU_FOLDOUT',
			'GMENU_LAYERS',
			'IMGMENU',
			'IMGMENUITEM',
			'JSMENU',
			'JSMENUITEM',
			'TMENU',
			'TMENUITEM',
			'TMENU_LAYERS'
			),

			// MENU common properties: http://support.typo3.org/documentation/tsref/menu/common-properties/
		8 => array(
			'JSWindow',
			'addParams',
			'alternativeSortingField',
			'begin',
			'debugItemConf',
			'imgNameNotRandom',
			'imgNamePrefix',
			'itemArrayProcFunc',
			'maxItems',
			'minItems',
			'overrideId',
			'sectionIndex',
			'showAccessRestrictedPages',
			'submenuObjSuffixes'
			),

			// MENU item states: http://support.typo3.org/documentation/tsref/menu/item-states/
		9 => array(
			'ACT',
			'ACTIFSUB',
			'ACTIFSUBRO',
			'ACTRO',
			'CUR',
			'CURIFSUB',
			'CURIFSUBRO',
			'CURRO',
			'IFSUB',
			'IFSUBRO',
			'NO',
			'SPC',
			'USERDEF1',
			'USERDEF1RO',
			'USERDEF2',
			'USERDEF2RO',
			'USR',
			'USRRO'
			),
	),
	
  /* Symbols apparently not used in GESHI 1.x: */		
	/*
	'SYMBOLS' => array(
		'(', ')', '[', ']', '{', '}', '!', '@', '%', '&', '\|\*\|','\|\|','\|','\*', '/',' < ',' > ' 
		),
		*/
	'CASE_SENSITIVE' => array(
		GESHI_COMMENTS => false,
		1 => true,
		2 => true,
		3 => true,
		4 => true,
		5 => true,
		),
	'STYLES' => array(
		'KEYWORDS' => array(
			1 => 'color: #b1b100;',
			2 => 'color: #000000; font-weight: bold;',
			3 => 'color: #000066;',
			
			10 => 'color: #900; font-weight:bold;',
			),
		'COMMENTS' => array(
			1 => 'color: #808080;',
			2 => 'color: #808080;',
			'MULTI' => 'color: #808080;'
			),
		'ESCAPE_CHAR' => array(
			0 => 'color: #000099; font-weight: bold;'
			),
		'BRACKETS' => array(
			0 => 'color: #66cc66;'
			),
		'STRINGS' => array(
			0 => 'color: #ff0000;'
			),
		'NUMBERS' => array(
			0 => 'color: #cc66cc;'
			),
		'METHODS' => array(
			1 => 'color: #006600;',
			2 => 'color: #006600;'
			),
		'SYMBOLS' => array(
			0 => 'color: #66cc66;'
			),
		'REGEXPS' => array(
			0 => 'color: #0000ff; font-weight: bold;'
			),
		'SCRIPT' => array(
			0 => '',
			1 => '',
			2 => '',
			3 => '',
			)
		),
	'URLS' => array(
		1 => 'http://support.typo3.org/documentation/tsref/conditions/{FNAME}/',
		2 => 'http://support.typo3.org/documentation/tsref/functions/{FNAME}/',
		3 => 'http://support.typo3.org/documentation/tsref/tlo-objects/{FNAME}/',
		4 => 'http://support.typo3.org/documentation/tsref/cobjects/{FNAME}/',
		5 => 'http://support.typo3.org/documentation/tsref/gifbuilder/',
		6 => 'http://support.typo3.org/documentation/tsref/gifbuilder/{FNAME}/',
		7 => 'http://support.typo3.org/documentation/tsref/menu/{FNAME}/',
		8 => 'http://support.typo3.org/documentation/tsref/menu/common-properties/',
		9 => 'http://support.typo3.org/documentation/tsref/menu/item-states/'
	),
	'OOLANG' => true,
	'OBJECT_SPLITTERS' => array(
		1 => ':',
	),
	'REGEXPS' => array(
		1 => array( // Works: matches any x/html tag
			GESHI_SEARCH => '(&lt;/?.+?&gt;)',
			GESHI_REPLACE => '\\1',
			GESHI_MODIFIERS => 'i',
			GESHI_BEFORE => '',
			GESHI_AFTER => ''
			),

		2 => array( // Works: matches any html entity:
			GESHI_SEARCH => '(&amp;\#*[0-9a-zA-Z]+?;)',
			GESHI_REPLACE => '\\1',
			GESHI_MODIFIERS => 's',
			GESHI_BEFORE => '',
			GESHI_AFTER => ''
		),
		
		3 => array( // Works: matches extension keys of the form tx_{something}_{something}. Should be styled same colour as kw1:
			GESHI_SEARCH => '(tx_[0-9A-Za-z]+?_[^\s=<>]+)',
			GESHI_REPLACE => '\\1',
			GESHI_MODIFIERS => 's',
			GESHI_BEFORE => '',
			GESHI_AFTER => ''
		),
		
		4 => array( // Matches markers:
			GESHI_SEARCH => '(\#\#\#.+?\#\#\#)',
			GESHI_REPLACE => '\\1',
			GESHI_MODIFIERS => 's',
			GESHI_BEFORE => '',
			GESHI_AFTER => ''
		),
		
			/*
		2 => array( // Works; matches (<|>), but needs modification not to match parts of html elements:
			GESHI_SEARCH => '(&lt;|&gt;)',
			GESHI_REPLACE => '\\1',
			GESHI_MODIFIERS => 'i',
			GESHI_BEFORE => '',
			GESHI_AFTER => ''
			),
			*/
		),
	'STRICT_MODE_APPLIES' => GESHI_MAYBE,
	'HIGHLIGHT_STRICT_BLOCK' => array(
		0 => true,
		1 => true,
		2 => true,
		3 => true
		)
);

?>
