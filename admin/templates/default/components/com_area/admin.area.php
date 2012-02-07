<?php
class AreaController extends Controller{
	function AreaController(){
		parent::__construct();
	}
 
	/**
	 * 显示列表
	 */
	function display()
	{
		//取对应菜单列表模型
		$model = $this->getModel('areas');
	
		//视图模型
		$view = $this->getView('areas');
	
		//设置模型
		$view->setModel($model);

		//显示
		$view->display();
	}

	/** 添加 **/
	function add()
	{
		//取对应菜单列表模型
		$model = $this->getModel('area');
	
		//视图模型
		$view = $this->getView('area');

		//设置模型
		$view->setModel($model);

		//显示
		$view->display();
	}
 	function edit()
	{
		//取对应菜单列表模型
		$model = $this->getModel('area');
	
		//视图模型
		$view = $this->getView('area');
 		//设置模型
		$view->setModel($model);

		//显示
		$view->edit();
	}
 	function save()
	{
		$model = $this->getModel('area');
		$model->save();
		//echo $_REQUEST['return'];exit;
		if( $_REQUEST['return'] )
		{
			$this->redirect($_REQUEST['return'],'保存 <b>'.$_REQUEST['name'].'</b> 成功!');
		}else{

			//if( $_GET['no_html'] == '1' ){
			//	$this->redirect('index.php?com=area','保存 <b>'.$_REQUEST['name'].'</b> 成功!');
			//}else{
				$view = $this->getView('area');
				$view->success();
			//}
		}
	}
 

	/**
	 * 删除
	 */
	function del()
	{
		$model = $this->getModel('area');
		$model->del();
		//$this->redirect('index.php?com=area');
	}
	/** 排序 **/
	function moveup()
	{
		if( ($id=intval($_REQUEST['id'])) > 0 ){
			$helperFile = PATH_COMPONENT.DS.'helper'.DS.'area.php';
			include($helperFile);

			$tree = new AreaHelper();
			$tree->moveup($id);
		}
		$this->redirect('index.php?com=area');
	}

	/** 向下排序 **/
	function movedown()
	{
		if( ($id=intval($_REQUEST['id'])) > 0 ){
			$helperFile = PATH_COMPONENT.DS.'helper'.DS.'area.php';
			include($helperFile);

			$tree = new AreaHelper();
			$tree->movedown($id);
		}
		$this->redirect('index.php?com=area');
	}

	/** 修改状态 **/
	function toggle()
	{
		$model = $this->getModel('area');
		$model->toggle();
 		//视图模型
		$this->redirect('index.php?com=area&mtid='.$this->menutypeid);
	}


	/** 锁定/解锁 **/
	function unlock()
	{
		$model = $this->getModel('area');
		$model->unlock();
 		//视图模型
		$this->redirect('index.php?com=area&mtid='.$this->menutypeid);

	}

	function lock()
	{
		$model = $this->getModel('area');
		$model->lock();
 		//视图模型
		$this->redirect('index.php?com=area&mtid='.$this->menutypeid);

	}


	function import(){
		$model = $this->getModel('area');
		$model->import();
	}

	function ajax(){
 		//取对应菜单列表模型
		$model = $this->getModel('areas');
	
		//视图模型
		$view = $this->getView('areas');
 		//设置模型
		$view->setModel($model);

		//显示
		$view->ajax();
	}

}
?>