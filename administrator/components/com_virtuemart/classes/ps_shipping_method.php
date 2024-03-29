<?php 
if( !defined( '_VALID_MOS' ) && !defined( '_JEXEC' ) ) die( 'Direct Access to '.basename(__FILE__).' is not allowed.' );
/**
*
* @version $Id: ps_shipping_method.php 1584 2008-12-04 20:41:32Z soeren_nb $
* @package VirtueMart
* @subpackage classes
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

class ps_shipping_method {


	/**************************************************************************
	* name: save()
	* created by: soeren
	* description:
	* parameters:
	* returns:
	**************************************************************************/
	function save(&$d) {
		global $VM_LANG, $vmLogger;
		
		$ps_vendor_id = $_SESSION["ps_vendor_id"];
		$db = new ps_DB;
		$shipping_class = basename(vmGet($d,"shipping_class"));
		if( file_exists( CLASSPATH."shipping/".$shipping_class.".php" )) {
			include( CLASSPATH."shipping/".$shipping_class.".php" );
			$_SHIPPING = new $shipping_class();
			
			if( $_SHIPPING->configfile_writeable() ) {
				$_SHIPPING->write_configuration( $d );
				$vmLogger->info( $VM_LANG->_('VM_CONFIGURATION_CHANGE_SUCCESS',false) );
				return True;
			}
			else {
		    	$vmLogger->err( sprintf($VM_LANG->_('VM_CONFIGURATION_CHANGE_FAILURE',false) , CLASSPATH."payment/".$_SHIPPING->classname.".cfg.php" ) );
		    	return false;
		    }
			
		}
		else {
			$vmLogger->err( 'The shipping class file '.CLASSPATH."shipping/".$d["shipping_class"].".php could not be found." );
			return false;
		}
	}

	/**************************************************************************
	** name: method_list()
	** created by: soeren
	** description: list all available shipping methods
	** parameters:
	** returns:
	***************************************************************************/
	function method_list( $payment_method_id="" ) {
		global $mosConfig_absolute_path;

		$ps_vendor_id = $_SESSION["ps_vendor_id"];
		$db = new ps_DB;

		$row = Array();
		$files = vmReadDirectory( CLASSPATH.'shipping/', '.ini$' );
		if( $files ) {
			require_once( CLASSPATH. 'ps_ini.php' );
			$ShippingModule =& new mShop_ini();
			$i = 0;
			foreach( $files as $file ) {
				$i++;
				$ShippingModule->load( CLASSPATH.'shipping/'.$file );
			}
			return( $ShippingModule->_elements  );

		}
		else
		return false;

	}

	function get_weight( $pid ) {
		global $vendor_country_2_code;
		if( empty($GLOBALS['product_info'][$pid]['weight'] )) {
			if( $vendor_country_2_code=="US"
			|| $vendor_country_2_code=="PR"
			|| $vendor_country_2_code=="DO"
			) {
				defined( 'WEIGHT_UOM' ) or define('WEIGHT_UOM', "LB" );
				$GLOBALS['product_info'][$pid]['weight'] = ps_shipping_method::get_weight_LB( $pid );
				return $GLOBALS['product_info'][$pid]['weight'];
			}

			else {
				defined( 'WEIGHT_UOM' ) or define('WEIGHT_UOM', "KG" );
				$GLOBALS['product_info'][$pid]['weight'] = ps_shipping_method::get_weight_KG( $pid );
				return $GLOBALS['product_info'][$pid]['weight'];
			}
		}
		else
		return $GLOBALS['product_info'][$pid]['weight'];
	}

	/**************************************************************************
	** name: get_weight_OZ()
	** created by: Matt Oberpriller
	** description: Calculate product weight in ounces
	** parameters: product_id
	** returns: weight in ounces
	***************************************************************************/
	function get_weight_OZ($pid) {
		global $vars, $vmLogger;
		$ps_vendor_id = $_SESSION["ps_vendor_id"];
		$db = new ps_DB;

		$q  = "SELECT product_sku,product_parent_id,product_weight,product_weight_uom FROM #__{vm}_product ";
		$q .= "WHERE product_id='$pid' ";

		$db->query($q);
		$db->next_record();

		if ($db->f("product_weight") == 0 && $db->f("product_parent_id")) {
			$q = "SELECT * from #__{vm}_product WHERE product_id='".$db->f("product_parent_id")."'";
			$db->query($q);
			$db->next_record();
		}

		if ($db->f("product_weight") > 0) {
			if (eregi("LB",$db->f("product_weight_uom")) || eregi("PO",$db->f("product_weight_uom"))) {
				$weight = $db->f("product_weight") * 16;
			}
			elseif (eregi("KG",$db->f("product_weight_uom")) || eregi("KILO",$db->f("product_weight_uom"))) {
				$weight = $db->f("product_weight") * 35.27396194958041;
			}
			elseif (eregi("G",$db->f("product_weight_uom"))) {
				$weight = $db->f("product_weight") * 0.035273961949580414;
			}
			elseif (eregi("OZ",$db->f("product_weight_uom")) || eregi("OU",$db->f("product_weight_uom"))) {
				$weight = $db->f("product_weight");
			}
			else {
				$vmLogger->debug( "Unknown weight UOM in product " . $db->f("product_sku") );
			}
		} 
		else {
			$vmLogger->debug( "Weight not specified for product " . $db->f("product_sku"));
		}

		if (!empty($weight)) {
			return($weight);
		}
		else {
			return 0;
		}
	}

	/**************************************************************************
	** name: get_weight_KG()
	** created by: Matt Oberpriller
	** modified by: Soeren
	** description: Calculate product weight in Kilograms
	** parameters: product_id
	** returns: weight in KG
	***************************************************************************/
	function get_weight_KG( $pid ) {
		global $vars, $vmLogger;
		$ps_vendor_id = $_SESSION["ps_vendor_id"];
		$db = new ps_DB;

		$q  = "SELECT product_sku,product_parent_id,product_weight,product_weight_uom FROM #__{vm}_product ";
		$q .= "WHERE product_id='$pid' ";

		$db->query($q);
		$db->next_record();

		if ($db->f("product_weight") == 0 && $db->f("product_parent_id")) {
			$q = "SELECT * from #__{vm}_product WHERE product_id='".$db->f("product_parent_id")."'";
			$db->query($q);
			$db->next_record();
		}

		if ($db->f("product_weight") > 0) {
			if (eregi("LB",$db->f("product_weight_uom")) || eregi("PO",$db->f("product_weight_uom"))) {
				$weight = $db->f("product_weight") * 0.4536;
			}
			elseif (eregi("KG",$db->f("product_weight_uom")) || eregi("KILO",$db->f("product_weight_uom"))) {
				$weight = $db->f("product_weight");
			}
			elseif (eregi("G",$db->f("product_weight_uom"))) {
				$weight = $db->f("product_weight") * 0.001;
			}
			elseif (eregi("OZ",$db->f("product_weight_uom")) || eregi("OU",$db->f("product_weight_uom"))) {
				$weight = $db->f("product_weight") * 0.02835;
			}
			else {
				$vmLogger->debug( "Unknown weight UOM in product " . $db->f("product_sku"));
			}
		} 
		else {
			$vmLogger->debug( "Weight not specified for product " . $db->f("product_sku"));
		}

		if (!empty($weight)) {
			return($weight);
		}
		else {
			return 0;
		}
	}

	/**************************************************************************
	** name: get_weight_LB()
	** created by: Matt Oberpriller
	** modified by: Soeren
	** description: Calculate product weight in Pounds
	** parameters: product_id
	** returns: weight in LB / PO
	***************************************************************************/
	function get_weight_LB( $pid ) {
		global $vars, $vmLogger;
		$ps_vendor_id = $_SESSION["ps_vendor_id"];
		$db = new ps_DB;

		$q  = "SELECT product_sku,product_parent_id,product_weight,product_weight_uom FROM #__{vm}_product ";
		$q .= "WHERE product_id='$pid' ";

		$db->query($q);
		$db->next_record();

		if ($db->f("product_weight") == 0 && $db->f("product_parent_id")) {
			$q = "SELECT * from #__{vm}_product WHERE product_id='".$db->f("product_parent_id")."'";
			$db->query($q);
			$db->next_record();
		}

		if ($db->f("product_weight") > 0) {
			if (eregi("LB",$db->f("product_weight_uom")) || eregi("PO",$db->f("product_weight_uom"))) {
				$weight = $db->f("product_weight");
			}
			elseif (eregi("KG",$db->f("product_weight_uom")) || eregi("KILO",$db->f("product_weight_uom"))) {
				$weight = $db->f("product_weight") * 2.20459;
			}
			elseif (eregi("G",$db->f("product_weight_uom"))) {
				$weight = $db->f("product_weight") * 0.00220459;
			}
			elseif (eregi("OZ",$db->f("product_weight_uom")) || eregi("OU",$db->f("product_weight_uom"))) {
				$weight = $db->f("product_weight") * 0.0625;
			}
			else {
				$vmLogger->debug( "Unknown weight UOM in product " . $db->f("product_sku"));
			}
		} 
		else {
			$vmLogger->debug( "Weight not specified for product " . $db->f("product_sku"));
		}

		if (!empty($weight)) {
			return($weight);
		}
		else {
			return 0;
		}
	}
}
?>
