<?php
/**
* @version 1.2.0
* @package RSform!Pro 1.2.0
* @copyright (C) 2007-2009 www.rsjoomla.com
* @license Commercial License, http://www.rsjoomla.com/terms-and-conditions.html
*/

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );


DEFINE('_RSFORM_PLUGIN_MIGRATION',1);
DEFINE('_RSFORM_PLUGIN_MIGRATION_TITLE','Migrate forms from RSform!');
DEFINE('_RSFORM_PLUGIN_MIGRATION_DESC','The Migration tool moves the forms you created from RSform! to RSform!Pro. This plugin will not overwrite the forms you already have in RSform!Pro. Please note.. the scripts from RSform! will not be migrated since it is not compatible with RSform!Pro.');
DEFINE('_RSFORM_PLUGIN_MIGRATION_BUTTON','Migrate forms');

function RSmigrationWritePluginInfo()
{
	$RSadapter=$GLOBALS['RSadapter'];
	?>
	<tr>
		<td valign="top"><input type="button" name="plugin" value="Remove" id="plg_migration" onclick="if(confirm('<?php echo _RSFORM_BACKEND_PLUGINS_REMOVE_CONFIRM;?>')) document.location='<?php echo _RSFORM_BACKEND_SCRIPT_PATH.'?option=com_rsform&task=plugins.remove&plugin=migration';?>';"></td>
		<td valign="top">
			<strong><label for="plg_mappings"><?php echo _RSFORM_PLUGIN_MIGRATION_TITLE;?></label></strong><br/>
			<?php echo _RSFORM_PLUGIN_MIGRATION_DESC;?>
		</td>
		<td valign="top" width="50%"><input type="button" name="migrate" value="<?php echo _RSFORM_PLUGIN_MIGRATION_BUTTON;?>" onclick="document.location='<?php echo _RSFORM_BACKEND_SCRIPT_PATH;?>?option=com_rsform&task=migration.screen';"/></td>
	</tr>
	<?php
}

function RSmigrationScreen()
{
	$RSadapter = $GLOBALS['RSadapter'];
	
	//check if RSform! exists
	$tables = mysql_list_tables($RSadapter->config['db']);
	$num_tables = @mysql_numrows($tables);
	
	$i = 0;
	$exist = 0;
	while($i < $num_tables)
	{
		$tablename = mysql_tablename($tables, $i);
		if ($tablename==$RSadapter->config['dbprefix'].'forme_forms') $exist++;
		$i++;
	}
	
	
	if($exist){
		$query = mysql_query("SELECT count(*) cnt FROM ".$RSadapter->config['dbprefix']."forme_forms");
		$exist = @mysql_result($query,0);
		
	?>
	
	<table class="adminform">
	<tr>
		<th>
		<?php echo _RSFORM_BACKEND_MIGRATION_TITLE_HEAD;?>
		</th>
	</tr>
	<tr>
		<td align="left">
		<input class="button" type="button" value="<?php printf(_RSFORM_BACKEND_MIGRATION_BTN,$exist);?>" onclick="document.location='<?php echo _RSFORM_BACKEND_SCRIPT_PATH;?>?option=com_rsform&task=migration.process';"/>
		</td>
	</tr>
	<tr>
		<td align="left">
		<?php echo _RSFORM_BACKEND_MIGRATION_INSTRUCTIONS;?>
		</td>
	</tr>
	</table>
	
	<?php
	}
	else 
	{
		?>
	
	<table class="adminform">
	<tr>
		<th>
		<?php echo _RSFORM_BACKEND_MIGRATION_TITLE_NOFORM_HEAD;?>
		</th>
	</tr>
	<tr>
		<td align="left">
		<?php echo _RSFORM_BACKEND_MIGRATION_INSTRUCTIONS;?>
		</td>
	</tr>
	</table>
	
	<?php
	}
	
}

function RSparseItems($def_value)
{
	$rows = explode(",",$def_value);
	if(!empty($rows))
	{
		foreach($rows as $i=>$row)
		{
			if(stristr($row,'{checked}')){
				$checked = '[c]';
			}
			else 
			{
				$checked = '';
			}
			
			$rows[$i] = str_replace('{checked}','', addslashes($row)) . $checked;
		}
	}
	$def_value = implode("\n",$rows);
	
	return $def_value;	
}

function RSmigrationParseComponent($inputtype, $field, $componentId)
{
	$RSadapter = $GLOBALS['RSadapter'];
	$query = '';
	$query .= "('', '$componentId', 'NAME', '".$field['name']."'),";
	
	switch($inputtype)
	{
		case 1:
			$query .= "('', '$componentId', 'CAPTION', '".$field['title']."'),";
			$query .= "('', '$componentId', 'DESCRIPTION', '".$field['description']."'),";
			$query .= "('', '$componentId', 'SIZE', '20'),";
			$query .= "('', '$componentId', 'MAXSIZE', ''),";
			$query .= "('', '$componentId', 'DEFAULTVALUE', '".addslashes($field['default_value'])."'),";
			$query .= "('', '$componentId', 'ADDITIONALATTRIBUTES', '".addslashes($field['params'])."'),";
			$query .= RSmigrationParseValidation($field, $componentId);
		break;
		case 2:
			$query .= "('', '$componentId', 'CAPTION', '".$field['title']."'),";
			$query .= "('', '$componentId', 'DESCRIPTION', '".$field['description']."'),";
			$query .= "('', '$componentId', 'COLS', '50'),";
			$query .= "('', '$componentId', 'ROWS', '5'),";
			$query .= "('', '$componentId', 'DEFAULTVALUE', '".addslashes($field['default_value'])."'),";
			$query .= "('', '$componentId', 'ADDITIONALATTRIBUTES', '".addslashes($field['params'])."'),";
			$query .= RSmigrationParseValidation($field, $componentId);
		break;
		case 3:
			$query .= "('', '$componentId', 'CAPTION', '".$field['title']."'),";
			$query .= "('', '$componentId', 'DESCRIPTION', '".$field['description']."'),";
			$query .= "('', '$componentId', 'SIZE', ''),";
			$query .= "('', '$componentId', 'MULTIPLE', 'NO'),";
			$query .= "('', '$componentId', 'ITEMS', '".RSparseItems($field['default_value'])."'),";
			$query .= "('', '$componentId', 'DEFAULTVALUE', ''),";
			$query .= "('', '$componentId', 'ADDITIONALATTRIBUTES', '".addslashes($field['params'])."'),";
			$query .= RSmigrationParseValidation($field, $componentId);
		break;
		case 4:
			$query .= "('', '$componentId', 'CAPTION', '".$field['title']."'),";
			$query .= "('', '$componentId', 'DESCRIPTION', '".$field['description']."'),";
			$query .= "('', '$componentId', 'FLOW', 'HORIZONTAL'),";
			$query .= "('', '$componentId', 'ITEMS', '".RSparseItems($field['default_value'])."'),";
			$query .= "('', '$componentId', 'DEFAULTVALUE', ''),";
			$query .= "('', '$componentId', 'ADDITIONALATTRIBUTES', '".addslashes($field['params'])."'),";
			$query .= RSmigrationParseValidation($field, $componentId);
		break;
		case 5:
			$query .= "('', '$componentId', 'CAPTION', '".$field['title']."'),";
			$query .= "('', '$componentId', 'DESCRIPTION', '".$field['description']."'),";
			$query .= "('', '$componentId', 'FLOW', 'HORIZONTAL'),";
			$query .= "('', '$componentId', 'ITEMS', '".RSparseItems($field['default_value'])."'),";
			$query .= "('', '$componentId', 'DEFAULTVALUE', ''),";
			$query .= "('', '$componentId', 'ADDITIONALATTRIBUTES', '".addslashes($field['params'])."'),";
			$query .= RSmigrationParseValidation($field, $componentId);
		break;
		case 6:
			$query .= "('', '$componentId', 'CAPTION', '".$field['title']."'),";
			$query .= "('', '$componentId', 'DESCRIPTION', '".$field['description']."'),";
			$query .= "('', '$componentId', 'DATEFORMAT', 'dd.mm.yyyy'),";
			$query .= "('', '$componentId', 'CALENDARLAYOUT', 'FLAT'),";
			$query .= "('', '$componentId', 'READONLY', 'YES'),";
			$query .= "('', '$componentId', 'POPUPLABEL', '...'),";
			$query .= "('', '$componentId', 'DEFAULTVALUE', ''),";
			$query .= "('', '$componentId', 'ADDITIONALATTRIBUTES', '".addslashes($field['params'])."'),";
			$query .= RSmigrationParseValidation($field, $componentId);
		break;
		case 7:
			$query .= "('', '$componentId', 'CAPTION', '".$field['title']."'),";
			$query .= "('', '$componentId', 'DESCRIPTION', '".$field['description']."'),";
			$query .= "('', '$componentId', 'LABEL', '".addslashes($field['default_value'])."'),";
			$query .= "('', '$componentId', 'RESET', 'NO'),";
			$query .= "('', '$componentId', 'RESETLABEL', 'Reset'),";
			$query .= "('', '$componentId', 'DEFAULTVALUE', ''),";
			$query .= "('', '$componentId', 'ADDITIONALATTRIBUTES', '".addslashes($field['params'])."'),";
		break;
		case 8:
			$query .= "('', '$componentId', 'CAPTION', '".$field['title']."'),";
			$query .= "('', '$componentId', 'DESCRIPTION', '".$field['description']."'),";
			$query .= "('', '$componentId', 'LENGTH', '4'),";
			$query .= "('', '$componentId', 'BACKGROUNDCOLOR', '#FFFFFF'),";
			$query .= "('', '$componentId', 'TEXTCOLOR', '#000000'),";
			$query .= "('', '$componentId', 'TYPE', 'ALPHA'),";
			$query .= "('', '$componentId', 'FLOW', 'VERTICAL'),";
			$query .= "('', '$componentId', 'SHOWREFRESH', 'NO'),";
			$query .= "('', '$componentId', 'REFRESHTEXT', 'Refresh'),";
			$query .= "('', '$componentId', 'ADDITIONALATTRIBUTES', 'style=\"text-align:center;width:75px;\"'),";
			$query .= RSmigrationParseValidation($field, $componentId);
		break;
		case 9:
			$query .= "('', '$componentId', 'CAPTION', '".$field['title']."'),";
			$query .= "('', '$componentId', 'DESCRIPTION', '".$field['description']."'),";
			$query .= "('', '$componentId', 'FILESIZE', ''),";
			$query .= "('', '$componentId', 'ACCEPTEDFILES', ''),";
			$query .= "('', '$componentId', 'DESTINATION', ''),";
			$query .= "('', '$componentId', 'ATTACHUSEREMAIL', 'NO'),";
			$query .= "('', '$componentId', 'ATTACHADMINEMAIL', 'NO'),";
			$query .= "('', '$componentId', 'ADDITIONALATTRIBUTES', '".addslashes($field['params'])."'),";
			$query .= RSmigrationParseValidation($field, $componentId);
		break;
		case 10:
			$query .= "('', '$componentId', 'TEXT', '".addslashes($field['default_value'])."'),";
		break;
		case 11:
			$query .= "('', '$componentId', 'DEFAULTVALUE', '".addslashes($field['default_value'])."'),";
			$query .= "('', '$componentId', 'ADDITIONALATTRIBUTES', '".addslashes($field['params'])."'),";
		break;
		case 12:
			$query .= "('', '$componentId', 'CAPTION', '".$field['title']."'),";
			$query .= "('', '$componentId', 'DESCRIPTION', '".$field['description']."'),";
			$query .= "('', '$componentId', 'RESET', 'NO'),";
			$query .= "('', '$componentId', 'RESETLABEL', 'Reset'),";
			$query .= "('', '$componentId', 'IMAGERESET', ''),";
			$query .= "('', '$componentId', 'IMAGEBUTTON', '".addslashes($field['default_value'])."'),";
			$query .= "('', '$componentId', 'LABEL', 'Button'),";
			$query .= "('', '$componentId', 'ADDITIONALATTRIBUTES', '".addslashes($field['params'])."'),";
		break;
		case 13:
			$query .= "('', '$componentId', 'CAPTION', '".$field['title']."'),";
			$query .= "('', '$componentId', 'DESCRIPTION', '".$field['description']."'),";
			$query .= "('', '$componentId', 'LABEL', '".addslashes($field['default_value'])."'),";
			$query .= "('', '$componentId', 'RESET', 'NO'),";
			$query .= "('', '$componentId', 'RESETLABEL', 'Reset'),";
			$query .= "('', '$componentId', 'DEFAULTVALUE', ''),";
			$query .= "('', '$componentId', 'ADDITIONALATTRIBUTES', '".addslashes($field['params'])."'),";
		break;
		case 14:
			$query .= "('', '$componentId', 'CAPTION', '".$field['title']."'),";
			$query .= "('', '$componentId', 'DESCRIPTION', '".$field['description']."'),";
			$query .= "('', '$componentId', 'SIZE', '20'),";
			$query .= "('', '$componentId', 'MAXSIZE', ''),";
			$query .= "('', '$componentId', 'DEFAULTVALUE', ''),";
			$query .= "('', '$componentId', 'ADDITIONALATTRIBUTES', '".addslashes($field['params'])."'),";
			$query .= RSmigrationParseValidation($field, $componentId);
		break;
		case 15:
			$query .= "('', '$componentId', 'LENGTH', '".addslashes($field['default_value'])."'),";
			$query .= "('', '$componentId', 'CHARACTERS', 'ALPHANUMERIC'),";
			$query .= "('', '$componentId', 'ADDITIONALATTRIBUTES', '".addslashes($field['params'])."'),";
			$query .= RSmigrationParseValidation($field, $componentId);
		break;
			
	}
	
	$query .= "('', '$componentId', 'COMPONENTTYPE', '".$inputtype."')";
	
	return $query;
}

function RSmigrationParseValidation($field, $componentId)
{
	switch($field['validation_rule'])
	{
		case '':
			$query = "	('', '$componentId', 'VALIDATIONRULE', ''),
						('', '$componentId', 'VALIDATIONMESSAGE', '".addslashes($field['validation_message'])."'),
						('', '$componentId', 'REQUIRED', 'NO'),";
		break;
		case 'mandatory':
			$query = "	('', '$componentId', 'VALIDATIONRULE', ''),
						('', '$componentId', 'VALIDATIONMESSAGE', '".addslashes($field['validation_message'])."'),
						('', '$componentId', 'REQUIRED', 'YES'),";
		break;
		case 'email':
			$query = "	('', '$componentId', 'VALIDATIONRULE', 'email'),
						('', '$componentId', 'VALIDATIONMESSAGE', '".addslashes($field['validation_message'])."'),
						('', '$componentId', 'REQUIRED', 'YES'),";
		break;
		case 'number':
			$query = "	('', '$componentId', 'VALIDATIONRULE', 'numeric'),
						('', '$componentId', 'VALIDATIONMESSAGE', '".addslashes($field['validation_message'])."'),
						('', '$componentId', 'REQUIRED', 'YES'),";
		break;
		case 'alphanum':
			$query = "	('', '$componentId', 'VALIDATIONRULE', 'alphanumeric'),
						('', '$componentId', 'VALIDATIONMESSAGE', '".addslashes($field['validation_message'])."'),
						('', '$componentId', 'REQUIRED', 'YES'),";
		break;
		case 'alpha':
			$query = "	('', '$componentId', 'VALIDATIONRULE', 'alpha'),
						('', '$componentId', 'VALIDATIONMESSAGE', '".addslashes($field['validation_message'])."'),
						('', '$componentId', 'REQUIRED', 'YES'),";
		break;
	}	
	return $query;
}

function RSmigrationProcess()
{
	$RSadapter = $GLOBALS['RSadapter'];
	//cicle forms
	$formCount = 0;
	$query = mysql_query("SELECT * FROM ".$RSadapter->config['dbprefix']."forme_forms");
	while ($form = mysql_fetch_array($query))
	{
		$formCount ++;
		
		foreach($form as $key=>$value){
			$form[$key] = mysql_real_escape_string(stripslashes($value));
		}
				
		$formQuery = mysql_query("INSERT INTO `{$RSadapter->tbl_rsform_forms}` 
		(`FormId`, `FormName`, `FormLayout`, `FormLayoutName`, `FormLayoutAutogenerate`, `FormTitle`, `Published`, `Lang`, `ReturnUrl`, `Thankyou`, `UserEmailText`, `UserEmailTo`, `UserEmailFrom`, `UserEmailFromName`, `UserEmailSubject`, `UserEmailMode`) VALUES		
		('', '{$form['name']}', '".$formLayout."', 'inline', 0, '{$form['title']}', '{$form['published']}', '', '{$form['return_url']}', '{$form['thankyou']}', '{$form['email']}', '{$form['emailto']}', '{$form['emailfrom']}', '{$form['emailfromname']}', '{$form['emailsubject']}', '{$form['emailmode']}')") or die(mysql_error());
		
		$formId = mysql_insert_id();
		$newform = $form;
		$formLayout = '';
		$enctype = '';
		
		$fieldsQuery = mysql_query("SELECT * FROM ".$RSadapter->config['dbprefix']."forme_fields WHERE form_id = '".$form['id']."' order by ordering") or die(mysql_error());
		while($field = mysql_fetch_assoc($fieldsQuery))
		{
			foreach($field as $key=>$value){
				$field[$key] = mysql_real_escape_string(stripslashes($value));
			}
			
			if($field['fieldstyle']=='') $field['fieldstyle'] = $form['fieldstyle'];
			
			$inputtype = RSmigrationGetComponentTypeId($field['inputtype']);
			if($inputtype == 9) $enctype = ' enctype="multipart/form-data"';
			
			$componentsQuery = mysql_query("INSERT INTO `{$RSadapter->tbl_rsform_components}` 
			(`ComponentId`, `FormId`, `ComponentTypeId`, `Order`, `Published`) VALUES
			('', $formId, ".$inputtype.", '{$field['ordering']}', '{$field['published']}')") or die(mysql_error());
						
			$componentId = mysql_insert_id();
			
			$query1 = "INSERT INTO `{$RSadapter->tbl_rsform_properties}` (`PropertyId`, `ComponentId`, `PropertyName`, `PropertyValue`) VALUES ".RSmigrationParseComponent($inputtype, $field, $componentId)."";
			$propertiesQuery = mysql_query($query1) or die($query1 . mysql_error());
			
			
			$field['fieldstyle'] = str_replace('{fieldtitle}','{'.$field['name'].':caption}',$field['fieldstyle']);
			$field['fieldstyle'] = str_replace('{field}','{'.$field['name'].':body}'.'<br/>{'.$field['name'].':validation}',$field['fieldstyle']);
			$field['fieldstyle'] = str_replace('{fielddesc}','{'.$field['name'].':description}',$field['fieldstyle']);
			$field['fieldstyle'] = str_replace('{validationsign}',($field['validation_rule'] == '' ? '':' (*) '),$field['fieldstyle']);
			
			if($field['published'])  $formLayout .= $field['fieldstyle'];
		
			$newform = RSmigrationChangePlaceholdersValues($field['name'],$newform);
			
			
			
				
		}
		
		$newFormQuery = mysql_query("UPDATE `{$RSadapter->tbl_rsform_forms}` SET
			
			`ReturnUrl` = '{$newform['return_url']}', 
			`Thankyou` = '{$newform['thankyou']}',
			`UserEmailText` = '{$newform['email']}',
			`UserEmailTo` = '{$newform['emailto']}', 
			`UserEmailFrom` = '{$newform['emailfrom']}', 
			`UserEmailFromName` = '{$newform['emailfromname']}', 
			`UserEmailSubject` = '{$newform['emailsubject']}'
			
			WHERE FormId = 	$formId");	
		
		
		
		
		//update form layout
		
		$explodes = explode('<form',$form['formstyle']);
		
		$afterForm = $explodes[1];
		$afterForm = explode('>',$afterForm);
		array_shift($afterForm);
		$afterForm = implode('>',$afterForm);
		$form['formstyle'] = $explodes[0].$afterForm;
		
		
		
		//$form['formstyle'] = preg_replace('<form(.*)>','',$form['formstyle']);
		$form['formstyle'] = str_replace('</form>','',$form['formstyle']);
		$form['formstyle'] = str_replace('{formtitle}','{global:formtitle}',$form['formstyle']);
		$form['formstyle'] = str_replace('{formfields}',$formLayout,$form['formstyle']);
		
		$layoutQuery = mysql_query("UPDATE `{$RSadapter->tbl_rsform_forms}` SET FormLayout = '".$form['formstyle']."' WHERE FormId = $formId");
		
		
		//submissions
		$submissionsQuery = mysql_query("SELECT * FROM ".$RSadapter->config['dbprefix']."forme_data WHERE form_id = '".$form['id']."'") or die(mysql_error());
		while($submission = mysql_fetch_array($submissionsQuery))
		{
			$sQuery = mysql_query("INSERT INTO `{$RSadapter->tbl_rsform_submissions}` 
			(`SubmissionId`, `FormId`, `DateSubmitted`, `UserIp`, `Username`, `UserId`) VALUES 
			('','{$formId}','{$submission['date_added']}','{$submission['uip']}','','{$submission['UserId']}')");
			
			$SubmissionId = mysql_insert_id();
			
			$result_explode = explode("||\n",$submission['params']);
			$result = array();
			foreach($result_explode as $param_row)
			{
				
				$param_row = explode('=',$param_row,2);
				if(isset($param_row[1])){
					$result[$param_row[0]] = $param_row[1];
				}else{
					$result[$param_row[0]] = '';
				}
			}
			
			if(!empty($result))
			{
				foreach($result as $key=>$value)
				{
					$svQuery = mysql_query("INSERT INTO `{$RSadapter->tbl_rsform_submission_values}` (`SubmissionId`,`FieldName`,`FieldValue`) VALUES ('$SubmissionId','$key','".addslashes($value)."')") or die(mysql_error());
				}
			}
			
		}
		
	}
	$msg = $formCount . _RSFORM_BACKEND_MIGRATION_MSG;
	$RSadapter->redirect(_RSFORM_BACKEND_SCRIPT_PATH.'?option='.$option.'&task=forms.manage',$msg);
}

function RSmigrationChangePlaceholdersValues($fieldname, $formArray)
{
	foreach($formArray as $key=>$value)
	{
		$formArray[$key] = str_replace('{'.$fieldname.'}','{'.$fieldname.':value}',$formArray[$key]);
	}
	return $formArray;
}


function RSmigrationGetComponentTypeId($type)
{	
	switch($type)
	{
		case 'text': 			return 1;
		case 'password': 		return 14;
		case 'radio': 			return 5;
		case 'checkbox':		return 4;
		case 'calendar':		return 6;
		case 'textarea':		return 2;
		case 'select':			return 3;
		case 'button':			return 7;
		case 'image button':	return 12;
		case 'submit button':	return 13;
		case 'reset button':	return 7;
		case 'file upload':		return 9;
		case 'hidden':			return 11;
		case 'free text':		return 10;
		case 'ticket number':	return 15;
		case 'captcha':			return 8;
	}
}


?>