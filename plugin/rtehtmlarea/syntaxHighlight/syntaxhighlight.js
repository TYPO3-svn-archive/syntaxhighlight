/***************************************************************
*  Copyright notice
*
*  (c) 2008 Stanislas Rolland <typo3(arobas)sjbr.ca>
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
*  A copy is found in the textfile GPL.txt and important notices to the license
*  from the author is found in LICENSE.txt distributed with these scripts.
*
*
*  This script is distributed in the hope that it will be useful,
*  but WITHOUT ANY WARRANTY; without even the implied warranty of
*  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
*  GNU General Public License for more details.
*
*
*  This copyright notice MUST APPEAR in all copies of the script!
***************************************************************/
/*
 * syntaxHighlight Plugin for TYPO3 htmlArea RTE
 *
 * TYPO3 SVN ID: $Id: syntaxhighlight.js $
 */
syntaxHighlight = HTMLArea.Plugin.extend({
		
	constructor : function(editor, pluginName) {
		this.base(editor, pluginName);
	},
	
	/*
	 * This function gets called by the class constructor
	 */
	configurePlugin : function (editor) {
		
		/*
		 * Setting up some properties from PageTSConfig
		 */
		this.buttonsConfiguration = this.editorConfiguration.buttons;
		
		/*
		 * Registering plugin "About" information
		 */
		var pluginInformation = {
			version        : "0.1",
			developer      : "Steffen Kamper",
			developerUrl   : "http://www.sk-typo3.de/",
			copyrightOwner : "Steffen Kamper",
			sponsor        : "Michiel Roos",
			sponsorUrl     : "http://typofree.org",
			license        : "GPL"
		};
		this.registerPluginInformation(pluginInformation);
		
		/*
		 * Registering the buttons
		 */
		for (var buttonId in this.buttonList) {
			if (this.buttonList.hasOwnProperty(buttonId)) {
				var button = this.buttonList[buttonId];
				var buttonConfiguration = {
					id      : buttonId,
					tooltip : this.localize(buttonId + "-Tooltip"),
					action  : "onButtonPress",
					context : button[0],
					hotKey  : (this.buttonsConfiguration[button[2]] ? this.buttonsConfiguration[button[2]].hotKey : (button[1] ? button[1] : null))
				};
				this.registerButton(buttonConfiguration);
			}
		}
		
		return true;
	},
	
	/*
	 * The list of buttons added by this plugin
	 */
	buttonList : {
		syntaxHighlight : [null, null, "syntaxhighlight"]
	},
	
	/*
	 * This function gets called when a button was pressed.
	 *
	 * @param  object  editor: the editor instance
	 * @param  string  id: the button id or the key
	 * @param  object  target: the target element of the contextmenu event, when invoked from the context menu
	 *
	 * @return boolean false if action is completed
	 */
	onButtonPress : function (editor, id, target) {
		  // Could be a button or its hotkey
		var buttonId = this.translateHotKey(id);
		buttonId = buttonId ? buttonId : id;
		this.popupWidth = 800;
		this.popupHeight = 600;

		this.dialog = this.openDialog("syntaxHighlight", this.makeUrlFromPopupName("syntaxhighlight"), "applyRequest", null, {width:this.popupWidth, height:this.popupHeight});
		return false;
	},
	
	applyRequest : function(param) {
		var editor = this.editor;
		editor.focusEditor();
		if (param) {
		}
	}

});
