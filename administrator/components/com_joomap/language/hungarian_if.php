<?php defined( '_JEXEC' ) or die( 'Direct Access to this location is not allowed.' ); ?>
<?php
/* @package joomap
 * @author: Jozsef Tamas Herczeg, http://www.soft-trans.hu/
 */

if( !defined( 'JOOMAP_LANG' )) {
    define ('JOOMAP_LANG', 1 );
    // -- General ------------------------------------------------------------------
    define("_JOOMAP_CFG_COM_TITLE", "Joomap be�ll�t�sai");
    define("_JOOMAP_CFG_OPTIONS", "Megjelen�t�s be�ll�t�sai");
    define("_JOOMAP_CFG_TITLE", "N�v");
    define("_JOOMAP_CFG_CSS_CLASSNAME", "CSS oszt�lyn�v");
    define("_JOOMAP_CFG_EXPAND_CATEGORIES","A tartalomkateg�ri�k kibont�sa");
    define("_JOOMAP_CFG_EXPAND_SECTIONS","A tartalomszekci�k kibont�sa");
    define("_JOOMAP_CFG_SHOW_MENU_TITLES", "A men�pontok megjelen�t�se");
    define("_JOOMAP_CFG_NUMBER_COLUMNS", "Az oszlopok sz�ma");
    define('_JOOMAP_EX_LINK', 'A k�ls� hivatkoz�sok megjel�l�se');
    define('_JOOMAP_CFG_CLICK_HERE', 'Kattints ide');
    define('_JOOMAP_CFG_GOOGLE_MAP',		'Google Sitemap');
    define('_JOOMAP_EXCLUDE_MENU',			'Men�azonos�t�k kiz�r�sa');
    define('_JOOMAP_TAB_DISPLAY',			'Megjelen�t�s');
    define('_JOOMAP_TAB_MENUS',				'Men�k');
    define('_JOOMAP_CFG_WRITEABLE',			'�rhat�');
    define('_JOOMAP_CFG_UNWRITEABLE',		'�r�sv�dett');
    define('_JOOMAP_MSG_MAKE_UNWRITEABLE',	'Ment�s ut�n megjel�l�s [ <span style="color: red;">�r�sv�dettk�nt</span> ]');
    define('_JOOMAP_MSG_OVERRIDE_WRITE_PROTECTION', 'Az �r�sv�detts�g hat�lytalan�t�sa ment�skor');
    define('_JOOMAP_GOOGLE_LINK',			'Google hivatkoz�s');

    // -- Tips ---------------------------------------------------------------------
    define('_JOOMAP_EXCLUDE_MENU_TIP',		'Add meg a helyt�rk�pb�l kihagyand� men�azonos�t�kat.<br /><strong>MEGJEGYZ�S</strong><br />V�laszd el vessz�vel az azoos�t�kat!');
    define('_JOOMAP_CFG_GOOGLE_MAP_TIP',	'A GoogleSiteMap sz�m�ra gener�lt XML f�jl');
    define('_JOOMAP_GOOGLE_LINK_TIP',		'M�sold ki a hivatkoz�st �s k�ldd be a GoogleSiteMap-nek');

    // -- Menus --------------------------------------------------------------------
    define("_JOOMAP_CFG_SET_ORDER", "Hat�rozd meg a men�k megjelen�t�s�nek sorrendj�t");
    define("_JOOMAP_CFG_MENU_SHOW", "L�tszik");
    define("_JOOMAP_CFG_MENU_REORDER", "�trendez�s");
    define("_JOOMAP_CFG_MENU_ORDER", "Sorrend");
    define("_JOOMAP_CFG_MENU_NAME", "Men�n�v");
    define("_JOOMAP_CFG_DISABLE", "Kattints r� a letilt�shoz");
    define("_JOOMAP_CFG_ENABLE", "Kattints r� az enged�lyez�shez");
    define('_JOOMAP_SHOW','L�tszik');
    define('_JOOMAP_NO_SHOW','Nem l�tszik');

    // -- Toolbar ------------------------------------------------------------------
    define("_JOOMAP_TOOLBAR_SAVE", "Ment�s");
    define("_JOOMAP_TOOLBAR_CANCEL", "M�gse");

    // -- Errors -------------------------------------------------------------------
    define('_JOOMAP_ERR_NO_LANG','Nem tal�lhat� ilyen nyelv [ %s ], bet�lt�sre ker�lt az alap�rtelmezett nyelv: angol<br />'); // %s = language
    define('_JOOMAP_ERR_CONF_SAVE',         '<h2>Nem siker�lt a be�ll�t�sok ment�se.</h2>');
    define('_JOOMAP_ERR_NO_CREATE',         'HIBA: Nem hozhat� l�tre a Settings t�bla');
    define('_JOOMAP_ERR_NO_DEFAULT_SET',    'HIBA: Nem sz�rhat�k be az alap�rtelmezett be�ll�t�sok');
    define('_JOOMAP_ERR_NO_PREV_BU',        'FIGYELEM! Nem dobhat� el az el�z� biztons�gi ment�s');
    define('_JOOMAP_ERR_NO_BACKUP',         'HIBA: Nem hozhat� l�tre a biztons�gi ment�s');
    define('_JOOMAP_ERR_NO_DROP_DB',        'HIBA: Nem dobhat� el a Settings t�bla');

    // -- Config -------------------------------------------------------------------
    define('_JOOMAP_MSG_SET_RESTORED',      'A be�ll�t�sok vissza�ll�t�sa k�sz<br />');
    define('_JOOMAP_MSG_SET_BACKEDUP',      'A be�ll�t�sok ment�se k�sz<br />');
    define('_JOOMAP_MSG_SET_DB_CREATED',    'A Settings t�bla l�trehoz�sa k�sz<br />');
    define('_JOOMAP_MSG_SET_DEF_INSERT',    'Az alap�rtelmezett be�ll�t�sok besz�r�sa k�sz');
    define('_JOOMAP_MSG_SET_DB_DROPPED',    'A Settings t�bla eldob�sa megt�rt�nt');
	
    // -- CSS ----------------------------------------------------------------------
    define('_JOOMAP_CSS',					'JooMap CSS');
    define('_JOOMAP_CSS_EDIT',				'Sablon szerkeszt�se'); // Edit template
	
    // -- Sitemap ------------------------------------------------------------------
    define('_JOOMAP_SHOW_AS_EXTERN_ALT','�j ablakban ny�lik meg a hivatkoz�s');
    define('_JOOMAP_PREVIEW','El�n�zet');
    define('_JOOMAP_SITEMAP_NAME','Helyt�rk�p');
}
?>
