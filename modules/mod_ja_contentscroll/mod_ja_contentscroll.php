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
require_once(JPATH_SITE.'/modules/mod_ja_contentscroll/mod_ja_contentscroll/application.php');

$xheight 		= 	$params->get('xheight',400);
$xwidth 		= 	$params->get('xwidth',400);
$iheight 		= 	$params->get('iheight',80);
$iwidth 		= 	$params->get('iwidth',80);
$numElem 		= 	$params->get('numElem',4);
$catid 			= 	$params->get('catid','');
$showtitle	 	= 	$params->get('showtitle',0);
$showimages 	= 	$params->get('showimages',0);
$showreadmore 	= 	$params->get('showreadmore',0);
$showintrotext 	= 	$params->get('showintrotext',0);
$link_titles 	= 	$params->get('link_titles',0);
$link_images 	= 	$params->get('link_images',0);
$numChar 		= 	$params->get('numchar',0);
$autoresize 	= 	$params->get('autoresize',0);
$addstyle	 	= 	$params->get('addstyle',0);

$mootools 		= 	$params->get('mootools',1);

$total  		= 	JArrayHelper::getValue($_REQUEST,'total',0);
$database		= 	&JFactory::getDBO();

if($catid)	$catid = "'".implode("','",explode(',',$catid))."'";

$el_style = "width:{$xwidth}px;height:{$xheight}px;";
$jactslide = new JA_ContentSlide($params, $database, $showtitle,$showreadmore,$showintrotext,$link_titles,$numElem,$numChar,$iwidth,$iheight,$showimages,$link_images);
if(!$total) $total = $jactslide->getTotal($catid,$showimages);
if($total){
	if($total > $numElem){
		$containerWidth = $numElem;
		$navDisplay = "";
	}else{
		$containerWidth = $total;
		$navDisplay = " display:none;";	
	}
	$ja_modid = $module->id;
	//Insert link to head (onece)
	//if($addstyle) JHTML::stylesheet('ja.contentscroll.css', $path = 'modules/mod_ja_contentscroll/mod_ja_contentscroll/');
	$filename = JPATH_SITE.DS.'templates/'.$mainframe->getTemplate().'/css/ja.contentscroll.css';
	$css_path = JURI::base().'templates/'.$mainframe->getTemplate().'/css/';
	if(!file_exists($filename)){
		$css_path = JURI::base().'modules/mod_ja_contentscroll/mod_ja_contentscroll/';
	}
	JHTML::stylesheet('ja.contentscroll.css', $css_path);
	JHTML::_('behavior.mootools');			
	?>

	<script type="text/javascript" src="<?php echo JURI::base(); ?>/modules/mod_ja_contentscroll/mod_ja_contentscroll/ja.contentscroll.js"></script>
	
	<div id="ja-contentslider" class="clearfix" >
	<div id="ja-contentslider-center" style="width: <?php echo $containerWidth*$xwidth;?>px;height: <?php echo $xheight;?>px;">
	<div style="display:block;width:<?php echo $total*$xwidth;?>px;height:<?php echo $xheight;?>px;">
	<?php $jactslide->genHTML($catid,0,$total,0,$showimages,$autoresize, $el_style ); ?>
	</div>
	</div>
	<div id="ja-contentslider-nav" style="width: <?php echo $containerWidth*$xwidth;?>px; <?php echo $navDisplay; ?>">
		<div id="ja-contentslider-nav-left"></div>
		<div id="ja-contentslider-nav-slider">
			<div id="ja-contentslider-nav-knob"></div>
		</div>
		<div id="ja-contentslider-nav-right"></div>
	</div>
	</div>

	<?php
}
else{
	echo '<div id="ja-contentslide-error">JA Content Slide Error: There is not any content in this category </div>';
}
?>

