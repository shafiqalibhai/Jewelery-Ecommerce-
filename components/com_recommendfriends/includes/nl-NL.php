<?php
/*
@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
@@  ____  __  __    __    ___  _  _  __  __  ____  ____  ____    __        ___  _____  __  __  @@
@@ (  _ \(  \/  )  /__\  / __)| )/ )(  \/  )( ___)(  _ \(_  _)  /__\      / __)(  _  )(  \/  ) @@
@@  )(_) ))    (  /(__)\( (__ |   <  )    (  )__)  )(_) )_)(_  /(__)\    ( (__  )(_)(  )    (  @@
@@ (____/(_/\/\_)(__)(__)\___)|_)\_)(_/\/\_)(____)(____/(____)(__)(__) () \___)(_____)(_/\/\_) @@
@@                                                                                             @@
@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
@@         RecommendFriends Component for Joomla! - v2.0.2 - Juli-23-2008 - D-Mack Media          @@
@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@

Als je veranderingen aanbrengt in het component of vertaald naar een andere taal,
bewerk dan alleen de delen volgens het hieronder getoonde:

DEFINE("_DM_EXAMPLE",".......bewerk alleen deze ruimte - waar de punten starten en stoppen0.....");

Als je andere tekst delen dan hierboven aangegeven is de kans groot dat er een 'breuk' onstaat
in de functionaliteit van het component. 
*/

/***********************************************************************************************/
/*********************************** Site Voorzijde (Front End) ********************************/
/***********************************************************************************************/

DEFINE("_DM_TITLE","Beveel onze site aan bij je vriend(en)!");

/////////////////////// Alleen voor ingelogde gebruikers
DEFINE("_DM_USER_INSTRUCTIONS","
<br />
Je naam en email adres, verschijnt ook in de email aan je vriend(en).  NB: Je kunt hier niets aan veranderen!!
<br /><br />
&nbsp;&nbsp;- Je moet tenminste 1 email adres van je vriend(en) invullen.
<br />");

/////////////////////// Voor Publieke Gebruikers - Iedereen kan een uitnodeging/aanbeveling versturen
DEFINE("_DM_USER_INSTRUCTIONS_1","
<br />
Je naam en email adres, verschijnt ook in de email(s) aan je vriend(en). NB: Je kunt hier niets aan veranderen!!
<br /><br />
&nbsp;&nbsp;- Je moet hier je eigen email adres invullen.
<br />
&nbsp;&nbsp;- Je moet tenminste 1 email adres van je vriend(en) invullen.
<br />");

/////////////////////// Captch Instructies - Optie moet actief zijn aan de Admin zijde (Back end)
DEFINE("_DM_USER_INSTRUCTIONS_CAPTCHA","
&nbsp;&nbsp;- Je moet ook de getoonde veiligheids code correct invullen.
<br />");

/////////////////////// Dank je notitie
DEFINE("_DM_USER_INSTRUCTIONS_THANKS","
<br />
Velden gemarkeerd met <font color='red'><b>**</b></font> zijn verplichte velden.
<br /><br />
Alvast onze dank voor de aanbeveling bij jou vriend(en)!
<br />");

/////////////////////// Voorzijde Email Formulier Beeld
DEFINE("_DM_YOUR_NAME","Jou naam:");
DEFINE("_DM_YOUR_EMAIL","Jou E-mail adres:");
DEFINE("_DM_FRIEND1_NAME","Naam vriend(en) (optioneel):");
DEFINE("_DM_FRIEND1_EMAIL","E-Mail adres(sen) Vriend(en):");
DEFINE("_DM_MESSAGE","Jou persoonlijk bericht (optioneel):");
DEFINE("_DM_MESSAGE_HTML","De site beheerder laat HTML code toe in jou persoonlijk bericht. Als je HTML code gebruikt zorg dan wel dat je de juiste syntax gebruikt - inclusief de in-line stijlen en &lt;p&gt;text&lt;/p&gt; of &lt;br&gt; voor de lijn afbreking, anders verschijnt de email niet correct bij de ontvanger of de email wordt geweigerd door de ontvanger(s)!");
DEFINE("_DM_SEND","Verstuur Aanbeveling!");
DEFINE("_DM_CC_USER","Plaats een vinkje als je zelf een kopie(BCC) wilt van de email");

/////////////////////// Javascript/Captcha Formulier Validatie Fouten Alarm
DEFINE("_DM_ALERT_FROM_EMAIL_EMPTY","Je moet jou email adres opgeven...");
DEFINE("_DM_ALERT_TO_EMAIL_EMPTY","Je moet minimaal 1 email adres opgeven...");
DEFINE("_DM_ALERT_FROM_EMAIL_INVALID","Let er op dat het email adres juist is (bv. vriend@adres.nl)...");
DEFINE("_DM_ALERT_TO_EMAIL_INVALID","Let er op dat het email adres van je vriend(en) juist is (bv. vriend@adres.nl)...");
DEFINE("_DM_ALERT_MULTIPLE_EMAIL"," *** Je mag maar EEN amail adres per veld invullen *** ");
DEFINE("_DM_CAPTCHA_INFO1","Anti-Spam Veiligheids Controle - Vul de hier getoonde veiligheids code in daarvoor bestemde veld in:");
DEFINE("_DM_CAPTCHA_INFO2","Herlaad");
DEFINE("_DM_CAPTCHA_INFO3","Klik op 'Herlaad' als je de Veiligheids code niet kunt lezen");
DEFINE("_DM_CAPTCHA_INFO4","Veiligheids Code:");
DEFINE("_DM_CAPTCHA_ALERT","*** Onjuiste Veiligheids Code... Probeer het nog eens ***");
DEFINE("_DM_CAP_REFRESH_ALERT","Als je op OK klikt wordt het gehele formulier gewist!  Toch doorgaan?");

/////////////////////// Email Succes/Faal Berichten
DEFINE("_DM_SUCCESS"," email(s) succesvol verzonden!");
DEFINE("_DM_SUCCESS_LIST","Hier een overzicht van de verzonden email(s):");
DEFINE("_DM_THANK_YOU","Hartelijk bedankt voor de aanbeveling!");
DEFINE("_DM_FAIL"," email(s) konden op dit moment niet verzonden worden. Probeer het later nog eens.");
DEFINE("_DM_FAIL_LIST","Hier een lijst van de niet verzonden email(s):");
DEFINE("_DM_COPY_USER","Hartelijk bedankt voor het aanbevelen van onze site: ");
DEFINE("_DM_COPY_USER1","Hier een lijst van de namen en email adres(sen) die je verstuurde:");
DEFINE("_DM_COPY_USER2","Hier is een kopie van de email die je vriend(en) zal ontvangen:");
DEFINE("_DM_YOUR_COPY1","Jou (BCC) kopie van de Email: ");
DEFINE("_DM_RECOMMEND_USER1","Aanbevelen gebruiker info: ");
DEFINE("_DM_RECOMMEND_USER2","Aanbevelen gebruikersnaam en e-mail: ");
DEFINE("_DM_BACK","Back");

/////////////////////// E-mail aan Vriend(en) Variabelen
DEFINE("_DM_HELLO","Hallo daar ");  //aanhef in de inhoud van de email als de vriend naam is gegeven
DEFINE("_DM_HELLO_2", "Hallo daar!"); //aanhef in de inhoud van de email als de vriend naam niet is gegeven
DEFINE("_DM_FRIEND","Jou Vriend "); //gebruikt als ONDERWERP in de email (tenzij anders gedefinieerd door de admin) gevolgd door gebruikersnaam en email
DEFINE("_DM_FRIEND_2","Een vriend van jou, ");  //beginlijn in de inhoud van de email gevolgd door gebruikersnaam en email
DEFINE("_DM_INVITES_YOU","wil dat het volgende bezoekt ");  //volgt op _DM_FRIEND in het ONDERWERP van de email
DEFINE("_DM_INVITES_YOU_2","denkt dat je wel geinteresseerd bent deze prachtige site - ");  //  volgt op _DM_FRIEND_2
DEFINE("_DM_GO_TO","Bekijk deze site op:");  //middenstuk van de email inhoud waar jou site-link verschijnt
DEFINE("_DM_TELLS_YOU","'s persoonlijk bericht aan jou:");  //bericht als de gebruiker dit bericht veld invuld
DEFINE("_DM_FRIEND_TELLS_YOU","Jou vriend's persoonlijk bericht aan jou:");  //bericht als de gebruiker dit bericht veld invuld
DEFINE("_DM_ADMIN_NEWS","Groot Nieuws!");
DEFINE("_DM_ADMIN_COPY"," is zojuist aanbevolen door een gebruiker aan zijn vriend(en)!");
DEFINE("_DM_ADMIN_COPY1","Hier een lijst van vriend(en) naar wie een email is verstuurd:");
DEFINE("_DM_ADMIN_COPY2","Hier een kopie van de verstuurde email:");


/***********************************************************************************************/
/********************************** Admin zijde (Back End) *************************************/
/***********************************************************************************************/

/////////////////////// Administratie - Voornaamste Email Configuratie
DEFINE("_DM_MAIN_CONFIG","Voornaamste Email Configuratie Instellingen:");
DEFINE("_DM_NUMREC","Aantal Vriend Velden:");
DEFINE("_DM_NUMREC_INFO","Voer het nummer in van Vriend(en) e-mail velden welke worden weergegeven aan de voor-zijde.");
DEFINE("_DM_FROM_REPLY","Email van de Gebruiker:");
DEFINE("_DM_FROM_REPLY_CHECK","Vinkje aan als u wilt dat voor het 'Van' <u>en</u> 'Reageren op' het gebruiker e-mailadres wordt weergegeven in de RecommendFriends email.  Zonder vinkje wordt voor het 'Van' het e-mailadres van de Administrator gegeven, en als 'Reageren op' het e-mailadres van de gebruiker.");
DEFINE("_DM_BCC_ADMIN","(Bcc) Kopie Admin:");
DEFINE("_DM_BCC_ADMIN_CHECK","Vinkje dit aan als u (Administrator) een (Bcc) kopie wenst te ontvangen van alle e-mails die worden verzonden via RecommendFriends. U ontvangt 1 e-mail voor elke aanbeveling die worden verstuurd - een lijst van e-mailadressen waar wat aan verstuurd is, wie de aanbeveling verstuurde en een kopie van de tekst. Waarschuwing: afhankelijk van hoe vaak dit gebruikt wordt, kan het gebeuren dat je erg veel e-mails ontvangt.");
DEFINE("_DM_CUST_SUBJECT","Gebruik aangepast onderwerp:");
DEFINE("_DM_CUST_SUBJECT_CHECK"," Vinkje dit aan als u gebruik wilt maken van onderstaand aangepast e-mail Onderwerp.");
DEFINE("_DM_CUST_EMAIL_SUBJECT","Aangepast onderwerp Email:");
DEFINE("_DM_CUST_EMAIL_SUBJECT_INFO","Dit vak is voor het aangepaste 'onderwerp' bericht voor gebruik in de e-mails. Als je het vinkje aan zet, maar het 'onderwerp' veld leeg laat, wordt de standaard tekst als onderwerp gebruikt ( je vriend/vriendin <b><i>Gebruiker/gebruikersnaam</i></b> wil graag dat je <b><i>uw sitenaam</i></b>) even bezoekt. **<b><u>NB</u></b>** Je mag in dit veld geen HTML of PHP codes gebruiken - je MOET hier alleen platte tekst gebruiken!");
DEFINE("_DM_CUST_MESSAGE","Gebruik aangepast bericht:");
DEFINE("_DM_CUST_MESSAGE_CHECK"," Vink dit aan als je onderstaand aangepast bericht wilt gebruiken.");
DEFINE("_DM_CUST_MESSAGE_HTML","Gebruik HTML Code:");
DEFINE("_DM_CUST_MESSAGE_HTML_INFO"," Vink dit aan om het gebruik van HTML Code toelaat in het Aangepaste Intro Bericht (het vinkje bij 'Gebruik aangepast bericht' moet geplaatst zijn). Als het vinkje aan staat worden alle Emails in het Content-Type:text/html MIME formaat verstuurd!");
DEFINE("_DM_CUST_INTRO_MESSAGE","Aangepast Intro Bericht:");
DEFINE("_DM_CUST_INTRO_MESSAGE_INFO","Stel een aangepast bericht op voor alle RecommendFriends e-mails die verstuurd worden. Het zal verschijnen boven het 'Jou persoonlijk bericht' dat een gebruiker (optioneel) kan invullen voor het versturen van de e-mails. Als het vinkje aanstaat en dit veld leeg laat, wordt er geen aangepast bericht gebruikt.");
DEFINE("_DM_CUST_INTRO_MESSAGE_INFO_2","**<b><u>NB</u></b>** Je kunt elke HTML-code in het aangepaste bericht gebruiken. Bovenstaande tekstruimte zal alle blanco/lege regels en spaties verwijderen, dus je moet alles <b>VOLLEDIG</b> opmaken met behulp van HTML-code en met behulp van in-line stijlen - inclusief goede witregels zoals &lt;p&gt;tekst&lt;/p&gt; of &lt;br /&gt; voor regelafstand, stijlen voor alle eigenschappen lettertype, kleuren enz. U kunt zelfs afbeeldingen insluiten in de e-mail - let er dan wel goed op dat je gebruik maakt van een volledige pad/folder verwijzing naar de afbeelding - dwz &lt;img src='http://www.yoursite.com/images/emailpicture.jpg'&gt;. U moet <b>GEEN</b> gebruik maken van &lt;html&gt;, &lt;head&gt; of &lt;body&gt; tags voor opening of sluiting. Ook kunt u <b>GEEN</b> gebruik maken van Javascript of PHP-codes in deze tekst-ruimte!");
DEFINE("_DM_CUST_INTRO_MESSAGE_INFO_3","**<b><u>NB</u></b>** U kunt alleen platte tekst gebruiken in het bericht hierboven - HTML, Javascript en PHP code zijn niet toegestaan (u kunt HTML-code alleen als je het vinkje bij 'Gebruik HTML-code' hierboven aanstaat)");

/////////////////////// Administratie - Voorzijde Formulier Beeld Formaat Configuratie
DEFINE("_DM_MAIN_FORMAT","Voorzijde Formulier Beeld Formaat Configuratie:");
DEFINE("_DM_CONFIG_SAVED","Configuratie instellingen zijn bewaard!");

/////////////////////// Formulier Veld Maten
DEFINE("_DM_FORM_SIZE_INFO","<b>Veld breedtes</b> - leg de breedte van de Naam en Email velden getoond aan de voorzijde vast.");
DEFINE("_DM_FORM_NAME","Jou(gebruiker) en Vriend(en) <b>Naam</b> Invoer Veld Breedte: ");
DEFINE("_DM_FORM_EMAIL","Jou(gebruiker) en Vriend(en) <b>Email</b> Invoer Veld Breedte: ");
DEFINE("_DM_FORM_MESSAGE_SIZE","Bericht Invoer Grootte");
DEFINE("_DM_FORM_ROWS","Tekstruimte Bericht Gebruiker #Rijen: ");
DEFINE("_DM_FORM_COLS","Tekstruimte Bericht Gebruiker #Kolommen: ");
DEFINE("_DM_FORM_DEFAULT","Standaard");

/////////////////////// Formulier Veld Kleuren
DEFINE("_DM_MAIN_FORM","<b>Uiterlijk Alle Formulier Velden</b> - configureer de achtergrond en tekst kleuren van de RecommendFriends formulier invoer velden (wis het kleur nummer of selecteer 'NO COLOR' als je gebruik wilt maken van CSS stijl template - bedenk wel dat de Admin CSS waarschijnlijk anders is dan de VoorZijde CSS):");
DEFINE("_DM_MAIN_FORMBG","Achtergrond Kleur:");
DEFINE("_DM_MAIN_FORMTX","Tekst Kleur:");
DEFINE("_DM_PREVIEW","Voorbeeld (Klik op 'Save' om wijzegingen vast te leggen)");
DEFINE("_DM_PREVIEW_TEXT","VoorbeeldTekst@UwSite.nl - 1234567890");

/////////////////////// Validatie Fouten
DEFINE("_DM_MAIN_ERROR_INFO","<b>Het Veld uiterlijk veranderen om Fouten te benadrukken</b> - configureer de achtergrond en tekst kleur van velden met validatie fout - dit wordt niet gestuurd door de standaard CSS stijl (wis het kleurnummer of selecteer 'NO COLOR' als je geen verandering van kleur wilt toepassen):");
DEFINE("_DM_ERROR_TEST","Test");
DEFINE("_DM_ERROR_RESET","Herstel");
DEFINE("_DM_ALERT_TEST","De Achtergrond en Tekst kleuren moeten hier zijn veranderd...");

/////////////////////// Ingelogde Gebruikers
DEFINE("_DM_LOGGED_INFO","<b>Veldkleur bepalen van Naam en Email Adres Gebruiker</b> - configureer hoe de Naam en Email Adres van ingelogde gebruikers moeten worden weergegevenr (wis het kleurnummer of selecteer 'NO COLOR' als je gebruik wilt maken van CSS stijl template - bedenk wel dat de Admin CSS waarschijnlijk anders is dan de VoorZijde CSS):");
DEFINE("_DM_LOGGED_USER","De Gebruikers Naam");
DEFINE("_DM_LOGGED_EMAIL","GebruikersNaam@UwSite.nl");

/////////////////////// Captcha Configuratie
DEFINE("_DM_CAP_TITLE","Captcha Veiligheids Afbeelding Configuratie");
DEFINE("_DM_GDFT_HALF","<font color='green'><b>GD Ondersteuning</b></font> is Beschikbaar maar <font color='red'><b>FreeType Ondersteuning</b></font> blijkt niet Geactiveerd te zijn op de server!!");
DEFINE("_DM_GDFT_NO","<font color='red'><b>GD Ondersteuning</b></font> en <font color='red'><b>FreeType Ondersteuning</b></font> zijn beide niet Geactiveerd op de server!!");
DEFINE("_DM_GREAT_NEWS","GOED NIEUWS!!!");
DEFINE("_DM_GDFT_YES","<font color='green'><b>GD Ondersteuning</b></font> en <font color='green'><b>FreeType Ondersteuning</b></font> zijn beide <b>Geactiveerd</b> op de server!!&nbsp;&nbsp;De Captcha optie van dit component kan hier goed functioneren!");
DEFINE("_DM_GD_WARNING","<<<<<<<<<<<<&nbsp;&nbsp;&nbsp;WAARSCHUWING&nbsp;&nbsp;&nbsp;>>>>>>>>>>>>");
DEFINE("_DM_GD_OPTIONS","Helaas blijkt dat de Captcha optie van dit component niet zal werken op deze server. <b>**NB** Het RecommendFriends Component kan wel gebruikt worden</b>, maar je kan Captcha niet gebruiken (het 'VINKJE' moet weg). Je kunt jou website host leverancier vragen om GD en FreeType ondersteuning te activeren als je toch gebruik wilt maken van Captcha...");
DEFINE("_DM_CAP_USE","Gebruik Captcha Beveiliging:");
DEFINE("_DM_CAP_USE_INFO","Vink dit aan als je Captcha Veiligheids Verificatie wilt activeren");
DEFINE("_DM_CAP_1","Afbeeldings opties");
DEFINE("_DM_CAP_2","Breedte van de Afbeelding (pixels)");
DEFINE("_DM_CAP_3","Hoogte van de Afbeelding (pixels)");
DEFINE("_DM_CAP_4","Willekeurige rotatie afbeelding (+/-10 degrees)");
DEFINE("_DM_CAP_ROTATE","Vink dit aan al je afbeelding wilt draaien");
DEFINE("_DM_CAP_6","Nee");
DEFINE("_DM_CAP_7","Kleuren Opties Afbeelding");
DEFINE("_DM_CAP_COLOR_BUTTON","Selecteer");
DEFINE("_DM_CAP_COLOR_NEW","Nieuw: ");
DEFINE("_DM_CAP_COLOR_ASIS","Set: ");
DEFINE("_DM_CAP_8","Achtergrond Kleur");
DEFINE("_DM_CAP_9","Tekst Kleur");
DEFINE("_DM_CAP_10","Ruis Kleur");
DEFINE("_DM_CAP_11","Font Opties");
DEFINE("_DM_CAP_12","Kies het te gebruiken Font");
DEFINE("_DM_CAP_13","MonoFont.ttf");
DEFINE("_DM_CAP_14","ComicBook.ttf");
DEFINE("_DM_CAP_15","OldCentury.ttf");
DEFINE("_DM_CAP_16","Aantal te gebruiken Karakters");
DEFINE("_DM_CAP_SAMPLE","Voorbeeld van de Captcha met de gekozen Opties<br />(Klik op 'Save' voor het bewaren van de opties)");

/////////////////////// Gebruiker Aangepast Bericht Opties
DEFINE("_DM_USER_MESSAGE","Bericht van Gebruiker:");
DEFINE("_DM_USER_MESSAGE_CHECK"," Vink dit aan om een persoonlijk bericht van gebruikers toe te staan.");
DEFINE("_DM_USER_MESSAGE_HTML","Gebruik HTML Code:");
DEFINE("_DM_USER_MESSAGE_HTML_INFO"," Vink dit aan om de gebruiker toe staan HTML Code in hun bericht te plaatsen ('Bericht van Gebruiker' moet actief zijn). Als het vinkje aan staat worden alle Emails als een Inhoud-Type:text/html MIME formaat verstuurd!  **<b><u>NB</u></b>**Dit kan mogelijk problemen veroorzaken op sommige sites/servers en onjuiste HTML code kan emails afbreken! Gewoonweg niet de 'Gebruik HTML Code' optie activeren als de er geen noodzaak voor gebruik is.");

/////////////////////// Administratie - Bewerk Taal Bestand
DEFINE("_DM_EDIT_LANG_HEADER","Taal bestand Configuratie/Bewerk");
DEFINE("_DM_EDIT_LANG","Klik Hier om het Taal bestand te bewerken");
DEFINE("_DM_EDIT_LANG_INFO","Je kan ELK deel van de tekst veranderen in dit component, zowel de voorkant als ook de administrators tekst, voor het bewerken wordt gebruik gemaakt van de on-line editor - probeer het eens!  Klik maar eens op onderstaande link ...");
DEFINE("_DM_LANG_EMPTY","Kan de opdracht niet uitvoeren... Taal bestand is leeg!");
DEFINE("_DM_LANG_IS_NOT_WRITEABLE","Kan de opdracht niet uitvoeren... Taal bestand is een alleen lezen bestand!");
DEFINE("_DM_LANG_SAVED","Taal bestand is opgeslagen!");
DEFINE('_DM_LANG_FILE','Het Taal bestand: ');
DEFINE("_DM_LANG_IS","is");
DEFINE("_DM_WRITEABLE","SCHRIJFBAAR");
DEFINE("_DM_UNWRITEABLE","ALLEEN LEZEN");
DEFINE("_DM_MAKE_UNWRITEABLE","Maak het taal bestand alleen lezen na opslaan? (Je kunt de tekst overschrijven via deze pagina als er meer veranderingen nodig zijn)");
DEFINE("_DM_OVERRRIDE_UNWRITEABLE","Schrijfbeveiliging aanzeten na bewaren ('Save')? (Vinkje moet aanstaan om veranderingen die je maakte op te slaan)");

/////////////////////// Administratie - Email Voorbeeld
DEFINE("_DM_EMAIL_PREVIEW","D-Mack RecommendFriends Email Voorbeeld   -   Klik op <b>**<u>Save</u>**</b> om eerst eventuele gedane wijzegingen op te slaan...");
DEFINE("_DM_SUBJECT_IN_EMAIL","Onderwerp veld in de Email:");
DEFINE("_DM_PREVIEW_SUBJECT","Jou vriend <b><i>Gebruiker/Naam</i></b> wants you to check out <b><i> %s </i></b><br />");
DEFINE("_DM_PREVIEW_SHORT_INTRO","Korte Intro:");
DEFINE("_DM_PREVIEW_USER_INFO","<b><i>Gebruikers Naam</i></b> (<b><i>Gebruikers Email adres</i></b>) denkt dat wel interesse hebt voor deze fraaie site - <b><i> %s </i></b>");
DEFINE("_DM_PREVIEW_ADMIN_MESSAGE","Aangepast Admin Bericht (indien gebruikt):");
DEFINE("_DM_PREVIEW_ADMIN_MESSAGE_BLANK","&nbsp;<b><i><font color='red'>***WAARSCHUWING***</font></i></b> Je hebt Aangepast Bericht geactiveerd maar er staat helemaal niets in het daarvoor bestemde Bericht Veld!");
DEFINE("_DM_PREVIEW_LINK","Link naar de Site:");
DEFINE("_DM_PREVIEW_LINK_INFO","Bezoek deze site op: <b><i> %s </i></b>");
DEFINE("_DM_PREVIEW_USER_MESSAGE","Gebruikers Bericht (indien gebruikt):");
DEFINE("_DM_PREVIEW_USER_MESSAGE_INFO","<b><i>Gebruikersnaam</i></b> peroonlijk bericht aan jou:");
DEFINE("_DM_PREVIEW_USER_MESSAGE_INFO2","<b><i>Gebruikers bericht hier</i></b>");


/////////////////////// Administratie - Informatie Pagina
DEFINE("_DM_PROGRAM","
    <i><b><font size='4'>
Programma
    </font></b></i><br /><br />
D-Mack RecommendFriends Versie v2.0.2 - Juli-23-2008 is een component die gebruikers in de gelegenheid stelt jou site aan te bevelen bij hun vrienden.
    <br /><br />
Het kan meerdere emails versturen, vastgelegd in Admin, met de naam van vrienden, en een kopie voor de Administrator en/of de gebruiker.  Het ondersteund Captcha Beveiliging als hulp om spam te voorkomen en een optie om in Content-Type:text/html MIME formaat te versturen!  ALLE tekst in het hele component, de voor en achter zijde, kunnen on-line bewerkt worden aan de achter (Admin) zijde van de site.  En het component is <b>XHTML 1.0 Transitional valid</b>!
    <br /><br />
Dit componen gebruikt de standaard Joomla! <b>JFactory Mailer</b> functies - welke zouden moeten werken als deze correct geconfigureerd zijn voor jou website server (i.e. Sendmail, PHPMailer, SMTP, etc).
    <br /><br />
Dit component is 100% Vrij (GNU/GPL License) - Het staat je <b><i>GEGARANDEERD HELEMAAL VRIJ</i></b> om alle bestanden naar eigen behoefte aan te passen. Het enige wat Ik je vraag is het mij te laten weten, ook of je het script verbeterd hebt, zodat ook Ik de verbeteringen kan aanbrengen en deze dan als een verbeterde versie kan uitbrengen voor de hele community.  Bedankt!
    <br /><br />
Als je een suggestie hebt of een fout hebt gevonden neem dan even contact op via mail: info op dmackmedia.com
    <br /><br />
");
DEFINE("_DM_CONFIG_INFO","
    <i><b><font size='4'>
Programma Configuratie
    </font></b></i><br /><br />
Met het uitkomen van deze versie (RecommendFriends v2.0.2 - Juli-23-2008) zijn er veel configuratie instellingen mogelijk binnen dit component.
    <ul>
    <li>
De Administrator kan het aantal 'Email Velden' vastleggen die beschikbaar zijn aan de voorzijde.
    <br /><br /></li>
    <li>
Het is mogelijk om het 'Van' en 'Reageren op' email adres in te stellen.  Indien geactiveerd (aagevinkt), zal het 'Van' en 'Reageren op' email adres van de gebruiker worden meegezonden. Indien NIET geactiveerd, verschijnt als 'Van' het email adres van de site 'Administrator' en als 'Reageren op' het email adres van de gebruiker.
    <br /><br /></li>
    <li>
Het is megelijk om in te stellen of de Administrator ook een kopie (Bcc) ontvangt van elke email verzonden aan de 'Vrienden' van de gebruiker. Als je een grote, active site hebt met veel gebruikers, is het wellicht verstandig om deze optie niet te activeren in verband met de grote hoeveelheid van mail die je dan krijgt. Indien geactiveerd (aagevinkt), wordt in het Bcc veld het Admin email adres geplaatst die voor de meeste ontvangers/gebruikers niet zichtbaar is.
    <br /><br /></li>
    <li>
Je kunt het 'Onderwerp' veld aanpassen van de emails. Er is een selectie-box die bepaald of je deze mogelijkheid wilt gebruiken of niet. Helaas kun je hier op dit moment alleen maar platte tekst voor gebruiken. Dus nu nog <b>Geen</b> HTML of PHP.
    <br /><br /></li>
    <li>
Ook kun je een aangepast introductie bericht maken voor de emails die aan Vrienden wordt verstuurd. Er is een selectie-box waarmee je deze optie activeerd/deactiveerd. Dit kan een goede manier zijn om meer bezoekers/gebruikers op je site te krijgen. Je kunt een opsomming maken van alle positieve zaken op jou site, om dan hopelijk meer gebruikers/leden te krijgen. Als je een 'Referentie' programma hebt, zou dit een geweldige plek zijn om te beschrijven hoe dat werkt, wat de voordelen zijn voor een nieuw lid en wat de voordelen voor de gebruiker is die RecommendFriends e-mails verstuurd.
    <br /><br /></li>
    <li>
Tevens is er de optie of je wel/niet toestaat HTML code te gebruiken in de aangepast introductie. Actieveren (toestaan) van deze optie houdt in dat alle emails in het Content-Type:text/html MIME formaat worden verstuurd. Je kunt dan alle HTML codes gebruiken in het bericht, maar je kunt <b>GEEN</b> andere codes (PHP, Javascript, etc.) gebruiken in het aangepaste veld.
    <br /><br /></li>
        <li>
Er zijn vele mogelijkheden om het uiterlijk van de Formulier velden weer te geven aan de voorzijde. Je kan de breedte van de naam en email velden in stellen als ook de gebruikers persoonlijk bericht veld. Gebruik de Kleuren Selector voor instellingen, van achtergrond en tekst kleuren, van validatie achtergrond en tekst kleuren als ook de achtergrond en tekst kleur van de naam en email adres velden van ingelogde gebruikers.
    <br /><br /></li>
        <li>
RecommendFriends v2.0.2 - Juli-23-2008 komt ook met Captcha Beveiliging!  <b><u>*NB*</u></b> Jou website server *MOET* wel het gebruik van GD Library als ook True Type Fonts geactiveerd hebben staan!  Je kan zelf gepalen of dit al of niet wilt gebruiken, ook kun de variabelen voor breedte, hoogte, tekst rotatie als ook de kleuren (en de achtergrond-tekst-ruis) instellen met behulp van de Kleuren-selector, het font en het aantal karakters die getoond worden in de afbeelding.
    <br /><br /></li>
    <li>
** ALLE ** tekst voor dit component getoond op het scherm, inclusief de voorzijde, admin configuratie tekst en hetgeen je nu leest, wordt aangeroepen via de bijgevoegde taal bestand(en) in de 'components\com_recommendfriends\includes' folder - kunnen nu allen bewerkt worden ** ON-LINE ** met behulp van dit component! Het staat je vrij deze naar believen aan te passen. Als je de tekst vertaald hebt in een andere taal (anders dan Engels), neem dan alsjebleift contact met me op zodat ik jou Taal bestand kan insluiten in het component voor verdere distributie! Bedankt!
    <br /><br /></li>
    <li>
Nu in diverse talen (vertalingen) beschikbaar. Bestanden:
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
Linken naar dit Component
    </font></b></i><br />
      <Table align='center' width='100%' cellpadding='12'>
        <tr>
          <td width='100%' align='left'>
            <p style='margin-top: 0; margin-bottom: 0'>Om in het hoofdmenu (mainmenu) een link te maken, als je dit tenminste voor iedereen (Publiek) beschikbaar wilt maken, moet je deze stappen volgen:</p>
            <ol style='font-family: Arial; font-size: 8pt'>
              <li>Klik Menu's --- Hoofdmenu link</li>
              <li>Klik op 'Nieuw' Rechts bovenin het top gedeelte van het scherm</li>
              <li>Kies het 'D-Mack Recommend Friends' Component in de lijst</li>
              <li>Voer een Titel in voor de link</li>
              <li>Voer een Alias in voor de link</li>
              <li>De gegeven link hoeft niet gewijzigd te worden</li>
              <li>Selecteer de 'Ja' radio button</li>
              <li>Zorg er voor dat het Toegangsniveau op 'Publiek' staat</li>
              <li>En tenslotte, klik je op 'Opslaan' als alles goed is kan het nu gebruikt worden!</li>
            </ol>
            <p style='margin-top: 0; margin-bottom: 0'>Om een link te plaatsen in het Gebruikersmenu (usermenu), als je wilt dat alleen 'Geregistreerde' dit component gebruiken, moet je deze stappen volgen:</p>
            <ol style='font-family: Arial; font-size: 8pt'>
              <li>Klik Menu's --- Gebruikersmenu link</li>
              <li>Volg de stappen 2 tot en met 7 hierboven getoond...</li>
              <li>Zorg er voor dat het Toegangsniveau op 'Geregistreerd' staat</li>
              <li>En tenslotte, klik je op 'Opslaan' als alles goed is kan het nu gebruikt worden!</li>
            </ol>
            <p style='margin-top: 0; margin-bottom: 0'>&nbsp;</p>
            <p style='margin-top: 0; margin-bottom: 0'>Je kunt tevens de component parameters aanpassen door te klikken op Component---Recommend Friends---Configuratie in het Hoofd Admin Menu hierboven.</p>
          </td>
        </tr>
      </table>
");
DEFINE("_DM_WARRANTY","
    <i><b><font size='4'>
Garantie
    </font></b></i><br /><br />
Dit programma is verspreid in de hoop dat het nuttig zal zijn, maar ZONDER ENIGE GARANTIE, zelfs zonder de impliciete garantie van VERKOOPBAARHEID of GESCHIKTHEID VOOR EEN BEPAALD DOEL.
    <br /><br />
");
/////////////////////// Administratie - Configuratie & Informatie Pagina Voetnoot
DEFINE("_DM_COPYRIGHT_BOTTOM","D-Mack RecommendFriends Aanvullende Informatie");
DEFINE("_DM_SUGGESTIONS","Als je een suggestie hebt of een fout hebt gevonden, neem dan alsjeblieft contact op via: info op dmackmedia.com");
DEFINE("_DM_COPYRIGHT","
D-Mack RecommendFriends component - v2.0.2 - Juli-23-2008 - valt onder de GNU/GPL licentie.
    <br />
****** Het staat je <b><i>GEGARANDEERD HELEMAAL VRIJ</i></b> de bestanden naar eigen behoefte aan te passen! ******
    <br />
Als je een fout vind, het script verbeterde of wat dan ook, laat dat dan de community weten middels commentaar op de Extensies pagina of in de Forums.
    <br />
En boven alles... Heb plezier!
    <br /><br />
");
?>