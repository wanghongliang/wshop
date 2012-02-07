<?php
 

class ElementArticle extends Element
{
	/**
	* Element name
	*
	* @access	protected
	* @var		string
	*/
	var	$_name = 'Text';

	function fetchElement($name, $value, &$node, $control_name)
	{
		static $js;
		$size = ( $node['size'] ? 'size="'.$node['size'].'"' : 'size="35" ' );
		$class = ( $node['class'] ? 'class="'.$node['class'].'"' : 'class="selectarticle"' );
        /*
         * Required to avoid a cycle of encoding &
         * html_entity_decode was used in place of htmlspecialchars_decode because
         * htmlspecialchars_decode is not compatible with PHP 4
         */
        $value = intval($value);//htmlspecialchars(html_entity_decode($value, ENT_QUOTES), ENT_QUOTES);
		$title = '';
		if( $value > 0 ){
			$sql =" select title from #__contents where id=".$value;
			$db=&Factory::getDB();
			$db->query($sql);
			$row = $db->getRow();
			$title = $row['title'];
		}

		//只输出一次,当多次调用时
		if( empty($js) ){
			$js = '
			<script language="javascript" >
				function openSelectArticle()
				{
					$.w.createDialog({
					title:\'上传图片\',
					width:800,
					height:500,
					top:10,
					iframe:true,
					url:\'index.php?com=contents&task=selectarticle&&tmpl=component&iname=\'+name,
					isget:true,
					reload:true
					},10);
				}

				function selectArticle(id,value)
				{
					$.w.closeN(10);
					$("#'.$control_name.$name.'").attr("value",id);
					$("#'.$control_name.$name.'_text").attr("value",value);
				}
			</script>
			';
		}

		return '<input type="hidden" name="'.$control_name.'['.$name.']" id="'.$control_name.$name.'" value="'.$value.'"  /><input type="text"   id="'.$control_name.$name.'_text" readonly value="'.$title.'" '.$class.' '.$size.' /><input type="button" value="选择一篇文章" onclick="openSelectArticle()" />'.$js;
	}
}