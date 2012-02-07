<?php
import('application.component.model');
class BannerModel extends Model
{
  
	/**
	 * Clicks the URL, incrementing the counter
	 */
	function click( $id = 0 )
	{
		$db = &Factory::getDB();
		// update click count
		$query = 'UPDATE #__advers' .
			' SET clicks = ( clicks + 1 )' .
			' WHERE id = ' . (int)$id;

		$db->query( $query );
  
	}

	/**
	 * Get the URL for a
	 */
	function getUrl( $id = 0 )
	{
		global $app; 
		$db = &Factory::getDB();

		// redirect to banner url
		$query = 'SELECT url FROM #__advers' .
			' WHERE id = ' . (int) $id;

 
		$db->query( $query );
 		$row = $db->getRow();

		$url = $row['url'];

 

 		// check for links
		if (!preg_match( '#http[s]?://|index[2]?\.php#', $url ))
		{
			$url = "http://$url";
		}
		return $url;
	}
}
