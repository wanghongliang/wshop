
<div  class="mod"  >
	<dl>
		<dt>
			<span>
				<span>
					<a href="#" > 求购列表</a>
				</span>
			</span>
		</dt>
		<dd>
		<table width=100%  class="buys_list" >
			<thead>
				<tr>
					<th>
						标题
					</th>
						
					<th>
						公司名称
					</th>

					<th>
						时间
					</th>
				</tr>
			</thead>
			<?php
			$rows = &$this->lists['rows'];
			$i=0;
			foreach( $rows as $row )
			{

				echo '<tr >';  
 				$imgs = explode(',',$row['images']);
				if( $imgs[0] ){
					$img = $imgs[0];
				}else{
					$img = $row['thumbnail'];
				}
				
				$link = '';
				?>
 
				  <td >
					  <a href="<?php echo $link; ?>" title="<?php echo $row['title'];?>"   >
						 <strong><?php echo $row['title'];?></strong>
					  </a>

				</td>
					<td>
 						<?php //echo String::substr($row['introtext'],0,100);?> 
 						<div>
							<a href="<?php echo $app->buildMemberLink($row['uname']); ?>" title="<?php echo $row['company'];?>" target=_blank >
								<u><?php echo $row['company'];?></u>
							</a>	
 						</div>
					</td>
					<td>
						<?php echo $row['modified'];?>
					</td>

 
				<?php
				echo '</tr>';
			}
			?>

			</table>
			
			<div >
			<?php
			echo $this->lists['nav']->showFilePage2();
			?>
			</div>
 			<div class="clr" ></div>

 		</dd>
	</dl>
</div>