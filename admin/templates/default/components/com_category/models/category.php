<?php
import('application.component.model');
class CategoryModel extends Model
{
	function CategoryModel()
	{
		parent::__construct();
		$this->tableName = '#__category';

	}
	function getType(){
		$sql = "select name,id from #__products_type ";
		$this->db->query($sql);
		$rows = $this->db->getResult();

		$data = array();
		foreach( $rows as $row ){
			$data[$row['id']] = $row['name'];
		}
		return $data;
	}

	//取规格信息
	function getSpec(){


		$sql = "select name,id from #__products_specification ";
		$this->db->query($sql);
		$data = $this->db->getResult();
 
		return $data;
	}
	function getList()
	{
		$helperFile = PATH_COMPONENT.DS.'helper'.DS.'category.php';
		include($helperFile);

		$tree = new CategoryHelper();
		//$result = $tree->getcatagory(1,2);
		$result = $tree->getAll();


		return $result;
		
	}


		/**
	 * 取当前编辑项
	 */
	function getItem()
	{
		global $app;
 
		$id =intval($_REQUEST['id']);
		if( $id < 1 )
		{
			//if( !isset($_REQUEST['url']) ){
			//	Error::throwError('无效的ID!');
			//}
			$row = array(
				'link'=>'index.php?',
				'type'=>'component'
			);
		}else{
			$sql = " select * from ".$this->tableName." where id='".$id."' ";
			$this->db->query($sql);
			$row = $this->db->getRow();	//获取菜单项数据


			/** 语言版本 
			$sql = "select * from #__menu_description where menu_id=".$row['id'];
			$this->db->query($sql);
			$results = $this->db->getResult();
			foreach( $results as $r )
			{
				$row['name'.$r['language_id']] = $r['menu_name'];
				$row['metakey'.$r['language_id']] = $r['menu_metakey'];
				$row['metadesc'.$r['language_id']] = $r['menu_metadesc'];
			}

			**/
		}

		//print_r($parameter);
 		//print_r($linkParameter);
		return $row;
	}

	/**
	 * 保存
	 */
	function save()
	{
		global $app;
		//创建树结构,用树结构来执行相应的操作
 		$helperFile = PATH_COMPONENT.DS.'helper'.DS.'category.php';
		include($helperFile);

		$tree = new CategoryHelper();

		$data = array(
			'name'=>$_REQUEST['name'],
			'alias'=>preg_replace('/[\s|　]+/','_',$_REQUEST['alias']), 
			'type_id'=>$_REQUEST['type_id'],
			'title'=>$_REQUEST['title'],
			'spec_ids'=>implode(',',$_POST['spec_id']),
			'deposit'=>round($_POST['deposit'],2),
			'metakey'=>$_REQUEST['metakey'],
			'metadesc'=>$_REQUEST['metadesc']
		);
		
		//没有写相关分类名称
		if( !$data['name'] )
		{
			$data['name'] = date('YmdHis');
		}


		if( $_REQUEST['autoalias']  ){
			import('chinesespell.chinesespell');
			$spell = new ChineseSpell();
			$alias = $spell->getFullSpell( mb_convert_encoding(String::substr($data['name'],0,6),'gb2312','utf-8'),'' );


			$sql = " select count(*) from ".$this->tableName." where  alias='".$alias."' ";

			if( $id > 0 )
			{
				$sql.=" and id<>".$id;
			}
			$this->db->query($sql);
			$row = $this->db->getRow();

			$alias = preg_replace('/[\s\v]+/','',$alias);
			if( $row['n'] > 0 ){
				$data['alias'] = $alias.'2';
			}else{
				$data['alias'] = $alias;
			}
		}

		//没有写相关别名
		if( !$data['alias'] )
		{
			$data['alias'] = date('YmdHis');
		}
		 
		$parent_id = intval($_REQUEST['parent_id']);	//父栏目的ID
		$id = intval( $_REQUEST['id'] );

		if( $id > 0 )
		{


			$data['parent_id'] = $parent_id;	//父栏目ID
			$tree->update($id,$data);

		}else{ 
			$data['published'] = 1; //默认为发布状态
			$id = $tree->addsort($parent_id,$data);
			unset($data);

		}





		return true;
	}
	/** 删除 **/
	function del()
	{
		global $app;
		if( ($id=intval($_REQUEST['id'])) > 0 ){

			//创建树结构,用树结构来执行相应的操作
			$helperFile = PATH_COMPONENT.DS.'helper'.DS.'category.php';
			include($helperFile);

			$tree = new CategoryHelper();
			$tree->deletesort($id);

			$app->enqueueMessage(' 删除成功.');
		}
	}

	/** 修改状态 **/
	function toggle()
	{
		if( ($id = intval($_REQUEST['id']) )>0 && $_REQUEST['attr'] )
		{
			$arr = array( $_REQUEST['attr'] =>$_REQUEST['value'] );
			$this->db->updateArray($this->tableName,$arr," id='".$id."' ");
		}
	}



	/** 解锁和锁定 **/
	function unlock()
	{
		global $app;

 		$ids =  $this->_filterID( $_REQUEST['ids'] );

 		if( count($ids) )
		{
			$sql = " update ".$this->tableName." set published=1 where id in (".implode(',',$ids).") ";
			//echo $sql;exit;
			$this->db->query($sql);
 			$app->enqueueMessage(' 操作成功,共解锁 '.$this->db->getAffectedRows().'项.');
		}
		return true;
		 
	}
	function lock()
	{
		global $app;
		$ids =  $this->_filterID( $_REQUEST['ids'] );
 		if( count($ids) )
		{
			$sql = " update ".$this->tableName." set published=0 where id in (".implode(',',$ids).") ";
			//echo $sql;exit;
			$this->db->query($sql);
 			$app->enqueueMessage(' 操作成功,共锁定 '.$this->db->getAffectedRows().'项.');
		}
		return true;
	}
}
?>