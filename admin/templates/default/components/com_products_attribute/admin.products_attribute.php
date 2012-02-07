<?php
class Products_attributeController extends Controller{
	var $baseuri = null;
	function Products_attributeController(){
		parent::__construct();

		if( $_GET['menuid']>0 ){ $_GET['type_id'] = $_GET['menuid']; } //这里为了实现提交排序的BUG
		$this->baseuri = 'index.php?com=products_attribute&type_id='.(int)$_GET['type_id'];

	}

	/**
	 * 显示列表
	 */
	function display()
	{
		//取对应菜单列表模型
		$model = $this->getModel('attributes');
	
		//视图模型
		$view = $this->getView('attributes');

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
		$model = $this->getModel('attribute');
	
		//视图模型
		$view = $this->getView('attribute');

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
		$model = $this->getModel('attribute');
	
		//视图模型
		$view = $this->getView('attribute');

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
			$model = $this->getModel('attribute');
			$model->delete($id);
		}
		$this->redirect( $this->baseuri );
	}

	/**
	 * 添加
	 */
	function save()
	{
		$model = $this->getModel('attribute');
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
		$model = $this->getModel('attribute');
		$model->toggle();
 		//视图模型
		$this->redirect($this->baseuri);
	} 


	function deleleall(){
		$model = $this->getModel('attributes');
		$model->deleleall();
 		//视图模型
		$this->redirect($this->baseuri);
	}

	
	/** 排序列表 **/
	function ordering()
	{

 		$model = $this->getModel('attribute');
		$model->ordering();
 		//视图模型
		$this->redirect($this->baseuri);
	}

}
?>