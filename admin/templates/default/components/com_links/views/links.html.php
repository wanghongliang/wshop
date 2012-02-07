<?php
import('application.component.view');
class LinksView extends view{
	var $rows;
	var $baseuri;
	var $path = null;

	function LinksView(){
        $this->baseuri = 'index.php?com=links';
		$this->path = dirname(__FILE__);
	}

	function display()
	{
        import('html.html');
       //广告分类
        $types = $this->get('typelist');

		$this->rows = $this->get('list');

        $nav = $this->get('nav');

		include($this->path.DS.'tmpl'.DS.'list.php');
	}
	//添加友情链接
	function add()
	{
		$linktypes = $this->get('typelist');
        include($this->path.DS.'tmpl'.DS.'linkform.php');
	}


    //编辑友情链接
    function edit()
    {
        if($_REQUEST['ids'] || $_REQUEST['id'])
        {
            if($_REQUEST['ids'])
			{
				if(strpos($_REQUEST['ids'], ',') === false)
				{
					$_REQUEST['id'] = (int)$_REQUEST['ids'];
				}
				else
				{
					$app->enqueueMessage('只能选择一项编辑');
					return false;
				}
			}
            $linktypes = $this->get('typelist');
            $this->rows = $this->get('record');
            include($this->path.DS.'tmpl'.DS.'linkform.php');

            return true;
        }
        return false;
    }
    //递归输出分类信息
    function showSelect($data = array(), $id = 0, $depth = 0, $pid = '') {
        $data = (array)$data;
        $depth++; //增加深度
        foreach($data[$id] as $v)
        {
            $selected = ($pid == $v['id'])?' selected':'';
            echo '<option value="'.$v['id'].'" '.$selected.'>';
            for($i = 1; $i < $depth; $i++)
            {
                echo ' - ';
            }
            echo $v['name'].'</option>';
            if(is_array($data[$v['id']])) {
                $this->showselect($data, $v['id'], $depth, $pid);
            }
        }
    }

} //end class
?>