<?php
import('application.component.view');
class ContentsView extends View
{
 	var $rows;
	var $menuid;	//当前菜单分类ID

	var $depth = 0;

	var $path = null;
	function ContentsView()
	{

		$this->path = dirname(__FILE__);

		$this->menuid = intval( $_REQUEST['menuid'] );
		$this->baseuri = 'index.php?com=contents&menuid='.$this->menuid;

		if( isset( $_REQUEST['tmpl'] ) ){ $this->baseuri.='&tmpl='.$_REQUEST['tmpl']; }
	}

	function display()
	{
		//文章属性
		$attr  = $this->get('attr');
		import('html.html');
		$lists = $this->get('List');
 		$this->rows = &$lists['rows'];
		$options = HTML::_('menu.linkoptions','contents',$this->menuid);

		$nav = $this->get('nav');
		include($this->path.DS.'tmpl'.DS.'list.php');
	}
	function recycle()
	{
		$this->rows =$this->get('recycleList');
		$nav = $this->get('nav');
  		include($this->path.DS.'tmpl'.DS.'recyclelist.php');
	}
}
?>