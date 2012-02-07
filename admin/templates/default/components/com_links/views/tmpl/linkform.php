<?
//import('html.html');
include($this->path.DS.'tmpl'.DS.'form_toolbar.php');
?>
<form action="index.php?com=links" method="post" name="listform">
    <table class="formtable">
         <tr>
            <td>链接名称： </td>
            <td><input type="text" name="name" size="40" value="<? echo $this->rows['name'];?>"/></td>
        </tr>
        <?php
            if(!empty($linktypes))
            {
                echo '<tr><td>所属分类： </td><td>';
                echo '<select name="type_id" size="10">';
                showSelect($linktypes, 0, 0, $this->rows['type_id']);
                echo '</select>';
                echo '</td></tr>';
            }
        ?>
        <tr>
            <td>是否发布： </td>
            <td><input type="radio" name="published" value="1" <? echo ($this->rows['published'] || !$_REQUEST['id'])?' checked':''; ?>/>发布 <input type="radio" name="published" value="0" <? echo (!$this->rows['published'] && $_REQUEST['id'])?' checked':''; ?>/>不发布</td>
        </tr>
        <tr>
            <td>logo图片： </td>
            <td>
                <input type="text" id="img" name="img" size="40" value="<? echo $this->rows['img']?>">
                <input type="button" name="" value="上传图片" onclick="upload('img')" />
            </td>
        </tr>
        <tr>
            <td>网 址： </td>
            <td>
                <input type="text" id="url" name="url" size="40" value="<? echo $this->rows['url']?>">
            </td>
        </tr>
        <tr>
            <td>备 注： </td>
            <td>
                <textarea name="description" cols="40" rows="5"><? echo $this->rows['description']; ?></textarea>
            </td>
        </tr>
        <tr>
            <td>&nbsp; </td>
            <td>
                <input type="hidden" name="uid" value="<? echo $this->uid; ?>"/>
                <input type="hidden" name="id" value="<? echo $_REQUEST['id']; ?>">
                <input type="hidden" name="task" value="savelink" />
                <input type="hidden" name="return" id="return" value="" />

                <input type="button" class="submit_btn" value="保存"/>
                <input type="button" class="apply_btn" value="应用" />
                <input type="reset" class="cancel_btn" value="取消" />
            </td>
        </tr>
    </table>
</form>
<script>
//点保存按钮
$('.submit_btn').click(function(){
    $('form').get(0).submit();
});
//点应用按键
$('.apply_btn').click(function(){
    $('#return').attr('value', '<? echo URI::current();?>');
    $('form').get(0).submit();
})
//点取消按钮
$('.cancel_btn').click(function(){
    location.href="index.php?com=links";
});
</script>
<?php
    function showSelect($data = array(), $id = 0, $depth = 0, $pid = '') {
        $data = (array)$data;
        static $n = 0;
        $depth++; //增加深度
        foreach($data[$id] as $v)
        {
            $selected = ($pid == $v['id'])?' selected':'';
            if($n == 0)$selected = ' selected';
            $n++;
            echo '<option value="'.$v['id'].'" '.$selected.'>';
            for($i = 1; $i < $depth; $i++)
            {
                echo ' - ';
            }
            echo $v['name'].'</option>';
            if(is_array($data[$v['id']])) {
                showselect($data, $v['id'], $depth, $pid);
            }
        }
    }
?>