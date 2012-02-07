<?php
import( 'application.component.view');
require(dirname(PATH_COMPONENT).DS.'com_products'.DS.'helpers'.DS.'route.php');

class ProductView extends View
{

	var $params = null;


	function display($tpl = null)
	{
		global $app;
		
		//$this->params 	   =& $app->getParams('products');

		//print_r($params);

		//$this->prev = $this->get('prev');
		//$this->next = $this->get('next');
		$model = &$this->getModel();
 		$lists = $this->get('item');
		
		$this->item = $lists['row'];	//产品信息

		//检测是否有活动
		$act = $model->getAct( $this->item['id'] );
		
		$this->lists = &$lists;

		$document = &Factory::getDocument();
 		 
		$pathway = &$app->getPathWay();
		$pathway->addItem($this->item['name'],'#');


		//商品图片展示
		if( $_GET['a'] == 'v' ){ 
			//print_r($this->item);
			if( $this->item['metadesc'] )
			{
				$document->setDescription($this->item['metadesc'].',图片展示');

			}
			if( $this->item['metakey'] )
			{
				$document->setKeywords($this->item['metakey'].',图片展示');

			}
			if( !empty( $this->item['title'] ) ){
				$document->setTitle($this->item['title'].'-'.$GLOBALS['config']['title'].',图片展示');
			}else{
				$document->setTitle($this->item['name'].'-'.$GLOBALS['config']['title'].',图片展示');
			} 
			$tpl = 'v';
			include(dirname(__FILE__).DS.'tmpl'.DS.'default_v.php');
		}else{


			//print_r($this->item);
			if( $this->item['metadesc'] )
			{
				$document->setDescription($this->item['metadesc']);

			}
			if( $this->item['metakey'] )
			{
				$document->setKeywords($this->item['metakey']);

			}
			if( !empty( $this->item['title'] ) ){
				$document->setTitle($this->item['title'].'-'.$GLOBALS['config']['title']);
			}else{
				$document->setTitle($this->item['name'].'-'.$GLOBALS['config']['title']);
			}
	  
   			include(dirname(__FILE__).DS.'tmpl'.DS.'default.php');
		}
	}

	function ajax(){
		$model = &$this->getModel();
		switch($_GET['a']){
			case 'getcomment':
				$rows = $model->getComment();
				$this->nav = $rows['nav'];
				include(dirname(__FILE__).DS.'tmpl'.DS.'ajax_getcomment.php');
				break;
			case 'getadvisory':
				$rows = $model->getAdvisory();
				$this->nav = $rows['nav'];
				include(dirname(__FILE__).DS.'tmpl'.DS.'ajax_getadvisory.php');
				break;


			case 'useful':
				$model->useful();
				break;
			case 'useless':
				$model->useless();
				break;

			case 'advisory':
				if( $model->saveAdvisory() ){
					$rows = $model->getAdvisory(); 
 					$this->nav = $rows['nav'];
					include(dirname(__FILE__).DS.'tmpl'.DS.'ajax_getadvisory.php');
				} 
				break;

			default:
		}
	}

 
	function getPage(){
	
		//if( $query = $this->nav->uri->getQuery() ){
		//	parse_str($query,$output);
		//	unset($output['page']);
		//	if( count($output)>0 ){
		//		return $this->nav->showFilePage2();
		//	}
		//}
		
		/**
		if( strstr($this->nav->uri->current(),'?') !== false  ){

			echo $this->nav->uri->current(); exit;
			return $this->nav->showFilePage2();
		}
		**/


		//if( strlen($this->nav->uri->_initPath)<2 ){
		//	return $this->nav->showFilePage2();
		//}
		$arg_c  =  $this->nav->currentPage;

		if( arg_c >$this->nav->totalPage){ $arg_c = $this->nav->totalPage; }
		if($arg_c<1)
			$arg_c=1;

		
		$str='<div class="page '.$css.'" ><div  class="pl" >&nbsp;&nbsp;总记录<b>';
		$str.=($this->nav->totalFile).'</b>条, 当前为'.$this->nav->currentPage.'/'.$this->nav->totalPage.'页, 每页'.$this->nav->percent.'条';
		$str.='</div>';

		$start=ceil($this->nav->currentPage-5);
		
		if($start<2) $start=1;
 
		//$start*=10;

		$end=$start+10;

		
		if($end>$this->nav->totalPage){ $end=$this->nav->totalPage;}
 		$str.=$tool.'<div class="pr" >';
		
 		//首页
		if($this->nav->currentPage>1){
			$str.='<span class="page_num" ><a href="'.$this->buildLink(1).'" >首页</a></span>';
		}else{
			$str.='<span class="page_num_word" > 首页 </span>';
		}

		//上一页
		if($this->nav->currentPage>$start){
			$str.='<span class="page_num" ><a href="'.$this->buildLink($this->nav->currentPage-1).'" >上一页</a></span>';
		}else{
			$str.='<span class="page_num_word" >上一页</span>';
		}


		//数字页
		for($i=$start;$i<=$end;$i++){
			if($this->nav->currentPage==$i){
				$str.='<span class="page_current" >'.($i).'</span>';
			}else{
				$str.='<span class="page_num" ><a href="'.$this->buildLink($i).'" >'.($i).'</a></span>';
			}
		}

		//下一页
		if($this->nav->currentPage<$end){
			$str.='<span class="page_num" ><a href="'.$this->buildLink($this->nav->currentPage+1).'" >下一页</a></span>';
		}else{
			$str.='<span class="page_num_word" >下一页</span>';
		}

		//最后一页
 		if($this->nav->currentPage<$end){
			$str.='<span class="page_num" ><a href="'.$this->buildLink($this->nav->totalPage).'" >最后一页</a></span>';
		}else{
			$str.='<span class="page_num_word" >最后一页</span>';
		}

		$str.='</span><div class="clr" ></div></div></div>';
 		//$str.='<style type="text/css">.page_number{float:left;width:10px;cursor:pointer;}</style>';
 		
		return $str;
	}

	function buildLink($page){
		return "javascript:getPage(\'".$_GET['a']."\',".$page.")";
	}

}
?>
