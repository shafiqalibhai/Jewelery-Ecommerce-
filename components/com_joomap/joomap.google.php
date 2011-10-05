<?php
defined('_JEXEC') or die('Direct Access to this location is not allowed.');

/**
 * Print "Google Sitemaps" list of the Joomap tree.
 * Does not use "priority" or "changefreq".
 * NOTE: When user is logged in, the tree will also contain private items!
 * @author Daniel Grothe
 * @version $Id: joomap.google.php 17 2008-08-19 12:34:38Z koders.de $
 */

	/** Wraps Google Sitemaps output */
	class JoomapGoogle {
		
		/**
		 * Keeps a list of already added links, so we won't ever supply double content.
		 *
		 * @var array
		 */
		var $added;
		
		/** Convert sitemap tree to a Google Sitemaps list */
		function &getList( &$tree ) {
			if( !$tree )
				return '';
				
			$out = '';
			
			$live_site = JURI::root();
			$len_live_site = strlen($live_site);
			foreach($tree as $node) {
				$link = $node->link;
				
				if (!isset($node->type))
					$node->type = ''; 
				switch ($node->type) {
					case 'separator':
						break;
					case 'url':
						if (eregi("index.php\?", $link)) {
							if (strpos( $link, 'Itemid=') === FALSE ) {
								$link .= '&amp;Itemid='.$node->id;
							}
						}
						break;
					default:
						$link .= '&amp;Itemid='.$node->id;
						break;
				}
				
				if( strcasecmp(substr($link, 0, 5), 'http:') != 0 ) {
					$link = JRoute::_($link);									// make path absolute and apply SEF transformation (if any)
					
					if( strcasecmp( substr($link, 0, 9), 'index.php' ) === 0 ){	// fix broken links
						$link = $live_site.$link;
					}
					
					if( strncmp($link, '/', 1) === 0) {							// skip the first slash
						$link = $live_site.substr($link, 1);
					}
				}
				
				$is_extern = (0 != strcasecmp(substr($link, 0, $len_live_site), $live_site));

				if( !isset($node->browserNav) )
					$node->browserNav = 0;

				if( $node->browserNav != 3										// ignore "no link"
				 && !$is_extern													// ignore external links
				 && !in_array($link, $this->added) ) {							// ignore links that have been added already

				 	$this->added[] = $link;

					$out .= "<url>\n";
					$out .= "<loc>".$link."</loc>\n";						// http://complete-url
					
					$isModified = (isset($node->modified) && $node->modified != FALSE && $node->modified != -1);
					$timestamp = ($isModified) ? $node->modified : time();
					$modified = gmdate('Y-m-d\TH:i:s\Z', $timestamp);		// ISO 8601 yyyy-mm-ddThh:mm:ss.sTZD
					$out .= "<lastmod>{$modified}</lastmod>\n";
		   			
		   		//$out .= "<changefreq>always</changefreq>";				// valid: always, hourly, daily, weekly, monthly, yearly, never
			   	//$out .= "<priority>0.8</priority>";						// valid: 0.0 - 1.0
					
		 			$out .= "</url>\n";
				}
				
				if( isset($node->tree) ) {
					$out .= $this->getList( $node->tree );
				}
			}
			return $out;
		}
		
		/** Print a Google Sitemaps representation of tree */
		function printTree( &$joomap, &$root ) {
			$this->added = array();
	
			header("Content-type: text/xml; charset=UTF-8");
			header("Content-encoding: UTF-8");
			
			echo '<?xml version="1.0" encoding="UTF-8"?>'.chr(10);
			echo '<urlset xmlns="http://www.google.com/schemas/sitemap/0.84"'.chr(10);
			echo ' xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"'.chr(10);
			echo ' xsi:schemaLocation="http://www.google.com/schemas/sitemap/0.84'.chr(10);
			echo ' http://www.google.com/schemas/sitemap/0.84/sitemap.xsd">'.chr(10);
			
			$tmp = array();
			foreach ($root as $menu) {											// concatenate all menu-trees
				foreach ($menu->tree as $node) {
					$tmp[] = $node;
				}
			}
			echo $this->getList($tmp);
			
			echo "</urlset>".chr(10);
			
			$scriptname = basename($_SERVER['SCRIPT_NAME']);
			$no_html = intval(JRequest::getInt('no_html', 0));
			if ($scriptname != 'index2.php' || $no_html != 1) {
				die();
			}
		}
	};
?>