<?php
/**
 * @version		$Id: fckeditor.php 1154 18-1-2008 andrew
 * @package		JoomlaFCK
 * @copyright	Copyright (C) 2006 - 2009 WebXSolution Ltd. All rights reserved.
 * @license		Creative Commons Licence <http://www.joomlafckeditor.com/index.php?option=com_content&view=article&id=5&Itemid=2>
 * Ths application has been written by WebxSolution Ltd.  You may not copy or distribute JoomlaFCK without written consent
 * from WebxSolution Ltd.
 */

// Do not allow direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport('joomla.event.plugin');

/**
 * fckeditor Lite for Joomla! WYSIWYG Editor Plugin
 *
 * @author WebxSolution Ltd <andrew@webxsolution.com>
 * @package Editors
 * @since 1.5
 */
class plgEditorFckeditor extends JPlugin {

	/**
	 * Constructor
	 *
	 * For php4 compatability we must not use the __constructor as a constructor for plugins
	 * because func_get_args ( void ) returns a copy of all passed arguments NOT references.
	 * This causes problems with cross-referencing necessary for the observer design pattern.
	 *
	 * @param 	object $subject The object to observe
	 * @param 	array  $config  An array that holds the plugin configuration
	 * @since 1.5
	 */
	 
	 
	var $_isInline = 0;
	var $_bodyStyles = "";
	var $_template = "";
	var $_path_root = "";
	 
	 
	function plgEditorFckeditor(& $subject, $config) {
		parent::__construct($subject, $config);
	}

	/**
	 * Method to handle the onInitEditor event.
	 *  - Initializes the fckeditor Lite WYSIWYG Editor
	 *
	 * @access public
	 * @return string JavaScript Initialization string
	 * @since 1.5
	 */
	function onInit()
	{
		
		$doc = & JFactory::getDocument();
		$doc->addStyleDeclaration("table.admintable {width: 100%;}");
		
  		return '<script type="text/javascript" src="'.JURI::root().'plugins/editors/fckeditor/fckeditor.js"></script>';
			
	}

	/**
	 * fckeditor Lite WYSIWYG Editor - get the editor content
	 *
	 * @param string 	The name of the editor
	 */
	function onGetContent( $editor ) {
	
	
			
		return " FCKeditorAPI.GetInstance('$editor').GetHTML(); ";
	}

	/**
	 * fckeditor Lite WYSIWYG Editor - set the editor content
	 *
	 * @param string 	The name of the editor
	 */
	function onSetContent( $editor, $html ) {
		return " oFCKeditor.InsertHtml = '" .  htmlentities($html) . "'";
	}

	/**
	 * fckeditor Lite WYSIWYG Editor - copy editor content to form field
	 *
	 * @param string 	The name of the editor
	 */
	function onSave( $editor ) { /* We do not need to test for anything */	}

	/**
	 * fckeditor Lite WYSIWYG Editor - display the editor
	 *
	 * @param string The name of the editor area
	 * @param string The content of the field
	 * @param string The name of the form field
	 * @param string The width of the editor area
	 * @param string The height of the editor area
	 * @param int The number of columns for the editor area
	 * @param int The number of rows for the editor area
	 * @param mixed Can be boolean or array.
	 */
	function onDisplay( $name, $content, $width, $height, $col, $row, $buttons = true )
	{
		// Load modal popup behavior
		JHTML::_('behavior.modal', 'a.modal-button');
		
		// Only add "px" to width and height if they are not given as a percentage
		if (is_numeric( $width )) {
			$width .= 'px';
		}
		if (is_numeric( $height )) {
			$height .= 'px';
		}

		jimport('joomla.environment.browser');
		$instance	=& JBrowser::getInstance();
		$language	=& JFactory::getLanguage();
		$db			=& JFactory::getDBO();
		
		

		if ($language->isRTL()) {
			$direction = 'rtl';
		} else {
			$direction = 'ltr';
		}
		
		/*
		 * Lets get the default template for the site application
		 */
		$query = 'SELECT template'
			. ' FROM #__templates_menu'
			. ' WHERE client_id = 0'
			. ' AND menuid = 0'
			;
		$db->setQuery( $query );
		$template = $db->loadResult();
		
		$this->_template = $template;
		
		/* Need to check to see  seesion recordd already created */
			
		$ip = md5($_SERVER['REMOTE_ADDR']);
		$query ='select session_id from #__session where session_id =\'' .$ip .'\''; 
		$db->setQuery( $query);
		$ip_recorded = $db->loadResult();
		
		
		if(!isset($ip_recorded)) //lets  record IP address
		{
		    
		   	$query = 'insert into #__session(time,session_id,gid,client_id,data) values(\'' . (time() + 7200) . '\',\'' . $ip  . '\',0,0,\''
			. session_id() . '\')';
			$db->Execute( $query );
		}
		
		else // update time and  user session_id 
		{
		   	$query = 'update #__session set time = \'' . (time() + 7200) . '\',data = \'' . session_id() . '\' ' 
			.'where session_id =\'' .$ip .'\''; 
			$db->Execute( $query );  
	                     
		}
		
		/* Load the FCK's Parameters */
		$toolbar 			=	$this->params->def( 'toolbar', 'Advanced' );
		$toolbar_ft 		=	$this->params->def( 'toolbar_ft', 'Advanced' );
		$skin				= 	$this->params->def( 'skin', 'office2003' );
		$image_path			=	$this->params->def( 'imagePath', 'images/stories' );
		$text_direction		=	$this->params->def( 'text_direction', 'ltr' );
		$wwidth				=   $this->params->def( 'wwidth', '100%' );
		$hheight			= 	$this->params->def( 'hheight', 480 );
		$lang_mode			= 	$this->params->def( 'lang_mode', 0 );
		$lang				= 	$this->params->def( 'lang_code', 'en' );
		$entermode 			= 	$this->params->def( 'entermode', 1 );
		$shiftentermode 	= 	$this->params->def( 'shiftentermode', 0 );
		$crtlshiftentermode = 	$this->params->def( 'ctrlshiftentermode', 2 );
		$htmlentities 		= 	$this->params->def( 'htmlentities', 1 );
		$includelatinentities = $this->params->def( 'includelatinentities', 0 );
		$includegreekentities = $this->params->def( 'includegreekentities', 0 );
		$numericentities 	= 	$this->params->def( 'numericentities', 0 );
		$bgcolor 			= 	$this->params->def('bgcolor','#FFFFFF');
		$fontcolor 			= 	$this->params->def('fontcolor','');
		$useRelativeURLPath = 	$this->params->def( 'UserRelativeFilePath', 0 );
		$textAlign 			= 	$this->params->def( 'TextAlign', '' );
		$showerrors 		= 	$this->params->def( 'showerrors', 1 );
	

	
		// initialise $error varable
		$errors = '';
			
		//set default view for toolabar
		$toolbar = $toolbar == 'Default' ? 'Advanced' : $toolbar;
		$toolbar_ft = $toolbar_ft == 'Default' ? 'Advanced' : $toolbar_ft;
		
		
		//set flag to see if Pspell should be enabled
		$enablePspell = intval(function_exists("pspell_check")  ? 1 : 0);
	
		$hasRoot = 0;

		$this->_path_root = '../';

   		if(!strpos(JPATH_BASE,'administrator'))
		{
		  	//set toolbar to compact mode
			$toolbar = $toolbar_ft;
			
			$this->_path_root = '';
		}

	    //check to see if we have to change the install chmod settings
		$this->changeChmod();
		
		
	  	//Sanitize image path
	  	 $image_path = preg_replace('/(^\/|\/$)/','',$image_path);
	       
		/* Check on the users enteries to ensure that they are correct */
		
		
		//$lastCharacter = substr( $image_path, (strlen( $image_path ) - 1), strlen($image_path) );
		
		//if( $lastCharacter != '/' && $lastCharacter != '\\' ){
		//	$image_path .= '/';
		//}//end if
		/* Check on the users enteries to ensure that they are correct */
		//$firstCharacter = substr( $image_path, 0, 1 );
		//if( $firstCharacter != '/' && $firstCharacter != '\\' ){
		//	$image_path = '/' . $image_path;
		//}//end if	
		/* Check to see if the path exists. */
		
      
	  
	     //check if a article has been set up and create one if there is none
	  	$msg = JFCKGroupFilter::check($db);
		if($msg) 
			echo $msg;		
		
		// If language mode set 
		
	    // set default Joomla language setting
		 switch ($lang_mode)
		 {
			 case 0:
				 $AutoDetectLanguage = 	0; // User selectiom
				 break;
			 case 1:
			 	$AutoDetectLanguage = 	0; // Joomla Default
				$lang = substr( $language->getTag(), 0, strpos( $language->getTag(), '-' ) ); //access joomlas global configuation and get the language setting from there
				break;
			 case 2:
			 	$AutoDetectLanguage = 	1; // Browser default
 				break; 
		 }
		 
		// Define Enter & Shift Enter Mode
		 $enterbehavior = array();
		 $enterbehavior[0] = 'br';
		 $enterbehavior[1] = 'p';
		 $enterbehavior[2] = 'div';

		// Define Entities
		$htmlentities	= $htmlentities ? 'true' : 'false';
		$includelatinentities	= $includelatinentities ? 'true' : 'false';
		$includegreekentities	= $includegreekentities ? 'true' : 'false';
		$numericentities	= $numericentities ? 'true' : 'false';


     
		$BaseAddCSSPath = '';
		$style_css = '';
        $stylesheet_name = '';
		
		$sitePath = preg_replace('/\/$/','',JURI::root());
	
	  	
		 if(!$errors)	
			$content_css = $this->_getTemplateCss($template,$BaseAddCSSPath,$style_css,$stylesheet_name,$errors);
		
      /* Generate the Output */
	  
		$html = '
		<textarea name="'.$name.'" id="'.$name.'" cols="75" rows="20" style="width:100%; height:350px;">' .$content.   '</textarea>';
		
		$doc = & JFactory::getDocument();
		$doc->addScriptDeclaration(
		    'function DisplayEditor' . $name . '() {
			var oFCKeditor = new FCKeditor("'.$name.'");
			oFCKeditor.BasePath = "'.JURI::root() .'plugins/editors/fckeditor/" ;
			oFCKeditor.Config["SitePath"] =  "'. $sitePath.'";
			oFCKeditor.Config["ImagePath"] =  "'. $image_path.'"; 
			oFCKeditor.Config["UseRelativeURLPath"] =  "'. $useRelativeURLPath.'"; 
			oFCKeditor.ToolbarSet = "'.$toolbar.'" ;
      		oFCKeditor.Config["EnterMode"] = "'.$enterbehavior[$entermode].'";
      		oFCKeditor.Config["ShiftEnterMode"] = "'.$enterbehavior[$shiftentermode].'";
			oFCKeditor.Config["CrtlShiftEnterMode"] = "'.$enterbehavior[$crtlshiftentermode].'";
      		oFCKeditor.Config["BaseAddCSSPath"] = "'. $BaseAddCSSPath.'";
			oFCKeditor.Config["EditorAreaCSS"] = "'. (!$this->_isInline ? $content_css : '' ) .'";
			oFCKeditor.Config["ContentLangDirection"] = "'.$direction.'" ;
			oFCKeditor.Config["AutoDetectLanguage"]  ="'. $AutoDetectLanguage .'";
			oFCKeditor.Config["DefaultLanguage"] = "'.$lang.'" ;
			oFCKeditor.Config["ProcessHTMLEntities"] = '.$htmlentities.' ;
			oFCKeditor.Config["IncludeLatinEntities"] = '.$includelatinentities.' ;
			oFCKeditor.Config["IncludeGreekEntities"] = '.$includegreekentities.' ;
			oFCKeditor.Config["ProcessNumericEntities"] = '.$numericentities.' ;
			oFCKeditor.Config["SkinPath"] = oFCKeditor.BasePath + "editor/skins/" + "'.$skin.'" + "/" ;
			oFCKeditor.Config["StylesXmlPath"]=  oFCKeditor.BasePath + "'.$style_css.'";
			oFCKeditor.Config["AddStylesheets"] = "'.$stylesheet_name.'";
			oFCKeditor.Config["BackgroundColor"] = "'.$bgcolor.'";
			oFCKeditor.Config["FontColor"] = "'.$fontcolor.'";		
			oFCKeditor.Config["Pspell"] = "'.$enablePspell.'";	
			oFCKeditor.Config["ForceInlineStyles"] = '. $this->_isInline .';
			oFCKeditor.Config["JTemplate"] = "'. $this->_template .'";
            oFCKeditor.Config["BodyStyles"] = "'. $this->_bodyStyles .'";
			oFCKeditor.Config["TextAlign"] = "'.$textAlign.'";	
			oFCKeditor.Config["UseAspell"] = '.  $enablePspell .';
			oFCKeditor.Width = "'.$wwidth.'" ;
		/*	oFCKeditor.Style_css ="'.$style_css.'" ; */
			oFCKeditor.Height = "'.$hheight.'" ;
			function ReplaceTextHeader()
			{
				oFCKeditor.ReplaceTextarea();
			}
				
			function RenderEditor() 
			{
			 
			  if(navigator.userAgent.indexOf("MSIE") >= 0)
			  {

			  	window.addEvent(\'domready\',ReplaceTextHeader);
			  }
			  else
			  {
			  	 ReplaceTextHeader();
			  }	
			}
			
			/* oFCKeditor.ReplaceTextarea();*/
			RenderEditor();}');
		  
		
  		$html .= '<script type="text/javascript">DisplayEditor'. $name . '()</script>';
		
		/* Add Joomla's Buttons */
		$html .= $this->_displayButtons($name, $buttons);

		
			
		$my = JFactory::getUser();		
		if( $showerrors && ( $my->usertype == 'Super Administrator' || $my->usertype == 'Administrator' ) ){
			//Version Checker
			if( function_exists( "curl_init" ) ){
				$ch = curl_init();	curl_setopt( $ch, CURLOPT_URL, 'http://www.joomlafckeditor.com/jversion.txt' );	curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );
				$version = curl_exec($ch); curl_close( $ch ); if( $version != '2.6.4' && $version ){ $errors .= 'Please be aware there is a newer version of the JoomlaFCK Editor which can be downloaded from <a href="http://www.joomlafckeditor.com" target="_blank">http://www.joomlafckeditor.com</a>.<br/>'; }//end if
			}//end if
			
			if( !is_dir( JPATH_SITE . '/' . $image_path) && $my->gid > $gid ){
				$errors .= '<span style="color: red;">Warning: ' . JPATH_SITE . '/' . $image_path . ' does not appear to be a valid directory!</span><br/>';
			}//end if
			
			if( $errors !== "" ){
				$adminMessage =  '<span style="color:blue">Please note the above message will only displayed to Administrators and above and cam be turned off in the Plugins Advance settings.</span>';			
				$html = $errors . $adminMessage . $html;
			}
		}//end if

		return $html;
	}
	
	function xml_writer($txt_filename = "" ,$xml_filename = "")
 	{
 	
   		global $main, $elem, $prop, $nam,$val,$option;  	
	
	
		/* echo '<span style="color: green;">Writing: ' . $txt_filename . ' to: '. $xml_filename .'</span><br/>'; */
		/* When was the files last modified? */
		$xml_str="<?xml version=\"1.0\" encoding=\"utf-8\" ?>
					<Styles>";
					
					
		$elem=array();
		$nam = array();
		
		$dir = dirname($xml_filename);
		
				
		$perms  = decoct(fileperms($this->_path_root . 'index.php') & 0777);
				
		switch($perms)
		{
			case 666:	$perms = 777;
						break;									
			case 644:   $perms = 755;
		}
			
	    if(!stristr(PHP_OS,'WIN') && $perms != decoct(fileperms($dir) & 0777))
		{	
			$oldumask = umask(0) ;	

			if($perms == 755)
			{ 
				@chmod( $dir, 0755);
				@chmod( $xml_filename, 0644);
			}
			else
			{
				@chmod( $dir, 0777);
				@chmod ($xml_filename,0666);
			}
			
			umask( $oldumask ) ;	
	    }
			
	
		$reader =& JFCKeditorHelper::getOptionXMLReader();
		
			
		$this->_isInline = intval($reader->checkOption($option));
		
	
		if($this->_isInline)
		{	
			$f = file_get_contents($txt_filename);
		

			$val = array();
			
			$this->extract_inline_css_elements($f,dirname($txt_filename));
				
		
			if(count($val))
			{
				foreach($val as $key=>$value)
				{
					if($elem[$key] == "body")
					{
					 	$this->_bodyStyles = $value .';' . $this->_bodyStyles;
					} 
		            elseif($val !== "offline"){
						$xml_str.='<Style name="'.$nam[$key].'" element="'.$elem[$key].'">
										<Attribute name="style" value="'.$value.'" />
									</Style>';	
						$xml_str.="\n";
					}//end if
				}//end for loop
			}//end count		
				
	      
		}				
		else	
		{
			$f = file_get_contents($txt_filename);
				
			$prop = array();

			$this->extract_css_elements($f,dirname($txt_filename));
			
			if(count($nam))
			{
				foreach($nam as $k=>$val)
				{
				
				   if($val !== "offline" ){
						$xml_str.='<Style name="'.$val.'" element="'.$elem[$k].'">
										<Attribute name="' . $prop[$k] .'" value="'.$val.'" />
									</Style>';	
						$xml_str.="\n";
					}//end if
				}//end for loop
			}//end count
	
		} 
		      
		$xml_str.="\n"."</Styles>"; 
		
		//write file
		
		//Translate file path as we reuire full path
		$xml_filename = JPATH_ROOT .DS. str_replace('../','/',$xml_filename);
		
		JFile::write($xml_filename,$xml_str);
	
 }//end function
 
	
	function extract_inline_css_elements($f,$dirname = '')
	{
		
		 global $nam,$elem,$val,$dir; 
	   
		 $dir = $dirname;

		preg_replace_callback('/^\s*(?:[a-z0-9\s\b]*)@import\s*(?:url\()?(?:"|\')?([^"\'\)]+)(?:"|\')?\)?;/im',  create_function(
		'$matches', 
		'global $dir;
		 $oldumask = umask(0);
		 @chmod( $matches[1], 0666);
		 umask( $oldumask );
		 $file = file_get_contents($dir ."/" .$matches[1]);
		 plgEditorFckeditor::extract_inline_css_elements($file,$dir);'
		),$f);

		$allowed_elements = array('\.','#','body','div','span','hr','table','td','tr','img','input','textarea');
		
		$f = preg_replace('/\s*body\s*\{/im',"body.default-font{",$f);
		
		
		$elem_list = implode('|',$allowed_elements ); 
		$allowed_elements[0] = '.';
		array_unshift($allowed_elements, "^");
				
		preg_match_all("/\s*(" . $elem_list  . ")?(?:\.|#)?([a-z0-9\.#_\*\-\n\r\t, ]*)(?:\s*\{\s*)([a-z0-9 \._\*\n\r\t\s:;,\-#%\(\)\/]+)(?=\s*\}\s*)/im",$f,$matches,PREG_SET_ORDER   );
		
				
					
		 foreach($matches as $match)
		 {
			
		    $element = trim($match[1]);
			
			$index =array_search($element,$allowed_elements) ;
		
			if($index)
			{
				$element = ($element == '.' || $element == '#') ? 'P' : 	$allowed_elements[$index];
				$match[2] = preg_replace('/(?![a-z0-9,]+\s+)(' . $elem_list .')(?!_)/i', '', $match[2]);
				$names = explode(",",$match[2]);
				$value = trim(preg_replace(array('/\s*;\s*$/','/(\n|\r\|\t)/'), '', $match[3]));
				$value = preg_replace('/([A-Z0-9_;:])\s+/i','$1 ',$value);
				$value = preg_replace('/position:\s*absolute/','position: relative',$value);
				$current_names =  array();	
							
				foreach($names  as $name)
				{
				
					
					$name = trim($name);
				 
			        if (!preg_match('/^[A-Z0-9_\-]+\s+[A-Z0-9_\-]+/i',$name))
					{
					
						$key = array_search($name,$nam);
						if(!in_array($name,$current_names))
						 {
						 
						
							 if(!$key && $name != "" )
							 {
								 array_push($nam,$name);
								 array_push($val,$value);
								 array_push($elem,$element);
							 }
							else if($key && $name != "")  
							{
					
								$val[$key] .= ';' . $value;
							}
							 array_push($current_names,$name);
					
						}
					}
				
				}	
				
				
			}
		}	
		
	}//end function	
	
	
	function extract_css_elements($f,$dirname = '')
	{
		
		 global $nam, $elem,$dir, $prop;
	   
		 $dir = $dirname;
		 
		 
		preg_replace_callback('/^\s*(?:[a-z0-9\s\b]*)@import\s*(?:url\()?(?:"|\')?([^"\'\)]+)(?:"|\')?\)?;/im',  create_function(
		'$matches', 
		'global $dir;
		 $oldumask = umask(0);
		 @chmod( $matches[1], 0666);
		 umask( $oldumask );
		 $file = file_get_contents($dir ."/" .$matches[1]);
		 plgEditorFckeditor::extract_css_elements($file,$dir);'
		),$f);

		$allowed_elements = array('\.','#','div','span','hr','table','td','tr','img','input','textarea');
		
	
		
		
		$elem_list = implode('|',$allowed_elements ); 
		$allowed_elements[0] = '.';
		array_unshift($allowed_elements, "^");
				
		preg_match_all("/\s*(" . $elem_list  . ")?(\.|#)?([a-z0-9\.#_\*\-\n\r\t, ]*)(?:\s*\{\s*)(?:[a-z0-9 \._\*\n\r\t\s:;,\-#%\(\)\/]+)(?=\s*\}\s*)/im",$f,$matches,PREG_SET_ORDER   );
		
		 foreach($matches as $match)
		 {
			$element = trim($match[1]);
			$index =array_search($element,$allowed_elements);
		    $type = '';
			
			if($element == '.' )
			{
				$type = 'class'; 
			}
			else if($element =='#')
			{
			    $type = 'id';
			}		
		    else
			{
				$type =  ($match[2] == '.') ? 'class' : 'id';
			}
			
			if($index)
			{
				$element = ($element == '.' || $element == '#') ? 'P' : 	$allowed_elements[$index];
				$match[3] = preg_replace('/(?![a-z0-9,]+\s+)(' . $elem_list .')(?!_)/i', '', $match[3]);
				$names = 	explode(",",$match[3]);	
				$current_names =  array();	
							
				foreach($names  as $name)
				{
				
					
					$name = trim($name);
				 
			        if (!preg_match('/^[A-Z0-9_\-]+\s+[A-Z0-9_\-]+/i',$name))
					{
					
						$key = array_search($name,$nam);
						if(!in_array($name,$current_names))
						 {
						 
						
							 if(!$key && $name != "" )
							 {
								
								 array_push($nam,$name);
								 array_push($elem,$element);
								 array_push($prop,$type);
							 }
							 array_push($current_names,$name);
					
						}
					}
				
				}	
				
				
			}
		}	
		
	}//end function	
	
	
		
	function onGetInsertMethod($name)
	{
		$doc = & JFactory::getDocument();
		$url = str_replace('administrator/', '', JURI::base() );
		$js= "function jInsertEditorText( text,editor ) {
				var oEditor = FCKeditorAPI.GetInstance(editor) ;
				text = text.replace( /<img src=\"/, '<img src=\"".$url."' );
				oEditor.InsertHtml( text );
		}";
		$doc->addScriptDeclaration($js);

		return true;
	}

	

	function _getTemplateCss($template,& $BaseAddCSSPath,& $style_css,& $stylesheet_name,& $errors )
	{
	
	    //Get parameter options for template CSS
		$content_css		=	$this->params->def( 'content_css', 1 );
		$editor_css			=	$this->params->def( 'editor_css', 0 );
		$content_css_custom	=	$this->params->def( 'content_css_custom', '' );
		$add_stylesheet_path = $this->params->def('add_stylesheet_path','');
    	$add_stylesheet = $this->params->def('add_stylesheet','');
	
	
	
	 	/* Start setting up the XML files */
		$xml_path=  $this->_path_root . "plugins/editors/fckeditor/fckstyles_template.xml";
		$style_css="fckstyles_template.xml";
	
	 
	 	// initialise $error varable
	 	$errors = '';
	
	
		if ( $content_css || $editor_css ) {
			if($editor_css !== 0 & $content_css == 0){
				if( is_file( JPATH_SITE . '/templates/'.$template.'/css/editor.css' ) ){
					$content_css = 'templates/'.$template.'/css/editor.css';
				} else {
					$errors .= '<span style="color: red;">Warning: ' . JPATH_SITE . '/templates/'.$template.'/css/editor.css' . ' does not appear to be a valid file. Reverting to JoomlaFCK\'s default styles</span><br/>';
				}//end if valid file
			} else {
				if( is_file( JPATH_SITE . '/templates/'.$template.'/css/template.css' ) ){
					$content_css = 'templates/'.$template.'/css/template.css';
					
				} 
			
				else if( is_file( JPATH_SITE . '/templates/'.$template.'/css/template.css.php' ) ){
				
				
				   $content_css = 'templates/'.$template.'/css/JFCKeditor.css.php'; 
				  
				   if(!is_file( JPATH_SITE . '/templates/'.$template.'/css/JFCKeditor.css.php') ||  
				   		filemtime(JPATH_SITE . '/templates/'.$template.'/css/template.css.php') > 
						filemtime(JPATH_SITE . '/templates/'.$template.'/css/JFCKeditor.css.php') ) 
				   {
				           
              
						 $file_content = file_get_contents('../templates/'.$template.'/css/template.css.php');
						  
						 $file_content  =  preg_replace_callback("/(.*?)(@?ob_start\('?\"?ob_gzhandler\"?'?\))(.*)/",
						   create_function(
								'$matches',
								'return ($matches[1]) .\';\';'
								
							),$file_content);
						 
						 
						  $file_content = preg_replace("/(.*define\().*DIRECTORY_SEPARATOR.*(;?)/",'',$file_content);
						 					 
     		   
						 $file_content =
						 
						 '<'. '?' . 'php' . ' function getYooThemeCSS() { ' . '?' . '>' . $file_content . '<'. '?' . 'php' .  ' } ' . '?' . '>';
						  
									  
						$fout = fopen($this->_path_root . $content_css,"w");
						fwrite($fout,$file_content);
						fclose($fout);
					}
					
					include($this->_path_root . $content_css);
					
					$content_css = 'templates/'.$template.'/css/JFCKeditor.css'; 
					
					 
				
					
					ob_start();
					
					
					getYooThemeCSS();
					
								
					$file_content =  ob_get_contents(); 
					
										
					ob_end_clean();
					
									
					$fout = fopen($this->_path_root . $content_css,"w");
					fwrite($fout,$file_content);
					fclose($fout);
				    
					
					
					
				}
				else {
					$errors .= '<span style="color: red;">Warning: ' . JPATH_SITE . '/templates/'.$template.'/css/template.css' . ' or ' . JPATH_SITE . '/templates/'.$template.'/css/template.css.php does not appear to be a valid file. Reverting to JoomlaFCK\'s default styles</span><br/>';
				}//end if valid file
			}//end if  $editor_css !== 0 & $content_css == 0

			/* Is the content_css == 0 or 1 then use FCK's default */
			if( $errors !== "" ){
				$content_css = 'plugins/editors/fckeditor/editor/css/fck_editorarea.css';
			}//end if 
	
			/*write to xml file and read from css asnd store this file under editors*/
			$this->xml_writer($this->_path_root .$content_css, $xml_path );
	
		} else {
			if ( $content_css_custom ) {
               
			              
				$hasRoot = strpos(' ' . strtolower($content_css_custom),strtolower(JPATH_SITE));
				$file_path = ($hasRoot ? '' : JPATH_SITE) .  ($hasRoot || substr($content_css_custom,0,1) == DS  ? '' : DS) .
				$content_css_custom;
           
		 	   
		    if( is_file(  $file_path) ){
					$content_css =  $file_path;
					$content_css = str_replace(strtolower(JPATH_SITE) . DS,'',strtolower($content_css_custom));
				} else {
					$errors .= '<span style="color: red;">Warning: ' .  $file_path . ' does not appear to be a valid file.</span><br/>';
					$content_css = 'plugins/editors/fckeditor/editor/css/fck_editorarea.css';
				}//end if valid file
					
			} else {
	
	     
				$content_css = 'plugins/editors/fckeditor/editor/css/fck_editorarea.css';
	
			}//end if $content_css_custom
			/*write to xml file and read from css asnd store this file under editors*/
		
				$this->xml_writer($this->_path_root .$content_css, $xml_path );
            
			
		}//end if $content_css || $editor_css

    		
		//if additional stylesheets specified
   		$stylesheet_name = ''; 
		
		
		
		if($add_stylesheet_path)
		{
		
		   	$hasRoot = strpos(' ' . strtolower($add_stylesheet_path),strtolower(JPATH_SITE));
			 
			$add_stylesheet_path = str_replace(strtolower(JPATH_SITE) . DS,'',strtolower($add_stylesheet_path));
			
		
		
  		}
		else
		{
		   $add_stylesheet_path = '/templates/' .$template. '/css/';
		}
				
			   
      
		
	    $BaseAddCSSPath = (preg_match('/(^\/|^\\\\)/',$add_stylesheet_path) ? '' : '/') .$add_stylesheet_path   
				.(preg_match('/.(\/$|\\\\$)/',$add_stylesheet_path) ? '' : '/');
        
		
  
        $BaseAddCSSPath = str_replace('\\','/',$BaseAddCSSPath);
		
       
	     //echo $add_stylesheet_path;

  
	   	if($add_stylesheet_path &&  $add_stylesheet)
	   	{
	   
			if (strpos($add_stylesheet,';'))
			{
				$stylesheets =  explode(';',$add_stylesheet);
			}
			else
			{
				$stylesheets[] = $add_stylesheet;
			}
		
		   
			$count = 0;
			
			foreach($stylesheets as $stylesheet)
			{
			
				if(!preg_match('/\.\w{3}$/',$stylesheet))
				{
					$stylesheet .= '.css';
						   
				}
				
			
				 
				$fin =  $this->_path_root .  substr($BaseAddCSSPath,1,strlen($BaseAddCSSPath)) . $stylesheet;
							
				
							
				$file =  JPATH_SITE . (preg_match('/(^\/|^\\\\)/',$add_stylesheet_path) ? '' : DS) .$add_stylesheet_path   
				.(preg_match('/.(\/$|\\\\$)/',$add_stylesheet_path) ? '' : DS) . $stylesheet;
				
				$fout = $this->_path_root . 'plugins/editors/fckeditor/' . str_replace('.css','.xml',$stylesheet);	
			
			
			 
				if( !is_file($file) )
				{
					
						$errors .= '<span style="color: red;">Warning: ' 
						. $file . ' does not appear to be a valid file. So additional styles will not be added</span><br/>';
						array_splice($stylesheets, $count,1);
						
				}
				else
				{ 
					$this->xml_writer($fin,$fout);
				}
		
		       $count ++;
			}
			
			 	$stylesheet_name =  str_replace('.css','',implode(';',$stylesheets));
	   
	   	}
		
		$content_css =   JURI::root() . $content_css; 
	 	$content_css =   str_replace(DS,'/',$content_css); 

		return $content_css;
	}
	
	function _displayButtons($name, $buttons)
	{
		// Load modal popup behavior
		JHTML::_('behavior.modal', 'a.modal-button');

		$args['name'] = $name;
		$args['event'] = 'onGetInsertMethod';

		$return = '';
		$results[] = $this->update($args);
		foreach ($results as $result) {
			if (is_string($result) && trim($result)) {
				$return .= $result;
			}
		}

		if(!empty($buttons))
		{
			$results = $this->_subject->getButtons($name, $buttons);

			/*
			 * This will allow plugins to attach buttons or change the behavior on the fly using AJAX
			 */
			$return .= "\n<div id=\"editor-xtd-buttons\">\n";
			foreach ($results as $button)
			{
				/*
				 * Results should be an object
				 */
				if ( $button->get('name') ) 
				{
					$modal		= ($button->get('modal')) ? 'class="modal-button"' : null;
					$href		= ($button->get('link')) ? 'href="'.$button->get('link').'"' : null;
					$onclick	= ($button->get('onclick')) ? 'onclick="'.$button->get('onclick').'"' : null;
					$return .= "<div class=\"button2-left\"><div class=\"".$button->get('name')."\"><a ".$modal." title=\"".$button->get('text')."\" ".$href." ".$onclick." rel=\"".$button->get('options')."\">".$button->get('text')."</a></div></div>\n";
				}
			}
			$return .= "</div>\n";
		}
		
		return $return;
	}
	
	
	function changeChmod()
	{
	
		//set core plugin permissons
		// Try to recover from bad chmod settings
		
		if(!defined('JFCK_BASE'))
			define('JFCK_BASE',$this->_path_root .'plugins/editors/fckeditor/editor');
		
		//file manager plugin
		
		$dir = JFCK_BASE . '/filemanager' ;
		$perms  = fileperms($this->_path_root . 'index.php');
		$perms = (decoct($perms & 0777));
		
		switch($perms)
		{
			case 666:	$perms = 777;
						break;									
			case 644:   $perms = 755;
		}
		
		$default_fperms = '0644';
		$default_dperms = '0755'; 
				
		if(!stristr(PHP_OS,'WIN') && file_exists($dir .'/connectors/php/connector.php')  
			&& JPath::canChmod($dir .'/connectors/php/connector.php')
			 && $perms != decoct(fileperms($dir) & 0777))
			 
		{
			
		
			
		   $oldumask = umask(0);
		
		 			
		    if($perms == 755)
			{
				@chmod(JFCK_BASE,0755);
				@chmod( $dir, 0755);
				JPath::setPermissions($dir);
			}			
			else		
			{
				$default_fperms = '0666';
				$default_dperms  = '0777';
				@chmod(JFCK_BASE,0777);
				@chmod( $dir, 0777);
				JPath::setPermissions($dir,'0666', '0777');
			}
			
			
			// About plugin			
	
			$dir =  JFCK_BASE . '/dialog';
			@chmod( $dir, octdec($default_dperms));
			@chmod( $dir .  '/fck_about.php', octdec($default_fperms));
			//JPath::setPermissions($dir,$default_fperms, $default_dperms);
		
				
			//JLink plugin	
			$dir =  JFCK_BASE . '/plugins';	
			@chmod($dir,octdec($default_dperms));
			@chmod($dir . '/jlink',octdec($default_dperms)); 
			@chmod($dir . '/jlink/suggest.php',octdec($default_fperms)); 
			@chmod($dir . '/jlink/suggest.class.php',octdec($default_fperms)); 	
			
			
			//SpellCheck plugin
			$dir = JFCK_BASE . '/plugins/pspellcheck';
			@chmod($dir,octdec($default_dperms));
			@chmod($dir . '/spellcheck',octdec($default_dperms));
			@chmod($dir . '/spellcheck/spellchecker.php',octdec($default_fperms)); 									
		
			umask($oldumask );
			
		}
			
	}

}
?>