    <div class="right_top" >
<h2  >商品点评</h2><span class="goon_btn"><a title="首页" href="./" style="color: rgb(255, 255, 255);">继续购物</a></span>
</div> 
	<div class="eform" style="">
		<div style="padding:10px 20px;">


			<?php 
				$num = count($item);
				$iscomment = 0; //默认为没有评论
				
				if( $num > 0 ){
					foreach( $item as $v ){ if( $v['iscomment'] == 1){  $iscomment++;  } }	//是否为已加的评论
					if( $iscomment < $num ){ $iscomment=0; }	//如果有没加的？就重设为0
			 
					
					$product_name = $item[0]['product_name'];
					$product_id = $item[0]['product_id'];
				}

				if( $num > 0 && $iscomment == 0 ){ ?>
			
				<h2 class="odtitle2">评论“<font color="red" ><?php echo $product_name;?></font>”</h2>
				<div class="u_ak">
				只针对商品本身，不要针对交易、配送等服务过程。有关服务过程的问题，请查看帮助中心，或者联系客服。
				<br/>
				感谢您的参与！完成评价后，您将获得一定的经验值。
				</div>


				<form action="<?php
				echo $this->baseurl;?>" method="post" name="evalform" onsubmit="return checkform();" >
					<h3>
					评价打分:<span class="req" >(*)</span>
					</h3>

					
					<div class="wp">
						<?php /**
						<ul class="box starRating">
						<li value="1" alt="很差" class="s1">1星</li>
						<li value="2" alt="差" class="s2">2星</li>
						<li value="3" alt="还行" class="s3">3星</li>
						<li value="4" alt="好" class="s4">4星</li>
						<li value="5" alt="很好" class="s5">5星</li>
						<li class="info">点击星星为商品打分</li>
						<li class="data">
						<input type="hidden" autocomplete="off" value="20"  id="$review_form_star">
						</li>
						</ul>
						**/?>

						<input name="star" type="radio" value="1" >差评
						<input name="star" type="radio" value="2" checked >中评
						<input name="star" type="radio" value="3" >好评
					</div>
		 

					<h3>
					评价<span class="req" >(*)</span>:
					</h3>
					<textarea cols=80 rows=8 name="content" id="content" ></textarea>
					<br>
					<?php
					if( $app->uid < 1 ){
						?>
						<div class="validate" >
						验证码：
						<input type="text" name="code" value="" size=8	 />
						<img valign="bottom" src="/index.php?com=feedbacks&task=securimage&no_html=1" id="validate">
						&nbsp;
						<span class="val_remark" >登陆后，不用输入验证码。</span>
						</div>
						<?php
					}
					?>
			 
					<input type="hidden" name="product_id" value="<?php echo $product_id;?>"  />
					<input type="hidden" name="product_name" value="<?php echo $product_name;?>" />
 					<input type="hidden" name="a" value="s" />
					<input type="submit" value="提交点评" class="u_btn" id="submit" > &nbsp;
					<a href="<?php echo $this->baseurl;?>" >取消</a>
				</form>

			<?php }else if( $iscomment > 0 ){
			?>
			您已完成对该产品的评论，谢谢！ 
			<br/>
			<a href="<?php echo $this->baseurl;?>" >点击这里返回我的评价列表</a>
			<?php
			}else{
			?> 
			<div id="user_right_index_box">要发表评论？</div>
			  <div id="user_right_return_body">
				您必须用这个帐号成功购买过该商品才可以发表评论。<br>
				<strong>如果你有其它帐户，</strong>并且已经用它购买过该商品　，你可以登录到那个帐户写评论。<br>
				注：只对购买过的商品才可以发表评论的要求是出于维护评论质量的要求。
			  </div> 
     	 
			<?php } ?>
		<br/>
        </div>
	</div>

	<script language="javascript" >
	function checkform(){ 
			if( $('#content').val() == ''){
				alert(' 请输入评论内容! ');
				return false;
			}

			if( $('#star').val() == '' ){
				//alert(' 请选择评分! ');
				//return false;
			}
 
			return true;
	}
	</script>
 

