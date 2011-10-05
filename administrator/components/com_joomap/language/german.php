<?php defined( '_JEXEC' ) or die( 'Direct Access to this location is not allowed.' ); ?>
<?php
/* @package joomap
 * @author: mic, http://www.mgfi.info/
 */

if( !defined( 'JOOMAP_LANG' )) {
    define('JOOMAP_LANG', 1 );
    // -- General ------------------------------------------------------------------
    define('_JOOMAP_CFG_COM_TITLE',         'Joomap Konfiguration');
    define('_JOOMAP_CFG_OPTIONS',           'Anzeige Einstellungen');
    define('_JOOMAP_CFG_CSS_CLASSNAME',     'CSS Klassenname');
    define('_JOOMAP_CFG_EXPAND_CATEGORIES', 'Kategorien ausklappen');
    define('_JOOMAP_CFG_EXPAND_SECTIONS',   'Bereiche ausklappen');
    define('_JOOMAP_CFG_SHOW_MENU_TITLES',  'Men&uuml; Titel anzeigen');
    define('_JOOMAP_CFG_NUMBER_COLUMNS',    'Anzahl der Spalten');
    define('_JOOMAP_EX_LINK',               'Externe Links markieren');
    define('_JOOMAP_CFG_CLICK_HERE',        'Hier klicken');
    define('_JOOMAP_CFG_GOOGLE_MAP',		'Google Sitemap');
    define('_JOOMAP_EXCLUDE_MENU',			'Nicht anzeigen');
    define('_JOOMAP_TAB_DISPLAY',			'Ansicht');
    define('_JOOMAP_TAB_MENUS',				'Men&uuml;s');
    define('_JOOMAP_CFG_WRITEABLE',			'Beschreibbar');
    define('_JOOMAP_CFG_UNWRITEABLE',		'Nicht Beschreibbar');
    define('_JOOMAP_MSG_MAKE_UNWRITEABLE',	'Nach dem Speichern als [ <span style="color: red;">Nicht beschreibbar</span> ] markieren');
    define('_JOOMAP_MSG_OVERRIDE_WRITE_PROTECTION', 'Zum Speichern Schreibschutz ausser Kraft setzen');
    define('_JOOMAP_GOOGLE_LINK',			'Googlelink');
    define('_JOOMAP_CFG_INCLUDE_LINK',		'Unsichtbarer Link zum Autor');

    // -- Tips ---------------------------------------------------------------------
    define('_JOOMAP_EXCLUDE_MENU_TIP',		'Men&uuml;IDs (laut nebenstehender Liste) der nicht anzuzeigenden Men&uuml;s angeben.<br /><strong>HINWEIS</strong>: Die IDs sind mit Beistrich zu trennen!');
    define('_JOOMAP_CFG_GOOGLE_MAP_TIP',	'Link &ouml;ffnet neues Fenster und zeigt die f&uuml;r GoogleSiteMap generierten Links');
    define('_JOOMAP_GOOGLE_LINK_TIP',		'Link kopieren und im GoogleSiteMaps-Konto angeben');

    // -- Menus --------------------------------------------------------------------
    define('_JOOMAP_CFG_SET_ORDER',         'Reihenfolge Men&uuml;anzeige');
    define('_JOOMAP_CFG_MENU_SHOW',         'Anzeigen');
    define('_JOOMAP_CFG_MENU_REORDER',      'Umordnen');
    define('_JOOMAP_CFG_MENU_ORDER',        'Reihenfolge');
    define('_JOOMAP_CFG_MENU_NAME',         'Men&uuml;name');
    define('_JOOMAP_CFG_DISABLE',           'Ausschalten');
    define('_JOOMAP_CFG_ENABLE',            'Einschalten');
    define('_JOOMAP_SHOW',                  'Anzeigen');
    define('_JOOMAP_NO_SHOW',               'Nicht anzeigen');

    // -- Toolbar ------------------------------------------------------------------
    define('_JOOMAP_TOOLBAR_SAVE',          'Speichern');
    define('_JOOMAP_TOOLBAR_CANCEL',        'Abbrechen');

    // -- Errors -------------------------------------------------------------------
    define('_JOOMAP_ERR_NO_LANG',           'Sprachendatei [ %s ] nicht gefunden, verwende stattdessen Englisch<br />');// %s = language
    define('_JOOMAP_ERR_CONF_SAVE',         '<h2>Fehler beim Speichern der Konfiguration!</h2>');
    define('_JOOMAP_ERR_NO_CREATE',         'FEHLER: Konnte Konfigurationstabelle nicht erstellen!');
    define('_JOOMAP_ERR_NO_DEFAULT_SET',    'FEHLER: Konnte Standardkonfigurationswerte nicht erstellen!');
    define('_JOOMAP_ERR_NO_PREV_BU',        'HINWEIS: Konnte alte Sicherungsdatei nicht l&ouml;schen!');
    define('_JOOMAP_ERR_NO_BACKUP',         'FEHLER: Konnte keine Sicherung erstellen!');
    define('_JOOMAP_ERR_NO_DROP_DB',        'FEHLER: Konnte Konfigurationsdaten nicht l&ouml;schen!');
    define('_JOOMAP_ERR_NO_SETTINGS',		'FEHLER: Konnte Einstellungen nicht laden: <a href="%s">Konfigurationstabelle jetzt erstellen</a>');

    // -- Config -------------------------------------------------------------------
    define('_JOOMAP_MSG_SET_RESTORED',      'Einstellungen wiederhergestellt');
    define('_JOOMAP_MSG_SET_BACKEDUP',      'Einstellungen gesichert');
    define('_JOOMAP_MSG_SET_DB_CREATED',    'Konfigurationsdatei erstellt');
    define('_JOOMAP_MSG_SET_DEF_INSERT',    'Standardwerte in Konfig eingetragen');
    define('_JOOMAP_MSG_SET_DB_DROPPED',    'Konfigurationsdatei gel&ouml;scht');

    // -- CSS ----------------------------------------------------------------------
    define('_JOOMAP_CSS',					'JooMap CSS');
    define('_JOOMAP_CSS_EDIT',				'Vorlage bearbeiten'); // Edit template

    // -- Sitemap (Frontend) -------------------------------------------------------
    define('_JOOMAP_SHOW_AS_EXTERN_ALT',    'Link &ouml;ffnet neues Fenster');
}
?>
