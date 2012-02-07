<?php
 
$session= &Factory::getSession();
//省市分类
$province = $this->get('province');
?>

<div style="padding:2px 10px; " >


 

<ul class="com_ com_contents">
	<li class="active_li"  style="height:30px;" >
	添加经销商信息
	</li>
</ul>
  
<form action="<?php echo $this->baseuri;?>"  method="post"  id="menage_form"  > 

<table class="formtable" >  
<tr >
	<td class="form_text" >请选择所在区域</td>
	<td>
	<?php
	//print_r($province);
	?>
	<select id="chinacomprovince"  class="inputh input_require" name="province" onchange="setCity(this.value,'chinacomcity');" >
	<option value="">--请选择省份--</option>
	<?php

	$cCity = array();
	foreach( $province as $p ){	
		
		if( $_REQUEST['province']>0 && $_REQUEST['province'] == $p['parent_id'] ){
			$cCity[] = $p;
		}
		if( $p['parent_id']>1 ){ continue;}
		?>
		<option value="<?php echo $p['id'];?>"
		
		<?php
		if( $p['id'] == $_REQUEST['province'] ) echo ' selected ';	

	
		?>
		><?php echo $p['name'];?></option>
		<?php
	}
	?>
	</select>
	

	<?php
	//print_r($cCity);
	?>
	<select  name="city" class="inputh" id="chinacomcity">
		
		<option value="">请选择城市</option>
		<?php 
		if( count($cCity) > 0 ){
			foreach( $cCity as $c ){
			?>
			<option value="<?php echo $c['id'];?>"
			
			<?php
			if( $c['id'] == $_REQUEST['city'] ) echo ' selected ';	

		
			?>
			><?php echo $c['name'];?></option>
			<?php
			}
		}
		?>
	</select>

	<div class="help" >
		选择区域后，可管理该区域的网站.
	</div>
	</td>
</tr> 


<tr >
	<td class="form_text" >账号:</td>
	<td>
		<input type="text" name="username" size=30 value="<?php echo $_REQUEST['username'];?>"  onblur="checkUN(this.value)" />
		&nbsp;<span class="uname_pr" > </span>
		<div class="help" >
		用户名是由 6-20 个字符或数字组成,请重新填写.
		</div>
	</td>
</tr>
<tr  >
	<td class="form_text" >密码:</td>
	<td>
		<input type="password"  name="password" size=30 value="" />	
		<div class="help" >
		这里虽然不要求密码长度，但最好在6位数以上.
		</div>
	</td>
</tr>
 <tr  >
	<td class="form_text" >再次输入密码:</td>
	<td>
		<input type="password"   name="repassword" size=30 value="" />

	</td>
</tr>

<tr  >
	<td class="form_text" >E-mail:</td>
	<td>
		<input type="text" id="email"  name="email" size=30 value="<?php echo $_REQUEST['email'];?>" />
		<div class="help" >
		邮箱格式必需填写正码.
		</div>

	</td>
</tr>

<tr   >
	<td class="form_text" >是否锁定</td>
	<td>
		<input type="radio" id="block"  name="block"  value="1" <?php echo $_REQUEST['block']==1?'checked':''; ?> /> 锁定

		<input type="radio" id="block"  name="block"  value="0" <?php echo $_REQUEST['block']==0?'checked':''; ?> /> 打开
	</td>
</tr> 


</table>


<ul class="com_ com_contents" style="margin-top:10px;"  >
	<li class="active_li"  style="height:30px;" >
	联系方式
	</li>
</ul>
 
<table class="formtable"   > 
 

<tr >
	<td class="form_text" >联系人</td>
	<td>
		<input type="text" id="model"  class="ftext" name="contact_name" size=30 value="<?php echo $_REQUEST['contact_name'];?>" />

	</td>
</tr>

<tr >
	<td class="form_text" >性 别</td>
	<td>
		<input type="radio" name="sex" value="1" <?php echo $_REQUEST['sex']==1?'checked':'';?> />男

		<input type="radio" name="sex" value="2"  <?php echo $_REQUEST['sex']==2?'checked':'';?> />女

		<input type="radio" name="sex" value="0"  <?php echo $_REQUEST['sex']==0?'checked':'';?>  />保密
	</td>
</tr>

 
 
<tr >
	<td class="form_text" > 个人介绍</td>
	<td>
		 <textarea cols=60 rows=6 name=intro ><?php echo $_REQUEST['intro'];?></textarea>
	</td>
</tr>
 



<tr >
	<td class="form_text" >手机号码</td>
	<td>
		<input type="text" id="brand"  class="ftext" name="mobile" size=30 value="<?php echo $_REQUEST['mobile'];?>" />

	</td>
</tr>

<tr >
	<td class="form_text" >固定电话</td>
	<td>
		<input type="text" id="model"  class="ftext" name="phone" size=30 value="<?php echo $_REQUEST['phone'];?>" />

	</td>
</tr>
<tr >
	<td class="form_text" >通信地址</td>
	<td>
		<input type="text" id="brand"  class="ftext" name="address" size=50 value="<?php echo $_REQUEST['address'];?>" />

	</td>
</tr>
<tr >
	<td class="form_text" >邮　编</td>
	<td>
		<input type="text" id="brand"  class="ftext" name="zip" size=30 value="<?php echo $_REQUEST['zip'];?>" />

	</td>
</tr>
</table>
 <ul class="com_ com_contents" style="margin-top:10px;"  >
	<li class="active_li"  style="height:30px;" >
	公司信息
	</li>
</ul>
 
<table class="formtable"  >  

	<tr  >
		<td class="form_text " >公司名称</td>
		<td >
			<input type="text" class="ftext"  name="c_name" size=50 value="<?php echo $_REQUEST['c_name'];?>" />
		</td>
	</tr>


	<tr  >
		<td class="form_text" >联系人</td>
		<td>
			<input type="text"   class="ftext"  name="c_contact_name" size=50 value="<?php echo $_REQUEST['c_contact_name'];?>" />
		</td>
	</tr>


	<tr   >
		<td class="form_text" >联系人职位</td>
		<td>
			<input type="text"  class="ftext"   name="c_contact_jobs" size=50 value="<?php echo $_REQUEST['c_contact_jobs'];?>" />
		</td>
	</tr>


	<tr  >
		<td class="form_text" >联系电话</td>
		<td>
			<input type="text" class="ftext"   name="c_phone" size=50 value="<?php echo $_REQUEST['c_phone'];?>" />
		</td>
	</tr>

	
	<tr  >
		<td class="form_text" >传真</td>
		<td>
			<input type="text" lass="ftext"  name="c_fax" size=50 value="<?php echo $_REQUEST['c_fax'];?>" />
		</td>
	</tr>
	<tr  >
		<td class="form_text" >公司地址</td>
		<td>
			<input type="text" class="ftext"  name="c_address" size=50 value="<?php echo $_REQUEST['c_address'];?>" />
		</td>
	</tr>
	<tr  >
		<td class="form_text" >公司网址</td>
		<td>
			<input type="text" class="ftext" name="c_http" size=50 value="<?php echo $_REQUEST['c_http'];?>" />
		</td>
	</tr>
	


</table>
 

	<div class="formbtn" >
				<input type="button"   value="提交"  class="submit_btn" />
 				<input type="button"   class="cancel_btn"  value="取消" />
				<input type="hidden" value="<?php echo $_REQUEST['module'];?>" name="module" id="module" />

				<input type="hidden" value="save" name="task" id="task" />
				<input type="hidden" value="<?php echo $_REQUEST['id'];?>" name="id" />
				<input type="hidden" value="<?php echo $this->menuid;?>" name="menuid" />
				<input type="hidden" value="" name="return" id="return"  />
	</div>
</form>

</div>


<script language="javascript" >
	var url_current ='<?php echo URI::current();?>';
 

 	$(function(){ 
		$('.submit_btn').click(function(){	
			
			if( check() ){
				$('#menage_form').get(0).submit();
			}
			
		}); 
		$('.apply_btn').click(function(){	
			if( check() ){
			$('#return').attr('value',url_current);
			$('#menage_form').get(0).submit();
			}
		});
		$('.cancel_btn').click(function(){
			location.href='<?php echo $this->baseuri;?>';
		});
	});
	
	function check(){
		if( $('input[name=username]').val().length<6 ){
			alert('账号的字符长度在6位数以上.');
			return false;
		}
		if( $('input[name=password]').val() != $('input[name=repassword]').val() ){
			alert(' 两次密码输入不一致! ');
			return false;
		}

		return true;

	}


	//市的数组
	var area=[
	<?php
		$n = count($province)-1;
		foreach( $province as $k=>$v ){
			if( $v['parent_id']>1){
				echo '['.$v['id'].',"'.$v['name'].'",'.$v['parent_id'].']';
				if( $k<$n ){ 
					echo ',';
				}
			}
		}
	?>
	];

	function setCity(id,idname)
	{
		var n=area.length;
		var select = $('#'+idname).get(0);
		select.length=0;
		var x=0;
		for(i=0;i<n;i++){
			if( area[i] ){
				if( area[i][2] == id ){
					select.options[x++]=new Option(area[i][1],area[i][0]);
				}
			}
		}

		//alert(x);
		if( x==0 ){
			$(select).hide();
		}else{
			$(select).show();
		}
	}

	//检查是否已注册
	function checkUN(v){
		if( v.length>5 ){
			var uri = 'index.php?com=dealer&task=ajax&act=checkname&no_html=1&name='+v;
			
			$.get(uri,function(data){
				if( $.trim(data) == '1' ){
					$('.uname_pr').html('OK');
				}else{
					$('.uname_pr').html('该用户名已存在.');
				}
			});
		}else{
			$('.uname_pr').html('小于6位字符.');
		}
	}

</script>