<?php
import('application.component.model');
class MenusModel extends Model
{
	var $menutypeid;

	var $types;

	function MenusModel()
	{
		parent::__construct();
		$this->tableName = '#__menu';
		$this->menutypeid = intval($_REQUEST['mtid']);

		if( $this->menutypeid < 1 )
		{
			$this->init(true);
		} 
	}

	function init($set = false)
	{
		//����SQL����˵�����ID��Ϣ
		$sql = "select id,title from #__menu_types where uid=".$this->uid."  ";	
		$this->db->query($sql);
		$this->types = $this->db->getResult();

		if( $set == true )
		{
			//�ض���ǰ�Ĳ˵���������
			$this->menutypeid = $this->types[0]['id'];
			$_REQUEST['mtid'] = $this->menutypeid;
		}
	}

	function getTypes()
	{
		if( empty($this->types) ){
			$this->init();
		}
		return $this->types;
	}

	function getList()
	{
		global $app;
		$context = $_REQUEST['com'];

		$order = $app->getUserStateFromRequest( 'filter_order',		'',		$context);
		$order_dir = $app->getUserStateFromRequest('filter_order_dir',		'',		$context  );
 		$lists['order'] = $order;
		$lists['order_dir'] = $order_dir;


		import('application.tree');
		$tree = new Tree();
		//$result = $tree->getcatagory(1,2);
		$lists['result'] = $tree->getAll(null,$order." ".$order_dir);
		return $lists;
	}

	//�����Բ˵�Ϊ��������
	function getMenucom()
	{
		static $com;
		if(empty($com))
		{
			$sql =" select com.option as o from #__components as com where com.menu_com = 1 ";
			$this->db->query($sql);
			$com = $this->db->getResult('o');
		}

 		return $com;
	}
	
}
?>