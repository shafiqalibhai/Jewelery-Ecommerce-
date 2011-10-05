<?php
if( !defined( '_VALID_MOS' ) && !defined( '_JEXEC' ) ) die( 'Direct Access to '.basename(__FILE__).' is not allowed.' ); 
/**
*
* @version $Id: checkout.login_form.php 1175 2008-01-21 20:17:55Z soeren_nb $
* @package VirtueMart
* @subpackage html
* @copyright Copyright (C) 2004-2007 soeren - All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
* VirtueMart is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* See /administrator/components/com_virtuemart/COPYRIGHT.php for copyright notices and details.
*
* http://virtuemart.net
*/
echo '<div style="color:#000000; background-color:#ffffff; position:absolute; left:460px;top:10px; border-top:1px;">';

mm_showMyFileName( __FILE__ );

// Determine settings based on CMS version
if( vmIsJoomla( '1.5' ) ) {
	// Post action
	$action =  'index.php?option=com_user&amp;task=login';

	// Return URL
	$uri = JFactory::getURI();
	$url = $uri->toString();
	$return_url = base64_encode( $url );

	// Set the validation value
	$validate = JUtility::getToken();
	
} else {
	// Post action
	$action = 'index.php?option=login';

	// Return URL
	$return_url = vmGet( $_SERVER, 'REQUEST_URI', null );

	// Convert & to &amp; for xhtml compliance
	$return_url = str_replace( '&', '&amp;', $return_url );
	$return_url = str_replace( 'option', '&amp;option', $return_url );

	// Set the validation value
	if( function_exists( 'josspoofvalue' ) ) {
		$validate = josSpoofValue(1);
	} else {
		$validate = vmSpoofValue(1);
	}
}

$theme = vmTemplate::getInstance();

$theme->set_vars( array(
						'action' => $action,
						'return_url' => $return_url,
						'validate' => $validate,
						'VM_LANG' => $VM_LANG,
						'mosConfig_lang' => $mosConfig_lang
					));

echo '<div style="padding-top:5px; background-color:#CCEEFF; color:#000000; width:340px; border-top:1px solid #000000;border-right:1px solid #000000;border-left:1px solid #000000;border-bottom:1px solid #000000;">';
echo $theme->fetch('common/login_form.tpl.php');
echo '</div>';

echo '</div>';
