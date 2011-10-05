<?php
if( !defined( '_VALID_MOS' ) && !defined( '_JEXEC' ) ) die( 'Direct Access to '.basename(__FILE__).' is not allowed.' );
/**
* VirtueMart MiniCart Module
*
* @version $Id: mod_virtuemart_cart.php 797 2007-04-06 08:04:36Z soeren_nb $
* @package VirtueMart
* @subpackage modules
*
* @copyright (C) 2004-2007 Soeren Eberhardt
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* VirtueMart is Free Software.
* VirtueMart comes with absolute no warranty.
*
* www.virtuemart.net
*/

/* Load the virtuemart main parse code */
$introtext= $params->get( 'introtext' );
$buttonimage= $params->get( 'buttonimage' );
$buttontext= $params->get( 'buttontext' );
$textsize= $params->get( 'textsize' );
$imageortext= $params->get( 'imageortext' );

$LiveSite = JURI::base();

if( file_exists(dirname(__FILE__).'/../../components/com_virtuemart/virtuemart_parser.php' )) {
	require_once( dirname(__FILE__).'/../../components/com_virtuemart/virtuemart_parser.php' );
} else {
	require_once( dirname(__FILE__).'/../components/com_virtuemart/virtuemart_parser.php' );
}

$cart = $_SESSION['cart'];
$auth = $_SESSION['auth'];
?>
<?php  if ($cart["idx"] == 0) {
}
else {
echo "
<div style='text-align:center;padding-top:12px;'>
	<a href='index.php?page=checkout.index&option=com_virtuemart&Itemid=26'>";
		
		
			if ($imageortext == "0") { 
echo "<img src='". $buttonimage. "' alt='Check out now' border='0' style='padding-bottom:10px;'/>";
} else {
echo "<span style='font-size:". $textsize. ";'><strong>". $buttontext.  "</strong></span><br/><br/>";
 }
		
		
	echo "</a>
</div>
<span style='font-size:". $textsize. ";font-family:arial;color:#000000;'>
	". $introtext ."
</span>
<hr size='1' color='#A1A1A1'>";
}
?>

<?php
global $VM_LANG, $sess, $mm_action_url;
$class_sfx = $params->get( 'class_sfx' );
mm_showMyFileName( __FILE__ );

require_once(CLASSPATH. 'ps_product.php' );
$ps_product =& new ps_product;
require_once(CLASSPATH. 'ps_shipping_method.php' );
require_once(CLASSPATH. 'ps_checkout.php' );
$ps_checkout =& new ps_checkout;
global $CURRENCY_DISPLAY, $VM_LANG, $vars;

  if ($cart["idx"] == 0) {
  
	echo $VM_LANG->_('PHPSHOP_EMPTY_CART');

     $checkout = false;
	 $amount = 0;
  }
  else {
	$my_taxrate = 0;
    $checkout = True;
    $total = $order_taxable = $order_tax = 0;
    $amount = 0;
    $weight_total = 0;
    for ($i=0;$i<$cart["idx"];$i++) {
      $price = $ps_product->get_adjusted_attribute_price($cart[$i]["product_id"],$cart[$i]["description"]);
      $amount += $cart[$i]["quantity"];

      if (@$auth["show_price_including_tax"] == 1) {
        $my_taxrate = $ps_product->get_product_taxrate($cart[$i]["product_id"] );
        $price["product_price"] *= ($my_taxrate+1);
      }
 
/* AJOUT MODIFICATION G3 */
$db_data_prod = new ps_DB;
// Get the product info from the database
        $db_data_prod->query( "SELECT * FROM #__{vm}_product WHERE product_id='".$_SESSION['cart'][$i]["product_id"]."'" );
        $product_parent_id = $db_data_prod->f("product_parent_id");
        if ($product_parent_id != 0) {
        $db_d= new ps_DB;
        $db_d->query("SELECT * FROM #__{vm}_product WHERE product_id='$product_parent_id'" );
        $db_d->next_record();
        }
$product_thumb_image = $product_parent_id!=0 && !$db_data_prod->f("product_thumb_image") ? $db_d->f("product_thumb_image") : $db_data_prod->f("product_thumb_image"); // Change
$productsku = $product_parent_id!=0 && !$db_data_prod->f("product_sku") ? $db_d->f("product_sku") : $db_data_prod->f("product_sku"); // Change
$productname = $product_parent_id!=0 && !$db_data_prod->f("product_name") ? $db_d->f("product_name") : $db_data_prod->f("product_name"); // Change
$productprice = round( $price["product_price"], 2 );
$productquantity = $cart[$i]["quantity"];



echo "<div style='margin-bottom:8px;clear:both;text-align:center;margin-top:8px;'><img src='".$LiveSite."components/com_virtuemart/shop_image/product/$product_thumb_image' width='96' align='middle' alt='image'/></div>";
echo "<div style='float:left;padding-bottom:5px;font-size:". $textsize. ";'><strong>". $productname. "</strong><br/>";
echo "<span style='font-size:". $textsize. ";'>Quantity: ". $productquantity.  "<br/>";
echo "Individual Price: </strong>".$CURRENCY_DISPLAY->getFullValue($productprice). "<br/>";
echo "SKU: ". $productsku. "</span></div>";
echo "<div style='clear:both;'></div><hr size='1' color='#A1A1A1' width='100%'>";
  
      $subtotal = round( $price["product_price"], 2 ) * $cart[$i]["quantity"];
      $total += $subtotal;


		$product_rows[$i]['subtotal'] = $CURRENCY_DISPLAY->getFullValue($subtotal);
		$product_rows[$i]['subtotal_with_tax'] = $CURRENCY_DISPLAY->getFullValue($subtotal * ($my_taxrate+1));  
	  
	  
      $weight_subtotal = ps_shipping_method::get_weight($cart[$i]["product_id"]) * $cart[$i]["quantity"];
      $weight_total += $weight_subtotal;
    }
    
    if( !empty($_SESSION['coupon_discount']) ) {
        $total -= $_SESSION['coupon_discount'];
    }
	
	
	$show_tax = true;
	$ordertotal = 0;
		if ($weight_total != 0 or TAX_VIRTUAL=='1') {
			$order_taxable = $ps_checkout->calc_order_taxable($vars);
			$tax_total = $ps_checkout->calc_order_tax($order_taxable, $vars);
		} else {
			$tax_total = 0;
		}
		if( $auth['show_price_including_tax']) {
			
		}
		
		$tax_total = Round( $order_taxable );
		$tax_total = $ps_checkout->calc_order_tax($order_taxable, $vars);
		$ordertotal = ($tax_total) + ($total);
  }
?>

<?php  if ($amount >= 1) 

echo "
<div style='width:100%;'>
		<div style='padding-top:9px;font-size:11px;'>
			<div style='float:left;font-size:". $textsize. ";'>Item(s) in your cart:</div>
			<div style='float:right;font-size:". $textsize. ";'>(" . $amount ." Items, ". $CURRENCY_DISPLAY->getFullValue($total) .")</div>
			<br style='clear:both;'/>
			<div style='clear:both;'></div>
			
						
</div>
</div>";?> 
