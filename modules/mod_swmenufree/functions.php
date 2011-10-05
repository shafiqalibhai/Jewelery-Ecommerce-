<?php
/**
* swmenufree v5.0
* http://swmenupro.com
* Copyright 2006 Sean White
**/

defined( '_JEXEC' ) or die( 'Restricted access' );
function swGetMenu($menu,$id,$hybrid,$cache,$cache_time,$use_table,$parent_id,$levels){

	global $my,$mainframe;

	
	$absolute_path=JPATH_ROOT;
  $live_site = $mainframe->isAdmin() ? $mainframe->getSiteURL() : JURI::base();

	$swmenufree_array=array();
	$ordered=array();
	$file = $absolute_path."/modules/mod_swmenufree/cache/menu.cache";
	$final_menu=array();

	if($cache){
		$data="";
    	 if ( !file_exists($file)){
			touch ($file);
			$handle = fopen ($file, 'w');
			$swmenufree_array=swGetMenuLinks($menu,$id,$hybrid,$use_table);
			$ordered = chain('ID', 'PARENT', 'ORDER', $swmenufree_array, $parent_id, $levels);
			for($i=0;$i<count($ordered);$i++){
				$data.=implode("'..'",$ordered[$i])."\n";
			}
			fwrite ($handle, $data);
			fclose ($handle);
			$final_menu=get_Final_Menu($swmenufree_array, $parent_id, $levels);
		}else if(strtotime($cache_time,filemtime($file))< strtotime("now")&&is_writable($file)){
			$handle = fopen ($file, 'w');
			$swmenufree_array=swGetMenuLinks($menu,$id,$hybrid,$use_table);
			$ordered = chain('ID', 'PARENT', 'ORDER', $swmenufree_array, $parent_id, $levels);
			for($i=0;$i<count($ordered);$i++){
				$data.=implode("'..'",$ordered[$i])."\n";
			}
			fwrite ($handle, $data);
			fclose ($handle);
			$final_menu=get_Final_Menu($swmenufree_array, $parent_id, $levels);
		}else if(file_exists($file)){
			$swmenu=file($file);
			for($i=0;$i<count($swmenu);$i++){
				$swmenufree[]=explode("'..'",$swmenu[$i]);
				$final_menu[] =array("TITLE" => $swmenufree[$i][0], "URL" =>  $swmenufree[$i][1] , "ID" => $swmenufree[$i][2]  , "PARENT" => $swmenufree[$i][3] ,  "ORDER" => $swmenufree[$i][4], "TARGET" => $swmenufree[$i][5],"ACCESS" => $swmenufree[$i][6], "indent"=>trim(substr($swmenu[$i],(strlen($swmenu[$i])-2))));
			}
			$final_menu=get_Final_Menu($final_menu, $parent_id, $levels);
		}
	}else{
		$swmenufree_array=swGetMenuLinks($menu,$id,$hybrid,$use_table);
		$final_menu=get_Final_Menu($swmenufree_array, $parent_id, $levels);
	}
	return $final_menu;
}


function get_Final_Menu($swmenufree_array, $parent_id, $levels){
	global $mainframe;
	$valid=0;
	$my = & JFactory::getUser();
	$final_menu=array();
	for($i=0;$i<count($swmenufree_array);$i++){
		$swmenu=$swmenufree_array[$i];
		
		//if($swmenu['ACCESS']<=$my->gid ){
		if($swmenu['ACCESS']<=$my->get('aid')) {
			if ($swmenu['PARENT']==$parent_id) {
				$valid++;
			}
			
			if (strcasecmp(substr($swmenu['URL'],0,4),"http")) {
			$swmenu['URL'] = JRoute::_($swmenu['URL'],1);
			}
			
			$swmenu['URL']=str_replace('&amp;','&',$swmenu['URL']);
			$final_menu[] =array("TITLE" => $swmenu['TITLE'], "URL" =>  $swmenu['URL'] , "ID" => $swmenu['ID']  , "PARENT" => $swmenu['PARENT'] ,  "ORDER" => $swmenu['ORDER'], "TARGET" => $swmenu['TARGET'],"ACCESS" => $swmenu['ACCESS'] );
		}
	}
	if(count($final_menu)&&$valid){
		$final_menu = chain('ID', 'PARENT', 'ORDER', $final_menu, $parent_id, 25);
	}else{
		$final_menu=array();
	}
	return $final_menu;
}



function swGetMenuLinks($menu,$id,$hybrid,$use_tables){
	global $lang, $database,$my,$absolute_path,$offset;
	$database = &JFactory::getDBO();
	$now = date( "Y-m-d H:i:s", time());
	$swmenufree_array=array();
	if ($menu=="swcontentmenu") {
		$sql =  "SELECT #__sections.* 
                FROM #__sections 
                INNER JOIN #__content ON #__content.sectionid = #__sections.id
                AND #__sections.published = 1
                AND ( publish_up = '0000-00-00 00:00:00' OR publish_up <= '$now'  )
                AND ( publish_down = '0000-00-00 00:00:00' OR publish_down >= '$now' )
                ORDER BY #__content.ordering
                ";
		$database->setQuery( $sql   );
		$result = $database->loadObjectList();

		for($i=0;$i<count($result);$i++) {
			$result2=$result[$i];
			
			if($use_tables){
							$url="index.php?option=com_content&view=section&id=".$result2->id;
							}else{
							$url="index.php?option=com_content&view=section&layout=blog&id=".$result2->id;
							}

			$swmenufree_array[] =array("TITLE" => $result2->title, "URL" =>  $url , "ID" => $result2->id  , "PARENT" => 0 ,  "ORDER" => $result2->ordering, "TARGET" => 0,"ACCESS" => $result2->access );
		}

		$sql =  "SELECT #__categories.* 
				FROM #__categories
                INNER JOIN #__content ON #__content.catid = #__categories.id
                AND #__categories.published = 1
                AND ( publish_up = '0000-00-00 00:00:00' OR publish_up <= '$now'  )
                AND ( publish_down = '0000-00-00 00:00:00' OR publish_down >= '$now' )
                ORDER BY #__content.ordering
                ";

		$database->setQuery( $sql   );
		$result = $database->loadObjectList();

		for($i=0;$i<count($result);$i++) {
			$result2=$result[$i];

						
			if($use_tables){
							$url="index.php?option=com_content&view=category&id=".$result2->id;
							}else{
							$url="index.php?option=com_content&view=category&layout=blog&id=".$result2->id;
							}

			$swmenufree_array[] =array("TITLE" => $result2->title, "URL" =>  $url , "ID" => $result2->id+1000  , "PARENT" => $result2->section ,  "ORDER" => $result2->ordering, "TARGET" => 0,"ACCESS" => $result2->access );
		}

		$sql =  "SELECT #__content.* 
				FROM #__content
                INNER JOIN #__categories ON #__content.catid = #__categories.id
                AND #__content.state = 1
                AND ( publish_up = '0000-00-00 00:00:00' OR publish_up <= '$now'  )
                AND ( publish_down = '0000-00-00 00:00:00' OR publish_down >= '$now' )
                ORDER BY #__content.ordering
                ";
		$database->setQuery( $sql   );
		$result = $database->loadObjectList();

		for($i=0;$i<count($result);$i++) {
			$result2=$result[$i];

			$url="index.php?option=com_content&view=article&catid=".$result2->catid."&id=" . $result2->id ;
			$swmenufree_array[] =array("TITLE" => $result2->title, "URL" =>  $url , "ID" => $result2->id+10000  , "PARENT" => $result2->catid+1000 ,  "ORDER" => $result2->ordering, "TARGET" => 0,"ACCESS" => $result2->access  );
		}
	}else if ($menu=="virtuemart") {
		$sql =  "SELECT #__vm_category.* ,#__vm_category_xref.*
		         FROM #__vm_category 
                INNER JOIN #__vm_category_xref ON #__vm_category_xref.category_child_id= #__vm_category.category_id
                AND #__vm_category.category_publish = 'Y'
                ORDER BY #__vm_category.list_order
                ";
		$database->setQuery( $sql   );
		$result = $database->loadObjectList();

		for($i=0;$i<count($result);$i++) {
			$result2=$result[$i];
			$url="index.php?option=com_virtuemart&page=shop.browse&category_id=" . $result2->category_id . "&Itemid=".($result2->category_id+10000) ;
			$swmenufree_array[] =array("TITLE" => $result2->category_name, "URL" =>  $url , "ID" => ($result2->category_id+10000)  , "PARENT" => ($result2->category_parent_id?($result2->category_parent_id+10000):0) ,  "ORDER" => $result2->list_order, "TARGET" => 0,"ACCESS" => 0 );
		}
	}else{
		if ($hybrid){
				$sql =  "SELECT #__content.*
				FROM #__content
                INNER JOIN #__categories ON #__content.catid = #__categories.id
                AND #__content.state = 1
                AND ( publish_up = '0000-00-00 00:00:00' OR publish_up <= '$now'  )
                AND ( publish_down = '0000-00-00 00:00:00' OR publish_down >= '$now' )
                ORDER BY #__content.catid,#__content.ordering
                ";
			$database->setQuery( $sql   );
			$hybrid_content = $database->loadObjectList();	
			
			
			$sql =  "SELECT #__categories.*
				FROM #__categories
                WHERE #__categories.published = 1
                ORDER BY #__categories.ordering
                ";
			$database->setQuery( $sql   );
			$hybrid_cat = $database->loadObjectList();		
		}
				
		$sql = "SELECT #__menu.* 
				FROM #__menu
                WHERE #__menu.menutype = '".$menu."' AND published = '1'
                ORDER BY parent, ordering
            ";

		$database->setQuery( $sql   );
		$result = $database->loadObjectList();

		$swmenufree_array=array();

		for($i=0;$i<count($result);$i++) {
			$result2=$result[$i];
			

			switch ($result2->type) {
				case 'separator';
				$mylink = "javascript:void(0);";
				break;

				case 'url':
					$mylink = $result2->link;
				if (eregi( "index.php\?", $result2->link )) {
					if (!eregi( "Itemid=", $result2->link )) {
						$mylink .= "&Itemid=$result2->id";
					}
				}
				break;

				case 'menulink';
				$mylink = $result2->link;
				break;
				
				default:
				$mylink = "index.php?Itemid=".$result2->id;
				break;
			}
			$swmenufree_array[] =array("TITLE" => $result2->name, "URL" =>  $mylink , "ID" => $result2->id  , "PARENT" => $result2->parent ,  "ORDER" => $result2->ordering, "TARGET" => $result2->browserNav,"ACCESS" => $result2->access );

			if ($hybrid){
				$opt=array();
				parse_str($result2->link, $opt);
				$opt['view'] = @$opt['view'] ? $opt['view']: 0;
				$opt['id'] = @$opt['id'] ? $opt['id']: 0;
				
				
				if ($opt['view']=="blogcategory" || $opt['view']=="category" ) {
					
				for($j=0;$j<count($hybrid_content);$j++){	
					$row=$hybrid_content[$j];
					if($row->catid==$opt['id']){
						
							$url="index.php?option=com_content&view=article&catid=".$row->catid."&id=" . $row->id ."&Itemid=".$result2->id;
							$swmenufree_array[] =array("TITLE" => $row->title, "URL" =>  $url , "ID" => $row->id+100000  , "PARENT" => $result2->id ,  "ORDER" => $row->ordering, "TARGET" => 0,"ACCESS" => $row->access );
						}	
					}
				}else if ($opt['view']=="blogsection" || $opt['view']=="section" ) {	
				//echo "hello";
				for($j=0;$j<count($hybrid_cat);$j++){	
				$row=$hybrid_cat[$j];
					if($row->section==$opt['id'] && $opt['id']){
						//$j=count($hybrid_cat);
														
							if($use_tables){
							$url="index.php?option=com_content&view=category&id=".$row->id."&Itemid=".$result2->id;
							}else{
							$url="index.php?option=com_content&view=category&layout=blog&id=".$row->id."&Itemid=".$result2->id;
							}
							$swmenufree_array[] =array("TITLE" => $row->title, "URL" =>  $url , "ID" => $row->id+10000  , "PARENT" => $result2->id ,  "ORDER" => $row->ordering, "TARGET" => 0,"ACCESS" => $row->access  );
							
							for($k=0;$k<count($hybrid_content);$k++){	
							$row2=$hybrid_content[$k];
								if($row2->catid==$row->id){
									
									$url="index.php?option=com_content&view=article&catid=".$row->id."&id=" . $row2->id."&Itemid=".$result2->id ;
									$swmenufree_array[] =array("TITLE" => $row2->title, "URL" =>  $url , "ID" => $row2->id+100000  , "PARENT" => $row->id+10000 ,  "ORDER" => $row2->ordering,  "TARGET" => 0,"ACCESS" => $row2->access );
									}	
								}
							}
						}
					}		
				}
			}
		}

	return $swmenufree_array;
}




function chain($primary_field, $parent_field, $sort_field, $rows, $root_id=0, $maxlevel=25)
{
	$c = new chain($primary_field, $parent_field, $sort_field, $rows, $root_id, $maxlevel);
	return $c->chainmenu_table;
}

class chain
{
	var $table;
	var $rows;
	var $chainmenu_table;
	var $primary_field;
	var $parent_field;
	var $sort_field;

	function chain($primary_field, $parent_field, $sort_field, $rows, $root_id, $maxlevel)
	{
		$this->rows = $rows;
		$this->primary_field = $primary_field;
		$this->parent_field = $parent_field;
		$this->sort_field = $sort_field;
		$this->buildchain($root_id,$maxlevel);
	}

	function buildChain($rootcatid,$maxlevel)
   {
       foreach($this->rows as $row)
       {
           $this->table[$row[$this->parent_field]][ $row[$this->primary_field]] = $row;
       }
       $this->makeBranch($rootcatid,0,$maxlevel);
   }

	function makeBranch($parent_id,$level,$maxlevel)
	{
		$rows=$this->table[$parent_id];
		$key_array1 = array_keys($rows);
		$key_array_size1 = sizeOf($key_array1);
		//for ($j=0;$j<$key_array_size1;$j++)
		  foreach($rows as $key=>$value)
		{
			//$key = $key_array1[$j];
			$rows[$key]['key'] = $this->sort_field;
		}

		usort($rows,'chainmenuCMP');
		$row_array = array_values($rows);
		$row_array_size = sizeOf($row_array);
		$i=0;
		 foreach($rows as $item)
		{
			//$item = $row_array[$i];
			$item['ORDER']=($i+1);
			$item['indent'] = $level;
			$i++;
			$this->chainmenu_table[] = $item;
			if((isset($this->table[$item[$this->primary_field]])) && (($maxlevel>$level+1) || ($maxlevel==0)))
			{
				$this->makeBranch($item[$this->primary_field], $level+1, $maxlevel);
			}
		}
	}
}

function chainmenuCMP($a,$b)
{
	if($a[$a['key']] == $b[$b['key']])
	{
		return 0;
	}
	return($a[$a['key']]<$b[$b['key']])?-1:1;
}


function transMenu($ordered, $swmenufree, $active_menu,  $sub_indicator, $parent_id,$selectbox_hack,$auto_position){
	global $mainframe;
	 $live_site = $mainframe->isAdmin() ? $mainframe->getSiteURL() : JURI::base();
	 if(substr($live_site,(strlen($live_site)-1),1)=="/"){$live_site=substr($live_site,0,(strlen($live_site)-1));}
	 
	$str="";
	$name = "";
	$topcounter = 0;
	$counter = 0;
	$number = count(chain('ID', 'PARENT', 'ORDER', $ordered, $parent_id, 1));
	$str.= "<div id=\"wrap\" class=\"menu\" align=\"".$swmenufree['position']."\">\n";
	$str.= "<table cellspacing=\"0\" cellpadding=\"0\" id=\"menu\" class=\"menu\" > \n";
	if (substr($swmenufree['orientation'],0,10)=="horizontal"){$str.= "<tr> \n";}

	foreach($ordered as $top){
		if ($top['indent'] == 0){
			$top['URL'] = str_replace( '&', '&amp;', $top['URL'] );
			$topcounter++;

			$name=$top['TITLE'];

			if (substr($swmenufree['orientation'],0,8)=="vertical"){
				$str.= "<tr> \n";
			}
			if(($topcounter==$number)&&($top["ID"]==$active_menu)){
				$str.= "<td id=\"trans-active\" class='last'> \n";
			}else if($top["ID"]==$active_menu){
				$str.= "<td id='trans-active'> \n";
			}else if($topcounter==$number){
				$str.= "<td class=\"last\"> \n";
			}else{
				$str.= "<td> \n";
			}

			 switch ($top['TARGET']) {
					// cases are slightly different
					case 1:
					// open in a new window
					$str.= '<a id="menu'.$top['ID'].'" href="'. $top['URL'] .'" target="_blank"  >'. $name .'</a>'."\n";
					break;

					case 2:
					// open in a popup window
					$str.= "<a href=\"#\" id=\"menu".$top['ID']."\" onclick=\"javascript: window.open('". $top['URL'] ."', '', 'toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width=780,height=550'); return false\" >". $name ."</a>\n";
					break;

					case 3:
					// don't link it
					$str.= '<a id="menu'.$top['ID'].'" >'. $name .'</a>'."\n";
					break;

					default:	// formerly case 2
					$str.= '<a id="menu'.$top['ID'].'" href="'.$top['URL'] .'" >';

					$str.= $name .'</a>'."\n";

					break;
				}
			
			$counter++;
			$str.= "</td> \n";

			if (substr($swmenufree['orientation'],0,8)=="vertical"){
				$str.= "</tr> \n";
			}
		}
	}
	if (substr($swmenufree['orientation'],0,10)=="horizontal"){$str.= "</tr> \n";}
	$str.= "</table></div> \n";
	$str.= "<div id=\"subwrap\"> \n";
	$str.="<script type=\"text/javascript\">\n";
	$str.="<!--\n";
	$str.="if (TransMenu.isSupported()) {\n";
	
	if($swmenufree['orientation']=="horizontal/down"){
		$str.= "var ms = new TransMenuSet(TransMenu.direction.down, ".$swmenufree['level1_sub_left'].",".$swmenufree['level1_sub_top'].", TransMenu.reference.bottomLeft);\n";
	}elseif($swmenufree['orientation']=="horizontal/up"){
		$str.= "var ms = new TransMenuSet(TransMenu.direction.up, ".$swmenufree['level1_sub_left'].", ".$swmenufree['level1_sub_top'].", TransMenu.reference.topLeft);\n";
	}elseif($swmenufree['orientation']=="horizontal/left"){
		$str.= "var ms = new TransMenuSet(TransMenu.direction.dleft, ".$swmenufree['level1_sub_left'].",".$swmenufree['level1_sub_top'].", TransMenu.reference.bottomRight);\n";
	}elseif($swmenufree['orientation']=="vertical/right"){
		$str.= "var ms = new TransMenuSet(TransMenu.direction.right, ".$swmenufree['level1_sub_left'].", ".$swmenufree['level1_sub_top'].", TransMenu.reference.topRight);\n";
	}elseif($swmenufree['orientation']=="vertical/left"){
		$str.= "var ms = new TransMenuSet(TransMenu.direction.left, ".$swmenufree['level1_sub_left'].", ".$swmenufree['level1_sub_top'].", TransMenu.reference.topLeft);\n";
	}elseif($swmenufree['orientation']=="vertical"){
		$str.= "var ms = new TransMenuSet(TransMenu.direction.right, ".$swmenufree['level1_sub_left'].", ".$swmenufree['level1_sub_top'].", TransMenu.reference.topRight);\n";
	}elseif($swmenufree['orientation']=="horizontal"){
		$str.= "var ms = new TransMenuSet(TransMenu.direction.down, ".$swmenufree['level1_sub_left'].", ".$swmenufree['level1_sub_top'].", TransMenu.reference.bottomLeft);\n";
	}
	$par=$ordered[0];
	
	foreach($ordered as $sub){
		$name=$sub['TITLE'];
		$sub2=next($ordered);
		if ($sub['TARGET']=="3"){
			$sub['TARGET']=0;
			$sub['URL']="javascript:void(0);";
		}
		if(($sub['indent']==0)&&(($sub2['indent'])==1)){
			$str.= "var menu".$sub['ID']." = ms.addMenu(document.getElementById(\"menu".$sub['ID']."\"));\n ";
		}else if(($sub['ORDER']==1)&&($sub['indent']>1)){
			$str.= "var menu".($sub['ID'])." = menu".findPar($ordered,$par).".addMenu(menu".findPar($ordered,$par).".items[".($par['ORDER']-1)."],".$swmenufree['level2_sub_left'].",".$swmenufree['level2_sub_top'].");\n";
		}
		if($sub['indent']>0){
			$str.= "menu".findPar($ordered,$sub).".addItem(\"".addslashes($name)."\", \"".addslashes($sub['URL'])."\", \"".$sub['TARGET']."\");\n";
		}
		$par=$sub;
	}
	$str.="function init() {\n";
	$str.="if (TransMenu.isSupported()) {\n";
	$str.="TransMenu.initialize();\n";
	$counter=0;
	for($i=0;$i<count($ordered);$i++){
		if($ordered[$i]['indent']==0) {
			$counter++;
			if(@$ordered[$i+1]['indent']==1) {
				$str.= "menu".($ordered[$i]['ID']).".onactivate = function() {document.getElementById(\"menu".$ordered[$i]['ID']."\").className = \"hover\"; };\n ";
				$str.= "menu".($ordered[$i]['ID']).".ondeactivate = function() {document.getElementById(\"menu".$ordered[$i]['ID']."\").className = \"\"; };\n ";
			}else{
				$str.= "document.getElementById(\"menu".$ordered[$i]['ID']."\").onmouseover = function() {\n";
				$str.= "ms.hideCurrent();\n";
				$str.= "this.className = \"hover\";\n";
				$str.= "}\n";
				$str.= "document.getElementById(\"menu".$ordered[$i]['ID']."\").onmouseout = function() { this.className = \"\"; }\n";
			}
		}
	}

	$str.="}}\n";
	if($sub_indicator){
		$str.="TransMenu.spacerGif = \"".$live_site."/modules/mod_swmenufree/images/transmenu/x.gif\";\n";
		if($swmenufree['orientation']=="horizontal/left" || $swmenufree['orientation']=="vertical/left"){
		$str.="TransMenu.dingbatOn = \"".$live_site."/modules/mod_swmenufree/images/transmenu/submenuleft-on.gif\";\n";
		$str.="TransMenu.dingbatOff = \"".$live_site."/modules/mod_swmenufree/images/transmenu/submenuleft-off.gif\"; \n";
		$str.="TransMenu.sub_indicator = true; \n";	
		}else{
		$str.="TransMenu.dingbatOn = \"".$live_site."/modules/mod_swmenufree/images/transmenu/submenu-on.gif\";\n";
		$str.="TransMenu.dingbatOff = \"".$live_site."/modules/mod_swmenufree/images/transmenu/submenu-off.gif\"; \n";
		$str.="TransMenu.sub_indicator = true; \n";
		}
	}else{
		$str.="TransMenu.dingbatSize = 0;\n";
		$str.="TransMenu.spacerGif = \"\";\n";
		$str.="TransMenu.dingbatOn = \"\";\n";
		$str.="TransMenu.dingbatOff = \"\"; \n";
		$str.="TransMenu.sub_indicator = false;\n";
	}
	$str.="TransMenu.menuPadding = 0;\n";
	$str.="TransMenu.itemPadding = 0;\n";
	$str.="TransMenu.shadowSize = 2;\n";
	$str.="TransMenu.shadowOffset = 3;\n";
	$str.="TransMenu.shadowColor = \"#888\";\n";
	$str.="TransMenu.shadowPng = \"".$live_site."/modules/mod_swmenufree/images/transmenu/grey-40.png\";\n";
	$str.="TransMenu.backgroundColor = \"".$swmenufree['sub_back']."\";\n";
	$str.="TransMenu.backgroundPng = \"".$live_site."/modules/mod_swmenufree/images/transmenu/white-90.png\";\n";
	$str.="TransMenu.hideDelay = ".($swmenufree['specialB']*2).";\n";
	$str.="TransMenu.slideTime = ".$swmenufree['specialB'].";\n";
	$str.="TransMenu.selecthack = ".$selectbox_hack.";\n";
	$str.="TransMenu.autoposition = ".$auto_position.";\n";
	$str.="TransMenu.renderAll();\n";


	$str.="if ( typeof window.addEventListener != \"undefined\" )\n";
	$str.="window.addEventListener( \"load\", init, false );\n";
	$str.="else if ( typeof window.attachEvent != \"undefined\" ) {\n";
	$str.="window.attachEvent( \"onload\", init);\n";
	$str.="}else{\n";
	$str.="if ( window.onload != null ) {\n";
	$str.="var oldOnload = window.onload;\n";
	$str.="window.onload = function ( e ) {\n";
	$str.="oldOnload( e );\n";
	$str.="init();\n";
	$str.="}\n}else\n";
	$str.="window.onload = init();\n";
	$str.="}\n}\n-->\n</script>\n</div>\n";

	return $str;

}


function findPar($ordered,$sub){
	$submenu = chain('ID', 'PARENT', 'ORDER', $ordered, $sub['PARENT'], 1);

	if ($sub['indent']==1){
		return $submenu[0]['PARENT'];
	}else{
		return $submenu[0]['ID'];
	}
}



function GosuMenu($ordered, $swmenufree, $active_menu,$selectbox_hack){
	global $absolute_path, $live_site;

	$name = "";
	$counter = 0;
	$doMenu = 1;
	$number = count($ordered);

	$str= "<div align=\"".$swmenufree['position']."\">\n";
	$str.= "<table cellspacing=\"0\" cellpadding=\"0\" id=\"menu\" class=\"ddmx\"  > \n";
	if ($swmenufree['orientation']=="horizontal"){$str.= "<tr> \n";}

	while ($doMenu){

		if ($ordered[$counter]['indent'] == 0){
			$ordered[$counter]['URL'] = str_replace( '&', '&amp;', $ordered[$counter]['URL'] );
			$name=$ordered[$counter]['TITLE'];

			if ($swmenufree['orientation']=="vertical"){
				$str.= "<tr> \n";
			}

			if(islast($ordered,$counter)){
				if (($ordered[$counter]['ID']==$active_menu)){$str.= "<td class='item11-acton-last'> \n";}
				else{ $str.= "<td class='item11-last'> \n"; }
			}else{
				if (($ordered[$counter]['ID']==$active_menu)){$str.= "<td class='item11-acton'> \n";}
				else{ $str.= "<td class='item11'> \n"; }
			}

			

				switch ($ordered[$counter]['TARGET']) {
					// cases are slightly different
					case 1:
					// open in a new window
					$str.= '<a href="'. $ordered[$counter]['URL'] .'" target="_blank" class="item1" >'. $name .'</a>';
					break;

					case 2:
					// open in a popup window
					$str.= "<a href=\"#\" onclick=\"javascript: window.open('". $ordered[$counter]['URL'] ."', '', 'toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width=780,height=550'); return false\" class=\"item1\">". $name ."</a>\n";
					break;

					case 3:
					// don't link it
					$str.= '<a class="item1" >'. $name .'</a>';
					break;

					default:	// formerly case 2
					// open in parent window
					$str.= '<a href="'. $ordered[$counter]['URL'] .'" class="item1">'. $name .'</a>';
					break;
				}
			

			if ($counter+1 == $number){
				$doSubMenu = 0;
				$doMenu = 0;
				$str.= "<div class=\"section\" style=\"border:0 !important;\" ></div> \n";
			}elseif($ordered[$counter+1]['indent'] == 0){
				$doSubMenu = 0;
				$str.= "<div class=\"section\" style=\"border:0 !important;\" ></div> \n";
			}else{$doSubMenu = 1;}


			$counter++;

			while ($doSubMenu){
				if ($ordered[$counter]['indent'] != 0){
					if ($ordered[$counter]['indent'] > $ordered[$counter-1]['indent']){ $str.= '<div class="section"  >';}
					$ordered[$counter]['URL'] = str_replace( '&', '&amp;', $ordered[$counter]['URL'] );
					$name=$ordered[$counter]['TITLE'];

					if (($counter+1 == $number) || ($ordered[$counter+1]['indent'] == 0) ){
						$doSubMenu = 0;
					}
					$style="";

					if (($counter+1 == $number) || islast($ordered,$counter)){
						$style=" style=\"border-bottom:".$swmenufree['sub_border_over']."\"";
					}

						switch ($ordered[$counter]['TARGET']) {
							// cases are slightly different
							case 1:
							// open in a new window
							$str.= '<a href="'. $ordered[$counter]['URL'] .'" '.$style.' target="_blank" class="item2" >'. $name .'</a>';
							break;

							case 2:
							// open in a popup window
							$str.= "<a href=\"#\" ".$style." onclick=\"javascript: window.open('". $ordered[$counter]['URL'] ."', '', 'toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width=780,height=550'); return false\" class=\"item2\">". $name ."</a>\n";
							break;

							case 3:
							// don't link it
							$str.= '<a class="item2" '.$style.' >'. $name .'</a>';
							break;

							default:	// formerly case 2
							// open in parent window
							$str.= "<a href=\"". $ordered[$counter]['URL'] ."\" class=\"item2\" ".$style.">". $name ."</a>\n";
							break;
						}
					

					if (($counter+1 == $number) || ($ordered[$counter+1]['indent'] < $ordered[$counter]['indent'])){

						$str.= str_repeat('</div>',(($ordered[$counter]['indent'])-(@$ordered[$counter+1]['indent'])));

					}
					$counter++;
				}
			}
		}

		$str.= "</td> \n";

		if ($swmenufree['orientation']=="vertical"){
			$str.= "</tr> \n";
		}
		if ($counter == ($number)){ $doMenu = 0;}
	}
	if ($swmenufree['orientation']=="horizontal"){$str.= "</tr> \n";}
	$str.= "</table></div> \n";

	$str.= "<script type=\"text/javascript\">\n";
	$str.= "<!--\n";
	$str.= "function makemenu(){\n";


	$str.= "var ddmx = new DropDownMenuX('menu');\n";
	if ($swmenufree['orientation']=="vertical"){$str.= "ddmx.type = \"vertical\"; \n";}
	$str.= "ddmx.delay.show = 0;\n";
	$str.= "ddmx.iframename = 'ddmx';\n";
	$str.= "ddmx.delay.hide = ".$swmenufree['specialB'].";\n";
	$str.= "ddmx.position.levelX.left = ".$swmenufree['level2_sub_left'].";\n";
	$str.= "ddmx.position.levelX.top = ".$swmenufree['level2_sub_top'].";\n";
	$str.= "ddmx.position.level1.left = ".$swmenufree['level1_sub_left'].";\n";
	$str.= "ddmx.position.level1.top = ".$swmenufree['level1_sub_top']."; \n";
	$str.= "ddmx.fixIeSelectBoxBug = ".($selectbox_hack?'true':'false').";\n";
	$str.= "ddmx.init(); \n";
	$str.= "}\n";

	$str.= "if ( typeof window.addEventListener != \"undefined\" )\n";
	$str.= "window.addEventListener( \"load\", makemenu, false );\n";

	$str.= "else if ( typeof window.attachEvent != \"undefined\" ) { \n";
	$str.= "window.attachEvent( \"onload\", makemenu );\n";
	$str.= "}\n";

	$str.= "else {\n";
	$str.= "if ( window.onload != null ) {\n";
	$str.= "var oldOnload = window.onload;\n";
	$str.= "window.onload = function ( e ) { \n";
	$str.= "oldOnload( e ); \n";
	$str.= "makemenu() \n";
	$str.= "} \n";
	$str.= "}  \n";
	$str.= "else  { \n";
	$str.= "window.onload = makemenu();\n";
	$str.= "} }\n";
	$str.= "--> \n";
	$str.= "</script>  \n";

	return $str;
}




function TigraMenu($ordered, $swmenufree,$active_menu){
	global $absolute_path, $live_site;
	$topcounter = 0;
	$counter = 0;
	$doMenu = 1;
	$uniqueID = $swmenufree['id'];
	$number = count($ordered);
	$mymenu_content ="\n<script type=\"text/javascript\">\n";
	$mymenu_content.="<!--\n";
	$mymenu_content.="var MENU_ITEMS = [";

	if ($swmenufree['orientation']=="vertical"){
		$swmenufree['level1_sub_left']=$swmenufree['level1_sub_left']+$swmenufree['main_width'];
		$swmenufree['level2_sub_left']=$swmenufree['level2_sub_left']+$swmenufree['sub_width'];
	}else{
		$swmenufree['level1_sub_top']=$swmenufree['level1_sub_top']+$swmenufree['main_height'];
		$swmenufree['level2_sub_left']=$swmenufree['level2_sub_left']+$swmenufree['sub_width'];
	}
		
	while ($doMenu){
//$ordered[$counter]['TITLE']=str_replace("'","",$ordered[$counter]['TITLE']);
		if ($ordered[$counter]['indent'] == 0){

			//$ordered[$counter]['URL'] = str_replace( '&', '&amp;', $ordered[$counter]['URL'] );
			$hasSub = 0;
			$topcounter++;
			
			$name="'".(addslashes($ordered[$counter]['TITLE']))."',";
			//if ($ordered[$counter]['URL']!="seperator"){
			if ($ordered[$counter]['ID']==$active_menu){
				$name="'<sw_active>".(addslashes($ordered[$counter]['TITLE']))."',";
			}
			$name.="'".$ordered[$counter]['URL']."',";
			switch ($ordered[$counter]['TARGET']) {
				// cases are slightly different
				case 1:
				// open in a new window
				$name.= "{ 'tw' : '_blank' , 'sb' : '".addslashes($ordered[$counter]['TITLE'])."'}";
				break;

				case 2:
				// open in a popup window
				$name.= "{ 'tw' : '_blank' , 'sb' : '".addslashes($ordered[$counter]['TITLE'])."', 'tl' : '1'}";
				break;

				case 3:
				// don't link it
				$name.= "{ 'tw' : '_self' , 'sb' : '".addslashes($ordered[$counter]['TITLE'])."'}";
				break;

				default:	// formerly case 2
				// open in parent window
				$name.= "{ 'tw' : '_self' , 'sb' : '".addslashes($ordered[$counter]['TITLE'])."'}";
				break;
			}
			if ($counter+1 == $number){
				$mymenu_content.="\n  [".$name."],";
				$doSubMenu = 0;
				$doMenu = 0;
			}elseif($ordered[$counter+1]['indent'] == 0){
				$mymenu_content.="\n  [".$name."],";
				$doSubMenu = 0;
			}else{
				$mymenu_content.="\n  [".$name.",";
				$doSubMenu = 1;
			}
			$counter++;

			while ($doSubMenu){

				if ($ordered[$counter]['indent'] != 0) {
					//$ordered[$counter]['URL'] = str_replace( '&', '&amp;', $ordered[$counter]['URL'] );
					$name=addslashes($ordered[$counter]['TITLE'])."',";

					$name.="'".$ordered[$counter]['URL']."',";
					switch ($ordered[$counter]['TARGET']) {
						// cases are slightly different
						case 1:
						// open in a new window
						$name.= "{ 'tw' : '_blank' , 'sb' : '".addslashes($ordered[$counter]['TITLE'])."'}";
						break;

						case 2:
						// open in a popup window
						$name.= "{ 'tw' : '_blank' , 'sb' : '".addslashes($ordered[$counter]['TITLE'])."', 'tl' : '1'}";
						break;

						case 3:
						// don't link it
						$name.= "{ 'tw' : '_self' , 'sb' : '".addslashes($ordered[$counter]['TITLE'])."'}";
						break;

						default:	// formerly case 2
						// open in parent window
						$name.= "{ 'tw' : '_self' , 'sb' : '".addslashes($ordered[$counter]['TITLE'])."'}";
						break;
					}

					if ($counter+1 == $number){
						$mymenu_content.="\n  ['".$name.str_repeat('],',($ordered[$counter]['indent']+1));
						//  $mymenu_content.=")\n";
						$doSubMenu = 0;
						$doMenu = 0;
					}elseif ($ordered[$counter]['indent'] < $ordered[$counter+1]['indent']){
						$mymenu_content.="\n  ['".$name.",";
						if ($ordered[$counter+1]['indent'] == 0){ $doSubMenu = 0;}
					}
					elseif ($ordered[$counter]['indent'] == $ordered[$counter+1]['indent']){
						$mymenu_content.="\n  ['".$name."],";
						if ($ordered[$counter+1]['indent'] == 0){ $doSubMenu = 0;}
					}
					elseif (($ordered[$counter]['indent'] > $ordered[$counter+1]['indent'])){
						$mymenu_content.="\n  ['".$name.str_repeat('],',(($ordered[$counter]['indent'])-($ordered[$counter+1]['indent'])+1));
						//$mymenu_content.="]),\n";
						if ($ordered[$counter+1]['indent'] == 0){ $doSubMenu = 0;}
					}

					$counter++;
					$hasSub++;

				}
			}
		}
	}

	$mymenu_content .= "\n ];";
	$mymenu_content .= "\n -->";
	$mymenu_content .= "\n </SCRIPT> \n";

	//echo $mymenu_content;
	$mymenu_content.= "<script type=\"text/javaScript\">\n";
	$mymenu_content.= "<!-- \n";
	$mymenu_content.= "var MENU_POS = [\n";
	$mymenu_content.= "{\n";
	// item sizes
	$mymenu_content.= "'height':";
	if (substr(swmenuGetBrowser(),0,5)=="MSIE6"){
		$border1 = explode(" ", $swmenufree['main_border']);
		$offset=rtrim(trim($border1[0]),'px');
	}else{ $offset=0;}
	$mymenu_content.=($swmenufree['main_height']+$offset);
	$mymenu_content.= ",\n";
	$mymenu_content.= "'width':".($swmenufree['main_width']+$offset);
	$mymenu_content.= ",\n";
	$mymenu_content.= "'block_top': ".$swmenufree['main_top'].",\n";
	$mymenu_content.= "'block_left': ".$swmenufree['main_left'].",\n";
	$mymenu_content.= "'top':";
	if ($swmenufree['orientation']=="vertical"){
		if (substr(swmenuGetBrowser(),0,5)!="MSIE6"){
			$border1 = explode(" ", $swmenufree['main_border']);
			$offset3=rtrim(trim($border1[0]),'px');
		}else{ $offset3=0;}
		$mymenu_content.= ($swmenufree['main_height']+$offset3);
	}else {$mymenu_content.= "0";}
	$mymenu_content.=",\n";
	$mymenu_content.="'left':";
	if ($swmenufree['orientation']=="vertical"){$mymenu_content.= "0";}
	else {$mymenu_content.= $swmenufree['main_width'];}
	$mymenu_content.=",\n";
	$mymenu_content.="'hide_delay':".$swmenufree['specialB'].",\n";
	$mymenu_content.="'expd_delay': ". $swmenufree['specialB'].",\n";
	$mymenu_content.="'css' : {\n";
	$mymenu_content.="'outer': ['m0l0oout', 'm0l0oover'],\n";
	$mymenu_content.="'inner': ['m0l0iout', 'm0l0iover']\n";
	$mymenu_content.="}\n";
	$mymenu_content.="}, \n";
	$mymenu_content.="{\n";
	$mymenu_content.="'height': ";
	if (substr(swmenuGetBrowser(),0,5)=="MSIE6"){
		$border2 = explode(" ", $swmenufree['sub_border']);
		$offset2=rtrim(trim($border2[0]),'px');
	}else{ $offset2=0;}
	$mymenu_content.= ($swmenufree['sub_height']+$offset2);
	$mymenu_content.=",\n";
	$mymenu_content.="'width':".($swmenufree['sub_width']+$offset2);
	$mymenu_content.=",\n";
	$mymenu_content.="'block_top': ". $swmenufree['level1_sub_top']." ,\n";
	$mymenu_content.="'block_left':".$swmenufree['level1_sub_left'].",\n";
	$mymenu_content.="'top': ";
	if (substr(swmenuGetBrowser(),0,5)!="MSIE6"){
		$border1 = explode(" ", $swmenufree['sub_border']);
		$offset3=rtrim(trim($border1[0]),'px');
	}else{ $offset3=0;}
	$mymenu_content.= ($swmenufree['sub_height']+$offset3);
	$mymenu_content.=",\n";
	$mymenu_content.="'left': 0, \n";
	$mymenu_content.="'css': {\n";
	$mymenu_content.="'outer' : ['m0l1oout', 'm0l1oover'],\n";
	$mymenu_content.="'inner' : ['m0l1iout', 'm0l1iover'] \n";
	$mymenu_content.="}\n";
	$mymenu_content.="}, \n";
	$mymenu_content.="{\n";
	$mymenu_content.="'block_top': ".$swmenufree['level2_sub_top'].",\n";
	$mymenu_content.="'block_left':".$swmenufree['level2_sub_left'].",\n";
	$mymenu_content.="'css': {\n";
	$mymenu_content.="'outer' : ['m0l1oout', 'm0l1oover'],\n";
	$mymenu_content.="'inner' : ['m0l1iout', 'm0l1iover'] \n";
	$mymenu_content.="} \n";
	$mymenu_content.="} \n";
	$mymenu_content.="] \n";
	$mymenu_content.="--> \n";
	$mymenu_content.="</script> \n";

	if (substr(swmenuGetBrowser(),0,5)!="MSIE6"){
		$border1 = explode(" ", $swmenufree['main_border']);
		$offset3=rtrim(trim($border1[0]),'px');
		$swmenufree['main_height'] = $swmenufree['main_height'] + $offset3;
		//$swmenufree['main_width'] = $swmenufree['main_width'] + $offset3;
	}
	$mymenu_content.= "<div style=\"position:".$swmenufree['position'].";z-index:1; top:0px; left:0px; width:";

	if ($swmenufree['orientation']=="vertical"){$mymenu_content.= $swmenufree['main_width']."px; height:".(($swmenufree['main_height']*$topcounter))."px \" >";}
	else {$mymenu_content.= (($swmenufree['main_width']*$topcounter))."px; height:".$swmenufree['main_height']."px \">";}
	$mymenu_content.= "\n<script type=\"text/javaScript\">\n";
	$mymenu_content.="<!--\n";
	$mymenu_content.= "new menu(MENU_ITEMS, MENU_POS);\n";
	$mymenu_content.="--> \n";
	$mymenu_content.="</script>\n";
	$mymenu_content.="</div>\n";
	return $mymenu_content;
}




function islast($array, $id){

	$this_level=$array[$id]['indent'];
	$last=0;
	$i=$id+1;
	$do=1;
	while($do){

		if(@$array[$i]['indent']<$this_level || $i==count($array)){$last=1;}
		if(@$array[$i]['indent']<=$this_level){
			$do=0;

		}
		$i++;
	}
	return $last;
}


function swmenuGetBrowser(){
	
	$br = new Browser;
   // echo substr($br->Name.$br->Version,0,5);
    

	return($br->Name.$br->Version);
}
function inAgent($agent) {
	global $HTTP_USER_AGENT;
	$notAgent = strpos($HTTP_USER_AGENT,$agent) === false;
	return !$notAgent;
}

function fixPadding(&$swmenufree){

	$padding1 = explode("px", $swmenufree['main_padding']);
	$padding2 = explode("px", $swmenufree['sub_padding']);
	for($i=0;$i<4; $i++){
		$padding1[$i]=trim(@$padding1[$i]);
		$padding2[$i]=trim(@$padding2[$i]);
	}
	if($swmenufree['main_width']!=0){$swmenufree['main_width'] = ($swmenufree['main_width'] - ($padding1[1]+$padding1[3]));}
	if($swmenufree['main_height']!=0){$swmenufree['main_height'] = ($swmenufree['main_height'] - ($padding1[0]+$padding1[2]));}
	if($swmenufree['sub_width']!=0){$swmenufree['sub_width'] = ($swmenufree['sub_width'] - ($padding2[1]+$padding2[3]));}
	if(@$swmenufree['sub_width']!=0){$swmenufree['sub_height'] = ($swmenufree['sub_height'] - ($padding2[0]+$padding2[2]));}
	return($swmenufree);


}


function sw_getactive($ordered){
	$current_itemid = trim( JRequest::getVar( 'Itemid', 0 ) );
	$current_id = trim( JRequest::getVar( 'id', 0 ) );
	$current_task = trim( JRequest::getVar( 'task', 0 ) );

	if (!$current_itemid && $current_id){

		if(eregi( "category" , $current_task)){
			$current_itemid = $current_id+1000;
		}elseif(eregi( "section" , $current_task)){
			$current_itemid = $current_id;
		}
		elseif(eregi( "view" , $current_task)){
			$current_itemid = $current_id+10000;
		}
	}
	$indent=0;
	$parent_value = $current_itemid;
	$parent=1;
	$id=0;
	while ($parent){
		for($i=0;$i<count($ordered);$i++) {
			$row=$ordered[$i];
			if ($row['ID']==$parent_value ){
				$parent_value = $row['PARENT'];
				$indent = $row['indent'];
				$id=$row['ID'];
			}
		}
		if (!$indent){
			$parent=0;
		}
	}
	return ($id);
}




class browser{

    var $Name = "Unknown";
    var $Version = "Unknown";
    var $Platform = "Unknown";
    var $UserAgent = "Not reported";
    var $AOL = false;

    function browser(){
        $agent = $_SERVER['HTTP_USER_AGENT'];

        // initialize properties
        $bd['platform'] = "Unknown";
        $bd['browser'] = "Unknown";
        $bd['version'] = "Unknown";
        $this->UserAgent = $agent;

        // find operating system
        if (eregi("win", $agent))
            $bd['platform'] = "Windows";
        elseif (eregi("mac", $agent))
            $bd['platform'] = "MacIntosh";
        elseif (eregi("linux", $agent))
            $bd['platform'] = "Linux";
        elseif (eregi("OS/2", $agent))
            $bd['platform'] = "OS/2";
        elseif (eregi("BeOS", $agent))
            $bd['platform'] = "BeOS";

        // test for Opera        
        if (eregi("opera",$agent)){
            $val = stristr($agent, "opera");
            if (eregi("/", $val)){
                $val = explode("/",$val);
                $bd['browser'] = $val[0];
                $val = explode(" ",$val[1]);
                $bd['version'] = $val[0];
            }else{
                $val = explode(" ",stristr($val,"opera"));
                $bd['browser'] = $val[0];
                $bd['version'] = $val[1];
            }

        // test for WebTV
        }elseif(eregi("webtv",$agent)){
            $val = explode("/",stristr($agent,"webtv"));
            $bd['browser'] = $val[0];
            $bd['version'] = $val[1];
        
        // test for MS Internet Explorer version 1
        }elseif(eregi("microsoft internet explorer", $agent)){
            $bd['browser'] = "MSIE";
            $bd['version'] = "1.0";
            $var = stristr($agent, "/");
            if (ereg("308|425|426|474|0b1", $var)){
                $bd['version'] = "1.5";
            }

        // test for NetPositive
        }elseif(eregi("NetPositive", $agent)){
            $val = explode("/",stristr($agent,"NetPositive"));
            $bd['platform'] = "BeOS";
            $bd['browser'] = $val[0];
            $bd['version'] = $val[1];

        // test for MS Internet Explorer
        }elseif(eregi("msie",$agent) && !eregi("opera",$agent)){
            $val = explode(" ",stristr($agent,"msie"));
            $bd['browser'] = $val[0];
            $bd['version'] = $val[1];
        
        // test for MS Pocket Internet Explorer
        }elseif(eregi("mspie",$agent) || eregi('pocket', $agent)){
            $val = explode(" ",stristr($agent,"mspie"));
            $bd['browser'] = "MSPIE";
            $bd['platform'] = "WindowsCE";
            if (eregi("mspie", $agent))
                $bd['version'] = $val[1];
            else {
                $val = explode("/",$agent);
                $bd['version'] = $val[1];
            }
            
        // test for Galeon
        }elseif(eregi("galeon",$agent)){
            $val = explode(" ",stristr($agent,"galeon"));
            $val = explode("/",$val[0]);
            $bd['browser'] = $val[0];
            $bd['version'] = $val[1];
            
        // test for Konqueror
        }elseif(eregi("Konqueror",$agent)){
            $val = explode(" ",stristr($agent,"Konqueror"));
            $val = explode("/",$val[0]);
            $bd['browser'] = $val[0];
            $bd['version'] = $val[1];
            
        // test for iCab
        }elseif(eregi("icab",$agent)){
            $val = explode(" ",stristr($agent,"icab"));
            $bd['browser'] = $val[0];
            $bd['version'] = $val[1];

        // test for OmniWeb
        }elseif(eregi("omniweb",$agent)){
            $val = explode("/",stristr($agent,"omniweb"));
            $bd['browser'] = $val[0];
            $bd['version'] = $val[1];

        // test for Phoenix
        }elseif(eregi("Phoenix", $agent)){
            $bd['browser'] = "Phoenix";
            $val = explode("/", stristr($agent,"Phoenix/"));
            $bd['version'] = $val[1];
        
        // test for Firebird
        }elseif(eregi("firebird", $agent)){
            $bd['browser']="Firebird";
            $val = stristr($agent, "Firebird");
            $val = explode("/",$val);
            $bd['version'] = $val[1];
            
        // test for Firefox
        }elseif(eregi("Firefox", $agent)){
            $bd['browser']="Firefox";
            $val = stristr($agent, "Firefox");
            $val = explode("/",$val);
            $bd['version'] = $val[1];
            
      // test for Mozilla Alpha/Beta Versions
        }elseif(eregi("mozilla",$agent) && 
            eregi("rv:[0-9].[0-9][a-b]",$agent) && !eregi("netscape",$agent)){
            $bd['browser'] = "Mozilla";
            $val = explode(" ",stristr($agent,"rv:"));
            eregi("rv:[0-9].[0-9][a-b]",$agent,$val);
            $bd['version'] = str_replace("rv:","",$val[0]);
            
        // test for Mozilla Stable Versions
        }elseif(eregi("mozilla",$agent) &&
            eregi("rv:[0-9]\.[0-9]",$agent) && !eregi("netscape",$agent)){
            $bd['browser'] = "Mozilla";
            $val = explode(" ",stristr($agent,"rv:"));
            eregi("rv:[0-9]\.[0-9]\.[0-9]",$agent,$val);
            $bd['version'] = str_replace("rv:","",$val[0]);
        
        // test for Lynx & Amaya
        }elseif(eregi("libwww", $agent)){
            if (eregi("amaya", $agent)){
                $val = explode("/",stristr($agent,"amaya"));
                $bd['browser'] = "Amaya";
                $val = explode(" ", $val[1]);
                $bd['version'] = $val[0];
            } else {
                $val = explode("/",$agent);
                $bd['browser'] = "Lynx";
                $bd['version'] = $val[1];
            }
        
        // test for Safari
        }elseif(eregi("safari", $agent)){
            $bd['browser'] = "Safari";
            $bd['version'] = "";

        // remaining two tests are for Netscape
        }elseif(eregi("netscape",$agent)){
            $val = explode(" ",stristr($agent,"netscape"));
            $val = explode("/",$val[0]);
            $bd['browser'] = $val[0];
            $bd['version'] = $val[1];
        }elseif(eregi("mozilla",$agent) && !eregi("rv:[0-9]\.[0-9]\.[0-9]",$agent)){
            $val = explode(" ",stristr($agent,"mozilla"));
            $val = explode("/",$val[0]);
            $bd['browser'] = "Netscape";
            $bd['version'] = $val[1];
        }
        
        // clean up extraneous garbage that may be in the name
        $bd['browser'] = ereg_replace("[^a-z,A-Z]", "", $bd['browser']);
        // clean up extraneous garbage that may be in the version        
        $bd['version'] = ereg_replace("[^0-9,.,a-z,A-Z]", "", $bd['version']);
        
        // check for AOL
        if (eregi("AOL", $agent)){
            $var = stristr($agent, "AOL");
            $var = explode(" ", $var);
            $bd['aol'] = ereg_replace("[^0-9,.,a-z,A-Z]", "", $var[1]);
        }
        
        // finally assign our properties
        $this->Name = $bd['browser'];
        $this->Version = $bd['version'];
        $this->Platform = $bd['platform'];
       // $this->AOL = $bd['aol'];
    }
}

?>
