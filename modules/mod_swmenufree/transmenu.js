/* =================================================================================================
 * TransMenu
 * March, 2003
 *
 * Customizable multi-level animated DHTML menus with transparency.
 *
 * Copyright 2003-2004, Aaron Boodman (www.youngpup.net)
 * =================================================================================================
 * "Can I use this?"
 *
 * Use of this library is governed by the Creative Commons Attribution 2.0 License. You can check it
 * out at: http://creativecommons.org/licenses/by/2.0/
 *
 * Basically: You may copy, distribute, and eat this code as you wish. But you must give me credit
 * for writing it. You may not misrepresent yourself as the author of this code.
 * =================================================================================================
 * "It's kinda hard to read, though"
 *
 * The uncompressed, commented version of this script can be found at:
 * http://youngpup.net/projects/transMenus
 * =================================================================================================
 * updates:
 * 04.19.04 fixed cascade problem with menus nested greater than two levels.
 * 12.23.03 added hideCurrent for menu actuators with no menus. renamed to TransMenu.
 * 04.18.03	fixed render bug in IE 5.0 Mac by removing that browser from compatibility table ;)
 *			also made gecko check a little more strict by specifying build no.
 * ============================================================================================== */



//==================================================================================================
// Configuration properties
//==================================================================================================
TransMenu.spacerGif = "img/x.gif";                     // path to a transparent spacer gif
TransMenu.dingbatOn = "img/submenu-on.gif";            // path to the active sub menu dingbat
TransMenu.dingbatOff = "img/submenu-off.gif";          // path to the inactive sub menu dingbat
TransMenu.dingbatSize = 14;                            // size of the dingbat (square shape assumed)
TransMenu.menuPadding = 5;                             // padding between menu border and items grid
TransMenu.itemPadding = 3;                             // additional padding around each item
TransMenu.shadowSize = 2;                              // size of shadow under menu
TransMenu.shadowOffset = 3;                            // distance shadow should be offset from leading edge
TransMenu.shadowColor = "#888";                        // color of shadow (transparency is set in CSS)
TransMenu.shadowPng = "img/grey-40.png";               // a PNG graphic to serve as the shadow for mac IE5
TransMenu.backgroundColor = "white";                   // color of the background (transparency set in CSS)
TransMenu.backgroundPng = "img/white-90.png";          // a PNG graphic to server as the background for mac IE5
TransMenu.hideDelay = 1000;                            // number of milliseconds to wait before hiding a menu
TransMenu.slideTime = 400;   
TransMenu.autoposition = 1; // number of milliseconds it takes to open and close a menu


//==================================================================================================
// Internal use properties
//==================================================================================================
TransMenu.reference = {topLeft:1,topRight:2,bottomLeft:3,bottomRight:4};
TransMenu.direction = {down:1,right:2,up:3,left:4,dleft:5};
TransMenu.registry = [];
TransMenu._maxZ = 100;



//==================================================================================================
// Static methods
//==================================================================================================
// supporting win ie5+, mac ie5.1+ and gecko >= mozilla 1.0
TransMenu.isSupported = function() {
        var ua = navigator.userAgent.toLowerCase();
		var pf = navigator.platform.toLowerCase();
        var an = navigator.appName;
        var r = true;

        if (ua.indexOf("gecko") > -1 && navigator.productSub >= 20020605) r = true; // gecko >= moz 1.0
        else if (an == "Microsoft Internet Explorer"  ) {
                if (document.getElementById) { // ie5.1+ mac,win
                        if (pf.indexOf("mac") == 0) {
							r = /msie (\d(.\d*)?)/.test(ua) && Number(RegExp.$1) >= 5.1;
						}
						else r = true;
                }
        }

        return r;
};

// call this in onload once menus have been created
TransMenu.initialize = function() {
        for (var i = 0, menu = null; menu = this.registry[i]; i++) {
                menu.initialize();
        }
};

// call this in document body to write out menu html
TransMenu.renderAll = function() {
        var aMenuHtml = [];
        for (var i = 0, menu = null; menu = this.registry[i]; i++) {
                aMenuHtml[i] = menu.toString();
        }
        document.write(aMenuHtml.join(""));
};

//==================================================================================================
// TransMenu constructor (only called internally)
//==================================================================================================
// oActuator            : The thing that causes the menu to be shown when it is mousedover. Either a
//                        reference to an HTML element, or a TransMenuItem from an existing menu.
// iDirection           : The direction to slide out. One of TransMenu.direction.
// iLeft                : Left pixel offset of menu from actuator
// iTop                 : Top pixel offset of menu from actuator
// iReferencePoint      : Corner of actuator to measure from. One of TransMenu.referencePoint.
// parentMenuSet        : Menuset this menu will be added to.
//==================================================================================================
function TransMenu(oActuator, iDirection, iLeft, iTop, iReferencePoint, parentMenuSet) {
        // public methods
        this.addItem = addItem;
        this.addMenu = addMenu;
        this.toString = toString;
        this.initialize = initialize;
        this.isOpen = false;
        this.show = show;
        this.hide = hide;
        this.items = [];
		//modid=TransMenu.modid;
        // events
        this.onactivate = new Function();       // when the menu starts to slide open
        this.ondeactivate = new Function();     // when the menu finishes sliding closed
        this.onmouseover = new Function();      // when the menu has been moused over
        this.onqueue = new Function();          // hack .. when the menu sets a timer to be closed a little while in the future
		this.ondequeue = new Function();

        // initialization
        this.index = TransMenu.registry.length;
        TransMenu.registry[this.index] = this;

        var id = "TransMenu" + this.index ;
        var contentHeight = null;
        var contentWidth = null;
        var childMenuSet = null;
        var animating = false;
        var childMenus = [];
        var slideAccel = -1;
        var elmCache = null;
        var ready = false;
        var _this = this;
        var a = null;
	
	//	var pos = (iDirection == TransMenu.direction.down || iDirection == TransMenu.direction.up)? "top" : "left";
       var pos = (iDirection == TransMenu.direction.down || iDirection == TransMenu.direction.up || iDirection == TransMenu.direction.dleft)? "top" : "left";
        var dim = null;

        // private and public method implimentations
        function addItem(sText, sUrl, browserNav, active) {
                var item = new TransMenuItem(sText, sUrl, this, browserNav, active,(id+"-"+this.items.length),iDirection);
                item._index = this.items.length;
                this.items[item._index] = item;
        }

        function addMenu(oMenuItem,offx,offy) {
                if (!oMenuItem.parentMenu == this) throw new Error("Cannot add a menu here");

				var iDirec = TransMenu.direction.right;
				var iRef = TransMenu.reference.topRight;
				if (iDirection == TransMenu.direction.left || iDirection == TransMenu.direction.dleft)
				{
					iDirec = TransMenu.direction.left;
					iRef = TransMenu.reference.topLeft;
				}
            if (childMenuSet == null) childMenuSet = new TransMenuSet(iDirec, offx, offy, iRef);

                var m = childMenuSet.addMenu(oMenuItem);

                childMenus[oMenuItem._index] = m;
                m.onmouseover = child_mouseover;
                m.ondeactivate = child_deactivate;
                m.onqueue = child_queue;
				m.ondequeue = child_dequeue;

                return m;
        }

        function initialize() {
                initCache();
                initEvents();
                initSize();
                ready = true;
        }

        function show() {
                //dbg_dump("show");
                if (ready) {
                        //dbg_msg("ID: " + id);
            _this.isOpen = true;
                        animating = true;
                        setContainerPos();
                        elmCache["clip"].style.visibility = "visible";
                        elmCache["clip"].style.zIndex = TransMenu._maxZ++;
					//	 elmCache["clip"].style.zIndex = 100;
                        //dbg_dump("maxZ: " + TransMenu._maxZ);
                        slideStart();
                        // ADD LINE BELOW
						if(TransMenu.selecthack){
							
                  WCH.Apply(id);
						}
                        _this.onactivate();
                }
        }

        function hide() {
        if (ready) {
                        _this.isOpen = false;
                        animating = true;

            for (var i = 0, item = null; item = elmCache.item[i]; i++)
                                dehighlight(item);

                        if (childMenuSet) childMenuSet.hide();

                        slideStart();
                       //ADD LINE BELOW
					   if(TransMenu.selecthack){
                      WCH.Discard(id);
					   }
                        _this.ondeactivate();
                }
        }

        function setContainerPos() {
                var sub = oActuator.constructor == TransMenuItem;
                var act = sub ? oActuator.parentMenu.elmCache["item"][oActuator._index] : oActuator;
                var el = act;

                var x = 0;
                var y = 0;


   var ua = navigator.userAgent.toLowerCase();
if(TransMenu.autoposition){

  
if ( ua.indexOf("opera") >= 0 )
{
         var minX = 0;
                var maxX = (window.innerWidth ? window.innerWidth + document.body.scrollLeft : document.body.clientWidth + document.body.scrollLeft) - parseInt(elmCache["clip"].style.width);
                var minY = 0;
                var maxY = (window.innerHeight ? window.innerHeight + document.body.scrollTop : document.body.clientHeight + document.body.scrollTop) - parseInt(elmCache["clip"].style.height);

     }else{


               var minX = 0;
var maxX = (window.innerWidth ? window.innerWidth + window.scrollX : document.documentElement.clientWidth + document.documentElement.scrollLeft) - parseInt(elmCache["clip"].style.width);
var minY = 0;
var maxY = (window.innerHeight ? window.innerHeight + window.scrollY : document.documentElement.clientHeight + document.documentElement.scrollTop) - parseInt(elmCache["clip"].style.height);
// alert(document.documentElement.clientHeight);
   }
}

                 // add up all offsets... subtract any scroll offset
                while (sub ? el.parentNode.className.indexOf("transMenu") == -1 : el.offsetParent) {
                        x += el.offsetLeft;
                        y += el.offsetTop;

                        if (el.scrollLeft) x -= el.scrollLeft;
                        if (el.scrollTop) y -= el.scrollTop;

                       
                        el = el.offsetParent;
                }

                if (oActuator.constructor == TransMenuItem) {
                        x += parseInt(el.parentNode.style.left);
                        y += parseInt(el.parentNode.style.top);
                }

                switch (iReferencePoint) {
                        case TransMenu.reference.topLeft:
                                break;
                        case TransMenu.reference.topRight:
                                x += act.offsetWidth;
                                break;
                        case TransMenu.reference.bottomLeft:
                                y += act.offsetHeight;
                                break;
                        case TransMenu.reference.bottomRight:
                                x += act.offsetWidth;
                                y += act.offsetHeight;
                                break;
                }
                //  Begin fix for Safari 1.2 Submenu Positions
//if (act.tagName == "A" && act.childNodes[0] && ua.indexOf("safari") > -1){
 x += el.offsetLeft;
 y += el.offsetTop;
//}
if ((act.tagName == "TR" && act.childNodes[0]) && ua.indexOf("safari") >= 0){
  if(iDirection==4){
 //  y += act.childNodes[0].offsetTop;
  }else  {
	  xx_offset=0;
	 if(TransMenu.sub_indicator){
	 xx_offset=act.childNodes[1].offsetWidth;
	 }
	 start=ua.indexOf("safari");
	 ver=parseInt(ua.substring((start+7),(start+10)));
	 if(ver<500){
  x += act.childNodes[0].offsetLeft + act.childNodes[0].offsetWidth + xx_offset ;
	 y += act.childNodes[0].offsetTop;
	 }
	
  }
}
 //Fix for opera
if ((act.tagName == "TR" && ua.indexOf("opera") >= 0 )){
 //  y += act.childNodes[0].offsetTop;
}

//  End fix for Safaria 1.2 Submenu Positions
                x += iLeft;
                y += iTop;
if(TransMenu.autoposition){
			   x = Math.max(Math.min(x, maxX), minX);
               y = Math.max(Math.min(y, maxY), minY);
}
				//alert(el.offsetTop);

				var ow = elmCache["items"].offsetWidth;
                var oh = elmCache["items"].offsetHeight;
                contentHeight = oh + TransMenu.shadowSize;
                contentWidth = ow + TransMenu.shadowSize;
				if (iDirection == TransMenu.direction.up )
				{
					y -= contentHeight;
				}
				if (iDirection == TransMenu.direction.left || iDirection == TransMenu.direction.dleft )
				{
					x -= contentWidth;
				}

				elmCache["clip"].style.left = x + "px";
                elmCache["clip"].style.top = y + "px";

        }

        function slideStart() {
                var x0 = parseInt(elmCache["content"].style[pos]);
                var x1 = _this.isOpen ? 0 : -dim;

                if (a != null) a.stop();
                a = new Accelimation(x0, x1, TransMenu.slideTime, slideAccel);

                a.onframe = slideFrame;
                a.onend = slideEnd;

                a.start();
        }

        function slideFrame(x) {
                elmCache["content"].style[pos] = x + "px";
        }

        function slideEnd() {
                if (!_this.isOpen) elmCache["clip"].style.visibility = "hidden";
                animating = false;
        }

        function initSize() {
                // everything is based off the size of the items table...
                var ow = elmCache["items"].offsetWidth;
                var oh = elmCache["items"].offsetHeight;
                var ua = navigator.userAgent.toLowerCase();

                // clipping container should be ow/oh + the size of the shadow
                elmCache["clip"].style.width = ow + TransMenu.shadowSize +  2 + "px";
                elmCache["clip"].style.height = oh + TransMenu.shadowSize + 2 + "px";

                // same with content...
                elmCache["content"].style.width = ow + TransMenu.shadowSize + "px";
                elmCache["content"].style.height = oh + TransMenu.shadowSize + "px";

                contentHeight = oh + TransMenu.shadowSize;
                contentWidth = ow + TransMenu.shadowSize;
                
                dim = (iDirection == TransMenu.direction.down || iDirection == TransMenu.direction.up ) ? contentHeight : contentWidth;
				if (iDirection == TransMenu.direction.left || iDirection == TransMenu.direction.up )
				{
					dim = -dim;
				}
                // set initially closed
                elmCache["content"].style[pos] = -dim - TransMenu.shadowSize + "px";
                elmCache["clip"].style.visibility = "hidden";
				// elmCache["clip"].style.float = "left";
                // if *not* mac/ie 5
                if (ua.indexOf("mac") == -1 || ua.indexOf("gecko") > -1) {
                        // set background div to offset size
                        elmCache["background"].style.width = ow + "px";
                        elmCache["background"].style.height = oh + "px";
                        elmCache["background"].style.backgroundColor = TransMenu.backgroundColor;

                        // shadow left starts at offset left and is offsetHeight pixels high
                        elmCache["shadowRight"].style.left = ow + "px";
                        elmCache["shadowRight"].style.height = oh - (TransMenu.shadowOffset - TransMenu.shadowSize) + "px";
                        elmCache["shadowRight"].style.backgroundColor = TransMenu.shadowColor;

                        // shadow bottom starts at offset height and is offsetWidth - shadowOffset 
                        // pixels wide (we don't want the bottom and right shadows to overlap or we 
                        // get an extra bright bottom-right corner)
                        elmCache["shadowBottom"].style.top = oh + "px";
                        elmCache["shadowBottom"].style.width = ow - TransMenu.shadowOffset + "px";
                        elmCache["shadowBottom"].style.backgroundColor = TransMenu.shadowColor;
                }
                // mac ie is a little different because we use a PNG for the transparency
                else {
                        // set background div to offset size
                        elmCache["background"].firstChild.src = TransMenu.backgroundPng;
                        elmCache["background"].firstChild.width = ow;
                        elmCache["background"].firstChild.height = oh;

                        // shadow left starts at offset left and is offsetHeight pixels high
                        elmCache["shadowRight"].firstChild.src = TransMenu.shadowPng;
                        elmCache["shadowRight"].style.left = ow + "px";
                        elmCache["shadowRight"].firstChild.width = TransMenu.shadowSize;
                        elmCache["shadowRight"].firstChild.height = oh - (TransMenu.shadowOffset - TransMenu.shadowSize);

                        // shadow bottom starts at offset height and is offsetWidth - shadowOffset 
                        // pixels wide (we don't want the bottom and right shadows to overlap or we 
                        // get an extra bright bottom-right corner)
                        elmCache["shadowBottom"].firstChild.src = TransMenu.shadowPng;
                        elmCache["shadowBottom"].style.top = oh + "px";
                        elmCache["shadowBottom"].firstChild.height = TransMenu.shadowSize;
                        elmCache["shadowBottom"].firstChild.width = ow - TransMenu.shadowOffset;
                }
        }
        
        
        function initCache() {
                var menu = document.getElementById(id);
                var all = menu.all ? menu.all : menu.getElementsByTagName("*"); // IE/win doesn't support * syntax, but does have the document.all thing

                elmCache = {};
                elmCache["clip"] = menu;
                elmCache["item"] = [];
                
                for (var i = 0, elm = null; elm = all[i]; i++) {
                        switch (elm.className) {
                                case "items":
                                case "content":
                                case "background":
                                case "shadowRight":
                                case "shadowBottom":
                                        elmCache[elm.className] = elm;
                                        break;
                                case "item":
                                        elm._index = elmCache["item"].length;
                                        elmCache["item"][elm._index] = elm;
                                        break;
                        }
                }

                // hack!
                _this.elmCache = elmCache;
        }

        function initEvents() {
                // hook item mouseover
                for (var i = 0, item = null; item = elmCache.item[i]; i++) {
                        item.onmouseover = item_mouseover;
                        item.onmouseout = item_mouseout;
                        item.onclick = item_click;
                }

                // hook actuation
                if (typeof oActuator.tagName != "undefined") {
                        oActuator.onmouseover = actuator_mouseover;
                        oActuator.onmouseout = actuator_mouseout;
                }

                // hook menu mouseover
                elmCache["content"].onmouseover = content_mouseover;
                elmCache["content"].onmouseout = content_mouseout;
        }

        function highlight(oRow) {
                oRow.className = "item hover";
                if (childMenus[oRow._index])
                    if (TransMenu.sub_indicator &&   oRow.lastChild.firstChild.src){
                        oRow.lastChild.firstChild.src = TransMenu.dingbatOn;
                    }
        }

        function dehighlight(oRow) {
                oRow.className = "item";
                if (childMenus[oRow._index])
                if (TransMenu.sub_indicator &&   oRow.lastChild.firstChild.src){
					oRow.lastChild.firstChild.src = TransMenu.dingbatOff;
        }          }

        function item_mouseover() {
                if (!animating) {
                        highlight(this);

                        if (childMenus[this._index]) 
                                childMenuSet.showMenu(childMenus[this._index]);
                        else if (childMenuSet) childMenuSet.hide();
                }
        }

        function item_mouseout() {
                if (!animating) {
                        if (childMenus[this._index]){
                             //   childMenuSet.hideMenu(childMenus[this._index]);
						} else{    // otherwise child_deactivate will do this
                                dehighlight(this);
						}
                }
        }

        function item_click() {
                if (!animating) {
                        if (_this.items[this._index].url) {

									if (_this.items[this._index].target =="1") {
										window.open(_this.items[this._index].url, "_blank");
									}else if (_this.items[this._index].target =="2") {
										window.open(_this.items[this._index].url, '', 'toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width=780,height=550');

									}else if (_this.items[this._index].target =="3") {
										location.href = void(0);
									}else{
									    location.href = _this.items[this._index].url;
									}
        }
		}
		}
        function actuator_mouseover() {
                parentMenuSet.showMenu(_this);
        }

        function actuator_mouseout() {
                parentMenuSet.hideMenu(_this);
        }

        function content_mouseover() {
                if (!animating) {
                        parentMenuSet.showMenu(_this);
                        _this.onmouseover();
                }
        }

        function content_mouseout() {
                if (!animating) {
                        parentMenuSet.hideMenu(_this);
                }
        }

        function child_mouseover() {
                if (!animating) {
                        parentMenuSet.showMenu(_this);
                }
        }

        function child_deactivate() {
                for (var i = 0; i < childMenus.length; i++) {
                        if (childMenus[i] == this) {
                                dehighlight(elmCache["item"][i]);
                                break;
                        }
                }
        }

        function child_queue() {
                parentMenuSet.hideMenu(_this);
        }

		function child_dequeue() {
				parentMenuSet.showMenu(_this);
		}

        function toString() {
                var aHtml = [];


                var sClassName = "transMenu"  + (oActuator.constructor != TransMenuItem ? " top" : "");

                for (var i = 0, item = null; item = this.items[i]; i++) {
                        aHtml[i] = item.toString(childMenus[i]);
                }

                return '<div id="' + id + '" class="' + sClassName + '">' +
                        '<div class="content"><table class="items" cellpadding="0" cellspacing="0" border="0">' +
                        aHtml.join('') +
                        '</table>' +
                        '<div class="shadowBottom"></div>' +
                        '<div class="shadowRight"></div>' +
		        '<div class="background"></div>' +
	                '</div></div>';
        }
}


//==================================================================================================
// TransMenuSet
//==================================================================================================
// iDirection           : The direction to slide out. One of TransMenu.direction.
// iLeft                : Left pixel offset of menus from actuator
// iTop                 : Top pixel offset of menus from actuator
// iReferencePoint      : Corner of actuator to measure from. One of TransMenu.referencePoint.
//==================================================================================================
TransMenuSet.registry = [];

function TransMenuSet(iDirection, iLeft, iTop, iReferencePoint) {
        // public methods
        this.addMenu = addMenu;
        this.showMenu = showMenu;
        this.hideMenu = hideMenu;
        this.hide = hide;
        this.hideCurrent = hideCurrent;

        // initialization
        var menus = [];
        var _this = this;
        var current = null;

        this.index = TransMenuSet.registry.length;
        TransMenuSet.registry[this.index] = this;

        // method implimentations...
        function addMenu(oActuator) {
                var m = new TransMenu(oActuator, iDirection, iLeft, iTop, iReferencePoint, this);
                menus[menus.length] = m;
                return m;
        }

        function showMenu(oMenu) {
                if (oMenu != current) {
                        // close currently open menu
                        if (current != null) hide(current);

                        // set current menu to this one
                        current = oMenu;

                        // if this menu is closed, open it
                        oMenu.show();
                }
                else {
                        // hide pending calls to close this menu
                        cancelHide(oMenu);
                }
        }

        function hideMenu(oMenu) {
                //dbg_dump("hideMenu a " + oMenu.index);
                if (current == oMenu && oMenu.isOpen) {
                        //dbg_dump("hideMenu b " + oMenu.index);
                        if (!oMenu.hideTimer) scheduleHide(oMenu);
                }
        }

        function scheduleHide(oMenu) {
                //dbg_dump("scheduleHide " + oMenu.index);
                oMenu.onqueue();
                oMenu.hideTimer = window.setTimeout("TransMenuSet.registry[" + _this.index + "].hide(TransMenu.registry[" + oMenu.index + "])", TransMenu.hideDelay);
        }

        function cancelHide(oMenu) {
                //dbg_dump("cancelHide " + oMenu.index);
                if (oMenu.hideTimer) {
						oMenu.ondequeue();
                        window.clearTimeout(oMenu.hideTimer);
                        oMenu.hideTimer = null;
                }
        }

        function hide(oMenu) {
                if (!oMenu && current) oMenu = current;

                if (oMenu && current == oMenu && oMenu.isOpen) {
                        hideCurrent();
                }
        }

        function hideCurrent() {
				if (null != current) {
					cancelHide(current);
					current.hideTimer = null;
					current.hide();
					current = null;
				}
        }
}

//==================================================================================================
// TransMenuItem (internal)
// represents an item in a dropdown
//==================================================================================================
// sText        : The item display text
// sUrl         : URL to load when the item is clicked
// oParent      : Menu this item is a part of
//==================================================================================================
function TransMenuItem(sText, sUrl, oParent, sTarget,active,id,iDirection) {
        this.toString = toString;
        this.text = sText;
        this.url = sUrl;
		 this.target = sTarget;

        this.parentMenu = oParent;

        function toString(bDingbat) {
                var sDingbat = bDingbat ? TransMenu.dingbatOff : TransMenu.spacerGif;
                var iEdgePadding = TransMenu.itemPadding + TransMenu.menuPadding;
                var sPaddingLeft = "padding:" + TransMenu.itemPadding + "px; padding-left:" + iEdgePadding + "px;";
                var sPaddingRight = "padding:" + TransMenu.itemPadding + "px; padding-right:" + iEdgePadding + "px;";
				
				var menustring = '<tr class="item">';
				if(TransMenu.sub_indicator&&((iDirection==TransMenu.direction.left)||(iDirection==TransMenu.direction.dleft))){
                menustring+='<td style="' + sPaddingRight + '">' +
                       '<img src="' + sDingbat + '" ></td>';
                  }
                menustring+= '<td nowrap style="' + sPaddingLeft + '" id="' + id + '">' +
                        sText + '</td>';

                if(TransMenu.sub_indicator&&((iDirection==TransMenu.direction.down)||(iDirection==TransMenu.direction.right)||(iDirection==TransMenu.direction.up))){
                menustring+='<td style="' + sPaddingRight + '">' +
                        '<img src="' + sDingbat + '" ></td>';
                  }
                  menustring+='</tr>';
               return menustring;

        }
}






//=====================================================================
// Accel[erated] [an]imation object
// change a property of an object over time in an accelerated fashion
//=====================================================================
// obj  : reference to the object whose property you'd like to animate
// prop : property you would like to change eg: "left"
// to   : final value of prop
// time : time the animation should take to run
// zip	: optional. specify the zippiness of the acceleration. pick a
//		  number between -1 and 1 where -1 is full decelerated, 1 is
//		  full accelerated, and 0 is linear (no acceleration). default
//		  is 0.
// unit	: optional. specify the units for use with prop. default is
//		  "px".
//=====================================================================
// bezier functions lifted from the lib_animation.js file in the
// 13th Parallel API. www.13thparallel.org
//=====================================================================

function Accelimation(from, to, time, zip) {
	if (typeof zip  == "undefined") zip  = 0;
	if (typeof unit == "undefined") unit = "px";

        this.x0         = from;
        this.x1		= to;
	this.dt		= time;
	this.zip	= -zip;
	this.unit	= unit;
	this.timer	= null;
	this.onend	= new Function();
        this.onframe    = new Function();
}



//=====================================================================
// public methods
//=====================================================================

// after you create an accelimation, you call this to start it-a runnin'
Accelimation.prototype.start = function() {
	this.t0 = new Date().getTime();
	this.t1 = this.t0 + this.dt;
	var dx	= this.x1 - this.x0;
	this.c1 = this.x0 + ((1 + this.zip) * dx / 3);
	this.c2 = this.x0 + ((2 + this.zip) * dx / 3);
	Accelimation._add(this);
};

// and if you need to stop it early for some reason...
Accelimation.prototype.stop = function() {
	Accelimation._remove(this);
};



//=====================================================================
// private methods
//=====================================================================

// paints one frame. gets called by Accelimation._paintAll.
Accelimation.prototype._paint = function(time) {
	if (time < this.t1) {
		var elapsed = time - this.t0;
	        this.onframe(Accelimation._getBezier(elapsed/this.dt,this.x0,this.x1,this.c1,this.c2));
        }
	else this._end();
};

// ends the animation
Accelimation.prototype._end = function() {
	Accelimation._remove(this);
        this.onframe(this.x1);
	this.onend();
};




//=====================================================================
// static methods (all private)
//=====================================================================

// add a function to the list of ones to call periodically
Accelimation._add = function(o) {
	var index = this.instances.length;
	this.instances[index] = o;
	// if this is the first one, start the engine
	if (this.instances.length == 1) {
		this.timerID = window.setInterval("Accelimation._paintAll()", this.targetRes);
	}
};

// remove a function from the list
Accelimation._remove = function(o) {
	for (var i = 0; i < this.instances.length; i++) {
		if (o == this.instances[i]) {
			this.instances = this.instances.slice(0,i).concat( this.instances.slice(i+1) );
			break;
		}
	}
	// if that was the last one, stop the engine
	if (this.instances.length == 0) {
		window.clearInterval(this.timerID);
		this.timerID = null;
	}
};

// "engine" - call each function in the list every so often
Accelimation._paintAll = function() {
	var now = new Date().getTime();
	for (var i = 0; i < this.instances.length; i++) {
		this.instances[i]._paint(now);
	}
};


// Bezier functions:
Accelimation._B1 = function(t) { return t*t*t };
Accelimation._B2 = function(t) { return 3*t*t*(1-t) };
Accelimation._B3 = function(t) { return 3*t*(1-t)*(1-t) };
Accelimation._B4 = function(t) { return (1-t)*(1-t)*(1-t) };


//Finds the coordinates of a point at a certain stage through a bezier curve
Accelimation._getBezier = function(percent,startPos,endPos,control1,control2) {
	return endPos * this._B1(percent) + control2 * this._B2(percent) + control1 * this._B3(percent) + startPos * this._B4(percent);
};


//=====================================================================
// static properties
//=====================================================================

Accelimation.instances = [];
Accelimation.targetRes = 10;
Accelimation.timerID = null;


//=====================================================================
// IE win memory cleanup
//=====================================================================

if (window.attachEvent) {
	var cearElementProps = [
		'data',
		'onmouseover',
		'onmouseout',
		'onmousedown',
		'onmouseup',
		'ondblclick',
		'onclick',
		'onselectstart',
		'oncontextmenu'
	];

	window.attachEvent("onunload", function() {
        var el;
        for(var d = document.all.length;d--;){
            el = document.all[d];
            for(var c = cearElementProps.length;c--;){
                el[cearElementProps[c]] = null;
            }
        }
	});
}

var WCH_Constructor = function() {
	//	exit point for anything but IE5.0+/Win
	if ( !(document.all && document.getElementById && !window.opera && navigator.userAgent.toLowerCase().indexOf("mac") == -1) ) {
		this.Apply = function() {};
		this.Discard = function() {};
		return;
	}

	//	private properties
	var _bIE55 = false;
	var _bIE6 = false;
	var _oRule = null;
	var _bSetup = true;
	var _oSelf = this;

	//	public: hides windowed controls
	this.Apply = function(vLayer, vContainer, bResize) {
		if (_bSetup) _Setup();

		if ( _bIE55 && (oIframe = _Hider(vLayer, vContainer, bResize)) ) {
			oIframe.style.visibility = "visible";
		} else if(_oRule != null) {
			_oRule.style.visibility = "hidden";
		}

	};

	//	public: shows windowed controls
	this.Discard = function(vLayer, vContainer) {
		if ( _bIE55 && (oIframe = _Hider(vLayer, vContainer, false)) ) {
			oIframe.style.visibility = "hidden";
		} else if(_oRule != null) {
			_oRule.style.visibility = "visible";
		}
	};

	//	private: returns iFrame reference for IE5.5+
	function _Hider(vLayer, vContainer, bResize) {
		var oLayer = _GetObj(vLayer);
		var oContainer = ( (oTmp = _GetObj(vContainer)) ? oTmp : document.getElementsByTagName("body")[0] );
		if (!oLayer || !oContainer) return;
		//	is it there already?
		var oIframe = document.getElementById("WCHhider" + oLayer.id);

		//	if not, create it
		if ( !oIframe ) {
			//	IE 6 has this property, IE 5 not. IE 5.5(even SP2) crashes when filter is applied, hence the check
			var sFilter = (_bIE6) ? "filter:progid:DXImageTransform.Microsoft.Alpha(style=0,opacity=0);" : "";
			//	get z-index of the object
			var zIndex = oLayer.style.zIndex;
			if ( zIndex == "" ) zIndex = oLayer.currentStyle.zIndex;
			zIndex = parseInt(zIndex);
			//	if no z-index, do nothing
			if ( isNaN(zIndex) ) return null;
			//	if z-index is below 2, do nothing (no room for Hider)
			if (zIndex < 2) return null;
			//	go one step below for Hider
			zIndex--;
			var sHiderID = "WCHhider" + oLayer.id;
			oContainer.insertAdjacentHTML("afterBegin", '<iframe class="WCHiframe" src="javascript:false;" id="' + sHiderID + '" scroll="no" frameborder="0" style="position:absolute;visibility:hidden;' + sFilter + 'border:0;top:0;left;0;width:0;height:0;background-color:#ccc;z-index:' + zIndex + ';"></iframe>');
			oIframe = document.getElementById(sHiderID);
			//	then do calculation
			_SetPos(oIframe, oLayer);
		} else if (bResize) {
			//	resize the iFrame if asked
			_SetPos(oIframe, oLayer);
		}
		return oIframe;
	};

	//	private: set size and position of the Hider
	function _SetPos(oIframe, oLayer) {
		//	fetch and set size
		oIframe.style.width = oLayer.offsetWidth + "px";
		oIframe.style.height = oLayer.offsetHeight + "px";
		//	move to specified position
		oIframe.style.left = oLayer.offsetLeft + "px";
		oIframe.style.top = oLayer.offsetTop + "px";
	};

	//	private: returns object reference
	function _GetObj(vObj) {
		var oObj = null;
		switch( typeof(vObj) ) {
			case "object":
				oObj = vObj;
				break;
			case "string":
				oObj = document.getElementById(vObj);
				break;
		}
		return oObj;
	};

	//	private: setup properties on first call to Apply
	function _Setup() {
		_bIE55 = (typeof(document.body.contentEditable) != "undefined");
		_bIE6 = (typeof(document.compatMode) != "undefined");

		if (!_bIE55) {
			if (document.styleSheets.length == 0)
				document.createStyleSheet();
			var oSheet = document.styleSheets[0];
			oSheet.addRule(".WCHhider", "visibility:visible");
			_oRule = oSheet.rules(oSheet.rules.length-1);
		}

		_bSetup = false;
	};
};
var WCH = new WCH_Constructor();
