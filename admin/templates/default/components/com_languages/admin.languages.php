<?php
class LanguagesController extends Controller{
 
	var $baseuri = null;
	function LanguagesController(){
		parent::__construct();
		$this->baseuri = 'index.php?com=languages';
	}
 
	/**
	 * 显示列表
	 */
	function display()
	{
		//取对应菜单列表模型
		$model = $this->getModel('languages');
	
		//视图模型
		$view = $this->getView('languages');

		//设置模型
		$view->setModel($model);
		//显示
		$view->display();
	}

	function type(){
		//取对应菜单列表模型
		$model = $this->getModel('languages');
	
		//视图模型
		$view = $this->getView('languages');

		//设置模型
		$view->setModel($model);
		//显示
		$view->typelist();
	}


	function setDefault()
	{
		$model = $this->getModel('languages');
		$model->setDefault();
 		$this->redirect($this->baseuri.'&task=type');

	}
	function addtype(){
		//取对应菜单列表模型
		$model = $this->getModel('languages');
	
		//视图模型
		$view = $this->getView('languages');

		//设置模型
		$view->setModel($model);
		//显示
		$view->addtype();
	}
 	/** 添加 **/
	function edittype()
	{
		//取对应菜单列表模型
		$model = $this->getModel('languages');
	
		//视图模型
		$view = $this->getView('languages');

		//设置模型
		$view->setModel($model);

		//显示
		$view->edittype();
	}

	/** 保存 **/
	function savetype()
	{
		//取对应菜单列表模型
		$model = $this->getModel('languages');
		$model->savetype();
		
		if( $_REQUEST['return']  )
		{
 			$this->redirect($_REQUEST['return']);
		}else{

 			$this->redirect($this->baseuri.'&task=type');
		}
	}	

	/** 锁定/解锁 **/
	function unlock()
	{
		$model = $this->getModel('languages');
		$model->unlock();
 		$this->redirect($this->baseuri.'&task=type');

	}

	function lock()
	{
		$model = $this->getModel('languages');
		$model->lock();
 		$this->redirect($this->baseuri.'&task=type');

	}

	/** 修改状态 **/
	function toggle()
	{
		$model = $this->getModel('languages');
		$model->toggle();
 		//视图模型
		$this->redirect($this->baseuri.'&task=type');
	}
	/**
	 * 删除
	 */
	function deltype()
	{
		if( ($id=intval($_REQUEST['id'])) > 0 ){
			$model = $this->getModel('languages');
			$model->delete($id);
		}
		$this->redirect($this->baseuri.'&task=type');
	}
	/** 保存 **/
	function save()
	{
		//取对应菜单列表模型
		$model = $this->getModel('languages');
		$model->save();

 		$this->redirect($this->baseuri);
 	}	

	/** 排序 **/
	function moveorder()
	{
		//取对应菜单列表模型
		$model = $this->getModel('languages');
		$model->moveorder();

	}
}	
?>