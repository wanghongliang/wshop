<div  class="mod db-mt5"  id="<?php echo $module->module,'-',$module->id;?>" >
	<dl>
		<dt>
			<span>
				<span>
					<a href="#" ><?php echo $module->title;?></a>
				</span>
			</span>
		</dt>
		<dd>
			<?php
 			?>
			<table class="company" >
				<tr>
 					<td colspan=2 ><strong><?php echo $item['name'];?></strong></td>
				</tr>

				<tr>
					<td><strong><?php echo $item['contact'];?></strong></td>
					<td><strong><?php echo $item['contact_jobs'];?></strong></td>
				</tr>
				<tr>
					<td>地址:</td>
					<td><?php echo $item['address'];?></td>
				</tr>

				<tr>
					<td>电话:</td>
					<td><?php echo $item['phone'];?></td>
				</tr>
				<tr>
					<td>传真:</td>
					<td><?php echo $item['fax'];?></td>
				</tr>

				<tr>
					<td>主页:</td>
					<td><?php echo $item['http'];?></td>
				</tr>
			</table>
			
 		</dd>
	</dl>
</div>