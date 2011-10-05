<?php defined( '_JEXEC' ) or die( '������ ������ �� �� ������� �����������.' ); ?>
<?php
/* @package joomap
 */

if( !defined( 'JOOMAP_LANG' )) {
    define ('JOOMAP_LANG', 1 );
    // -- General ------------------------------------------------------------------
    define("_JOOMAP_CFG_COM_TITLE", "���������� Joomap");
    define("_JOOMAP_CFG_OPTIONS", "������������ �����������");
    define("_JOOMAP_CFG_TITLE", "���������");
    define("_JOOMAP_CFG_CSS_CLASSNAME", "��'� ����� CSS");
    define("_JOOMAP_CFG_EXPAND_CATEGORIES","�������� �������");
    define("_JOOMAP_CFG_EXPAND_SECTIONS","�������� ����");
    define("_JOOMAP_CFG_SHOW_MENU_TITLES", "�������� ��������� ����");
    define("_JOOMAP_CFG_NUMBER_COLUMNS", "ʳ������ �������");
    define('_JOOMAP_EX_LINK', '��������� ������ ���������');
    define('_JOOMAP_CFG_CLICK_HERE', '�������� ����');
    define('_JOOMAP_CFG_GOOGLE_MAP',		'Google Sitemap');
    define('_JOOMAP_EXCLUDE_MENU',			'��������� ������������� ����');
    define('_JOOMAP_TAB_DISPLAY',			'������');
    define('_JOOMAP_TAB_MENUS',				'����');
    define('_JOOMAP_CFG_WRITEABLE',			'����� ����������');
    define('_JOOMAP_CFG_UNWRITEABLE',		'ҳ���� ��� �������');
    define('_JOOMAP_MSG_MAKE_UNWRITEABLE',	'ϳ��� ���������� ������� <span style="color: red;">"����� ��� �������"</span>');
    define('_JOOMAP_MSG_OVERRIDE_WRITE_PROTECTION', '����� �������� <span style="color: red;">"����� ��� �������"</span> ��� ���������');
    define('_JOOMAP_GOOGLE_LINK',			'Googlelink');

    // -- Tips ---------------------------------------------------------------------
    define('_JOOMAP_EXCLUDE_MENU_TIP',		'������ ������������� ����, �� �� �� ������ �������� � ����� �����.<br /><strong>�������</strong><br />��������� ������������� ����� ����!');
    define('_JOOMAP_CFG_GOOGLE_MAP_TIP',	'�������� XML-���� ��� GoogleSiteMap');
    define('_JOOMAP_GOOGLE_LINK_TIP',		'�������� �������� �� ����������� �� GoogleSiteMap');

    // -- Menus --------------------------------------------------------------------
    define("_JOOMAP_CFG_SET_ORDER", "���������� ������� ����������� ����");
    define("_JOOMAP_CFG_MENU_SHOW", "��������");
    define("_JOOMAP_CFG_MENU_REORDER", "������");
    define("_JOOMAP_CFG_MENU_ORDER", "�������");
    define("_JOOMAP_CFG_MENU_NAME", "��'� ����");
    define("_JOOMAP_CFG_DISABLE", "����������");
    define("_JOOMAP_CFG_ENABLE", "���������");
    define('_JOOMAP_SHOW','��������');
    define('_JOOMAP_NO_SHOW','�� ����������');

    // -- Toolbar ------------------------------------------------------------------
    define("_JOOMAP_TOOLBAR_SAVE", "��������");
    define("_JOOMAP_TOOLBAR_CANCEL", "³������");

    // -- Errors -------------------------------------------------------------------
    define('_JOOMAP_ERR_NO_LANG','³������ [ %s ] ����, ����������� ���� �� ����������: ���������<br />'); // %s = language
    define('_JOOMAP_ERR_CONF_SAVE',         '<h2>�� ������� �������� ����������.</h2>');
    define('_JOOMAP_ERR_NO_CREATE',         '�������: ��������� �������� ������� �����������');
    define('_JOOMAP_ERR_NO_DEFAULT_SET',    '�������: ��������� ���������� ������������ �� ����������');
    define('_JOOMAP_ERR_NO_PREV_BU',        '�����: ��������� ������� ��������� �������� ����');
    define('_JOOMAP_ERR_NO_BACKUP',         '�������: ��������� �������� �������� ����');
    define('_JOOMAP_ERR_NO_DROP_DB',        '�������: ��������� ������� ������� �����������');

    // -- Config -------------------------------------------------------------------
    define('_JOOMAP_MSG_SET_RESTORED',      '������������ ���������<br />');
    define('_JOOMAP_MSG_SET_BACKEDUP',      '������������ ��������<br />');
    define('_JOOMAP_MSG_SET_DB_CREATED',    '�������� ������� �����������<br />');
    define('_JOOMAP_MSG_SET_DEF_INSERT',    '���������� ������������ �� ����������');
    define('_JOOMAP_MSG_SET_DB_DROPPED',    '������� ����������� ������ �������');
	
    // -- CSS ----------------------------------------------------------------------
    define('_JOOMAP_CSS',					'JooMap CSS');
    define('_JOOMAP_CSS_EDIT',				'���������� ������'); // Edit template
	
    // -- Sitemap ------------------------------------------------------------------
    define('_JOOMAP_SHOW_AS_EXTERN_ALT','ó������� ��������� � ������ ���');
    define('_JOOMAP_PREVIEW','��������� ��������');
    define('_JOOMAP_SITEMAP_NAME','Sitemap');
}
?>
