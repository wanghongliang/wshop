<?php
import('application.component.model');
class AjaxModel extends Model
{
 	var $nav = null;
	function AjaxModel()
	{
		parent::__construct();
		$this->tableName = '#__products_series';
 	}
	//取规格信息
	function getSeries(){ 
		$id = (int)$_GET['id']; 
		$sql=" select * from ".$this->tableName." where id='".$id."' ";
		$this->db->query($sql);
		return $this->db->getRow(); 
	}
 	function getSelected(){ 
		$id=(int)$_GET['id'];
 
			$sql=" select p.id, p.name,l.is_double from #__products_link as l left join ".$this->tableName." as p on l.products_link_id = p.id where l.products_id=".$id;
			$this->db->query($sql);
			return $this->db->getResult(); 
 
	}

	function addItem(){
		$id=(int)$_GET['id'];
		$ids = trim($_GET['ids']);
		$is_single = (int)$_GET['is_single'];
		$select_ids = explode(',',$ids);
		
  
 		//插入关联
		foreach( $select_ids as $v ){ 
			$sql="insert into #__products_link set  products_id ='".$id."' , products_link_id='".$v."' , is_double = '".$is_single."' ";  
			$this->db->query($sql,true);

			if ($is_single)
			{ 
				$sql="insert into #__products_link set  products_id ='".$id."' , products_link_id='".$v."' , is_double = '".$is_single."' "; 
				$this->db->query($sql,true);
			}


		}

 
	}

	function dropItem(){
		$id=(int)$_GET['id'];
		$ids = trim($_GET['ids']);

		$sql=" update  #__products_link set is_double=0 where products_link_id=".$id." and products_id in (".$ids.") ";
		$this->db->query($sql); 
 

		$sql=" delete from #__products_link where products_id=".$id." and products_link_id in (".$ids.") ";
		$this->db->query($sql);
		return true;
 
	}
 	function getGroup(){ 
		$id=(int)$_GET['id']; 
		$sql=" select p.id, p.name,g.products_price from #__products_group as g left join ".$this->tableName." as p on g.products_id = p.id where g.parent_id=".$id;
		$this->db->query($sql);
		return $this->db->getResult();  
	}

	function addGroup(){
		$id=(int)$_GET['id'];
		$ids = intval($_GET['ids']);
		$is_single =round($_GET['is_single'],2);//$_GET['is_single']; 
 	 
		$sql="insert into #__products_group set  parent_id ='".$id."' , products_id='".$ids."' , products_price = '".$is_single."' ";  
		$this->db->query($sql,true); 
 
	}
	function dropGroup(){
		$id=(int)$_GET['id'];  
		$ids = trim($_GET['ids']);	
		$sql=" delete from #__products_group where parent_id=".$id." and products_id in (".$ids.") ";
		$this->db->query($sql);
		return true;
 
	}
	function setthumb(){
		$image_str = trim($_GET['img'],',');
 		$image_str = substr($image_str,0,-4).'_s.jpg';
		$id = (int)$_GET['id'];

		$sql = "update ".$this->tableName." set thumbnail='".$image_str."' where id='".$id."' ";
		$this->db->query($sql);
 
		return true;
	}

	function setdefimg(){
		$image_str = trim($_GET['img'],',');
 		 
		$id = (int)$_GET['id'];

		$sql = "update ".$this->tableName." set images='".$image_str."' where id='".$id."' ";
		$this->db->query($sql);
 
		//echo $sql;
		return true;
	}

 }



?>