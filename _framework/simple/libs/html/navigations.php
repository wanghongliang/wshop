<?php

/**
 * 导航条类
 */
class Navigations
{
	var $currentPage; //当前是第几页
	var $totalFile;   //总记录数
	var $percent;     //每页有多少？

	var $totalPage=1;   //总页数

	var $records;//当前页是第几篇文章起始(构造sql);

	var $fileLink;

	var $prevPage;//上一页
	var $nextPage;//下一页
	var $uri = null;

	var $request = array();		//需要设定请求变量均放在这个数组中


	//参数是总文件数
    function Navigations($percent=20,$arg_num=0)
	{
		$this->percent=$percent;
		//算出文章页数的起始篇
		$this->setTotalPage($arg_num);
		$this->uri = &URI::getInstance();
 		//$this->request['com'] = $_REQUEST['com'];
	}


	function setRequest($arr)
	{
		if( is_array( $arr ) )
		{
			foreach( $arr as $v )
			{
				if( isset($_REQUEST[$v]) ){	//过滤一下，没有测试过
					$this->request[$v] = $_REQUEST[$v];
				}
			}
		}

		if( !isset($this->request['itemid']) )
		{
			if( class_exists("SiteApplication") ){
				$menus	= &SiteApplication::getMenu();
				$menu	= $menus->getActive();
				$this->request['itemid'] =  $menu['id'];
			}


		}

 
	}

	function getRequest($arr)
	{
		return $this->request+$arr;
	}


	function buildLink($page){
    		return  $this->uri->getByURL(array('page'=>$page)); 
	}
	//设定总页数---------参数是文件总数
	function setTotalPage($arg_num)
	{
		if($arg_num<1) $arg_num=0;
 		$this->totalFile=$arg_num;
 		if($this->totalFile%$this->percent==0)
		{
			$this->totalPage=floor($this->totalFile/$this->percent);
		}else
		{
			$this->totalPage=floor($this->totalFile/$this->percent)+1;
		}
	}

	function setPage( $arg_c )
	{
		if($arg_c<1) 
			$arg_c=1;
		$this->currentPage=$arg_c;
 	}
	function getRowNumber(){
		return $this->currentPage * $this->percent - $this->percent;
	}


	//返回构造sql-----------参数:当前
	function getLimit($arg_c=0)
    {		
		
		if( $arg-c >$this->totalPage){ $arg_c = $this->totalPage; }

		if($arg_c<1) 
			$arg_c=1;
		$this->currentPage=$arg_c;


		$this->records= $this->currentPage * $this->percent - $this->percent;
		//返回构造的sql
		return " limit ".$this->records." ,".$this->percent;
	}


	//返回值:总页数
	function getTotalPage()
	{
		return $this->totalPage;
	}

	//得到每页的记录数
	function getPercent()
	{
		return $this->percent;
	}
 

	function getCurrentPage(){
		$page=intval($_REQUEST('page'));
 		return $page;
	}

	function showFilePage($arg_c=1)
	{
		$router=Factory::getRouter();

		if( $arg-c >$this->totalPage){ $arg_c = $this->totalPage; }
		if($arg_c<1)
			$arg_c=1;

		if($this->currentPage<1){
			$this->currentPage=$arg_c;
		}
		//echo $this->currentPage;
		if(''==$this->fileLink) 
		{
			//$url='?'.preg_replace('|page=\d?|i','',$_SERVER['QUERY_STRING']).'&';
			//$url=str_replace('&&','&',$url);
			//$this->fileLink=$url;
		}


		
		//页面过大，就显示1 2 3 4 5
		if($this->totalFile>100) return $this->showFilePage2($arg_c);
		$m='<div align=center class=page >&nbsp;共&nbsp;'.$this->totalFile.' 条记录&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;每页&nbsp;'.$this->percent.' 条';
		if($this->currentPage<=1)
		{
			$m.=" 首 页 &nbsp;  上一页&nbsp;";
		}
		else
		{
			$m.="<a href='".$router->_($this->getRequest(array('page'=>'1')))."' > 首 页 </a>&nbsp;";
 
			$m.="<a href='".$router->_($this->getRequest(array('page'=>($this->currentPage-1))))."' >上一页</a>&nbsp;";
		 
		}

		if($this->currentPage>=$this->totalPage)
		{
			$m.="  下一页 &nbsp;&nbsp;页 尾&nbsp;";
		}else
		{
			$m.=" <a href='".$router->_($this->getRequest(array('page'=>($this->currentPage+1))))."' >下一页</a>&nbsp;&nbsp;";
			$m.=" <a href='".$router->_($this->getRequest(array('page'=>$this->totalPage)))."'>页 尾</a>";
		}
		$m.="&nbsp;&nbsp;&nbsp; 共 ".$this->currentPage." / ".$this->totalPage." 页";	

		$m.="&nbsp;&nbsp;&nbsp;第 &nbsp;<select name=p onchange=\"location.href=this.value\" >";
		for($i=1;$i<=$this->totalPage;$i++)
		{
			if($i==$this->currentPage)
				$selected='selected='.$i;
			else
				$selected='';
			
			
			$m.="<option value='".$router->_($this->request())."&page=".$i."' {$selected} >".$i."</option>";
			
		
		}
		$m.="</select>&nbsp;页</div>";
		return $m;
	}


	function showFilePage2($arg_c=1,$tool='',$css='')
	{
	 

		if( $arg_c >$this->totalPage){ $arg_c = $this->totalPage; }
		if($arg_c<1)
			$arg_c=1;

		
		$str='<div class="page '.$css.'" ><div  class="pl" >&nbsp;&nbsp;总记录<b>';
		$str.=($this->totalFile).'</b>条, 当前为'.$this->currentPage.'/'.$this->totalPage.'页, 每页'.$this->percent.'条';
		$str.='</div>';

		$start=ceil($this->currentPage-5);
		
		if($start<2) $start=1;
 
		//$start*=10;

		$end=$start+10;

		
		if($end>$this->totalPage){ $end=$this->totalPage;}
 		$str.=$tool.'<div class="pr" >';
		
 		//首页
		if($this->currentPage>1){
			$str.='<span class="page_num" ><a href="'.$this->buildLink(1).'" >首页</a></span>';
		}else{
			$str.='<span class="page_num_word" > 首页 </span>';
		}

		//上一页
		if($this->currentPage>$start){
			$str.='<span class="page_num" ><a href="'.$this->buildLink($this->currentPage-1).'" >上一页</a></span>';
		}else{
			$str.='<span class="page_num_word" >上一页</span>';
		}


		//数字页
		for($i=$start;$i<=$end;$i++){
			if($this->currentPage==$i){
				$str.='<span class="page_current" >'.($i).'</span>';
			}else{
				$str.='<span class="page_num" ><a href="'.$this->buildLink($i).'" >'.($i).'</a></span>';
			}
		}

		//下一页
		if($this->currentPage<$end){
			$str.='<span class="page_num" ><a href="'.$this->buildLink($this->currentPage+1).'" >下一页</a></span>';
		}else{
			$str.='<span class="page_num_word" >下一页</span>';
		}

		//最后一页
 		if($this->currentPage<$end){
			$str.='<span class="page_num" ><a href="'.$this->buildLink($this->totalPage).'" >最后一页</a></span>';
		}else{
			$str.='<span class="page_num_word" >最后一页</span>';
		}

		$str.='</span><div class="clr" ></div></div></div>';
 		//$str.='<style type="text/css">.page_number{float:left;width:10px;cursor:pointer;}</style>';
 		
		return $str;

	}
	
	
	function showFilePage3($arg_c=1,$tool='',$css='')
	{

		if( $arg-c >$this->totalPage){ $arg_c = $this->totalPage; }
		if($arg_c<1)
			$arg_c=1;

		$str='<div class="page '.$css.'" ><div style="float:left;">&nbsp;&nbsp;总记录<b>';
		$str.=($this->totalFile).'</b>条, 当前为'.$this->currentPage.'页, 每页'.$this->percent.'条';
		$str.='</div>';

		$start=floor($arg_c/10);
		
		if($start<2) $start=1; 
		$end=$start+10; 
		if($end>$this->totalPage){ $end=$this->totalPage;}
 
		$str.=$tool.'<div style="float:right;" >';
		$router=Factory::getRouter();

		
 		//首页
		if($this->currentPage>1){
			$str.='<div class="page_num_word" ><a href="'.$this->buildLink(array('page'=>1)).'" >首页</a></div>';
		}else{
			$str.='<div class="page_num_word" ><span >首页</span></div>';
		}

		//上一页
		if($this->currentPage>$start){
			$str.='<div class="page_num_word" ><a href="'.$this->buildLink(array('page'=>$this->currentPage-1)).'" >上一页</a></div>';
		}else{
			$str.='<div class="page_num_word" ><span >上一页</span></div>';
		}


		//数字页
		for($i=$start;$i<=$end;$i++){
			if($this->currentPage==$i){
				$str.='<div class="page_current" >'.($i).'</div>';
			}else{
				$str.='<a href="'.$this->buildLink(array('page'=>$i)).'" ><div class="page_num" >'.($i).'</div></a>';
			}
		}

		//下一页
		if($this->currentPage<$end){
			$str.='<div class="page_num_word" ><a href="'.$this->buildLink(array('page'=>$this->currentPage+1)).'" >下一页</a></div>';
		}else{
			$str.='<div class="page_num_word" >下一页</div>';
		}

		//最后一页
 		if($this->currentPage<$end){
			$str.='<div class="page_num_word" ><a href="'.$this->buildLink(array('page'=>$end)).'" >最后一页</a></div>';
		}else{
			$str.='<div class="page_num_word" >最后一页</div>';
		}

		$str.='</div><div class="clear" ></div></div>';
  		
		return $str;

	} 
}

?>