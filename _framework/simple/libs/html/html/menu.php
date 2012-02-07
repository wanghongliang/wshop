<?php

class HTMLMenu
{
 
 
	function linkoptions( $com="contents", $id = 0 , $extra ="")
	{

		global $app;

		$db =&Factory::getDB();

		// get a list of the menu items
		$query = 'SELECT m.id, m.parent_id,m.component, m.name, m.tid '
		. ' FROM #__menu AS m'
		. ' WHERE m.uid ='.$app->uid
		. ' ORDER BY m.tid, m.lft'
		;
		$db->query( $query );
		$mitems = $db->getResult();
 

 		$query = 'SELECT * '
		. ' FROM #__menu_types where  uid ='.$app->uid
		;
		$db->query( $query );
		$mtypes = $db->getResult();
		
		$current = array();		//当前菜单项
 		$children = array();
 		foreach ( $mitems as $v )
		{
 			$children[$v['tid']][$v['parent_id']][] = $v;

			//查找出当前的菜单项
			if( $v['id'] == $id )
			{
				$current = $v;
			}
		}


		//当前菜单分类
		$mtid = intval($_REQUEST['mtid']);
		if( $mtid > 0 ){$current['tid'] = $mtid; }


		//$options = array();//'<select '.$extra.' >';	//select 字符串

		//菜单分类选项框
		$typeoptions ='<select '.$extra.' onchange="filterByMenu(this.value,0);" class="select" >';
		$typeoptions .= "<option >-请选择-</option>";

		$menuoptions ='<select '.$extra.' id="selectmenu"  onchange="filterByMenu(0,this.value);" class="select" >';

 
		foreach( $mtypes as $k=>$type )
		{

			$typeoptions .= '<option value="'.$type['id'].'" ';
			if( $type['id'] == $current['tid'] )
			{
				$typeoptions .= " selected ";
			}
			$typeoptions .= ' >'.$type['title'].'</option>';

			//为列表框设 "顶部" 值
			$option = '<option value="0" >-请选择-</option>';
			$option .=  HTMLMenu::treerecurse($children[$type['id']],0,0,$com,$id);
			
			//$js .= " option[".$type['id']."]='".$option."'; ";

			if( $k==0 && $current['tid']==0 ) {
				$menuoptions .=$option;	//select 字符串
			}else if( $current['tid'] == $type['id'] )//设定当前选择的菜单项
			{
				$menuoptions .=$option;	//select 字符串
			}
		}
 

 		$typeoptions .='</select >';	//select 字符串
		$menuoptions .='</select >';	//select 字符串
		
		unset($mitems,$mtypes,$children,$children,$option);
		return $typeoptions.$menuoptions;
	}

 
	function selectoptions( $com="contents", $id = 0 , $extra ="")
	{

		global $app;
		$db =&Factory::getDB();


		// get a list of the menu items
		$query = 'SELECT m.id, m.parent_id,m.component, m.name, m.tid '
		. ' FROM #__menu AS m'
		. ' WHERE  m.uid ='.$app->uid.' and  m.published = 1 '
		. ' ORDER BY m.tid, m.lft'
		;
		$db->query( $query );
		$mitems = $db->getResult();
 

 		$query = 'SELECT * '
		. ' FROM #__menu_types where  uid ='.$app->uid
		;

 
		$db->query( $query );
		$mtypes = $db->getResult();
		
		$current = array();		//当前菜单项
 		$children = array();
 		foreach ( $mitems as $v )
		{
 			$children[$v['tid']][$v['parent_id']][] = $v;

			//查找出当前的菜单项
			if( $v['id'] == $id )
			{
				$current = $v;
			}
		}


		//当前菜单分类
		$mtid = intval($_REQUEST['mtid']);
		if( $mtid > 0 ){$current['tid'] = $mtid; }


		//$options = array();//'<select '.$extra.' >';	//select 字符串

		//菜单分类选项框
		$typeoptions ='<select '.$extra.' size=15 >';
		//$typeoptions .= "<option >-请选择-</option>";

		foreach( $mtypes as $k=>$type )
		{
			$typeoptions .= '<option value="'.$type['id'].'" ';
			$typeoptions .= ' disabled ><i>'.$type['title'].'</i></option>';
			//为列表框设 "顶部" 值
 			$typeoptions .=  HTMLMenu::treerecurse($children[$type['id']],0,0,$com,$id);
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
				if( $com != $item['component']  )
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
				$str .=  HTMLMenu::treerecurse($arr,$item['id'],$depth,$com,$selectid );
 			}
		}

		return $str;
	}

}