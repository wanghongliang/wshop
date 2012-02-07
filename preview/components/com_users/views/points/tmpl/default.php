 <div class="right_top" >
<h2  >我的积分</h2><span class="goon_btn"><a title="首页" href="./" style="color: rgb(255, 255, 255);">继续购物</a></span>
</div> 
<?php
$msg = $app->getMsg(); 
if( $msg )
{  echo $msg; 
}  


		 $rows = $lists['goods'];
		 $num = count($rows);
 
?>

<div class="right_top">
       	<span style="float: left;">
		您目前的可用积分为：
		<span style="color: rgb(255, 102, 0); padding-right: 20px;">
			<font style="font-family: Georgia,Times,serif; font-size: 24px;">0</font> 积分
		</span>
		<a target="" href="/article-57.html" style="color: rgb(153, 153, 153);">[如何获得更多积分]</a>
		</span>
</div>


<div class="right_line">  
      <span><strong style="color: rgb(0, 0, 0); line-height: 30px; float: left;">积分消费明细</strong><span style="float: right; text-align: right;">总获取积分：<?php echo (int)$lists['total1'];?> 积分 | 总消费积分：<?php echo (int)$lists['total2'];?> 积分</span><div class="clr"></div></span>       	
        <table cellspacing="0" cellpadding="0" border="0" width="100%" class="table">
          <tbody>
		  <tr>
            <td height="30" align="center" width="29%" valign="middle" class="td_top">积分变动时间</td>
            <td align="left" width="45%" valign="middle" class="td_top">积分变动原因</td>
            <td align="center" width="26%" valign="middle" class="td_top">积分变动额度</td>
            </tr>
			<?php
			 $rows = &$lists['rows'];
			 $num = count($rows);
							//是否有定单信息
			if( $num > 0 ){
				$i=1;
				require_once(dirname(PATH_COMPONENT).DS.'com_products'.DS.'helpers'.DS.'route.php'); 
				foreach( $rows as $k=>$row  ){
					$link = Router::_( ProductsHelperRoute::getProductRoute($row['product_id'],$row['catid']) );
				?>
				<tr>
					<td class="td" align="center"  ><?php echo date('Y-m-d H:i:s',$row['created']);?></td>
					<td class="td" > <?php echo $row['note'];?> 
					</td>
					<td class="td" align="center"  ><?php echo $row['points'];?></td>
				</tr>
				<?php
				}
			}
			?>
           <tr></tr>
        </tbody>
		</table>        
		  <?php echo $lists['nav']->showFilePage2(); ?>
</div>
