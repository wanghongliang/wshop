<?
import('html.html');
include($this->path.DS.'tmpl'.DS.'toolbar_typelist.php');
?>
<form action="<?php echo $this->baseuri;?>" method="post" name="listform" >
<table class="listtable">
        <thead>
        <tr>
            <th><input type="checkbox" class="selectall" /></th>
            <th width="300">分类名称
            <th>
            发布
            </th>
 
            <th> 操作 </th>
            <th> ID </th>
        </tr>
    </thead>
    <?php $this->_showRow(0);?>
</table>
		<input type="hidden" name="filter_order" value="<?php echo $lists['order']; ?>" />
		<input type="hidden" name="filter_order_dir" value="<?php echo $lists['order_dir']; ?>" />

		<input type="hidden" name="com" value="<?php echo $_REQUEST['com'];?>" />

		<input type="hidden" name="mtid" value="<?php echo $_REQUEST['mtid'];?>" />
		<input type="hidden" name="menuid" value="<?php echo $this->menuid;?>" />
</form>