<?php
defined('_JEXEC') or die('Direct Access to this location is not allowed.');

/**
 * The Configuration-Tab for the sitemap layout settings.
 * @author Daniel Grothe
 * @version $Id: config_display.php 12 2008-08-17 20:51:27Z koders.de $
 */
?>
<div id="page-display">
	<fieldset>
		<legend><?php echo _JOOMAP_CFG_OPTIONS; ?></legend>
		
		<table class="adminForm" cellspacing="1">
			<tr>
				<td style="width:100%">
					<table class="admintable">
						<tr>
							<td style="width:1%" class="key">
								<label for="classname"><?php echo _JOOMAP_CFG_CSS_CLASSNAME; ?></label>:
							</td>
							<td style="width:32%">
								<input type="text" name="classname" id="classname" value="<?php echo @$config->classname; ?>"/>
							</td>
							
							<td style="width:1%" class="key">
								<label for="show_menutitle"><?php echo _JOOMAP_CFG_SHOW_MENU_TITLES; ?></label>:
							</td>
							<td style="width:32%">
								<input type="checkbox" name="show_menutitle" id="show_menutitle" value="1"<?php echo @$config->show_menutitle ? ' checked="checked"' : ''; ?> />
							</td>
							
							<td class="key">
								<label for="include_link"><?php echo _JOOMAP_CFG_INCLUDE_LINK; ?></label>:
							</td>
							<td>
								<input type="checkbox" name="includelink" id="include_link" value="1"<?php echo @$config->includelink ? ' checked="checked"' : ''; ?> />
							</td>
						</tr>
							
						<tr>
							<td style="width:1%" class="key">
								<label for="columns"><?php echo _JOOMAP_CFG_NUMBER_COLUMNS; ?></label>:
							</td>
							<td style="width:32%">
								<?php echo $lists['columns']; ?>
							</td>
							
							<td class="key">
								<label for="expand_section"><?php echo _JOOMAP_CFG_EXPAND_SECTIONS; ?></label>:
							</td>
							<td>
								<input type="checkbox" name="expand_section" id="expand_section" value="1"<?php echo @$config->expand_section ? ' checked="checked"' : ''; ?> />
							</td>
							
							<td>&nbsp;</td>
							<td>&nbsp;</td>
						</tr>
						
						<?php
							// currently selected external link marker image
							if ($config->ext_image && eregi('\.(gif|jpg|jpeg|png)$', $config->ext_image)) {
								$ext_imgurl = JURI::root().'components/com_joomap/images/'.$config->ext_image;
							} else {
								$ext_imgurl = JURI::root().'components/com_joomap/images/blank.png';
							}
						?> 
						<tr>
							<td class="key">
								<label for="exlinks"><?php echo _JOOMAP_EX_LINK; ?></label>:
							</td>
							<td style="white-space:nowrap;">
								<input type="checkbox" name="exlinks" id="exlinks" value="1"<?php echo @$config->exlinks ? ' checked="checked"' : ''; ?> />
								&nbsp;
								<?php echo $lists['imageurl']; ?> 
								&nbsp;
								<img src="<?php echo $ext_imgurl; ?>" name="imagelib" alt="" />
							</td>
							
							<td class="key">
								<label for="expand_category"><?php echo _JOOMAP_CFG_EXPAND_CATEGORIES; ?></label>:
							</td>
							<td>
								<input type="checkbox" name="expand_category" id="expand_category" value="1"<?php echo @$config->expand_category ? ' checked="checked"' : ''; ?> />
							</td>
							
							<td>&nbsp;</td>
							<td>&nbsp;</td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
	</fieldset>
	
	<fieldset>
		<legend><?php echo _JOOMAP_CFG_GOOGLE_MAP; ?></legend>
		<table class="admintable">
			<?php
				$google_link = JURI::root().'index2.php?option=com_joomap&amp;view=google&amp;no_html=1';
				$popupTitle	= _JOOMAP_CFG_GOOGLE_MAP;
				$popupText	= _JOOMAP_GOOGLE_LINK_TIP;
			?> 
			<tr>
				<td class="key">
					<span class="error hasTip" title="<?php echo $popupTitle.'::'.$popupText; ?>">
						<label for="">
							<?php echo _JOOMAP_CFG_GOOGLE_MAP; ?>:
						</label>
					</span>
				</td>
				<td>
					<span id="googlelink" style="border:1px solid silver; padding:1px;">
						<a href="<?php echo $google_link; ?>" target="_blank" title="Google Sitemap Link">
							<?php echo $google_link; ?> 
						</a>
					</span>
					&nbsp;
					<span class="error hasTip" title="<?php echo $popupTitle.'::'.$popupText; ?>">
						<?php echo JoomapAdminHtml::infoIcon(); ?> 
					</span>
				</td>
			</tr>
		</table>
	</fieldset>

	<?php
		$popupTitle	= _JOOMAP_EXCLUDE_MENU;
		$popupText	= _JOOMAP_EXCLUDE_MENU_TIP;
	?>

	<fieldset>
		<legend><?php echo _JOOMAP_EXCLUDE_MENU; ?></legend>
		<table class="admintable">
		<tr>
			<td class="key">
				<span class="error hasTip" title="<?php echo $popupTitle.'::'.$popupText; ?>">
					<label for="exclmenus">
						<?php echo _JOOMAP_EXCLUDE_MENU; ?>:
					</label>
				</span>
			</td>
			<td style="white-space: nowrap">
				<input type="text" name="exclmenus" id="exclmenus" size="40" value="<?php echo $config->exclmenus; ?>" />
				&nbsp;
				<button onclick="addExclude(); return false;">&larr;</button>&nbsp;
			</td>
			<td>
				<?php echo $lists['exclmenus']; ?>
				&nbsp;
				<span class="error hasTip" title="<?php echo $popupTitle.'::'.$popupText; ?>">
					<?php echo JoomapAdminHtml::infoIcon(); ?> 
				</span>
			</td>
		</tr>
		</table>
	</fieldset>
</div>