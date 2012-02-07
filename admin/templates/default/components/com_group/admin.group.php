<?php
class GroupController extends Controller{
	function GroupController(){
		parent::__construct();
	}
 
	/**
	 * 显示列表
	 */
	function display()
	{
		//取对应菜单列表模型
		$model = $this->getModel('groups');
	
		//视图模型
		$view = $this->getView('groups');
	
		//设置模型
		$view->setModel($model);

		//显示
		$view->display();
	}

	/** 添加 **/
	function add()
	{
		//取对应菜单列表模型
		$model = $this->getModel('group');
	
		//视图模型
		$view = $this->getView('group');

		//设置模型
		$view->setModel($model);

		//显示
		$view->display();
	}
 	function edit()
	{
		//取对应菜单列表模型
		$model = $this->getModel('group');
	
		//视图模型
		$view = $this->getView('group');
 		//设置模型
		$view->setModel($model);

		//显示
		$view->edit();
	}
 	function save()
	{
		$model = $this->getModel('group');
		$model->save();
		//echo $_REQUEST['return'];exit;
		if( $_REQUEST['return'] )
		{
			$this->redirect($_REQUEST['return'],'保存 <b>'.$_REQUEST['name'].'</b> 成功!');
		}else{
			$this->redirect('index.php?com=group','保存 <b>'.$_REQUEST['name'].'</b> 成功!');
		}
	}

	/**
	 * 删除
	 */
	function del()
	{
		$model = $this->getModel('group');
		$model->del();
		$this->redirect('index.php?com=group');
	}
	/** 排序 **/
	function moveup()
	{
		if( ($id=intval($_REQUEST['id'])) > 0 ){
			$helperFile = PATH_COMPONENT.DS.'helper'.DS.'group.php';
			include($helperFile);

			$tree = new groupHelper();
			$tree->moveup($id);
		}
		$this->redirect('index.php?com=group');
	}

	/** 向下排序 **/
	function movedown()
	{
		if( ($id=intval($_REQUEST['id'])) > 0 ){
			$helperFile = PATH_COMPONENT.DS.'helper'.DS.'group.php';
			include($helperFile);

			$tree = new groupHelper();
			$tree->movedown($id);
		}
		$this->redirect('index.php?com=group');
	}

	/** 修改状态 **/
	function toggle()
	{
		$model = $this->getModel('group');
		$model->toggle();
 		//视图模型
		$this->redirect('index.php?com=group&mtid='.$this->menutypeid);
	}


	/** 锁定/解锁 **/
	function unlock()
	{
		$model = $this->getModel('group');
		$model->unlock();
 		//视图模型
		$this->redirect('index.php?com=group&mtid='.$this->menutypeid);

	}

	function lock()
	{
		$model = $this->getModel('group');
		$model->lock();
 		//视图模型
		$this->redirect('index.php?com=group&mtid='.$this->menutypeid);

	}

}
?>