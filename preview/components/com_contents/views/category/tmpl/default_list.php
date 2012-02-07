<?php 
require_once ($app->getPreviewComponentPath().DS.'com_contents'.DS.'helpers'.DS.'route.php');

$model = &$this->getModel();

$menu = &$app->getMenu();
$cmenu = &$menu->getActive();
 
$uri = &URI::getInstance();
//基本URL信息
$baseurl = '/'.$GLOBALS['config']['preview_directory'].'/'.URI_DIRECTORY.'/'.$app->getTemplate();
?>

<link href="<?php echo $baseurl;?>/css/service.css" type="text/css" rel="stylesheet" />

<link href="<?php echo $baseurl;?>/css/article.css" type="text/css" rel="stylesheet" />
<div class="flv mag-t5"><img src="/preview/templates/default/images/about.jpg" alt="" /></div>

<div id="dtroot">
<?php
$item	=& ModuleHelper::getModule('mod_breadcrumbs');
echo ModuleHelper::renderModule($item);

?>
</div>
 

		<div id="abright" style="float:left; margin-top:10px;min-height:500px;*height:500px;  width:718px; border:1px solid #aaa; " >
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
						<div><a href="<?php echo Router::_( ContentsHelperRoute::getArticleRoute($row['id'],$row['menuid']) );?>" target="_blank" ><?php
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
 				<a href="<?php echo Router::_( ContentsHelperRoute::getArticleRoute($row['id'],$row['menuid']) );?>" target="_blank"  >
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
 





 <div id="latestnew"> 
		<?php 
		$lists = $model->getArticle(422); 
		?>
		<h2>最新公告</h2> <a href="<?php echo  Router::_('index.php?itemid=422');?>" class="mores">更多>></a>
		<ul class="newul">
			<?php
			foreach( $lists['rows'] as $k=>$v ){
				 $link=Router::_( ContentsHelperRoute::getArticleRoute($v['id'],$v['menuid']) );
			?>
				<li>
					<a href="<?php echo $link;?>" >
					<?php echo $v['title'];?>
					</a>
				</li>
			<?php
			}
			?> 
		</ul>

</div>
<div id="latestnew">
		<?php 
		$lists = $model->getArticle(408); 
		?>
		<div class="ntitle"><h2>导购资讯</h2><a href="<?php echo  Router::_('index.php?itemid=408');?>">更多>></a></div>
		<ul class="serli">
			<?php
			foreach( $lists['rows'] as $k=>$v ){
				 $link=Router::_( ContentsHelperRoute::getArticleRoute($v['id'],$v['menuid']) );
			?>
				<li>
					<a href="<?php echo $link;?>" >
					<?php echo $v['title'];?>
					</a>
				</li>
			<?php
			}
			?> 
		</ul>
</div>

