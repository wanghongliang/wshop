<?php
class TuansController extends Controller{

	var $baseuri=null;
	function TuansController(){
		parent::__construct();
		$this->baseuri = 'index.php?com=tuans';
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
		$model = $this->getModel('tuans');
	
		//视图模型
		$view = $this->getView('tuans');
		
		//设置模型
		$view->setModel($model);
		//显示
		$view->display();
	}

	/** 添加 **/
	function add()
	{
		//取对应菜单列表模型
		$model = $this->getModel('tuan');
	
		//视图模型
		$view = $this->getView('tuan');

		//设置模型
		$view->setModel($model);

		//显示
		$view->display();
	}

	/** 添加 **/
	function edit()
	{
		//取对应菜单列表模型
		$model = $this->getModel('tuan');
	
		//视图模型
		$view = $this->getView('tuan');
 		//设置模型
		$view->setModel($model);

		//显示
		$view->edit();
	}


	/**
	 * 锁定一条记录
	 */
	function setstatu()
	{
		$model = $this->getModel('tuan');
		$model->setstatu();
		//显示
		$this->redirect($this->baseuri);
	}

	/**
	 * 添加
	 */
	function save()
	{
		$model = $this->getModel('tuan');
		$model->save(); 
		$this->redirect($this->baseuri,'保存成功！');
	}

	/**
	 * 锁定所选记录
	 */
	function lockall()
	{
		$model = $this->getModel('tuan');
		$model->lockall();
		//显示
		$this->redirect($this->baseuri);
	}

	/**
	 * 解锁所选记录
	 */
	function unlockall()
	{
		$model = $this->getModel('tuan');
		$model->unlockall();
		//显示
		$this->redirect($this->baseuri);
	}

	/**
	 * 删除一条记录
	 */
	function delete()
	{
		$model = $this->getModel('tuan');
		$model->delete();
		//视图模型
		$this->redirect($this->baseuri,'删除成功！');
	}

	/**
	 * 删除所选记录
	 */
	function deleteall()
	{
		$model = $this->getModel('tuan');
		$model->deleteall();
		//视图模型
		$this->redirect($this->baseuri);
	}


 
}	
?>