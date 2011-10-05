<?php
/**
      Click PopUp Module for Joomla 1.5
      -----------------------------------------------------------------------
      Click PopUp show a link that open a popup with inside text or a module position. 
      Created bt Andrea S. of www.joomlovers.net 
      -----------------------------------------------------------------------
*/

// no direct access
defined('_JEXEC') or die('Restricted access');
$doc = &Jfactory::getDocument();
$link	= $params->get('link');
$linksize	= $params->get('linksize');
$width	= $params->get('width');
$height	= $params->get('height');
$bgcolor	= $params->get('bgcolor');
$txtcolor	= $params->get('txtcolor');
$close	= $params->get('close');
$closesize	= $params->get('closesize');
$bordersize	= $params->get('bordersize');
$bordertype	= $params->get('bordertype');
$bordercolor	= $params->get('bordercolor');

$a = new stdClass;
$dispatcher	=& JDispatcher::getInstance();
JPluginHelper::importPlugin('content');
$a->text = $str;
$results = $dispatcher->trigger('onPrepareContent', array (&$a, $a->params, 0));
?>

<style type="text/css">
#layer1{position:absolute;visibility:hidden;width:<?php echo "$width" ?>px;height:<?php echo "$height" ?>px;background-color:<?php echo "$bgcolor" ?>;border:<?php echo "$bordersize" ?>px <?php echo "$bordertype" ?> <?php echo "$bordercolor" ?>;padding:5px 2px 5px 2px;  color:<?php echo "$txtcolor" ?>;z-index:999;}
#hide{float:right;  color:<?php echo "$closecolor" ?>;  font-size:<?php echo "$closesize" ?>px;  margin:3px;}
#show{position:relative;  font-size:<?php echo "$linksize" ?>px;}
</style>
<div id="show"><a href="#" onclick="setVisible('layer1');return false" target="_self"><?php echo "$link" ?></a></p></div>
<div id="layer1">
<span id="hide"><a href="javascript:setVisible('layer1')" style="text-decoration: none"><strong><?php echo "$close" ?></strong></a></span>
<br />
<?php echo "$a->text" ?>
</div>
