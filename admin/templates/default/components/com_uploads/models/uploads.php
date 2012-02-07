<?php
import('application.component.model');
class UploadsModel extends Model
{
	var $nav = null;
	var $lists = null;
 	function UploadsModel()
	{
		parent::__construct();
 
 	}
	function getList()
	{
		
		return $this->lists;
	}

	function getNav()
	{
		if( !$this->nav )
		{
			$this->getList();
		}
		return $this->nav;
	}


	function save()
	{
 		if( count($_FILES) > 0  )
		{
			import('filesystem.dir');
			if( $_POST['iscom'] == 'products' ){
				if( $this->lists = WDir::uploadFile( $_FILES['filename'],$GLOBALS['config']['upload_dir'].DS.'products','',$_REQUEST['rename'] ) ){
					$img = PATH_ROOT.str_replace('/',DS,$this->lists['uri_path']);
					$this->thumbIMG($img,$img); 
					return true;
				}
			}else{
				if( $this->lists = WDir::uploadFile( $_FILES['filename'],$GLOBALS['config']['upload_dir'],'',$_REQUEST['rename'] ) ){
					return true;
				}
			}
		}

		return false;
	}


	//��������ͼ
	// $destination ԭͼ $path_s ��ͼ·��
	function thumbIMG( $destination ,$path_s){
		if( file_exists($destination) ){
			//��ͼƬ��·������
			$img_file_new = substr($path_s,0,-4).'_s.jpg';
			$img_file_m = substr($path_s,0,-4).'_m.jpg';
			//$img_file_new2 = substr($path_s,0,-4).'_m.jpg';
			//if( file_exists($img_file_new) ){
 				//return;
			//}
 			$img_width=(int)$GLOBALS['config']['options']['thumbwidth'];//?['100;
			$img_height=(int)$GLOBALS['config']['options']['thumbheight'];//100;
 			 
 			//--$img_width_m=(int)$GLOBALS['config']['options']['imgwidth'];//?['100;
			//--$img_height_m=(int)$GLOBALS['config']['options']['imgheight'];//100;


			$img_width = $img_width>10?$img_width:100;
			$img_height = $img_height>10?$img_height:100;


			//--$img_width_m = $img_width_m>10?$img_width_m:300;
			//--$img_height_m = $img_height_m>10?$img_height_m:300;



			//$watermark=0;      //�Ƿ񸽼�ˮӡ(1Ϊ��ˮӡ,����Ϊ����ˮӡ);
			//$watertype=2;      //ˮӡ����(1Ϊ����,2ΪͼƬ)
 			//$waterimg=PATH_ROOT.DS.'media'.DS.'1'.DS."watermark2.png";    //ˮӡͼƬ
			//$waterimg2=PATH_ROOT.DS.'media'.DS.'1'.DS."watermark3.png";    //ˮӡͼƬ
 

			//ͼƬ��Ϣ
			$iinfo=getimagesize($destination,$iinfo);
			$nimage=imagecreatetruecolor($img_width,$img_height); 
			//--$nimage_m=imagecreatetruecolor($img_width_m,$img_height_m);		//��ͼƬ

			//��ͼƬ
			//$big_w = 720;
			//$big_h = $iinfo[1] * (720/$iinfo[0]); 
			//$bigimage = imagecreatetruecolor($big_w,$big_h);

			switch ($iinfo[2])
			{
				case 1:
				$simage =imagecreatefromgif($destination);
				break;
				case 2:
				$simage =imagecreatefromjpeg($destination);
				break;
				case 3:
				$simage =imagecreatefrompng($destination);
				break;
				case 6:
				$simage =imagecreatefromwbmp($destination);
				break;
				default:
				die("��֧�ֵ��ļ�����");
				exit;
			}
			

			$newW = $iinfo[0];
			$newH = $iinfo[0]/$img_width * $img_height;
	 
			$start_left = 0;


			//����Կ�Ϊ��ͼ����̫��ʱ���ռ����Ը�Ϊ׼
			if( $iinfo[1] < $newH ){  
				$newW = $iinfo[1]/$img_height * $img_width ;
				$newH = $iinfo[1]; 
				$start_left =($iinfo[0]-$newW)/2;
			}
		
			imagecopyresampled($nimage,$simage,0,0,$start_left,0,$img_width,$img_height,$newW,$newH );
			//--imagecopyresampled($nimage_m,$simage,0,0,$start_left,0,$img_width_m,$img_height_m,$newW,$newH );
 			//imagecopyresampled($bigimage,$simage,0,0,0,0,$big_w,$big_h,$iinfo[0],$iinfo[1]);


			/**
 			//��ˮӡ
			if($watermark==1)
			{
 				//��ˮӡ
				switch($watertype)
				{
					case 1:   //��ˮӡ�ַ���
					imagestring($nimage,2,3,0,$waterstring,$black);
 					break;
					case 2:   //��ˮӡͼƬ
					//$simage1 =imagecreatefromgif($waterimg);
					$simage1 =imagecreatefrompng($waterimg);
					imagecopy($nimage,$simage1,$img_width-54,$img_height-20,0,0,54,20);
					imagedestroy($simage1);
					$simage2 =imagecreatefrompng($waterimg2);
					imagecopy($bigimage,$simage2,$big_w-159,$big_h-55,0,0,149,45);
					imagedestroy($simage2);
					break;
				}
			}

			**/

			$ouput_file_type = 2;
			switch ($ouput_file_type)
			{
				case 1:
				//imagegif($nimage, $destination);
				imagejpeg($nimage, $img_file_new,100);
				//--imagejpeg($nimage_m, $img_file_m,100);
				break;
				case 2:
				imagejpeg($nimage, $img_file_new,100);
				//--imagejpeg($nimage_m, $img_file_m,100);
				//imagejpeg($bigimage, substr($destination,0,-4).'.jpg',100);
				break;
				case 3:
				imagepng($nimage, $img_file_new);
				//--imagepng($nimage_m, $img_file_m);
				break;
				case 6:
				imagewbmp($nimage, $img_file_new);
				//--imagewbmp($nimage_m, $img_file_m);
				//imagejpeg($nimage, $destination);
				break;
			}

			//����ԭ�ϴ��ļ�
			imagedestroy($nimage);
			imagedestroy($simage);
			//--imagedestroy($nimage_m);
			

			//unlink($destination);
			return $img_file_new;

		}

		return $destination;

	}



}
?>