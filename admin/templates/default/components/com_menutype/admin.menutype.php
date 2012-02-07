<?php
class MenutypeController extends Controller{
	function MenutypeController(){
		parent::__construct();
	}

	/**
	 * 显示列表
	 */
	function display()
	{
		//取对应菜单列表模型
		$model = $this->getModel('menutypes');
	
		//视图模型
		$view = $this->getView('menutypes');

		//设置模型
		$view->setModel($model);

		//显示
		$view->display();
	}

	/**
	 * 添加
	 */
	function add()
	{
 		//取对应菜单列表模型
		$model = $this->getModel('menutype');
	
		//视图模型
		$view = $this->getView('menutype');

		//设置模型
		$view->setModel($model);
		//显示
		$view->display();
	}

	/**
	 * 编辑
	 */
	function edit()
	{
 		//取对应菜单列表模型
		$model = $this->getModel('menutype');
	
		//视图模型
		$view = $this->getView('menutype');

		//设置模型
		$view->setModel($model);
		//显示
		$view->edit();
	}


	/**
	 * 删除
	 */
	function del()
	{
		if( ($id=intval($_REQUEST['id'])) > 0 ){
 			//取对应菜单列表模型
			$model = $this->getModel('menutype');
			$model->delete($id);
		}
		$this->redirect('index.php?com=menutype');
	}

	/**
	 * 添加
	 */
	function save()
	{
		$model = $this->getModel('menutype');
		$model->save();
		$this->redirect('index.php?com=menutype');
	}

	/**
	 * 移动
	 */
	function move()
	{
 		
	}
}
?>