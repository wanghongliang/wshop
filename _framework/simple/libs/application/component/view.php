<?php
/**
* @ 版本		$Id: view.php 2009-6-26
* @ 作用		视图类
* @ 包			libraries
* @ 团队        团队One网
* @ copyright   Copyright (c) 2006-2009 TuanduiOne Inc. All rights reserved {@link http://www.daybillion.com}
* @ 作者        王洪亮
* @ E-mail      daybillion@yahoo.com.cn
* @ 认证		需商业许可认证,详细请查看根目录下 LICENSE.txt
* @ 备注：		本系统基于团队协作开发
 */
 
/**
 * 视图基类
 */
class View
{
	/**
	 * 视图的名称
	 */
	var $_name = null;

	/**
	 * 注册的模型类数组
	 */
	var $_models = array();

	/**
	 * 视图的基本目录
	 */
	var $_basePath = null;

	/**
	 *默认的模型
	 */
	var $_defaultModel = null;


	/**
	 * 组件名称
	 */
	//var $com_name;

	/**
	 * 布局模板名称
	 */
	var $_layout = 'default';

	/**
	 * 布局模板的扩展名
	 */
	var $_layoutExt = 'php';

	/**
	* 搜索目录资源（模板） 
	*/
	var $_path = array(
		'template' => array(),
		'helper' => array()
	);

	/**
	* 默认的模板名称
	*/
	var $_template = null;

	/**
	* 脚本模板的输出内容
	*/
	var $_output = null;

	/**
     * 用于 escaping. 的回调方法
     *
     */
    var $_escape = 'htmlspecialchars';

	 /**
     * 使用的字符集
     *
     */
    var $_charset = 'UTF-8';

  
	function __construct($config = array())
	{
		//设置视图名称
		if (empty( $this->_name ))
		{
			if (array_key_exists('name', $config))  {
				$this->_name = $config['name'];
			} else {
				$this->_name = $this->getName();
 			}
		}
 			

		 //设置字符集信息
        if (array_key_exists('charset', $config)) {
            $this->_charset = $config['charset'];
        }

		 // 定义 escape 回调方法
        if (array_key_exists('escape', $config)) {
            $this->setEscape($config['escape']);
        }

		// 设置基本的搜索路径
		if (array_key_exists('base_path', $config)) {
			$this->_basePath	= $config['base_path'];
		} else {
			$this->_basePath	= PATH_COMPONENT;
		}

		//模板路径
		if (array_key_exists('template_path', $config)) {
			//使用用户自定义的模板路径
			$this->_setPath('template', $config['template_path']);
		} else {
			$this->_setPath('template', $this->_basePath.DS.'views'.DS.$this->getName().DS.'tmpl');
		}

		// 帮助类文件的搜索路径
		if (array_key_exists('helper_path', $config)) {
			// 用户自定义的目录
			$this->_setPath('helper', $config['helper_path']);
		} else {
			$this->_setPath('helper', $this->_basePath.DS.'helpers');
		}

		// 设定布局文件
		if (array_key_exists('layout', $config)) {
			$this->setLayout($config['layout']);
		} else {
			$this->setLayout('default');
		}
 
	}

	/**
	 * 视图初始化方法
	 */
	function init(){}

	/**
	* 执行模板文件
	*
	* @param string 模板名称：自动从模板路径中搜索
	*
 	* @see fetch()
	*/
	function display($tpl = null)
	{
 		echo $this->loadTemplate($tpl);
	}

	/**
	* 给视图不同的变量赋值
	*
	* 可以通过不同参数赋值
	* 不可以给开头是下划线的变量赋值，他们是私的变量
	*
	* <code>
	* $view = new WView();
	*
	* // assign directly
	* $view->var1 = 'something';
	* $view->var2 = 'else';
	*
	* // assign by name and value
	* $view->assign('var1', 'something');
	* $view->assign('var2', 'else');
	*
	* // assign by assoc-array
	* $ary = array('var1' => 'something', 'var2' => 'else');
	* $view->assign($obj);
	*
	* // assign by object
	* $obj = new stdClass;
	* $obj->var1 = 'something';
	* $obj->var2 = 'else';
	* $view->assign($obj);
	*
	* </code>
	*
	* @return bool True on success, false on failure.
	*/
	function assign()
	{
		// get the arguments; there may be 1 or 2.
		$arg0 = @func_get_arg(0);
		$arg1 = @func_get_arg(1);

		// assign by object
		if (is_object($arg0))
		{
			// assign public properties
			foreach (get_object_vars($arg0) as $key => $val)
			{
				if (substr($key, 0, 1) != '_') {
					$this->$key = $val;
				}
			}
			return true;
		}

		// assign by associative array
		if (is_array($arg0))
		{
			foreach ($arg0 as $key => $val)
			{
				if (substr($key, 0, 1) != '_') {
					$this->$key = $val;
				}
			}
			return true;
		}

		// assign by string name and mixed value.

		// we use array_key_exists() instead of isset() becuase isset()
		// fails if the value is set to null.
		if (is_string($arg0) && substr($arg0, 0, 1) != '_' && func_num_args() > 1)
		{
			$this->$arg0 = $arg1;
			return true;
		}

		// $arg0 was not object, array, or string.
		return false;
	}


	/**
	* 给视图设置一个属性变量
	* <code>
	* $view = new WView();
	*
	* // assign by name and value
	* $view->assignRef('var1', $ref);
	*
	* // assign directly
	* $view->ref =& $var1;
	* </code>
	*
	* @access public
	*
	* @param string $key The name for the reference in the view.
	* @param mixed &$val The referenced variable.
	*
	* @return bool True on success, false on failure.
	*/

	function assignRef($key, &$val)
	{
		if (is_string($key) && substr($key, 0, 1) != '_')
		{
			$this->$key =& $val;
			return true;
		}

		return false;
	}

	/**
     * 过滤一个视图变量的输出
     *
     * @param  mixed $var The output to escape.
     * @return mixed The escaped value.
     */
    function escape($var)
    {
        if (in_array($this->_escape, array('htmlspecialchars', 'htmlentities'))) {
            return call_user_func($this->_escape, $var, ENT_COMPAT, $this->_charset);
        }

        return call_user_func($this->_escape, $var);
    }

	/**
	 * 调用模型的相关方法，如果没有相关模型的方法，将返回视图的属性变量
	 */
	function &get( $property, $default = null )
	{

		// If $model is null we use the default model
		if (is_null($default)) {
			$model = $this->_defaultModel;
		} else {
			$model = strtolower( $default );
		}

 
		// First check to make sure the model requested exists
		if (isset( $this->_models[$model] ))
		{
			// Model exists, lets build the method name
			$method = 'get'.ucfirst($property);

			// Does the method exist?
			if (method_exists($this->_models[$model], $method))
			{
				// The method exists, lets call it and return what we get
                $result = $this->_models[$model]->$method();
                return $result;
			}

		}

		// degrade to WObject::get
		$result = $this->getProperty( $property, $default );
		return $result;
	}
	/**
	 * 返回相关属性值
 	 */
	function getProperty($property, $default=null)
	{
		if(isset($this->$property)) {
			return $this->$property;
		}
		return $default;
	}
	/**
	 * 获取模型
	 */
	function &getModel( $name = null )
	{
		if ($name === null) {
			$name = $this->_defaultModel;
		}
		return $this->_models[strtolower( $name )];
	}

	/**
	* 获取布局
	*/

	function getLayout()
	{
		return $this->_layout;
	}

	/**
	 * 获取一个视图名称 
	 */
	function getName()
	{
		$name = $this->_name;

		if (empty( $name ))
		{
			$r = null;
			if (!preg_match('/((view)*(.*(view)?.*))View$/i', get_class($this), $r)) {
				Error::throwError (  "WView::getName() : Cannot get or parse class name.");
			}
 
			if (strpos($r[3], "view"))
			{
				Error::throwError("视图的类名错!");
			}
			$name = strtolower( $r[3] );
		}
		return $name;
	}

	/**
	 * 添加一个模型对象到视图
	 */
	function &setModel( &$model, $default = true )
	{
		//print_r($model);
		if( !is_object($model) )
		{
			Error::throwError('不是一个模型对象,请查看是否在组件 model 目录下有对应的模型类!');
		}
		$name = strtolower($model->getName());
 		$this->_models[$name] = &$model;
		if ($default) {
			$this->_defaultModel = $name;
		}
 		return $model;
	}

	/**
	* 设置布局
	*/

	function setLayout($layout)
	{
		if( $layout ){

 			$previous		= $this->_layout;
			$this->_layout = $layout;
			return $previous;
		}
		return false;
	}

	/**
	 * 允许设置不同的模板布局文件后缀名称
	 */
	function setLayoutExt( $value )
	{
		$previous	= $this->_layoutExt;
		if ($value = preg_replace( '#[^A-Za-z0-9]#', '', trim( $value ) )) {
			$this->_layoutExt = $value;
		}
		return $previous;
	}

	 /**
     * 设置一个 escape 回调函数
     */
    function setEscape($spec)
    {
        $this->_escape = $spec;
    }

	/**
	 * 添加一个模板路径
	 */
	function addTemplatePath($path)
	{
		$this->_addPath('template', $path);
	}

	/**
	 *添加一个帮助文件路径
	 */
	function addHelperPath($path)
	{
		$this->_addPath('helper', $path);
	}

	/**
	 * 加载一个模板文件
	 */
	function loadTemplate( $tpl = null)
	{
		global $app, $option;

		// 清除输出变量的值
		$this->_output = null;

		//	创建的模板文件名的基础上的布局
		$file = isset($tpl) ? $this->_layout.'_'.$tpl : $this->_layout;


		$this->_template = PATH_COMPONENT.DS.'views'.DS.$this->getName().DS.'tmpl'.DS.$file.'.php';
		
     	if ( file_exists($this->_template) )
		{
 			unset($tpl);
			unset($file);
 
 			ob_start();
 			include $this->_template;
 			$this->_output = ob_get_contents();
			ob_end_clean();
			return $this->_output;
		}
		else {
			$this->_template = PATH_COMPONENT.DS.'views'.DS.$this->getName().DS.'tmpl'.DS.'default.php';
			if ( file_exists($this->_template) )
			{
				unset($tpl);
				unset($file);
	 
				ob_start();
				include $this->_template;
				$this->_output = ob_get_contents();
				ob_end_clean();
				return $this->_output;
			}
			else {
				return Error::throwError( 'Layout "' . $file . '" not found' );
			}
		}
	}

	/**
	 * 加载一个帮助文件
	 */
	function loadHelper( $hlp = null)
	{
		// clean the file name
		$file = preg_replace('/[^A-Z0-9_\.-]/i', '', $hlp);

 		wimport('core.filesystem.path');
		$helper = WPath::find($this->_path['helper'], $this->_createFileName('helper', array('name' => $file)));

		if ($helper != false)
		{
 			include_once $helper;
		}
	}

	/**
	* 设置模板搜索文件夹路径
	*
	* @access protected
	* @param string 路径的类型，通常是 template
	* @param string|array 路径字符，或数组
	*/
	function _setPath($type, $path)
	{
		global $app, $option;

		// clear out the prior search dirs
		$this->_path[$type] = array();

		// actually add the user-specified directories
		$this->_addPath($type, $path);

		// always add the fallback directories as last resort
		switch (strtolower($type))
		{
			case 'template':
			{
				// set the alternative template search dir
				if (isset($app))
				{
					$option = preg_replace('/[^A-Z0-9_\.-]/i', '', $option);
					$fallback = PATH_BASE.DS.'templates'.DS.$app->getTemplate().DS.'html'.DS.$option.DS.$this->getName();
					$this->_addPath('template', $fallback);
				}
			}	break;
		}
	}

	/**
	* 添加路径
	*/
	function _addPath($type, $path)
	{
		// just force to array
		settype($path, 'array');

		// loop through the path directories
		foreach ($path as $dir)
		{
			// no surrounding spaces allowed!
			$dir = trim($dir);

			// add trailing separators as needed
			if (substr($dir, -1) != DIRECTORY_SEPARATOR) {
				// directory
				$dir .= DIRECTORY_SEPARATOR;
			}

			// add to the top of the search dirs
			array_unshift($this->_path[$type], $dir);
		}
	}

	/**
	 * 创建相关资源的文件名称
	 *
	 * @param string 	$type  类型
	 * @param array 	$parts 信息
	 * @return string 文件名称
	 */
	function _createFileName($type, $parts = array())
	{
		$filename = '';

		switch($type)
		{
			case 'template' :
				$filename = strtolower($parts['name']).'.'.$this->_layoutExt;
				break;

			default :
				$filename = strtolower($parts['name']).'.php';
				break;
		}
		return $filename;
	}
}