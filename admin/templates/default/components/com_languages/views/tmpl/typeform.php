<?
//import('html.html');
include($this->path.DS.'tmpl'.DS.'toolbar_type_form.php');
?>
<form action="index.php?com=languages" method="post" name="listform">
    <table class="formtable">
         <tr>
            <td>分类名称：</td>
            <td><input type="text" name="name" size="40" value="<? echo $this->rows['name'];?>"/></td>
        </tr>
          <tr>
            <td>标识：(用字母标识会显示在URL中)</td>
            <td><input type="text" name="mark" size="40" value="<? echo $this->rows['mark'];?>"/></td>
        </tr>
        <tr>
            <td>是否发布：</td>
            <td><input type="radio" name="published" value="1" <? echo ($this->rows['published'] || !$_REQUEST['id'])?' checked':''; ?>/>发布 <input type="radio" name="published" value="0" <? echo (!$this->rows['published'] && $_REQUEST['id'])?' checked':''; ?>/>不发布</td>
        </tr>

		<tr>
            <td>图标：</td>
            <td>
                <input type="text" id="img" name="img" size="40" value="<? echo $this->rows['img']?>">
                <input type="button" name="" value="上传图片" onclick="upload('img')" />
				<input name="" value=".." onclick="selectImage('img')" type="button">
            </td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td>
                <input type="hidden" name="uid" value="<? echo $this->uid; ?>"/>
                <input type="hidden" name="id" value="<? echo $_REQUEST['id']; ?>">
                <input type="hidden" name="task" value="savetype" />
                <input type="hidden" name="return" id="return" value="" />

                <input type="submit" class="submit_btn" value="保存"/>
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
    $('#return').attr('value','<?php echo URI::current();?>');
    $('form').get(0).submit();
})
//点取消按钮
$('.cancel_btn').click(function(){
    location.href="index.php?com=languages&task=type";
});
</script>