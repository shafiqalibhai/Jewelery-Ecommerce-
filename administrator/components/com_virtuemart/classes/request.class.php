<?php
/**
 * @version		$Id: request.class.php 1319 2008-03-19 18:58:38Z soeren_nb $
 * @package		VirtueMart
 * @subpackage	core
 * @copyright	Copyright (C) 2005 - 2007 Open Source Matters. All rights reserved.
 * @copyright	Copyright (C) 2007-2008 soeren. All rights reserved.
 * @license		GNU/GPL, see LICENSE.php
 * Joomla! is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * See COPYRIGHT.php for copyright notices and details.
 */

// Check to ensure this file is within the rest of the framework
if( !defined( '_VALID_MOS' ) && !defined( '_JEXEC' ) ) die( 'Direct Access to '.basename(__FILE__).' is not allowed.' );

/**
 * Set the available masks for cleaning variables
 */
define('VMREQUEST_NOTRIM'   , 1);
define('VMREQUEST_ALLOWRAW' , 2);
define('VMREQUEST_ALLOWHTML', 4);

function vmGet( &$arr, $name, $def=null, $mask=0 ) {
	// Static input filters for specific settings
	static $noHtmlFilter	= null;
	static $safeHtmlFilter	= null;

	$var = vmGetArrayValue( $arr, $name, $def, '' );

	// If the no trim flag is not set, trim the variable
	if (!($mask & 1) && is_string($var)) {
		$var = trim($var);
	}

	// Now we handle input filtering
	if ($mask & 2) {
		// If the allow raw flag is set, do not modify the variable
		$var = $var;
	} elseif ($mask & 4) {
		// If the allow html flag is set, apply a safe html filter to the variable
		if (is_null($safeHtmlFilter)) {
			$safeHtmlFilter = & vmInputFilter::getInstance(null, null, 1, 1);
		}
		$var = $safeHtmlFilter->clean($var, 'none');
	} else {
		// Since no allow flags were set, we will apply the most strict filter to the variable
		if (is_null($noHtmlFilter)) {
			$noHtmlFilter = & vmInputFilter::getInstance(/* $tags, $attr, $tag_method, $attr_method, $xss_auto */);
		}
		$var = $noHtmlFilter->clean($var, 'none');
	}
	return $var;
}
/**
 * Create the request global object
 */
$GLOBALS['_VMREQUEST'] = array();

/**
 * vmRequest Class
 *
 * This class serves to provide VirtueMart with a common interface to access
 * request variables.  This includes $_POST, $_GET, and naturally $_REQUEST.  Variables
 * can be passed through an input filter to avoid injection or returned raw.
 *
 * @static
 * @author		Louis Landry <louis.landry@joomla.org>
 * @package		Joomla.Framework
 * @subpackage	Environment
 * @since		1.1
 */
class vmRequest {
	
	/**
	 * Gets the request method
	 * 
	 * @return string
	 */
	function getMethod() {
		$method = strtoupper( $_SERVER['REQUEST_METHOD'] );
		return $method;
	}

	/**
	 * Fetches and returns a given variable.
	 *
	 * The default behaviour is fetching variables depending on the
	 * current request method: GET and HEAD will result in returning
	 * an entry from $_GET, POST and PUT will result in returning an
	 * entry from $_POST.
	 *
	 * You can force the source by setting the $hash parameter:
	 *
	 *   post		$_POST
	 *   get		$_GET
	 *   files		$_FILES
	 *   cookie		$_COOKIE
	 *   env		$_ENV
	 *   server		$_SERVER
	 *   method		via current $_SERVER['REQUEST_METHOD']
	 *   default	$_REQUEST
	 *
	 * @static
	 * @param	string	$name		Variable name
	 * @param	string	$default	Default value if the variable does not exist
	 * @param	string	$hash		Where the var should come from (POST, GET, FILES, COOKIE, METHOD)
	 * @param	string	$type		Return type for the variable, for valid values see {@link JFilterInput::clean()}
	 * @param	int		$mask		Filter mask for the variable
	 * @return	mixed	Requested variable
	 * @since	1.1
	 */
	function getVar($name, $default = null, $hash = 'default', $type = 'none', $mask = 0) {
		// Ensure hash and type are uppercase
		$hash = strtoupper( $hash );
		if ($hash === 'METHOD') {
			$hash = strtoupper( $_SERVER['REQUEST_METHOD'] );
		}
		$type	= strtoupper( $type );
		$sig	= $hash.$type.$mask;

		// Get the input hash
		switch ($hash)
		{
			case 'GET' :
				$input = &$_GET;
				break;
			case 'POST' :
				$input = &$_POST;
				break;
			case 'FILES' :
				$input = &$_FILES;
				break;
			case 'COOKIE' :
				$input = &$_COOKIE;
				break;
			case 'SESSION'    :
				$input = &$_SESSION;
				break;
			case 'ENV'    :
				$input = &$_ENV;
				break;
			case 'SERVER'    :
				$input = &$_SERVER;
				break;
			default:
				$input = &$_REQUEST;
				$hash = 'REQUEST';
				break;
		}

		if (isset($GLOBALS['_VMREQUEST'][$name]['SET.'.$hash]) && ($GLOBALS['_VMREQUEST'][$name]['SET.'.$hash] === true)) {
			// Get the variable from the input hash
			$var = (isset($input[$name]) && $input[$name] !== null) ? $input[$name] : $default;
		} 
		elseif (!isset($GLOBALS['_VMREQUEST'][$name][$sig])) {
			if (isset($input[$name]) && $input[$name] !== null) {
				// Get the variable from the input hash and clean it
				$var = vmRequest::_cleanVar($input[$name], $mask, $type);

				// Handle magic quotes compatability
				if (get_magic_quotes_gpc() && ($var != $default) && ($hash != 'FILES')) {
					$var = vmRequest::_stripSlashesRecursive( $var );
				}

				$GLOBALS['_VMREQUEST'][$name][$sig] = $var;
			} elseif ($default !== null) {
				// Clean the default value
				$var = vmRequest::_cleanVar($default, $mask, $type);
			} else {
				$var = $default;
			}
		} else {
			$var = $GLOBALS['_VMREQUEST'][$name][$sig];
		}

		return $var;
	}

	/**
	 * Fetches and returns a given filtered variable. The integer
	 * filter will allow only digits to be returned. This is currently
	 * only a proxy function for getVar().
	 *
	 * See getVar() for more in-depth documentation on the parameters.
	 *
	 * @static
	 * @param	string	$name		Variable name
	 * @param	string	$default	Default value if the variable does not exist
	 * @param	string	$hash		Where the var should come from (POST, GET, FILES, COOKIE, METHOD)
	 * @return	integer	Requested variable
	 * @since	1.1
	 */
	function getInt($name, $default = 0, $hash = 'default') {
		return vmRequest::getVar($name, $default, $hash, 'int');
	}

	/**
	 * Fetches and returns a given filtered variable.  The float
	 * filter only allows digits and periods.  This is currently
	 * only a proxy function for getVar().
	 *
	 * See getVar() for more in-depth documentation on the parameters.
	 *
	 * @static
	 * @param	string	$name		Variable name
	 * @param	string	$default	Default value if the variable does not exist
	 * @param	string	$hash		Where the var should come from (POST, GET, FILES, COOKIE, METHOD)
	 * @return	float	Requested variable
	 * @since	1.1
	 */
	function getFloat($name, $default = 0.0, $hash = 'default') {
		return vmRequest::getVar($name, $default, $hash, 'float');
	}

	/**
	 * Fetches and returns a given filtered variable. The bool
	 * filter will only return true/false bool values. This is
	 * currently only a proxy function for getVar().
	 *
	 * See getVar() for more in-depth documentation on the parameters.
	 *
	 * @static
	 * @param	string	$name		Variable name
	 * @param	string	$default	Default value if the variable does not exist
	 * @param	string	$hash		Where the var should come from (POST, GET, FILES, COOKIE, METHOD)
	 * @return	bool		Requested variable
	 * @since	1.1
	 */
	function getBool($name, $default = false, $hash = 'default') {
		return vmRequest::getVar($name, $default, $hash, 'bool');
	}

	/**
	 * Fetches and returns a given filtered variable. The word
	 * filter only allows the characters [A-Za-z_]. This is currently
	 * only a proxy function for getVar().
	 *
	 * See getVar() for more in-depth documentation on the parameters.
	 *
	 * @static
	 * @param	string	$name		Variable name
	 * @param	string	$default	Default value if the variable does not exist
	 * @param	string	$hash		Where the var should come from (POST, GET, FILES, COOKIE, METHOD)
	 * @return	string	Requested variable
	 * @since	1.1
	 */
	function getWord($name, $default = '', $hash = 'default') {
		return vmRequest::getVar($name, $default, $hash, 'word');
	}
	
	/**
	 * Fetches and returns a given filtered variable. 
	 * The variable can have the value "Y" or "N", nothing else
	 *
	 * See getVar() for more in-depth documentation on the parameters.
	 *
	 * @static
	 * @param	string	$name		Variable name
	 * @param	string	$default	Default value if the variable does not exist
	 * @param	string	$hash		Where the var should come from (POST, GET, FILES, COOKIE, METHOD)
	 * @return	string	Requested variable
	 * @since	1.1
	 */
	function getYesOrNo($name, $default = 'N', $hash = 'default') {
		$yes_or_no = strtoupper( vmRequest::getVar($name, $default, $hash, 'none'));
		return $yes_or_no == 'Y' ? 'Y' : 'N'; 
	}
	/**
	 * Fetches and returns a given filtered variable. The cmd
	 * filter only allows the characters [A-Za-z0-9.-_]. This is
	 * currently only a proxy function for getVar().
	 *
	 * See getVar() for more in-depth documentation on the parameters.
	 *
	 * @static
	 * @param	string	$name		Variable name
	 * @param	string	$default	Default value if the variable does not exist
	 * @param	string	$hash		Where the var should come from (POST, GET, FILES, COOKIE, METHOD)
	 * @return	string	Requested variable
	 * @since	1.1
	 */
	function getCmd($name, $default = '', $hash = 'default') {
		return vmRequest::getVar($name, $default, $hash, 'cmd');
	}

	/**
	 * Fetches and returns a given filtered variable. The string
	 * filter deletes 'bad' HTML code, if not overridden by the mask.
	 * This is currently only a proxy function for getVar().
	 *
	 * See getVar() for more in-depth documentation on the parameters.
	 *
	 * @static
	 * @param	string	$name		Variable name
	 * @param	string	$default	Default value if the variable does not exist
	 * @param	string	$hash		Where the var should come from (POST, GET, FILES, COOKIE, METHOD)
 	 * @param	int		$mask		Filter mask for the variable
	 * @return	string	Requested variable
	 * @since	1.1
	 */
	function getString($name, $default = '', $hash = 'default', $mask = 0)
	{
		// Cast to string, in case VMREQUEST_ALLOWRAW was specified for mask
		return (string) vmRequest::getVar($name, $default, $hash, 'string', $mask);
	}

	/**
	 * Set a variabe in on of the request variables
	 *
	 * @access	public
	 * @param	string	$name		Name
	 * @param	string	$value		Value
	 * @param	string	$hash		Hash
	 * @param	boolean	$overwrite	Boolean
	 * @return	string	Previous value
	 * @since	1.1
	 */
	function setVar($name, $value = null, $hash = 'method', $overwrite = true)
	{
		//If overwrite is true, makes sure the variable hasn't been set yet
		if(!$overwrite && array_key_exists($name, $_REQUEST)) {
			return $_REQUEST[$name];
		}

		// Clean global request var
		$GLOBALS['_VMREQUEST'][$name] = array();

		// Get the request hash value
		$hash = strtoupper($hash);
		if ($hash === 'METHOD') {
			$hash = strtoupper($_SERVER['REQUEST_METHOD']);
		}

		$previous	= array_key_exists($name, $_REQUEST) ? $_REQUEST[$name] : null;
		
		switch ($hash)
		{
			case 'GET' :
				$_GET[$name] = $value;
				$_REQUEST[$name] = $value;
				break;
			case 'POST' :
				$_POST[$name] = $value;
				$_REQUEST[$name] = $value;
				break;
			case 'COOKIE' :
				$_COOKIE[$name] = $value;
				$_REQUEST[$name] = $value;
				break;
			case 'SESSION' :
				$_SESSION[$name] = $value;
				break;
			case 'FILES' :
				$_FILES[$name] = $value;
				break;
			case 'ENV'    :
				$_ENV['name'] = $value;
				break;
			case 'SERVER'    :
				$_SERVER['name'] = $value;
				break;
		}

		// Mark this variable as 'SET'
		$GLOBALS['_VMREQUEST'][$name]['SET.'.$hash] = true;
		$GLOBALS['_VMREQUEST'][$name]['SET.REQUEST'] = true;

		return $previous;
	}

	/**
	 * Fetches and returns a request array.
	 *
	 * The default behaviour is fetching variables depending on the
	 * current request method: GET and HEAD will result in returning
	 * $_GET, POST and PUT will result in returning $_POST.
	 *
	 * You can force the source by setting the $hash parameter:
	 *
	 *   post		$_POST
	 *   get		$_GET
	 *   files		$_FILES
	 *   cookie		$_COOKIE
	 *   env		$_ENV
	 *   server		$_SERVER
	 *   method		via current $_SERVER['REQUEST_METHOD']
	 *   default	$_REQUEST
	 *
	 * @static
	 * @param	string	$hash	to get (POST, GET, FILES, METHOD)
	 * @param	int		$mask	Filter mask for the variable
	 * @return	mixed	Request hash
	 * @since	1.1
	 */
	function get($hash = 'default', $mask = 0) {
		$hash = strtoupper($hash);

		if ($hash === 'METHOD') {
			$hash = strtoupper( $_SERVER['REQUEST_METHOD'] );
		}

		switch ($hash) {
			case 'GET' :
				$input = $_GET;
				break;

			case 'POST' :
				$input = $_POST;
				break;

			case 'FILES' :
				$input = $_FILES;
				break;

			case 'COOKIE' :
				$input = $_COOKIE;
				break;
				
			case 'SESSION' :
				$input = $_SESSION;
				break;
				
			case 'ENV'    :
				$input = &$_ENV;
				break;
			
			case 'SERVER'    :
				$input = &$_SERVER;
				break;

			default:
				$input = $_REQUEST;
				break;
		}

		$result = vmRequest::_cleanVar($input, $mask);

		// Handle magic quotes compatability
		if (get_magic_quotes_gpc() && ($hash != 'FILES')) {
			$result = vmRequest::_stripSlashesRecursive( $result );
		}

		return $result;
	}

	function set($array, $hash = 'default', $overwrite = true) {
		foreach($array as $key => $value) {
			vmRequest::setVar($key, $value, $hash, $overwrite);
		}
	}

	/**
	 * Cleans the request from script injection.
	 *
	 * @static
	 * @return	void
	 * @since	1.1
	 */
	function clean() {
		vmRequest::_cleanArray( $_FILES );
		vmRequest::_cleanArray( $_ENV );
		vmRequest::_cleanArray( $_GET );
		vmRequest::_cleanArray( $_POST );
		vmRequest::_cleanArray( $_COOKIE );
		vmRequest::_cleanArray( $_SERVER );

		if (isset( $_SESSION )) {
			vmRequest::_cleanArray( $_SESSION );
		}

		$REQUEST	= $_REQUEST;
		$GET		= $_GET;
		$POST		= $_POST;
		$COOKIE		= $_COOKIE;
		$FILES		= $_FILES;
		$ENV		= $_ENV;
		$SERVER		= $_SERVER;

		if (isset ( $_SESSION )) {
			$SESSION = $_SESSION;
		}

		foreach ($GLOBALS as $key => $value) {
			if ( $key != 'GLOBALS' ) {
				unset ( $GLOBALS [ $key ] );
			}
		}
		$_REQUEST	= $REQUEST;
		$_GET		= $GET;
		$_POST		= $POST;
		$_COOKIE	= $COOKIE;
		$_FILES		= $FILES;
		$_ENV 		= $ENV;
		$_SERVER 	= $SERVER;

		if (isset ( $SESSION )) {
			$_SESSION = $SESSION;
		}

		// Make sure the request hash is clean on file inclusion
		$GLOBALS['_VMREQUEST'] = array();
	}

	/**
	 * Adds an array to the GLOBALS array and checks that the GLOBALS variable is not being attacked
	 *
	 * @access	protected
	 * @param	array	$array	Array to clean
	 * @param	boolean	True if the array is to be added to the GLOBALS
	 * @since	1.1
	 */
	function _cleanArray( &$array, $globalise=false )
	{
		static $banned = array( '_files', '_env', '_get', '_post', '_cookie', '_server', '_session', 'globals' );

		foreach ($array as $key => $value)
		{
			// PHP GLOBALS injection bug
			$failed = in_array( strtolower( $key ), $banned );

			// PHP Zend_Hash_Del_Key_Or_Index bug
			$failed |= is_numeric( $key );
			if ($failed) {
				die( 'Illegal variable <b>' . implode( '</b> or <b>', $banned ) . '</b> passed to script.' );
			}
			if ($globalise) {
				$GLOBALS[$key] = $value;
			}
		}
	}

	function _cleanVar($var, $mask = 0, $type=null)
	{
		// Static input filters for specific settings
		static $noHtmlFilter	= null;
		static $safeHtmlFilter	= null;

		// If the no trim flag is not set, trim the variable
		if (!($mask & 1) && is_string($var)) {
			$var = trim($var);
		}

		// Now we handle input filtering
		if ($mask & 2)
		{
			// If the allow raw flag is set, do not modify the variable
			$var = $var;
		}
		elseif ($mask & 4)
		{
			// If the allow html flag is set, apply a safe html filter to the variable
			if (is_null($safeHtmlFilter)) {
				$safeHtmlFilter = & vmInputFilter::getInstance(null, null, 1, 1);
			}
			$var = $safeHtmlFilter->clean($var, $type);
		}
		else
		{
			// Since no allow flags were set, we will apply the most strict filter to the variable
			if (is_null($noHtmlFilter)) {
				$noHtmlFilter = & vmInputFilter::getInstance(/* $tags, $attr, $tag_method, $attr_method, $xss_auto */);
			}
			$var = $noHtmlFilter->clean($var, $type);
		}
		return $var;
	}

	/**
	 * Strips slashes recursively on an array
	 *
	 * @access	protected
	 * @param	array	$array		Array of (nested arrays of) strings
	 * @return	array	The input array with stripshlashes applied to it
	 */
	function _stripSlashesRecursive( $value ) {
		$value = is_array( $value ) ? array_map( array( 'vmRequest', '_stripSlashesRecursive' ), $value ) : stripslashes( $value );
		return $value;
	}
}
