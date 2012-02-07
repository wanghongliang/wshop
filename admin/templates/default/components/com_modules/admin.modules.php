<?php
class ModulesController extends Controller{
 
	var $baseuri = null;
	function ModulesController(){
		parent::__construct();
		$this->baseuri = 'index.php?com=modules';
		if( isset($_REQUEST['tmpl']) ){
			$this->baseuri .= '&tmpl='.$_REQUEST['tmpl'];
		}
		if( isset($_REQUEST['act']) ){
			$this->baseuri .= '&act='.$_REQUEST['act'];
		}

	}
 
	/**
	 * 显示列表
	 */
	function display()
	{
		//取对应菜单列表模型
		$model = $this->getModel('modules');
	
		//视图模型
		$view = $this->getView('modules');

		//设置模型
		$view->setModel($model);
		//显示
		$view->display();
	}
 
	/** 添加 **/
	function add()
	{
		//取对应菜单列表模型
		$model = $this->getModel('module');
	
		//视图模型
		$view = $this->getView('module');

		//设置模型
		$view->setModel($model);

		//显示
		$view->display();
	}

	/** 添加 **/
	function edit()
	{
		//取对应菜单列表模型
		$model = $this->getModel('module');
	
		//视图模型
		$view = $this->getView('module');

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
		$model = $this->getModel('module');
		$model->save();

		//echo $_REQUEST['return'];exit;
		if( $_REQUEST['return'] )
		{
			$this->redirect($_REQUEST['return'],'保存 <b>'.$_REQUEST['name'].'</b> 成功!');
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
			$model = $this->getModel('module');
			$model->delete($id);
		}
		$this->redirect($this->baseuri);
	}


	/** 复制一份 **/
	function copy()
	{
		$model = $this->getModel('module');
		$model->copy();
 		//视图模型
		$this->redirect($this->baseuri);
	}

	function deleleall(){
		$model = $this->getModel('module');
		$model->deleleall();
 		//视图模型
		$this->redirect($this->baseuri);
	}

	/** 修改状态 **/
	function toggle()
	{
		$model = $this->getModel('module');
		$model->toggle();
 		//视图模型
		$this->redirect($this->baseuri);
	}


	/** 添加选择的模块内容 **/
	function selectadd()
	{
		//取对应菜单列表模型
		$model = $this->getModel('module');
		//视图模型
		$view = $this->getView('module');
		//设置模型
		$view->setModel($model);
		$view->select();		//选择模块内型
	}


	function moveorder()
	{
		//取对应菜单列表模型
		$model = $this->getModel('module');
		$model->moveOrder();
	}
}	
?>