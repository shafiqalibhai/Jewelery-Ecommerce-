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

DEFINE("_DM_TITLE","Raccomanda il nostro sito ai tuoi amici!");

/////////////////////// For Logged in Users Only
DEFINE("_DM_USER_INSTRUCTIONS","
<br />
Il tuo nome e il tuo indirizzo email, visualizzati sotto, appariranno nelle mail inviate ai tuoi amici. <br /><b>Nota : Non puoi modificare questi campi!!</b>
<br /><br />
&nbsp;&nbsp;- Devi inserire almeno <b>1</b> indirizzo mail!<br />");

/////////////////////// For Public Users - Anyone can send an invite/recommendation
DEFINE("_DM_USER_INSTRUCTIONS_1","
<br />Il nome e gli indirizzi email che inserisci in questi campi apparariranno nelle mail inviate ai tuoi amici<br /><br />
&nbsp;&nbsp;- Devi inserire il <b>tuo</b> indirizzo email
<br />
&nbsp;&nbsp;- Devi inserire almeno <b>1</b> degli indirizzi email dei tuoi amici
<br />");

/////////////////////// Captch Instructions - If Option Selected in Admin
DEFINE("_DM_USER_INSTRUCTIONS_CAPTCHA","
&nbsp;&nbsp;- Devi inserire il codice corretto visualizzato nell'immagine.
<br />");

/////////////////////// Thank You Note
DEFINE("_DM_USER_INSTRUCTIONS_THANKS","
<br />
Per invitare i tuoi amici tutti i campi marcati con <font color='red'><b>**</b></font> devono essere compilati correttamente.
<br /><br />
Grazie per aver invitato i tuoi amici!!
<br />");

/////////////////////// Frontend Email Form Display
DEFINE("_DM_YOUR_NAME","Il tuo nome:");
DEFINE("_DM_YOUR_EMAIL","La tua mail:");
DEFINE("_DM_FRIEND1_NAME","Nomi amici (facoltativo):");
DEFINE("_DM_FRIEND1_EMAIL","Indirizzi email amici:");
DEFINE("_DM_MESSAGE","Messaggio personale (facoltativo):");
DEFINE("_DM_MESSAGE_HTML","L'administrateur du site a permis code HTML de votre message personnel. Si vous utilisez le code HTML, s’il vous plaît assurer que vous utilisez complètement corriger la syntaxe HTML - y compris en ligne des styles et des &lt;p&gt;texte&lt;/p&gt; ou &lt;br /&gt; pour tous les sauts de ligne, sinon les e-mails n'apparaissent pas correctement ou mai être rejeté par les bénéficiaires!");
DEFINE("_DM_SEND"," Invia raccomandazione! ");
DEFINE("_DM_CC_USER","Seleziona se vuoi avere una copia nascosta (Bcc) della mail");

/////////////////////// Javascript/Captcha Form Validation Alert Errors
DEFINE("_DM_ALERT_FROM_EMAIL_EMPTY","Devi inserire il tuo indirizzo email...");
DEFINE("_DM_ALERT_TO_EMAIL_EMPTY","Devi inserire almeno un indirizzo email per l'invio...");
DEFINE("_DM_ALERT_FROM_EMAIL_INVALID","Perfavore controlla che l'indirizzo sia corretto (es. amico@home.com)...");
DEFINE("_DM_ALERT_TO_EMAIL_INVALID","Perfavore controlla che tutte le mail dei tuoi amici siano corrette (es. friend@home.com)...");
DEFINE("_DM_ALERT_MULTIPLE_EMAIL"," *** Puoi inserire solo UN indirizzo email per ogni capmpo *** ");
DEFINE("_DM_CAPTCHA_INFO1","Controllo Anti-Spam - Inserisci il codice di sicurezza visualizzato:");
DEFINE("_DM_CAPTCHA_INFO2","Ricarica");
DEFINE("_DM_CAPTCHA_INFO3","Fare clic su 'Ricarica' se non puoi leggere la Sicurezza Immagine");
DEFINE("_DM_CAPTCHA_INFO4","Codice di Sicurezza:");
DEFINE("_DM_CAPTCHA_ALERT","*** Hai inserito un codice invalido... Riprova ***");
DEFINE("_DM_CAP_REFRESH_ALERT","Facendo clic su OK cancellerà tutte le informazioni in forma! Continue anyway?");

/////////////////////// Email Success/Fail Messages
DEFINE("_DM_SUCCESS"," email inviate con successo!");
DEFINE("_DM_SUCCESS_LIST","Lista delle mail inviate:");
DEFINE("_DM_THANK_YOU","Grazie per averci segnalato!");
DEFINE("_DM_FAIL"," Le mail NON possono essere inviate in questo momento. Perfavore riprova più tardi.");
DEFINE("_DM_FAIL_LIST","Lista delle mail che NON sono state inviate:");
DEFINE("_DM_COPY_USER","Grazie per la segnalazione ");
DEFINE("_DM_COPY_USER1","Lista di nomi e mail che hai inviato:");
DEFINE("_DM_COPY_USER2","Copia della mail che i tuoi amici riceveranno:");
DEFINE("_DM_YOUR_COPY1","La copia Email (Bcc): ");
DEFINE("_DM_RECOMMEND_USER1","Informazioni utente che ha segnalato: ");
DEFINE("_DM_RECOMMEND_USER2","Informazioni utente e mail: ");
DEFINE("_DM_BACK","Torna");

/////////////////////// E-mail Sent to Friends Variables
DEFINE("_DM_HELLO","Ciao ");  //introduction in the body of the email if friends name is provided
DEFINE("_DM_HELLO_2", "Ciao!"); //introduction in the body of the email if friends name not provided
DEFINE("_DM_FRIEND","Un tuo amico, "); //used in the SUBJECT of the email (if not defined by admin) followed by username and email
DEFINE("_DM_FRIEND_2","Un  amico, ");  //starting line in the body of the email followed by username and email
DEFINE("_DM_INVITES_YOU"," ti invita su ");  //follows _DM_FRIEND
DEFINE("_DM_INVITES_YOU_2","crede che questo sito possa essere di tuo gradimento - ");  //  follows _DM_FRIEND_2
DEFINE("_DM_GO_TO","Visita il sito :");  //middle of email body where your site link actualy appears
DEFINE("_DM_TELLS_YOU","messaggio personale per te:");  //message if user filled in message field
DEFINE("_DM_FRIEND_TELLS_YOU","Del tuo amico messaggio personale a voi:");  //message if user filled in message field
DEFINE("_DM_ADMIN_NEWS","Gran News!");
DEFINE("_DM_ADMIN_COPY"," Un utente ha appena raccomandato il sito ai suoi amici!");
DEFINE("_DM_ADMIN_COPY1","Ecco la lista delle persone a cui &egrave;:$
 stata inviata la mail:");
DEFINE("_DM_ADMIN_COPY2","Ecco una copia della mail inviata:");


/***********************************************************************************************/
/*************************************** Admin Back End ****************************************/
/***********************************************************************************************/

/////////////////////// Administration - Main Email Configuration
DEFINE("_DM_MAIN_CONFIG","Main Email Configuration Settings:");
DEFINE("_DM_NUMREC","Numero di campi amici:");
DEFINE("_DM_NUMREC_INFO","Inserisci il numero di campi email-amici da visualizzare nel front end.");
DEFINE("_DM_FROM_REPLY","Email da Utente:");
DEFINE("_DM_FROM_REPLY_CHECK","Spunta questo box se vuoi che i campi 'Da:' <u>e</u> 'Rispondi a:', utilizzati da RecommendFriends, siano quelli dell'utente. Se non spuntato il campo 'Da' sar&agrave; quello dell'Amministratore e, il campo 'Rispondi a:' sar&agrave; l'indirizzo mail degli utenti.");
DEFINE("_DM_BCC_ADMIN","Copia (Bcc) Admin:");
DEFINE("_DM_BCC_ADMIN_CHECK","Spunta questo  box se tu (Administrator) vuoi riceverere una copia(Bcc) di tutte le mail inviate dal componente RecommendFriends.  Riceverai una sola mail per ogni raccomandazione inviata compresa una lista delle mail inviate, chi le ha inviate, e una copia del testo della mail.  Attenzione: Se il tuo sito ha molti utenti ed &egrave; particolarmente attivo potresti ricevere molte mail..");
DEFINE("_DM_CUST_SUBJECT","Usa Soggetto: personalizzato");
DEFINE("_DM_CUST_SUBJECT_CHECK"," Spunta questo box se vuoi usare un Soggetto personalizzato");
DEFINE("_DM_CUST_EMAIL_SUBJECT","Soggetto Personalizzato:");
DEFINE("_DM_CUST_EMAIL_SUBJECT_INFO","Se vuoi ricevere un messaggio personalizzato per il campo 'Soggetto' nella mail, usa questo box. Se spunti questo box, ma lasci il campo Soggetto Personalizzato vuoto, verr&agrave; utilizzato il testo Soggetto standard.(Your Friend <b><i>Users username</i></b> wants you to check out <b><i>Nome del tuo sito</i></b>). **<b><u>NOTA</u></b>**Non puoi utilizzare codice HTML o PHP in questo campo- solo plain text!");
DEFINE("_DM_CUST_MESSAGE","Usa Messaggio Personalizzato:");
DEFINE("_DM_CUST_MESSAGE_CHECK"," Spunta questo box se vuoi utilizzare il Messaggio personalizzato qui sotto.");
DEFINE("_DM_CUST_MESSAGE_HTML","Uso di codice HTML:");
DEFINE("_DM_CUST_MESSAGE_HTML_INFO"," Selezionare questa casella per consentire di codice HTML in Custom Introduzione Messaggio (deve consentire di 'Usa messaggio personalizzato' casella di controllo di cui sopra). Selezionando la casella di controllo invierà tutte le email come Content-Type: text / html formato MIME!");
DEFINE("_DM_CUST_INTRO_MESSAGE","Custom Intro Message:");
DEFINE("_DM_CUST_INTRO_MESSAGE_INFO","Impostare una introduzione personalizzate per tutti i RecommendFriends e-mail che vengono inviati. Verrà visualizzato sopra il messaggio personalizzato Utente (opzionale) che l'utente può digitare prima di inviare le email. Se si seleziona la casella di controllo, ma il messaggio personalizzato campo è vuoto, NO messaggio personalizzato verrà utilizzato");
DEFINE("_DM_CUST_INTRO_MESSAGE_INFO_2","**<b><u>NOTA</u></b>** È possibile utilizzare qualsiasi codice HTML nel messaggio personalizzato. Il testo sopra di tutti i nastri in bianco / righe vuote e spazi bianchi, così si avrà bisogno di includere <b>COMPLETA </b> per la formattazione HTML code utilizzando in linea stili - tra cui corretta di riga come ad esempio &lt;p&gt;texte&lt;/p&gt; ou &lt;br /&gt; o per la spaziatura, per tutti gli stili di proprietà font, colori, ecc Potete anche inserire immagini in email - solo assicurarsi di utilizzare il percorso completo per l'immagine - vale a dire &lt;img src = 'http://www.yoursite.com/images/emailpicture.jpg'&gt;. Si dovrebbe <b>non</b> includere ogni apertura o la chiusura di &lt;html&gt;, &lt;head&gt; or &lt;body&gt; o tag. Anche notare che non è possibile utilizzare qualsiasi Javascript o PHP codici in questo campo!");
DEFINE("_DM_CUST_INTRO_MESSAGE_INFO_3","**<b><u>NOTA</u></b>** Si può utilizzare solo testo nel messaggio sopra - non HTML, Javascript o codice PHP ammessi (è possibile utilizzare codice HTML solo se si verifica la 'Usa codice HTML' casella di controllo di cui sopra )");

/////////////////////// Administration - Front End Form Display Formatting Configuration
DEFINE("_DM_MAIN_FORMAT","Impostazioni front-end form:");
DEFINE("_DM_CONFIG_SAVED","Impostazioni di configurazione sono stati salvati!");

/////////////////////// Form Fields Sizes
DEFINE("_DM_FORM_SIZE_INFO","<b>Campo Ampiezze</b> - impostare la larghezza del Nome e-mail in ingresso campi visualizzati sul front-end");
DEFINE("_DM_FORM_NAME","Il tuo(utente) e Amici <b>Nome</b> campo di immissione Larghezza: ");
DEFINE("_DM_FORM_EMAIL","Il tuo(utente) e Amici <b>Email</b> campo di immissione Larghezza: ");
DEFINE("_DM_FORM_MESSAGE_SIZE","Messaggio di input dimensioni");
DEFINE("_DM_FORM_ROWS","Messaggio textarea utente #Righe: ");
DEFINE("_DM_FORM_COLS","Messaggio textarea utente #Colonne: ");
DEFINE("_DM_FORM_DEFAULT","Predefinito");

/////////////////////// Form Fields
DEFINE("_DM_MAIN_FORM","<b>Configurazione di tutti i campi della form di front-end</b> - configura colore del testo e dello sfondo dei campi (cancella il numero della colonna o seleziona 'NO COLOR' se vuoi utilizzare lo stile CSS del tuo template - ricorda anche che l'Admin CSS potrebbe essere differente dal CSS del Front End CSS):");
DEFINE("_DM_MAIN_FORMBG","Colore Sfondo:");
DEFINE("_DM_MAIN_FORMTX","Colore del testo:");
DEFINE("_DM_PREVIEW","Anteprima formattazione (Clicca 'Salva' per aggiornare i cambiamenti)");
DEFINE("_DM_PREVIEW_TEXT","TestoEsempio@Tuosito.com - 1234567890");

/////////////////////// Validation Errors
DEFINE("_DM_MAIN_ERROR_INFO","<b>Apparenza della Form di Errore</b> - configura colore del testo e dello sfondo dei campi che hanno errori di validazione - questo non &egrave; controllato da un CSS di default (configura colore del testo e dello sfondo dei campi, cancella il numero relativo al colore o seleziona 'NO COLOR' se non vuoi che appaiono colori diversi):");
DEFINE("_DM_ERROR_TEST","Testo");
DEFINE("_DM_ERROR_RESET","Reset");
DEFINE("_DM_ALERT_TEST","I colori del Testo e dello Sfondo dovrebbero essere cambiati...");

/////////////////////// Logged In Users
DEFINE("_DM_LOGGED_INFO","<b>Apparenza dei campi User Name e Email</b> - configura come i campi User Name e Email Address appariranno per gli utenti loggati (cancella il numero del colore o seleziona 'NO COLOR' se vuoi usare lo stile CSS del tuo template - ricorda anche che l'Admin CSS potrebbe essere differente dal CSS del Front End CSS):");
DEFINE("_DM_LOGGED_USER"," Nome utente");
DEFINE("_DM_LOGGED_EMAIL","NomeUtente@TuoSito.com");

/////////////////////// Captcha Configuration
DEFINE("_DM_CAP_TITLE","Configurazione immagine Captcha");
DEFINE("_DM_GDFT_HALF","GD Supporto e attivata FreeType Support, ma non sembra essere attivato sul server!!");
DEFINE("_DM_GDFT_NO","Supporto GD e FreeType Support entrambi non sembrano essere attivato sul server!!");
DEFINE("_DM_GREAT_NEWS","GRANDI NOVITA '!!!");
DEFINE("_DM_GDFT_YES","Supporto GD e FreeType Support sono sia attivato sul server! Captcha la scelta del componente dovrebbe funzionare bene!");
DEFINE("_DM_GD_WARNING","<<<<<<<<<<<<&nbsp;&nbsp;&nbsp;AVVERTENZA&nbsp;&nbsp;&nbsp;>>>>>>>>>>>>");
DEFINE("_DM_GD_OPTIONS","Purtroppo non apparire come la possibilità di Captcha la componente di lavoro su questo server. ** NOTA ** E ancora possibile utilizzare il componente RecommendFriends, ma non e possibile utilizzare l'opzione Captcha qui sotto (che deve essere 'spunta'). Si potrebbe chiedere al proprio fornitore di servizi di hosting sito web per consentire GD e FreeType Support se hai bisogno di avere Captcha...");
DEFINE("_DM_CAP_USE","Usa controllo Captcha:");
DEFINE("_DM_CAP_USE_INFO","Spunta questo box se vuoi abilitare l'immagine Captcha");
DEFINE("_DM_CAP_1","Impostazioni Principali Immagine");
DEFINE("_DM_CAP_2","Larghezza immagine (pixels)");
DEFINE("_DM_CAP_3","Altezza immagine (pixels)");
DEFINE("_DM_CAP_4","Rotazione casuale Immagine (+/-10 gradi)");
DEFINE("_DM_CAP_ROTATE","Seleziona se vuoi l'immagine ruotata");
DEFINE("_DM_CAP_6","No");
DEFINE("_DM_CAP_7","Impostazioni Colori Immagine");
DEFINE("_DM_CAP_COLOR_BUTTON","Seleziona");
DEFINE("_DM_CAP_COLOR_NEW","Nuovo: ");
DEFINE("_DM_CAP_COLOR_ASIS","Set: ");
DEFINE("_DM_CAP_8","Colore Sfondo");
DEFINE("_DM_CAP_9","Colore Testo");
DEFINE("_DM_CAP_10","Colore di disturbo");
DEFINE("_DM_CAP_11","Impostazioni Font");
DEFINE("_DM_CAP_12","Seleziona il Font da Visualizzare");
DEFINE("_DM_CAP_13","MonoFont.ttf");
DEFINE("_DM_CAP_14","ComicBook.ttf");
DEFINE("_DM_CAP_15","OldCentury.ttf");
DEFINE("_DM_CAP_16","Numero di caratteri da Visualizzare");
DEFINE("_DM_CAP_SAMPLE","Esempio Immagine Captcha Image con le Impostazioni Selezionate<br />(Clicca 'Salva' per aggiornare l'immagine o 'Ricarica' per ottenere un nuovo codice di sicurezza)");

/////////////////////// User Custom Message Options
DEFINE("_DM_USER_MESSAGE","Utente consentire messaggio:");
DEFINE("_DM_USER_MESSAGE_CHECK"," Seleziona questa casella per consentire all'utente di inserire un messaggio personalizzato.");
DEFINE("_DM_USER_MESSAGE_HTML","Utente codice HTML:");
DEFINE("_DM_USER_MESSAGE_HTML_INFO"," Seleziona questa casella per consentire all'utente di inserire codice HTML nel loro messaggio personalizzato (deve consentire di 'Consenti Utente Messaggio' casella di controllo di cui sopra). Selezionando la casella di controllo invierà tutte le email come Content-Type: text / html formato MIME! ** <b> <u> NOTA </ u> </ b> ** Questo potrebbe potenzialmente causare problemi su alcuni siti / server e non validi codice HTML potrebbe rompere il email! Semplicemente disattivare la 'utente di codice HTML' opzione se ci sono problemi.");

/////////////////////// Administration - Edit Langauge File
DEFINE("_DM_EDIT_LANG_HEADER","Impostazione file lingua");
DEFINE("_DM_EDIT_LANG","Clicca Qui per Modificare il file Lingua");
DEFINE("_DM_EDIT_LANG_INFO","Puoi cambiare OGNI parola del testo in questo componente, sia il front-end che la parte di amministrazione, editando il file lingua incluso. Provalo! Clicca il link qui sotto...");
DEFINE("_DM_LANG_EMPTY","Non &egrave; possibile completare l'operazione, il file lingua &egrave; vuoto!");
DEFINE("_DM_LANG_IS_NOT_WRITEABLE","Non &egrave; possibile completare l'operazione, il file lingua &egrave; non &egrave; scrivibile!");
DEFINE("_DM_LANG_SAVED","File lingua salvato!");
DEFINE('_DM_LANG_FILE','Il File Lingua &egrave;: ');
DEFINE("_DM_LANG_IS","&egrave;");
DEFINE("_DM_WRITEABLE","SCRIVIBILE");
DEFINE("_DM_UNWRITEABLE","NON SCRIVIBILE");
DEFINE("_DM_MAKE_UNWRITEABLE","Rendere il file non scrivibile dopo il salvataggio? (Potrai modificare il file ancora da questa pagina se dovrai apportare ulteriori cambiamenti)");
DEFINE("_DM_OVERRRIDE_UNWRITEABLE","Ignorare la protezione in scrittura? (Spunta questo box per salvare i cambiamenti apportati)");

/////////////////////// Administration - Email Preview
DEFINE("_DM_EMAIL_PREVIEW","D-Mack RecommendFriends Anteprima Email   -   Clicca <b>**<u>Salva</u>**</b> per aggiornare la pagina e visualizzare i cambiamenti apportati...");
DEFINE("_DM_SUBJECT_IN_EMAIL","Soggetto Email:");
DEFINE("_DM_PREVIEW_SUBJECT","Un amico, <b><i>Users username</i></b> ti invita su <b><i> %s </i></b><br /><br />");
DEFINE("_DM_PREVIEW_SHORT_INTRO","Breve Introduzione:");
DEFINE("_DM_PREVIEW_USER_INFO","<b><i>Users username</i></b> (<b><i>Users emailaddress</i></b>) crede che questo sito possa essere di tuo gradimento - <b><i> %s </i></b>");
DEFINE("_DM_PREVIEW_ADMIN_MESSAGE","Messaggio Personalizzato dell'Utente (se utilizzato):");
DEFINE("_DM_PREVIEW_ADMIN_MESSAGE_BLANK","&nbsp;<b><i><font color='red'>***AVVERTENZA***</font></i></b> Hai attivato il messaggio personalizzato opzione ma non vi è alcuna informazione nel campo Messaggio!");
DEFINE("_DM_PREVIEW_LINK","Link al tuo Sito:");
DEFINE("_DM_PREVIEW_LINK_INFO","Visita il sito: <b><i> %s </i></b>");
DEFINE("_DM_PREVIEW_USER_MESSAGE","Messaggio Utente (se utilizzato):");
DEFINE("_DM_PREVIEW_USER_MESSAGE_INFO","<b><i>Nome utente utenti's</i></b> peronal messaggio:");
DEFINE("_DM_PREVIEW_USER_MESSAGE_INFO2","<b><i>Utenti messaggio qui</i></b>");

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