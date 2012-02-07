<?php

/***
 * 模板安装是以数组的格式添加默认的数据
 */



//定义默认的菜单类型
$menu_types = array(
	0=>array(
		'title'=>'主菜单','description'=>'主导航菜单'
		)
);





//定义菜单数据
$menu = array(
	0=>array(
		'component'=>'pages',	//组件名称
		'name'=>'首页',			//菜单名称
		'view'=>'page',			//视图名称--非字段属性
		'type'=>'component',	//菜单类型
		'home'=>'1'				//是否为首页
	),
	1=>array(
		'component'=>'pages',	//组件名称
		'name'=>'公司简介',			//菜单名称
		'view'=>'page',			//视图名称--非字段属性
		'type'=>'component',	//菜单类型	
	),
	2=>array(
		'component'=>'products',	//组件名称
		'name'=>'产品中心',			//菜单名称
		'view'=>'page',			//视图名称--非字段属性
		'type'=>'component',	//菜单类型	
	),
	3=>array(
		'component'=>'新闻中心',	//组件名称
		'name'=>'企业动态',			//菜单名称
		'view'=>'page',			//视图名称--非字段属性
		'type'=>'component',	//菜单类型	
	),
	4=>array(
		'component'=>'pages',	//组件名称
		'name'=>'服务支持',			//菜单名称
		'view'=>'page',			//视图名称--非字段属性
		'type'=>'component',	//菜单类型	
	),
	5=>array(
		'component'=>'pages',	//组件名称
		'name'=>'在线反馈',			//菜单名称
		'view'=>'page',			//视图名称--非字段属性
		'type'=>'component',	//菜单类型	
	),
	6=>array(
		'component'=>'pages',	//组件名称
		'name'=>'联系我们',			//菜单名称
		'view'=>'page',			//视图名称--非字段属性
		'type'=>'component',	//菜单类型	
	)
 
);




//模块数据
$modules = array(

	0=>array(
		'title'=>'企业LOGO',		//菜单名称
		'position'=>'wrap',		//位置
		'published'=>'1',		//是否发布
		'module'=>'mod_logo',	//模块类型
		'ordering'=>'1'
	),
	1=>array(
		'title'=>'菜单',		//菜单名称
		'position'=>'wrap',		//位置
		'published'=>'1',		//是否发布
		'module'=>'mod_menu',	//模块类型
		'ordering'=>'2'
	),

 
	3=>array(
		'title'=>'主广告展示',		//菜单名称
		'position'=>'wrap',		//位置
		'published'=>'1',		//是否发布
		'module'=>'mod_banner',	//模块类型
		'ordering'=>'3'
	),


	4=>array(
		'title'=>'产品分类显示',		//菜单名称
		'position'=>'left',		//位置
		'published'=>'1',		//是否发布
		'module'=>'mod_producttype',	//模块类型
		'ordering'=>'1'
	),
	5=>array(
		'title'=>'版权信息',		//菜单名称
		'position'=>'footer',		//位置
		'published'=>'1',		//是否发布
		'module'=>'mod_copyright',	//模块类型
		'ordering'=>'1'
	),
	6=>array(
		'title'=>'产品显示',		//菜单名称
		'position'=>'home',		//位置
		'published'=>'1',		//是否发布
		'module'=>'mod_product',	//模块类型
		'ordering'=>'1'
	),
	7=>array(
		'title'=>'公司信息',		//菜单名称
		'position'=>'home',		//位置
		'published'=>'1',		//是否发布
		'module'=>'mod_company',	//模块类型
		'ordering'=>'2'
	)
);



//生成缓存文件



//添加产品内容和信息内容

?>