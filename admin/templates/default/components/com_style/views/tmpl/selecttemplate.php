<script language="javascript" >
	function changeT(name,obj)
	{
		parent.changeTemplate(name);
		$('.img').removeClass('default');
		$(obj).find('.img').addClass('default');
	}

	//查到当前选择的模板
	function getTemplate()
	{
		return $('.default').attr('id');
	}

</script>

<div class="template_list"  >
	<div class="m_title" >请选择模板样式</div>
	<div class="m_body"  >

	<table border=0 >	
	<tr  >		

	<?php 

 	if( is_array($list) ){
		$i = 0;

		$input_orderings = '';	//当前列表的排序值
		foreach($list as $k=>$row )
		{
			$input_orderings.=','.$row['ordering'];

			if( $i++%6==0 && $i>1 ){
				echo '</tr><tr>';
			}
		?>
				<td>
					<div class="template" onclick="changeT('<?php echo $row['name'];?>',this);" >
						<div class="img <?php if( $row['default'] == 1 ){ 
							echo ' default '; }?>" 

							id="<?php echo $row['name'];?>" 
						>

						<img src="/<?php echo $GLOBALS['config']['preview_directory'];?>/templates/<?php echo $row['name'];?>/thumbnail.gif" width=110 height=110  />

						</div>

						<div>
						<?php 

							echo $row['title'];
						
						?>
						</div>
					</div>
				</td>
 		 
			
		<?

			$i = 1-$i;
		}
	}
	?>
	</tr>

	<tfoot>
	<tr>
		<td colspan=9 >
		<?php //echo $nav->showFilePage2();?>
		</td>
	</tr>
	</tfoot>

</table>

	</div>
 </div>

