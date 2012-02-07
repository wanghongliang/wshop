<?php
class InstallerController extends Controller{
 
	var $baseuri = null;
	function InstallerController(){
		parent::__construct();
		$this->baseuri = 'index.php?com=installer';
	}
 
	/**
	 * 显示列表
	 */
	function display()
	{
		//取对应菜单列表模型
		$model = $this->getModel('installer');
	
		//视图模型
		$view = $this->getView('installer');

		//设置模型
		$view->setModel($model);
		//显示
		$view->display();
	}

	/** 添加 **/
	function add()
	{
		//取对应菜单列表模型
		$model = $this->getModel('installer');
	
		//视图模型
		$view = $this->getView('installer');

		//设置模型
		$view->setModel($model);

		//显示
		$view->display();
	}

	/** 添加 **/
	function edit()
	{
		//取对应菜单列表模型
		$model = $this->getModel('installer');
	
		//视图模型
		$view = $this->getView('installer');

		//设置模型
		$view->setModel($model);

		//显示
		$view->edit();
	}
 
	/**
	 * 添加
	 */
	function save()
	{
		$model = $this->getModel('installer');
		$model->save();
		//echo $_REQUEST['return'];exit;
		if( $_REQUEST['return'] )
		{
			$this->redirect($_REQUEST['return']);
		}else{
			$this->redirect($this->baseuri);
		}
	}

	/**
	 * 删除
	 */
	function del()
	{
		if( ($id=intval($_REQUEST['id'])) > 0 ){
			$model = $this->getModel('installer');
			$model->delete($id);
		}
		$this->redirect($this->baseuri);
	}

	/**
	 * 安装上传
	 */
	function uploadinstaller()
	{
 		$model = $this->getModel('installer');
		$model->uploadinstaller();


 		$this->redirect($this->baseuri);
	}
}	
?>