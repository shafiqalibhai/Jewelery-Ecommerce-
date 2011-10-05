<?php
defined('_JEXEC') or die('Direct Access to this location is not allowed.');

/**
 * The Configuration-Tab for selecting and ordering the menus in the sitemap.
 * @author Daniel Grothe
 * @version $Id: config_menus.php 12 2008-08-17 20:51:27Z koders.de $ 
 */
?>
<div id="page-menus">
	<fieldset class="adminForm">
		<legend><?php echo _JOOMAP_CFG_SET_ORDER; ?>:</legend>

		<table class="adminlist" cellspacing="1">
			<thead>
			<tr>
				<th class="key" width="1%">&nbsp;#</th>
				<th class="key" width="1%" style="display:none"> Select </th>
				<th class="key" width="1%"><?php echo _JOOMAP_CFG_MENU_SHOW; ?></th>
				<th class="key" width="1%"><?php echo _JOOMAP_CFG_MENU_REORDER; ?></th>
				<th class="key" width="1%"><?php echo _JOOMAP_CFG_MENU_ORDER; ?></th>
				<th class="title key" width="95%"><?php echo _JOOMAP_CFG_MENU_NAME; ?></th>
			</tr>
			</thead>
			<tbody>
			<?php
			/** Print list of the Joomla menus */
			if ( isset($pageNav->limitstart) ) {							// Obey nav start
				$start = $pageNav->limitstart;
			} else {
				$start = 0;
			}
			$limit = count($menus) - $start;
			if ( isset($pageNav->limit) && $limit > $pageNav->limit) {		// Obey nav limit
				$limit = $pageNav->limit;
			}
		
			$alternate = 0;
			$keys = array_keys( $menus );                               	// associative array offsets
		
			for ($i = $start; $i < $start+$limit; ++$i):
				$menu = $menus[ $keys[$i] ];                            	// get array element at offset i
				$menu->checked_out = 0;                                 	// get the selection boxes needed for move up/down
				$checked = JHTML::_('grid.checkedout', $menu, $i );
				if ( $menu->show ) {                                    	// Menu is included in sitemap
					$img = 'tick.png';
					$alt = _JOOMAP_SHOW;
					$title = _JOOMAP_CFG_DISABLE;
				} else {                                                	// Menu not included in sitemap
					$img = 'publish_x.png';
					$alt = _JOOMAP_NO_SHOW;
					$title = _JOOMAP_CFG_ENABLE;
				}
				// START: row output
			?>
			<tr class="row<?php echo $alternate; ?>">
				<td align="right" class="key">
					<?php echo $pageNav->getRowOffset( $i ); ?>
				</td>
				<td style="display:none">
					<?php echo $checked; ?>
				</td>
				<td align="center">
					<a href="javascript: void(0);" onClick="return listItemTask('cb<?php echo $i;?>','<?php echo $menu->show ? 'unpublish' : 'publish';?>')">
					<img src="images/<?php echo $img;?>" width="12" height="12" border="0" alt="<?php echo $alt; ?>" title="<?php echo $title; ?>"/>
					</a>
				</td>
				<td align="center">
					<?php echo $pageNav->orderUpIcon($i, true); ?> 
					<?php echo $pageNav->orderDownIcon($i, $limit, true); ?> 
				</td>
				<td align="center">
					<input type="text" name="order[<?php echo $menu->id; ?>]" size="5" value="<?php echo $menu->ordering; ?>" class="text_area" style="text-align:center" />
				</td>
				<td align="left">
					<?php echo $menu->type; ?> 
				</td>
			</tr>
			<?php
				// END: row output
				$alternate = 1 - $alternate;
			endfor;
			?>
			</tbody>
			<tfoot>
				<tr>
					<td colspan="6">
						<?php echo $pageNav->getListFooter(); ?> 
					</td>
				</tr>
			</tfoot>
		</table>
		
		<div style="text-align: center;">
			
		</div>
	</fieldset>
</div>
