<?php
/**
*	RecommendFriends Component for Joomla! - for Site Promotion
*
* @version $Id: recommendfriends.php - v2.0.3 - January-06-2009 - D-Mack Media
* @package Joomla
* @subpackage RecommendFriends
* @copyright (c) 2007-2010 D-Mack Media, dmackmedia.com
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
*
* This is free software
**/
?>

<script type="text/javascript">
<!--

///////////////////////////// Email Validation Scripts //////////////////////////////

//Change the Enter Key from submitting the form to just tabbing between fields
function handleEnter (field, event) {
		var keyCode = event.keyCode ? event.keyCode : event.which ? event.which : event.charCode;
		if (keyCode == 13) {
			var i;
			for (i = 0; i < field.form.elements.length; i++)
				if (field == field.form.elements[i])
					break;
			i = (i + 1) % field.form.elements.length;
			field.form.elements[i].focus();
			return false;
		}
		else
		return true;
}
//Check if the required filed(s) are empty
function isEmpty( str ){
    strRE = new RegExp( );
    strRE.compile( '^[\s ]*$', 'gi' );
    return strRE.test( str.value );
}
//Email address validity check
function notValidEmail( str ){
    mailRE = new RegExp( );
    mailRE.compile( '^[\._a-z0-9-]+@[\.a-z0-9-]+[\.]{1}[a-z]{2,4}$', 'gi' );
    return !(mailRE.test( str.value ));
}
//Visual cues for users on error fields - highlight/field focus
function highlight(field) {
  var bgcolor = '<?php echo $dm_errorbg; ?>';
  var txcolor = '<?php echo $dm_errortx; ?>';
  if ( bgcolor != '') {
    field.style.backgroundColor='<?php echo $dm_errorbg; ?>';
  }
  if ( txcolor != '') {
   field.style.color='<?php echo $dm_errortx; ?>';
  }
  field.focus();
}
function highlight2 (field) {
  var bgcolor = '<?php echo $dm_errorbg; ?>';
  var txcolor = '<?php echo $dm_errortx; ?>';
  if ( bgcolor != '') {
    field.style.backgroundColor='<?php echo $dm_formbg; ?>';
  }
  if ( txcolor != '') {
  field.style.color='<?php echo $dm_formtx; ?>';
  }
}
//Check email fields for the required field(s) only - for Logged in users
function recommendvalidate(){
	if (isEmpty (document.recommend.recommend_to_email0)) {
    highlight  (document.forms.recommend.recommend_to_email0);
		alert('<?php echo _DM_ALERT_TO_EMAIL_EMPTY; ?>');
		return false;
	} else if (notValidEmail (document.recommend.recommend_to_email0)) {
    highlight  (document.forms.recommend.recommend_to_email0);
		alert('<?php echo _DM_ALERT_TO_EMAIL_INVALID; ?>' + '\n' + '<?php echo _DM_ALERT_MULTIPLE_EMAIL; ?>');
		return false;
	} else {
		return true;
	}
}
//Check email fields for the required field(s) only - for Public Users (not Logged in)
function recommendvalidateall(){
	if (isEmpty (document.recommend.recommend_from_email)) {
    highlight (document.forms.recommend.recommend_from_email);
		alert('<?php echo _DM_ALERT_FROM_EMAIL_EMPTY; ?>');
		return false;
	} else if (isEmpty (document.recommend.recommend_to_email0)) {
    highlight2 (document.forms.recommend.recommend_from_email);
    highlight  (document.forms.recommend.recommend_to_email0);
		alert('<?php echo _DM_ALERT_TO_EMAIL_EMPTY; ?>');
		return false;
	} else if (notValidEmail (document.recommend.recommend_from_email)) {
    highlight2 (document.forms.recommend.recommend_to_email0);
    highlight  (document.forms.recommend.recommend_from_email);
		alert('<?php echo _DM_ALERT_FROM_EMAIL_INVALID; ?>' + '\n' + '<?php echo _DM_ALERT_MULTIPLE_EMAIL; ?>');
		return false;
	} else if (notValidEmail (document.recommend.recommend_to_email0)) {
    highlight2 (document.forms.recommend.recommend_from_email);
    highlight  (document.forms.recommend.recommend_to_email0);
		alert('<?php echo _DM_ALERT_TO_EMAIL_INVALID; ?>' + '\n' + '<?php echo _DM_ALERT_MULTIPLE_EMAIL; ?>');
		return false;
	} else {
		return true;
	}
}
//-->
</script>