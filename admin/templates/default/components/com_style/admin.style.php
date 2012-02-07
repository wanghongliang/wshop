<?php
class StyleController extends Controller{
	function StyleController(){
		parent::__construct();
	}

	/**
	 * 显示列表
	 */
	function display()
	{
		//取对应菜单列表模型
		$model = $this->getModel('style');
	
		//视图模型
		$view = $this->getView('style');

		//设置模型
		$view->setModel($model);

		//显示
		$view->display();
	}

	/**
	 * AJAX方式取模块列表信息
	 */
	function selectmodule()
	{
		//取对应菜单列表模型
		$model = $this->getModel('style');
	
		//视图模型
		$view = $this->getView('style');

		//设置模型
		$view->setModel($model);

		//显示
		$view->showSelectModule();
	}
 

	/**
	 * ajax 方式保存布局样式
	 */
	function savelayout()
	{
		//取对应菜单列表模型
		$model = $this->getModel('style');
		$model->savelayout();
	}

	/**
	 * 模板列表
	 */
	function selecttemplate()
	{
		//取对应菜单列表模型
		$model = $this->getModel('style');
		//视图模型
		$view = $this->getView('style');
		//设置模型
		$view->setModel($model);
		//显示
		$view->selecttemplate();
	}
}
?>