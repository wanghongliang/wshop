<?php
import('application.component.view');
class ConfigView extends View
{
 	var $rows;
	var $menuid;	//当前菜单分类ID
	var $depth = 0;
	var $editor = null;
	function ConfigView()
	{	
		$this->path = dirname(__FILE__);
 	}

	function display()
	{
	
		import('html.form');	//获取表单对象
		import('html.editor');
		$this->editor = Editor::getInstance($GLOBALS['config']['editor']);


  		//print_r($options);
 		$item = $this->get('item');
		$option = $this->get('option');

 		include($this->path.DS.'tmpl'.DS.'form.php');
	}
	/** 属性表单 **/
	function optionForm(&$row,$val,$name=null){
 		 

		$name = empty($name)?'options':$name;
		switch( $row['type'] ){
			case '3':	//多行文本框 
				echo Form::textarea($name.'['.$row['field'].']',$val,' cols=35 rows=5 ');
				break;
			case '1':	//列表
				$values = explode(",",$row['values']);
 
				$data=array(0=>'请选择..');
				foreach( $values  as $v ){ 
					$v = trim($v);
					$v = explode(':',$v);
					$data[$v[0]] = $v[1];
				}
				echo Form::dropdown($name.'['.$row['field'].']',$data,$val);
				break;
			case '5':
 				echo $this->editor->display($name.'['.$row['field'].']',$val,'100%','450');
 			break;

			default:	//文本框
				echo Form::input($name.'['.$row['field'].']',$val,' size=50 ');
				break;
		}

	}
}
?>