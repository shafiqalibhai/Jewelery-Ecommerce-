<?php
/**
*	RecommendFriends Component for Joomla! - for Site Promotion
*
* @version $Id: admin.recommendfriends.html.php - v2.0.3 - January-06-2009 - D-Mack Media
* @package Joomla
* @subpackage RecommendFriends
* @copyright (c) 2007-2010 D-Mack Media, dmackmedia.com
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
*
* This is free software
**/

defined( '_JEXEC' ) or die( 'Restricted access' );

class HTML_recommendfriends {

////////////////////////////////////////////////////////////// Begin Configuration Editor Display
function showConfig(&$params, $option) {
global $mainframe, $option;
$main_sitename = $mainframe->getCfg('sitename');
$main_livesite = JURI::base();
$component_site_path = JPATH_COMPONENT_SITE.DS."includes".DS;
$component_admin_path = JPATH_COMPONENT_ADMINISTRATOR.DS;
$site_abs_path = $mainframe->getCfg('absolute_path');
$main_site_url = $mainframe->getSiteURL();
include_once($component_site_path."301a.js.php");
include_once( $component_admin_path."config.recommendfriends.php" );
?>
<table width="80%" align="center"><tr><td>
<form action="index2.php" name="adminForm" method="post">
		<table class="adminform">
		<tr>
			<th colspan="3" height="19">
D-Mack RecommendFriends Configuration Details - v2.0.3 - January-06-2009
			</th>
		</tr>
		<tr>
			<td colspan="3">
        <hr color="#cc0000">
			</td>
		</tr>
    <tr>
      <td colspan="3">
        <p style="margin-left:.25em; margin-top:0; margin-bottom:0">
        <b><u><font color="darkred"><?php echo JText::_('_DM_MAIN_CONFIG'); ?></font></u></b>
        </p>
      </td>
    <tr>
		<tr>
			<td width="16%" valign="middle">
			 <br /><?php echo JText::_('_DM_NUMREC'); ?>
			</td>
			<td colspan="2" valign="top">
        <br /><input class="inputbox" type="text" name="dm_numrec" value="<?php echo $params['dm_numrec']; ?>" maxlength="2" size="1"/>
        <?php echo JText::_('_DM_NUMREC_INFO'); ?>
			</td>
		</tr>
		<tr>
			<td colspan="3">
        <hr />
			</td>
		</tr>
		<tr>
			<td width="16%" valign="top">
        <p style="margin-top:.25em; margin-bottom:0">
        <?php echo JText::_('_DM_FROM_REPLY'); ?>
        </p>
			</td>
			<td colspan="2" valign="top">
        <input type="checkbox" name="dm_mail_from" value="" <?php echo ($params['dm_mail_from'] ? "checked" : ""); ?>/>
        <?php echo JText::_('_DM_FROM_REPLY_CHECK'); ?>
			</td>
		</tr>
		<tr>
			<td colspan="3">
        <hr />
			</td>
		</tr>
		<tr>
			<td width="16%" valign="top">
        <p style="margin-top:.25em; margin-bottom:0">
        <?php echo JText::_('_DM_BCC_ADMIN'); ?>
        </p>
			</td>
			<td colspan="2" valign="top">
        <input type="checkbox" name="dm_ccadmin" value="" <?php echo ($params['dm_ccadmin'] ? "checked" : ""); ?>/>
        <?php echo JText::_('_DM_BCC_ADMIN_CHECK'); ?>
			</td>
		</tr>
		<tr>
			<td height="23" colspan="3">
<hr />
			</td>
		</tr>
		<tr>
			<td width="16%" valign="middle">
        <?php echo JText::_('_DM_CUST_SUBJECT'); ?>
			</td>
			<td colspan="2" valign="top">
        <input type="checkbox" name="dm_subject_use" value="" <?php echo ($params['dm_subject_use'] ? "checked" : ""); ?>/>
        <?php echo JText::_('_DM_CUST_SUBJECT_CHECK'); ?>
      </td>
		</tr>
		<tr>
			<td width="16%" valign="top">
        <p style="margin-top:.25em; margin-bottom:0">
        <?php echo JText::_('_DM_CUST_EMAIL_SUBJECT'); ?>
        </p>
			</td>
			<td colspan="2" valign="top">
        <input class="inputbox" type="text" name="dm_subject" value="<?php echo $params['dm_subject']; ?>" size="105"/>
        <br /><?php echo JText::_('_DM_CUST_EMAIL_SUBJECT_INFO'); ?>
			</td>
		</tr>
		<tr>
			<td colspan="3">
<hr />
			</td>
		</tr>
		<tr>
			<td width="16%" valign="middle">
        <?php echo JText::_('_DM_CUST_MESSAGE'); ?>
      </td>
			<td colspan="2" valign="top">
        <input type="checkbox" name="dm_msg_use" value="" <?php echo ($params['dm_msg_use'] ? "checked" : ""); ?> />
        <?php echo JText::_('_DM_CUST_MESSAGE_CHECK'); ?>
      </td>
		</tr>
		<tr>
			<td width="16%" height="42" valign="top">
        <p style="margin-top:.25em; margin-bottom:0">
          <?php echo JText::_('_DM_CUST_MESSAGE_HTML'); ?>
        </p>
      </td>
			<td colspan="2" valign="top">
        <input type="checkbox" name="dm_msg_html" value="" <?php echo ($params['dm_msg_html'] ? "checked" : ""); ?> onclick="htmlMessage();" />
        <?php echo JText::_('_DM_CUST_MESSAGE_HTML_INFO'); ?>
        <input type="hidden" name="dm_htmlcheck" id="dm_htmlcheck" value="<?php echo $params['dm_htmlcheck']; ?>">
      </td>
		</tr>
<script language="javascript">
function htmlMessage() {
  if(document.adminForm.dm_msg_html.checked==true){
    document.adminForm.dm_htmlcheck.value=true;
    Show();
  } else {
    document.adminForm.dm_htmlcheck.value=false;
    Hide();
  }
}
function Show() {
  //Show 1
  var elem = document.getElementById('show1');
  elem.style.position = 'relative';
  elem.style.left = '0px';
  elem.style.display = "block";
  //Hide 2
  var elema = document.getElementById('show2');
  elema.style.position = 'absolute';
  elema.style.left = '-4000px';
  elema.style.display = "none";
}
function Hide() {
  //Hide 1
  var elemb = document.getElementById('show1');
  elemb.style.position = 'absolute';
  elemb.style.left = '-4000px';
  elemb.style.display = "none";
  //Show 2
  var elemc = document.getElementById('show2');
  elemc.style.position = 'relative';
  elemc.style.left = '0px';
  elemc.style.display = "block";
}
</script>
		<tr>
			<td width="16%" valign="top">
        <?php echo JText::_('_DM_CUST_INTRO_MESSAGE'); ?>
			</td>
			<td colspan="2" valign="top">
        <textarea cols="80" rows="15" name="dm_msg" class="inputbox"><?php echo stripslashes($params['dm_msg']); ?></textarea>
        <br /><?php echo JText::_('_DM_CUST_INTRO_MESSAGE_INFO'); ?>
			</td>
		</tr>
    <tr id='show1' style="display:none">
      <td>&nbsp;</td>
      <td colspan="2" bgcolor="#E0FFF0">
        <?php echo JText::_('_DM_CUST_INTRO_MESSAGE_INFO_2'); ?>
      </td>
    </tr>
    <tr id='show2' style="display:none">
      <td>&nbsp;</td>
      <td colspan="2" bgcolor="#E0F0FF">
        <?php echo JText::_('_DM_CUST_INTRO_MESSAGE_INFO_3'); ?>
      </td>
    </tr>
<script language="javascript">
if(document.adminForm.dm_msg_html.checked==true){
  Show();
} else {
  Hide();
}
</script>
<!-- **************** Begin Front End Form Display Edit Info **************** -->
		<tr>
			<td colspan="3">
        <hr color="#cc0000">
			</td>
		</tr>
    <tr>
      <td colspan="3">
        <p style="margin-left:.25em; margin-top:0em; margin-bottom:0">
        <b><u><font color="darkred"><?php echo JText::_('_DM_MAIN_FORMAT'); ?></font></u></b>
        </p>
      </td>
    <tr>
		<tr>
			<td colspan="3">
        <table width="100%">
          <tr>
            <td colspan="2">
              <?php echo JText::_('_DM_FORM_SIZE_INFO'); ?>
            </td>
          </tr>
          <tr>
            <td>
<?php echo JText::_('_DM_FORM_NAME'); ?><input class="inputbox" type="text" name="dm_namew" value="<?php echo $params['dm_namew']; ?>" maxlength="3" size="2"/>&nbsp;&nbsp;(<?php echo JText::_('_DM_FORM_DEFAULT'); ?>=35)
            </td>
            <td>
<?php echo JText::_('_DM_FORM_EMAIL'); ?><input class="inputbox" type="text" name="dm_emailw" value="<?php echo $params['dm_emailw']; ?>" maxlength="3" size="2"/>&nbsp;&nbsp;(<?php echo JText::_('_DM_FORM_DEFAULT'); ?>=45)
            </td>
          </tr>
        </table>
      </td>
    </tr>
		<tr>
			<td colspan="3">
        <hr />
			</td>
		</tr>
		<tr>
			<td colspan="3">
        <table width="100%">
          <tr>
            <td colspan="2">
              <?php echo JText::_('_DM_MAIN_FORM'); ?>
            </td>
          </tr>
          <tr>
            <td>
              <div id="colorpicker301" class="colorpicker301"></div>
              <?php echo JText::_('_DM_MAIN_FORMBG'); ?>
              <input type="button" onclick="showColorGrid3('input_field_4','sample_4');" value="<?php echo JText::_('_DM_CAP_COLOR_BUTTON'); ?>">&nbsp;
              <input  class="inputbox" name="dm_formbg" type="text" ID="input_field_4" size="9" value="<?php echo $params['dm_formbg']; ?>">&nbsp;
              &nbsp;<?php echo JText::_('_DM_CAP_COLOR_NEW'); ?><input type="text" ID="sample_4" size="1" value="" readonly>
              &nbsp;&nbsp;&nbsp;<?php echo JText::_('_DM_CAP_COLOR_ASIS'); ?><input style="background-color: <?php echo "#" . $params['dm_formbg']; ?>;" type="text" size="1" value="" readonly>
            </td>
            <td>
              <div id="colorpicker301" class="colorpicker301"></div>
              <?php echo JText::_('_DM_MAIN_FORMTX'); ?>
              <input type="button" onclick="showColorGrid3('input_field_5','sample_5');" value="<?php echo JText::_('_DM_CAP_COLOR_BUTTON'); ?>">&nbsp;
              <input  class="inputbox" name="dm_formtx" type="text" ID="input_field_5" size="9" value="<?php echo $params['dm_formtx']; ?>">&nbsp;
              &nbsp;<?php echo JText::_('_DM_CAP_COLOR_NEW'); ?><input type="text" ID="sample_5" size="1" value="" readonly>
              &nbsp;&nbsp;&nbsp;<?php echo JText::_('_DM_CAP_COLOR_ASIS'); ?><input style="background-color: <?php echo "#" . $params['dm_formtx']; ?>;" type="text" size="1" value="" readonly>
            </td>
          </tr>
          <tr>
            <td colspan="2">
              <p align="center" style="margin-top:.5em; margin-bottom:0">
              <input <?php if (($params['dm_formbg'] != "") && ($params['dm_formtx'] != "")) { echo 'style="height:1.5em; background-color:#' .  $params["dm_formbg"] . '; color:#' . $params["dm_formtx"] . ';"'; } else { echo 'class="inputbox"';}; ?> name="sample" type="text" size="50" value="<?php echo JText::_('_DM_PREVIEW_TEXT'); ?>" readonly>
              </p>
              <p align="center" style="margin-top:0; margin-bottom:.25em">
              <?php echo JText::_('_DM_PREVIEW'); ?>
              </p>
            </td>
          </tr>
      		<tr>
      			<td colspan="2">
              <hr />
      			</td>
      		</tr>
          <tr>
            <td colspan="2">
              <?php echo JText::_('_DM_MAIN_ERROR_INFO'); ?>
            </td>
          </tr>
          <tr>
            <td>
              <div id="colorpicker301" class="colorpicker301"></div>
              <?php echo JText::_('_DM_MAIN_FORMBG'); ?>
              <input type="button" onclick="showColorGrid3('input_field_6','sample_6');" value="<?php echo JText::_('_DM_CAP_COLOR_BUTTON'); ?>">&nbsp;
              <input  class="inputbox" name="dm_errorbg" type="text" ID="input_field_6" size="9" value="<?php echo $params['dm_errorbg']; ?>">&nbsp;
              &nbsp;<?php echo JText::_('_DM_CAP_COLOR_NEW'); ?><input type="text" ID="sample_6" size="1" value="" readonly>
              &nbsp;&nbsp;&nbsp;<?php echo JText::_('_DM_CAP_COLOR_ASIS'); ?><input style="background-color: <?php echo "#" . $params['dm_errorbg']; ?>;" type="text" size="1" value="" readonly>
            </td>
            <td>
              <div id="colorpicker301" class="colorpicker301"></div>
              <?php echo JText::_('_DM_MAIN_FORMTX'); ?>
              <input type="button" onclick="showColorGrid3('input_field_7','sample_7');" value="<?php echo JText::_('_DM_CAP_COLOR_BUTTON'); ?>">&nbsp;
              <input  class="inputbox" name="dm_errortx" type="text" ID="input_field_7" size="9" value="<?php echo $params['dm_errortx']; ?>">&nbsp;
              &nbsp;<?php echo JText::_('_DM_CAP_COLOR_NEW'); ?><input type="text" ID="sample_7" size="1" value="" readonly>
              &nbsp;&nbsp;&nbsp;<?php echo JText::_('_DM_CAP_COLOR_ASIS'); ?><input style="background-color: <?php echo "#" . $params['dm_errortx']; ?>;" type="text" size="1" value="" readonly>
            </td>
          </tr>
          <tr>
            <td colspan="2">
              <p align="center" style="margin-top:.5em; margin-bottom:0">
              <input <?php if (($params['dm_formbg'] != "") && ($params['dm_formtx'] != "")) { echo 'style="height:1.5em; background-color:#' .  $params["dm_formbg"] . '; color:#' . $params["dm_formtx"] . ';"'; } else { echo 'class="inputbox"';}; ?> name="errorsample" type="text" size="50" value="<?php echo JText::_('_DM_PREVIEW_TEXT'); ?>" readonly>
              </p>
              <p align="center" style="margin-top:0; margin-bottom:.25em">
              <?php echo JText::_('_DM_PREVIEW'); ?>
              </p>
            </td>
          </tr>
          <tr>
            <td colspan="2">
              <script type="text/javascript">
              <!--
              //Check email fields for the required field(s) only - for Logged in users
              function errorvalidate(){
                var bgcolor = '<?php echo $params['dm_errorbg']; ?>';
                var txcolor = '<?php echo $params['dm_errortx']; ?>';
                if ( bgcolor != '') {
              	document.adminForm.errorsample.style.backgroundColor='<?php echo $params['dm_errorbg']; ?>';
                }
                if ( txcolor != '') {
              	document.adminForm.errorsample.style.color='<?php echo $params['dm_errortx']; ?>';
                }
              	alert('<?php echo JText::_('_DM_ALERT_TEST'); ?>');
               	document.adminForm.errorsample.focus();
               	return false;
                }
              function errorreset(){
              	document.adminForm.errorsample.style.backgroundColor='<?php echo $params['dm_formbg']; ?>';
              	document.adminForm.errorsample.style.color='<?php echo $params['dm_formtx']; ?>';
               	document.adminForm.errorsample.focus();
                return false;
                }
              //-->
              </script>
              <p align="center" style="margin-top:0; margin-bottom:.25em">
              <input type="button" onclick="errorvalidate();" value="&nbsp;<?php echo JText::_('_DM_ERROR_TEST'); ?>&nbsp;">&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" onclick="errorreset();" value="<?php echo JText::_('_DM_ERROR_RESET'); ?>">
              </p>
            </td>
          </tr>
      		<tr>
      			<td colspan="2">
              <hr />
      			</td>
      		</tr>
          <tr>
            <td colspan="2">
              <?php echo JText::_('_DM_LOGGED_INFO'); ?>
            </td>
          </tr>
          <tr>
            <td>
              <div id="colorpicker301" class="colorpicker301"></div>
              <?php echo JText::_('_DM_MAIN_FORMBG'); ?>
              <input type="button" onclick="showColorGrid3('input_field_8','sample_8');" value="<?php echo JText::_('_DM_CAP_COLOR_BUTTON'); ?>">&nbsp;
              <input  class="inputbox" name="dm_loggedbg" type="text" ID="input_field_8" size="9" value="<?php echo $params['dm_loggedbg']; ?>">&nbsp;
              &nbsp;<?php echo JText::_('_DM_CAP_COLOR_NEW'); ?><input type="text" ID="sample_8" size="1" value="" readonly>
              &nbsp;&nbsp;&nbsp;<?php echo JText::_('_DM_CAP_COLOR_ASIS'); ?><input style="background-color: <?php echo "#" . $params['dm_loggedbg']; ?>;" type="text" size="1" value="" readonly>
            </td>
            <td>
              <div id="colorpicker301" class="colorpicker301"></div>
              <?php echo JText::_('_DM_MAIN_FORMTX'); ?>
              <input type="button" onclick="showColorGrid3('input_field_9','sample_9');" value="<?php echo JText::_('_DM_CAP_COLOR_BUTTON'); ?>">&nbsp;
              <input  class="inputbox" name="dm_loggedtx" type="text" ID="input_field_9" size="9" value="<?php echo $params['dm_loggedtx']; ?>">&nbsp;
              &nbsp;<?php echo JText::_('_DM_CAP_COLOR_NEW'); ?><input type="text" ID="sample_9" size="1" value="" readonly>
              &nbsp;&nbsp;&nbsp;<?php echo JText::_('_DM_CAP_COLOR_ASIS'); ?><input style="background-color: <?php echo "#" . $params['dm_loggedtx']; ?>;" type="text" size="1" value="" readonly>
            </td>
          </tr>
          <tr>
            <td colspan="2">
              <p align="center" style="margin-top:0; margin-bottom:.25em">
              <input style="color: #<?php echo $params['dm_loggedtx']; ?>; background-color: #<?php echo $params['dm_loggedbg']; ?>;" name="logged_name" type="text" value="<?php echo JText::_('_DM_LOGGED_USER'); ?>" size="35" readonly />
              &nbsp;&nbsp;&nbsp;&nbsp;<input style="color: #<?php echo $params['dm_loggedtx']; ?>; background-color: #<?php echo $params['dm_loggedbg']; ?>;" name="logged_email" type="text" value="<?php echo JText::_('_DM_LOGGED_EMAIL'); ?>" size="45" readonly />
              </p>
              <p align="center" style="margin-top:0; margin-bottom:.25em">
              <?php echo JText::_('_DM_PREVIEW'); ?>
              </p>
            </td>
          </tr>
        </table>
      </td>
		</tr>
		<tr>
			<td colspan="3">
<hr />
			</td>
		</tr>
		<tr>
			<td width="16%" valign="middle">
        <b><?php echo JText::_('_DM_USER_MESSAGE'); ?></b>
			</td>
			<td colspan="2" valign="top">
        <input type="checkbox" name="dm_msg_user" value="" <?php echo ($params['dm_msg_user'] ? "checked" : ""); ?>/>
        <?php echo JText::_('_DM_USER_MESSAGE_CHECK'); ?>
      </td>
		</tr>
		<tr>
			<td width="16%" valign="middle">
        <b><?php echo JText::_('_DM_FORM_MESSAGE_SIZE'); ?></b>
			</td>
			<td valign="middle">
        <?php echo JText::_('_DM_FORM_ROWS'); ?><input class="inputbox" type="text" name="dm_userrows" value="<?php echo $params['dm_userrows']; ?>" maxlength="3" size="2"/>&nbsp;&nbsp;(<?php echo JText::_('_DM_FORM_DEFAULT'); ?>=8)
      </td>
      <td valign="middle">
        <?php echo JText::_('_DM_FORM_COLS'); ?><input class="inputbox" type="text" name="dm_usercols" value="<?php echo $params['dm_usercols']; ?>" maxlength="3" size="2"/>&nbsp;&nbsp;(<?php echo JText::_('_DM_FORM_DEFAULT'); ?>=55)
      </td>
    </tr>
		<tr>
			<td width="16%" valign="top">
        <p style="margin-top:.25em; margin-bottom:0">
          <b><?php echo JText::_('_DM_USER_MESSAGE_HTML'); ?></b>
        </p>
			</td>
			<td colspan="2" valign="top">
        <input type="checkbox" name="dm_msg_user_html" value="" <?php echo ($params['dm_msg_user_html'] ? "checked" : ""); ?>/>
        <?php echo JText::_('_DM_USER_MESSAGE_HTML_INFO'); ?>
      </td>
		</tr>

<!-- **************** Begin Captcha Edit Info **************** -->
		<tr>
			<td colspan="3">
        <hr color="#cc0000">
			</td>
		</tr>
    <tr>
      <td colspan="3">
        <p style="margin-left:.25em; margin-top:0em; margin-bottom:0">
        <b><u><font color="darkred"><?php echo JText::_('_DM_CAP_TITLE'); ?></font></u></b>
        </p>
      </td>
    </tr>
    <tr>
      <td colspan="3" style="border-bottom: 1px solid #A0A0A0">
<?php
$gdsupport = ""; $freetype = "";
if (!extension_loaded('gd')) {
  $gdsupport = "false";
} else {
  $gdsupport = "true";
  $array=gd_info ();
  foreach ($array as $key=>$val) {
    if ($key == "FreeType Support") {
      if ($val===true) {
        $freetype = "true";
      } else {
        $freetype = "false";
      }
    }
  }
}
if ($gdsupport == "true" && $freetype != "true") {
  $gdfreetype = JText::_('_DM_GDFT_HALF');
} elseif ($gdsupport == "false") {
  $gdfreetype = JText::_('_DM_GDFT_NO');
}
if ($gdsupport == "true" && $freetype == "true") {
?>
        <p style="margin-top:0em; margin-bottom:.25em">
        <i><b><?php echo JText::_('_DM_GREAT_NEWS'); ?></b>&nbsp;-&nbsp;<?php echo JText::_('_DM_GDFT_YES'); ?></i>
        </p>
<?php
} else {
?>
        <p style="margin-top:0em; margin-bottom:.25em">
        <b><font color="red"><?php echo JText::_('_DM_GD_WARNING'); ?></font></b>&nbsp;&nbsp;<i><?php echo $gdfreetype; ?>&nbsp;&nbsp;
        <?php echo JText::_('_DM_GD_OPTIONS'); ?></i>
        </p>
<?php
}
?>
      </td>
    </tr>
		<tr>
			<td width="16%" valign="middle">
        <?php echo JText::_('_DM_CAP_USE'); ?>
			</td>
			<td colspan="2" valign="top">
        <input type="checkbox" name="dm_cap_use" value="" <?php echo ($params['dm_cap_use'] ? "checked" : ""); ?>/>
        <?php echo JText::_('_DM_CAP_USE_INFO'); ?>
      </td>
		</tr>
    <tr>
      <td colspan="3">
        <table width="100%" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td width=33% style="border-top: 1px solid #C0C0C0; border-bottom: 1px solid #C0C0C0">
              <b><?php echo JText::_('_DM_CAP_1'); ?></b>
            </td>
            <td width=33% style="border-left: 1px solid #C0C0C0; border-right: 1px solid #C0C0C0; border-top: 1px solid #C0C0C0; border-bottom: 1px solid #C0C0C0">
              <b><?php echo JText::_('_DM_CAP_7'); ?></b>
            </td>
            <td width=33% style="border-top: 1px solid #C0C0C0; border-bottom: 1px solid #C0C0C0">
              <b><?php echo JText::_('_DM_CAP_11'); ?></b>
            </td>
          </tr>
          <tr>
            <td width=33%>
              <b><i><?php echo JText::_('_DM_CAP_2'); ?></b></i>
            </td>
            <td width=33% style="border-left: 1px solid #C0C0C0; border-right: 1px solid #C0C0C0;">
              <b><i><?php echo JText::_('_DM_CAP_8'); ?></b></i>
            </td>
            <td width=33%>
              <b><i><?php echo JText::_('_DM_CAP_12'); ?></b></i>
            </td>
          </tr>
          <tr>
            <td width=33%>
              <input class="inputbox" type="text" name="dm_width" value="<?php echo $params['dm_width']; ?>" maxlength="3" size="3"/>
            </td>
            <td width=33% style="border-left: 1px solid #C0C0C0; border-right: 1px solid #C0C0C0;">
              <div id="colorpicker301" class="colorpicker301"></div>
              <input type="button" onclick="showColorGrid3('input_field_1','sample_1');" value="<?php echo JText::_('_DM_CAP_COLOR_BUTTON'); ?>">&nbsp;
              <input  class="inputbox" name="dm_bghex" type="text" ID="input_field_1" size="9" value="<?php echo $params['dm_bghex']; ?>">&nbsp;
              &nbsp;<?php echo JText::_('_DM_CAP_COLOR_NEW'); ?><input type="text" ID="sample_1" size="1" value="" readonly>
              &nbsp;&nbsp;&nbsp;<?php echo JText::_('_DM_CAP_COLOR_ASIS'); ?><input style="background-color: <?php echo "#" . $params['dm_bghex']; ?>;" type="text" size="1" value="" readonly>
            </td>
            <td width=33%>
              &nbsp;&nbsp;&nbsp;<input type="radio" name="dm_font" value="monofont.ttf" <?php if ($params['dm_font']=="monofont.ttf") {echo "checked";}; ?>><?php echo JText::_('_DM_CAP_13'); ?>
            </td>
          </tr>
          <tr>
            <td width=33%>
              <b><i><?php echo JText::_('_DM_CAP_3'); ?></b></i>
            </td>
            <td width=33% style="border-left: 1px solid #C0C0C0; border-right: 1px solid #C0C0C0;">
              <b><i><?php echo JText::_('_DM_CAP_9'); ?></b></i>
            </td>
            <td width=33%>
              &nbsp;&nbsp;&nbsp;<input type="radio" name="dm_font" value="comicbook.ttf" <?php if ($params['dm_font']=="comicbook.ttf") {echo "checked";}; ?>><?php echo JText::_('_DM_CAP_14'); ?>
            </td>
          </tr>
          <tr>
            <td width=33%>
              <input class="inputbox" type="text" name="dm_height" value="<?php echo $params['dm_height']; ?>" maxlength="3" size="3"/>
            </td>
            <td width=33% style="border-left: 1px solid #C0C0C0; border-right: 1px solid #C0C0C0;">
              <div id="colorpicker301" class="colorpicker301"></div>
              <input type="button" onclick="showColorGrid3('input_field_2','sample_2');" value="<?php echo JText::_('_DM_CAP_COLOR_BUTTON'); ?>">&nbsp;
              <input  class="inputbox" name="dm_txhex" type="text" ID="input_field_2" size="9" value="<?php echo $params['dm_txhex']; ?>">&nbsp;
              &nbsp;<?php echo JText::_('_DM_CAP_COLOR_NEW'); ?><input type="text" ID="sample_2" size="1" value="" readonly>
              &nbsp;&nbsp;&nbsp;<?php echo JText::_('_DM_CAP_COLOR_ASIS'); ?><input style="background-color: <?php echo "#" . $params['dm_txhex']; ?>;" type="text" size="1" value="" readonly>
            </td>

            <td width=33%>
              &nbsp;&nbsp;&nbsp;<input type="radio" name="dm_font" value="oldcentury.ttf" <?php if ($params['dm_font']=="oldcentury.ttf") {echo "checked";}; ?>><?php echo JText::_('_DM_CAP_15'); ?>
            </td>
          </tr>
          <tr>
            <td width=33%>
              <b><i><?php echo JText::_('_DM_CAP_4'); ?></b></i>
            </td>
            <td width=33% style="border-left: 1px solid #C0C0C0; border-right: 1px solid #C0C0C0;">
              <b><i><?php echo JText::_('_DM_CAP_10'); ?></b></i>
            </td>
            <td width=33%>
              <b><i><?php echo JText::_('_DM_CAP_16'); ?></b></i>
            </td>
          </tr>
          <tr>
            <td width=33%>
              <input type="checkbox" name="dm_rotate" value="" <?php echo ($params['dm_rotate'] ? "checked" : ""); ?>/>
              <?php echo JText::_('_DM_CAP_ROTATE'); ?>
            </td>
            <td width=33% style="border-left: 1px solid #C0C0C0; border-right: 1px solid #C0C0C0;">
              <div id="colorpicker301" class="colorpicker301"></div>
              <input type="button" onclick="showColorGrid3('input_field_3','sample_3');" value="<?php echo JText::_('_DM_CAP_COLOR_BUTTON'); ?>">&nbsp;
              <input  class="inputbox" name="dm_nhex" type="text" ID="input_field_3" size="9" value="<?php echo $params['dm_nhex']; ?>">&nbsp;
              &nbsp;<?php echo JText::_('_DM_CAP_COLOR_NEW'); ?><input type="text" ID="sample_3" size="1" value="" readonly>
              &nbsp;&nbsp;&nbsp;<?php echo JText::_('_DM_CAP_COLOR_ASIS'); ?><input style="background-color: <?php echo "#" . $params['dm_nhex']; ?>;" type="text" size="1" value="" readonly>
            </td>
            <td width=33%>
              <input class="inputbox" type="text" name="dm_chars" value="<?php echo $params['dm_chars']; ?>" maxlength="2" size="3"/>
            </td>
          </tr>
          <tr>
            <td colspan="3">
                <p align="center" style="margin-top:.5em; margin-bottom:0">
<?php
$dm_font = substr(JPATH_BASE, 0, -13).DS.'components'.DS.'com_recommendfriends'.DS.'includes'.DS.$params['dm_font'];
$capvars = "width=".$params['dm_width']."&height=".$params['dm_height']."&chars=".$params['dm_chars']."&rotate=".$params['dm_rotate']."&font=".$dm_font."&bghex=".$params['dm_bghex']."&txhex=".$params['dm_txhex']."&nhex=".$params['dm_nhex'];
?>
                <img name="captcha" style="border: 1px solid #719595;" src="<?php echo $main_site_url ?>administrator/components/com_recommendfriends/securityimage.php?<?php echo $capvars; ?>" alt="Security Image" />&nbsp;&nbsp;
                </p>
                <p align="center" style="margin-top:0; margin-bottom:.5em">
                <?php echo JText::_('_DM_CAP_SAMPLE'); ?>
                </p>
            </td>
          </tr>
        </table>
      </td>
    </tr>

<!-- **************** Begin Edit Language File Link **************** -->
		<tr>
			<td colspan="3">
        <hr color="#cc0000">
			</td>
		</tr>
    <tr>
      <td colspan="3">
        <p style="margin-left:.25em; margin-top:0em; margin-bottom:0">
        <b><u><font color="darkred"><?php echo JText::_('_DM_EDIT_LANG_HEADER'); ?></font></u></b>
        </p>
      </td>
    </tr>
    <tr>
      <td colspan="3"><br />
        <table cellpadding="6"><tr><td>
        <?php echo JText::_('_DM_EDIT_LANG_INFO'); ?><br /><br />
        &nbsp;&nbsp;<a href = "<?php echo $main_site_url.'/administrator/index2.php?option='.$option.'&task=Language' ?>"><b><?php echo JText::_('_DM_EDIT_LANG'); ?></b></a><br /><br />
        </td></tr></table>
      </td>
    </tr>

<!-- **************** Begin Email Preview Display **************** -->
		<tr>
			<td colspan="3">
        <hr color="#cc0000">
			</td>
		</tr>
    <tr>
      <td colspan="3">
        <p style="margin-left:.25em; margin-top:0em; margin-bottom:0">
        <b><u><font color="darkred"><?php echo JText::_('_DM_EMAIL_PREVIEW'); ?></font></u></b>
        </p>
      </td>
    </tr>
    <tr>
      <td colspan="3"><br />
        <?php
          $main_sitename = $mainframe->getCfg('sitename');
          $main_site_url = $mainframe->getSiteURL();
          $divider1 = "~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~";
          $divider2 = "=====================================================================";
        ?>
  <table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" width="100%">
    <tr>
      <td width="23%" height="28" valign="middle" bgcolor="#ebf0f1">
        <?php echo JText::_('_DM_SUBJECT_IN_EMAIL'); ?>
      </td>
      <td width="77%" valign="middle" bgcolor="#ebf0f1">
        <?php
          if (($params['dm_subject_use'] == 1) && ($params['dm_subject'] != "")) {
            echo $params['dm_subject'];
          } else {
            echo JText::sprintf('_DM_PREVIEW_SUBJECT', $main_sitename);
          } ?>
      </td>
    </tr>
    <tr>
      <td width="23%" valign="top">
        <?php echo JText::_('_DM_PREVIEW_SHORT_INTRO'); ?>
      </td>
      <td width="77%" valign="top">
        <?php
          echo $divider1 . "<br />";
          echo JText::_('_DM_HELLO') . "<br /><br />";
          echo JText::sprintf('_DM_PREVIEW_USER_INFO', $main_sitename) . "<br /><br />";
        ?>
      </td>
    </tr>
    <?php  if ($params['dm_msg_use'] == 1) { ?>
    <tr>
        <td width="23%" valign="top" bgcolor="#ebf0f1">
          <?php echo JText::_('_DM_PREVIEW_ADMIN_MESSAGE'); ?>
        </td>
        <td width="77%" valign="top" bgcolor="#ebf0f1">
          <?php
            if ($params['dm_msg'] != "") {
              echo $divider1 . "<br />";
              if ($params['dm_msg_html'] == 1) {
                echo stripslashes($params['dm_msg']) . "<br />";
              } else {
                $order   = array("\r\n", "\n", "\r");
                $replace = '<br />';
                // Processes \r\n's first so they aren't converted twice.
                $msgfiltered = str_replace($order, $replace, $params['dm_msg']);
                echo stripslashes($msgfiltered) . "<br />";
              }
            } else {
              echo JText::_('_DM_PREVIEW_ADMIN_MESSAGE_BLANK') . "<br /><br />";
            }
          ?>
        </td>
    </tr>
    <?php
        $bg="";
        $bg1="#ebf0f1";
      } else {
        $bg="#ebf0f1";
        $bg1="";
      }
    ?>
    <tr>
        <td width="23%" valign="top" bgcolor="<?php echo $bg; ?>">
          <?php echo JText::_('_DM_PREVIEW_LINK'); ?>
        </td>
        <td width="77%" valign="top" bgcolor="<?php echo $bg; ?>">
          <?php
            echo $divider2 . "<br />";
            $urlhref = "<a href='" . $main_site_url . "'>" . $main_site_url . "</a>";
            echo JText::sprintf('_DM_PREVIEW_LINK_INFO', $urlhref);
            echo $divider2 . "<br /><br />";
          ?>
        </td>
    </tr>
    <tr>
        <td width="23%" valign="top" bgcolor="<?php echo $bg1; ?>">
          <?php echo JText::_('_DM_PREVIEW_USER_MESSAGE'); ?>
        </td>
        <td width="77%" valign="top" bgcolor="<?php echo $bg1; ?>">
          <?php
            echo JText::_('_DM_PREVIEW_USER_MESSAGE_INFO');
            echo "<br />" . $divider1 . "<br />";
            echo JText::_('_DM_PREVIEW_USER_MESSAGE_INFO2') . "<br /><br />";
          ?>
        </td>
    </tr>
  </table>
  <input type="hidden" name="option" value="<?php echo $option; ?>"/>
  <input type="hidden" name="task" value=""/>
</form>
     </td>
    </tr>

<!-- **************** Begin Miscellaneous Info **************** -->
		<tr>
			<td colspan="3">
        <hr color="#cc0000">
			</td>
		</tr>
    <tr>
      <td colspan="3">
        <p style="margin-left:.25em; margin-top:0em; margin-bottom:0">
        <b><u><font color="darkred"><?php echo JText::_('_DM_COPYRIGHT_BOTTOM'); ?></font></u></b>
        </p>
      </td>
    </tr>
    <tr>
      <td colspan="3">
       <br />
       <p align="center" style="margin-top: 0; margin-bottom: 8">
         <b><?php echo JText::_('_DM_SUGGESTIONS'); ?></b>
       </p>
       <p align="center" style="margin-top: 0; margin-bottom: 8">
         <?php echo JText::_('_DM_COPYRIGHT'); ?>
       </p>
</td></tr></table>
</td></tr></table>
<?php
	}
////////////////////////////////////////////////////////////// Begin Language File Editor
function showSource($file, $option) {
    global $option, $main_site_url, $mainframe;
//    $file = stripslashes($file);
    $f=fopen($file,"r");
    $content = fread($f, filesize($file));
    $content = htmlspecialchars($content);
?>
<form action='index2.php' name='adminForm' method='post'>
  <table width="80%" align="center">
		<tr>
			<td>
        <b>D-Mack RecommendFriends Language File Editor - v2.0.3 - January-06-2009</b><br /><br />
			</td>
		</tr>
    <tr>
      <td>
        <?php
        $language = JFactory::getLanguage();
        $tag = $language->getTag();
        ?>

        <?php echo JText::_('_DM_LANG_FILE') . "  <b>'" . $tag . ".php'</b>   " . JText::_('_DM_LANG_IS') . " ";
      	echo is_writable($file) ? '<font color="green"><b> '. JText::_('_DM_WRITEABLE') .'</b></font>' : '<font color="red"><b> '. JText::_('_DM_UNWRITEABLE') . '</b></font>'; ?>
        </font>
      </td>
    </tr>
    <?php
    if (JPath::canChmod($file)) {
      echo "<tr><td><br />";
      if (is_writable($file)) {
        echo "<input type=\"checkbox\" id=\"disable_write\" name=\"disable_write\" value=\"1\"/>\n";
        echo "<label for=\"disable_write\"><b>". JText::_('_DM_MAKE_UNWRITEABLE') ."</b></label>";
      } else {
        echo "<input type=\"checkbox\" id=\"enable_write\" name=\"enable_write\" value=\"1\"/>\n";
        echo "<label for=\"enable_write\"><b>". JText::_('_DM_OVERRRIDE_UNWRITEABLE') ."</b></label>";
      }
      echo "</td></tr>\n";
    }
    ?>
    <tr>
      <td>
        <br /><textarea cols='119' rows='35' name='filecontent'><?php echo $content ?></textarea>
      </td>
    </tr>
  </table>
<input type='hidden' name='file' value='<?php echo $file; ?>' />
<input type='hidden' name='option' value='<?php echo $option; ?>' />
<input type='hidden' name='task' value='' />
</form>
<table width="80%" align="center">
  <tr>
    <td>
      <br />
      <p align="center" style="margin-top: 0; margin-bottom: 8">
        <b><?php echo JText::_('_DM_SUGGESTIONS'); ?></b>
      </p>
      <p align="center" style="margin-top: 0; margin-bottom: 8">
        <?php echo JText::_('_DM_COPYRIGHT'); ?>
      </p>
    </td>
  </tr>
</table>
<?php
}
////////////////////////////////////////////////////////////// Begin About D-Mack RecommendFriends Info
function about ($option) {
  global $option, $main_site_url, $mainframe;
?>
<form action="index.php?option=com_recommendfriends" method="post" name="adminForm">
  <table width="80%" align="center" style="background-color:#FFFFFF;border:1px solid #600">
    <tr>
      <td>
    		<div style="text-align:left;padding-left:5px;padding-right:5px;">
          <p style="font-size:160%;font-weight:bold;font-color:#650000; margin-top:.75em; margin-bottom:.25em" align="center">
            <i>*** D-Mack RecommendFriends - v2.0.3 - January-06-2009 ***</i></p>
      		<p style="font-size:100%;font-weight:bold;font-color:#650000; margin-top:0; margin-bottom:0" align="center">
            D-Mack Media - </font> <a href='http://www.dmackmedia.com' target='_blank'>Vancouver Website Design</font></a></p>
      		<p style="padding-left:10px;padding-right:10px; margin-top:0; margin-bottom:0" align="center">
            D-Mack Media - Professional and Friendly Website Design and Hosting</p>
      		<p style="padding-left:10px;padding-right:10px; margin-top:0; margin-bottom:0" align="left">
            &nbsp;</p>
        </div>
      </td>
    </tr>
    <tr>
      <td>
    		<div style="text-align:left;padding-left:5px;padding-right:5px;">
          <hr />
<table width="100%">
<tr>
<td valign="top" width="60%">
            <?php echo JText::_('_DM_PROGRAM'); ?>
</td>
<td>
          <p align="center" style="margin-top: 0; margin-bottom: 0">
            <img style="border: 1px solid #719595;" align="right" src="<?php echo $main_site_url ?>/administrator/components/com_recommendfriends/recommendfriends_screen.jpg" alt="RecommendFriends Screen Shot" />
          </p>
</td>
</tr>
</table>
          <hr />
            <?php echo JText::_('_DM_CONFIG_INFO'); ?>
          <hr />
            <i><b><font size='4'>
Helpful Links
            </font></b></i><br /><br />
Here is list of links that might be helpful if you have questions or problems.
            <ul>
              <li style="margin-top:0; margin-bottom:.5em;">
D-Mack Demo Site: <a href="http://www.dmackmedia.net/recommend-demo.html" target="_blank">http://www.dmackmedia.net/recommend-demo.html</a>
              </li><li style="margin-top:0; margin-bottom:.5em;">
D-Mack Downloads: <a href="http://www.dmackmedia.net/downloads.html" target="_blank">http://www.dmackmedia.net/downloads.html</a>
              </li><li style="margin-top:0; margin-bottom:.5em;">
D-Mack Support Forums: <a href="http://www.dmackmedia.net/support-forums.html" target="_blank">http://www.dmackmedia.net/support-forums.html</a>
              </li><li style="margin-top:0; margin-bottom:.5em;">
D-Mack Joomla Site: <a href="http://www.dmackmedia.net" target="_blank">http://www.dmackmedia.net</a>
              </li><li>
D-Mack Media Site: <a href="http://www.dmackmedia.com" target="_blank">http://www.dmackmedia.com</a>
              </li>
            </ul>
          <hr />
            <?php echo JText::_('_DM_WARRANTY'); ?>
          <hr />
          <p align="center" style="margin-top: 0; margin-bottom: 8">
            <b><?php echo JText::_('_DM_SUGGESTIONS'); ?></b>
          </p>
          <p align="center" style="margin-top: 0; margin-bottom: 8">
            <?php echo JText::_('_DM_COPYRIGHT'); ?>
          </p>
    		</div>
      </td>
    </tr>
  </table>
  <input type="hidden" name="option" value="com_recommendfriends" />
  <input type="hidden" name="task" value="Configuration" />
</form>
<?php
		return true;
	}
}
?>