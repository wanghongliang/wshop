<?php
import('application.component.view');
class CouponView extends View
{
 	var $rows;
	var $baseuri;	//URI
	var $depth = 0;
	function CouponView()
	{
		$this->baseuri = 'index.php?com=coupon';
		$this->path = dirname(__FILE__);
	}

	function display()
	{
		import('html.form');	//获取表单对象
		$levels = $this->get('level');
 		include($this->path.DS.'tmpl'.DS.'form.php');
	}
 
	/** 添加 **/
	function edit()
	{
		$item = $this->get('item');
		import('html.form');	//获取表单对象
		$levels = $this->get('level');
			
		include($this->path.DS.'tmpl'.DS.'form.php');
	}


	//以AJAX方式加载属性列表
	function ajax(){
		$t = (int)$_GET['tid'];
		switch($t){
			case 1:
				$param_file='1.php';
				break;
			default:
				$param_file = $t.'.php';
				break;
		}

		$path = dirname(__FILE__).DS.'tmpl'.DS.'params'.DS.$param_file; 
		if( file_exists($path) ){
		include($path);
		}
	}

	function actOptions(){
		$data = array(
			0=>'请选择活动规则',
			1=>'购物车中商品总金额大于指定金额，赠送某个赠品',
			2=>'商品直接打折，如全场女鞋8折。可以对商品任意折扣，适合低价清货促销',
			3=>'购物车中商品总金额大于指定金额，免运费',
			5=>'购物车中商品总金额大于指定金额，客户就可得到指定的%off折扣',
			6=>'-购物车中商品总金额大于指定金额,就可立减某金额', 
		);
		return $data;
	}

}
?>