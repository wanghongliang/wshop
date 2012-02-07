<?php
global $app;
include($app->getMemberOptionPath());

?>
 
<div class="regheader" >
	<div class="topnav" >
		<div class="" >
			<a href="/" >首页</a>
			<a href="/index.php?com=users&view=login" >登陆</a>
			<a href="#" >帮助中心</a>
		</div>

		<div class="" >
		如遇注册问题请拨打，<span class="sm">0755-27803441</span>
		</div>
	</div>

	<?php
	$module =& ModuleHelper::getModule('mod_logo');
    echo ModuleHelper::renderModule($module);
 	?>
	 <div class="login_title" >
		 免费注册  	
	 </div>
</div>
<div class="clr" ></div>

<div class="stepTop">
	<a href="/" >首页</a>
	>
	<a href="/index.php?com=users&view=user&layout=registor" >用户注册</a>
	>
	<a href="/index.php?com=users&view=user&layout=registor" >基本信息</a>
	>
	<a href="" >公司信息</a>
	>
	<a href="" >邮箱激活</a>
	>
	<a href="" >注册成功</a>

</div>
<?php

//错误提示消息
$msg = $app->getMsg();
if( $msg )
{
  echo $msg;
}
?>


<div class="stepTip"><span class="asterisk">*</span>必填项</div>
<form enctype="multipart/form-data" action="/index.php?com=users&task=registor" method="post" name="form1"  onsubmit="return validateForm();"  >
		<div class="stepborderTop3"></div>
		<div class="stepborderTop2"></div>
			<div class="stepborder">
			<h4>公司基本信息 </h4>		
	    <div class="hr" ></div>
							<table cellspacing="0" cellpadding="0" border="0" class="stepMain">
								<tbody><tr>
									<th class="fieldtitle r"><span class="asterisk">*</span>公司名称</th>
									<td class="fieldinfo">
										<input type="text" maxlength="80" size="60" value="" class="reg_input_text3 input_require" name="company_name">
										<span class="info"></span>
 								  </td>
								</tr>
								<tr>
									<th class="fieldtitle r">
										<span class="asterisk">*</span>国家/地区
									</th>
									<td class="fieldinfo">
										<select disabled="" class="inputh"  name="country">
											<option selected="" value="China">中国</option>
										</select>
										<span class="info"></span>
									</td>
									<input type="hidden" value="China" name="area">
								</tr>
 
								
								<tr id="chinaaddress1" class="ftabv">
									<th class="fieldtitle r"><span class="asterisk">*</span>省份/城市</th>
									<td class="fieldinfo">
										<?php
										//print_r($province);
										?>
										<select id="chinacomprovince"  class="inputh input_require" name="province" onchange="setCity(this.value,'chinacomcity');" >
										<option value="">--请选择省份--</option>
										<?php
 										foreach( $province as $p ){
											if( $p['parent_id']>1 ){ continue;}
											?>
											<option value="<?php echo $p['id'];?>" ><?php echo $p['name'];?></option>
											<?php
										}
										?>
										</select>

										<select   name="city" class="inputh" id="chinacomcity">
											<option value="">请选择城市</option>
										</select>
										<span class="info">
										</span>
									</td>
								</tr>

								<tr id="chinaaddress2" class="ftabv">
									<th class="fieldtitle r"><span class="asterisk">*</span>公司地址</th>
									<td class="fieldinfo">
									<input type="text" maxlength="80" size="60" value="" class="reg_input_text3 input_require" name="address"  >
									<span class="info"></span>
									</td>

								</tr>
								

								<tr>
									<th class="fieldtitle r">邮编</th>
									<td class="fieldinfo">
									<input type="text" maxlength="50" value="" name="zip" class="reg_input_text" >
									<span class="info"></span>
									</td>
								</tr>



								<tr>
									<th class="fieldtitle r">
										<span class="asterisk">*</span>联系电话
									</th>
									<td class="fieldinfo">
										<table cellspacing="0" cellpadding="0" border="0" class="stepIn">
											<tbody>
											<tr align="center" style="background:#ddd" >
												<td>国家代码</td>
												<td id="areacodetd">区号</td>
												<td>号码</td>
											</tr>
											<tr>
												<td>
													<input maxlength="40" value="86" size="10" name="telcountrycode" class="reg_input_text2 input_require" id="telcountrycode">
												</td>
												<td id="areacodetd1">
													<input maxlength="40" value="" size="10" name="telareacode" class="reg_input_text2 input_require" id="telareacode">
												</td>
												<td>
													<input maxlength="40" value="" size="15" class="reg_input_text input_require" name="phone">
												</td>
											</tr>
										</tbody>
										</table>
										<span class="info"></span>
									</td>
								</tr>


								<tr>
									<th class="fieldtitle r">传真</th>
									<td class="fieldinfo">
										<table cellspacing="0" cellpadding="0" border="0" class="stepIn">
											<tbody><tr>
												<td><input maxlength="40" value="86" size="10" class="reg_input_text2 input_require" name="faxcountrycode" id="faxcountrycode"></td>
												<td id="areacodetd2">
												<input maxlength="40" value="" size="10" class="reg_input_text2 input_require" name="faxareacode" id="faxareacode">
												</td>
												<td><input maxlength="40" value="" size="15" class="reg_input_text input_require" name="fax"></td>
											</tr>
										</tbody>
										</table>
										<span class="info"></span>
									</td>
								</tr>


								<tr>
									<th class="fieldtitle r">公司网站</th>
									<td class="fieldinfo">
									<input type="text" maxlength="160" size="60" value="http://" class="reg_input_text3" name="http">
									<span class="info"></span>
									</td>
								</tr>
							</tbody>
							</table>


 							<h4>公司业务信息</h4>
							<div class="hr" ></div>
							<table cellspacing="0" cellpadding="0" border="0" class="stepMain">
								<tbody>
								<tr>
									<th class="fieldtitle r">
									<span class="asterisk">*</span>公司类型 
									</th>
									<td class="fieldinfo">
										<?php
										foreach( $company_type as $k=> $type ){
											?>
											<input type="checkbox" value="<?php echo $k;?>" name="company_type[]">  <?php echo $type;?>
											<?
										}
										?>
										<span class="info"></span>
									</td>
								</tr>
								<tr>
									<th class="fieldtitle r"><span class="asterisk">*</span>主营行业<br>
 										<td class="fieldinfo">
 										<select name="catid"  class="input_require" >
 											<?php
											settype($this->category,'array');
											$percent = ceil(count($this->category)/4);
											$i=0;
											foreach( $this->category as $cat )
											{
												?>
												<option value="<?php echo $cat['id'];?>" ><?php echo $cat['name'];?></option>
  												<?php
 
											}
											?>
 											<li>
 										</select>
 										<span class="info"  ></span>
										</td>
								</tr>

								<tr>
									<th class="fieldtitle r"><span class="asterisk">*</span>公司关键词</th>
									<td class="fieldinfo">
										<input type="text" maxlength="80" size="60" value=""  class="reg_input_text3 input_require" name="keywords">
										<span class="info"></span>

										<br>
										<span class="remark red">- 请输入3－5个主营产品作为公司的关键词
										<br>
										- 多个关键词由逗号分隔开，例如：关键词一，关键词二，关键词三。 </span>
									
									</td>
								</tr>


								<tr>
									<th class="fieldtitle r"><span class="asterisk">*</span>公司描述</th>
									<td class="fieldinfo">
										<span class="fr"> 
										<textarea  rows="10" cols="80" name="intro" id="intro" class="input_require"  ></textarea>
										<br>
										<span class="info"></span>
									
										<div class="remark">- 我们建议您填写详细的公司介绍，例如历史、业绩、经营范围、发展前景等。<br>
											- 不支持HTML语言。<br>
										<span class="red">- 内容请控制在50-2000个字符内。</span></div></td>
								</tr>


								<tr>
									<th class="fieldtitle r">员工人数</th>
									<td class="fieldinfo">
										<select size="1" name="employees_number" class="inputh " >
										<?php
										foreach( $employees as $k => $em ){
											?>
											<option value="<?php echo $k;?>"><?php echo $em;?></option>
											<?
										}
										?>
										</select>
										<span class="info"></span>
									</td>
								</tr>


								<tr>
									<th class="fieldtitle r">营业额</th>
									<td class="fieldinfo">
										<select size="1" name="turnover" class="inputh" >
										<?php
										foreach( $turnover as $k => $em ){
											?>
											<option value="<?php echo $k;?>"><?php echo $em;?></option>
											<?
										}
										?>
										</select>
 										百万美元
										<span class="info"></span>
									</td>
								</tr>

								<tr>
									<th class="fieldtitle r">公司图标</th>
									<td class="fieldinfo">
										<input type="file" class="reg_input_text"  name="logo">
										<span class="info"></span>
										<br>
										<span class="remark">图片的格式和大小限制：<br>
											- jpg, jpeg或gif格 式均可，图片不超过100k。
										</span>

									</td>
								</tr>


								<tr>
									<th class="fieldtitle r">商标</th>
									<td class="fieldinfo">
									<input type="text" maxlength="80" value="" class="reg_input_text" name="trademark">
									<span class="info"></span>
									</td>
								</tr>
							</tbody></table>

 						<h4>公司联系信息</h4>
	    <div class="hr" ></div>
							<table cellspacing="0" cellpadding="0" border="0" class="stepMain">
								<tbody><tr>
									<th class="fieldtitle r">
										<span class="asterisk">*</span>联系人姓名
									</th>
									<td class="fieldinfo">
										<input type="text" maxlength="25" size="20" value="<?php echo $_POST['firstname'];?>" class="reg_input_text input_require" name="contact_name">
										<select name="contact_sex" class="inputh" >
											<option  <?php if( $_POST['sex'] == '1' ){ echo ' selected="selected" '; }?> value="1">先生</option>
											<option value="0"  <?php if( $_POST['sex'] != '1' ){ echo ' selected="selected" ';} ?> >女士</option>
										</select>
										<span class="info"></span>
									</td>
								</tr>
								<tr>
									<th class="fieldtitle r">
										<span class="asterisk">*</span>电子邮箱
									</th>
									<td class="fieldinfo en">
										<?php echo $_POST['email'];?>
									</td>
								</tr>
 
								<tr>
									<th class="fieldtitle r">所属部门</th>
									<td class="fieldinfo">
										<input type="text" maxlength="25" size="40" value=""  class="reg_input_text" name="contact_department">
										<span class="info"></span>
									</td>
								</tr>
								<tr>
									<th class="fieldtitle r">职务</th>
									<td class="fieldinfo">
										<input type="text" maxlength="25" size="40" value="" class="reg_input_text" name="contact_post">
										<span class="info"></span>
									</td>
								</tr>
								<tr>
									<th class="fieldtitle r">移动电话</th>
									<td class="fieldinfo">
										国家代码 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;移动电话号码<br>
										<input type="text" maxlength="40" value="86" size="10" class="reg_input_text2" name="mobilecountrycode"><input type="text" maxlength="50" size="40" value="" class="reg_input_text" name="mobile">
										<span class="info"></span>
									</td>
								</tr>
							</tbody></table>
		  </div>

		  <div class="stepborderBottom2"></div>
		  <div class="stepborderBottom3"></div>
		  <div class="stepEnd">会员资料一经提交，即表示您同意我们的<a target="_blank" href="/help/terms/">用户协议</a>并且已经阅读和理解了我们的<a target="_blank" href="/help/policy/">隐私策略</a>。</div>
		  <div class="stepSubmit">
		  
		 <?php 
		 foreach( $_POST as $k => $v ){
			?>
			<input type="hidden" name="<?php echo $k;?>" value="<?php echo $v;?>" />
			<?php
		 }?>
		
		<input type="Submit" value="下一步">
							
						
		  </div>
	</form>
<style type="text/css" >
 
</style>

<script language="javascript" >
	
	//声明一个记录没有错误码的对象
	var record = {};
	var form = {
 		"company_name":["noNull","请填写公司名称.","请填写公司名称."],
		"address":["noNull","请填写公司地址.","请填写公司地址."],

		"province":["noNull","请选择省份.","请选择省份."],
	
		"telareacode":['noNull','请填写电话号码,如： 80 0755 27803441.','请填写电话号码,如： 80 0755 27803441.'],
		"phone":['noNull','请填写电话号码,如： 80 0755 27803441.','请填写电话号码,如： 80 0755 27803441.' ],

		"faxareacode":['noNull','请填写传真号码,如： 80 0755 27803441.','请填写传真号码,如： 80 0755 27803441.'],
		"fax":['noNull','请填写传真号码,如： 80 0755 27803441.','请填写电话号码,如： 80 0755 27803441.' ],

		"catid":['noNull','请选择主行业.','请选择主行业.'],

		"keywords":['noNull','请填写关键词.','请填写关键词.'],
		"intro":['noNull','请填写公司简介.','请填写公司简介.'],
		'contact_name':['noNull','请填写联系人姓名.','请填写联系人姓名.']
		};

	$(function(){

		 
		//获取焦点进，提示信息
		$('.input_require').focus(function(){ 
 	
			//确认是否指定了该表单
 			if( eval( 'form.'+this.name ) )
			{	info = $('.info',this.parentNode.parentNode);
 				if( !info.get(0) ){
					info = $('.info',this.parentNode.parentNode.parentNode.parentNode.parentNode);
				}
				valiate = eval( 'form.'+this.name );
				
				if( info.attr('attr') != 'no' ){	
					info.removeClass('error');
					info.addClass('focus');

					info.show();
					info.html(valiate[1]);
					 
					//alert(info.nodeName);
				}
				if( this.nodeName == 'SELECT' ){
					$(this).change(function(){ process(this); });
				}else{
					$(this).blur(function(){ process(this); });
				}
			}
 



		//失去焦点时，提示信息
		});//.blur(function(){  process(this);  });
	});

	/******** 处理表单的方法 *********/
	function process(obj)
	{
 			if( eval( 'form.'+obj.name ) )
			{	
				info = $('.info',obj.parentNode.parentNode);
				if( !info.get(0) ){
					info = $('.info',obj.parentNode.parentNode.parentNode.parentNode.parentNode);
				}

 				info.removeClass('focus');
 				var valiate = eval( 'form.'+obj.name );
				//返回值可以是字符，也可以是真假
				var re = eval(valiate[0]+'(obj.value,info,obj)');

				if( re == true ){
					ok(info,obj);
				}else if( re==false){
					error(info,valiate[2],obj);
				}
			}
 
	}


	/***×××　提示信息显示和关闭的方法 *******/

	//错误
	function error(info,text,obj){
		//if( info.attr('attr') != 'no' ){
 			info.show();
		//}
		info.addClass('error');
		info.html(text);

		eval('record.'+obj.name+'=false');
	}
	function ok(info,obj){
		if( info.attr('attr') != 'no' ){
 			info.show();info.html('<span class="ok" ></span>');
		}
		eval('record.'+obj.name+'=true');
	}
	

	/******* 以下是验证方法 *********/

	//验证会员名是否重复
	function validateUsername(value,info,obj){

		value = $.trim(value);

		//错误消息
		var msg = true;

		//不能小于6大于20
		if( value.length>20 || value.length<6 )
		{
			return false;
		}

		if( !validateChar( value ) )
		{
			return false;
		}
 
		//ajax方式验证用户名
		var uri='/index.php?com=users&task=checkusername&no_html=1';
		$.get(uri,{'username':value},function(data){
 			if( $.trim(data) == '0' )
			{
				msg  = value+'该用户已注册,请重新填写一个登录名!';
				error(info,msg,obj);
  			}else{
				ok(info,obj);
			}
		});
 
 	}

	//验证密码
	function validatePass(v)
	{
		var r = validateChar(v);
		if( r ){ r = limit(v,6,20);  }
 		return r;
	}

	//重新输入密码
	function validateRePass(v)
	{
		//是否合格
		if( validatePass(v) ){
			if( $('input[name=pass]').get(0).value == v ){ return true;}
		}
		return false;
 	}







	//邮箱验证
	function isEmail(strEmail) {
		if (strEmail.search(/^\w+((-\w+)|(\.\w+))*\@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z0-9]+$/) != -1)
		{
			return true;
		}else{
			return false;
		}
	}


	//合法的字符
	function validateChar(v)
	{
		return /^[a-zA-Z_0-9]+$/.test(v);
	}

	//不能为空验正
	function noNull(value)
	{
 		var s = ( value=='' );
 		return !s;
	}

	function limit(obj, min, max) 
	{
		if ((obj).length > max || (obj).length < min)
		{
			return false;
		}
		return true;
	}



	function validateForm()
	{
		var error = false;
		var un = false;
		var r=false;




		//遍历对象属性
	    for(var p in form){
			r = eval('record.'+p);


			//alert(r);
			if( r == true ){
				
			}else if( typeof(r) == 'undefined' ){
				try{
					process($('input[name='+p+']').get(0));
				}catch(e){// alert(e.name+""+e.message);
				
				}
				un =true;
			}else{
 				 error=true;
			}
   			 /**
			 // 方法  
			 if(typeof(form[p])=="function"){  
				 
			  }else{  
				process($('input[name='+p+']').get(0));
			  } 
			 **/
 
		}
		
 

 		if( un == true || error == true ){
			return false;
		}else{
 			return true;
		}

	}

	function isString(str){ 
        return (typeof str=='string')&&str.constructor==String; 
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
			if( area[i][2] == id ){
				select.options[x++]=new Option(area[i][1],area[i][0]);
			}
		}
		if( x==0 ){
			$(select).hide();
		}else{
			$(select).show();
		}
	}

</script>
 