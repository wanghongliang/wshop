<?php
class ActivitiesController extends Controller{
	var $baseuri = null;
	function ActivitiesController(){
		parent::__construct();
		$this->baseuri = 'index.php?com=activities';
	}

	/**
	 * 显示列表
	 */
	function display()
	{
		//取对应菜单列表模型
		$model = $this->getModel('acts');
	
		//视图模型
		$view = $this->getView('acts');

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
		$model = $this->getModel('act');
	
		//视图模型
		$view = $this->getView('act');

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
		$model = $this->getModel('act');
	
		//视图模型
		$view = $this->getView('act');

		//设置模型
		$view->setModel($model);
		//显示
		$view->edit();
	}

	function ajax()
	{
 		//取对应菜单列表模型
		$model = $this->getModel('act');
	
		//视图模型
		$view = $this->getView('act');

		//设置模型
		$view->setModel($model);
		//显示
		$view->ajax();
	}
	/**
	 * 删除
	 */
	function del()
	{
		if( ($id=intval($_REQUEST['id'])) > 0 ){
 			//取对应菜单列表模型
			$model = $this->getModel('act');
			$model->delete($id);
		}
		$this->redirect( $this->baseuri );
	}

	/**
	 * 添加
	 */
	function save()
	{
		$model = $this->getModel('act');
		$model->save();
		if( $_REQUEST['return'] )
		{
			$this->redirect($_REQUEST['return'],'保存成功!');
		}else{
			$this->redirect($this->baseuri,'保存成功!');
		}
	}


	/** 修改状态 **/
	function toggle()
	{
		$model = $this->getModel('act');
		$model->toggle();
 		//视图模型
		$this->redirect($this->baseuri);
	} 
}
?>