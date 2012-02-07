<?php
class CompaniesController extends Controller{

 	var $baseuri = null;
	function CompaniesController(){
		parent::__construct();
 
		$this->baseuri = 'index.php?com=companies';

 

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
		$model = $this->getModel('company');
	
		//视图模型
		$view = $this->getView('company');

		//设置模型
		$view->setModel($model);
		//显示
		$view->display();
	}

	function save()
	{
		//取对应菜单列表模型
		$model = $this->getModel('company');
		$model->save();
		$this->redirect($this->baseuri);
	}


 
}	
?>