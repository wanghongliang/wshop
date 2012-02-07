<?php
class UsersController extends Controller{
 
	var $baseuri = null;
	function UsersController(){
		parent::__construct();
		$this->baseuri = 'index.php?com=users';

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
		$model = $this->getModel('users');
	
		//视图模型
		$view = $this->getView('users');

		//设置模型
		$view->setModel($model);
		//显示
		$view->display();
	}

	/** 添加 **/
	function add()
	{
		//取对应菜单列表模型
		$model = $this->getModel('user');
	
		//视图模型
		$view = $this->getView('user');

		//设置模型
		$view->setModel($model);

		//显示
		$view->display();
	}

	/** 添加 **/
	function edit()
	{
		//取对应菜单列表模型
		$model = $this->getModel('user');
	
		//视图模型
		$view = $this->getView('user');

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
		$model = $this->getModel('user');
		$model->save();

		if( $_REQUEST['return'] ){ $this->redirect($this->baseuri);
		}else{
		//echo $_REQUEST['return'];exit;
		//视图模型
		$view = $this->getView('user');
		$view->success();
		}
	}

 
	/**
	 * 删除
	 */
	function del()
	{
		if( ($id=intval($_REQUEST['id'])) > 0 ){
			$model = $this->getModel('user');
			$model->delete($id);
		}
		$this->redirect($this->baseuri);
	}


	/** 复制一份 **/
	function copy()
	{
		$model = $this->getModel('user');
		$model->copy();
 		//视图模型
		$this->redirect($this->baseuri);
	}

	function deleleall(){
		$model = $this->getModel('user');
		$model->deleleall();
 		//视图模型
		$this->redirect($this->baseuri);
	}

	/** 排序 **/
	function moveup()
	{
 
	}

	/** 向下排序 **/
	function movedown()
	{
 
	}

	/** 添加选择的模块内容 **/
	function selectadd()
	{
		//取对应菜单列表模型
		$model = $this->getModel('user');
		//视图模型
		$view = $this->getView('user');
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