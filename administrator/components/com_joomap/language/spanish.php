<?php defined( '_JEXEC' ) or die( 'No se permite el acceso directo a esta posici�n.' ); ?>
<?php
/* @package joomap
 * @author: Daniel Grothe, http://www.ko-ca.com/
 * translated by: Andr�s Victoria Ortega
 */

if( !defined( 'JOOMAP_LANG' )) {
    define ('JOOMAP_LANG', 1 );
    // -- General ------------------------------------------------------------------
    define("_JOOMAP_CFG_COM_TITLE", "Configuraci�n de Joomap");
    define("_JOOMAP_CFG_OPTIONS", "Opciones de configuraci�n");
    define("_JOOMAP_CFG_TITLE", "T�tulo");
    define("_JOOMAP_CFG_CSS_CLASSNAME", "Nombre de la clase CSS");
    define("_JOOMAP_CFG_EXPAND_CATEGORIES","Expandir el contenido de las categor�as");
    define("_JOOMAP_CFG_EXPAND_SECTIONS","Expandir el contenido de las secciones");
    define("_JOOMAP_CFG_SHOW_MENU_TITLES", "Mostrar los t�tulos de los men�s");
    define("_JOOMAP_CFG_NUMBER_COLUMNS", "N�mero de columnas");
    define('_JOOMAP_EX_LINK', 'Marcar enlaces externos');
    define('_JOOMAP_CFG_CLICK_HERE', 'Pulse aqu�');
    define('_JOOMAP_CFG_GOOGLE_MAP',		'Google Sitemap');
    define('_JOOMAP_EXCLUDE_MENU',			'Excluir IDs del men�');
    define('_JOOMAP_TAB_DISPLAY',			'Mostrar');
    define('_JOOMAP_TAB_MENUS',				'Men�s');
    define('_JOOMAP_CFG_WRITEABLE',			'No protegido contra escritura');
    define('_JOOMAP_CFG_UNWRITEABLE',		'Protegido contra escritura');
    define('_JOOMAP_MSG_MAKE_UNWRITEABLE',	'Tras grabarlo marcarlo como [ <span style="color: red;">protegido contra escritura</span> ]');
    define('_JOOMAP_MSG_OVERRIDE_WRITE_PROTECTION', 'Anular la protecci�n contra escritura al grabar');
    define('_JOOMAP_GOOGLE_LINK',			'Googlelink');

    // -- Tips ---------------------------------------------------------------------
    define('_JOOMAP_EXCLUDE_MENU_TIP',		'Especifica los IDs del men� que no quiere incluir en el mapa del sitio.<br /><strong>NOTA</strong><br />�Separe los IDs con comas!');
    define('_JOOMAP_CFG_GOOGLE_MAP_TIP',	'Fichero XML generado para el mapa del sitio de Google');
    define('_JOOMAP_GOOGLE_LINK_TIP',		'Copie el enlace y env�elo a Google');

    // -- Menus --------------------------------------------------------------------
    define("_JOOMAP_CFG_SET_ORDER", "Seleccionar el orden en el que se muestran los men�s");
    define("_JOOMAP_CFG_MENU_SHOW", "Mostrar");
    define("_JOOMAP_CFG_MENU_REORDER", "Reordenar");
    define("_JOOMAP_CFG_MENU_ORDER", "Ordenar");
    define("_JOOMAP_CFG_MENU_NAME", "Nombre del Men�");
    define("_JOOMAP_CFG_DISABLE", "Pulse para desactivar");
    define("_JOOMAP_CFG_ENABLE", "Pulse para activar");
    define('_JOOMAP_SHOW','Mostrar');
    define('_JOOMAP_NO_SHOW','No mostrar');

    // -- Toolbar ------------------------------------------------------------------
    define("_JOOMAP_TOOLBAR_SAVE", "Guardar");
    define("_JOOMAP_TOOLBAR_CANCEL", "Cancelar");

    // -- Errors -------------------------------------------------------------------
    define('_JOOMAP_ERR_NO_LANG','No se ha encontrado el lenguaje [ %s ], se carga el lenguaje por defecto: ingl�s<br />'); // %s = language
    define('_JOOMAP_ERR_CONF_SAVE',         '<h2>Fallo al guardar la configuraci�n.</h2>');
    define('_JOOMAP_ERR_NO_CREATE',         'ERROR: No se ha podido crear la tabla de opciones');
    define('_JOOMAP_ERR_NO_DEFAULT_SET',    'ERROR: No se han podido insertar las opciones por defecto');
    define('_JOOMAP_ERR_NO_PREV_BU',        'ATENCI�N: No se ha podido borrar la copia de seguridad anterior');
    define('_JOOMAP_ERR_NO_BACKUP',         'ERROR: No se ha podido crear la copia de seguridad');
    define('_JOOMAP_ERR_NO_DROP_DB',        'ERROR: No se ha podido borrar la tabla de opciones');

    // -- Config -------------------------------------------------------------------
    define('_JOOMAP_MSG_SET_RESTORED',      'Opciones restauradas<br />');
    define('_JOOMAP_MSG_SET_BACKEDUP',      'Opciones guardadas<br />');
    define('_JOOMAP_MSG_SET_DB_CREATED',    'Tabla de opciones creada<br />');
    define('_JOOMAP_MSG_SET_DEF_INSERT',    'Opciones por defecto insertadas');
    define('_JOOMAP_MSG_SET_DB_DROPPED',    'Tabla de opciones borrada');
	
    // -- CSS ----------------------------------------------------------------------
    define('_JOOMAP_CSS',					'JooMap CSS');
    define('_JOOMAP_CSS_EDIT',				'Editar plantilla'); // Edit template
	
    // -- Sitemap ------------------------------------------------------------------
    define('_JOOMAP_SHOW_AS_EXTERN_ALT','El enlace se abre en una nueva ventana');
    define('_JOOMAP_PREVIEW','Previsualizaci�n');
    define('_JOOMAP_SITEMAP_NAME','Mapa del sitio');
}
?>
