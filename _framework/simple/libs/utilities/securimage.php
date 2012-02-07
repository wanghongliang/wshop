<?php
/**
 * 生成一个验证码类
 */
class Simge
{
	function check($input_name)
	{
		include(dirname(__FILE__).DS."securimage".DS."securimage.php");
		$img = new Securimage();
		$valid = $img->check($input_name);
		return $valid;
	}

	function show($w=0,$h=0,$font_size=0)
	{
		include(dirname(__FILE__).DS."securimage".DS."securimage.php");
		$img = new securimage();
		if( $w > 0 ){ $img->image_width = $w; }
		if( $h > 0 ){ $img->image_height = $h; }
		if( $font_size > 0 ){ $img->font_size = $font_size;}
		$img->show(); // alternate use:  $img->show('/path/to/background.jpg');
	}
}
?>