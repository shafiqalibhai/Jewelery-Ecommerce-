<?php
if( !defined( '_VALID_MOS' ) && !defined( '_JEXEC' ) ) die( 'Direct Access to '.basename(__FILE__).' is not allowed.' );
/**
* mambo-phphop Product Categories Module
* NOTE: THIS MODULE REQUIRES AN INSTALLED VirtueMart Component!
*
* @version $Id: mod_virtuemart_product_categories.php
* @package VirtueMart
* @subpackage modules
* 
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
*
* VirtueMart is Free Software.
* VirtueMart comes with absolute no warranty.
*
* www.virtuemart.net
*/
global $jscook_type, $jscookMenu_style, $jscookTree_style;

// Load the virtuemart main parse code
if( file_exists(dirname(__FILE__).'/../../components/com_virtuemart/virtuemart_parser.php' )) {
	require_once( dirname(__FILE__).'/../../components/com_virtuemart/virtuemart_parser.php' );
	$mosConfig_absolute_path = realpath( dirname(__FILE__).'/../..' );
} else {
	require_once( dirname(__FILE__).'/../components/com_virtuemart/virtuemart_parser.php' );
}
if (!function_exists(getXhtmlList)){
  function getXhtmlList($category_id=0, $rankmin, $rankmax, $params, $only_published=true, $keyword = "" ) {
    if (empty($category_id)) {
      $category_id="0";
    }
    $db = &JFactory::getDBO();  
    $parent_id=$category_id;
    $menus_table=array();
    if ($rows = getKidos($parent_id)) {
      $menus_table[]=$rows;
    }
    if ($category_id>0) {
      do {
        $child_id=$parent_id;
        $parent_id=getDady($parent_id);
        $rows = getKidos($parent_id);
        for ($n=0; $n<count($rows); $n++) {
            if ($rows[$n]['id']==$child_id){
              $rows[$n]['active']=1;
            }
            if ($rows[$n]['id']==$category_id){
              $rows[$n]['active']=2;
            }
          }
        $menus_table[] = $rows;
      } while ($parent_id>0);
    }   
    $menus_table = array_reverse($menus_table);
    // output
    return getRowMenu ($menus_table,$rankmin, $rankmax, true, $params);
  }
  function getRowMenu ($rows,$rankmin, $rankmax, $firstPass=false, $params) {
    global $sess ;
    $class_sfx = $params->get( 'class_sfx', "" );
    $Itemidmod = JRequest::getVar('Itemid', '');
    if (!empty($Itemidmod)) {
      $Itemidmod='&Itemid='.$Itemidmod;
    }  
    if (isset($rows[$rankmin])) {
      $html='<ul'.($firstPass?' class="vmLinkMenu'.$class_sfx.'"':'').'>';
      $numLi=0;
      foreach ($rows[$rankmin] as $menu_element) {
          $texte = shopMakeHtmlSafe ($menu_element['name']);
          $link = JFilterOutput::ampReplace(JURI::base()."index.php?option=com_virtuemart&page=shop.browse&category_id=".$menu_element['id'].$Itemidmod);
          if ($menu_element['active']==1) {
            $class = ' class="active item'.$numLi.'"';
          } elseif ($menu_element['active']==2) {
            $class = ' class="active item'.$numLi.'" id="active_menu"';
          } else {
            $class = ' class="item'.$numLi.'"';
          }
          $html.= '<li'.$class.'><a href="'.$link.'" title="'.$texte.'" ><span>'.$texte.'</span></a>';
          if ($menu_element['active']>0 && $rankmin<$rankmax && isset($rows[$rankmin+1])) {
            $html.=getRowMenu ($rows,$rankmin+1, $rankmax,false, $params);
          }
          $html.= '</li>';
          $numLi++;
      }
      $html.="</ul>";
      return $html;
    }
  }
  function getDady($catpid, $only_published=true, $keyword = "") {
    $db = &JFactory::getDBO();
    $query="SELECT category_parent_id FROM #__vm_category_xref WHERE category_child_id=".$catpid;
    $db->setQuery($query);  
    return $db->loadResult();
  }
  function getKidos ($catpid, $only_published=true, $keyword = "") {
    $db = &JFactory::getDBO();
    $query = "SELECT category_id AS id, category_parent_id AS parent, category_name AS name, 0 AS active ".
    "FROM #__vm_category_xref, #__vm_category  ".
    "WHERE category_parent_id = ".$catpid.
    " AND #__vm_category.category_id=#__vm_category_xref.category_child_id ";
    if( $only_published ) {
  			$query .= " AND #__vm_category.category_publish='Y' ";
  		}
    if( !empty( $keyword )) {
      $query .= "AND ( category_name LIKE '%$keyword%' ";
      $query .= "OR category_description LIKE '%$keyword%' ";
      $query .= ") ";
  	}
    $query .= "ORDER BY #__vm_category.list_order ASC, #__vm_category.category_name ASC";
  	$db->setQuery($query);
  	$db->query();
    if ($db->getNumRows()>0) {
      return $db->loadAssocList();
    } else {
      return false;
    }   
  }
}
$category_id = vmGet( $_REQUEST, 'category_id');
global $VM_LANG, $sess;
$rankmin = $params->get( 'link_list_min_rank','0');
$rankmax = $params->get( 'link_list_max_rank', '10' );

echo '
<div class="vmlinklist'.$params->get('moduleclass_sfx','').'">'.
getXhtmlList($category_id, $rankmin, $rankmax, $params).
'
</div>';
?>
