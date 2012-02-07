<?php
import('application.component.view');
class adtypeView extends view{
	var $rows;
	var $uid;
	var $path;
	function adtypeView()
	{
        $this->baseuri = 'index.php?com=advers';
		$this->path = dirname(__FILE__);
	}
	function display()
	{
		$this->rows = $this->get('list');
		include($this->path.DS.'tmpl'.DS.'typelist.php');
	}
	//添加链接分类
	function addtype()
	{
        $adtype = $this->get('list');
		include($this->path.DS.'tmpl'.DS.'typeform.php');
	}
    //分类编辑
    function edit() {
    	global $app;
        if($_REQUEST['id'] || $_REQUEST['ids']) {
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

            $adtype = $this->get('list');
            $this->rows = $this->get('record');
            include($this->path.DS.'tmpl'.DS.'typeform.php');
            return ture;
        }
        return false;
    }
    //移动分类
    function selecttype()
    {
        $this->rows = $this->get('list');
        echo '请选择友情链接分类';
        echo '<select name="selectmenu" size="15">';
        $this->showSelect($this->rows, 0, 0);
        echo '</select>';
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
    /**
     * 递归循环输出信息
     */
    function _showRow($pid,$depth=0)
    {
        static $n=1;
         if( is_array( $this->rows[$pid] ) )
        {
            $depth++;    //加一个深度,当启动递归时
            $items = $this->rows[$pid];
            $len = count($items)-1;
            foreach( $items as $k=> $item )
            {
                if( $depth == 1 ){   $n++; }
                ?>
                <tr class="trbg<? echo $n%2;  ?>"  >
                    <td>
                        <input type="checkbox" name="id[]" class="ids" value="<?php echo $item['id'];?>" />
                    </td>

                    <td>
                        <?php

                        for($i=1;$i<$depth;$i++){
                            echo '&nbsp;<font color=#aaaaaa >-</font>&nbsp;';
                        }

                        ?>
                        <?php
                            //echo $item['id'];
                            echo '<a href="'.$this->baseuri.'&task=edit&id='.$item['id'].'">'.$item['name'].'</a>';// 名称
                            //echo $item['parent_id'];
                        ?>
                    </td>
                <td>
                <?php
                if($item['published'] == 1 ){
                    ?>
                    <a href="<?php echo $this->baseuri;?>&task=toggle&attr=published&value=0&id=<?php echo $item['id'];?>" >
                    <img src="templates/default/images/tick.png" >
                    </a>
                    <?php
                }else{
                    ?>
                    <a href="<?php echo $this->baseuri;?>&task=toggle&attr=published&value=1&id=<?php echo $item['id'];?>" >
                    <img src="templates/default/images/publish_x.png" >
                    </a>
                    <?php
                }?>

                </td>
 
                        <td>
                            <a href="<?php echo $this->baseuri;?>&task=edit&id=<?php echo $item['id'];?>" class="list_edit">
                            编辑
                            </a>
                            &nbsp;
                            <?php
                            //是否有子栏
                            if( is_array( $this->rows[$item['id']] ) ){

                            }else{
                            ?>
                                <a href="javascript:del('<?php echo $this->baseuri;?>&task=deltype&id=<?php echo $item['id'];?>');" class="list_del">
                                    删除
                                </a>
                            <?php
                            }
                            ?>

                        </td>
                    <td>
                        <?php
                        echo $item['id'];
                        ?>
                    </td>

                </tr>
                <?
                 $this->_showRow($item['id'],$depth);
              }
        }
    }
}   //end class