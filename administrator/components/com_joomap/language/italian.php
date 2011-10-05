<?php defined( '_JEXEC' ) or die( 'Direct Access to this location is not allowed.' ); ?>
<?php
/* @package joomap
 * @author: luscarpa, luscarpa@webagain.net, http://www.webagain.net
 */

if( !defined( 'JOOMAP_LANG' )) {
    define ('JOOMAP_LANG', 1 );
    // -- General ------------------------------------------------------------------
    define("_JOOMAP_CFG_COM_TITLE", "Cofigurazione di Joomap");
    define("_JOOMAP_CFG_OPTIONS", "Visualizza Opzioni");
    define("_JOOMAP_CFG_TITLE", "Titolo");
    define("_JOOMAP_CFG_CSS_CLASSNAME", "CSS Classname");
    define("_JOOMAP_CFG_EXPAND_CATEGORIES","Espandi contenuto categorie");
    define("_JOOMAP_CFG_EXPAND_SECTIONS","Espandi contenuto sezioni");
    define("_JOOMAP_CFG_SHOW_MENU_TITLES", "Visualizza i titoli del menu");
    define("_JOOMAP_CFG_NUMBER_COLUMNS", "Numero di colonne");
    define('_JOOMAP_EX_LINK', 'Seleziona links esterni');
    define('_JOOMAP_CFG_CLICK_HERE', 'Click qui');
    define('_JOOMAP_CFG_GOOGLE_MAP',		'Google Sitemap');
    define('_JOOMAP_EXCLUDE_MENU',			'Escludi Menu IDs');
    define('_JOOMAP_TAB_DISPLAY',			'Visualizza');
    define('_JOOMAP_TAB_MENUS',				'Menu');
    define('_JOOMAP_CFG_WRITEABLE',			'Scrivibile');
    define('_JOOMAP_CFG_UNWRITEABLE',		'Non Scrivibile');
    define('_JOOMAP_MSG_MAKE_UNWRITEABLE',	'Dopo il salvataggio imposta come [ <span style="color: red;">non scrivibile</span> ]');
    define('_JOOMAP_MSG_OVERRIDE_WRITE_PROTECTION', 'Override write protection when saving');
    define('_JOOMAP_GOOGLE_LINK',			'Googlelink');

    // -- Tips ---------------------------------------------------------------------
    define('_JOOMAP_EXCLUDE_MENU_TIP',		'Specifica gli IDs dei menu che non vuoi includere nel sitemap.<br /><strong>NOTA</strong><br />Separa gli IDs con la virgola!');
    define('_JOOMAP_CFG_GOOGLE_MAP_TIP',	'File XML generato per GoogleSiteMap');
    define('_JOOMAP_GOOGLE_LINK_TIP',		'Copia il link e inseriscilo in GoogleSiteMap');

    // -- Menus --------------------------------------------------------------------
    define("_JOOMAP_CFG_SET_ORDER", "Modifica l'ordine del menu");
    define("_JOOMAP_CFG_MENU_SHOW", "Visualizza");
    define("_JOOMAP_CFG_MENU_REORDER", "Riordina");
    define("_JOOMAP_CFG_MENU_ORDER", "Ordina");
    define("_JOOMAP_CFG_MENU_NAME", "Nome Menu");
    define("_JOOMAP_CFG_DISABLE", "Click per disabilitare");
    define("_JOOMAP_CFG_ENABLE", "Click per abilitare");
    define('_JOOMAP_SHOW','Visualizza');
    define('_JOOMAP_NO_SHOW','Non visualizzare');

    // -- Toolbar ------------------------------------------------------------------
    define("_JOOMAP_TOOLBAR_SAVE", "Salva");
    define("_JOOMAP_TOOLBAR_CANCEL", "Cancella");

    // -- Errors -------------------------------------------------------------------
    define('_JOOMAP_ERR_NO_LANG','Nessun file di linguaggio [ %s ] trovato, � stato caricato quello di default: english<br />'); // %s = language
    define('_JOOMAP_ERR_CONF_SAVE',         '<h2>Salvataggio configurazione fallito.</h2>');
    define('_JOOMAP_ERR_NO_CREATE',         'ERRORE: Impossibile creare le tabelle di configurazione');
    define('_JOOMAP_ERR_NO_DEFAULT_SET',    'ERRORE: Impossibile inserire le configurazioni di default');
    define('_JOOMAP_ERR_NO_PREV_BU',        'WARNING: Impossibile cancellare backup precedenti');
    define('_JOOMAP_ERR_NO_BACKUP',         'ERRORE: Impossibile creare un backup');
    define('_JOOMAP_ERR_NO_DROP_DB',        'ERRORE: Impossibile cancellare le tabelle di configurazione');

    // -- Config -------------------------------------------------------------------
    define('_JOOMAP_MSG_SET_RESTORED',      'Configurazione ristabilite<br />');
    define('_JOOMAP_MSG_SET_BACKEDUP',      'Configurazioni salvata<br />');
    define('_JOOMAP_MSG_SET_DB_CREATED',    'Tabelle di configurazioni create<br />');
    define('_JOOMAP_MSG_SET_DEF_INSERT',    'Configurazioni di Default inserite');
    define('_JOOMAP_MSG_SET_DB_DROPPED',    'Tabelle di configurazione cancellate');
	
    // -- CSS ----------------------------------------------------------------------
    define('_JOOMAP_CSS',					'JooMap CSS');
    define('_JOOMAP_CSS_EDIT',				'Modifica template'); // Edit template
	
    // -- Sitemap ------------------------------------------------------------------
    define('_JOOMAP_SHOW_AS_EXTERN_ALT','Apri il link in una nuova finestra');
    define('_JOOMAP_PREVIEW','Anteprima');
    define('_JOOMAP_SITEMAP_NAME','Sitemap');
}
?>
