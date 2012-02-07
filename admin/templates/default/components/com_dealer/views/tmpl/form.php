<?php
 
$session= &Factory::getSession();
//省市分类
$province = $this->get('province');
?>

<div style="padding:2px 10px; " >



<div class="editor-tabs" >
	<ul class="switch_btn" >
		<li class="active" >基本信息</li>
		<li>详细联系信息</li> 
		<li >公司信息</li>
	</ul>
</div>

<form action="<?php echo $this->baseuri;?>&no_html=1"  method="post"  id="menage_form"  > 
	<ul class="switch_con" >
	<li class="con active" > 
	<table class="formtable" >  

		<tr >
			<td class="form_text" >经销商所在区域</td>
			<td>
				<?php
				//print_r($province);
				?>
				<select id="chinacomprovince"  class="inputh input_require" name="province" onchange="setCity(this.value,'chinacomcity');" >
				<option value="">--请选择省份--</option>
				<?php

				$cCity = array();
				foreach( $province as $p ){	
					
					if( $item['province']>0 && $item['province'] == $p['parent_id'] ){
						$cCity[] = $p;
					}
					if( $p['parent_id']>1 ){ continue;}
					?>
					<option value="<?php echo $p['id'];?>"
					
					<?php
					if( $p['id'] == $item['province'] ) echo ' selected ';	

				
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
						if( $c['id'] == $item['city'] ) echo ' selected ';	

					
						?>
						><?php echo $c['name'];?></option>
						<?php
						}
					}
					?>
				</select>
			</td>
		</tr>
		<tr >
			<td class="form_text" >账号:</td>
			<td>
				<input type="text" id="username"  name="username" size=30 value="<?php echo $item['username'];?>" readonly />
			</td>
		</tr>
		<tr  >
			<td class="form_text" >新密码:</td>
			<td>
				<input type="password"  name="password" size=30 value="" />
			</td>
		</tr>
		<tr  >
			<td class="form_text" >重新输入密码:</td>
			<td>
				<input type="password"  name="repassword" size=30 value="" />
			</td>
		</tr>
		<tr  >
			<td class="form_text" >所属组:</td>
			<td>
				<?php echo 	$pid;?>
			</td>
		</tr>
 
		<tr  >
			<td class="form_text" >E-mail:</td>
			<td>
				<input type="text" id="email"  name="email" size=30 value="<?php echo $item['email'];?>" />
			</td>
		</tr>

		<tr   >
			<td class="form_text" >是否锁定</td>
			<td>
				<input type="radio" id="block"  name="block"  value="1" <?php echo $item['block']==1?'checked':''; ?> /> 锁定

				<input type="radio" id="block"  name="block"  value="0" <?php echo $item['block']==0?'checked':''; ?> /> 打开
			</td>
		</tr> 
	</table>
	</li>
	<li class="con" >
<table class="formtable" >
 

		<tr >
			<td class="form_text" >性 别</td>
			<td>
				<input type="radio" name="sex" value="1" <?php echo $item['sex']==1?'checked':'';?> />男

				<input type="radio" name="sex" value="2"  <?php echo $item['sex']==2?'checked':'';?> />女

				<input type="radio" name="sex" value="0"  <?php echo $item['sex']==0?'checked':'';?>  />保密
			</td>
		</tr>


		<tr >
			<td class="form_text" >生　日</td>
			<td>
				<?php
				$year = 1967;
				$month = 12;
				$day = 31;
				
				?>
				<select name="year" >
				<?php
				$y=(int)date('Y');
 				for(; $year<=$y; $year++){
					?>
					<option value="<?php echo $year;?>" 
					<?php
					if( $year == $item['year'] ) echo ' selected ';	
					?>
					><?php echo $year;?></option>
					<?php
				}
				?>
				</select>
				年


				<select name="month" >
				<?php
  				for($i=1; $i<=$month; $i++){
					?>
					<option value="<?php echo $i;?>" 
					<?php
					if( $i == $item['month'] ) echo ' selected ';	
					?>
					><?php echo $i;?></option>
					<?php
				}
				?>
				</select>
				月


				<select name="day" >
				<?php
  				for($i=1; $i<=$day; $i++){
					?>
					<option value="<?php echo $i;?>"
					<?php
					if( $i == $item['day'] ) echo ' selected ';	
					?>
					><?php echo $i;?></option>
					<?php
				}
				?>
				</select>
				日

			</td>
		</tr>

  
		<tr >
			<td class="form_text" > 个人介绍</td>
			<td>
				 <textarea cols=60 rows=6 name=intro ><?php echo $item['intro'];?></textarea>
			</td>
		</tr>

 
		<tr >
			<td class="form_text"  >
 				<b>联系方式</b>
 			</td>
			<td style=" border-bottom:1px solid #f0f0f0;"  >
			<SPAN style="color:red;" > </SPAN>
			</td>
		</tr>
 

		<tr >
			<td class="form_text" >联系人</td>
			<td>
				<input type="text" id="model"  class="ftext" name="contact_name" size=30 value="<?php echo $item['contact_name'];?>" />
 
			</td>
		</tr>
		<tr >
			<td class="form_text" >手机号码</td>
			<td>
				<input type="text" id="brand"  class="ftext" name="mobile" size=30 value="<?php echo $item['mobile'];?>" />
 
			</td>
		</tr>

		<tr >
			<td class="form_text" >固定电话</td>
			<td>
				<input type="text" id="model"  class="ftext" name="phone" size=30 value="<?php echo $item['phone'];?>" />
 
			</td>
		</tr>
		<tr >
			<td class="form_text" >通信地址</td>
			<td>
				<input type="text" id="brand"  class="ftext" name="address" size=50 value="<?php echo $item['address'];?>" />
 
			</td>
		</tr>
		<tr >
			<td class="form_text" >邮　编</td>
			<td>
				<input type="text" id="brand"  class="ftext" name="zip" size=30 value="<?php echo $item['zip'];?>" />
 
			</td>
		</tr>
	</table>



	</li>
	<li class="con" >
	<table class="formtable" >  
 
		<tr  >
			<td class="form_text " >公司名称</td>
			<td >
				<input type="text" class="ftext"  name="c_name" size=50 value="<?php echo $item['c_name'];?>" />
			</td>
		</tr>


		<tr  >
			<td class="form_text" >联系人</td>
			<td>
				<input type="text"   class="ftext"  name="c_contact_name" size=50 value="<?php echo $item['c_contact_name'];?>" />
			</td>
		</tr>

 
 		<tr   >
			<td class="form_text" >联系人职位</td>
			<td>
				<input type="text"  class="ftext"   name="c_contact_jobs" size=50 value="<?php echo $item['c_contact_jobs'];?>" />
			</td>
		</tr>


		<tr  >
			<td class="form_text" >联系电话</td>
			<td>
				<input type="text" class="ftext"   name="c_phone" size=50 value="<?php echo $item['c_phone'];?>" />
			</td>
		</tr>
 
		
		<tr  >
			<td class="form_text" >传真</td>
			<td>
				<input type="text" lass="ftext"  name="c_fax" size=50 value="<?php echo $item['c_fax'];?>" />
			</td>
		</tr>
 		<tr  >
			<td class="form_text" >公司地址</td>
			<td>
				<input type="text" class="ftext"  name="c_address" size=50 value="<?php echo $item['c_address'];?>" />
			</td>
		</tr>
 		<tr  >
			<td class="form_text" >公司网址</td>
			<td>
				<input type="text" class="ftext" name="c_http" size=50 value="<?php echo $item['c_http'];?>" />
			</td>
		</tr>
		
 

	</table>
	</li>
</ul>

	<div class="formbtn" >
			<input type="button"  value="提交"  class="submit_btn" />
			<input type="button" class="apply_btn" value="应用" />
			<input type="button"   class="btn"  id="cancel_btn"  value="取消" />
			<input type="hidden" value="<?php echo $item['module'];?>" name="module" id="module" />

			<input type="hidden" value="save2" name="task" id="task" />
			<input type="hidden" value="<?php echo $item['id'];?>" name="id" />
			<input type="hidden" value="<?php echo $this->menuid;?>" name="menuid" />
			<input type="hidden" value="" name="return" id="return"  />
	</div>
</form>

</div>


<script language="javascript" >
	var url_current ='<?php echo URI::current();?>';
 	$(function(){ 
		$('.submit_btn').click(function(){	
			
			if( check() ){
				$('#menage_form').get(0).submit();
			}
			
		}); 
		$('.apply_btn').click(function(){	
			if( check() ){
			$('#return').attr('value',url_current);
			$('#menage_form').get(0).submit();
			}
		});
		$('#cancel_btn').click(function(){	
			parent.$.w.closeDialog();
 		});
	});
	
	function check(){
		if( $('input[name=password]').val() != $('input[name=repassword]').val() ){
			alert(' 两次密码输入不一致! ');
			return false;
		}

		return true;

	}
	//市的数组
	var area=[
	<?php
		$n = count($province)-1;
		foreach( $province as $k=>$v ){
			if( $v['parent_id']>1){
				echo '['.$v['id'].',"'.$v['name'].'",'.$v['parent_id'].']';
				if( $k<$n ){ 
					echo ',';
				}
			}
		}
	?>
	];

	function setCity(id,idname)
	{
		var n=area.length;
		var select = $('#'+idname).get(0);
		select.length=0;
		var x=0;
		for(i=0;i<n;i++){
			if( area[i] ){
				if( area[i][2] == id ){
					select.options[x++]=new Option(area[i][1],area[i][0]);
				}
			}
		}

		//alert(x);
		if( x==0 ){
			$(select).hide();
		}else{
			$(select).show();
		}
	}

</script>