<?php
class CategoryController extends Controller{
	function CategoryController(){
		parent::__construct();
	}
 
	/**
	 * 显示列表
	 */
	function display()
	{
		//取对应菜单列表模型
		$model = $this->getModel('categorys');
	
		//视图模型
		$view = $this->getView('categorys');
	
		//设置模型
		$view->setModel($model);

		//显示
		$view->display();
	}

	/** 添加 **/
	function add()
	{
		//取对应菜单列表模型
		$model = $this->getModel('category');
	
		//视图模型
		$view = $this->getView('category');

		//设置模型
		$view->setModel($model);

		//显示
		$view->display();
	}
 	function edit()
	{
		//取对应菜单列表模型
		$model = $this->getModel('category');
	
		//视图模型
		$view = $this->getView('category');
 		//设置模型
		$view->setModel($model);

		//显示
		$view->edit();
	}
 	function save()
	{
		$model = $this->getModel('category');
		$model->save();
		//echo $_REQUEST['return'];exit;
		if( $_REQUEST['return'] )
		{
			$this->redirect($_REQUEST['return'],'保存 <b>'.$_REQUEST['name'].'</b> 成功!');
		}else{
			$this->redirect('index.php?com=category','保存 <b>'.$_REQUEST['name'].'</b> 成功!');
		}
	}

	/**
	 * 删除
	 */
	function del()
	{
		$model = $this->getModel('category');
		$model->del();
		$this->redirect('index.php?com=category');
	}
	/** 排序 **/
	function moveup()
	{
		if( ($id=intval($_REQUEST['id'])) > 0 ){
			$helperFile = PATH_COMPONENT.DS.'helper'.DS.'category.php';
			include($helperFile);

			$tree = new CategoryHelper();
			$tree->moveup($id);
		}
		$this->redirect('index.php?com=category');
	}

	/** 向下排序 **/
	function movedown()
	{
		if( ($id=intval($_REQUEST['id'])) > 0 ){
			$helperFile = PATH_COMPONENT.DS.'helper'.DS.'category.php';
			include($helperFile);

			$tree = new CategoryHelper();
			$tree->movedown($id);
		}
		$this->redirect('index.php?com=category');
	}

	/** 修改状态 **/
	function toggle()
	{
		$model = $this->getModel('category');
		$model->toggle();
 		//视图模型
		$this->redirect('index.php?com=category&mtid='.$this->menutypeid);
	}


	/** 锁定/解锁 **/
	function unlock()
	{
		$model = $this->getModel('category');
		$model->unlock();
 		//视图模型
		$this->redirect('index.php?com=category&mtid='.$this->menutypeid);

	}

	function lock()
	{
		$model = $this->getModel('category');
		$model->lock();
 		//视图模型
		$this->redirect('index.php?com=category&mtid='.$this->menutypeid);

	}

}
?>