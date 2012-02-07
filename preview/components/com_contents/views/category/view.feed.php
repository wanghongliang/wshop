<?php
 
wimport( 'core.application.component.view');

/**
 * HTML View class for the Content component
 
 */
class ContentViewCategory extends WView
{
	function display()
	{
		global $mainframe;

		$doc     =& WFactory::getDocument();
		$params =& $mainframe->getParams();
		$doc->link = WRoute::_('index.php?option=com_content&view=category&id='.WRequest::getVar('id',null, '', 'int'));

		// Get some data from the model
		WRequest::setVar('limit', $mainframe->getCfg('feed_limit'));
		$rows 		= & $this->get( 'Data' );

		foreach ( $rows as $row )
		{
			// strip html from feed item title
			$title = $this->escape( $row->title );
			$title = html_entity_decode( $title );

			// url link to article
			// & used instead of &amp; as this is converted by feed creator
			$link = WRoute::_('index.php?option=com_content&view=article&id='. $row->slug .'&catid='.$row->catslug );

			// strip html from feed item description text
			$description	= ($params->get('feed_summary', 0) ? $row->introtext.$row->fulltext : $row->introtext);
			$author			= $row->created_by_alias ? $row->created_by_alias : $row->author;
			@$date 			= ( $row->created ? date( 'r', strtotime($row->created) ) : '' );

			// load individual item creator class
			$item = new WFeedItem();
			$item->title 		= $title;
			$item->link 		= $link;
			$item->description 	= $description;
			$item->date			= $date;
			$item->category   	= $row->category;

			// loads item info into rss array
			$doc->addItem( $item );
		}
	}
}
?>
