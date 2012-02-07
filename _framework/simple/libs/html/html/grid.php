<?php
 

class HTMLGrid
{
	/**
	 * @param	string	链接标题
	 * @param	string	字符 如:c.title
	 * @param	string	当前的方向 asc desc 
	 * @param	string	当前 c.title
	 * @param	string	
	 */
	function sort( $title, $order, $direction = 'asc', $selected = 0, $task=NULL )
	{
		$direction	= strtolower( $direction );
		$images		= array( 'uparrow0.gif', 'downarrow0.gif' ,'uparrow.gif','downarrow.gif');
		//$index		= intval( $direction == 'desc' );
		//$direction2	= ($direction == 'desc') ? 'asc' : 'desc';

		$a_asc = '<a href="javascript:tableOrdering(\''.$order.'\',\'asc\',\''.$task.'\');" title="'.  '点击排序'  .'">';

		$a_desc = '<a href="javascript:tableOrdering(\''.$order.'\',\'desc\',\''.$task.'\');" title="'.  '点击排序'  .'">';
		$html .=  $title  ;
		
		//有一个亮
		if ($order == $selected ) {
			if( $direction == 'asc' ){
				//$html .= $a_asc.'<img src="templates/default/images/'.$images[2].'" ></a>';
				$html .= $a_desc.'<img src="templates/default/images/'.$images[2].'" ></a>';
			}else{
				$html .= $a_asc.'<img src="templates/default/images/'.$images[3].'" ></a>';
				//$html .= $a_desc.'<img src="templates/default/images/'.$images[3].'" ></a>';
			}
		}else{	//都不亮
				//$html .= $a_asc.'<img src="templates/default/images/'.$images[0].'" ></a>';
				$html .= $a_desc.'<img src="templates/default/images/'.$images[1].'" ></a>';
		}
 
		return $html;
	}

	



}
