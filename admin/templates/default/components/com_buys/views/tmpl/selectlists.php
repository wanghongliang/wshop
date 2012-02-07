<div class="db-mt10" >
	<table class="innertable"  >
		<thead>
			<tr>
				<th>标题</th>
	 
				<th> ID </th>
			</tr>
		</thead>

		<?php 

		if( is_array($this->rows) ){
			foreach($this->rows as $k=>$row )
			{
			?>
				<tr>
					<td>
						<a href="javascript:parent.selectArticle(<?php echo $row['id'];?>,'<?php echo $row['title'];?>');" >
							<?php echo $row['title'];?>
						</a>
					</td>
					<td>
						<?php echo $row['id'];?>
					</td>
				</tr>
			<?
			}
		}
		?>
		<tr>
			<td colspan=3 >
				<?php
				echo $nav->showFilePage2();
				
				?>
			</td>
		</tr>
	</table>
</div>