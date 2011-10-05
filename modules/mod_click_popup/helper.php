<?php
/**
      Click PopUp Module for Joomla 1.5
      -----------------------------------------------------------------------
      Click PopUp show a link that open a popup with inside text or a module position. 
      Created bt Andrea S. of www.joomlovers.net 
      -----------------------------------------------------------------------
*/

// no direct access
defined('_JEXEC') or die('Restricted access');

require_once (JPATH_SITE.DS.'components'.DS.'com_content'.DS.'helpers'.DS.'route.php');

class modclick_popupHelper {
	function getContent(&$params) {
		$str = $params->get( 'content' );
		return $str;
	}
}
