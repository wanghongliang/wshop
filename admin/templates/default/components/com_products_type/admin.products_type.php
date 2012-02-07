<?php
class Products_typeController extends Controller{
	var $baseuri = null;
	function Products_typeController(){
		parent::__construct();
		$this->baseuri = 'index.php?com=products_type';
	}

	/**
	 * 显示列表
	 */
	function display()
	{
		//取对应菜单列表模型
		$model = $this->getModel('types');
	
		//视图模型
		$view = $this->getView('types');

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
		$model = $this->getModel('type');
	
		//视图模型
		$view = $this->getView('type');

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
		$model = $this->getModel('type');
	
		//视图模型
		$view = $this->getView('type');

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
			$model = $this->getModel('type');
			$model->delete($id);
		}
		$this->redirect( $this->baseuri );
	}

	/**
	 * 添加
	 */
	function save()
	{
		$model = $this->getModel('type');
		$model->save();
		$this->redirect( $this->baseuri );
	}


	/** 修改状态 **/
	function toggle()
	{
		$model = $this->getModel('type');
		$model->toggle();
 		//视图模型
		$this->redirect($this->baseuri);
	} 
}
?>