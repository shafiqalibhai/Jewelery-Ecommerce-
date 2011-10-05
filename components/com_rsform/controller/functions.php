<?php
/**
* @version 1.2.0
* @package RSform!Pro 1.2.0
* @copyright (C) 2007-2009 www.rsjoomla.com
* @license Commercial License, http://www.rsjoomla.com/terms-and-conditions.html
*/

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

	function RSgetValidationRules()
	{
		$RSadapter=$GLOBALS['RSadapter'];
		
		$pattern = '#function (.*?)\(#i';
		$file = file_get_contents(_RSFORM_FRONTEND_ABS_PATH.'/controller/validation.php');
		preg_match_all($pattern,$file,$matches);
		
		$results = isset($matches[1]) ? $matches[1] : array();
		foreach ($results as $i => $result)
			$results[$i] = trim($result);
		
		return implode("\n",$results);
	}

	function RSisCode($value)
	{
		$RSadapter=$GLOBALS['RSadapter'];
		if (preg_match('/<code>/',$value))
			return eval($value);
		else
			return $value;
	}
	
	function RSisXMLCode($value)
	{
		$RSadapter=$GLOBALS['RSadapter'];
		if(preg_match('/{RSadapter}/',$value))
			return ($RSadapter->$value);
		else return $value;
	}

	function RSinitForm($formId)
	{
		$RSadapter=$GLOBALS['RSadapter'];
		$formId = intval($formId);
		$rez=mysql_query("SELECT `ComponentId`,`Order`,`ComponentTypeId`,`Published` FROM $RSadapter->tbl_rsform_components WHERE FormId=$formId ORDER BY `Order`");
		$i = 1;
		$j = 0;
		$returnVal='';
		while($r=mysql_fetch_assoc($rez))
		{
			$j = ($j) ? 0 : 1;
			$returnVal.='<tr class="row'.$j.'" style="height: auto">';
			$returnVal.='<td><input type="hidden" name="previewComponentId" value="'.$r['ComponentId'].'"/></td>';
			$returnVal.=RSshowSelectComponent($r['ComponentId']);
			$returnVal.=RSshowComponentName($r['ComponentId']);
			$returnVal.=RSpreviewComponent($formId,$r['ComponentId']);
			$returnVal.=RSshowEditComponentButton($r['ComponentTypeId'],$r['ComponentId']);
			$returnVal.=RSshowRemoveComponentButton($formId,$r['ComponentId']);
			$returnVal.=RSshowComponentOrdering($formId,$r['ComponentId'],$r['Order'],$i);
			$returnVal.=RSshowMoveUpComponent($formId,$r['ComponentId']);
			$returnVal.=RSshowMoveDownComponent($formId,$r['ComponentId']);
			$returnVal.=RSshowChangeStatusComponentButton($formId,$r['ComponentId'],$r['Published']);
			$returnVal.='</tr>';
			$i++;
		}
		echo $returnVal;
	}

	function RSshowSelectComponent($componentId)
	{
		return '<td><input type="checkbox" name="checks[]" value="'.$componentId.'"/></td>';
	}

	function RSshowComponentName($componentId)
	{
		$data=array();
		$data=RSgetComponentProperties($componentId);
		return '<td>'.$data['NAME'].'</td>';
	}

	//1.5 ready
	function RSgetComponentProperties($componentId)
	{
		$db = JFactory::getDBO();
		$componentId = intval($componentId);
		
		//load component properties
		$db->setQuery("SELECT PropertyName, PropertyValue FROM `#__rsform_properties` WHERE ComponentId=".$componentId);
		$rez = $db->loadObjectList();
		
		//set up data array with component properties
		$data=array();
		foreach($rez as $propertyObj)
			$data[$propertyObj->PropertyName]=$propertyObj->PropertyValue;
		
		$data['componentId'] = $componentId;
		return $data;
	}
	
	function RSpreviewComponent($formId,$componentId)
	{
		$RSadapter=$GLOBALS['RSadapter'];
		$formId = intval($formId);
		$componentId = intval($componentId);
		
		$q="select
				$RSadapter->tbl_rsform_component_types.ComponentTypeName,
				$RSadapter->tbl_rsform_properties.PropertyName,
				$RSadapter->tbl_rsform_properties.PropertyValue

				from $RSadapter->tbl_rsform_components
				left join $RSadapter->tbl_rsform_forms on $RSadapter->tbl_rsform_components.FormId=$RSadapter->tbl_rsform_forms.FormId
				left join $RSadapter->tbl_rsform_component_types on $RSadapter->tbl_rsform_components.ComponentTypeId=$RSadapter->tbl_rsform_component_types.ComponentTypeId
				left join $RSadapter->tbl_rsform_properties on $RSadapter->tbl_rsform_components.ComponentId=$RSadapter->tbl_rsform_components.ComponentId

				where $RSadapter->tbl_rsform_forms.FormId=$formId and $RSadapter->tbl_rsform_components.ComponentId=$componentId";
		$r = mysql_fetch_assoc(mysql_query($q));
		$out='';
		switch($r['ComponentTypeName'])
		{
			case 'textBox':
			{
				$data = RSgetComponentProperties($componentId);
				$defaultValue = RSisCode($data['DEFAULTVALUE']);
				
				$out.='<td>'.$data['CAPTION'].'</td>';
				$out.='<td><input type="text" value="'.$defaultValue.'" size="'.$data['SIZE'].'"/></td>';
			}
			break;
			
			case 'textArea':
			{
				$data = RSgetComponentProperties($componentId);
				$defaultValue = RSisCode($data['DEFAULTVALUE']);	
				
				$out.='<td>'.$data['CAPTION'].'</td>';
				$out.='<td><textarea cols="'.$data['COLS'].'" rows="'.$data['ROWS'].'">'.$defaultValue.'</textarea></td>';
			}
			break;
			
			case 'selectList':
			{
				$data=RSgetComponentProperties($componentId);
				
				$out.='<td>'.$data['CAPTION'].'</td>';
				$out.='<td><select '.($data['MULTIPLE']=='YES' ? 'multiple="multiple"' : '').' size="'.$data['SIZE'].'">';
				
				$aux = RSisCode($data['ITEMS']);
				
				$aux = str_replace("\r",'',$aux);
				$items = explode("\n",$aux);
				
				foreach($items as $item)
				{
					$buf=explode("|",$item);
					if(count($buf)==1)
					{
						if(preg_match('/\[c\]/',$buf[0]))
							$out.='<option selected="selected">'.str_replace('[c]','',$buf[0]).'</option>';
						else
							$out.='<option value="'.$buf[0].'">'.$buf[0].'</option>';
					}
					if(count($buf)==2)
					{
						if(preg_match('/\[c\]/',$buf[1]))
							$out.='<option selected="selected" value="'.$buf[0].'">'.str_replace('[c]','',$buf[1]).'</option>';
						else
							$out.='<option value="'.$buf[0].'">'.$buf[1].'</option>';
					}
				}
				$out.='</select></td>';
			}
			break;
			
			case 'checkboxGroup':
			{
				$i=0;
				$data=RSgetComponentProperties($componentId);
				
				$out.='<td>'.$data['CAPTION'].'</td>';
				
				$aux = RSisCode($data['ITEMS']);
				$aux=str_replace("\r",'',$aux);
				$items=explode("\n",$aux);
				
				$out.='<td>';
				foreach($items as $item)
				{
					$buf=explode("|",$item);
					if(count($buf)==1)
					{
						if(preg_match('/\[c\]/',$buf[0]))
						{
							$v=str_replace('[c]','',$buf[0]);
							$out.='<input checked="checked" type="checkbox" value="'.$v.'" name="'.$data['NAME'].'" id="'.$data['NAME'].$i.'"/><label for="'.$data['NAME'].$i.'">'.$v.'</label>';
						}
						else
							$out.='<input type="checkbox" value="'.$buf[0].'" name="'.$data['NAME'].'" id="'.$data['NAME'].$i.'"/><label for="'.$data['NAME'].$i.'">'.$buf[0].'</label>';
					}
					if(count($buf)==2)
					{
						if(preg_match('/\[c\]/',$buf[1]))
						{
							$v=str_replace('[c]','',$buf[1]);
							$out.='<input checked="checked" type="checkbox" value="'.$buf[0].'" name="'.$data['NAME'].'" id="'.$data['NAME'].$i.'"/><label for="'.$data['NAME'].$i.'">'.$v.'</label>';
						}
						else
							$out.='<input type="checkbox" value="'.$buf[0].'" name="'.$data['NAME'].'" id="'.$data['NAME'].$i.'"/><label for="'.$data['NAME'].$i.'">'.$buf[1].'</label>';

					}
					if($data['FLOW']=='VERTICAL') $out.='<br/>';
					$i++;
				}
				$out.='</td>';

			}
			break;
			
			case 'radioGroup':
			{
				$i=0;
				$data=RSgetComponentProperties($componentId);
				
				$out.='<td>'.$data['CAPTION'].'</td>';
				
				$aux = RSisCode($data['ITEMS']);
				$aux=str_replace("\r",'',$aux);
				$items=explode("\n",$aux);
				
				$out.='<td>';
				foreach($items as $item)
				{
					$buf=explode("|",$item);
					if(count($buf)==1)
					{
						if(preg_match('/\[c\]/',$buf[0]))
						{
							$v=str_replace('[c]','',$buf[0]);
							$out.='<input checked="checked" type="radio" value="'.$v.'" name="'.$data['NAME'].'" id="'.$data['NAME'].$i.'"/><label for="'.$data['NAME'].$i.'">'.$v.'</label>';
						}
						else
							$out.='<input type="radio" value="'.$buf[0].'" name="'.$data['NAME'].'" id="'.$data['NAME'].$i.'"/><label for="'.$data['NAME'].$i.'">'.$buf[0].'</label>';
					}
					if(count($buf)==2)
					{
						if(preg_match('/\[c\]/',$buf[1]))
						{
							$v=str_replace('[c]','',$buf[1]);
							$out.='<input checked="checked" type="radio" value="'.$buf[0].'" name="'.$data['NAME'].'" id="'.$data['NAME'].$i.'"/><label for="'.$data['NAME'].$i.'">'.$v.'</label>';
						}
						else
							$out.='<input type="radio" value="'.$buf[0].'" name="'.$data['NAME'].'" id="'.$data['NAME'].$i.'"/><label for="'.$data['NAME'].$i.'">'.$buf[1].'</label>';

					}
					if($data['FLOW']=='VERTICAL') $out.='<br/>';
					$i++;
				}
				$out.='</td>';

			}
			break;
			
			case 'calendar':
			{
				$data=RSgetComponentProperties($componentId);
				$out.='<td>'.$data['CAPTION'].'</td>';
				$out.='<td><img src="'.$RSadapter->config['live_site'].'/administrator/components/com_rsform/images/icons/calendar.gif" /> '.constant('_RSFORM_BACKEND_COMP_FVALUE_'.$data['CALENDARLAYOUT']).'</td>';
			}
			break;
			
			case 'button':
			{
				$data=RSgetComponentProperties($componentId);
				$out.='<td>'.$data['CAPTION'].'</td>';
				$out.='<td><input type="button" value="'.$data['LABEL'].'"/>';
				if ($data['RESET']=='YES')
					$out.='&nbsp;&nbsp;<input type="reset" value="'.$data['RESETLABEL'].'"/>';
				$out.='</td>';
			}
			break;
			
			case 'captcha':
			{
				$data=RSgetComponentProperties($componentId);
				$out.='<td>'.$data['CAPTION'].'</td>';

				$out.='<td>';
				$out.='<img src="'.str_replace('index.php','index2.php',_RSFORM_FRONTEND_SCRIPT_PATH).'?option=com_rsform&amp;task=captcha&amp;componentId='.$componentId.'" id="captcha'.$componentId.'" alt="'.$data['CAPTION'].'"/>';
				$out.=($data['FLOW']=='HORIZONTAL') ? '':'<br/>';
				$out.='<input type="text" name="form['.$data['NAME'].']" value="" id="captchaTxt'.$componentId.'" '.$data['ADDITIONALATTRIBUTES'].' />';
				$out.=($data['SHOWREFRESH']=='YES') ? '<a href="" onclick="refreshCaptcha('.$componentId.',\''.str_replace('index.php','index2.php',_RSFORM_FRONTEND_SCRIPT_PATH).'?option=com_rsform&amp;task=captcha&amp;componentId='.$componentId.'\');return false;">'.$data['REFRESHTEXT'].'</a>':'';
				$out.='</td>';
			}
			break;
			
			case 'fileUpload':
			{
				$data=RSgetComponentProperties($componentId);
				$out.='<td>'.$data['CAPTION'].'</td>';
				$out.='<td><input type="file" name="'.$data['NAME'].'"/></td>';
			}
			break;
			
			case 'freeText':
			{
				$data=RSgetComponentProperties($componentId);
				$out.='<td>&nbsp;</td>';
				$out.='<td>'.$data['TEXT'].'</td>';
			}
			break;
			
			case 'hidden':
			{
				$data=RSgetComponentProperties($componentId);
				$out.='<td>&nbsp;</td>';
				$out.='<td>{hidden field}</td>';
			}
			break;
			
			case 'imageButton':
			{
				$data = RSgetComponentProperties($componentId);
				
				$out.='<td>'.$data['CAPTION'].'</td>';
				$out.='<td>';
				$out.='<input type="image" src="'.$data['IMAGEBUTTON'].'"/>';
				if($data['RESET']=='YES')
					$out.='&nbsp;&nbsp;<input type="image" src="'.$data['IMAGERESET'].'"/>';
				$out.='</td>';
			}
			break;
			
			case 'submitButton':
			{
				$data=RSgetComponentProperties($componentId);
				
				$out.='<td>'.$data['CAPTION'].'</td>';
				$out.='<td><input type="button" value="'.$data['LABEL'].'" />';
				if($data['RESET']=='YES')
					$out.='&nbsp;&nbsp;<input type="reset" value="'.$data['RESETLABEL'].'"/>';
				$out.='</td>';
			}
			break;
			
			case 'password':
			{
				$data = RSgetComponentProperties($componentId);
				
				$out.='<td>'.$data['CAPTION'].'</td>';
				$out.='<td><input type="password" value="'.$data['DEFAULTVALUE'].'" size="'.$data['SIZE'].'"/></td>';
			}
			break;
			
			case 'ticket':
			{
				$data = RSgetComponentProperties($componentId);
				
				$out.='<td>&nbsp;</td>';
				$out.='<td>'.RSgenerateString($data['LENGTH'],$data['CHARACTERS']).'</td>';
			}
			break;
		}
		return $out;
	}

	function RSshowEditComponentButton($formId,$componentId)
	{
		return '<td><a href="#" onclick="displayTemplate('."'".$formId."','".$componentId."'".');"><img src="components/com_rsform/images/icons/edit.png" border="0" width="16" height="16" alt="Edit Component" /></a></td>';
	}
	function RSshowRemoveComponentButton($formId,$componentId)
	{
		return '<td><a href="#" onclick="removeComponent('."'".$formId."','".$componentId."'".');"><img src="components/com_rsform/images/icons/remove.png" border="0" width="12" height="12" alt="Remove Component" style="padding-left:20px;" /></a></td>';
	}
	function RSshowChangeStatusComponentButton($formId, $componentId, $published)
	{
		return '<td><a href="#" onclick="changeStatusComponent('."'".$formId."','".$componentId."'".');"><img src="components/com_rsform/images/icons/'.($published ? 'publish':'unpublish').'.png" border="0" width="12" height="12" alt="'.($published ? 'Unpublish' : 'Publish').' Component" style="padding-left:20px;" id="currentStatus'.$componentId.'" /></a></td>';
	}
	function RSshowComponentOrdering($formId,$componentId,$order,$tabIndex)
	{
		return '<td><input type="text" value="'.$order.'" size="2" name="ordering['.$componentId.']" tabindex="'.$tabIndex.'"/></td>';
	}
	function RSshowMoveUpComponent($formId,$componentId)
	{
		return '<td><a href="#" onclick="moveComponentUp('."'".$formId."','".$componentId."'".');"><img src="components/com_rsform/images/icons/uparrow.png" border="0" width="12" height="12" alt="Move Up" /></a></td>';
	}
	function RSshowMoveDownComponent($formId,$componentId)
	{
		return '<td><a href="#" onclick="moveComponentDown('."'".$formId."','".$componentId."'".');"><img src="components/com_rsform/images/icons/downarrow.png" border="0" width="12" height="12" alt="Move Down" /></a></td>';
	}
	function RSgetFormLayout($formId)
	{
		$RSadapter=$GLOBALS['RSadapter'];
		$formId = intval($formId);

		$r = mysql_fetch_assoc(mysql_query("SELECT FormLayoutAutogenerate,FormLayoutName FROM $RSadapter->tbl_rsform_forms WHERE FormId='$formId'"));
		if($r['FormLayoutAutogenerate']==1)
		{
			$layout=@include(_RSFORM_BACKEND_ABS_PATH.'/layouts/'.$r['FormLayoutName'].'.php');
			$layout=preg_replace('/1/','',$layout);
			return $layout;
		}
		else
		{
			$r=mysql_fetch_assoc(mysql_query("SELECT FormLayout FROM $RSadapter->tbl_rsform_forms WHERE FormId=$formId"));
			return $r['FormLayout'];
		}
	}
	function RSresolveComponentName($componentName,$formId)
	{
		$RSadapter=$GLOBALS['RSadapter'];
		$componentName = RScleanVar($componentName);
		$formId = intval($formId);
		
		$q="select $RSadapter->tbl_rsform_properties.ComponentId
		from $RSadapter->tbl_rsform_properties
		join $RSadapter->tbl_rsform_components on $RSadapter->tbl_rsform_components.ComponentId=$RSadapter->tbl_rsform_properties.ComponentId
		where $RSadapter->tbl_rsform_properties.PropertyValue='$componentName' and $RSadapter->tbl_rsform_properties.PropertyName='NAME' and $RSadapter->tbl_rsform_components.FormId='$formId'";
		return @mysql_result(mysql_query($q),0);
	}
	function RSfrontComponentCaption($componentId)
	{
		$RSadapter=$GLOBALS['RSadapter'];
		$componentId = intval($componentId);
		
		return @mysql_result(mysql_query("SELECT PropertyValue FROM $RSadapter->tbl_rsform_properties WHERE ComponentId='$componentId' AND PropertyName='CAPTION'"),0);
	}
	function RSfrontComponentDescription($componentId)
	{
		$RSadapter=$GLOBALS['RSadapter'];
		$componentId = intval($componentId);
		
		return @mysql_result(mysql_query("SELECT PropertyValue FROM $RSadapter->tbl_rsform_properties WHERE ComponentId='$componentId' AND PropertyName='DESCRIPTION'"),0);
	}
	function RSfrontComponentValidationMessage($componentId,$value='')
	{
		$RSadapter=$GLOBALS['RSadapter'];
		$componentId = intval($componentId);
		
		$msg = @mysql_result(mysql_query("SELECT PropertyValue FROM $RSadapter->tbl_rsform_properties WHERE ComponentId='$componentId' AND PropertyName='VALIDATIONMESSAGE'"),0);
		
		if(!empty($value) && in_array($componentId,$value,false)==true)
			return '<span id="component'.$componentId.'" class="formError">'.$msg.'</span>';
		else
			return '<span id="component'.$componentId.'" class="formNoError">'.$msg.'</span>';
	}
	function RSfrontLayout($formId, $formLayout)
	{
		$RSadapter=$GLOBALS['RSadapter'];
		$formId = intval($formId);
		//get form title
		$formTitle = @mysql_result(mysql_query("SELECT FormTitle FROM $RSadapter->tbl_rsform_forms WHERE FormId='$formId'"),0);		
		$result = str_replace('{global:formtitle}',$formTitle, $formLayout);
		
		return $result;
	}
	function RSfrontComponentBody($formId,$componentId,$value='')
	{
		$RSadapter=$GLOBALS['RSadapter'];
		$formId = intval($formId);
		$componentId = intval($componentId);
		
		if(is_array($value))
			foreach($value as $key=>$vl)
			{
				if(is_array($vl) && !empty($vl))
					foreach($vl as $k_vl=>$v_vl)
						$value[$key][$k_vl] = RSstripVar($value[$key][$k_vl]);
				else
					$value[$key] = RSstripVar($value[$key]);
			}
		
		$q="
			select

				$RSadapter->tbl_rsform_properties.PropertyName,
				$RSadapter->tbl_rsform_properties.PropertyValue,
				$RSadapter->tbl_rsform_components.ComponentTypeId,
				$RSadapter->tbl_rsform_components.Order

				from $RSadapter->tbl_rsform_components

				left join $RSadapter->tbl_rsform_properties on $RSadapter->tbl_rsform_properties.ComponentId=$RSadapter->tbl_rsform_components.ComponentId

				where $RSadapter->tbl_rsform_components.FormId=$formId and $RSadapter->tbl_rsform_components.ComponentId=$componentId
		";

		$r=mysql_fetch_assoc(mysql_query($q));
		$out='';
		
		$data = RSgetComponentProperties($componentId);
		switch(RSresolveComponentTypeId($r['ComponentTypeId']))
		{
			case 'textBox':
			{
				$defaultValue = RSisCode($data['DEFAULTVALUE']);
				$out .= '<input type="text" value="'.(!empty($value) ? RSshowVar($value[$data['NAME']]) : $defaultValue).'" size="'.$data['SIZE'].'" '.($data['MAXSIZE'] > 0 ? 'maxlength="'.$data['MAXSIZE'].'"' : '').' name="form['.$data['NAME'].']" id="'.$data['NAME'].'" '.$data['ADDITIONALATTRIBUTES'].'/>';
			}
			break;

			case 'textArea':
			{
				$defaultValue = RSisCode($data['DEFAULTVALUE']);
				if ($data['WYSIWYG'] == 'YES')
					$out .= $RSadapter->WYSIWYG('form['.$data['NAME'].']', (!empty($value) ? RSshowVar($value[$data['NAME']]) : $defaultValue), 'id['.$data['NAME'].']', $data['COLS']*10, $data['ROWS']*10, $data['COLS'], $data['ROWS']);
				else
					$out .= '<textarea cols="'.$data['COLS'].'" rows="'.$data['ROWS'].'" name="form['.$data['NAME'].']" id="'.$data['NAME'].'" '.$data['ADDITIONALATTRIBUTES'].'>'.(!empty($value) ? RSshowVar($value[$data['NAME']]) : $defaultValue).'</textarea>';
			}
			break;

			case 'selectList':
			{
				$out .= '<select '.($data['MULTIPLE']=='YES' ? 'multiple="multiple"' : '').' name="form['.$data['NAME'].'][]" '.($data['SIZE'] > 0 ? 'size="'.$data['SIZE'].'"' : '').' id="'.$data['NAME'].'" '.$data['ADDITIONALATTRIBUTES'].' >';
				$aux = RSisCode($data['ITEMS']);
				$aux = str_replace("\r","",$aux);
				$items = explode("\n",$aux);
				foreach($items as $item)
				{
					$buf = explode('|',$item);
					
					$option_value = $buf[0];
					$option_value_trimmed = str_replace('[c]','',$option_value);
					$option_shown = count($buf) == 1 ? $buf[0] : $buf[1];
					$option_shown_trimmed = str_replace('[c]','',$option_shown);
					
					$option_checked = false;
					if (empty($value) && preg_match('/\[c\]/',$option_shown))
						$option_checked = true;
					if (!empty($value[$data['NAME']]) && array_search($option_value_trimmed,$value[$data['NAME']]) !== false)
						$option_checked = true;
					
					$out .= '<option '.($option_checked ? 'selected="selected"' : '').' value="'.$option_value_trimmed.'">'.$option_shown_trimmed.'</option>';
				}
				$out .= '</select>';
			}
			break;
			
			case 'checkboxGroup':
			{
				$i=0;
				$aux = RSisCode($data['ITEMS']);
				$aux = str_replace("\r","",$aux);
				$items = explode("\n",$aux);
				foreach($items as $item)
				{
					$buf = explode('|',$item);
					
					$option_value = $buf[0];
					$option_value_trimmed = str_replace('[c]','',$option_value);
					$option_shown = count($buf) == 1 ? $buf[0] : $buf[1];
					$option_shown_trimmed = str_replace('[c]','',$option_shown);
					
					$option_checked = false;
					if (empty($value) && preg_match('/\[c\]/',$option_shown))
						$option_checked = true;
					if (!empty($value[$data['NAME']]) && array_search($option_value_trimmed,$value[$data['NAME']]) !== false)
						$option_checked = true;
						
					$out .= '<input '.($option_checked ? 'checked="checked"' : '').' name="form['.$data['NAME'].'][]" type="checkbox" value="'.$option_value_trimmed.'" id="'.$data['NAME'].$i.'" '.$data['ADDITIONALATTRIBUTES'].' /><label for="'.$data['NAME'].$i.'">'.$option_shown_trimmed.'</label>';
					
					if($data['FLOW']=='VERTICAL') $out.='<br/>';
					$i++;
				}

			}
			break;
			
			case 'radioGroup':
			{
				$i=0;
				$aux = RSisCode($data['ITEMS']);
				$aux = str_replace("\r","",$aux);
				$items = explode("\n",$aux);
				foreach($items as $item)
				{
					$buf = explode('|',$item);
					
					$option_value = $buf[0];
					$option_value_trimmed = str_replace('[c]','',$option_value);
					$option_shown = count($buf) == 1 ? $buf[0] : $buf[1];
					$option_shown_trimmed = str_replace('[c]','',$option_shown);
					
					$option_checked = false;
					if (empty($value) && preg_match('/\[c\]/',$option_shown))
						$option_checked = true;
					if (!empty($value[$data['NAME']]) && $value[$data['NAME']] == $option_value_trimmed)
						$option_checked = true;
					
					$out .= '<input '.($option_checked ? 'checked="checked"' : '').' name="form['.$data['NAME'].']" type="radio" value="'.$option_value_trimmed.'" id="'.$data['NAME'].$i.'" '.$data['ADDITIONALATTRIBUTES'].' /><label for="'.$data['NAME'].$i.'">'.$option_shown_trimmed.'</label>';
					
					if($data['FLOW']=='VERTICAL') $out.='<br/>';
					$i++;
				}

			}
			break;
			
			case 'calendar':
			{
				$calendars = RScomponentExists($formId, 6);
				$calendars = array_flip($calendars);
				$def_cal_val = (empty($value) ? '':$value[$data['NAME']]);

				switch($data['CALENDARLAYOUT'])
				{
					case 'FLAT':
						$out.='<input id="txtcal'.$calendars[$componentId].'" name="form['.$data['NAME'].']" type="text" '.($data['READONLY'] == 'YES' ? 'readonly="readonly"' : '').' class="txtCal" value="'.$def_cal_val.'" '.$data['ADDITIONALATTRIBUTES'].'/><br/>
							<div id="cal'.$calendars[$componentId].'Container" style="z-index:'.(9999-$r['Order']).'"></div>';
					break;

					case 'POPUP':
						$out .= '<input id="txtcal'.$calendars[$componentId].'" name="form['.$data['NAME'].']" type="text" '.($data['READONLY'] == 'YES' ? 'readonly="readonly"' : '').'  value="'.$def_cal_val.'" '.$data['ADDITIONALATTRIBUTES'].'/>
							<input id="btn'.$calendars[$componentId].'" type="button" value="'.$data['POPUPLABEL'].'" onclick="showHideCalendar(\'cal'.$calendars[$componentId].'Container\');" class="btnCal" '.$data['ADDITIONALATTRIBUTES'].' />
							<div id="cal'.$calendars[$componentId].'Container" style="clear:both;display:none;position:absolute;z-index:'.(9999-$r['Order']).'"></div>';
					break;
				}

			}
			break;
			
			case 'button':
			{
				$out .= '<input type="button" value="'.$data['LABEL'].'" name="form['.$data['NAME'].']" id="'.$data['NAME'].'" '.$data['ADDITIONALATTRIBUTES'].' />';
				if ($data['RESET']=='YES')
					$out .= '&nbsp;&nbsp;<input type="reset" value="'.$data['RESETLABEL'].'" name="form['.$data['NAME'].']" id="'.$data['NAME'].'" '.$data['ADDITIONALATTRIBUTES'].' />';
			}
			break;
			
			case 'captcha':
			{
				$out .= '<img src="'.str_replace('index.php','index2.php',_RSFORM_FRONTEND_SCRIPT_PATH).'?option=com_rsform&amp;task=captcha&amp;componentId='.$componentId.'" id="captcha'.$componentId.'" alt="'.$data['CAPTION'].'"/>';
				$out .= ($data['FLOW']=='HORIZONTAL') ? '':'<br/>';
				$out .= '<input type="text" name="form['.$data['NAME'].']" value="" id="captchaTxt'.$componentId.'" '.$data['ADDITIONALATTRIBUTES'].' />';
				$out .= ($data['SHOWREFRESH']=='YES') ? '<a href="javascript:void(0)" onclick="refreshCaptcha('.$componentId.',\''.str_replace('index.php','index2.php',_RSFORM_FRONTEND_SCRIPT_PATH).'?option=com_rsform&amp;task=captcha&amp;componentId='.$componentId.'\');return false;">'.$data['REFRESHTEXT'].'</a>':'';
			}
			break;
			
			case 'fileUpload':
			{
				$out .= '<input type="hidden" name="MAX_FILE_SIZE" value="'.$data['FILESIZE'].'000" />';
				$out .= '<input type="file" name="form['.$data['NAME'].']" id="'.$data['NAME'].'" '.$data['ADDITIONALATTRIBUTES'].' />';
			}
			break;
			
			case 'freeText':
			{
				$out .= $data['TEXT'];
			}
			break;
			
			case 'hidden':
			{
				$defaultValue = RSisCode($data['DEFAULTVALUE']);
				$out .= '<input type="hidden" name="form['.$data['NAME'].']" id="'.$data['NAME'].'" value="'.$defaultValue.'" '.$data['ADDITIONALATTRIBUTES'].' />';
			}
			break;
			
			case 'imageButton':
			{
				$out .= '<input type="image" src="'.$data['IMAGEBUTTON'].'" name="form['.$data['NAME'].']" id="'.$data['NAME'].'" '.$data['ADDITIONALATTRIBUTES'].' />';
				if ($data['RESET']=='YES')
					$out .= '<input type="reset" name="" id="reset_'.$data['NAME'].'" style="display: none !important" />&nbsp;&nbsp;<input onclick="document.getElementById(\'reset_'.$data['NAME'].'\').click();return false;" type="image" src="'.$data['IMAGERESET'].'" name="form['.$data['NAME'].']" '.$data['ADDITIONALATTRIBUTES'].' />';
			}
			break;
			
			case 'submitButton':
			{
				$out .= '<input type="submit" value="'.$data['LABEL'].'" name="form['.$data['NAME'].']" id="'.$data['NAME'].'" '.$data['ADDITIONALATTRIBUTES'].' />';
				if ($data['RESET']=='YES')
					$out .= '&nbsp;&nbsp;<input type="reset" value="'.$data['RESETLABEL'].'" name="form['.$data['NAME'].']" '.$data['ADDITIONALATTRIBUTES'].' />';
			}
			break;
			
			case 'password':
			{
				$out .= '<input type="password" value="'.$data['DEFAULTVALUE'].'" size="'.$data['SIZE'].'" name="form['.$data['NAME'].']" id="'.$data['NAME'].'" '.($data['MAXSIZE'] > 0 ? 'maxlength="'.$data['MAXSIZE'].'"' : '').' '.$data['ADDITIONALATTRIBUTES'].' />';
			}
			break;
			
			case 'ticket':
			{
				$out .= '<input type="hidden" name="form['.$data['NAME'].']" value="'.RSgenerateString($data['LENGTH'],$data['CHARACTERS']).'" '.$data['ADDITIONALATTRIBUTES'].' />';
			}
			break;
		}
		return $out;
	}

	function RSshowForm($formId,$val='',$validation='')
	{
		$RSadapter=$GLOBALS['RSadapter'];
		if(!isset($GLOBALS['ismodule'])) $GLOBALS['ismodule'] = 'head';
		$RSadapter->addHeadTag( _RSFORM_FRONTEND_REL_PATH . '/controller/functions.js','js', $GLOBALS['ismodule'] );
		$RSadapter->addHeadTag( _RSFORM_FRONTEND_REL_PATH . '/front.css','css', $GLOBALS['ismodule'] );
		//add the head tags for the calendar
		$calendars = RScomponentExists($formId, 6);//6 is the componentTypeId for calendar
		if(!empty($calendars))
		{
			foreach($calendars as $i=>$calendarComponentId)
			{
				$data = RSgetComponentProperties($calendarComponentId);
				$calendars['CALENDARLAYOUT'][$i] = $data['CALENDARLAYOUT'];
				$calendars['DATEFORMAT'][$i] = $data['DATEFORMAT'];
				if(!empty($_POST))
				{
					if ($_POST['form'][$data['NAME']]!='')
						$calendars['VALUES'][$i] = $_POST['form'][$data['NAME']];// date('m/d/Y',strtotime($_POST['form'][$data['NAME']]));
					else
						$calendars['VALUES'][$i] = '';
				}else
					$calendars['VALUES'][$i] = '';
			}
			$calendarsLayout = "'".implode("','", $calendars['CALENDARLAYOUT'])."'";
			$calendarsFormat = "'".implode("','", $calendars['DATEFORMAT'])."'";
			$calendarsValues = "'".implode("','", $calendars['VALUES'])."'";
			//check if it's a module
			//$RSadapter->addHeadTag( _RSFORM_FRONTEND_REL_PATH . '/calendar/cal.js','js',$GLOBALS['ismodule'] );
			$RSadapter->addHeadTag( _RSFORM_FRONTEND_REL_PATH . "/calendar/calendar.css",'css',$GLOBALS['ismodule'] );
			//$RSadapter->addHeadTag( _RSFORM_FRONTEND_SCRIPT_PATH.'?option=com_rsform&amp;task=showJs','js', $GLOBALS['ismodule'] );
			$calSetup = '';
		}
		
		$formId = intval($formId);
		$r=mysql_fetch_assoc(mysql_query("SELECT FormLayout, ScriptDisplay FROM $RSadapter->tbl_rsform_forms WHERE FormId='$formId' AND `Published`='1'"));
		
		if(!isset($r['FormLayout'])) return 'No formId';
		
		$scriptDisplay = $r['ScriptDisplay'];
		$formLayout = $r['FormLayout'];

		$find=array();
		$replace=array();

		$q="select
			$RSadapter->tbl_rsform_properties.PropertyValue,
			$RSadapter->tbl_rsform_components.ComponentId
		 from $RSadapter->tbl_rsform_properties
		join $RSadapter->tbl_rsform_components on `$RSadapter->tbl_rsform_components`.ComponentId=`$RSadapter->tbl_rsform_properties`.ComponentId
		where $RSadapter->tbl_rsform_components.FormId='$formId' and $RSadapter->tbl_rsform_properties.PropertyName='NAME'
		and $RSadapter->tbl_rsform_components.Published='1'
		";
		
		$rez=mysql_query($q) or die(mysql_error());
		
		//Caption
		while($r=mysql_fetch_assoc($rez))
		{
			$find[] = '{'.$r['PropertyValue'].':caption}';
			$replace[] = RSfrontComponentCaption(RSresolveComponentName($r['PropertyValue'],$formId));
		}

		//Body
		if(mysql_num_rows($rez))
		{
			mysql_data_seek($rez,0);
			while($r=mysql_fetch_assoc($rez))
			{
				$find[] = '{'.$r['PropertyValue'].':body}';
				$replace[] = RSfrontComponentBody($formId,RSresolveComponentName($r['PropertyValue'],$formId),$val);
			}
	
			//Description
			mysql_data_seek($rez,0);
			while($r=mysql_fetch_assoc($rez))
			{
				$find[] = '{'.$r['PropertyValue'].':description}';
				$replace[] = RSfrontComponentDescription(RSresolveComponentName($r['PropertyValue'],$formId));
			}
			
			mysql_data_seek($rez,0);
			//Validation rules hidden
			while($r=mysql_fetch_assoc($rez))
			{
				$find[] = '{'.$r['PropertyValue'].':validation}';
				$replace[] = RSfrontComponentValidationMessage(RSresolveComponentName($r['PropertyValue'],$formId),$validation);
			}
		}
		
		$u = JFactory::getURI();
		$u = JRoute::_($u->toString());
		
		$formLayout = str_replace($find,$replace,$formLayout);
		$formLayout = RSfrontLayout($formId, $formLayout);
		$formLayout.= '<input type="hidden" name="form[formId]" value="'.$formId.'"/>';
		$formLayout = '<form method="post" id="userForm" enctype="multipart/form-data" action="'.$u.'">'.$formLayout.'</form>';
		if(!empty($calendars))
		{
			$formLayout .= '
			<script type="text/javascript" src="'._RSFORM_FRONTEND_REL_PATH.'/calendar/cal.js"></script>
			<script type="text/javascript">'._RSFORM_FRONTEND_CALENDARJS.'</script>
			<script type="text/javascript" defer="defer">rsf_CALENDAR.util.Event.addListener(window, "load", init(Array('.$calendarsLayout.'),Array('.$calendarsFormat.'),Array('.$calendarsValues.')));</script>' ;
		}
		
		eval($scriptDisplay);
		return $formLayout;
	}

	function RSshowThankyouMessage($formId)
	{
		$RSadapter=$GLOBALS['RSadapter'];
		$output = '';

		//check return url
		$formId = intval($formId);
		$returnUrl = mysql_result(mysql_query("SELECT ReturnUrl FROM `{$RSadapter->tbl_rsform_forms}` WHERE `formId` = '$formId'"),0);
		
		if(!isset($_SESSION['form'][$formId]['submissionId']))$_SESSION['form'][$formId]['submissionId'] = '';
		$returnUrl = RSprocessField($returnUrl,$_SESSION['form'][$formId]['submissionId']);
		
		if(!empty($returnUrl))
			$goto = "document.location='".$returnUrl."';";
		else
			$goto = 'document.location.reload();';

		$output .= base64_decode($_SESSION['form'][$formId]['thankYouMessage']).sprintf(_RSFORM_FRONTEND_THANKYOU_BUTTON,$goto);
		unset($_SESSION['form'][$formId]['thankYouMessage']);

		return $output;
	}

	function RSprocessForm($formId)
	{
		$RSadapter=$GLOBALS['RSadapter'];
		$user = $RSadapter->user();
		$formId = intval($formId);
		$_POST['form']['formId'] = intval($_POST['form']['formId']);
		$r=mysql_fetch_assoc(mysql_query("SELECT ScriptProcess, ScriptProcess2 FROM `{$RSadapter->tbl_rsform_forms}` WHERE FormId={$_POST['form']['formId']}"));
		
		$ScriptProcess = $r['ScriptProcess'];
		$ScriptProcess2 = $r['ScriptProcess2'];
		
		$invalid=array();
		$invalid=RSvalidateForm($_POST['form']['formId']);

		if(!empty($invalid)) return $invalid;//showForm($formId,$_POST['form'],$invalid);
		
		
		$userEmail=array(
			'to'=>'',
			'cc'=>'',
			'bcc'=>'',
			'from'=>'',
			'replyto'=>'',
			'fromName'=>'',
			'text'=>'',
			'subject'=>'',
			'files' =>array()
			);
		$adminEmail=array(
			'to'=>'',
			'cc'=>'',
			'bcc'=>'',
			'from'=>'',
			'replyto'=>'',
			'fromName'=>'',
			'text'=>'',
			'subject'=>'',
			'files' =>array()
			);
			
		eval($ScriptProcess);
		
		if(empty($invalid))
		{
			$db='';
			$dest=array();
			$tmp_name=array();
			$name=array();
			$fieldName=array();
			$user['username'] = RScleanVar($user['username']);
			$user['id'] = intval($user['id']);
			mysql_query("INSERT INTO `{$RSadapter->tbl_rsform_submissions}` (`FormId`, `DateSubmitted`, `UserIp`, `Username`, `UserId`) VALUES ('{$_POST['form']['formId']}',now(),'{$_SERVER['REMOTE_ADDR']}','{$user['username']}','{$user['id']}')") or die(mysql_error());
			$SubmissionId = mysql_insert_id();
			if(isset($_FILES['form']['tmp_name']) && is_array($_FILES['form']['tmp_name']))
			{
				foreach($_FILES['form']['name'] as $key=>$val)
					if(!empty($_FILES['form']['name'][$key]))
					{
						$dest[] = RSgetFileDestination($key,$_POST['form']['formId']);
						$name[] = $val;
						$fieldName[] = $key;
					}

				foreach($_FILES['form']['tmp_name'] as $key=>$val)
					if(!empty($_FILES['form']['name'][$key]))
						$tmp_name[] = $val;

				
				for($i=0;$i<count($dest);$i++)
					if(isset($tmp_name[$i]))
					{
						$fieldName[$i] = RScleanVar($fieldName[$i]);
						
						$prop = RSgetComponentProperties(RSresolveComponentName($fieldName[$i],$formId));
						$timestamp = uniqid('');
						move_uploaded_file($tmp_name[$i],$dest[$i].$timestamp.'-'.$name[$i]);
						@chmod($dest[$i].$timestamp.'-'.$name[$i],0644);
						$db = $dest[$i].$timestamp.'-'.$name[$i];
						//$db = RScleanVar($db);
						$db = mysql_real_escape_string($db);
						if ($prop['ATTACHUSEREMAIL']=='YES')
							$userEmail['files'][] = $db;
						if ($prop['ATTACHADMINEMAIL']=='YES')
							$adminEmail['files'][] = $db;

						mysql_query("INSERT INTO `{$RSadapter->tbl_rsform_submission_values}` (`SubmissionId`, `FormId`, `FieldName`, `FieldValue`) VALUES ('{$SubmissionId}','{$_POST['form']['formId']}','$fieldName[$i]','$db')");
					}
			}

			foreach ($_POST['form'] as $key=>$val)
			{
				$val = (is_array($val) ? implode("\n",$val) : $val);
				$key = RScleanVar($key);
				$val = RScleanVar(RSstripjavaVar($val));
				mysql_query("INSERT INTO `{$RSadapter->tbl_rsform_submission_values}` (`SubmissionId`, `FormId`, `FieldName`, `FieldValue`) VALUES ('{$SubmissionId}','{$_POST['form']['formId']}','".$key."','".$val."')");
			}
			if(defined('_RSFORM_PLUGIN_MAPPINGS')) RSmappingsWriteSubmissions($formId, $SubmissionId);
			//die();				

	
			$r=mysql_fetch_assoc(mysql_query("SELECT * FROM `{$RSadapter->tbl_rsform_forms}` WHERE FormId={$_POST['form']['formId']}"));
			$userEmail['to']=RSprocessField($r['UserEmailTo'],$SubmissionId);
			$userEmail['cc']=RSprocessField($r['UserEmailCC'],$SubmissionId);
			$userEmail['bcc']=RSprocessField($r['UserEmailBCC'],$SubmissionId);
			$userEmail['subject']=RSprocessField($r['UserEmailSubject'],$SubmissionId);
			$userEmail['from']=RSprocessField($r['UserEmailFrom'],$SubmissionId);
			$userEmail['replyto']=RSprocessField($r['UserEmailReplyTo'],$SubmissionId);
			$userEmail['fromName']=RSprocessField($r['UserEmailFromName'],$SubmissionId);
			$userEmail['text']=RSprocessField($r['UserEmailText'],$SubmissionId);
			$userEmail['mode']=$r['UserEmailMode'];

			$adminEmail['to']=RSprocessField($r['AdminEmailTo'],$SubmissionId);
			$adminEmail['cc']=RSprocessField($r['AdminEmailCC'],$SubmissionId);
			$adminEmail['bcc']=RSprocessField($r['AdminEmailBCC'],$SubmissionId);
			$adminEmail['subject']=RSprocessField($r['AdminEmailSubject'],$SubmissionId);
			$adminEmail['from']=RSprocessField($r['AdminEmailFrom'],$SubmissionId);
			$adminEmail['replyto']=RSprocessField($r['AdminEmailReplyTo'],$SubmissionId);
			$adminEmail['fromName']=RSprocessField($r['AdminEmailFromName'],$SubmissionId);
			$adminEmail['text']=RSprocessField($r['AdminEmailText'],$SubmissionId);
			$adminEmail['mode']=$r['AdminEmailMode'];

			//mail users
			$recipients = explode(',',$userEmail['to']);
			
			if ($r['UserEmailAttach'] && file_exists($r['UserEmailAttachFile']))
				$userEmail['files'][] = $r['UserEmailAttachFile'];
			
			if(!empty($recipients))
				foreach($recipients as $recipient)
					if(!empty($recipient))
						$RSadapter->mail($userEmail['from'], $userEmail['fromName'], $recipient, $userEmail['subject'], $userEmail['text'], $userEmail['mode'], !empty($userEmail['cc']) ? $userEmail['cc'] : null, !empty($userEmail['bcc']) ? $userEmail['bcc'] : null, $userEmail['files'], !empty($userEmail['replyto']) ? $userEmail['replyto'] : '');
						
			//mail admins
			$recipients = explode(',',$adminEmail['to']);
			if(!empty($recipients))
				foreach($recipients as $recipient)
					if(!empty($recipient))
						$RSadapter->mail($adminEmail['from'], $adminEmail['fromName'], $recipient, $adminEmail['subject'], $adminEmail['text'], $adminEmail['mode'], !empty($adminEmail['cc']) ? $adminEmail['cc'] : null, !empty($adminEmail['bcc']) ? $adminEmail['bcc'] : null, $adminEmail['files'], !empty($adminEmail['replyto']) ? $adminEmail['replyto'] : '');
			
			$thankYouMessage = RSprocessField($r['Thankyou'],$SubmissionId);			
			
			eval($ScriptProcess2);
			
			// SESSION quick hack - we base64 encode it here and decode it when we show it
			$_SESSION['form'][$formId]['thankYouMessage'] = base64_encode($thankYouMessage);
			$_SESSION['form'][$formId]['submissionId'] = $SubmissionId;
			
			$RSadapter->redirect(JRequest::getURI());

		}

		return false;
	}

	function RSgetSubmissionValue($SubmissionId, $ComponentId)
	{
		$RSadapter=$GLOBALS['RSadapter'];
		$data = RSgetComponentProperties($ComponentId);
		
		$FieldValue = @mysql_result(mysql_query("SELECT FieldValue FROM `".$RSadapter->tbl_rsform_submission_values."` WHERE FieldName = '".$data['NAME']."' AND SubmissionId = '".$SubmissionId."'"),0);
		
		return $FieldValue;
	}
	
	function RScleanVar($string,$html=false)
	{
		$string = $html ? htmlentities($string,ENT_COMPAT,'UTF-8') : $string;
		$string = get_magic_quotes_gpc() ? mysql_real_escape_string(stripslashes($string)) : mysql_real_escape_string($string);
		return $string;
	}
	
	function RSshowVar($string)
	{
		return htmlspecialchars($string);
	}
	
	function RSstripVar($string)
	{
		$string = get_magic_quotes_gpc() ? stripslashes($string) : $string;
		return $string;
	}
	
	function RSstripjavaVar($val)
	{
	   // remove all non-printable characters. CR(0a) and LF(0b) and TAB(9) are allowed
	   // this prevents some character re-spacing such as <java\0script>
	   // note that you have to handle splits with \n, \r, and \t later since they *are* allowed in some inputs
	   $val = preg_replace('/([\x00-\x08][\x0b-\x0c][\x0e-\x20])/', '', $val);

	   // straight replacements, the user should never need these since they're normal characters
	   // this prevents like <IMG SRC=&#X40&#X61&#X76&#X61&#X73&#X63&#X72&#X69&#X70&#X74&#X3A&#X61&#X6C&#X65&#X72&#X74&#X28&#X27&#X58&#X53&#X53&#X27&#X29>
	   $search = 'abcdefghijklmnopqrstuvwxyz';
	   $search .= 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
	   $search .= '1234567890!@#$%^&*()';
	   $search .= '~`";:?+/={}[]-_|\'\\';
	   for ($i = 0; $i < strlen($search); $i++) {
	      // ;? matches the ;, which is optional
	      // 0{0,7} matches any padded zeros, which are optional and go up to 8 chars

	      // &#x0040 @ search for the hex values
	      $val = preg_replace('/(&#[x|X]0{0,8}'.dechex(ord($search[$i])).';?)/i', $search[$i], $val); // with a ;
	      // &#00064 @ 0{0,7} matches '0' zero to seven times
	      $val = preg_replace('/(&#0{0,8}'.ord($search[$i]).';?)/', $search[$i], $val); // with a ;
	   }

	   // now the only remaining whitespace attacks are \t, \n, and \r
	   $ra1 = Array('javascript', 'vbscript', 'expression', 'applet', 'meta', 'xml', 'blink', 'link', 'style', 'script', 'embed', 'object', 'iframe', 'frame', 'frameset', 'ilayer', 'layer', 'bgsound', 'title', 'base');
	   $ra2 = Array('onabort', 'onactivate', 'onafterprint', 'onafterupdate', 'onbeforeactivate', 'onbeforecopy', 'onbeforecut', 'onbeforedeactivate', 'onbeforeeditfocus', 'onbeforepaste', 'onbeforeprint', 'onbeforeunload', 'onbeforeupdate', 'onblur', 'onbounce', 'oncellchange', 'onchange', 'onclick', 'oncontextmenu', 'oncontrolselect', 'oncopy', 'oncut', 'ondataavailable', 'ondatasetchanged', 'ondatasetcomplete', 'ondblclick', 'ondeactivate', 'ondrag', 'ondragend', 'ondragenter', 'ondragleave', 'ondragover', 'ondragstart', 'ondrop', 'onerror', 'onerrorupdate', 'onfilterchange', 'onfinish', 'onfocus', 'onfocusin', 'onfocusout', 'onhelp', 'onkeydown', 'onkeypress', 'onkeyup', 'onlayoutcomplete', 'onload', 'onlosecapture', 'onmousedown', 'onmouseenter', 'onmouseleave', 'onmousemove', 'onmouseout', 'onmouseover', 'onmouseup', 'onmousewheel', 'onmove', 'onmoveend', 'onmovestart', 'onpaste', 'onpropertychange', 'onreadystatechange', 'onreset', 'onresize', 'onresizeend', 'onresizestart', 'onrowenter', 'onrowexit', 'onrowsdelete', 'onrowsinserted', 'onscroll', 'onselect', 'onselectionchange', 'onselectstart', 'onstart', 'onstop', 'onsubmit', 'onunload');
	   $ra = array_merge($ra1, $ra2);

	   $found = true; // keep replacing as long as the previous round replaced something
	   while ($found == true) {
	      $val_before = $val;
	      for ($i = 0; $i < sizeof($ra); $i++) {
	         $pattern = '/';
	         for ($j = 0; $j < strlen($ra[$i]); $j++) {
	            if ($j > 0) {
	               $pattern .= '(';
	               $pattern .= '(&#[x|X]0{0,8}([9][a][b]);?)?';
	               $pattern .= '|(&#0{0,8}([9][10][13]);?)?';
	               $pattern .= ')?';
	            }
	            $pattern .= $ra[$i][$j];
	         }
	         $pattern .= '/i';
	         $replacement = substr($ra[$i], 0, 2).'<x>'.substr($ra[$i], 2); // add in <> to nerf the tag
	         $val = preg_replace($pattern, $replacement, $val); // filter out the hex tags
	         if ($val_before == $val) {
	            // no replacements were made, so exit the loop
	            $found = false;
	         }
	      }
	   }
	   return $val;
	}
	
	function RSgetValidationRule($componentId)
	{
		$RSadapter=$GLOBALS['RSadapter'];
		$componentId = intval($componentId);
		
		$q="
		SELECT
			$RSadapter->tbl_rsform_properties.PropertyValue
		FROM $RSadapter->tbl_rsform_properties
		join $RSadapter->tbl_rsform_components on $RSadapter->tbl_rsform_properties.ComponentId=$RSadapter->tbl_rsform_components.ComponentId
		where $RSadapter->tbl_rsform_properties.PropertyName='VALIDATIONRULE' and $RSadapter->tbl_rsform_properties.ComponentId='$componentId';
		";
		$r = @mysql_result(mysql_query($q),0);
		if(!empty($r)) return $r;
	}

	function RSgetRequired($value,$formId)
	{
		$RSadapter=$GLOBALS['RSadapter'];

		$formId = intval($formId);
		$componentId=RSresolveComponentName($value,$formId);
		$q="
		SELECT
			$RSadapter->tbl_rsform_properties.PropertyValue
		FROM $RSadapter->tbl_rsform_properties
		join $RSadapter->tbl_rsform_components on $RSadapter->tbl_rsform_properties.ComponentId=$RSadapter->tbl_rsform_components.ComponentId
		where $RSadapter->tbl_rsform_components.FormId='$formId' and $RSadapter->tbl_rsform_properties.PropertyName='REQUIRED' and $RSadapter->tbl_rsform_properties.ComponentId='$componentId';
		";
		$r = @mysql_result(mysql_query($q),0);
		if(!empty($r)) return $r;
	}
	function RSvalidateForm($formId)
	{
		$RSadapter=$GLOBALS['RSadapter'];
		$formId = intval($formId);
		
		$invalid=array();
		$rez=mysql_query("SELECT ComponentId FROM $RSadapter->tbl_rsform_components WHERE FormId='$formId' AND Published=1");
		while($r=mysql_fetch_assoc($rez))
		{
			$data=RSgetComponentProperties($r['ComponentId']);
			$required=RSgetRequired($data['NAME'],$formId);
			$validationRule=RSgetValidationRule($r['ComponentId']);

			if (RSgetComponentTypeId($r['ComponentId'])==8 && (empty($_POST['form'][$data['NAME']]) || empty($_SESSION['CAPTCHA'.$r['ComponentId']]) || $_POST['form'][$data['NAME']]!=$_SESSION['CAPTCHA'.$r['ComponentId']]))
				$invalid[] = $data['componentId'];
			
			if(RSgetComponentTypeId($r['ComponentId'])==9)
			{
				// File has been *sent* to the server
				if (isset($_FILES['form']['tmp_name'][$data['NAME']]) && $_FILES['form']['error'][$data['NAME']] != 4)
				{
					// File has been uploaded correctly to the server
					if($_FILES['form']['error'][$data['NAME']] == 0)
					{
						// Let's check if the extension is allowed
						$buf = explode('.',$_FILES['form']['name'][$data['NAME']]);
						$m = '#'.$buf[count($buf)-1].'#';
						if (!empty($data['ACCEPTEDFILES']) && !preg_match(strtolower($m),strtolower($data['ACCEPTEDFILES'])))
							$invalid[] = $data['componentId'];
						// Let's check if it's the correct size
						if ($_FILES['form']['size'][$data['NAME']] > 0 && $data['FILESIZE'] > 0 && $_FILES['form']['size'][$data['NAME']] > $data['FILESIZE']*1024)
							$invalid[] = $data['componentId'];
					}
					// File has not been uploaded correctly - next version we'll trigger some messages based on the error code
					else
						$invalid[] = $data['componentId'];
				}
				// File has not been sent but it's required
				elseif($data['REQUIRED']=='YES')
					$invalid[] = $data['componentId'];
				
				continue;
			}
			
			if ($required == 'YES')
			{
				if(!isset($_POST['form'][$data['NAME']]))
				{
					$invalid[] = $data['componentId'];
					continue;
				}
				if (!is_array($_POST['form'][$data['NAME']]) && strlen(trim($_POST['form'][$data['NAME']])) == 0)
				{
					$invalid[] = $data['componentId'];
					continue;
				}
				if (!is_array($_POST['form'][$data['NAME']]) && strlen(trim($_POST['form'][$data['NAME']])) > 0 && is_callable($validationRule) && call_user_func($validationRule,$_POST['form'][$data['NAME']]) == false)
				{
					$invalid[] = $data['componentId'];
					continue;
				}
				if (is_array($_POST['form'][$data['NAME']]))
				{
					$valid=implode('',$_POST['form'][$data['NAME']]);
					if(empty($valid))
					{
						$invalid[] = $data['componentId'];
						continue;
					}
				}
			}
			else
			{
				if (isset($_POST['form'][$data['NAME']]) && !is_array($_POST['form'][$data['NAME']]) && strlen(trim($_POST['form'][$data['NAME']])) > 0 && is_callable($validationRule) && call_user_func($validationRule,$_POST['form'][$data['NAME']]) == false)
				{
					$invalid[] = $data['componentId'];
					continue;
				}
			}
		}
		return $invalid;
	}

	function RSgetComponentTypeId($componentId)
	{
		$RSadapter=$GLOBALS['RSadapter'];
		$componentId = intval($componentId);
		
		return @mysql_result(mysql_query("SELECT ComponentTypeId FROM $RSadapter->tbl_rsform_components WHERE ComponentId='$componentId'"),0);
	}
	function RSresolveComponentTypeId($componentTypeId)
	{
		$RSadapter=$GLOBALS['RSadapter'];
		$componentTypeId = intval($componentTypeId);
		
		return @mysql_result(mysql_query("SELECT ComponentTypeName FROM $RSadapter->tbl_rsform_component_types WHERE ComponentTypeId='$componentTypeId'"),0);
	}
	function RSgetComponentTypeIdByName($componentName,$formId)
	{
		$RSadapter=$GLOBALS['RSadapter'];
		$componentName = mysql_real_escape_string($componentName);
		$q="
		select $RSadapter->tbl_rsform_components.ComponentTypeId
		from $RSadapter->tbl_rsform_components
		left join $RSadapter->tbl_rsform_properties on $RSadapter->tbl_rsform_properties.ComponentId=$RSadapter->tbl_rsform_components.ComponentId
		where $RSadapter->tbl_rsform_properties.PropertyName='NAME' and $RSadapter->tbl_rsform_properties.PropertyValue='$componentName' and $RSadapter->tbl_rsform_components.FormId='$formId';
		";
		return @mysql_result(mysql_query($q),0);
	}

	function RSgetFileDestination($componentName,$formId)
	{
		$RSadapter=$GLOBALS['RSadapter'];
		$componentId=RSresolveComponentName($componentName,$formId);
		
		return @mysql_result(mysql_query("SELECT PropertyValue FROM $RSadapter->tbl_rsform_properties WHERE PropertyName='DESTINATION' AND ComponentId='$componentId'"),0);
	}
	function RScomponentExists($formId,$componentTypeId)
	{
		$RSadapter=$GLOBALS['RSadapter'];
		$formId = intval($formId);
		$componentTypeId = intval($componentTypeId);
		
		$rez=mysql_query("SELECT ComponentId FROM $RSadapter->tbl_rsform_components WHERE ComponentTypeId='$componentTypeId' AND FormId='$formId' AND Published='1'");
		$output=array();
		while($r=mysql_fetch_assoc($rez))
			$output[] = $r['ComponentId'];
		
		return $output;
	}

	function RSgenerateString($length, $characters, $type='Random')
	{
		if($type == 'Random')
		{
			switch($characters)
			{
				case 'ALPHANUMERIC':
				default:
			  		$possible = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
				break;
				case 'ALPHA':
					$possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
				break;
				case 'NUMERIC':
					$possible = "0123456789";
				break;
			}

			if($length<1||$length>255) $length = 8;
			  $key = "";
			  $i = 0;
			  while ($i < $length) {
			    $key .= substr($possible, mt_rand(0, strlen($possible)-1), 1);
			    $i++;
			  }
		}
		if($type == 'Sequential')
		{

		}
		return $key;
	}

	function RSprocessField($result,$submissionId)
	{
		$db = JFactory::getDBO();
		$RSadapter=$GLOBALS['RSadapter'];
		$submissionId = intval($submissionId);
		
		
		//get submission details
		$Submission = RSgetSubmission($submissionId);
		
		//initialize placeholder and value arrays
		$placeholders = array();
		$values = array();
		
		//load form components
		$db->setQuery("SELECT ComponentId FROM #__rsform_components WHERE FormId = '".$Submission->FormId."' AND Published = 1");
		$ComponentRows = $db->loadObjectList();
		
		foreach($ComponentRows as $ComponentRow)
		{
			$properties = RSgetComponentProperties($ComponentRow->ComponentId);

			//{component:caption}
			$placeholders[] = '{'.$properties['NAME'].':caption'.'}';
			$values[] = isset($properties['CAPTION']) ? $properties['CAPTION'] : '';
			
			//{component:name}
			$placeholders[] = '{'.$properties['NAME'].':name'.'}';
			$values[] = $properties['NAME'];
			
			//{component:value}
			$placeholders[] = '{'.$properties['NAME'].':value'.'}';
			$properties['NAME'] = mysql_real_escape_string($properties['NAME']);
			$SubmissionValue = '';
			if(!empty($Submission->values))
				foreach($Submission->values as $SubmissionValueObj)
					if($SubmissionValueObj->FieldName == $properties['NAME'])
						$SubmissionValue = $SubmissionValueObj->FieldValue;
						
			if ($SubmissionValue !== '' && RSgetComponentTypeId($ComponentRow->ComponentId)==9) $SubmissionValue = basename($SubmissionValue);
			$values[] = $SubmissionValue;
		}
		
		$user = $RSadapter->user($Submission->UserId);
		array_push($placeholders, '{global:username}', '{global:userid}', '{global:useremail}', '{global:fullname}', '{global:userip}', '{global:date_added}', '{global:sitename}', '{global:siteurl}');
		array_push($values, $user['username'], $user['id'], $user['email'], $user['fullname'], $_SERVER['REMOTE_ADDR'], $Submission->DateSubmitted, $RSadapter->config['sitename'], $RSadapter->config['live_site']);
		
		$result = str_replace($placeholders,$values,$result);

		return $result;
	}
	
	function RSgetSubmission($SubmissionId)
	{
		$db = JFactory::getDBO();
		
		//get submission 
		$db->setQuery("SELECT * FROM #__rsform_submissions WHERE SubmissionId = '".$SubmissionId."'");
		$Submission = $db->loadObject();
		
		//get submission details
		$db->setQuery("SELECT * FROM #__rsform_submission_values WHERE SubmissionId = '".$SubmissionId."'");
		$Submission->values = $db->loadObjectList();
		
		return $Submission;
	}

	function RSgetFormLayoutName($formId)
	{
		$RSadapter=$GLOBALS['RSadapter'];
		$formId = intval($formId);
		
		return @mysql_result(mysql_query("SELECT FormLayoutName FROM $RSadapter->tbl_rsform_forms WHERE FormId='$formId'"),0);
	}

	function RSreturnCheckedLayoutName($formId,$layoutName)
	{
		$RSadapter=$GLOBALS['RSadapter'];
		$formId = intval($formId);
		
		if(@mysql_result(mysql_query("SELECT FormLayoutName FROM $RSadapter->tbl_rsform_forms WHERE FormId='$formId'"),0) == $layoutName) echo 'checked';
	}

	function RScopyForm($formId)
	{
		$RSadapter=$GLOBALS['RSadapter'];
		$formId = intval($formId);
		$q="insert into $RSadapter->tbl_rsform_forms
		(`FormName`,`FormLayout`,`FormLayoutName`,`FormLayoutAutogenerate`,`FormTitle`,`Published`,`Lang`,`ReturnUrl`,`Thankyou`,`UserEmailText`,`UserEmailTo`,`UserEmailCC`,`UserEmailBCC`,`UserEmailFrom`,`UserEmailReplyTo`,`UserEmailFromName`,`UserEmailSubject`,`UserEmailMode`,`UserEmailAttach`,`UserEmailAttachFile`,`AdminEmailText`,`AdminEmailTo`,`AdminEmailCC`,`AdminEmailBCC`,`AdminEmailFrom`,`AdminEmailReplyTo`,`AdminEmailFromName`,`AdminEmailSubject`,`AdminEmailMode`,`ScriptProcess`,`ScriptProcess2`,`ScriptDisplay`)
		select
		`FormName`,`FormLayout`,`FormLayoutName`,`FormLayoutAutogenerate`,`FormTitle`,`Published`,`Lang`,`ReturnUrl`,`Thankyou`,`UserEmailText`,`UserEmailTo`,`UserEmailCC`,`UserEmailBCC`,`UserEmailFrom`,`UserEmailReplyTo`,`UserEmailFromName`,`UserEmailSubject`,`UserEmailMode`,`UserEmailAttach`,`UserEmailAttachFile`,`AdminEmailText`,`AdminEmailTo`,`AdminEmailCC`,`AdminEmailBCC`,`AdminEmailFrom`,`AdminEmailReplyTo`,`AdminEmailFromName`,`AdminEmailSubject`,`AdminEmailMode`,`ScriptProcess`,`ScriptProcess2`,`ScriptDisplay`

		from $RSadapter->tbl_rsform_forms where $RSadapter->tbl_rsform_forms.FormId='$formId'";
		mysql_query($q) or die(mysql_error()."<br/>$q");
		$newFormId=mysql_insert_id();

		mysql_query("UPDATE $RSadapter->tbl_rsform_forms SET FormName=CONCAT(FormName,' copy'),FormTitle=CONCAT(FormTitle,' copy') WHERE FormId='$newFormId'");

		$rez=mysql_query("SELECT * FROM $RSadapter->tbl_rsform_components WHERE FormId='$formId'");
		while($r=mysql_fetch_assoc($rez))
		{
			$componentId=$r['ComponentId'];
			mysql_query("INSERT INTO $RSadapter->tbl_rsform_components (FormId,ComponentTypeId,`Order`) VALUES ('$newFormId','{$r['ComponentTypeId']}','{$r['Order']}')");
			$newComponentId=mysql_insert_id();

			$rez2=mysql_query("SELECT * FROM $RSadapter->tbl_rsform_properties WHERE ComponentId='$componentId'");
			while($r2=mysql_fetch_assoc($rez2))
				mysql_query("INSERT INTO $RSadapter->tbl_rsform_properties (PropertyName,PropertyValue,ComponentId) VALUES ('".mysql_real_escape_string($r2[PropertyName])."','".mysql_real_escape_string($r2[PropertyValue])."','$newComponentId')");
		}
	}

	function RScopyComponent($sourceComponentId,$destinationFormId)
	{
		$RSadapter=$GLOBALS['RSadapter'];
		$sourceComponentId = intval($sourceComponentId);
		$destinationFormId = intval($destinationFormId);
		
		$r=mysql_fetch_assoc(mysql_query("SELECT * FROM $RSadapter->tbl_rsform_components WHERE ComponentId='$sourceComponentId'"));
		
		//get max ordering
		$r['Order'] = @mysql_result(mysql_query("SELECT max(`Order`)+1 FROM `".$RSadapter->tbl_rsform_components."` WHERE FormId = '".$destinationFormId."'"),0);
		
		mysql_query("INSERT INTO $RSadapter->tbl_rsform_components (`FormId`,`ComponentTypeId`,`Order`,`Published`) VALUES ('$destinationFormId','$r[ComponentTypeId]','$r[Order]','$r[Published]')");
		$newComponentId=mysql_insert_id();

		$rez=mysql_query("SELECT * FROM $RSadapter->tbl_rsform_properties WHERE ComponentId='$sourceComponentId'");
		while($r=mysql_fetch_assoc($rez))
		{
			if($r['PropertyName'] == 'NAME') $r['PropertyValue'] .= ' copy';
			mysql_query("INSERT INTO $RSadapter->tbl_rsform_properties (ComponentId,PropertyName,PropertyValue) values ('$newComponentId','$r[PropertyName]','".mysql_real_escape_string($r[PropertyValue])."')");
		}
	}

	function RSlistComponents($formId)
	{
		$RSadapter=$GLOBALS['RSadapter'];
		$formId = intval($formId);
		
		$components=array();
		$q="select $RSadapter->tbl_rsform_properties.PropertyValue

		from $RSadapter->tbl_rsform_properties

		left join $RSadapter->tbl_rsform_components on $RSadapter->tbl_rsform_components.ComponentId=$RSadapter->tbl_rsform_properties.ComponentId

		where
			$RSadapter->tbl_rsform_components.FormId='$formId' and
			$RSadapter->tbl_rsform_components.Published='1' and
			$RSadapter->tbl_rsform_properties.PropertyName='NAME'
		order by
			$RSadapter->tbl_rsform_components.`Order`;
		";
		$rez=mysql_query($q) or die(mysql_error());
		while($r=mysql_fetch_assoc($rez))
			$components[] = $r['PropertyValue'];
		
		return $components;
	}


function RSbackupCreateXMLfile($option, $formIds, $submissions, $files, $filename)
{
	$db = &JFactory::getDBO();
	$RSadapter=$GLOBALS['RSadapter'];
	$user = $RSadapter->user();

    //create the xml file
$xml =
'<?xml version="1.0" encoding="utf-8"?>
<RSinstall type="rsformbackup">
<name>RSform backup</name>
<creationDate></creationDate>
<author></author>
<copyright></copyright>
<authorEmail></authorEmail>
<authorUrl></authorUrl>
<version>'._RSFORM_VERSION.'</version>
<description>RSform Backup</description>
<tasks></tasks>
</RSinstall>';
    $xml = str_replace('<creationDate></creationDate>','<creationDate>'.date('Y-m-d').'</creationDate>',$xml);
    $xml = str_replace('<author></author>','<author>'.$user['username'].'</author>',$xml);
    $xml = str_replace('<copyright></copyright>','<copyright> (C) '.date('Y').' '.$RSadapter->config['live_site'].'</copyright>',$xml);
    $xml = str_replace('<authorEmail></authorEmail>','<authorEmail>'.$RSadapter->config['mail_from'].'</authorEmail>',$xml);
    $xml = str_replace('<authorUrl></authorUrl>','<authorUrl>'.$RSadapter->config['live_site'].'</authorUrl>',$xml);

    $tasks = array();
    /*
    $tasks[] = "\t".'<task type="query">'."TRUNCATE TABLE `{$RSadapter->tbl_rsform_components}`".'</task>';
    $tasks[] = "\t".'<task type="query">'."TRUNCATE TABLE `{$RSadapter->tbl_rsform_component_types}`".'</task>';
    $tasks[] = "\t".'<task type="query">'."TRUNCATE TABLE `{$RSadapter->tbl_rsform_component_type_fields}`".'</task>';
    $tasks[] = "\t".'<task type="query">'."TRUNCATE TABLE `{$RSadapter->tbl_rsform_config}`".'</task>';
    $tasks[] = "\t".'<task type="query">'."TRUNCATE TABLE `{$RSadapter->tbl_rsform_forms}`".'</task>';
    $tasks[] = "\t".'<task type="query">'."TRUNCATE TABLE `{$RSadapter->tbl_rsform_properties}`".'</task>';
    $tasks[] = "\t".'<task type="query">'."TRUNCATE TABLE `{$RSadapter->tbl_rsform_submissions}`".'</task>';
    $tasks[] = "\t".'<task type="query">'."TRUNCATE TABLE `{$RSadapter->tbl_rsform_submission_values}`".'</task>';
    
    if(defined('_RSFORM_PLUGIN_MAPPINGS')) $tasks[] = "\t".'<task type="query">'."TRUNCATE TABLE `{$RSadapter->tbl_rsform_mappings}`".'</task>';
	*/
    /*
    //LOAD COMPONENT_TYPES
    $query = mysql_query("SELECT * FROM `$RSadapter->tbl_rsform_component_types`");
    while($component_row = mysql_fetch_array($query,MYSQL_ASSOC))
    {
         $tasks[] = RSxmlReturnQuery($RSadapter->tbl_rsform_component_types,$component_row);
    }
    //LOAD COMPONENT_TYPE_FIELDS
    $query = mysql_query("SELECT * FROM `{$RSadapter->tbl_rsform_component_type_fields}`");
    while($component_row = mysql_fetch_array($query,MYSQL_ASSOC))
    {
         $tasks[] = RSxmlReturnQuery($RSadapter->tbl_rsform_component_type_fields,$component_row);
    }
    //LOAD CONFIG
    $query = mysql_query("SELECT * FROM `$RSadapter->tbl_rsform_config`");
    while($component_row = mysql_fetch_array($query,MYSQL_ASSOC))
    {
         $tasks[] = RSxmlReturnQuery($RSadapter->tbl_rsform_config,$component_row);
    }
    */
    //LOAD FORMS
    
    $db->setQuery("SELECT * FROM `{$RSadapter->tbl_rsform_forms}` WHERE FormId IN ('".implode("','",$formIds)."') ORDER BY FormId");
    $form_rows = $db->loadObjectList();
    foreach($form_rows as $form_row)
    {
         $tasks[] = RSxmlReturnQuery($RSadapter->tbl_rsform_forms,$form_row,'FormId');
         $tasks[] = '<task type="eval" source="">$GLOBALS[\'q_FormId\'] = mysql_insert_id();</task>';
         
         //LOAD COMPONENTS
	    $db->setQuery("SELECT * FROM `$RSadapter->tbl_rsform_components` WHERE FormId = '".$form_row->FormId."'");
	    $component_rows = $db->loadObjectList();
	    foreach($component_rows as $component_row)
	    {
	         $tasks[] = RSxmlReturnQuery($RSadapter->tbl_rsform_components,$component_row,'ComponentId','FormId');
	         $tasks[] = '<task type="eval" source="">$GLOBALS[\'q_ComponentId\'] = mysql_insert_id();</task>';
	         
	             //LOAD PROPERTIES
			    $db->setQuery("SELECT * FROM `{$RSadapter->tbl_rsform_properties}` WHERE ComponentId = '".$component_row->ComponentId."'");
			    $property_rows = $db->loadObjectList();
			    foreach($property_rows as $property_row)
			    {
			         $tasks[] = RSxmlReturnQuery($RSadapter->tbl_rsform_properties,$property_row,'PropertyId','ComponentId');
			    }
	    }
	    
	    
	    if($submissions)
		{
		    //LOAD SUBMISSIONS
		    $db->setQuery("SELECT * FROM `{$RSadapter->tbl_rsform_submissions}` WHERE FormId = '".$form_row->FormId."'");
		    $submission_rows = $db->loadObjectList();
		    foreach($submission_rows as $submission_row)
		    {
				$tasks[] = RSxmlReturnQuery($RSadapter->tbl_rsform_submissions,$submission_row,'SubmissionId','FormId');
				$tasks[] = '<task type="eval" source="">$GLOBALS[\'q_SubmissionId\'] = mysql_insert_id();</task>';
 
				//LOAD SUBMISSION_VALUES
				$db->setQuery("SELECT * FROM `{$RSadapter->tbl_rsform_submission_values}` WHERE SubmissionId = '".$submission_row->SubmissionId."'");
				$submission_value_rows = $db->loadObjectList();
				foreach($submission_value_rows as $submission_value_row)
			    {
			         $tasks[] = RSxmlReturnQuery($RSadapter->tbl_rsform_submission_values,$submission_value_row,'SubmissionValueId','SubmissionId');
			         echo '<p>'.RSxmlReturnQuery($RSadapter->tbl_rsform_submission_values,$submission_value_row,'SubmissionValueId','SubmissionId').'</p>';
			         
			    }
			   // die();
			    
		    }
		}
    }
    
    
    
/*
    if(defined('_RSFORM_PLUGIN_MAPPINGS'))
    {
	    //LOAD MAPPINGS
	    $query = mysql_query("SELECT * FROM `{$RSadapter->tbl_rsform_mappings}`");
	    while($component_row = mysql_fetch_array($query,MYSQL_ASSOC))
	    {
	         $tasks[] = RSxmlReturnQuery($RSadapter->tbl_rsform_mappings,$component_row);
	    }
    }
*/
    $task_html = implode("\r\n",$tasks);
    $xml = str_replace('<tasks></tasks>','<tasks>'."\r\n".$task_html."\r\n".'</tasks>',$xml);

    //echo $xml;die();
    //write the file
    //touch($filename);
    if (!$handle = fopen($filename, 'w')) exit;
    if (fwrite($handle, $xml) === FALSE) exit;
    fclose($handle);
}



function RSxmlReturnQuery($tb_name, $row, $exclude = null, $dynamic = null)
{

    $fields = array();
    $values = array();

    foreach($row as $k=>$v) {
        $fields[] = '`' . $k . '`';
        if($k == $exclude) $v = "";
        if($k == $dynamic) $v = "{".$dynamic."}";
        $values[] = "'" . mysql_real_escape_string($v) . "'";
    }

    $xml = 'INSERT INTO `' . $tb_name . '` (' . implode(',',$fields) . ') VALUES (' . implode(',',$values) . ' )';
    //$xml = str_replace("\r",'',$xml);
    //$xml = str_replace("\n",'\\n',$xml);

    return "\t".'<task type="query"><![CDATA['.$xml.']]></task>';
}

function RSxmlentities($string, $quote_style=ENT_QUOTES)
{
    static $trans;
    if (!isset($trans)) {
        $trans = get_html_translation_table(HTML_ENTITIES, $quote_style);
        foreach ($trans as $key => $value)
            $trans[$key] = '&#'.ord($key).';';
        // dont translate the '&' in case it is part of &xxx;
        //$trans[chr(38)] = '&';
    }
    // after the initial translation, _do_ map standalone '&' into '&#38;'
    return preg_replace("/&(?![A-Za-z]{0,4}\w{2,3};|#[0-9]{2,3};)/","&#38;" , strtr($string, $trans));
}/*
function RSxmlentities ( $string, $null )
{
    return str_replace ( array ( '&', '"', "'", '<', '>' ), array ( '&amp;' , '&quot;', '&apos;' , '&lt;' , '&gt;' ), $string );
}
*/
function RSRmkdir($path)
{
    $exp=explode("/",$path);
    $way='';
    foreach($exp as $n){
        $way.=$n.'/';
        if(!file_exists($way))
            @mkdir($way);
    }
}

function RSuploadFile( $filename, $userfile_name, &$msg )
{
    $RSadapter=$GLOBALS['RSadapter'];
    $baseDir = $RSadapter->processPath( $RSadapter->config['absolute_path'] . '/media' );

    if (file_exists( $baseDir )) {
        if (is_writable( $baseDir )) {
            if (move_uploaded_file( $filename, $baseDir . $userfile_name )) {
            	$RSadapter->chmod( $baseDir . $userfile_name );
            	return true;/*
                if () {

                } else {
                    $msg = 'Failed to change the permissions of the uploaded file.';
                }*/
            } else {
                $msg = 'Failed to move uploaded file to <code>/media</code> directory.';
            }
        } else {
            $msg = 'Upload failed as <code>/media</code> directory is not writable.';
        }
    } else {
        $msg = 'Upload failed as <code>/media</code> directory does not exist.'.$baseDir;
    }
    return false;
}


function RSprocessTask($option, $task, $uploaddir){
    //$type,$value,$dest
    $RSadapter=$GLOBALS['RSadapter'];

    $type    	= $task->getAttribute('type');
    $source    	= $task->getAttribute('source');
    $value   	= $task->getText();
    
    //$source 	= eval('return "'.$source.'";');
    //$value	= eval('return "'.$value.'";');
     
    switch ($type){
        case 'mkdir':
            RSRmkdir($RSadapter->config['absolute_path'].$value);
            //echo 'MKDIR OK '.$value;
            return true;
        break;
        case 'query':
        	$value = str_replace('{PREFIX}',$RSadapter->config['dbprefix'], $value);
        	if(isset($GLOBALS['q_FormId'])) $value = str_replace('{FormId}',$GLOBALS['q_FormId'], $value);
        	if(isset($GLOBALS['q_ComponentId'])) $value = str_replace('{ComponentId}',$GLOBALS['q_ComponentId'], $value);
        	if(isset($GLOBALS['q_SubmissionId'])) $value = str_replace('{SubmissionId}',$GLOBALS['q_SubmissionId'], $value);
			// Little hack to rename all uppercase tables to new lowercase format
			preg_match('/INSERT INTO `'.$RSadapter->config['dbprefix'].'(\w+)`/',$value,$matches);
			if (count($matches) > 0 && isset($matches[1]))
				$value = str_replace($matches[1],strtolower($matches[1]),$value);
			// End of hack
        	if(mysql_query(html_entity_decode($value)))
        	{
                return true;
            }else{
                echo 'QUERY ERROR '.$value."<br/>";
                return false;
            }

        break;
        case 'copy':
            if($value!=''){

                $rfile = @fopen ($uploaddir.$source, "r");
                if (!$rfile) {
                    echo 'FOPEN ERROR '.$uploaddir.$source.". Make sure the file exists.<br/>";
                    return false;
                }else{
                    $filecontents = @fread($rfile, filesize($uploaddir.$source));
                    $filename = $RSadapter->config['absolute_path'].'/'.$value;

                    //check if folder exists, else mkdir it.
                    $path = str_replace('\\','/',$filename);
                    $path = explode('/',$path);
                    unset($path[count($path)-1]);
                    $path = implode('/',$path);
                    if(!is_dir($path)) RSRmkdir($path);
					@chmod($path,0777);
                    if (!$handle = @fopen($filename, 'w')) {
                        echo 'FWRITE OPEN ERROR '.$filename.". Make sure there are write permissions (777)<br/>";
                        return false;
                        // exit;
                    }

                    // Write $filecontents to our opened file.
                    if (fwrite($handle, $filecontents) === FALSE) {
                        echo 'FWRITE ERROR '.$filename.". Make sure there are write permissions (777)<br/>";
                        return false;
                    }
                    //echo 'COPY OK '.$value;
                    return true;

                    fclose($handle);
                }
            }
        break;
        case 'rename':
        	if($value!=''){
        		$oldfile = $uploaddir.$source;
        		$newfile = $RSadapter->config['absolute_path'].'/'.$value;
        		$rename = @rename($oldfile,$newfile);
        		if(!$rename){
        			 echo 'RENAME ERROR '.$newfile."<br/>";
                     return false;
        		}
        	}
        break;
        case 'eval':
        	eval($value);
        	return true;
        break;
        case 'delete':
            $filename = $RSadapter->config['absolute_path'].$value;
            if(file_exists($filename)){
                if(is_dir($filename)){
                    rmdir($filename);
                }else{
                    unlink($filename);
                }
                //echo 'DELETE OK '.$value;
                return true;
            }else{
                echo 'DELETE ERROR '.$value."<br/>";
                return false;
            }
        break;

    }
}


function RSparse_mysql_dump($file)
{
	$RSadapter=$GLOBALS['RSadapter'];
	$message = '';

	$file_content = file($file);
	foreach($file_content as $sql_line)
	{
		if(trim($sql_line) != "" && strpos($sql_line, "--") === false)
		{
			$sql_line = str_replace('{PREFIX}',$RSadapter->config['dbprefix'], $sql_line);
	   		mysql_query($sql_line) or $message .= '<pre>'.$sql_line.mysql_error().'</pre><br/>';
	 	}
	}

	if($message == '') return 'ok';
	else return $message;
}


//PLUGINS
function RSmappingsBuyWriteTab()
{
	$RSadapter=$GLOBALS['RSadapter'];
	?>
      <tr>
          	<td valign="top" align="left" colspan="3">
          		<?php echo _RSFORM_BACKEND_FORMS_EDIT_MAPPINGS_BUY_DESC;?>
			</td>
		</tr>
    <?php
}


?>