<?php
if( !defined( '_VALID_MOS' ) && !defined( '_JEXEC' ) ) die( 'Direct Access to '.basename(__FILE__).' is not allowed.' ); 
/**
*
* @package VirtueMart
* @subpackage languages
* @copyright Copyright (C) 2004-2008 soeren - All rights reserved.
* @translator soeren
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
* VirtueMart is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* See /administrator/components/com_virtuemart/COPYRIGHT.php for copyright notices and details.
*
* http://virtuemart.net
*/
global $VM_LANG;
$langvars = array (
	'CHARSET' => 'ISO-8859-1',
	'PHPSHOP_MODULE_LIST_ORDER' => 'ListOrder',
	'PHPSHOP_PRODUCT_INVENTORY_LBL' => 'Product Inventory',
	'PHPSHOP_PRODUCT_INVENTORY_STOCK' => 'Number',
	'PHPSHOP_PRODUCT_INVENTORY_WEIGHT' => 'Weight',
	'PHPSHOP_PRODUCT_LIST_PUBLISH' => 'Publish',
	'PHPSHOP_PRODUCT_LIST_SEARCH_BY_DATE' => 'Search Product',
	'PHPSHOP_PRODUCT_LIST_SEARCH_BY_DATE_TYPE_PRODUCT' => 'modified',
	'PHPSHOP_PRODUCT_LIST_SEARCH_BY_DATE_TYPE_PRICE' => 'with price modified',
	'PHPSHOP_PRODUCT_LIST_SEARCH_BY_DATE_TYPE_WITHOUTPRICE' => 'without price',
	'PHPSHOP_PRODUCT_LIST_SEARCH_BY_DATE_AFTER' => 'After',
	'PHPSHOP_PRODUCT_LIST_SEARCH_BY_DATE_BEFORE' => 'Before',
	'PHPSHOP_PRODUCT_FORM_SHOW_FLYPAGE' => 'View current product flypage in shop',
	'PHPSHOP_PRODUCT_FORM_NEW_PRODUCT_LBL' => 'New Product',
	'PHPSHOP_PRODUCT_FORM_PRODUCT_INFO_LBL' => 'Product Information',
	'PHPSHOP_PRODUCT_FORM_PRODUCT_STATUS_LBL' => 'Product Status',
	'PHPSHOP_PRODUCT_FORM_PRODUCT_DIM_WEIGHT_LBL' => 'Product Dimensions and Weight',
	'PHPSHOP_PRODUCT_FORM_PRODUCT_IMAGES_LBL' => 'Product Images',
	'PHPSHOP_PRODUCT_FORM_UPDATE_ITEM_LBL' => 'Update Item',
	'PHPSHOP_PRODUCT_FORM_ITEM_INFO_LBL' => 'Item Information',
	'PHPSHOP_PRODUCT_FORM_ITEM_STATUS_LBL' => 'Item Status',
	'PHPSHOP_PRODUCT_FORM_ITEM_DIM_WEIGHT_LBL' => 'Item Dimensions and Weight',
	'PHPSHOP_PRODUCT_FORM_ITEM_IMAGES_LBL' => 'Item Images',
	'PHPSHOP_PRODUCT_FORM_IMAGE_UPDATE_LBL' => 'To update actual image, type in path to new image.',
	'PHPSHOP_PRODUCT_FORM_IMAGE_DELETE_LBL' => 'Delete current image.',
	'PHPSHOP_PRODUCT_FORM_PRODUCT_ITEMS_LBL' => 'Product Items',
	'PHPSHOP_PRODUCT_FORM_ITEM_ATTRIBUTES_LBL' => 'Item Attributes',
	'PHPSHOP_PRODUCT_FORM_DELETE_PRODUCT_MSG' => 'Are you sure you want to delete this Product\nand the Items related to it?',
	'PHPSHOP_PRODUCT_FORM_DELETE_ITEM_MSG' => 'Are you sure you want to delete this Item?',
	'PHPSHOP_PRODUCT_FORM_MANUFACTURER' => 'Manufacturer',
	'PHPSHOP_PRODUCT_FORM_SKU' => 'SKU',
	'PHPSHOP_PRODUCT_FORM_NAME' => 'Name',
	'PHPSHOP_PRODUCT_FORM_CATEGORY' => 'Category',
	'PHPSHOP_PRODUCT_FORM_AVAILABLE_DATE' => 'Availability Date',
	'PHPSHOP_PRODUCT_FORM_SPECIAL' => 'On Special',
	'PHPSHOP_PRODUCT_FORM_DISCOUNT_TYPE' => 'Discount Type',
	'PHPSHOP_PRODUCT_FORM_PUBLISH' => 'Publish?',
	'PHPSHOP_PRODUCT_FORM_LENGTH' => 'Length',
	'PHPSHOP_PRODUCT_FORM_WIDTH' => 'Width',
	'PHPSHOP_PRODUCT_FORM_HEIGHT' => 'Height',
	'PHPSHOP_PRODUCT_FORM_DIMENSION_UOM' => 'Unit of Measure',
	'PHPSHOP_PRODUCT_FORM_WEIGHT_UOM' => 'Unit of Measure',
	'PHPSHOP_PRODUCT_FORM_FULL_IMAGE' => 'Full Image',
	'PHPSHOP_PRODUCT_FORM_WEIGHT_UOM_DEFAULT' => 'pounds',
	'PHPSHOP_PRODUCT_FORM_DIMENSION_UOM_DEFAULT' => 'inches',
	'PHPSHOP_PRODUCT_FORM_PACKAGING' => 'Units in Packaging',
	'PHPSHOP_PRODUCT_FORM_PACKAGING_DESCRIPTION' => 'Here you can fill in a number unit in packaging. (max. 65535)',
	'PHPSHOP_PRODUCT_FORM_BOX' => 'Units in Box',
	'PHPSHOP_PRODUCT_FORM_BOX_DESCRIPTION' => 'Here you can fill in a number unit in box. (max. 65535)',
	'PHPSHOP_PRODUCT_DISPLAY_ADD_PRODUCT_LBL' => 'Product Add Results',
	'PHPSHOP_PRODUCT_DISPLAY_UPDATE_PRODUCT_LBL' => 'Product Update Results',
	'PHPSHOP_PRODUCT_DISPLAY_ADD_ITEM_LBL' => 'Item Add Results',
	'PHPSHOP_PRODUCT_DISPLAY_UPDATE_ITEM_LBL' => 'Item Update Results',
	'PHPSHOP_CATEGORY_FORM_LBL' => 'Category Information',
	'PHPSHOP_CATEGORY_FORM_NAME' => 'Category Name',
	'PHPSHOP_CATEGORY_FORM_PARENT' => 'Parent',
	'PHPSHOP_CATEGORY_FORM_DESCRIPTION' => 'Category Description',
	'PHPSHOP_CATEGORY_FORM_PUBLISH' => 'Publish?',
	'PHPSHOP_CATEGORY_FORM_FLYPAGE' => 'Category Flypage',
	'PHPSHOP_ATTRIBUTE_LIST_LBL' => 'Attribute List for',
	'PHPSHOP_ATTRIBUTE_LIST_NAME' => 'Attribute Name',
	'PHPSHOP_ATTRIBUTE_LIST_ORDER' => 'List Order',
	'PHPSHOP_ATTRIBUTE_FORM_LBL' => 'Attribute Form',
	'PHPSHOP_ATTRIBUTE_FORM_NEW_FOR_PRODUCT' => 'New Attribute for Product',
	'PHPSHOP_ATTRIBUTE_FORM_UPDATE_FOR_PRODUCT' => 'Update Attribute for Product',
	'PHPSHOP_ATTRIBUTE_FORM_NEW_FOR_ITEM' => 'New Attribute for Item',
	'PHPSHOP_ATTRIBUTE_FORM_UPDATE_FOR_ITEM' => 'Update Attribute for Item',
	'PHPSHOP_ATTRIBUTE_FORM_NAME' => 'Attribute Name',
	'PHPSHOP_ATTRIBUTE_FORM_ORDER' => 'List Order',
	'PHPSHOP_PRICE_LIST_FOR_LBL' => 'Price for',
	'PHPSHOP_PRICE_LIST_GROUP_NAME' => 'Group Name',
	'PHPSHOP_PRICE_LIST_PRICE' => 'Price',
	'PHPSHOP_PRODUCT_LIST_CURRENCY' => 'Currency',
	'PHPSHOP_PRICE_FORM_LBL' => 'Price Information',
	'PHPSHOP_PRICE_FORM_NEW_FOR_PRODUCT' => 'New Price for Product',
	'PHPSHOP_PRICE_FORM_UPDATE_FOR_PRODUCT' => 'Update Price for Product',
	'PHPSHOP_PRICE_FORM_NEW_FOR_ITEM' => 'New Price for Item',
	'PHPSHOP_PRICE_FORM_UPDATE_FOR_ITEM' => 'Update Price for Item',
	'PHPSHOP_PRICE_FORM_PRICE' => 'Price',
	'PHPSHOP_PRICE_FORM_CURRENCY' => 'Currency',
	'PHPSHOP_PRICE_FORM_GROUP' => 'Shopper Group',
	'PHPSHOP_LEAVE_BLANK' => '(leave BLANK if you have <br />no individual php-file for it!)',
	'PHPSHOP_PRODUCT_FORM_ITEM_LBL' => 'Item',
	'PHPSHOP_PRODUCT_DISCOUNT_STARTDATE' => 'Startdate of discount',
	'PHPSHOP_PRODUCT_DISCOUNT_STARTDATE_TIP' => 'Specifies the day when the discount begins',
	'PHPSHOP_PRODUCT_DISCOUNT_ENDDATE' => 'End date of discount',
	'PHPSHOP_PRODUCT_DISCOUNT_ENDDATE_TIP' => 'Specifies the day when the discount ends',
	'PHPSHOP_FILEMANAGER_PUBLISHED' => 'Published?',
	'PHPSHOP_FILES_LIST' => 'FileManager::Image/File List for',
	'PHPSHOP_FILES_LIST_FILENAME' => 'Filename',
	'PHPSHOP_FILES_LIST_FILETITLE' => 'File Title',
	'PHPSHOP_FILES_LIST_FILETYPE' => 'File Type',
	'PHPSHOP_FILES_LIST_FULL_IMG' => 'Full Image',
	'PHPSHOP_FILES_LIST_THUMBNAIL_IMG' => 'Thumbnail Image',
	'PHPSHOP_FILES_FORM' => 'Upload a File for',
	'PHPSHOP_FILES_FORM_CURRENT_FILE' => 'Current File',
	'PHPSHOP_FILES_FORM_FILE' => 'additional File',
	'PHPSHOP_FILES_FORM_IMAGE' => 'additional Image',
	'PHPSHOP_FILES_FORM_UPLOAD_TO' => 'Upload to',
	'PHPSHOP_FILES_FORM_UPLOAD_IMAGEPATH' => 'default Product Image Path',
	'PHPSHOP_FILES_FORM_UPLOAD_OWNPATH' => 'Specify the file location',
	'PHPSHOP_FILES_FORM_UPLOAD_DOWNLOADPATH' => 'Download Path (e.g. for selling downloadables!)',
	'PHPSHOP_FILES_FORM_AUTO_THUMBNAIL' => 'Auto-Create Thumbnail?',
	'PHPSHOP_FILES_FORM_FILE_PUBLISHED' => 'File is published?',
	'PHPSHOP_FILES_FORM_FILE_TITLE' => 'File Title (what the Customer sees)',
	'PHPSHOP_FILES_FORM_FILE_URL' => 'File URL (optional)',
	'PHPSHOP_PRODUCT_FORM_AVAILABILITY_TOOLTIP1' => 'Fill in any text here that will be displayed to the customer on the product flypage.<br />e.g.: 24h, 48 hours, 3 - 5 days, On Order.....',
	'PHPSHOP_PRODUCT_FORM_AVAILABILITY_TOOLTIP2' => 'OR select an Image to be displayed on the Details Page (flypage).<br />The images reside in the directory <i>%s</i><br />',
	'PHPSHOP_PRODUCT_FORM_CUSTOM_ATTRIBUTE_LIST_EXAMPLES' => '<h4>Examples for the Custom attribute List Format:</h4>
        <pre>Name;Extras;</strong>...</pre>',
	'PHPSHOP_IMAGE_ACTION' => 'Image Action',
	'PHPSHOP_PARAMETERS_LBL' => 'Parameters',
	'PHPSHOP_PRODUCT_TYPE_LBL' => 'Product Type',
	'PHPSHOP_PRODUCT_PRODUCT_TYPE_LIST_LBL' => 'Product Type List for',
	'PHPSHOP_PRODUCT_PRODUCT_TYPE_FORM_LBL' => 'Add Product Type for',
	'PHPSHOP_PRODUCT_PRODUCT_TYPE_FORM_PRODUCT_TYPE' => 'Product Type',
	'PHPSHOP_PRODUCT_TYPE_FORM_NAME' => 'Product Type Name',
	'PHPSHOP_PRODUCT_TYPE_FORM_DESCRIPTION' => 'Product Type Description',
	'PHPSHOP_PRODUCT_TYPE_FORM_PARAMETERS' => 'Parameters',
	'PHPSHOP_PRODUCT_TYPE_FORM_LBL' => 'Product Type Information',
	'PHPSHOP_PRODUCT_TYPE_FORM_PUBLISH' => 'Publish?',
	'PHPSHOP_PRODUCT_TYPE_FORM_BROWSEPAGE' => 'Product Type Browse Page',
	'PHPSHOP_PRODUCT_TYPE_FORM_FLYPAGE' => 'Product Type Flypage',
	'PHPSHOP_PRODUCT_TYPE_PARAMETER_LIST_LBL' => 'Parameters of Product Type',
	'PHPSHOP_PRODUCT_TYPE_PARAMETER_FORM_LBL' => 'Parameter Information',
	'PHPSHOP_PRODUCT_TYPE_PARAMETER_FORM_NOT_FOUND' => 'Product Type not found!',
	'PHPSHOP_PRODUCT_TYPE_PARAMETER_FORM_NAME' => 'Parameter Name',
	'PHPSHOP_PRODUCT_TYPE_PARAMETER_FORM_NAME_DESCRIPTION' => 'This name will be column name of table. Must be unique and without space.<br/>For example: main_material',
	'PHPSHOP_PRODUCT_TYPE_PARAMETER_FORM_LABEL' => 'Parameter Label',
	'PHPSHOP_PRODUCT_TYPE_PARAMETER_FORM_TYPE_INTEGER' => 'Integer',
	'PHPSHOP_PRODUCT_TYPE_PARAMETER_FORM_TYPE_TEXT' => 'Text',
	'PHPSHOP_PRODUCT_TYPE_PARAMETER_FORM_TYPE_SHORTTEXT' => 'Short Text',
	'PHPSHOP_PRODUCT_TYPE_PARAMETER_FORM_TYPE_FLOAT' => 'Float',
	'PHPSHOP_PRODUCT_TYPE_PARAMETER_FORM_TYPE_CHAR' => 'Char',
	'PHPSHOP_PRODUCT_TYPE_PARAMETER_FORM_TYPE_DATETIME' => 'Date & Time',
	'PHPSHOP_PRODUCT_TYPE_PARAMETER_FORM_TYPE_DATE' => 'Date',
	'PHPSHOP_PRODUCT_TYPE_PARAMETER_FORM_TYPE_TIME' => 'Time',
	'PHPSHOP_PRODUCT_TYPE_PARAMETER_FORM_TYPE_BREAK' => 'Break Line',
	'PHPSHOP_PRODUCT_TYPE_PARAMETER_FORM_TYPE_MULTIVALUE' => 'Multiple Values',
	'PHPSHOP_PRODUCT_TYPE_PARAMETER_FORM_VALUES' => 'Possible Values',
	'PHPSHOP_PRODUCT_TYPE_PARAMETER_FORM_MULTISELECT' => 'Show Possible Values as Multiple select?',
	'PHPSHOP_PRODUCT_TYPE_PARAMETER_FORM_VALUES_DESCRIPTION' => '<strong>If Possible Values are set, Parameter can have only this values. Example for Possible Values:</strong><br/><span class="sectionname">Steel;Wood;Plastic;...</span>',
	'PHPSHOP_PRODUCT_TYPE_PARAMETER_FORM_DEFAULT' => 'Default Value',
	'PHPSHOP_PRODUCT_TYPE_PARAMETER_FORM_DEFAULT_HELP_TEXT' => 'For Parameter Default Value use this format:<ul><li>Date: YYYY-MM-DD</li><li>Time: HH:MM:SS</li><li>Date & Time: YYYY-MM-DD HH:MM:SS</li></ul>',
	'PHPSHOP_PRODUCT_TYPE_PARAMETER_FORM_UNIT' => 'Unit',
	'PHPSHOP_PRODUCT_CLONE' => 'Clone Product',
	'PHPSHOP_HIDE_OUT_OF_STOCK' => 'Hide out of stock products',
	'PHPSHOP_FEATURED_PRODUCTS_LIST_LBL' => 'Featured & Discounted Products',
	'PHPSHOP_FEATURED' => 'Featured',
	'PHPSHOP_SHOW_FEATURED_AND_DISCOUNTED' => 'featured AND discounted',
	'PHPSHOP_SHOW_DISCOUNTED' => 'discounted products',
	'PHPSHOP_FILTER' => 'Filter',
	'PHPSHOP_PRODUCT_FORM_DISCOUNTED_PRICE' => 'Discounted Price',
	'PHPSHOP_PRODUCT_FORM_DISCOUNTED_PRICE_TIP' => 'Here you can override the discount setting fill in a special discount price for this product.<br/>
		The Shop will create a new discount record from the discounted price.',
	'PHPSHOP_PRODUCT_LIST_QUANTITY_START' => 'Quantity Start',
	'PHPSHOP_PRODUCT_LIST_QUANTITY_END' => 'Quantity End',
	'VM_PRODUCTS_MOVE_LBL' => 'Move products from one category to another',
	'VM_PRODUCTS_MOVE_LIST' => 'You have chosen to move the following %s products',
	'VM_PRODUCTS_MOVE_TO_CATEGORY' => 'Move to the following category',
	'VM_PRODUCT_LIST_REORDER_TIP' => 'Select a product category to reorder products in a category',
	'VM_REVIEW_FORM_LBL' => 'Add Review',
	'PHPSHOP_REVIEW_EDIT' => 'Add/Edit a Review',
	'SEL_CATEGORY' => 'Select a category',
	'VM_PRODUCT_FORM_MIN_ORDER' => 'Minimum Purchase Quantity',
	'VM_PRODUCT_FORM_MAX_ORDER' => 'Maximum Purchase Quantity',
	'VM_DISPLAY_TABLE_HEADER' => 'Display Table Header',
	'VM_DISPLAY_LINK_TO_CHILD' => 'Link to child product from list',
	'VM_DISPLAY_INCLUDE_PRODUCT_TYPE' => 'Include Product Type With Child',
	'VM_DISPLAY_USE_LIST_BOX' => 'Use List box for child products',
	'VM_DISPLAY_LIST_STYLE' => 'List Style',
	'VM_DISPLAY_USE_PARENT_LABEL' => 'Use Parent Settings:',
	'VM_DISPLAY_LIST_TYPE' => 'List:',
	'VM_DISPLAY_QUANTITY_LABEL' => 'Quantity:',
	'VM_DISPLAY_QUANTITY_DROPDOWN_LABEL' => 'Drop Down Box Values',
	'VM_DISPLAY_CHILD_DESCRIPTION' => 'Display Child Description',
	'VM_DISPLAY_DESC_WIDTH' => 'Child Description Width',
	'VM_DISPLAY_ATTRIB_WIDTH' => 'Child Attribute Width',
	'VM_DISPLAY_CHILD_SUFFIX' => 'Child Class Suffix',
	'VM_INCLUDED_PRODUCT_ID' => 'Product IDs to include',
	'VM_EXTRA_PRODUCT_ID' => 'Extra IDs',
	'PHPSHOP_DISPLAY_RADIOBOX' => 'Use Radio Box',
	'PHPSHOP_PRODUCT_FORM_ITEM_DISPLAY_LBL' => 'Display Options',
	'PHPSHOP_DISPLAY_USE_PARENT' => 'Override Child products Display Values and use parents',
	'PHPSHOP_DISPLAY_NORMAL' => 'Standard Quantity Box',
	'PHPSHOP_DISPLAY_HIDE' => 'Hide Quantity Box',
	'PHPSHOP_DISPLAY_DROPDOWN' => 'Use Dropdown Box',
	'PHPSHOP_DISPLAY_CHECKBOX' => 'Use Check Box',
	'PHPSHOP_DISPLAY_ONE' => 'One Add to Cart Button',
	'PHPSHOP_DISPLAY_MANY' => 'Add to Cart Button for each Child',
	'PHPSHOP_DISPLAY_START' => 'Start Value',
	'PHPSHOP_DISPLAY_END' => 'End Value',
	'PHPSHOP_DISPLAY_STEP' => 'Step Value',
	'PRODUCT_WAITING_LIST_TAB' => 'Waiting List',
	'PRODUCT_WAITING_LIST_USERLIST' => 'Users waiting to be notified when this product is back in stock',
	'PRODUCT_WAITING_LIST_NOTIFYUSERS' => 'Notify these users now (when you have updated the number of products stock)',
	'PRODUCT_WAITING_LIST_NOTIFIED' => 'notified',
	'VM_PRODUCT_FORM_AVAILABILITY_SELECT_IMAGE' => 'Select Image',
	'VM_PRODUCT_RELATED_SEARCH' => 'Search for Products or Categories here:',
	'VM_FILES_LIST_ROLE' => 'Role',
	'VM_FILES_LIST_UP' => 'Up',
	'VM_FILES_LIST_GO_UP' => 'Go Up',
	'VM_CATEGORY_FORM_PRODUCTS_PER_ROW' => 'Show x products per row',
	'VM_CATEGORY_FORM_BROWSE_PAGE' => 'Category Browse Page',
	'VM_PRODUCT_CLONE_OPTIONS_TAB' => 'Clone Product Options',
	'VM_PRODUCT_CLONE_OPTIONS_LBL' => 'Also clone these Child Items',
	'VM_PRODUCT_LIST_MEDIA' => 'Media',
	'VM_REVIEW_LIST_NAMEDATE' => 'Name/Date',
	'VM_PRODUCT_SELECT_ONE_OR_MORE' => 'Select one or more Products',
	'VM_PRODUCT_SEARCHING' => 'Searching...',
	'PHPSHOP_PRODUCT_FORM_ATTRIBUTE_LIST_EXAMPLES' => '<h4>Examples for the Attribute List Format:</h4>
Title = Color, Property = Red ; Click on New Property to add a new color: Green ; Then click on New attribute to add a new attribute, and so on.
<h4>Inline price adjustments for using the Advanced Attributes modification:</h4>
Price = +10 to add this amount to the configured price.<br />  Price = -10 to subtract this amount from the configured price.<br />  Price = 10 to set the product\'s price to this amount.',
	'VM_FILES_FORM_PRODUCT_IMAGE' => 'Product Image (full and thumb)',
	'VM_FILES_FORM_DOWNLOADABLE' => 'Downloadable Product File (to be sold!)',
	'VM_FILES_FORM_RESIZE_IMAGE' => 'Resize Full Image File?'
); $VM_LANG->initModule( 'product', $langvars );
?>