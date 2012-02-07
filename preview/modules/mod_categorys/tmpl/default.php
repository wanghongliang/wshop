<?php

$menu = &$app->getMenu();
$result = $menu->getCategory();
	//print_r($result);
$catid= (int)($_REQUEST['catid']);
$cat = &$menu->getCategoryItem($catid);
   
//是否展示分类菜单 
if(  $_REQUEST['tmpl'] == 'home'  || ( $_REQUEST['com'] == 'products' && ( $_REQUEST['view'] == 'category' || $_REQUEST['view'] == 'search' ) )){ 
	$hide = false;
}else{ 
	$hide = true; 
} 
 
?>
<Div id="productsort" <?php if( $hide == true ){  ?> class="opencat" <?php } ?> >
<h2 id="typetitle" >格力产品分类</h2>
<ul id="typemenu" <?php if( $hide == true ){  ?> style="display:none;" <?php } ?> >
  
	<?php

	$rows = array();
	foreach( $result as $v ){ $rows[$v['parent_id']][] = $v; }

	foreach( $rows[0] as $k=>$v ){
		?>
		<li>
		<a class="cat <?php if( $v['id'] == $catid ){ echo ' act'; } ?>"  href="<?php echo $menu->bProductsLink($v['route']);?>"><?php echo $v['name'];?></a>
		<?php
		$cats = $rows[$v['id']];
		if( count($cats)>0 ){
			?>
			<dl>
			<?php
			foreach( $cats as $a=>$b ){
				?>
				<dd>
				<a href="<?php echo $menu->bProductsLink($b['route']);?>" <?php if( $b['id'] == $catid ){ echo ' class="act" '; } ?> ><?php echo $b['name'];?></a>
				</dd>
				<?php
			}
			?>
			</dl>
			<?php
		}
		?>
		</li>
		<?php
	}

	?>
</ul>
</div>