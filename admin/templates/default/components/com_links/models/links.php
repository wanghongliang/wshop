<?php
import('application.component.model');
class linksModel extends Model{
    var $nav;
	function LinksModel()
	{
		parent::__construct();
		$this->tableName = '#__links';
        $this->typeTable = '#__link_types';
	}
    //友情链接列表
	function getList(){
        global $app;
        $context = $_REQUEST['com'];

		$order = $app->getUserStateFromRequest( 'filter_order',		'',		$context);
		$order_dir = $app->getUserStateFromRequest('filter_order_dir',		'',		$context  );
		$key =	 $app->getUserStateFromRequest('key',		'',		$context  );
		$tid =  $app->getUserStateFromRequest('tid',		0,		$context  );
		$lists['key'] = trim($key);
		$lists['order'] = $order;
		$lists['order_dir'] = $order_dir;

        //查询条件
        $sql_where = " where c.type_id=t.id ";
		if( $tid > 0 ){
			$sql_where .=" and type_id=".$tid;
		}


        $sqlchild = "select id, name from ".$this->typeTable." where uid='{$this->uid}' ";

        $sql = "select count(*) as n from ".$this->tableName." as c,($sqlchild) as t ";
        $sql .= $sql_where;
        $this->db->query($sql);
        $result = $this->db->getRow();

        //分页初实例
        import('html.navigations');
        $this->nav = new Navigations(20,$result['n']);

        $sql = "select c.id, c.name, c.img, c.url, c.published, c.type_id, c.hot, c.ordering, t.id as tid, t.name as tname from ".$this->tableName." as c,({$sqlchild}) as t ";
        $sql .= $sql_where;
        //排序
		if( $order )
		{
			$sql .= " order by ".$order." ".$order_dir;
		}else{
			$sql .= " order by c.id desc ";
		}
        $sql .= $this->nav->getLimit($_REQUEST['page']);

		$this->db->query($sql);
        $lists['rows'] = $this->db->getResult();
        return $lists;
	}
    //友情链接分类
    function getTypeList()
    {
        $query = "select id, name, parent_id, ordering, published from ".$this->typeTable." where uid='{$this->uid}' order by ordering ASC";
        $this->db->query($query);
        $result = $this->db->getResult('parent_id', true);

        return $result;
    }
    /** 修改状态 **/
    function toggle()
    {
        if( ($id = intval($_REQUEST['id']) )>0 && $_REQUEST['attr'] )
        {
            $arr = array( $_REQUEST['attr'] =>$_REQUEST['value'] );
            $this->db->updateArray($this->tableName,$arr," id='".$id."' and uid='".$this->uid."' ");
        }
    }
    //友情链接详情
    function getRecord()
    {
        $query = "select * from ".$this->tableName." where id='{$_REQUEST['id']}'";
        $this->db->query($query);
        return $this->db->getRow();
    }
    //保存友情链接
    function save()
    {
        $data = array(
                        'name' =>   $_REQUEST['name'],
                        'published' => $_REQUEST['published'],
                        'url'   => $_REQUEST['url'],
                        'img' => $_REQUEST['img'],
                        'type_id'   => $_REQUEST['type_id'],
                        'description' => $_REQUEST['description'],
                    );

        $id = intval($_REQUEST['id']);
        if($id > 0)
        {
            $this->db->updateArray($this->tableName, $data, " id='{$id}'");
        }
        else
        {
            $data['uid'] = $this->uid;
            $data['ordering'] = $this->getNextOrder();
            $this->db->insertArray($this->tableName, $data);
        }
        return true;
    }

    /** 修改排序值 **/
	function ordering()
	{
		global $app;
		$id = intval( $_REQUEST['id'] );
		$from = intval( $_REQUEST['from'] );
		$to = intval( $_REQUEST['to'] );

		if( $id>0 && $to>0 && $from>0 )
		{
			$sql = " select count(*) as n from ".$this->tableName." where uid='{$this->uid}'";
			$this->db->query($sql);
			$result = $this->db->getRow();

			$count = $result['n'];

			if( $count < $to )
			{
				$app->enqueueMessage(' 排序失败，排序值大于最大值.');
				return false;
			}
			if( $from > $to ){		//向上移
				$sql = " update ".$this->tableName." set ordering = ordering+1 where uid=".$this->uid." and ordering>=".$to." and ordering<".$from;
 			}else if( $from < $to )//向后移
			{
				$sql = " update ".$this->tableName." set ordering = ordering-1 where uid=".$this->uid." and ordering>".$from." and ordering<=".$to;
 			}
			//echo $sql;exit;
			$this->db->query($sql);

			$data = array('ordering'=>$to);
			$this->db->updateArray($this->tableName,$data," uid=".$this->uid." and id=".$id." ");
			$app->enqueueMessage(' 排序成功.');

		}
	}

    /** 删除内容 **/
	function del($id)
	{
        echo $id = $_REQUEST['id'];
		if( $id > 0 )
		{
			//删除前，先把其它排序值减一
			$sql = "select ordering from ".$this->tableName." where uid=".$this->uid." and id=".$id;
			$this->db->query($sql);
			$row = $this->db->getRow();
			$sql =" update ".$this->tableName." set ordering = ordering-1 where ordering > ".$row['ordering']." and uid='{$this->uid}'";
			$this->db->query($sql);

			$sql = "delete from ".$this->tableName." where id=".$id;
			$this->db->query($sql);
			return true;
		}

		return false;
	}
    /** 拷贝一份 **/
	function copy()
	{
 		global $app;
		$copy_ids = &$this->_filterID( $_REQUEST['ids'] );
		if( count($copy_ids) )
		{
			$sql = " select * from ".$this->tableName." where id in (".implode(',',$copy_ids).") ";
			$this->db->query($sql);
			$rows = $this->db->getResult();
            $ordering = (int)$this->getNextOrder(" uid='{$this->uid}' ");
			foreach( $rows as $row )
			{
				unset($row['id']);
                $row['ordering'] = $ordering;
				//$row['ordering'] =  (int)($this->getNextOrder(" position='".$row['position']."' "));
				$this->db->insertArray( $this->tableName,$row );
                $ordering++;

 			}

			$app->enqueueMessage(' 复制成功,共复制 '.count($copy_ids).'项.');
		}
 		return true;
	}

    //移动友情链接
    function moveAll()
    {
        global $app;
		$ids =  $this->_filterID( $_REQUEST['ids'] );
		$moveToID = intval(  $_REQUEST['movetoid'] );
 		if( count($ids) && $moveToID>0 )
		{
			$sql = " update ".$this->tableName." set type_id=".$moveToID." where uid = ".$this->uid." and id in (".implode(',',$ids).") ";
			//echo $sql;exit;
			$this->db->query($sql);

			$app->enqueueMessage(' 移动成功,共移动 '.count($ids).'项.');
		}
		return true;
    }

   //锁定，解锁友情链接
    function lock($val = null)
    {
        if($val !== null && $_REQUEST['ids'])
        {
            $ids = implode(',', $this->_filterID($_REQUEST['ids']));
            $this->db->query("update ".$this->tableName." set published='{$val}' where id in({$ids}) and uid='{$this->uid}'");

            return true;
        }
    }

    function deleteAll()
    {
        global $app;
		$copy_ids =  $this->_filterID( $_REQUEST['ids'] );

 		if( count($copy_ids) )
		{
			$sql = " delete from ".$this->tableName." where uid = ".$this->uid." and id in (".implode(',',$copy_ids).") ";
			//echo $sql;exit;
			$this->db->query($sql);

			$this->reorder();	//重新排序
			$app->enqueueMessage(' 删除成功,共删除 '.count($copy_ids).'项.');
		}
		return true;
    }

    function  _filterID($string){
		if( $string )
		{
			$id_array = explode( ',',$string);
			$copy_ids = array();
			foreach( $id_array as $id )
			{
				if( $id = intval($id) )
				{
					$copy_ids[] = $id;
				}
			}
		}

		return $copy_ids;
	}

    function getNav()
    {
		return $this->nav;
	}

}   //end class;