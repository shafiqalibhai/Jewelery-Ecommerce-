<?php
defined( '_JEXEC' ) or die( 'Direct Access to this location is not allowed.' );

/**
 * HTML class for all JooMap administration output
 * @author Daniel Grothe
 * @version $Id: admin.joomap.html.php 12 2008-08-17 20:51:27Z koders.de $
 */
class JoomapAdminHtml {
	

	/**
	 * Show the configuration options.
	 *
	 * @param JoomapConfig $config
	 * @param array $menus
	 * @param JPagination $pageNav
	 * @param array $lists
	 */
	function show(&$config, &$menus, &$pageNav, &$lists) {
		
		// Where the templates for all the tabs are stored 
		
		$templatePath = JPATH_COMPONENT.DS.'tmpl'.DS;
		
		// Import javascript for tooltips
		
		JHTML::_('behavior.tooltip');
		
		// Import javascript for tab-switch support
		
		JHTML::_('behavior.switcher');

		// Load the sub-menu navigation template into the document
		
		ob_start();
		require $templatePath.'navigation.php'; 
		$navigation = ob_get_contents();
		ob_end_clean();
		$document =& JFactory::getDocument();
		$document->setBuffer($navigation, 'modules', 'submenu');
		
		// Output the configuration form
?>
		<style type="text/css">
			table.admintable label { white-space: nowrap; }
			table.admintable td.key { vertical-align: middle; } 
		</style>
			
		<script type="text/javascript">
	        function menu_listItemTask( id, task, option ) {
	            var f = document.adminForm;
	            cb = eval( 'f.' + id );
	            if (cb) {
	                cb.checked = true;
	                submitbutton(task);
	            }
	            return false;
	        }
	
	        function changeDisplayImage() {
	            if (document.adminForm.imageurl.value !='') {
	                document.adminForm.imagelib.src='../components/com_joomap/images/' + document.adminForm.imageurl.value;
	            } else {
	                document.adminForm.imagelib.src='../images/blank.png';
	            }
	        }
	
			function addExclude() {
				var exclude = document.adminForm.exclmenus.value.split(',');
				exclude.push( document.adminForm.excl_menus.value );
				//remove duplicates;
				var tmp = new Object();
				for(var i = 0; i < exclude.length; i++) {
					var id = parseInt(exclude[i]);
					if( isNaN(id))
						continue;
	
					tmp[ id ] = id;
				}
				exclude = new Array();
				for(var k in tmp) {
					exclude.push( tmp[k] );
				}
				document.adminForm.exclmenus.value = exclude.join(',');
			}
		</script>

		<form action="index2.php" method="post" name="adminForm">
			<div id="config-document">
				<?php
					// import the tabs content
				
					require $templatePath.'config_menus.php';
					require $templatePath.'config_display.php';
					require $templatePath.'config_css.php';
				?>
			</div>
			
			<input type="hidden" name="option" value="com_joomap" />
			<input type="hidden" name="task" value="" />
			<input type="hidden" name="boxchecked" value="0" />
			<input type="hidden" name="hidemainmenu" value="0" />
		</form>
	<?php
	}
	
	/**
	 * Generate img link for an information icon
	 *
	 * @return string
	 */
	function infoIcon() {
		$img = '<img src="'.JURI::root().'includes/js/dtree/img/question.gif" border="0" alt="" style="vertical-align:middle" />';
		return $img;
	}
}
?>