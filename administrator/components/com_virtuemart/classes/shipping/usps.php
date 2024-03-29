<?php
if( !defined( '_VALID_MOS' ) && !defined( '_JEXEC' ) ) die( 'Direct Access to '.basename(__FILE__).' is not allowed.' );
/**
*  MODIFIED BY Corey Koltz (http://www.koltz.com)
*  Code updated to work with multiple shipping options and
*  updated for May 2007 changes by USPS.
*
* @version $Id: usps.php,v 3.0 2007/06/21 by Corey Koltz
* Original code by Soeren Eberhardt
* @package VirtueMart
* @subpackage shipping
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

/**
* This is the Shipping class for 
* using a part of the USPS Online Tools:
* = Rates and Service Selection =
*
* @copyright (C) 2005 E-Z E
*/
class usps {

	function list_rates( &$d ) {
		global $VM_LANG, $CURRENCY_DISPLAY, $mosConfig_absolute_path;
		$db = new ps_DB;
		$dbv = new ps_DB;
		$dbc = new ps_DB;

		/** Read current Configuration ***/
		require_once(CLASSPATH ."shipping/".__CLASS__.".cfg.php");

		$q  = "SELECT * FROM `#__{vm}_user_info`, `#__{vm}_country` WHERE user_info_id='" . $db->getEscaped($d["ship_to_info_id"])."' AND ( country=country_2_code OR country=country_3_code)";
		$db->query($q);
		$db->next_record();

		$q  = "SELECT * FROM #__{vm}_vendor WHERE vendor_id='".$_SESSION['ps_vendor_id']."'";
		$dbv->query($q);
		$dbv->next_record();

		$order_weight = $d['weight'];

		if($order_weight > 0) {

			//USPS Username
			$usps_username = USPS_USERNAME;

			//USPS Password
			$usps_password = USPS_PASSWORD;

			//USPS Server
			$usps_server = USPS_SERVER;

			//USPS Path
			$usps_path = USPS_PATH;

			//USPS package size
			$usps_packagesize = USPS_PACKAGESIZE;

			//USPS Package ID
			$usps_packageid = 0;

			//USPS International Per Pound Rate
			$usps_intllbrate = USPS_INTLLBRATE;

			//USPS International handling fee
			$usps_intlhandlingfee = USPS_INTLHANDLINGFEE;

			//Pad the shipping weight to allow weight for shipping materials
			$usps_padding = USPS_PADDING;
			$usps_padding = $usps_padding * 0.01;
			$order_weight = ($order_weight * $usps_padding) + $order_weight;
			
			//USPS Machinable for Parcel Post
			$usps_machinable = USPS_MACHINABLE;
			if ($usps_machinable == '1') $usps_machinable = 'TRUE';
			else $usps_machinable = 'FALSE';
			
			//USPS Shipping Options to display
			$usps_ship[0] = USPS_SHIP0;
			$usps_ship[1] = USPS_SHIP1;
			$usps_ship[2] = USPS_SHIP2;
			$usps_ship[3] = USPS_SHIP3;
			$usps_ship[4] = USPS_SHIP4;
			$usps_ship[5] = USPS_SHIP5;
			$usps_ship[6] = USPS_SHIP6;
			$usps_ship[7] = USPS_SHIP7;
			$usps_ship[8] = USPS_SHIP8;
			$usps_ship[9] = USPS_SHIP9;
			$usps_ship[10] = USPS_SHIP10;
			foreach ($usps_ship as $key => $value){
				if ($value == '1') $usps_ship[$key] = 'TRUE';
				else $usps_ship[$key] = 'FALSE';
			}
			$usps_intl[0] = USPS_INTL0;
			$usps_intl[1] = USPS_INTL1;
			$usps_intl[2] = USPS_INTL2;
			$usps_intl[3] = USPS_INTL3;
			$usps_intl[4] = USPS_INTL4;
			$usps_intl[5] = USPS_INTL5;
			$usps_intl[6] = USPS_INTL6;
			$usps_intl[7] = USPS_INTL7;
			$usps_intl[8] = USPS_INTL8;
			// $usps_intl[9] = USPS_INTL9;
			foreach ($usps_intl as $key => $value){
				if ($value == '1') $usps_intl[$key] = 'TRUE';
				else $usps_intl[$key] = 'FALSE';
			}
			//Title for your request
			$request_title = "Shipping Estimate";

			//The zip that you are shipping from
			$source_zip = substr($dbv->f("vendor_zip"),0,5);

			$shpService = 'All'; //"Priority";
			
			//The zip that you are shipping to
			$dest_country = $db->f("country_2_code");
			if ($dest_country == "GB") {
				$q  = "SELECT state_name FROM #__{vm}_state WHERE state_2_code='".$db->f("state")."'";
				$dbc->query($q);
				$dbc->next_record();
				$dest_country_name = $dbc->f("state_name");
			}
			else {
				$dest_country_name = $db->f("country_name");
			}
			$dest_state = $db->f("state");
			$dest_zip = substr($db->f("zip"),0,5);
			//$weight_measure
	        if ($order_weight < 1) { 
                      $shipping_pounds_intl = 0;
            } else {
                      $shipping_pounds_intl = ceil ($order_weight);
            }
			if ($order_weight < 0.88) {
				$shipping_pounds = 0;
				$shipping_ounces = round(16 * ($order_weight - floor($order_weight)));
			}
			else	{
				$shipping_pounds = ceil ($order_weight);
				$shipping_ounces = 0;
			}

			$os = array("Mac", "NT", "Irix", "Linux");
			$states = array("AL","AK","AR","AZ","CA","CO","CT","DC","DE","FL","GA","HI","IA","ID","IL","IN","KS","KY","LA","MA","MD","ME","MI","MN","MO","MS","MT","NC","ND","NE","NH","NJ","NM","NV","NY","OH","OK","OR","PA","RI","SC","SD","TN","TX","UT","VT","VA","WA","WI","WV","WY");
			//If weight is over 70 pounds, round down to 70 for now.
			//Will update in the future to be able to split the package or something?
			if( $order_weight > 70.00 ) {
				echo "We are unable to ship USPS as the package weight exceeds the 70 pound limit,<br>please select another shipping method.";
			}
			else 	{
			if( ( $dest_country == "US") && in_array($dest_state,$states) )	{
				/******START OF DOMESTIC RATE******/
				//the xml that will be posted to usps
				$xmlPost = 'API=RateV2&XML=<RateV2Request USERID="'.$usps_username.'" PASSWORD="'.$usps_password.'">';
				$xmlPost .= '<Package ID="'.$usps_packageid.'">';
				$xmlPost .= "<Service>".$shpService."</Service>";
				$xmlPost .= "<ZipOrigination>".$source_zip."</ZipOrigination>";
				$xmlPost .= "<ZipDestination>".$dest_zip."</ZipDestination>";
				$xmlPost .= "<Pounds>".$shipping_pounds."</Pounds>";
				$xmlPost .= "<Ounces>".$shipping_ounces."</Ounces>";
				$xmlPost .= "<Size>".$usps_packagesize."</Size>";
				$xmlPost .= "<Machinable>".$usps_machinable."</Machinable>";
				$xmlPost .= "</Package></RateV2Request>";

				// echo htmlentities( $xmlPost );
				$host = $usps_server;
				//$host = "production.shippingapis.com";
				$path = $usps_path; //"/ups.app/xml/Rate";
				//$path = "/ShippingAPI.dll";
				$port = 80;
				$protocol = "http";
				
				$html = "";
				
				//echo "<textarea>".$protocol."://".$host.$path."?API=Rate&XML=".$xmlPost."</textarea>";
				// Using cURL is Up-To-Date and easier!!
				if( function_exists( "curl_init" )) {
					$CR = curl_init();
					curl_setopt($CR, CURLOPT_URL, $protocol."://".$host.$path); //"?API=RateV2&XML=".$xmlPost);
					curl_setopt($CR, CURLOPT_POST, 1);
					curl_setopt($CR, CURLOPT_FAILONERROR, true);
					curl_setopt($CR, CURLOPT_POSTFIELDS, $xmlPost);
					curl_setopt($CR, CURLOPT_RETURNTRANSFER, 1);

					$xmlResult = curl_exec( $CR );


					$error = curl_error( $CR );
					if( !empty( $error )) {
						$GLOBALS['vmLogger']->err( curl_error( $CR ) );
						$html = "<br/><span class=\"message\">".$VM_LANG->_('PHPSHOP_INTERNAL_ERROR')." USPS.com</span>";
						$error = true;
					}
					else {
						/* XML Parsing */
						require_once( $mosConfig_absolute_path. '/includes/domit/xml_domit_lite_include.php' );
						$xmlDoc = new DOMIT_Lite_Document();
						$xmlDoc -> parseXML( $xmlResult, false, true );
						/* Let's check wether the response from USPS is Success or Failure ! */
						if( strstr( $xmlResult, "Error" ) ) {
							$error = true;
							$html = "<span class=\"message\">".$VM_LANG->_('PHPSHOP_USPS_RESPONSE_ERROR')."</span><br/>";
							$error_code = $xmlDoc->getElementsByTagName( "Number" );
							$error_code = $error_code->item(0);
							$error_code = $error_code->getText();
							$html .= $VM_LANG->_('PHPSHOP_ERROR_CODE').": ".$error_code."<br/>";

							$error_desc = $xmlDoc->getElementsByTagName( "Description" );
							$error_desc = $error_desc->item(0);
							$error_desc = $error_desc->getText();
							$html .= $VM_LANG->_('PHPSHOP_ERROR_DESC').": ".$error_desc."<br/>";

						}
					}
					curl_close( $CR );
				}
				else {
					$protocol = "http";
					$fp = fsockopen($protocol."://".$host, $errno, $errstr, $timeout = 60);
					if( !$fp ) {
						$error = true;
						$html = $VM_LANG->_('PHPSHOP_INTERNAL_ERROR').": $errstr ($errno)";
					}
					else {
						//send the server request
						fputs($fp, "POST $path HTTP/1.1\r\n");
						fputs($fp, "Host: $host\r\n");
						fputs($fp, "Content-type: application/x-www-form-urlencoded\r\n");
						fputs($fp, "Content-length: ".strlen($xmlPost)."\r\n");
						fputs($fp, "Connection: close\r\n\r\n");
						fputs($fp, $xmlPost . "\r\n\r\n");

						$xmlResult = '';
						while(!feof($fp)) {
							$xmlResult .= fgets($fp, 4096);
						}
						if( stristr( $xmlResult, "Success" )) {
							/* XML Parsing */
							require_once( $mosConfig_absolute_path. '/includes/domit/xml_domit_lite_include.php' );
							$xmlDoc =& new DOMIT_Lite_Document();
							$xmlDoc->parseXML( $xmlResult, false, true );
							$error = false;
							
						}
						else {
							$html = "Error processing the Request to USPS.com";
							$error = true;
						}
					}

				}
				if (DEBUG){
					echo "XML Post: <br>";
					echo "<textarea cols='80'>".$protocol."://".$host.$path."?".$xmlPost."</textarea>";
					echo "<br>";
					echo "XML Result: <br>";
					echo "<textarea cols='80' rows='10'>".$xmlResult."</textarea>";
					echo "<br>";
					echo "Cart Contents: ".$order_weight. " ".$weight_measure."<br><br>\n";
	  			}
				if( $error ) {
					// comment out, if you don't want the Errors to be shown!!
					//$vmLogger->err( $html );
					// Switch to StandardShipping on Error !!!
					//require_once( CLASSPATH . 'shipping/standard_shipping.php' );
					//$shipping =& new standard_shipping();
					//$shipping->list_rates( $d );
					echo "We are unable to ship USPS as the there was an error,<br> please select another shipping method.";
					return;
				}
				// Domestic shipping - add how long it might take
				$ship_commit[0]="1 - 2 Days";
				$ship_commit[1]="1 - 2 Days";
				$ship_commit[2]="1 - 2 Days";
				$ship_commit[3]="1 - 3 Days";
				$ship_commit[4]="1 - 3 Days";
				$ship_commit[5]="1 - 3 Days";
				$ship_commit[6]="2 - 9 Days";
				$ship_commit[7]="2 - 9 Days";
				$ship_commit[8]="2 - 9 Days";
				$ship_commit[9]="2 - 9 Days";
				$ship_commit[10]="2 Days or More";
				
				// retrieve the service and postage items
				$i = 0;
				if ($order_weight > 15) {
					$count = 8;
					$usps_ship[6] = $usps_ship[7];
					$usps_ship[7] = $usps_ship[9];
					$usps_ship[8] = $usps_ship[10];	
					}			
				else if ($order_weight >= 0.86) {
					$count = 9;
					$usps_ship[6] = $usps_ship[7];
					$usps_ship[7] = $usps_ship[8];
					$usps_ship[8] = $usps_ship[9];
					$usps_ship[9] = $usps_ship[10];
				}
				else {
					$count = 10;

				}
				while ($i <= $count) {
				if( isset( $xmlDoc)) {
					$ship_service[$i] = $xmlDoc->getElementsByTagName( 'MailService' );
					$ship_service[$i] = $ship_service[$i]->item($i);
					$ship_service[$i] = $ship_service[$i]->getText();

					$ship_postage[$i] = $xmlDoc->getElementsByTagName( 'Rate' );
					$ship_postage[$i] = $ship_postage[$i]->item($i);
					$ship_postage[$i] = $ship_postage[$i]->getText();
					if (preg_match('/%$/',USPS_HANDLINGFEE)) {
					  $ship_postage[$i] = $ship_postage[$i] * (1+substr(USPS_HANDLINGFEE,0,-1)/100);
					} else {
					  $ship_postage[$i] = $ship_postage[$i] + USPS_HANDLINGFEE;
					}


				$i++;

				}
				}
				/******END OF DOMESTIC RATE******/
			}
			else	{
				/******START INTERNATIONAL RATE******/
				//the xml that will be posted to usps
				$xmlPost = 'API=IntlRate&XML=<IntlRateRequest USERID="'.$usps_username.'" PASSWORD="'.$usps_password.'">';
				$xmlPost .= '<Package ID="'.$usps_packageid.'">';
				$xmlPost .= "<Pounds>".$shipping_pounds_intl."</Pounds>";
				$xmlPost .= "<Ounces>".$shipping_ounces."</Ounces>";
				$xmlPost .= "<MailType>Package</MailType>";
				$xmlPost .= "<Country>".$dest_country_name."</Country>";
				$xmlPost .= "</Package></IntlRateRequest>";

				// echo htmlentities( $xmlPost );
				$host = $usps_server;
				//$host = "production.shippingapis.com";
				$path = $usps_path; //"/ups.app/xml/Rate";
				//$path = "/ShippingAPI.dll";
				$port = 80;
				$protocol = "http";

				//echo "<textarea>".$protocol."://".$host.$path."?API=Rate&XML=".$xmlPost."</textarea>";
				// Using cURL is Up-To-Date and easier!!
				if( function_exists( "curl_init" )) {
					$CR = curl_init();
					curl_setopt($CR, CURLOPT_URL, $protocol."://".$host.$path); //"?API=RateV2&XML=".$xmlPost);
					curl_setopt($CR, CURLOPT_POST, 1);
					curl_setopt($CR, CURLOPT_FAILONERROR, true);
					curl_setopt($CR, CURLOPT_POSTFIELDS, $xmlPost);
					curl_setopt($CR, CURLOPT_RETURNTRANSFER, 1);


					$xmlResult = curl_exec( $CR );
					//echo "<textarea>".$xmlResult."</textarea>";
					$error = curl_error( $CR );
					if( !empty( $error )) {
						$GLOBALS['vmLogger']->err( curl_error( $CR ) );
						$html = "<br/><span class=\"message\">".$VM_LANG->_('PHPSHOP_INTERNAL_ERROR')." USPS.com</span>";
						$error = true;
					}
					else {
						/* XML Parsing */
						require_once( $mosConfig_absolute_path. '/includes/domit/xml_domit_lite_include.php' );
						$xmlDoc = new DOMIT_Lite_Document();
						$xmlDoc->parseXML( $xmlResult, false, true );

						/* Let's check wether the response from USPS is Success or Failure ! */
						if( strstr( $xmlResult, "Error" ) ) {
							$error = true;
							$html = "<span class=\"message\">".$VM_LANG->_('PHPSHOP_USPS_RESPONSE_ERROR')."</span><br/>";
							$error_code = $xmlDoc->getElementsByTagName( "Number" );
							$error_code = $error_code->item(0);
							$error_code = $error_code->getText();
							$html .= $VM_LANG->_('PHPSHOP_ERROR_CODE').": ".$error_code."<br/>";

							$error_desc = $xmlDoc->getElementsByTagName( "Description" );
							$error_desc = $error_desc->item(0);
							$error_desc = $error_desc->getText();
							$html .= $VM_LANG->_('PHPSHOP_ERROR_DESC').": ".$error_desc."<br/>";

						}

					}
					curl_close( $CR );

				}
				else {
					$protocol = "http";
					$fp = fsockopen($protocol."://".$host, $errno, $errstr, $timeout = 60);
					if( !$fp ) {
						$error = true;
						$html = $VM_LANG->_('PHPSHOP_INTERNAL_ERROR').": $errstr ($errno)";
					}
					else {
						//send the server request
						fputs($fp, "POST $path HTTP/1.1\r\n");
						fputs($fp, "Host: $host\r\n");
						fputs($fp, "Content-type: application/x-www-form-urlencoded\r\n");
						fputs($fp, "Content-length: ".strlen($xmlPost)."\r\n");
						fputs($fp, "Connection: close\r\n\r\n");
						fputs($fp, $xmlPost . "\r\n\r\n");

						$xmlResult = '';
						while(!feof($fp)) {
							$xmlResult .= fgets($fp, 4096);
						}
						if( stristr( $xmlResult, "Success" )) {
							/* XML Parsing */
							require_once( $mosConfig_absolute_path. '/includes/domit/xml_domit_lite_include.php' );
							$xmlDoc = new DOMIT_Lite_Document();
							$xmlDoc->parseXML( $xmlResult, false, true );
							$error = false;
						}
						else {
							$html = "Error processing the Request to USPS.com";
							$error = true;
						}
					}

				}
				if (DEBUG){
					echo "XML Post: <br>";
					echo "<textarea cols='80'>".$protocol."://".$host.$path."?".$xmlPost."</textarea>";
					echo "<br>";
					echo "XML Result: <br>";
					echo "<textarea cols='80' rows='10'>".$xmlResult."</textarea>";
					echo "<br>";
					echo "Cart Contents: ".$order_weight. " ".$weight_measure."<br><br>\n";
	  			}
				if( $error ) {
					// comment out, if you don't want the Errors to be shown!!
					//$vmLogger->err( $html );
					// Switch to StandardShipping on Error !!!
					//require_once( CLASSPATH . 'shipping/standard_shipping.php' );
					//$shipping =& new standard_shipping();
					//$shipping->list_rates( $d );
					//return;
					echo "We are unable to ship USPS as there was an error,<br> please select another shipping method.";
				}
				// retrieve the service and postage items
				$i = 0;
				$numChildren = 0;
				$numChildren = $xmlDoc->documentElement->firstChild->childCount;
				$numChildren = ($numChildren - 7);  // this line removes the preceeding 6 lines of crap not needed plus 1 to make up for the $i starting at 0
				while ($i <= $numChildren) {
					if( isset( $xmlDoc)) {
						$ship_service[$i] = $xmlDoc->getElementsByTagName( "SvcDescription" );
						$ship_service[$i] = $ship_service[$i]->item($i);
						$ship_service[$i] = $ship_service[$i]->getText();
						
						$ship_weight[$i] = $xmlDoc->getElementsByTagName( "MaxWeight" );
						$ship_weight[$i] = $ship_weight[$i]->item($i);
						$ship_weight[$i] = $ship_weight[$i]->getText($i);
					}
					$i++;
				}
				// retrieve postage for countries that support all nine shipping methods and weights
				$ship_weight[8] = ($ship_weight[8]/16);
				if ( $order_weight <= $ship_weight[0] && $ship_weight[1] && $ship_weight[2] && $ship_weight[3] && $ship_weight[4] && $ship_weight[5] && $ship_weight [6] && $ship_weight[7] && $ship_weight[8] ) {
						$count = 8;
					}
				// retrieve postage for countries that support eight of the nine shipping methods and weights
				elseif ( $order_weight <= $ship_weight[0] && $ship_weight[1] && $ship_weight[2] && $ship_weight[3] && $ship_weight[4] && $ship_weight[5] && $ship_weight [6] && $ship_weight[7] ) {
						$count = 7;
						// $usps_intl[6] = $usps_intl[7];
					}
				// retrieve postage for countries that support seven of the nine shipping methods and weights
				elseif ( $order_weight <= $ship_weight[0] && $ship_weight[1] && $ship_weight[2] && $ship_weight[3] && $ship_weight[4] && $ship_weight[5] && $ship_weight [6] ) {
						$count = 6;
					}	
				// retrieve postage for countries that support six of the nine shipping methods and weights
				elseif ( $order_weight <= $ship_weight[0] && $ship_weight[1] && $ship_weight[2] && $ship_weight[3] && $ship_weight[4] && $ship_weight[5] ) {
						$count = 5;
					}		
				// retrieve postage for countries that support five of the nine shipping methods and weights
				elseif ( $order_weight <= $ship_weight[0] && $ship_weight[1] && $ship_weight[2] && $ship_weight[3] && $ship_weight[4] ) {
						$count = 4;
					}	
				// retrieve postage for countries that support four of the nine shipping methods and weights
				elseif ( $order_weight <= $ship_weight[0] && $ship_weight[1] && $ship_weight[2] && $ship_weight[3] ) {
						$count = 3;
					}		
				// retrieve postage for countries that support three of the nine shipping methods and weights 
				elseif ( $order_weight <= $ship_weight[0] && $ship_weight[1] && $ship_weight[2] ) {
						$count = 2;
					}		
				// retrieve postage for countries that support two of the nine shipping methods and weights 
				elseif ( $order_weight <= $ship_weight[0] && $ship_weight[1] ) {
						$count = 1;
					}
				// retrieve postage for countries that support one of the nine shipping methods and weights 
				elseif ( $order_weight <= $ship_weight[0] ) {
						$count = 0;
					}
				else { 
					echo "We are unable to ship USPS as the package weight exceeds what your<br>country allows, please select another shipping method.";
				}
				$i = 0;
				while ($i <= $numChildren) {
				if( isset( $xmlDoc)) {
					$ship_service[$i] = $xmlDoc->getElementsByTagName( "SvcDescription" );
					$ship_service[$i] = $ship_service[$i]->item($i);
					$ship_service[$i] = $ship_service[$i]->getText();
					
					$ship_commit[$i] = $xmlDoc->getElementsByTagName( "SvcCommitments");
					$ship_commit[$i] = $ship_commit[$i]->item($i);
					$ship_commit[$i] = $ship_commit[$i]->getText();

					$ship_postage[$i] = $xmlDoc->getElementsByTagName( "Postage" );
					$ship_postage[$i] = $ship_postage[$i]->item($i);
					$ship_postage[$i] = $ship_postage[$i]->getText($i);
					$ship_postage[$i] = $ship_postage[$i] + USPS_INTLHANDLINGFEE;
				$i++;
				}
				/******END INTERNATIONAL RATE******/
			}
			}
			$i = 0;
			while ($i <= $count) {
			$html = "";
			// USPS returns Charges in USD.
			$charge[$i] = $ship_postage[$i];
			$ship_postage[$i] = $CURRENCY_DISPLAY->getFullValue($charge[$i]);

			$shipping_rate_id = urlencode(__CLASS__."|USPS|".$ship_service[$i]."|".$charge[$i]);
			//$checked = (@$d["shipping_rate_id"] == $value) ? "checked=\"checked\"" : "";
			$html .= "\n<input type=\"radio\" name=\"shipping_rate_id\" checked=\"checked\" value=\"$shipping_rate_id\" id=\"$shipping_rate_id\" />\n";

			$_SESSION[$shipping_rate_id] = 1;

			$html .= "<label for=\"$shipping_rate_id\">";
			$html .= "USPS ".$ship_service[$i]." ";
			
			$html .= "<strong>(".$ship_postage[$i].")</strong>";
			if (USPS_SHOW_DELIVERY_QUOTE == 1) {
				$html .= "&nbsp;&nbsp;-&nbsp;&nbsp;".$ship_commit[$i];
			}
			$html .= "</label>";
			$html .= "<br />";
			if ($dest_country_name == "United States" && $usps_ship[$i] == "TRUE") {
				echo $html;
			}
			else if ($dest_country_name != "United States" && $usps_intl[$i] == "TRUE") {
				echo $html;
			}
			$i++;
			}
		}
		}
		return true;
	} //end function list_rates


	function get_rate( &$d ) {

		$shipping_rate_id = $d["shipping_rate_id"];
		$is_arr = explode("|", urldecode(urldecode($shipping_rate_id)) );
		$order_shipping = (float)$is_arr[3];

		return $order_shipping;

	} //end function get_rate


	function get_tax_rate() {

		/** Read current Configuration ***/
		require_once(CLASSPATH ."shipping/".__CLASS__.".cfg.php");

		if( intval(USPS_TAX_CLASS)== 0 )
		return( 0 );
		else {
			require_once( CLASSPATH. "ps_tax.php" );
			$tax_rate = ps_tax::get_taxrate_by_id( intval(USPS_TAX_CLASS) );
			return $tax_rate;
		}
	}

	/**
    * Validate this Shipping method by checking if the SESSION contains the key
    * @returns boolean False when the Shipping method is not in the SESSION
    */
	function validate( $d ) {

		$shipping_rate_id = $d["shipping_rate_id"];

		if( array_key_exists( $shipping_rate_id, $_SESSION )) {
			return true;
		}
		else {
			return false;
		}
	} //end function validate

	/**
    * Show all configuration parameters for this Shipping method
    * @returns boolean False when the Shipping method has no configration
    */
	function show_configuration() {

		global $VM_LANG;
		/** Read current Configuration ***/
		require_once(CLASSPATH ."shipping/".__CLASS__.".cfg.php");
    ?>
<table>
	<tr>
		<td><strong><?php echo $VM_LANG->_('PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_USPS_USERNAME') ?></strong></td>
		<td><input type="text" name="USPS_USERNAME" class="inputbox"
			value="<?php echo USPS_USERNAME ?>" /></td>
		<td>
          <?php echo mm_ToolTip($VM_LANG->_('PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_USPS_USERNAME_TOOLTIP')) ?>
        </td>
	</tr>
	<tr>
		<td><strong><?php echo $VM_LANG->_('PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_USPS_PASSWORD') ?></strong>
		</td>
		<td><input type="text" name="USPS_PASSWORD" class="inputbox"
			value="<?php echo USPS_PASSWORD ?>" /></td>
		<td>
            <?php echo mm_ToolTip($VM_LANG->_('PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_USPS_PASSWORD_TOOLTIP')) ?>
        </td>
	</tr>
	<tr>
		<td><strong><?php echo $VM_LANG->_('PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_USPS_SERVER') ?></strong>
		</td>
		<td><input type="text" name="USPS_SERVER" class="inputbox"
			value="<?php echo USPS_SERVER ?>" /></td>
		<td>
            <?php echo mm_ToolTip($VM_LANG->_('PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_USPS_SERVER_TOOLTIP')) ?>
        </td>
	</tr>
	<tr>
		<td><strong><?php echo $VM_LANG->_('PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_USPS_PATH') ?></strong>
		</td>
		<td><input type="text" name="USPS_PATH" class="inputbox"
			value="<?php echo USPS_PATH ?>" /></td>
		<td>
            <?php echo mm_ToolTip($VM_LANG->_('PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_USPS_PATH_TOOLTIP')) ?>
        </td>
	</tr>
	<tr>
		<td><strong><?php echo $VM_LANG->_('PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_USPS_PACKAGESIZE') ?></strong>
		</td>
		<td><select name="USPS_PACKAGESIZE">
			<option value="REGULAR"
				<?php if (USPS_PACKAGESIZE == 'REGULAR') echo "selected=\"selected\""; ?>>Regular</option>
			<option value="LARGE"
				<?php if (USPS_PACKAGESIZE == 'LARGE') echo "selected=\"selected\""; ?>>Large</option>
			<option value="OVERSIZE"
				<?php if (USPS_PACKAGESIZE == 'OVERSIZE') echo "selected=\"selected\""; ?>>Oversize</option>
		</select></td>
		<td>
            <?php echo mm_ToolTip($VM_LANG->_('PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_USPS_PACKAGESIZE_TOOLTIP')) ?>
        </td>
	</tr>
	<tr>
		<td><strong><?php echo $VM_LANG->_('PHPSHOP_UPS_TAX_CLASS') ?></strong></td>
		<td>
		  <?php
		  require_once(CLASSPATH.'ps_tax.php');
		  ps_tax::list_tax_value("USPS_TAX_CLASS", USPS_TAX_CLASS) ?>
		</td>
		<td><?php echo mm_ToolTip($VM_LANG->_('PHPSHOP_UPS_TAX_CLASS_TOOLTIP')) ?>
		
		
		
		
		
		<td>
	
	</tr>
	<tr>
		<TD colspan="3">
		<HR />
		</td>
	</tr>
	<tr>
		<td><strong><?php echo $VM_LANG->_('PHPSHOP_USPS_HANDLING_FEE') ?></strong></td>
		<td><input class="inputbox" TYPE="text" name="USPS_HANDLINGFEE"
			value="<?php echo USPS_HANDLINGFEE ?>" /></td>
		<td><?php echo mm_ToolTip($VM_LANG->_('PHPSHOP_USPS_HANDLING_FEE_TOOLTIP')) ?></td>
	</tr>
	<tr>
		<td><strong><?php echo $VM_LANG->_('PHPSHOP_USPS_PADDING') ?></strong></td>
		<td><input class="inputbox" TYPE="text" name="USPS_PADDING"
			value="<?php echo USPS_PADDING ?>" /></td>
		<td><?php echo mm_ToolTip($VM_LANG->_('PHPSHOP_USPS_PADDING_TOOLTIP')) ?></td>
	</tr>
	<tr>
		<td><strong><?php echo $VM_LANG->_('PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_USPS_INTLLBRATE') ?></strong>
		</td>
		<td><input type="text" name="USPS_INTLLBRATE" class="inputbox"
			value="<?php echo USPS_INTLLBRATE ?>" /></td>
		<td>
            <?php echo mm_ToolTip($VM_LANG->_('PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_USPS_INTLLBRATE_TOOLTIP')) ?>
        </td>
	</tr>
	<tr>
		<td><strong><?php echo $VM_LANG->_('PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_USPS_INTLHANDLINGFEE') ?></strong>
		</td>
		<td><input type="text" name="USPS_INTLHANDLINGFEE" class="inputbox"
			value="<?php echo USPS_INTLHANDLINGFEE ?>" /></td>
		<td>
            <?php echo mm_ToolTip($VM_LANG->_('PHPSHOP_ADMIN_CFG_STORE_SHIPPING_METHOD_USPS_INTLHANDLINGFEE_TOOLTIP')) ?>
        </td>
	</tr>
	<tr>
		<td><strong><?php echo _VM_LANG_USPS_MACHINABLE ?></strong></td>
		<td><label> <input name="USPS_MACHINABLE" type="radio"
			<?php if (USPS_MACHINABLE == 1) echo "checked=\"checked\""; ?>
			value="1" /> Yes</label> <label> <input name="USPS_MACHINABLE"
			type="radio"
			<?php if (USPS_MACHINABLE == 0) echo "checked=\"checked\""; ?>
			value="0" /> No</label></td>
		<td><?php echo mm_ToolTip(_VM_LANG_USPS_MACHINABLE_TOOLTIP) ?></td>
	</tr>
	<tr>
		<td><strong><?php echo _VM_LANG_USPS_QUOTE ?></strong></td>
		<td><label> <input name="USPS_SHOW_DELIVERY_QUOTE" type="radio"
			<?php if (USPS_SHOW_DELIVERY_QUOTE == 1) echo "checked=\"checked\""; ?>
			value="1" /> Yes</label> <label> <input
			name="USPS_SHOW_DELIVERY_QUOTE" type="radio"
			<?php if (USPS_SHOW_DELIVERY_QUOTE == 0) echo "checked=\"checked\""; ?>
			value="0" /> No</label></td>
		<td><?php echo mm_ToolTip(_VM_LANG_USPS_QUOTE_TOOLTIP) ?></td>
	</tr>
	<tr>
		<td colspan="3">
		<hr><?php echo _VM_LANG_USPS_SHIP; ?><hr>
		</td>
	</tr>
	<!-- added for new shipping rate V2 code ... Domestic Shipping-->
	<?php $count = 10; $i = 0; ?> 
	<?php while ($i <= $count): 
	$dom_option = constant("USPS_SHIP".$i);
	?>
	<tr>
		<td><strong><?php $var_name = "_VM_LANG_USPS_SHIP$i"; eval("\$var = $var_name;"); echo $var; ?></strong></td>
		<td><label> <input name="USPS_SHIP<?php echo $i; ?>" type="radio"
			<?php $var_name = "\$dom_option"; eval("\$var = $var_name;"); if ($var  == 1) echo "checked=\"checked\""; ?>
			value="1" /> Yes</label> <label> <input
			name="USPS_SHIP<?php echo $i; ?>" type="radio"
			<?php $var_name = "\$dom_option"; eval("\$var = $var_name;"); if ($var  == 0) echo "checked=\"checked\""; ?>
			value="0" /> No</label></td>
		<td><?php $var_name = "_VM_LANG_USPS_SHIP".$i; eval("\$var = $var_name;"); echo mm_ToolTip($var) ?></td>
	</tr>
	<?php $i++; ?>
	<?php endwhile; ?> 
	<tr>
		<td colspan="3">
		<hr><?php echo _VM_LANG_USPS_INTL; ?><hr>
		</td>
	</tr>
	<!-- added for new shipping rate V2 code ... International Shipping -->
	<?php $count = 8; $i = 0; ?>
	<?php while ($i <= $count): 
	$int_option = constant("USPS_INTL".$i);
	?>
	<tr>
		<td><strong><?php $var_name = "_VM_LANG_USPS_INTL$i"; eval("\$var = $var_name;"); echo $var; ?></strong></td>
		<td><label> <input name="USPS_INTL<?php echo $i; ?>" type="radio"
			<?php $var_name = "\$int_option"; eval("\$var = $var_name;"); if ($var  == 1) echo "checked=\"checked\""; ?>
			value="1" /> Yes</label> <label> <input
			name="USPS_INTL<?php echo $i; ?>" type="radio"
			<?php $var_name = "\$int_option"; eval("\$var = $var_name;"); if ($var  == 0) echo "checked=\"checked\""; ?>
			value="0" /> No</label></td>
		<td><?php $var_name = "_VM_LANG_USPS_INTL".$i; eval("\$var = $var_name;"); echo mm_ToolTip($var) ?></td>
	</tr>
	<?php $i++; ?>
	<?php endwhile; ?>	
	
	</table>
<?php
   // return false if there's no configuration
   return true;
	} //end function show_configuration

	/**
  * Returns the "is_writeable" status of the configuration file
  * @param void
  * @returns boolean True when the configuration file is writeable, false when not
  */
	function configfile_writeable() {
		return is_writeable( CLASSPATH."shipping/".__CLASS__.".cfg.php" );
	} //end function configfile_writable

	/**
	* Writes the configuration file for this shipping method
	* @param array An array of objects
	* @returns boolean True when writing was successful
	*/
	function write_configuration( &$d ) {
	    global $vmLogger;
		
		$my_config_array = array("USPS_USERNAME" => vmGet( $d, 'USPS_USERNAME' ),
		"USPS_PASSWORD" => vmGet( $d, 'USPS_PASSWORD' ),
		"USPS_SERVER" => vmGet( $d, 'USPS_SERVER' ),
		"USPS_PATH" => vmGet( $d, 'USPS_PATH' ),
		"USPS_PACKAGESIZE" => vmGet( $d, 'USPS_PACKAGESIZE' ),
		"USPS_TAX_CLASS" => vmGet( $d, 'USPS_TAX_CLASS' ),
		"USPS_HANDLINGFEE" => vmGet( $d, 'USPS_HANDLINGFEE' ),
		"USPS_PADDING" => vmGet( $d, 'USPS_PADDING' ),
		"USPS_INTLLBRATE" => vmGet( $d, 'USPS_INTLLBRATE' ),
		"USPS_INTLHANDLINGFEE" => vmGet( $d, 'USPS_INTLHANDLINGFEE' ),
		"USPS_MACHINABLE" => vmGet( $d, 'USPS_MACHINABLE' ),
		"USPS_SHOW_DELIVERY_QUOTE" => vmGet( $d, 'USPS_SHOW_DELIVERY_QUOTE' ),
		"USPS_SHIP0" => vmGet( $d, 'USPS_SHIP0' ),
		"USPS_SHIP1" => vmGet( $d, 'USPS_SHIP1' ),
		"USPS_SHIP2" => vmGet( $d, 'USPS_SHIP2' ),
		"USPS_SHIP3" => vmGet( $d, 'USPS_SHIP3' ),
		"USPS_SHIP4" => vmGet( $d, 'USPS_SHIP4' ),
		"USPS_SHIP5" => vmGet( $d, 'USPS_SHIP5' ),
		"USPS_SHIP6" => vmGet( $d, 'USPS_SHIP6' ),
		"USPS_SHIP7" => vmGet( $d, 'USPS_SHIP7' ),
		"USPS_SHIP8" => vmGet( $d, 'USPS_SHIP8' ),
		"USPS_SHIP9" => vmGet( $d, 'USPS_SHIP9' ),
		"USPS_SHIP10" => vmGet( $d, 'USPS_SHIP10' ),
		"USPS_INTL0" => vmGet( $d, 'USPS_INTL0' ),
		"USPS_INTL1" => vmGet( $d, 'USPS_INTL1' ),
		"USPS_INTL2" => vmGet( $d, 'USPS_INTL2' ),
		"USPS_INTL3" => vmGet( $d, 'USPS_INTL3' ),
		"USPS_INTL4" => vmGet( $d, 'USPS_INTL4' ),
		"USPS_INTL5" => vmGet( $d, 'USPS_INTL5' ),
		"USPS_INTL6" => vmGet( $d, 'USPS_INTL6' ),
		"USPS_INTL7" => vmGet( $d, 'USPS_INTL7' ),
		"USPS_INTL8" => vmGet( $d, 'USPS_INTL8' ),
		//"USPS_INTL9" => vmGet( $d, 'USPS_INTL9']
		);
		$config = "<?php\n";
		$config .= "if( !defined( '_VALID_MOS' ) && !defined( '_JEXEC' ) ) die( 'Direct Access to '.basename(__FILE__).' is not allowed.' ); \n\n";
		foreach( $my_config_array as $key => $value ) {
			$value = str_replace("'", "\'", $value );
			$config .= "define ('$key', '$value');\n";
		}

		$config .= "?>";

		if ($fp = fopen(CLASSPATH ."shipping/".__CLASS__.".cfg.php", "w")) {
			fputs($fp, $config, strlen($config));
			fclose ($fp);
			return true;
		}
		else {
			$vmLogger->err( "Error writing to configuration file" );
			return false;
		}
	} //end function write_configuration

}

define( '_VM_LANG_USPS_MACHINABLE', 'Machinable Packages?' );
define( '_VM_LANG_USPS_MACHINABLE_TOOLTIP', 'Can packages be processed on the machine?' );
define( '_VM_LANG_USPS_QUOTE', 'Show Delivery Days Quote?' );
define( '_VM_LANG_USPS_QUOTE_TOOLTIP', 'Show Delivery Days Quote?' );
define( '_VM_LANG_USPS_SHIP', 'Domestic Shipping Options' );
define( '_VM_LANG_USPS_PADDING_TOOLTIP', 'Pad the shipping weight to allow weight for shipping materials' );
define( '_VM_LANG_USPS_SHIP0', 'USPS Express Mail PO to PO' );
define( '_VM_LANG_USPS_SHIP1', 'USPS Express Mail' );
define( '_VM_LANG_USPS_SHIP2', 'USPS Express Mail Flat-Rate Envelope' );
define( '_VM_LANG_USPS_SHIP3', 'USPS Priority Mail' );
define( '_VM_LANG_USPS_SHIP4', 'USPS Priority Mail Flat Rate Envelope' );
define( '_VM_LANG_USPS_SHIP5', 'USPS Priority Mail Flat Rate Box' );
define( '_VM_LANG_USPS_SHIP6', 'USPS First-Class Mail' );
define( '_VM_LANG_USPS_SHIP7', 'USPS Parcel Post' );
define( '_VM_LANG_USPS_SHIP8', 'USPS Bound Printed Matter' );
define( '_VM_LANG_USPS_SHIP9', 'USPS Media Mail' );
define( '_VM_LANG_USPS_SHIP10', 'USPS Library Mail' );
define( '_VM_LANG_USPS_INTL', 'International Shipping Options' );
define( '_VM_LANG_USPS_INTL0', 'USPS Global Express Guaranteed' );
define( '_VM_LANG_USPS_INTL1', 'USPS Global Express Guaranteed Non-Document Rectangular' );
define( '_VM_LANG_USPS_INTL2', 'USPS Global Express Non-Rectangular' );
define( '_VM_LANG_USPS_INTL3', 'USPS Express Mail International (EMS)' );
define( '_VM_LANG_USPS_INTL4', 'USPS Express Mail International (EMS) Flat Rate Envelope' );
define( '_VM_LANG_USPS_INTL5', 'USPS Priority Mail International' );
define( '_VM_LANG_USPS_INTL6', 'USPS Priority Mail International Flat Rate Envelope' );
define( '_VM_LANG_USPS_INTL7', 'USPS Priority Mail International Flat Rate Box' );
define( '_VM_LANG_USPS_INTL8', 'USPS First-Class Mail International' );
//define( '_VM_LANG_USPS_INTL9', 'Currently Not Used - Do Not Select' );
?>
