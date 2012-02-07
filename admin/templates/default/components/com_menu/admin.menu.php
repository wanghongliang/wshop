<?php
class MenuController extends Controller{

	var $menutypeid;	//当前菜单分类
	function MenuController(){
		parent::__construct();
		$this->menutypeid = intval( $_REQUEST['mtid'] );
		if( $this->menutypeid < 1 )
		{
			//Error::throwError('没有指定菜单类型');
		}

	}
 
	/**
	 * 显示列表
	 */
	function display()
	{
		//取对应菜单列表模型
		$model = $this->getModel('menus');
	
		//视图模型
		$view = $this->getView('menus');

		//设置模型
		$view->setModel($model);
		//显示
		$view->display();
	}

	/** 添加 **/
	function add()
	{
		//取对应菜单列表模型
		$model = $this->getModel('menu');
	
		//视图模型
		$view = $this->getView('menu');

		//设置模型
		$view->setModel($model);

		//显示
		$view->display();
	}

	/** 添加 **/
	function edit()
	{
		//取对应菜单列表模型
		$model = $this->getModel('menu');
	
		//视图模型
		$view = $this->getView('menu');
 		//设置模型
		$view->setModel($model);

		//显示
		$view->edit();
	}

	/** 选择组件 **/
	function selectcomtype()
	{
		//取对应菜单列表模型
		$model = $this->getModel('menu');
	
		//视图模型
		$view = $this->getView('menu');

		//设置模型
		$view->setModel($model);

		//显示
		$view->showSelectComponent();
	}

	/**
	 * 添加
	 */
	function save()
	{
		$model = $this->getModel('menu');
		$model->save();
		//echo $_REQUEST['return'];exit;
		if( $_REQUEST['return'] )
		{
			$this->redirect($_REQUEST['return'],'保存 <b>'.$_REQUEST['name'].'</b> 成功!');
		}else{
			$this->redirect('index.php?com=menu&mtid='.$this->menutypeid,'保存 <b>'.$_REQUEST['name'].'</b> 成功!');
		}
	}

	/**
	 * 删除
	 */
	function del()
	{
		$model = $this->getModel('menu');
		$model->del();
		$this->redirect('index.php?com=menu&mtid='.$this->menutypeid);
	}


	/** 删除带有组件数据的菜单 **/
	function delmenu()
	{
		$model = $this->getModel('menu');
		$model->delmenu();

		//视图模型
		$view = $this->getView('menu');
		$view->delprompt();
		//$this->redirect('index.php?com=menu&mtid='.$this->menutypeid);
	}

	function delmenuconfirm()
	{
		$model = $this->getModel('menu');
		$model->delmenuconfirm();
		$this->redirect('index.php?com=menu&mtid='.$this->menutypeid);
	}

	/** 排序 **/
	function moveup()
	{
		if( ($id=intval($_REQUEST['id'])) > 0 ){
			import('application.tree');
			$tree = new Tree();
			$tree->moveup($id);
		}
		$this->redirect('index.php?com=menu&mtid='.$this->menutypeid);
	}

	/** 向下排序 **/
	function movedown()
	{
		if( ($id=intval($_REQUEST['id'])) > 0 ){
			import('application.tree');
			$tree = new Tree();
			$tree->movedown($id);
		}
		$this->redirect('index.php?com=menu&mtid='.$this->menutypeid);
	}



	/** 把原内容转移到其它菜单内容 **/
	function shiftcontent()
	{
		//取对应菜单列表模型
		$model = $this->getModel('menu');
	
		//视图模型
		$view = $this->getView('menu');

		//设置模型
		$view->setModel($model);

		//显示
		$view->shiftcontent();
	}

	/** 加载选择的菜单 **/
	function ajaxselectmenu()
	{
		//取对应菜单列表模型
		$model = $this->getModel('menu');
		//视图模型
		$view = $this->getView('menu');
		//设置模型
		$view->setModel($model);
		//显示
		$view->ajaxselectmenu();
	}
	/** 修改状态 **/
	function toggle()
	{
		$model = $this->getModel('menu');
		$model->toggle();
 		//视图模型
		$this->redirect('index.php?com=menu&mtid='.$this->menutypeid);
	}

	/** 设置首页 **/
	function sethome()
	{
		$model = $this->getModel('menu');
		if($model->setHome()){
 			//视图模型
			$this->redirect('index.php?com=menu&mtid='.$this->menutypeid,'设置成功!');
		}

	}


	/** 锁定/解锁 **/
	function unlock()
	{
		$model = $this->getModel('menu');
		$model->unlock();
 		//视图模型
		$this->redirect('index.php?com=menu&mtid='.$this->menutypeid);

	}

	function lock()
	{
		$model = $this->getModel('menu');
		$model->lock();
 		//视图模型
		$this->redirect('index.php?com=menu&mtid='.$this->menutypeid);

	}

	/** ajax 方式加载 左边菜单 **/
	function ajaxmenu(){
		//取对应菜单列表模型
		$model = $this->getModel('menu');
		//视图模型
		$view = $this->getView('menu');
		//设置模型
		$view->setModel($model);
		//显示
		$view->ajaxmenu();
	}

}
?>