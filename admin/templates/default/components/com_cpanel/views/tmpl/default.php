 
<?php
global $app;
$db = &Factory::getDB();
$sql = " select id,username,lastvisitDate,favorites_num,photo,hits from #__users where id=".$app->uid;
$db->query($sql);
$info = $db->getRow();

//订单状态 
$order_status = array(
	0=>'等待处理', 
	2=>'正在配货',
	3=>'已发货',
	7=>'会员已取消',
	8=>'已完成',
);			$order_pay = array(0=>'未支付',1=>'已支付'); //支付状态
?>
<div class="cpanel_header" >


	<div class="company_info"  >
		<table width="96%" >
		<tr>
			<td    class="userinfo" >


			 <div > 
				<h3>欢迎<font color=red > <?php echo $info['username'];?> </font>!</h3> 
			 
				<div >
				最后登陆时间： <?php echo $info['lastvisitDate']; ?> 
				</div> 
				
			</div>

			<div class="clr" ></div>

				
			</td>
		</tr>

		<tr>
			<td class="company_info3"   >
				<ul>
					<li>
					<a href="index.php?com=menu" >菜单/内容管理</a>
					</li>
					<li>|</li>

					<li>
					<a  href="index.php?com=configs">网站配置</a>
					</li>
					<li>|</li>

					<li>
					<a  href="index.php?com=companies">企业信息</a>
					</li>
					 
				</ul>
 				 
			</td>
		</tr>
			
		<tr>
			<td   class="userinfo company_info3" style="padding:0px;">
						<?php
			//最订单信息
			$db = &Factory::getDB();
			$sql = "select * from #__order  order by id desc limit 8";
			$db->query($sql);

			$result = $db->getResult();

			?>

			<div class="lastadd" >
				<div class="t">
					最近订单信息
				</div>
			 
					<table width="100%" cellspacing="0" border="0"  class="lists" >

					<tr class="h" >
						<th class="fs2 headerSort" >订单号</th>
						<th class="fs2 headerSort" >订单金额</th>
						<th class="fs2 headerSort" >下单时间</th>
						<th class="fs2 headerSort" >支付方式</th>
						<th class="fs2 headerSort" >付款状态</th>
						<th class="fs2 headerSort" >货运状态</th>
						<th class="fs2 headerSort" >订单状态</th>
						<th class="fs2 headerSort" >查看</th>
					</tr>

					<?php
					if( count($result)>0 ){	
					?>	

					<?php
					foreach( $result as $k=>$v ){
					?>
					<tr>
						<td><a href="index.php?com=orders&task=edit&id=<?php echo $v['id'];?>"><?php echo $v['order_sn'];?></a></td>
						<td>￥<?php echo $v['amount'];?></td>
						<td> <?php echo $v['created_date'];?> </td>

				<td><?php echo $pays[$v['pay']]['name'];?></td>

				<td>
				<?php 
				switch( $v['pay_status'] ){

					case '2':
							echo '已退款';
							break;
					case '1':
							echo '已付款';
							break;
					case '0':
					default:
						echo '未支付';
					 
				}

  				?>
				
			 </td>
				<td>
				<?php 
				switch( $v['ship_status'] ){

					case '2':
							echo '已退货';
							break;
					case '1':
							echo '已发货';
							break;
					case '0':
	 
						echo '未发货';
					break;
					 
				} 
 				?>
			 </td>
 
	 
				<td>
				<?php 
				switch( $v['order_status'] ){

					case 'dead':
							echo '已作废';
							break;
					case 'finish':
							echo '已完成';
							break;
					case 'active':
					default:
						echo '进行中..';
					 
				}
 				?>
				</td>



						<td><a href="index.php?com=orders&task=edit&id=<?php echo $v['id'];?>">查看</a></td>
					</tr>
					<?php 
					}
					}else{
					?> 
						<tr><td colspan=6 >没有订单信息.</td></tr>
					<?php
					}
					?>
				</table> 
				 
			</div>
 

			</td>
		</tr>
		<tr>
			<td class="company_info4"   >
				 <div >
				 技术支持：&nbsp;深圳市格力在线技术有限公司 
				 &nbsp;&nbsp;&nbsp;
				 服务电话：&nbsp;0755-2780 8888
				 </div>
				 <div>
				  网 &nbsp;&nbsp; 址：&nbsp;
				  <a href="http://www.greeonline.com" target=_blank >
				  www.greeonline.com
				  </a>
				 </div>
 				 
			</td>
		</tr>

		</table>
	</div>
	<?php /**
	<div class="cpanel" >
		<ul >
			<li class="con_mod" >
			<?php

			$modules	=& ModuleHelper::getModules('cpanel-left');
			foreach($modules as $item)
			{
				echo ModuleHelper::renderModule($item);
			}

			?>

			</li>
		</ul>
		
	</div>
	**/
	?>

	<br class="clr" />
</div>