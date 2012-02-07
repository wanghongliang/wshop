<?php
import( 'application.component.model');

class BuyModel extends Model
{
	function getItem()
	{
		global $app;
		if( $id = intval($_REQUEST['id']) ){
			$sql = " select * from #__buys where id=".$id;
			$this->db->query($sql);

			//当前求购信息
			$row = $this->db->getRow();


			//求购分类
			$menu = &$app->getMenu();
			$cat = $menu->getCategoryItem($row['catid']);
			

			//加入路径
			$pathway = &$app->getPathWay();
 			$pathway->addItem($cat['name'],$menu->bBuysLink($cat['route']));
 			$pathway->addItem($row['title'],'#');

			return $row;
		}
	}
}
?>