<?php
//当更新内容时，启用的插件方法
$app->registerEvent('onUpdateAfter', 'plgCache');

if( $GLOBALS['config']['options']['cache'] == 1 ){
	$app->registerEvent('promptCache', 'plgPromptCache'); 
}


//后台管理插件
function plgCache($com){
	 $sql =" update #__components set cache=1 where `option`='".$com."' ";
	 $db=&Factory::getDB();
	 $db->query($sql);
}


function plgPromptCache(){
	 $sql =" select `option` from  #__components  where cache=1 ";
	 $db=&Factory::getDB();
	 $db->query($sql);
	 $data = $db->getResult();
	 if( count($data)>0 ){
		?>
		<div class="short">
		 <a href="index.php?com=cache" >一键更新缓存</a>
		</div>
		<?php
	 }
}