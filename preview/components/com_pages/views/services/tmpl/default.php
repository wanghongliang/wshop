<?php
require_once ($app->getPreviewComponentPath().DS.'com_contents'.DS.'helpers'.DS.'route.php');
$uri = &URI::getInstance();

//基本URL信息
$baseurl = '/'.$GLOBALS['config']['preview_directory'].'/'.URI_DIRECTORY.'/'.$app->getTemplate();
?>
<link href="<?php echo $baseurl;?>/css/service.css" type="text/css" rel="stylesheet"/>

<div id="dtroot">
<?php
$item	=& ModuleHelper::getModule('mod_breadcrumbs');
echo ModuleHelper::renderModule($item);
?> 
</div>
<div id="thumbs"><a href=""><img src="<?php echo $baseurl;?>/cache/serbanner.jpg" alt="" /></a></div>
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



<div class="fnleft">
	<div class="ntitle"><h2>会员咨询</h2><a href="<?php echo  Router::_('index.php?itemid=429');?>">更多>></a></div>
	<ul class="serli comment">
	<?php
	$comments = $model->getComment();
	foreach( $comments['rows'] as $k=>$v ){
	?>
		<li> <?php echo $v['content'];?> 
		<?php 
		if(  !empty( $v['recontent'] ) ){
			?>
			<div class="replay" >答:
			<?php
			echo $v['recontent'];
			?>
			</div>
			<?php
		}
		?>
		</li>
	<?php
	}
	?>
 
	</ul>

</div>

<div class="fnleft">

<div class="ntitle"><h2>用户评价</h2> <a href="<?php echo  Router::_('index.php?itemid=430');?>">更多>></a></div>

	<?php
	require(dirname(PATH_COMPONENT).DS.'com_products'.DS.'helpers'.DS.'route.php');
	$evaluation = $model->getEvaluation();
	foreach( $evaluation['rows'] as $k=>$v ){
		$link = Router::_( ProductsHelperRoute::getProductRoute($v['product_id'],$v['catid']) );	

	?>
 	<dl class="prodl">
	<dt><a href="<?php echo $link;?>#evaluation" target=_blank ><img src="<?php echo $v['thumbnail'];?>" width="60" height="60"></a> </dt>
	<dd><a href="<?php echo $link;?>#evaluation" target=_blank ><?php echo $v['contents'];?></a></dd>
	<dd class="c-grall"><?php echo $v['uname'];?> 评价于: <?php echo substr($v['created'],0,10);?></dd>
	</dl>
 	<?php
	}
	?> 
</div>



<div class="clr" ></div>