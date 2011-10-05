/**
* Bookmark Us - Joomla! Add to Bookmarks Module.
* @ version 1.0
* @ package Bookmark_Us
* @ Released under GNU/GPL License - http://www.gnu.org/copyleft/gpl.htm
* @ copyright (C) 2005 by Michael Carico - All rights reserved
* @ website http://www.kabam.net
**/


function displayLink(p_type, p_url, p_title, p_link_text) {

  var agt = navigator.userAgent.toLowerCase();
  var p_here = top.location.href

  if (p_type == 3)
  {
    if ((agt.indexOf("opera") != -1)) // || (agt.indexOf("firefox") != -1))
    {
      document.write("<a href=\""+p_here+"\" title=\"" + p_title + "\" rel=\"sidebar\">" + p_link_text + "</a>");
    } else
    {
      document.write("<a href=\"javascript:addBookmark('"+p_title+"',top.location.href);\" title=\"" + p_title + "\" >" + p_link_text + "</a>");
    }
  } else
  {
    if (agt.indexOf("opera") != -1) 
    {
      document.write("<a href=\"" + p_url + "\" title=\"" + p_title + "\" rel=\"sidebar\">" + p_link_text + "</a>");
    } else
    {
      document.write("<a href=\"javascript:addBookmark('"+p_title+"','"+p_url+"');\" title=\"" + p_title + "\" >" + p_link_text + "</a>");
    }
  }
}


function addBookmark(title,url) {

  var msg_netscape = "NetScape message";
  var msg_opera    = "This function does not work with this version of Opera.  Please bookmark us manually.";
  var msg_other    = "Your browser does not support automatic bookmarks.  Please bookmark us manually.";
  var agt          = navigator.userAgent.toLowerCase();


  if (agt.indexOf("opera") != -1) 
  {
    if (window.opera && window.print)
    {
      return true;
    } else 
    {
      alert(msg_other);
    }
  }    
  else if (agt.indexOf("firefox") != -1) window.sidebar.addPanel(title,url,"");
  else if ((agt.indexOf("msie") != -1) && (parseInt(navigator.appVersion) >=4)) window.external.AddFavorite(url,title); 
  else if (agt.indexOf("netscape") != -1) window.sidebar.addPanel(title,url,"")         
  else if (window.sidebar && window.sidebar.addPanel) window.sidebar.addPanel(title,url,""); 
  else alert(msg_other);
  
}