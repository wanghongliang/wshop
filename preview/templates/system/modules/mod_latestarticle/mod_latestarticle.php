<?php
include(PATH_MODULES.DS.$module->module.DS.'helper.php');
$lists = &modLatestArticleHelper::getList($params);
?>
<div  class="mod  db-mt5"  >
	<dl>
		<dt>
			<span>
				<span>
					<a href="#" >最新文章信息</a>
				</span>
			</span>
		</dt>
		<dd>
				<ul>			
			<?php 
			foreach( $lists['list_article'] as $v )
			{
				?>

				<li>
				<a href="<?php echo $v->link;?>" >
					<?php 
					echo $v->title;
					?>
				</a>
				</li>

				<?php
			}
			?>
				</ul>
 		</dd>
	</dl>
</div>