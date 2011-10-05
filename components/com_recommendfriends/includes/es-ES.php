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

DEFINE("_DM_TITLE","&iexcl;Recomiende esta web a sus amigos!");

/////////////////////// For Logged in Users Only
DEFINE("_DM_USER_INSTRUCTIONS","
<br />
Su nombre y direcci&oacute;n de email, que se muestran debajo, aparecer&aacute;n en los emails que env&iacute;e. NOTA: No puede editarlos.
<br /><br />
&nbsp;&nbsp;- Debe indicar al menos <b>1</b> direcci&oacute;n email de sus amigos.
<br />");

/////////////////////// For Public Users - Anyone can send an invite/recommendation
DEFINE("_DM_USER_INSTRUCTIONS_1","
<br />
Su nombre y direcci&oacute;n de email, que se muestran debajo, aparecer&aacute;n en los emails que env&iacute;e.
<br /><br />
&nbsp;&nbsp;- Debe indicar <b>su</b> direcci&oacute;n email.
<br />
&nbsp;&nbsp;- Debe indicar al menos <b>1</b> direcci&oacute;n email de sus amigos.
<br />");

/////////////////////// Captch Instructions - If Option Selected in Admin
DEFINE("_DM_USER_INSTRUCTIONS_CAPTCHA","
&nbsp;&nbsp;- Debe tambi&eacute;n introducir el c&oacute;digo de seguridad que se muestra.
<br />");

/////////////////////// Thank You Note
DEFINE("_DM_USER_INSTRUCTIONS_THANKS","
<br />
Los campos marcados con <font color='red'><b>**</b></font> se deben rellenar para que sea posible enviar la recomendaci&oacute;n.
<br /><br />
<b>&iexcl;Gracias por recomendarnos!</b>
<br />");

/////////////////////// Frontend Email Form Display
DEFINE("_DM_YOUR_NAME","Su nombre (opcional)here there:");
DEFINE("_DM_YOUR_EMAIL","Su email:");
DEFINE("_DM_FRIEND1_NAME","Nombre de su amigo (opcional):");
DEFINE("_DM_FRIEND1_EMAIL","Email de su amigo:");
DEFINE("_DM_MESSAGE","Su mensaje (opcional):");
DEFINE("_DM_MESSAGE_HTML","<br>Se permite <b>HTML</b> para su mensaje personal. <br>Si usa c&oacute;digo HTML, por favor, aseg&uacute;rese de que la sintaxis HTML es totalmente correcta, incluyendo todos los saltos de l&iacute;nea (&lt;p&gt;text&lt;/p&gt; o &lt;br&gt;), de otra forma los emails no se mostrar&aacute;n de forma correcta o pueden ser rechazados por el receptor.");
DEFINE("_DM_SEND","Enviar");
DEFINE("_DM_CC_USER","Marque esta casilla si desea recibir una copia ciega (Bcc) del email.");

/////////////////////// Javascript/Captcha Form Validation Alert Errors
DEFINE("_DM_ALERT_FROM_EMAIL_EMPTY","Por favor, introduzca su email");
DEFINE("_DM_ALERT_TO_EMAIL_EMPTY","Necesita indicar al menos 1 email de un amigo ");
DEFINE("_DM_ALERT_FROM_EMAIL_INVALID","Por favor, aseg&uacute;rese de que su email es v&aacute;lido (por ejemplo, correo@dominio.com).");
DEFINE("_DM_ALERT_TO_EMAIL_INVALID","Por favor, aseg&uacute;rese de que todos los emails de sus amigos son v&aacute;lidos (por ejemplo, amigo@dominio.com).");
DEFINE("_DM_ALERT_MULTIPLE_EMAIL"," *** S&oacute;lo puede escribir UN email por casilla *** ");
DEFINE("_DM_CAPTCHA_INFO1","Comprobaci&oacute;n de Seguridad Antispam. Escriba el c&oacute;digo de seguridad indicado:");
DEFINE("_DM_CAPTCHA_INFO2","Recargar");
DEFINE("_DM_CAPTCHA_INFO3","Pulse 'Recargar' si no puede leer la imagen de seguridad.");
DEFINE("_DM_CAPTCHA_INFO4","C&oacute;digo de seguridad:");
DEFINE("_DM_CAPTCHA_ALERT","*** El c&oacute;digo introducido no es v&aacute;lido. Por favor, int&eacute;ntelo de nuevo ***");
DEFINE("_DM_CAP_REFRESH_ALERT","Al pulsar 'OK' se borra TODOS los datos del formulario. Desea continuar?");

/////////////////////// Email Success/Fail Messages
DEFINE("_DM_SUCCESS"," email(s) se han enviado de forma correcta.");
DEFINE("_DM_SUCCESS_LIST","Vea debajo una lista de los correos enviados:");
DEFINE("_DM_THANK_YOU","<b>&iexcl;Gracias por recomendarnos!</b>");
DEFINE("_DM_FAIL"," email(s) NO se han podido enviar ahora. Por favor, int&eacute;ntelo m&aacute;s tarde.");
DEFINE("_DM_FAIL_LIST","Esta es una lista de los emails que no se han podido enviar:");
DEFINE("_DM_COPY_USER","Gracias por recomendar nuestra web: ");
DEFINE("_DM_COPY_USER1","Esta es una lista de nombre(s) e email(s) que ha enviado :");
DEFINE("_DM_COPY_USER2","Esta es una copia del email que sus amigos reciben:");
DEFINE("_DM_YOUR_COPY1","Copia ciega (Bcc) a su email: ");
DEFINE("_DM_RECOMMEND_USER1","Info del usuario que recomienda: ");
DEFINE("_DM_RECOMMEND_USER2","Nombre e Email del usuario que recomienda: ");
DEFINE("_DM_BACK","Volver");

/////////////////////// E-mail Sent to Friends Variables
DEFINE("_DM_HELLO","Hola ");  //introduction in the body of the email if friends name is provided
DEFINE("_DM_HELLO_2", "Hola"); //introduction in the body of the email if friends name not provided
DEFINE("_DM_FRIEND","Su amigo "); //used in the SUBJECT of the email (if not defined by admin) followed by username and email
DEFINE("_DM_FRIEND_2","Un amigo suyo, ");  //starting line in the body of the email followed by username and email
DEFINE("_DM_INVITES_YOU","quier que vea la web ");  //follows _DM_FRIEND in the SUBJECT of the email
DEFINE("_DM_INVITES_YOU_2","piensa que le puede interesar la web de - ");  //  follows _DM_FRIEND_2
DEFINE("_DM_GO_TO","Visite la web en:");  //middle of email body where your site link actualy appears
DEFINE("_DM_TELLS_YOU"," le dice que:");  //message if user filled in message field
DEFINE("_DM_FRIEND_TELLS_YOU","El mensaje de su amigo:");  //message if user filled in message field
DEFINE("_DM_ADMIN_NEWS","Buenas noticias");
DEFINE("_DM_ADMIN_COPY"," acaba de ser recomenda por un usuario a su(s) amigo(s).");
DEFINE("_DM_ADMIN_COPY1","Esta es una lista de amigo(s) a los que se ha enviado el email:");
DEFINE("_DM_ADMIN_COPY2","Esta es una copia del email enviado:");


/***********************************************************************************************/
/*************************************** Admin Back End ****************************************/
/***********************************************************************************************/

/////////////////////// Administration - Main Email Configuration
DEFINE("_DM_MAIN_CONFIG","Ajustes de Configuraci&oacute;n del Email principal:");
DEFINE("_DM_NUMREC","N&uacute;mero de campos de amigos:");
DEFINE("_DM_NUMREC_INFO","Introduzca el n&uacute;mero de campos de amigos que aparecer&aacute;n.");
DEFINE("_DM_FROM_REPLY","Email Desde Usuario:");
DEFINE("_DM_FROM_REPLY_CHECK","Marque esta casilla si desea que las direcciones '<b>Desde</b>' y '<b>Responder</b> que aparecen en los emails de '<b>Recomendar a un amigo</b>' usen la direcci&oacute;n email del usuario. <br><br> Si NO se marca, la direcci&oacute;n 'Desde' ser&aacute; la suya (Administrador) y la 'Responder' la del usuario.");
DEFINE("_DM_BCC_ADMIN","Copia ciega (Bcc) al Administrador:");
DEFINE("_DM_BCC_ADMIN_CHECK","Marque esta casilla si Ud.(Administrador) desea recibir una copia ciega(Bcc) de todos los emails enviados mediante RecommendFriends.  Recibir&aacute; s&oacute;lo 1 email por cada grupo de recomendaciones enviado y en el que aparece la lista de direcciones email a las que se ha enviado, quien ha enviado la recomendaci&oacute;n y una copia del mensaje.  <br><br><b>Atenci&oacute;n</b>: dependiendo de cuantos usuarios tiene, lo activa que es su web, etc., puede recibir un mont&oacute;n de emails.");
DEFINE("_DM_CUST_SUBJECT","Usar Asunto particularizado:");
DEFINE("_DM_CUST_SUBJECT_CHECK","Marque esta casilla si desea usar como Asunto del email el mensaje particularizado de debajo.");
DEFINE("_DM_CUST_EMAIL_SUBJECT","Asunto particularizado del email:");
DEFINE("_DM_CUST_EMAIL_SUBJECT_INFO","<br>Si desea poner un mensaje particularizado para el campo '<b>Asunto</b>' del email, use esta casilla.<br><br>Si marca la casilla pero deja el 'Asunto' particularizado en blanco, entonces se usar&aacute; el 'Asunto' por defecto (Su amigo <b><i>Nombre del Usuario</i></b> quiere que visite  <b><i>el nombre de su web</i></b>). <br><br>**<b><u>NOTA</u></b>**: NO use aqu&iacute; c&oacute;digo HTML o PHP. DEBE ser s&oacute;lo texto plano.");
DEFINE("_DM_CUST_MESSAGE","Usar Mensaje particularizado:");
DEFINE("_DM_CUST_MESSAGE_CHECK","Marque esta casilla si desea usar el mensaje introductorio particularizado de debajo.");
DEFINE("_DM_CUST_MESSAGE_HTML","Usar c&oacute;digo HTML:");
DEFINE("_DM_CUST_MESSAGE_HTML_INFO"," Marque esta casilla para permitir c&oacute;digo HTML en el mensaje introductorio particularizado de debajo (debe marcar la casilla 'Usar Mensaje particularizado' de arriba). <br><br>Marcando la casilla de 'Usar c&oacute;digo HTML' los emails se enviar&aacute;n como  Content-Type:text/html MIME format!");
DEFINE("_DM_CUST_INTRO_MESSAGE","Mensaje de introducci&oacute;n particularizado:");
DEFINE("_DM_CUST_INTRO_MESSAGE_INFO","<br>Introduzca un mensaje introductorio particularizado para los emails enviados por RecommendFriends. Aparecer&aacute; antes del mensaje del usuario(opcional) que puede escribir el usuario antes de enviarlos emails.<br><br>Si marca la casilla pero el mensaje particularizado est&aacute; en blanco, NO se usar&aacute; ninguno.<br>");
DEFINE("_DM_CUST_INTRO_MESSAGE_INFO_2","**<b><u>NOTA</u></b>** Puede usar cualquier c&oacute;digo HTML en el mensaje particularizado. El &aacute;rea de texto de arriba eliminar&aacute; las l&iacute;neas en blanco o vac&iacute;as, por lo que necesita incluir formateado <b>TOTAL</b> del HTML usando estilos en-linea, incluyendo los saltos de l&iacute;nea adecuados tales como &lt;p&gt;text&lt;/p&gt; o &lt;br /&gt; para los saltos de l&iacute;nea, estilos para todas las propiedades de los tipos de letra, colores, etc.  Puede incluso incluir im&aacute;genes en el email, asegur&aacute;ndose de incluir la ruta COMPLETA a esta, por ejemplo, &lt;img src='http://www.yoursite.com/images/emailpicture.jpg'&gt;. <b>NO</b>  debe incluir cualquier apertura o cierre &lt;html&gt;, &lt;head&gt; o &lt;body&gt; tags.  Tambi&eacute;n debe tener en cuenta que <b>NO</b> puede usar c&oacute;digo Javascript o PHP en este campo.");
DEFINE("_DM_CUST_INTRO_MESSAGE_INFO_3","**<b><u>NOTA</u></b>** Debe usar S&Oacute;LO texto plano en la casilla de arriba. NO puede usar c&oacute;digo Javascript o PHP en ella(puede usar c&oacute;digo HTML si ha marcado la casilla de arriba 'Usar c&oacute;digo HTML')");

/////////////////////// Administration - Front End Form Display Formatting Configuration
DEFINE("_DM_MAIN_FORMAT","Configuraci&oacute;n del Formato de Muestra del  Front End:");
DEFINE("_DM_CONFIG_SAVED","los ajustes de la configuraci&oacute;n se han guardado");

/////////////////////// Form Fields Sizes
DEFINE("_DM_FORM_SIZE_INFO","<b>Ancho de los campos</b> - indique el ancho de las casillas de Nombre e Email mostrados en el Front End");
DEFINE("_DM_FORM_NAME","Ancho de la casilla <b>Nombre</b> del usuario y amigos: ");
DEFINE("_DM_FORM_EMAIL","Ancho de la casilla <b>Email</b> del usuario y amigos: ");
DEFINE("_DM_FORM_MESSAGE_SIZE","Tama&ntilde;o del Mensaje");
DEFINE("_DM_FORM_ROWS","&Aacute;rea de texto del mensaje del usuario #Filas: ");
DEFINE("_DM_FORM_COLS","&Aacute;rea de texto del mensaje del usuario #Columnas: ");
DEFINE("_DM_FORM_DEFAULT","por defecto");

/////////////////////// Form Fields Colors
DEFINE("_DM_MAIN_FORM","<b>Apariencia de las casillas de los formularios</b> - configure los colores del texto y del fondo de las casillas de RecommendFriends (elimine el n&uacute;mero de color o seleccione 'NO COLOR' si desea usar el estilo CSS de la plantilla - tenga en cuenta que el CSS de Admin es probablemente diferente del CSS del Front End):");
DEFINE("_DM_MAIN_FORMBG","Color del fondo:");
DEFINE("_DM_MAIN_FORMTX","Color del texto:");
DEFINE("_DM_PREVIEW","Vista previa del formato (Pulse 'Guardar' para actualizar los cambios)");
DEFINE("_DM_PREVIEW_TEXT","Textodeejemplo@Sudominio.com - 1234567890");

/////////////////////// Validation Errors
DEFINE("_DM_MAIN_ERROR_INFO","<b>Apariencia Remarcada de las casillas de error</b> - configure los colores de texto y del fondo de los campos que producen error de validaci&oacute;n. Esto no se controla por el estilo CSS por defecto (elimine el n&uacute;mero de color o seleccione 'NO COLOR' si no desea cambiar los colores):");
DEFINE("_DM_ERROR_TEST","Probar");
DEFINE("_DM_ERROR_RESET","Resetear");
DEFINE("_DM_ALERT_TEST","Los colores del texto y del fondo deben haber sido cambiados");

/////////////////////// Logged In Users
DEFINE("_DM_LOGGED_INFO","<b>Apariencia de las casillas Nombre de usuario e Email</b> - configure como aparece el nombre de usuario e email para un usuario registrado (elimine el n&uacute;mero de color o seleccione 'NO COLOR' si desea usar el estilo CSS de la plantilla - tenga en cuenta que el CSS de Admin es probablemente diferente del CSS del Front End):");
DEFINE("_DM_LOGGED_USER","El nombre de usuario");
DEFINE("_DM_LOGGED_EMAIL","Nombredeusuario@Sudominio.com");

/////////////////////// Captcha Configuration
DEFINE("_DM_CAP_TITLE","Configuraci&oacute;n de la imagen Captcha de seguridad");
DEFINE("_DM_GDFT_HALF","<font color='green'><b>El Soporte de GD</b></font> est&aacute; habilitado pero <font color='red'><b>el Soporte de FreeType</b></font> no parece estar habilitado en su servidor.");
DEFINE("_DM_GDFT_NO","Ambos, <font color='red'><b>el Soporte de GD</b></font> y <font color='red'><b>el Soporte de FreeType</b></font> NO parecen estar habilitados en su servidor.");
DEFINE("_DM_GREAT_NEWS","BUENAS NOTICIAS");
DEFINE("_DM_GDFT_YES","<font color='green'><b>El Soporte de GD</b></font> y <font color='green'><b>el Soporte de FreeType</b></font> est&aacute;n ambos <b>Habilitados</b> en su servidor.&nbsp;&nbsp;La opci&oacute;n Captcha funcionar&aacute; correctamente.");
DEFINE("_DM_GD_WARNING","<<<<<<<<<<<<&nbsp;&nbsp;&nbsp;ATENCI&Oacute;N&nbsp;&nbsp;&nbsp;>>>>>>>>>>>>");
DEFINE("_DM_GD_OPTIONS","Desafortunadamente, parece que la opci&oacute;n Captcha NO funcionar&aacute; en este servidor.<br><br> <b>**NOTA** Puede a&uacute;n usar la componente RecommendFriends</b>, pero no puede usar la opci&oacute;n Captcha de abajo. Debe ser 'DESMARCADA'. Pida a su proveedor de alojamiento web que habilite el soporte de GD y de FreeType si necesita Captcha.");
DEFINE("_DM_CAP_USE","Usar la seguridad Captcha:");
DEFINE("_DM_CAP_USE_INFO","Marque esta casilla si desea habilitar la verificaci&oacute;n de seguridad Captcha.");
DEFINE("_DM_CAP_1","Opciones de la imagen principal");
DEFINE("_DM_CAP_2","Ancho de la imagen (pixels)");
DEFINE("_DM_CAP_3","Alto de la imagen (pixels)");
DEFINE("_DM_CAP_4","Rotar la imagen aleatoria (+/-10 grados)");
DEFINE("_DM_CAP_ROTATE","Compruebe si desea la imagen rotada");
DEFINE("_DM_CAP_6","No");
DEFINE("_DM_CAP_7","Opciones de color de la imagen");
DEFINE("_DM_CAP_COLOR_BUTTON","Seleccionar");
DEFINE("_DM_CAP_COLOR_NEW","Nuevo: ");
DEFINE("_DM_CAP_COLOR_ASIS","Poner: ");
DEFINE("_DM_CAP_8","Color de fondo");
DEFINE("_DM_CAP_9","Color del texto");
DEFINE("_DM_CAP_10","Color del ruido");
DEFINE("_DM_CAP_11","Opciones del tipo de letra");
DEFINE("_DM_CAP_12","Elija el tipo de letra a mostrar");
DEFINE("_DM_CAP_13","MonoFont.ttf");
DEFINE("_DM_CAP_14","ComicBook.ttf");
DEFINE("_DM_CAP_15","OldCentury.ttf");
DEFINE("_DM_CAP_16","N&uacute;mero de car&aacute;cteres a mostrar");
DEFINE("_DM_CAP_SAMPLE","Ejemplo de imagen Captcha con las opciones seleccionadas<br />(Pulse 'Guardar' para actualizar la imagen con las nuevas opciones)");

/////////////////////// User Custom Message Options
DEFINE("_DM_USER_MESSAGE","Permitir mensaje del usuario:");
DEFINE("_DM_USER_MESSAGE_CHECK"," Marque esta casilla para permitir que el usuario pueda incluir un mensaje.");
DEFINE("_DM_USER_MESSAGE_HTML","Permitir c&oacute;digo HTML en el mensaje del usuario:");
DEFINE("_DM_USER_MESSAGE_HTML_INFO"," Marque esta casilla para permitir al usuario el uso de c&oacute;digo HTML en su mensaje (se debe activar la casilla de arriba 'Permitir mensaje del usuario'). Al marcar la casilla los emails se enviar&aacute;n como Content-Type:text/html MIME format.  <br><br>**<b><u>NOTA</u></b>**: Esto puede causar problemas en algunas webs/servidores y el c&oacute;digo HTML no v&aacute;lido puede romper los emails. Si esto ocurre, simplemente inhabilite la opci&oacute;n 'Permitir c&oacute;digo HTML en el mensaje del usuario'.");

/////////////////////// Administration - Edit Langauge File
DEFINE("_DM_EDIT_LANG_HEADER","Configurar/Editar el fichero de Idioma");
DEFINE("_DM_EDIT_LANG","Pulse aqu&iacute; para editar el fichero de idioma");
DEFINE("_DM_EDIT_LANG_INFO","Puede cambiar CUALQUIER texto en esta componente, para ambos, los textos del Front-End y los de Administraci&oacute;n, editando el fichero de idioma incluido. &iexcl;Pru&eacute;belo! Simplemente pulse en el enlace de abajo.");
DEFINE("_DM_LANG_EMPTY","No se puede completar la operaci&oacute;n. El fichero de idioma est&aacute; vac&iacute;o.");
DEFINE("_DM_LANG_IS_NOT_WRITEABLE","No se puede completar la operaci&oacute;n. El fichero de idioma no es escribible.");
DEFINE("_DM_LANG_SAVED","El fichero de idioma se ha guardado.");
DEFINE('_DM_LANG_FILE','El fichero de idioma: ');
DEFINE("_DM_LANG_IS","es");
DEFINE("_DM_WRITEABLE","ESCRIBIBLE");
DEFINE("_DM_UNWRITEABLE","NO ESCRIBIBLE");
DEFINE("_DM_MAKE_UNWRITEABLE","&iquest;Marcar el fichero de idioma como no escribible despu&eacute;s de guardar? (Puede sobreescribir este fichero desde esta p&aacute;gina otra vez si necesita hacer m&aacute;s cambios)");
DEFINE("_DM_OVERRRIDE_UNWRITEABLE","&iquest;Ignorar la protecci&oacute;n contra escritura al guardar? (Debe de marcar la casilla para guardar cualquier cambio que haya hecho)");

/////////////////////// Administration - Email Preview
DEFINE("_DM_EMAIL_PREVIEW","D-Mack RecommendFriends Email Preview   -   Click <b>**<u>Save</u>**</b> first to update this page to see any changes you have made...");
DEFINE("_DM_SUBJECT_IN_EMAIL","Asunto del email:");
DEFINE("_DM_PREVIEW_SUBJECT","Su amigo <b><i>Nombre del Usuario</i></b> quiere que visite <b><i> %s </i></b><br />");
DEFINE("_DM_PREVIEW_SHORT_INTRO","Introducci&oacute;n corta:");
DEFINE("_DM_PREVIEW_USER_INFO","<b><i>Nombre del usuario</i></b> (<b><i>Email del usuario</i></b>) piensa que puede estar interesado en esta web - <b><i> %s </i></b>");
DEFINE("_DM_PREVIEW_ADMIN_MESSAGE","Mensaje particularizado (si se usa):");
DEFINE("_DM_PREVIEW_ADMIN_MESSAGE_BLANK","&nbsp;<b><i><font color='red'>***ATENCI&Oacute;N***</font></i></b> Ha habilitado la opci&oacute;n de mensaje particularizado pero el campo del mensaje est&aacute; en blanco.");
DEFINE("_DM_PREVIEW_LINK","Enlace a la web:");
DEFINE("_DM_PREVIEW_LINK_INFO","Visite la web en: <b><i> %s </i></b>");
DEFINE("_DM_PREVIEW_USER_MESSAGE","Mensaje del usuario (si se usa):");
DEFINE("_DM_PREVIEW_USER_MESSAGE_INFO","Mensaje personal de <b><i>Nombre del usuario</i></b>:");
DEFINE("_DM_PREVIEW_USER_MESSAGE_INFO2","<b><i>Aqu&iacute; el mensaje del usuario</i></b>");


/////////////////////// Administration - Information Page
DEFINE("_DM_PROGRAM","
    <i><b><font size='4'>
Programa
    </font></b></i><br /><br />
D-Mack RecommendFriends Version v2.0.3 - 06-January-2009 es una componente que permite a los usuarios de una web recomendar esta a sus amigos.
    <br /><br />
Puede enviar m&uacute;ltiple emails, cuyo n&uacute;mero se define en la Administraci&oacute;n, con el nombre del amigo, y copia al Administrador y/o al Usuario.  Tambi&eacute;n incorpora Seguridad Captcha para ayudar a prevenir el spam y la opci&oacute;n de enviar en formato HTML.  TODOP el fichero de idioma de la componente completa, front end y back, se puede editar on-line desde el Admin.  Y la componente es v&aacute;lida <b>XHTML 1.0 Transitional</b>.
    <br /><br />
Esta componente usa funciones est&aacute;ndar Joomla! <b>JFactory Mailer</b> las cuales deben funcionar si los ajustes de email de su web est&aacute;n correctamente configurados para su servidor web (esto es, Sendmail, PHPMailer, SMTP, etc).
    <br /><br />
Esta es una componente 100% gratuita (GNU/GPL License) - Se le permite <i>ABSOLUTAMENTE</i> modificar cualquier fichero a su gusto.  Lo &uacute;nico que pido es que se me comunique si ha mejorado el programa, de forma que yo tambi&eacute;n pueda hacerlo y resuministrarlo a la comunidad. Gracias.
    <br /><br />
Si tiene alguna sugerencia o encuentra alg&uacute;n error, por favor, cont&aacute;ctenos por email: info@dmackmedia.com
    <br /><br />
");
DEFINE("_DM_CONFIG_INFO","
    <i><b><font size='4'>
Configuraci&oacute;n del Programa
    </font></b></i><br /><br />
En esta versi&oacute;n (RecommendFriends v2.0.3 - 06-January-2009) hay un gran n&uacute;mero de par&aacute;metros configurables de la componente.
    <ul>
    <li>
El Administrador puede indicar cuantos 'Campos Email' se muestran en el Front End.
    <br /><br /></li>
    <li>
Es posible seleccionar que direcciones aparecen para 'Desde' y 'Responder'. Si se selecciona, las direcciones (marcado), las direcciones 'Desda' <u>y</u> 'Responder' de los emails enviados a amigos se enviar&aacute;n al Usuario. Si NO se selecciona, la direcci&oacute;n 'Desde' ser&aacute; la del Administrador de la web y la direcci&oacute;n 'Responder' ser&aacute; la del usuario.<br /><br /></li>
    <li>
Es posible indicar si el Administrador de la web debe recibir una copia ciega (Bcc) de cada email enviado a los 'Amigos' del usuario.  Si tiene una web muy grande, con muchos usuarios activos, puede que desee deshabilitar esta opci&oacute;n ya que puede recibir muchos emails.  Si la selecciona, el email del Administrador se pondr&aacute; el el campo Bcc con lo que no ser&aacute; visible a los otros receptores del email.
    <br /><br /></li>
    <li>
Puede cambiar o personalizar el campo 'Asunto' de los emails. Hay una casilla que determina si se usa el asunto personalizado o no.  Desafortunadamente, actualmente no puede usar etiquetas personalizadas o formateo. Debe ser texto plano.
    <br /><br /></li>
    <li>
Tambi&eacute;n puede usar un mensaje introductorio personalizado para los emails enviados a Amigos.  Hay una casilla para esto que habilitar&aacute;/deshabilitar&aacute;el uso de un mensaje introductorio personalizado.  Esto puede ser una forma excelente de conseguir m&aacute;s usuarios de su web.  Puede indicar las caracter&iacute;sticas y beneficios de su web que, esperamos, le haga ganar nuevos usuarios.  Si esta se basa en un programa de 'Referidos', este ser&aacute; un excelente sitio para indicar como funciona, los beneficios de adherirse a &eacute;l y explicar los beneficios para el usuario que envi&oacute; los emails de  RecommendFriends.
    <br /><br /></li>
    <li>
Existe tambi&eacute;n una opci&oacute;n para permitir/no permitir que se use c&oacute;digo HTML en la introducci&oacute;n personalizada.  Al habilitar esta opci&oacute; los emails se enviar&aacute;n en formato Content-Type:text/html MIME.  Puede usar cualquier c&oacute;digo HTML en el mensaje, pero NO puede usar otros c&oacute;digos (PHP, Javascript, etc.).
    <br /><br /></li>
        <li>
Hay muchas formas de cambiar la apariencia de los campos de formulario en el front end.  Puede indicar el ancho de los campos nombre e email, as&iacute; como del campo del mensaje del usuario.  Mediante el uso de selectores de color puede cambiar estos para el texto y el fondo, para el fondo y el texto del mensaje de validaci&oacute;n y el fondo y texto que muestra el nombre de usuario e email para los usuarios que est&aacute;n registrados.
    <br /><br /></li>
        <li>
RecommendFriends v2.0.3 - 06-January-2009 tambi&eacute;n incluye seguridad Captcha.  <b><u>*NOTA*</u></b>: Su servidor web *DEBE* tener habilitadas las librer&iacute;as GD as&iacute; como tipos de letra True Type.  Puede elegir si desea usarlo o no, as&iacute; como muchas opciones de la imagen que incluyen su ancho, altura, rotaci&oacute;n del texto, colores, color de ruido, tipo de letra y n&uacute;mero de caracteres a mostrar en la imagen.
    <br /><br /></li>
    <li>
** TODO ** el texto mostrado en las pantallas de esta componente, incluyendo el front-end, texto de configuraci&oacute;n del Admin y lo que est&aacute; leyendo ahora, se obtiene del fichero de idioma en la carpeta '/includes', y puede ser editado **ON-LINE** con la componente.  T&oacute;mese la libertad de modificarlo como desee, y si lo ha traducido a otro idioma (distinto del Ingl&eacute;s), por favor, cont&aacute;cteme de forma que pueda incluirlo en la distribuci&oacute;n de la componente. Gracias.
    <br /><br /></li>
    <li>
ahora con varios ficheros de idioma:
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
Como enlazar la componente
    </font></b></i><br />
      <Table align='center' width='100%' cellpadding='12'>
        <tr>
          <td width='100%' align='left'>
            <p style='margin-top: 0; margin-bottom: 0'>Para a&ntilde;adir un enlace al Men&uacute; Principal (mainmenu) y desea que todo el mundo (Public) tenga acceso a esta componente, siga los pasos siguientes:</p>
            <ol style='font-family: Arial; font-size: 8pt'>
              <li>En la parte superior pulse en 'Men&uacute;s - Enlace Men&uacute; principal</li>
              <li>Pulse en 'Nuevo' en la parte superior derecha de la pantalla</li>
              <li>Elija de la lista lacomponente 'D-Mack Recommend Friends'</li>
              <li>Escriba un nombre del enlace</li>
              <li>Escriba un Alias del enlace</li>
              <li>NO necesita cambiar el elemento 'Padre'</li>
              <li>Marque el circulo 'Publicado'</li>
              <li>Aseg&uacute;rese que el nivel de acceso est&aacute; a 'Publico'</li>
              <li>Y finalmente pulse 'Guardar'</li>
            </ol>
            <p style='margin-top: 0; margin-bottom: 0'>Para a&ntilde;adir un enlace al Men&uacute; de usuario y desea que s&oacute;lo los usuarios 'Registrados' puedan usar esta componente, siga estos pasos:</p>
            <ol style='font-family: Arial; font-size: 8pt'>
              <li>En la parte superior pulse en 'Men&uacute;s - Enlace Men&uacute; de usuario</li>
              <li>Siga los pasos 2 a 7 de arriba</li>
              <li>Aseg&uacute;rese que el nivel de acceso est&aacute; a 'Registrados'</li>
              <li>Y finalmente pulse 'Guardar'</li>
            </ol>
            <p style='margin-top: 0; margin-bottom: 0'>&nbsp;</p>
            <p style='margin-top: 0; margin-bottom: 0'>Tambi&eacute;n puede configurar los par&aacute;metros de esta componente pulsando en la parte superior: Componentes  >>  Recommend Friends  >>  Configuration.</p>
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