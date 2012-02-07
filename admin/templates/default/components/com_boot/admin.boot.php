<?php
class BootController extends Controller{
	function BootController(){
		parent::__construct();
	}

	/**
	 * 显示列表
	 */
	function display()
	{
		//取对应菜单列表模型
		$model = $this->getModel('boot');
	
		//视图模型
		$view = $this->getView('boot');

		//设置模型
		$view->setModel($model);
		

		if( $task = $_REQUEST['task'] ){
			$view->$task();
		}else{
			//显示
			$view->display();
		}
	}


	/**
	 * 清空
	 */
	function emptydata()
	{
		//取对应菜单列表模型
		$model = $this->getModel('boot');
		$model->emptyUserData();
		$this->redirect('index.php?com=users');
	}


	/**
	 * 导入数据
	 */
	function import()
	{
		$model = $this->getModel('boot');
		$model->import();
	}
 
}
?>