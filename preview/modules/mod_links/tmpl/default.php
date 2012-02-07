<?php
	//这里是控制器，根据参数中， 显示方式的选择，进行加载不同的样式文件
	$style = intval($params['showway']);

	$style_file = $mod_path.DS.'tmpl'.DS.'style_'.$style.'.php';
	if( file_exists($style_file) )
	{
		include( $style_file );
	}
 ?>
