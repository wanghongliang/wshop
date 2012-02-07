<?php
class PagesController extends Controller{

	var $menuid;	//当前菜单分类
	var $baseuri = null;
	function PagesController(){
		parent::__construct();
		$this->menuid = intval( $_REQUEST['menuid'] );

		$this->baseuri = 'index.php?com=pages&menuid='.$this->menuid;

		if( isset($_REQUEST['tmpl']) ){
			$this->baseuri.="&tmpl=".$_REQUEST['tmpl'];
		}
		if( isset($_REQUEST['mtid']) ){
			$this->baseuri.="&mtid=".$_REQUEST['mtid'];
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
		$model = $this->getModel('page');
	
		//视图模型
		$view = $this->getView('page');

		//设置模型
		$view->setModel($model);
		//显示
		$view->display();
	}

	function save()
	{
		//取对应菜单列表模型
		$model = $this->getModel('page');
		$model->save();
		$this->redirect($this->baseuri,'保存成功!');
	}


 
}	
?>