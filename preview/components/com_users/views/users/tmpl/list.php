
<div  class="mod "  >
	<dl>
		<dt>
			<span>
				<span>
					<a href="#" >企业信息列表</a>
				</span>
			</span>
		</dt>
		<dd>
		<table width=100% class="companies_list" >
			<thead>
				<tr>
 					<th width=70% >
						公司名称
					</th>
 					<th>
						加入时间
					</th>
					<th align=center >
						发联系信息
					</th>
				</tr>
			</thead>
			<?php
			$rows = &$this->lists['rows'];

			//print_r($rows);
			$i=0;
			foreach( $rows as $row )
			{
				echo '<tr class="bg'.($i++%2).'" >';  
 				?>
 
				  <td > 
					
					  <a class="fca" href="<?php echo $app->buildMemberLink( $row['uname'] );?>" title="<?php echo $row['company_name'];?>" target=_blank   >
						 <strong><?php echo $row['company_name'];?></strong>
					  </a>

					  <span class="fc6" >[广东,深圳]</span>
					<div class="company_intro" >
					  <?php echo str_replace("　", "",String::substr(strip_tags($row['intro']),0,125));?>..
					  </div>
					 </td>
					<td>	
					  <?php 
						  echo  substr($row['join_date'],0,10);
					  ?>
					</td>
					<td>
						<a href="#" >
						<div class="send_contact" ></div>
						</a>
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