<?php
class modCompanyHelper
{
	/**
	 * ��ȡ��������
	 */
	function & getList(&$params)
	{
		global $app;
		$db = &Factory::getDB();
		//print_r($params);
		//˵���� ��ģ������������ݣ��ɴ�һ�������ݵĶ�ȡ


		//�����б�
		$list = array();
 			
		$query = "select * from #__companies where uid=".$app->uid;
		$db->query($query);
		$list = $db->getRow();
		return $list;

	}
 
}
