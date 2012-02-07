<?php
/*
	*功能：快速付款入口模板页
	*详细：该页面是针对不涉及到购物车流程、充值流程等业务流程，只需要实现买家能够快速付款给卖家的付款功能。
	*版本：3.1
	*日期：2010-10-29
	*说明：
	*以下代码只是为了方便商户测试而提供的样例代码，商户可以根据自己网站的需要，按照技术文档编写,并非一定要使用该代码。
	*该代码仅供学习和研究支付宝接口使用，只是提供一个参考。
*/

require_once("alipay_config.php");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML XMLNS:CC><HEAD><TITLE>支付宝 - 网上支付 安全快速！</TITLE>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<META content=网上购物/网上支付/安全支付/安全购物/购物，安全/支付,安全/支付宝/安全,支付/安全，购物/支付, 
name=description 在线 付款,收款 网上,贸易 网上贸易.>
<META content=网上购物/网上支付/安全支付/安全购物/购物，安全/支付,安全/支付宝/安全,支付/安全，购物/支付, name=keywords 
在线 付款,收款 网上,贸易 网上贸易.><LINK href="images/layout.css" 
type=text/css rel=stylesheet>

<SCRIPT language=JavaScript>
<!-- 
  //校验输入框 -->
function CheckForm()
{

	if (document.orderform.order_title.value.length == 0) {
		alert("请选择您要订购的产品.");
		document.orderform.order_title.focus();
		return false;
	}


	if (document.orderform.order_name.value.length == 0) {
		alert("请输入您的姓名.");
		document.orderform.order_name.focus();
		return false;
	}
	if (document.orderform.order_phone.value.length == 0) {
		alert("请输入您的电话.");
		document.orderform.order_phone.focus();
		return false;
	}
	var reg	= new RegExp(/^\d{0,5}-?\d{7,15}$/);
	if (! reg.test(document.orderform.order_phone.value))
	{
        alert("请正确输入电话号码.");
		document.orderform.order_phone.focus();
		return false;
	}

	if (document.orderform.order_address.value.length == 0) {
		alert("请输入您的地址.");
		document.orderform.order_address.focus();
		return false;
	}
	//if (Number(document.alipayment.alimoney.value) < 0.01) {
	//	alert("付款金额金额最小是0.01.");
	//	document.alipayment.alimoney.focus();
	//	return false;
	//}
}  

<!-- 
  //控制文字显示-->
function glowit(which){
if (document.all.glowtext[which].filters[0].strength==2)
	document.all.glowtext[which].filters[0].strength=1
else
	document.all.glowtext[which].filters[0].strength=2
}
function glowit2(which){
if (document.all.glowtext.filters[0].strength==2)
	document.all.glowtext.filters[0].strength=1
else
	document.all.glowtext.filters[0].strength=2
}


function startglowing(){
if (document.all.glowtext&&glowtext.length){
for (i=0;i<glowtext.length;i++)
eval('setInterval("glowit('+i+')",150)')
}
else if (glowtext)
setInterval("glowit2(0)",150)
}


if (document.all)
window.onload=startglowing


</SCRIPT>
</HEAD>
<style>
<!--
#glowtext{
filter:glow(color=red,strength=2);
width:100%;
}
-->
</style>
<BODY text=#000000 bgColor=#ffffff leftMargin=0 topMargin=4>
<CENTER>

 


<FORM name=orderform onSubmit="return CheckForm();" action="alipayto.php"
method=post  >
 
<TABLE cellSpacing=0 cellPadding=0 width=537 border=0>
	<TR>
	 <td height="28" align="left" colspan="3">
	 <div class="orderremark" >
	 　　　1、请您认真填写以下订单信息,该信息不会对外公开，请您放心填写；<br>
	　　　2、我们收到订单后将会尽快将您的信息反馈给相关人员，并会尽快与您联系；<br>
	　　　3、收货地址越详细越好哦：<font color="#ff0000">如：xx省xx市xx县/区/市xx街/镇xx号/村</font>；<br>       
	</div>

	</td>
	</tr>

<TR>
  <TD class=form-left>产品类型： </TD>
  <TD class=form-star>* </TD>
  <TD class=form-right>
  <select name="order_title" >       
         <option value="" selected="">请选择您要订购的产品</option>
		 <option value="左旋360减肥咖啡 一周期 激瘦体验装 『395元』">左旋360减肥咖啡 一周期 激瘦体验装 『395元』</option>
		 <option value="左旋360减肥咖啡 二周期 骨感窈窕装 『590元』">左旋360减肥咖啡 二周期 骨感窈窕装 『590元』</option>
		 <option value="左旋360减肥咖啡 三周期 瘦人体质装 『860元』">左旋360减肥咖啡 三周期 瘦人体质装 『860元』</option>
         </select>
 </span>
 </TD>
</TR>


<TR>
  <TD class=form-left>收货人姓名： </TD>
  <TD class=form-star>* </TD>
  <TD class=form-right><INPUT size=45 name="order_name" maxlength="200"  class="orderinput"  ></TD>
</TR>

<TR>
  <TD class=form-left>联系电话： </TD>
  <TD class=form-star>* </TD>
  <TD class=form-right><INPUT size=45 name=order_phone maxlength="200"  class="orderinput"  ></TD>
</TR>

<TR>
  <TD class=form-left>收货人地址：</TD>
  <TD class=form-star>* </TD>
  <TD class=form-right><INPUT size=45 name=order_address maxlength="200"  class="orderinput"  ></TD>
</TR>


<TR>
  <TD class=form-left>邮      编： </TD>
  <TD class=form-star>&nbsp;</TD>
  <TD class=form-right><INPUT size=45 name=order_zip maxlength="200"  class="orderinput"  ></TD>
</TR>
<TR>
  <TD class=form-left>E-mail： </TD>
  <TD class=form-star>&nbsp;</TD>
  <TD class=form-right><INPUT size=45 name=order_mail maxlength="200"  class="orderinput"  ></TD>
</TR>

<TR>
  <TD class=form-left>备注：</TD>
  <TD class=form-star>&nbsp;</TD>
  <TD class=form-right><INPUT size=45 name=order_remark maxlength="200"  class="orderinput"  ></TD>
</TR>

 

 
 <TR>
  <TD class=form-left></TD>
  <TD class=form-star></TD>
  <TD class=form-right>
  <INPUT class="button_sure"  type=image 
	src="images/button_sure.gif" value=确认订单 
	name=nextstep>
	
	
<INPUT type=reset  class="resetbtn"  value="" 
 >
	
	</TD>
</TR>
</TABLE>





 

</FORM>

 

 
</BODY></HTML>
