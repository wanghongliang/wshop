<?php
//print_r($this->item);
$basepath = dirname(__FILE__);
//include($basepath.DS.'header.php');
$baseurl = '/preview/templates/'.$app->getTemplate();

?>

<link rel="stylesheet" type="text/css" href="<?php echo $baseurl;?>/css/tuan.css" />


	<div class="hfleft">
		<h1 class="histitle">邮件订阅提示信息</h1>
		<div class="histcontent">


			<div style="background: none repeat scroll 0% 0% rgb(255, 255, 255);">
			<div style="width: 300px; margin-left: 70px; margin-top: 20px;">
				  <div style="width: 60px; float: left; margin-top: 10px;"><img height="47" width="49" src="http://t1.lashouimg.com/templates/default/images/right.jpg"></div>
				  <div style="width: 240px; float: right; line-height: 18px;"><p style="font-size: 14px; font-weight: bold;">邮件订阅成功!</p><p style="font-size: 12px;">每天的团购将及时发到您邮箱</p>
				  </div>
				  <div style="clear: both;"></div>
			  </div>
			  </div>

			<div style="width: 350px; margin-left: 25px; margin-top: 6px; background: none repeat scroll 0% 0% rgb(245, 245, 245); display:none;">
			  <div style="width: 250px; margin: 0pt auto; padding-top: 6px;"><p style="color: rgb(255, 108, 0); font-weight: bold; font-size: 14px;">您可能收不到订阅邮件...</p>
				  <p style="font-size: 12px; margin-top: -2px;">请将 whl@126.com 加入邮箱白名单</p></div>
				  <div style="margin-left: 50px; margin-top: -6px;">
 
				  </div>
				  <div style="height: 25px;"></div>
		   </div>

		   <br/><br/>
		
		</div>
		<div class="hisbtm"></div>
	</div>
 
<div class="cln">&nbsp;</div>


 

<?php include($basepath.DS.'footer.php');?>