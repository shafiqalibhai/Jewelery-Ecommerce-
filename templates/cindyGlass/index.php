<?php
/**
 * @copyright	Copyright (C) 2009 Cindy Lackore All rights reserved.
 * @license		commercial
 */
defined('_JEXEC') or die('Restricted access');
?>

<?php echo '<?xml version="1.0" encoding="utf-8"?'.'>'; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $this->language; ?>" lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>" >
<head>

 <meta http-equiv="content-type" content="text/html; charset=utf-8" />
  <meta name="robots" content="index, follow" />
  <meta name="keywords" content="CindyLackore.com" />
  <meta name="description" content="CindyLackore.com" />
  <meta name="generator" content="" />
  <title>CindyLackore.com</title>

  <style type="text/css">


			#tcscroller{
				width: 143px;
				height: 113px;
				border: 1px solid #020202;
				padding: 5px;
				background-color: #000000;
			}
  </style>
  <script type="text/javascript" src="/includes/js/joomla.javascript.js"></script>
  <script type="text/javascript" src="/media/system/js/mootools.js"></script>
  <script type="text/javascript" src="/media/system/js/caption.js"></script>
  <script type="text/javascript" src="http://www.cindylackore.com/modules/mod_tcnewsscroller/js/tcscroller.js"></script>
  <script type="text/javascript">
      window.addEvent('load', function(){ var JTooltips = new Tips($$('.hasTip'), { maxTitleChars: 50, fixed: false}); });
  </script>
<script type="text/javascript">var cart_title = "Cart";var ok_lbl="Continue";var cancel_lbl="Cancel";var notice_lbl="Notice";var live_site="http://www.cindylackore.com";</script>
<link rel="stylesheet" href="/media/system/css/calendar-jos.css" type="text/css"  title="Green"  media="all" />
<link rel="stylesheet" href="/media/system/css/modal.css" type="text/css" />
<link rel="stylesheet" href="/components/com_rsform/front.css" type="text/css" />
<script type="text/javascript" src="/components/com_rsform/controller/functions.js"></script>
<script type="text/javascript" src="/media/system/js/modal.js"></script>
<script type="text/javascript" src="/modules/mod_rokslideshow/tmpl/slideshow.js"></script>

<script type="text/javascript">

      window.addEvent('load', function(){ var JTooltips = new Tips($$('.hasTip'), { maxTitleChars: 50, fixed: false}); });

  </script>
<script type="text/javascript">
Calendar._DN = new Array ("Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday");Calendar._SDN = new Array ("Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat", "Sun"); Calendar._FD = 0;	Calendar._MN = new Array ("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");	Calendar._SMN = new Array ("Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec");Calendar._TT = {};Calendar._TT["INFO"] = "About the Calendar";
 		Calendar._TT["ABOUT"] =
 "DHTML Date/Time Selector\n" +
 "(c) dynarch.com 2002-2005 / Author: Mihai Bazon\n" +
"For latest version visit: http://www.dynarch.com/projects/calendar/\n" +
"Distributed under GNU LGPL.  See http://gnu.org/licenses/lgpl.html for details." +
"\n\n" +
"Date selection:\n" +
"- Use the \xab, \xbb buttons to select year\n" +
"- Use the " + String.fromCharCode(0x2039) + ", " + String.fromCharCode(0x203a) + " buttons to select month\n" +
"- Hold mouse button on any of the above buttons for faster selection.";
Calendar._TT["ABOUT_TIME"] = "\n\n" +
"Time selection:\n" +
"- Click on any of the time parts to increase it\n" +
"- or Shift-click to decrease it\n" +
"- or click and drag for faster selection.";

		Calendar._TT["PREV_YEAR"] = "Click to move to the previous year. Click and hold for a list of years.";Calendar._TT["PREV_MONTH"] = "Click to move to the previous month. Click and hold for a list of the months.";	Calendar._TT["GO_TODAY"] = "Go to today";Calendar._TT["NEXT_MONTH"] = "Click to move to the next month. Click and hold for a list of the months.";Calendar._TT["NEXT_YEAR"] = "Click to move to the next year. Click and hold for a list of years.";Calendar._TT["SEL_DATE"] = "Select a date";Calendar._TT["DRAG_TO_MOVE"] = "Drag to move";Calendar._TT["PART_TODAY"] = " (Today)";Calendar._TT["DAY_FIRST"] = "Display %s first";Calendar._TT["WEEKEND"] = "0,6";Calendar._TT["CLOSE"] = "Close";Calendar._TT["TODAY"] = "Today";Calendar._TT["TIME_PART"] = "(Shift-)Click or Drag to change the value.";Calendar._TT["DEF_DATE_FORMAT"] = "%Y-%M-%D"; Calendar._TT["TT_DATE_FORMAT"] = "%A, %B %e";Calendar._TT["WK"] = "wk";Calendar._TT["TIME"] = "Time:";
		window.addEvent('domready', function() {

			SqueezeBox.initialize({});

			$$('a.modal-button').each(function(el) {
				el.addEvent('click', function(e) {
					new Event(e).stop();
					SqueezeBox.fromElement(el);
				});
			});
		});
function DisplayEditortext() {
			var oFCKeditor = new FCKeditor("text");
			oFCKeditor.BasePath = "http://www.cindylackore.com/plugins/editors/fckeditor/" ;
			oFCKeditor.Config["SitePath"] =  "http://www.cindylackore.com";
			oFCKeditor.Config["ImagePath"] =  "images/stories"; 
			oFCKeditor.Config["UseRelativeURLPath"] =  "0"; 
			oFCKeditor.ToolbarSet = "Advanced" ;
      		oFCKeditor.Config["EnterMode"] = "p";
      		oFCKeditor.Config["ShiftEnterMode"] = "br";
			oFCKeditor.Config["CrtlShiftEnterMode"] = "div";
      		oFCKeditor.Config["BaseAddCSSPath"] = "/templates/cindyGlass/css/";
			oFCKeditor.Config["EditorAreaCSS"] = "http://www.cindylackore.com/plugins/editors/fckeditor/editor/css/fck_editorarea.css";
			oFCKeditor.Config["ContentLangDirection"] = "ltr" ;
			oFCKeditor.Config["AutoDetectLanguage"]  ="0";
			oFCKeditor.Config["DefaultLanguage"] = "en" ;
			oFCKeditor.Config["ProcessHTMLEntities"] = true ;
			oFCKeditor.Config["IncludeLatinEntities"] = false ;
			oFCKeditor.Config["IncludeGreekEntities"] = false ;
			oFCKeditor.Config["ProcessNumericEntities"] = false ;
			oFCKeditor.Config["SkinPath"] = oFCKeditor.BasePath + "editor/skins/" + "office2007" + "/" ;
			oFCKeditor.Config["StylesXmlPath"]=  oFCKeditor.BasePath + "fckstyles_template.xml";
			oFCKeditor.Config["AddStylesheets"] = "";
			oFCKeditor.Config["BackgroundColor"] = "#FFFFFF";
			oFCKeditor.Config["FontColor"] = "";		
			oFCKeditor.Config["Pspell"] = "1";	
			oFCKeditor.Config["ForceInlineStyles"] = 0;
			oFCKeditor.Config["JTemplate"] = "cindyGlass";
            oFCKeditor.Config["BodyStyles"] = "";
			oFCKeditor.Config["TextAlign"] = "";	
			oFCKeditor.Config["UseAspell"] = 1;
			oFCKeditor.Width = "100%" ;
		/*	oFCKeditor.Style_css ="fckstyles_template.xml" ; */
			oFCKeditor.Height = "480" ;
			function ReplaceTextHeader()
			{
				oFCKeditor.ReplaceTextarea();
			}
				
			function RenderEditor() 
			{
			 
			  if(navigator.userAgent.indexOf("MSIE") >= 0)
			  {

			  	window.addEvent('domready',ReplaceTextHeader);
			  }
			  else
			  {
			  	 ReplaceTextHeader();
			  }	
			}
			
			/* oFCKeditor.ReplaceTextarea();*/
			RenderEditor();}
function jInsertEditorText( text,editor ) {
				var oEditor = FCKeditorAPI.GetInstance(editor) ;
				text = text.replace( /<img src="/, '<img src="http://www.cindylackore.com/' );
				oEditor.InsertHtml( text );
		}
		window.addEvent('domready', function() {

			SqueezeBox.initialize({});

			$$('a.modal').each(function(el) {
				el.addEvent('click', function(e) {
					new Event(e).stop();
					SqueezeBox.fromElement(el);
				});
			});
		});
			function insertReadmore(editor) {
				var content =  FCKeditorAPI.GetInstance('text').GetHTML(); 
				if (content.match(/<hr\s+id=("|')system-readmore("|')\s*\/*>/i)) {
					alert('Already exists');
					return false;
				} else {
					jInsertEditorText('<hr id="system-readmore" />', editor);
				}
			}
			
window.addEvent('domready', function() {Calendar.setup({
        inputField     :    "publish_up",     // id of the input field
        ifFormat       :    "%Y-%m-%d %H:%M:%S",      // format of the input field
        button         :    "publish_up_img",  // trigger for the calendar (button ID)
        align          :    "Tl",           // alignment (defaults to "Bl")
        singleClick    :    true
    });});
window.addEvent('domready', function() {Calendar.setup({
        inputField     :    "publish_down",     // id of the input field
        ifFormat       :    "%Y-%m-%d %H:%M:%S",      // format of the input field
        button         :    "publish_down_img",  // trigger for the calendar (button ID)
        align          :    "Tl",           // alignment (defaults to "Bl")
        singleClick    :    true
    });});
function keepAlive( ) {	var myAjax = new Ajax( "index.php", { method: "get" } ).request();} window.addEvent("domready", function(){ keepAlive.periodical(59880000 ); });
  </script>
  <script type="text/javascript" src="http://www.cindylackore.com/plugins/editors/fckeditor/fckeditor.js"></script>



<script type="text/javascript" src="<?php echo $this->baseurl ?>/templates/cindyGlass/jquery.js"></script>
<script>



jQuery.noConflict();

</script>
<script>



function bookmark(url,title){

  if ((navigator.appName == "Microsoft Internet Explorer") && (parseInt(navigator.appVersion) >= 4)) {

  window.external.AddFavorite(url,title);

  } else if (navigator.appName == "Netscape") {

    window.sidebar.addPanel(title,url,"");

  } else {

    alert("Press CTRL-D (Netscape) or CTRL-T (Opera) to bookmark");

  }

}

$(function(){
//alert("test");

$(".item13").html("<a href=\"javascript:void(0);\" ><span>Bookmark This Page</span></a>");

debugger;

$(".mainlevel")[1].click(function(){ bookmark('http://www.cindylackore.com','Cindy'); });

//onclick='bookmark(\'http://www.cindylackore.com\',\'Cindy\');'
});



</script>
<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/cindyGlass/css/all.css" type="text/css" />
</head>
<body>
<div id="main">
  <div id="header">
    <h1 class="logo"><a href="index.php">CindyLackore</a></h1>
    <div class="acoount-info" width="100%">
      <div class="items" style="float:left;">
      <!-- topright starts here -->
		<jdoc:include type="modules" name="topright" />
	  <!-- top right ends here -->
	  </div>
      <div class="items" style="float:right; padding-top: 10px; padding-left: 25px;">
	  <!-- top right 2 starts here -->
		<jdoc:include type="modules" name="topright2" />
	  <!-- top right 2 ends here -->
	  </div>





    </div>
    <div id="menu">
      <!-- top menu starts here -->
      <jdoc:include type="modules" name="topmenu" />
      <!-- top menu ends here -->
    </div>
  </div>
  <div id="content">
    <div class="content-text">
      <div class="flash-holder">
        <!-- flash holder starts here -->
        <jdoc:include type="modules" name="slideshow" />
        <!-- flash holder ends here -->
      </div>

<div class="text">
        <!-- messages start here -->
        <jdoc:include type="message" />
        <!-- messages end here -->
        <!-- component starts here -->
        <jdoc:include type="component" />
        <!-- component ends here -->

      </div>
      <div class="img-gallery">
<?php if($_GET[page] != "shop.product_details") {
?>
        <!-- below component starts here -->
        <jdoc:include type="modules" name="belowcomponent" />
        <!-- below component ends here -->
<?php } ?>

      </div>
    </div>
    <div class="left-col">
      <div class="search-hold">
        <div class="search-field">
          <!-- search starts here -->
          <jdoc:include type="modules" name="search" />
          <!-- search ends here -->
        </div>
        <div>
          <!-- kept static for now ... will change after functionality of the component is accomplished -->
          <a href="#">Search by Color and Price</a> </div>
      </div>
      <div id="nav">
        <h5>BROWSE</h5>
        <!-- left starts here -->
        <jdoc:include type="modules" name="virtueleftmenu" />
        <!-- left ends here -->
      </div>
      <div class="text-block">
        <div class="hold">
          <!-- news scroller starts here -->
          <jdoc:include type="modules" name="newsscroller" />
          <!-- news scroller ends here -->
        </div>
      </div>
    </div>
    <div style="clear:both"></div>
  </div>
  <div id="footer">
    <div class="nav">
      <!-- bottom menu starts here -->
      <jdoc:include type="modules" name="bottommenu" />
      <!-- bottom menu ends here -->
    </div>
    <ul class="card-list">
      <li><a href=""><img src="/images/1.gif" alt="" /></a></li>
    </ul>
    <div class="copyright">
      <!-- copyright starts here -->
      <jdoc:include type="modules" name="copyright" />
      <!-- copyright ends here -->
      Copyright 2009 Cindy Lackore All rights reserved
      <!-- debug starts here -->
      <jdoc:include type="modules" name="debug" />
      <!-- debug ends here -->
    </div>
  </div>
  <div class="border-images"> <a href="" class="btn-crab"><span>crab</span></a> <a href="" class="btn-cicada"><span>cicada</span></a> <a href="" class="btn-dragonfly"><span>dragonfly</span></a> <a href="" class="btn-octopus"><span>octopus</span></a> <a href="" class="btn-frog"><span>frog</span></a> <a href="" class="btn-bird"><span>bird</span></a> <a href="" class="btn-oyster"><span>oyster</span></a> <a href="" class="btn-fish"><span>fish</span></a> <a href="" class="btn-rooster"><span>rooster</span></a> <a href="" class="btn-fairy"><span>fairy</span></a> <a href="" class="btn-conch"><span>conch</span></a> <a href="" class="btn-bee"><span>bee</span></a> <a href="" class="btn-turtle"><span>turtle</span></a> <a href="" class="btn-mermaid"><span>mermaid</span></a> <a href="" class="btn-bug"><span>bug</span></a> <a href="" class="btn-nest"><span>nest</span></a> </div>
</div>
</body>
</html>
