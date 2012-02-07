<?php
import('application.component.view');
class AjaxView extends View
{
 	var $rows;
	var $menuid;	//当前菜单分类ID
	var $depth = 0;
	function AjaxView()
	{	
		$this->path = dirname(__FILE__);
 		$this->baseuri = 'index.php?com=products';

		if( isset( $_REQUEST['tmpl'] ) ){ $this->baseuri.='&tmpl='.$_REQUEST['tmpl']; }
		if( isset( $_REQUEST['id'] ) ){ $this->baseuri.='&id='.$_REQUEST['id']; }
	}

	function ajax()
	{
	
		
		$act = trim( $_GET['act'] );
		$model = &$this->getModel();
		switch($act){
			case 'search';
				$rows = $this->get('products');
				include($this->path.DS.'ajax'.DS.'search.php');
				break;

			case 'addlink':
				$model->addItem();
				$rows = $this->get('selected');
				include($this->path.DS.'ajax'.DS.'selected.php');
				break;

			case 'droplink':
				$model->dropItem();
				$rows = $this->get('selected');
				include($this->path.DS.'ajax'.DS.'selected.php');
				break; 

			case 'addgroup':
				$model->addGroup();
				$rows = $this->get('group');
				include($this->path.DS.'ajax'.DS.'group.php');
				break;

			case 'dropgroup':
				$model->dropGroup();
				$rows = $this->get('group');
				include($this->path.DS.'ajax'.DS.'group.php');
				break; 

			case 'setthumb':
				$model->setthumb();
				break;

			case 'setdefimg':
				$model->setdefimg();
				break;



			case 'quikedit':
				$model->quikedit();
				break;
		}
 		
	}
 
}
?>