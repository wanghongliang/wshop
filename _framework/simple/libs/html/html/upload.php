<?php
 

class WHTMLUpload 
{
 	function image($name, $value,  $class='', $size= 30 ,$w=300  )
	{
 
        /*
         * Required to avoid a cycle of encoding &
         * html_entity_decode was used in place of htmlspecialchars_decode because
         * htmlspecialchars_decode is not compatible with PHP 4
         */
        //$value = htmlspecialchars(html_entity_decode($value, ENT_QUOTES), ENT_QUOTES);

		//$config = $app->getCfg('');

		//$config =& WFactory::getConfig();
		//print_r($config);
		

		$string ='<input type="text" name="'.$name.'" id="'.$name.'" value="'.$value.'" '.$class.' '.$size.' /><input type="button" onclick="$(\'#'.$name.'\').uploadImage();" value="上传" />';



		/**
		 * 上传图片配置信息
		 */
		$table =& WTable::getInstance('component');
 		$table->loadByOption( 'com_media' );
		$mediaparams = new WParameter( $table->params );

		//print_r($mediaparams);

		//图片文件
		$image_extensions = $mediaparams->get('image_extensions');
		
		//判断是否为图片文件
		if( strpos( $image_extensions , substr($value,-3) )!== false ) 
		{
			$string .= '<div ><img src="'.$value.'" width='.$w.' /></div>';
		}
		//echo $image_extensions;

		return $string;
	}
}