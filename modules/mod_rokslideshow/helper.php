<?php
/**
* @package RokSlideshow
* @copyright Copyright (C) 2007 RocketWerx. All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
*/

// no direct access
defined('_JEXEC') or die('Restricted access');

require_once (JPATH_SITE.DS.'components'.DS.'com_content'.DS.'helpers'.DS.'route.php');
jimport('joomla.utilities.date');

class modRokSlideshowHelper
{
	//helper functions
	function imageList ($directory, $sortcriteria, $sortorder) {
	    $results = array();
	    $handler = opendir($directory);
			$i = 0;
	    while ($file = readdir($handler)) {
	        if ($file != '.' && $file != '..' && modRokSlideshowHelper::isImage($file)) {
						$results[$i][0] = $file;
						$results[$i][1] = filemtime($directory . "/" .$file);
						$i++;
					}
	    }
	    closedir($handler);

			//these lines sort the contents of the directory by the date
			// Obtain a list of columns

			foreach($results as $res) {
				if ($sortcriteria == 0 ) $sortAux[] = $res[0];
				else $sortAux[] = $res[1];
			}

			if ($sortorder == 0) {
				array_multisort($sortAux, SORT_ASC, $results);
			} elseif ($sortorder == 2) {
				srand((float)microtime() * 1000000);
				shuffle($results);
			} else {
				array_multisort($sortAux, SORT_DESC, $results);
			}

			foreach($results as $res) {
				$sorted_results[] = $res[0];
			}

	    return $sorted_results;
	}

	function getInfo($imagePath, $file) {
			global $iso_client_lang;

			$langext = "";
			$fileext= ".txt";

			if (isset($iso_client_lang) && strlen($iso_client_lang)>1) $langext = "." . $iso_client_lang;

			$file_noext = substr($file, 0, strrpos($file,"."));
			$info = array();

			$infofile = $imagePath . $file_noext . $langext . $fileext;

			if (!file_exists($infofile)) $infofile = $imagePath . $file_noext . $fileext;
			if (file_exists($infofile)) {
				$imginfo = file ($infofile);
				foreach ($imginfo as $line) {
					$info[] = addslashes($line);
				}
				return $info;
			}
			return array('','#','');
	}

	function isImage($file) {
		$imagetypes = array(".jpg", ".jpeg", ".gif", ".png");
		$extension = substr($file,strrpos($file,"."));
		if (in_array($extension, $imagetypes)) return true;
		else return false;
	}

	function cleanDir($dir) {
		if (substr($dir, -1, 1) == '/')
			return $dir;
		else
			return $dir . "/";
	}

}
