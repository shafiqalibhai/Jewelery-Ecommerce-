<?php
if( !defined( '_VALID_MOS' ) && !defined( '_JEXEC' ) ) die( 'Direct Access to '.basename(__FILE__).' is not allowed.' );
/*
 * @version $Id: order.label_track.php 1122 2008-01-07 14:52:31Z thepisu $
 * @package VirtueMart
 * @subpackage html
 */
mm_showMyFileName(__FILE__);

$order_id = vmGet($_REQUEST, 'order_id', null);
if (!is_numeric($order_id))
	die(str_replace('order_id',$order_id,$VM_LANG->_('VM_ORDER_LABEL_ORDERID_NOTVALID')));

$db =& new ps_DB;

$q = "SELECT shipper_class, label_is_generated, tracking_number ";
$q .= "FROM #__{vm}_shipping_label ";
$q .= "WHERE order_id='" . $order_id . "'";
$db->query($q);
if (!$db->next_record())
	die($VM_LANG->_('VM_ORDER_LABEL_NOTFOUND'));

include_once(CLASSPATH . "shipping/" . $db->f("shipper_class") . ".php");
eval("\$ship_class =& new " . $db->f("shipper_class") . "();");
if (!is_callable(array($ship_class, 'void_label')))
	die(str_replace('{ship_class}',$ship_class,$VM_LANG->_('VM_ORDER_LABEL_CLASSCANNOT')));

if (!$db->f('label_is_generated'))
	die($VM_LANG->_('VM_ORDER_LABEL_NEVERGENERATED'));

$msg = $ship_class->track($order_id);

echo "<html>\n";
echo "<head><title>" . $VM_LANG->_('VM_ORDER_LABEL_TRACK_TITLE') . "</title></head>\n";
echo "<body>\n";
echo $msg . "\n";
echo "</body>\n";
echo "</html>\n";
?>
