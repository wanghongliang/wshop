	<?php	//模块列表						?>
	<div class="module_list"  >
	<div class="m_title" >已安装模块</div>
	<div class="m_body"  >
	<ul id="exists_module" >
		<?php
		if( is_array(  $modules_list ) ){
			foreach( $modules_list as $module )
			{
				?>
					<li>
					

						<a href="#" >
							<input type="checkbox" class="md" name="<?php echo $module['module'];?>" value="<?php echo $module['id'];?>"
							<?php 
							if( $module['published'] == '1' ){
								echo 'checked';
							}
							
							?>
							onclick="javascript:toggleM('<?php echo $module['module'];?>-<?php echo $module['id'];?>','<?php echo $module['position'];?>',this)";
							/>
						</a>
					 
						<?php echo $module['title'];?>
						
					</li>
				<?
			}
		}else{
			
		}
		?>
	</ul>
	</div>
 </div>

 <div class="module_type" >
 	<div class="m_title" >推荐模块</div>
	<div class="m_body" >
		<ul >
		<?php
		if( is_array(  $modules ) ){
			foreach( $modules as $module )
			{
				?>
					<li>
						<?php echo $module['title'];?>
						&nbsp;

						<a href="javascript:openCreateMD('<?php echo $module['name'];?>')" >
						添加
						</a>
					</li>
				<?
			}
		}else{
			
		}
		?>
	</ul>
	</div>
 </div>
<?php //完成 ?>
