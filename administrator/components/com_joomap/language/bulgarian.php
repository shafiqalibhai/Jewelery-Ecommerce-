<?php defined( '_JEXEC' ) or die( 'Direct Access to this location is not allowed.' ); ?>
<?php
/* @package joomap
 * @author: Daniel Grothe, http://www.ko-ca.com/
 */

if( !defined( 'JOOMAP_LANG' )) {
    define ('JOOMAP_LANG', 1 );
    // -- General ------------------------------------------------------------------
    define("_JOOMAP_CFG_COM_TITLE", "Joomap �������������");
    define("_JOOMAP_CFG_OPTIONS", "������ ���");
    define("_JOOMAP_CFG_TITLE", "��������");
    define("_JOOMAP_CFG_CSS_CLASSNAME", "��� �� CSS-����");
    define("_JOOMAP_CFG_EXPAND_CATEGORIES","������� ����������� �� ������������");
    define("_JOOMAP_CFG_EXPAND_SECTIONS","������� �������� �� ������������");
    define("_JOOMAP_CFG_SHOW_MENU_TITLES", "������ ���������� � ������");
    define("_JOOMAP_CFG_NUMBER_COLUMNS", "���� ������");
    define('_JOOMAP_EX_LINK', '�������� ���������� ������');
    define('_JOOMAP_CFG_CLICK_HERE', '������ ���');
    define('_JOOMAP_CFG_GOOGLE_MAP',		'Google ����� �� �����');
    define('_JOOMAP_EXCLUDE_MENU',			'�� �������� ID �� ������');
    define('_JOOMAP_TAB_DISPLAY',			'������');
    define('_JOOMAP_TAB_MENUS',				'������');
    define('_JOOMAP_CFG_WRITEABLE',			'����� ��������');
    define('_JOOMAP_CFG_UNWRITEABLE',		'����� ��������');
    define('_JOOMAP_MSG_MAKE_UNWRITEABLE',	'���� ����� �������� ���� [ <span style="color: red;">��������</span> ]');
    define('_JOOMAP_MSG_OVERRIDE_WRITE_PROTECTION', '��� ����� ����������� ��������� �� ���������');
    define('_JOOMAP_GOOGLE_LINK',			'Google-������');

    // -- Tips ---------------------------------------------------------------------
    define('_JOOMAP_EXCLUDE_MENU_TIP',		'�������� ID �� ��������, ����� �� �� ����� �������� � ������� �� �����.<br /><strong>NOTE</strong><br />������� ���������� ID ��� �������!');
    define('_JOOMAP_CFG_GOOGLE_MAP_TIP',	'XML-���� ��������� �� GoogleSiteMap');
    define('_JOOMAP_GOOGLE_LINK_TIP',		'������� �������� � � ������� �� GoogleSiteMap');

    // -- Menus --------------------------------------------------------------------
    define("_JOOMAP_CFG_SET_ORDER", "��������� �� ���� �� ��������� �� ��������");
    define("_JOOMAP_CFG_MENU_SHOW", "������");
    define("_JOOMAP_CFG_MENU_REORDER", "������������");
    define("_JOOMAP_CFG_MENU_ORDER", "��������");
    define("_JOOMAP_CFG_MENU_NAME", "��� �� ������");
    define("_JOOMAP_CFG_DISABLE", "������ �� �� �� ��������");
    define("_JOOMAP_CFG_ENABLE", "������ �� �� �� �������");
    define('_JOOMAP_SHOW','������');
    define('_JOOMAP_NO_SHOW','�� ��������');

    // -- Toolbar ------------------------------------------------------------------
    define("_JOOMAP_TOOLBAR_SAVE", "������");
    define("_JOOMAP_TOOLBAR_CANCEL", "�����");

    // -- Errors -------------------------------------------------------------------
    define('_JOOMAP_ERR_NO_LANG','No such language [ %s ] found, loaded default language: english<br />');
    define('_JOOMAP_ERR_CONF_SAVE',         '<h2>Failed to save the configuration.</h2>');
    define('_JOOMAP_ERR_NO_CREATE',         'ERROR: Not able to create Settings table');
    define('_JOOMAP_ERR_NO_DEFAULT_SET',    'ERROR: Not able to insert default Settings');
    define('_JOOMAP_ERR_NO_PREV_BU',        'WARNING: Not able to drop previous backup');
    define('_JOOMAP_ERR_NO_BACKUP',         'ERROR: Not able to create backup');
    define('_JOOMAP_ERR_NO_DROP_DB',        'ERROR: Not able to drop Settings table');

    // -- Config -------------------------------------------------------------------
    define('_JOOMAP_MSG_SET_RESTORED',      'Settings restored<br />');
    define('_JOOMAP_MSG_SET_BACKEDUP',      'Settings saved<br />');
    define('_JOOMAP_MSG_SET_DB_CREATED',    'Settings table created<br />');
    define('_JOOMAP_MSG_SET_DEF_INSERT',    'Default Settings inserted');
    define('_JOOMAP_MSG_SET_DB_DROPPED',    'Settings table dropped');
	
    // -- CSS ----------------------------------------------------------------------
    define('_JOOMAP_CSS',					'JooMap CSS');
    define('_JOOMAP_CSS_EDIT',				'�������� ������'); // Edit template
	
    // -- Sitemap ------------------------------------------------------------------
    define('_JOOMAP_SHOW_AS_EXTERN_ALT','������ �� � ��� ��������');
    define('_JOOMAP_PREVIEW','�������');
    define('_JOOMAP_SITEMAP_NAME','����� �� �����');
}
?>
