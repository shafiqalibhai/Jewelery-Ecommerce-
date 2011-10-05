<?php defined( '_JEXEC' ) or die( 'Direct Access to this location is not allowed.' ); ?>
<?php
/* @package joomap
 * @author: nartconcept, nartconcept@gmail.com, http://www.modos-groupware.info/
 */

if( !defined( 'JOOMAP_LANG' )) {
    define ('JOOMAP_LANG', 1 );
    // -- General ------------------------------------------------------------------
    define("_JOOMAP_CFG_COM_TITLE", "Pr&eacute;f&eacute;rences de Joomap");
    define("_JOOMAP_CFG_OPTIONS", "Pr&eacute;f&eacute;rences");
    define("_JOOMAP_CFG_TITLE", "Titre");
    define("_JOOMAP_CFG_CSS_CLASSNAME", "Nom de fichier CSS");
    define("_JOOMAP_CFG_EXPAND_CATEGORIES","D&eacute;velopper les cat&eacute;gories");
    define("_JOOMAP_CFG_EXPAND_SECTIONS","D&eacute;velopper les sections");
    define("_JOOMAP_CFG_SHOW_MENU_TITLES", "Afficher le(s) titres de(s) menu(s)");
    define("_JOOMAP_CFG_NUMBER_COLUMNS", "Nombre de colonnes");
    define('_JOOMAP_EX_LINK', 'Marquer les liens externes');
    define('_JOOMAP_CFG_CLICK_HERE', 'Cliquer ici');
    define('_JOOMAP_CFG_GOOGLE_MAP',		'Google Sitemap');
    define('_JOOMAP_EXCLUDE_MENU',			'Exclure lien(s) [ Menu IDs ]');
    define('_JOOMAP_TAB_DISPLAY',			'Pr&eacute;f&eacute;rences');
    define('_JOOMAP_TAB_MENUS',				'Menus');
    define('_JOOMAP_CFG_WRITEABLE',			'Modifiable');
    define('_JOOMAP_CFG_UNWRITEABLE',		'Non modifiable');
    define('_JOOMAP_MSG_MAKE_UNWRITEABLE',	'Rendre [ <span style="color: red;">non modifiable</span> ] apr&egrave;s la sauvegarde');
    define('_JOOMAP_MSG_OVERRIDE_WRITE_PROTECTION', 'Prot&eacute;ger en &eacute;criture en sauvegardant');
    define('_JOOMAP_GOOGLE_LINK',			'Lien Google');

    // -- Tips ---------------------------------------------------------------------
    define('_JOOMAP_EXCLUDE_MENU_TIP',		'S&eacute;lectionner le(s) lien(s) [ Menu IDs ] que vous ne souhaitez pas ajouter dans le Plan du site.<br /><strong>NOTE</strong><br />S&eacute;parer les liens [ IDs ] par une virgule!');
    define('_JOOMAP_CFG_GOOGLE_MAP_TIP',	'Fichier XML g&eacute;n&eacute;r&eacute; pour Google SiteMap');
    define('_JOOMAP_GOOGLE_LINK_TIP',		'Copier et Soumettre le lien &agrave; Google SiteMap');

    // -- Menus --------------------------------------------------------------------
    define("_JOOMAP_CFG_SET_ORDER", "Ordre d'affichage de(s) menu(s)");
    define("_JOOMAP_CFG_MENU_SHOW", "Afficher");
    define("_JOOMAP_CFG_MENU_REORDER", "R&eacute;organiser");
    define("_JOOMAP_CFG_MENU_ORDER", "Ordre");
    define("_JOOMAP_CFG_MENU_NAME", "Nom du menu");
    define("_JOOMAP_CFG_DISABLE", "Cliquer pour masquer");
    define("_JOOMAP_CFG_ENABLE", "Cliquer pour afficher");
    define('_JOOMAP_SHOW','Affich&eacute;');
    define('_JOOMAP_NO_SHOW','Masqu&eacute;');

    // -- Toolbar ------------------------------------------------------------------
    define("_JOOMAP_TOOLBAR_SAVE", "Sauver");
    define("_JOOMAP_TOOLBAR_CANCEL", "Quitter");

    // -- Errors -------------------------------------------------------------------
    define('_JOOMAP_ERR_NO_LANG','Aucun fichier de la langue [ %s ] n\'a pas &eacute;t&eacute; trouv&eacute;, la langue par d&eacute;faut est: anglais<br />'); // %s = language
    define('_JOOMAP_ERR_CONF_SAVE',         '<h2>Echec de sauvegarde de table de pr&eacute;f&eacute;rences.</h2>');
    define('_JOOMAP_ERR_NO_CREATE',         'ERREUR: Impossible de cr&eacute;er la table de pr&eacute;f&eacute;rences');
    define('_JOOMAP_ERR_NO_DEFAULT_SET',    'ERREUR: Impossible d\'appliquer la table de pr&eacute;f&eacute;rences par d&eacute;faut');
    define('_JOOMAP_ERR_NO_PREV_BU',        'ERREUR: Impossible de supprimer la derni&egrave;re sauvegarde');
    define('_JOOMAP_ERR_NO_BACKUP',         'ERREUR: Impossible de cr&eacute;er une sauvegarde');
    define('_JOOMAP_ERR_NO_DROP_DB',        'ERREUR: Impossible de supprimer la table de pr�f�rences');

    // -- Config -------------------------------------------------------------------
    define('_JOOMAP_MSG_SET_RESTORED',      'Table de pr&eacute;f&eacute;rences a &eacute;t&eacute; restor&eacute;e<br />');
    define('_JOOMAP_MSG_SET_BACKEDUP',      'Les pr&eacute;f&eacute;rences ont &eacute;t&eacute; sauvegard&eacute;e<br />');
    define('_JOOMAP_MSG_SET_DB_CREATED',    'Table de pr&eacute;f&eacute;rences a &eacute;t&eacute; cr&eacute;&eacute;e<br />');
    define('_JOOMAP_MSG_SET_DEF_INSERT',    'Table de pr&eacute;f&eacute;rences par d&eacute;fauta &eacute;t&eacute; inser&eacute;e');
    define('_JOOMAP_MSG_SET_DB_DROPPED',    'Table de pr&eacute;f&eacute;rences a &eacute;t&eacute; supprim&eacute;e');
	
    // -- CSS ----------------------------------------------------------------------
    define('_JOOMAP_CSS',					'JooMap CSS');
    define('_JOOMAP_CSS_EDIT',				'Editer le template [ fichier CSS ]'); // Edit template
	
    // -- Sitemap ------------------------------------------------------------------
    define('_JOOMAP_SHOW_AS_EXTERN_ALT','Ouvrire le lien dans une nouvelle fen&ecirc;tre');
    define('_JOOMAP_PREVIEW','Aper&ccedil;u');
    define('_JOOMAP_SITEMAP_NAME','Plan du site');
}
?>
