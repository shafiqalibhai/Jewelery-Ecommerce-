<?php
defined( '_JEXEC' ) or die( 'Direct Access to this location is not allowed.' );

/**
 * Uninstall routine for Joomap.
 * Drops the settings table from the Joomla! database
 * @author Daniel Grothe
 * @see JoomapConfig.php
 * @version $Id: uninstall.joomap.php 12 2008-08-17 20:51:27Z koders.de $
 */
function com_uninstall() {
	require_once JPATH_ADMINISTRATOR.DS.'components'.DS.'com_joomap'.DS.'classes'.DS.'JoomapConfig.php';
	JoomapConfig::backup();
	JoomapConfig::remove();
}

?>