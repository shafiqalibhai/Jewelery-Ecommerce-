<?php
/**
*	RecommendFriends Component for Joomla! - for Site Promotion
* 
* @version $Id: install.recommendfriends.php - v2.0.3 - January-06-2009 - D-Mack Media
* @package Joomla
* @subpackage RecommendFriends
* @copyright (c) 2007-2010 D-Mack Media, dmackmedia.com
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
*
* This is free software
**/

defined( '_JEXEC' ) or die( 'Direct Access to this location is not allowed.' );

function com_install() {

$database = JFactory::getDBO();

# Set up new icons for admin menu
$database->setQuery("UPDATE #__components SET admin_menu_img='js/ThemeOffice/config.png' WHERE admin_menu_link='option=com_recommendfriends&task=Configuration'");
$iconresult[0] = $database->query();
if ( !$database->query() ) {
		$errmsg .= "Warning: Couldn't update the image for the RecommendFriends Configuration Admin sub-menu.<br />";
}

$database->setQuery("UPDATE #__components SET admin_menu_img='js/ThemeOffice/help.png' WHERE admin_menu_link='option=com_recommendfriends&task=Information'");
$iconresult[1] = $database->query();
if ( !$database->query() ) {
		$errmsg .= "Warning: Couldn't update the image for the RecommendFriends Configuration Admin sub-menu.<br />";
}

# clear link on top-level component menu item
$database->setQuery("UPDATE #__components SET admin_menu_link='' where name='Recommend Friends'");
$database->query();

# Show installation result to user
?>
<center>
<table width="100%" border="0" height="272">
  <tr>
    <td height="10">
D-Mack RecommendFriends v2.0.3 - January-06-2009 component has been successfully installed!
    </td>
  </tr>
  <tr>
    <td height="60">
      <hr />
      <b><font style="font-family:verdana,arial; font-size:24px; color:green;"><b>Installation: Successful!</b></font></b>
      <hr />
    </td>
  </tr>

  <tr>
    <td>
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
  $gdfreetype = JText::_('<font color="green"><b>GD Support</b></font> is Enabled but <font color="red"><b>FreeType Support</b></font> does not appear to be Enabled on your server!!');
} elseif ($gdsupport == "false") {
  $gdfreetype = JText::_('<font color="red"><b>GD Support</b></font> and <font color="red"><b>FreeType Support</b></font> both appear NOT to be Enabled on your server!!');
}
if ($gdsupport == "true" && $freetype == "true") {
?>
        <p style="margin-top:0em; margin-bottom:.5em">
        <i><b><?php echo JText::_('GREAT NEWS!!'); ?></b>&nbsp;-&nbsp;<?php echo JText::_('<font color="green"><b>GD Support</b></font> and <font color="green"><b>FreeType Support</b></font> are both <b>Enabled</b> on your server!!&nbsp;&nbsp;The Captcha option of the component should work just fine!'); ?></i>
        </p>
<?php
} else {
?>
        <p style="margin-top:0em; margin-bottom:.5em">
        <b><font color="red"><?php echo JText::_('<<<<<&nbsp;&nbsp;&nbsp;WARNING&nbsp;&nbsp;&nbsp;>>>>>'); ?></font></b>&nbsp;&nbsp;<i><?php echo $gdfreetype; ?>&nbsp;&nbsp;
        <?php echo JText::_('Unfortunately it does not look like the Captcha option of the component will work on this server. <b>**NOTE**You can still use the RecommendFriends Component</b>, but you can not use the Captcha option (it must be DISABLED i.e.UNCHECKED in the Admin Configuration). You could ask your website hosting provider to enable GD and FreeType Support if you need to have Captcha...'); ?></i>
        </p>
<?php
}
?>
      <hr />
    </td>
  </tr>
  <tr>
    <td height="132" valign="top">
      <p style="margin-top: 0; margin-bottom: 0">Now all you need to do is add a New link to the Recommend Friends Component.&nbsp; For example:</p>
      <p style="margin-top: 0; margin-bottom: 0">&nbsp;</p>
      <p style="margin-top: 0; margin-bottom: 0">To add a link to the Main Menu (mainmenu) if you want everyone (Public) to be able to use this component, follow these steps:</p>
      <ol style="font-family: Arial; font-size: 8pt">
        <li>Click the Menu->Main Menu link</li>
        <li>Click on 'New' in the top right part of the screen</li>
        <li>the 'D-Mack Recommend Friends' Component from the list</li>
        <li>Type in a Title for the link</li>
        <li>Type in an Alias for the link</li>
        <li>Don't need to change the Parent Item</li>
        <li>Click the 'Publish' radio button</li>
        <li>Make sure the Link's Access Level is set to 'Public'</li>
        <li>And Finally, click 'Save' and you should be good to go!</li>
      </ol>
      <p style="margin-top: 0; margin-bottom: 0">To add a link to the User Menu (usermenu) if you want only 'Registered' users to use this component, follow these steps:</p>
      <ol style="font-family: Arial; font-size: 8pt">
        <li>Click the Menu->User Menu link</li>
        <li>Follow steps 2 through 7 shown above...</li>
        <li>Make sure the Link's Access Level is set to 'Registered'</li>
        <li>Click the 'Publish' radio button</li>
        <li>And Finally, click 'Save' and you should be good to go!</li>
      </ol>
      <p style="margin-top: 0; margin-bottom: 0">&nbsp;</p>
      <p style="margin-top: 0; margin-bottom: 0">You can also set many of the available parameters for the component in the Admin area by clicking the Component->Recommend Friends->Configuration link on the Admin Menu.  Information is also available through the Component->Recommend Friends->Information link.</p>
    </td>
  </tr>
  <tr>
    <td height="95">
      <hr />
      <p style="margin-top: 0; margin-bottom: 0">
Thank you for using D-Mack RecommendFirends!</p>
      <p style="margin-top: 0; margin-bottom: 0">
&nbsp;</p>
      <p style="margin-top: 0; margin-bottom: 0">
Component developed/refined by <a href="http://www.dmackmedia.com/" target="_blank">D-Mack Media  - Vancouver Website Design</a>.  Professional and Friendly Web Design and Hosting.</p>
      <p style="margin-top: 0; margin-bottom: 0">
&nbsp;</p>
    </td>
  </tr>
</table>
</center>

<?php
}
/** EOF **/
?>
