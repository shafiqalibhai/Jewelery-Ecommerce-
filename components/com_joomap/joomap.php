<?php
defined('_JEXEC') or die('Direct Access to this location is not allowed.');

/** 
 * Joomap - A sitemap component for Joomla! CMS (http://www.joomla.org)
 * Project Website: http://www.koder.de/joomap.html
 * @license GNU/GPL v2 (http://www.gnu.org/licenses/gpl-2.0.html)
 * @author Daniel Grothe / www.koca.de
 * @author MIC / www.mgfi.info
 * @version $Id: joomap.php 13 2008-08-18 14:41:01Z koders.de $
 */

/**
 * This is the Joomap component frontend entry-point.
 */

	// load Joomap language file
	$langPath = JPATH_COMPONENT_ADMINISTRATOR.DS.'language'.DS;
	$lang =& JFactory::getLanguage();
	if (file_exists($langPath.$lang->getBackwardLang().'.php')) {
	    include_once $langPath.$lang->getBackwardLang().'.php';
	} else {
	    include_once $langPath.'english.php';
	}

	require_once JPATH_COMPONENT_ADMINISTRATOR.DS.'classes'.DS.'JoomapConfig.php';
	$config = new JoomapConfig;
	$config->load();

	require_once JPATH_COMPONENT_ADMINISTRATOR.DS.'classes'.DS.'JoomapPlugins.php';
	JoomapPlugins::loadPlugins();

	$joomap = new Joomap($config);
	$tree = $joomap->generateTree();
	//$joomap->printDebugTree( $tree );		// DEBUG output

	$view =  JRequest::getVar('view', 'html', '', 'string');
	switch( $view ) {
		
		case 'google':															// Google Sitemaps output
			require_once JPATH_COMPONENT_SITE.DS.'joomap.google.php';
			$view = new JoomapGoogle(); 
			$view->printTree($joomap, $tree);
			break;

		default:																// Html output
			global $mainframe;
			require_once $mainframe->getPath('front_html');
			$view = new JoomapHtml();
			$view->printTree($joomap, $tree);
			break;

	}

	/**
	 * Generates a node-tree of all the Menus in Joomla!
	 * This is the main class of the Joomap component.
	 * @author Daniel Grothe
	 * @access public
	 */
	class Joomap {
		/** @var JoomapConfig Configuration settings */
		var $config;
		/** @var integer The current user's access level */
		var $gid;
		/** @var boolean Is authentication disabled for this website? */
		var $noauth;
		/** @var string Current time as a ready to use SQL timeval */
		var $now;
		/** @var StdClass Access restrictions for user */
		var $access;

		/** Default constructor, requires the config as parameter. */
		function Joomap(&$config) {
			$this->config =& $config;
			
			$user =& JFactory::getUser();
			$access = new StdClass();
			$access->canEdit 	= $user->authorize( 'com_content', 'edit', 'content', 'all' );
			$access->canEditOwn = $user->authorize( 'com_content', 'edit', 'content', 'own' );
			$access->canPublish = $user->authorize( 'com_content', 'publish', 'content', 'all' );
			$this->access	=& $access;
			$this->gid		= $user->gid;

			$siteConfig =& JFactory::getConfig();
			$this->noauth 	= $siteConfig->getValue('config.shownoauth');
			$this->now		= date( 'Y-m-d H:i:s', time() + $siteConfig->getValue('config.offset') * 60 * 60 );
		}

		/** Generate a full website tree */
		function &generateTree() {
			$menus = $this->config->getMenus();
			$root = array();
			foreach ( $menus as $menutype => $menu ) {
				if( !$menu->show )
					continue;

				$node = new stdclass();

				$node->ordering = $menu->ordering;
				$node->tree = $this->getMenuTree($menutype);

				if( count($node->tree) == 0 )									// ignore empty menus
					continue;

				$node->browserNav = 3;
				$node->type = 'separator';
				$node->name = $this->getMenuTitle($menutype);					// get the mod_mainmenu title from modules table
				$root[] = $node;												// add the menu to the sitetree
			}
			usort($root, array('Joomap','sort_ordering'));						//sort the root tree according to ordering
			return $root;
		}

		/**
		 * Get a Menu's items and sub-menus as a tree.
		 * Get the complete list of menu entries where the menu is in $menutype.
		 * If the component, that is linked to the menuitem, has a registered handler,
		 * this function will call the handler routine and add the complete tree.
		 * A tree with subtrees for each menuitem is returned.
		 */
		function &getMenuTree( &$menutype ) {
			$database =& JFactory::getDBO();

			if( strlen($menutype) == 0 ) {
				$result = null;
				return $result;
			}

			$menuExluded	= explode( ',', $this->config->exclmenus ); 		// by mic: fill array with excluded menu IDs
			// echo '<br />[DEBUG excluded menus] ' . $this->config->exclmenus . '<br />';

			/* * noauth is true:
			   - Will show links to registered content, even if the client is not logged in.
			   - The user will need to login to see the item in full.
			   * noauth is false:
			   - Will show only links to content for which the logged in client has access.
			*/
			$sql = "SELECT m.id, m.name, m.parent, m.link, c.option, m.browserNav, m.menutype, m.ordering, m.params, m.componentid, c.name AS component"
            . "\n FROM #__menu AS m"
            . "\n LEFT JOIN #__components AS c ON m.type='component' AND c.id=m.componentid"
            . "\n WHERE m.published='1' AND m.menutype = '".$menutype."'"
            . ( $this->noauth ? '' : "\n AND m.access <= '". $this->gid ."'" )
            . "\n ORDER BY m.menutype,m.parent,m.ordering";

			// Load all menuentries
			$database->setQuery( $sql );
			$items = $database->loadObjectList();

			if( count($items) <= 0) {	//ignore empty menus
				$result = null;
				return $result;
			}
			
			$root = array();

			foreach($items as $i => $item) {									// Add each menu entry to the root tree.

                if( in_array( $item->id, $menuExluded ) ) {						// skip to be excluded menu-items
                    continue;
                }

				$node = new stdclass;
				$node->tree 		= JoomapPlugins::getTree( $this, $item );	// Determine the menu entry's type and call it's handler

				$node->id 			= $item->id;
				$node->name 		= $item->name;								// displayed name of node
				$node->parent 		= $item->parent;							// id of parent node
				$node->browserNav 	= $item->browserNav;						// how to open link
				$node->ordering 	= isset($item->ordering) ? $item->ordering : $i;	// display-order of the menuentry
				$node->link 		= isset($item->link) ? htmlspecialchars($item->link) : '';	// convert link to valid xml
				$node->type 		= isset($item->type) ? $item->type : '';	// menuentry-type
				if (isset($item->modified))										// getTree() might have added a modified date
					$node->modified = $item->modified;

				$root[$node->id] 	= $node;									//add this node to the root tree
			}

			//move children into the tree of their parent
			
			foreach($root as $node) {
				if( $node->parent > 0 && isset($root[$node->parent]) ) {
					$root[$node->parent]->tree[] = &$root[$node->id];
				}
			}

			//remove all children from the toptree
			
			foreach ($root as $node) {
				if ($node->parent > 0) {
					unset($root[$node->id]);
				}
			}

			usort($root, array('Joomap', 'sort_ordering'));						//sort the top tree according to ordering

			return $root;
		}

		/** Look up the title for the module that links to $menutype */
		function getMenuTitle($menutype) {
			$database =& JFactory::getDBO();
			
			$query = "SELECT * FROM #__modules WHERE published='1' AND module='mod_mainmenu' AND params LIKE '%menutype=". $menutype ."%'";
			$database->setQuery($query);
			$row = $database->loadObject();
			if (!$row)
				return '';
			return $row->title;
		}

		/** Print tree details for debugging and testing */
		function printDebugTree( &$tree ) {
			foreach( $tree as $menu) {
				echo $menu->name."<br />\n";
				echo '<pre>';
				print_r( $menu->tree );
				echo '</pre>';
			}
		}

		/** called with usort to sort menus */
		function sort_ordering( &$a, &$b) {
			if( $a->ordering == $b->ordering )
				return 0;
			return $a->ordering < $b->ordering ? -1 : 1;
		}
	};

?>
