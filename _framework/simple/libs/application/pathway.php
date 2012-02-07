<?php
/**
* @ �汾		$Id: pathway.php 2009-6-26
* @ ����		·����
* @ ��			libraries
* @ �Ŷ�        �Ŷ�One��
* @ copyright   Copyright (c) 2006-2009 TuanduiOne Inc. All rights reserved {@link http://www.TuanduiOne.com}
* @ ����        ������
* @ E-mail      tuanduione@yahoo.cn
* @ ��֤		����ҵ�����֤,��ϸ��鿴��Ŀ¼�� LICENSE.txt
* @ ��ע��		��ϵͳ�����Ŷ�Э������
* @ �Ŷӳ�Ա	������ �ƹ�ʤ �ܽ��� ��۷�
*/

 /**
 * ��ǰλ�õĽ�����
 *
 */
class Pathway 
{
	/**
	 * ·����������
	 */
	var $_pathway = null;

	/**
	 * ����
	 */
	var $_count = 0;

 
	function Pathway($options = array())
	{
		//��ʼ��
		$this->_pathway = array();
	}

	/**
	 * ����
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

				// ����һ��·������
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
	 * ����һ��·������
	 */
	function getPathway()
	{
		$pw = $this->_pathway;

		// ʹ��array_values������ֵ����ļ�
		return array_values($pw);
	}

	/**
	 * ����·������
	 */
	function setPathway($pathway)
	{
		$oldPathway	= $this->_pathway;
		$pathway	= (array) $pathway;

		// ����.
		$this->_pathway = array_values($pathway);

		return array_values($oldPathway);
	}

	/**
	 * ����������һ�������·������
	 */
	function getPathwayNames()
	{
		// ��ʼ������
		$names = array (null);

		// �����˵�����������
		foreach ($this->_pathway as $item) {
			$names[] = $item->name;
		}
		return array_values($names);
	}

	/**
	 * ���������һ����Ŀ
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
	 * �趨һ����Ŀ����
	 *
	 * @param integer $id
	 * @param string $name
	 * @return boolean True on success 
	 */
	function setItemName($id, $name)
	{
		// ��ʼ��
		$ret = false;

		if (isset($this->_pathway[$id])) {
			$this->_pathway[$id]->name = $name;
			$ret = true;
		}

		return $ret;
	}

	/**
	 * ����һ����Ŀ
	 */
	function _makeItem($name, $link)
	{
		$item = new stdClass();
		$item->name = html_entity_decode($name);
		$item->link = $link;

		return $item;
	}
}
