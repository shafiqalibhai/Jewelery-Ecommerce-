<?php
/**
* @version 1.2.0
* @package RSform!Pro 1.2.0
* @copyright (C) 2007-2009 www.rsjoomla.com
* @license Commercial License, http://www.rsjoomla.com/terms-and-conditions.html
*/

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

function com_uninstall() {
	
	//Init RS Adapter
	require_once(dirname(__FILE__).'/../../../components/com_rsform/controller/adapter.php');
	require_once(dirname(__FILE__).'/../../../components/com_rsform/controller/functions.php');
	
	$RSadapter = new RSadapter();
	$GLOBALS['RSadapter'] = $RSadapter;

	//require backend language file
	require_once(_RSFORM_FRONTEND_ABS_PATH.'/languages/'._RSFORM_FRONTEND_LANGUAGE.'.php');
	//Remove addons
		//plugin
		//$RSadapter->removePlugin('mosrsform',true);
		
		//modules
		//$RSadapter->removeModule('mod_rsform', true);
		//$RSadapter->removeModule('mod_rsform_list', true);
	
	
	//Remove RSform!Pro tables
	RSparse_mysql_dump(_RSFORM_BACKEND_ABS_PATH.'/tmp/rsform-uninstall.sql');
	
	echo "<b>RSform! Pro "._RSFORM_VERSION." uninstalled</b>";
}

?>