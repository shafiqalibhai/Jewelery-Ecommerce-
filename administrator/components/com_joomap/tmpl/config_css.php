<?php
defined( '_JEXEC' ) or die( 'Direct Access to this location is not allowed.' );

/**
 * The Configuration-Tab for editing the CSS-styles.
 * @author Daniel Grothe
 * @version $Id: config_css.php 12 2008-08-17 20:51:27Z koders.de $ 
 */
$template_path = JPATH_COMPONENT_SITE.DS.'css'.DS.'joomap.css';

if ($fp = @fopen($template_path, 'r')) {
	$csscontent = @fread($fp, @filesize($template_path));
	$csscontent = htmlspecialchars($csscontent);
} else {
	echo 'Error reading template file: '.$template_path;
}
?>
<div id="page-css">
	<fieldset>
		<legend><?php echo _JOOMAP_CSS_EDIT; ?></legend>
		<table cellpadding="1">
			<tr>
				<td width="220">
					<span class="componentheading">
						<?php echo _JOOMAP_CSS; ?>:
						<?php
							echo is_writable($template_path) ?
								'<strong style="color:green;">'._JOOMAP_CFG_WRITEABLE.'</strong>' :
								'<strong style="color:red;">'._JOOMAP_CFG_UNWRITEABLE.'</strong>';
						?>
					</span>
				</td>
	
				<?php if (JPath::canChmod($template_path) && is_writable($template_path)): ?>
	
				<td>
					<input type="checkbox" id="disable_write" name="disable_write" value="1" />
					<label for="disable_write"><?php echo _JOOMAP_MSG_MAKE_UNWRITEABLE; ?></label>
				</td>
	
				<?php else: ?>
	
				<td>
					<input type="checkbox" id="enable_write" name="enable_write" value="1" />
					<label for="enable_write"><?php echo _JOOMAP_MSG_OVERRIDE_WRITE_PROTECTION; ?></label>
				</td>
	
				<?php endif; ?>
			</tr>
		</table>
		
		<table class="adminform">
			<tr>
				<th><?php echo $template_path; ?></th>
			</tr>
			<tr>
				<td>
					<textarea style="width: 100%; height: 500px" cols="80" rows="25"
					name="csscontent" class="inputbox"><?php
					echo $csscontent;
					?></textarea>
				</td>
			</tr>
		</table>
	</fieldset>
</div>
