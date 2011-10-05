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
require_once (dirname(__FILE__).DS.'helper.php');

$str = modclick_popupHelper::getContent($params);
$document =& JFactory::getDocument();
$document->addScript( JURI::base() . 'modules/mod_click_popup/js/popupDiv.js' );
require(JModuleHelper::getLayoutPath('mod_click_popup'));
?>
