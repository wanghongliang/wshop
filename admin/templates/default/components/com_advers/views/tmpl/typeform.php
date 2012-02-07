<?
//import('html.html');
include($this->path.DS.'tmpl'.DS.'toolbar_type.php');

$params = explode('|',$this->rows['params']);
?>
<form action="index.php?com=advers" method="post" name="listform">
    <table class="formtable">
         <tr>
            <td>分类名称：</td>
            <td><input type="text" name="name" size="40" value="<? echo $this->rows['name'];?>"/></td>
        </tr>
 
		<tr>
            <td>该组广告数量</td>
            <td>

			<select name="num" >
			<?php
			for( $i=1;$i<=10;$i++ ){
			?>
				<option value="<?php echo $i;?>" <?php if( $i==$params[0] ){ echo 'selected'; } ?> >
					<?php echo $i;?>
				</option>
			<?php
			}
			?>
			</select>

			<div class="help" >
				设定在该分类广告的数量,经销商在上传广告图片时，需要上传的数量.
			</div>
			</td>
        </tr>
 
		<tr>
            <td>该组广告尺寸设置</td>
            <td>
			宽度 <input type="text" name="width" size="10" value="<?php echo $params[1];?>"  />px &nbsp;
			高度 <input type="text" name="height" size="10" value="<?php echo $params[2];?>" />px 
			<div class="help" >
				设定在该分类广告的尺寸.以象素为单位.
			</div>
			</td>
        </tr>

        <tr>
            <td>是否发布：</td>
            <td><input type="radio" name="published" value="1" <? echo ($this->rows['published'] || !$_REQUEST['id'])?' checked':''; ?>/>发布 <input type="radio" name="published" value="0" <? echo (!$this->rows['published'] && $_REQUEST['id'])?' checked':''; ?>/>不发布</td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td>
                <input type="hidden" name="uid" value="<? echo $this->uid; ?>"/>
                <input type="hidden" name="id" value="<? echo $_REQUEST['id']; ?>">
                <input type="hidden" name="task" value="save" />
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
    location.href="index.php?com=advers&task=type";
});
</script>