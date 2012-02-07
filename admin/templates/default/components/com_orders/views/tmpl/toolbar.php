<?php

?>

<?php

?>
<div class="toolbar" >

<ul class="com_ com_contents">
 
	<li class="active_li" >订单管理</li>

</ul>

<div class="clr" ></div>
<div class="tackle" >

	<ul class="tools" >	
 
		<li   > 
			<a href="javascript:delall('<?php echo $this->baseuri;?>&task=deleleall')"   class="btn_delele"  >
			删除
			</a>
		</li>
	 



	</ul>

	<div class="filter" >

 		<div class="db-fl " >
		 &nbsp;订单号：
		<input type="text" name="key" value="<?php echo  $lists['key'];?>" size=10 />

		 &nbsp;时间:
		<input type="text" name="t_begin" value="<?php echo  $lists['t_begin'];?>" id="t_begin" size=10  onclick="return showCalendar('t_begin', '%Y-%m-%d', '24', false,'t_begin' );"  />
		到
		<input type="text" name="t_end" value="<?php echo  $lists['t_end'];?>" id="t_end" size=10 onclick="return showCalendar('t_end', '%Y-%m-%d', '24', false,'t_end' );"  />

		<input type="button" value="搜索" onclick="submitForm()" id="sbutton" class="sbutton"/>
		<input type="button" value="清空" onclick="$('input[name=key]').attr('value','');$('input[name=t_begin]').attr('value','');$('input[name=t_end]').attr('value','');submitForm()" class="sbutton"/>
		</div>

	</div>
	<div class="clr" ></div>
</div>
</div>
 
<div class="subbar" >
<ul>
	<li class="<?php if( $_REQUEST['s'] == 1 ){ ?> active_li <?php }else{ ?> normal_li <?php } ?>" >
	<a href="<?php echo $this->baseuri;?>&s=1" >全部订单( <?php echo $status[0];?> )</a>
	</li>

	<li class="<?php if( $_REQUEST['s'] == 2 ){ ?> active_li <?php }else{ ?> normal_li <?php } ?>" >
	<a href="<?php echo $this->baseuri;?>&s=2" >未处理( <?php echo $status[2];?> )</a>
	</li>

	<li class="<?php if( $_REQUEST['s'] == 3 ){ ?> active_li <?php }else{ ?> normal_li <?php } ?>" >
	<a href="<?php echo $this->baseuri;?>&s=3" >已付款待发货( <?php echo $status[3];?> )</a>
	</li>

	<li class="<?php if( $_REQUEST['s'] == 4 ){ ?> active_li <?php }else{ ?> normal_li <?php } ?>" >
	<a href="<?php echo $this->baseuri;?>&s=4" >已发货( <?php echo $status[4];?> )</a>
	</li>

	<li class="<?php if( $_REQUEST['s'] == 5 ){ ?> active_li <?php }else{ ?> normal_li <?php } ?>" >
	<a href="<?php echo $this->baseuri;?>&s=5" >已完成( <?php echo $status[5];?> )</a>
	</li>

 	<li class="<?php if( $_REQUEST['s'] == 7 ){ ?> active_li <?php }else{ ?> normal_li <?php } ?>" >
	<a href="<?php echo $this->baseuri;?>&s=7" >已退款( <?php echo $status[7];?> )</a>
	</li>

	<li class="<?php if( $_REQUEST['s'] == 8 ){ ?> active_li <?php }else{ ?> normal_li <?php } ?>" >
	<a href="<?php echo $this->baseuri;?>&s=8" >已退货( <?php echo $status[8];?> )</a>
	</li>

	<li class="<?php if( $_REQUEST['s'] == 9 ){ ?> active_li <?php }else{ ?> normal_li <?php } ?>" >
	<a href="<?php echo $this->baseuri;?>&s=9" >已作废( <?php echo $status[9];?> )</a>
	</li>

</ul>
</div>