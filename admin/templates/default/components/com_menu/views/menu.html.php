<?php
import('application.component.view');
class MenuView extends View
{
 	var $rows;
	var $menutypeid;	//当前菜单分类ID
	var $depth = 0;
	function MenuView()
	{	
		$this->path = dirname(__FILE__);
		$this->menutypeid = intval( $_REQUEST['mtid'] );
	}

	function display()
	{
	
		//取当前编辑的内容
		$item = $this->get('item');

		import('html.form');	//获取表单对象
		$this->rows = $this->get('list');	//取模型类数据
		$options = array(0=>'顶部');	//为列表框设 "顶部" 值
		$options = $options + Form::_buildTreeOptions($this->rows);

		
		if( $item['type'] == 'url' )
		{
			//print_r($options);
 			$linkInput = Form::input('link',$item['link'],' size=45  ');

		}else{
			//print_r($options);
 			$linkInput = Form::input('link',$item['link'],' size=45 readonly ');
	
		}

		$pid = Form::dropdown('parent_id',$options,0,' class="select" size="10" ');
		include($this->path.DS.'tmpl'.DS.'form.php');
	}


	/**
	 * 编辑界面
	 */
	function edit()
	{		
		//取当前编辑的内容
		$item = $this->get('item');


		import('html.form');	//获取表单对象
		$this->rows = $this->get('list');	//取模型类数据
		$options = array(0=>'顶部');	//为列表框设 "顶部" 值
		$options = $options + Form::_buildTreeOptions($this->rows,0,0,$item['id']);

		//print_r($options);
 	
		if( $item['type'] == 'url' )
		{
			//print_r($options);
 			$linkInput = Form::input('link',$item['link'],' size=45  ');

		}else{
			//print_r($options);
 			$linkInput = Form::input('link',$item['link'],' size=45 readonly ');
	
		}
		
		$pid = Form::dropdown('parent_id',$options,$item['parent_id'],'  class="select"  size="10" ');
		include($this->path.DS.'tmpl'.DS.'form.php');
	}
 
	/**
	 * 显示选择的组件
	 */
	function showSelectComponent()
	{
		$lists = array();		//组件列表
		//别名
		if( $_REQUEST['next'] == 'alias' )
		{
			import('html.form');	//获取表单对象
			$lists = $this->get('allmenu');	//取模型类数据

			$options = '<select size=20 >';
			foreach( $lists['types'] as $type )
			{

				//echo $type['title'];
					//array_push($options,$type['title']);	
					$options .= '<option value=""  disabled=\"disabled\" ><b>'.$type['title'].'</b></option>';
					//为列表框设 "顶部" 值
					$options .=  Form::_buildAllSelect($lists['rows'][$type['id']],0,0,$_REQUEST['url']['com'],$_REQUEST['id']);
			}
			$options .= '</select>';
		}else{
		
			$lists = $this->get('cominfo');
		}
		//print_r($lists);
		//echo $this->path.DS.'tmpl'.DS.'selectcomponent.php';

		$linkType= $this->get('linkType');

		include($this->path.DS.'tmpl'.DS.'selectcomponent.php');
	}
	/**
	 * 显示选择的组件
	 */
	function shiftcontent()
	{
		if( isset( $_REQUEST['del'] ) ){
			include($this->path.DS.'tmpl'.DS.'shiftcontent_del.php');
		}else{
			include($this->path.DS.'tmpl'.DS.'shiftcontent.php');
		}
	}


	/**
	 * 显示选择的菜单
	 */
	function ajaxselectmenu()
	{
		import('html.form');	//获取表单对象
		$lists = $this->get('allmenu');	//取模型类数据

 		$options = '';
		foreach( $lists['types'] as $type )
		{

			//echo $type['title'];
				//array_push($options,$type['title']);	
				$options .= '<option value=""  disabled=\"disabled\" ><b>'.$type['title'].'</b></option>';
				//为列表框设 "顶部" 值
				$options .=  Form::_buildAllSelect($lists['rows'][$type['id']],0,0,$_REQUEST['url']['com'],$_REQUEST['id']);
		}
 		 

		include($this->path.DS.'tmpl'.DS.'ajaxselectmenu.php');
	}

	function delprompt()
	{
		include($this->path.DS.'tmpl'.DS.'delprompt.php');
	}
	
		/**
	 * 显示选择的菜单
	 */
	function ajaxmenu()
	{
 
		$menus = $this->get('ajaxmenu');
		include($this->path.DS.'tmpl'.DS.'ajaxmenu.php');
	}

	
}
?>