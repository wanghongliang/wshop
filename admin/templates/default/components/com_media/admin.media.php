<?php
class MediaController extends Controller{
 	function MediaController(){
		parent::__construct();
 	}
 
	/**
	 * ��ʾ�б�
	 */
	function display()
	{
 		//��ͼģ��
		$view = $this->getView('media');

 		//��ʾ
		$view->display();
	}


	/**
	 * ɾ��ͼƬ
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