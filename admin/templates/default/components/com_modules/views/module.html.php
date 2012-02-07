<?php
import('application.component.view');
class ModuleView extends View
{
 	var $rows;
 	var $depth = 0;
	function ModuleView()
	{	
		$this->path = dirname(__FILE__);
		$this->baseuri = 'index.php?com=modules&client_id='.intval($_REQUEST['client_id']);

		if( isset($_REQUEST['tmpl']) ){
			$this->baseuri .= '&tmpl='.$_REQUEST['tmpl'];
		}

		if( isset($_REQUEST['act']) ){
			$this->baseuri .= '&act='.$_REQUEST['act'];
		}
 	}

	function display()
	{
		import('html.form');	//获取表单对象
  		//print_r($options);
		$item=$this->get('item'); 
		$selects = $this->_buildMultiMenu( $item['id']); 

		$components = $this->get('component');
 		include($this->path.DS.'tmpl'.DS.'form.php');
	}
	/**
	 * 编辑界面
	 */
	function edit()
	{		
		//取当前编辑的内容
		$item = $this->get('item');

		$selects = $this->_buildMultiMenu( $item['id']);
		$components = $this->get('component');
  		include($this->path.DS.'tmpl'.DS.'form.php');
	}

	/**
	 * 编辑成功后的界面
	 */
	function success()
	{
  		include($this->path.DS.'tmpl'.DS.'success.php');

	}


	/** 选择模块类型 **/
	function select()
	{
		$modules = $this->get('select');
  		include($this->path.DS.'tmpl'.DS.'select.php');

	}




	/***** 构造菜单多选框 *****/
	function _buildMultiMenu( $id = 0 )
	{
		global $app;

		//构建多选菜单
		$db = &Factory::getDB();


		//选择的菜单项
		$selected = array();

		//是否为新添加的模块
		if ($id) {
			$pages = 'select';
			$query = 'SELECT menuid AS value'
			. ' FROM #__modules_menu'
			. ' WHERE moduleid = '.(int) $id
			;
			$db->query($query);
			$lookup = $db->loadObjectList();
 			if (empty($lookup)) {
 				$pages = 'none';
			} elseif (count($lookup) == 1 && $lookup[0]->value == 0) {
				$pages = 'all';
			} elseif( $lookup[0]->value< 1 ) {
				foreach ($lookup as $key => $modMenu) {
					$selected[-$modMenu->value] = $modMenu->value;
 				}
 				$pages = 'deselect';
 			} else {

				foreach ($lookup as $key => $modMenu) {
					$selected[$modMenu->value] = $modMenu->value;
 				}
			}


		} else {
 			$pages = 'all';
		}


 
		$sql = "select id,name,parent_id from #__menu where uid=".$app->uid." order by lft ";
		$db->query($sql);
		$rows = $db->getResult('id');
		
		$selects = "<select name='selections[]' size=10  id='selections' multiple=true  >";
		foreach( $rows as $k=>$row ){

			//先设定depth属性
			if( isset( $rows[$row['parent_id']]['depth'] ) ){
				$rows[$k]['depth'] = $rows[$row['parent_id']]['depth']+1;
			}else{
				$rows[$k]['depth'] = 0;
			}

			//构建多选框
 			$selects .= "<option value='".$row['id']."' ";
			
			if( $pages == 'all' ){
				$selects .= " selected disabled ";
			}elseif( $pages == 'none' ){
				$selects .= "  disabled ";
			}elseif( isset( $selected[$row['id']] ) ){
				$selects .= " selected ";
			}

			$selects .=" >";
			for( $i=  $rows[$k]['depth']  ; $i>0; $i-- )
			{
				$selects .= "&nbsp;&nbsp;";
			}
			$selects .= $row['name']."</option>";
 		}
		$selects .= "</select>";
		

		return array('pages'=>$pages,'select'=>$selects);
		
	}
 }
?>