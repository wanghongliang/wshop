<?php

$config = array(
	'host'=>'localhost',
	'database'=>'daybillion',
	'username'=>'daybillion',
	'pass'=>'daybillion'
);

#w_feedbacks

 
#print_r($config);

#连接和打开数据库
$dbh = mysql_connect($config['host'],$config['username'],$config['pass']);
$err = mysql_error();
if($err){die("连接错误");}


mysql_select_db($config['database']);
$err = mysql_error();
if($err){die("打开数据库错误");} 

mysql_query("set names 'utf8'");

$order_no = date('YmdHis');		//订单号
$order_title = $order_no; //订单标题
$order_name = $_POST['order_name'];
$order_phone = $_POST['order_phone'];
$order_address = $_POST['order_address'];
$order_zip = $_POST['order_zip'];
$order_mail = $_POST['order_mail'];
$order_remark = $_POST['order_title'].'<br/>'.$_POST['order_remark'];





$sql="insert into w_feedbacks set author='{$order_name}',title='{$order_title}',phone='{$order_phone}',company='',address='{$order_address}',release_date='".date('Y-m-d')."',email='{$order_mail}',content='{$order_remark}' ";

//echo $sql;
if( mysql_query($sql) ){
}else{
	$err = mysql_error();
	##print_r($err);
	echo '订单失败，请重新下单，谢谢！';
	exit;
}

header("Content-type: text/html; charset=utf-8");

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML XMLNS:CC><HEAD><TITLE>在线订单！</TITLE>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<LINK href="images/layout.css" 
type=text/css rel=stylesheet>

</HEAD>
<style>
<!--
#glowtext{
filter:glow(color=red,strength=2);
width:100%;
}

.STYLE3 {
    color: #663300;
    font-size: 14px;

    font-weight: bold;
    line-height: 24px;
}

.STYLE4 {
    color: #000000;
    font-size: 14px;
    font-weight: bold;
}

.STYLE6 {
    color: #FF6600;
    font-size: 14px;
}
-->
</style>
<BODY text=#000000 bgColor=#ffffff leftMargin=0 topMargin=4>
<CENTER>
<div style="padding-top:30px;" >

<table   cellspacing="1" cellpadding="0" border="0">
  <tbody><tr>
    <td >

	
	<table width="460" cellspacing="2" cellpadding="0" bgcolor="#cccccc" align="center">
      <tbody><tr>
        <td height="88" width="628" bgcolor="#ffffff" align="center">

		<p class="STYLE3">您的订单已经提交完成，请您在10分钟内编辑订单号，<br>
          发短信至<span class="STYLE8">13530253280 </span><br>
          确认您的信息,以便我们优先处理您的订单，以最快的速度为您发货!
		</p>      
		  
		 </td>
      </tr>

      <tr>
        <td height="105" bgcolor="#ffffff">
			<div align="center" class="STYLE4">温馨提示：<br>
			  <br>
			   手机短信：13530253280<br>
			  <br>
				全国订购热线：0755-27803441
			</div>
		</td>
      </tr>

      <tr>
        <td height="60" bgcolor="#ffffff" align="center" class="STYLE6">
		您的订单号是:<font color="#ff0000"><b><?php echo $order_no; ?></b></font>.请您妥善保管好您的订单号.
		</td>
      </tr>
    </tbody>
	
	</table>
	
	</td>
  </tr>
  <tr>
    <td width="100%"></td>
  </tr>
</tbody></table>
</div>


</CENTER>
</BODY></HTML>
