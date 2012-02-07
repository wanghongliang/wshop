	<div id="header"><h1 id="gree_logo"><a href="/" >格力网上购物平台</a></h1></div>
	<div class="flv">
		<h3 class="retitle">用户注册</h3>
		<div id="reform">

			<?php
			//错误提示消息
			$msg = $app->getMsg();
			if( $msg )
			{
			  echo $msg;
			} 
			//include($app->getMemberOptionPath()); 
			?> 
			<form id="registor" name="registor" method="post"  action="/index.php?com=users&task=reg" onsubmit="return submitForm();" >
				<p>
					<label class="inlab" for="username">用户名：</label>
					<input type="text" name="username" value="<?php echo $_REQUEST['username'];?>" class="input_require reg_input_text">	
					<span class="info"></span>
				</p>
				<p>
					<label class="inlab" for="pwd">密 码：</label>
					  <input type="password" name="pass"  class="input_require reg_input_text">
					  <span class="info"></span>
				</p>
				<p>
					<label class="inlab" for="repwd">确认密码：</label>
					 <input type="password"  name="repass" class="input_require reg_input_text">
					 <span class="info"></span>
				</p>
				<p>
					<label class="inlab" for="email">邮 箱：</label>
					<input type="text" name="email" class="input_require reg_input_text" value="<?php echo $_REQUEST['email'];?>" >
					 <span class="info"></span>
				</p>
				<p>
					<label class="inlab" for="yzm">验证码：</label>
					<input name = "code" type="text"    class="input_require reg_input_text">
	 
				  <img id="validate" src="/index.php?com=feedbacks&task=securimage&sid=<?php echo md5(uniqid(time())); ?>&no_html=1" valign=top > 
				   <span class="info">
				   </span>
				</p>
				<p style="margin-left:100px;*margin-left:20px;height:40px;"><input style="float:left;" type="submit" value="同意协议，并完成注册" id="submit"  /></p>
			</form>
			<div class="reintro">
				<p>一、本站服务条款的确认和接纳</p>
				<p>
				本站的各项电子服务的所有权和运作权归本站。本站提供的服务将完全按照其发布的服务条款和操作规则严格执行。用户同意所有服务条款并完成注册程序，才能成为本站的正式用户。用户确认：本协议条款是处理双方权利义务的约定，除非违反国家强制性法律，否则始终有效。在下订单的同时，您也同时承认了您拥有购买这些产品的权利能力和行为能力，并且将您对您在订单中提供的所有信息的真实性负责。
				</p><p>
				二、服务简介
				</p><p>
				本站运用自己的操作系统通过国际互联网络为用户提供网络服务。同时，用户必须：<br/>
				* (1)自行配备上网的所需设备，包括个人电脑、调制解调器或其它必备上网装置。<br/>
				* (2)自行负担个人上网所支付的与此服务有关的电话费用、网络费用。
				</p><p>
				基于本站所提供的网络服务的重要性，用户应同意
				</p><p>
				* (1)提供详尽、准确的个人资料。<br/>
				* (2)不断更新注册资料，符合及时、详尽、准确的要求。
				</p><p>
				本站保证不公开用户的真实姓名、地址、电子邮箱和联系电话等用户信息， 除以下情况外：
				</p><p>
				* (1)用户授权本站透露这些信息。<br/>
				* (2)相应的法律及程序要求本站提供用户的个人资料。
				</p><p>
				三、价格和数量
				</p><p>
				本站将尽最大努力保证您所购商品与网站上公布的价格一致。<br/>
				产品的价格和可获性都在本站上指明，这类信息将随时更改。<br/>
				您所订购的商品，如果发生缺货，您有权取消定单。
				</p><p>

				四、送货
				</p><p>
				本站将会把产品送到您所指定的送货地址。所有在本站上列出的送货时间为参考时间，参考时间的计算是根据库存状况、正常的处理过程和送货时间、送货地点的基础上估计得出的。
				</p><p>
				请清楚准确地填写您的真实姓名、送货地址及联系方式。因如下情况造成订单延迟或无法配送等，本站将无法承担迟延配送的责任：
				* (1)客户提供错误信息和不详细的地址；<br/>
				* (2)货物送达无人签收，由此造成的重复配送所产生的费用及相关的后果。<br/>
				* (3)不可抗力，例如：自然灾害、交通戒严、突发战争等。
				</p><p>
				五、服务条款的修改
				</p><p>
				本站将可能不定期的修改本用户协议的有关条款，一旦条款及服务内容产生变动，本站将会在重要页面上提示修改内容。
</p><p>
				六、用户隐私制度
</p><p>
				尊重用户个人隐私是本站的一项基本政策。所以，作为对以上第二条注册资料分析的补充，本站一定不会在未经合法用户授权时公开、编辑或透露其注册资料及保存在本站中的非公开内容。
</p><p>
				七、用户的帐号，密码和安全性
</p><p>
				用户一旦注册成功，成为本站的合法用户，将得到一个密码和用户名。您可随时根据指示改变您的密码。用户需谨慎合理的保存、使用用户名和密码。用户若发现任何非法使用用户帐号或存在安全漏洞的情况，请立即通知本站和向公安机关报案。
</p><p>
				八、对用户信息的存储和限制
</p><p>
				如果用户违背了国家法律法规规定或本协议约定，本站有视具体情形中止或终止对其提供网络服务的权利。
</p><p>
				九、用户管理
</p><p>
				本协议依据国家相关法律法规规章制定，用户同意严格遵守以下条款：<br/>

				* (1)从中国境内向外传输技术性资料时必须符合中国有关法规。<br/>
				* (2) 不利用本站从事非法活动。<br/>
				* (3)不干扰或混乱网络服务。<br/>
				* (4)遵守所有使用网络服务的网络协议、规定、程序和惯例。<br/>
</p><p>
				用户须承诺不传输任何违法犯罪的、骚扰性的、中伤他人的、辱骂性的、恐吓性的、伤害性的、庸俗的，淫秽的、不文明的等信息资料；不传输损害国家社会公共利益和涉及国家安全的信息资料；不传输教唆他人从事本条所述行为的信息资料。<br/>
				未经许可而非法进入其它电脑系统是禁止的。
</p><p>
				若用户的行为不符合以上提到的服务条款，本站将作出独立判断立即取消用户服务帐号。用户需对自己在网上的行为承担法律责任。用户若在本站上散布和传播反动、色情或其它违反国家法律的信息，本站的系统记录有可能作为用户违反法律的证据。
</p><p>
				十、通告
</p><p>
				所有发给用户的通告都可通过重要页面的公告或电子邮件或常规的信件传送。用户协议条款的修改、服务变更、或其它重要事件的通告都会以此形式进行。
</p><p>
				十一、网络服务内容的所有权
</p><p>
				本站定义的网络服务内容包括：文字、软件、声音、图片、录象、图表、广告中的全部内容；电子邮件的全部内容；本站为用户提供的其它信息。所有这些内容受版权、商标、标签和其它财产所有权法律的保护。所以，用户只能在本站和广告商授权下才能使用这些内容，而不能擅自复制、再造这些内容、或创造与内容有关的派生产品。本站所有的文章版权归原文作者和本站共同所有，任何人需要转载本站的文章，必须征得原文作者和本站授权。
</p><p>
				十二、责任限制
</p><p>
				如因不可抗力或其它本站无法控制的原因使本站销售系统崩溃或无法正常使用导致网上交易无法完成或丢失有关的信息、记录等本站会尽可能合理地协助处理善后事宜，并尽最大努力使客户免受损失。
</p><p>
				十三、法律管辖和适用
</p><p>
				本协议的订立、执行和解释及争议的解决均应适用中国法律。
</p><p>
				如发生本站服务条款与中国法律相抵触时，则这些条款将完全按法律规定重新解释，而其它有效条款继续有效。
				如双方就本协议内容或其执行发生任何争议，双方应尽力友好协商解决；协商不成时，任何一方均可向人民法院提起诉讼。</p>
			</div>
		</div>
	</div>
	<?php
	$item	=& ModuleHelper::getModule('mod_copyright');
	echo ModuleHelper::renderModule($item);
	?> 



 
<script language="javascript" >
	
	//声明一个记录没有错误码的对象
	var record = {};
	var form = {
 		"username":["validateUsername"," 6-20个字符，不能含空格或中文","6-20个字符，不能含空格或中文!"],
			"pass":["validatePass"," 6-20个字符,不能含空格或中文","6-20个字符，不能含空格或中文!"],
			"repass":["validateRePass","请重新输入密码。","两次密码不一致,请重新输入"],
			//"validate":["noNull","请填写旁边的验证码。","请填写旁边的验证码。"]
			"email":["isEmail","请输入您的邮箱.","邮箱格式不正确."]
		};

	$(function(){

 

		//获取焦点进，提示信息
		$('.input_require').focus(function(){ 

			//确认是否指定了该表单
 			if( eval( 'form.'+this.name ) )
			{	info = $('.info',this.parentNode);
				valiate = eval( 'form.'+this.name );
				info.removeClass('error');
				info.addClass('focus');
				info.html(valiate[1]);
			}

		//失去焦点时，提示信息
		}).blur(function(){
 			process(this);
 		});
	});
	function submitForm(){
		if( validateForm()){ 
			//alert('ok');
			//alert($('#registor').get(0));
			//$('#registor').submit();
			return true; 
		}else{
			alert('请正确填写相关项');
			return false;
		}
	}
	/******** 处理表单的方法 *********/
	function process(obj)
	{
 		if( eval( 'form.'+obj.name ) )
		{	
			info = $('.info',obj.parentNode);
			info.removeClass('focus');
			info.hide();
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
		info.show();
		info.addClass('error');
		info.html(text);
		eval('record.'+obj.name+'=false');
	}
	function ok(info,obj){
		info.show();
		info.html('<span class="ok" ></span>');
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
				msg  = value+'该用户已注册.!';
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


	var tag = true; //两次提交
	function validateForm()
	{
		var error = false;
		var un = false;
		var r=false;

		//遍历对象属性
	    for(var p in form){
			r = eval('record.'+p);

			if( r == true ){
				
			}else if( typeof(r) == 'undefined' ){
 				process($('#registor').find('[name='+p+']').get(0));

				//alert('ok');
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

		if( un == true && tag ){ 
			tag=false;
			return validateForm(); 
		}

 		if(  error == true ){
			return false;
		}else{
 			return true;
		}

	}

	function isString(str){ 
        return (typeof str=='string')&&str.constructor==String; 
    }
</script>
 