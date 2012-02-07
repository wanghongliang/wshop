		<table cellspacing="0" cellpadding="0" border="0" width="100%" class="paytab" >
        <tbody> 
 		<?php
		$defaultArea = explode(',',$_REQUEST['addr']);

 
		//货运方式
		$shipping = $this->get('shipping');
		$shipping_free = 0; //当前的货运费用
		$i=0;
		foreach( $shipping as $k=>$row ){
			$free = 0;
			$v  = $row[0];

			//相关配置项
			$cg = unserialize($v['cg']);
	
			//指定配送地区和费用
			if( $cg['setting'] == 'setting_sda' ){
				//查找配置的地区价格
				foreach( $row as $x=>$y ){
					$aids = explode(',',$y['areaid_group']); 
					//找到后计算价格
					if( in_array( $defaultArea[2],$aids ) || in_array( $defaultArea[1],$aids ) || in_array( $defaultArea[0],$aids ) ){
						$config = unserialize($y['config']);
						$free = $config['firstFee'];
					}
				}

				//是否设定当前城市的货运价格
				if( $free == 0 ){  
					if( $cg['defAreaFee'] != 1 ){ continue; }
					$free = $cg['firstprice']; 
 				 }
			}else{
				$free = $cg['firstprice'];
			} 
		?>

		<tr>
		  <td align="left" width="24%" valign="middle">
			<input type="radio"   onclick="selectShipping(this)" <?php if( $i++==0 ){ $shipping_free=$free; echo ' checked '; } if( $v['has_cod']==1 ){ echo ' has_cod=1 '; }?>  value="<?php echo $v['id'];?>" name="shipping"  > <b>
			<label for="wangyin"><?php echo $v['name'];?></label> 
			</b>
			</td>
		  <td align="left" width="38%" valign="middle"><?php echo $v['desc'];?>	</td>
		  <td align="left"  valign="middle">费用： <font style="color:red;font-size:14px;" > <span class="price" ><?php echo Utility::price_format($free);  ?></span> 元</font></td>
		</tr> 
		<?php } ?> 
      </tbody>
</table>