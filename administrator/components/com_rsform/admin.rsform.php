<?php
/**
* @version 1.2.0
* @package RSform!Pro 1.2.0
* @copyright (C) 2007-2009 www.rsjoomla.com
* @license Commercial License, http://www.rsjoomla.com/terms-and-conditions.html
*/

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );


ini_set('max_execution_time','300');
require_once(dirname(__FILE__).'/../../../components/com_rsform/controller/adapter.php');

//create the RSadapter
$GLOBALS['RSadapter'] = new RSadapter();
$RSadapter = $GLOBALS['RSadapter'];

//$RSadapter = $GLOBALS['RSadapter'];


//require classes
require_once(_RSFORM_BACKEND_ABS_PATH.'/admin.rsform.html.php');
require_once(_RSFORM_FRONTEND_ABS_PATH.'/rsform.class.php');

//require controller
require_once(_RSFORM_FRONTEND_ABS_PATH.'/controller/functions.php');

//require backend language file
require_once(_RSFORM_FRONTEND_ABS_PATH.'/languages/'._RSFORM_BACKEND_LANGUAGE.'.php');

//get task
$task           = $RSadapter->getParam($_REQUEST, 'task');
// get form id
$formId 		= $RSadapter->getParam($_REQUEST, 'formId');
 /*
$cid 	= mosGetParam($_REQUEST, 'cid', array());


$layout= mosGetParam($_GET, 'layout', null);

$limit 			= intval( mosGetParam( $_REQUEST, 'limit', 15 ) );
$limitstart 	= intval( mosGetParam( $_REQUEST, 'limitstart', 0 ) );
*/

switch($task)
{
	case 'debug':
		
	break;
	
	case 'richtext.show':
		richtextShow();
	break;
	
//FORMS
    case 'forms.manage':
        formsManage();
    break;

    case 'forms.edit':
        formsEdit($formId);
    break;

    case 'forms.cancel':
        formsCancel($option);
    break;

    case 'forms.save':
        formsSave($option, 0);
    break;

    case 'forms.apply':
        formsSave($option, 1);
    break;

    case 'forms.delete':
        formsDelete($option);
    break;

    case 'forms.copy':
    	formsCopy($option);
    break;

	case "forms.publish":
		formsPublish( $option, 1);
	break;

	case "forms.unpublish":
		formsPublish( $option, 0 );
	break;

	case "forms.preview":
		formsPreview( $option );
	break;

	case "forms.menuadd.screen":
		formsMenuaddScreen( $option );
	break;

	case "forms.menuadd.process":
		formsMenuaddProcess( $option );
	break;

    case 'forms.changeAutoGenerateLayout':
        formsChangeAutoGenerateLayout($option, $formId);
        exit();
    break;

//COMPONENTS

	case 'components.validate.name':
		componentsValidateName($option);
		exit();
	break;

	case 'components.display':
		componentsDisplay($option);
		exit();
	break;

	case 'components.movedown':
		componentsMoveDown($option);
	break;

	case 'components.moveup':
		componentsMoveUp($option);
	break;

	case 'components.copy.screen':
		componentsCopyScreen($option);
	break;

	case 'components.copy.process':
		componentsCopyProcess($option);
	break;

	case 'components.cancel':
		componentsCancel($option);
	break;

	case 'components.changestatus':
		componentsChangeStatus($option);
		exit();
	break;

	case 'components.remove':
		componentsRemove($option);
		exit();
	break;

//LAYOUTS
	case 'layouts.generate':
		layoutsGenerate($option, $formId);
		exit();
	break;

	case 'layouts.saveLayoutName':
		layoutsSaveName($formId);
		exit();
	break;
//SUBMISSIONS
	case 'submissions.manage':
		submissionsManage($option, $formId);
	break;
	case 'submissions.edit':
		submissionsEdit($option, $formId);
	break;
	case 'submissions.delete':
		submissionsDelete($option);
	break;
	case 'submissions.delete.all':
		submissionsDelete($option,-1);
	break;
	case 'submissions.export':
		submissionsExport($option);
	break;
	case 'submissions.export.process':
		submissionsExportProcess($option);
	break;

//CONFIGURATION
	case 'configuration.save':
		configurationSave($option);
	break;

	case 'configuration.edit':
		configurationEdit($option);
	break;

//BACKUP/RESTORE
	case 'backup.restore':
		backupRestore($option);
	break;

	case 'backup.download':
		backupDownload($option);
	break;
	
//MIGRATION
	case 'migration.process':
		migrationProcess($option);
	break;
	case 'migration.screen':
		migrationScreen($option);
	break;
	

//UPDATE
	case 'updates.manage':
		updatesManage($option);
	break;

	case 'update.upload.process':
		updateUploadProcess($option);
	break;

//MAPPINGS
	case 'mappings.getColumns':
		mappingsGetColumns($option);
		exit();
	break;

	case 'mappings.saveMapping':
		mappingsSaveMapping($option);
		exit();
	break;

	case 'mappings.deleteMapping':
		mappingsDeleteMapping($option);
		exit();
	break;
	
//PLUGINS
    case 'plugins.remove':
        pluginsRemove($option);
    break;
	
//CONTROL PANEL
    case 'saveRegistration':
        saveRegistration($option);
    break;

	default:
		rsform_HTML::controlPanel();
	break;
}

function richtextShow()
{
	$RSadapter = $GLOBALS['RSadapter'];
	$formId = intval($RSadapter->getParam($_GET,'formId'));
	$openerId = RScleanVar($RSadapter->getParam($_GET, 'openerId'));
	
	$additionalHTML = '
	<script type="text/javascript">
		window.opener.document.getElementById(\''.$openerId.'\').innerHTML = document.getElementById(\''.$openerId.'\').value;
	</script>
	
	';
	
	if (isset($_POST[$openerId]))
		$_POST[$openerId] = RScleanVar(trim($_POST[$openerId]));
	
	if(isset($_POST['act']))
	{
		switch($_POST['act'])
		{
			case 'save':
			default:
				mysql_query("UPDATE `{$RSadapter->tbl_rsform_forms}` SET `$openerId` = '".$_POST[$openerId]."' WHERE FormId = '$formId'") or die(mysql_error());
			break;
			
			case 'saveclose':
				mysql_query("UPDATE `{$RSadapter->tbl_rsform_forms}` SET `$openerId` = '".$_POST[$openerId]."' WHERE FormId = '$formId'") or die(mysql_error());
				$additionalHTML .= '
				<script type="text/javascript">
					window.close();
				</script>
				';
			break;
		}
	}
	
	//get value
	$r = @mysql_result(mysql_query("SELECT $openerId FROM `{$RSadapter->tbl_rsform_forms}` WHERE FormId = '$formId'"),0);
	
	rsform_HTML::richtextShow($formId, $openerId, $r, $additionalHTML);
}
//////////////////////////////////////// FORMS ////////////////////////////////////////
/**
* @desc Forms Manager Screen
*/
function formsManage()
{
    $RSadapter = $GLOBALS['RSadapter'];

    $rez = mysql_query("SELECT * FROM `{$RSadapter->tbl_rsform_forms}` ORDER BY `FormId` DESC") or die(mysql_error());

    $rows = array();
    while($r=mysql_fetch_assoc($rez))
	{
        //build today, this month, this year
        $r['_todaySubmissions'] = @mysql_result(mysql_query("SELECT COUNT(`SubmissionId`) cnt FROM `{$RSadapter->tbl_rsform_submissions}` WHERE date_format(DateSubmitted,'%Y-%m-%d') = '".date('Y-m-d')."' AND FormId='{$r['FormId']}'"),0);

        $r['_monthSubmissions'] = @mysql_result(mysql_query("SELECT COUNT(`SubmissionId`) cnt FROM `{$RSadapter->tbl_rsform_submissions}` WHERE date_format(DateSubmitted,'%Y-%m') = '".date('Y-m')."' AND FormId='{$r['FormId']}'"),0);
		
        $r['_allSubmissions'] = @mysql_result(mysql_query("SELECT COUNT(`SubmissionId`) cnt FROM `{$RSadapter->tbl_rsform_submissions}` WHERE FormId='{$r['FormId']}'"),0);

        $rows[] = $r;
    }
    rsform_HTML::formsManage($rows);
}

/**
 * Forms Publish/Unpublish Process
 *
 * @param str $option
 * @param int $publishform
 */
function formsPublish( $option, $publishform=1 )
{
	$RSadapter = $GLOBALS['RSadapter'];

	$publishform = intval($publishform);
  	$cids = $RSadapter->getParam($_POST,'cid');
  	$total = count($cids);
  	$formIds = implode(',', $cids);

	if ($total > 0)
		mysql_query("UPDATE $RSadapter->tbl_rsform_forms SET Published = '".$publishform."' WHERE FormId IN ($formIds)");

    switch ($publishform)
	{
		case 1:
			$msg = $total ._RSFORM_BACKEND_SUC_PUBL_FORM.' ';
		break;
		
		case 0:
		default:
			$msg = $total ._RSFORM_BACKEND_SUC_UNPUBL_FORM.' ';
		break;
	}

	$RSadapter->redirect( _RSFORM_BACKEND_SCRIPT_PATH.'?option='.$option.'&task=forms.manage', $msg );

}

/**
 * Forms Menu Add Screen
 *
 * @param str $option
 */
function formsMenuaddScreen($option)
{
	$RSadapter = $GLOBALS['RSadapter'];

	$formId = intval($RSadapter->getParam($_REQUEST,'formId'));

	//get form title
	$formTitle = @mysql_result(mysql_query("SELECT FormTitle FROM `$RSadapter->tbl_rsform_forms` WHERE FormId = '$formId'"),0);

	$menus = $RSadapter->getMenus();

	rsform_HTML::formsMenuaddScreen($option, $menus, $formId, $formTitle);
}

/**
 * Forms Menu Add Process
 *
 * @param str $option
 */
function formsMenuaddProcess($option)
{
	$RSadapter = $GLOBALS['RSadapter'];

	$formId = intval($RSadapter->getParam($_REQUEST,'formId'));
	$menu = $RSadapter->getParam($_REQUEST,'menu');
	$menuTitle = $RSadapter->getParam($_REQUEST,'menutitle');

	//get form title
	$formTitle = @mysql_result(mysql_query("SELECT FormTitle FROM `$RSadapter->tbl_rsform_forms` WHERE FormId = '$formId'"),0);
	
	//insert
	$RSadapter->addMenu($formId, $menuTitle, $menu);

	$RSadapter->redirect( _RSFORM_BACKEND_SCRIPT_PATH.'?option='.$option.'&task=forms.manage', _RSFORM_BACKEND_FORMS_MENUADD_ADDED );
}
/**
 * Forms Preview Process
 *
 * @param str $option
 */
function formsPreview($option)
{
	$RSadapter = $GLOBALS['RSadapter'];

	$formId = intval($RSadapter->getParam($_REQUEST,'formId'));

	?>
	<script type="text/javascript">
		window.open('<?php echo _RSFORM_FRONTEND_SCRIPT_PATH.'/index.php?option='.$option.'&formId='.$formId;?>');
		document.location='<?php echo _RSFORM_BACKEND_SCRIPT_PATH.'?option='.$option.'&task=forms.edit&formId='.$formId;?>';
	</script>
	<?php
}

/**
 * Forms Copy Process
 */
function formsCopy($option)
{
	$RSadapter = $GLOBALS['RSadapter'];
	$formIds = $RSadapter->getParam($_POST,'cid');

	$total = count($formIds);
	if ($total > 0)
		foreach($formIds as $formId)
			RScopyForm($formId);

	$msg = $total._RSFORM_BACKEND_FORMS_COPY.' ';
	$RSadapter->redirect( _RSFORM_BACKEND_SCRIPT_PATH.'?option='. $option .'&task=forms.manage', $msg );
}
/**
 * Forms Delete Process
 *
 * @param str $option
 */
function formsDelete($option)
{
	$RSadapter = $GLOBALS['RSadapter'];

	$formIds = $RSadapter->getParam($_POST,'cid');
	$total = count($formIds);
	
	if ($total > 0)
		foreach($formIds as $formId)
		{
			$formId = intval($formId);
			
			//Delete Submissions
			$submissionIds = array();
			$result = mysql_query("SELECT SubmissionId FROM $RSadapter->tbl_rsform_submissions WHERE FormId = '$formId'");
			while ($row = mysql_fetch_assoc($result))
				$submissionIds[]  = $row['SubmissionId'];
			$submissions = implode(',',$submissionIds);
			
			if (count($submissionIds) > 0)
			{
				mysql_query("DELETE FROM $RSadapter->tbl_rsform_submission_values WHERE SubmissionId IN ({$submissions})");
				mysql_query("DELETE FROM $RSadapter->tbl_rsform_submissions WHERE SubmissionId IN '{$submissions}'");
			}

			//Delete Components
			$componentIds = array();
			$result = mysql_query("SELECT ComponentId FROM $RSadapter->tbl_rsform_components WHERE FormId = '$formId'");
			while($row = mysql_fetch_assoc($result))
				$componentIds[] = $row['ComponentId'];
			$components = implode(',',$componentIds);
			
			if (count($componentIds) > 0)
			{
				mysql_query("DELETE FROM $RSadapter->tbl_rsform_properties WHERE ComponentId IN '{$components}'");
				mysql_query("DELETE FROM $RSadapter->tbl_rsform_components WHERE ComponentId IN '{$components}'");
			}

			//Delete Forms
			mysql_query("DELETE FROM $RSadapter->tbl_rsform_forms WHERE FormId = '{$formId}'");
		}
	
	$msg = $total ._RSFORM_BACKEND_FORMS_DEL.' ';
	$RSadapter->redirect( _RSFORM_BACKEND_SCRIPT_PATH.'?option='. $option .'&task=forms.manage', $msg );
}

/**
 * Forms Edit Screen
 *
 * @param int $formId
 */
function formsEdit($formId)
{
	$RSadapter = $GLOBALS['RSadapter'];
    global $option;

	$formId = intval($formId);
	
    if(isset($_POST['ordering']))
    {
        $formId = intval($_POST['formId']);
        $order = $_POST['ordering'];
        asort($order);
        $i=1;
        foreach($order as $key => $val)
        {
            $val = $i++;
			$key = intval($key);
            mysql_query("update `{$RSadapter->tbl_rsform_components}` set `Order`='$val' where ComponentId='$key'") or die(mysql_error());
        }
    }
	
    if (isset($_GET['formId']))
        $formId = intval($_GET['formId']);
    
	if (!isset($_GET['formId']) && !isset($_POST['formId']))
    {
        mysql_query("insert into `{$RSadapter->tbl_rsform_forms}` (`FormName`,`FormTitle`,`FormLayout`,`FormLayoutName`,`FormLayoutAutogenerate`) values('"._RSFORM_BACKEND_FORMS_EDIT_NO_FORM_NAME."','"._RSFORM_BACKEND_FORMS_EDIT_NO_FORM_TITLE."','','inline','1')") or die(mysql_error());
        $formId = mysql_insert_id();

        $layout = @include(_RSFORM_BACKEND_ABS_PATH.'/layouts/inline.php');
        mysql_query("update `{$RSadapter->tbl_rsform_forms}` SET `FormLayout` = '$layout' WHERE FormId = '$formId'") or die(mysql_error());
    }
	
    if(isset($_POST['COMPONENTTYPE']))
    {
        if($_POST['componentIdToEdit']!=-1)
        {
            foreach($_POST['param'] as $key=>$val)
            {
				$_POST['componentIdToEdit'] = intval($_POST['componentIdToEdit']);
				$val = RScleanVar($val);
				$key = RScleanVar($key);
                mysql_query("update `{$RSadapter->tbl_rsform_properties}` set PropertyValue='$val' where ComponentId='{$_POST['componentIdToEdit']}' and PropertyName='{$key}'") or die(mysql_error());
            }
        }
        else
        {
            $nextOrder = @mysql_result(mysql_query("select max(`Order`)+1 as MO from `{$RSadapter->tbl_rsform_components}` where FormId='$formId'"),0);
            mysql_query("insert into `{$RSadapter->tbl_rsform_components}` (FormId,ComponentTypeId,`Order`) values ('$_POST[formId]','$_POST[COMPONENTTYPE]','$nextOrder')") or die(mysql_error());

            $componentId = @mysql_result(mysql_query("select max(ComponentId) as MCI from `{$RSadapter->tbl_rsform_components}`"),0);
            $values = $_POST['param'];
			
            foreach($values as $key => $value)
            {
				$value = RScleanVar($value);
				$key = RScleanVar($key);
                mysql_query("insert into `{$RSadapter->tbl_rsform_properties}` (ComponentId,PropertyName,PropertyValue) values ('$componentId','$key','$value')") or die(mysql_error());
            }
        }
        $formId = intval($_POST['formId']);
    }
	
    $row = mysql_fetch_assoc(mysql_query("SELECT * FROM `{$RSadapter->tbl_rsform_forms}` WHERE FormId='{$formId}'"));
    rsform_HTML::formsEdit($formId, $row);
}

/**
 * Forms Save Process
 *
 * @param str $option
 * @param int $apply
 */
function formsSave($option,$apply=0)
{
    $RSadapter = $GLOBALS['RSadapter'];

    foreach($_POST as $key=>$value)
    	$row[$key] = RScleanVar($RSadapter->getParam($_POST,$key));
    
//    	`FormLayoutAutogenerate`= '{$row['FormLayoutAutogenerate']}',
    $query = mysql_query("
    UPDATE `{$RSadapter->tbl_rsform_forms}` SET
    	`FormName` 				= '{$row['FormName']}',
    	`FormLayout` 			= '{$row['FormLayout']}',
    	`FormTitle`				= '{$row['FormTitle']}',
    	`ReturnUrl`				= '{$row['ReturnUrl']}',
    	`UserEmailTo`			= '{$row['UserEmailTo']}',
    	`UserEmailCC`			= '{$row['UserEmailCC']}',
    	`UserEmailBCC`			= '{$row['UserEmailBCC']}',
    	`UserEmailFrom`			= '{$row['UserEmailFrom']}',
    	`UserEmailReplyTo`		= '{$row['UserEmailReplyTo']}',
    	`UserEmailFromName`		= '{$row['UserEmailFromName']}',
    	`UserEmailSubject`		= '{$row['UserEmailSubject']}',
    	`UserEmailMode`			= '{$row['UserEmailMode']}',
		`UserEmailAttach`		= '{$row['UserEmailAttach']}',
		`UserEmailAttachFile`	= '{$row['UserEmailAttachFile']}',
    	".($row['UserEmailMode'] ? '':"`UserEmailText` = '{$row['UserEmailText']}',")."
    	".($row['AdminEmailMode'] ? '':"`AdminEmailText` = '{$row['AdminEmailText']}',")."
    	`AdminEmailTo`			= '{$row['AdminEmailTo']}',
    	`AdminEmailCC`			= '{$row['AdminEmailCC']}',
    	`AdminEmailBCC`			= '{$row['AdminEmailBCC']}',
    	`AdminEmailFrom`		= '{$row['AdminEmailFrom']}',
    	`AdminEmailReplyTo`		= '{$row['AdminEmailReplyTo']}',
    	`AdminEmailFromName`	= '{$row['AdminEmailFromName']}',
    	`AdminEmailSubject`		= '{$row['AdminEmailSubject']}',
    	`AdminEmailMode`		= '{$row['AdminEmailMode']}',
    	`ScriptProcess`			= '{$row['ScriptProcess']}',
    	`ScriptProcess2`		= '{$row['ScriptProcess2']}',
    	`ScriptDisplay`			= '{$row['ScriptDisplay']}'
    WHERE
    	`FormId` 				= '{$row['formId']}';") or die(mysql_error());

    if(!$apply)
		$RSadapter->redirect(_RSFORM_BACKEND_SCRIPT_PATH."?option=$option&task=forms.manage", _RSFORM_BACKEND_FORMS_SAVE." ");
    else
		$RSadapter->redirect(_RSFORM_BACKEND_SCRIPT_PATH."?option=$option&task=forms.edit&formId=".$row['formId'], _RSFORM_BACKEND_FORMS_SAVE." ");

}

/**
 * Closes the form
 *
 * @param str $option
 */
function formsCancel($option)
{
	$RSadapter = $GLOBALS['RSadapter'];

    $RSadapter->redirect(_RSFORM_BACKEND_SCRIPT_PATH."?option=$option&task=forms.manage" );
}
/**
 * Change the AutoGenerate layout
 *
 * @param unknown_type $option
 * @param unknown_type $formId
 * @param unknown_type $formLayoutName
 */
function formsChangeAutoGenerateLayout($option, $formId)
{
	$RSadapter = $GLOBALS['RSadapter'];

	$formLayoutName = RScleanVar($RSadapter->getParam($_GET, 'formLayoutName'));
	$formId = intval($formId);
	
    mysql_query("UPDATE `{$RSadapter->tbl_rsform_forms}` SET `FormLayoutAutogenerate` = ABS(FormLayoutAutogenerate-1), `FormLayoutName`='$formLayoutName' WHERE `FormId` = '$formId'") or die(mysql_error());
}

//////////////////////////////////////// COMPONENTS ////////////////////////////////////////
/**
 * Validates a component name
 *
 * @param str $option
 */
function componentsValidateName($option)
{
	$RSadapter = $GLOBALS['RSadapter'];

	$componentName 		= RScleanVar($RSadapter->getParam($_GET, 'componentName'));
	$currentComponentId = intval($RSadapter->getParam($_GET, 'currentComponentId'));
	$componentId		= intval($RSadapter->getParam($_GET, 'componentId'));
	$componentType		= intval($RSadapter->getParam($_GET, 'componentType'));
	$destination		= $RSadapter->getParam($_GET, 'destination');
	$formId				= intval($RSadapter->getParam($_GET, 'formId'));

	$componentName = trim($componentName);
	if(eregi('[^a-zA-Z0-9_ ]', $componentName ) || empty($componentName))
	{
		echo _RSFORM_BACKEND_COMPONENTS_VALIDATE_ERROR_UNIQUE_NAME;
		return;
	}
	
	//on file upload component, check destination
	if($componentType==9)
	{
		if (empty($destination))
		{
			echo _RSFORM_BACKEND_COMPONENTS_VALIDATE_ERROR_DESTINATION;
			return;
		}
		if(!is_dir($destination))
		{
			echo _RSFORM_BACKEND_COMPONENTS_VALIDATE_ERROR_DESTINATION_NOT_DIR;
			return;
		}
		if(!is_writable($destination))
		{
			echo _RSFORM_BACKEND_COMPONENTS_VALIDATE_ERROR_DESTINATION_NOT_WRITABLE;
			return;
		}
	}
	
	if ($currentComponentId == 0)
		$q="select
				`{$RSadapter->tbl_rsform_forms}`.`FormId`,
				`{$RSadapter->tbl_rsform_properties}`.`PropertyName`,
				`{$RSadapter->tbl_rsform_properties}`.`PropertyValue`
			from `{$RSadapter->tbl_rsform_components}`
			left join `{$RSadapter->tbl_rsform_properties}` on `{$RSadapter->tbl_rsform_components}`.`ComponentId`=`{$RSadapter->tbl_rsform_properties}`.`ComponentId`
			left join {$RSadapter->tbl_rsform_forms} on `{$RSadapter->tbl_rsform_components}`.`FormId`=`{$RSadapter->tbl_rsform_forms}`.`FormId`
			where `{$RSadapter->tbl_rsform_forms}`.`FormId`='$_GET[formId]' and `{$RSadapter->tbl_rsform_properties}`.PropertyName='NAME' and `{$RSadapter->tbl_rsform_properties}`.PropertyValue='$_GET[componentName]'";
	else
		$q="select
				`{$RSadapter->tbl_rsform_forms}`.`FormId`,
				`{$RSadapter->tbl_rsform_properties}`.`PropertyName`,
				`{$RSadapter->tbl_rsform_properties}`.`PropertyValue`
			from {$RSadapter->tbl_rsform_components}
			left join `{$RSadapter->tbl_rsform_properties}` on `{$RSadapter->tbl_rsform_components}`.ComponentId={$RSadapter->tbl_rsform_properties}.ComponentId
			left join {$RSadapter->tbl_rsform_forms} on `{$RSadapter->tbl_rsform_components}`.FormId={$RSadapter->tbl_rsform_forms}.FormId
			where {$RSadapter->tbl_rsform_forms}.FormId='$formId' and `{$RSadapter->tbl_rsform_properties}`.PropertyName='NAME' and `{$RSadapter->tbl_rsform_properties}`.PropertyValue='$componentName' and `{$RSadapter->tbl_rsform_components}`.ComponentId!=$_GET[currentComponentId]";
			
	$exists = mysql_num_rows(mysql_query($q));
	
	if ($exists)
		echo _RSFORM_BACKEND_COMPONENTS_VALIDATE_ERROR_UNIQUE_NAME;
	else
		echo 'Ok';

	exit();
}

/**
 * Displays a component in the backend.
 *
 * @param unknown_type $option
 */
function componentsDisplay($option)
{
	$RSadapter = $GLOBALS['RSadapter'];
	$componentId = intval($RSadapter->getParam($_GET, 'componentId'));
	$componentType = intval($RSadapter->getParam($_GET, 'componentType'));

	$rez = mysql_query("SELECT * FROM `{$RSadapter->tbl_rsform_component_type_fields}` WHERE ComponentTypeId='{$componentType}' ORDER BY Ordering");
	$data = array();
	$out = '';
	if ($componentId > 0)
		$data=RSgetComponentProperties($componentId);
	
	$out.='<table class="componentForm" border="0" cellspacing="0" cellpadding="0">';
	$counter = 0;
	while($r = mysql_fetch_assoc($rez))
	{
		if ($counter==2 && mysql_num_rows($rez) > 3)
			$out.= '<tr><td><input type="button" onclick="processComponent('.$componentType.')" value="'._RSFORM_BACKEND_COMP_SAVE.'" style="float:right; margin-right:20px;"></td></tr>';
		$out.='<tr>';
		
		switch($r['FieldType'])
		{
			case 'textbox':
			{
				$out.='<td>'.constant('_RSFORM_BACKEND_COMP_FIELD_'.$r['FieldName']).'<br/>';
				if ($componentId > 0)
				{	
					$val = (defined('_RSFORM_BACKEND_COMP_FVALUE_'.$data[$r['FieldName']]) ? constant('_RSFORM_BACKEND_COMP_FVALUE_'.$data[$r['FieldName']]) : $data[$r['FieldName']]);
					$out .= '<input type="text" id="'.$r['FieldName'].'" name="param['.$r['FieldName'].']" value="'.RSshowVar($data[$r['FieldName']]).'" class="wide"></td>';
				}
				else
				{
					$val = (defined('_RSFORM_BACKEND_COMP_FVALUE_'.RSisCode($r['FieldValues'])) ? constant('_RSFORM_BACKEND_COMP_FVALUE_'.RSisCode($r['FieldValues'])) : RSisCode($r['FieldValues']));
					$out .= '<input type="text" id="'.$r['FieldName'].'" name="param['.$r['FieldName'].']" value="'.$val.'" class="wide"></td>';
				}
			}
			break;

			case 'textarea':
			{
				$out .= '<td>'.constant('_RSFORM_BACKEND_COMP_FIELD_'.$r['FieldName']).'<br/>';				
				if ($componentId > 0)
				{
					$constant = str_replace('::','',$data[$r['FieldName']]);
					$val = (defined('_RSFORM_BACKEND_COMP_FVALUE_'.$constant) ? constant($constant) : $data[$r['FieldName']]);
					$out .= '<textarea id="'.$r['FieldName'].'" name="param['.$r['FieldName'].']" rows="5" cols="20" class="wide">'.RSshowVar($val).'</textarea></td>';
				}
				else
				{
					$val = (defined('_RSFORM_BACKEND_COMP_FVALUE_'.RSisCode($r['FieldValues'])) ? constant('_RSFORM_BACKEND_COMP_FVALUE_'.RSisCode($r['FieldValues'])) : RSisCode($r['FieldValues']));
					$out .= '<textarea id="'.$r['FieldName'].'" name="param['.$r['FieldName'].']" rows="5" cols="20" class="wide">'.$val.'</textarea></td>';
				}
			}
			break;
			
			case 'select':
			{
				$out .= '<td>'.constant('_RSFORM_BACKEND_COMP_FIELD_'.$r['FieldName']).'<br/>';
				$out .= '<select id="'.$r['FieldName'].'" name="param['.$r['FieldName'].']">';
				$r['FieldValues'] = str_replace("\r",'',$r['FieldValues']);
				$r['FieldValues'] = RSisCode($r['FieldValues']);
				$buff = explode("\n",$r['FieldValues']);
				foreach($buff as $val)
				{
					$label = (defined('_RSFORM_BACKEND_COMP_FVALUE_'.$val) ? constant('_RSFORM_BACKEND_COMP_FVALUE_'.$val) : $val);
					$out .= '<option '.($componentId > 0 && $data[$r['FieldName']] == $val ? 'selected="selected"' : '').' value="'.RSshowVar($val).'">'.RSshowVar($label).'</option>';
				}
				$out .= '</select></td>';
			}
			break;
			
			case 'hidden':
			{
				$val = (defined('_RSFORM_BACKEND_COMP_FVALUE_'.$r['FieldValues']) ? constant('_RSFORM_BACKEND_COMP_FVALUE_'.$r['FieldValues']) : $r['FieldValues']);
				$out .= '<td><input type="hidden" id="'.$r['FieldName'].'" name="'.$r['FieldName'].'" value="'.RSshowVar($val).'"></td>';
			}
			break;
		}
		
		if ($componentId > 0)
			$out .= '<input type="hidden" name="updateComponent">';
			
		$out .= '</tr>';
		$counter++;
	}
	$out .= '<tr><td><input type="button" onclick="processComponent('.$componentType.')" value="'._RSFORM_BACKEND_COMP_SAVE.'" style="float:right; margin-right:20px;"></td></tr>';
	$out .= '<tr><td>&nbsp;</td></tr>';
	$out .= '</table>';

	echo $out;
}

/**
 * Moves the component up
 *
 * @param str $option
 */
function componentsMoveUp($option)
{
	$RSadapter = $GLOBALS['RSadapter'];
	
	$componentId = intval($RSadapter->getParam($_GET, 'componentId'));
	$formId = intval($RSadapter->getParam($_GET, 'formId'));

	$order = @mysql_result(mysql_query("SELECT `Order` FROM `{$RSadapter->tbl_rsform_components}` WHERE FormId='{$formId}' AND ComponentId='{$componentId}'"),0);

	if ($order > 1)
	{
		$order -= 1;
		$id = @mysql_result(mysql_query("SELECT ComponentId FROM `{$RSadapter->tbl_rsform_components}` WHERE FormId='{$formId}' AND `Order`='$order'"),0);
		mysql_query("UPDATE `{$RSadapter->tbl_rsform_components}` SET `Order`=`Order`-1 WHERE ComponentId='{$componentId}' AND FormId='{$formId}'");
		mysql_query("UPDATE `{$RSadapter->tbl_rsform_components}` SET `Order`=`Order`+1 WHERE ComponentId='$id' AND FormId='{$formId}'");
	}
}

/**
 * Moves the component down
 *
 * @param str $option
 */
function componentsMoveDown($option)
{
	$RSadapter = $GLOBALS['RSadapter'];
	
	$componentId = intval($RSadapter->getParam($_GET, 'componentId'));
	$formId = intval($RSadapter->getParam($_GET, 'formId'));

	$max= @mysql_result(mysql_query("SELECT COUNT(ComponentId) AS number FROM `{$RSadapter->tbl_rsform_components}` WHERE FormId='{$formId}'"),0);
	$order = @mysql_result(mysql_query("SELECT `Order` FROM `{$RSadapter->tbl_rsform_components}` WHERE FormId='{$formId}' AND ComponentId='{$componentId}'"),0);
	
	if ($order < $max)
	{
		$order += 1;
		$id = @mysql_result(mysql_query("SELECT ComponentId FROM `{$RSadapter->tbl_rsform_components}` WHERE FormId='{$formId}' AND `Order`='$order'"),0);
		mysql_query("UPDATE `{$RSadapter->tbl_rsform_components}` SET `Order`=`Order`+1 WHERE ComponentId='{$componentId}' AND FormId='{$formId}'");
		mysql_query("UPDATE `{$RSadapter->tbl_rsform_components}` SET `Order`=`Order`-1 WHERE ComponentId='$id' AND FormId='{$formId}'");
	}
}

/**
 * Components Cancel
 *
 * @param str $option
 */
function componentsCancel($option)
{
	$RSadapter = $GLOBALS['RSadapter'];

	$formId = $RSadapter->getParam($_POST, 'formId');

	$RSadapter->redirect(_RSFORM_BACKEND_SCRIPT_PATH.'?option='.$option.'&task=forms.edit&formId='.$formId);
}

/**
 * Components Copy Process
 *
 * @param str $option
 */
function componentsCopyProcess($option)
{
	$RSadapter = $GLOBALS['RSadapter'];
	$formId = intval($RSadapter->getParam($_POST, 'formId'));
	$toFormId = intval($RSadapter->getParam($_POST, 'toFormId', 0));
	$componentsToCopy = $RSadapter->getParam($_POST, 'componentId', array());

	if ($toFormId > 0 && !empty($componentsToCopy))
		foreach($componentsToCopy as $componentToCopyId)
			RScopyComponent($componentToCopyId,$toFormId);

	$RSadapter->redirect(_RSFORM_BACKEND_SCRIPT_PATH.'?option='.$option.'&task=forms.edit&formId='.$toFormId,_RSFORM_BACKEND_COMPONENTS_COPY_OK);
}

/**
 * Components Copy Screen
 *
 * @param str $option
 */
function componentsCopyScreen($option)
{
	$RSadapter = $GLOBALS['RSadapter'];
	$formId = intval($RSadapter->getParam($_REQUEST, 'formId'));
	$components = $RSadapter->getParam($_REQUEST,'checks',array());
	//load all forms
	$rez = mysql_query("SELECT FormId, FormTitle FROM `{$RSadapter->tbl_rsform_forms}`");

	$forms = array();
	while($r = mysql_fetch_array($rez))
		$forms[$r['FormId']] = $r['FormTitle'];
	
	rsform_HTML::componentsCopyScreen($option, $forms, $components, $formId);
}

/**
 * Publish / Unpublish a component
 *
 * @param str $option
 */
function componentsChangeStatus($option)
{
	$RSadapter = $GLOBALS['RSadapter'];
	$componentId = intval($RSadapter->getParam($_GET, 'componentId'));

	//get current status
	$currentStatus = @mysql_result(mysql_query("SELECT `Published` FROM `{$RSadapter->tbl_rsform_components}` WHERE ComponentId='$componentId'"),0);
	$newStatus = ($currentStatus) ? 0 : 1;
	mysql_query("UPDATE `{$RSadapter->tbl_rsform_components}` SET published = '$newStatus' WHERE ComponentId='$componentId'");
}

/**
 * Remove Component
 *
 * @param str $option
 */
function componentsRemove($option)
{
	$RSadapter = $GLOBALS['RSadapter'];
	$componentId = intval($RSadapter->getParam($_GET, 'componentId'));
	$formId = intval($RSadapter->getParam($_GET, 'formId'));

	mysql_query("DELETE FROM `{$RSadapter->tbl_rsform_components}` WHERE ComponentId='$componentId'");
	mysql_query("DELETE FROM `{$RSadapter->tbl_rsform_properties}` WHERE ComponentId='$componentId'");
	
	$rez=mysql_query("SELECT ComponentId FROM `{$RSadapter->tbl_rsform_components}` WHERE FormId='$formId' ORDER BY `Order`");
	$i = 1;
	while($r=mysql_fetch_assoc($rez))
	{
		mysql_query("UPDATE `{$RSadapter->tbl_rsform_components}` SET `Order`='$i' WHERE ComponentId='$r[ComponentId]'");
		$i++;
	}
}

//////////////////////////////////////// LAYOUTS ////////////////////////////////////////

function layoutsGenerate($option, $formId)
{
	$RSadapter = $GLOBALS['RSadapter'];
	$layout = $RSadapter->getParam($_GET,'layout');

	$bad = array('\\','/');
	$layout = str_replace($bad,'',$layout);
	require_once(_RSFORM_BACKEND_ABS_PATH.'/layouts/'.$layout.'.php');
}

function layoutsSaveName($formId)
{
	$RSadapter = $GLOBALS['RSadapter'];
	$formId = intval($formId);
	
	$formLayoutName = RScleanVar($RSadapter->getParam($_GET,'formLayoutName'));
	mysql_query("UPDATE {$RSadapter->tbl_rsform_forms} set FormLayoutName='$formLayoutName' where FormId='$formId'");
}

//////////////////////////////////////// SUBMISSIONS ////////////////////////////////////////
/**
 * Submissions Manager Screen
 *
 * @param str $option
 * @param int $formId
 */
function submissionsManage($option, $formId)
{
	$RSadapter = $GLOBALS['RSadapter'];

	$formId = intval($formId);
	
	if ($formId == 0)
	{
		//get the first form
		$formId = @mysql_result(mysql_query("SELECT FormId FROM {$RSadapter->tbl_rsform_forms} WHERE published=1 ORDER BY FormId LIMIT 1"),0);
		if ($formId > 0)
		$RSadapter->redirect(_RSFORM_BACKEND_SCRIPT_PATH.'?option='.$option.'&task=submissions.manage&formId='.$formId);
	}

	$data = new SManager($formId);
	$data->limit = $RSadapter->config['list_limit'];

	//load forms
	$forms = array();
	$query = mysql_query("SELECT FormId, FormName FROM {$RSadapter->tbl_rsform_forms} order by FormId");
	while($formRow = mysql_fetch_array($query))
		$forms[$formRow['FormId']] = $formRow['FormName'];

	rsform_HTML::submissionsManage($option, $data, $forms);
}
/**
 * Edits one submission
 *
 * @param str $option
 * @param int $formId
 */
function submissionsEdit($option, $formId)
{
	$RSadapter = $GLOBALS['RSadapter'];

	$data = new SManager($formId);
	
	$order = 0;
	if (isset($_GET['order']) && $_GET['order'] == 'asc')
		$order = 1;
	
	$id = 0;
	if (isset($_GET['id']) && $_GET['id'] > 0)
		$id = $_GET['id'];

	$sort_id = 0;
	if (isset($_GET['sort_id']) && $_GET['sort_id'] > 0)
		$sort_id = $_GET['sort_id'];
	
	$filter = '';
	if (isset($_GET['filter']) && strlen($_GET['filter']) > 0)
		$filter = $_GET['filter'];
	$data->filter = $filter;
	
	$page = 1;
	if (isset($_GET['page']) && $_GET['page'] > 1)
		$page = $_GET['page'];
	$data->current = $page;
	
	$data->limit = $RSadapter->config['list_limit'];
	if (isset($_GET['limit']))
		$data->limit = $_GET['limit'];

	if(!isset($_GET['action']))
		$_GET['action'] = '';
	
	header('Content-type: text/html; charset=utf-8');
	switch($_GET['action']){
		case 'edit':
			$data->setValue($_GET['SubmissionId'], $_GET['SubmissionValueId'], $_POST['value'], $_GET['fieldName']);
			exit();
		break;
		case 'remove':
			$data->setOrder($sort_id, $order);
			$data->deleteRow($id);
			rsform_HTML::submissionsTable($option, $data);
			exit();
		break;
		case 'sort':
			$data->setOrder($sort_id, $order);
			rsform_HTML::submissionsTable($option, $data);
			exit();
		break;
		case 'filter':
			$data->setOrder($sort_id, $order);
			rsform_HTML::submissionsTable($option, $data);
			exit();
		break;
		case 'page':
			$data->setOrder($sort_id, $order);
			rsform_HTML::submissionsTable($option, $data);
			exit();
		break;
		case 'pager':
			$data->setOrder($sort_id, $order);
			$data->pager($page, $filter);
			exit();
		break;
		case 'exportall':
			$data->setOrder($sort_id, $order);
			$data->exportAll($page, $filter);
			exit();
		break;
	}

}

function deleteSubmissionFiles($submissionId, $formId)
{
	$RSadapter = $GLOBALS['RSadapter'];
	
	$formId = intval($formId);
	
	//check if submissions have file uploads
		
	//check if form has upload fields, and return their names
	$query = mysql_query("SELECT ComponentId FROM `{$RSadapter->tbl_rsform_components}` WHERE ComponentTypeId = 9 AND FormId = '$formId'");
	while($row = mysql_fetch_assoc($query))
	{
		$file = @mysql_result(mysql_query("SELECT sv.FieldValue FROM `{$RSadapter->tbl_rsform_submission_values}` sv, `{$RSadapter->tbl_rsform_properties}` p WHERE p.ComponentId = '{$row['ComponentId']}' AND p.PropertyName = 'NAME' AND p.PropertyValue = sv.FieldName AND sv.SubmissionId = '{$submissionId}' LIMIT 1"),0);
		if(!empty($file)) @unlink($file);
	}
}

/**
 * Deletes submissions
 *
 * @param str $option
 * @param int $all
 */
function submissionsDelete($option, $all=1)
{
	$RSadapter = $GLOBALS['RSadapter'];

	$formId 		= intval($RSadapter->getParam($_REQUEST, 'formId'));
	$submissionIds 	= $RSadapter->getParam($_POST, 'checks');

	//delete submissionIds
	if($all!=-1)
	{
		if(!empty($submissionIds))
		{
			foreach($submissionIds as $submissionId)
				deleteSubmissionFiles($submissionId, $formId);
			
			mysql_query("DELETE FROM {$RSadapter->tbl_rsform_submissions} WHERE `SubmissionId` IN (".implode(',',$submissionIds).")");
			mysql_query("DELETE FROM {$RSadapter->tbl_rsform_submission_values} WHERE `SubmissionId` IN (".implode(',',$submissionIds).")");
		}
	}
	else
	{
		$submissionIds = array();
		
		$result = mysql_query("SELECT SubmissionId FROM {$RSadapter->tbl_rsform_submissions} WHERE `FormId` = '$formId'");
		while($row = mysql_fetch_assoc($result))
		{
			deleteSubmissionFiles($row['SubmissionId'], $formId);
			$submissionIds[] = $row['SubmissionId'];
		}
			
		if (!empty($submissionIds))
			mysql_query("DELETE FROM {$RSadapter->tbl_rsform_submission_values} WHERE `SubmissionId` IN (".implode(',',$submissionIds).")");
		
		mysql_query("DELETE FROM {$RSadapter->tbl_rsform_submissions} WHERE `FormId` = '$formId'");
	}
	$RSadapter->redirect(_RSFORM_BACKEND_SCRIPT_PATH.'?option='.$option.'&task=submissions.manage&formId='.$formId);
}

/**
 * Export Submissions Screen
 *
 * @param str $option
 */
function submissionsExport($option)
{
	$RSadapter = $GLOBALS['RSadapter'];

	$formId 		= intval($RSadapter->getParam($_REQUEST, 'formId'));
	$submissionIds 	= $RSadapter->getParam($_POST, 'checks');

	//load form Name
	$formName = @mysql_result(mysql_query("SELECT FormName FROM {$RSadapter->tbl_rsform_forms} WHERE FormId = '$formId'"),0);

	//load components
	$formComponents = array();
	$result = mysql_query("SELECT `ComponentId`, `Order` FROM `{$RSadapter->tbl_rsform_components}` WHERE `FormId` = '$formId' AND `Published` = 1 ORDER BY `Order`");
	while($componentRow = mysql_fetch_assoc($result))
	{
		$componentProperties=RSgetComponentProperties($componentRow['ComponentId']);
		$formComponents[$componentRow['ComponentId']] = array('ComponentName'=>$componentProperties['NAME'],'Order'=>$componentRow['Order']);
	}
	rsform_HTML::submissionsExport($option, $formId, $submissionIds, $formName, $formComponents);
}

/**
 * Submissions Export Process
 *
 * @param str $option
 */
function submissionsExportProcess($option)
{
	global $RSadapter;

	$formId = $RSadapter->getParam($_POST,'formId');
	$data = new SManager($formId,$export = 1);
	
	$data->filter = isset($_POST['filter']) ? $_POST['filter'] : '';
	
	//$data->submissionIds 		= $RSadapter->getParam($_POST,'ExportRows', 0);
	
	$data->exportHeaders		= $RSadapter->getParam($_POST,'ExportHeaders',0);
	$data->exportDelimiter		= (isset($_POST['ExportDelimiter']) ? stripslashes($_POST['ExportDelimiter']): '');
	$data->exportDelimiter		= str_replace(array('\t','\n','\r'),array("\t","\n","\r"),$data->exportDelimiter);
	$data->exportFieldEnclosure	= (isset($_POST['ExportFieldEnclosure']) ? stripslashes($_POST['ExportFieldEnclosure']) : '');
	$data->exportSubmission		= $RSadapter->getParam($_POST,'ExportSubmission');
	$data->exportOrder			= $RSadapter->getParam($_POST,'ExportOrder');
	$data->exportComponent		= $RSadapter->getParam($_POST,'ExportComponent');
	
	$output = $data->createExportFile();
}

//////////////////////////////////////// CONFIGURATION ////////////////////////////////////////
/**
 * Saves registration form
 *
 * @param str $option
 */
function saveRegistration($option)
{
	$RSadapter = $GLOBALS['RSadapter'];
	$rsformConfigPost = $RSadapter->getParam($_POST,'rsformConfig');
	if(!isset($rsformConfigPost['global.register.code']))$rsformConfigPost['global.register.code']='';
	if($rsformConfigPost['global.register.code']=='') $RSadapter->redirect(_RSFORM_BACKEND_SCRIPT_PATH.'?option='.$option,_RSFORM_BACKEND_SAVEREG_CODE);
	mysql_query("UPDATE `{$RSadapter->tbl_rsform_config}` SET SettingValue = '".RScleanVar(trim($rsformConfigPost['global.register.code']))."' WHERE SettingName = 'global.register.code'");

	$RSadapter->redirect(_RSFORM_BACKEND_SCRIPT_PATH.'?option='.$option.'&task=updates.manage',_RSFORM_BACKEND_SAVEREG_SAVED);
}

/**
 * Configuration Edit Screen
 *
 * @param str $option
 */
function configurationEdit($option)
{
	$RSadapter = $GLOBALS['RSadapter'];
	rsform_HTML::configurationEdit($option);
}

/**
 * Configuration Save process
 *
 * @param str $option
 */
function configurationSave($option)
{
	$RSadapter = $GLOBALS['RSadapter'];

	$rsformConfig = $RSadapter->getParam($_POST,'rsformConfig',array());
	$languageFile = $RSadapter->getParam($_POST,'languageFile',array());

	foreach($rsformConfig as $setting_name=>$setting_value)
		$query = mysql_query("UPDATE `{$RSadapter->tbl_rsform_config}` SET SettingValue = '".RScleanVar($setting_value)."' WHERE SettingName = '".RScleanVar($setting_name)."'");
	

	if(!empty($languageFile))
		foreach($languageFile as $file=>$content)
		{
			$filename = _RSFORM_FRONTEND_ABS_PATH.'/languages/'.$file;
			if ( $fp = fopen ($filename, 'wb') ) {
				fputs( $fp, stripslashes( $content ) );
				fclose( $fp );
			}
		}
	
	$RSadapter->redirect(_RSFORM_BACKEND_SCRIPT_PATH.'?option='.$option.'&task=configuration.edit',_RSFORM_BACKEND_CONFIGURATION_SAVED);
}


//////////////////////////////////////// MIGRATION ////////////////////////////////////////

function migrationProcess($option)
{
	$RSadapter = $GLOBALS['RSadapter'];
	if(defined('_RSFORM_PLUGIN_MIGRATION')) RSmigrationProcess();
}

function migrationScreen($option)
{
	$RSadapter = $GLOBALS['RSadapter'];
	if(defined('_RSFORM_PLUGIN_MIGRATION')) RSmigrationScreen();
}


//////////////////////////////////////// BACKUP / RESTORE ////////////////////////////////////////
/**
 * Backup / Restore Screen
 *
 * @param str $option
 */
function backupRestore($option)
{
	$RSadapter = $GLOBALS['RSadapter'];
    $rez = mysql_query("SELECT FormId, FormTitle, FormName FROM `{$RSadapter->tbl_rsform_forms}` ORDER BY FormId DESC");
	$rows = array();
	
    while($r=mysql_fetch_assoc($rez))
	{
        $r['_allSubmissions'] = @mysql_result(mysql_query("SELECT COUNT(`SubmissionId`) cnt FROM `{$RSadapter->tbl_rsform_submissions}` WHERE FormId='{$r['FormId']}'"),0);
    	$rows[] = $r;
    }
	
	rsform_HTML::backupRestore( $rows, _RSFORM_BACKEND_BACKUPRESTORE_TITLE_HEAD, $option, 'component', '', dirname(__FILE__), "");
}

/**
 * Backup Generate Process
 *
 * @param str $option
 */
function backupDownload($option)
{
    $RSadapter = $GLOBALS['RSadapter'];

	if(empty($_POST['cid']))
  		$RSadapter->redirect(_RSFORM_BACKEND_SCRIPT_PATH.'?option='.$option.'&task=backup.restore',_RSFORM_BACKEND_BACKUPRESTORE_FORMS_SELECT);
  		
    $tmpdir = uniqid('rsformbkp');
    $pathtotmpdir = $RSadapter->config['absolute_path'].'/media/'.$tmpdir.'/';
    mkdir($pathtotmpdir);
    chmod($pathtotmpdir,0777);

    require_once( $RSadapter->config['absolute_path'] . '/administrator/includes/pcl/pclzip.lib.php' );
    require_once( $RSadapter->config['absolute_path'] . '/administrator/includes/pcl/pclerror.lib.php' );

    $name = 'rsform_backup_' . date('Y-m-d_His') . '.zip';

    $files4XML = array();
    RSbackupCreateXMLfile($option, $_POST['cid'], $_POST['submissions'], $files4XML, $pathtotmpdir . '/install.xml' );

    chdir($pathtotmpdir);
    $zipfile = new PclZip( $pathtotmpdir . $name );

    $zipfile->add($pathtotmpdir.'/install.xml',
                        PCLZIP_OPT_REMOVE_PATH, $pathtotmpdir);
    /*$zipfile->add(implode(',',$files),
                        PCLZIP_OPT_ADD_PATH, 'rsads',
                        PCLZIP_OPT_REMOVE_PATH, $mosConfig_absolute_path);*/
    @$zipfile->create();

    $RSadapter->redirect( $RSadapter->config['live_site'] .'/media/'. $tmpdir .'/'. $name );
}


//////////////////////////////////////// UPDATES ////////////////////////////////////////


function updateUploadProcess( $option ) {
	$RSadapter = $GLOBALS['RSadapter'];

    // Check that the zlib is available
    if(!extension_loaded('zlib')) {
        echo "The installer can't continue before zlib is installed";
        exit() ;
    }

    $userfile = $RSadapter->getParam( $_FILES, 'userfile' );
    $filetype = $RSadapter->getParam( $_POST, 'filetype');
    $overwrite = $RSadapter->getParam( $_POST, 'overwrite');
    
    if (!$userfile) {
        echo "No file selected";
        exit();
    }

    $userfile_name = $userfile['name'];

    $msg = @constant('_RSFORM_BACKEND_UPDATECHECK_STATUS_'.strtoupper($filetype));

    $resultdir = RSuploadFile( $userfile['tmp_name'], $userfile['name'], $msg );

    $has_errors = 0;
    //check if file is a valid plugin
    if ($resultdir !== false) {
        $baseDir = $RSadapter->config['absolute_path'] . '/media/' ;

        require_once( _RSFORM_JOOMLA_XML_PATH );
        $installer = new RSinstaller();
        $installer->archivename = $userfile['name'];
        if($installer->upload($userfile['name']))
        {
        	if($installer->readInstall())
        	{
        	 	$RSinstall = $installer->xmldoc->documentElement;
				if($installer->installType!=$filetype)
					$msg = constant('_RSFORM_BACKEND_UPDATECHECK_'.strtoupper($filetype));
				else
				{
					if ($filetype == 'rsformbackup' && $overwrite == 1)
					{
						mysql_query("TRUNCATE TABLE `{$RSadapter->tbl_rsform_forms}`");
						mysql_query("TRUNCATE TABLE `{$RSadapter->tbl_rsform_components}`");
						mysql_query("TRUNCATE TABLE `{$RSadapter->tbl_rsform_properties}`");
						mysql_query("TRUNCATE TABLE `{$RSadapter->tbl_rsform_submissions}`");
						mysql_query("TRUNCATE TABLE `{$RSadapter->tbl_rsform_submission_values}`");
					}
					
					
					$tasks_node = &$RSinstall->getElementsByPath('tasks', 1);
					if (!is_null($tasks_node)) {
						$tasks = $tasks_node->childNodes;
						$has_errors = false;
						foreach($tasks as $task){
							if(RSprocessTask($option, $task, $installer->installDir)===FALSE)$has_errors = true;
						}
						//if($has_errors) die();
					}

					//clean up
					@unlink($baseDir.$userfile['name']);
					$installer->cleanup($userfile['name'], $installer->installDir);
					$msg = _RSFORM_BACKEND_UPDATECHECK_OK;
				}
        	}
			else
                $msg = _RSFORM_BACKEND_UPDATECHECK_NOINSTALL;
        }
		else
		{
            $msg = _RSFORM_BACKEND_UPDATECHECK_BADFILE;
            @unlink($baseDir.$userfile['name']);
        }
    }

    
    if(!$has_errors)
    switch($filetype)
	{
        case 'rsformbackup':
            $RSadapter->redirect(_RSFORM_BACKEND_SCRIPT_PATH.'?option='.$option.'&task=backup.restore',$msg);
        break;
        case 'rsformupdate':
            $RSadapter->redirect(_RSFORM_BACKEND_SCRIPT_PATH.'?option='.$option.'&task=updates.manage',$msg);
        break;
        case 'rsformplugin':
            $RSadapter->redirect(_RSFORM_BACKEND_SCRIPT_PATH.'?option='.$option.'&task=configuration.edit',$msg);
        break;

    }
}

function updatesManage($option){
	rsform_HTML::updatesManage($option);
}

//////////////////////////////////////// MAPPINGS ////////////////////////////////////////

function mappingsGetColumns($option)
{
	$RSadapter = $GLOBALS['RSadapter'];
	$result = '<select name="rsform_mapping_column" id="rsform_mapping_column">';
	$columns = RSgetColumns($_GET['tableName']);
	foreach ($columns as $column)
		$result.='<option value="'.$column.'">'.$column.'</option>';
	$result .= '</select>';
	
	echo $result;
}

function mappingsSaveMapping($option)
{
	$RSadapter = $GLOBALS['RSadapter'];
	$_GET['ComponentId'] = intval($_GET['ComponentId']);
	$_GET['MappingTable'] = RScleanVar($_GET['MappingTable']);
	$_GET['MappingColumn'] = RScleanVar($_GET['MappingColumn']);
	mysql_query("SELECT * FROM `".$RSadapter->tbl_rsform_mappings."` WHERE ComponentId='$_GET[ComponentId]' AND MappingTable='$_GET[MappingTable]' AND MappingColumn='$_GET[MappingColumn]'");
	if(mysql_affected_rows()!=0)
	{
		echo '1';
		return;
	}
	mysql_query("INSERT INTO `".$RSadapter->tbl_rsform_mappings."` (ComponentId, MappingTable, MappingColumn) VALUES ('$_GET[ComponentId]','$_GET[MappingTable]','$_GET[MappingColumn]')");
	$result = RSwebserviceMappingsTable($_GET['FormId']);
	
	echo $result;
}

function mappingsDeleteMapping($option)
{
	$RSadapter = $GLOBALS['RSadapter'];
	$_GET['MappingId'] = intval($_GET['MappingId']);
	
	mysql_query("DELETE FROM `".$RSadapter->tbl_rsform_mappings."` WHERE MappingId='$_GET[MappingId]'");
	$result = RSwebserviceMappingsTable($_GET['FormId']);
	
	echo $result;
}


//////////////////////////////////////// PLUGINS ////////////////////////////////////////

function pluginsRemove($option)
{
	$RSadapter = $GLOBALS['RSadapter'];
	
	$plugin = $RSadapter->getParam($_GET,'plugin',0);
	
	$bad = array('\\','/');
	$plugin = str_replace($bad,'',$plugin);
	
	if($plugin)
	{
		if(file_exists($RSadapter->config['absolute_path'].'/components/com_rsform/plugins/'.$plugin.'.php'))
		{
			unlink($RSadapter->config['absolute_path'].'/components/com_rsform/plugins/'.$plugin.'.php');
			$msg = _RSFORM_BACKEND_PLUGINS_REMOVE_OK;
		}
		else
			$msg = _RSFORM_BACKEND_PLUGINS_REMOVE_ERROR;
	}
	else 
		$msg = _RSFORM_BACKEND_PLUGINS_REMOVE_ERROR;
	
	$RSadapter->redirect(_RSFORM_BACKEND_SCRIPT_PATH.'?option='.$option.'&task=configuration.edit',$msg);
}
?>