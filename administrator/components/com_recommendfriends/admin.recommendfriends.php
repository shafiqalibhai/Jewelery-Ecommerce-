<?php
/**
*	RecommendFriends Component for Joomla! - for Site Promotion
*
* @version $Id: admin.recommendfriends.php - v2.0.3 - January-06-2009 - D-Mack Media
* @package Joomla
* @subpackage RecommendFriends
* @copyright (c) 2007-2010 D-Mack Media, dmackmedia.com
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
*
* This is free software
**/

defined( '_JEXEC' ) or die( 'Restricted access' );

global $mainframe, $option;

$componentpath = JPATH_COMPONENT_SITE.DS."includes".DS;

// ensure user has access to this function
$my=&JFactory::getUser();
$acl=&JFactory::getACL();
if(!$my->gid == 25) {
	$mainframe->redirect( 'index2.php', _NOT_AUTH);
}

require_once( $mainframe->getPath( 'admin_html' ) );
$id 	= intval( JRequest::getvar( 'id', 0 ) );
$cid 	= JRequest::getvar( 'cid', array(0) );
if (!is_array( $cid )) {
	$cid = array(0);
}

$language = JFactory::getLanguage();
$tag = $language->getTag();
if (file_exists($componentpath."$tag.php")) {
	include_once($componentpath."$tag.php");
} else {
	include_once($componentpath."en-GB.php");
}

if (isset($_GET['task'])) {
  $task = $_GET['task'];
}

switch ($task) {
	case 'Information': {
		about($option);
  	break;
  }
	case 'SaveSettings': {
		saveConfig($option);
  	break;
  }
	case "Configuration": {
		showConfig($option);
  	break;
  }
	case "Language": {
		showLanguage($option);
  	break;
  }
	case 'SaveLanguage': {
		saveLanguage($option);
  	break;
  }
	case 'cancel': {
		showConfig($option);
  	break;
  }
	case 'back': {
		showConfig($option);
  	break;
  }
	default: {
		showConfig($option);
  	break;
	}
}

function about($option) {
	global $mainframe, $option;
	HTML_recommendfriends::about($option);
}

function showConfig($option) {
	global $mainframe, $option;
  include_once( JPATH_COMPONENT_ADMINISTRATOR.DS."config.recommendfriends.php" );
	$params = array();
	$params['dm_numrec']         = $dm_numrec;
	$params['dm_mail_from']      = $dm_mail_from;
	$params['dm_ccadmin']        = $dm_ccadmin;
	$params['dm_subject_use']    = $dm_subject_use;
	$params['dm_subject']        = $dm_subject;
	$params['dm_msg_use']        = $dm_msg_use;
	$params['dm_msg_html']       = $dm_msg_html;
  $params['dm_htmlcheck']      = $dm_htmlcheck;
	$params['dm_msg']     	     = $dm_msg;
	$params['dm_msg_user']       = $dm_msg_user;
	$params['dm_msg_user_html']  = $dm_msg_user_html;
	$params['dm_namew']          = $dm_namew;
	$params['dm_emailw']         = $dm_emailw;
	$params['dm_userrows']       = $dm_userrows;
	$params['dm_usercols']       = $dm_usercols;
	$params['dm_formbg'] 	       = $dm_formbg;
	$params['dm_formtx'] 	       = $dm_formtx;
	$params['dm_errorbg']        = $dm_errorbg;
	$params['dm_errortx']        = $dm_errortx;
	$params['dm_loggedbg']       = $dm_loggedbg;
	$params['dm_loggedtx']       = $dm_loggedtx;
	$params['dm_cap_use']        = $dm_cap_use;
	$params['dm_width'] 	       = $dm_width;
	$params['dm_height'] 	       = $dm_height;
	$params['dm_chars'] 	       = $dm_chars;
	$params['dm_rotate'] 	       = $dm_rotate;
	$params['dm_font'] 	         = $dm_font;
	$params['dm_bghex'] 	       = $dm_bghex;
	$params['dm_txhex'] 	       = $dm_txhex;
	$params['dm_nhex'] 	         = $dm_nhex;
	HTML_recommendfriends::showConfig($params, $option);
}

/* Save configuration form @param string The current GET/POST option */
function saveConfig($option) {
	global $option, $mainframe;
	$configfile = JPATH_COMPONENT_ADMINISTRATOR.DS."config.recommendfriends.php";
	@chmod ($configfile, 0777);
	$permission = @is_writable($configfile);
	if (!$permission) {
    $mainframe->redirect( 'index2.php?option=$option', 'Configuration file not writable!' );
	  break;
	}
  $dm_numrec         = JRequest::getvar('dm_numrec', '4');
  $dm_mail_from      = JRequest::getvar('dm_mail_from', 1);
  $dm_ccadmin        = JRequest::getvar('dm_ccadmin', 1);
  $dm_subject_use    = JRequest::getvar('dm_subject_use', 1);
  $dm_subject        = JRequest::getvar('dm_subject', 'Subject');
  $dm_msg_use        = JRequest::getvar('dm_msg_use', 1);
  $dm_msg_html       = JRequest::getvar('dm_msg_html', 1);
  $dm_htmlcheck      = JRequest::getvar('dm_htmlcheck', '');
  if ($dm_htmlcheck == 'true') {
    $dm_msg          = addslashes(JRequest::getVar( 'dm_msg','Message Body', 'post', 'string',JREQUEST_ALLOWRAW));
  } else {
    $dm_msg          = addslashes(JRequest::getVar( 'dm_msg','Message Body', 'post', 'string'));
  }
  $dm_msg_user       = JRequest::getvar('dm_msg_user', 1);
  $dm_msg_user_html  = JRequest::getvar('dm_msg_user_html', 1);
  $dm_namew          = JRequest::getvar('dm_namew', '35');
  $dm_emailw         = JRequest::getvar('dm_emailw', '45');
  $dm_userrows       = JRequest::getvar('dm_userrows', '8');
  $dm_usercols       = JRequest::getvar('dm_usercols', '55');
  $dm_formbg         = JRequest::getvar('dm_formbg', 'CFCFCF');
  $dm_formtx         = JRequest::getvar('dm_formtx', '0E0B48');
  $dm_errorbg        = JRequest::getvar('dm_errorbg', '483D8B');
  $dm_errortx        = JRequest::getvar('dm_errortx', 'FFFFFF');
  $dm_loggedbg       = JRequest::getvar('dm_loggedbg', '5A5A5A');
  $dm_loggedtx       = JRequest::getvar('dm_loggedtx', 'FFFFFF');
  $dm_cap_use        = JRequest::getvar('dm_cap_use', 1);
  $dm_width          = JRequest::getvar('dm_width', '120');
  $dm_height         = JRequest::getvar('dm_height', '40');
  $dm_chars          = JRequest::getvar('dm_chars', '5');
  $dm_rotate         = JRequest::getvar('dm_rotate', 1);
  $dm_font           = JRequest::getvar('dm_font', 'monofont.ttf');
  $dm_bghex          = JRequest::getvar('dm_bghex', '0C0C0C');
  $dm_txhex          = JRequest::getvar('dm_txhex', 'FFFFFF');
  $dm_nhex           = JRequest::getvar('dm_nhex', 'FF0000');
  $config =
  '<?php
  $dm_numrec         = "'.$dm_numrec.'";
  $dm_mail_from      = '.($dm_mail_from ? 0 : 1).';
  $dm_ccadmin        = '.($dm_ccadmin ? 0 : 1).';
  $dm_subject_use    = '.($dm_subject_use ? 0 : 1).';
  $dm_subject        = "'.$dm_subject.'";
  $dm_msg_use        = '.($dm_msg_use ? 0 : 1).';
  $dm_msg_html       = '.($dm_msg_html ? 0 : 1).';
  $dm_htmlcheck      = "'.$dm_htmlcheck.'";
  $dm_msg            = "'.$dm_msg.'";
  $dm_msg_user       = '.($dm_msg_user ? 0 : 1).';
  $dm_msg_user_html  = '.($dm_msg_user_html ? 0 : 1).';
  $dm_namew          = "'.$dm_namew.'";
  $dm_emailw         = "'.$dm_emailw.'";
  $dm_userrows       = "'.$dm_userrows.'";
  $dm_usercols       = "'.$dm_usercols.'";
  $dm_formbg         = "'.$dm_formbg.'";
  $dm_formtx         = "'.$dm_formtx.'";
  $dm_errorbg        = "'.$dm_errorbg.'";
  $dm_errortx        = "'.$dm_errortx.'";
  $dm_loggedbg       = "'.$dm_loggedbg.'";
  $dm_loggedtx       = "'.$dm_loggedtx.'";
  $dm_cap_use        = '.($dm_cap_use ? 0 : 1).';
  $dm_width 	    	 = "'.$dm_width.'";
  $dm_height 		     = "'.$dm_height.'";
  $dm_chars 		     = "'.$dm_chars.'";
  $dm_rotate 		     = '.($dm_rotate ? 0 : 1).';
  $dm_font 		       = "'.$dm_font.'";
  $dm_bghex 		     = "'.$dm_bghex.'";
  $dm_txhex 		     = "'.$dm_txhex.'";
  $dm_nhex 		       = "'.$dm_nhex.'";
  ?>';

?>
<?php
  if ($fp = @fopen("$configfile", "w")) {
  	@fputs($fp, $config, strlen($config));
  	@fclose ($fp);
  }
  $mainframe->redirect( "index2.php?option=$option&task=Configuration", JText::_( '_DM_CONFIG_SAVED' ) );
}

function showLanguage($option) {
  global $mainframe, $option;
  $componentpath = JPATH_COMPONENT_SITE.DS."includes".DS;
  $language = JFactory::getLanguage();
  $tag = $language->getTag();
  if (file_exists($componentpath."$tag.php")) {
  	$file = $componentpath."$tag.php";
  } else {
  	$file = $componentpath."en_GB.php";
  }
	  HTML_recommendfriends::showSource($file,$option);
}

function saveLanguage( $option ) {
  global $mainframe, $option;
  $componentpath = JPATH_COMPONENT_SITE.DS."includes".DS;
  $file 		 = JRequest::getvar('file', '' );
  $filecontent = $_POST['filecontent'];
  if (!$filecontent) {
    $mainframe->redirect( "index2.php?option=$option&act=settings", JText::_( '_DM_LANG_EMPTY' ) );
  }
  $language = JFactory::getLanguage();
  $tag = $language->getTag();
  if (file_exists($componentpath."$tag.php")) {
  	$file = $componentpath."$tag.php";
  } else {
  	$file = $componentpath."en_GB.php";
  }
  $enable_write = JRequest::getvar('enable_write',0);
  $oldperms = fileperms($file);
  if ($enable_write) @chmod($file, $oldperms | 0222);
  clearstatcache();
  if (is_writable( $file ) == false) {
    $mainframe->redirect( "index2.php?option=$option&task=Language", JText::_( '_DM_LANG_IS_NOT_WRITEABLE' ) );
  }
  if ($fp = fopen ($file, "w")) {
    fputs( $fp, stripslashes( $filecontent ) );
    fclose( $fp );
    if ($enable_write) {
      @chmod($file, $oldperms);
    } else {
      if (JRequest::getvar('disable_write',0))
      @chmod($file, $oldperms & 0777555);
    }
    $mainframe->redirect( "index2.php?option=$option&task=Language", JText::_( '_DM_LANG_SAVED' ) );
  } else {
    if ($enable_write) @chmod($file, $oldperms);
    $mainframe->redirect( "index2.php?option=$option&task=Language", JText::_( '_DM_LANG_IS_NOT_WRITEABLE' ) );
  }
}
?>