<?php
import( 'application.component.view');
require(dirname(PATH_COMPONENT).DS.'com_website'.DS.'helpers'.DS.'route.php');

class DirectoryView extends View
{
	var $nav = null;
	function display($tpl = null)
	{
		global $app;
		$GLOBALS['body_id'] = 'cate';
		$_REQUEST['tmpl']='home-list';
   		$this->lists = $this->get('list');
		$this->nav = $this->lists['nav'];
		include(dirname(__FILE__).DS.'tmpl'.DS.'default.php');
	}
 
	function showFilePage2(){

		if( ROUTER_MODE <3 ){
			return $this->nav->showFilePage2();
		}else if( $query = $this->nav->uri->getQuery() ){
			parse_str($query,$output);
			unset($output['page']);
			if( count($output)>0 ){
				return $this->nav->showFilePage2();
			}
		}
		
		/**
		if( strstr($this->nav->uri->current(),'?') !== false  ){

			echo $this->nav->uri->current(); exit;
			return $this->nav->showFilePage2();
		}
		**/


		//if( strlen($this->nav->uri->_initPath)<2 ){
		//	return $this->nav->showFilePage2();
		//}
		if( $arg-c >$this->nav->totalPage){ $arg_c = $this->nav->totalPage; }
		if($arg_c<1)
			$arg_c=1;

		
		$str='<div class="page '.$css.'" ><div style="float:left;">&nbsp;&nbsp;总记录<b>';
		$str.=($this->nav->totalFile).'</b>条, 当前为'.$this->nav->currentPage.'页, 每页'.$this->nav->percent.'条';
		$str.='</div>';

		$start=ceil($this->nav->currentPage-5);
		
		if($start<2) $start=1;
 
		//$start*=10;

		$end=$start+10;

		
		if($end>$this->nav->totalPage){ $end=$this->nav->totalPage;}
 		$str.=$tool.'<div style="float:right;" >';
		
 		//首页
		if($this->nav->currentPage>1){
			$str.='<div class="page_num_word" ><a href="'.$this->buildLink(1).'" >首页</a></div>';
		}else{
			$str.='<div class="page_num_word" ><span >首页</span></div>';
		}

		//上一页
		if($this->nav->currentPage>$start){
			$str.='<div class="page_num_word" ><a href="'.$this->buildLink($this->nav->currentPage-1).'" >上一页</a></div>';
		}else{
			$str.='<div class="page_num_word" ><span >上一页</span></div>';
		}


		//数字页
		for($i=$start;$i<=$end;$i++){
			if($this->nav->currentPage==$i){
				$str.='<div class="page_current" >'.($i).'</div>';
			}else{
				$str.='<a href="'.$this->buildLink($i).'" ><div class="page_num" >'.($i).'</div></a>';
			}
		}

		//下一页
		if($this->nav->currentPage<$end){
			$str.='<div class="page_num_word" ><a href="'.$this->buildLink($this->nav->currentPage+1).'" >下一页</a></div>';
		}else{
			$str.='<div class="page_num_word" >下一页</div>';
		}

		//最后一页
 		if($this->nav->currentPage<$end){
			$str.='<div class="page_num_word" ><a href="'.$this->buildLink($this->nav->totalPage).'" >最后一页</a></div>';
		}else{
			$str.='<div class="page_num_word" >最后一页</div>';
		}

		$str.='</div><div class="clear" ></div></div>';
 		//$str.='<style type="text/css">.page_number{float:left;width:10px;cursor:pointer;}</style>';
 		
		return $str;
	}

	function buildLink($page){
		static $path;
		if( empty($path) ){
			if( strlen($this->nav->uri->_initPath)<2 ||  $this->nav->uri->_initPath == '/index.php' ){
				$path = 'list';
			}else{
				$path = substr($this->nav->uri->_initPath,11,-5);
			}
		}

 		if( $page == 1 ){
			if( $path == 'websites' ){
				return '/';
			}else{
				return $path.'.html';
			}
		}else{
			return $path.'_'.$page.'.html';
		}
	}
}
?>