<?php
/**
 * The Joomap component administrator toolbar
 * @author Daniel Grothe
 * @see admin.joomap.php
 * @version $Id: toolbar.joomap.php 14 2008-08-18 15:36:39Z koders.de $
 */

defined( '_JEXEC' ) or die( 'Direct Access to this location is not allowed.' );

// load language file

$lang =& JFactory::getLanguage();
if( file_exists( JPATH_COMPONENT.DS.'language'.DS.$lang->getBackwardLang().'.php') ) {
	require_once JPATH_COMPONENT.DS.'language'.DS.$lang->getBackwardLang().'.php';
} else {
	//echo 'Language file [ '. $lang->getBackwardLang().' ] not found, using default language: english<br />';
	require_once JPATH_COMPONENT.DS.'language'.DS.'/english.php';
}

// load html output class

require_once( $mainframe->getPath( 'toolbar_html' ) );


$act 	= JRequest::getVar('act', '', '', 'string');
if ($act) {
	$task = $act;
}

switch ($task) {
	default:
		$document =& JFactory::getDocument();
		$document->setTitle(_JOOMAP_CFG_COM_TITLE);
		
		JToolBarHelper::title(_JOOMAP_CFG_COM_TITLE, 'generic.png');
		JToolBarHelper::custom('backup', 'archive.png', 'archive_f2.png', "Backup Settings", false);
		JToolBarHelper::custom('restore', 'restore.png', 'restore_f2.png', "Restore Settings", false);
		JToolBarHelper::spacer(20);
		JToolBarHelper::divider();
		JToolBarHelper::spacer(20);
		JToolBarHelper::save( 'save' );
		JToolBarHelper::cancel( 'cancel' );
		break;
}
?>
