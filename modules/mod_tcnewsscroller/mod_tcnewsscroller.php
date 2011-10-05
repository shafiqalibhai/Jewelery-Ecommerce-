<?php
	/**
	* @name 		TCNewsScroller Module for Joomla!
	* @version 		1.0.2
	* @author 		Roy I Purba and  Dani Gunawan (www.tobacamp.com)
	* @package		Joomla
	* @license		GNU/GPL
	*
	* This module displays a text scroller of your latest news (or other categories) to your Joomla! site.
	* Thanks to Dynamic Drive (www.dynamicdrives.com) for the Javascript and CSS codes used in this module.
	*
	* More templates & extensions are available at Tobacamp website, http://tobacamp.com.
	*
	* Enjoy it!
	*/
	
	/**
	 * CHANGELOG (by DaGu Sep 26, 2008)
	 *
	 * - Fix title link error
	 * - Fix sql query
	 * - Remove unnecessary HTML & CSS codes
	 * - Optimize JavaScript codes
	 * - Declare CSS using Joomla! valid declaration
	 * - Move JavaScript process business code to external file
	 *
	 * Addition:
	 * - Article limitation (customizable)
	 * - Character limitation (customizable)
	 * - Read more link (customizable)
	 * - Ordering option 
	 * - Sort type option (ascending or descending)
	 * - Scroller speed
	 * - Border type (solid, dashed, dotted)
	 * - Border color
	 * - Border thickness
	 */

	defined('_JEXEC') or die('Restricted access');
	
	$modulename = 'mod_tcnewsscroller'; 
	
	$catid = $params->get('catid', 1);
	$order = $params->get('order', 'ordering');
	$sort = $params->get('sort', 'ASC');
	$limit = $params->get('limit', 0);
	$limitchar = $params->get('limitchar', 0);
	$readmore = $params->get('readmore', '1');
	$readmoretext = $params->get('readmoretext', 'Read more...');
	
	$width = $params->get('width',200);
	$height = $params->get('height',250);
	
	$time = $params->get('time',3000);
	$speed = $params->get('speed', 75);
	
	$bgcolor = $params->get('bgcolor','#FFFFFF');
	$bordertype = $params->get('bordertype', 'solid');
	$bordercolor = $params->get('bordercolor', '#000000');
	$borderthickness = $params->get('borderthickness', '1');
	
	$db =& JFactory::getDBO();
	// build query
	$field_intro = 'introtext';
	if ($limitchar > 0) {
		$field_intro = "substr(introtext, 1, $limitchar) as introtext";
	}
	
	$limitation = '';
	if ($limit > 0 ) {
		$limitation = "LIMIT 0, $limit";
	}
	
	$query = "SELECT id, title, $field_intro FROM #__content WHERE state = '1' AND catid = '$catid' ORDER BY $order $sort $limitation"; 
	
	$db->setQuery( $query );
	$rows = $db->loadObjectList();
	
	$document =& JFactory::getDocument();
	
	$styles = '
			#tcscroller{
				width: ' . $width . 'px;
				height: ' . $height . 'px;
				border: ' . $borderthickness . 'px ' . $bordertype . ' ' . $bordercolor . ';
				padding: 5px;
				background-color: ' . $bgcolor . ';
			}';
			
	$document->addStyleDeclaration($styles);

	$js = 'modules/' . $modulename . '/js/tcscroller.js';
	$document->addScript(JURI::base() . $js);
?>
    
    <script type="text/javascript">
        var tc_speed = <?php echo $speed; ?> // speed
		var tc_time = <?php echo $time; ?> // pause time
 
        var pausecontent=new Array()

	
<?php
		$i = 0;
		foreach($rows as $row)
		{
			// replace ' to \'
			$title = str_replace("'", "\\'", $row->title);
			$introtext = str_replace("'", "\\'", $row->introtext);

			$link = JRoute::_('index.php?option=com_content&view=article&task=view&id='	. $row->id);
						
			$rmore = '';
			// add read more
			if ($readmore == 1) {
				$rmore = '<div><a href="' . $link . '">' . $readmoretext . '</a></div>';
			}
			
			
			$tctext = '<div class="contentheading"><a href="' . $link . '">' . $title .'</a></div>'
							. $introtext . $rmore ;
		
			?>
			
			pausecontent[<?php echo $i; ?>] = '<?php echo $tctext; ?>'
			//x++
		
			<?php		
			$i++;
		}
		
?>
   		new pausescroller(pausecontent, "tcscroller", tc_time, tc_speed)
	</script>
