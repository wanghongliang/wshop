<?php
 
class ElementProducttype extends Element
{
	/**
	* Element name
	*
	* @access	protected
	* @var		string
	*/
	var	$_name = 'producttype';

	function fetchElement($name, $value, &$params, $control_name)
	{
	 
		global $app;
		$db = &Factory::getDB();
		$sql = "select id,name from #__menu where uid=".$app->uid." and parent_id=0 and component='products' ";
		$db->query($sql);
		$rows = $db->getResult();


		$str = '<select name="'.$control_name.'['.$name.']" >';
		
		$str .= '<option value="0" >所有产品分类</option>';

		//print_r($params['optoins']);
		foreach( $rows as $row )
		{
			$str .= '<option value="'.$row['id'].'" ';
			if( $value == $row['id'] )
			{
				$str .= ' selected ';
			}

			$str .= '>';
			$str .= $row['name'];
			$str .= '</option>';
		}
		$str.='</select>';
		return $str;
	}
}
