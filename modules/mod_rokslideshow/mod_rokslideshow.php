<?php
/**
* @package RokSlideshow
* @copyright Copyright (C) 2007 RocketWerx. All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
*/


// no direct access
defined('_JEXEC') or die('Restricted access');
// Include the syndicate functions only once
require_once (dirname(__FILE__).DS.'helper.php');

$imagePath 	= modRokSlideshowHelper::cleanDir($params->get( 'imagePath', 'images/stories/fruit' ));
$sortCriteria = $params->get( 'sortCriteria', 0);
$sortOrder = $params->get( 'sortOrder', 'asc');
$sortOrderManual = $params->get( 'sortOrderManual', '');

if (trim($sortOrderManual) != "")
	$images = explode(",", $sortOrderManual);
else
	$images = modRokSlideshowHelper::imageList($imagePath, $sortCriteria, $sortOrder);

require(JModuleHelper::getLayoutPath('mod_rokslideshow'));