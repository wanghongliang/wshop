<?php
/**
* @ �汾		$Id: head.php 2009-6-26
* @ ����		�ĵ��࣬������ָ�ʽ���ĵ�
* @ ��		libraries.core.documet.html.reader
* @ �Ŷ�        �Ŷ�One��
* @ copyright   Copyright (c) 2006-2009 TuanduiOne Inc. All rights reserved {@link http://www.TuanduiOne.com}
* @ ����        ������
* @ E-mail      tuanduione@yahoo.cn
* @ ��֤		����ҵ�����֤,��ϸ��鿴��Ŀ¼�� LICENSE.txt
* @ ��ע������ܻ����Ŷ�Э������
*/
 

class DocumentRenderHead 
{
	/**
	* �ĵ����������
	*/
	var	$_doc = null;

	/**
	 * �����ĵ���Ĭ������
	 *
 	 */
	 var $_mime = "text/html";

 	function __construct(&$doc) {
		$this->_doc =& $doc;
	}

	/**
	 * ��Ⱦ�ĵ�ͷ����Ϣ,����һ���ַ���
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
	 * ȡͷ���ļ���Ϣ
	 */

	function fetchHead(&$document)
	{
		//�н����ַ�
		$lnEnd = "\n";
 
		$tagEnd	= ' />';

		$strHtml = '';

 
 		//$strHtml .= $tab.'<meta name="description" content="'.$document->getDescription().'" />'.$lnEnd;
 
		//$strHtml .= $tab.'<title>'.htmlspecialchars($document->getTitle()).'</title>'.$lnEnd;

 

		// ��ʽ�ļ�����
		foreach ($document->_styleSheets as $strSrc => $strAttr )
		{
			$strHtml .= $tab . '<link rel="stylesheet" href="'.$strSrc.'" type="'.$strAttr['mime'].'"';
			if (!is_null($strAttr['media'])){
				$strHtml .= ' media="'.$strAttr['media'].'" ';
			}
	 
			$strHtml .= $tagEnd.$lnEnd;
		}

		// ��ʽ�ļ�����
		foreach ($document->_style as $type => $content)
		{
			$strHtml .= $tab.'<style type="'.$type.'">'.$lnEnd;

			 
			$strHtml .= $tab.$tab.'<!--'.$lnEnd;
			$strHtml .= $content . $lnEnd;

			$strHtml .= $tab.$tab.'-->'.$lnEnd;
			$strHtml .= $tab.'</style>'.$lnEnd;
		}

		// ���ɽű�����
		foreach ($document->_scripts as $strSrc => $strType) {
			$strHtml .= $tab.'<script type="'.$strType.'" src="'.$strSrc.'"></script>'.$lnEnd;
		}

		// �ű�
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