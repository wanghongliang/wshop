<?php
class FeedbacksController extends Controller{

	var $baseuri=null;
	function FeedbacksController(){
		parent::__construct();
		$this->baseuri = 'index.php?com=feedbacks';
		if( isset($_REQUEST['tmpl']) ){
			$this->baseuri .="&tmpl=".$_REQUEST['tmpl'];
		}
	}

 
	/**
	 * 显示列表
	 */
	function display()
	{
		//取对应菜单列表模型
		$model = $this->getModel('feedbacks');
	
		//视图模型
		$view = $this->getView('feedbacks');
		
		//设置模型
		$view->setModel($model);
		//显示
		$view->display();
	}

	/** 添加 **/
	function add()
	{
		//取对应菜单列表模型
		$model = $this->getModel('feedback');
	
		//视图模型
		$view = $this->getView('feedback');

		//设置模型
		$view->setModel($model);

		//显示
		$view->display();
	}

	/** 添加 **/
	function edit()
	{
		//取对应菜单列表模型
		$model = $this->getModel('feedback');
	
		//视图模型
		$view = $this->getView('feedback');
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
		$model = $this->getModel('feedback');
		$model->lock();
		//显示
		$this->redirect($this->baseuri);
	}

	/**
	 * 添加
	 */
	function save()
	{
		$model = $this->getModel('feedback');
		$model->save();
		
		$this->redirect($this->baseuri,'保存成功！');
	}

	/**
	 * 锁定所选记录
	 */
	function lockall()
	{
		$model = $this->getModel('feedback');
		$model->lockall();
		//显示
		$this->redirect($this->baseuri);
	}

	/**
	 * 解锁所选记录
	 */
	function unlockall()
	{
		$model = $this->getModel('feedback');
		$model->unlockall();
		//显示
		$this->redirect($this->baseuri);
	}

	/**
	 * 删除一条记录
	 */
	function delete()
	{
		$model = $this->getModel('feedback');
		$model->delete();
		//视图模型
		$this->redirect($this->baseuri,'删除成功！');
	}

	/**
	 * 删除所选记录
	 */
	function deleteall()
	{
		$model = $this->getModel('feedback');
		$model->deleteall();
		//视图模型
		$this->redirect($this->baseuri);
	}


	/** 向上排序 **/
	function moveup()
	{
		if( ($id=intval($_REQUEST['id'])) > 0 ){
			import('application.tree');
			$tree = new Tree();
			$tree->moveup($id);
		}
		$this->redirect('index.php?com=menu&mtid='.$this->menutypeid);
	}

	/** 向下排序 **/
	function movedown()
	{
		if( ($id=intval($_REQUEST['id'])) > 0 ){
			import('application.tree');
			$tree = new Tree();
			$tree->movedown($id);
		}
		$this->redirect('index.php?com=menu&mtid='.$this->menutypeid);
	}
}	
?>