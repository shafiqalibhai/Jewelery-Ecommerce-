<?php
/**
* Module Name : Products List Module
* Created By : Ken Wong (designer@i-onepage.com)
* Created Date : Dec 2007
* Modified By : Dean Beedell (dean.beedell@lightquick.co.uk)
* Create Date : Oct 2008
* 
* @package Joomla
* @copyright Copyright (C) 2005 Open Source Matters. All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
* Joomla! is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* See COPYRIGHT.php for copyright notices and details.
*/

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

//Get configurable parameters

echo "<form name='product_list_form' id='product_list_form' method='post' action='index.php'>\n";

$database = &JFactory::getDBO(); 
$categoryOrder 			= $params->get('category_order',0);
$categoryOrderDirection=$params->get('category_order_direction',0);
$productOrder=$params->get('product_order',0);
$productOrderDirection=$params->get('product_order_direction',0);

$showProduct=$params->get('show_product',0);
$fromDate=$params->get('from_date',null);
$toDate=$params->get('to_date',null);


$arrFromDate=explode('-',$fromDate);
$arrToDate=explode('-',$toDate);

define( "_MOS_NOTRIM", 0x0001 );
define( "_MOS_ALLOWHTML", 0x0002 );
define( "_MOS_ALLOWRAW", 0x0004 );

if($showProduct==2)
{
    $fromDateTimeStamp=mktime(0,0,0,$arrFromDate[0],$arrFromDate[1],$arrFromDate[2]);
    $toDateTimeStamp=mktime(0,0,0,$arrToDate[0],$arrToDate[1],$arrToDate[2]);
}

//Get category list

$sql="Select
	a.category_id as id,
	a.category_name As name,
	b.category_parent_id As parent
	From #__vm_category As a
	Inner Join #__vm_category_xref As b
	On a.category_id=b.category_child_id
	Where a.category_publish='Y'
	";

if($categoryOrder==0)
{
    $sql.=" Order by a.category_name ";
}
else
{
    $sql.=" Order by a.list_order ";
}

if($categoryOrderDirection==0)
{
    $sql.=" ASC ";
}
else
{
    $sql.=" DESC ";
}


$where=array();

if($showProduct!=0)
{
    $where[]="a.product_publish='Y'";
}

if($showProduct==2)
{
    $where[]=" (a.cdate >=$fromDateTimeStamp And a.cdate <= $toDateTimeStamp )";
}

$database = &JFactory::getDBO();
$database->setQuery($sql);
$rowProductCategories=$database->loadObjectList();

$sql="Select a.product_id+10000 as id,a.product_name As name,b.category_id as parent
	  From #__vm_product As a
	  Inner Join #__vm_product_category_xref	As b
	  On a.product_id=b.product_id	  
	";



if(count($where))

$sql.=" Where ".implode(" AND ",$where);


if($productOrder==0)
{
    $sql.=" Order By product_name ";

}
elseif ($productOrder==1)
{
    $sql.=" Order By product_sku ";
}
else
{
    $sql.=" Order By cdate ";
}


if($productOrderDirection==0)
{
    $sql.=" ASC ";
}
else
{
    $sql.=" DESC ";
}

//echo $sql;

$database = &JFactory::getDBO();
$database->setQuery($sql);
$rowproducts=$database->loadObjectList();

$rowproducts=array_merge((array)$rowProductCategories,(array)$rowproducts);

$cid=GetParam($_REQUEST,'cid',0);

$preload=array();
$preload[]=makeOption(0,"Select item");

// ARTIO - need to change the way pages are redirected, URL needs to be SEFed and stored in option value
//global $mosConfig_absolute_path;
require_once( JPATH_SITE.DS.'components'.DS.'com_virtuemart'.DS.'virtuemart_parser.php' );
require_once(CLASSPATH.'ps_product.php');

if( !function_exists('mod_product_list_treelist') ) {
	function mod_product_list_treelist( &$src_list, $src_id, $tgt_list, $tag_name, $tag_attribs, $key, $text, $selected ) {

		// establish the hierarchy of the menu
		$children = array();
		$sel = '';
		$itemid = mod_product_list_getvmitemid();
		
		// first pass - collect children
		foreach ($src_list as $v ) {
		    // Create the URL
		    $cid = $id = $v->id;
		    
		    if( $id > 10000 ) {
		        $id = $id - 10000;
		        // Get the flypage for the product
		        $flypage = ps_product::get_flypage($id);
		        
                    //$v->url = sefRelToAbs('index.php?page=shop.product_details&flypage='.$flypage.'&product_id='.$id.'&manufacturer_id=0&option=com_virtuemart&Itemid='.$itemid.'&cid='.$cid);
                    $v->url = JRoute::_('index.php?page=shop.product_details&flypage='.$flypage.'&product_id='.$id.'&manufacturer_id=0&option=com_virtuemart&Itemid='.$itemid.'&cid='.$cid);
		    } else {
		        //$v->url = sefRelToAbs('index.php?page=shop.browse&category_id='.$id.'&option=com_virtuemart&Itemid='.$itemid.'&cid='.$cid);
		        $v->url = JRoute::_('index.php?page=shop.browse&category_id='.$id.'&option=com_virtuemart&Itemid='.$itemid.'&cid='.$cid);
		    }
		    
		    // Check the selected param
		    if( $v->id == $selected ) {
		        $sel = $v->url;
		    }
		    
			$pt = $v->parent;
			$list = @$children[$pt] ? $children[$pt] : array();
			array_push( $list, $v );
			$children[$pt] = $list;
		}
		// second pass - get an indent list of the items
		$ilist = TreeRecurse( 0, '', array(), $children );

		// assemble menu items to the array
		$this_treename = '';
		foreach ($ilist as $item) {
			if ($this_treename) {
				if ($item->id != $src_id && strpos( $item->treename, $this_treename ) === false) {
					$tgt_list[] = makeOption( $item->url, $item->treename );
				}
			} else {
				if ($item->id != $src_id) {
					$tgt_list[] = makeOption( $item->url, $item->treename );
				} else {
					$this_treename = "$item->treename/";
				}
			}
		}
		// build the html select list
		return selectList( $tgt_list, $tag_name, $tag_attribs, $key, $text, $sel );
	}
}


if( !function_exists('mod_product_list_getvmitemid') ) {
    function mod_product_list_getvmitemid() {
        $database = &JFactory::getDBO();  
        $database->setQuery("SELECT id FROM #__menu WHERE link='index.php?option=com_virtuemart' AND published=1");
        $id = $database->loadResult();
        if( !$id ) {
          $id = GetParam($_REQUEST, 'Itemid', 1);
        }
        return $id;
    }
}


function GetParam( &$arr, $name, $def=null, $mask=0 ) {
        if (isset( $arr[$name] )) {
            if (is_array($arr[$name])) foreach ($arr[$name] as $key=>$element) $result[$key] = mosGetParam ($arr[$name], $key, $def, $mask);
            else {
                $result = $arr[$name];
                if (!($mask&_MOS_NOTRIM)) $result = trim($result);
                if (!is_numeric( $result)) {
                    if (!($mask&_MOS_ALLOWHTML)) $result = strip_tags($result);
                    if (!($mask&_MOS_ALLOWRAW)) {
                        if (is_numeric($def)) $result = intval($result);
                    }
                }
                if (!get_magic_quotes_gpc()) {
                    $result = addslashes( $result );
                }
            }
            return $result;
        } else {
            return $def;
        }
    }








//if( !function_exists('mosTreeRecurse') ) {
      function TreeRecurse( $id, $indent, $list, &$children, $maxlevel=9999, $level=0, $type=1,$parent='parent') {
        if (@$children[$id] AND $level <= $maxlevel) {
            $newindent = $indent.($type ? '.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' : '&nbsp;&nbsp;');
            $pre = $type ? '<sup>L</sup>&nbsp;' : '- ';
            foreach ($children[$id] as $v) {
                $id = $v->id;
                $list[$id] = $v;
                $list[$id]->treename = $indent.($v->$parent == 0 ? '' : $pre).$v->name;
                $list[$id]->children = count( @$children[$id] );
                $list[$id]->level = $level;
                $list = TreeRecurse( $id, $newindent, $list, $children, $maxlevel, $level+1, $type );
            }
        }
        return $list;
    }
//}

function selectList( &$arr, $tag_name, $tag_attribs, $key, $text, $selected=NULL ) {
                 // check if array
                 if ( is_array( $arr ) ) {
                         reset( $arr );
                 }
 
                 $html   = "\n<select name=\"$tag_name\" $tag_attribs>";
                 $count  = count( $arr );
 
                 for ($i=0, $n=$count; $i < $n; $i++ ) {
                         $k = $arr[$i]->$key;
                         $t = $arr[$i]->$text;
                         $id = ( isset($arr[$i]->id) ? @$arr[$i]->id : null);
 
                         $extra = '';
                         $extra .= $id ? " id=\"" . $arr[$i]->id . "\"" : '';
                         if (is_array( $selected )) {
                                 foreach ($selected as $obj) {
                                         $k2 = $obj->$key;
                                         if ($k == $k2) {
                                                 $extra .= " selected=\"selected\"";
                                                 break;
                                         }
                                 }
                         } else {
                                 $extra .= ($k == $selected ? " selected=\"selected\"" : '');
                         }
                         $html .= "\n\t<option value=\"".$k."\"$extra>" . $t . "</option>";
                 }
                 $html .= "\n</select>\n";
 
                 return $html;
         }
 



     
//if( !function_exists('makeOption') ) {     
         function makeOption( $value, $text='', $value_name='value', $text_name='text' ) {
                 $obj = new stdClass;
                 $obj->$value_name = $value;
                 $obj->$text_name = trim( $text ) ? $text : $value;
                 return $obj;
         }

//}



echo mod_product_list_treelist(&$rowproducts,0,$preload,'cid','onchange="gotoVMPage();"','value','text',$cid);
// ARTIO end

echo "</form>";

?>

<script language="javascript">
function gotoVMPage()
{
    var url=document.product_list_form.cid.value;
    location.href=url;
}
</script>
