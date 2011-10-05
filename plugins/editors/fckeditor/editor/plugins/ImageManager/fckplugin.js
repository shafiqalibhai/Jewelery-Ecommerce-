// ================================================
// Image Manager FCKeditor interface (IE & Gecko)
// ================================================
// Plugin Interface: Brent Kelly - Zeald.com
// (c)2005 All rights reserved.
// ================================================
// Integrates FCKeditor with:
// PHP image manager http://www.zhuo.org/htmlarea/
// ================================================
// Revision: 1.0                   Date: 06/03/2005
// $Id: fckplugin.js,v 1.4 2006/12/21 20:47:55 thierrybo Exp $
// ================================================



// ==============       config settings       ===========

// plugin's language
	var _editor_lang = FCKLanguageManager.ActiveLanguage.Code;
// show image manager or show immediately the image editor
// false = use manager, standard behavior
// true = no manager, only editing the image
	var IM_directEdit = false;

// ================================================




	var FCKImageManager = function(name) {  
		this.Name = name;		
	}  
	// manage the plugins' button behavior  
	FCKImageManager.prototype.GetState = function() {  
		return FCK_TRISTATE_OFF;  
	}  
	 
	FCKCommands.RegisterCommand('ImageManager', new FCKImageManager('ImageManager')) ;  
	 
	// Create the toolbar button. 
	var oImageManagerItem = new FCKToolbarButton( 'ImageManager', "ImageManager", null, null, false, true ) ; 
	oImageManagerItem.IconPath = FCKConfig.PluginsPath + 'ImageManager/icon.gif' ; 
	FCKToolbarItems.RegisterItem( 'ImageManager', oImageManagerItem ) ;
	
	FCKImageManager.prototype.Execute = function() {  
		ImageManager_click(FCK, null)	
	}

    // Open the Placeholder dialog on double click.
    function ImageManager_doubleClick (img) {

		if ( img.tagName == 'IMG' ) FCKCommands.GetCommand( 'ImageManager' ).Execute() ;
	}

	FCK.RegisterDoubleClickHandler( ImageManager_doubleClick, 'IMG' ) ;	

	// starting ImageManager
	function ImageManager_click(editor, sender) {
		var wArgs = {};
		if(FCKSelection.GetType() == 'Control') {
			var sElm = FCK.Selection.GetSelectedElement();
		} if(FCKSelection.GetType() == 'Text') {
			var sElm = FCKSelection.GetParentElement();
		}
		
		if (sElm != null && sElm.nodeName.toLowerCase() == 'img') var im = sElm;  // is current cell a image ?			
	
		if (im) { // selected object is image
			wArgs.f_url		= im.src ? im.src : '';
			wArgs.f_alt		= im.alt ? im.alt : '';
			wArgs.f_title 	= im.title ? im.title : '';
			wArgs.f_width 	= im.style.width  ? im.style.width  : im.width;
			wArgs.f_height 	= im.style.height ? im.style.height : im.height;
			wArgs.f_border 	= im.border ? im.border : '';
			wArgs.f_align 	= im.align ? im.align : '';
			wArgs.f_className = im.className ? im.className : '';
			
			// (-1 when not set under gecko for some reason)
			wArgs.f_horiz = (im.hspace >= 0) ? im.attributes['hspace'].nodeValue : ''; 
			wArgs.f_vert = (im.vspace >= 0) ? wArgs.f_vert = im.attributes['vspace'].nodeValue : '';			
		} else {
			wArgs = null;
		}
		//-------------------------------------------------------------------------
		var manager = new ImageManager();
		manager.insert(wArgs);

	}

//-------------------------------------------------------------------------
function setAttrib(element, name, value, fixval) { // set element attributes
	if (!fixval && value != null) {
		var re = new RegExp('[^0-9%]', 'g');
		value = value.replace(re, '');
	}
	if (value != null && value != '') {
		element.setAttribute(name, value);
	} else {
		element.removeAttribute(name);
	}
}

/* IMAGE MANAGER OBJECT - A CROSS BETWEEN THE STANDALONE & HTMLAREA PLUGIN VERSIONS */
function ImageManager()
{
	//var tt = ImageManager.I18N;	
};


// Open up the plugin's dialog with manager or editor.
ImageManager.prototype.insert = function(outparam)
{
	// show image editor
	if (IM_directEdit)
	{
		// image selected?
		var sElm = FCK.Selection.GetSelectedElement();
		if (sElm != null && sElm.nodeName.toLowerCase() == 'img')
		{
			// opening a dialog with the image editor - editor.php must receive the path to the image relative to your 'base_url' defined in 'config.inc.php'
			// for direct Editing, we assume that there are no subdirectories in 'base_url' so our path is just '/'
			lastSlashPosition = sElm.src.lastIndexOf('/') + 1;
			imgFileName = sElm.src.substring(lastSlashPosition);
			var url = FCKConfig.PluginsPath + 'ImageManager/editor.php?img=' + "/" + imgFileName;
			Dialog(url, null, outparam);
		}
		// no image selected - stop
		else
		{
			alert("no image selected");
			return false;
		}
	}
	// show image manager
	else
	{
		var manager = FCKConfig.PluginsPath+'ImageManager/manager.php';

		
		Dialog(manager, function(param) {

			if (!param) return false; // user must have pressed cancel
			var sElm = FCK.Selection.GetSelectedElement();
			if (sElm != null && sElm.nodeName.toLowerCase() == 'img') var im = sElm;				

			if (!im) { // new image// no image - create new image
				im = FCK.CreateElement('IMG');					
			}

			// set image attributes	
			setAttrib(im, "_fcksavedurl", param.f_url, true);			
			setAttrib(im, 'src', param.f_url, true);				
			setAttrib(im, 'alt', param.f_alt, true);
			setAttrib(im, 'title', param.f_title, true);
			setAttrib(im, 'align', param.f_align, true);
			setAttrib(im, 'border', param.f_border);
			setAttrib(im, 'hspace', param.f_horiz);
			setAttrib(im, 'vspace', param.f_vert);
			setAttrib(im, 'width', param.f_width);
			setAttrib(im, 'height', param.f_height);				
			setAttrib(im, 'className', param.f_className, true); 
			return;

		}, outparam);
	}
};

// Dialog v3.0 - Copyright (c) 2003-2004 interactivetools.com, inc.
// This copyright notice MUST stay intact for use (see license.txt).
//
// Portions (c) dynarch.com, 2003-2004
//
// A free WYSIWYG editor replacement for <textarea> fields.
// For full source code and docs, visit http://www.interactivetools.com/
//
// Version 3.0 developed by Mihai Bazon.
//   http://dynarch.com/mishoo
//
// Id: dialog.js 26 2004-03-31 02:35:21Z Wei Zhuo 

// Though "Dialog" looks like an object, it isn't really an object.  Instead
// it's just namespace for protecting global symbols.
function Dialog(url, action, init) {
	if (typeof init == "undefined") {
		init = window;	// pass this window object by default
	}
	Dialog._geckoOpenModal(url, action, init);
};

Dialog._parentEvent = function(ev) {
	setTimeout( function() { if (Dialog._modal && !Dialog._modal.closed) { Dialog._modal.focus() } }, 50);
	if (Dialog._modal && !Dialog._modal.closed) {
		Dialog._stopEvent(ev);
	}
};


// should be a function, the return handler of the currently opened dialog.
Dialog._return = null;

// constant, the currently opened dialog
Dialog._modal = null;

// the dialog will read it's args from this variable
Dialog._arguments = null;

Dialog._geckoOpenModal = function(url, action, init) {
	//var urlLink = "hadialog"+url.toString();
	var myURL = "hadialog"+url;
	var regObj = /\W/g;
	myURL = myURL.replace(regObj,'_');
	var dlg = window.open(url, myURL,
			      "toolbar=no,menubar=no,personalbar=no,width=10,height=10," +
			      "scrollbars=no,resizable=yes,modal=yes,dependable=yes");
	Dialog._modal = dlg;
	Dialog._arguments = init;

	// capture some window's events
	function capwin(w) {
		Dialog._addEvent(w, "click", Dialog._parentEvent);
		Dialog._addEvent(w, "mousedown", Dialog._parentEvent);
		Dialog._addEvent(w, "focus", Dialog._parentEvent);
	};
	// release the captured events
	function relwin(w) {
		Dialog._removeEvent(w, "click", Dialog._parentEvent);
		Dialog._removeEvent(w, "mousedown", Dialog._parentEvent);
		Dialog._removeEvent(w, "focus", Dialog._parentEvent);
	};
	capwin(window.document);
	// capture other frames
	for (var i = 0; i < window.frames.length; capwin(window.frames[i++].document));
	// make up a function to be called when the Dialog ends.
	Dialog._return = function (val) {
		if (val && action) {
			action(val);
		}
		relwin(window.document);
		// capture other frames
		for (var i = 0; i < window.frames.length; relwin(window.frames[i++].document));
		Dialog._modal = null;
	};
};


// event handling

Dialog._addEvent = function(el, evname, func) {
	if (Dialog.is_ie) {
		el.attachEvent("on" + evname, func);
	} else {		
		el.addEventListener(evname, func, true);
	}
};


Dialog._removeEvent = function(el, evname, func) {
	if (Dialog.is_ie) {
		el.detachEvent("on" + evname, func);
	} else {
		el.removeEventListener(evname, func, true);
	}
};


Dialog._stopEvent = function(ev) {
	if (Dialog.is_ie) {
		ev.cancelBubble = true;
		ev.returnValue = false;
	} else {
		ev.preventDefault();
		ev.stopPropagation();
	}
};

Dialog.agt = navigator.userAgent.toLowerCase();
Dialog.is_ie	   = ((Dialog.agt.indexOf("msie") != -1) && (Dialog.agt.indexOf("opera") == -1));
