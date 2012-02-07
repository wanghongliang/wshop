<?php
import('application.component.model');
class LinktypeModel extends Model{
	function LinktypeModel()
	{
		parent::__construct();
		$this->tableName = '#__link_types';
        $this->assocTable = '#__links';
	}

	function getlist()
	{
		$query = "select id, name, parent_id, ordering, published from ".$this->tableName." where uid='{$this->uid}' order by ordering ASC";
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
    //锁定，解锁
    function lock($val = null)
    {
        if($val !== null && $_REQUEST['ids'])
        {
            $ids = implode(',', $this->_filterID($_REQUEST['ids']));
            $this->db->query("update ".$this->tableName." set published='{$val}' where id in({$ids}) and uid='{$this->uid}'");

            return true;
        }
    }
    //移动排序
    function moveUpDown($flag = 1) {
        if($_REQUEST['id'] > 0) {
            $this->db->query("select id, parent_id, ordering from ".$this->tableName." where id='{$_REQUEST['id']}'");
            $result = $this->db->getRow();

            $ording_id = $result['ordering'] + $flag;


            $this->db->query("update ".$this->tableName." set ordering='{$result['ordering']}' where parent_id='{$result['parent_id']}' and ordering='{$ording_id}' and uid='{$this->uid}'");

            $this->db->query("update ".$this->tableName." set ordering='{$ording_id}' where id='{$result['id']}'");

            return true;

        }
       return false;
    }

    //删除
    function del()
    {
        if($_REQUEST['id'])
        {
            $this->db->query("select id, parent_id, ordering from ".$this->tableName." where id='{$_REQUEST['id']}'");
            $result = $this->db->getRow();

            $this->db->query("update ".$this->tableName." set ordering=ordering-1 where parent_id='{$result['parent_id']}' and ordering>{$result['ordering']} and uid='{$this->uid}'");

            $this->db->query("delete from ".$this->tableName." where id='{$result['id']}'");

            return true;
        }
        return false;
    }

    //删除多个分类数据
    function delAll()
    {
		global $app;
    	if($_REQUEST['ids'])
		{
	    	$ids = $this->_filterID($_REQUEST['ids']);
	    	$sql = "select id from ".$this->tableName." where parent_id in(".implode(',', $ids).") and uid='{$this->uid}'";
	    	$this->db->query($sql);
	    	if($this->db->next_record())
	    	{
				$app->enqueueMessage('请先删除子分类');
				return false;
			}
			else
			{
				$sql = "delete from ".$this->tableName." where id in(".implode(',', $ids).") and uid='{$this->uid}'";
				$this->db->query($sql);

				//删除分类下内容
				$this->dels($ids);
				$app->enqueueMessage('删除成功');

				return true;
			}
		}

    	$app->enqueueMessage('请选择删除项');
    	return false;
	}

    //删除分类下的内容
    function dels($type_id = 0)
    {
		if($type_id > 0)
		{
			if(is_array($type_id))
			{
				$tids = implode(',', $type_id);
				$sql = "delete from ".$this->assocTable." where uid='{$this->uid}' and type_id in(".$tids.")";
			}
			else
			{
				$sql = "delete from ".$this->assocTable." where uid='{$this->uid}' and type_id='{$type_id}'";
			}
			$this->db->query($sql);
			//重排序
			$this->reorder();
			return true;
		}
	}

    //链接分类详细内容
    function getRecord() {
        if($_REQUEST['id']) {
            $this->db->query("select * from ".$this->tableName." where id='{$_REQUEST['id']}'");
            return $this->db->getRow();
        }
        return false;
    }

    //保存分类数据
    function save()
    {
        $data = array(
                        'name' =>   $_REQUEST['name'],
                        'published' => $_REQUEST['published']
                    );
        if($_REQUEST['parent_id'])
        {
            $data['parent_id'] = $_REQUEST['parent_id'];
        }
        $id = intval($_REQUEST['id']);
        if($id > 0)
        {
            $this->db->query("select id, parent_id, ordering from ".$this->tableName." where id='{$_REQUEST['id']}'");
            $result = $this->db->getrow();
            if($result['parent_id'] != $_REQUEST['id'])
            {
                $this->db->query("update ".$this->tableName." set ordering=ordering-1 where parent_id='{$result['parent_id']}' and ordering>{$result['ordering']} and uid='{$this->uid}'");

                $data['ordering'] = $this->getNextOrder(" parent_id='{$_REQUEST['parent_id']}' and uid='{$this->uid}' ");

            }
            $this->db->updateArray($this->tableName, $data, " id='{$_REQUEST['id']}'");
        }
        else
        {
            $data['uid'] = $this->uid;
            $data['ordering'] = $this->getNextOrder(" parent_id='{$_REQUEST['parent_id']}' and uid='{$this->uid}' ");
            $this->db->insertArray($this->tableName, $data);
        }
        return true;
    }
     //过滤字符
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
}//end class linkTypeModel.
