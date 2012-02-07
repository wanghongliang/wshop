<?php
$menu = &$app->getMenu();
import('utilities.cart');
$cart =  Cart::getInstance();
//require_once (dirname(__FILE__).DS.'helper.php'); 
//require(ModuleHelper::getLayoutPath('mod_search'));
?>





<div id="search">
<div class="slft" >
<div class="srgt" >


	<form action="/?com=products&view=search" method="post" id="sfm" >
		<p id="psearch">
			<input type="input" name="k" id="keyword" value="<?php echo empty($_GET['k'])?'输入您想要的宝贝':$_GET['k'];?>" />
			<input type="button" id="psbtn" value="&nbsp;" />
		</p>
	</form>
	
	<p class="plab">
		热门搜索：
		<a href="javascript:searchsubmit('空调');">空调</a>
		<a href="javascript:searchsubmit('空调扇');">空调扇</a>
		<a href="javascript:searchsubmit('热水器');">热水器</a>
		<a href="javascript:searchsubmit('电磁炉');">电磁炉</a>
		<a href="javascript:searchsubmit('电饭煲');">电饭煲</a>
		<a href="javascript:searchsubmit('电水壶');">电水壶</a> 
	</p>




<div id="pcart"  ><a class="goorder"  href="javascript:location.href='<?php echo $menu->link('index.php?com=cart&act=checkout');?>';" >&nbsp;&nbsp;&nbsp;</a>
	<span class="cart" onclick="location.href='<?php echo $menu->link('index.php?com=cart');?>';">购物车中有 <b class="cartnum"><?php echo $cart->getNum();?></b> 件商品</span>
	<div class="clist" >
		<dl>
		<?php
		$ms = &$cart->getMerchandises();

		if( count($ms)>0 ){
			require_once ($app->getPreviewComponentPath().DS.'com_products'.DS.'helpers'.DS.'route.php');
		$total = 0;
		$total_price = 0;


		$total_pays = 0;
		foreach( $ms as $k=>$v ){
			$price = intval($v['info']['price']);	//价格
			$sub_total_price = $price * $v['number'];	//小结
			$total += $v['number'];	//总数量
			$total_price += $sub_total_price; //总价格


			$deposit = intval($v['attr']['price']);	//价格
			$sub_total_p = $deposit * $v['number'];	//小结
			$total_pays += $sub_total_p; //总价格
		?>
			<dd pe="<?php echo $sub_total_price;?>" >
			<div class="img" >
				<img width="50"  src="<?php echo $v['info']['thumbnail'];?>">
			</div>
			<div class="pn" >
			<a href="<?php echo Router::_( ProductsHelperRoute::getProductRoute($v['info']['id'],$v['info']['catid']) );?>" target="_blank" >
			 <?php echo $v['info']['name'];?>
			</a><br/>
			<font color=red>￥<?php echo $price;?> x <?php echo $v['number'];?> </font>
			<a href="#" onclick="delcart(this,'<?php echo $k;?>');" class="hcolor3">[删除]</a>
			</div>
			</dd>
		<?php }

		}else{
			?>
		<?php }?>
		</dl>
		<p class="cart_out">
			<? echo '共<font color="red"><span class="cartnum" >'.($total?$total:0).'</span></font>件商品，金额总计：<font color="red">￥<span class="totalPrice" >'.($total_price?$total_price:0).'</span></font>'; ?><br/>
			<a class="porder"  href="javascript:location.href='<?php echo $menu->link('index.php?com=cart&act=checkout');?>';" >去结算</a>
		</p>
	</div>
</div>






</div>
</div>
</div>


 