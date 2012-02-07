<?php
include(dirname(__FILE__).DS.'helper.php');
$lists = &modFocusHelper::getList($params);
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
<div  class="mod mod_focus <?php echo $params['moduleclass_sfx']?>"  id="<?php echo $module->module,'-',$module->id;?>"  >
	<dl>
		<dt>
			<?php
			if( $params['titlelink'] == '1' ){
			?>
				<a href="<?php echo $cat_link;?>" target=_blank alt="<?php echo $module->title;?>" ><?php echo $module->title;?></a>
			<?php
			}else{
			?>
				<span class="a"><?php echo $module->title;?></span>
			<?php
			}
			?>
 		</dt>
		<dd>
		<ul>			
			<?php 
			$length = intval( $params['length'] );
			$showauthor = intval( $params['showauthor'] );
				//控制标题的长度
				if( $length > 0 ){
					$len = $length * 2;
					foreach( $lists['list_article'] as $v )
					{
						?>
						<li class="article" ><a href="<?php echo $v->link;?>"  target=_blank >
							<?php 
							echo '<span class="cat" >['.$v->name.']</span>';

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

							<a href="<?php echo $v->link;?>" target=_blank >
								<?php 
								
								echo $v->title;
								?>
							</a>
						</li>

						<?php
					}
				}
 
			?>
			</ul>

			<div class="statistics" >
				<span class="db-fl db-mt5" >
				<img src="/preview/templates/ukehu/images/xianhuoimg.gif" />
				</span>
				<ul>
					<li>申请认证企业1306家</li>
					<li>通过认证企业711家</li>
					<li>关闭认证企业166家</li>
					<li>上传现货库存586579条</li>
				</ul>
			</div>
 		</dd>
	</dl>
</div>