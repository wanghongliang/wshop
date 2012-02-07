<div class="right_top" >
<h2  >我的优惠券</h2><span class="goon_btn"><a title="首页" href="./" style="color: rgb(255, 255, 255);">继续购物</a></span>
</div>
<?php
$msg = $app->getMsg(); 
if( $msg )
{  echo $msg; 
}  


		 $rows = $lists['goods'];
		 $num = count($rows);
 
?>

<div class="right_line">
        <table cellspacing="0" cellpadding="0" border="0" width="100%" class="table">
          <tbody><tr>
            <td align="left" valign="middle" class="td_form">&nbsp;</td>
            <td align="left" valign="middle" class="td_form" colspan="3">&nbsp;</td>
          </tr>
          <tr>
            <td height="40" align="left" width="4%" valign="middle" class="td_form">&nbsp;</td>
            <td align="left" valign="middle" class="td_form" colspan="3"><strong style="font-size: 14px; color: rgb(0, 0, 0);">输入验证码，在帐户中充入新的优惠卡/礼品卡</strong></td>
          </tr>
          <tr>
            <td height="40" align="left" valign="middle" class="td_form">&nbsp;</td>
            <td align="left" valign="middle" id="global_insert_input" class="td_form" colspan="3">验证码：
              <input type="text" size="20" id="bonus_sn" name="bonus_sn"><input type="hidden" value="act_add_bonus" name="act">
            <span>请输入您的优惠券/礼品卡的验证码</span></td>
          </tr>         
          <tr>
            <td height="40" align="left" valign="middle" class="td_form">&nbsp;</td>
            <td align="left" width="7%" valign="middle" class="td_form">&nbsp;</td>
            <td align="left" width="14%" valign="middle" class="td_form"><input type="submit" value="绑定" style="border: medium none;" class="u_btn2"></td>
            <td align="left" width="75%" valign="middle" class="td_form"><?php /** <a target="_blank" href="#">点击查看详细说明&gt;&gt;</a>**/?></td>
          </tr>
          <tr>
            <td align="left" valign="middle" class="td">&nbsp;</td>
            <td align="left" valign="middle" class="td" colspan="3">&nbsp;</td>
          </tr>
        </tbody></table>
      </div>


	  <div class="right_line">      
        <p style="line-height: 30px;"><strong style="font-size: 14px; color: rgb(0, 0, 0);">[优惠券/礼品卡]</strong>（共 0 张可用，合计面值 0.00元）<font style="color: rgb(255, 0, 0); font-size: 12px; padding-left: 10px;">*过期的优惠券将被删除，请及时使用！</font></p>
        <table cellspacing="0" cellpadding="0" border="0" width="100%" class="table">
          <tbody><tr>
            <td height="30" align="center" width="23%" valign="middle" class="td_top">验证码</td>
            <td align="center" width="13%" valign="middle" class="td_top">面值</td>
            <td align="center" width="16%" valign="middle" class="td_top">最小订单金额</td>
            <td align="center" width="33%" valign="middle" class="td_top">有效期</td>
            <td align="center" width="15%" valign="middle" class="td_top">状态</td>
          </tr>
		            <tr></tr>
        </tbody></table>
      </div>