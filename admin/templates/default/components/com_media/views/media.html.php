<?php
import('application.component.view');
class MediaView extends View
{
	var $path = null;
 	function MediaView()
	{
		parent::__construct();
		$this->path = dirname(__FILE__);
 	}

	function uploadSuccess()
	{	
		
		$lists = $this->get('list');
 		//显示上传界面
		include($this->path.DS.'tmpl'.DS.'success.php');
	}

	function display()
	{
		$uri=URI::getInstance();
		
		//当前的URI
		$uri->delVar('picurl');
		
		//设置当前的URL路径
		$com = $_REQUEST['com'];
		$c   = $_REQUEST['c'];
 		$url = $uri->current();//.'?com='.$com.'&c='.$c.'&no_html=1';

		//导入文件夹操作类
		import('filesystem.dir');


		//图片的根目录
		$dir_path=$GLOBALS['config']['upload_dir'];

		//当前设定的 pictureURL
		if(''!=$_GET['picurl']){
			$currentPU =str_replace('-|-',DS,$_GET['picurl']).DS;
			$dir_path.= $currentPU;
		}else{
			$currentPU = DS;
		}

		//设定上一级目录
		$prevfolder = substr($_GET['picurl'],0,strrpos($_GET['picurl'],'-|-'));

		

		$dir_path=preg_replace('|[\\\/]+|','/',$dir_path);//preg_replace('/[\\\]+/',"/"

		//显示上传界面
		include($this->path.DS.'tmpl'.DS.'default.php');
	}
}
?>