<?php 
require_once ($app->getPreviewComponentPath().DS.'com_contents'.DS.'helpers'.DS.'route.php');


$menu = &$app->getMenu();
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

<div id="dtroot">
<?php
$item	=& ModuleHelper::getModule('mod_breadcrumbs');
echo ModuleHelper::renderModule($item);

?>
 

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
			<h1 class="abtitle2"><?php echo  $this->item['title'];?></h1>
			<div id="abcon">
				<?php
				 //echo $this->item['introtext'];
				 echo $this->item['content'];
				?>
			</div>
			<?php
			if( $this->params['show_closebtn'] == '1' ){
			?>
				<div class="article_btn" >
				<a href="javascript:window.print();">[ 打印 ] </a>
						&nbsp;
						<a href="javascript:history.back()" >
							[ 返回 ]
						</a>
			 
				</div>
			<?php
			}
			?>


		</div>
</div>



 