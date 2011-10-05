<?php
/**
*	RecommendFriends Component for Joomla! - for Site Promotion
*
* @version $Id: toolbar.recommendfriends.php - v2.0.3 - January-06-2009 - D-Mack Media
* @package Joomla
* @subpackage RecommendFriends
* @copyright (c) 2007-2010 D-Mack Media, dmackmedia.com
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
*
* This is free software
**/

//defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );
defined( '_JEXEC' ) or die( 'Restricted Access.' );
global $mainframe;
$title='D-Mack Media RecommendFriends';
if ($task) {$title.='&nbsp;&nbsp; <font size="3" color="green">('.$task.')</font>';}
JToolBarHelper::title($title);

switch ( $task ) {
	case "Configuration":
		JToolBarHelper::save( 'SaveSettings' );
		JToolBarHelper::apply( 'SaveSettings' );
		JToolBarHelper::cancel('Configuration');
		break;
	case "Information":
		JToolBarHelper::cancel('Configuration');
		break;
	case "Language":
		JToolBarHelper::save( 'SaveLanguage' );
		JToolBarHelper::apply( 'SaveLanguage' );
		JToolBarHelper::cancel('Configuration');
		break;
	default:
		JToolBarHelper::save( 'SaveSettings' );
		JToolBarHelper::apply( 'SaveSettings' );
		JToolBarHelper::cancel('Configuration');
		break;
}
?>
