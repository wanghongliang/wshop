<?php
//print_r($this->info);
?>
<div class="right_top" >
<h2  >编辑个人资料</h2><span class="goon_btn"><a title="首页" href="./" style="color: rgb(255, 255, 255);">继续购物</a></span>
</div> 
 
<div class="ubox">

<?php
$msg = $app->getMsg(); 
if( $msg )
{  echo $msg; 
}  
?>



<form onsubmit="return checkregform(this);" href="#" name="form_reg" method="post">

<table width="670" cellspacing="5" cellpadding="0" border="0"  class="ftable" style="margin: 30px auto 15px;"> 
	<tr>
		<td  class="ft" >昵称：</td>
		<td>
			<input type="text" value="<?php echo $this->info['nickname'];?>" class="input_02" maxlength="50" size="30" name="nickname">
		</td>
	</tr>
	<tr>
		<td  class="ft" >居住地：</td>
		<td>
			<input type="text" value="<?php echo $this->info['address'];?>" class="input_02" maxlength="50" size="30" name="address">
		</td>
	</tr>
	<tr>
		<td  class="ft" >邮政编码：</td>
		<td>
			<input type="text" value="<?php echo $this->info['zip'];?>" class="input_02" maxlength="50" size="30" name="zip">
		</td>
	</tr>
	<tr>
		<td  class="ft" >E-mail：</td>
		<td>
			 <?php echo $this->info['email'];?> 
		</td>
	</tr>
 
 		<tr >
			<td class="ft" >性 别：</td>
			<td>
				<input type="radio" name="sex" value="1" <?php echo $this->info['sex']==1?'checked':'';?> />男

				<input type="radio" name="sex" value="2"  <?php echo $this->info['sex']==2?'checked':'';?> />女

				<input type="radio" name="sex" value="0"  <?php echo $this->info['sex']==0?'checked':'';?>  />保密
			</td>
		</tr>

	<tr >
			<td  class="ft">生　日：</td>
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
					if( $year == $this->info['year'] ) echo ' selected ';	
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
					if( $i == $this->info['month'] ) echo ' selected ';	
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
					if( $i == $this->info['day'] ) echo ' selected ';	
					?>
					><?php echo $i;?></option>
					<?php
				}
				?>
				</select>
				日

			</td>
		</tr> 

	<tr>
		<td  class="ft" >手机：</td>
		<td>
			<input type="text" value="<?php echo $this->info['mobile'];?>" class="input_02" maxlength="50" size="30" name="mobile">
		</td>
	</tr>
	<tr>
		<td  class="ft" >固定电话：</td>
		<td>
			<input type="text" value="<?php echo $this->info['phone'];?>" class="input_02" maxlength="50" size="30" name="phone">
		</td>
	</tr>
	<tr>
		<td  class="ft" >个人简介：</td>
		<td>
			<textarea style="width: 398px; height: 110px;" class="input_02" name="intro"><?php echo $this->info['intro'];?></textarea>
		</td>
	</tr>
	<tr>
			<td >&nbsp;</td>
			<td height="60">
				<input type="hidden" name="task" value="edit" />
				<input type="hidden" name="act2" value="save" />
				<input type="submit" class="u_btn" value="保存修改">
			</td>
		</tr>
</tbody></table>
</form>

</div>


<script language="javascript" >
function checkregform(obj){
 
}
</script>