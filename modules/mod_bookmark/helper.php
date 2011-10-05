<?php

class modBookmarksHelper
{
	function getMessage( $params )
	{
		global $mainframe;
		
		$bus_format            = $params->def('bus_format','1');
		$bus_display_image     = $params->def('bus_display_image','1');
		$bus_sidebar           = $params->def('bus_sidebar','0');
		$bus_site              = $params->def('bus_site','1');
		$bus_site_def_image    = $params->def('bus_site_def_image','0');
		$bus_site_image        = $params->def('bus_site_image','mnotes.gif');
		$bus_page              = $params->def('bus_page','1');
		$bus_page_def_image    = $params->def('bus_page_def_image','1');
		$bus_page_image        = $params->def('bus_page_image','bookmark_page.gif');
		$bus_break_line        = $params->def('bus_break_line','1');
		$bus_b1                = $params->def('bus_b1','1');
		$bus_b1_def_image      = $params->def('bus_b1_def_image','1');
		$bus_b1_image          = $params->def('bus_b1_image','bookmark_page.gif');
		$bus_b1_text           = $params->def('bus_b1_text','Bookmark 1');
		$bus_b1_title          = $params->def('bus_b1_title','Bookmark 1');
		$bus_b1_url            = $params->def('bus_b1_url','#');
		$bus_b2                = $params->def('bus_b2','1');
		$bus_b2_def_image      = $params->def('bus_b2_def_image','1');
		$bus_b2_image          = $params->def('bus_b2_image','bookmark_page.gif');
		$bus_b2_text           = $params->def('bus_b2_text','Bookmark 2');
		$bus_b2_title          = $params->def('bus_b2_title','Bookmark 2');
		$bus_b2_url            = $params->def('bus_b2_url','#');
		$bus_b3                = $params->def('bus_b3','1');
		$bus_b3_def_image      = $params->def('bus_b3_def_image','1');
		$bus_b3_image          = $params->def('bus_b3_image','bookmark_page.gif');
		$bus_b3_text           = $params->def('bus_b3_text','Bookmark 3');
		$bus_b3_title          = $params->def('bus_b3_title','Bookmark 3');
		$bus_b3_url            = $params->def('bus_b3_url','#');
		
		$mes="<script language=\"JavaScript\" type= \"text/javascript\" src=\"modules/mod_bookmark/bookmark_us.js\"></script>";
					
		if ($bus_format == '1')
  		{
    		if ($bus_site) $mes.=modBookmarksHelper::bus_display_link('1',$bus_display_image,$bus_site_def_image,$bus_site_image,$mainframe->getCfg( 'sitename' ),$mainframe->getCfg( 'live_site' ),"Bookmark Website");
    		if ($bus_page) $mes.=modBookmarksHelper::bus_display_link('3',$bus_display_image,$bus_page_def_image,$bus_page_image,$mainframe->getPageTitle(),"","Bookmark Page");


    		if ($bus_break_line) $mes.="<hr />";

    		if ($bus_b1) $mes.=modBookmarksHelper::bus_display_link('2',$bus_display_image,$bus_b1_def_image,$bus_b1_image,$bus_b1_title,$bus_b1_url,$bus_b1_text);
    		if ($bus_b2) $mes.=modBookmarksHelper::bus_display_link('2',$bus_display_image,$bus_b2_def_image,$bus_b2_image,$bus_b2_title,$bus_b2_url,$bus_b2_text);
    		if ($bus_b3) $mes.=modBookmarksHelper::bus_display_link('2',$bus_display_image,$bus_b3_def_image,$bus_b3_image,$bus_b3_title,$bus_b3_url,$bus_b3_text);
  		}	
		if ($bus_format == '2')
  		{
    		if ($bus_site) $mes.=modBookmarksHelper::bus_display_link('1',$bus_display_image,$bus_site_def_image,$bus_site_image,$mainframe->getCfg( 'sitename' ),$mainframe->getCfg( 'live_site' ),"Bookmark Website");
    		if ($bus_b1) $mes.=modBookmarksHelper::bus_display_link('2',$bus_display_image,$bus_b1_def_image,$bus_b1_image,$bus_b1_title,$bus_b1_url,$bus_b1_text);
    		if ($bus_b2) $mes.=modBookmarksHelper::bus_display_link('2',$bus_display_image,$bus_b2_def_image,$bus_b2_image,$bus_b2_title,$bus_b2_url,$bus_b2_text);
    		if ($bus_b3) $mes.=modBookmarksHelper::bus_display_link('2',$bus_display_image,$bus_b3_def_image,$bus_b3_image,$bus_b3_title,$bus_b3_url,$bus_b3_text);

    		if ($bus_break_line) $mes.="<hr />";

    		if ($bus_page) $mes.=modBookmarksHelper::bus_display_link('3',$bus_display_image,$bus_page_def_image,$bus_page_image,$mainframe->getPageTitle(),"","Bookmark Page");

  		}	
		return $mes;
	}
	
	function bus_display_link($p_type, $p_display_image,$p_def_image,$p_image,$p_title,$p_url,$p_link_text) {
		global $mainframe;
		$text=" ";
 		 if ($p_display_image)
  		 { 
    		if ($p_def_image) 
    		{
      			if ($p_type == '1')
      			{
        			$p_image = "modules/mod_bookmark/bookmark_site.gif";
      			} else
      			{
        			$p_image = "modules/mod_bookmark/bookmark_page.gif";
      			}
    		} else
    		{
      		$p_image = "modules/mod_bookmark/".$p_image;
    		}
    		$text= "<img src=\"".$p_image."\" align=\"absmiddle\" alt=\"\" />";
    	$text.="&nbsp;";
  		}
  		$text.="<script type=\"text/javascript\"> displayLink(\"".$p_type."\",\"".$p_url."\",\"".$p_title."\",\"".$p_link_text."\"); </script>";

  		$text.="<br />";
		return $text;
	}
	
	
	
}

?>