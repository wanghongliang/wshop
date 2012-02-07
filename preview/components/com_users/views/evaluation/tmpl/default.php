 <div class="right_top" >
<h2  >我的评价</h2><span class="goon_btn"><a title="首页" href="./" style="color: rgb(255, 255, 255);">继续购物</a></span>
</div> 
<?php
$msg = $app->getMsg(); 
if( $msg )
{  echo $msg; 
}  


		 $rows = $lists['goods'];
		 $num = count($rows);
		 if( $num > 0 ){
?>

        <ul class="labtitle">
            <li class="now">待评价商品</li>
            
        </ul>
 
        <div class="revbox">
            <table width="100%" cellpadding="0" cellspacing="0" border="0" class="coltab">
                <?php foreach($rows as $k=>$row ){ ?>
                <tr>
                    <td>
					<a href="<?php echo $this->baseurl;?>&a=r&product_id=<?php echo $row['product_id'];?>"><img src="<?php echo $row['product_thumb'];?>" width="80"  align="center"/>
					<?php echo $row['product_name'];?></a>
					</td> 
                    <td><a href="<?php echo $this->baseurl;?>&a=r&product_id=<?php echo $row['product_id'];?>">我要评论</a></td>
                </tr>
                <?php } ?>
            </table>
        </div>

<?php
		 }
?>

        <ul class="labtitle" style="margin-top:10px;">
             <li class="now">已评价的商品</li>
        </ul>
        <div class="revbox" >
            <table width="100%" cellpadding="0" cellspacing="0" border="0" class="coltab">
				<?php
				/**
                <tr><td colspan="3"><b>我发表的评论：</b>&nbsp;&nbsp;<a href="" class="color2">全部评论</a> &nbsp;&nbsp;<a href="">本周的评论</a>&nbsp;&nbsp;<a href="">本月的评论</a>&nbsp;&nbsp;<a href="">本年的评论</a></td></tr>
				**/
				 $rows = $lists['rows'];
				 $num = count($rows);
								//是否有定单信息
				if( $num > 0 ){
					$i=1;
					require(dirname(PATH_COMPONENT).DS.'com_products'.DS.'helpers'.DS.'route.php'); 
					foreach( $rows as $k=>$row  ){
						$link = Router::_( ProductsHelperRoute::getProductRoute($row['product_id'],$row['catid']) );
					?>
					<tr>
						<td class=td width="35%"><?php echo $row['contents'];?></td>
						<td class=td >对“<a href="<?php echo $link;?>" target="_blank" ><?php echo $row['name'];?></a>”的评论
						&nbsp;<?php echo $row['star'];?>分
						</td>
						<td class=td >发表于 <?php echo $row['created'];?></td>
					</tr>
					<?php
					}
				}
				?>
    
            </table>
            <?php echo $lists['nav']->showFilePage2(); ?>
        </div>
 