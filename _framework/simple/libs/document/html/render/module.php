<?php


class DocumentRendermodule
{
    /**
	 * 执行模块
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
					 * 如果模块没有找到，创建标准的对象
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


		// 内容
		if (!is_null($content)) {
			$module->content = $content;
		}

 
		
		/**
		 * 先直接返回，暂不缓存
		 */
		return ModuleHelper::renderModule($module, $params);
	}
}

?>