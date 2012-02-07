<?php
import('application.component.view');
class Order_shipView extends View
{
 	var $rows;
 	var $depth = 0;
 	var $path = null;
	function Order_shipView()
	{		 
		$this->path = dirname(__FILE__); 
 		$this->baseuri = 'index.php?com=order_ship'; 
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
		$model = &$this->getModel();
		$item = $this->get('item');

		$product_lists = $model->getDeliveryProducts($item['delivery_id']);
		//print_r($product_lists);
  		include($this->path.DS.'tmpl'.DS.'show.php');
	}
}
?>