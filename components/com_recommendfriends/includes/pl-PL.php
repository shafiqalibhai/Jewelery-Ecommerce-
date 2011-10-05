<?php
/*
@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
@@  ____  __  __    __    ___  _  _  __  __  ____  ____  ____    __        ___  _____  __  __  @@
@@ (  _ \(  \/  )  /__\  / __)| )/ )(  \/  )( ___)(  _ \(_  _)  /__\      / __)(  _  )(  \/  ) @@
@@  )(_) ))    (  /(__)\( (__ |   <  )    (  )__)  )(_) )_)(_  /(__)\    ( (__  )(_)(  )    (  @@
@@ (____/(_/\/\_)(__)(__)\___)|_)\_)(_/\/\_)(____)(____/(____)(__)(__) () \___)(_____)(_/\/\_) @@
@@                                                                                             @@
@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
@@         RecommendFriends Component for Joomla! - v2.0.3 - January-06-2009 - D-Mack Media          @@
@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@

If you are changing any of the text in this component or translating into a different
language, please only edit the areas as shown below:

DEFINE("_DM_EXAMPLE",".......only edit in this area - where the dots start and stop.......");

If you change any text other than the areas specified above, you will most likely 'break'
the functionality of the component.
*/

/***********************************************************************************************/
/*************************************** Site Front End ****************************************/
/***********************************************************************************************/

DEFINE("_DM_TITLE","Poleæ nasz¹ stronê znajomym!");

/////////////////////// For Logged in Users Only
DEFINE("_DM_USER_INSTRUCTIONS","
<br />
Twoje imiê i adres e-mail, pokazany poni¿ej, bêdzie widoczny za zaproszeniach wys³anych znajomym. Uwaga, nie mo¿esz zmieniaæ tych danych.
<br /><br />
&nbsp;&nbsp;- WprowadŸ co najmniej <b>1</b> adres email znajomego
<br />");

/////////////////////// For Public Users - Anyone can send an invite/recommendation
DEFINE("_DM_USER_INSTRUCTIONS_1","
<br />
Twój adres e-mail bêdzie widoczny na wysy³anych zaproszeniach.
<br /><br />
&nbsp;&nbsp; Aby poleciæ serwis wystarczy podaæ swój adres e-mail 
<br />
&nbsp;&nbsp; i wpisaæ adresy e-mail zapraszanych osób.
<br />");

/////////////////////// Captch Instructions - If Option Selected in Admin
DEFINE("_DM_USER_INSTRUCTIONS_CAPTCHA","
&nbsp;&nbsp;- oraz wprowadziæ podany kod.
<br />");

/////////////////////// Thank You Note
DEFINE("_DM_USER_INSTRUCTIONS_THANKS","
<br />
Wype³nij pola zaznaczone <font color='red'><b>**</b></font> przed wys³aniem zaproszenia.
<br /><br />
Dziêkujemy za polecenie!
<br />");

/////////////////////// Frontend Email Form Display
DEFINE("_DM_YOUR_NAME","Wpisz Twoje imiê:");
DEFINE("_DM_YOUR_EMAIL","Twój E-mail:");
DEFINE("_DM_FRIEND1_NAME","Wpisz imiê osoby, któr¹ zapraszasz:");
DEFINE("_DM_FRIEND1_EMAIL","Wpisz adres e-mail osoby, któr¹ zapraszasz:");
DEFINE("_DM_MESSAGE","Je¿eli chcesz mo¿esz dodaæ swoj¹ wiadomoœæ:");
DEFINE("_DM_MESSAGE_HTML","Na stronie administrator pozwolil kod HTML do swojej wiadomosci. Jesli nie uzywac kodu HTML, nalezy sie upewnic, ze calkowicie prawidlowe wykorzystanie skladni HTML - w tym linii i stylów &lt;p&gt;tekst&lt;/p&gt; lub &lt;br /&gt; dla wszystkich linii przerwy, w przeciwnym wypadku wiadomosci nie beda wyswietlane poprawnie lub moze zostac odrzucony przez odbiorców!");
DEFINE("_DM_SEND","Wyslij Rekomendacja!");
DEFINE("_DM_CC_USER","zaznacz jeœli chcesz otrzymaæ kopiê zaproszenia");

/////////////////////// Javascript/Captcha Form Validation Alert Errors
DEFINE("_DM_ALERT_FROM_EMAIL_EMPTY","Proszê wprowadŸ swój adres e-mail...");
DEFINE("_DM_ALERT_TO_EMAIL_EMPTY","Proszê wprowadŸ adres e-mail osoby, któr¹ zapraszasz...");
DEFINE("_DM_ALERT_FROM_EMAIL_INVALID","Proszê sprawdŸ, czy Twój e-mail jest poprawny...");
DEFINE("_DM_ALERT_TO_EMAIL_INVALID","Proszê sprawdŸ, czy adres e-mail zapraszanej osoby jest poprawny...");
DEFINE("_DM_ALERT_MULTIPLE_EMAIL"," *** WprowadŸ drugi adres e-mail w nowym polu*** ");
DEFINE("_DM_CAPTCHA_INFO1","Aby wys³aæ zaproszenie wpisz podany kod:");
DEFINE("_DM_CAPTCHA_INFO2","Przeladowac");
DEFINE("_DM_CAPTCHA_INFO3","Trzaskac 'Przeladowac' jesli ty nie moze przeczytac ten Zabezpieczenie Wyobrazenie o osobie");
DEFINE("_DM_CAPTCHA_INFO4","Kod antyspamowy:");
DEFINE("_DM_CAPTCHA_ALERT","*** Poda³eœ niew³aœciwy kod, proszê spróbuj ponownie ***");
DEFINE("_DM_CAP_REFRESH_ALERT","Klikniecie OK spowoduje wymazanie wszystkich informacji w formie! Continue anyway?");

/////////////////////// Email Success/Fail Messages
DEFINE("_DM_SUCCESS"," Uda³o siê! Twoje zaproszenia zosta³y wys³ane!");
DEFINE("_DM_SUCCESS_LIST","Oto lista wys³anych zaproszeñ:");
DEFINE("_DM_THANK_YOU","Dziêkujemy za polecenie!");
DEFINE("_DM_FAIL"," Nie uda³o siê tym razem wys³aæ zaproszeñ.Prosimy spróbuj póŸniej.");
DEFINE("_DM_FAIL_LIST","Oto lista niewys³anych zaproszeñ:");
DEFINE("_DM_COPY_USER","Dziêkujemy za polecenie ");
DEFINE("_DM_COPY_USER1","Oto lista zaproszonych przez Ciebie osób:");
DEFINE("_DM_COPY_USER2","a to jest kopia zaproszenia jakie oni otrzymaj¹:");
DEFINE("_DM_YOUR_COPY1","Twój Poczta elektroniczna (Bcc) Kopiowac: ");
DEFINE("_DM_RECOMMEND_USER1","Polecajacy Uzytkownik Informacja: ");
DEFINE("_DM_RECOMMEND_USER2","Polecajacy Uzytkownik Wymienic i Poczta elektroniczna: ");
DEFINE("_DM_BACK","Wstecz");

/////////////////////// E-mail Sent to Friends Variables
DEFINE("_DM_HELLO","Witaj ");  //introduction in the body of the email if friends name is provided
DEFINE("_DM_HELLO_2", "Witaj!"); //introduction in the body of the email if friends name not provided
DEFINE("_DM_FRIEND","Twoj znajomy "); //used in the SUBJECT of the email (if not defined by admin) followed by username and email
DEFINE("_DM_FRIEND_2","Twój znajomy, ");  //starting line in the body of the email followed by username and email
DEFINE("_DM_INVITES_YOU"," poleca Tobie serwis ");  //follows _DM_FRIEND
DEFINE("_DM_INVITES_YOU_2","zaprasza Ciebie na strony serwisu ");  //  follows _DM_FRIEND_2
DEFINE("_DM_GO_TO","WejdŸ na stronê:");  //middle of email body where your site link actualy appears
DEFINE("_DM_TELLS_YOU","Zaproszenie od znajomego:");  //message if user filled in message field

DEFINE("_DM_FRIEND_TELLS_YOU","Your Friend's osobista wiadomosc dla Ciebie:");  //message if user filled in message field
DEFINE("_DM_ADMIN_NEWS","Great News!");

DEFINE("_DM_ADMIN_COPY"," polecono nasz serwis!");
DEFINE("_DM_ADMIN_COPY1","tutaj jest lista zaproszonych znajomych:");
DEFINE("_DM_ADMIN_COPY2","a to jest kopia zaproszenia:");


/***********************************************************************************************/
/*************************************** Admin Back End ****************************************/
/***********************************************************************************************/

/////////////////////// Administration - Main Email Configuration
DEFINE("_DM_MAIN_CONFIG","Main Email Configuration Settings:");
DEFINE("_DM_NUMREC","Number of Friends Fields:");
DEFINE("_DM_NUMREC_INFO","Enter the number of Friends email fields to be displayed in front end.");
DEFINE("_DM_FROM_REPLY","Email From User:");
DEFINE("_DM_FROM_REPLY_CHECK","Check this box if you would like the 'From' <u>and</u> 'Reply To' email addresses that appear in the RecommendFriends emails to use the Users email address.  If NOT checked, the 'From' email address will be yours(Administrator) and the 'Reply To' email address to be the Users.");
DEFINE("_DM_BCC_ADMIN","Copy (Bcc) Admin:");
DEFINE("_DM_BCC_ADMIN_CHECK","Check this box if you(Administrator) would like to receive a copy(Bcc) of all emails that are sent from RecommendFriends.  You will receive only 1 email for each batch of recommendations sent - listing the email addresses sent to, who sent the recommendation and a copy of the Body text.  Warning: depending on how many users you have, how active your site is etc., you could receive a lot of emails.");
DEFINE("_DM_CUST_SUBJECT","Use Custom Subject:");
DEFINE("_DM_CUST_SUBJECT_CHECK"," Check this box if you want to use the Custom Email Subject message below.");
DEFINE("_DM_CUST_EMAIL_SUBJECT","Custom Email Subject:");
DEFINE("_DM_CUST_EMAIL_SUBJECT_INFO","If you would like to set a custom message for the 'subject' field in the email, use this box. If you check the box, but leave the Custom Subject field empty, the default Subject Text will be used (Your Friend <b><i>Users username</i></b> wants you to check out <b><i>Your SiteName</i></b>). **<b><u>NOTE</u></b>** You can NOT use any HTML or PHP codes in this field - it MUST be plain text only!");
DEFINE("_DM_CUST_MESSAGE","Use Custom Message:");
DEFINE("_DM_CUST_MESSAGE_CHECK"," Check this box if you want to use the Custom Intro Message below.");
DEFINE("_DM_CUST_MESSAGE_HTML","Use HTML Code:");
DEFINE("_DM_CUST_MESSAGE_HTML_INFO"," Check this box to allow HTML Code in the Custom Intro Message (must enable 'Use Custom Message' checkbox above). Checking the box will send all the Emails as Content-Type:text/html MIME format!");
DEFINE("_DM_CUST_INTRO_MESSAGE","Custom Intro Message:");
DEFINE("_DM_CUST_INTRO_MESSAGE_INFO","Set a customized introduction for all the RecommendFriends emails that are sent. It will appear above the User Custom Message(optional) that the user can type in prior to sending the emails.  If you check the box, but the Custom Message field is empty, NO custom message will be used.");
DEFINE("_DM_CUST_INTRO_MESSAGE_INFO_2","**<b><u>NOTE</u></b>** You can use any HTML code in the custom message. The textarea above will strip out all blank/empty lines and whitespace, so you will need to include <b>FULL</b> formating for the HTML code using in-line styles - including proper line breaks such as &lt;p&gt;text&lt;/p&gt; or &lt;br /&gt; for line spacing, styles for all font properties, colors, etc.  You can even include images in the email - just make sure you use the FULL path to the image - i.e. &lt;img src='http://www.yoursite.com/images/emailpicture.jpg'&gt;. You should <b>NOT</b> include any opening or closing &lt;html&gt;, &lt;head&gt; or &lt;body&gt; tags.  Also note that you can NOT use any Javascript or PHP codes in this field!");
DEFINE("_DM_CUST_INTRO_MESSAGE_INFO_3","**<b><u>NOTE</u></b>** You can ONLY use plain text in the message above - no HTML, Javascript or PHP code allowed (you can use HTML code only if you check the 'Use HTML Code' checkbox above)");

/////////////////////// Administration - Front End Form Display Formatting Configuration
DEFINE("_DM_MAIN_FORMAT","Front End Form Display Format Configuration:");
DEFINE("_DM_CONFIG_SAVED","Configuration settings have been saved!");

/////////////////////// Form Fields Sizes
DEFINE("_DM_FORM_SIZE_INFO","<b>Field Widths</b> - set the widths of the Name and Email input fields displayed on the Front End");
DEFINE("_DM_FORM_NAME","Your(user) and Friends <b>Name</b> Input Field Width: ");
DEFINE("_DM_FORM_EMAIL","Your(user) and Friends <b>Email</b> Input Field Width: ");
DEFINE("_DM_FORM_MESSAGE_SIZE","Message Input Size");
DEFINE("_DM_FORM_ROWS","User Message Textarea #Rows: ");
DEFINE("_DM_FORM_COLS","User Message Textarea #Columns: ");
DEFINE("_DM_FORM_DEFAULT","Default");

/////////////////////// Form Fields
DEFINE("_DM_MAIN_FORM","<b>All Form Fields Appearance</b> - configure the form fields background and text colors on the RecommendFriends input fields (delete the color number or select 'NO COLOR' if you want to use the template CSS style - also note that the Admin CSS is probably different from the Front End CSS):");
DEFINE("_DM_MAIN_FORMBG","Back Ground Color:");
DEFINE("_DM_MAIN_FORMTX","Text Color:");
DEFINE("_DM_PREVIEW","Formatting Preview (Click 'Save' to update changes)");
DEFINE("_DM_PREVIEW_TEXT","SampleText@Yoursite.com - 1234567890");

/////////////////////// Validation Errors
DEFINE("_DM_MAIN_ERROR_INFO","<b>Form Field Error Highlighting Appearance</b> - configure the form field background and text color on fields that have a validation error - this is not controlled by a default CSS style (delete the color number or select 'NO COLOR' if you don't want any color changes):");
DEFINE("_DM_ERROR_TEST","Test");
DEFINE("_DM_ERROR_RESET","Reset");
DEFINE("_DM_ALERT_TEST","The Background and Text Colors should have changed...");

/////////////////////// Logged In Users
DEFINE("_DM_LOGGED_INFO","<b>User Name and Email Address Form Field Appearance</b> - configure how the User Name and Email Address will appear for a logged in user (delete the color number or select 'NO COLOR' if you want to use the template CSS style - also note that the Admin CSS is probably different from the Front End CSS):");
DEFINE("_DM_LOGGED_USER","The User Name");
DEFINE("_DM_LOGGED_EMAIL","UserName@Yoursite.com");

/////////////////////// Captcha Configuration
DEFINE("_DM_CAP_TITLE","Captcha Security Image Configuration");
DEFINE("_DM_GDFT_HALF","<font color='green'><b>GD Support</b></font> is Enabled but <font color='red'><b>FreeType Support</b></font> does not appear to be Enabled on your server!!");
DEFINE("_DM_GDFT_NO","<font color='red'><b>GD Support</b></font> and <font color='red'><b>FreeType Support</b></font> both appear NOT to be Enabled on your server!!");
DEFINE("_DM_GREAT_NEWS","GREAT NEWS!!!");
DEFINE("_DM_GDFT_YES","<font color='green'><b>GD Support</b></font> and <font color='green'><b>FreeType Support</b></font> are both <b>Enabled</b> on your server!!&nbsp;&nbsp;The Captcha option of the component should work just fine!");
DEFINE("_DM_GD_WARNING","<<<<<<<<<<<<&nbsp;&nbsp;&nbsp;WARNING&nbsp;&nbsp;&nbsp;>>>>>>>>>>>>");
DEFINE("_DM_GD_OPTIONS","Unfortunately it doesn't look like the Captcha option of the component will work on this server. <b>**NOTE**You can still use the RecommendFriends Component</b>, but you can not use the Captcha option below (it must be 'UNCHECKED'). You could ask your website hosting provider to enable GD and FreeType Support if you need to have Captcha...");
DEFINE("_DM_CAP_USE","Use Captcha Security:");
DEFINE("_DM_CAP_USE_INFO","Check this box if you would like to enable the Captcha Security Verification");
DEFINE("_DM_CAP_1","Main Image Options");
DEFINE("_DM_CAP_2","Width of Image (pixels)");
DEFINE("_DM_CAP_3","Height of Image (pixels)");
DEFINE("_DM_CAP_4","Random Image Rotate (+/-10 degrees)");
DEFINE("_DM_CAP_ROTATE","Check if you want the image rotated");
DEFINE("_DM_CAP_6","No");
DEFINE("_DM_CAP_7","Image Color Options");
DEFINE("_DM_CAP_COLOR_BUTTON","Select");
DEFINE("_DM_CAP_COLOR_NEW","New: ");
DEFINE("_DM_CAP_COLOR_ASIS","Set: ");
DEFINE("_DM_CAP_8","Background Color");
DEFINE("_DM_CAP_9","Text Color");
DEFINE("_DM_CAP_10","Noise Color");
DEFINE("_DM_CAP_11","Font Options");
DEFINE("_DM_CAP_12","Choose Font to Display");
DEFINE("_DM_CAP_13","MonoFont.ttf");
DEFINE("_DM_CAP_14","ComicBook.ttf");
DEFINE("_DM_CAP_15","OldCentury.ttf");
DEFINE("_DM_CAP_16","Number of Characters to Display");
DEFINE("_DM_CAP_SAMPLE","Sample of Captcha Image with Options Selected<br />(Click 'Save' to update image with new options)");

/////////////////////// User Custom Message Options
DEFINE("_DM_USER_MESSAGE","Allow User Message:");
DEFINE("_DM_USER_MESSAGE_CHECK"," Check this box to allow the User to enter a Custom Message.");
DEFINE("_DM_USER_MESSAGE_HTML","User HTML Code:");
DEFINE("_DM_USER_MESSAGE_HTML_INFO"," Check this box to allow the User to enter HTML Code in their Custom Message (must enable 'Allow User Message' checkbox above). Checking the box will send all the Emails as Content-Type:text/html MIME format!  **<b><u>NOTE</u></b>**This could potentially cause problems on some sites/servers and invalid HTML code could break the emails! Simply disable the 'User HTML Code' option if there are any issues.");

/////////////////////// Administration - Edit Langauge File
DEFINE("_DM_EDIT_LANG_HEADER","Language File Configuration/Edit");
DEFINE("_DM_EDIT_LANG","Click Here to Edit the Language File");
DEFINE("_DM_EDIT_LANG_INFO","You can change ANY of the text in this component, both the front end and the administrator text, by editing the included Language File with the handy on-line editor - give it a try!  Just click the link below...");
DEFINE("_DM_LANG_EMPTY","Can't complete the operation... Language file is empty!");
DEFINE("_DM_LANG_IS_NOT_WRITEABLE","Can't complete the operation... Language file is unwriteable!");
DEFINE("_DM_LANG_SAVED","Language file is saved!");
DEFINE('_DM_LANG_FILE','The Language File: ');
DEFINE("_DM_LANG_IS","is");
DEFINE("_DM_WRITEABLE","WRITEABLE");
DEFINE("_DM_UNWRITEABLE","UNWRITEABLE");
DEFINE("_DM_MAKE_UNWRITEABLE","Make the language file unwriteable after saving? (You can overwrite the file again on this page if you need to make more changes)");
DEFINE("_DM_OVERRRIDE_UNWRITEABLE","Override write protection while saving? (You must check the box to save any changes you have made)");

/////////////////////// Administration - Email Preview
DEFINE("_DM_EMAIL_PREVIEW","D-Mack RecommendFriends Email Preview   -   Click <b>**<u>Save</u>**</b> first to update this page to see any changes you have made...");
DEFINE("_DM_SUBJECT_IN_EMAIL","Subject Field in the Email:");
DEFINE("_DM_PREVIEW_SUBJECT","Your Friend <b><i>Users Username</i></b> wants you to check out <b><i> %s </i></b><br />");
DEFINE("_DM_PREVIEW_SHORT_INTRO","Short Intro:");
DEFINE("_DM_PREVIEW_USER_INFO","<b><i>Users Username</i></b> (<b><i>Users Emailaddress</i></b>) thinks you would be quite interested in this great site - <b><i> %s </i></b>");
DEFINE("_DM_PREVIEW_ADMIN_MESSAGE","Customized Admin Message (if used):");
DEFINE("_DM_PREVIEW_ADMIN_MESSAGE_BLANK","&nbsp;<b><i><font color='red'>***WARNING***</font></i></b> You have Enabled the Custom Message option but there is no information in the Message Field!");
DEFINE("_DM_PREVIEW_LINK","Link to Site:");
DEFINE("_DM_PREVIEW_LINK_INFO","Check out the site at: <b><i> %s </i></b>");
DEFINE("_DM_PREVIEW_USER_MESSAGE","User Message (if used):");
DEFINE("_DM_PREVIEW_USER_MESSAGE_INFO","<b><i>Users Username's</i></b> peronal message to you:");
DEFINE("_DM_PREVIEW_USER_MESSAGE_INFO2","<b><i>Users message here</i></b>");


/////////////////////// Administration - Information Page
DEFINE("_DM_PROGRAM","
    <i><b><font size='4'>
Program
    </font></b></i><br /><br />
D-Mack RecommendFriends Version v2.0.3 - January-06-2009 is a component to allow your users to recommend your website to their friends.
    <br /><br />
It can send multiple emails, number defined in Admin, with the friends name, and copy the Administrator and/or the User.  It also incorporates Captcha Security to help prevent spam and the option to send Content-Type:text/html MIME format!  ALL text for the entire component, front end and back, can be edited on-line in the Admin area of the site.  And the component is <b>XHTML 1.0 Transitional valid</b>!
    <br /><br />
This component uses standard Joomla! <b>JFactory Mailer</b> functions - which should work if your website's email settings are correctly configured for your website server (i.e. Sendmail, PHPMailer, SMTP, etc).
    <br /><br />
This is a 100% Free Component (GNU/GPL License) - You are <i>ABSOLUTELY ALLOWED</i> to modify any of the files to your liking.  The only thing I ask is to let me know if you have improved the script so I might also improve the script and re-release it to the community.  Thanks!
    <br /><br />
If you have any suggestions or have found a bug, please contact us by mail: info at dmackmedia.com
    <br /><br />
");
DEFINE("_DM_CONFIG_INFO","
    <i><b><font size='4'>
Program Configuration
    </font></b></i><br /><br />
As of this version (RecommendFriends v2.0.3 - January-06-2009) there are many great configuration settings for the component.
    <ul>
    <li>
The Administrator can set how many 'Email Fields' are displayed on the Front End.
    <br /><br /></li>
    <li>
It is possible to select how the 'From' and 'Reply To' addresses are set.  If selected (checked), the 'From' <u>and</u> 'Reply To' email addresses in the email sent to the Friend(s) will be set to the User.  If NOT selected, the 'From' email address will be set with the site 'Administrator' email address and the 'Reply To' email address will be set with the User's email address.
    <br /><br /></li>
    <li>
It is possible to set whether the site Administrator should receive a copy (Bcc) of every email sent to the user's 'Friends'.  If you have a large, active site with many users, you may want to disable this option as you possibly could receive many emails.  If selected (checked), the Admin email will be set in the Bcc field so it will not be visible to most users.
    <br /><br /></li>
    <li>
You can change or customize the 'Subject' field for the emails. There is a checkbox that determines whether to use the custom subject field or not.  Unfortunately you are not able to use custom tags or formatting at this time.  It should be text only.
    <br /><br /></li>
    <li>
You can also set a customized introduction message for the emails sent to Friends.  There is a checkbox for this that will enable/disable the use of the introduction message.  This can be a great way to get more members for your site.  You could list the features and benefits of your site that will hopefully entice friends to join.  If you have a 'Referral' program setup, this would be a great place to describe how it works, what the benefits are for a new member and explain the benefits for the User who sent the RecommendFriends emails.
    <br /><br /></li>
    <li>
There is also and option to allow/enable HTML code to be entered in the custom introduction.  Enabling the option will send all the Emails as Content-Type:text/html MIME format.  You can use any HTML code in the message, but you can NOT use any other codes (PHP, Javascript, etc.) in the custom field.
    <br /><br /></li>
        <li>
There many ways to change the appearance of the form fields in the front end.  Using custom color selectors, you can change the form field backkground and text colors, the form field validation alert background and text colors as well as the background and text colors that display the username and email address for logged in users.
    <br /><br /></li>
        <li>
RecommendFriends v2.0.3 - January-06-2009 also includes Captcha Security!  <b><u>*NOTE*</u></b> Your website server *MUST* have GD Library enabled as well as True Type Fonts!  You can choose if you want use it or not, as well as set many variables for the image including the width, height, text rotation, set all colors (background-text-noise) by using custom color selectors, choose the font type and set the number of characters displayed in the image.
    <br /><br /></li>
    <li>
** ALL ** text that is displayed on screen for this component, including the front end, admin configuration text and what you are reading now, is called through the included language file(s) in the includes folder - and now it can all be edited ** ON-LINE ** through the component!  Feel free to change the text any way you like.  If you have translated the text into a different language (other than English), please contact me so I can include your Language file into the component distribution!  Thanks!
    <br /><br /></li>
    <li>
Now with several Language (translations) Files:
<ul>
 <li>German  - de-DE.php - Front End (Thank You Fabian Metzner!)</li>
 <li>English - en-GB.php - Entire Component</li>
 <li>Spanish - es-ES.php - Entire Component (Thank You Luis J. Pumares!)</li>
 <li>French  - fr-FR.php - Entire Component (Thank You Patrick Atlas!)</li>
 <li>Italian - it-IT.php - Front End and most of Back End (Thank You Andrea Garbato!)</li>
 <li>Dutch   - nl-NL.php - Entire Component (Thank You Adri 'CanBerra' Dekker!)</li>
 <li>Polish  - pl-PL.php - Front End (Thank You Stanislaw Kordasiewicz!)</li>
 <li>Russian - ru-RU.php - Front End (Thank You Denis S.!)</li>
 <li>Turkish - tr-TR.php - Front End (Thank You Sedat Oguz!)</li>
</ul>
</ul>
<hr>
    <i><b><font size='4'>
Linking to the Component
    </font></b></i><br />
      <Table align='center' width='100%' cellpadding='12'>
        <tr>
          <td width='100%' align='left'>
            <p style='margin-top: 0; margin-bottom: 0'>To add a link to the Main Menu (mainmenu) if you want everyone (Public) to be able to use this component, follow these steps:</p>
            <ol style='font-family: Arial; font-size: 8pt'>
              <li>Click the Menu---Main Menu link</li>
              <li>Click on 'New' in the top right part of the screen</li>
              <li>Choose the 'D-Mack Recommend Friends' Component from the list</li>
              <li>Type in a Title for the link</li>
              <li>Type in an Alias for the link</li>
              <li>Don't need to change the Parent Item</li>
              <li>Click the 'Publish' radio button</li>
              <li>Make sure the Link's Access Level is set to 'Public'</li>
              <li>And Finally, click 'Save' and you should be good to go!</li>
            </ol>
            <p style='margin-top: 0; margin-bottom: 0'>To add a link to the User Menu (usermenu) if you want only 'Registered' users to use this component, follow these steps:</p>
            <ol style='font-family: Arial; font-size: 8pt'>
              <li>Click the Menu---User Menu link</li>
              <li>Follow steps 2 through 7 shown above...</li>
              <li>Make sure the Link's Access Level is set to 'Registered'</li>
              <li>And Finally, click 'Save' and you should be good to go!</li>
            </ol>
            <p style='margin-top: 0; margin-bottom: 0'>&nbsp;</p>
            <p style='margin-top: 0; margin-bottom: 0'>You can also set the component parameters by clicking Component---Recommend Friends---Configuration on the Main Admin Menu above.</p>
          </td>
        </tr>
      </table>
");
DEFINE("_DM_WARRANTY","
    <i><b><font size='4'>
Warranty
    </font></b></i><br /><br />
This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
    <br /><br />
");
/////////////////////// Administration - Configuration & Information Page Footer
DEFINE("_DM_COPYRIGHT_BOTTOM","D-Mack RecommendFriends Miscellaneous Info");
DEFINE("_DM_SUGGESTIONS","If you have any suggestions or have found a bug, please contact us by mail: info at dmackmedia.com");
DEFINE("_DM_COPYRIGHT","
D-Mack RecommendFriends component - v2.0.3 - January-06-2009 - is licensed under GNU/GPL.
    <br />
****** You are ABSOLUTELY ALLOWED to modify any of the files to your liking! ******
    <br />
If you find a bug or improve the script in any way, please let the community know by adding comment(s) either on the Extensions page or in the Forums.
    <br />
And Most of All... Have Fun!
    <br /><br />
");
?>