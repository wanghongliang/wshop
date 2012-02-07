<?php
class ElementMenuitem extends Element
{
	/**
	* Element name
	*
	* @access	protected
	* @var		string
	*/
	var	$_name = 'ImageList';

	function fetchElement($name, $value, &$node, $control_name)
	{
		$filter = '\.png$|\.gif$|\.jpg$|\.bmp$|\.ico$';
  		$string = $this->selectoptions( $node["com"],$value,' name="'.$control_name.'['.$name.']" id="'.$name.'" ' );


		return  $string ;
	}

	function selectoptions( $com="contents", $id = 0 , $extra ="")
	{
		global $app;
 
		$db =&Factory::getDB();

		// get a list of the menu items
		$query = 'SELECT m.id, m.parent_id,m.component, m.name, m.tid '
		. ' FROM #__menu AS m'
		. ' WHERE uid='.$app->uid
		. ' and m.published = 1'
		. ' ORDER BY m.tid, m.lft'
		;
		$db->query( $query );
		$mitems = $db->getResult();
 

 		$query = 'SELECT * '
		. ' FROM #__menu_types where uid='.$app->uid
		;
		$db->query( $query );
		$mtypes = $db->getResult();
		
		$current = array();		//当前菜单项
 		$children = array();
 		foreach ( $mitems as $v )
		{
 			$children[$v['tid']][$v['parent_id']][] = $v;
 
		}
 		//$options = array();//'<select '.$extra.' >';	//select 字符串


 
		//菜单分类选项框
		$typeoptions ='<select '.$extra.' >';
		$typeoptions .= "<option value='0' >-请选择-</option>";

		foreach( $mtypes as $k=>$type )
		{
			$typeoptions .= '<option value="'.$type['id'].'" ';
			$typeoptions .= ' disabled ><i>'.$type['title'].'--顶部</i></option>';
			//为列表框设 "顶部" 值
 			$typeoptions .=  $this->treerecurse($children[$type['id']],0,0,$com,$id);
		}
 

 		$typeoptions .='</select >';	//select 字符串
 		
		unset($mitems,$mtypes,$children,$children,$option);
		return $typeoptions;
	}
	
	/** 
	 * 构造所有菜单选择框
	 * $arr 以父ID为索引的多维数组
	 * $pid 父ID
	 * $depth 深度
	 * $com 不能选择的 $com 
	 */
	function treerecurse(&$arr,$pid=0,$depth=0,$com = '',$selectid=0)
	{
		
		$str = '';
		if( is_array( $arr[$pid] ) )
		{
			$depth++;	//加一个深度,当启动递归时
			$items = $arr[$pid];
 
			foreach( $items as $item )
			{
 
				$str .='<option value="'.$item['id'].'" ';
				if( $_REQUEST['id'] == $item['id']  )	//和当前菜单相同时，不能链接
				{
					$str.=" disabled=\"disabled\" ";
				}else if( $item['id']==$selectid )
				{
					$str.=" selected ";
				}
				$str .='> &nbsp;';

				if( $depth > 1 ){	//子栏 
					for($i=1;$i<$depth;$i++){
						$str.= '&nbsp;&nbsp;';
					}
					$str .= '└';
				}else{

				}
				//⊥－├┌└$str .= $item['id'];
				$str .= $item['name'];// 名称
				//echo $item['parent_id'];
				$str .="</option>";
				$str .=  $this->treerecurse(&$arr,$item['id'],$depth,$com,$selectid );
 			}
		}

		return $str;
	}
}
