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
	  /* stdWrap in general, plus properties of functions, cObjects etc: */
		1 => array(
			'_offset',
			'_LOCAL_LANG',
			'_DEFAULT_PI_VARS',
			'_CSS_DEFAULT_STYLE',
			'yPosOffset',
			'XY',
			'xPosOffset',
			'xmlprologue',
			'xhtml_cleaning',
			'xhtmlDoctype',
			'wraps',
			'wrapNonWrappedLines',
			'wrapFieldName',
			'wrapAlign',
			'wrapAfterTags',
			'wrap3',
			'wrap2',
			'wrap',
			'workOnSubpart',
			'workArea',
			'wordSpacing',
			'width',
			'where',
			'wave',
			'w',
			'valueArray',
			'value',
			'USRRO',
			'USR',
			'USERNAME_substToken',
			'USERID_substToken',
			'userIdColumn',
			'userfunction',
			'userFunc',
			'userdefined',
			'USERDEF2RO',
			'USERDEF2',
			'USERDEF1RO',
			'USERDEF1',
			'useLargestItemY',
			'useLargestItemX',
			'useCacheHash',
			'url',
			'upper',
			'updated',
			'unset',
			'uniqueLinkVars',
			'uidInList',
			'uid',
			'typolinkLinkAccessRestrictedPages_addParams',
			'typolinkLinkAccessRestrictedPages',
			'typolinkCheckRootline',
			'typolink',
			'types',
			'typeNum',
			'type',
			'trim',
			'transparentColor',
			'transparentBackground',
			'totalWidth',
			'topOffset',
			'token',
			'tm',
			'titleText',
			'titleTagFunction',
			'title',
			'tile',
			'thisUrl',
			'thickness',
			'textStyle',
			'textPos',
			'textObjNum',
			'textMaxLength',
			'textMargin_outOfText',
			'textMargin',
			'text',
			'template',
			'TDparams',
			'target',
			'tags',
			'tableWidth',
			'tableStyle',
			'tableStdWrap',
			'tables',
			'tableParams',
			'table',
			'sys_language_uid',
			'sys_language_softMergeIfNotBlank',
			'sys_language_overlay',
			'sys_language_mode',
			'sword_standalone',
			'sword_noMixedCase',
			'sword',
			'swirl',
			'subst_elementUid',
			'substring',
			'substMarksSeparately',
			'subparts',
			'subMenuOffset',
			'submenuObjSuffixes',
			'stylesheet',
			'stripHTML',
			'strftime',
			'stdWrap2',
			'stdWrap',
			'stayFolder',
			'stat_typeNumList',
			'stat_titleLen',
			'stat_mysql',
			'stat_excludeIPList',
			'stat_apache_pagenames',
			'stat_apache_notExtended',
			'stat_apache_noRoot',
			'stat_apache_noHost',
			'stat_apache_niceTitle',
			'stat_apache_logfile',
			'stat_apache',
			'stat',
			'src',
			'split',
			'specialEval',
			'special',
			'SPC',
			'spamProtectEmailAddresses_lastDotSubst',
			'spamProtectEmailAddresses',
			'spamProtectEmaiAddresses_atSubst',
			'spacing',
			'spaceRight',
			'spaceLeft',
			'spaceBelowAbove',
			'spaceBefore',
			'spaceAfter',
			'space',
			'source',
			'solarize',
			'smallFormFields',
			'slide',
			'size',
			'sitetitle',
			'simulateStaticDocuments_replacementChar',
			'simulateStaticDocuments_pEnc_onlyP',
			'simulateStaticDocuments_pEnc',
			'simulateStaticDocuments_noTypeIfNoTitle',
			'simulateStaticDocuments_dontRedirectPathInfoError',
			'simulateStaticDocuments_addTitle',
			'simulateStaticDocuments',
			'showFirst',
			'showActive',
			'shortcutIcon',
			'short',
			'shear',
			'sharpen',
			'shadow',
			'setJS_openPic',
			'setJS_mouseOver',
			'setFixedWidth',
			'setFixedHeight',
			'setCurrent',
			'setContentToCurrent',
			'set',
			'separator',
			'sendCacheHeaders_onlyWhenLoginDeniedInBranch',
			'sendCacheHeaders',
			'selectFields',
			'selected',
			'select',
			'sectionIndex',
			'section',
			'sample',
			'RO_chBgColor',
			'rowSpace',
			'rows',
			'rotate',
			'rootline',
			'RO',
			'rmTagIfNoAttrib',
			'rm',
			'rightjoin',
			'returnLast',
			'returnKey',
			'resultObj',
			'resources',
			'required',
			'REQ',
			'renderWrap',
			'renderObj',
			'renderCharset',
			'removeWrapping',
			'removeTags',
			'removePrependedNumbers',
			'removeObjectsOfDummy',
			'removeIfFalse',
			'removeIfEquals',
			'removeDefaultJS',
			'removeBadHTML',
			'remapTag',
			'remap',
			'relPathPrefix',
			'relativeToTriggerItem',
			'relativeToParentLayer',
			'reduceColors',
			'redirect',
			'recipient',
			'rawUrlEncode',
			'range',
			'radioWrap',
			'RADIO',
			'quality',
			'protectLVar',
			'protect',
			'properties',
			'processScript',
			'prioriCalc',
			'previewBorder',
			'prev',
			'preUserFunc',
			'prepend',
			'preIfEmptyListNum',
			'prefixRelPathWith',
			'prefixLocalAnchors',
			'prefixComment',
			'preCObject',
			'postUserFuncInt',
			'postUserFunc',
			'postCObject',
			'plainTextStdWrap',
			'pidInList',
			'path',
			'parseFunc',
			'params',
			'parameter',
			'pageTitleFirst',
			'pageGenScript',
			'page',
			'overrideId',
			'overrideEdit',
			'overrideAttribs',
			'override',
			'outputLevels',
			'outline',
			'outerWrap',
			'orderBy',
			'options',
			'opacity',
			'onlyCurrentPid',
			'offsetWrap',
			'offset',
			'obj',
			'numRows',
			'no_cache',
			'noWrapAttr',
			'noValueInsert',
			'noTrimWrap',
			'notification_email_urlmode',
			'notification_email_encoding',
			'notification_email_charset',
			'noStretchAndMarginCells',
			'noScaleUp',
			'noRows',
			'noResultObj',
			'noPageTitle',
			'noOrderBy',
			'nonWrappedTag',
			'nonTypoTagUserFunc',
			'nonTypoTagStdWrap',
			'nonCachedSubst',
			'noLinkUnderline',
			'noLink',
			'noLInk',
			'noCols',
			'noBlur',
			'noAttrib',
			'NO',
			'niceText',
			'next',
			'newWindow',
			'newRecordFromTable',
			'netprintApplicationLink',
			'nesting',
			'negate',
			'name',
			'MP_mapRootPoints',
			'MP_disableTypolinkClosestMPValue',
			'MP_defaults',
			'minW',
			'minItems',
			'minH',
			'min',
			'method',
			'metaCharset',
			'message_preview_workspace',
			'message_preview',
			'message_page_is_being_generated',
			'menuWidth',
			'menuOffset',
			'menuName',
			'menuHeight',
			'menuBackColor',
			'meaningfulTempFilePrefix',
			'maxWinText',
			'maxWidth',
			'maxW',
			'maxItems',
			'maxHeight',
			'maxH',
			'max',
			'mask',
			'marks',
			'markerWrap',
			'makelinks',
			'mainScript',
			'main',
			'mailto',
			'm',
			'lower',
			'lowColor',
			'longdescURL',
			'lockPosition_adjust',
			'lockPosition_addSelf',
			'lockPosition',
			'lockFilePath',
			'locationData',
			'localNesting',
			'locale_all',
			'lneThickness',
			'lm',
			'listNum',
			'list',
			'linkWrap',
			'linkVars',
			'linkOnlyPixelsAbove',
			'lineColor',
			'line',
			'levels',
			'leftOffset',
			'leftjoin',
			'layout',
			'layer_menu_id',
			'layerStyle',
			'language_alt',
			'languageField',
			'language',
			'lang',
			'labelWrap',
			'labelStdWrap',
			'label',
			'LABEL',
			'keywords',
			'key',
			'keepNonMatchedTags',
			'keep',
			'jumpurl_mailto_disable',
			'jumpurl_enable',
			'jumpurl',
			'JSwindow_params',
			'JSwindow',
			'JSWindow',
			'join',
			'iterations',
			'itemArrayProcFunc',
			'isTrue',
			'isPositive',
			'isLessThan',
			'isInList',
			'isGreaterThan',
			'isFalse',
			'IProcFunc',
			'invert',
			'intval',
			'intTarget',
			'intensity',
			'insertDmailerBoundaries',
			'insertData',
			'insertClassesFromRTE',
			'inputLevels',
			'innerWrap2',
			'innerWrap',
			'innerStdWrap_all',
			'inlineStyle2TempFile',
			'index_externals',
			'index_enable',
			'index_descrLgd',
			'incT3Lib_htmlmail',
			'includeNotInMenu',
			'includeLibs',
			'includeLibrary',
			'includeJS',
			'includeCSS',
			'import',
			'imgStart',
			'imgPath',
			'imgParams',
			'imgObjNum',
			'imgNamePrefix',
			'imgNameNotRandom',
			'imgMax',
			'imgMapExtras',
			'imgMap',
			'imgList',
			'image_frames',
			'image_effects',
			'image_compression',
			'imageLinkWrap',
			'image',
			'IFSUBRO',
			'IFSUB',
			'ifEmpty',
			'if',
			'icon_link',
			'icon_image_ext_list',
			'iconCObject',
			'icon',
			'http',
			'htmlTag_setParams',
			'htmlTag_langKey',
			'htmlTag_dir',
			'htmlSpecialChars',
			'HTMLparser',
			'hoverStyle',
			'hover',
			'highColor',
			'hideMenuWhenNotOver',
			'hideMenuTimer',
			'hideButCreateMap',
			'hide',
			'hiddenFields',
			'height',
			'headTag',
			'headerData',
			'headerComment',
			'h',
			'groupBy',
			'gray',
			'goodMess',
			'globalNesting',
			'gapWidth',
			'gapLineThickness',
			'gapLineCol',
			'gapBgCol',
			'gamma',
			'ftu',
			'freezeMouseover',
			'frameSet',
			'frameReloadIfNotInFrameset',
			'frame',
			'formName',
			'format',
			'forceTypeValue', 
			'forceTypeValue',
			'fontTag',
			'fontSize',
			'fontFile',
			'fontColor',
			'foldTimer',
			'foldSpeed',
			'flop',
			'flip',
			'fixAttrib',
			'firstLabelGeneral',
			'firstLabel',
			'filelist',
			'filelink',
			'file',
			'fieldWrap',
			'fieldRequired',
			'fieldPrefix',
			'field',
			'FEData',
			'face',
			'extTarget',
			'externalBlocks',
			'ext',
			'explode',
			'expand',
			'expAll',
			'excludeUidList',
			'excludeDoktypes',
			'equals',
			'equalH',
			'entryLevel',
			'encapsTagList',
			'encapsLinesStdWrap',
			'encapsLines',
			'enableContentLengthHeader',
			'enable',
			'emboss',
			'emailMess',
			'elements',
			'effects',
			'editPanel',
			'editicons',
			'edit',
			'edge',
			'dWorkArea',
			'doublePostCheck',
			'doubleBrTag',
			'dontWrapInTable',
			'dontMd5fieldNames',
			'dontLinkIfSubmenu',
			'dontHideOnMouseUp',
			'dontFollowMouse',
			'dontCheckPid',
			'doNotStripHTML',
			'doNotShowLink',
			'doNotLinkIt',
			'doctypeSwitch',
			'doctype',
			'distributeY',
			'distributeX',
			'displayRecord',
			'displayActiveOnLoad',
			'disablePrefixComment',
			'disablePageExternalUrl',
			'disableCharsetHeader',
			'disableAltText',
			'disableAllHeaderCode',
			'directReturn',
			'directory',
			'directionUp',
			'directionLeft',
			'dimensions',
			'denyTags',
			'defaultAlign',
			'default',
			'debugRenumberedObject',
			'debugItemConf',
			'debugFunc',
			'debugData',
			'debug',
			'date',
			'dataWrap',
			'dataArray',
			'data',
			'cWidth',
			'CURRO',
			'current',
			'CURIFSUBRO',
			'CURIFSUB',
			'CUR',
			'CSS_inlineStyle',
			'csConv',
			'crop',
			'content_from_pid_allowOutsideDomain',
			'constants',
			'config',
			'conf',
			'compensateFieldWidth',
			'commentWrap',
			'COMMENT',
			'colSpace',
			'cols',
			'colRelations',
			'colors',
			'color',
			'collapse',
			'cObjNum',
			'cObject',
			'cMargins',
			'clear',
			'CHECK',
			'charcoal',
			'char',
			'cellspacing',
			'cellpadding',
			'casesensitiveComp',
			'case',
			'captionSplit',
			'captionAlign',
			'caption',
			'cache_period',
			'cache_clearAtMidnight',
			'c',
			'bytes',
			'brTag',
			'browser',
			'br',
			'bottomImg_mask',
			'bottomImg',
			'bottomHeight',
			'bottomContent',
			'borderThick',
			'bordersWithin',
			'borderCol',
			'border',
			'bodyTagMargins',
			'bodyTagCObject',
			'bodyTagAdd',
			'bodyTag',
			'bm',
			'blur',
			'blankStrEqFalse',
			'bgImg',
			'beLoginLinkIPList_logout',
			'beLoginLinkIPList_login',
			'beLoginLinkIPList',
			'begin',
			'beforeWrap',
			'beforeROImg',
			'beforeImgTagParams',
			'beforeImgLink',
			'beforeImg',
			'before',
			'baseURL',
			'badMess',
			'backColor',
			'autoLevels',
			'autoInsertPID',
			'ATagTitle',
			'ATagParams',
			'ATagBeforeWrap',
			'arrowNO',
			'arrowImgParams',
			'arrowACT',
			'arrayReturnMode',
			'applyTotalW',
			'applyTotalH',
			'append',
			'antiAlias',
			'angle',
			'andWhere',
			'alwaysLink',
			'alwaysActivePIDlist',
			'always',
			'altWrap',
			'altUrl_noDefaultParams',
			'altUrl',
			'altText',
			'altTarget',
			'altImgResource',
			'alternativeTempPath',
			'alternativeSortingField',
			'allWrap',
			'allStdWrap',
			'allowTags',
			'allowNew',
			'allowEdit',
			'allowedCols',
			'allowedAttribs',
			'allow',
			'align',
			'age',
			'after',
			'admPanel',
			'adminPanelStyles',
			'adjustSubItemsH',
			'adjustItemsH',
			'addQueryString',
			'addParams',
			'additionalParams',
			'additionalHeaders',
			'addExtUrlsAndShortCuts',
			'addAttributes',
			'ACTRO',
			'ACTIFSUBRO',
			'ACTIFSUB',
			'ACT',
			'accessKey',
			'accessibility',
			'absRefPrefix',
		),
	
	  /* Content objects in general: */
	  2 => array(
			'USER_INT',
			'USER',
			'TEXT', 
			'TEMPLATE',
			'SEARCHRESULT',
			'RESTORE_REGISTER',
			'RECORDS',
			'PHP_SCRIPT_INT',
			'PHP_SCRIPT_EXT',
			'PHP_SCRIPT',
			'OTABLE',
			'MULTIMEDIA',
			'LOAD_REGISTER',
			'IMG_RESOURCE',
			'IMGTEXT',
			'IMAGE',
			'HTML',	
			'HRULER',
			'HMENU',
			'FORM',
			'EDITPANEL',
			'FILE',
			'CTABLE',
			'CONTENT',
			'COLUMNS',
			'COBJ_ARRAY',
			'COA_INT',
			'COA',
			'CLEARGIF',
			'CASE',
	  ),
		
	  /* Gifbuilder objects: */
		3 => array(
			'WORKAREA',
			'TEXT',
			'SHADOW',
			'SCALE',
			'IMGMAP',
			'IMAGE',
			'OUTLINE',
			'GIFBUILDER',
			'EMBOSS',
			'CROP',
			'BOX',
			'ADJUST',
		),
		
		/* Menu objects: */
		4 => array(
			'TMENU_LAYERS',
			'TMENU',
			'JSMENU',
			'IMGMENU',
			'GMENU_LAYERS',
			'GMENU_FOLDOUT',
			'GMENU',
		),
	  
		/* Setup: */
		5 => array(
			'plugin',
			'PAGE',
			'META',
			'FRAMESET',
			'FRAME',
			'FE_TABLE',
			'FE_DATA',
			'CONSTANTS',
			'CONFIG',
			'CARRAY',
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
		1 => '',
		2 => '',
		3 => '',
		4 => '',
		),
	'OOLANG' => true,
	'OBJECT_SPLITTERS' => array(
		1 => ':',
	),
	'REGEXPS' => array(
		1 => array( // Works: matches any x/html tag
			GESHI_SEARCH => '(&lt;\/*.+?&gt;)',
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
	'SCRIPT_DELIMITERS' => array(
		0 => array(
			'<?php' => '?>'
			),
		1 => array(
			'<?' => '?>'
			),
		2 => array(
			'<%' => '%>'
			),
		3 => array(
			'<script language="php">' => '</script>'
			)
		),
	'HIGHLIGHT_STRICT_BLOCK' => array(
		0 => true,
		1 => true,
		2 => true,
		3 => true
		)
);

?>