<?php
import('application.component.model');
class ProductModel extends Model
{
	var $menuid = 0;

	var $nav = null;
	function ProductModel()
	{
		parent::__construct();
		$this->tableName = '#__products_series';
		$this->menuid = intval($_REQUEST['menuid']);
	}
 
 
	function getSelectList()
	{
		if( $this->menuid > 0 ){
			$where = " where menuid='".$this->menuid."'";
		}else{
			$where = "";
		}

		$order = " order by id desc ";

 
		import('html.navigations');
		$sql = " select count(*) as n from ".$this->tableName;
		$sql .= $where;
		

		$this->db->query($sql);
		$result = $this->db->getRow();
		$this->nav = new Navigations(20,$result['n']);
		

 
 		$sql = " select * from ".$this->tableName;
		$sql .= $where;
		$sql .= $order;

		$sql.= $this->nav->getLimit($_REQUEST['page']);

		$this->db->query($sql);
		return $this->db->getResult();

	}
 
 

	/**
	 * 取当前编辑项
	 */
	function getItem()
	{
		$id =intval($_REQUEST['id']);
		if( $id < 1 )
		{
			Error::throwError('无效的ID!');
		}
		
		
		$sql = " select * from ".$this->tableName." where id='".$id."' ";
		$this->db->query($sql);

		$row = $this->db->getRow();	//获取菜单项数据
		return $row;
	}


 
	/**
	 * 保存
	 */
	function save()
	{
		global $app;
		
		$image_str = trim($_POST['images'],',');
 		$data = array(
			'name'=>$_POST['name'],			//商品名称
   			'images'=>$image_str,
			'quantily'=>(substr_count($image_str,',')+1),
  
		);

		if( $_POST['thumbnail'] ){
			$data['thumbnail'] = $_POST['thumbnail'];
		}else if( $_POST['recreate'] == '1' ){

			if( $pos = strpos($image_str,'|1') ){
				$tmp=substr($image_str,0,$pos);
				$tmp_a = explode(',',$tmp);
				$outimg = $tmp_a[count($tmp_a)-1]; 
				$data['thumbnail'] = substr($outimg,0,-4).'_s.jpg';
			}
		}

		if( is_array($_REQUEST['params'] ) )	//保存参数列表
		{
			//import('html.format.ini');
			//$data['params'] = FormatINI::arrayToString($_REQUEST['params']);
		}
		$parent_id = intval($_REQUEST['parent_id']);	//父栏目的ID
		$id = intval( $_REQUEST['id'] );
 
		if( $id > 0 )
		{
			$this->db->updateArray( $this->tableName, $data , " id='{$id}' " );
 		}else{
			$data['uid']=$app->uid;
 			$data['ordering'] = $this->getNextOrder("");	//获取排序值
			$this->db->insertArray( $this->tableName, $data  );
			$id = $this->db->insertid();
 		}
		


		//print_r($attr_ids_update);
		//exit;
		
		/***
		//附件排序
		$downloads_ordering = trim($_REQUEST['downloads_ordering'],',');
		$order_downloads = explode(',',$downloads_ordering);

		$ds = array();
		foreach( $order_downloads as $v ){
			$order_d = explode('|',$v);
			$ds[$order_d[1]] = $order_d[0];
		}
		
		//print_r($ds);

		//是否有附件信息
		$download_file = trim($_REQUEST['new_downloads'],',');
		$files = explode(',',$download_file);

		if( count($files)>0 ){
			foreach( $files as $v ){
				$file = explode('|',$v);
				if( $file[0] && $file[1] && $file[2] ){
					$data = array(
						'name'=>$file[0],
						'type'=>$file[1],
						'language_id'=>$file[3],
						'file_path'=>$file[2],
						'ordering'=>$ds[$file[0]],
						'product_id'=>$id
						
					);
					
					$this->db->insertArray('#__products_accessories',$data);
				}

				
			}
			 
		}
		**/


		return true;
	}


	

	/** 删除内容 **/
	function delete($id)
	{
		if( $id > 0 )
		{

			//删除前，先把其它排序值减一
			$sql = "select ordering from ".$this->tableName." where uid=".$this->uid." and id=".$id;
			$this->db->query($sql);
			$row = $this->db->getRow();
			$sql =" update ".$this->tableName." set ordering = ordering-1 where ordering > ".(int)$row['ordering'];
			$this->db->query($sql);
			$sql = "delete from ".$this->tableName." where id=".$id;
			$this->db->query($sql);
			return true;
		}

		return false;
	}


	/** 移动所选择的文章到指定菜单 **/
	function moveall()
	{
		global $app;
		$ids =  $this->_filterID( $_REQUEST['ids'] );
		$moveToID = intval(  $_REQUEST['movetoid'] );
 		if( count($ids) && $moveToID>0 )
		{
			$sql = " update ".$this->tableName." set catid=".$moveToID." where uid = ".$this->uid." and id in (".implode(',',$ids).") ";
			//echo $sql;exit;
			$this->db->query($sql);

			$app->enqueueMessage(' 移动成功,共移动 '.count($ids).'项.');
		}
		return true;
	}

	/** 拷贝一份 **/
	function copy()
	{
 		global $app;
		$copy_ids = &$this->_filterID( $_REQUEST['ids'] );
		if( count($copy_ids) )
		{
			$sql = " select * from ".$this->tableName." where id in (".implode(',',$copy_ids).") ";
			$this->db->query($sql);
			$rows = $this->db->getResult();
			foreach( $rows as $row )
			{
				unset($row['id']);
				$row['title'] = "新建 ".$row['title'];
				$row['introtext'] = addslashes($row['introtext']);
				$row['fulltext'] = addslashes($row['fulltext']);
				//$row['ordering'] =  (int)($this->getNextOrder(" position='".$row['position']."' "));
				$this->db->insertArray( $this->tableName,$row );

 			}

			$this->reorder();	//重新排序

			$app->enqueueMessage(' 复制成功,共复制 '.count($copy_ids).'项.');
		}
 		return true;
	}
	/** 全部删除 **/
	function deleleall(){
		global $app;
		$copy_ids =  $this->_filterID( $_REQUEST['ids'] );

 		if( count($copy_ids) )
		{
			$sql = " delete from ".$this->tableName." where  id in (".implode(',',$copy_ids).") ";
			//echo $sql;exit;
			$this->db->query($sql);

			$this->reorder();	//重新排序


			$app->enqueueMessage(' 删除成功,共删除 '.count($copy_ids).'项.');
		}
		return true;
	}
	
	function movetorecycle()
	{
		global $app;
		$copy_ids =  $this->_filterID( $_REQUEST['ids'] );

 		if( count($copy_ids) )
		{
			$sql = " update ".$this->tableName." set menuid=0 where uid = ".$this->uid." and id in (".implode(',',$copy_ids).") ";
			//echo $sql;exit;
			$this->db->query($sql);
			$app->enqueueMessage(' 放入回收站成功,共移动 '.count($copy_ids).'项.');
		}
		return true;
	}

	function  _filterID($string){
		if( $string )
		{
			$id_array = explode( ',',$string);
			$copy_ids = array();
			foreach( $id_array as $id )
			{
				if( $id = intval($id) )
				{
					$copy_ids[] = $id;
				}
			}
		}

		return $copy_ids;
	}

	function getNav(){
		return $this->nav;
	}
	/** 修改状态 **/
	function toggle()
	{
		if( ($id = intval($_REQUEST['id']) )>0 && $_REQUEST['attr'] )
		{
			$arr = array( $_REQUEST['attr'] =>$_REQUEST['value'] );
			$this->db->updateArray($this->tableName,$arr," id='".$id."' and uid='".$this->uid."' ");
		}
	}

	/** 修改排序值 **/
	function ordering()
	{
		global $app;
		$id = intval( $_REQUEST['id'] );
		$from = intval( $_REQUEST['from'] );
		$to = intval( $_REQUEST['to'] );
		
		if( $id>0 && $to>0 )
		{
			$sql = "select ordering  from ".$this->tableName." where  id=".$id;
			$this->db->query($sql);

			$row = $this->db->getRow();
			$from = (int)$row['ordering'];	//更新排序值
			$menuid = $row['menuid'];

			$sql = " select count(*) as n from ".$this->tableName;
			$this->db->query($sql);
			$result = $this->db->getRow();
			
			$count = $result['n'];

			if( $count < $to )
			{
				$app->enqueueMessage(' 排序失败，排序值大于最大值.');
				return false;
			}
			if( $from > $to ){		//向上移
				$sql = " update ".$this->tableName." set ordering = ordering+1 where uid=".$this->uid." and ordering>=".$to." and ordering<".$from;
 			}else if( $from < $to )//向后移
			{
				$sql = " update ".$this->tableName." set ordering = ordering-1 where  ordering>".$from." and ordering<=".$to;
 			}
			//echo $sql;exit;
			$this->db->query($sql);

			$data = array('ordering'=>$to);

			
			$this->db->updateArray($this->tableName,$data,"  id=".$id." ");
 			$app->enqueueMessage(' 排序成功.');

		}
	}

	function deleteImg($img){
		$suffix = substr($img,-3);
		$imgfilter = array('jpg','bmp','png','gif');
		if( in_array($suffix,$imgfilter) ){
			$img = '/media'.substr($img,6);
			$img = PATH_ROOT.str_replace('/',DS,$img);  
			
			if( file_exists($img) ){
				unlink($img); 
			}
			$thumbIMG = substr($img,0,-4).'_s.jpg'; 
			if( file_exists($thumbIMG) ){
				unlink($thumbIMG); 
			}
			echo '1';
		}
	}

	function saveImg($img){
		$id = (int)$_GET['id'];
		if( $id > 0 ){
			$data = array('images'=>$img);
			$this->db->updateArray($this->tableName,$data," id='".$id."' ");
		}
	}


 }



?>