<?php
class ElitesController extends Controller{
	var $baseuri = null;
	function ElitesController(){
		parent::__construct();
		$this->baseuri = 'index.php?com=elites';
		
		if( isset($_REQUEST['s']) ){
			$this->baseuri .='&s='.$_REQUEST['s'];
		}else if( isset($_REQUEST['menuid']) ){
			$this->baseuri .='&s='.$_REQUEST['menuid'];
		}
	}

	/**
	 * 显示列表
	 */
	function display()
	{
		//取对应菜单列表模型
		$model = $this->getModel('elites');
	
		//视图模型
		$view = $this->getView('elites');

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
		$model = $this->getModel('elite');
	
		//视图模型
		$view = $this->getView('elite');

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
		$model = $this->getModel('elite');
	
		//视图模型
		$view = $this->getView('elite');

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
			$model = $this->getModel('elite');
			$model->delete($id);
		}
		//$this->redirect( $this->baseuri );
	}

	/**
	 * 添加
	 */
	function save()
	{
		$model = $this->getModel('elite');
		$model->save();
		if( $_REQUEST['return'] )
		{
			$this->redirect($_REQUEST['return'],'保存成功!');
		}else{
			$this->redirect($this->baseuri,'保存成功!');
		}
	}
	/** 排序列表 **/
	function ordering()
	{

 		$model = $this->getModel('elite');
		$model->ordering();
 		//视图模型
		$this->redirect($this->baseuri);
	}

	function selectproducts(){
		$model = $this->getModel('elites');
		$model->selectproducts();
		if( $_REQUEST['return'] )
		{
			$this->redirect($_REQUEST['return']);
		}else{
			$this->redirect($this->baseuri);
		}
	}
	function deleleall(){
		$model = $this->getModel('elite');
		$model->deleleall();
 		//视图模型
		$this->redirect($this->baseuri);
	}

	/** 修改状态 **/
	function toggle()
	{
		$model = $this->getModel('elite');
		$model->toggle();
 		//视图模型
		$this->redirect($this->baseuri);
	} 
}
?>