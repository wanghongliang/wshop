<?php
import('application.component.model');
class LanguagesModel extends Model
{
	var $nav = null;
	var $client_id=0;


 	function LanguagesModel()
	{
		parent::__construct();
		$this->tableName = '#__languages';
 	}
	function getList()
	{
		$lists = array();
		$where = array("  uid='".$this->uid."' ");
		$where = count($where)>0 ? " where ".implode(' and ',$where):'';


		$order = " order by ordering ";
		import('html.navigations');
		$sql = " select count(*) as n from ".$this->tableName."   ";
 		$sql .= $where;
		

		$this->db->query($sql);
		$result = $this->db->getRow();
		$this->nav = new Navigations(20,$result['n']);


		//过滤菜单项
 		$sql = " select id,name,published,img,isdefault,ordering,mark from ".$this->tableName;		
		$sql .= $where;
		$sql .= $order;
		$sql .= $this->nav->getLimit($_REQUEST['page']);
 		$this->db->query($sql);
		$lists =$this->db->getResult();
		return $lists;
		

 	}

	function getLanguages()
	{
		$where = array("  uid='".$this->uid."' and published=1 ");
		$where = count($where)>0 ? " where ".implode(' and ',$where):'';
		$order = " order by ordering ";
			//过滤菜单项
 		$sql = " select * from ".$this->tableName;		
		$sql .= $where;
		$sql .= $order;
  		$this->db->query($sql);
		$lists =$this->db->getResult();
		return $lists;
	}

	function getNav()
	{
		if( !$this->nav )
		{
			$this->getList();
		}
		return $this->nav;
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

		$sql = " select id,name,img,published,mark from ".$this->tableName." where id='".$id."' ";
		$this->db->query($sql);

		$row = $this->db->getRow();	//获取菜单项数据
 
		return $row;
	}


	/** 保存语言分类 **/
	function savetype()
	{
		global $app;
	 
		$data = array(
			'name'=>$_REQUEST['name'],
			'published'=>$_REQUEST['published'],
			'img'=>$_REQUEST['img'],
			'mark'=>$_REQUEST['mark'],
 		);
		
	 
 		$id = intval( $_REQUEST['id'] );

		if( $id > 0 )
		{
			$this->db->updateArray( $this->tableName, $data , " id='{$id}' " );
 		}else{
 			$data['uid'] = $this->uid;
			$data['ordering'] = $this->getNextOrder("");
			$this->db->insertArray( $this->tableName, $data  );
 		}
		return true;
	}




	/** 保存语言包内容信息 **/
	function save()
	{
		global $app;
		if( is_array( $_POST ) )
		{
			$data = array();
 			foreach( $_POST as $k=>$v )
			{
				
				if( strpos( $k, 'lan_' ) !== false )
				{
					$i = intval( substr($k,4) )+1;
 					$data = array('params'=>serialize($v));
					//更新数据
					$this->db->updateArray( $this->tableName, $data , " ordering='{$i}' " );
				}
			}

			$app->enqueueMessage(' 保存成功.');
 
		}
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
			$sql =" update ".$this->tableName." set ordering = ordering-1 where uid=".$this->uid." and ordering > ".$row['ordering'];
			$this->db->query($sql);

			//然后再删除
			$sql = "delete from ".$this->tableName." where id=".$id." and uid=".$this->uid;
			$this->db->query($sql);
			return true;
		}

		return false;
	}
	function moveorder()
	{
 		$ids = trim( $_REQUEST['ids'] );
		$ids_array = explode(',',$ids );
		foreach( $ids_array as $k=>$id )
		{
			if( $id != 1 )
			{
 				$sql =" update ".$this->tableName." set ordering=".(int)($k+1)." where id=".$id;
				$this->db->query($sql);
				
 			}
		}
		//echo '排序成功.';

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

	/** 解锁和锁定 **/
	function unlock( $f = null )
	{
		global $app;

 		$ids =  $this->_filterID( $_REQUEST['ids'] );

 		if( count($ids) )
		{
			if( $f ){
				$sql = " update ".$this->tableName." set ".$f."=1 where uid = ".$this->uid." and id in (".implode(',',$ids).") ";
			}else{
				$sql = " update ".$this->tableName." set published=1 where uid = ".$this->uid." and id in (".implode(',',$ids).") ";
			}
			//echo $sql;exit;
			$this->db->query($sql);
 			$app->enqueueMessage(' 操作成功,共解锁 '.$this->db->getAffectedRows().'项.');
		}
		return true;
		 
	}
	function lock(  $f = null)
	{
		global $app;
		$ids =  $this->_filterID( $_REQUEST['ids'] );
 		if( count($ids) )
		{
			if( $f ){
				$sql = " update ".$this->tableName." set ".$f."=0 where uid = ".$this->uid." and id in (".implode(',',$ids).") ";
			}else{
				$sql = " update ".$this->tableName." set published=0 where uid = ".$this->uid." and id in (".implode(',',$ids).") ";
			}
			//echo $sql;exit;
			$this->db->query($sql);
 			$app->enqueueMessage(' 操作成功,共锁定 '.$this->db->getAffectedRows().'项.');
		}
		return true;
	}


	function setDefault()
	{
		if( ( $id =intval($_REQUEST['ids']) ) > 0  ){
			$this->db->query(" update ".$this->tableName." set isdefault=0 where uid = ".$this->uid);
			$this->db->query(" update ".$this->tableName." set isdefault=1 where uid = ".$this->uid." and id = ".$id);
		}
	}
}
?>