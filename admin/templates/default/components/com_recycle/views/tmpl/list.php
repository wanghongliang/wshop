<?
import('html.html');

//include($this->path.DS.'tmpl'.DS.'toolbar.php');
?>
<form action="<?php echo $this->baseuri;?>" method="post" name="listform" >
 
<ul class="recycle_list" >

	<?php 

 	if( is_array($this->rows) ){
		$i = 0;

 		foreach($this->rows as $k=>$row )
		{
		?>
			 <li>
				<?php
			
				echo $row['name'];
				?>

				<?php
				echo $row['count'];
				?>
				
				<div class="db-fs12" >
 					全部清空
					
					<div>

						<a href="javascript:v();" class="v" url="index.php?com=<?php echo $row['option'];?>&tmpl=component&menuid=0&task=recycle"  >恢复</a>
					</div>
				</div>
			 </li>
		<?

			$i = 1-$i;

		}
	}
	?>

</ul>
				<?php
				echo $nav->showFilePage2();
				
				?>
 

		<input type="hidden" name="filter_order" value="<?php echo $lists['order']; ?>" />
		<input type="hidden" name="filter_order_dir" value="<?php echo $lists['order_dir']; ?>" />


		<input type="hidden" name="mtid" value="<?php echo $_REQUEST['mtid'];?>" />
		<input type="hidden" name="menuid" value="<?php echo $this->menuid;?>" />
</form>


<script language="javascript" >
 function v(){}
 $(function(){
	 $('.v').wDialog({title:'编辑内容',width:960,height:520,top:2,iframe:true});
 });

 
</script>