<?php
/**
* @version 1.2.0
* @package RSform!Pro 1.2.0
* @copyright (C) 2007-2009 www.rsjoomla.com
* @license Commercial License, http://www.rsjoomla.com/terms-and-conditions.html
*/

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );


	// Select components
	$q="SELECT {$RSadapter->tbl_rsform_properties}.PropertyValue, {$RSadapter->tbl_rsform_components}.ComponentId FROM {$RSadapter->tbl_rsform_components} LEFT JOIN {$RSadapter->tbl_rsform_properties} ON {$RSadapter->tbl_rsform_properties}.ComponentId={$RSadapter->tbl_rsform_components}.ComponentId	WHERE {$RSadapter->tbl_rsform_components}.FormId=$formId AND {$RSadapter->tbl_rsform_properties}.PropertyName='NAME' AND {$RSadapter->tbl_rsform_components}.Published=1 ORDER BY {$RSadapter->tbl_rsform_components}.Order";
	$rez=mysql_query($q) or die(mysql_error());
	
	// Start layout generation
	$out='';
	$out.='<fieldset class="formFieldset">'."\n";
	$out.='<legend>{global:formtitle}</legend>'."\n";
	$out.='<ol class="formContainer">'."\n";
	while($r=mysql_fetch_assoc($rez))
	{
		//build validation message
		$componentProperties=RSgetComponentProperties($r['ComponentId']);
		$out.="\t".'<li>'."\n";
		
		$out.= "\t\t".'<div class="formCaption">{'.$r['PropertyValue'].':caption}'.((array_key_exists('REQUIRED',$componentProperties) && $componentProperties['REQUIRED']=='YES') ? '<strong class="formRequired">(*)</strong>' : '' ).'</div>'."\n";
		$out.= "\t\t".'<div class="formBody">{'.$r['PropertyValue'].':body}<span class="formClr">{'.$r['PropertyValue'].':validation}</span></div>'."\n";
		$out.= "\t\t".'<div class="formDescription">{'.$r['PropertyValue'].':description}</div>'."\n";
		
		$out.="\t".'</li>'."\n";
	}
	$out.='</ol>'."\n";
	$out.='</fieldset>'."\n";
	// End layout generation
	
	// Clean it
	$cleanout = RScleanVar($out);
	// Update the layout
	mysql_query("UPDATE {$RSadapter->tbl_rsform_forms} SET FormLayout='$cleanout' WHERE FormId=$formId");

	echo $out;
?>