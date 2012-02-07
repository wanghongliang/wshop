<?php
require_once($app->getPreviewComponentPath().DS.'com_banners'.DS.'helper.php');
require_once(dirname(__FILE__).DS.'helper.php');
$lists = &modLatestArticleHelper::getList($params);


if( $params['catid'] ){
	$cat_link = Router::_('index.php?itemid='.$params['catid']);

}else if( is_object($lists['list_article'][0]) ){

	$cat_link = $lists['list_article'][0]->link;
	$pos = strrpos( $cat_link , '/' );
	$cat_link = substr( $cat_link , 0, $pos );
}else{
	$cat_link = "#";
}

?>

<h2 id="hnews"> </h2>
<ul id="hnewsul">
<?php
$length = intval( $params['length'] );


$showauthor = intval( $params['showauthor'] );

//显示作者的名称
if( $params['showauthor'] )
{

//控制标题的长度
if( $length > 0 ){
	$len = $length * 2;
	foreach( $lists['list_article'] as $v )
	{
		?>
		<li class="article" >
			<span class="author" >
				<strong><?php echo $v->author;?></strong>
			</span>
			<a href="<?php echo $v->link;?>"  >
				<?php
				if( strlen($v->title) > $len ){
					echo String::substr($v->title,0,$length);
					echo $params['title_sfx'];
				}else{
					echo $v->title;
				}

				//echo strlen($v->title),$len;
				?>
			</a>
		</li>

		<?php
	}
}else{
	foreach( $lists['list_article'] as $v )
	{
		?>
		<li class="article">

			<span class="author" >
				<strong><?php echo $v->author;?></strong>
			</span>



			<a href="<?php echo $v->link;?>" >
				<?php
				echo $v->title;
				?>
			</a>
		</li>

		<?php
	}
}
}else{

//控制标题的长度
if( $length > 0 ){
	$len = $length * 2;
	foreach( $lists['list_article'] as $v )
	{
		?>
		<li class="article" ><a href="<?php echo $v->link;?>"  >
			<?php
			if( strlen($v->title) > $len ){
				echo String::substr($v->title,0,$length);
				echo $params['title_sfx'];
			}else{
				echo $v->title;
			}

			//echo strlen($v->title),$len;
			?>
		</a>
		</li>

		<?php
	}
}else{
	foreach( $lists['list_article'] as $v )
	{
		?>
		<li class="article">

			<a href="<?php echo $v->link;?>" >
				<?php
				echo $v->title;
				?>
			</a>
		</li>

		<?php
	}
}
}

?>

</ul>
