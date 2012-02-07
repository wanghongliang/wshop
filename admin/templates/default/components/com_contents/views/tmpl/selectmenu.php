<?
import('html.html');
 ?>
 
 <div class="db-padding10 db-align-center" >
 请选择以下菜单项:
 <br/>
	<?php
		echo HTML::_('menu.selectoptions',$_REQUEST['com'],0,' class="selectmenu" ');
	?>
 </div>