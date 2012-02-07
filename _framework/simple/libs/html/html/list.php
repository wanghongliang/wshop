<?php
 
 
class WHTMLList
{
	/**
	* Build the select list for access level
	*/
	function accesslevel( &$row )
	{

		//$db =& WFactory::getDBO();

		//$query = 'SELECT id AS value, name AS text'
		//. ' FROM #__groups'
		//. ' ORDER BY id'
		//;
		//$db->setQuery( $query );
		$groups = array();//$db->loadObjectList();
		$access = WHTML::_('select.genericlist',   $groups, 'access', 'class="inputbox" size="3"', 'value', 'text', intval( $row->access ), '', 1 );

		return $access;
	}

	/**
	* Build the select list to choose an image
	*/
	function images( $name, $active = NULL, $javascript = NULL, $directory = NULL, $extensions =  "bmp|gif|jpg|png" )
	{
		if ( !$directory ) {
			$directory = '/images/stories/';
		}

		if ( !$javascript ) {
			$javascript = "onchange=\"javascript:if (document.forms.adminForm." . $name . ".options[selectedIndex].value!='') {document.imagelib.src='..$directory' + document.forms.adminForm." . $name . ".options[selectedIndex].value} else {document.imagelib.src='../images/blank.png'}\"";
		}

		wimport( 'core.filesystem.folder' );
		$imageFiles = WFolder::files( PATH_SITE.DS.$directory );
		$images 	= array(  WHTML::_('select.option',  '', '- '. WText::_( 'Select Image' ) .' -' ) );
		foreach ( $imageFiles as $file ) {
		   if ( eregi( $extensions, $file ) ) {
				$images[] = WHTML::_('select.option',  $file );
			}
		}
		$images = WHTML::_('select.genericlist',  $images, $name, 'class="inputbox" size="1" '. $javascript, 'value', 'text', $active );

		return $images;
	}

	/**
	 * Description
	 *
 	 * @param string SQL with ordering As value and 'name field' AS text
 	 * @param integer The length of the truncated headline
 	 * @since 1.5
 	 */
	function genericordering( $sql, $chop = '30' )
	{
		$db =& WFactory::getDBO();
		$order = array();
		$db->setQuery( $sql );
		if (!($orders = $db->loadObjectList())) {
			if ($db->getErrorNum()) {
				echo $db->stderr();
				return false;
			} else {
				$order[] = WHTML::_('select.option',  1, WText::_( 'first' ) );
				return $order;
			}
		}
		$order[] = WHTML::_('select.option',  0, '0 '. WText::_( 'first' ) );
		for ($i=0, $n=count( $orders ); $i < $n; $i++) {

			if (WString::strlen($orders[$i]->text) > $chop) {
				$text = WString::substr($orders[$i]->text,0,$chop)."...";
			} else {
				$text = $orders[$i]->text;
			}

			$order[] = WHTML::_('select.option',  $orders[$i]->value, $orders[$i]->value.' ('.$text.')' );
		}
		$order[] = WHTML::_('select.option',  $orders[$i-1]->value+1, ($orders[$i-1]->value+1).' '. WText::_( 'last' ) );

		return $order;
	}

	/**
	* Build the select list for Ordering of a specified Table
	*/
	function specificordering( &$row, $id, $query, $neworder = 0 )
	{
		$db =& WFactory::getDBO();

		if ( $id ) {
			$order = WHTML::_('list.genericordering',  $query );
			$ordering = WHTML::_('select.genericlist',   $order, 'ordering', 'class="inputbox" size="1"', 'value', 'text', intval( $row->ordering ) );
		} else {
			if ( $neworder ) {
				$text = WText::_( 'descNewItemsFirst' );
			} else {
				$text = WText::_( 'descNewItemsLast' );
			}
			$ordering = '<input type="hidden" name="ordering" value="'. $row->ordering .'" />'. $text;
		}
		return $ordering;
	}

	/**
	* Select list of active users
	*/
	function users( $name, $active, $nouser = 0, $javascript = NULL, $order = 'name', $reg = 1 )
	{
		$db =& WFactory::getDBO();

		$and = '';
		if ( $reg ) {
		// does not include registered users in the list
			$and = ' AND gid > 18';
		}

		$query = 'SELECT id AS value, name AS text'
		. ' FROM #__users'
		. ' WHERE block = 0'
		. $and
		. ' ORDER BY '. $order
		;
		$db->setQuery( $query );
		if ( $nouser ) {
			$users[] = WHTML::_('select.option',  '0', '- '. WText::_( 'No User' ) .' -' );
			$users = array_merge( $users, $db->loadObjectList() );
		} else {
			$users = $db->loadObjectList();
		}

		$users = WHTML::_('select.genericlist',   $users, $name, 'class="inputbox" size="1" '. $javascript, 'value', 'text', $active );

		return $users;
	}

	/**
	* Select list of positions - generally used for location of images
	*/
	function positions( $name, $active = NULL, $javascript = NULL, $none = 1, $center = 1, $left = 1, $right = 1, $id = false )
	{
		if ( $none ) {
			$pos[] = WHTML::_('select.option',  '', WText::_( 'None' ) );
		}
		if ( $center ) {
			$pos[] = WHTML::_('select.option',  'center', WText::_( 'Center' ) );
		}
		if ( $left ) {
			$pos[] = WHTML::_('select.option',  'left', WText::_( 'Left' ) );
		}
		if ( $right ) {
			$pos[] = WHTML::_('select.option',  'right', WText::_( 'Right' ) );
		}

		$positions = WHTML::_('select.genericlist',   $pos, $name, 'class="inputbox" size="1"'. $javascript, 'value', 'text', $active, $id );

		return $positions;
	}

	/**
	* Select list of active categories for components
	*/
	function category( $name, $section, $active = NULL, $javascript = NULL, $order = 'ordering', $size = 1, $sel_cat = 1 )
	{
		$db =& WFactory::getDBO();
		
		//根据当前单元的选择，显示对应的分类信息
		$sectionid = WRequest::getInt('sectionid');
	
		//有单元ID，条件为 sectionid=$sectionid
		if( $sectionid > 0 ){
			$where = ' sectionid = '.$sectionid;
		}else{
			$where = ' section = '.$db->Quote($section);
		}

		$query = 'SELECT id AS value, title AS text'
		. ' FROM #__categories'
		. ' WHERE '
		. $where
		. ' AND published = 1'
		. ' ORDER BY '. $order
		;
		$db->setQuery( $query );

		//echo $query;
		//exit;

		if ( $sel_cat ) {
			$categories[] = WHTML::_('select.option',  '0', '- '. WText::_( 'Select a Category' ) .' -' );
			$categories = array_merge( $categories, $db->loadObjectList() );
		} else {
			$categories = $db->loadObjectList();
		}

		$category = WHTML::_('select.genericlist',   $categories, $name, 'class="inputbox" size="'. $size .'" '. $javascript, 'value', 'text', $active );
		return $category;
	}

	/**
	* Select list of active sections
	*/
	function section( $name, $active = NULL, $javascript = NULL, $order = 'ordering', $uncategorized = false )
	{
		$db =& WFactory::getDBO();

		$categories[] = WHTML::_('select.option',  '-1', '- '. WText::_( 'Select Section' ) .' -' );

		if ($uncategorized) {
			$categories[] = WHTML::_('select.option',  '0', WText::_( 'Uncategorized' ) );
		}
		
		
		//频道的范围
		$section = WRequest::getCmd('section');

		//组件
		$section = $section?$section:'content';
		
		$query = 'SELECT id AS value, title AS text'
		. ' FROM #__sections'
		. ' WHERE published = 1'
		. ' AND scope =\''.$section.'\''
		. ' ORDER BY ' . $order
		;

  		$db->setQuery( $query );
		$sections = array_merge( $categories, $db->loadObjectList() );

		$category = WHTML::_('select.genericlist',   $sections, $name, 'class="inputbox" size="1" '. $javascript, 'value', 'text', $active );

		return $category;
	}
}