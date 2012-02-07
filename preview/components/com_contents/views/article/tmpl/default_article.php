<?php 
require_once ($app->getPreviewComponentPath().DS.'com_contents'.DS.'helpers'.DS.'route.php');

$model = &$this->getModel();

$menu = &$app->getMenu();


$uri = &URI::getInstance();
//基本URL信息
$baseurl = '/'.$GLOBALS['config']['preview_directory'].'/'.URI_DIRECTORY.'/'.$app->getTemplate();
?>

<link href="<?php echo $baseurl;?>/css/service.css" type="text/css" rel="stylesheet" />
<link href="<?php echo $baseurl;?>/css/article.css" type="text/css" rel="stylesheet" />

<div id="dtroot">
<?php
$item	=& ModuleHelper::getModule('mod_breadcrumbs');
echo ModuleHelper::renderModule($item);

?>
 


		<div id="abright" style="float:left; margin-top:10px;min-height:500px;*height:500px; width:718px; border:1px solid #aaa; " >
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

