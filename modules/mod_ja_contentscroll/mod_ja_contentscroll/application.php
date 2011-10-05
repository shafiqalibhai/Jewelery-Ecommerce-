<?php 
/*------------------------------------------------------------------------
# JA Zeolite for Joomla 1.5 - Version 1.0 - Licence Owner JA108425
# ------------------------------------------------------------------------
# Copyright (C) 2004-2008 J.O.O.M Solutions Co., Ltd. All Rights Reserved.
# @license - Copyrighted Commercial Software
# Author: J.O.O.M Solutions Co., Ltd
# Websites:  http://www.joomlart.com -  http://www.joomlancers.com
# This file may not be redistributed in whole or significant part.
-------------------------------------------------------------------------*/


defined( '_JEXEC' ) or die( 'Restricted access' );

class JA_ContentSlide{

	var $_params = '';
	var $_db = '';
	var $_show_price = 0;
	var $_show_addtocart = 0;
	var $_typeproduct = 0;
	var $_numElem = 0;
	var	$_total = 0;
	var $_listPro = '';
	var $_now 		= '';
	var $_access 	= '';
	var $_nullDate 	='';
	var $_numChar = '';
	var $_link_titles = '';
	var $_width 	 = '';
	var $_height 	 = '';
	var $_showimages  = '';
	//var $_listPro = array();
	////////////

	function JA_ContentSlide($params, $database, $showtitle,$showreadmore,$showintrotext,$link_titles ,$numElem,$numChar,$xwidth,$xheight,$showimages,$link_images){
		global $mainframe;
		$this->_params 			= 	$params;
		$this->_db 				= 	$database;
		$this->_showtitle 		= 	$showtitle;
		$this->_showreadmore	= 	$showreadmore; 	
		$this->_showintrotext 	= 	$showintrotext; 
		$this->_link_titles 	= 	$link_titles; 		
		$this->_link_images 	= 	$link_images; 		
		$this->_numElem 		= 	$numElem;
		$this->_numChar 		= 	$numChar;
		$this->_width 			= 	$xwidth;
		$this->_height 			= 	$xheight;
		$this->_showimages 		= 	$showimages;

		$this->_now 			= date( 'Y-m-d H:i' );
		$this->_access 			= !$mainframe->getCfg( 'shownoauth' );
		$this->_nullDate 		= $this->_db->getNullDate();
		
		$this->_params->set( 'image', 		1 );
		$this->_params->set( 'intro_only', 		1 );
		$this->_params->set( 'hide_author', 		1 );
		$this->_params->set( 'hide_createdate', 	0 );
		$this->_params->set( 'hide_modifydate', 	1 );
		$this->_params->set( 'link_titles', 		1 );

	}
	
	function getTotal($catid,$showimages){
		$my = &JFactory::getUser();
		$aid=$my->get('aid',0);
		$where = ($showimages && !$this->_showtitle && !$this->_showreadmore && !$this->_showintrotext) ? " AND a.introtext LIKE '%{mosimage}%'" : "";

		$query 	= 	" SELECT COUNT(a.id)"
					. "\n FROM #__content AS a"
					. "\n WHERE a.state = 1".$where
					. "\n AND ( a.publish_up = " . $this->_db->Quote( $this->_nullDate ) . " OR a.publish_up <= " . $this->_db->Quote( $this->_now ) . " )"
					. "\n AND ( a.publish_down = " . $this->_db->Quote( $this->_nullDate ) . " OR a.publish_down >= " . $this->_db->Quote( $this->_now ) . " )"
					. ( $this->_access ? "\n AND a.access <= " . (int) $aid : '' )
					;
		if($catid) $query .= ' AND a.catid IN ('.$catid.') ';
		$this->_db->setQuery($query);
		$this->_total = $this->_db->loadResult();
		return $this->_total;
	}

	function loadContents($catid,$start=0,$numberE=1,$useajax = 1, $showimages = 0){
		$my = &JFactory::getUser();
		$aid=$my->get('aid',0);
		$where = ($showimages && !$this->_showtitle && !$this->_showreadmore && !$this->_showintrotext) ? " AND a.introtext LIKE '%{mosimage}%'" : "";
		$query 	= 	'SELECT a.*,cc.description as catdesc, cc.title as cattitle,s.description as secdesc, s.title as sectitle,' .
			' CASE WHEN CHAR_LENGTH(a.alias) THEN CONCAT_WS(":", a.id, a.alias) ELSE a.id END as slug,'.
			' CASE WHEN CHAR_LENGTH(cc.alias) THEN CONCAT_WS(":",cc.id,cc.alias) ELSE cc.id END as catslug,'.
			' CASE WHEN CHAR_LENGTH(s.alias) THEN CONCAT_WS(":", s.id, s.alias) ELSE s.id END as secslug'.
					' FROM #__content AS a' .
					' INNER JOIN #__categories AS cc ON cc.id = a.catid' .
					' INNER JOIN #__sections AS s ON s.id = a.sectionid'
					
					. "\n WHERE a.state = 1".$where
					. "\n AND ( a.publish_up = " . $this->_db->Quote( $this->_nullDate ) . " OR a.publish_up <= " . $this->_db->Quote( $this->_now ) . " )"
					. "\n AND ( a.publish_down = " . $this->_db->Quote( $this->_nullDate ) . " OR a.publish_down >= " . $this->_db->Quote( $this->_now ) . " )"
					. ( $this->_access ? "\n AND a.access <= " . (int) $aid : '' )
					;
		if($catid) $query .= ' AND a.catid IN ('.$catid.') ';
		if($useajax) $query .=  ' LIMIT '.$start.','.$numberE;
        
		$this->_db->setQuery($query);
		
		return $this->_listPro = $this->_db->loadObjectlist();
	}

	function genHTML($catid, $start = 0 ,$numElem = 4,$useajax , $showimages, $autoresize , $el_style){		
		$mainframe =& JFactory::getApplication('site');
		//JPluginHelper::importPlugin( 'content' );

		$contents = $this->loadContents($catid,$start,$numElem,$useajax);
		$i=0;
		foreach($contents as $contn){
			echo "<div class=\"content_element\" style=\"float:left; ".$el_style." \">";

				// get Itemid
				$Itemid =  $mainframe->getItemid( $contn->id );
				// Blank itemid checker for SEF
				if ($Itemid == NULL) {
					$Itemid = '';
				} else {
					$Itemid = '&Itemid='. $Itemid;
				}
				
				$link   = JRoute::_(ContentHelperRoute::getArticleRoute($contn->slug, $contn->catslug, $contn->sectionid));
				if($this->_showtitle) {
					echo "<div class=\"ja_slidetitle\">";
					echo ($this->_link_titles) ? '<a href="'.$link.'">'.$contn->title.'</a>' : $contn->title;
					echo "</div>";
				}


				$contn->text 	= $contn->introtext;
				$mainframe->triggerEvent( 'onPrepareContent', array( &$contn, &$this->_params, 0 ) , true );
				$contn->introtext = $contn->text;
				$image = $this->replaceImage ($contn, $this->_numChar,$this->_showimages, $this->_width, $this->_height,$autoresize);////////////////

				if($this->_showimages) {
				echo "<div class=\"ja_slideimages clearfix\">";
					echo ($this->_link_images) ? '<a href="'.$link.'" title="'.$contn->title.'">'.$image.'</a>' : $image;
				echo "</div>";
				}
				if($this->_showintrotext) {
				echo "<div class=\"ja_slideintro\">";
					echo ($this->_numChar) ? $contn->introtext1 : $contn->introtext;
				echo "</div>";
				}

				if($this->_showreadmore) {
				echo "<div class=\"ja-slidereadmore\">";
					echo '<a href="'.$link.'" class="readon">'.JText::_('Read more...').'</a>';
				echo "</div>";
				}
			echo "</div>";
			$i++;
		}
	}
	function replaceImage( &$row, $maxchars, $showimage, $width = 0, $height = 0 ,$autoresize) {
		//global $database, $_MAMBOTS, $current_charset;

		// expression to search for
			//$regex = "/\<img.*\/\>/";
		$regex = "/\<img\s*src\s*=\s*\"([^\"]*)\"[^\>]*\>/";
		preg_match ($regex, $row->introtext, $matches);
		$images = (count($matches)) ? $matches : array();
		$image = ($showimage && count($images))? $this->processImage ( $images, $width, $height ,$autoresize):"";
		if ($autoresize) {
			if ($image) {				
				$image = "<img src=\"$image\" alt=\"{$row->title}\" />";
			}
			$regex1 = "/\<img.*\/\>/";
			$row->introtext = trim($row->introtext);
			$row->introtext = preg_replace( $regex1, '', $row->introtext );
		} else {
			$regex = "/\<img.*\/\>/";
			preg_match ($regex, $row->introtext, $matches);
			$row->introtext = trim($row->introtext);
			$row->introtext = preg_replace ($regex, '', $row->introtext);

			$image = $showimage && count($matches)?$matches[0]:"";
			if (count($images)) {
				$image = "<img src=\"".$images[1]."\" alt=\"{$row->title}\" width=\"$width\"  heigh=\"$height\" />";
			}
		}

		$row->introtext1 = strip_tags($row->introtext);
		if ($maxchars && strlen ($row->introtext) > $maxchars) {
			$row->introtext1 = substr ($row->introtext1, 0, $maxchars) . "...";
		}
		// clean up globals
		return $image;
	}

	function processImage ( &$image, $width, $height ) {
		/* for 1.5 - don't need to use image parameter */
		if(!count($image)) return;
			$img = $image[1] ;
			$imagesurl = (file_exists(JPATH_SITE .'/'.$img)) ? $this->jaResize($img,$width,$height) :  $img ;
			return $imagesurl;
		/* End 1.5 */
	}

	function jaResize($image,$max_width,$max_height){
		$path = JPATH_SITE;
			$sizeThumb = getimagesize(JPATH_SITE.'/'.$image);
			$width = $sizeThumb[0];
			$height = $sizeThumb[1];
			
			$x_ratio = $max_width / $width;
			$y_ratio = $max_height / $height;
			
			if (($width <= $max_width) && ($height <= $max_height) ) {
				$tn_width = $width;
				$tn_height = $height;
			} else if (($x_ratio * $height) < $max_height) {
				$tn_height = ceil($x_ratio * $height);
				$tn_width = $max_width;
			} else {
				$tn_width = ceil($y_ratio * $width);
				$tn_height = $max_height;
			}
			if(file_exists($path.'/images/resized/'.$image)){
				$smallImg = getimagesize(JPATH_SITE.'/images/resized/'.$image);
				if ($smallImg[0] <= $smallImg[1] && $smallImg[1] != $max_height) {
				} else if ($smallImg[1] <= $smallImg[0] && $smallImg[0] != $max_width) {
				} else {
						return "images/resized/".$image;
				}
			}
			if(!file_exists($path.'/images/resized/')) mkdir($path.'/images/resized/',0755);
			$folders = explode('/',$image);
			$tmppath = $path.'/images/resized/';
			for($i=0;$i < count($folders)-1; $i++){
				if(!file_exists($tmppath.$folders[$i])) mkdir($tmppath.$folders[$i],0755);
				$tmppath = $tmppath.$folders[$i].'/';
			}
			$resized = $path.'/images/resized/'.$image;
			// read image
			$ext = strtolower(substr(strrchr($image, '.'), 1)); // get the file extension
			switch ($ext) { 
				case 'jpg':     // jpg
					$src = imagecreatefromjpeg(JPATH_SITE.'/'.$image);
					break;
				case 'png':     // png
					$src = imagecreatefrompng(JPATH_SITE.'/'.$image);
					break;
				case 'gif':     // gif
					$src = imagecreatefromgif(JPATH_SITE.'/'.$image);
					break;
				default:
			}
			
			$dst = imagecreatetruecolor($tn_width,$tn_height);
			if (function_exists('imageantialias')) imageantialias ($dst, true);
			imagecopyresampled ($dst, $src, 0, 0, 0, 0, $tn_width, $tn_height, $width, $height);
			imagejpeg($dst, $resized, 90); // write the thumbnail to cache as well...
			return "images/resized/".$image;		
	}
		
}
?>
