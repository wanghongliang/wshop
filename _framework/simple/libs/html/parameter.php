<?php

//加载对应的参数元素
include(dirname(__FILE__).DS.'parameter'.DS.'element.php');

/**
 * 参数的处理
 * 用于处理和加载相关的参数，包括XML文件
 *
 */
class Parameter
{
	var $_xml = null; //XML分析后的数据
	var $_elements = array();
	var $_elementPath = array();
	var $params = array();		//元素列表
	var $params_value = array();

	function __construct($data, $path = '')
	{
 		// 设定默认的元素路径
		$this->_elementPath[] = dirname( __FILE__ ).DS.'parameter'.DS.'element';

		if( is_array($data) ){
			$this->_parseData( $data );		//直接将数组绑定到对象上
		}else if( is_file( $data ) )
		{
			$this->_loadXMLFile( $data );
		}
	}
	
	/** 绑定字符串 **/
	function bind($string )
	{
		if( is_string($string) ){
			//把 ini 字符串分析为数组
			import('html.format.ini');
			$data = &FormatINI::stringToArray($string);
			$this->params_value = $data;
		}
		return true;
	}

	/**
	 * 绑定数据
	 *
	 * @param	mixed	$data 数组 或 对象
	 * @return	boolean	成功返回 true
	 */
	function _parseData($data)
	{
		if ( is_array($data) ) {
			
			$this->_xml = $data;

 			if( is_array($data['metadata']['state']['params']) )
			{


				//如果参数为一个XML解析为 一个 param attr 属性
 					$params = $data['metadata']['state']['params'];

					if( count($params['param'])>1 )	//如果有一个属性会分在 param att and param 
					{
						$this->_parseArray($params['param']);
						return;
					}
	
					$currentParams = $params['param attr'];

					 
					$currentParams['optoins'] = array();;
					
					if( is_array( $params['param']['option'] ) )
					{
						$options = $params['param']['option'];

						for( $i = 0,$n = count($options)/2; $i<$n; $i++ ){
							$currentParams['optoins'][$i] = array(
								'text'=>$options[$i],
								'attr'=>$options[$i.' attr']
							);
							
						}
					}
					$this->params[] =$currentParams;

				 
			}else if( is_array($data['install']['params']) ){
				$params = $data['install']['params'];
				
				if( is_array($params['param attr']) )
				{
					$currentParams = $params['param attr'];
					$currentParams['optoins'] = array();;
					
					if( is_array( $params['param']['option'] ) )
					{
						$options = $params['param']['option'];

						for( $i = 0,$n = count($options)/2; $i<$n; $i++ ){
							$currentParams['optoins'][$i] = array(
								'text'=>$options[$i],
								'attr'=>$options[$i.' attr']
							);
							
						}
					}
					$this->params[] =$currentParams;
 				}else{
					$this->_parseArray($params['param']);
				 }

			}



	
			
		}
	}

	function _parseArray(&$params)
	{
			/** 分析 XML 文件中的 params **/
			if( is_array( $params ) ){
			//foreach( $params as $k=>$param )
				$y=count($params)/2;
				

					for( $x=0;$x<$y;$x++)
					{
						$currentParams = $params[$x.' attr'];
						$currentParams['optoins'] = array();;
						
						if( is_array( $params[$x]['option'] ) )
						{
							$options = $params[$x]['option'];

							for( $i = 0,$n = count($options)/2; $i<$n; $i++ ){
								$currentParams['optoins'][$i] = array(
									'text'=>$options[$i],
									'attr'=>$options[$i.' attr']
								);
								
							}
						}
						$this->params[] =$currentParams;
	 
					}
			 
			}else{  
				 
			}
	}


	/** 分析一个XML文件 **/
	function _loadXMLFile($file)
	{
		if( file_exists( $file ) )
		{
			import('filesystem.xml');
			$metadata = XML_unserialize( file_get_contents($file) );
			$this->_parseData($metadata);
			return true;
		}
		return false;	
	}


	/**
	 * 输出参数
	 *
	 */
	function render()
	{
		if (!isset($this->_xml)) {
			return false;
		}


		$params = $this->params;	//获取参数
		$html = array ();
		$html[] = '<table width="100%" class="paramlist admintable" cellspacing="1">';

		//if ($description = $params['description']) {
		//	// 添加一个描述
		//	$desc	= ($description);
		//	$html[]	= '<tr><td class="paramlist_description" colspan="2">'.$desc.'</td></tr>';
		//}
		

		//直接加载元素
		$element = new Element();
		
 		foreach ($params as $param)
		{
			if( $ele = $element->loadElement($param['type']) )
			{
				if( isset( $this->params_value[$param['name']] ) )
				{
					$value = $this->params_value[$param['name']];
				}else{
					$value = $param['default'];
				}
 

				$param = $ele->render($param,$value);
 				$html[] = '<tr>';
				if ($param[0]) {
					$html[] = '<td width="21%" class="paramlist_key"><span class="editlinktip">'.$param[0].'</span></td>';
 					if( !empty($param[2]) ){
						$html[] = '<td class="paramlist_value" >'.$param[1].'<div class="des">'.$param[2].'</div></td>';
					}else{
						$html[] = '<td class="paramlist_value" >'.$param[1].'</td>';
					}

				} else {
					 
					if( !empty($param[2]) ){
						$html[] = '<td class="paramlist_value" colspan="2">'.$param[1].'<div class="des">'.$param[2].'</div></td>';
					}else{
						$html[] = '<td class="paramlist_value" colspan="2">'.$param[1].'</td>';
					}
				}
				$html[] = '</tr>';
			}
		}

		if (count($params) < 1) {
			$html[] = "<tr><td colspan=\"2\"><i>".('此项没有对应的参数.')."</i></td></tr>";
		}

		$html[] = '</table>';

		return implode("\n", $html);
	}
 
}