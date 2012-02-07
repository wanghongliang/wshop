<?php
class LevelController extends Controller{
	var $baseuri = null;
	function LevelController(){
		parent::__construct();
		$this->baseuri = 'index.php?com=level';
	}

	/**
	 * 显示列表
	 */
	function display()
	{
		//取对应菜单列表模型
		$model = $this->getModel('levels');
	
		//视图模型
		$view = $this->getView('levels');

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
		$model = $this->getModel('level');
	
		//视图模型
		$view = $this->getView('level');

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
		$model = $this->getModel('level');
	
		//视图模型
		$view = $this->getView('level');

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
			$model = $this->getModel('level');
			$model->delete($id);
		}
		$this->redirect( $this->baseuri );
	}

	/**
	 * 添加
	 */
	function save()
	{
		$model = $this->getModel('level');
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
		$model = $this->getModel('level');
		$model->toggle();
 		//视图模型
		$this->redirect($this->baseuri);
	} 
}
?>