<?

import('html.html');
include ($this->path . DS . 'tmpl' . DS . 'toolbar.php');

?>
<form action="<?php echo $this->baseuri;?>" method="post" name="listform" >
    <table class="listtable" style="margin:0px;" >
        <thead>
		<tr>
			<th width=10 ><input type="checkbox" class="selectall" /></th>
			<th>
			<?php

echo HTML::_('grid.sort', '名称', 'c.name', $lists['order_dir'], $lists['order']);

?>
			<th>
			<?php

echo HTML::_('grid.sort', '广告图片', 'c.img', $lists['order_dir'], $lists['order']);

?>

			</th>

			<th>
			<?php

echo HTML::_('grid.sort', '推荐', 'c.hot', $lists['order_dir'], $lists['order']);

?>

			</th>

			<th>
			<?php

echo HTML::_('grid.sort', '发布', 'c.published', $lists['order_dir'], $lists['order']);

?>

			</th>

			<th>
			<?php

echo HTML::_('grid.sort', '排序', 'c.ordering', $lists['order_dir'], $lists['order']);

?>

			</th>


			<th>
			<?php

echo HTML::_('grid.sort', '所属分类', 'c.type_id', $lists['order_dir'], $lists['order']);

?>

			</th>
			<th > 操作 </th>
			<th> <?php

echo HTML::_('grid.sort', 'ID', 'c.id', $lists['order_dir'], $lists['order']);

?> </th>
		</tr>
	</thead>
    <?php

if (is_array($lists['rows']))
{
    $i = 0;

    foreach ($lists['rows'] as $k => $row)
    {

?>
			<tr class="trbg<?

        echo $i;

?>" >
				<td>
					<input type="checkbox"  name="id[]" value="<?php

        echo $row['id'];

?>" class="ids" />
				</td>

				<td>
				<a href="<?php

        echo $this->baseuri;

?>&task=editlink&id=<?php

        echo $row['id'];

?>" >
					<?php

        echo $row['name'];

?>
				</a>
				</td>

				<td>

				<?php
					$path = PATH_ROOT.str_replace('/',DS,$row['img']);
					if( is_file( $path )  ){
				?>
				<img src="<?php

						echo $row['img'];

				?>" width=60 />
				<?php }else{ ?>
				无图
				<?php } ?>
				</td>

				<td>
				<?php

        if ($row['hot'] == 1)
        {

?>
					<a href="<?php

            echo $this->baseuri;

?>&task=togglelink&attr=hot&value=0&id=<?php

            echo $row['id'];

?>" >
						<img src="templates/default/images/tick.png" >
					</a>
					<?php

        } else
        {

?>
					<a href="<?php

            echo $this->baseuri;

?>&task=togglelink&attr=hot&value=1&id=<?php

            echo $row['id'];

?>" >
						<img src="templates/default/images/publish_x.png" >
					</a>
					<?php

        }

?>
				</td>
				<td>
				<?php

        if ($row['published'] == 1)
        {

?>
					<a href="<?php

            echo $this->baseuri;

?>&task=togglelink&attr=published&value=0&id=<?php

            echo $row['id'];

?>" >
					<img src="templates/default/images/tick.png" >
					</a>
					<?php

        } else
        {

?>
					<a href="<?php

            echo $this->baseuri;

?>&task=togglelink&attr=published&value=1&id=<?php

            echo $row['id'];

?>" >
					<img src="templates/default/images/publish_x.png" >
					</a>
					<?php

        }

?>

				</td>

				<td>
				<input type="text" name="ordering" value="<?php

        echo $row['ordering'];

?>" size=5 class="ordering" />
				</td>

				<td><?php

        echo $row['tname'];

?></td>


 				<td>
				<a href="<?php

        echo $this->baseuri;

?>&task=editlink&id=<?php

        echo $row['id'];

?>" class="list_edit">
				编辑
				</a>

				&nbsp;
				<a href="javascript:del('<?php

        echo $this->baseuri;

?>&task=dellink&id=<?php

        echo $row['id'];

?>');" class="list_del" >
				删除
				</a>

				</td>

				<td>
					<?php

        echo $row['id'];

?>
				</td>
			</tr>
		<?

        $i = 1 - $i;

    }
}

?>

		<tr class="navigations" >
			<td colspan=9 >
				<?php

echo $nav->showFilePage2();

?>
			</td>
		</tr>
</table>
<input type="hidden" name="com" value="<?php

echo $_REQUEST['com'];

?>" />
<input type="hidden" name="filter_order" value="<?php

echo $lists['order'];

?>" />
<input type="hidden" name="filter_order_dir" value="<?php

echo $lists['order_dir'];

?>" />
</form>
<?php
function showSelect($data = array(), $id = 0, $depth = 0, $pid = '') 
{
    $data = (array)$data;
    $depth++; //增加深度
    foreach($data[$id] as $v)
    {
        $selected = ($pid == $v['id'])?' selected':'';
        $n++;
        echo '<option value="'.$v['id'].'" '.$selected.'>';
        for($i = 1; $i < $depth; $i++)
        {
            echo ' - ';
        }
        echo $v['name'].'</option>';
        if(is_array($data[$v['id']])) {
            showselect($data, $v['id'], $depth, $pid);
        }
    }
}
?>
