<?php
/**
* @version		$Id: helper.php 10812 2008-08-26 19:36:10Z charlvn $
* @package		Joomla
* @copyright	Copyright (C) 2005 - 2008 Open Source Matters. All rights reserved.
* @license		GNU/GPL, see LICENSE.php
* Joomla! is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* See COPYRIGHT.php for copyright notices and details.
*/

// no direct access
defined('_JEXEC') or die('Restricted access');


jimport('joomla.base.tree');
jimport('joomla.utilities.simplexml');

/**
 * mod_mainmenu Helper class
 *
 * @static
 * @package		Joomla
 * @subpackage	Menus
 * @since		1.5
 */
class superfish_modMainMenuHelper
{
	function buildXML(&$params)
	{
		$menu = new superfish_JMenuTree($params);
		$items = &JSite::getMenu();

		// Get Menu Items
		$rows = $items->getItems('menutype', $params->get('menutype'));
		$maxdepth = $params->get('maxdepth',10);

		// Build Menu Tree root down (orphan proof - child might have lower id than parent)
		$user =& JFactory::getUser();
		$ids = array();
		$ids[0] = true;
		$last = null;
		$unresolved = array();
		// pop the first item until the array is empty if there is any item
		if ( is_array($rows)) {
			while (count($rows) && !is_null($row = array_shift($rows)))
			{
				if (array_key_exists($row->parent, $ids)) {
					$row->ionly = $params->get('menu_images_link');
					$menu->addNode($params, $row);

					// record loaded parents
					$ids[$row->id] = true;
				} else {
					// no parent yet so push item to back of list
					// SAM: But if the key isn't in the list and we dont _add_ this is infinite, so check the unresolved queue
					if(!array_key_exists($row->id, $unresolved) || $unresolved[$row->id] < $maxdepth) {
						array_push($rows, $row);
						// so let us do max $maxdepth passes
						// TODO: Put a time check in this loop in case we get too close to the PHP timeout
						if(!isset($unresolved[$row->id])) $unresolved[$row->id] = 1;
						else $unresolved[$row->id]++;
					}
				}
			}
		}
		return $menu->toXML();
	}

	function &getXML($type, &$params, $decorator)
	{
		static $xmls;

		if (!isset($xmls[$type])) {
			$cache =& JFactory::getCache('mod_mainmenu');
			$string = $cache->call(array('superfish_modMainMenuHelper', 'buildXML'), $params);
			$xmls[$type] = $string;
		}

		// Get document
		$xml = JFactory::getXMLParser('Simple');
		$xml->loadString($xmls[$type]);
		$doc = &$xml->document;

		$menu	= &JSite::getMenu();
		$active	= $menu->getActive();
		$start	= $params->get('startLevel');
		$end	= $params->get('endLevel');
		$sChild	= $params->get('showAllChildren');
		$path	= array();

		// Get subtree
		if ($start)
		{
			$found = false;
			$root = true;
			if(!isset($active)){
				$doc = false;
			}
			else{
				$path = $active->tree;
				for ($i=0,$n=count($path);$i<$n;$i++)
				{
					foreach ($doc->children() as $child)
					{
						if ($child->attributes('id') == $path[$i]) {
							$doc = &$child->ul[0];
							$root = false;
							break;
						}
					}

					if ($i == $start-1) {
						$found = true;
						break;
					}
				}
				if ((!is_a($doc, 'JSimpleXMLElement')) || (!$found) || ($root)) {
					$doc = false;
				}
			}
		}

		if ($doc && is_callable($decorator)) {
			$doc->map($decorator, array('end'=>$end, 'children'=>$sChild));
		}
		return $doc;
	}

	function render(&$params, $callback)
	{
	
		// Include the new menu class
		$xml = superfish_modMainMenuHelper::getXML($params->get('menutype'), $params, $callback);
		if ($xml) {
			$class = implode(" ", Array($params->get('class_sfx'), 'sf-menu', 'sf-'.$params->get('menu_style')));
			$xml->addAttribute('class', 'menu'.$class);
			if ($tagId = $params->get('tag_id')) {
				$xml->addAttribute('id', $tagId);
			}

			$result = JFilterOutput::ampReplace($xml->toString((bool)$params->get('show_whitespace')));
			$result = str_replace(array('<ul/>', '<ul />'), '', $result);
			echo $result."\n";



/*********************************************************************************************************/
/*********************************************************************************************************/

			$doc =& JFactory::getDocument();
			$cache =& JFactory::getCache();

			$noCache = !$params->get('cache') || !$cache->_options['caching'];
			
			$cs_path = JURI::base().'modules/mod_superfishmenu/tmpl/%s/%s.%s';
			$js_path = JURI::base().'modules/mod_superfishmenu/tmpl/%s/%s.%s';
			
		
			/* add the javascript files.  order is important! */
			$addScripts = Array('jquery');
			if($params->get('useEventSpecialHover')) $addScripts[] = 'jquery.event.hover';
			if($params->get('useBgIframe')) 		 $addScripts[] = 'jquery.bgiframe.min';
			if($params->get('useSuperSubs')) 		 $addScripts[] = 'supersubs';
			$addScripts[] = 'superfish';

			foreach($addScripts as $name) {
				if($noCache)
					$doc->addScript(sprintf($js_path, 'js', $name, 'js'),'text/javascript');
				else
					echo '<script language="javascript" type="text/javascript" src="'.sprintf($js_path, 'js', $name, 'js').'"></script>'."\n";
			}

			/* add the stylesheet files */
			$addStyles = Array();
			if($params->get('menu_style')!='list') $addStyles[] = 'superfish';
			if($params->get('menu_style')=='vertical') $addStyles[] = 'superfish-vertical';
			if($params->get('menu_style')=='navbar') $addStyles[] = 'superfish-navbar';

			foreach($addStyles as $name) 
				if($noCache)
					$doc->addStyleSheet(sprintf($cs_path, 'css', $name, 'css'),'text/css');   
				else
					echo '<link rel="stylesheet" type="text/css" href="'.sprintf($cs_path, 'css', $name, 'css').'" />'."\n";
			}


			/* add any custom stylesheet files */
			if($params->get('custom_stylesheets')) {
				$sheets = preg_split('/\n/', $params->get('custom_stylesheets') );
				foreach($sheets as $idx=>$sheet) {
					if(!$sheet) continue;
					list($url, $media) = preg_split('/(?<!\\\):/', $sheet );
					if(!$media) $media = 'all';
					$url = str_replace( Array("\\:","{mostemplate}"), Array(':','templates/'.$doc->get('template')), $url);
					// get parameters of the style, for security reasons, backslash any quotes
					// i think joomla fixes this automagically, but just in case :)
					$url = preg_replace( '/"/', '\\"', $url );
					$url = preg_replace( '/{(.*?)}/e', '$doc->params->get("\\1","")', $url );

					if($noCache)
						$doc->addStyleSheet($url, 'text/css', $media);
					else
						echo '<link rel="stylesheet" type="text/css" href="'.$url.'" media="'.$media.'" />'."\n";
				}
			}
			
			/* add any custom css */
			if($params->get('custom_css')) {

				if($noCache)
					$doc->addStyleDeclaration( $params->get('custom_css') ,'text/css');
				else
					echo '<style type="text/css">'."\n".($params->get('custom_css'))."\n".'</style>'."\n";
			}
			
			/* get the superfish options */
			$superfish_options = Array(
				'hoverClass' 	=> $params->get('hoverClass', 'sfHover'),
				'pathClass' 	=> $params->get('pathClass', ''),
				'pathLevels' 	=> $params->get('pathLevels', '1'),
				'delay' 		=> $params->get('delay', '800'),
				'animation' 	=> $params->get('animation','{opacity:\'show\'}'),
				'speed' 		=> $params->get('speed', 'def'),
				'autoArrows' 	=> $params->get('autoArrows','1'),
				'dropShadows' 	=> $params->get('dropShadows','1'),
				'onInit' 		=> $params->get('onInit',''),
				'onBeforeShow' 	=> $params->get('onBeforeShow',''),
				'onShow' 		=> $params->get('onShow',''),
				'onHide' 		=> $params->get('onHide',''),
			);
			if($superfish_options['animation']=='custom') $superfish_options['animation'] = $params->get('custom_animation');
			if($superfish_options['animation']=='{}') $superfish_options['animation'] = '';

			$no_quote = Array('animation', 'onInit', 'onBeforeShow','onShow','onHide');
			
			if(!function_exists('hasValue')) {
				function hasValue($var) { return $var !== ''; }
			}
			$superfish_options = array_filter( $superfish_options, 'hasValue' );

			foreach($superfish_options as $key=>$value) $superfish_options[$key] = $key.':'.(in_array($key, $no_quote) || preg_match('/^(true|false|([0-9]+))$/i', $value) ? $value : "'$value'");
			$superfish_options = implode(', ', $superfish_options);
			
			$superstring = 'jQuery("ul.sf-menu")';
			if($params->get('useSuperSubs')) $superstring .= '.supersubs({minWidth:\''.$params->get('min_width').'\', maxWidth:\''.$params->get('max_width').'\', extraWidth:\''.$params->get('extra_width').'\'})';
			$superstring .= '.superfish({'.$superfish_options.'})';
			
			if($params->get('useBgIframe')) {
				$bgi_options = Array(
					'top' 		=> $params->get('bgi_top', 'auto'),
					'left' 		=> $params->get('bgi_left', 'auto'),
					'width' 	=> $params->get('bgi_width', 'auto'),
					'height' 	=> $params->get('bgi_height', 'auto'),
					'opacity' 	=> $params->get('bgi_opacity', 'true'),
					'src' 		=> $params->get('bgi_src', 'javascript:false;'),
				);
				foreach($bgi_options as $key=>$value) $bgi_options[$key] = $key.':'.(preg_match('/^(true|false|([0-9]+))$/i', $value) ? $value : "'$value'");
				$bgi_options = implode(', ', $bgi_options);
	
				$superstring .= '.find(\'ul\').bgIframe({'.$bgi_options.'})';
			}

			$setup_js = "jQuery(document).ready(function(){ $superstring });";

			if($noCache)
				$doc->addScriptDeclaration($setup_js, 'text/javascript');
			else
				echo '<script language="javascript" type="text/javascript">'."\n".$setup_js."\n".'</script>';

			/* get the $.event.special.hover options */
			if($params->get('useEventSpecialHover')) {
				$setup_js  = 'jQuery.event.special.hover.delay = '.$params->get('hover_delay', '100').";\n";
				$setup_js .= 'jQuery.event.special.hover.speed = '.$params->get('hover_speed', '100').";\n";
				if($noCache)
					$doc->addScriptDeclaration($setup_js, 'text/javascript');
				else
					echo '<script language="javascript" type="text/javascript">'."\n".$setup_js."\n".'</script>';
			}
			
			// I sure hope that's all!

/*********************************************************************************************************/
/*********************************************************************************************************/

		}
	}

/**
 * Main Menu Tree Class.
 *
 * @package		Joomla
 * @subpackage	Menus
 * @since		1.5
 */
class superfish_JMenuTree extends JTree
{
	/**
	 * Node/Id Hash for quickly handling node additions to the tree.
	 */
	var $_nodeHash = array();

	/**
	 * Menu parameters
	 */
	var $_params = null;

	/**
	 * Menu parameters
	 */
	var $_buffer = null;

	function __construct(&$params)
	{
		$this->_params		=& $params;
		$this->_root		= new superfish_JMenuNode(0, 'ROOT');
		$this->_nodeHash[0]	=& $this->_root;
		$this->_current		=& $this->_root;
	}

	function addNode(&$params, $item)
	{
		// Get menu item data
		$data = $this->_getItemData($params, $item);

		// Create the node and add it
		$node = new superfish_JMenuNode($item->id, $item->name, $item->access, $data);

		if (isset($item->mid)) {
			$nid = $item->mid;
		} else {
			$nid = $item->id;
		}
		$this->_nodeHash[$nid] =& $node;
		$this->_current =& $this->_nodeHash[$item->parent];

		if ($this->_current) {
			$this->addChild($node, true);
		} else {
			// sanity check
			JError::raiseError( 500, 'Orphan Error. Could not find parent for Item '.$item->id );
		}
	}

	function toXML()
	{
		// Initialize variables
		$this->_current =& $this->_root;

		// Recurse through children if they exist
		while ($this->_current->hasChildren())
		{
			$this->_buffer .= '<ul>';
			foreach ($this->_current->getChildren() as $child)
			{
				$this->_current = & $child;
				$this->_getLevelXML(0);
			}
			$this->_buffer .= '</ul>';
		}
		if($this->_buffer == '') { $this->_buffer = '<ul />'; }
		return $this->_buffer;
	}

	function _getLevelXML($depth)
	{
		$depth++;

		// Start the item
		$this->_buffer .= '<li access="'.$this->_current->access.'" level="'.$depth.'" id="'.$this->_current->id.'">';

		// Append item data
		$this->_buffer .= $this->_current->link;

		// Recurse through item's children if they exist
		while ($this->_current->hasChildren())
		{
			$this->_buffer .= '<ul>';
			foreach ($this->_current->getChildren() as $child)
			{
				$this->_current = & $child;
				$this->_getLevelXML($depth);
			}
			$this->_buffer .= '</ul>';
		}

		// Finish the item
		$this->_buffer .= '</li>';
	}

	function _getItemData(&$params, $item)
	{
		$data = null;

		// Menu Link is a special type that is a link to another item
		if ($item->type == 'menulink')
		{
			$menu = &JSite::getMenu();
			if ($newItem = $menu->getItem($item->query['Itemid'])) {
    $tmp = clone($newItem);
				$tmp->name	 = '<span><![CDATA['.$item->name.']]></span>';
				$tmp->mid	 = $item->id;
				$tmp->parent = $item->parent;
			} else {
				return false;
			}
		} else {
			$tmp = clone($item);
			$tmp->name = '<span><![CDATA['.$item->name.']]></span>';
		}

		$iParams = new JParameter($tmp->params);
		if ($params->get('menu_images') && $iParams->get('menu_image') && $iParams->get('menu_image') != -1) {
			$image = '<img src="'.JURI::base(true).'/images/stories/'.$iParams->get('menu_image').'" alt="'.$item->alias.'" />';
			if($tmp->ionly){
				 $tmp->name = null;
			 }
		} else {
			$image = null;
		}
		switch ($tmp->type)
		{
			case 'separator' :
				return '<span class="separator">'.$image.$tmp->name.'</span>';
				break;

			case 'url' :
				if ((strpos($tmp->link, 'index.php?') === 0) && (strpos($tmp->link, 'Itemid=') === false)) {
					$tmp->url = $tmp->link.'&amp;Itemid='.$tmp->id;
				} else {
					$tmp->url = $tmp->link;
				}
				break;

			default :
				$router = JSite::getRouter();
				$tmp->url = $router->getMode() == JROUTER_MODE_SEF ? 'index.php?Itemid='.$tmp->id : $tmp->link.'&Itemid='.$tmp->id;
				break;
		}

		// Print a link if it exists
		if ($tmp->url != null)
		{
			// Handle SSL links
			$iSecure = $iParams->def('secure', 0);
			if ($tmp->home == 1) {
				$tmp->url = JURI::base();
			} elseif (strcasecmp(substr($tmp->url, 0, 4), 'http') && (strpos($tmp->link, 'index.php?') !== false)) {
				$tmp->url = JRoute::_($tmp->url, true, $iSecure);
			} else {
				$tmp->url = str_replace('&', '&amp;', $tmp->url);
			}

			switch ($tmp->browserNav)
			{
				default:
				case 0:
					// _top
					$data = '<a href="'.$tmp->url.'">'.$image.$tmp->name.'</a>';
					break;
				case 1:
					// _blank
					$data = '<a href="'.$tmp->url.'" target="_blank">'.$image.$tmp->name.'</a>';
					break;
				case 2:
					// window.open
					$attribs = 'toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes,'.$this->_params->get('window_open');

					// hrm...this is a bit dickey
					$link = str_replace('index.php', 'index2.php', $tmp->url);
					$data = '<a href="'.$link.'" onclick="window.open(this.href,\'targetWindow\',\''.$attribs.'\');return false;">'.$image.$tmp->name.'</a>';
					break;
			}
		} else {
			$data = '<a>'.$image.$tmp->name.'</a>';
		}

		return $data;
	}
}

/**
 * Main Menu Tree Node Class.
 *
 * @package		Joomla
 * @subpackage	Menus
 * @since		1.5
 */
class superfish_JMenuNode extends JNode
{
	/**
	 * Node Title
	 */
	var $title = null;

	/**
	 * Node Link
	 */
	var $link = null;

	/**
	 * CSS Class for node
	 */
	var $class = null;

	function __construct($id, $title, $access = null, $link = null, $class = null)
	{
		$this->id		= $id;
		$this->title	= $title;
		$this->access	= $access;
		$this->link		= $link;
		$this->class	= $class;
	}
}
