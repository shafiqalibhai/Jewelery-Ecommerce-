<?php defined( '_JEXEC' ) or die( 'Direct Access to this location is not allowed.' ); ?>
<?php
/* @package joomap
 * @author: Daniel Grothe, http://www.ko-ca.com/
 */

if( !defined( 'JOOMAP_LANG' )) {
    define('JOOMAP_LANG', 1 );
    // -- General ------------------------------------------------------------------
    define('_JOOMAP_CFG_COM_TITLE',			'Joomap Configuration');
    define('_JOOMAP_CFG_OPTIONS',			'Display Options');
    define('_JOOMAP_CFG_CSS_CLASSNAME',		'CSS Classname');
    define('_JOOMAP_CFG_EXPAND_CATEGORIES',	'Expand Content Categories');
    define('_JOOMAP_CFG_EXPAND_SECTIONS',	'Expand Content Sections');
    define('_JOOMAP_CFG_SHOW_MENU_TITLES',	'Show Menu Titles');
    define('_JOOMAP_CFG_NUMBER_COLUMNS',	'Number of Columns');
    define('_JOOMAP_EX_LINK',				'Mark external links');
    define('_JOOMAP_CFG_CLICK_HERE', 		'Click here');
    define('_JOOMAP_CFG_GOOGLE_MAP',		'Google Sitemap');
    define('_JOOMAP_EXCLUDE_MENU',			'Exclude Menu IDs');
    define('_JOOMAP_TAB_DISPLAY',			'Display');
    define('_JOOMAP_TAB_MENUS',				'Menus');
    define('_JOOMAP_CFG_WRITEABLE',			'Writeable');
    define('_JOOMAP_CFG_UNWRITEABLE',		'Unwriteable');
    define('_JOOMAP_MSG_MAKE_UNWRITEABLE',	'Make unwriteable after saving');
    define('_JOOMAP_MSG_OVERRIDE_WRITE_PROTECTION', 'Override write protection while saving');
    define('_JOOMAP_GOOGLE_LINK',			'Googlelink');
    define('_JOOMAP_CFG_INCLUDE_LINK',		'Invisible link to author');

    // -- Tips ---------------------------------------------------------------------
    define('_JOOMAP_EXCLUDE_MENU_TIP',		'Specify menu IDs you dont want to be included in the sitemap.<br /><strong>NOTE</strong><br />Seperate IDs with comma!');
    define('_JOOMAP_CFG_GOOGLE_MAP_TIP',	'The XML file generated for GoogleSiteMap');
    define('_JOOMAP_GOOGLE_LINK_TIP',		'Copy link and submit to GoogleSiteMap');

    // -- Menus --------------------------------------------------------------------
    define('_JOOMAP_CFG_SET_ORDER',			'Set Menu Display Order');
    define('_JOOMAP_CFG_MENU_SHOW',			'Show');
    define('_JOOMAP_CFG_MENU_REORDER',		'Reorder');
    define('_JOOMAP_CFG_MENU_ORDER',		'Order');
    define('_JOOMAP_CFG_MENU_NAME',			'Menu Name');
    define('_JOOMAP_CFG_DISABLE',			'Click to disable');
    define('_JOOMAP_CFG_ENABLE',			'Click to enable');
    define('_JOOMAP_SHOW',					'Show');
    define('_JOOMAP_NO_SHOW',				'Dont\'t show');

    // -- Toolbar ------------------------------------------------------------------
    define('_JOOMAP_TOOLBAR_SAVE', 			'Save');
    define('_JOOMAP_TOOLBAR_CANCEL', 		'Cancel');

    // -- Errors -------------------------------------------------------------------
    define('_JOOMAP_ERR_NO_LANG',			'Language file [ %s ] not found, loaded default language: english<br />');
    define('_JOOMAP_ERR_CONF_SAVE',         'ERROR: Failed to save the configuration.');
    define('_JOOMAP_ERR_NO_CREATE',         'ERROR: Not able to create Settings table');
    define('_JOOMAP_ERR_NO_DEFAULT_SET',    'ERROR: Not able to insert default Settings');
    define('_JOOMAP_ERR_NO_PREV_BU',        'WARNING: Not able to drop previous backup');
    define('_JOOMAP_ERR_NO_BACKUP',         'ERROR: Not able to create backup');
    define('_JOOMAP_ERR_NO_DROP_DB',        'ERROR: Not able to drop Settings table');
    define('_JOOMAP_ERR_NO_SETTINGS',		'ERROR: Unable to load Settings from Database: <a href="%s">Create Settings table</a>');

    // -- Config -------------------------------------------------------------------
    define('_JOOMAP_MSG_SET_RESTORED',      'Settings restored');
    define('_JOOMAP_MSG_SET_BACKEDUP',      'Settings saved');
    define('_JOOMAP_MSG_SET_DB_CREATED',    'Settings table created');
    define('_JOOMAP_MSG_SET_DEF_INSERT',    'Default Settings inserted');
    define('_JOOMAP_MSG_SET_DB_DROPPED',    'Settings table dropped');
	
    // -- CSS ----------------------------------------------------------------------
    define('_JOOMAP_CSS',					'JooMap CSS');
    define('_JOOMAP_CSS_EDIT',				'Edit template'); // Edit template
	
    // -- Sitemap (Frontend) -------------------------------------------------------
    define('_JOOMAP_SHOW_AS_EXTERN_ALT',	'Link opens new window');
}
?>
