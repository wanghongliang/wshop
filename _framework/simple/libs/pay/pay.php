<?php

class Pay{
 
	var $_pay = null;
	var $_name = null;
	
	/** 构选器方法 **/
	function Pay($pay = 'none')
	{
		$this->_name = $pay;
	}
	
	/** 多例方法 **/
	function &getInstance($signature = 0)
	{
		static $instances;

		if (!isset ($instances)) {
			$instances = array ();
		}
 
		if (empty ($instances[$signature])) {	 
			$db = &Factory::getDB();
			$sql = "select element,folder,params from #__plugins where id=".(int)$signature;
		 
			$db->query($sql);
			$row = $db->getRow();

			$path = PATH_PLUGINS.DS.$row['folder'].DS.$row['element'].'.php'; 

  			if ( ! file_exists($path) )
			{
				$message = '没有找到支付插件!';
				Error::throwError(  $message );
				return false;
			}
			$name = 'plgPay'.$row['element'];
			if( !class_exists( $name ) ){	//加载一次
				require $path;
			}
			import('html.format.ini'); 
			$params = FormatINI::stringToArray( $row['params'] ); 
			unset($params['desc']);
			$instances[$signature] = new $name ($params); 
			unset($row,$params);
		}
		return $instances[$signature];
	}

	function initialise()
	{
	}
	/** 显示方法  **/
	function display($name, $html, $width, $height, $col, $row, $buttons = true, $params = array())
	{
		$this->_loadPay($params);

		//是否加载
		if(is_null(($this->_pay))) {
			return;
		}
 		$width	= str_replace( ';', '', $width );
		$height	= str_replace( ';', '', $height );

 		$return = null;

		$args['name'] 		 = $name;
		$args['content']	 = $html;
		$args['width'] 		 = $width;
		$args['height'] 	 = $height;
		$args['col'] 		 = $col;
		$args['row'] 		 = $row;
		$args['buttons']	 = $buttons;
		$args['event'] 		 = 'onDisplay';

 		$return = $this->onDisplay($args);
 		return $return;
	}

	function onDisplay($args){ return null; }
	

}

?>