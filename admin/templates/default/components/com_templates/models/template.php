<?php
import('application.component.model');
class TemplateModel extends Model
{
	var $client_id=0;
 	function TemplateModel()
	{
		parent::__construct();
		$this->tableName = '#__configs';
		$this->client_id = intval($_REQUEST['client_id']);
 	}
 

	/**
	 * 取当前编辑项
	 */
	function setDefault()
	{
		global $app;
		if( $this->client_id == 0 )
		{
			$ids_string = $_REQUEST['ids'];

			$ids = explode(',',$ids_string);
			if( $ids[0] ){
				$data = array('template'=>$ids[0]);
				$this->db->updateArray("#__configs" , $data ," uid='".$app->uid."' ");

				import('cache.cache');	//导入缓存常用文件
				Cache::cacheConfig();	//生成缓存配置信息
			}
		}
	}
 }
?>