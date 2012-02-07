<?php
 
class ElementAdvertype extends Element
{
	/**
	* Element name
	*
	* @access	protected
	* @var		string
	*/
	var	$_name = 'advertype';

	function fetchElement($name, $value, &$params, $control_name)
	{
	 
		global $app;
		$db = &Factory::getDB();
		$sql = "select id,name from #__adver_types where uid=".$app->uid."  ";
		$db->query($sql);
		$rows = $db->getResult();


		$str = '<select name="'.$control_name.'['.$name.']" >';
		
		$str .= '<option value="0" >所有分类</option>';

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
