<?php

class adversController extends Controller
{
    function __construct()
    {
        parent::__construct();

        $this->baseuri = 'index.php?com=advers';
		if( !empty( $_REQUEST['tid'] ) ){
			 $this->baseuri .="&tid=".$_REQUEST['tid'];
		}

        if (is_array($_REQUEST['return']))
        {
            if ($_REQUEST['return']['task'])
            {
                $this->baseuri .= '&task=' . $_REQUEST['return']['task'];
            }
        }
    }

    function display()
    {
        //取对应菜单列表模型
        $model = $this->getModel('advers');

        //视图模型
        $view = $this->getView('advers');

        //设置模型
        $view->setModel($model);

        $view->display();
    }
    //更改属性
    function toggleLink()
    {
        $model = $this->getModel('advers');
        $model->toggle();
        $this->redirect($this->baseuri);
    }



	/** 选择一  **/
	function selectadver()
	{
		//取对应菜单列表模型
		$model = $this->getModel('advers');
	
		//视图模型
		$view = $this->getView('advers');

		//设置模型
		$view->setModel($model);

		//显示
		$view->selectadver();
	}


    //添加友情链接
    function addLink()
    {
        $model = $this->getModel('advers');

        $view = $this->getView('advers');
        $view->setModel($model);

        $view->add();
    }
    function editLink()
    {
        $model = $this->getModel('advers');
        $view = $this->getView('advers');

        $view->setModel($model);
        $view->edit();
    }
    //保存友情链接
    function saveLink()
    {
        $model = $this->getModel('advers');
        $model->save();
        if ($_REQUEST['return'])
        {
            $this->redirect($_REQUEST['return'], '保存成功');
        } else
        {
            $this->redirect($this->baseuri, '保存成功');
        }

    }
    //保存 
    function savebanner()
    {
        $model = $this->getModel('advers');
        $model->savebanner();
        if ($_REQUEST['return'])
        {
            $this->redirect($_REQUEST['return'], '保存成功');
        } else
        {
            $this->redirect($this->baseuri, '保存成功');
        }

    }


    /** 排序列表 **/
    function ordering()
    {

        $model = $this->getModel('advers');
        $model->ordering();
        //视图模型
        $this->redirect($this->baseuri);
    }
    //复制友情链接
    function copy()
    {
        $model = $this->getModel('advers');
        $model->copy();
        //视图模型
        $this->redirect($this->baseuri);
    }
    //删除链接
    function dellink()
    {
        $model = $this->getModel('advers');
        $model->del();
        $this->redirect($this->baseuri, '删除成功');
    }
    //删除友情链接集
    function deleteAlladvers()
    {
        $model = $this->getModel('advers');
        $model->deleteAll();
        $this->redirect($this->baseuri, '删除成功');
    }
    //锁定广告
    function lock()
    {
        $model = $this->getModel('advers');

        $model->lock(0);
        $this->redirect($this->baseuri, '锁定成功');
    }
    //解锁广告
    function unlock()
    {
        $model = $this->getModel('advers');

        $model->lock(1);
        $this->redirect($this->baseuri, '锁定成功');
    }
    //友情链接分类列表显示
    function type()
    {
        $model = $this->getModel('adtype');
        $view = $this->getView('adtype');

        $view->setModel($model);
        $view->display();
    }
    /** 修改友情链接分类发布状态 **/
    function toggle()
    {
        $model = $this->getModel('adtype');
        $model->toggle();
        //视图模型
        $this->redirect($this->baseuri . '&task=type');
    }
    //分类上移排序
    function moveUp()
    {
        $model = $this->getModel('adtype');
        $model->moveUpDown();
        $this->redirect($this->baseuri . '&task=type');
    }
    //分类下移排序
    function moveDown()
    {
        $model = $this->getModel('adtype');
        $model->moveUpDown(-1);
        $this->redirect($this->baseuri . '&task=type');
    }
    //删除分类
    function deltype()
    {
        $model = $this->getModel('adtype');
        if ($model->del())
        {
            $this->redirect($this->baseuri . '&task=type', '删除成功');
        } else
        {
            $this->redirect($this->baseuri . '&task=type', '请选择ID，再删除');
        }
    }
    //锁定分类
    function lockType()
    {
        $model = $this->getModel('adtype');

        $model->lock(0);
        $this->redirect($this->baseuri.'&task=type', '锁定成功');
    }
    //解锁分类
    function unlockType()
    {
        $model = $this->getModel('adtype');
        $model->lock(1);

        $this->redirect($this->baseuri.'&task=type', '解锁成功');
    }
    //删除分类集
    function deleteAllType()
    {
        $model = $this->getModel('adtype');
        $model->delAll();
        $this->redirect($this->baseuri . '&task=type');
    }
    //添加友情链接分类
    function addtype()
    {
        $model = $this->getModel('adtype');

        $view = $this->getView('adtype');
        $view->setModel($model);
        $view->addtype();
    }
    //友情链接分类编辑
    function edit()
    {
        $model = $this->getModel('adtype');
        $view = $this->getView('adtype');
        $view->setModel($model);

        $flag = $view->edit();
        if (!$flag)
        {
            $this->redirect($this->baseuri . '&task=type');
        }
    }
    //保荐分类
    function save()
    {
        $model = $this->getModel('adtype');
        $model->save();

        if ($_REQUEST['return'])
        {
            $this->redirect($_REQUEST['return'], '保存成功');
        } else
        {
            $this->redirect($this->baseuri . '&task=type', '保存成功');
        }
    }

    function selecttype()
    {
        $model = $this->getModel('adtype');
        $view = $this->getView('adtype');

        $view->setModel($model);
        $view->selecttype();
    }
    //移动友情链接
    function moveAll()
    {
        $model = $this->getModel('advers');
        $model->moveAll();
        $this->redirect($this->baseuri, '移动成功');
    }
} //end class


?>