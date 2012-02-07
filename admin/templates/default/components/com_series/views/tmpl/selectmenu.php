<?php 
import('html.form');	//获取表单对象
$type = $this->get('cat');

 $data_type = array(0=>'请选择...');
$data_type = Form::_buildTreeOptions($type,0,0,0,$data_type);

 //print_r($data);
?> 

 <div class="db-padding10 db-align-center" > 
  <div class="prompt" > 
  商品移动到其它分类后，相应的属性和规格将会删除. 
 </div> 
  <b>
  请选择以下分类:
  </b>
 
	<?php
		//echo HTML::_('menu.selectoptions',$_REQUEST['com'],0,' class="selectmenu" ');
		echo Form::dropdown('catid',$data_type,0,' class="selectmenu" size=20 ');
	?>
 </div>