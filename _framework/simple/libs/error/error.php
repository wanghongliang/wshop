<?php

/** 
 * 错信息
 */
class Error
{
	function throwError($msg,$type=null)
	{	
		//header("Content-type:text/html;charset=utf-8"); 
		static $tag;
		global $app;	//应用
		if( isset($tag) ){
			exit($msg.Error::getBacktrace());
		}else{
			$tag = true;
		}
		//exit($msg.Error::getBacktrace());
		if( is_object( $app ) ){
			//模板文件
			$_REQUEST['tmpl'] = 'error';
			$GLOBALS['config']['template'] = 'system';	//改变模板
		
			 
			$app->enqueueMessage($msg,$type);
			if ( function_exists( 'debug_backtrace' ))
			{
				$backtrace = debug_backtrace();

				$app->enqueueMessage($backtrace);
			}
		}else{
 			exit($msg.Error::getBacktrace());
		}
	}

	function getBacktrace()
	{
		$str = '';
		/*
       * 引用其它错误信息报告
       */
        if ( function_exists( 'debug_backtrace' ))
		{
			$backtrace = debug_backtrace();
            $str .='<div style="font-family:Arail;" >错误信息:';
           //print_r($backtrace);
			for( $i = count( $backtrace ) - 1; $i >= 0; --$i )
			{
				
                $str .='<br><br>';
				if (isset( $backtrace[$i]['file'] )) {
					$str .='<div style="color:blue;" >File :'.$backtrace[$i]['file'].'</div>';
				}
				if (isset( $backtrace[$i]['line'] )) {
					$str .='<div style="color:red;" >Line :'.$backtrace[$i]['line'].'</div>';
				}
				if (isset( $backtrace[$i]['class'] )) {
					$str .='<div>Class :'. $backtrace[$i]['class'].'</div>';
				}
                /*
                if (isset( $backtrace[$i]['object'] )) {
					$str .='<br>Object :',$backtrace[$i][5];
                    $backtrace[$i]['object']->toString();
				}

                */
				if (isset( $backtrace[$i]['function'] )) {
					$str .='<div>Function :'. $backtrace[$i]['function'].'</div>';
				}
				if (isset( $backtrace[$i]['type'] )) {
					$str .='<div>Type :'. $backtrace[$i]['type'].'</div>';
				}

				
				if (isset( $backtrace[$i]['args'] )) {
					$str .='<div>Args :'. print_r($backtrace[$i]['args']).'</div>';
				}
				
			}
            $str .='</div>';
		}
        $str .='<br/><br/>';

		return $str;
	}
}
?>