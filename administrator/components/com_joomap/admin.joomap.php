<?php
defined( '_JEXEC' ) or die( 'Direct Access to this location is not allowed.' );

/**
 * Joomap - A sitemap component for Joomla! CMS (http://www.joomla.org)
 * Project Website: http://www.koder.de/joomap.html
 * @license GNU/GPL v2 (http://www.gnu.org/licenses/gpl-2.0.html)
 * @author Daniel Grothe / www.koca.de
 * @author MIC / www.mgfi.info
 * @version $Id: admin.joomap.php 15 2008-08-18 15:37:08Z koders.de $
 */

// check access permissions (only superadmins & admins)

$user =& JFactory::getUser();
if (!$user->authorize('com_users', 'manage')) {
	$app =& JFactory::getApplication();
	$app->redirect( 'index2.php', JText::_('ALERTNOTAUTH'));
}

// load language file

$lang =& JFactory::getLanguage();
if( file_exists( JPATH_COMPONENT.DS.'language'.DS.$lang->getBackwardLang().'.php') ) {
	require_once JPATH_COMPONENT.DS.'language'.DS.$lang->getBackwardLang().'.php';
} else {
	//echo 'Language file [ '. $lang->getBackwardLang().' ] not found, using default language: english<br />';
	require_once JPATH_COMPONENT.DS.'language'.DS.'/english.php';
}

// load settings from database
require_once JPATH_COMPONENT.DS.'classes'.DS.'JoomapConfig.php';
$config = new JoomapConfig();
if( !$config->load() ) {
	$text = _JOOMAP_ERR_NO_SETTINGS."<br />\n";
	$link = 'index2.php?option=com_joomap&task=create';
	echo sprintf( $text, $link );
}

$cid 	= JRequest::getVar('cid', array(), '', 'array');
JArrayHelper::toInteger($cid, array());
$task 	= JRequest::getVar('task', '', '', 'string');

$admin = new JoomapAdmin;
$admin->show( $config, $task, $cid );

class JoomapAdmin {
	
	var $config = null;
	
	/** Parses input parameters and calls appropriate function */
	function show( &$config, &$task, &$cid ) {
		$this->config = &$config;
		
		switch ($task) {
			
			case 'save':
				$result = $this->saveOptions();				
				$app =& JFactory::getApplication();
				$app->redirect('index.php?option=com_joomap', $this->getMessage($result));
				break;
			
			case 'cancel':
				$app =& JFactory::getApplication();
				$app->redirect('index.php');
				break;
			
			case 'publish':
				if ($this->setMenuShow($cid, true))
					$this->showSettingsDialog();
				break;
			
			case 'unpublish':
				if ($this->setMenuShow($cid, false))
					$this->showSettingsDialog();
				break;
			
			case 'orderup':
				if ($this->orderMenu($cid[0], -1))
					$this->showSettingsDialog();
				break;
			
			case 'orderdown':
				if ($this->orderMenu($cid[0], 1))
					$this->showSettingsDialog();
				break;
			
			case 'create':
				$config->create();
				$this->showSettingsDialog();
				break;
			
			case 'restore':
				if( $config->restore() ){
					$app =& JFactory::getApplication();
					$app->redirect('index.php?option=com_joomap', _JOOMAP_MSG_SET_RESTORED);
					return;
				}
				$this->showSettingsDialog();
				break;
			
			case 'backup':
				if( $config->backup() ){
					$app =& JFactory::getApplication();
					$app->redirect('index.php?option=com_joomap', _JOOMAP_MSG_SET_BACKEDUP);
					return;
				}
				$this->showSettingsDialog();
				break;
			
			default:
				$this->showSettingsDialog();
				break;
		}
	}
		
	/** 
	 * Show settings dialog
	 * @param integer  configuration save success
	 */
	function showSettingsDialog($success = 0) {
		global $mainframe;
		
		$database	=& JFactory::getDBO();
		$config		=& $this->config;
	
		$limit		= $mainframe->getUserStateFromRequest('viewlistlimit', 'limit', $mainframe->getCfg('list_limit'), 'int');
		$limitstart	= $mainframe->getUserStateFromRequest('viewlimitstart', 'limitstart', 0, 'int');

		$menus = $this->getMenus();
		$this->sortMenus($menus);
		$total = count($menus);
		
		jimport('joomla.html.pagination');
		$pageNav = new JPagination( $total, $limitstart, $limit );

		// images for 'external link' tagging
		
		$javascript = 'onchange="changeDisplayImage();"';
	    $directory = '/components/com_joomap/images';
	    $lists['imageurl'] = JHTML::_('list.images', 'imageurl', $config->ext_image, $javascript, $directory );
	    
	    // column count selection

	    $columns = array(
			JHTML::_('select.option', 1),
			JHTML::_('select.option', 2 ),
			JHTML::_('select.option', 3 ),
			JHTML::_('select.option', 4 )
		);
		//jimport('joomla.html.html.select');
		$lists['columns'] = JHTML::_('select.genericlist', $columns, 'columns', 'id="columns" class="inputbox" size="1"', 'value', 'text',  $config->columns);
	
		// get list of menu entries in all menus
		
		$query = "SELECT id AS value, name AS text, CONCAT( id, ' - ', name ) AS menu"
			."\n FROM #__menu"
			."\n WHERE published != -2"
			."\n ORDER BY menutype, parent, ordering";
		$database->setQuery( $query );
		$exclmenus = $database->loadObjectList();
		$lists['exclmenus'] = JHTML::_('select.genericlist', $exclmenus, 'excl_menus', 'class="inputbox" size="1"', 'value', 'menu', NULL );
	
		require_once $mainframe->getPath('admin_html');
		JoomapAdminHtml::show($config, $menus, $pageNav, $lists);
	}

	/** Save settings handed via POST */
	function saveOptions() {
		$config = &$this->config;
	
		$config->classname 			= JRequest::getVar('classname', $config->classname, 'post', 'string' );
		$config->expand_category 	= JRequest::getVar('expand_category', 0, 'post', 'int' );
		$config->expand_section 	= JRequest::getVar('expand_section', 0, 'post', 'int' );
		$config->show_menutitle 	= JRequest::getVar('show_menutitle', 0, 'post', 'int' );
		$config->columns 			= JRequest::getVar('columns', $config->columns, 'post', 'int' );
		$config->exlinks 			= JRequest::getVar('exlinks', 0, 'post', 'int' );
		$config->includelink		= JRequest::getVar('includelink', 0, 'post', 'int' );
		$config->ext_image 			= JRequest::getVar('imageurl', '', 'post', 'string' );
		$config->exclmenus			= JRequest::getVar('exclmenus', $config->exclmenus, 'post', 'string' );
		
		$config->exclmenus 			= str_replace(' ', '', $config->exclmenus); 	// eliminate blanks
	
		$menus 						= $this->getMenus();
		$menutypes					= $this->getMenuTypes();
	
		$order						= JRequest::getVar('order', array(), 'post', 'array');	// menu id => menu ordering
		$csscontent	 				= JRequest::getVar('csscontent', '', 'post', 'string', JREQUEST_ALLOWRAW);	// CSS
	
		foreach($order as $key => $value) {
			$menutype = $menutypes[$key];
			$menus[ $menutype ]->ordering = $value;
		}
		$this->sortMenus( $menus );
		$config->setMenus( $menus );

		$success = $config->save() ? 1 : 2;
		
		// save css
		$file 			= JPATH_COMPONENT_SITE.DS.'css'.DS.'joomap.css';
		$enable_write	= JRequest::getVar('enable_write', 0, 'post', 'int');
		$disable_write	= JRequest::getVar('disable_write', 0, 'post', 'int');
		$oldperms		= fileperms($file);
	
		if( $enable_write ){
			@chmod( $file, $oldperms | 0222 );
		}
	
		clearstatcache();
		
		if( $fp = @fopen( $file, 'w' )) {
			fputs( $fp, stripslashes( $csscontent ) );
			fclose( $fp );
			if( $enable_write ) {
				@chmod( $file, $oldperms );
			}else{
				if ($disable_write){
					@chmod($file, $oldperms & 0777555);
				}
			}
		} else {
			if( $enable_write ){
				@chmod( $file, $oldperms );
			}
		}
		// end CSS
	
		return $success;
	}

	/** Move the display order of a record */
	function orderMenu( $uid, $inc ) {
		$config = &$this->config;
	
		$menus		= $this->getMenus();
		$menutypes  = $this->getMenuTypes();
		$menutype	= $menutypes[$uid];
		
		// move position up/down
		
		$menus[$menutype]->ordering += $inc;
		
		// swap position with previous entry at that position
		
		foreach ($menus as $type => $menu) {
			if ($type != $menutype
				&& $menu->ordering == $menus[$menutype]->ordering )
				$menus[$type]->ordering -= $inc;
		}
		
		$this->sortMenus($menus);
		$config->setMenus($menus);
		if (!$config->save()) {
			JError::raiseWarning(500, _JOOMAP_ERR_CONF_SAVE);
			return false;
		}
		
		return true;
	}

	/** Set the show attribute for multiple menus */
	function setMenuShow( $cid, $show ) {
		$config = &$this->config;
		$menus		= $this->getMenus();
		$menutypes  = $this->getMenuTypes();

		foreach ($cid as $uid) {
			$menutype = $menutypes[$uid];	
			$menus[$menutype]->show = $show;
		}
		
		$config->setMenus($menus);
		if( !$config->save() ) {
			JError::raiseWarning(500, _JOOMAP_ERR_CONF_SAVE);
			return false;
		}
		
		return true;
	}

//------------------------------ MISC FUNCTIONS ------------------------------//

	/**
	 * Map message code to message text
	 * TODO: Find better solution for setting result messages  
	 *
	 * @param int $msgCode
	 * @return string
	 */
	
	function getMessage($msgCode) {
	$msg = '';
	switch ($msgCode) {
		case 1:
			$msg = _JOOMAP_MSG_SET_BACKEDUP;
			break;

		case 2:
			$msg = _JOOMAP_ERR_CONF_SAVE;
			break;

		default:
			break;
	    }
	    
		return $msg;
	}
	
	/** uasort function that compares element ordering */
	function sort_ordering( &$a, &$b) {
		if( $a->ordering == $b->ordering) {
			return 0;
		}
		return $a->ordering < $b->ordering ? -1 : 1;
	}

	/** make menu ordering continuous*/
	function sortMenus( &$menus ) {
		uasort( $menus, array('JoomapAdmin','sort_ordering') );
		$i = 0;
		foreach( $menus as $key => $menu)
			$menus[$key]->ordering = $i++;
	}

	/**
	 * Load all registered menutypes
	 * @return array
	 */
	function getMenuTypes() {
		$query = 'SELECT menutype FROM #__menu_types';	// has UNIQUE index
		$db = &JFactory::getDBO();
		$db->setQuery($query);
		return $db->loadResultArray();
	}
	
	/**
	 * Get the complete list of menus in joomla.
	 */
	function &getMenus() {
		
		$menutypes = $this->getMenuTypes();

		// Load configured menutypes from config 
		
		$config =& $this->config;
		$menus = $config->getMenus();
		
		// Merge configured and not yet configured menutypes 
		
		$allmenus = array();
		foreach ($menutypes as $index => $menutype) {
			if (isset($menus[$menutype])) {
				$allmenus[$menutype] = $menus[$menutype];
			} else {
				$allmenus[$menutype] = new stdclass;
				$allmenus[$menutype]->ordering = $index;
				$allmenus[$menutype]->show = false;
			}
			$allmenus[$menutype]->id = $index;
			$allmenus[$menutype]->type = $menutype;
		}
	
		return $allmenus;
	}
};
?>
