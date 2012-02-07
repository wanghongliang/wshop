<?php


$tid = intval($params['menutype']);
$tid = $tid?$tid:0;

//这里是个对象引用，当在后面程序改变其值时，会发生错误!!!!!!!!!!!!!
$menu = &$app->getMenu();
//print_r($menu->menus);
$data = $menu->getMenus($tid);
$menus = $menu->buidTree($data);
$rows = $menus[0];
$active = &$menu->getActive();
$active_css = 'now';
if( !$active )
{
	$active =&$menu->getDefault();
}

import('utilities.cart');
$cart =  Cart::getInstance();
?>

 
	<ul id="menus">
		<?php
		$i=0;
		
		foreach( $rows as $k=>$m )
		{
			
 			?>
			<li class="<?php if( $i++==0 ){ echo 'first';}elseif( $i==4 ){ echo 'end'; } ?>" ><a href="<?php echo $m['link'];?>" <?php if( $m['id'] == $active['id'] ){ echo ' class="now" '; } ?> ><?php echo $m['name'];?></a></li>
 			<?php
			if( $i>4 ){ break; }
 		}
		?> 

	</ul>
	<div id="psearch">
		<form action="/?com=products&view=search" method="post" id="sfm" >
			<input type="input" name="k" id="keyword" value="<?php echo empty($_GET['k'])?'输入您想要的宝贝':$_GET['k'];?>" />

 			<input type="button" value="搜索" id="psbtn" /> 
		</form>
	</div>
	<div id="pcart">
		<p id="pcartnum">购物车中有：<b class="cartnum c-red"><?php echo $cart->getNum();?></b> 件商品</p>
		<a class="goorder"  href="javascript:location.href='<?php echo $menu->link('index.php?com=cart');?>';" id="pcheck">去结算</a>

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

 
 


