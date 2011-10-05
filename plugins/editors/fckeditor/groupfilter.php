<?php

class JFCKGroupFilter
{

 
	 function check($dbo)
	 {
	 	 
	 	$config	= JComponentHelper::getParams( 'com_content' );
	  	$isXssAuto = $config->get( 'filter_groups',0);
	    $error = "";
	 	 
		if(!$isXssAuto)
		{
		    //Add a default filter group for registers users and authors
			$db		=& $dbo;
			$row 	=& JTable::getInstance('component');
			  
			JError::raiseWarning(100,"No Article filter set, so the groups: Registers Users and Author have been automatically applied to the blacklist!");
		       
			$error = 'To change the Artilce filter please read documentation at <a target="_blank" href="http://www.joomlafckeditor.com/why-does-some-html-get-removed-from-articles-in-version-158">http://www.joomlafckeditor.com/why-does-some-html-get-removed-from-articles-in-version-158</a>' ; 
			   
			$query = 'SELECT id'
			. ' FROM #__components'
			. ' WHERE  ' . $db->nameQuote( 'option' ) .' = "com_content"' 
			. ' AND parent = 0';
			
		
			$db->setQuery( $query );
			$id = $db->loadResult();
		
			// load the row from the db table
			$row->load( intval( $id ) );
			
	 		$config->set('filter_groups','18|19'); 
			$config->set( 'filter_type','BL' );
			$config->set( 'filter_tags','' );
			$config->set( 'filter_attritbutes','' );
			 
			$row->params = stripslashes($config->toString());
					
			 	
					
			if (!$row->check()) {
				JError::raiseError(500, $row->getError() );
			}
				
			if (!$row->store()) {
				JError::raiseError(500, $row->getError() );
			}
			$row->checkin();
			 
								
		}
		
		
		return $error;			 
	 }
   
}