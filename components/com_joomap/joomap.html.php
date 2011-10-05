<?php
defined('_JEXEC') or die('Direct Access to this location is not allowed.');

/**
 * Wraps HTML representation of the Joomap tree as an unordered list (ul)
 * @author Daniel Grothe
 * @version $Id: joomap.html.php 17 2008-08-19 12:34:38Z koders.de $
 */

	/** Wraps HTML output */
	class JoomapHtml {
		
		/**
		 * Id of the currently active Menu-Entry
		 *
		 * @var int
		 */
		var $itemId;
		
		/**
		 * Convert sitemap tree to an 'unordered' html list.
		 * This function uses recursion, keep unnecessary code out of this!
		 * @see JoomapHtml::printTree()
		 */
		function &getHtmlList( &$tree, &$exlink, $level = 0 ) {

			if( !$tree ) {
				$result = '';
				return $result;
			}
			
			$out = '<ul class="level_'.$level.'">';
			foreach($tree as $node) {
				if ($this->itemId == $node->id)
					$out .= '<li class="active">';
				else
					$out .= '<li>';
				
				$link = $node->link;
				if (!isset($node->type))
					$node->type = '';
				switch ($node->type) {
					case 'separator':
						break;
						
					case 'url':
						if (eregi( "index.php\?", $link ) ) {
							if (strpos($link, 'Itemid=') === FALSE ) {
								$link .= '&amp;Itemid='.$node->id;
							}
						}
						break;
						
					default:
						$link .= '&amp;Itemid='.$node->id;
						break;
				}

				if (strcasecmp(substr($link, 0, 5), 'http:') != 0)
					$link = JRoute::_($link);						// apply SEF transformation
				
				if (!isset($node->browserNav))
					$node->browserNav = 0;
					
				switch ($node->browserNav) {
					case 1:											// open url in new window
						$ext_image = '';
						if( $exlink[0] ){
							$ext_image = '&nbsp;<img src="'.JURI::root().'components/com_joomap/images/'. $exlink[1] .'" alt="' . _JOOMAP_SHOW_AS_EXTERN_ALT . '" title="' . _JOOMAP_SHOW_AS_EXTERN_ALT . '" border="0" />';
						}
						$out .= '<a href="'.$link.'" title="'. $node->name .'" target="_blank">'. $node->name . $ext_image .'</a>';
						break;

					case 2:											// open url in javascript popup window
						$ext_image = '';
						if( $exlink[0] ) {
							$ext_image = '&nbsp;<img src="'.JURI::root().'/components/com_joomap/images/'. $exlink[1] .'" alt="' . _JOOMAP_SHOW_AS_EXTERN_ALT . '" title="' . _JOOMAP_SHOW_AS_EXTERN_ALT . '" border="0" />';
						}
						$out .= '<a href="'. $link .'" title="'. $node->name .'" target="_blank" '. "onClick=\"javascript: window.open('". $link ."', '', 'toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width=780,height=550'); return false;\">". $node->name . $ext_image."</a>";
						break;

					case 3:											// no link
						$out .= '<span>'. $node->name .'</span>';
						break;

					default:										// open url in parent window
						$out .= '<a href="'. $link .'" title="'. $node->name .'">'. $node->name .'</a>';
						break;
				}
				
				if (isset($node->tree)) {
					$out .= $this->getHtmlList($node->tree, $exlink, $level + 1);
				}
				$out .= '</li>' . "\n";
			}
			$out .= '</ul>' . "\n";
			return $out;
		}
		
		/**
		 * Print the whole joomap HTML output
		 * @param $joomap The joomap object we are called from
		 * @param $root The prepared sitetree
		 * @see joomap.php
     */
		function printTree(&$joomap, &$root) {
			$app		=& JFactory::getApplication();
			$document	=& JFactory::getDocument();
			$config		=& $joomap->config;
			$params		=& $app->getParams();
			
			$document->setTitle($params->get('page_title'));
			$document->addStyleSheet('components/com_joomap/css/joomap.css');
			
			if ($params->get('show_page_title')):
			?>
				<div class="componentheading<?php echo $params->get('pageclass_sfx')?>">
					<?php echo $params->get('page_title'); ?>
				</div>
			<?php
			endif;
			
			// Prepare imagelinks to mark popup links
			
			$exlink[0] = $config->exlinks;
			$exlink[1] = $config->ext_image;

			// calculate column widths

			if ($config->columns > 1) {
				$total = count($root);
				$columns = $total < $config->columns ? $total : $config->columns;
				$width	= (100 / $columns) - 1;
			}
			
			$uri =& JFactory::getURI();
			$this->itemId = $uri->getVar('Itemid');
			
			echo '<div class="'.$config->classname.'">';
			echo '<div class="contentpaneopen"'.($config->columns > 1 ? ' style="float:left;width:100%;"' : '').'>';
			
			// Show the site-tree in multiple separate trees if needed
			
			if( $config->show_menutitle || $config->columns > 1 ) {				// each menu gets a separate list
				foreach( $root as $menu ) {
					
					if( $config->columns > 1 )									// use columns
						echo '<div style="float:left;width:'.$width.'%;">';
					
					if( $config->show_menutitle )								// show menu titles
						echo '<h2 class="menutitle">'.$menu->name.'</h2>';

					echo $this->getHtmlList($menu->tree, $exlink);
					if ($config->columns > 1)
						echo "</div>\n";
				}

				if ($config->columns > 1)
					echo '<div style="clear:left"></div>';

			} else {															// don't show menu titles, all items in one big tree
				$tmp = array();
				foreach( $root as $menu ) {										// concatenate all menu-trees
					foreach( $menu->tree as $node ) {
						$tmp[] = $node;
					}
				}
				echo $this->getHtmlList($tmp, $exlink);
			}
			
			// Show a hidden link back to the joomap author's website
			
			if( $config->includelink ) {
				$keywords = array('Webdesign', 'Software Anpassung', 'Software Entwicklung', 'Programmierung');
				$location = array('Iserlohn', 'Hagen', 'Dortmund', 'Ruhrgebiet', 'NRW');
				$advert = $keywords[mt_rand() % count($keywords)].' '.$location[mt_rand() % count($location)];
				echo "<a href=\"http://www.ko-ca.com\" style=\"font-size:1px;display:none;\">$advert</a>";
			}

			echo "</div>";
			echo "</div>\n";
		}
	};
?>
