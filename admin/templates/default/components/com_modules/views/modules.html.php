<?php
import('application.component.view');
class ModulesView extends View
{
 	var $rows;
 
	var $depth = 0;
	function ModulesView()
	{
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
		$act = trim($_REQUEST['act']);
		 
		if( $act == 'short' ){
			$this->rows = $this->get('list_short');
			$this->path = dirname(__FILE__);
			$nav = $this->get('nav');
			include($this->path.DS.'tmpl'.DS.'list_short.php');
			
			 
		}else{
			import('html.form');	//获取表单对象
			$pos = $this->get('bypos');
			$mod = $this->get('bymod');
 
			$this->rows = $this->get('list');
			$this->path = dirname(__FILE__);
			$nav = $this->get('nav');
			include($this->path.DS.'tmpl'.DS.'list.php');
		}
	}
 

 

}
?>