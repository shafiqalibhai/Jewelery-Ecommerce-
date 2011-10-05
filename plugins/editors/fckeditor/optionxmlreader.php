<?php

class JFCKeditorHelper
{
  
	function getOptionXMLReader()
	{
		if(defined('_JEXEC'))
		{
		   return JFCKOptionXMLReader::getInstance();
		}
		else if (defined('_VALID_MOS'))
		{
		  	return JFCKOptionXMLReaderLegacy::getInstance();	
		}
		return false;

	}
} 

//Interface 
class IJFCKOptionXMLReader
{

	var $_xml = null;

   function checkOption($option = null) {}

}

		
class JFCKOptionXMLReader extends IJFCKOptionXMLReader
{
		
	
		
	function  __construct($reader = 'jfckoptionxmlreader')
	{
		$file = JPATH_PLUGINS . DS .  'editors' .DS .'fckeditor' .DS . 'editor' . DS . 'lang' . DS . 'lm_cfg.xml';
		
		$this->_xml =& JFactory::getXMLParser('Simple');
		
		if (JFile::exists($file))
		{
			if(!$this->_xml->loadFile($file))
			{
				  JError::raiseWarning(100,'Could not load the option file for the JoomlaFCK editor!');
			} 
		}
		else
		{
			 JError::raiseWarning(100,'Could not find the option file for the JoomlaFCK editor!');
		}
			
			
	
	}
	
	//overide
	function &getInstance($reader = 'jfckoptionxmlreader')
	{
		static $instances;

		if (!isset ($instances)) {
			$instances = array ();
		}

		$signature = serialize($reader);

		if (empty ($instances[$signature])) {
			$instances[$signature] = new JFCKOptionXMLReader($reader);
		}

		return $instances[$signature];
	}
	
	//overide
 	function checkOption($option = null)
	{
		$found = false;	
		
		if($this->_xml->document && $option)
		{				
		
		    $options =& $this->_xml->document;
					 	 
			if($options)
			{
				foreach($options->children() as $com_option) 
				{
					if($com_option->attributes('name') == $option)
					{
					   
						$found = true;
						break;
					}	 
				}  
			}
		}
		return $found;	      

	}

}

		
class JFCKOptionXMLReaderLegacy extends IJFCKOptionXMLReader
{
		
		
	function  __construct($reader = 'jfckoptionxmlreaderlegacy')
	{
		global $mosConfig_absolute_path;
		
				
		$file = $mosConfig_absolute_path . DS . 'mambots' . DS .  'editors' .DS .'fckeditor' .DS . 'editor' . DS . 'lang' . DS . 'lm_cfg.xml';
		
		$this->_xml = new DOMIT_Lite_Document();
		$this->_xml->resolveErrors( true );
		

		if (file_exists($file))
		{
			
			$this->_xml->loadXML( $file, false, true );
			
		}

	}
	
	//overide
	function &getInstance($reader = 'jfckoptionxmlreaderlegacy')
	{
		static $instances;

		if (!isset ($instances)) {
			$instances = array ();
		}

		$signature = serialize($reader);

		if (empty ($instances[$signature])) {
			$instances[$signature] = new JFCKOptionXMLReaderLegacy($reader);
		}

		return $instances[$signature];
	}
	
	//overide
 	function checkOption($option = null)
	{
		$found = false;	
		
		if($this->_xml->documentElement && $option)
		{				
		
		    $options =& $this->_xml->documentElement;
					 	 
			if($options)
			{
				foreach($options->childNodes as $com_option) 
				{
					if($com_option->getAttribute('name') == $option)
					{
					   
						$found = true;
						break;
					}	 
				}  
			}
		}
		return $found;	      

	}

}



