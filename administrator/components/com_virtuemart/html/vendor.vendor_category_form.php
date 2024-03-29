<?php
if( !defined( '_VALID_MOS' ) && !defined( '_JEXEC' ) ) die( 'Direct Access to '.basename(__FILE__).' is not allowed.' ); 
/**
*
* @version $Id: vendor.vendor_category_form.php 1095 2007-12-19 20:19:16Z soeren_nb $
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
mm_showMyFileName( __FILE__ );

//First create the object and let it print a form heading
$formObj = &new formFactory( $VM_LANG->_('PHPSHOP_VENDOR_CAT_FORM_LBL') );
//Then Start the form
$formObj->startForm();

$option = empty($option)?vmGet( $_REQUEST, 'option', 'com_virtuemart'):$option;
$vendor_category_id = vmGet( $_REQUEST, 'vendor_category_id');
if (!empty($vendor_category_id)) {
	$q = "SELECT * FROM #__{vm}_vendor_category ";
	$q .= "WHERE vendor_category_id='$vendor_category_id'";
	$db->query($q);
	$db->next_record();
}
?> 
<table class="adminform">
	<tr> 
                  <td width="38%" nowrap align="right"><strong><?php echo $VM_LANG->_('PHPSHOP_VENDOR_CAT_FORM_INFO_LBL') ?></strong> 
                  </td>
                  <td width="62%">&nbsp;</td>
	</tr>
	<tr> 
		<td width="38%" nowrap align="right"><?php echo $VM_LANG->_('PHPSHOP_VENDOR_CAT_FORM_NAME') ?>:</td>
		<td width="62%"> 
                    <input type="text" class="inputbox" name="vendor_category_name" size="18" value="<?php $db->sp('vendor_category_name') ?>" />
		</td>
	</tr>
	<tr> 
		<td width="38%" nowrap align="right" valign="top"><?php echo $VM_LANG->_('PHPSHOP_VENDOR_CAT_FORM_DESCRIPTION') ?>:</td>
                  <td width="62%" valign="top"> 
                    <textarea name="vendor_category_desc" cols="40" rows="2" wrap="virtual"><?php $db->sp('vendor_category_desc'); ?></textarea>
                  </td>
	</tr>
	<tr> 
                  <td width="38%" nowrap align="right" valign="top">&nbsp;</td>
                  <td width="62%" valign="top">&nbsp;</td>
	</tr>
	<tr> 
		<td align="center">&nbsp; </td>
	</tr>
	<tr> 
		<td align="center">&nbsp;</td>
	</tr>
</table>
<?php
// Add necessary hidden fields
$formObj->hiddenField( 'vendor_category_id', $vendor_category_id );

$funcname = !empty($vendor_category_id) ? "vendorcategoryupdate" : "vendorcategoryadd";

// Write your form with mixed tags and text fields
// and finally close the form:
$formObj->finishForm( $funcname, $modulename.'.vendor_category_list', $option );