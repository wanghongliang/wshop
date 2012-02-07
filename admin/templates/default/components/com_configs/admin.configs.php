<?php
class ConfigsController extends Controller{

 	var $baseuri = null;
	function ConfigsController(){
		parent::__construct();
 
		$this->baseuri = 'index.php?com=configs';

 
		if( isset($_REQUEST['tmpl']) ){
			$this->baseuri.="&tmpl=".$_REQUEST['tmpl'];
		}


		if(  is_array($_REQUEST['return']) )		//当是回收方法时，将返回到回收方法上
		{
			if( $_REQUEST['return']['task'] )
			{
				$this->baseuri.='&task='.$_REQUEST['return']['task'];
			}
		}


	}
 
	/**
	 * 显示列表
	 */
	function display()
	{
		//取对应菜单列表模型
		$model = $this->getModel('config');
	
		//视图模型
		$view = $this->getView('config');

		//设置模型
		$view->setModel($model);
		//显示
		$view->display();
	}

	function save()
	{
		//取对应菜单列表模型
		$model = $this->getModel('config');
		$model->save();
		$this->redirect($this->baseuri);
	}


 
}	
?>