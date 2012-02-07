<?php
import('application.component.view');
class OrdersView extends View
{
 	var $rows;
	var $menuid;	//当前菜单分类ID

	var $depth = 0;

	var $path = null;
	function OrdersView()
	{		
		
		$this->path = dirname(__FILE__); 
 		$this->baseuri = 'index.php?com=orders';

		if( isset( $_REQUEST['tmpl'] ) ){ $this->baseuri.='&tmpl='.$_REQUEST['tmpl']; }
	}
	function display()
	{

		import('html.html');
		$lists = $this->get('List');
 		$this->rows = &$lists['rows'];
		$options = HTML::_('menu.linkoptions','orders',$this->menuid);

		$nav = $this->get('nav');
		
		$status = $this->get('status');

		//支付方式
		$pays = $this->get('pays'); 
		include($this->path.DS.'tmpl'.DS.'list.php');
	}
	function accessories()
	{
		import('html.html');
		$lists = $this->get('List');
 		$this->rows = &$lists['rows'];
 
		$nav = $this->get('nav');
 
 		include($this->path.DS.'tmpl'.DS.'list_accessories.php');
	}
	function recycle()
	{
		$this->rows =$this->get('recycleList');
		$nav = $this->get('nav');
  		include($this->path.DS.'tmpl'.DS.'recyclelist.php');
	}
}
?>