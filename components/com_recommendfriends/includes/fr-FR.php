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

DEFINE("_DM_TITLE","Recommander ce site &agrave; vos amis!");

/////////////////////// For Logged in Users Only
DEFINE("_DM_USER_INSTRUCTIONS","
<br />
Votre nom et votre adresse email, indiqu&eacute;s ci-dessous, <br />
appara&icirc;tront dans les messages envoy&eacute;s &agrave; vos amis.<br />
Vous ne pouvez pas &eacute;diter ces champs.
<br /><br />
&nbsp;&nbsp;- Vous devez entrer au moins <b>une</b> adresse email de vos amis.
<br />");

/////////////////////// For Public Users - Anyone can send an invite/recommendation
DEFINE("_DM_USER_INSTRUCTIONS_1","
<br />
Votre nom et votre adresse email, que vous saisirez dans les<br />
champs ci-dessous, appara&icirc;tront dans les messages envoy&eacute;s<br />
&agrave; vos amis.<br />
<br />
&nbsp;&nbsp;- Vous devez entrer <b>votre</b> adresse email.
<br />
&nbsp;&nbsp;- Vous devez entrer au moins <b>une</b> adresse email de vos amis.
<br />");

/////////////////////// Captch Instructions - If Option Selected in Admin
DEFINE("_DM_USER_INSTRUCTIONS_CAPTCHA","
&nbsp;&nbsp;- Vous devrez &eacute;galement saisir le code de s&eacute;curit&eacute; affich&eacute; ci-dessous.
<br />");

/////////////////////// Thank You Note
DEFINE("_DM_USER_INSTRUCTIONS_THANKS","
<br />
Les champs marqu&eacute;s <font color='red'><b>**</b></font> doivent &ecirc;tre obligatoirement saisis<br />  pour que votre message de recommandation soit envoy&eacute; correctement.
<br /><br />
Merci de nous faire conna&icirc;tre!
<br />");

/////////////////////// Frontend Email Form Display
DEFINE("_DM_YOUR_NAME","Votre nom:");
DEFINE("_DM_YOUR_EMAIL","Votre adresse email:");
DEFINE("_DM_FRIEND1_NAME","Les noms de vos amis (optionnel):");
DEFINE("_DM_FRIEND1_EMAIL","Les emails de vos amis:");
DEFINE("_DM_MESSAGE","Votre message personnel (optionnel):");
DEFINE("_DM_MESSAGE_HTML","L'administrateur du site a permis code HTML de votre message personnel. Si vous utilisez le code HTML, s’il vous plaît assurer que vous utilisez complètement corriger la syntaxe HTML - y compris en ligne des styles et des &lt;p&gt;texte&lt;/p&gt; ou &lt;br&gt; pour tous les sauts de ligne, sinon les e-mails n'apparaissent pas correctement ou mai être rejeté par les bénéficiaires!");
DEFINE("_DM_SEND","Envoyer Recommandation!");
DEFINE("_DM_CC_USER","Cochez cette case si vous voulez recevoir une copie cach&eacute;e (Ccc)<br /> de votre message");

/////////////////////// Javascript/Captcha Form Validation Alert Errors
DEFINE("_DM_ALERT_FROM_EMAIL_EMPTY","Vous devez entrer votre adresse email...");
DEFINE("_DM_ALERT_TO_EMAIL_EMPTY","Vous devez entrer au moins une adresse a laquelle envoyer...");
DEFINE("_DM_ALERT_FROM_EMAIL_INVALID","Assurez vous que votre adresse email est valide (ie. ami@home.com)...");
DEFINE("_DM_ALERT_TO_EMAIL_INVALID","Assurez vous que les adresses email de vos amis sont valides (ie. ami@home.com)...");
DEFINE("_DM_ALERT_MULTIPLE_EMAIL"," *** Une adresse mail par champ autorisee... *** ");
DEFINE("_DM_CAPTCHA_INFO1","Syst&egrave;me de s&eacute;curit&eacute; anti-spam - Saisissez le code de s&eacute;curit&eacute; affich&eacute;:");
DEFINE("_DM_CAPTCHA_INFO2","Recharger");
DEFINE("_DM_CAPTCHA_INFO3","Cliquez sur 'Recharger' si vous ne pouvez pas lire Code de s&eacute;curit&eacute;");
DEFINE("_DM_CAPTCHA_INFO4","Code de S&eacute;curit&eacute;:");
DEFINE("_DM_CAPTCHA_ALERT","*** Vous avez saisi un code de s&eacute;curit&eacute; invalide - R&eacute;essayez ***");
DEFINE("_DM_CAP_REFRESH_ALERT","En cliquant sur OK effacera toutes les informations sur le formulaire!  Continuer?");

/////////////////////// Email Success/Fail Messages
DEFINE("_DM_SUCCESS"," message(s) a(ont) &eacute;t&eacute; envoy&eacute;s!");
DEFINE("_DM_SUCCESS_LIST","Voici la liste des emails &agrave; qui le message a &eacute;t&eacute; envoy&eacute;:");
DEFINE("_DM_THANK_YOU","Merci de nous faire conna&icirc;tre!");
DEFINE("_DM_FAIL"," message(s) n'a(ont) pas &eacute;t&eacute; envoy&eacute;s.  R&eacute;essayez plus tard.");
DEFINE("_DM_FAIL_LIST","Voici la liste des emails &agrave; qui le message n'a pas &eacute;t&eacute; envoy&eacute;:");
DEFINE("_DM_COPY_USER","Merci de nous faire connaître ");
DEFINE("_DM_COPY_USER1","Voici la liste des noms et des emails à qui vous avez envoyé votre message:");
DEFINE("_DM_COPY_USER2","Voici une copie du message que vos amis recevront:");
DEFINE("_DM_YOUR_COPY1","Votre email pour une copie cach&eacute;e (Ccc): ");
DEFINE("_DM_RECOMMEND_USER1","Information concernant la personne qui a recommandé le site: ");
DEFINE("_DM_RECOMMEND_USER2","Nom et email concernant la personne qui a recommandé le site: ");
DEFINE("_DM_BACK","Retour");

/////////////////////// E-mail Sent to Friends Variables
DEFINE("_DM_HELLO","Bonjour, ");  //introduction in the body of the email if friends name is provided
DEFINE("_DM_HELLO_2", "Bonjour!"); //introduction in the body of the email if friends name not provided
DEFINE("_DM_FRIEND","Votre ami "); //used in the SUBJECT of the email (if not defined by admin) followed by username and email
DEFINE("_DM_FRIEND_2","Un de vos amis, ");  //starting line in the body of the email followed by username and email
DEFINE("_DM_INVITES_YOU"," souhaite vous faire connaître ");  //follows _DM_FRIEND
DEFINE("_DM_INVITES_YOU_2","pense que vous serez intéressé par ce site  - ");  //  follows _DM_FRIEND_2
DEFINE("_DM_GO_TO","Visitez le site à l'adresse suivante:");  //middle of email body where your site link actualy appears
DEFINE("_DM_TELLS_YOU"," a un message personnel pour vous:");  //message if user filled in message field
DEFINE("_DM_FRIEND_TELLS_YOU","Votre ami message personnel &agrave; vous:");  //message if user filled in message field
DEFINE("_DM_ADMIN_NEWS","Great News!");
DEFINE("_DM_ADMIN_COPY"," vient juste d'être recommandé par un utilisateur à ses amis!");
DEFINE("_DM_ADMIN_COPY1","Voici la liste des amis à qui le message a été envoyé:");
DEFINE("_DM_ADMIN_COPY2","Voici une copie du message qui a été reçu:");


/***********************************************************************************************/
/*************************************** Admin Back End ****************************************/
/***********************************************************************************************/

/////////////////////// Administration - Main Email Configuration
DEFINE("_DM_MAIN_CONFIG","Principaux param&egrave;tres de configuration e-mail:");
DEFINE("_DM_NUMREC","Nombre de champs 'amis':");
DEFINE("_DM_NUMREC_INFO","Saisissez le nombre de champs 'amis' &agrave; faire appara&icirc;tre dans le formulaire.");
DEFINE("_DM_FROM_REPLY","Email de l'utilisateur:");
DEFINE("_DM_FROM_REPLY_CHECK","Cochez cette case si vous souhaitez que les champs 'De' <u>et</u> 'R&eacute;ponse &agrave;' apparaissent avec l'adresse email de l'utilisateur. Si non, le champ 'De' contiendra l'adresse email de l'administrateur et le champ 'R&eacute;ponse &agrave' celui de l'utilisateur.");
DEFINE("_DM_BCC_ADMIN","Faire une copie cach&eacute;e (Ccc) &agrave; l'administrateur:");
DEFINE("_DM_BCC_ADMIN_CHECK","Cochez cette case si vous (l'administrateur) voulez recevoir une copie cach&eacute;e de tous les messages envoy&eacute;s par le composant RecommendFriends.  Vous recevrez seulement un message pour chaque lot de recommandation envoy&eacute; avec la liste des adresses email , qui a envoy&eacute; la recommandation et une copie du corps du message.  Attention : en fonction du nombre d'internautes que vous recevez et de la fr&eacute;quentation du site, vous pourriez recevoir beaucoup de messages.");
DEFINE("_DM_CUST_SUBJECT","Utiliser un champ sujet personnalis&eacute;:");
DEFINE("_DM_CUST_SUBJECT_CHECK"," Cochez cette case si vous souhaitez utiliser le champ sujet personnalis&eacute; ci-dessous.");
DEFINE("_DM_CUST_EMAIL_SUBJECT","Champ sujet personnalis&eacute;:");
DEFINE("_DM_CUST_EMAIL_SUBJECT_INFO","Remplissez ici le message personnalis&eacute; pour le champ 'sujet' du message. Si la case est coch&eacute;e, mais que vous laissez le champ 'sujet' personnalis&eacute; vide, le texte sujet par d&eacute;faut sera utilis&eacute; (Votre ami <b><i>Nom de l'Ami</i></b> souhaite vous faire d&eacute;couvrir <b><i>Votre Site Web</i></b>). **<b><u>NOTE</u></b>** Vous ne pouvez utiliser ni HTML ni code PHP dans ce champ, seulement du texte brut!");
DEFINE("_DM_CUST_MESSAGE","Inclure un message personnalis&eacute;:");
DEFINE("_DM_CUST_MESSAGE_CHECK"," Cochez cette case si vous souhaitez inclure un message d'introduction personnalis&eacute;.");
DEFINE("_DM_CUST_MESSAGE_HTML","Utilisez le code HTML:");
DEFINE("_DM_CUST_MESSAGE_HTML_INFO"," Cochez cette case pour permettre code HTML dans le Message personnalis&eacute; Intro (doit permettre 'Utiliser Message personnalis&eacute;' case ci-dessus). Cochant la case enverra tous les e-mails que Content-Type: text / html format MIME!");
DEFINE("_DM_CUST_INTRO_MESSAGE","Message d'introduction personnalis&eacute;:");
DEFINE("_DM_CUST_INTRO_MESSAGE_INFO","Définir une introduction personnalisé pour tous les RecommendFriends e-mails qui sont envoyés. Il apparaîtra au-dessus de l'utilisateur Message personnalisé (optionnel) que l'utilisateur peut taper avant d'envoyer des e-mails. Si vous cochez cette case, mais le champ Message personnalisé est vide, aucun message personnalisé sera utilisé");
DEFINE("_DM_CUST_INTRO_MESSAGE_INFO_2","**<b><u>NOTE</u></b>** Vous pouvez utiliser n'importe quel code HTML dans le message personnalisé. Le texte ci-dessus toutes les bandes en blanc / lignes vides et les espaces, alors vous aurez besoin d'inclure <b>COMPLETE</b> formatage pour le code HTML en utilisant des styles de lignes - y compris le bon sauts de ligne tels que &lt;p&gt;texte&lt;/p&gt; ou &lt;br&gt; ou pour l'espacement des lignes, des styles pour tous les biens font, couleurs, etc Vous pouvez même inclure des images dans l'e-mail - assurez-vous que vous utilisez le chemin complet vers l'image - c'est-à-dire &lt;img src = 'http://www.yoursite.com/images/emailpicture.jpg'&gt;. Vous devriez <b>PAS</b> comporte aucune ouverture ou la fermeture &lt;html&gt;, &lt;head&gt; ou &lt;body&gt; balises. Notez également que vous ne pouvez pas utiliser tout le Javascript ou les codes PHP dans ce domaine!");
DEFINE("_DM_CUST_INTRO_MESSAGE_INFO_3","**<b><u>NOTE</u></b>** Vous ne pouvez utiliser le format ASCII dans le message ci-dessus - pas de HTML, Javascript ou du code PHP autorisés (vous pouvez utiliser du code HTML que si vous cochez 'Utilisation de code HTML' case ci-dessus)");

/////////////////////// Administration - Front End Form Display Formatting Configuration
DEFINE("_DM_MAIN_FORMAT","Configuration du format d'affichage du formulaire:");
DEFINE("_DM_CONFIG_SAVED","Des param&#269;tres de configuration ont &eacute;t&eacute; sauv&eacute;es!");

/////////////////////// Form Fields Sizes
DEFINE("_DM_FORM_SIZE_INFO","<b>Champ Largeurs</b> - fixe la largeur du nom et e-mail les champs de saisie s'affiche sur le Front End");
DEFINE("_DM_FORM_NAME","Votre (utilisateur) et Amis <b>Nom</b> Champ de saisie Largeur: ");
DEFINE("_DM_FORM_EMAIL","Votre (utilisateur) et Amis <b>E-mail</b> Champ de saisie Largeur: ");
DEFINE("_DM_FORM_MESSAGE_SIZE","Message d'entrée Taille");
DEFINE("_DM_FORM_ROWS","Utilisateur Message #Lignes de texte: ");
DEFINE("_DM_FORM_COLS","Utilisateur Message #colonnes de texte: ");
DEFINE("_DM_FORM_DEFAULT","Défaut");

/////////////////////// Form Fields
DEFINE("_DM_MAIN_FORM","<b>Apparence de tous les champs du formulaire</b> - configure les couleurs du fond et du texte des champs de saisie du composant RecommendFriends (effacez le num&eacute;ro de la couleur ou s&eacute;lectionnez 'PAS DE COULEUR' si vous souhaitez utiliser le style CSS par d&eacute;faut. Notez que le style CSS de l'administration n'est probablement pas le m&ecirc;me que le style CSS du site):");
DEFINE("_DM_MAIN_FORMBG","Couleur du fond:");
DEFINE("_DM_MAIN_FORMTX","Couleur du texte:");
DEFINE("_DM_PREVIEW","Aper&ccedil;u du formatage (Cliquez 'Sauver' pour sauvegarder les changements)");
DEFINE("_DM_PREVIEW_TEXT","TexteExemple@VotreSite.fr - 1234567890");

/////////////////////// Validation Errors
DEFINE("_DM_MAIN_ERROR_INFO","<b>Apparence des champs du formulaire contenant des erreurs</b> - configure les couleurs du fond et du texte des champs de saisie qui contiennent une erreur - Ceci n'est pas sous le contr&ocirc;le d'un style CSS par d&eacute;faut (effacez le num&eacute;ro de la couleur ou s&eacute;lectionnez 'PAS DE COULEUR' si vous ne souhaitez pas que les couleurs changent):");
DEFINE("_DM_ERROR_TEST","Tester");
DEFINE("_DM_ERROR_RESET","R&eacute;initialiser");
DEFINE("_DM_ALERT_TEST","Les couleurs du fond et du texte ont du changer...");

/////////////////////// Logged In Users
DEFINE("_DM_LOGGED_INFO","<b>Apparence des champs nom d'utilisateur et adresse email</b> - configure comment le nom d'utilisateur et l'adresse email apparaissent pour un utilisateur connect&eacute; (effacez le num&eacute;ro de la couleur ou s&eacute;lectionnez 'PAS DE COULEUR' si vous voulez utiliser le style CSS par d&eacute;faut - Notez que le style CSS de l'administration n'est probablement pas le m&ecirc;me que le style CSS du site):");
DEFINE("_DM_LOGGED_USER","Le nom d'utilisateur");
DEFINE("_DM_LOGGED_EMAIL","NomUtilisateur@VotreSite.fr");

/////////////////////// Captcha Configuration
DEFINE("_DM_CAP_TITLE","Configuration de l'image de s&eacute;curit&eacute; captcha");
DEFINE("_DM_GDFT_HALF","GD Support est Active FreeType Support mais ne semble pas etre active sur votre serveur!!");
DEFINE("_DM_GDFT_NO","GD et FreeType Support Support deux ne semblent pas etre active sur votre serveur!!");
DEFINE("_DM_GREAT_NEWS","GREAT NEWS!!!");
DEFINE("_DM_GDFT_YES","GD et FreeType Support de soutien sont a la fois active sur votre serveur! Captcha Le choix de la composante devrait fonctionner a merveille!");
DEFINE("_DM_GD_WARNING","<<<<<<<<<<<<&nbsp;&nbsp;&nbsp;AVERTISSEMENT&nbsp;&nbsp;&nbsp;>>>>>>>>>>>>");
DEFINE("_DM_GD_OPTIONS","Malheureusement, il ne ressemble a la Captcha choix de la composante travail sur ce serveur. ** NOTE ** Vous pouvez toujours utiliser les composants RecommendFriends, mais vous ne pouvez pas utiliser l'option ci-dessous Captcha (elle doit etre 'UNCHECKED'). Vous pouvez demander a votre fournisseur d'hebergement de sites Web pour permettre GD et FreeType support Si vous avez besoin d'avoir Captcha...");
DEFINE("_DM_CAP_USE","Utiliser la s&eacute;curit&eacute; captcha:");
DEFINE("_DM_CAP_USE_INFO","Cochez cette case si vous souhaitez utiliser la v&eacute;rification par s&eacute;curit&eacute captcha");
DEFINE("_DM_CAP_1","Options principales de l'image");
DEFINE("_DM_CAP_2","Largeur de l'image (en pixel)");
DEFINE("_DM_CAP_3","Hauteur de l'image (en pixel)");
DEFINE("_DM_CAP_4","Rotation al&eacute;atoire de l'image (+/-10 degr&eacute;s)");
DEFINE("_DM_CAP_ROTATE","Cochez cette case si vous souhaitez une rotation al&eacute;atoire de l'image");
DEFINE("_DM_CAP_6","Non");
DEFINE("_DM_CAP_7","Options de couleur de l'image");
DEFINE("_DM_CAP_COLOR_BUTTON","S&eacute;lectionner");
DEFINE("_DM_CAP_COLOR_NEW","<br />Nouveau: ");
DEFINE("_DM_CAP_COLOR_ASIS","Enregistr&eacute;: ");
DEFINE("_DM_CAP_8","Couleur du fond");
DEFINE("_DM_CAP_9","Couleur du texte");
DEFINE("_DM_CAP_10","Couleur du bruit");
DEFINE("_DM_CAP_11","Options de la police de caract&egrave;re");
DEFINE("_DM_CAP_12","Choisissez la police de caract&egrave;re &agrave; afficher");
DEFINE("_DM_CAP_13","MonoFont.ttf");
DEFINE("_DM_CAP_14","ComicBook.ttf");
DEFINE("_DM_CAP_15","OldCentury.ttf");
DEFINE("_DM_CAP_16","Nombre de caract&egrave;res &agrave; afficher");
DEFINE("_DM_CAP_SAMPLE","Exemple d'image captcha avec les options s&eacute;lectionn&eacute;es<br />(Cliquez sur 'Sauver' pour mettre &agrave jour les nouvelles options - ou 'Recharger' pour obtenir un nouveau code de la s&eacute;curit&eacute;)");

/////////////////////// User Custom Message Options
DEFINE("_DM_USER_MESSAGE","Autoriser l'utilisateur message:");
DEFINE("_DM_USER_MESSAGE_CHECK"," Cochez cette case pour permettre &agrave; l'utilisateur d'entrer un message personnalis&eacute;.");
DEFINE("_DM_USER_MESSAGE_HTML","Html code d'utilisateur:");
DEFINE("_DM_USER_MESSAGE_HTML_INFO"," Cochez cette case pour permettre &agrave; l'utilisateur d'entrer de code HTML dans leur Message personnalis&eacute; (doit permettre 'Autoriser l'utilisateur Message' case ci-dessus). Cochant la case enverra tous les e-mails que Content-Type: text / html format MIME! ** <b> <u> NOTE </ u> </ b> ** Cela pourrait potentiellement causer des probl&#269;mes sur certains sites / serveurs et non valide HTML code pourrait briser les e-mails! Il suffit de d&eacute;sactiver 'l'utilisateur code HTML' option s'il ya des questions.");

/////////////////////// Administration - Edit Langauge File
DEFINE("_DM_EDIT_LANG_HEADER","Edition/configuration du fichier de langue");
DEFINE("_DM_EDIT_LANG","Cliquez ici pour &eacute;diter le fichier de langue");
DEFINE("_DM_EDIT_LANG_INFO","Vous pouvez changer tout le texte dans ce composant, correspondant &agrave; la partie utilisateur et &agrave; la partie administrateur, en &eacute;ditant le fichier langue inclus avec l'&eacute;diteur en ligne inclus. Essayez en cliquant sur le lien ci-dessous...");
DEFINE("_DM_LANG_EMPTY","Impossible de terminer l'op&eacute;ration... Le fichier langue est vide!");
DEFINE("_DM_LANG_IS_NOT_WRITEABLE","Impossible de terminer l'op&eacute;ration... Le fichier langue est prot&eacute;g&eacute; en &eacute;criture!");
DEFINE("_DM_LANG_SAVED","Le fichier langue est sauvegard&eacute;!");
DEFINE('_DM_LANG_FILE','Le fichier langue: ');
DEFINE("_DM_LANG_IS","est");
DEFINE("_DM_WRITEABLE","MODIFIABLE");
DEFINE("_DM_UNWRITEABLE","PROTEGE en &eacute;criture");
DEFINE("_DM_MAKE_UNWRITEABLE","Prot&eacute;ger le fichier langue apr&egrave;s la sauvegarde? (Vous pourrez faire d'autres modifications plus tard si vous le souhaitez en utilisant cette page)");
DEFINE("_DM_OVERRRIDE_UNWRITEABLE","Supprimer la protection du fichier langue apr&egrave;s la sauvegarde? (Vous devrez cocher cette case pour pouvoir sauvegarder dans un fichier prot&eacute;g&eacute;)");

/////////////////////// Administration - Email Preview
DEFINE("_DM_EMAIL_PREVIEW","Pr&eacute;visualisation de l'email de recommandation   -   Cliquez d'abord sur <b>**<u>Sauvegarder</u>**</b> pour mettre &agrave; cette page avant de voir les modifications que vous avez faites...");
DEFINE("_DM_SUBJECT_IN_EMAIL","Sujet du message:");
DEFINE("_DM_PREVIEW_SUBJECT","Votre ami <b><i>Nom de l'Ami</i></b> souhaite vous faire conna&icirc;tre ce site : <b><i> %s </i></b><br /><br />");
DEFINE("_DM_PREVIEW_SHORT_INTRO","Courte introduction:");
DEFINE("_DM_PREVIEW_USER_INFO","<b><i>Nom de l'Ami</i></b> (<b><i>Email de l'Ami</i></b>) pense que vous serez tr&egrave;s int&eacute;ress&eacute; par ce site web - <b><i> %s </i></b>");
DEFINE("_DM_PREVIEW_ADMIN_MESSAGE","Message administrateur personnalis&eacute; (s'il est utilis&eacute;):");
DEFINE("_DM_PREVIEW_ADMIN_MESSAGE_BLANK","&nbsp;<b><i><font color='red'>***AVERTISSEMENT***</font></i></b> Vous avez activ&eacute; l'option Message personnalis&eacute;, mais il n'ya pas d'information dans le domaine de message!");
DEFINE("_DM_PREVIEW_LINK","Lien vers le site:");
DEFINE("_DM_PREVIEW_LINK_INFO","D&eacute;couvrez le site &agrave; cette adresse: <b><i> %s </i></b>");
DEFINE("_DM_PREVIEW_USER_MESSAGE","Message pour l'utilisateur (s'il est utilis&eacute;):");
DEFINE("_DM_PREVIEW_USER_MESSAGE_INFO","<b><i>Nom d'utilisateur Les utilisateurs de</i></b> peronal message:");
DEFINE("_DM_PREVIEW_USER_MESSAGE_INFO2","<b><i>Les utilisateurs message ici</i></b>");

/////////////////////// Administration - Information Page
DEFINE("_DM_PROGRAM","
    <i><b><font size='4'>
Programme
    </font></b></i><br /><br />
D-Mack RecommendFriends Version v2.0.3 - January-06-2009 est un composant permettant &agrave; des utilisateurs de recommander votre site &agrave; leurs amis.
    <br /><br />
Il peut envoyer plusieurs messages simultan&eacute;ment, selon un nombre d&eacute;fini par l'administrateur, avec les noms des destinataires et une copie &agrave; l'administrateur et/ou &agrave; l'utilisateur. Il peut &eacute;galement inclure une s&eacute;curit&eacute; par l'utilisation d'image captcha pour aider &agrave; la pr&eacute;vention des spams!
    <br /><br />
Ce composant utilise la fonction Joomla! <b>mosMail</b> - qui fonctionnera si l'option de mail de votre site est correctement configur&eacute;e pour votre serveur web (par exemple Sendmail, SMTP, etc).
    <br /><br />
C'est un composant libre &agrave; 100% (GNU/GPL License) - Vous &ecirc;tes <i>ABSOLUMENT AUTORISE</i> &agrave; modifier tous les fichiers que vous souhaitez.  La seule chose que je demande est de me faire savoir si vous avez am&eacute;lior&eacute; le script, ainsi je pourrai &eacute;galement le faire et proposer de nouvelles versions &agrave; la communaut&eacute;. Merci!
    <br /><br />
Si vous avez des suggestions ou si vous avez d&eacute;couvert un bug, merci de prendre contact avec moi par email! : info at dmackmedia.com
    <br /><br />
");
DEFINE("_DM_WARRANTY","
    <i><b><font size='4'>
Garantie
    </font></b></i><br /><br />
This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. (note: laiss&eacute; en anglais pour respecter les termes juridiques, en d'autres termes: le programme est distribu&eacute; dans l'espoir qu'il sera utile mais SANS AUCUNE GARANTIE.)
    <br /><br />
");
DEFINE("_DM_CONFIG_INFO","
    <i><b><font size='4'>
Configuration du programme
    </font></b></i><br /><br />
Dans la version de ce composant (RecommendFriends v2.0.3 - January-06-2009), il y a beaucoup d'options int&eacute;ressantes dans la configuration.
    <ul>
    <li>
L'administrateur peut d&eacute;finir le nombre de champs 'Email' affich&eacute;s dans l'interface utilisateur.
    <br /><br /></li>
    <li>
Il est possible de choisir comment les champs 'De' et 'R&eacute;pondre &agrave;' sont remplis. Si l'option est activ&eacute;e, les champs 'De' <u>et</u> 'R&eacute;pondre &agrave;' des messages envoy&eacute;s aux amis contiendront l'email de l'utilisateur. Sinon, le champ 'De' des messages envoy&eacute;s contiendra l'email de l'administrateur tel qu'il est configur&eacute; dans le site, et le champ 'R&eacute;pondre &agrave;' contiendra l'email de l'utilisateur.
    <br /><br /></li>
    <li>
Il est possible d'indiquer si l'administrateur du site doit recevoir une copie cach&eacute;e de chaque message envoy&eacute; aux amis de l'utilisateur. Si votre site est tr&egrave;s actif et re&ccedil;oit beaucoup d'internautes, vous devriez d&eacute;sactiver cette option sinon vous recevrez beaucoup de messages. Si l'option est activ&eacute;e, l'adresse email de l'administrateur sera indiqu&eacute;e dans le champ Ccc et ne sera ainsi pas visible par les destinataires.
    <br /><br /></li>
    <li>
Vous pouvez changer ou personnaliser le champ 'Sujet' des messages. Une case &agrave; cocher permet de d&eacute;terminer si le champ sujet est personnalis&eacute; ou pas. Il n'est pas possible pour l'instant d'utiliser des balises ou des formattages personnalis&eacute;s. Le champ sujet doit &ecirc;tre &eacute;crit en texte brut.
    <br /><br /></li>
    <li>
Vous pouvez &eacute;galement personnaliser un message d'introduction dans les messages envoy&eacute;s aux amis. Une case &agrave; cocher permet de s&eacute;lectionner/d&eacute;s&eacute;lectionner l'usage du message d'introduction. C'est une bonne fa&ccedil;on d'obtenir encore plus de visiteurs et d'utilisateurs pour votre site. Vous pouvez lister les fonctionnalit&eacute;s et les avantages de votre site pour inciter les internautes &agrave; vous rejoindre. Si vous avez un programme de parrainage, ce serait un tr&egrave;s bon endroit pour d&eacute;crire comment il fonctionne, quels b&eacute;n&eacute;fices peuvent en retirer les nouveaux membres et les utilisateurs quand ils recommandent votre site. Il n'est pas possible pour l'instant d'utiliser des balises ou des formattages personnalis&eacute;s. Le champ sujet doit &ecirc;tre &eacute;crit en texte brut.
    <br /><br /></li>
        <li>
Il existe de nombreuses fa&ccedil;ons de modifier l'apparence des champs des formulaires pour les utilisateurs. En utilisant des s&eacute;lecteurs de couleurs personnalis&eacute;es, vous pouvez changer les couleurs du fond et du texte des champs de saisie, celles des champs d'alerte de validation ainsi que celles de l'affichage des noms et des adresses email des utilisateurs enregistr&eacute;s.
    <br /><br /></li>
        <li>
RecommendFriends v2.0.3 - January-06-2009 inclut maintenant la s&eacute;curit&eacute; captcha. Vous pouvez choisir de l'utiliser ou non. De nombreuses variables permettent de choisir la hauteur et la largeur de l'image, la rotation du texte et toutes les couleurs en utilisant des s&eacute;lecteurs de couleurs, de choisir la police de caract&egrave;res et le nombre de caract&egrave;res affich&eacute;s dans l'image.
    <br /><br /></li>
    <li>
** TOUT ** le texte affich&eacute; &agrave; l'&eacute;cran pour le composant, y compris l'interface utilisateur, le texte de configuration de l'administrateur et ce que vous lisez maintenant, est appel&eacute; en utilisant le(s) fichier(s) de langue inclus. Il peut &ecirc;tre maintenant &eacute;dit&eacute; ** EN LIGNE ** par le composant! Changez le texte comme vous le souhaitez. Si vous avez traduit le texte dans d'autres langues (autres que le fran&ccedil;ais et l'anglais), veuillez me contacter, ainsi je pourrai inclure votre fichier langue dans la prochaine distribution du composant! Merci!
    <br /><br /></li>
    <li>
Maintenant, avec plusieurs Langue (traductions) Fichiers:
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
Lien vers le composant
    </font></b></i><br />
      <Table align='center' width='100%' cellpadding='12'>
        <tr>
          <td width='100%' align='left'>
            <p style='margin-top: 0; margin-bottom: 0'>Pour ajouter un lien dans le menu principal (mainmenu) si vous souhaitez que tout le monde (visiteurs) puisse utiliser ce composant, suivez les instructions suivantes:</p>
            <ol style='font-family: Arial; font-size: 8pt'>
              <li>Cliquez sur Menu -> mainmenu</li>
              <li>Cliquez sur 'Nouveau' en haut &agrave; droite de l'&eacute;cran</li>
              <li>Choisissez 'Composant' dans le tableau des Composants</li>
              <li>Cliquez sur 'Suivant' en haut &agrave; droite de l'&eacute;cran</li>
              <li>Saisissez un nom pour le lien</li>
              <li>S&eacute;lectionnez Recommend Friends dans la liste des composants</li>
              <li>Vous n'avez pas besoin de changer l'item Parent</li>
              <li>V&eacute;rifiez que le niveau d'acc&egrave;s est positionn&eacute; sur 'Public'</li>
              <li>Cliquez sur le bouton radio 'Publié'</li>
              <li>Et enfin, cliquez sur 'Sauvez' et vous devriez avoir tout bon!</li>
            </ol>
            <p style='margin-top: 0; margin-bottom: 0'>Pour ajouter un lien dans le menu utilisateur (usermenu) si vous souhaitez uniquement que les utilisateurs enregistr&eacute;s utilisent ce composant, suivez ces instructions:</p>
            <ol style='font-family: Arial; font-size: 8pt'>
              <li>Cliquez sur Menu -> usermenu</li>
              <li>Suivez les instructions 2 &agrave; 7 ci-dessus...</li>
              <li>V&eacute;rifiez que le niveau d'acc&egrave;s est positionn&eacute; sur 'Membre'</li>
              <li>Cliquez sur le bouton radio 'Publié'</li>
              <li>Et enfin, cliquez sur 'Sauvez' et vous devriez avoir tout bon!</li>
            </ol>
            <p style='margin-top: 0; margin-bottom: 0'>&nbsp;</p>
            <p style='margin-top: 0; margin-bottom: 0'>Vous pouvez configurer les param&egrave;tres du composant en cliquant sur le menu Composants->Recommend Friends->Configuration dans le menu administration ci-dessus.</p>
          </td>
        </tr>
      </table>
");

/////////////////////// Administration - Configuration & Information Page Footer
DEFINE("_DM_COPYRIGHT_BOTTOM","Informations diverses concernant D-Mack RecommendFriends");
DEFINE("_DM_SUGGESTIONS","Si vous avez des suggestions ou si vous avez d&eacute;couvert un bug, merci de prendre contact avec moi par email! : info at dmackmedia.com");
DEFINE("_DM_COPYRIGHT","
Le composant D-Mack RecommendFriends - v2.0.3 - January-06-2009 - est licenci&eacute; sous GNU/GPL.
    <br />
****** Vous &ecirc;tes ENTIEREMENT AUTORISE &agrave; modifier les fichiers selon vos besoins! ******
    <br />
Si vous avez trouv&eacute; un bug ou si vous avez am&eacute;lior&eacute; le script de toutes les mani&egrave;res que ce soit, merci de laisser &agrave; la communaut&eacute; la possibilit&eacute; de le savoir par l'interm&eacute;diaire d'un commentaire ajout&eacute; dans les pages de l'extention ou dans les forums.
    <br />
Et plus que tout... Prenez du plaisir!
    <br /><br />
");
?>
