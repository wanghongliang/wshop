<?php
class OrdersController extends Controller{

	var $menuid;	//当前菜单分类
	var $baseuri = null;
	function OrdersController(){
		parent::__construct();
		$this->menuid = intval( $_REQUEST['menuid'] );

		$this->baseuri = 'index.php?com=orders';

		if( isset($_REQUEST['tmpl']) ){
			$this->baseuri.="&tmpl=".$_REQUEST['tmpl'];
		}


		if(  is_array($_REQUEST['return']) )		//当是回收方法时，将返回到回收方法上
		{
			if( $_REQUEST['return']['task'] )
			{
				$this->baseuri.='&task='.$_REQUEST['return']['task'];
			}
		}

	}
 
	/**
	 * 显示列表
	 */
	function display()
	{
		//取对应菜单列表模型
		$model = $this->getModel('orders');
	
		//视图模型
		$view = $this->getView('orders');

		//设置模型
		$view->setModel($model);
		//显示
		$view->display();
	}


	/**
	 * 附件
	 */
	function accessories(){
		//取对应菜单列表模型
		$model = $this->getModel('accessories');
		$model->dispath();
	}

	/**
	 * 菜单操作方式
	 */
	function recycle()
	{
		//取对应菜单列表模型
		$model = $this->getModel('orders');
		//视图模型
		$view = $this->getView('orders');
		//设置模型
		$view->setModel($model);
		//显示
		$view->recycle();
	}


	/** 添加 **/
	function add()
	{
		//取对应菜单列表模型
		$model = $this->getModel('order');
	
		//视图模型
		$view = $this->getView('order');

		//设置模型
		$view->setModel($model);

		//显示
		$view->display();
	}

	/** 添加 **/
	function edit()
	{
		//取对应菜单列表模型
		$model = $this->getModel('order');
	
		//视图模型
		$view = $this->getView('order');

		//设置模型
		$view->setModel($model);

		//显示
		$view->edit();
	}

	
	//操作
	function opt(){
		//取对应菜单列表模型
		$model = $this->getModel('order');
	
		//视图模型
		$view = $this->getView('order');

		//设置模型
		$view->setModel($model);

		//显示
		$view->display();
	}
 
	/**
	 * 添加
	 */
	function save()
	{
		//取对应菜单列表模型
		$model = $this->getModel('order');
	
		//视图模型
		$view = $this->getView('order');

		//设置模型
		$view->setModel($model);
		//显示
		$view->save();
 
		/**
		//echo $_REQUEST['return'];exit;
		if( $_REQUEST['return'] )
		{
			$this->redirect($_REQUEST['return']);
		}else{
			$this->redirect($this->baseuri,'保存成功!');
		}
		**/
	}


	function savestatus(){
 		$model = $this->getModel('order');
		$model->savestatus();
		if( $_REQUEST['return'] )
		{
			$this->redirect($_REQUEST['return']);
		}else{
			$this->redirect($this->baseuri,'保存成功!');
		}
	}

	/**
	 * 删除
	 */
	function del()
	{
		if( ($id=intval($_REQUEST['id'])) > 0 ){
			$model = $this->getModel('order');
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

	/** 选择一篇文章 **/
	function selectarticle()
	{
		//取对应菜单列表模型
		$model = $this->getModel('order');
	
		//视图模型
		$view = $this->getView('order');

		//设置模型
		$view->setModel($model);

		//显示
		$view->selectarticle();
	}


	/** 转移选择菜单 **/
	function selectmenu()
	{
		//视图模型
		$view = $this->getView('order');
		//显示
		$view->selectmenu();
	}

	/** 移动到指定菜单 **/
	function moveall()
	{
		//取对应菜单列表模型
		$model = $this->getModel('order');
		$model->moveall();
		$this->redirect($this->baseuri);
	}
	/** 复制一份 **/
	function copy()
	{
		$model = $this->getModel('order');
		$model->copy();
 		//视图模型
		$this->redirect($this->baseuri);
	}

	function deleleall(){
		$model = $this->getModel('order');
		$model->deleleall();
 		//视图模型
		$this->redirect($this->baseuri);
	}

	/** 移入回收站 **/
	function movetorecycle()
	{
		$model = $this->getModel('order');
		$model->movetorecycle();
 		//视图模型
		$this->redirect($this->baseuri);

	}
	/** 修改状态 **/
	function toggle()
	{
		$model = $this->getModel('order');
		$model->toggle();
 		//视图模型
		$this->redirect($this->baseuri);
	}

	/** 排序列表 **/
	function ordering()
	{

 		$model = $this->getModel('order');
		$model->ordering();
 		//视图模型
		$this->redirect($this->baseuri);
	}

	/** 锁定/解锁 **/
	function unlock()
	{
		$model = $this->getModel('orders');
		$model->unlock();
 		//视图模型
		$this->redirect($this->baseuri);

	}

	function lock()
	{
		$model = $this->getModel('orders');
		$model->lock();
 		//视图模型
		$this->redirect($this->baseuri);

	}
	/** 锁定/解锁 **/
	function unisfront()
	{
		$model = $this->getModel('orders');
		$model->unlock('isfront');
 		//视图模型
		$this->redirect($this->baseuri);

	}

	function isfront()
	{
		$model = $this->getModel('orders');
		$model->lock('isfront');
 		//视图模型
		$this->redirect($this->baseuri);
	}



}	
?>