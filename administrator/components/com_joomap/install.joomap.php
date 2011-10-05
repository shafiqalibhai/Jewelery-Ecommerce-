<?php
/**
 * Installation routine for Joomap.
 * Creates the settings table in the Joomla! database
 * @author Daniel Grothe
 * @see JoomapConfig.php
 * @version $Id: install.joomap.php 13 2008-08-18 14:41:01Z koders.de $
 */

defined( '_JEXEC' ) or die( 'Error while executing install file: Direct Access to this location is not allowed.' );
 
// load language file
$pathLangFile	= JPATH_ADMINISTRATOR.DS.'components'.DS.'com_joomap'.DS.'language'.DS;
$lang			=& JFactory::getLanguage();
$tmp_lng 		= $lang->getBackwardLang();
if (!file_exists($pathLangFile.$tmp_lng.'.php')) {
    if (file_exists($pathLangFile.'german.php' )) {
        $tmp_lng = 'german';
        echo 'Sprachendatei [ '.$lang->getBackwardLang().' ] nicht gefunden, verwende stattdessen [ Deutsch ]<br />';
    } else {
        $tmp_lng = 'english';
        echo 'Language file [ '.$lang->getBackwardLang().' ] not found, using default language: English<br />';
    }
}
if (file_exists($pathLangFile.$tmp_lng.'.php'))
	include_once $pathLangFile.$tmp_lng.'.php';

function com_install() {
	include JPATH_ADMINISTRATOR.DS.'components'.DS.'com_joomap'.DS.'classes'.DS.'JoomapConfig.php';
	
	echo '<table class="adminlist" style="width:auto"><tr class="row0"><td>&rarr;</td><td>'."\n";
	JoomapConfig::create();
	echo '</td></tr>'."\n";
	
	if( JoomapConfig::restore() )
		echo '<tr class="row1"><td>&rarr;</td><td>'._JOOMAP_MSG_SET_RESTORED.'</td></tr>'."\n";
	
	echo "</table>\n";
}

?>
