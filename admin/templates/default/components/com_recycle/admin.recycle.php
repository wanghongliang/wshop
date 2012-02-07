<?php
class RecycleController extends Controller{

	var $menuid;	//当前菜单分类
	var $baseuri = null;
	function RecycleController(){
		parent::__construct();
		$this->menuid = intval( $_REQUEST['menuid'] );

		$this->baseuri = 'index.php?com=recycle&menuid='.$this->menuid;

		if( isset($_REQUEST['tmpl']) ){
			$this->baseuri.="&tmpl=".$_REQUEST['tmpl'];
		}
	}
	/**
	 * 显示列表
	 */
	function display()
	{
		//取对应菜单列表模型
		$model = $this->getModel('recycles');
		//视图模型
		$view = $this->getView('recycles');
		//设置模型
		$view->setModel($model);
		//显示
		$view->display();
	}
}
?>