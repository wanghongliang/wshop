<?php
class EvaluationController extends Controller{

	var $baseuri=null;
	function EvaluationController(){
		parent::__construct();
		$this->baseuri = 'index.php?com=evaluation';
		if( isset($_REQUEST['tmpl']) ){
			$this->baseuri .="&tmpl=".$_REQUEST['tmpl'];
		}

		if( $_REQUEST['return'] )
		{
			$this->baseuri = $_REQUEST['return'];
		}
 		//echo $_REQUEST['return'];exit;


	}

 
	/**
	 * 显示列表
	 */
	function display()
	{
		//取对应菜单列表模型
		$model = $this->getModel('evaluations');
	
		//视图模型
		$view = $this->getView('evaluations');
		
		//设置模型
		$view->setModel($model);
		//显示
		$view->display();
	}

	/** 添加 **/
	function add()
	{
		//取对应菜单列表模型
		$model = $this->getModel('evaluation');
	
		//视图模型
		$view = $this->getView('evaluation');

		//设置模型
		$view->setModel($model);

		//显示
		$view->display();
	}

	/** 添加 **/
	function edit()
	{
		//取对应菜单列表模型
		$model = $this->getModel('evaluation');
	
		//视图模型
		$view = $this->getView('evaluation');
 		//设置模型
		$view->setModel($model);

		//显示
		$view->edit();
	}


	/**
	 * 锁定一条记录
	 */
	function lock()
	{
		$model = $this->getModel('evaluation');
		$model->lock();
		//显示
		$this->redirect($this->baseuri);
	}

	/**
	 * 添加
	 */
	function save()
	{
		$model = $this->getModel('evaluation');
		$model->save(); 
		$this->redirect($this->baseuri,'保存成功！');
	}

	/**
	 * 锁定所选记录
	 */
	function lockall()
	{
		$model = $this->getModel('evaluation');
		$model->lockall();
		//显示
		$this->redirect($this->baseuri);
	}

	/**
	 * 解锁所选记录
	 */
	function unlockall()
	{
		$model = $this->getModel('evaluation');
		$model->unlockall();
		//显示
		$this->redirect($this->baseuri);
	}

	/**
	 * 删除一条记录
	 */
	function delete()
	{
		$model = $this->getModel('evaluation');
		$model->delete();
		//视图模型
		$this->redirect($this->baseuri,'删除成功！');
	}

	/**
	 * 删除所选记录
	 */
	function deleteall()
	{
		$model = $this->getModel('evaluation');
		$model->deleteall();
		//视图模型
		$this->redirect($this->baseuri);
	}


 
}	
?>