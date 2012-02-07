<?php
import( 'application.component.model');

class AjaxModel extends Model
{
 	function getFavorite()
	{
		global $app;

	
		if( $id = intval($_REQUEST['id']) ){
 			$row = array(); $group = array();
			$session = &Factory::getSession();
 			$uid= $session->get('uid');
			$status = 0;	//0 为用户没有登陆，1为成功，2为已收藏

 			if( $uid > 0 ){
				
				$type =$_REQUEST['type'];

				if( $type == 'http' ){
					$sql = " select name,http from #__http where id=".$id;
					$this->db->query($sql);
					$item = $this->db->getRow();

					//是否已收藏
					$sql = " select count(*) as num from #__website_favorites where  uid=".$uid." and http='".$item['http']."' ";
					$this->db->query($sql);
					$row = $this->db->getRow();


	 
					if( $row['num'] < 1 ){

						/**
						$sql = " select name,http from #__website where id=".$id;
						$this->db->query($sql);
						//当前求购信息
						$row = $this->db->getRow();
						$data = array(
							'name'=>$row['name'],
							'http'=>$row['http'],
							'website_id'=>$id,
							'uid'=>$uid,
							'tid'=>1,
							'created'=>date('Y-m-d H:i:s'),
						);
						$this->db->insertArray('#__website_favorites',$data);
						$status = 1;
						**/
 

						$sql = " select id,name from #__website_group where uid=".$uid;
						$this->db->query($sql);
						$group = $this->db->getResult();

						$status = 1;
					}else{
						$status = 2;
					}

				}else{

					$sql = " select name,http,thumbnail from #__website where id=".$id;
					$this->db->query($sql);
					$item = $this->db->getRow();

					//是否已收藏
					$sql = " select count(*) as num from #__website_my where  uid=".$uid." and http='".$item['http']."' ";
					$this->db->query($sql);
					$row = $this->db->getRow();

					if( $row['num'] < 1 ){

						/**
						$sql = " select name,http from #__website where id=".$id;
						$this->db->query($sql);
						//当前求购信息
						$row = $this->db->getRow();
						$data = array(
							'name'=>$row['name'],
							'http'=>$row['http'],
							'website_id'=>$id,
							'uid'=>$uid,
							'tid'=>1,
							'created'=>date('Y-m-d H:i:s'),
						);
						$this->db->insertArray('#__website_favorites',$data);
						$status = 1;
						**/


						//echo $sql;

						$sql = " select id,name from #__website_my_group where uid=".$uid;
						$this->db->query($sql);
						$group = $this->db->getResult();

						$status = 1;
					}else{
						$status = 2;
					}

				}



			}
			$list = array('status'=>$status,'row'=>$item,'group'=>$group);
 			return $list;
		}
	}

	function getCat(){
  		//数据列表
		$list = array();
		$query = "select id,name,parent_id from #__category  order by lft ";
		$this->db->query($query);
		$lists = $this->db->getResult();
		return $lists;
 	}

	//添加到收藏
	function savfav(){
 		 $name = $this->decode($_REQUEST['name']);
		 $http = $this->decode($_REQUEST['http']);

		 if( $name=='' && $http == '' ){
			 return false;
		 }	

		 $data = array(
			'name'=> $name,			//产品名称
			'http'=>$http,	//简介
 			'tid'=>$_REQUEST['tid'],
			'website_id'=>intval($_REQUEST['wid']),
 		  );


		//是否添加新的组信息
		$group_name = $this->decode($_REQUEST['new_group']);
		$type =$_REQUEST['type'];

		if( $type == 'http' ){

			if( $group_name ){
				$sql = "select id from #__website_group where uid='".$this->uid."' and name='".$group_name."' ";
				$this->db->query($sql);
				$row = $this->db->getRow();

				if( $row['id']>0 ){
					$data['tid'] = $row['id'];
				}else{
					$sql="insert into #__website_group set name='".$group_name."',uid='".$this->uid."' ";
					$this->db->query($sql);
					$data['tid'] = $this->db->insertid();
				}
			}

			$id = intval( $_REQUEST['fid'] );
			if( $id > 0 )
			{
				$this->db->updateArray(  '#__website_favorites', $data , " id='{$id}' " );
			}else{
				$data['uid'] = $this->uid;
				$data['created'] = date('Y-m-d H:i:s');
				$sql ="select ordering from #__website_favorites where uid=".$this->uid;
				$this->db->query($sql);
				$row = $this->db->getRow();
				$data['ordering']=$row['ordering']+1;
				$this->db->insertArray( '#__website_favorites', $data  );
			}

		}else{

			if( $group_name ){
				$sql = "select id from #__website_my_group where uid='".$this->uid."' and name='".$group_name."' ";
				$this->db->query($sql);
				$row = $this->db->getRow();

				if( $row['id']>0 ){
					$data['tid'] = $row['id'];
				}else{
					$sql="insert into #__website_my_group set name='".$group_name."',uid='".$this->uid."' ";
					$this->db->query($sql);
					$data['tid'] = $this->db->insertid();
				}
			}
			$data['thumb'] = trim($_REQUEST['thumb']);
			$id = intval( $_REQUEST['fid'] );
			if( $id > 0 )
			{
				$this->db->updateArray(  '#__website_my', $data , " id='{$id}' " );
			}else{
				$data['uid'] = $this->uid;
				$data['created'] = date('Y-m-d H:i:s');
				$sql ="select ordering from #__website_my where uid=".$this->uid;
				$this->db->query($sql);
				$row = $this->db->getRow();
				$data['ordering']=$row['ordering']+1;
				$this->db->insertArray( '#__website_my', $data  );

				$sql =" update #__website set favs=1+favs where id=".$data['website_id'];
 				$this->db->query($sql);
			}
		}
	}


	function sendError(){
		$status = 0;
		if( $id = intval($_REQUEST['id']) ){

			$row = array('num'=>0);

			//已登陆的会员只能报一次错
			if( $this->uid > 0 ){
				$sql = " select count(*) as num from #__website_notice where uid=".$this->uid." and website_id=".$id;
				$this->db->query($sql);
				$row = $this->db->getRow($sql);

				 
			}else{

			}

 


			if( $row['num'] > 0 ){
				$status =1;
			}else{
				$data = array(
					'website_id'=>$id,
					'uid'=>$this->uid,
					'type'=>1,
					'created'=>date('Y-m-d H:i:s'),
				);
				$this->db->insertArray('#__website_notice',$data);

				//$sql = " select * from #__website where id=".$id;
				//$this->db->query($sql);

				//当前求购信息
				//$row = $this->db->getRow();
	 
				
				$status = 2;
			}
		}
		return $status;
	}
	

	function saveajaxweb(){
		global $app;
		
		$name = $this->decode($_REQUEST['name']);
		$value =  $this->decode($_REQUEST['value']);

		$status = 0;

		//是否加添网站名称和网址
		if( strlen( $name ) < 3 || strlen( $value ) < 10 ){
			return $status;	//不符合条件
		}


		$uid = intval($app->uid); //会员ID
		//上传图片
		if( strpos($GLOBALS['config']['upload_type'],substr($_FILES['file']['name'],-4)) !== false ){

			//print_r($_FILES); 
			//上传文件
			import('filesystem.dir');
			$uploadDir = PATH_UPLOAD.DS.'website'.DS.$uid;	
			//大图上传的目录
			$uploadDir_big_t = PATH_ROOT.DS.'media_big'.DS.$uid;

			WDir::mkdir($uploadDir);
			WDir::mkdir($uploadDir_big_t);
			$uploadDir .= DS;
			$uploadDir_big_t .=DS;
			//上传后的文件路径
			$path=$uploadDir.$_FILES['file']['name'];
			$path_s = $uploadDir_big_t.$_FILES['file']['name'];
			 
			 //1024*1024 
			if( $_FILES['file']['size'] > 1048576 ){
				$status=1;
				return; 
			}


 			
			if(@move_uploaded_file($_FILES['file']['tmp_name'],$path_s))
			{
				$pic = preg_replace('/[\\\]+/','/',str_replace(PATH_ROOT,'',$this->thumbIMG($path_s,$path)) );
				$status = 2;
				//$data = array('photo'=>$pic);
				//$this->db->updateArray("#__users" , $data ," id='".$app->uid."' ");
			}
 		}else{
			$status=3;
		}

		
		
		$key1 = $this->decode($_REQUEST['key1']);
		$key2 = $this->decode($_REQUEST['key2']);
		$key3 = $this->decode($_REQUEST['key3']);

		$data = array(
			'name' => $name,
			'http' => $value,
			'introtext' =>substr($this->decode($_REQUEST['remark']),0,500),
			'catid' =>  intval($_REQUEST['cat']),
			'areaid' => intval($_REQUEST['areaid']),
			'topicid' => intval($_REQUEST['topicid']),
			'colorid' => intval($_REQUEST['colorid']),
			'thumbnail'=>$pic,
			'created'=>date('Y-m-d H:i:s'),
			'modified'=>date('Y-m-d H:i:s'),
			'uid'=>$uid,
		);
		$this->db->insertArray('#__website',$data);
		$id=$this->db->insertid();	
 

		return array('status'=>$status,'id'=>$id);
 	}

	function thumbIMG( $destination ,$path_s){
		if( file_exists($destination) ){
			$img_file_new = substr($path_s,0,-4).'_s.jpg';
			//$image = new SimpleImage();
			//$image->load($img_file);
			//$image->resize(162,122);
			//$image->save($img_file_new);
			//exit;

			if( file_exists($img_file_new) ){
 				//return;
			}


			$img_width=162;
			$img_height=122;

			 
			$watermark=1;      //是否附加水印(1为加水印,其他为不加水印);
			$watertype=2;      //水印类型(1为文字,2为图片)
 			$waterimg=PATH_ROOT.DS.'media'.DS.'1'.DS."watermark2.png";    //水印图片
			$waterimg2=PATH_ROOT.DS.'media'.DS.'1'.DS."watermark3.png";    //水印图片
 
 			//加水印
				if($watermark==1)
				{

				//图片信息
				$iinfo=getimagesize($destination,$iinfo);
				$nimage=imagecreatetruecolor($img_width,$img_height);
				
				$big_w = 720;
				$big_h = $iinfo[1] * (720/$iinfo[0]);

				$bigimage = imagecreatetruecolor($big_w,$big_h);


				//$white=imagecolorallocate($nimage,255,255,255);
				//$black=imagecolorallocate($nimage,0,0,0);
				//$red=imagecolorallocate($nimage,255,0,0);
				//imagefill($nimage,0,0,$white);

				//print_r($iinfo);
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
					die("不支持的文件类型");
					exit;
				}
				
				/**
				$newH = $iinfo[0]/$img_width * $img_height ;
				$newH2 = $newH;
				//if( $iinfo[1] < $newH ){ $newH = $iinfo[1]; }

				imagecopyresampled($nimage,$simage,0,0,0,0,$img_width,$img_height,$iinfo[0],$newH );

				if( $iinfo[1] < $newH2 ){
					//echo $img_height-$img_width/$iinfo[0]*( $newH2 - $iinfo[1] );
					imagefilledrectangle($nimage,0,$img_height-$img_width/$iinfo[0]*( $newH2 - $iinfo[1] ),$img_width,$img_height,$white);
				}
				**/


				
				$newW = $iinfo[0];
				$newH = $iinfo[0]/$img_width * $img_height;
		 
				$start_left = 0;
				//如果以宽为截图，高太短时，刚计算以商为准
				if( $iinfo[1] < $newH ){ 

					$newW = $iinfo[1]/$img_height * $img_width ;
					$newH = $iinfo[1];

					$start_left =($iinfo[0]-$newW)/2;
				}
 			
				imagecopyresampled($nimage,$simage,0,0,$start_left,0,$img_width,$img_height,$newW,$newH );
 
 				imagecopyresampled($bigimage,$simage,0,0,0,0,$big_w,$big_h,$iinfo[0],$iinfo[1]);

				switch($watertype)
				{
					case 1:   //加水印字符串
					imagestring($nimage,2,3,0,$waterstring,$black);

 					break;
					case 2:   //加水印图片
					//$simage1 =imagecreatefromgif($waterimg);
					$simage1 =imagecreatefrompng($waterimg);
					imagecopy($nimage,$simage1,$img_width-54,$img_height-20,0,0,54,20);
					imagedestroy($simage1);

					$simage2 =imagecreatefrompng($waterimg2);
					imagecopy($bigimage,$simage2,$big_w-159,$big_h-55,0,0,149,45);
					imagedestroy($simage2);
					break;
				}
				

				$ouput_file_type = 2;
				switch ($ouput_file_type)
				{
					case 1:
					//imagegif($nimage, $destination);
					imagejpeg($nimage, $img_file_new,100);
					break;
					case 2:
					imagejpeg($nimage, $img_file_new,100);
					imagejpeg($bigimage, substr($destination,0,-4).'.jpg',100);
					break;
					case 3:
					imagepng($nimage, $img_file_new);
					break;
					case 6:
					imagewbmp($nimage, $img_file_new);
					//imagejpeg($nimage, $destination);
					break;
				}

				//覆盖原上传文件
				imagedestroy($nimage);
				imagedestroy($simage);
			}

			unlink($destination);
			return $img_file_new;

		}

		return $destination;

	}
 	function decode($s){
		return urldecode(trim($s));
	}
}
?>