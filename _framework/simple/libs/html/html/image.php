<?php
 
 
class WHTMLImage
{
	/**
	* Checks to see if an image exists in the current templates image directory
 	* if it does it loads this image.  Otherwise the default image is loaded.
	* Also can be used in conjunction with the menulist param to create the chosen image
	* load the default or use no image
	*
	* @param	string	The file name, eg foobar.png
	* @param	string	The path to the image
	* @param	int		empty: use $file and $folder, -1: show no image, not-empty: use $altFile and $altFolder
	* @param	string	Another path.  Only used for the contact us form based on the value of the imagelist parm
	* @param	string	Alt text
	* @param	array	An associative array of attributes to add
	* @param	boolean	True (default) to display full tag, false to return just the path
	*/
	function site( $file, $folder='/images/M_images/', $altFile=NULL, $altFolder='/images/M_images/', $alt=NULL, $attribs = null, $asTag = 1)
	{
		static $paths;
		global $app;

		if (!$paths) {
			$paths = array();
		}

		if (is_array( $attribs )) {
			$attribs = WArrayHelper::toString( $attribs );
		}

		$cur_template = $app->getTemplate();

		if ( $altFile )
		{
			// $param allows for an alternative file to be used
			$src = $altFolder . $altFile;
		}
		else if ( $altFile == -1 )
		{
			// Comes from an image list param field with 'Do not use' selected
			return '';
		} else {
			$path = WPATH_SITE .'/templates/'. $cur_template .'/images/'. $file;
			if (!isset( $paths[$path] ))
			{
				if ( file_exists( WPATH_SITE .'/templates/'. $cur_template .'/images/'. $file ) ) {
					$paths[$path] = 'templates/'. $cur_template .'/images/'. $file;
				} else {
					// outputs only path to image
					$paths[$path] = $folder . $file;
				}
			}
			$src = $paths[$path];
		}
		
		//echo $src;
		if (substr($src, 0, 1 ) == "/") {
			$src = substr_replace($src, '', 0, 1);
		}

		// Prepend the base path
		$src = WURI::base(true).'/'.$src;
		
		$iPath = PATH_SITE .'/'.$src;

		if( file_exists( $iPath ) )
		{
			
		}else{
			return '<div class="noimg" >无图</div>';
		}
		// outputs actual html <img> tag
		if ($asTag) {
			return '<img src="'. $src .'" alt="'. html_entity_decode( $alt ) .'" '.$attribs.' />';
		}

		return $src;
	}

	/**
	* Checks to see if an image exists in the current templates image directory
	* if it does it loads this image.  Otherwise the default image is loaded.
	* Also can be used in conjunction with the menulist param to create the chosen image
	* load the default or use no image
	*
	* @param	string	The file name, eg foobar.png
	* @param	string	The path to the image
	* @param	int		empty: use $file and $folder, -1: show no image, not-empty: use $altFile and $altFolder
	* @param	string	Another path.  Only used for the contact us form based on the value of the imagelist parm
	* @param	string	Alt text
	* @param	array	An associative array of attributes to add
	* @param	boolean	True (default) to display full tag, false to return just the path
	*/
	function administrator( $file, $directory='/images/', $param=NULL, $param_directory='/images/', $alt = NULL, $attribs = null, $type = 1 )
	{
		global $app;

		if (is_array( $attribs )) {
			$attribs = WArrayHelper::toString( $attribs );
		}

		$cur_template = $app->getTemplate();

		// strip html
		$alt	= html_entity_decode( $alt );

		if ( $param ) {
			$image = $param_directory . $param;
		} else if ( $param == -1 ) {
			$image = '';
		} else {
			if ( file_exists( PATH_ADMINISTRATOR .'/templates/'. $cur_template .'/images/'. $file ) ) {
				$image = 'templates/'. $cur_template .'/images/'. $file;
			} else {
				// compability with previous versions
				if ( substr($directory, 0, 14 )== "/administrator" ) {
					$image = substr($directory,15) . $file;
				} else {
					$image = $directory . $file;
				}
			}
		}

		if (substr($image, 0, 1 ) == "/") {
			$image = substr_replace($image, '', 0, 1);
		}

		// Prepend the base path
		$image = WURI::base(true).'/'.$image;

		// outputs actual html <img> tag
		if ( $type ) {
			$image = '<img src="'. $image .'" alt="'. $alt .'" '.$attribs.' />';
		}

		return $image;
	}
}