<?php
import('application.component.model');
class ElitesModel extends Model
{
	function ElitesModel()
	{
		parent::__construct();
		$this->tableName = '#__elite_re';
	}
	function getList()
	{
		$elite_id=(int)$_REQUEST['s'];
		$elite_id = $elite_id<1?1:$elite_id;
		$sql =" select t.products_id as id,a.name,a.thumbnail,a.shop_price,a.store,t.ordering from ".$this->tableName." as t left join #__products as a on t.products_id=a.id  where t.elite_id=".$elite_id." order by t.ordering limit 50 ";
		$this->db->query($sql);
		$result = $this->db->getResult();
		return $result;
	}

	function selectproducts(){
		global $app;
		$ids =  $this->_filterID( $_REQUEST['ids'] );
		$s = intval(  $_REQUEST['s'] );
 		if( count($ids) && $s>0 )
		{
			foreach( $ids as $k=>$id ){
				$query = " insert into #__elite_re set  elite_id=$s,products_id=$id,ordering=50 ";
				if( !$this->db->query($query,true) ){
					unset($ids[$k]);
				}
			}

			$app->enqueueMessage(' 添加成功,共添加 '.count($ids).'项.');
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
}
?>