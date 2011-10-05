<?php
defined( '_JEXEC' ) or die( 'Direct Access to this location is not allowed.' );

// Register with the Plugin Manager
$tmp = new Joomap_content();
JoomapPlugins::addPlugin($tmp);

/**
 * A Plugin to show standard Joomla content in the Joomap Sitemap.
 *
 * @package Plugins
 * @author Daniel Grothe
 * @version $Id: content.plugin.php 12 2008-08-17 20:51:27Z koders.de $
 */
class Joomap_content {

	/**
	 * Keeps the reference of the calling Joomap instance.
	 * @var Joomap
	 */
	var $joomap;
	
	/**
	 * Keeps the reference of the currenty processed Menu-Item.
	 *
	 * @var stdClass
	 */
	var $menuEntry;
	
	/**
	 * Checks wether this Plugin is able to handle the passed Menu-Item. 
	 *
	 * @param Joomap $joomap
	 * @param Object $menuItem
	 * @return bool
	 */
	function isOfType(&$joomap, &$menuItem) {
		return ($menuItem->option == 'com_content');
	}

	/**
	 * Processes the Menu-Entry and creates a tree of content-nodes.
	 *
	 * @param Joomap $joomap
	 * @param stdClass $menuEntry 
	 * @return array|null
	 */
	function &getTree(&$joomap, &$menuEntry) {
		$this->joomap =& $joomap;
		$this->menuEntry =& $menuEntry;

		// Extract all query-parameters from the link
		// view=category|section
		// layout=blog|''
		// id=category or section id
		
		list($script, $query) = explode('?', $menuEntry->link, 2);
		$queryParts = explode('&', $query);
		$query = new StdClass();  
		foreach ($queryParts as $part) {
			 list($key, $val) = explode('=', $part, 2);
			 if ($key)
			 	$query->$key = $val;
		}
		
		// Generate the content tree
		
		$action = $query->view;
		if (isset($query->layout))
			$action .= $query->layout;
		
		$result = null;		
		switch ($action) {
			
			case 'section':
				if ($this->joomap->config->expand_section)
					$result = $this->getSection($query->id);
				break;
			
			case 'sectionblog':
				if ($this->joomap->config->expand_section)
					$result = $this->getSectionBlog($query->id);
				break;
			
			case 'category':
				if ($this->joomap->config->expand_category)
					$result = $this->getCategory($query->id);
				break;

			case 'categoryblog':
				if ($this->joomap->config->expand_category)
					$result = $this->getCategory($query->id);
				break;
				
			case 'article':
				break;
		}
		
		return $result;
	}
	
	/**
	 * Generates a tree of all the categories in the section and the articles in
	 * each category.
	 * Category articles get omitted if <code>expand_category</code> is disabled
	 * in the Joomap configuration. 
	 *
	 * @param int $id The Section Id
	 * @return array
	 */
	function getSection($id) {
		require_once JPATH_SITE.DS.'components'.DS.'com_content'.DS.'helpers'.DS.'query.php';
		require_once JPATH_SITE.DS.'components'.DS.'com_content'.DS.'models'.DS.'section.php';
		$section = new ContentModelSection;
		$section->setId($id);
		
		// Temporarily set the Menu-Entry as the active entry, so the
		// Section-Model loads the correct Parameters.
		
		$menu =& JSite::getMenu();
		$item = $menu->getActive();
		$menu->setActive($this->menuEntry->id);
		$categories = $section->getCategories();
		$menu->setActive($item->id);
		
		$expand = $this->joomap->config->expand_category; 
		
		$content = array();
		$menuEntry =& $this->menuEntry;
		foreach ($categories as $item) {
			$node = new stdclass();
			$node->id = $menuEntry->id;
			$node->browserNav = $menuEntry->browserNav;
			$node->name = $item->title;
			if (!isset($item->modified) || $item->modified == '0000-00-00 00:00:00')
				$item->modified = isset($item->created) ? $item->created : null;
			$node->modified = $this->_toTimestamp($item->modified);
			$node->link = 'index.php?option=com_content&amp;view=category&amp;id='.$item->id;
			$node->type = 'component';
			if ($expand) {
				$node->tree = $this->getCategory($item->id);
			}
			$content[] = $node;
	    }
		
		return $content;
	}
	
	/**
	 * Generates a list of all published articles in the section.
	 *
	 * @param int $id The Section Id
	 * @return array
	 */
	function getSectionBlog($id) {
		
		require_once JPATH_SITE.DS.'components'.DS.'com_content'.DS.'helpers'.DS.'query.php';
		require_once JPATH_SITE.DS.'components'.DS.'com_content'.DS.'models'.DS.'section.php';
		$section = new ContentModelSection;
		$section->setId($id);
		
		// Temporarily set the Menu-Entry as the active entry, so the
		// Section-Model loads the correct Parameters.
		
		$menu =& JSite::getMenu();
		$item = $menu->getActive();
		$menu->setActive($this->menuEntry->id);
		$data = $section->getData();
		$menu->setActive($item->id);

		$content = array();
		$menuEntry =& $this->menuEntry;
		foreach ($data as $item) {
			$node = new stdclass();
			$node->id = $menuEntry->id;
			$node->browserNav = $menuEntry->browserNav;
			$node->name = $item->title;
			$node->type = 'component';
			if ($item->modified == '0000-00-00 00:00:00')
				$item->modified = $item->created;
			$node->modified = $this->_toTimestamp($item->modified);
			$node->link = 'index.php?option=com_content&amp;view=article&amp;id='.$item->id;
			$content[] = $node;
	    }

	    return $content;
	}

	/**
	 * Generates a list of all published articles in the category.
	 *
	 * @param int $id The Category Id
	 * @return array
	 */
	function getCategory($id) {
		require_once JPATH_SITE.DS.'components'.DS.'com_content'.DS.'helpers'.DS.'query.php';
		require_once JPATH_SITE.DS.'components'.DS.'com_content'.DS.'models'.DS.'category.php';
		$category = new ContentModelCategory;
		$category->setId($id);
		
		// Temporarily set the Menu-Entry as the active entry, so the
		// Category-Model loads the correct Parameters.
		
		$menu =& JSite::getMenu();
		$oldItem = $menu->getActive();
		$menu->setActive($this->menuEntry->id);
		
		// Also overwrite the Component name, so defaults get loaded correctly.
		
		$oldOption = JRequest::getVar('option', '', 'get');
		JRequest::setVar('option', 'com_content', 'get', true);
		
		$data = $category->getData();
		
		// Restore original active menu itemid and active component name.
		
		JRequest::setVar('option', $oldOption, 'get', true);
		$menu->setActive($oldItem->id);
		
		// Generate tree

		$content = array();
		$menuEntry =& $this->menuEntry;
		if ($data) {
			foreach ($data as $item) {
				$node = new stdclass();
				$node->id = $menuEntry->id;
				$node->browserNav = $menuEntry->browserNav;
				$node->name = $item->title;
				if ($item->modified == '0000-00-00 00:00:00')
					$item->modified = $item->created;
				$node->modified = $this->_toTimestamp($item->modified);
				$node->type = 'component';
				$node->link = 'index.php?option=com_content&amp;view=article&amp;id='.$item->id;
				$content[] = $node;
		    }
		}
		return $content;
	}
	
	/***************************************************/
	/* copied from /components/com_content/content.php */
	/***************************************************/

	/** Translate Joomla datestring to timestamp */
	function _toTimestamp( &$date ) {
		if ( $date && ereg( "([0-9]{4})-([0-9]{2})-([0-9]{2})[ ]([0-9]{2}):([0-9]{2}):([0-9]{2})", $date, $regs ) ) {
			return mktime( $regs[4], $regs[5], $regs[6], $regs[2], $regs[3], $regs[1] );
		}
		return FALSE;
	}
}
?>
