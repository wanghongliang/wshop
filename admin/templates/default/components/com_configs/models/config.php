<?php
import('application.component.model');
class ConfigModel extends Model
{
	var $menuid = 0;

	var $nav = null;
	function ConfigModel()
	{
		parent::__construct();
		$this->tableName = '#__configs';
		$this->menuid = intval($_REQUEST['menuid']);
	}


	function getOption(){
		$sql = "select * from #__configs_option where published=1 ";
		$this->db->query($sql);
		return $this->db->getResult();
	}
	/**
	 * 取当前编辑项
	 */
	function getItem()
	{
 
		$sql = " select * from ".$this->tableName."   "; 
 		$this->db->query($sql);
		$row = $this->db->getRow();	//获取菜单项数据
		return $row;
	}

	function getCom(){
		$sql = " select c.option,c.params from  #__components as c  where c.enabled=1  ";
		$this->db->query($sql);
		return $this->db->getResult('option');
	}

	function save()
	{
		global $app;
	 
		import('cache.cache');	//导入缓存常用文件 
		$options=serialize($_POST['options']);
		$data = array(
			'title'=>$_REQUEST['title'],
			'email'=>$_REQUEST['email'],
			'metakey'=>$_REQUEST['metakey'],
			'metadesc'=>$_REQUEST['metadesc'],
			'options'=>$options,
		);
		import('filesystem.dir'); 
		if( $_FILES['logo']['name']  ){
		if( $lists = WDir::uploadFile( $_FILES['logo'],$GLOBALS['config']['upload_dir'],'') ){
			 $data['logo']=$lists['uri_path'];
		} 
		}
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
 			$data['uid'] = $this->uid;
			$this->db->insertArray( $this->tableName, $data  );
 		}
 
		Cache::cacheConfig();	//生成缓存配置信息


		//查看是否有组件信息需要保存

		$com_params = array();
		foreach( $_POST as $k=>$v ){
			if( strpos( $k,'com_') !== false ){
				$k = substr($k,4);
				$com_params[$k] = $v; 
				$sql = " update #__components as c set c.params='".addslashes(serialize($v))."' where c.option='".$k."' ";
				$this->db->query($sql);
			}
		}

		//print_r($com_params);exit;



		$app->enqueueMessage(' 保存成功.');

		return true;
	}
	


  }






?>