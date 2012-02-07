<?php
class Create_htmlController extends Controller{

 	var $baseuri = null;
	function Create_htmlController(){
		parent::__construct();
 
		$this->baseuri = 'index.php?com=create_html';
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
		$model = $this->getModel('creates');
	
		//视图模型
		$view = $this->getView('creates');

		//设置模型
		$view->setModel($model);
		//显示
		$view->display();
	}


	function start(){
		//取对应菜单列表模型
		$model = $this->getModel('create');
		$model->start();
	}

	function create()
	{
		//取对应菜单列表模型
		$model = $this->getModel('create');
		$model->create();
 	}

	function edit(){
		//取对应菜单列表模型
		$model = $this->getModel('create');
		//视图模型
		$view = $this->getView('create');
		//设置模型
		$view->setModel($model);
		//显示
		$view->display();
	}
	
	function deleteall(){
		import('filesystem.dir');
		$dir = WDir::getInstance();

		$files = $dir->getFiles(PATH_ROOT,'tml');
		//print_r($files);

		foreach( $files as $file ){
			unlink(PATH_ROOT.DS.$file['name']);
		}

		echo '清除完成，共删除'.count($files).'个 .html 文件!';
	}

 
}	
?>