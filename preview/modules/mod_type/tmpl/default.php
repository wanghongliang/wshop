<td  class="submenu_type" >
<div  class="mod_ mod_type"   id="<?php echo $module->module,'-',$module->id;?>" >
	<dl>
		<dt>
			<a href="#" ><?php// echo $module->title;?></a>
		</dt>
		<dd>
		<ul class="ptype" >
		<?php
		$i=0;
		foreach( $list as $row )
		{
 			echo '<li>';
			echo '<a href="'.$row['link'].'" >';
			echo $row['name'];
			echo '</a>';
			echo '</li>';
		}
		?>
		</ul>
 		</dd>
	</dl>
</div>
</td>