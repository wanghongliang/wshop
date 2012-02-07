<?php
class LinksController extends Controller {
    function __construct()
    {
        parent::__construct();

        $this->baseuri = 'index.php?com=links';

        if(is_array($_REQUEST['return']))
        {
            if($_REQUEST['return']['task'])
            {
                $this->baseuri .= '&task='.$_REQUEST['return']['task'];
            }
        }
    }

    function display()
    {
       //取对应菜单列表模型
		$model = $this->getModel('links');

		//视图模型
		$view = $this->getView('links');

		//设置模型
		$view->setModel($model);

		$view->display();
    }
    //更改属性
    function toggleLink()
    {
        $model = $this->getModel('links');
        $model->toggle();
        $this->redirect($this->baseuri);
    }
    //添加友情链接
    function addLink()
    {
        $model = $this->getModel('links');

        $view = $this->getView('links');
        $view->setModel($model);

        $view->add();
    }
    function editLink()
    {
        $model = $this->getModel('links');
        $view = $this->getView('links');

        $view->setModel($model);
        $view->edit();
    }
    //保存友情链接
    function saveLink()
    {
        $model = $this->getModel('links');
        $model->save();
        if($_REQUEST['return'])
        {
            $this->redirect($_REQUEST['return'], '保存成功');
        }
        else
        {
            $this->redirect($this->baseuri, '保存成功');
        }
    }

    //锁定友情链接
    function lock()
    {
        $model = $this->getModel('links');
        $model->lock(0);
        $this->redirect($this->baseuri, '锁定成功');
    }

    function unlock()
    {
        $model = $this->getModel('links');
        $model->lock(1);
        $this->redirect($this->baseuri, '解锁成功');
    }

    /** 排序列表 **/
	function ordering()
	{

 		$model = $this->getModel('links');
		$model->ordering();
 		//视图模型
		$this->redirect($this->baseuri);
	}
    //复制友情链接
    function copy()
	{
		$model = $this->getModel('links');
		$model->copy();
 		//视图模型
		$this->redirect($this->baseuri);
	}
    //删除链接
    function dellink()
    {
        $model = $this->getModel('links');
        $model->del();
        $this->redirect($this->baseuri, '删除成功');
    }
    //删除友情链接集
    function deleteAllLinks()
    {
        $model = $this->getModel('links');
        $model->deleteAll();
        $this->redirect($this->baseuri, '删除成功');
    }
    //友情链接分类列表显示
    function linktype()
    {
    	$model = $this->getModel('linktype');
    	$view = $this->getView('linktype');

    	$view->setModel($model);
    	$view->display();
    }
    /** 修改友情链接分类发布状态 **/
    function toggle()
    {
        $model = $this->getModel('linktype');
        $model->toggle();
         //视图模型
        $this->redirect($this->baseuri.'&task=linktype');
    }
    //分类上移排序
    function moveUp() {
        $model = $this->getModel('linktype');
        $model->moveUpDown();
        $this->redirect($this->baseuri.'&task=linktype');
    }
    //分类下移排序
    function moveDown() {
        $model = $this->getModel('linktype');
        $model->moveUpDown(-1);
        $this->redirect($this->baseuri.'&task=linktype');
    }
    //锁定分类
    function locktype()
    {
        $model = $this->getModel('linktype');
        $model->lock(0);
        $this->redirect($this->baseuri.'&task=linktype', '锁定成功');
    }
     //解锁分类
    function unlocktype()
    {
        $model = $this->getModel('linktype');
        $model->lock(1);
        $this->redirect($this->baseuri.'&task=linktype', '解锁成功');
    }
    //删除分类
    function deltype()
    {
        $model = $this->getModel('linktype');
        if($model->del())
        {
            $this->redirect($this->baseuri.'&task=linktype', '删除成功');
        }
        else
        {
            $this->redirect($this->baseuri.'&task=linktype', '请选择ID，再删除');
        }
    }
    //删除分类集
    function delAllType()
    {
        $model = $this->getModel('linktype');
        $model->delAll();
        $this->redirect($this->baseuri.'&task=linktype');
    }
    //添加友情链接分类
    function addtype()
    {
    	$model = $this->getModel('linktype');

    	$view = $this->getView('linktype');
    	$view->setModel($model);
    	$view->addtype();
    }
    //友情链接分类编辑
    function editType() {
        $model = $this->getModel('linktype');
        $view = $this->getView('linktype');
        $view->setModel($model);

        $view->edit();
    }
    //保荐分类
    function save()
    {
        $model = $this->getModel('linktype');
        $model->save();

        if($_REQUEST['return'])
        {
            $this->redirect($_REQUEST['return']);
        }
        else
        {
            $this->redirect($this->baseuri.'&task=linktype', '保存成功');
        }
    }

    function selecttype()
    {
        $model = $this->getModel('linktype');
        $view = $this->getView('linktype');

        $view->setModel($model);
        $view->selecttype();
    }
    //移动友情链接
    function moveAll()
    {
        $model = $this->getModel('links');
        $model->moveAll();
        $this->redirect($this->baseuri, '移动成功');
    }
} //end class
?>