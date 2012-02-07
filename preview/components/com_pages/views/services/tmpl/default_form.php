<div class="" >
<?php
$msg = $app->getMsg(); 
if( $msg )
{  echo $msg; 
}  
?>
</div>

<form action="<?php echo URI::current();?>" method="get">
<?php
if( $app->uid > 0  ){
?>
<p>
  按时间查询：<input type="text" name="ts" id="ts" size="10" /> - 
  <input type="text" name="te" id="te" size="10" /> 
  &nbsp;
  <input type="submit" class="sgbtn" value="查询" />
   <input type="hidden" name="a" value="<?php echo $_GET['a'];?>" />
</p>
<?php
}else{
?>
	<p>
		<select name="w" >
			<option value="1">用户名</option>
			<option value="2">订单号</option>
			<option value="3">联系电话</option>
			<option value="4">手机</option>
		</select>
		<input type="text" name="k" id="" /> 
		<label for="yzm">输入验证码：</label> 
		<input type="text" name="v" id="yzm" size="5" />
		<a href="javascript:void;"> 
			<img id="validate" src="/index.php?com=feedbacks&task=securimage&sid=<?php echo md5(uniqid(time())); ?>&no_html=1" valign=center height=22  > 
		</a>
		 <input type="hidden" name="a" value="<?php echo $_GET['a'];?>" />
		 <input type="submit" class="sgbtn" value="查询" />
		<a href="/index.php?com=users" ><u>会员登陆</u></a>后可以直接查询。
	 </p>
<?php
}
?>
</form>