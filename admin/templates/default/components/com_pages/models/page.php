<?php
import('application.component.model');
class PageModel extends Model
{
	var $menuid = 0;

	var $nav = null;
	function PageModel()
	{
		parent::__construct();
		$this->tableName = '#__pages';
		$this->menuid = intval($_REQUEST['menuid']);
	}
	/**
	 * 取当前编辑项
	 */
	function getItem()
	{
 
		$sql = " select * from ".$this->tableName." where uid='".$this->uid."' and menuid=".$this->menuid;

 		$this->db->query($sql);
		$row = $this->db->getRow();	//获取菜单项数据
 
		return $row;
	}
	/**
	 * 取当前编辑项
	 */
	function getMenu()
	{
 
		$sql = " select m.id, m.parent_id, m.component, m.name, m.type, m.iscontent, m.link, m.tid , t.title from #__menu as m left join #__menu_types as t on m.tid = t.id order by lft ";

 		$this->db->query($sql);
		$row = $this->db->getResult('tid',true);	//获取菜单项数据
		return $row;
	}
	function save()
	{
		global $app;
	 
		$data = array(
 			'content'=>$_REQUEST['content']
		);
		
		if( is_array($_REQUEST['params'] ) )	//保存参数列表
		{
			//import('html.format.ini');
			//$data['params'] = FormatINI::arrayToString($_REQUEST['params']);
		}

 		$id = intval( $_REQUEST['id'] );
		if( $id > 0 )
		{
			$this->db->updateArray( $this->tableName, $data , " id='{$id}' " );
 		}else{
			$data['menuid'] = $this->menuid;
			$data['uid'] = $this->uid;
			$this->db->insertArray( $this->tableName, $data  );
 		}
  
		return true;
	}


  }



?>