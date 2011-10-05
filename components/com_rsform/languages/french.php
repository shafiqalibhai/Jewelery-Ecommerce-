<?php
/**
* @version 1.2.0
* @package RSform!Pro 1.2.0
* @copyright (C) 2007-2009 www.rsjoomla.com
* @license Commercial License, http://www.rsjoomla.com/terms-and-conditions.html
*/

//TOOLBAR
DEFINE('_RSFORM_BACKEND_TOOLBAR_MAIN','RSform');
DEFINE('_RSFORM_BACKEND_TOOLBAR_SUPPORT','Support');
DEFINE('_RSFORM_BACKEND_TOOLBAR_EDIT','Editer');
DEFINE('_RSFORM_BACKEND_TOOLBAR_REMOVE','Supprimer');
DEFINE('_RSFORM_BACKEND_TOOLBAR_REMOVE_ALL','Supprimer tout');
DEFINE('_RSFORM_BACKEND_TOOLBAR_DUPLICATE','Copier');
DEFINE('_RSFORM_BACKEND_TOOLBAR_CLOSE','Fermer');
DEFINE('_RSFORM_BACKEND_TOOLBAR_EXPORT','Exporter');
DEFINE('_RSFORM_BACKEND_TOOLBAR_EXPORT_ALL','Exporter Tout');
DEFINE('_RSFORM_BACKEND_TOOLBAR_NEWFIELD','Nouveau Champ');
DEFINE('_RSFORM_BACKEND_TOOLBAR_UPDATE','Mise � jour');
DEFINE('_RSFORM_BACKEND_TOOLBAR_PREVIEW','Pr�visualisation');
DEFINE('_RSFORM_BACKEND_NO','Non');
DEFINE('_RSFORM_BACKEND_YES','Oui');


//INSTALLER
DEFINE('_RSFORM_INSTALLER_TABLES_OK','<font color="green"><b>Succ�s</b></font>, Les tables de RSform!Pro ont �t� cr��es<br/>');
DEFINE('_RSFORM_INSTALLER_XML_OK','');
DEFINE('_RSFORM_INSTALLER_PLUGIN_OK','<font color="green"><b>Succ�s</b></font>, %s Plugin Ajout�<br/>');
DEFINE('_RSFORM_INSTALLER_MODULE_OK','<font color="green"><b>Succ�s</b></font>, %s Module Ajout�<br/>');
DEFINE('_RSFORM_INSTALLER_PERMISSIONS_OK','<font color="green"><b>Succ�s</b></font>, Permissions chang�s sur le r�pertroire %s � %s<br/>');
DEFINE('_RSFORM_INSTALLER_DB_OK','<font color="green"><b>Succ�s</b></font>, Base de donn�es mise � jour<br/>');

DEFINE('_RSFORM_INSTALLER_TABLES_ERROR','<font color="red"><b>Error</b></font>, Les tables de RSform!Pro ont rencontr�es un probl�me lors de leur cr�ation :<br/>%s<br/>');
DEFINE('_RSFORM_INSTALLER_PLUGIN_ERROR','<font color="red"><b>Error</b></font>, Ne peux pas ajouter le plugin. Erreur:<br/>%s<br/>');
DEFINE('_RSFORM_INSTALLER_XML_ERROR','<font color="red"><b>Error</b></font>, Ne trouve pas le fichier xml. Erreurr:<br/>%s<br/>');
DEFINE('_RSFORM_INSTALLER_MODULE_ERROR','<font color="red"><b>Error</b></font>, Ne peux pas ajouter le module. Erreur:<br/>%s<br/>');
DEFINE('_RSFORM_INSTALLER_PERMISSIONS_ERROR','<font color="red"><b>Error</b></font>, Les permissions ne peuvent �tre chang�es pour  %s. Effectuer le changement manuellement %s<br/>');
DEFINE('_RSFORM_INSTALLER_DB_ERROR','<font color="red"><b>Error</b></font>, La base de donn�es ne peut-�tre mise � jour :<br/>%s<br/>');

DEFINE('_RSFORM_INSTALLER_WELCOME','<b>RSForm! Pro 1.2.0 Composant pour Joomla!</b><br/>
&copy; 2007-2009 by <a href="http://www.rsjoomla.com" target="_blank">http://www.rsjoomla.com</a><br/>
Tous droits reserv�s.
<br/><br/>

Ce composant a �t� enregistr� sous <a href="http://www.rsjoomla.com/license/rsformpro.html" target="_blank">License Commerciale</a>.<br/>
<br/><br/>

<b>Visitez <a href="http://www.rsjoomla.com/" target="_blank">http://www.rsjoomla.com/</a> - pour l\'utilisation, le support technique, le manuel utilisateur,  des modules additionnels ainsi que la base de ressource de RSForm! Pro.</b><br/><br/>

Merci d\'utiliser RSForm! Pro.
<br/><br/>
L\'�quipe de  rsjoomla.com
<br/><br/>');

//BACKEND COMPONENT_TYPE_FIELDS

DEFINE('_RSFORM_BACKEND_COMP_FIELD_NAME','Nom');
DEFINE('_RSFORM_BACKEND_COMP_FIELD_CAPTION','Caption');
DEFINE('_RSFORM_BACKEND_COMP_FIELD_REQUIRED','Obligatoire');
DEFINE('_RSFORM_BACKEND_COMP_FIELD_SIZE','Poid');
DEFINE('_RSFORM_BACKEND_COMP_FIELD_FILESIZE','Poid du fichier(KB)');
DEFINE('_RSFORM_BACKEND_COMP_FIELD_MAXSIZE','Poid Max');
DEFINE('_RSFORM_BACKEND_COMP_FIELD_VALIDATIONRULE','R�gle de Validation');
DEFINE('_RSFORM_BACKEND_COMP_FIELD_VALIDATIONMESSAGE','Validation de Message');
DEFINE('_RSFORM_BACKEND_COMP_FIELD_ADDITIONALATTRIBUTES','Attributs Aditionnels');
DEFINE('_RSFORM_BACKEND_COMP_FIELD_DEFAULTVALUE','Valeur par d�faut');
DEFINE('_RSFORM_BACKEND_COMP_FIELD_DESCRIPTION','Description');
DEFINE('_RSFORM_BACKEND_COMP_FIELD_COMPONENTTYPE','Type de Composant');
DEFINE('_RSFORM_BACKEND_COMP_FIELD_COLS','Cols');
DEFINE('_RSFORM_BACKEND_COMP_FIELD_ROWS','Champs');
DEFINE('_RSFORM_BACKEND_COMP_FIELD_MULTIPLE','Multiple');
DEFINE('_RSFORM_BACKEND_COMP_FIELD_ITEMS','Objets');
DEFINE('_RSFORM_BACKEND_COMP_FIELD_FLOW','Flow');
DEFINE('_RSFORM_BACKEND_COMP_FIELD_DATEFORMAT','Format de Date');
DEFINE('_RSFORM_BACKEND_COMP_FIELD_CALENDARLAYOUT','Calendrier');
DEFINE('_RSFORM_BACKEND_COMP_FIELD_LABEL','Label');
DEFINE('_RSFORM_BACKEND_COMP_FIELD_RESET','Effacer');
DEFINE('_RSFORM_BACKEND_COMP_FIELD_RESETLABEL','Effacer Label');
DEFINE('_RSFORM_BACKEND_COMP_FIELD_LENGTH','Length');
DEFINE('_RSFORM_BACKEND_COMP_FIELD_BACKGROUNDCOLOR','Couleur de fond');
DEFINE('_RSFORM_BACKEND_COMP_FIELD_TEXTCOLOR','Couleur du texte');
DEFINE('_RSFORM_BACKEND_COMP_FIELD_TYPE','Type');
DEFINE('_RSFORM_BACKEND_COMP_FIELD_ACCEPTEDFILES','Fichiers accept�s');
DEFINE('_RSFORM_BACKEND_COMP_FIELD_DESTINATION','Destination');
DEFINE('_RSFORM_BACKEND_COMP_FIELD_TEXT','Texte');
DEFINE('_RSFORM_BACKEND_COMP_FIELD_IMAGERESET','Effacer Image');
DEFINE('_RSFORM_BACKEND_COMP_FIELD_IMAGEBUTTON','Bouton Image');
DEFINE('_RSFORM_BACKEND_COMP_FIELD_SHOWREFRESH','Actualiser');
DEFINE('_RSFORM_BACKEND_COMP_FIELD_REFRESHTEXT','Actualiser le texte');
DEFINE('_RSFORM_BACKEND_COMP_FIELD_READONLY','Readonly');
DEFINE('_RSFORM_BACKEND_COMP_FIELD_POPUPLABEL','Popup Label');
DEFINE('_RSFORM_BACKEND_COMP_FIELD_CHARACTERS','Caract�res');
DEFINE('_RSFORM_BACKEND_COMP_FIELD_ATTACHUSEREMAIL','Attacher l\'email de l\'utilisateur');
DEFINE('_RSFORM_BACKEND_COMP_FIELD_ATTACHADMINEMAIL','Attacher l\'email de l\'admin');
DEFINE('_RSFORM_BACKEND_COMP_FIELD_WYSIWYG','Enable WYSIWYG Editor');

//BACKEND COMPONENT_FIELD_VALUES
DEFINE('_RSFORM_BACKEND_COMP_FVALUE_NO','Non');
DEFINE('_RSFORM_BACKEND_COMP_FVALUE_YES','Oui');
DEFINE('_RSFORM_BACKEND_COMP_FVALUE_INVALIDINPUT','Donn�e Invalide');
DEFINE('_RSFORM_BACKEND_COMP_FVALUE_HORIZONTAL','Horizontal');
DEFINE('_RSFORM_BACKEND_COMP_FVALUE_VERTICAL','Vertical');
DEFINE('_RSFORM_BACKEND_COMP_FVALUE_DDMMYYYY','jj.mm.aaaa');
DEFINE('_RSFORM_BACKEND_COMP_FVALUE_FLAT','Plat');
DEFINE('_RSFORM_BACKEND_COMP_FVALUE_POPUP','Popup');
DEFINE('_RSFORM_BACKEND_COMP_FVALUE_ALPHA','Alpha');
DEFINE('_RSFORM_BACKEND_COMP_FVALUE_ALPHANUMERIC','Alphanumerique');
DEFINE('_RSFORM_BACKEND_COMP_FVALUE_NUMERIC','Numerique');
DEFINE('_RSFORM_BACKEND_COMP_FVALUE_REFRESH','Actualiser');

DEFINE('_RSFORM_BACKEND_COMP_SAVE','Sauver');


//BACKEND FORMS MANAGE                                             
DEFINE('_RSFORM_BACKEND_FORMS_MANAGE_TITLE','Titre du Formulaire');
DEFINE('_RSFORM_BACKEND_FORMS_MANAGE_NAME','Nom du Formulaire');
DEFINE('_RSFORM_BACKEND_FORMS_MANAGE_PUBLISHED','Publier');
DEFINE('_RSFORM_BACKEND_FORMS_MANAGE_SUBMISSIONS','Soumettre');     
DEFINE('_RSFORM_BACKEND_FORMS_MANAGE_LINK','Ajouter au Menu');
DEFINE('_RSFORM_BACKEND_FORMS_MANAGE_PREVIEW','Pr�visualiser');
DEFINE('_RSFORM_BACKEND_FORMS_MANAGE_ID','ID du formulaire');  
                                       
DEFINE('_RSFORM_BACKEND_FORMS_MANAGE_TODAY','Aujourd\'hui : ');
DEFINE('_RSFORM_BACKEND_FORMS_MANAGE_MONTH','Ce mois-ci : ');
DEFINE('_RSFORM_BACKEND_FORMS_MANAGE_ALL','Tout : ');
DEFINE('_RSFORM_BACKEND_FORMS_MANAGE_SEARCH','Rechercher :');
DEFINE('_RSFORM_BACKEND_FORMS_MANAGE_SEARCH_LIMIT','Pagination :');

//FORMS ADD MENU
DEFINE('_RSFORM_BACKEND_FORMS_MENUADD_ADDED','Formulaire ajout� au menu');
DEFINE('_RSFORM_BACKEND_FORMS_MENUADD_MENUTITLE','Titre du Menu : ');


//BACKEND FORMS DELETE

DEFINE('_RSFORM_BACKEND_FORMS_DEL','Formulaire(s) supprim�(s).');

//BACKEND FORMS COPY
DEFINE('_RSFORM_BACKEND_FORMS_COPY','Formulaire(s) Copi�(s).');

//BACKEND FORMS PUBLISH/UNPUBLISH
DEFINE('_RSFORM_BACKEND_SUC_PUBL_FORM','Formulaire(s) Publi�(s).');
DEFINE('_RSFORM_BACKEND_SUC_UNPUBL_FORM','Formulaire(s) D�publi�(s).');

//BACKEND FORMS EDIT
DEFINE('_RSFORM_BACKEND_FORMS_EDIT_NO_FORM_NAME','aucun nom');
DEFINE('_RSFORM_BACKEND_FORMS_EDIT_NO_FORM_TITLE','aucun titre');

DEFINE('_RSFORM_BACKEND_FORMS_EDIT_TITLE_FORM_COMPONENTS','Composant');
DEFINE('_RSFORM_BACKEND_FORMS_EDIT_TITLE_FORM_LAYOUT','Formulaire Layout');
DEFINE('_RSFORM_BACKEND_FORMS_EDIT_TITLE_FORM_EDIT','Editer le formulaire');
DEFINE('_RSFORM_BACKEND_FORMS_EDIT_TITLE_USER_EMAILS','Emails de l\'utilisateur');
DEFINE('_RSFORM_BACKEND_FORMS_EDIT_TITLE_ADMIN_EMAILS','Emails Administrateur');
DEFINE('_RSFORM_BACKEND_FORMS_EDIT_TITLE_SCRIPTS','Scripts');
DEFINE('_RSFORM_BACKEND_FORMS_EDIT_TITLE_MAPPINGS','Mappings');

DEFINE('_RSFORM_BACKEND_FORMS_EDIT_TEXTBOX','Textbox');
DEFINE('_RSFORM_BACKEND_FORMS_EDIT_PASSWORD','Mot de passe');
DEFINE('_RSFORM_BACKEND_FORMS_EDIT_TEXTAREA','Textarea');
DEFINE('_RSFORM_BACKEND_FORMS_EDIT_DROPDOWN','Drop-down');
DEFINE('_RSFORM_BACKEND_FORMS_EDIT_CHECKBOX','Cases � cocher');
DEFINE('_RSFORM_BACKEND_FORMS_EDIT_RADIO','Boutons Radio');
DEFINE('_RSFORM_BACKEND_FORMS_EDIT_CALENDAR','Calendrier');
DEFINE('_RSFORM_BACKEND_FORMS_EDIT_BUTTON','Bouton');
DEFINE('_RSFORM_BACKEND_FORMS_EDIT_SUBMITBUTTON','Soumettre');
DEFINE('_RSFORM_BACKEND_FORMS_EDIT_IMAGEBUTTON','Image Bouton');
DEFINE('_RSFORM_BACKEND_FORMS_EDIT_CAPTCHA','Captcha Antispam');
DEFINE('_RSFORM_BACKEND_FORMS_EDIT_FILE','Fichier mis en ligne');
DEFINE('_RSFORM_BACKEND_FORMS_EDIT_FREETEXT','Champ texte');
DEFINE('_RSFORM_BACKEND_FORMS_EDIT_HIDDEN','Champ cach�');
DEFINE('_RSFORM_BACKEND_FORMS_EDIT_TICKET','Ticket pour le support');

DEFINE('_RSFORM_BACKEND_FORMS_EDIT_LAYOUT_INLINE_XHTML','En ligne (XHTML)');
DEFINE('_RSFORM_BACKEND_FORMS_EDIT_LAYOUT_INLINE','En ligne');
DEFINE('_RSFORM_BACKEND_FORMS_EDIT_LAYOUT_2LINES','2 Lignes');
DEFINE('_RSFORM_BACKEND_FORMS_EDIT_LAYOUT_2COLSINLINE','2 Colonnes en ligne');
DEFINE('_RSFORM_BACKEND_FORMS_EDIT_LAYOUT_2COLS2LINES','2 Colonnes sur  2 lignes');
DEFINE('_RSFORM_BACKEND_FORMS_EDIT_LAYOUT_AUTOGENERATE','Auto Generation du Layout ?');

DEFINE('_RSFORM_BACKEND_FORMS_EDIT_FORM_EDIT_HEAD','Editer les propri�t�s');
DEFINE('_RSFORM_BACKEND_FORMS_EDIT_FORM_EDIT_TITLE','Titre du formulaire');
DEFINE('_RSFORM_BACKEND_FORMS_EDIT_FORM_EDIT_NAME','Nom du formulaire');
DEFINE('_RSFORM_BACKEND_FORMS_EDIT_FORM_EDIT_LANGUAGE','Langue du formulaire ISO(pour le support multilingue). Si vous voulez utiliser diff�rentes langues, vous devez cr�er deux formulaire du m�me nom mais utilisant deux langues diff�rentes ISO.');
DEFINE('_RSFORM_BACKEND_FORMS_EDIT_FORM_EDIT_RETURN','URL de retour');
DEFINE('_RSFORM_BACKEND_FORMS_EDIT_FORM_EDIT_RETURN_DESC','Vous pouvez indiquer une URL de retour o� l\'utilisateur sera redirig� apr�s avoir soumis son formulaire. Si Merci est activ� (non vide), l\'utilisateur verra le message de remerciement avec un bouton continuer.');
DEFINE('_RSFORM_BACKEND_FORMS_EDIT_FORM_EDIT_THANKYOU','Message de remerciement');
DEFINE('_RSFORM_BACKEND_FORMS_EDIT_FORM_EDIT_THANKYOU_DESC','Le message de remerciement sera vu par l\'utilisateur apr�s avoir valid� le formulaire.');


DEFINE('_RSFORM_BACKEND_FORMS_EDIT_USER_EMAILS_HEAD','Emails de l\'utilisateur');


DEFINE('_RSFORM_BACKEND_FORMS_EDIT_USER_EMAILS_RECIPIENTS','<strong>� :</strong>');
DEFINE('_RSFORM_BACKEND_FORMS_EDIT_USER_EMAILS_FROM','<strong>De :</strong>');
DEFINE('_RSFORM_BACKEND_FORMS_EDIT_USER_EMAILS_FROMNAME','<strong>Nom :</strong>');
DEFINE('_RSFORM_BACKEND_FORMS_EDIT_USER_EMAILS_SUBJECT','<strong>Sujet : </strong>');
DEFINE('_RSFORM_BACKEND_FORMS_EDIT_USER_EMAILS_MODE','<strong>Mode(Text/HTML):</strong>');
DEFINE('_RSFORM_BACKEND_FORMS_EDIT_USER_EMAILS_TEXT','<strong>Message:</strong>');
DEFINE('_RSFORM_BACKEND_FORMS_EDIT_FORM_EDIT_USER_EMAILS_TEXT','Edit the e-mail text');
DEFINE('_RSFORM_BACKEND_FORMS_EDIT_USER_EMAILS_DESC','Note that you must fill in all the e-mail fields correctly in order to receive the e-mail. You can customize the e-mail text to match what the user filled in by copying the Quick Add text in the Email text field.');

DEFINE('_RSFORM_BACKEND_EDITFORMS_EMAIL_USER_SUBJECT_DEFAULT','Merci pour votre message');
DEFINE('_RSFORM_BACKEND_EDITFORMS_EMAIL_USER_TEXT_DEFAULT','Vous pouvez ajouter les champs du formualaire dans l\'email en ajoutant ceci : {}. Exemple:<br/>Cher {fullname:value}, merci pour votre visite.');


DEFINE('_RSFORM_BACKEND_FORMS_EDIT_ADMIN_EMAILS_HEAD','Emails utilisateur');


DEFINE('_RSFORM_BACKEND_FORMS_EDIT_ADMIN_EMAILS_RECIPIENTS','<strong>A :</strong>');
DEFINE('_RSFORM_BACKEND_FORMS_EDIT_ADMIN_EMAILS_FROM','<strong>De :</strong>');
DEFINE('_RSFORM_BACKEND_FORMS_EDIT_ADMIN_EMAILS_FROMNAME','<strong>Venant de :</strong>');
DEFINE('_RSFORM_BACKEND_FORMS_EDIT_ADMIN_EMAILS_SUBJECT','<strong>Sujet : </strong>');
DEFINE('_RSFORM_BACKEND_FORMS_EDIT_ADMIN_EMAILS_MODE','<strong>Mode(Text/HTML):</strong>');
DEFINE('_RSFORM_BACKEND_FORMS_EDIT_ADMIN_EMAILS_ATTACH','<strong>Attach file:</strong>');
DEFINE('_RSFORM_BACKEND_FORMS_EDIT_ADMIN_EMAILS_ATTACH_FILE','<strong>Location of file to attach:</strong>');
DEFINE('_RSFORM_BACKEND_FORMS_EDIT_ADMIN_EMAILS_ATTACH_FILE_WARNING','<strong style="color: red">WARNING! File does not exist. No file will be attached.</strong>');

DEFINE('_RSFORM_BACKEND_FORMS_EDIT_ADMIN_EMAILS_TEXT','<strong>Message:</strong>');
DEFINE('_RSFORM_BACKEND_FORMS_EDIT_FORM_EDIT_ADMIN_EMAILS_TEXT','Edit the e-mail text');
DEFINE('_RSFORM_BACKEND_FORMS_EDIT_ADMIN_EMAILS_DESC','Note that you must fill in all the e-mail fields correctly in order to receive the e-mail. You can customize the e-mail text to match what the user filled in by copying the Quick Add text in the Email text field.');

DEFINE('_RSFORM_BACKEND_EDITFORMS_EMAIL_ADMIN_SUBJECT_DEFAULT','Merci pour votre message');
DEFINE('_RSFORM_BACKEND_EDITFORMS_EMAIL_ADMIN_TEXT_DEFAULT','Vous pouvez ajouter les champs du formulaire dans l\'email en ajoutant ceci : {}. Exemple:<br/>Cher {fullname:value}, merci pour votre visite');

DEFINE('_RSFORM_BACKEND_FORMS_EDIT_EMAILS_MODE_TEXT','Texte');
DEFINE('_RSFORM_BACKEND_FORMS_EDIT_EMAILS_MODE_HTML','HTML');


DEFINE('_RSFORM_BACKEND_FORMS_EDIT_SCRIPTS_HEAD','Scripts');

DEFINE('_RSFORM_BACKEND_FORMS_EDIT_SCRIPTS_DISPLAY','Script called on form display');
DEFINE('_RSFORM_BACKEND_FORMS_EDIT_SCRIPTS_DISPLAY_DESC','Ajouter votre script sans <php ?>');

DEFINE('_RSFORM_BACKEND_FORMS_EDIT_SCRIPTS_PROCESS','Script called on form process');
DEFINE('_RSFORM_BACKEND_FORMS_EDIT_SCRIPTS_PROCESS_DESC','Ajouter votre script sans <php ?>');

DEFINE('_RSFORM_BACKEND_FORMS_EDIT_SCRIPTS_PROCESS2','Script called after form has been processed');
DEFINE('_RSFORM_BACKEND_FORMS_EDIT_SCRIPTS_PROCESS2_DESC','Add your script without &lt;?php ?&gt;');

DEFINE('_RSFORM_BACKEND_FORMS_EDIT_MAPPINGS_HEAD','Mappings');

DEFINE('_RSFORM_BACKEND_FORMS_EDIT_MAPPINGS_COMPONENT_NAME','Component Name:');
DEFINE('_RSFORM_BACKEND_FORMS_EDIT_MAPPINGS_TABLE_TO_MAP','Table to map:');
DEFINE('_RSFORM_BACKEND_FORMS_EDIT_MAPPINGS_COLUMN_TABLE_TO_MAP','Column from table to map:');

DEFINE('_RSFORM_BACKEND_FORMS_EDIT_MAPPINGS_DESC','<strong>Please make sure you know what you are doing. Although Mappings is a powerful tool since it helps you integrate RSform!Pro with other applications, if not configured properly, it will write data to tables and may affect the other applications(or Joomla). We cannot be held responsable for any incorrect usage of the Mapping functionality.</strong>');

DEFINE('_RSFORM_BACKEND_FORMS_EDIT_MAPPINGS_BUY_DESC','

<strong>Database Mappings plugin</strong>

<p>This function allows you to save the data from your submissions to an external table or tables, depending on your configuration. With this functionality, RSform!Pro can be used to add data into any application you have installed in your Joomla powered site.</p>

<p>After purchasing and downloading the plugin, go to <a href="index2.php?option=com_rsform&task=configuration.edit">RSform!Pro Configuration > Plugins</a> and upload the plugin file. Please take into account that this is not a joomla plugin, so it cannot be installed using the Joomla Installer. It must be installed inside the RSform!Pro application only.</p>');

DEFINE('_RSFORM_BACKEND_FORMS_EDIT_MAPPINGS_BUY','<p><a href="index2.php?option=com_rsform&task=configuration.edit">Go to your Joomla Administrator Panel > RSform!Pro > Configuration > Plugins to get the RSform!Pro Database Mappings Plugin</a></p>');
DEFINE('_RSFORM_BACKEND_FORMS_EDIT_MAPPINGS_DOWNLOAD','Get RSform!Pro Database Mappings Plugin');
DEFINE('_RSFORM_BACKEND_FORMS_EDIT_MAPPINGS_NOLICENSE','Please add your license code first.');




//FORMS MENUADD

DEFINE('_RSFORM_BACKEND_FORMS_MENUADD_ADD','Ajouter <b>%s</b> � : ');
DEFINE('_RSFORM_BACKEND_FORMS_MENUADD_BTN','Sauver');

    //COMPONENT PREVIEW
DEFINE('_RSFORM_BACKEND_FORMS_EDIT_COMPREVIEW_NAME','Nom');
DEFINE('_RSFORM_BACKEND_FORMS_EDIT_COMPREVIEW_CAPTION','Caption');
DEFINE('_RSFORM_BACKEND_FORMS_EDIT_COMPREVIEW_PREVIEW','Pr�visualisation du composant');
DEFINE('_RSFORM_BACKEND_FORMS_EDIT_COMPREVIEW_EDIT','Editer');
DEFINE('_RSFORM_BACKEND_FORMS_EDIT_COMPREVIEW_REMOVE','Supprimer');
DEFINE('_RSFORM_BACKEND_FORMS_EDIT_COMPREVIEW_ORDERING','Organiser');
DEFINE('_RSFORM_BACKEND_FORMS_EDIT_COMPREVIEW_PUBLISHED','Publier');
DEFINE('_RSFORM_BACKEND_FORMS_EDIT_COMPREVIEW_SAVE_ORDER','Enregistrer l\'ordre');

	//COMPONENT LAYOUT
DEFINE('_RSFORM_BACKEND_FORMS_EDIT_COMP_QUICKADD','Ajout rapide');	
DEFINE('_RSFORM_BACKEND_FORMS_EDIT_COMP_QUICKADD_DESC','Selection > glisser > d�poser');	
DEFINE('_RSFORM_BACKEND_FORMS_EDIT_COMP_QUICKADD_BTN','Ajouter');	
DEFINE('_RSFORM_BACKEND_FORMS_EDIT_COMP_CAPTION','caption');	
DEFINE('_RSFORM_BACKEND_FORMS_EDIT_COMP_BODY','body');	
DEFINE('_RSFORM_BACKEND_FORMS_EDIT_COMP_VALIDATION','validation');	
DEFINE('_RSFORM_BACKEND_FORMS_EDIT_COMP_DESCRIPTION','description');	
DEFINE('_RSFORM_BACKEND_FORMS_EDIT_COMP_VALUE','value');	

//FORMS SAVE

DEFINE('_RSFORM_BACKEND_FORMS_SAVE','Formulaire enregistr�');
DEFINE('_RSFORM_BACKEND_FORMS_SAVE_ERROR_NAME','Le formulaire doit avoir un nom');

//COMPONENTS COPY SCREEN
DEFINE('_RSFORM_BACKEND_COMPONENTS_COPY','O� voulez vous copier le formulaire ?');
DEFINE('_RSFORM_BACKEND_COMPONENTS_COPY_OK','Les composants ont �t� copi�s');
DEFINE('_RSFORM_BACKEND_COMPONENTS_COPY_BTN','Copie des composants');


//COMPONENTS VALIDATE NAME
DEFINE('_RSFORM_BACKEND_COMPONENTS_VALIDATE_ERROR_UNIQUE_NAME','Sp�cifier un nom unique au formulaire');
DEFINE('_RSFORM_BACKEND_COMPONENTS_VALIDATE_ERROR_DESTINATION','La destination ne peut-�tre vide');
DEFINE('_RSFORM_BACKEND_COMPONENTS_VALIDATE_ERROR_DESTINATION_NOT_DIR','La destination que vous avez choisi n\'est pas un r�pertoire');
DEFINE('_RSFORM_BACKEND_COMPONENTS_VALIDATE_ERROR_DESTINATION_NOT_WRITABLE','La destination que vous avez choisi est prot�g�e en �criture');

//SUBMISSIONS MANAGE
DEFINE('_RSFORM_BACKEND_SUBMISSIONS_MANAGE_FORM_SELECT','Voir les enregistrements pour : ');
DEFINE('_RSFORM_BACKEND_SUBMISSIONS_MANAGE_VIEW','Voir ');
DEFINE('_RSFORM_BACKEND_SUBMISSIONS_MANAGE_FILTER','Filtrer ');
DEFINE('_RSFORM_BACKEND_SUBMISSIONS_MANAGE_FILTER_BTN','Filtrer');
DEFINE('_RSFORM_BACKEND_SUBMISSIONS_MANAGE_CLR_FILTER_BTN','Effacer les filtres');

DEFINE('_RSFORM_BACKEND_SUBMISSIONS_MANAGE_TABLE_ACTIONS','Actions');

//SUBMISSIONS EXPORT
DEFINE('_RSFORM_BACKEND_SUBMISSIONS_EXPORT_HEAD_EXPORT','Exporter');
DEFINE('_RSFORM_BACKEND_SUBMISSIONS_EXPORT_HEAD_SUBMISSION_DATA','Soumettre des infos suppl�mentaires');
DEFINE('_RSFORM_BACKEND_SUBMISSIONS_EXPORT_HEAD_COLUMN_ORDER','Ordre des colonnes');
DEFINE('_RSFORM_BACKEND_SUBMISSIONS_EXPORT_HEAD_COMPONENTS','Composants');

DEFINE('_RSFORM_BACKEND_SUBMISSIONS_EXPORT_DATE_SUBMITTED','Date de soumission');
DEFINE('_RSFORM_BACKEND_SUBMISSIONS_EXPORT_USER_IP','Ip de l\'utilisateur');
DEFINE('_RSFORM_BACKEND_SUBMISSIONS_EXPORT_USERNAME','Nom d\'utilisateur');

DEFINE('_RSFORM_BACKEND_SUBMISSIONS_EXPORT_FOR','Exporter les enregistrements pour "%s"');
DEFINE('_RSFORM_BACKEND_SUBMISSIONS_EXPORT_ALL_ROWS','Exporter tous les champs');
DEFINE('_RSFORM_BACKEND_SUBMISSIONS_EXPORT_SELECTED_ROWS','Exporter les champs s�l�ctionn�s');

DEFINE('_RSFORM_BACKEND_SUBMISSIONS_EXPORT_DELIMITER','Delimiter:');
DEFINE('_RSFORM_BACKEND_SUBMISSIONS_EXPORT_FIELD_ENCLOSURE','Champ Enclosure :');
DEFINE('_RSFORM_BACKEND_SUBMISSIONS_EXPORT_HEADERS','Inclure les ent�tes des colonnes :');

DEFINE('_RSFORM_BACKEND_SUBMISSIONS_EXPORT_BTN','Exporter');


//BACKEND SAVEREG
DEFINE('_RSFORM_BACKEND_SAVEREG_CODE','Merci d\'entrer votre num�ro de s�rie.');
DEFINE('_RSFORM_BACKEND_SAVEREG_SAVED','Enregistrement sauvegard�.');


//CONFIGURATION
DEFINE('_RSFORM_BACKEND_CONFIGURATION_SAVED','Configuration Sauvegard�e');

//SETTINGS

DEFINE('_RSFORM_BACKEND_SETTINGS_TABS_CONFIG','Param�tres');
DEFINE('_RSFORM_BACKEND_SETTINGS_TABS_PLUGINS','Plugins');

DEFINE('_RSFORM_BACKEND_SETTINGS_GLOBAL_HEAD','Param�tres g�n�raux');
DEFINE('_RSFORM_BACKEND_SETTINGS_IMAGES_HEAD','Param�tres des images');
DEFINE('_RSFORM_BACKEND_SETTINGS_PATHS_HEAD','Param�tres des dossiers');

DEFINE('_RSFORM_BACKEND_SETTINGS','Param�tres');
DEFINE('_RSFORM_BACKEND_SETTINGS_REGISTER','Code de license');
DEFINE('_RSFORM_BACKEND_SETTINGS_REGISTER_DESC','Votre code d\'enregistrement.');
DEFINE('_RSFORM_BACKEND_SETTINGS_SAVED','Param�tres sauvegard�s');

DEFINE('_RSFORM_BACKEND_SETTINGS_DEBUG','Debug Mode');
DEFINE('_RSFORM_BACKEND_SETTINGS_DEBUG_DESC','Enable the debug mode.');

DEFINE('_RSFORM_BACKEND_SETTINGS_UPLOADDIR_WRITABLE','<font color="green"><b>Non prot�g� en �criture</b></font>');
DEFINE('_RSFORM_BACKEND_SETTINGS_UPLOADDIR_NOTWRITABLE','<font color="red"><b>Prot�g� en �criture</b></font>');
DEFINE('_RSFORM_BACKEND_SETTINGS_LANGUAGE','Backend Default Language');
DEFINE('_RSFORM_BACKEND_SETTINGS_LANGUAGE_DESC','');

DEFINE('_RSFORM_BACKEND_SETTINGS_SAVED','Settings Saved');


DEFINE('_RSFORM_BACKEND_PLUGINS_HEAD','Plugins');

DEFINE('_RSFORM_BACKEND_PLUGINS_UPLOAD_TITLE','Upload Plugins');
DEFINE('_RSFORM_BACKEND_PLUGINS_UPLOAD_FILE','Package File:');
DEFINE('_RSFORM_BACKEND_PLUGINS_BUTTON','Upload');
DEFINE('_RSFORM_BACKEND_PLUGINS_UPLOAD_INSTRUCTIONS','<h2>Plugins Instructions</h2>
<ul>
	<li>RSform!Pro Plugins expand the component functionalities. You can find a list of plugins here: <a href="http://www.rsjoomla.com/index.php/RSformPro/RSformPro-Professional-Joomla-Form-Management-Component.html" target="_blank">http://www.rsjoomla.com/index.php/RSformPro/RSformPro-Professional-Joomla-Form-Management-Component.html</a>.</li>
	<li>Click on Browse and choose a plugin file then click on the "Upload" button.</li>
</ul>
');

DEFINE('_RSFORM_BACKEND_PLUGINS_TITLE','Remove Plugins');

DEFINE('_RSFORM_BACKEND_PLUGINS_REMOVE_OK','Plugin removed');
DEFINE('_RSFORM_BACKEND_PLUGINS_REMOVE_ERROR','Plugin could not be removed. Please check permissions.');
DEFINE('_RSFORM_BACKEND_PLUGINS_REMOVE_CONFIRM','Are you sure?');


//BACKEND BACKUP/RESTORE
DEFINE('_RSFORM_BACKEND_BACKUPRESTORE_TITLE_HEAD','Restaurer');
DEFINE('_RSFORM_BACKEND_BACKUPRESTORE_BACKUP','Cliquer ici pour g�n�rer le fichier de sauvegarde.');
DEFINE('_RSFORM_BACKEND_BACKUPRESTORE_PACKAGE_FILE','Fichier :');
DEFINE('_RSFORM_BACKEND_BACKUPRESTORE_RESTORE_BTN','Restaurer');
DEFINE('_RSFORM_BACKEND_BACKUPRESTORE_INSTRUCTIONS','<h2>Sauvegarde / Instructions de restauration</h2>
<ul>
	<li>Quand vous le voudrez, t�l�charger le fichier de sauvegarde en cliquant sur "Cliquez ici pour g�n�rer le fichier de sauvegarde". La sauvegarde enregistrera tous les fichiers mis en ligne ainsi que la base de donn�es.</li>
	<li>Cliquer pour parcourir et choisir votre sauvegarde, puis cliquez sur "Restaurer".</li>
</ul>
');
DEFINE('_RSFORM_BACKEND_BACKUPRESTORE_NOTWRITABLE','<font color="red">/media est prot�g� en �criture</font><br/>Merci de changer les permissions pour pouvoir mettre en ligne un document.');
DEFINE('_RSFORM_BACKEND_BACKUPRESTORE_INCLUDE_SUBMISSIONS','Include Submissions?');
DEFINE('_RSFORM_BACKEND_BACKUPRESTORE_OVERWRITE','Overwrite existing forms? <b><font color="red">Caution</font>, you will not be able to recover old forms after restoring if you check this box.</b>');
DEFINE('_RSFORM_BACKEND_BACKUPRESTORE_FORMS','Backup Only Forms');
DEFINE('_RSFORM_BACKEND_BACKUPRESTORE_FORMS_SUBMISSIONS','Backup Forms And Submissions ?');
DEFINE('_RSFORM_BACKEND_BACKUPRESTORE_FORMS_SELECT','Please select at least one form to backup');


//MIGRATION TOOL

DEFINE('_RSFORM_BACKEND_MIGRATION_TITLE_HEAD','Migration Tool');
DEFINE('_RSFORM_BACKEND_MIGRATION_BTN','Migrate %s form(s) from RSform!');
DEFINE('_RSFORM_BACKEND_MIGRATION_INSTRUCTIONS','<h2>Migration from RSform! to RSform!Pro Instructions</h2>
<ul>
	<li>In order to import the forms generated in RSform! you must have both components installed.</li>
	<li>The migration tool won\'t replace the forms that you already developed in RSform!Pro</li>
</ul>
');
DEFINE('_RSFORM_BACKEND_MIGRATION_MSG',' Forms migrated to RSform!Pro');

DEFINE('_RSFORM_BACKEND_MIGRATION_TITLE_NOFORM_HEAD','RSform! and RSform!Pro must be installed in order to migrate forms.');

//UPDATES

DEFINE('_RSFORM_BACKEND_UPDATESMANAGE_INSTRUCTIONS','<h2>Updates Instructions</h2>
<ul>
	<li>Quand nous mettons en ligne une mise � jour, vous pouvez la t�l�charger directement � partir de cet �cran. Enregistrez la mise � jour sur votre ordinateur et � partir d\'ici, t�l�chagez la et installez la.</li>
</ul>');
DEFINE('_RSFORM_BACKEND_UPDATESMANAGE_BUTTON','Mise � jour');
DEFINE('_RSFORM_BACKEND_UPDATECHECK_OK','Succ�s');
DEFINE('_RSFORM_BACKEND_UPDATECHECK_NOINSTALL','S�lectionnez un fichier valide.');
DEFINE('_RSFORM_BACKEND_UPDATECHECK_BADFILE','Le fichier s�l�ctionn� n\'est pas valide.');
DEFINE('_RSFORM_BACKEND_UPDATECHECK_STATUS_RSFORMBACKUP','Sauvegarde charg�e.');
DEFINE('_RSFORM_BACKEND_UPDATECHECK_STATUS_RSFORMUPDATE','Le composant est mis � jour.');
DEFINE('_RSFORM_BACKEND_UPDATECHECK_STATUS_RSFORMPLUGIN','Plugin mis � jour.');

DEFINE('_RSFORM_BACKEND_UPDATESMANAGE_UPDATE_TITLE','Mettre en ligne le package');
DEFINE('_RSFORM_BACKEND_UPDATESMANAGE_UPDATE_FILE','Fichier de Package :');
DEFINE('_RSFORM_BACKEND_UPDATESMANAGE_WRITABLE','(<font color="green"><b>PERMISSIONS EN ECRITURE</b></font>)');
DEFINE('_RSFORM_BACKEND_UPDATESMANAGE_NOTWRITABLE','(<font color="red"><b>PROTEGE EN ECRITURE</b></font>)');
DEFINE('_RSFORM_BACKEND_UPDATESMANAGE_PERMISSIONS','Merci de changer les permissions sur le r�pertoire afin de le lib�rer en �criture. Pour cela utiliser votre client FTP et modifier les permissions chmod en 777.');



//CONTROL PANEL
DEFINE('_RSFORM_BACKEND_CPANEL_FORMS_MANAGE','Formulaire Manager');    
DEFINE('_RSFORM_BACKEND_CPANEL_SUBMISSIONS_MANAGE','Manager les enregistrements');
DEFINE('_RSFORM_BACKEND_CPANEL_CONFIGURATION_EDIT','Configuration');
DEFINE('_RSFORM_BACKEND_CPANEL_BACKUP_RESTORE','Sauvegarder - Restaurer');
DEFINE('_RSFORM_BACKEND_CPANEL_UPDATES_MANAGE','Chercher des mises � jour');
DEFINE('_RSFORM_BACKEND_CPANEL_SUPPORT','Support');     

DEFINE('_RSFORM_VERSION_TITLE','Version install�e :');
DEFINE('_RSFORM_AUTHOR_TITLE','Auteur :');
DEFINE('_RSFORM_CODE_TITLE','Votre code');
DEFINE('_RSFORM_REGISTER','Mise � jour de votre enregistrement');
DEFINE('_RSFORM_REGISTER_MODIFY','Modifier l\'enregistrement');


DEFINE('_RSFORM_FRONTEND_THANKYOU','Le formulaire a �t� soumis avec succ�s. Merci !');
DEFINE('_RSFORM_FRONTEND_THANKYOU_BUTTON','<br/><input type="button" name="continue" value="Continuer" onclick="%s"/>');


DEFINE('_RSFORM_MOD_RSFORM_LIST_DATETIME','d.m.Y');
DEFINE('_RSFORM_FRONTEND_CALENDARJS', '
//CALENDAR SETUP
var MONTHS_SHORT 	= Array("Jan", "Fev", "Mar", "Avr", "Mai", "Jui", "Jul", "Aou", "Sep", "Oct", "Nov", "Dec");
var MONTHS_LONG 	= Array("Janvier", "F�vrier", "Mars", "Avril", "Mai", "Juin", "Juillet", "Ao�t", "Septembre", "Octobre", "Novembre", "Decembre");
var WEEKDAYS_1CHAR 	= Array("D", "L", "M", "M", "J", "V", "S");
var WEEKDAYS_SHORT 	= Array("Di", "Lu", "Ma", "Me", "Je", "Ve", "Sa");
var WEEKDAYS_MEDIUM = Array("Dim", "Lun", "Mar", "Mer", "Jeu", "Ven", "Sam");
var WEEKDAYS_LONG 	= Array("Dimanche", "Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi");
var START_WEEKDAY 	= 1;
');

?>