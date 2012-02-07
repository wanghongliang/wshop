<?php
/**
* @ 版本		$Id: pathway.php 2009-6-26
* @ 作用		路径类
* @ 包			libraries
* @ 团队        团队One网
* @ copyright   Copyright (c) 2006-2009 TuanduiOne Inc. All rights reserved {@link http://www.TuanduiOne.com}
* @ 作者        王洪亮
* @ E-mail      tuanduione@yahoo.cn
* @ 认证		需商业许可认证,详细请查看根目录下 LICENSE.txt
* @ 备注：		本系统基于团队协作开发
* @ 团队成员	王洪亮 唐国胜 熊进超 金慧芬
*/

 /**
 * 当前位置的解析类
 *
 */
class Pathway 
{
	/**
	 * 路径对象数组
	 */
	var $_pathway = null;

	/**
	 * 数量
	 */
	var $_count = 0;

 
	function Pathway($options = array())
	{
		//初始化
		$this->_pathway = array();
	}

	/**
	 * 工厂
	 */
	function &getInstance($client, $options = array())
	{
		static $instances;

		if (!isset( $instances )) {
			$instances = array();
		}

		if (empty($instances[$client]))
		{
			 
 
			$path = PATH_BASE.DS.'includes'.DS.'pathway.php';
			if(file_exists($path))
			{
				require_once $path;

				// 创建一个路径对象
				$classname = 'Pathway'.ucfirst($client);
				$instance = new $classname($options);
			}
			else
			{
				WError::throwError( 'Unable to load pathway: '.$client); 
			}

			$instances[$client] = & $instance;
		}

		return $instances[$client];
	}

	/**
	 * 返回一个路径数组
	 */
	function getPathway()
	{
		$pw = $this->_pathway;

		// 使用array_values重置数值数组的键
		return array_values($pw);
	}

	/**
	 * 设置路径数组
	 */
	function setPathway($pathway)
	{
		$oldPathway	= $this->_pathway;
		$pathway	= (array) $pathway;

		// 设置.
		$this->_pathway = array_values($pathway);

		return array_values($oldPathway);
	}

	/**
	 * 创建并返回一个数组的路径名称
	 */
	function getPathwayNames()
	{
		// 初始化变量
		$names = array (null);

		// 构建菜单项名称数组
		foreach ($this->_pathway as $item) {
			$names[] = $item->name;
		}
		return array_values($names);
	}

	/**
	 * 创建并添加一个项目
	 */
	function addItem($name, $link='')
	{
		// Initalize variables
		$ret = false;

		if ($this->_pathway[] = $this->_makeItem($name, $link)) {
			$ret = true;
			$this->_count++;
		}
		return $ret;
	}


	/**
	 * 设定一个项目名称
	 *
	 * @param integer $id
	 * @param string $name
	 * @return boolean True on success 
	 */
	function setItemName($id, $name)
	{
		// 初始化
		$ret = false;

		if (isset($this->_pathway[$id])) {
			$this->_pathway[$id]->name = $name;
			$ret = true;
		}

		return $ret;
	}

	/**
	 * 创建一个项目
	 */
	function _makeItem($name, $link)
	{
		$item = new stdClass();
		$item->name = html_entity_decode($name);
		$item->link = $link;

		return $item;
	}
}
