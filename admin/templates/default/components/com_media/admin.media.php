<?php
class MediaController extends Controller{
 	function MediaController(){
		parent::__construct();
 	}
 
	/**
	 * 显示列表
	 */
	function display()
	{
 		//视图模型
		$view = $this->getView('media');

 		//显示
		$view->display();
	}


	/**
	 * 删除图片
	 */
	function delfile(){


		//echo $_POST['upload_dir'];
		$dir_path=PATH_ROOT.DS;
 


		if(is_file($dir_path.str_replace('-|-',DS,$_GET['d']) )){


			if( unlink($dir_path.str_replace('-|-',DS,$_GET['d']) ) ){
				echo '1';
			}
		}
	}
  
}	
?>