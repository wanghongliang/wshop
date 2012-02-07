<?php
/**
* @ 版本		$Id: head.php 2009-6-26
* @ 作用		文档类，输出各种格式的文档
* @ 包		libraries.core.documet.html.reader
* @ 团队        团队One网
* @ copyright   Copyright (c) 2006-2009 TuanduiOne Inc. All rights reserved {@link http://www.TuanduiOne.com}
* @ 作者        王洪亮
* @ E-mail      tuanduione@yahoo.cn
* @ 认证		需商业许可认证,详细请查看根目录下 LICENSE.txt
* @ 备注：本框架基于团队协作开发
*/
 

class DocumentRenderHead 
{
	/**
	* 文档对象的引用
	*/
	var	$_doc = null;

	/**
	 * 解析文档的默认类型
	 *
 	 */
	 var $_mime = "text/html";

 	function __construct(&$doc) {
		$this->_doc =& $doc;
	}

	/**
	 * 渲染文档头部信息,返回一个字符串
	 *
	 */
	function render( $head = null, $params = array(), $content = null )
	{
		ob_start();

		echo $this->fetchHead($this->_doc);

		$contents = ob_get_contents();
		ob_end_clean();

		return $contents;
	}

	/**
	 * 取头部文件信息
	 */

	function fetchHead(&$document)
	{
		//行结束字符
		$lnEnd = "\n";
 
		$tagEnd	= ' />';

		$strHtml = '';

 
 		//$strHtml .= $tab.'<meta name="description" content="'.$document->getDescription().'" />'.$lnEnd;
 
		//$strHtml .= $tab.'<title>'.htmlspecialchars($document->getTitle()).'</title>'.$lnEnd;

 

		// 样式文件链接
		foreach ($document->_styleSheets as $strSrc => $strAttr )
		{
			$strHtml .= $tab . '<link rel="stylesheet" href="'.$strSrc.'" type="'.$strAttr['mime'].'"';
			if (!is_null($strAttr['media'])){
				$strHtml .= ' media="'.$strAttr['media'].'" ';
			}
	 
			$strHtml .= $tagEnd.$lnEnd;
		}

		// 样式文件声明
		foreach ($document->_style as $type => $content)
		{
			$strHtml .= $tab.'<style type="'.$type.'">'.$lnEnd;

			 
			$strHtml .= $tab.$tab.'<!--'.$lnEnd;
			$strHtml .= $content . $lnEnd;

			$strHtml .= $tab.$tab.'-->'.$lnEnd;
			$strHtml .= $tab.'</style>'.$lnEnd;
		}

		// 生成脚本链接
		foreach ($document->_scripts as $strSrc => $strType) {
			$strHtml .= $tab.'<script type="'.$strType.'" src="'.$strSrc.'"></script>'.$lnEnd;
		}

		// 脚本
		foreach ($document->_script as $type => $content)
		{
			$strHtml .= $tab.'<script type="'.$type.'">'.$lnEnd;

 
			$strHtml .= $content.$lnEnd;

 			$strHtml .= $tab.'</script>'.$lnEnd;
		}

 		return $strHtml;
	}

}

?>