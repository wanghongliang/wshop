<?php
//print_r($this->item);
$basepath = dirname(__FILE__);
//include($basepath.DS.'header.php');
$baseurl = '/preview/templates/'.$app->getTemplate();
		$uri = &URI::getInstance();

?>

<link rel="stylesheet" type="text/css" href="<?php echo $baseurl;?>/css/tuan.css" />


	<div class="hfleft">
		<div class="zone" >
		<h1 class="histitle">邀请有奖</h1>
 
			<br/>
<dl class="invate_way">			  <dt>当好友通过您的专用邀请链接注册并完成首次购买，系统会为您的现金账户充值5元，可直接用于支付。</dt>

			<?php if( $app->uid>0 ){ ?>
			<dd id="inv_way1"> <b id="urldoc2">这是您的专用邀请链接，通过MSN或QQ发送给好友吧！</b><br>
        <input type="text" onfocus="this.select()" value="<?php echo substr(URI::base(),0,-1),$uri->getByURL(array('a'=>'in','uid'=>$app->uid)); ?>" class="inputs" id="qqmsnurl2" name="qqmsnurl2" autocomplete="off" style="width:360px;">
        <!--[if IE]>
        <input type="submit" value="复制链接" class="dbtn com_btn" onClick="copy2(document.getElementById('qqmsnurl2').value)">
        <![endif]-->
        <div class="clear"></div>
      </dd>
			<?php }else{ ?>

			
			  <dd>
				<form id="gotoLoginForm" name="gotoLoginForm" method="post" action="/?com=users">
				  请先 <a class="blue" style="cursor:pointer" onclick="document.gotoLoginForm.submit();">登录</a> 或者 <a class="blue" href="?com=users&layout=registor" >注册</a>，获取您的专用邀请链接。
				  <input type="hidden" name="return" value="<?php echo URI::current();?>">
				</form>
			  </dd>
		
			<?php } ?>
 	</dl>
		 <div class="clr"></div>
		</div>
		
	</div>
 
	<div class="tfright">
		<div class="zone"> 
				<h4>在哪里可以看到我的返利？</h4>
				<p>在<a href="http://www.quwan.com/tuan/account/invites" class="blue">我的邀请</a>可看到您的邀请和返利记录。返利金额不返现，可在下次团购时用于支付。</p>
				<h4>哪种情况会使邀请返利失效？</h4>
				<p>同一个手机号或送货地址多次使用时不返利，对自己邀请自己的作弊行为扣除一切返利。</p>
				<h4>购买所有团购商品都返利吗？</h4>
				<p>个别团购会注明不返利，也不计入好友的首次购买，好友下次购买可返利商品时您将获得5元返利。</p>
	 
		</div>

 
	</div>

<div class="cln">&nbsp;</div>


 

<?php include($basepath.DS.'footer.php');?>