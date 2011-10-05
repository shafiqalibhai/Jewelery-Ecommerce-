<?php

	defined( '_JEXEC' ) or die( 'Restricted access' );

// Include the syndicate functions only once
require_once( dirname(__FILE__).DS.'helper.php' );

$message = modBookmarksHelper::getMessage( $params );
require( JModuleHelper::getLayoutPath( 'mod_bookmark' ) );


	
?>