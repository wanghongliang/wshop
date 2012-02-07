<?php
import('application.component.view');
class Order_refundView extends View
{
 	var $rows;
 	var $depth = 0;
 	var $path = null;
	function Order_refundView()
	{		 
		$this->path = dirname(__FILE__); 
 		$this->baseuri = 'index.php?com=order_refund'; 
		if( isset( $_REQUEST['tmpl'] ) ){ $this->baseuri.='&tmpl='.$_REQUEST['tmpl']; }
	}
	function display()
	{

		import('html.html');
		$lists = $this->get('List');
 		$this->rows = &$lists['rows'];  
		$nav = $this->get('nav');
 
		include($this->path.DS.'tmpl'.DS.'list.php');
	} 
	function show()
	{ 
		$item = $this->get('item');
  		include($this->path.DS.'tmpl'.DS.'show.php');
	}
}
?>