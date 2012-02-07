<?php
 require(dirname(PATH_COMPONENT).DS.'com_products'.DS.'helpers'.DS.'route.php');
$rows = &$lists['rows']; 
//省市分类
//$province = $this->get('province');
?> 

 <div class="right_top" >
<h2  >我的收藏</h2><span class="goon_btn"><a title="首页" href="./" style="color: rgb(255, 255, 255);">继续购物</a></span>
</div>

<?php
$msg = $app->getMsg(); 
if( $msg )
{  echo $msg; 
}  
?>
<div class="border2" style="margin-top:10px;"  >

	<table width="100%" cellpadding="0" cellspacing="0" border="0" class="coltab">
		<tr><td colspan="5"><input type="checkbox" class="selectall" /> <label for="checkall">全选</label></td></tr>
		<?php 
		foreach( $rows as $row ){
			$link = Router::_( ProductsHelperRoute::getProductRoute($row['products_id'],$row['catid']) );


			?>
			<tr>
				<td>
					<input type="checkbox" name="sox[]" value="<? echo $row['id']; ?>" class="ids" />
				</td>
				<td>
					<a href="<?php echo $link;?>">
						<img src="<?php echo $row['thumbnail'];?>" width="80"/>
					</a>
				</td>
				<td>
					<a href="<?php echo $link;?>" target="_blank" ><?php echo $row['name'];?></a><br/>
					收藏时间：<?php echo substr($row['created'],0,10);?>
				</td>
				<td>格力网购价：￥<?php echo $row['price'];?></td>
				<td><a href="index.php?com=users&view=fav&act=cancel&id=<?php echo $row['id'];?>">>>取消收藏</a></td>
			</tr>
			<?php
		}
		?>
		 <tr><td colspan="5"><a href="javascript:delall('index.php?com=users&view=fav&act=delall');">批量取消</a></td></d></tr>
	</table>

	<?php
	echo $lists['nav']->showFilePage2();
	?>
</div>