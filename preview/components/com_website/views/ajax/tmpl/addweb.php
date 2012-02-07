 <div class="form_border" >

<table class="formtable" >
	<tr >
		<td class="form_text" >
			<span class="asterisk">*</span>网站名称</td>
		<td>
			<input type="text" id="name"  class="ftext" name="name" size=50 value="<?php echo $item['name'];?>" />

		</td>
		<td rowspan=9 >
		<?php
		$session = &Factory::getSession();
		$userid = $session->get('uid');

		if( $userid > 0 ){
		?>
		<div class="reg_guide" >
		收藏、点评网站，我们一起设计分享... 
		<br/>
		发布网站，加2个积分.
		</div>
		<?php
		}else{
		?>
			<div class="reg_guide" >
			<a href="/?com=users&view=user&layout=registor" target=_blank  >
			免费注册会员</a>
			&nbsp;
			<a href="/?com=users&view=login" target=_blank  >
			会员登陆
			</a>
			<br/>
			收藏、点评网站，我们一起设计分享... 
			</div>
		<?php
		}
		?>
		</td>
	</tr>
	<tr >
		<td class="form_text" ><span class="asterisk">*</span>网址</td>
		<td>
			<input type="text" id="http"  class="ftext" name="http" size=50 value="<?php echo $item['http'];?>" />

		</td>
	</tr>
	<tr>
		<td class="form_text" ><span class="asterisk">*</span>类别</td>
	<td>
		<select id="cat" size=1 style="width:200px;" class="inputh input_require" name="catid"  >
		<option value="">--请选择--</option>
		<?php
		foreach( $cats as $p ){
			?>
			<option value="<?php echo $p['id'];?>" <?php if( $p['id']==$item['catid']){ echo ' selected '; }?> ><?php echo $p['name'];?></option>
			<?php
		}
		?>
		</select>
		

	  </td>
	</tr>


	<tr>
		<td class="form_text" ><span class="asterisk"> </span>地域分类</td>
	<td>
			
		<select name="areaid" >
		<?php 
		$areaid=$item['areaid']?$item['areaid']:5;
		foreach( $areas as $k=>$v ){
				echo '<option value="'.$k.'" ';
				if( $areaid  == $k ){
					echo ' selected ';
				}
				echo '>'.$v.'</option>';
		}?>
		</select>
	</td>
	</tr>


	<tr>
		<td class="form_text" ><span class="asterisk"> </span>专题分类</td>
	<td>
			
		<select name="topicid" >
		<?php 
		$topicid=$item['topicid']?$item['topicid']:4;
		foreach( $topics as $k=>$v ){
				echo '<option value="'.$k.'" ';
				if( $topicid == $k ){
					echo ' selected ';
				}
				echo '>'.$v.'</option>';
		}?>
		</select>
	</td>
	</tr>


	<tr>
		<td class="form_text" ><span class="asterisk"> </span>颜色分类</td>
	<td>
			
		<select name="colorid" >
		<?php 
		$colorid=$item['colorid']?$item['colorid']:9;
		foreach( $colors as $k=>$v ){
				echo '<option value="'.$v['id'].'" ';
				if( $colorid == $v['id'] ){
					echo ' selected ';
				}
				echo '>'.$v['text'].'</option>';
		}?>
		</select>
	</td>
	</tr>
	<tr>
		  <td class="form_text" > <span class="asterisk"> </span>标签 </td>
		  <td class="fieldinfo"><span class="info"></span>
			
			<input name="key1" size="15" value="<?php echo $lists['keys'][0]['tag']; ?>" maxlength="20" class="ftext" type="text">
			 <input name="key2" size="15" value="<?php echo $lists['keys'][1]['tag']; ?>" maxlength="20" class="ftext" type="text">
			 <input name="key3" size="15" value="<?php echo $lists['keys'][2]['tag']; ?>" maxlength="20" class="ftext" type="text">
			</td>
	</tr>
	<tr >
		<td class="form_text" ><span class="asterisk">&nbsp;</span>图片</td>
		<td>
			 <span id="filespan">
			 <input type="file" id="file" name="file" /> 
			  <span id="msg"></span>
			</span>
		</td>
	</tr>

	<tr>
		<td class="form_text" > <span class="asterisk"> </span>点评 </td>
		<td class="fieldinfo">
		<textarea cols=45 rows=6 class="remark" name="remark" ></textarea>
		</td>
	</tr>
	<tr>
	<td>
	</td>
	<td   >

		<input  type="button" onclick="return ajaxaddweb();" class="submit_btn btn_save"  
		value="保存"
		/>
		<input  onclick="closeDialog();"  type="button" class="cancel_btn btn_cancel"  
		value="取消"
		/>
	</td>
	</tr>
</table>
</div>
 
 