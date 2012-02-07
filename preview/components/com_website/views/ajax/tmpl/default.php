<?php
$status = $this->lists['status'];
$row = $this->lists['row'];

$group = $this->lists['group'];
?>
<div  class="db-mt5"  >
	<dl>
		<dt>
 

		</dt>
		<dd>
			<?php
			switch($status){
				case 1:
					?>
					<div >
					<span class="label" > 收藏名称：</span>
					<input type="text" class="fname" name="name" size=30 value="<?php echo $row['name'];?>" />
					
					<br/>
					<span class="label" >网址：</span>
					<input type="text" class="fhttp" name="http" size=30  value="<?php echo $row['http'];?>" />


					<br/>
					<span class="label" >分组：</span>
					<select name="tid" class="ftid"  >
						<?php
						foreach( $group as $g ){
						?>
						<option value="<?php echo $g['id'];?>" ><?php echo $g['name'];?></option>
						<?php
						}
						?>
					</select>
					<span   >新建分组：</span>
					<input type="text" name="fnt" class="fnt" value="" size=12 />
					</div>
					
					<div class="button" >
						<input type="hidden" value="<?php echo $_GET['id'];?>" class="id"  >
						<input type="hidden" value="<?php echo $_REQUEST['type'];?>" name="type" class="type" >
						<input type="hidden" value="<?php echo $row['thumbnail'];?>" name="thumb" class="thumb" >
						<input type="button" value="确定" onclick="saveFav()"  >
						<input type="button" value="取消"  onclick="closeDialog()" >
					</div>
					<?php
					break;
				case 2:
					$session = &Factory::getSession();
					$username = $session->get('username');
					?>
					<DIV style="padding:30px;text-align:center;" >
					您已经收藏过！ 					
					 <a href="/china/index.php/<?php echo $username;?>" target=_blank ><u><font color=red>查看/编辑</font></u>	
					</a>
					</DIV>
					<?php
					break;
				default:
					?>
					登陆会员后，可以定义<font color=red>个性的</font>网站收藏导航！
					<br/>
					<a href="/index.php?com=users&view=login" target=_blank >
					<u><font color=red>会员登陆</font></u>
					</a>
					&nbsp;&nbsp;
					<a href="/index.php?com=users&view=user&layout=registor" target=_blank >
					<u><font color=red>马上免费注册会员!</font></u>	
					</a>

					<?php
			}
			?>
			


			<div class="clr" ></div>
 		</dd>
	</dl>
</div>