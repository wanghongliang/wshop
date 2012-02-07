		<div class="header hhome" >
			<div   class="logo hlogo">
				<div class="logo_img">
				<a href="/">
					<img border="0" alt="优秀网站欣赏-ui58酷站欣赏" src="/preview/templates/ukehu/home-images/logo.jpg">
					<div class="logon">网站案例的分析，收藏，点评！</div>
				</a>
				</div>
				<br class="clr">
			</div>
			<?php
 			//导航条
			$menu = &$app->getMenu();
			$data = $menu->getMenus(1);
				$data = $menu->buidTree($data);
			$menus = $data[0];

			?>
			<div class="nav" >
			<ul>
			<?php
			$n = count($menus)-1;
			$i=0;
			foreach( $menus as $item )
			{

			?>
				<li <?php if( $i++ == $n ) echo ' class="end" '; ?> >
				<a href="<?php echo $item['link'];?>" >
				<?php echo $item['name'];?>
				</a>
				
				</li>
			<?php
			}

			?>
			</ul>
			</div>
		</div>
		<div class="clr" ></div>



<div class="mba" >
<?php
//logo 
$module	=& ModuleHelper::getModule('mod_banners');
echo ModuleHelper::renderModule($module);
$session = &Factory::getSession();
$uid = $session->get('uid');
?>


	<div class="blogin" >

	<?php if( $uid < 1 ){ ?>
	<form action="index.php?com=users&task=dologin" method=post >
		<ul>
		<li>

			<span class="text" >	用户名：</span> <input type="text" class="txt" name="username" value="" />
		</li>

		<li>
			<span class="text" >	密    码：	</span> <input type="password"  class="txt" name="pass" value="" />

			<a href="index.php?com=users&task=repass" class="fg" >
			忘记密码？
			</a>
		</li>

		<li><span class="text" >&nbsp;	</span>
			<input type="checkbox" value="1" />
			记住我
			<input type="submit"  class="loginbtn" value="&nbsp;" />
		</li>

		</ul>
	</form>
	<?php }else{ ?>
		<div class="homemember" >
		欢迎<?php echo $session->get('username');?>,
		<a href="/member/"  > 
		进入会员中心
		</a>
		<br>
			&nbsp;
			<a href="<?php	echo $app->buildMemberLink($session->get('username')); ?>" target=_blank  > 
				<u>我的导航</u>
			</a>
			&nbsp;
			<a href="<?php	echo $app->buildMemberLink($session->get('username')); ?>/fav" target=_blank  > 
				<u>我的收藏</u>
			</a>
		<br>
		<a href="/member/index.php?com=ws" >
		我的网站
		</a>
		&nbsp;
		<a href="/member/index.php?com=ws&task=add" >
		发布我的网站
		</a>
		</div>

	<?php } ?>
	</div>
</div>

<div class="clr" ></div>
<?php
require(dirname(PATH_COMPONENT).DS.'com_website'.DS.'helpers'.DS.'route.php');

//最新加入网站
$sql = "select w.id,w.name,w.http,w.thumbnail,w.catid,w.introtext from #__ws as w where w.uid>0 order by w.modified desc limit 3 ";
$db = &Factory::getDB();
$db->query($sql);
$results  = $db->getResult();
?>

<div class="lasted" >
	<div class="lt" >
	最近加入的网站..
	</div>
	<div class="lastweb" >
	<ul>
	<?php
	$n = count($results)-1; $i=0;
	foreach( $results as $item ){
		$link = Router::_( WebsiteHelperRoute::getRoute($item['id'],$item['catid']) );

	?>
	 <li <?php if( $i++ == $n ){ echo ' class="no" '; } ?> >	
		<div class="img" >
			<div class="imgin" >
				<a href="<?php echo $link;?>"  target=_blank >
					<img src="<?php echo $item['thumbnail'];?>" width=160 />
				</a>
			</div>
		</div>
		<div class="info" >
			<div class="fr"> >><a href="<?php echo $link;?>"  target=_blank > <u>详细/点评</u></a></div>
			名称：<?php echo $item['name'];?> 
			<br/>
			网址：<a href="<?php echo $item['http'];?>" target=_blank ><?php echo $item['http'];?></a>
			<br>
			<?php echo $item['introtext'];?>
		</div>
	</li>
	<?php 
	}
	?>
	</ul>
	<div class="clr" ></div>
	</div>
	 

<?php

//最新网站点评
$sql = "select p.content,u.photo,u.username from #__website_post as p left join #__users as u on p.uid=u.id where p.uid>0 and p.content !='' order by p.id desc limit 10 ";
$db->query($sql);
$results  = $db->getResult();

?>

	<div class="lt" >
		最近网站点评
	</div>

	<div class="lastpost">
	<ul>
	<?php
	foreach( $results as $item ){
		$link = $app->buildMemberLink( $item['username'] ); 
	?>
	 <li>	
		<div class="u" >
				<a href="<?php echo $link;?>" target=_blank >
					<img src="<?php echo $item['photo'];?>" width=50 />
					<br>
					<?php echo $item['username'];?>
				</a>
				
		</div>
 
		<div class="info" >
			<?php echo String::substr($item['content'],0,60);?>
		</div>
	</li>
	<?php 
	}
	?>
	</ul>
	</div>

</div>

<?php
//最近加入的会员
$sql =" select id,username,photo from #__users order by id desc";
$db->query($sql);
$results = $db->getResult();


?>
<div class="lastjoin" >
	<div class="t" >
	最新加入的会员..
	</div>
	<div class="bod" >
	<ul>
	<?php
	foreach( $results as $re ){
				$link = $app->buildMemberLink( $re['username'] ); 

		?>
		<li>
			<a href="<?php echo $link;?>" target=_blank >
			<?php if( $re['photo'] !='' ){?>
				<img src="<?php echo $re['photo'];?>" width=50 height=50 />
			<?php }else{ ?>
				<img src="/i/templates/system/images/photo2.jpg" width=48 height=48 class="bor"  />
			<?php } ?>
			 <br>
			<?php echo $re['username'];?>
			</a>
		</li>
		<?php
	}
	?>
	</ul><div class="clr" ></div>
	</div>
</div>


<div class="lasttag" >
	<div class="t" >
	热门标签
	</div>
	<div class="bod" >
	<ul>
		<Li>
		<a href="#" >
		设计公司
		</a>
		</li>
	</ul>
	</div>
</div>

<div class="clr" ></div>