<?php

import('application.component.view');
class adversView extends view
{
    var $rows;
    var $baseuri;
    var $path = null;

    function adversView()
    {
        $this->baseuri = 'index.php?com=advers';
        $this->path = dirname(__file__);
    }

    function display()
    {
        import('html.html');
        //广告分类
        $type = $this->get('typelist');

		$tid = $_GET['tid'];
		if( $tid<1 ){ $tid = $type[0]['id']; }
		$model = $this->getModel();
		
		foreach( $type as $t ){ if( $tid == $t['id'] ){ $ct = $t; } }
		$type_params = explode('|', $ct['params'] );
		
		//print_r($type_params);
		$item = $model->getItem($tid);
		$params = unserialize($item['params']);

        include ($this->path . DS . 'tmpl' . DS . 'banners.php');
    }
    //添加友情链接
    function add()
    {
        $linktypes = $this->get('typelist');
        include ($this->path . DS . 'tmpl' . DS . 'adverform.php');
    }
    //编辑友情链接
    function edit()
    {
        if($_REQUESt['ids'] || $_REQUEST['id'])
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


			$ptypes = $this->get('productType');


            include ($this->path . DS . 'tmpl' . DS . 'adverform.php');

            return true;
        }

        return false;
    }
	function selectadver()
	{
		$this->rows = $this->get('selectList');
		$nav = $this->get('nav');
		include($this->path.DS.'tmpl'.DS.'selectlists.php');
	}


} //end class


?>