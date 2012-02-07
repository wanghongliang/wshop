<?php
import('application.component.view');
class ProductView extends View
{
 	var $rows;
	var $menuid;	//当前菜单分类ID
	var $depth = 0;
	function ProductView()
	{	
		$this->path = dirname(__FILE__);
		$this->menuid = intval( $_REQUEST['menuid'] );
		$this->baseuri = 'index.php?com=products&menuid='.$this->menuid;

		if( isset( $_REQUEST['tmpl'] ) ){ $this->baseuri.='&tmpl='.$_REQUEST['tmpl']; }
		if( isset( $_REQUEST['id'] ) ){ $this->baseuri.='&id='.$_REQUEST['id']; }
	}

	function display()
	{
	

		import('html.form');	//获取表单对象
  		//print_r($options);
 		//分类
		//$cat_ = Form::
		$type = $this->get('cat');
		
		$brands = $this->get('brand');
		//清除相关链的商品记录
		$this->get('deletelink');
		//print_r($type);
 		include($this->path.DS.'tmpl'.DS.'form.php');
	}


	/**
	 * 编辑界面
	 */
	function edit()
	{		
		import('html.form');	//获取表单对象
		//$accessories = $this->get('accessories');
		//$acctype = $this->get('acctype');
		$type = $this->get('cat');
		$brands = $this->get('brand');
		//取当前编辑的内容
		$item = $this->get('item');

		//查找当前的分类
		$product_type = $this->findType($item['catid'],$type);
 
		if( $_REQUEST['tmpl']  == 'component' ){
			//print_r($product_type);
  			include($this->path.DS.'tmpl'.DS.'form_component.php');
		}else{
			include($this->path.DS.'tmpl'.DS.'form.php');
		}
	}


	/** 从分类数组中查找当前商品所属分类 **/
	function findType($id,&$a){

		$d = array();
		if( is_array($a) ){
			foreach( $a as $v ){ 
				foreach( $v as $v2 ){
					if( $v2['id'] == $id ){
						return $v2;
					}
				}
			}
		}
		return $d;
	}


	/** 属性表单 **/
	function attrForm(&$row,$val,$price='',$img=''){
		echo Form::hidden('attr_id_list[]',$row['attr_id']);
		
		switch($row['attr_input_type']){
			case '2':	//多行文本框 
				echo Form::textarea('attr_value_list[]',$val,' cols=35 rows=5 ');
				break;
			case '1':	//列表
				$values = explode("\n",$row['attr_values']);
				$data=array(0=>'请选择..');
				foreach( $values  as $va ){
					$v  = explode(':',$va);
					$v = isset($v[1])?trim($v[1]):trim($v[0]);
					$data[$v] = $v;
				}
				echo Form::dropdown('attr_value_list[]',$data,$val);
				break;
			default:	//文本框
				echo Form::input('attr_value_list[]',$val,' size=30 ');
				break;
		}

		if(  $row['attr_type'] == '2' ){
			echo ' 属性价格 '.Form::input('attr_price_list[]',$price,' size=10 ');
			if( $row['attr_type'] == '2' ){
				echo '<input type="hidden" name="attr_img_list[]" value="'.$img.'" size=10 class="i_thumb" />';
				echo ' <input type="button" value="选择相关图片" onclick="selectRelated(this)" /><span class="a_thumb" >';
				if( $img != '' ){ echo '<img src="'.$img.'" width=50 height=50 />'; }
				echo '</span>';
			}
		}else{
			echo Form::hidden('attr_price_list[]',$price);
			//echo Form::hidden('attr_img_list[]',$img);
		}
	}
 
	function selectOption($v){
		$values = explode("\n",$v);
		$data=array(0=>'请选择..');
		foreach( $values  as $v ){
			$v = trim($v);
			$data[$v] = $v;
		}
		echo Form::dropdown('av_list[]',$data,$val);
	}

	/**
	 * 显示选择的组件
	 */
	function showSelectComponent()
	{
		$lists = $this->get('cominfo');
		//print_r($lists);
		//echo $this->path.DS.'tmpl'.DS.'selectcomponent.php';

		$linkType= $this->get('linkType');
		include($this->path.DS.'tmpl'.DS.'selectcomponent.php');
	}


	function selectproduct()
	{
		import('html.form');	//获取表单对象
		$lists = $this->get('selectList');
		$type = $this->get('cat');
		$this->rows = $lists['rows'];
		$nav = $this->get('nav');
		if( $_REQUEST['act'] == 'm'){ //一次选多个商品 
			include($this->path.DS.'tmpl'.DS.'selectmultilists.php');
		}else{
			include($this->path.DS.'tmpl'.DS.'selectlists.php');
		}
	}

	function selectmenu()
	{
		$_REQUEST['tmpl'] = 'component';
		include($this->path.DS.'tmpl'.DS.'selectmenu.php');
	}
	

	function ajaxattr(){
 		import('html.form');	//获取表单对象
				//取当前编辑的内容
		$item = $this->get('item');
		include($this->path.DS.'tmpl'.DS.'ajaxattr.php');
	}

}
?>