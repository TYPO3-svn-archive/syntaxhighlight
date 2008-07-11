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
 * - First Release
 *
 * 2008/07/11 (2.0.0)
 * - Michiel Roos <geshi@typofree.org> Complete rewrite
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
	'COMMENT_SINGLE' => array(1  => '//', 2 => '#', 3 => '####', 4 => '# *'),
	'COMMENT_MULTI' => array('/*' => '*/'),
	'CASE_KEYWORDS' => GESHI_CAPS_NO_CHANGE,
	'QUOTEMARKS' => array(''),
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
		
			// GIFBUILDER toplevel link: http://support.typo3.org/documentation/tsref/gifbuilder/
		5 => array(
			'GIFBUILDER',
			),
		
			// GIFBUILDER: http://support.typo3.org/documentation/tsref/gifbuilder/
			// NOTE! the IMAGE and TEXT field already are linked in group 4, they 
			// cannot be linked twice . . . . unfortunately
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
	
	'SYMBOLS' => array(
		'|',
		'(', ')', '[', ']', '{', '}',
		'+', '*', '/', '%',
		'!', '&', '^',
		'<', '>', '=',
		'?', ':', ';',
		'.'
		),
	'CASE_SENSITIVE' => array(
		GESHI_COMMENTS => true,
		1 => true,
		2 => true,
		3 => true,
		4 => true,
		5 => true,
		),
	'STYLES' => array(
		'KEYWORDS' => array(
			1 => 'color: #00e000;',
			2 => 'color: #ffffff;',
			3 => 'color: #ffbb00;',
			4 => 'color: #ffbb00;',
			5 => 'color: #ffbb00;',
			6 => 'color: #ffbb00;',
			7 => 'color: #ffbb00;',
			8 => 'color: #ffffff;',
			9 => 'color: #ffbb00;',
			),
		'COMMENTS' => array(
			1 => 'color: #ccc;',
			2 => 'color: #ccc;',
			3 => 'color: #ccc;',
			'MULTI' => 'color: #ccc;'
			),
		'BRACKETS' => array(
			0 => 'color: #e00000;'
			),
		'STRINGS' => array(
			0 => 'color: #ac14aa;'
			),
		'NUMBERS' => array(
			0 => 'color: #ac14aa;'
			),
		'METHODS' => array(
			1 => 'color: #0000e0;',
			2 => 'color: #0000e0;'
			),
		'SYMBOLS' => array(
			0 => 'color: #e0e000;',
			),
		'REGEXPS' => array(
			0 => 'color: #00e0e0;',
			1 => 'color: #e0e000;',
			2 => 'color: #a2a2ff;',
			3 => 'color: #00e0e0;',
			4 => 'color: #0000e0;',
			6 => 'color: #00e000;',
			7 => 'color: #e00000;',
			8 => 'color: #0000e0;'
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
	'OOLANG' => false,
	'OBJECT_SPLITTERS' => array(
	),
	'REGEXPS' => array(
			// Constant
		0 => array(
			GESHI_SEARCH => '(\{)(\$[a-zA-Z_\.]+[a-zA-Z0-9_\.]*)(\})',
			GESHI_REPLACE => '\\2',
			GESHI_MODIFIERS => '',
			GESHI_BEFORE => '\\1',
			GESHI_AFTER => '\\3'
			),

			// Constant dollar sign
		1 => array(
			// GESHI_SEARCH => '(\{)(\$)([a-zA-Z_\.]+[a-zA-Z0-9_\.]*)(\})',
			// Should be extended to also match stuff like: {$lib.shadowIntensity}
			GESHI_SEARCH => '(\$)([a-zA-Z_\.]+[a-zA-Z0-9_\.]*)',
			GESHI_REPLACE => '\\1',
			GESHI_MODIFIERS => '',
			GESHI_BEFORE => '',
			GESHI_AFTER => '\\2'
			),

			// xhtml tag
		2 => array(
			GESHI_SEARCH => '(&lt;.+?&gt;)',
			GESHI_REPLACE => '\\1',
			GESHI_MODIFIERS => '',
			GESHI_BEFORE => '',
			GESHI_AFTER => ''
			),

			// HTML entity
		3 => array(
			GESHI_SEARCH => '(&amp;\#*[0-9a-zA-Z]+?;)',
			GESHI_REPLACE => '\\1',
			GESHI_MODIFIERS => 's',
			GESHI_BEFORE => '',
			GESHI_AFTER => ''
			),
		
			// extension key: tx_{something}_{something}
		4 => array(
			GESHI_SEARCH => '(tx_[0-9A-Za-z]+?_[^\s=<>]+)',
			GESHI_REPLACE => '\\1',
			GESHI_MODIFIERS => 's',
			GESHI_BEFORE => '',
			GESHI_AFTER => ''
			),
		
			// markers
		5 => array(
			GESHI_SEARCH => '(\#\#\#.+?\#\#\#)',
			GESHI_REPLACE => '\\1',
			GESHI_MODIFIERS => 's',
			GESHI_BEFORE => '',
			GESHI_AFTER => ''
			),

			// conditions and controls
		6 => array(
			GESHI_SEARCH => '(\[)(globalVar|global|end)',
			GESHI_REPLACE => '\\2',
			GESHI_MODIFIERS => 's',
			GESHI_BEFORE => '\\1',
			GESHI_AFTER => ''
			),

			// HEX color codes
		7 => array(
			GESHI_SEARCH => '(\#([0-9abcdefABCDEF]{6}|[0-9abcdefABCDEF]{3}))',
			GESHI_REPLACE => '\\1',
			GESHI_MODIFIERS => '',
			GESHI_BEFORE => '',
			GESHI_AFTER => ''
			),
		
			// lowlevel setup and constant objects
		8 => array(
			GESHI_SEARCH => '([^\.]\b)(config|content|file|frameset|includeLibs|lib|page|plugin|resources|sitemap|sitetitle|styles|tt_content|tt_news|types|xmlnews)',
			GESHI_REPLACE => '\\2',
			GESHI_MODIFIERS => '',
			GESHI_BEFORE => '\\1',
			GESHI_AFTER => ''
			),

		),
	'STRICT_MODE_APPLIES' => GESHI_NEVER,
);

?>
