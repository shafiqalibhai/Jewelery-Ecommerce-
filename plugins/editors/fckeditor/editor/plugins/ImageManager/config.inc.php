<?php
/**
 * Image Manager configuration file.
 * @author Wei Zhuo
 * @author Paul Moers <mail@saulmade.nl> - watermarking and replace code + several small enhancements <http://fckplugins.saulmade.nl>
 * @version $Id: config.inc.php,v 1.4 2006/12/17 14:53:50 thierrybo Exp $
 * @package ImageManager
 */


/* 
 File system path to the directory you want to manage the images
 for multiple user systems, set it dynamically.

 NOTE: This directory requires write access by PHP. That is, 
       PHP must be able to create files in this directory.
	   Able to create directories is nice, but not necessary.
*/

// AW added

 //Cause browser to reload page every time
header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past



//load up Joomla Framework   AW




$IMConfig = array();


define('DS',DIRECTORY_SEPARATOR);

//get root folder
$dir = explode(DS,dirname(__FILE__));

array_splice($dir,-6);

$base_folder = implode(DS,$dir);

$ip_recorded_for_jusr = '';
$ip = md5($_SERVER['REMOTE_ADDR']);
$base_path = '';
$user = '';

if(is_dir($base_folder.DS.'libraries'.DS.'joomla'))   
{

	define( '_JEXEC', 1 );
	define('JPATH_BASE',$base_folder);
	
	require_once ( JPATH_BASE .DS.'includes'.DS.'defines.php' );
	
	/* Load in the configuation file */
	require_once( JPATH_CONFIGURATION	.DS.'configuration.php' );
	
	/*load loader class */
	require_once(JPATH_LIBRARIES .DS.'loader.php' );
	
	/* Load Joomla's required classes */
		
	/* Load Joomla's required classes */
		
	jimport('joomla.base.object');
	jimport('joomla.text');
	jimport('joomla.filter.input');
	jimport('joomla.database.database');
	jimport('joomla.factory');
	jimport('joomla.error.error');
	jimport('joomla.environment.uri');
		
	
	
	
	//get image directory
	
	// Get base URL

	$url = preg_replace('@/plugins/.*/imagemanager/@i','/',JURI::root());
	
	//get system parameters
	$JConfig = new JConfig();
			
	//get DB intstance
		
	$database =  &  JDatabase::getInstance(array('driver'=>$JConfig->dbtype,'host'=>$JConfig->host,'user'=>$JConfig->user,'password'=>$JConfig->password,
									'database'=>$JConfig->db,'prefix'=>$JConfig->dbprefix));
									
									
	$expired_time = time() - ($JConfig->lifetime * 60);						
	
	$sql ='select ips.session_id from #__session ips '
	. 'join #__session uip on uip.session_id = ips.data '
	. 'where ips.session_id =\'' .$ip . '\' and uip.gid > 18 '
	. 'and uip.time > ' .$expired_time;								
									
	$database->setQuery( $sql);
	$ip_recorded_for_jusr = $database->loadResult();
	
	$base_path = JPATH_BASE;
	$sql =  "SELECT params FROM #__plugins WHERE element = 'fckeditor' AND folder ='editors'" ;
	unset($JConfig);
							
							
							
								
}
else
{
	/* Load in the configuation file */
	require_once( '../../../../../../configuration.php' );
	/* Load Joomla's DB Class */
	if(!defined('_JEXEC')) 
		define('_VALID_MOS',1);
	require_once( '../../../../../../includes/database.php' );
	/* Create a new Instance */
	$database = new database( $mosConfig_host, $mosConfig_user, $mosConfig_password, $mosConfig_db, $mosConfig_dbprefix, $mosConfig_offline );
	
	// Get base URL
	$url = $mosConfig_live_site . '/';
	
	$expired_time = time() - $mosConfig_lifetime;

	$sql ='select ips.session_id from #__session ips '
	. 'join #__session uip on uip.session_id = ips.username '
	. 'join #__users usr on usr.id = uip.userid '
	. 'where ips.session_id =\'' .$ip . '\' and usr.gid > 18 '
	. 'and uip.time > ' .$expired_time;
	
	$database->setQuery( $sql);
	$ip_recorded_for_jusr = $database->loadResult();
	$base_path = $mosConfig_absolute_path;
	$sql =  "SELECT params FROM #__mambots  WHERE element = 'legacy.fckeditor' AND folder ='editors'";

}


if(!$ip_recorded_for_jusr)
{
 echo "<script>alert('Access is denied because user session has expired.')</script>";
 exit;
}

/* Need to access the database to get the image path */

$database->setQuery( $sql );
$result = $database->loadResult();

preg_match('/imagePath=(.*)\n/', $result, $location, PREG_OFFSET_CAPTURE);

if(!empty($location))
	$imagePath = $location[1][0];
else
	$imagePath = 'images/stories';
	
preg_match('/userfolder=(.*)\n?/', $result, $location, PREG_OFFSET_CAPTURE);

if(!empty($location))
	$use_userfolder = $location[1][0];
else
	$use_userfolder = 0;

if($use_userfolder)
{
 
  
	if(defined('_JEXEC'))
	{   
		$sql =  "select case when usr.usertype != 'Super Administrator'  then lower(usr.username) else '' end as username from #__session ips "
		. "join #__session uip on uip.session_id = ips.data "
		. "join #__users usr on usr.id = uip.userid "
		. "where ips.session_id  = '" .$ip_recorded_for_jusr . "'";
		
			
	}
	else
	{
			
		$sql = "select case when usr.usertype != 'Super Administrator'  then lower(usr.username) else '' end as username from #__session ips "
		. "join #__session uip on uip.session_id = ips.username "
		. "join #__users usr on usr.id = uip.userid "
		. "where ips.session_id  = '" .$ip_recorded_for_jusr . "'";
	} 

	$database->setQuery( $sql );
	$user = $database->loadResult();
}	
	

$IMConfig['root_dir'] =  $base_path   .DS . $imagePath;
$IMConfig['base_dir'] =  $IMConfig['root_dir'];
if($user)
{
	$IMConfig['base_dir'] = $IMConfig['base_dir'].DS . $user;
	$path = $IMConfig['base_dir'];
	if(!is_dir($path))
	{
	  //create folder
	  $origmask =  @umask(0);
	   if(!@mkdir($path,0755))
	   {
		 if(!@mkdir($path,0777))
			@umask($origmask);
			echo '<script>alert("Could not create user folder");</script>';
			exit;
	   }
	   
	   @umask($origmask);
	}
	
	
	
/*
 The URL to the above path, the web browser needs to be able to see it.
 It can be protected via .htaccess on apache or directory permissions on IIS,
 check you web server documentation for futher information on directory protection
 If this directory needs to be publicly accessiable, remove scripting capabilities
 for this directory (i.e. disable PHP, Perl, CGI). We only want to store assets
 in this directory and its subdirectories.
*/

	$IMConfig['base_url'] = $url . $imagePath .DS .$user;
}
else
{
	$IMConfig['base_url'] = $url . $imagePath;

}

$IMConfig['base_root'] = $url . $imagePath;


$IMConfig['server_name'] = $_SERVER['SERVER_NAME'];

/*
 demo - when true, no saving is allowed
*/
$IMConfig['demo'] = false;

/*

  Possible values: true, false

  TRUE - If PHP on the web server is in safe mode, set this to true.
         SAFE MODE restrictions: directory creation will not be possible,
		 only the GD library can be used, other libraries require
		 Safe Mode to be off.

  FALSE - Set to false if PHP on the web server is not in safe mode.
*/
$IMConfig['safe_mode'] = false;

/* 
 Possible values: 'GD', 'IM', or 'NetPBM'

 The image manipulation library to use, either GD or ImageMagick or NetPBM.
 If you have safe mode ON, or don't have the binaries to other packages, 
 your choice is 'GD' only. Other packages require Safe Mode to be off.
*/
define('IMAGE_CLASS', 'GD');


/*
 After defining which library to use, if it is NetPBM or IM, you need to
 specify where the binary for the selected library are. And of course
 your server and PHP must be able to execute them (i.e. safe mode is OFF).
 GD does not require the following definition.
*/
define('IMAGE_TRANSFORM_LIB_PATH', '/usr/bin/');


/* ==============  OPTIONAL SETTINGS ============== */


/*
  The prefix for thumbnail files, something like .thumb will do. The
  thumbnails files will be named as "prefix_imagefile.ext", that is,
  prefix + orginal filename.
*/
$IMConfig['thumbnail_prefix'] = '.';

/*
  Thumbnail can also be stored in a directory, this directory
  will be created by PHP. If PHP is in safe mode, this parameter
  is ignored, you can not create directories. 

  If you do not want to store thumbnails in a directory, set this
  to false or empty string '';
*/
$IMConfig['thumbnail_dir'] = '.thumbs';

/*
  Possible values: true, false

 TRUE -  Allow the user to create new sub-directories in the
         $IMConfig['base_dir'].

 FALSE - No directory creation.

 NOTE: If $IMConfig['safe_mode'] = true, this parameter
       is ignored, you can not create directories
*/
$IMConfig['allow_new_dir'] = true;

/*
  Possible values: true, false

  TRUE - Allow the user to upload files.

  FALSE - No uploading allowed.
*/
$IMConfig['allow_upload'] = true;

/*
  Possible values: true, false

  TRUE - Allow the user to edit images.

  FALSE - No editing allowed.
*/
$IMConfig['allow_edit'] = true;

/*
  Possible values: true, false

  TRUE - Allow the replacement of the image with a newly uploaded image in the editor dialog.

  FALSE - No replacing allowed.
*/
$IMConfig['allow_replace'] = true;

/*
  Possible values: true, false

  TRUE - Allow the deletion of images

  FALSE - No deleting allowed
*/
$IMConfig['allow_delete'] = false;

/*
  Possible values: true, false

  TRUE - Allow the user to enter a new filename for saving the edited image.

  FALSE - Overwrite
*/
$IMConfig['allow_newFileName'] = false;

/*
  Possible values: true, false
  Only applies when the the user can enter a new filename (The baove settig = 'allow_newFileName' true)

  TRUE - Overwrite file of entered filename, if file already exist.

  FALSE - Save to variant of entered filename, if file already exist.
*/
$IMConfig['allow_overwrite'] = false;

/*
  Specify the paths of the watermarks to use (relative to $IMConfig['base_dir']).
  Specifying none will hide watermarking functionality.
 */
 
$WMbaseFolder =  '/watermark/';

$path = $IMConfig['root_dir'] .$WMbaseFolder;
$IMConfig['watermarks'] = array();	
$exclude = array("Thumbs.db");
//check to see if folder exisrs

if(!is_dir($path))
{
  //create folder
  $origmask =  @umask(0);
   if(!@mkdir($path,0755))
   {
   	 if(!@mkdir($path,0777))
	 	@umask($origmask);
	 	echo '<script>alert("Could not create watermark folder");</script>';
		exit;
   }
   //copy files
   
   $spath = dirname(__FILE__)  . DS . 'img' .DS . 'watermark';  
   
   $handle = opendir($spath);
	while (($file = readdir($handle)) !== false)
	{
		if (($file != '.') && ($file != '..') && (!in_array($file,$exclude))) {
			if(!is_dir($spath . DS . $file))
			{
			
				if(!@copy($spath .DS . $file,$path .DS . $file))
				{
					echo '<script>alert("Could not copy $file to watermark folder");</script>';
					exit;
				}
  				$IMConfig['watermarks'][] = $WMbaseFolder . $file;
			}
					
		}
			
	}
	closedir($handle);
   @umask($origmask);

}
else
{
	//load water file array
	$handle = opendir($path);
	while (($file = readdir($handle)) !== false)
	{
		if (($file != '.') && ($file != '..') && (!in_array($file,$exclude))) {
			if(!is_dir($path . DS . $file))
			{
				$IMConfig['watermarks'][] = $WMbaseFolder . $file;
			}
					
		}
			
	}
	closedir($handle);
}

/*
	To limit the width and height for uploaded files, specify the maximum pixeldimensions.
	Specify more widthxheight sets by copying both lines and increasing the number in the second brackets.
	If only one set is specified, no select list will show and this set will be used by default.
	Setting the single set its values to either zero or empty will allow any size.
*/
//$IMConfig['maxWidth'][0] = 333;
//$IMConfig['maxHeight'][0] = 333;
//$IMConfig['maxWidth'][1] = 100;
//$IMConfig['maxHeight'][1] = 180;
$IMConfig['maxWidth'][0] = 550;  
$IMConfig['maxHeight'][0] = 350;
$IMConfig['maxWidth'][1] = 1000;  
$IMConfig['maxHeight'][1] = 1000;


/*
 Possible values: true, false

 TRUE - If set to true, uploaded files will be validated based on the 
        function getImageSize, if we can get the image dimensions then 
        I guess this should be a valid image. Otherwise the file will be rejected.

 FALSE - All uploaded files will be processed.

 NOTE: If uploading is not allowed, this parameter is ignored.
*/
$IMConfig['validate_images'] = true;

/*
 The default thumbnail if the thumbnails can not be created, either
 due to error or bad image file.
*/
$IMConfig['default_thumbnail'] = 'img/default.gif';

/*
  Thumbnail dimensions.
*/
$IMConfig['thumbnail_width'] = 96;
$IMConfig['thumbnail_height'] = 96;

/*
  Image Editor temporary filename prefix.
*/
$IMConfig['tmp_prefix'] = '.editor_';
?>