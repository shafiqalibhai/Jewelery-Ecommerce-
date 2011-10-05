<?php

/**
 * @version		$Id: fckeditor.php 1154 18-1-2008 andrew
 * @package		JoomlaFCK
 * @copyright	Copyright (C) 2006 - 2008 WebXSolution Ltd. All rights reserved.
 * @license		Creative Commons Licence <http://www.joomlafckeditor.com/index.php?option=com_content&view=article&id=5&Itemid=2>
 * Ths application has been written by WebxSolution Ltd.  You may not copy or distribute JoomlaFCK without written consent
 * from WebxSolution Ltd.
 */
 //Cause browser to reload page every time
header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past


if(!defined('DS'))
{
 define('DS',DIRECTORY_SEPARATOR);
}

include_once("fckeditor" . DS . "optionxmlreader.php");
 
if(isset($_MAMBOTS))
{
 include_once("fckeditor.legacy.php");
}
else // load in class for J!1.5
{
 include_once("fckeditor" . DS . "groupfilter.php");
 include_once("fckeditor.class.php");
}
