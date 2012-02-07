<div class="select_module" >
	<ul>
		<?php
		if( is_array(  $modules ) ){
			foreach( $modules as $module )
			{
				?>
					<li>
						<input class="module" type="radio" name="module" value="<?php echo $module['name'];?>" > 
						<?php echo $module['title'];?>
					</li>
				<?
			}
		}else{
			
		}
		?>
	</ul>
	<br class="clr" />
</div>

 <script language="javascript" >
 
	 $('.module').click(function(){

		location.href=('<?php echo $this->baseuri;?>&tmpl=component&task=add&select='+this.value);
 	 });
 
</script>