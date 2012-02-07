<?
include($this->path.DS.'tmpl'.DS.'toolbar_form_component.php');
?>
<form action="<?php echo $this->baseuri;?>"  method="post"  id="menage_form" name="listform"  >

<div class="comment" >
	<b><?php echo $item['author'];?></b>
	于  <?php echo date('Y-m-d H:i:s',$item['created']);?> 对 <b><?php echo $item['product_name'];?></b> 的商品咨询
	<div>
		<?php echo $item['content'];?>
	</div>
	<div class="comment_foot" >
		<b>IP 地址：<?php echo $item['ip_address'];?></b>
		<?php if( $item['published'] == '1' ){ ?>
		已显示
		<?php }else{ ?>
		禁止显示 
		<?php } ?>
	</div>
	 
	<?php 
	
	if( is_array($replay) && count($replay)>0 ){
		?>
 

		<div class="re" >
		<ul >

		<?php
		foreach( $replay as $re ){
			?>
			<li>
				管理员 <?php echo $re['author'];?> 于 <?php echo date('Y-m-d H:i:s',$re['created']);?> 回复<br/>
				<?php echo $re['content'];?>
			</li>
			<?php

		}
		?>
		</ul>
		</div>
		<input type="hidden" value="<?php echo $replay[0]['comment_id'];?>" name="reply_id" />
		<?php
	}
	?>	
</div>

<?php
$user= $this->get('user');

?>
	<table class="formtable"  >

		<tr class="style1" >
			<th   colspan=2 >
			回复评论
			</th>
		</tr>
 
		<tr  >
			<td class="form_text" >回复:</td>
			<td>
				<textarea cols=60 rows=6 name="reply_content" ><?php echo $re['content'];?></textarea>
			</td>
		</tr>
		<tr  >
			<td class="form_text" >用户名:</td>
			<td>
				<input type="text" name="reply_name" size=30 value="<?php echo $user['username'];?>" readonly />
			</td>
		</tr>
 
 		<tr  >
			<td class="form_text" >E-mail:</td>
			<td>
				<input type="text" id="release_date"  name="reply_email" size=30 value="<?php echo $user['email'];?>" readonly />
			</td>
		</tr>

	</table>
		


		<input type="hidden" value="save" name="task" id="task" />
		<input type="hidden" value="reply_date" name="reply_date" id="reply_date" />
		<input type="hidden" value="<?php echo $item['comment_id'];?>" name="id" />
		<input type="hidden" value="<?php echo $item['products_id'];?>" name="products_id" />
		<input type="hidden" value="" name="return" id="return"  />

		<div class="formbtn" >
			<input type="button" class="submit_btn" value="保存"/>
			<input type="button" class="apply_btn" value="应用" />
			<input type="reset" class="cancel_btn" value="取消" />
		</div>
</form>


<script language="javascript" >
 	$(function(){
		$('.submit_btn').click(function(){
 			$('#menage_form').get(0).submit();
			return true;
 		});

		$('.apply_btn').click(function(){	
			$('#return').attr('value','<?php echo URI::current();?>');
			$('#menage_form').get(0).submit();
 		});

		$('.cancel_btn').click(function(){	
			location.href='index.php?com=products_comment<?php if( $_REQUEST['tmpl']== 'component' ){ echo "&tmpl=component";}?>';
 		});
	});
</script>