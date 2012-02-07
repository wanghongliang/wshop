<?php
 
class HTML
{
 
	function _( $type )
	{
		//Initialise variables
		$prefix = 'HTML';
		$file   = '';
		$func   = $type;

		// Check to see if we need to load a helper file
		$parts = explode('.', $type);

		/**
		if( strpos($type,'content')!==false )
		{
			exit($type);

		}


		**/
		switch(count($parts))
		{
			case 3 :
			{
				$prefix		= preg_replace( '#[^A-Z0-9_]#i', '', $parts[0] );
				$file		= preg_replace( '#[^A-Z0-9_]#i', '', $parts[1] );
				$func		= preg_replace( '#[^A-Z0-9_]#i', '', $parts[2] );
			} break;

			case 2 :
			{
				$file		= preg_replace( '#[^A-Z0-9_]#i', '', $parts[0] );
				$func		= preg_replace( '#[^A-Z0-9_]#i', '', $parts[1] );
			} break;
		}

		$className	= $prefix.ucfirst($file);
	

		if (!class_exists( $className ))
		{
			
			$path = dirname(__FILE__).DS.'html'.DS.strtolower($file).'.php';
			require $path;
			if (!class_exists( $className ))
			{
				Error::throwError(  $className.'::' .$func. ' not found in file.' );
				return false;
			}
		 
		}

		if (is_callable( array( $className, $func ) ))
		{
			$args = func_get_args();
			array_shift( $args );
			return call_user_func_array( array( $className, $func ), $args );
		}
		else
		{
			Error::throwError( 0, $className.'::'.$func.' not supported.' );
			return false;
		}
	}


	function getLT()
	{
		static $data;
		if( empty($data) ){
			$lt = Language::getLanguageType();
			unset($lt[1],$lt[2]);
			foreach( $lt as $k=>$v )
			{
				$lt[$k]='<img src="'.$v['img'].'" width=25 height=18 />';
			}
		}
		return $lt;
	}
 
}
