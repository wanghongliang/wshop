<?php
include(dirname(__FILE__).DS.'header.php');

//网址分类
$db= &Factory::getDB();
$sql = "select id,name from #__website_type order by lft ";
$db->query($sql);
$rows = $db->getResult();


$tid = intval($_REQUEST['tid']);
$cat = array();
?>

<div class="n_body" >
	<div class="n_left" >
 
		<div class="white">

		  <div class="t2">网址分类</div>
		  <ul class="c1" >
		  <?php
		  foreach( $rows as $row ){
			  if( $row['id'] == $tid ){ $cat = $row; }
			  ?>
			  <li class="tp" >
			  <a href="<?php echo Router::_(getHttpCatRoute($row['id']));?>"    >
			  <?php echo $row['name'];?>
			  </a>
			  </li>
			  <?php
		  }
		  ?>
		  </ul>
 		  <div class="clr" ></div>
		</div>

 
	</div>
	<div class="n_center2" >
		<table width="100%" cellspacing="0" cellpadding="0" class="t">
		  <tbody>
		  
 
			<tr><td colspan="5" class="t2 f14"><b><?php echo $cat['name'];?></b></td>
			</tr>

			<tr>
			<?php
			$i=0;
			foreach( $this->items as $item ){
				if( $i++%5==0 && $i>1 ){ echo '</tr><tr>'; }
				?>
				<td class="c2 <?php if( $item['status']==1 ){ echo ' elite '; }?>">	<a href="<?php echo $item['http'];?>" target=_blank class="bo <?php if( $item['status']==1 ){ echo ' elite'; }?>" id="<?php echo $item['id'];?>"  rel="nofollow" >
				<?php echo $item['name'];?>
				</a></td>
				<?
			}
			?>
			</tr>
	 
		 
		  </tbody>
		  </table>
	</div>

</div>


 




 
<div class="clr"></div>

<?php
unset($rows);
unset($results);
?>