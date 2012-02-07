<?php
$s = $_COOKIE['TMP']['history'];   
?>

<div class="history <?php echo $params['moduleclass_sfx'];?>" >
<h2 class="title2">您浏览过的商品</h2>
<ul class="ulhistory"> 
<?php 
require_once(dirname(PATH_COMPONENT).DS.'com_products'.DS.'helpers'.DS.'route.php');
if( !function_exists('f') ){
	function f($v)
	{
		return $v>0;
	}
}


if( !empty($s) ){
	$s = explode(',', $s); 
	$s = array_filter(array_unique($s),"f" );

	 
	$sql = " select p.id,  p.thumbnail,p.name,p.catid  from    #__products as p   where p.id in (".implode(',',$s)." )  ";
	$db = &Factory::getDB();
	$db->query($sql); 
	$rows = $db->getResult();
	foreach( $rows as $row ){
		$link = Router::_( ProductsHelperRoute::getProductRoute($row['id'],$row['catid']) );
	?>	
		<li>
			<a href="<?php echo $link;?>">
				<img src="<?php echo $row['thumbnail'];?>" width="75"/>
				<?php echo $row['name'];?> 
			
			</a>
		</li>
	<?php
	}

}
?>
</ul>
<div class="clear" ></div>
</div>