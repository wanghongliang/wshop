<?php
/**
* @ �汾		$Id: controller.php 2009-6-26
* @ ����		���������ļ�
* @ ��			libraries
* @ �Ŷ�        �Ŷ�One��
* @ copyright   Copyright (c) 2006-2009 TuanduiOne Inc. All rights reserved {@link http://www.daybillion.com}
* @ ����        ������
* @ E-mail      daybillion@yahoo.com.cn
* @ ��֤		����ҵ�����֤,��ϸ��鿴��Ŀ¼�� LICENSE.txt
* @ ��ע��		��ϵͳ�����Ŷ�Э������
* @ �Ŷӳ�Ա	������ �ƹ�ʤ �ܽ��� ��۷�
*/

defined('PATH_BASE') or die();

/**
 * ����������
 */
class WController extends WObject
{
	/**
	 * ���������ļ�·��
	 */
	var $_basePath = null;

	/**
	 * ����������
	 */
	var $_name = null;

	/**
	 * �෽��
	 */
	var $_methods 	= null;

	/**
	 * ��������ӳ��
	 */
	var $_taskMap 	= null;

	/**
	 * ��ǰִ�е�����
	 */
	var $_task 		= null;

	/**
	 * ����ӳ��
	 */
	var $_doTask 	= null;

	/**
	 * ��ͼ���ļ�Ŀ¼
	 */
	var $_path = array(
		'view'	=> array()
	);

	/**
	 * �ض����URL
	 */
	var $_redirect 	= null;

	/**
	 * �ض������Ϣ
	 */
	var $_message 	= null;

	/**
	 * ��Ϣ����
	 */
	var $_messageType 	= null;

	/**
	 * Ȩ�޿�����
	 */
	var $_acoSection 		= null;

	/**
	 * Ĭ�Ͽ��������ֵ
	 */
	var $_acoSectionValue 	= null;

	/**
	 * ������
	 *
	 * @param	������Ϣ����
	 */
	function __construct( $config = array() )
	{
		//ʵʼ��˽�еı���
		$this->_redirect	= null;
		$this->_message		= null;
		$this->_messageType = 'message';
		$this->_taskMap		= array();
		$this->_methods		= array();
		$this->_data		= array();

		// ��ȡ�෽��
		$thisMethods	= get_class_methods( get_class( $this ) );
		$baseMethods	= get_class_methods( 'WController' );
		$methods		= array_diff( $thisMethods, $baseMethods );

		//���Ĭ�ϵ�����
		$methods[] = 'display';

		// �������ӳ��
		foreach ( $methods as $method )
		{
			if ( substr( $method, 0, 1 ) != '_' ) {
				$this->_methods[] = strtolower( $method );
				//�Զ�ע�ṫ������
				$this->_taskMap[strtolower( $method )] = $method;
			}
		}

		// ����
		if (empty( $this->_name ))
		{
			if (array_key_exists('name', $config))  {
				$this->_name = $config['name'];
			} else {
				$this->_name = $this->getName();
			}
		}

		// ����������·��
		if (array_key_exists('base_path', $config)) {
			$this->_basePath	= $config['base_path'];
		} else {
			$this->_basePath	= PATH_COMPONENT;// PATH_COMPONENT;
		}

		// ע��Ĭ�ϵ�����
		if ( array_key_exists( 'default_task', $config ) ) {
			$this->registerDefaultTask( $config['default_task'] );
		} else {
			$this->registerDefaultTask( 'display' );
		}

		// ����ģ����·��
		if ( array_key_exists( 'model_path', $config ) ) {
	  
			$this->addModelPath($config['model_path']);
		} else {
			$this->addModelPath($this->_basePath.DS.'models');
		}

		// ��ͼ��·��
		if ( array_key_exists( 'view_path', $config ) ) {
		 
			$this->_setPath( 'view', $config['view_path'] );
		} else {
			$this->_setPath( 'view', $this->_basePath.DS.'views' );
		}

		//�������ʼ��
		$this->init();
	}

	function init(){}

	/**
	 * ִ���������ֱ�ӵ��ÿ�������������෽��
	 */
	function execute( $task )
	{
		$this->_task = $task;

		$task = strtolower( $task );
		if (isset( $this->_taskMap[$task] )) {
			$doTask = $this->_taskMap[$task];
		} elseif (isset( $this->_taskMap['__default'] )) {
			$doTask = $this->_taskMap['__default'];
		} else {
			return WError::raiseError( 404, WText::_('Task ['.$task.'] not found') );
		}
 		$this->_doTask = $doTask;



		//��֤
		if ($this->authorize( $doTask ))
		{
			$retval = $this->$doTask();
			return $retval;
		}
		else
		{
			return WError::raiseError( 403, WText::_('Access Forbidden') );
		}
 	}

	/**
	 * ��֤���
	 */
	function authorize( $task )
	{
 		if ($this->_acoSection)
		{
 			if ($this->_acoSectionValue) {
 				$task = $this->_acoSectionValue;
			}
 			$user = & WFactory::getUser();
			return $user->authorize( $this->_acoSection, $task );
		}
		else
		{
 			return true;
		}
	}

	/**
	 * ���͵�MVCִ�з�ʽ
	 */
	function display($cachable=false)
	{
		$document =& WFactory::getDocument();

		$viewType	= $document->getType();
		$viewName	= WRequest::getCmd( 'view', $this->getName() );
		$viewLayout	= WRequest::getCmd( 'layout', 'default' );
	
  
		$view = & $this->getView( $viewName, $viewType, '', array( 'base_path'=>$this->_basePath));

		//print_r($view);
 		if ($model = & $this->getModel($viewName)) {
			$view->setModel($model, true);
		}
 

		$view->setLayout($viewLayout);

	 
		if ($cachable) {
			global $option;
			$cache =& WFactory::getCache($option, 'view');
			$cache->get($view, 'display');
		} else {
			$view->display();
		}

	}

	/**
	 * ת������ҳ��
	 */
	function redirect()
	{
		if ($this->_redirect) {
			global $app;
			$app->redirect( $this->_redirect, $this->_message, $this->_messageType );
		}
		return false;
	}

	/**
	 * ȡ���ģ�ͷ���
	 */
	function &getModel( $name = '', $prefix = '', $config = array() )
	{
		if ( empty( $name ) ) {
			$name = $this->getName();
		}

		if ( empty( $prefix ) ) {
			$prefix = $this->getName() . 'Model';
		}

		if ( $model = & $this->_createModel( $name, $prefix, $config ) )
		{
			// ����ģ�͵��������
			$model->setState( 'action', $this->_task );

			// �Ѳ˵������ã�����ģ������
			$app	= &WFactory::getApplication();
			$menu	= &$app->getMenu();
			if (is_object( $menu ))
			{
				if ($item = $menu->getActive())
				{
					$params	=& $menu->getParams($item->id);
					// Set Default State Data
					$model->setState( 'parameters.menu', $params );
				}
			}
		}
		return $model;
	}

	/**
	 * ���һ��ģ������·��
	 */
	function addModelPath( $path )
	{
		wimport('core.application.component.model');
		WModel::addIncludePath($path);
	}

	/**
	 * ��ȡ�����б�
	 */
	function getTasks()
	{
		return $this->_methods;
	}

	/**
	 * ��ȡ����
	 */
	function getTask()
	{
		return $this->_task;
	}

	/**
	 * ������������
	 */
	function getName()
	{
		$name = $this->_name;
		
 		if (empty( $name ))
		{
			$r = null;
			if ( !preg_match( '/(.*)Controller/i', get_class( $this ), $r ) ) {
				WError::raiseError(500, "WController::getName() : Cannot get or parse class name.");
			}
			$name = strtolower( $r[1] );
		}

		return $name;
	}

	/**
	 * ��ȡ��ͼ��
	 */
	function &getView( $name = '', $type = '', $prefix = '', $config = array() )
	{
		static $views;

		if ( !isset( $views ) ) {
			$views = array();
		}

		if ( empty( $name ) ) {
			$name = $this->getName();
		}

		if ( empty( $prefix ) ) {
			$prefix = $this->getName() . 'View';
		}

		if ( empty( $views[$name] ) )
		{
			if ( $view = & $this->_createView( $name, $prefix, $type, $config ) ) {
				$views[$name] = & $view;
			} else {
				$result = WError::raiseError(
					500, WText::_( 'View File not found [name, type, prefix]:' )
						. ' ' . $name . ',' . $type . ',' . $prefix
				);
				return $result;
			}
		}

		return $views[$name];
	}

	/**
	 * ���һ����ͼ�࣬�ļ�����·��
	 */
	function addViewPath( $path )
	{
		$this->_addPath( 'view', $path );
	}

	/**
	 * ע��һ������ӳ�䷽�����滻ԭ����
	 */
	function registerTask( $task, $method )
	{
		if ( in_array( strtolower( $method ), $this->_methods ) ) {
			$this->_taskMap[strtolower( $task )] = $method;
		}
	}

	/**
	 * ע��һ��Ĭ�ϵķ���
	 */
	function registerDefaultTask( $method )
	{
		$this->registerTask( '__default', $method );
	}

	/**
	 *����һ���ڲ�����Ϣ
	 */
	function setMessage( $text )
	{
		$previous		= $this->_message;
		$this->_message = $text;
		return $previous;
	}

	/**
	 * �ض���������URL
	 */
	function setRedirect( $url, $msg = null, $type = 'message' )
	{
		$this->_redirect = $url;
		if ($msg !== null) {
			 
			$this->_message	= $msg;
		}
		$this->_messageType	= $type;
	}

	/**
	 * ���÷��ʿ��Ƶȼ�
	 *
	 * @access	public
	 * @param	string  ���
	 * @param	string  �ȼ�ֵ
	 */
	function setAccessControl( $section, $value = null )
	{
		$this->_acoSection = $section;
		$this->_acoSectionValue = $value;
	}

	/**
	 * ����һ��ģ�Ͷ���
	 *
	 * @param	string  ģ������
	 * @param	string	ģ�͵�ǰ׺
	 * @param	array	������Ϣ����
	 * @return	mixed	ģ�Ͷ���
	 */
	function &_createModel( $name, $prefix = '', $config = array())
	{
		$result = null;

		// Clean the model name
		$modelName	 = preg_replace( '/[^A-Z0-9_]/i', '', $name );
		$classPrefix = preg_replace( '/[^A-Z0-9_]/i', '', $prefix );
		
		$result =& WModel::getInstance($modelName, $classPrefix, $config);
		return $result;
	}

	/**
	 * �������ز�����һ����ͼ���󡣸÷������Ȼ��ڵ�ǰ��ģ��Ŀ¼�ĶԱȣ���û��ʹ��Ĭ������·��������ͼ����ļ���
	 *
	 * ע�������˳��
	 * @param	string  ��ͼ������
	 * @param	string	��ǰ׺
	 * @param	string	��ͼ����
	 * @param	array	������Ϣ
	 * @return	mixed	��ͼ����
	 */
	function &_createView( $name, $prefix = '', $type = '', $config = array() )
	{
		$result = null;

		// �����ļ�����
		$viewName	 = preg_replace( '/[^A-Z0-9_]/i', '', $name );
		$classPrefix = preg_replace( '/[^A-Z0-9_]/i', '', $prefix );
		$viewType	 = preg_replace( '/[^A-Z0-9_]/i', '', $type );

		// ��ͼ����
		$viewClass = $classPrefix . $viewName;


		//echo $viewClass;

		if ( !class_exists( $viewClass ) )
		{
			wimport( 'core.filesystem.path' );
			$path = WPath::find(
				$this->_path['view'],
				$this->_createFileName( 'view', array( 'name' => $viewName, 'type' => $viewType) )
			);
			//print_r($this->_path['view']);
			//print_r($this->_createFileName( 'view', array( 'name' => $viewName, 'type' => $viewType)));exit;
 			if ($path) {
				require_once $path;

				if ( !class_exists( $viewClass ) ) {
					$result = WError::raiseError(
						500, WText::_( 'View class not found [class, file]:' )
						. ' ' . $viewClass . ', ' . $path );
					return $result;
				}
			} else {
				return $result;
			}
		}

		$result = new $viewClass($config);
		return $result;
	}



	/**
	* ������ͼ��ģ������ļ���·��
	*/
	function _setPath( $type, $path )
	{
 		$this->_path[$type] = array();

 		$this->_addPath( $type, $path );
	}

	/**
	*���һ�������ļ�·��
	*
	* @param	string ·�������磺 'model', 'view'.
	* @param	string|array Ŀ¼
	* @return	void
	*/
	function _addPath( $type, $path )
	{
		// just force path to array
		settype( $path, 'array' );

		// loop through the path directories
		foreach ( $path as $dir )
		{
			// no surrounding spaces allowed!
			$dir = trim( $dir );

			// add trailing separators as needed
			if ( substr( $dir, -1 ) != DIRECTORY_SEPARATOR ) {
				// directory
				$dir .= DIRECTORY_SEPARATOR;
			}

			// add to the top of the search dirs
			array_unshift( $this->_path[$type], $dir );
		}
	}


	function _createFileName( $type, $parts = array() )
	{
		$filename = '';

		switch ( $type )
		{
			case 'view':
				if ( !empty( $parts['type'] ) ) {
					$parts['type'] = '.'.$parts['type'];
				}

				$filename = strtolower($parts['name']).DS.'view'.$parts['type'].'.php';
			break;
		}
		return $filename;
	}
}