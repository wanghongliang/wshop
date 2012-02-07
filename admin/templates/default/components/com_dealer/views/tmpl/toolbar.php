<?php

?>

<div class="toolbar" >

	<ul class="com_ com_contents" >	
	<li   class='active_li'  > 
		经销商会员管理
	</li>  
	</ul>
<div class="clr" ></div>	
<div class="tackle" >
	
	<ul class="tools">
	<li  class="createbtn btn_add" > 
		<a href="<?php echo $this->baseuri;?>&task=add"    >
		添加
		</a>
	</li> 
	<li> 
		<a   href="javascript:setdefault('<?php echo $this->baseuri;?>&task=setdefault')"  class="btn_default" > 设为默认 </a>
	</li>
		<li  >
			<a href="javascript:href('<?php echo $this->baseuri;?>&task=unlock')"  class="btn_unlock"  >
			 解锁
			</a>
		</li>
		<li   >
			<a href="javascript:href('<?php echo $this->baseuri;?>&task=lock')"  class="btn_lock"  >
			 锁定
			</a>
		</li>

	<li class="createbtn btn_add" > 
		<a href="javascript:href('<?php echo $this->baseuri;?>&task=deleleall')"  >
		删除
		</a>
	</li>
</ul>

	<div class="filter" >

		<div class="db-fl db-pl5" >
 
				<select id="chinacomprovince"  class="inputh input_require" name="province" onchange="setCity(this.value,'chinacomcity');" >
				<option value="">--请选择省份--</option>
				<?php
				$city =  $_REQUEST['city'];
				$pro  = $_REQUEST['province'];

				$cCity = array();
				foreach( $province as $p ){	
					
					if( $pro>0 && $pro == $p['parent_id'] ){
						$cCity[] = $p;
					}
					if( $p['parent_id']>1 ){ continue;}
					?>
					<option value="<?php echo $p['id'];?>"
					
					<?php
					if( $p['id'] == $pro ) echo ' selected ';	

				
					?>
					><?php echo $p['name'];?></option>
					<?php
				}
				?>
				</select>
				

				<?php
				//print_r($cCity);
				?>
				<select  name="city" class="inputh" id="chinacomcity">
					
					<option value="">请选择城市</option>
					<?php 
					if( count($cCity) > 0 ){
						foreach( $cCity as $c ){
						?>
						<option value="<?php echo $c['id'];?>"
						
						<?php
						if( $c['id'] == $city ) echo ' selected ';	

					
						?>
						><?php echo $c['name'];?></option>
						<?php
						}
					}
					?>
				</select>
 
		 &nbsp;账号：
		<input type="text" name="key" value="<?php echo  $lists['key'];?>" size=10 />
		<input type="button" value="搜索" onclick="submitForm()" class="sbutton"/>
		<input type="button" value="清空" onclick="$('input[name=key]').attr('value','');submitForm()" class="sbutton"/>
		</div>

	</div>



<div class="clr" ></div>
</div>
</div>



