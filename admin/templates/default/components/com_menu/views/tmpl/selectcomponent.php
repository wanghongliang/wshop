<div class="selectmenutype"  >
	<ul>
	<?php
		//分析相关菜单URL类型参数
		$link = parse_url(URI::current());
 		parse_str($link['query'],$linkParameter);
		unset($linkParameter['url']['com']);	//
		unset($linkParameter['type']);	//
		

		//print_r($link['query']);
		$uri = 'index.php?'.http_build_query($linkParameter);
		
		$task = 'edit';
		if( $_REQUEST['next'] == 'add' )
		{
			$task = 'add';
 			$js_option = 3;
		}else{
			$js_option = 0;
		}


		foreach( $linkType as $k => $type )
		{
			switch($k){
				case 'menulink':
				?>
				<li>
					<div class="root-node" >
					<a href="<?php echo $uri;?>&no_html=0&task=<?php echo $task;?>&type=menulink" >
						菜单别名
					</a>					
					</div>
				</li>
				<?
					break;
				case 'url':
				?>
				<li><div class="root-node" >
				
					<a href="<?php echo $uri;?>&no_html=0&task=<?php echo $task;?>&type=url" >
						外部链接
					</a>

				</div></li>
				<?
					break;
				case 'component':
				?>
				<li><div class="root-node" >请选择相应的组件布局</div>
					<ul class=""  >
						<?php

						//print_r($lists);
						foreach( $lists as $item )
						{
							?>
								<li>
									<div class="node" >
										<a href="javascript:$.w.loadDialog('<?php echo $uri.'&url[com]='.$item['option'];?>',<?php echo $js_option;?>);" >
											<?php echo $item['name']; ?>
										</a>
									</div>

									<?php echo $item['parameter']; ?>
								</li>
							<?php
						}

						?>
					</ul>
				</li>
				<?php
					break;
			}
		}
	?>
	</ul>
</div>

