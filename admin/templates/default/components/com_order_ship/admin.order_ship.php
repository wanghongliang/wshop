<?php
class Order_shipController extends Controller{

 	var $baseuri = null;
	function Order_shipController(){
		parent::__construct();
 		$this->baseuri = 'index.php?com=order_ship';
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
		$model = $this->getModel('order_ship');
	
		//视图模型
		$view = $this->getView('order_ship');

		//设置模型
		$view->setModel($model);
		//显示
		$view->display();
	}
 

	/** 添加 **/
	function edit()
	{
		//取对应菜单列表模型
		$model = $this->getModel('order_ship');
	
		//视图模型
		$view = $this->getView('order_ship');

		//设置模型
		$view->setModel($model);

		//显示
		$view->show();
	}

	/**
	 * 删除
	 */
	function del()
	{
		if( ($id=intval($_REQUEST['id'])) > 0 ){
			$model = $this->getModel('order_ship');
			$model->delete($id);
		}
		$this->redirect($this->baseuri);
	}
	 



}	
?>