<?php
class UninstallController extends Controller{

	var $client_id;	//当前菜单分类
	var $baseuri = null;
	function UninstallController(){
		parent::__construct();
		$this->client_id = intval( $_REQUEST['client_id'] );

		$this->baseuri = 'index.php?com=uninstall&client_id='.$this->client_id;

		if( isset($_REQUEST['type']) )
		{
			$this->baseuri .= '&type='.$_REQUEST['type'];
		}
	}
 
	/**
	 * 显示列表
	 */
	function display()
	{
		//取对应菜单列表模型
		$model = $this->getModel('uninstalls');
	
		//视图模型
		$view = $this->getView('uninstalls');

		//设置模型
		$view->setModel($model);
		//显示
		$view->display();
	}

	/** 添加 **/
	function add()
	{
		//取对应菜单列表模型
		$model = $this->getModel('uninstall');
	
		//视图模型
		$view = $this->getView('uninstall');

		//设置模型
		$view->setModel($model);

		//显示
		$view->display();
	}

	/** 添加 **/
	function edit()
	{
		//取对应菜单列表模型
		$model = $this->getModel('uninstall');
	
		//视图模型
		$view = $this->getView('uninstall');

		//设置模型
		$view->setModel($model);

		//显示
		$view->edit();
	}
 
	/**
	 * 添加
	 */
	function save()
	{
		$model = $this->getModel('uninstall');
		$model->save();
		//echo $_REQUEST['return'];exit;
		if( $_REQUEST['return'] )
		{
			$this->redirect($_REQUEST['return']);
		}else{
			$this->redirect($this->baseuri);
		}
	}

	/**
	 * 删除
	 */
	function del()
	{
		if( ($id=intval($_REQUEST['id'])) > 0 ){
			$model = $this->getModel('uninstall');
			$model->delete($id);
		}
		$this->redirect($this->baseuri,'卸载成功.');
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
}	
?>