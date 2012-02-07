<?php
import('application.component.view');
class PageView extends View
{
 	var $rows;
	var $menuid;	//当前菜单分类ID
	var $depth = 0;
	function PageView()
	{	
		$this->path = dirname(__FILE__);
		$this->menuid = intval( $_REQUEST['menuid'] );
	}

	function display()
	{
	
		import('html.form');	//获取表单对象
  		//print_r($options);

		if( $this->menuid < 1 ) {
			$item = $this->get('menu');
			include($this->path.DS.'tmpl'.DS.'list.php');
		}else{
			$item = $this->get('item');
			include($this->path.DS.'tmpl'.DS.'form.php');
		}
	}

}
?>