<?
include($this->path.DS.'tmpl'.DS.'toolbar.php');
?>
<form action="index.php?com=languages" method="post" name="listform">

<table class="moveordertable listtable"  >
	<thead>
		<tr> 
 			<?php
			$count = count( $this->rows );
			
			$params_count =count(unserialize($this->rows[0]['params']));;
			
			$params = array();
			foreach( $this->rows as $k=>$row )
			{
				$params[$row['ordering']] = unserialize($row['params']);
				?>
				<th <?php if( $k==0 ){?> width=140 <?php } ?> >
					<?php echo $row['name'];?>
				</th>
				<?php
			}
			?>
			<th >操作</th>
		</tr>
	</thead>

	<?php 
  	if( is_array($this->rows) ){
		$i = 0;

 		for($b=0;$b<$params_count;$b++)
		{
 		?>
			<tr class="trbg1" >		
 
				<?php
				for( $a=0;$a<$count;$a++){
					?>
					<td>
					<input type="text" name="lan_<?php echo $a;?>[]" value="<?php echo $params[$a+1][$b];?>" /> 
					</td>
					<?php
				}
				?>
 				<td>
				 <span class="add" onclick="addTR(this)" > +</span>
				 <span class="removeTR" onclick="removeTR(this)" > -</span>
				</td>
 

		 
			</tr>
		<?

			$i = 1-$i;
		}
	}
	?>
	<tfoot>
	<tr>
		<td colspan=9 >
		<?php //echo $nav->showFilePage2();?>
		</td>
	</tr>
	</tfoot>

</table>
<input type="hidden" name="com" value="<?php echo $_REQUEST['com'];?>" />
<input type="hidden" name="task" value="save" />

<input type="hidden" name="input_ordering" value="<?php echo substr($input_orderings,1);?>" />

</form>

 <script language="javascript" >

 //点保存按钮
$('.submit_btn').click(function(){
    $('form').get(0).submit();
});


	function addTR(obj){
		var tr = $(obj.parentNode.parentNode).clone();
		$(tr).insertBefore($(obj.parentNode.parentNode));
 	}

	function removeTR(obj){
		//移除按钮
 		$(obj.parentNode.parentNode).remove();
	}
</script>

<style type="text/css" >
input[type=text]{
	border:1px solid #ddd;
 	height:20px;
}
.add,.removeTR{
	font-size:18px;
	cursor:pointer;
}
</style>