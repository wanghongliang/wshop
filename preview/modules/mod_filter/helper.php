<?php
class modFilterHelper
{
	/**
	 * ��ȡ��������
	 */
	function & getProvince($area=1)
	{
		global $app;
 
		$menu = &$app->getMenu();
		//�����б�
		$list = array();
 			
		$list = &$menu->getCategory();
		return $list;


	}
 
}
