<?php

class Editor{
 
	var $_editor = null;
	var $_name = null;
	
	/** 构选器方法 **/
	function Editor($editor = 'none')
	{
		$this->_name = $editor;
	}
	
	/** 多例方法 **/
	function &getInstance($editor = 'none')
	{
		static $instances;

		if (!isset ($instances)) {
			$instances = array ();
		}

		$signature = serialize($editor);
		if (empty ($instances[$signature])) {	 
			$path = PATH_PLUGINS.DS.'editors'.DS.$editor.'.php';

 			if ( ! file_exists($path) )
			{
				$message = '没有找到编辑器插件!';
				Error::throwError(  $message );
				return false;
			}
			$name = 'plgEditor'.$editor;
			if( !class_exists( $name ) ){	//加载一次
				require $path;
			}
			$instances[$signature] = new $name ();
		}
		return $instances[$signature];
	}

	function initialise()
	{
	}
	/** 显示方法  **/
	function display($name, $html, $width, $height, $col, $row, $buttons = true, $params = array())
	{
		$this->_loadEditor($params);

		//是否加载
		if(is_null(($this->_editor))) {
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