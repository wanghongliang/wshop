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

			//��ǰ����Ϣ
			$row = $this->db->getRow();


			//�󹺷���
			$menu = &$app->getMenu();
			$cat = $menu->getCategoryItem($row['catid']);
			

			//����·��
			$pathway = &$app->getPathWay();
 			$pathway->addItem($cat['name'],$menu->bBuysLink($cat['route']));
 			$pathway->addItem($row['title'],'#');

			return $row;
		}
	}
}
?>