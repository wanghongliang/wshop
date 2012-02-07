<?php
class ComponentsController extends Controller{
 
	var $baseuri = null;
	function ComponentsController(){
		parent::__construct();
		$this->baseuri = 'index.php?com=components';
	}
 
	/**
	 * 显示列表
	 */
	function display()
	{
		//取对应菜单列表模型
		$model = $this->getModel('components');
	
		//视图模型
		$view = $this->getView('components');

		//设置模型
		$view->setModel($model);
		//显示
		$view->display();
	}

	/** 添加 **/
	function add()
	{
		//取对应菜单列表模型
		$model = $this->getModel('component');
	
		//视图模型
		$view = $this->getView('component');

		//设置模型
		$view->setModel($model);

		//显示
		$view->display();
	}

	/** 添加 **/
	function edit()
	{
		//取对应菜单列表模型
		$model = $this->getModel('component');
	
		//视图模型
		$view = $this->getView('component');

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
		$model = $this->getModel('component');
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
			$model = $this->getModel('component');
			$model->delete($id);
		}
		$this->redirect($this->baseuri);
	}


	/** 排序 **/
	function moveup()
	{
		if( ($id=intval($_REQUEST['id'])) > 0 ){
			import('application.tree');
			$tree = new Tree();
			$tree->moveup($id);
		}
		$this->redirect($this->baseuri);
	}

	/** 向下排序 **/
	function movedown()
	{
		if( ($id=intval($_REQUEST['id'])) > 0 ){
			import('application.tree');
			$tree = new Tree();
			$tree->movedown($id);
		}
		$this->redirect($this->baseuri);
	}
}	
?>