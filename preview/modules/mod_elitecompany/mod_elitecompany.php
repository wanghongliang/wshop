<?php
global $app;

include(dirname(__FILE__).DS.'helper.php');
$lists = &modEliteCompanyHelper::getList($params);

 
?>
<div  class="mod mod_elitecompany <?php echo $params['moduleclass_sfx']?>"  id="<?php echo $module->module,'-',$module->id;?>"  >
	<dl>
		<dt>
 			<span>	
				<span class="more" >
					<a href="<?php echo $cat_link;?>" alt="更多" target=_blank >更多..</a>
				</span>
				<?php
				if( $params['titlelink'] == '1' ){
				?>
					<a href="<?php echo $cat_link;?>" target=_blank alt="<?php echo $module->title;?>" ><?php echo $module->title;?></a>
				<?php
				}else{
				?>
					<span class="a"><?php echo $module->title;?></span>
				<?php
				}
				?>
			</span>
		</dt>
		<dd>
		<div class="mod_header" >
			<span class="db-fr" >诚信积分</span>
			<span class="db-fl" >公司名称</span>
		</div>
 		<?php 
		 if( is_array( $rows = $lists['rows'] ) )
		 {
			 ?>
			 <ul>
			 <?php
			 foreach( $rows as $row )
			 {
				 ?>
				 <li>
				 <a href="<?php echo $app->buildMemberLink( $row->username );?>" target=_blank >
					<?php echo $row->company_name;?>
				 </a>
				 </li>
				 <?php
			 }
			?>
			</ul>
			<?php
		 }
		?>
   		</dd>
	</dl>
</div>