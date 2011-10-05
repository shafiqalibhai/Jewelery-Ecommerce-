<?php
/*
 * FCKeditor - The text editor for Internet - http://www.fckeditor.net
 * Copyright (C) 2003-2007 Frederico Caldeira Knabben
 *
 * == BEGIN LICENSE ==
 *
 * Licensed under the terms of any of the following licenses at your
 * choice:
 *
 *  - GNU General Public License Version 2 or later (the "GPL")
 *    http://www.gnu.org/licenses/gpl.html
 *
 *  - GNU Lesser General Public License Version 2.1 or later (the "LGPL")
 *    http://www.gnu.org/licenses/lgpl.html
 *
 *  - Mozilla Public License Version 1.1 or later (the "MPL")
 *    http://www.mozilla.org/MPL/MPL-1.1.html
 *
 * == END LICENSE ==
 *
 * Configuration file for the File Manager Connector for PHP.
 */
 //Cause browser to reload page every time
header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past

global $Config;
// set system constants

//default path
$default_img_path = 'images/stories';
$default_fla_path = 'images/stories/flash';
$default_media_path = 'media';
$default_file_path = 'file';
$user = '';

define( 'DS', DIRECTORY_SEPARATOR );

//currenrt level in diretoty structure
$currentfolderlevel = 7;

//get root folder
$rootFolder = explode(DS,dirname(__FILE__));

array_splice($rootFolder,-$currentfolderlevel);

$base_folder = implode(DS,$rootFolder);


$ip = md5($_SERVER['REMOTE_ADDR']);




if(is_dir($base_folder.DS.'libraries'.DS.'joomla'))   
{
     
	define( '_JEXEC', 1 );
	
	define('JPATH_BASE',$base_folder);
	
	
	
	require_once ( JPATH_BASE .DS.'includes'.DS.'defines.php' );
	
	
	/* Load in the configuation file */
	//require_once( '../../../../../../../configuration.php' );
	require_once( JPATH_CONFIGURATION	.DS.'configuration.php' );
	
	/*load loader class */
	
	require_once(JPATH_LIBRARIES .DS.'loader.php' );
	
	
	/* Load Joomla's required classes */
	
	jimport('joomla.base.object');
	jimport('joomla.text');
	jimport('joomla.filter.input');
	jimport('joomla.database.database');
	jimport('joomla.factory');
	jimport('joomla.error.error');
	jimport('joomla.environment.uri');
	
	
	
	//get system parameters
	
	$JConfig = new JConfig();
	
	
	//get DB intstance
	
	$database =  &  JDatabase::getInstance(array('driver'=>$JConfig->dbtype,'host'=>$JConfig->host,'user'=>$JConfig->user,'password'=>$JConfig->password,
									'database'=>$JConfig->db,'prefix'=>$JConfig->dbprefix));
									
	// Get base URL

	$url = preg_replace('@/plugins/.*/php/@i','',JURI::root());
	
	//need to check if back end user has already logged in 

	$expired_time = time() - ($JConfig->lifetime * 60);						

	unset($JConfig);	
	
	
	
	$sql ='select ips.session_id from #__session ips '
	. 'join #__session uip on uip.session_id = ips.data '
	. 'where ips.session_id =\'' .$ip . '\' and uip.gid > 18 '
	. 'and uip.time > ' .$expired_time;
	
	$base_path = JPATH_SITE;
}
else
{

	/* Load in the configuation file */
	require_once( '../../../../../../../configuration.php' );
	/* Load Joomla's DB Class */
	define('_VALID_MOS',1);
	require_once( '../../../../../../../includes/database.php' );
	/* Create a new Instance */
	$database = new database( $mosConfig_host, $mosConfig_user, $mosConfig_password, $mosConfig_db, $mosConfig_dbprefix, $mosConfig_offline );
	
	// Get base URL
	$url = $mosConfig_live_site;
	
	$expired_time = time() - $mosConfig_lifetime;

	$sql ='select ips.session_id from #__session ips '
	. 'join #__session uip on uip.session_id = ips.username '
	. 'join #__users usr on usr.id = uip.userid '
	. 'where ips.session_id =\'' .$ip . '\' and usr.gid > 18 '
	. 'and uip.time > ' .$expired_time;
	
	$base_path = $mosConfig_absolute_path;


}


$database->setQuery( $sql);
$ip_recorded_for_jusr = $database->loadResult();




if(isset($ip_recorded_for_jusr)) 
{
	$Config['Enabled'] = true;
}
else
{
	$Config['Enabled'] = false;
}

/* Need to access the database to get the image path */
$sql =  "SELECT params FROM #__"  .  (defined('_JEXEC') ? "plugins WHERE element = 'fckeditor' " : "mambots  WHERE element = 'legacy.fckeditor' ") . "AND folder ='editors'"    ;

$database->setQuery( $sql );
$result = $database->loadResult();


	//throw new exception('i have got here');

if($result)
{
   
  
	preg_match_all('/(?:imagePath=|flashPath=|mediaPath=|filePath=)(.*)\n?/', $result, $location,PREG_SET_ORDER);

	// Path to user files relative to the document root.
	$imagePath = $location[0][1];
	$imagePath = preg_replace('/(^\s*\/|\/\s*$)/','',$imagePath);
	$flashPath = $location[1][1];
	$flashPath = preg_replace('/(^\s*\/|\/\s*$)/','',$flashPath);
	$mediaPath = $location[2][1];
	$mediaPath = preg_replace('/(^\s*\/|\/\s*$)/','',$mediaPath);
	$filePath = $location[3][1];
	$filePath = preg_replace('/(^\s*\/|\/\s*$)/','',$filePath);
	
	preg_match('/userfolder=(.*)\n?/', $result, $location, PREG_OFFSET_CAPTURE);

	$use_userfolder = $location[1][0];
	

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
	
}
else
{
	$imagePath = $default_img_path;
	$flashPath = $default_fla_path;
	$mediaPath = $default_media_path;
	$filePath = $default_file_path;
}





unset($database);


$Config['UserFilesPath'] = $url; 

// Fill the following value it you prefer to specify the absolute path for the
// user files directory. Useful if you are using a virtual directory, symbolic
// link or alias. Examples: 'C:\\MySite\\userfiles\\' or '/root/mysite/userfiles/'.
// Attention: The above 'UserFilesPath' must point to the same directory.


$Config['UserFilesAbsolutePath'] = $base_path;  

// Due to security issues with Apache modules, it is recommended to leave the
// following setting enabled.
$Config['ForceSingleExtension'] = true ;

// Perform additional checks for image files
// if set to true, validate image size (using getimagesize)
$Config['SecureImageUploads'] = true;

// What the user can do with this connector
$Config['ConfigAllowedCommands'] = array('QuickUpload', 'FileUpload', 'GetFolders', 'GetFoldersAndFiles', 'CreateFolder') ;

// Allowed Resource Types
$Config['ConfigAllowedTypes'] = array('File', 'Image', 'Flash', 'Media','File-Media') ; //Aw

// For security, HTML is allowed in the first Kb of data for files having the
// following extensions only.
$Config['HtmlExtensions'] = array("html", "htm", "xml", "xsd", "txt", "js") ;

/*
	Configuration settings for each Resource Type

	- AllowedExtensions: the possible extensions that can be allowed. 
		If it is empty then any file type can be uploaded.
	- DeniedExtensions: The extensions that won't be allowed. 
		If it is empty then no restrictions are done here.

	For a file to be uploaded it has to fulfill both the AllowedExtensions
	and DeniedExtensions (that's it: not being denied) conditions.

	- FileTypesPath: the virtual folder relative to the document root where
		these resources will be located. 
		Attention: It must start and end with a slash: '/'

	- FileTypesAbsolutePath: the physical path to the above folder. It must be
		an absolute path. 
		If it's an empty string then it will be autocalculated.
		Useful if you are using a virtual directory, symbolic link or alias. 
		Examples: 'C:\\MySite\\userfiles\\' or '/root/mysite/userfiles/'.
		Attention: The above 'FileTypesPath' must point to the same directory.
		Attention: It must end with a slash: '/'

	 - QuickUploadPath: the virtual folder relative to the document root where
		these resources will be uploaded using the Upload tab in the resources 
		dialogs.
		Attention: It must start and end with a slash: '/'

	 - QuickUploadAbsolutePath: the physical path to the above folder. It must be
		an absolute path. 
		If it's an empty string then it will be autocalculated.
		Useful if you are using a virtual directory, symbolic link or alias. 
		Examples: 'C:\\MySite\\userfiles\\' or '/root/mysite/userfiles/'.
		Attention: The above 'QuickUploadPath' must point to the same directory.
		Attention: It must end with a slash: '/'

	 	NOTE: by default, QuickUploadPath and QuickUploadAbsolutePath point to 
	 	"userfiles" directory to maintain backwards compatibility with older versions of FCKeditor. 
	 	This is fine, but you in some cases you will be not able to browse uploaded files using file browser.
	 	Example: if you click on "image button", select "Upload" tab and send image 
	 	to the server, image will appear in FCKeditor correctly, but because it is placed 
	 	directly in /userfiles/ directory, you'll be not able to see it in built-in file browser.
	 	The more expected behaviour would be to send images directly to "image" subfolder.
	 	To achieve that, simply change
			$Config['QuickUploadPath']['Image']			= $Config['UserFilesPath'] ;
			$Config['QuickUploadAbsolutePath']['Image']	= $Config['UserFilesAbsolutePath'] ;
		into:	
			$Config['QuickUploadPath']['Image']			= $Config['FileTypesPath']['Image'] ;
			$Config['QuickUploadAbsolutePath']['Image'] 	= $Config['FileTypesAbsolutePath']['Image'] ;			
		
*/

$Config['AllowedExtensions']['File']	= array('7z', 'aiff', 'asf', 'avi', 'bmp', 'csv', 'doc', 'fla', 'flv', 'gif', 'gz', 'gzip', 'jpeg', 'jpg', 'mid', 'mov', 'mp3', 'mp4', 'mpc', 'mpeg', 'mpg', 'ods', 'odt', 'pdf', 'png', 'ppt', 'pxd', 'qt', 'ram', 'rar', 'rm', 'rmi', 'rmvb', 'rtf', 'sdc', 'sitd', 'swf', 'sxc', 'sxw', 'tar', 'tgz', 'tif', 'tiff', 'txt', 'vsd', 'wav', 'wma', 'wmv', 'xls', 'xml', 'zip') ;
$Config['DeniedExtensions']['File']		= array() ;
$Config['FileTypesPath']['File']		= $Config['UserFilesPath'] . "/" . $filePath . "/" . $user;  
$Config['FileTypesAbsolutePath']['File']= (($Config['UserFilesAbsolutePath'] == '') ? '' : $Config['UserFilesAbsolutePath']). "/" . $filePath . "/" . $user; 
$Config['QuickUploadPath']['File']		= $Config['UserFilesPath'] . "/" . $filePath . "/" . $user;
$Config['QuickUploadAbsolutePath']['File']= $Config['UserFilesAbsolutePath'] . "/" . $filePath . "/" . $user;  

$Config['AllowedExtensions']['Image']	= array('bmp','gif','jpeg','jpg','png') ;
$Config['DeniedExtensions']['Image']	= array() ;
$Config['FileTypesPath']['Image']		= $Config['UserFilesPath'] . "/" . $imagePath . "/" . $user; 
$Config['FileTypesAbsolutePath']['Image']= (($Config['UserFilesAbsolutePath'] == '') ? '' : $Config['UserFilesAbsolutePath']) . "/" . $imagePath. "/" . $user; 
$Config['QuickUploadPath']['Image']		= $Config['UserFilesPath'] . "/" . $imagePath . "/" . $user; 
$Config['QuickUploadAbsolutePath']['Image']= $Config['UserFilesAbsolutePath'] . "/" . $imagePath . "/" . $user; 

$Config['AllowedExtensions']['Flash']	= array('swf','flv') ;
$Config['DeniedExtensions']['Flash']	= array() ;
$Config['FileTypesPath']['Flash']		= $Config['UserFilesPath'] . "/" . $flashPath . "/" . $user; 
$Config['FileTypesAbsolutePath']['Flash']= (($Config['UserFilesAbsolutePath'] == '') ? '' : $Config['UserFilesAbsolutePath']). "/" . $flashPath . "/" . $user;
$Config['QuickUploadPath']['Flash']		= $Config['UserFilesPath'] . "/" . $flashPath . "/" . $user;
$Config['QuickUploadAbsolutePath']['Flash']= $Config['UserFilesAbsolutePath'] . "/" . $flashPath . "/" . $user;

$Config['AllowedExtensions']['Media']	= array('aiff', 'asf', 'avi', 'bmp', 'fla', 'flv', 'gif', 'jpeg', 'jpg', 'mid', 'mov', 'mp3', 'mp4', 'mpc', 'mpeg', 'mpg', 'png', 'qt', 'ram', 'rm', 'rmi', 'rmvb', 'swf', 'tif', 'tiff', 'wav', 'wma', 'wmv') ;
$Config['DeniedExtensions']['Media']	= array() ;
$Config['FileTypesPath']['Media']		= $Config['UserFilesPath']. "/" . $mediaPath . "/" . $user;
$Config['FileTypesAbsolutePath']['Media']= (($Config['UserFilesAbsolutePath'] == '') ? '' : $Config['UserFilesAbsolutePath']) . "/" . $mediaPath . "/" . $user;
$Config['QuickUploadPath']['Media']		= $Config['UserFilesPath'] . "/" . $mediaPath . "/" . $user;
$Config['QuickUploadAbsolutePath']['Media']= $Config['UserFilesAbsolutePath'] . "/" . $mediaPath . "/". $user;

?>
