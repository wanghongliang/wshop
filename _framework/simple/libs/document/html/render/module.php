<?php


class DocumentRendermodule
{
    /**
	 * ִ��ģ��
     */
	function render( $module, $params = array(), $content = null )
	{
		if (!is_object($module))
		{
			$title	= isset($params['title']) ? $params['title'] : null;

			$module =& ModuleHelper::getModule($module, $title);

			if (!is_object($module))
			{
				if (is_null($content)) {
					return '';
				} else {
					/**
					 * ���ģ��û���ҵ���������׼�Ķ���
					 */
					$tmp = $module;
					$module = new stdClass();
					$module->params = null;
					$module->module = $tmp;
					$module->id = 0;
					$module->user = 0;
				}
			}
		}


		// ����
		if (!is_null($content)) {
			$module->content = $content;
		}

 
		
		/**
		 * ��ֱ�ӷ��أ��ݲ�����
		 */
		return ModuleHelper::renderModule($module, $params);
	}
}

?>