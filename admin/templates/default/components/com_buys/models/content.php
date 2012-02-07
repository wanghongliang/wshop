<?php
import('application.component.model');
class ContentModel extends Model
{
	var $menuid = 0;

	var $nav = null;
	function ContentModel()
	{
		parent::__construct();
		$this->tableName = '#__contents';
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
 
		/** 语言版本 **/
		/**
		
		$lt = Language::getLanguageType();
		
 
		if( count($lt)>0 ){
		
			$sql = "select * from #__contents_description where content_id=".$row['id'];
			$this->db->query($sql);
			$results = $this->db->getResult();
			foreach( $results as $r )
			{
				$row['title'.$r['language_id']] = $r['title'];
				$row['content'.$r['language_id']] = $r['content'];
				$row['metakey'.$r['language_id']] = $r['metakey'];
				$row['metadesc'.$r['language_id']] = $r['metadesc'];

 			}
		}

		**/


		return $row;
	}

	/**
	 * 保存
	 */
	function save()
	{
		global $app;
	 
		$data = array(
			'title'=>$_REQUEST['title'],
			'author'=>$_REQUEST['author'],
			'images'=>$_REQUEST['images'],
			'content'=>$_REQUEST['content'],
			'attr'=>intval($_REQUEST['attr']),
			'metakey'=>$_REQUEST['metakey'],
			'metadesc'=>$_REQUEST['metadesc'],
			'modified'=>date('Y-m-d H:i:s')
		);
		
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
			$data['menuid'] = $this->menuid;
			$data['uid'] = $this->uid;

			$data['published'] = 1;
			$data['ordering'] = $this->getNextOrder("");
			$data['created'] = date('Y-m-d H:i:s');

			$this->db->insertArray( $this->tableName, $data  );
 		}

		

		/*** 多语言版面的更新 **/
		/**
		$lt = Language::getLanguageType();
		foreach( $lt as $k=>$v )
		{
			$title = $_REQUEST['title'.$k];
			$content = $_REQUEST['content'.$k];
			$metakey = $_REQUEST['metakey'.$k];
			$metadesc = $_REQUEST['metadesc'.$k];
 		
			$sql = " INSERT INTO #__contents_description ( content_id,language_id,title,content,metakey,metadesc)  VALUES({$id},{$k},'{$title}','{$content}','{$metakey}','{$metadesc}')   ON DUPLICATE KEY UPDATE title='{$title}',content='{$content}',metakey='{$metakey}',metadesc='{$metadesc}' ";
			$this->db->query($sql);

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
			$sql = "select ordering,menuid from ".$this->tableName." where uid=".$this->uid." and id=".$id;
			$this->db->query($sql);
			$row = $this->db->getRow();


			$sql =" update ".$this->tableName." set ordering = ordering-1 where uid=".$this->uid." and ordering > ".$row['ordering'];
			$this->db->query($sql);

			//然后再删除
			$sql = "delete from ".$this->tableName." where id=".$id." and uid=".$this->uid;
			$this->db->query($sql);


			//然后再删除
			$sql = "delete from #__contents_description  where content_id=".$id;
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
			$sql = " update ".$this->tableName." set menuid=".$moveToID." where uid = ".$this->uid." and id in (".implode(',',$ids).") ";
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
			$sql = " delete from ".$this->tableName." where uid = ".$this->uid." and id in (".implode(',',$copy_ids).") ";
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
			$sql = "select ordering,menuid from ".$this->tableName." where uid=".$this->uid." and id=".$id;
			$this->db->query($sql);

			$row = $this->db->getRow();
			$from = $row['ordering'];	//更新排序值
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
				$sql = " update ".$this->tableName." set ordering = ordering-1 where uid=".$this->uid." and ordering>".$from." and ordering<=".$to;
 			}
			//echo $sql;exit;
			$this->db->query($sql);

			$data = array('ordering'=>$to);
			$this->db->updateArray($this->tableName,$data," uid=".$this->uid." and id=".$id." ");
			$app->enqueueMessage(' 排序成功.');

		}
	}

	function getAttr(){
		$attr = array(
			0=>'默认',
			1=>'置顶',
			2=>'推荐',
			3=>'关注'
		);

		return $attr;
	}
 }
?>