<?php
import('application.component.model');
class DatabaseModel extends Model
{
	var $client_id=0;
 	function DatabaseModel()
	{
		parent::__construct();
		$this->tableName = '#__configs';
		$this->client_id = intval($_REQUEST['client_id']);
 	}
 

	/**
	 * 取当前编辑项
	 */
	function backup()
	{
		//print_r($GLOBALS['config']);


		$database = $GLOBALS['config']['database'];
		 $options = array( 
			'charset'=>'utf8',
			'filename'=>$database
		);


		if( mysql_connect($GLOBALS['config']['host'],$GLOBALS['config']['user'],$GLOBALS['config']['password']) ){
			//echo 'ok';
		}else{
			echo 'mysql connect error!';
		}
		mysql_select_db($database);
		mysql_query("SET NAMES '{$options['charset']}'");

		// 设置要导出的表

		$tables=list_tables($database);

		//$filename=sprintf($options['filename'],$database);
		$dirs = PATH_CACHE.DS.'data'.DS;
		
		import('filesystem.dir');
		WDir::mkdir($dirs);
		
 		if( !empty($_GET['fn']) ){ $options['filename'] = $_GET['fn']; }

		$filename = $dirs.$options['filename'].'_'.date('Y-m-d_His').'.sql';
		$fp=fopen($filename,'w');
		foreach($tables as $table){
			dump_table($table,$fp);
		}
		fclose($fp);
		mysql_close();  

		echo str_replace(DS,'/',str_replace(PATH_ROOT,'',$filename));
	}

	//恢复数据库
	function restore(){

		$fn =trim( $_GET['fn'] );
		if( !empty( $fn ) ){
			$dirs = PATH_CACHE.DS.'data'.DS.$fn;
			if( file_exists( $dirs ) ){
				//unlink( $dirs);
				$sql = file_get_contents( $dirs );
				$this->db->setQuery($sql);
				$this->db->queryBatch();
				echo '1';
			}
		}
		return true;
	}

	function upload(){	
		global $app;
 		if( count($_FILES) > 0  )
		{
			import('filesystem.dir'); 
			
 			$file_name = $_FILES['uploadfile']['name'];
 			if( substr($file_name,-4) == '.sql' ){
				//上传后的文件路径
				$path=PATH_CACHE.DS.'data'.DS.substr($file_name,0,-4).'_'.date('Y-m-d_His').'.up.sql';

				if(@move_uploaded_file(  $_FILES['uploadfile']['tmp_name'],$path))
				{
				   
				 $app->enqueueMessage(' 备份文件上传成功'); 
				}
			}else{
			
				$app->enqueueMessage(' 文件必需是 .sql 的格式','error'); 
			}

		}

		return false;
	}




	function delete(){
		$fn =trim( $_GET['fn'] );
		if( !empty( $fn ) ){
			$dirs = PATH_CACHE.DS.'data'.DS.$fn;
			if( file_exists( $dirs ) ){
				unlink( $dirs);
				echo '1';
			}
		}
		return true;
	}

	function deleteAll(){
		$dir = PATH_CACHE.DS.'data';
  		if( $data = $dir->getFiles($directory,'.sql') ){
			foreach( $data as $k=>$file ){
				unlink( $dir.$file['name'] );
			}
		}

		return true;
	}
 }

 
//获取表的名称
function list_tables($database)
{
    $rs = mysql_list_tables($database);
    $tables = array();
    while ($row = mysql_fetch_row($rs)) {
        $tables[] = $row[0];
    }
    mysql_free_result($rs);
    return $tables;
}
//导出数据库
function dump_table($table, $fp = null)
{
    $need_close = false;
    if (is_null($fp)) {
        $fp = fopen($table . '.sql', 'w');
        $need_close = true;
    }
	$a=mysql_query("show create table `{$table}`");
 	
	$row=@mysql_fetch_assoc($a);
	
 	fwrite($fp,"drop table if exists ".$row['Table'].";\n".$row['Create Table'].";\n\n");//导出表结构
    $rs = mysql_query("SELECT * FROM `{$table}`");
    while ($row = @mysql_fetch_row($rs)) {
        fwrite($fp, get_insert_sql($table, $row));
    }
    @mysql_free_result($rs);
    if ($need_close) {
        fclose($fp);
    }
}
//导出表数据
function get_insert_sql($table, $row)
{
    $sql = "INSERT INTO `{$table}` VALUES (";
    $values = array();
    foreach ($row as $value) {
        $values[] = "'" . mysql_real_escape_string($value) . "'";
    }
    $sql .= implode(', ', $values) . ");\n";
    return $sql;
}



?>
