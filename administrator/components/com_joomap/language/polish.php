<?php defined( '_JEXEC' ) or die( 'Direct Access to this location is not allowed.' ); ?>
<?php
/* @package joomap
 */

if( !defined( 'JOOMAP_LANG' )) {
    define ('JOOMAP_LANG', 1 );
    // -- General ------------------------------------------------------------------
    define("_JOOMAP_CFG_COM_TITLE", "Konfiguracja Joomap");
    define("_JOOMAP_CFG_OPTIONS", "Opcje wy�wietlania");
    define("_JOOMAP_CFG_TITLE", "Tytu�");
    define("_JOOMAP_CFG_CSS_CLASSNAME", "Nazwa klasy CSS");
    define("_JOOMAP_CFG_EXPAND_CATEGORIES","Rozwi� kategorie artyku��w");
    define("_JOOMAP_CFG_EXPAND_SECTIONS","Rozwi� sekcje artyku��w");
    define("_JOOMAP_CFG_SHOW_MENU_TITLES", "Poka� tytu�y menu");
    define("_JOOMAP_CFG_NUMBER_COLUMNS", "Ilo�� kolumn");
    define('_JOOMAP_EX_LINK', 'Oznaczenie link�w zewn�trznych');
    define('_JOOMAP_CFG_CLICK_HERE', 'Klikni tutaj');
    define('_JOOMAP_CFG_GOOGLE_MAP',		'Google Sitemap');
    define('_JOOMAP_EXCLUDE_MENU',			'ID menu wy��czonych');
    define('_JOOMAP_TAB_DISPLAY',			'Wygl�d');
    define('_JOOMAP_TAB_MENUS',				'Menu');
    define('_JOOMAP_CFG_WRITEABLE',			'Zapisywalny');
    define('_JOOMAP_CFG_UNWRITEABLE',		'Niezapisywalny');
    define('_JOOMAP_MSG_MAKE_UNWRITEABLE',	'Po zapisaniu ustaw prawa do pliku na: [ <span style="color: red;">niezapisywalny</span> ]');
    define('_JOOMAP_MSG_OVERRIDE_WRITE_PROTECTION', 'Zmie� prawa do pliku na czas zapisywania zmian.');
    define('_JOOMAP_GOOGLE_LINK',			'Link do Google');

    // -- Tips ---------------------------------------------------------------------
    define('_JOOMAP_EXCLUDE_MENU_TIP',		'Okre�l pozycje menu, kt�rych nie chcesz w��czy� do mapy serwisu.<br /><strong>UWAGA</strong><br />Oddziel ID przecinkami!');
    define('_JOOMAP_CFG_GOOGLE_MAP_TIP',	'Tworzy plik XML dla GogleSiteMap');
    define('_JOOMAP_GOOGLE_LINK_TIP',		'Skopiuj odno�nik i wy�lij do GoogleSiteMap');

    // -- Menus --------------------------------------------------------------------
    define("_JOOMAP_CFG_SET_ORDER", "Ustaw kolejno�� wy�wietlania pozycji menu");
    define("_JOOMAP_CFG_MENU_SHOW", "Poka�");
    define("_JOOMAP_CFG_MENU_REORDER", "Przestaw");
    define("_JOOMAP_CFG_MENU_ORDER", "Kolejno��");
    define("_JOOMAP_CFG_MENU_NAME", "Nazwa menu");
    define("_JOOMAP_CFG_DISABLE", "Kliknij, by WY��czy�");
    define("_JOOMAP_CFG_ENABLE", "Kliknij, by W��czy�");
    define('_JOOMAP_SHOW','Poka�');
    define('_JOOMAP_NO_SHOW','Nie pokazuj');

    // -- Toolbar ------------------------------------------------------------------
    define("_JOOMAP_TOOLBAR_SAVE", "Zapisz");
    define("_JOOMAP_TOOLBAR_CANCEL", "Anuluj");

    // -- Errors -------------------------------------------------------------------
    define('_JOOMAP_ERR_NO_LANG','Nie znaleziono j�zyka [ %s ], wczytano domy�lny j�zyk komunikat�w: angielski<br />'); // %s = language
    define('_JOOMAP_ERR_CONF_SAVE',         '<h2>Zapisanie konfiguracji nie powiod�o si�.</h2>');
    define('_JOOMAP_ERR_NO_CREATE',         'B��D: Nie mo�na utworzy� w BD tabeli z ustawieniami)');
    define('_JOOMAP_ERR_NO_DEFAULT_SET',    'B��D: Nie mo�na odczyta� domy�lnych ustawie�');
    define('_JOOMAP_ERR_NO_PREV_BU',        'Ostrze�enie: Nie mo�na usun�c poprzeniej kopii zapasowej');
    define('_JOOMAP_ERR_NO_BACKUP',         'B��D: Nie mo�na utworzy� kopii zapasowej');
    define('_JOOMAP_ERR_NO_DROP_DB',        'B��D: Nie mo�na usun�� tabeli bazy danych z ustawieniami');

    // -- Config -------------------------------------------------------------------
    define('_JOOMAP_MSG_SET_RESTORED',      'Ustawienia zosta�y przywr�cone<br />');
    define('_JOOMAP_MSG_SET_BACKEDUP',      'Ustawienia zosta�y zachowane.<br />');
    define('_JOOMAP_MSG_SET_DB_CREATED',    'Tabela konfiguracji (settings)w BD zosta�a utworzona<br />');
    define('_JOOMAP_MSG_SET_DEF_INSERT',    'Zastosowano domy�lne ustawienia');
    define('_JOOMAP_MSG_SET_DB_DROPPED',    'Tabela BD z ustawieniami zosta�a usuni�ta.');
	
    // -- CSS ----------------------------------------------------------------------
    define('_JOOMAP_CSS',					'JooMap CSS');
    define('_JOOMAP_CSS_EDIT',				'Edytuj szablon'); // Edit template
	
    // -- Sitemap ------------------------------------------------------------------
    define('_JOOMAP_SHOW_AS_EXTERN_ALT','Otwiera link w nowym oknie');
    define('_JOOMAP_PREVIEW','Podgl�d');
    define('_JOOMAP_SITEMAP_NAME','Mapa serwisu');
}
?>
