<?php
class CouponController extends Controller{
	var $baseuri = null;
	function CouponController(){
		parent::__construct();
		$this->baseuri = 'index.php?com=coupon';
	}

	/**
	 * 显示列表
	 */
	function display()
	{
		//取对应菜单列表模型
		$model = $this->getModel('coupons');
	
		//视图模型
		$view = $this->getView('coupons');

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
		$model = $this->getModel('coupon');
	
		//视图模型
		$view = $this->getView('coupon');

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
		$model = $this->getModel('coupon');
	
		//视图模型
		$view = $this->getView('coupon');

		//设置模型
		$view->setModel($model);
		//显示
		$view->edit();
	}

	function ajax()
	{
 		//取对应菜单列表模型
		$model = $this->getModel('coupon');
	
		//视图模型
		$view = $this->getView('coupon');

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
			$model = $this->getModel('coupon');
			$model->delete($id);
		}
		$this->redirect( $this->baseuri );
	}

	/**
	 * 添加
	 */
	function save()
	{
		$model = $this->getModel('coupon');
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
		$model = $this->getModel('coupon');
		$model->toggle();
 		//视图模型
		$this->redirect($this->baseuri);
	} 
}
?>