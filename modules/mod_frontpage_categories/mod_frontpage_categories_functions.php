<?php



function find_cat_image($cat_id,$db_username,$db_password,$db_name) {
	$con = mysql_connect("jocms.db.4376705.hostedresource.com",$db_username,$db_password);
	if (!$con)
	  {
	  die('Could not connect: ' . mysql_error());
	  }

	mysql_select_db($db_name, $con);
	
	$q = 'SELECT * FROM jos_vm_category WHERE category_id='.$cat_id;
	$return = mysql_query( $q );
	$row = mysql_fetch_array($return);
	$return_val = $row['category_thumb_image'];
	return $return_val;
	}



/**
	 * This function is used for the frontend to display a
	 * complete link list of top-level categories
	 * 
	 * @param int $category_id The category to be highlighted
	 * @param string $links_css_class The css class that marks mainlevel links
	 * @param string $list_css_class (deprecated)
	 * @param string $highlighted_style The css styles that format the hightlighted category
	 * @return string HTML code with the link list
	 */

	function get_category_tree2( $category_id=0,
				$links_css_class="mainlevel",$numcolumns=5,
				$cat_height,$image_width,
				$sub_categories_display=1,
				$list_css_class="mm123",
				$highlighted_style="font-style:italic;" ) {
		global $sess;
		$config =& JFactory::getConfig();
		$db_username = $config->getValue( 'config.user' );
		$db_password = $config->getValue( 'config.password' );
		$db_name = $config->getValue( 'config.db' );
		$categories = ps_product_category::getCategoryTreeArray(); // Get array of category objects
		$result = ps_product_category::sortCategoryTreeArray($categories); // Sort array of category objects
		$row_list = $result['row_list'];
		$depth_list = $result['depth_list'];
		$category_tmp = $result['category_tmp'];
		$nrows = sizeof($category_tmp);
		$numcolumns = 100/$numcolumns-3;
		$k = 0;
		// Copy the Array into an Array with auto_incrementing Indexes
		$key = array_keys($categories); // Array of category table primary keys
		
		$nrows = $size = sizeOf($key); // Category count

		$html = "";

		// Find out if we have subcategories to display
		$allowed_subcategories = Array();
		if( !empty( $categories[$category_id]["category_parent_id"] ) ) {
			// Find the Root Category of this category
			$root = $categories[$category_id];
			$allowed_subcategories[] = $categories[$category_id]["category_parent_id"];
			// Loop through the Tree up to the root
			while( !empty( $root["category_parent_id"] )) {
				$allowed_subcategories[] = $categories[$root["category_child_id"]]["category_child_id"];
				$root = $categories[$root["category_parent_id"]];
			}
		}
		// Fix the empty Array Fields
		if( $nrows < count( $row_list ) ) {
			$nrows = count( $row_list );
		}

		// Now show the categories
		for($n = 0 ; $n < $nrows ; $n++) {

			if( !isset( $row_list[$n] ) || !isset( $category_tmp[$row_list[$n]]["category_child_id"] ) )
			continue;
			if( $category_id == $category_tmp[$row_list[$n]]["category_child_id"] )
			$style = $highlighted_style;
			else
			$style = "";

			$allowed = true;
			if( $depth_list[$n] > 0 ) {
				// Subcategory!
				if( isset( $root ) && in_array( $category_tmp[$row_list[$n]]["category_child_id"], $allowed_subcategories )
				|| $category_tmp[$row_list[$n]]["category_parent_id"] == $category_id
				|| $category_tmp[$row_list[$n]]["category_parent_id"] == @$categories[$category_id]["category_parent_id"]) {
					$allowed = true;

				}
			}
			else
			$allowed = true;
			$append = "";
			
			if( $allowed ) {
				if( $style == $highlighted_style ) {
					$append = 'id="active_menu2"';
				}
				if( $depth_list[$n] > 0) {
					$css_class = "sublevel_frontpage_categories";
					$type = 2;
				}
				else {
					$css_class = $links_css_class;
					$css_class = 'mainlevel_frontpage_categories';
					$type = 1;
				}

				$catname = shopMakeHtmlSafe( $category_tmp[$row_list[$n]]["category_name"] );
				
				if ($type == 1) {
					if ($k > 0) {
						$html .= '</div>';
						}
					else {
						#$html .= '<div style="float:left;text-align: left;padding:3px;background:#000;width:'.$numcolumns.'%;margin:5px;border:100px solid #888;">testtest';
						
						}
					$html .= '<div class="mod_frontpage_div" style="width:'.$numcolumns.'%;height:'.$cat_height.'px">';
					$cat_image = 'components/com_virtuemart/shop_image/category/';
					$base_image = find_cat_image($category_tmp[$row_list[$n]]["category_child_id"],$db_username,$db_password,$db_name);
						
						
						if ($base_image != '') {
							$cat_image .= $base_image;
							list($width, $height, $type, $attr) = getimagesize($cat_image);
							
							$target = $image_width;

							if ($width != '' && $height != '') {
								if ($width > $height) {
								$percentage = ($target / $width);
								} else {
								$percentage = ($target / $width);
								}

								//gets the new value and applies the percentage, then rounds the value

								$width = round($width * $percentage);
								$height = round($height * $percentage);
							}
						}
						$html .= '
						<a title="'.$catname.'" style="display:block;'.$style.'" class="'. $css_class .'" href="'. $sess->url(URL."index.php?page=shop.browse&amp;category_id=".$category_tmp[$row_list[$n]]["category_child_id"]) .'" '.$append.'>
					
						<img src="components/com_virtuemart/shop_image/category/'.find_cat_image($category_tmp[$row_list[$n]]["category_child_id"],$db_username,$db_password,$db_name).'" width='.$width.' height='.$height.'>
					
						</a>
						';
						
					
					}
				
				
				$k = $k + 1;
			}
		}
		$html .= '</div>';
		return $html;
	}