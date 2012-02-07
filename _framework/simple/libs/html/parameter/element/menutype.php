<?php
 
class ElementMenutype extends Element
{
	/**
	* Element name
	*
	* @access	protected
	* @var		string
	*/
	var	$_name = 'menutype';

	function fetchElement($name, $value, &$params, $control_name)
	{
	 
		global $app;
		$db = &Factory::getDB();
		$sql = "select id,title from #__menu_types where uid=".$app->uid;
		$db->query($sql);
		$rows = $db->getResult();


		$str = '<select name="'.$control_name.'['.$name.']" >';
		
 

		//print_r($params['optoins']);
		foreach( $rows as $row )
		{
			$str .= '<option value="'.$row['id'].'" ';
			if( $value == $row['id'] )
			{
				$str .= ' selected ';
			}

			$str .= '>';
			$str .= $row['title'];
			$str .= '</option>';
		}
		$str.='</select>';
		return $str;
	}
}
