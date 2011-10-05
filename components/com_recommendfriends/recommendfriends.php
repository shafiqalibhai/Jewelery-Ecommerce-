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

defined( '_JEXEC' ) or die( 'Restricted access' );

global $mainframe, $option;

include_once( JPATH_COMPONENT_ADMINISTRATOR.DS."config.recommendfriends.php" );

$main_sitename = $mainframe->getCfg('sitename');
$main_livesite = JURI::base();
$includes_path = JPATH_COMPONENT.DS."includes".DS;

$func = JRequest::getVar( 'func' );
if ($func == "captcha") {
  $dm_font = $includes_path.$dm_font;
  $width   = isset($dm_width) ? $dm_width : '120';
  $height  = isset($dm_height) ? $dm_height : '40';
  $chars   = isset($dm_chars) && $dm_chars > 1 ? $dm_chars : '6';
  $rotate  = isset($dm_rotate) ? $dm_rotate : '0';
  $font    = isset($dm_font) ? $dm_font : 'monofont.ttf';
  $bghex   = isset($dm_bghex) ? $dm_bghex : '#FF0000';
  $txhex   = isset($dm_txhex) ? $dm_txhex : '#FFFFFF';
  $nhex    = isset($dm_nhex) ? $dm_nhex : '#000000';
  $bgrgb   = html2rgb($bghex);
  $txrgb   = html2rgb($txhex);
  $nrgb    = html2rgb($nhex);
  $captcha = new CaptchaSecurityImages($width,$height,$chars,$rotate,$font,$bgrgb,$txrgb,$nrgb);
  exit();
}

function html2rgb($color){
  if ($color[0] == '#') $color = substr($color, 1);
  if (strlen($color) == 6) list($r, $g, $b) = array($color[0].$color[1], $color[2].$color[3], $color[4].$color[5]);
  elseif (strlen($color) == 3) list($r, $g, $b) = array($color[0], $color[1], $color[2]);
  else return false;
  $r = hexdec($r); $g = hexdec($g); $b = hexdec($b);
  return array($r, $g, $b);
}

$language = JFactory::getLanguage();
$tag = $language->getTag();

if (file_exists($includes_path.$tag.".php")) {
	include_once($includes_path.$tag.".php");
} else {
	include_once($includes_path."en-GB.php");
}

include_once( $includes_path."chkfrm.js.php" );

$database = JFactory::getDBO();
$query = "SELECT id FROM #__menu WHERE link = 'index.php?option=com_recommendfriends'";
$database->setQuery($query);
$base_url = "index.php?option=com_recommendfriends&amp;Itemid=" . $database->loadResult();	// Base URL string

$recommend_option = JRequest::getvar('recommend_option', '');
$secure = JRequest::getVar('security_code', '');

jimport( 'joomla.application.component.controller' );

/////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////  Beginning of Send Email Routine
/////////////////////////////////////////////////////////////////////////////////////////////////

$goahead = '';
if (($dm_cap_use == 1) && ($recommend_option == "send") && ($_SESSION['CAPTCHA'] == $secure) && (!empty($_SESSION['CAPTCHA']))) {
  $goahead = "yes";
} else if (($dm_cap_use != 1) && ($recommend_option == "send")) {
  $goahead = "yes";
}

if ($goahead == "yes") {
  jimport('joomla.mail.helper');
  // Check for request forgeries
  JRequest::checkToken() or die( 'Invalid Token' );

  $recommend_from_name = trim (JRequest::getvar('recommend_from_name', ''));
  $recommend_from_email = trim (JRequest::getvar('recommend_from_email', ''));

  if ($dm_msg_user == 1 && $dm_msg_user != "") {
    if ($dm_msg_user_html == 1) {
      $recommend_text = JRequest::getvar('recommend_text', '', 'post', 'string', JREQUEST_ALLOWRAW);
    } elseif ($dm_msg_user_html != 1 && $dm_msg_html == 1) {
      $recommend_text_raw = JRequest::getvar('recommend_text', '', 'post', 'string');
      $order   = array("\r\n", "\n", "\r");
      $replace = '<br />';
      $msgfiltered = str_replace($order, $replace, $recommend_text_raw);
      $recommend_text = stripslashes($msgfiltered);
    } else {
      $recommend_text = JRequest::getvar('recommend_text', '', 'post', 'string');
    }
  }
//---------------------------------------------- Setup Subject
	if ($dm_subject_use == 1 && $dm_subject != "") {
		$subject = $dm_subject;
	} else {
    if (isset($recommend_from_name) && $recommend_from_name != "") {
   		$subject = JText::_( '_DM_FRIEND' ) . $recommend_from_name . " " . JText::_( '_DM_INVITES_YOU' ) . $main_sitename . "!";
    } else {
   		$subject = JText::_( '_DM_FRIEND' ) . JText::_( '_DM_INVITES_YOU' ) . $main_sitename . "!";
    }
  }

  if (($dm_msg_use == 1 && $dm_msg_html == 1) ||  ($dm_msg_user == 1 && $dm_msg_user_html == 1)) {
    $eol = "<br />";
    define ('PHP_EOL', "");
  } else {
    if (strtoupper(substr(PHP_OS,0,3) == 'WIN')) {
      $eol = '';
      define ('PHP_EOL', "\r\n");
    } else {
      $eol = '';
      define ('PHP_EOL', "\n");
    }
  }
  $divider1 = "~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~";
  $divider2 = "=====================================================================";

/////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////  Set-up Email to be Sent to the Friends
/////////////////////////////////////////////////////////////////////////////////////////////////

//---------------------------------------------- Intro Message
  $text = $eol . PHP_EOL;

  if (isset($recommend_from_name) && $recommend_from_name != "") {
  	$text .= JText::_( '_DM_FRIEND_2' ) . $recommend_from_name . " (" . $recommend_from_email . "), ";
	  $text .= JText::_( '_DM_INVITES_YOU_2' ) . " " . $main_sitename;
  } else {
  	$text .= JText::_( '_DM_FRIEND_2' ) . " (" . $recommend_from_email . "), ";
	  $text .= JText::_( '_DM_INVITES_YOU_2' ) . " " . $main_sitename;
  }
	if ($dm_msg_use == 1 && $dm_msg != "") {
    $text .= $eol . PHP_EOL . $divider1;
    $text .= $eol . PHP_EOL . stripslashes($dm_msg) . $eol . PHP_EOL . $eol . PHP_EOL;
  }

//---------------------------------------------- Link to Website

  if ($dm_msg_html == 1 ||  $dm_msg_user_html == 1) {
    $text .= $divider1 . $eol . PHP_EOL;
  	$text .= JText::_( '_DM_GO_TO' ) . " <a href='" . $main_livesite . "'>" . $main_livesite . "</a>" . $eol . PHP_EOL;
  } else {
    $text .= $divider1 . $eol . PHP_EOL;
  	$text .= JText::_( '_DM_GO_TO' ) . " " . $main_livesite . $eol . PHP_EOL . $eol . PHP_EOL;
  }
  $text .= $eol . PHP_EOL . $divider1 . $eol . PHP_EOL;

//---------------------------------------------- User Message
  if (isset($recommend_text) && $recommend_text != "") {
    if (isset($recommend_from_name) && $recommend_from_name != "") {
      $text .= $recommend_from_name . "" . JText::_( '_DM_TELLS_YOU' );
    } else {
      $text .= JText::_( '_DM_FRIEND_TELLS_YOU' );
    }
		$text .=  $eol . PHP_EOL . $eol . PHP_EOL;
    $text .= $recommend_text . $eol . PHP_EOL . $eol . PHP_EOL;
  }
  $text = wordwrap($text, 70);

  $replyname = $recommend_from_name;
  $replymail = $recommend_from_email;

	if ($dm_mail_from == 1) {
    $fromname = $recommend_from_name;
    $fromemail = $recommend_from_email;
	} else {
    $fromname = $mainframe->getCfg('fromname');
    $fromemail = $mainframe->getCfg('mailfrom');
	}

  $list = ""; $lista = ""; $fail = ""; $okay = 0; $bad = 0;
  for ($i = 0; $i < $dm_numrec; $i++) {
    $emailfield = "recommend_to_email$i";
    $toemail = trim (JRequest::getvar( $emailfield, '' ), '');
    if ($toemail != '') {
      $namefield = "recommend_to_name$i";
      $toname = JRequest::getvar( $namefield, '' );
      if ($toname != "") {
        $intro  = $divider1 . $eol . PHP_EOL;
        $intro .= JText::_( '_DM_HELLO' ) . $toname . "," . $eol . PHP_EOL;
        $subjectfinal = $toname . "! " . $subject;
      } else {
        $intro  = $divider1 . $eol . PHP_EOL;
		    $intro .= JText::_( '_DM_HELLO_2' ) . $eol . PHP_EOL;
        $subjectfinal = $subject;
      }
      $message = $intro . $text;

////////////////////////////////////////////////////////  Send the Emails
      $mail = JFactory::getMailer();
      if (($dm_msg_use == 1 && $dm_msg_html == 1) ||  ($dm_msg_user == 1 && $dm_msg_user_html == 1)) {
       	$mail->IsHTML( 1 );
      }
      $mail->addRecipient( $toemail );
      if ($replyname == "") {
        $replyname = "-";
      }
			$mail->addReplyTo( array( $replymail, $replyname ) );
      $mail->setSender( array ($fromemail, $fromname) );
      $mail->setSubject( $subjectfinal );
      $mail->setBody( $message );
      $success = $mail->Send();
////////////////////////////////////////////////////////  Compile the Results
      if ( $success ) {
        $list .= $toname . " [" . $toemail . "]<br />";
        $lista .= $toname . " [" . $toemail . "]" . $eol . PHP_EOL;
        $okay += 1;
      } else {
        $fail .= $toname . " [" . $toemail . "]<br />";
        $faila .= $toname . " [" . $toemail . "]" . $eol . PHP_EOL;
        $bad += 1;
        continue;
      }
    } else {
      continue;
    }
  }

/////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////  User's Copy if Requested
/////////////////////////////////////////////////////////////////////////////////////////////////

  $dm_ccuser = JRequest::getvar('dm_ccuser', 0);
  if ($dm_ccuser == 1) {
    $copy_user = $recommend_from_email;
    $copy_user_name = $recommend_from_name;

//---------------------------------------------- Message for User Copy

    $user_message = $divider2 . $eol . PHP_EOL . $eol . PHP_EOL;
    if ($dm_msg_html == 1 ||  $dm_msg_user_html == 1) {
      $user_message .= JText::_( '_DM_COPY_USER' ) . " <a href='" . $main_livesite . "'>" . $main_livesite . "</a> !!!" . $eol . PHP_EOL;
    } else {
      $user_message .= JText::_( '_DM_COPY_USER' ) . $main_livesite . " !!!" . $eol . PHP_EOL . $eol . PHP_EOL;
    }
    $user_message .= JText::_( '_DM_COPY_USER1' ) . $eol . PHP_EOL . $eol . PHP_EOL;
    $user_message .= $lista . $eol . PHP_EOL;
    $user_message .= $divider2 . $eol . PHP_EOL;

    if ($bad > 0) {
      $user_message .= JText::_( '_DM_FAIL_LIST' ) . $eol . PHP_EOL;
      $user_message .= $eol . PHP_EOL . $faila . $eol . PHP_EOL;
      $user_message .= $divider2 . $eol . PHP_EOL . $eol . PHP_EOL;
    }

    $user_message .= JText::_( '_DM_COPY_USER2' ) . $eol . PHP_EOL . $eol . PHP_EOL;
    $user_message .= $message . $eol . PHP_EOL;
    $user_message .= $divider2 . $eol . PHP_EOL . JText::_( '_DM_THANK_YOU' ) . $eol . PHP_EOL;

  	if ($dm_subject_use == 1 && $dm_subject != "") {
  		$subject = $dm_subject;
  	} else {
      if (isset($copy_user_name) && $copy_user_name != "") {
     		$subject = $copy_user_name . "!  " . JText::_( '_DM_COPY_USER' ) . $main_sitename . "!";
      } else {
     		$subject = JText::_( '_DM_COPY_USER' ) . $main_sitename . "!";
      }
    }

////////////////////////////////////////////////////////  Send the User Email Copy
    $mail = JFactory::getMailer();
    if (($dm_msg_use == 1 && $dm_msg_html == 1) ||  ($dm_msg_user == 1 && $dm_msg_user_html == 1)) {
     	$mail->IsHTML( 1 );
    }
    $mail->addRecipient( $copy_user );
    if ($copy_user_name == "") {
      $copy_user_name = "-";
    }
  	$mail->addReplyTo( array( $copy_user, $copy_user_name ) );
    $mail->setSender( array ($fromemail, $fromname) );
    $mail->setSubject( $subject );
    $mail->setBody( $user_message );
    $successbcc = $mail->Send();
////////////////////////////////////////////////////////  Compile the Results
    if ($copy_user != "") {
      if ( $successbcc ) {
        $list .= JText::_( '_DM_YOUR_COPY1' ) . $copy_user_name . " [" . $copy_user . "]<br />";
        $lista .= JText::_( '_DM_RECOMMEND_USER2' ) . $copy_user_name . " [" . $copy_user . "]" . $eol . PHP_EOL;
        $okay += 1;
      } else {
        $fail .= JText::_( '_DM_YOUR_COPY1' ) . $copy_user_name . " [" . $copy_user . "]<br />";
        $faila .= JText::_( '_DM_RECOMMEND_USER2' ) . $copy_user_name . " [" . $copy_user . "]" . $eol . PHP_EOL;
        $bad += 1;
        continue;
      }
    } else {
        continue;
    }
  }

/////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////  Admin Copy if Requested
/////////////////////////////////////////////////////////////////////////////////////////////////

  if ($dm_ccadmin == 1) {
    $copy_admin = $mainframe->getCfg('mailfrom');
    $copy_admin_name = $mainframe->getCfg('fromname');
    $copy_user = $recommend_from_email;
    $copy_user_name = $recommend_from_name;
//---------------------------------------------- Message for Admin Copy

    $admin_message = $divider2 . $eol . PHP_EOL . $eol . PHP_EOL;

    $admin_message .= JText::_( '_DM_ADMIN_NEWS' ) . $eol . PHP_EOL;
    if ($dm_msg_html == 1 ||  $dm_msg_user_html == 1) {
      $admin_message .= "<a href='" . $main_livesite . "'>" . $main_livesite . "</a> " . JText::_( '_DM_ADMIN_COPY' );
      $admin_message .= $eol . PHP_EOL . $eol . PHP_EOL;
    } else {
      $admin_message .= $main_livesite . JText::_( '_DM_ADMIN_COPY' ) . $eol . PHP_EOL . $eol . PHP_EOL;
    }
    if ($dm_ccuser != 1 && $recommend_from_name != "") {
      $lista .= '- ' . JText::_( '_DM_RECOMMEND_USER2' ) . $recommend_from_name . " [" . $recommend_from_email . "]" . $eol . PHP_EOL;
    } elseif ($dm_ccuser != 1) {
      $lista .= '- ' . JText::_( '_DM_RECOMMEND_USER1' ) . " [" . $recommend_from_email . "]" . $eol . PHP_EOL;
    }
    if ($dm_ccuser != 1) {
      $lista .= JText::_( '- User Bcc = No' ) . $eol . PHP_EOL;
    } else {
      $lista .= JText::_( '- User Bcc = Yes' ) . $eol . PHP_EOL;
    }
    $admin_message .= JText::_( '_DM_ADMIN_COPY1' ) . $eol . PHP_EOL . $eol . PHP_EOL;
    $admin_message .= $lista . $eol . PHP_EOL;
    $admin_message .= $divider2 . $eol . PHP_EOL . $eol . PHP_EOL;
    if ($bad > 0) {
      $admin_message .= JText::_( '_DM_FAIL_LIST' ) . $eol . PHP_EOL;
      $admin_message .= $eol . PHP_EOL . $faila . $eol . PHP_EOL;
      $admin_message .= $divider2 . $eol . PHP_EOL . $eol . PHP_EOL;
    }
    $admin_message .= JText::_( '_DM_ADMIN_COPY2' ) . $eol . PHP_EOL . $eol . PHP_EOL;
    $admin_message .= $message . $eol . PHP_EOL . $eol . PHP_EOL;
  	if ($dm_subject_use == 1 && $dm_subject != "") {
  		$subject = $dm_subject;
  	} else {
     	$subject = $copy_admin_name . " - " . JText::_( '_DM_ADMIN_NEWS' ) . " " . $main_sitename . JText::_( '_DM_ADMIN_COPY' );
    }

//////////////////////////////////////////////////  Send the Admin Email Copy - Not added to results
    $mail = JFactory::getMailer();
    if (($dm_msg_use == 1 && $dm_msg_html == 1) ||  ($dm_msg_user == 1 && $dm_msg_user_html == 1)) {
     	$mail->IsHTML( 1 );
    }
    $mail->addRecipient( $copy_admin );
    if ($copy_user_name == "") {
      $copy_user_name = "-";
    }
  	$mail->addReplyTo( array( $copy_user, $copy_user_name ) );
    $mail->setSender( array ($fromemail, $fromname) );
    $mail->setSubject( $subject );
    $mail->setBody( $admin_message );
    $successbccadmin = $mail->Send();
  }

/////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////  List Email Results/Summary on Redirect Page
/////////////////////////////////////////////////////////////////////////////////////////////////

  if ( $okay > 0 ) {
    echo  '<center><br /><b>' . $okay . JText::_( '_DM_SUCCESS' ) . '</b><br /><br />'
          . JText::_( '_DM_SUCCESS_LIST' ) . '<br /><hr />'
          . $list . '<hr />'
          . '<b>' . JText::_( '_DM_THANK_YOU' ) . '</b><br /><br />';
  }
  if ( $bad > 0 ) {
    echo  '<center><br /><b>' . $bad . JText::_( '_DM_FAIL' ) . '</b><br /><br />'
          . JText::_( '_DM_FAIL_LIST' ) . '<br /><hr />'
          . $fail . '<hr /><br /><br />';
  }
  echo '[ <a href="'.$base_url.'">' . JText::_( '_DM_BACK' ) . '</a> ]</center>';
  unset($_SESSION['CAPTCHA']);

} else {

/////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////  Begin Main RecommendFriends Form Display
/////////////////////////////////////////////////////////////////////////////////////////////////

//---------------------------------------------- Check if the User is Logged In or Not
  $user = &JFactory::getUser();
  $id = $user->get( 'id' );
	if (isset($id) && $id!="") {
		$query = "SELECT name, email FROM #__users WHERE id='$id'";
		$database->setQuery($query);
		$rows = $database->loadObjectList();
		$row = $rows[0];
		$recommend_from_name = $row->name;
		$recommend_from_email = $row->email;
	} else {                              // if not logged in
    $recommend_from_name = "";
    $recommend_from_email = "";
	}

/////////////////////////////////////////////////////////////////////////////  Begin Form Display
?>
<table width="100%" cellpadding="4" cellspacing="4" border="0" align="center" class="contentpane">
	<tr>
		<td><h1 class="componentheading"><?php echo JText::_( '_DM_TITLE' ); ?></h1></td>
	</tr>
	<tr>
    <td>

<?php

if (($dm_cap_use == 1) && ($recommend_option == "send") && ($_SESSION['CAPTCHA'] != $secure)) {
  echo '<hr /><p align = "center"><FONT color="Red"><b><i>' . JText::_( '_DM_CAPTCHA_ALERT' ) . '</i></b></font></p><hr />';
}

if ($recommend_from_email !== "") {
   echo JText::_( '_DM_USER_INSTRUCTIONS' );
   $validate = "return recommendvalidate()";
} else {
   echo JText::_( '_DM_USER_INSTRUCTIONS_1' );
   $validate = "return recommendvalidateall()";
}
if ($dm_cap_use == 1) {
   echo JText::_( '_DM_USER_INSTRUCTIONS_CAPTCHA' );
}
   echo JText::_( '_DM_USER_INSTRUCTIONS_THANKS' );
?>
<br />
<hr />
   <form name="recommend" method="post" action="<?php echo $base_url; ?>" onsubmit="<?php echo $validate; ?>">
     <table width="100%" border="0" cellspacing="0" cellpadding="0">
       <tr>
         <td height="28" width="266" valign="bottom"><?php echo JText::_( '_DM_YOUR_NAME' ); ?></td>
         <td height="28" valign="bottom"><?php echo JText::_( '_DM_YOUR_EMAIL' ); ?></td>
       </tr>
       <tr>
<?php

//---------------------------------------------- If User is Logged In
if ($recommend_from_email !== "") {
?>
         <td height="28" width="266" valign="top">
          <input name="recommend_from_name" type="text" <?php if (($dm_loggedbg != "")&&($dm_loggedtx != "")){echo 'style="background-color:#'.$dm_loggedbg.'; color:#'.$dm_loggedtx.';"';}else{echo 'class="inputbox"';}; ?> value="<?php if(isset($_POST['recommend_from_name'])){echo $_POST['recommend_from_name'];}else{echo $recommend_from_name;}?>" size="<?php if (($dm_namew != "")&&(is_numeric($dm_namew))){echo $dm_namew;}else{echo '35';}; ?>" readonly onkeypress="return handleEnter(this, event)" /></td>
         <td height="28" valign="top">
          <input name="recommend_from_email" type="text" <?php if (($dm_loggedbg != "")&&($dm_loggedtx != "")){echo 'style="background-color:#'.$dm_loggedbg.'; color:#'.$dm_loggedtx.';"';}else{echo 'class="inputbox"';}; ?> value="<?php if(isset($_POST['recommend_from_email'])){echo $_POST['recommend_from_email'];}else{echo $recommend_from_email;}?>" size="<?php if (($dm_emailw != "")&&(is_numeric($dm_emailw))){echo $dm_emailw;}else{echo '45';}; ?>" readonly onkeypress="return handleEnter(this, event)" /></td>
       </tr>
<?php
} else {
//---------------------------------------------- If User is NOT Logged In
?>
         <td width="266" height="28" valign="top">
          <input name="recommend_from_name" type="text" <?php if (($dm_formbg != "")&&($dm_formtx != "")){echo 'style="background-color:#'.$dm_formbg.'; color:#'.$dm_formtx.';"';}else{echo 'class="inputbox"';}; ?> value="<?php if(isset($_POST['recommend_from_name'])){echo $_POST['recommend_from_name'];}else{echo $recommend_from_name;} ?>" size="<?php if (($dm_namew != "")&&(is_numeric($dm_namew))){echo $dm_namew;}else{echo '35';}; ?>" onkeypress="return handleEnter(this, event)" />
         </td>
         <td height="28" valign="top">
          <input name="recommend_from_email" type="text" <?php if (($dm_formbg != "")&&($dm_formtx != "")){echo 'style="background-color:#'.$dm_formbg.'; color:#'.$dm_formtx.';"';}else{echo 'class="inputbox"';}; ?> value="<?php if(isset($_POST['recommend_from_email'])){echo $_POST['recommend_from_email'];}else{echo $recommend_from_email;} ?>" size="<?php if (($dm_emailw != "")&&(is_numeric($dm_emailw))){echo $dm_emailw;}else{echo '45';}; ?>" onkeypress="return handleEnter(this, event)" /><font color="red"><b>**</b></font></td>
       </tr>
<?php } ?>
       <tr>
         <td width="266" height="28" valign="bottom"><?php echo JText::_( '_DM_FRIEND1_NAME' ); ?></td>
         <td height="28" valign="bottom"><?php echo JText::_( '_DM_FRIEND1_EMAIL' ); ?></td>
       </tr>
       <?php
/////////////////////////////////////////////////////// Display Required Number of Friends Fields
       for ($i = 0; $i < $dm_numrec; $i++) {
?>
         <tr>
           <td width="266" height="28" valign="top">
             <input type="text" name="recommend_to_name<?php echo $i;?>" size="<?php if (($dm_namew != "")&&(is_numeric($dm_namew))){echo $dm_namew;}else{echo '35';}; ?>" <?php if (($dm_formbg != "")&&($dm_formtx != "")){echo 'style="background-color:#'.$dm_formbg.'; color:#'.$dm_formtx.';"';}else{echo 'class="inputbox"';}; ?> value="<?php if(isset($_POST['recommend_to_name' . $i ])){echo $_POST['recommend_to_name' . $i ];}else{echo "";} ?>" onkeypress="return handleEnter(this, event)" />
           </td>
           <td height="28" valign="top">
             <input type="text" name="recommend_to_email<?php echo $i;?>" size="<?php if (($dm_emailw != "")&&(is_numeric($dm_emailw))){echo $dm_emailw;}else{echo '45';}; ?>" <?php if (($dm_formbg != "")&&($dm_formtx != "")){echo 'style="background-color:#'.$dm_formbg.'; color:#'.$dm_formtx.';"';}else{echo 'class="inputbox"';}; ?> value="<?php if(isset($_POST['recommend_to_email' . $i ])){echo $_POST['recommend_to_email' . $i ];}else{echo "";} ?>" onkeypress="return handleEnter(this, event)" /><?php if ($i == 0) { echo '<font color="red"><b>**</b></font>'; } ?>
           </td>
         </tr>
<?php
       }
/////////////////////////////////////////////////////// Show User Custom Message Field if Enabled
       if ($dm_msg_user == 1) {
?>
         <tr>
           <td colspan="2" height="28" valign="bottom"><?php echo JText::_( '_DM_MESSAGE' ); ?></td>
         </tr>
         <tr>
           <td colspan="2" height="123" valign="top"><textarea name="recommend_text" id="recommend_text" <?php if (($dm_formbg != "")&&($dm_formtx != "")){echo 'style="background-color:#'.$dm_formbg.'; color:#'.$dm_formtx.';"';}else{echo 'class="inputbox"';}; ?> rows="<?php if (($dm_userrows != "")&&(is_numeric($dm_userrows))){echo $dm_userrows;}else{echo '8';}; ?>" cols="<?php if (($dm_usercols != "")&&(is_numeric($dm_usercols))){echo $dm_usercols;}else{echo '55';}; ?>"><?php if (isset($_POST['recommend_text'])){ echo $_POST['recommend_text'];} ?></textarea></td>
         </tr>
<?php
         if ($dm_msg_user_html == 1) {
?>
           <tr>
             <td colspan="2" height="48" valign="top"><?php echo JText::_( '_DM_MESSAGE_HTML' ); ?><br /><br /></td>
           </tr>
<?php
        }
      }
/////////////////////////////////////////////////////////////// Show Checkbox for User Bcc (copy)
?>
       <tr>
          <td colspan="2" height="28">
      			<input type="checkbox" name="dm_ccuser" <?php if (($dm_formbg != "")&&($dm_formtx != "")){echo 'style="background-color:#'.$dm_formbg.'; color:#'.$dm_formtx.';"';}else{echo 'class="inputbox"';}; ?> value="1" <?php if (isset($_POST['dm_ccuser']) && $_POST['dm_ccuser'] == 1){echo "CHECKED";} ?> />&nbsp;<?php echo JText::_( '_DM_CC_USER' ); ?>
          </td>
       </tr>
       <tr>
         <td colspan="2" height="1"></td>
       </tr>
<?php
///////////////////////////////////////////////////////////////////////// Show Captcha if Enabled
       if ($dm_cap_use == 1) {
?>
         <tr>
           <td colspan="2">
             <table width="100%">
               <tr>
                 <td colspan="2">
                   <br /><?php echo JText::_( '_DM_CAPTCHA_INFO1' ); ?>
                 </td>
               </tr>
               <tr>
                 <td valign="middle" width="10%">
                   <img name="captcha" style="border: 1px solid #719595;" src="<?php echo JURI::base(); ?>index.php?option=com_recommendfriends&amp;func=captcha" alt="Security Image" />
                 </td>
                 <td valign="middle">
                   &nbsp;<a href="javascript: refreshcaptcha();"><img src="<?php echo JURI::base().'components/'.$option.'/includes/reload.jpg'; ?>" alt="Reload Security Image" /></a>
                   &nbsp;<a href="javascript: refreshcaptcha();"><?php echo JText::_( '_DM_CAPTCHA_INFO2' ); ?></a>
                   &nbsp;-&nbsp;<?php echo _DM_CAPTCHA_INFO3; ?>
                 </td>
               </tr>
               <tr>
                 <td colspan="2" width="75%">
                   <?php echo JText::_( '_DM_CAPTCHA_INFO4' ); ?><br />
                   <input id="security_code" name="security_code" type="text"  <?php if (($dm_formbg != "")&&($dm_formtx != "")){echo 'style="background-color:#'.$dm_formbg.'; color:#'.$dm_formtx.';"';}else{echo 'class="inputbox"';}; ?> /><font color="red"><b>**</b></font>
                 </td>
               </tr>
             </table>
           </td>
         </tr>
<?php
       }
////////////////////////////////////////////////////////////////////////////// Form Submit Button
?>
       <tr>
         <td colspan="2" height="1"></td>
       </tr>
       <tr>
         <td colspan="2" height="55">
            <input type="submit" name="Submit" value="<?php echo JText::_( '_DM_SEND' ); ?>" class="button" />
            <input name="recommend_option" type="hidden" id="recommend_option" value="send" />
         </td>
       </tr>
     </table>
     <?php echo JHTML::_( 'form.token' ); ?>
   </form>
    </td>
	</tr>
</table>
<script type="text/javascript">
<!--
function refreshcaptcha() {
	var answer = confirm('<?php echo JText::_('_DM_CAP_REFRESH_ALERT'); ?>');
	if (answer==true){
		window.location.reload();
	}
}
//-->
</script>
<?php
}

/////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////  Captcha Class and Functions
/////////////////////////////////////////////////////////////////////////////////////////////////

class CaptchaSecurityImages {

	function generateCode($chars) {
		/* list all possible characters, similar looking characters and vowels have been removed */
		$possible = '23456789bcdfghjkmnpqrstvwxyz';
		$code = '';
		$i = 0;
		while ($i < $chars) {
			$code .= substr($possible, mt_rand(0, strlen($possible)-1), 1);
			$i++;
		}
		return $code;
	}

	function CaptchaSecurityImages($width,$height,$chars,$rotate,$font,$bgrgb,$txrgb,$nrgb) {
		$code = $this->generateCode($chars);
		/* font size will be 50% of the image height */
		$font_size = $height * 0.5;
		$image = @imagecreate($width, $height) or die('Cannot initialize new GD image stream');
		/* set the colours */
		$background_color = imagecolorallocate($image, $bgrgb[0], $bgrgb[1], $bgrgb[2]); //background color
		$text_color = imagecolorallocate($image, $txrgb[0], $txrgb[1], $txrgb[2]);   //text color
		$noise_color = imagecolorallocate($image, $nrgb[0], $nrgb[1], $nrgb[2]);  //noise color
		/* generate random dots in background */
		for( $i=0; $i<($width*$height)/3; $i++ ) {
			imagefilledellipse($image, mt_rand(0,$width), mt_rand(0,$height), 1, 1, $noise_color);
		}
		/* generate random lines in background */
		for( $i=0; $i<($width*$height)/150; $i++ ) {
			imageline($image, mt_rand(0,$width), mt_rand(0,$height), mt_rand(0,$width), mt_rand(0,$height), $noise_color);
		}
		/* create textbox and add text */
    $angle = $rotate * (5*rand(0,4) - 10); // random rotation -10 to +10 degrees
		$textbox = imagettfbbox($font_size, $angle, $font, $code) or die('Error in imagettfbbox function');
		$x = ($width - $textbox[4])/2;
		$y = ($height - $textbox[5])/2;
		imagettftext($image, $font_size, $angle, $x, $y, $text_color, $font , $code) or die('Error in imagettftext function');
		/* output captcha image to browser */
		header('Content-Type: image/jpeg');
		imagejpeg($image);
		imagedestroy($image);
		$_SESSION['CAPTCHA'] = $code;
	}
}

?>