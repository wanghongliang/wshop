<?php 
require_once ($app->getPreviewComponentPath().DS.'com_contents'.DS.'helpers'.DS.'route.php');


$menu = &$app->getMenu();
$cmenu = &$menu->getActive();
$data = $menu->getMenus( 10); 
$keys = array(); //array_keys( $data );
foreach( $data as $v ){  $keys[] = $v['id']; }


//print_r($keys);
$db = &Factory::getDB();
$sql = "select id,title,menuid from #__contents where menuid in (".implode(',',$keys)." ) ";
$db->query($sql);
$results = $db->getResult('menuid',true);



$uri = &URI::getInstance();
//基本URL信息
$baseurl = '/'.$GLOBALS['config']['preview_directory'].'/'.URI_DIRECTORY.'/'.$app->getTemplate();
?>


<link href="<?php echo $baseurl;?>/css/article.css" type="text/css" rel="stylesheet" />
<div class="flv mag-t5"><img src="/preview/templates/default/images/about.jpg" alt="" /></div>

<div id="dtroot">
<?php
$item	=& ModuleHelper::getModule('mod_breadcrumbs');
echo ModuleHelper::renderModule($item);

?>
</div>
<div class="flv">
		<div id="ableft">
			<h2 class="ptitle3">帮助中心</h2>
			<ul id="artype"> 
			<?php
			foreach( $data as $k=>$v ){
				?>
				<li> <?php echo $v['name'];?> 
				<?php
				if( is_array( $rows = $results[$v['id']] ) ){
					echo '<ul>';
					foreach( $rows as $item ){
					$link =  Router::_( ContentsHelperRoute::getArticleRoute($item['id'],$item['menuid']) );
					?>
					<li><a href="<?php echo $link;?>"><?php echo $item['title'];?> </a></li>

					<?php
					}
					echo '</ul>';
				}
				echo '</li>';
			}
			?> 
			</ul>
		</div>
		<div id="abright">
			<h1 class="abtitle2"><?php echo $cmenu['name'];?> </h1>
			<div id="abcon">
	 		<ul class="content_list db-p10" >
			<?php
			$params 	   =& $app->getParams('com_contents');
			 

			$rows = &$this->lists['rows'];
			if( $params['setstyle']==1 ){
				foreach( $rows as $row )
				{
					?>
					<li class="article">
						<div><a href="<?php echo Router::_( ContentsHelperRoute::getArticleRoute($row['id'],$row['menuid']) );?>"><?php
					echo $row['title'];
					?></a></div><span><?php echo $row['modified'];?></span><div class="line"></div>
	 
					</li>

					<?php
				}

			}else{
			foreach( $rows as $row )
			{
				?>
				<li class="article">
 				<a href="<?php echo Router::_( ContentsHelperRoute::getArticleRoute($row['id'],$row['menuid']) );?>" >
				<?php
				echo $row['title'];
				?>
				</a>
				</li>

				<?php
			}


			}

			?>
			</ul>
			<?php echo $this->lists['nav']->showFilePage2();?>
			</div>
 
		</div>
</div>

 