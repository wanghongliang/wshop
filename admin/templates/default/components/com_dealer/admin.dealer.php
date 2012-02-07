<?php
define('GROUP_DEALER',17);

class DealerController extends Controller{
 
	var $baseuri = null;
	function DealerController(){
		parent::__construct();
		$this->baseuri = 'index.php?com=dealer';

		if( $_REQUEST['return'] )
		{
			$this->baseuri = $_REQUEST['return'];
		}
	}
 
	/**
	 * 显示列表
	 */
	function display()
	{
		//取对应菜单列表模型
		$model = $this->getModel('dealers');
	
		//视图模型
		$view = $this->getView('dealers');

		//设置模型
		$view->setModel($model);
		//显示
		$view->display();
	}

	/** 添加 **/
	function add()
	{
		//取对应菜单列表模型
		$model = $this->getModel('dealer');
	
		//视图模型
		$view = $this->getView('dealer');

		//设置模型
		$view->setModel($model);

		//显示
		$view->display();
	}

	/** 添加 **/
	function edit()
	{
		//取对应菜单列表模型
		$model = $this->getModel('dealer');
	
		//视图模型
		$view = $this->getView('dealer');

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
		$model = $this->getModel('dealer');
		if( !$model->save() ){
			//$this->redirect($this->baseuri.'&task=add');
			$this->add();
		}else{
			$this->redirect($this->baseuri);
		}
	 
	}
	function save2()
	{
		$model = $this->getModel('dealer');
		$model->save2(); 
		if( $_REQUEST['return'] ){ 
			$this->redirect($this->baseuri);
		}else{
			//echo $_REQUEST['return'];exit;
			//视图模型
			$view = $this->getView('dealer');
			$view->success();
		}
	}

	function setdefault(){
		$model = $this->getModel('dealer');
		$model->setDefault();
 		$this->redirect($this->baseuri);
 	}


	/**
	 * 删除
	 */
	function del()
	{
		if( ($id=intval($_REQUEST['id'])) > 0 ){
			$model = $this->getModel('dealer');
			$model->delete($id);
		}
		$this->redirect($this->baseuri);
	}


	/** 复制一份 **/
	function copy()
	{
		$model = $this->getModel('dealer');
		$model->copy();
 		//视图模型
		$this->redirect($this->baseuri);
	}

	function deleleall(){
		$model = $this->getModel('dealer');
		$model->deleleall();
 		//视图模型
		$this->redirect($this->baseuri);
	}

	/** 排序 **/
	function ajax()
	{
 		$model = $this->getModel('dealer');
		$model->ajax();
	}

	/** 添加选择的模块内容 **/
	function selectadd()
	{
		//取对应菜单列表模型
		$model = $this->getModel('dealer');
		//视图模型
		$view = $this->getView('dealer');
		//设置模型
		$view->setModel($model);
		$view->select();		//选择模块内型
	}


	
	/** 会员退出 **/
	function logout()
	{
		$session =& Factory::getSession();
		$session->destroy();
		$this->redirect('/');
	}

}	
?>