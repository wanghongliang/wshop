<?php
/**
 * 菜单加载类
 */
class Menu
{
	var $menus = array();
 	var $_active = null;
 	var $_default = null;
 	var $_uid = null;
 	function Menu()
	{
 		$this->load();
	}
 

	function getItem($com)
	{
		foreach( $this->menus as $menus ){
			if( $menus['com'] == $com && $menus['isalias'] < 1 ){
						return $menus;
			}
			if( is_array($menus['submenu']) ){
				foreach( $menus['submenu'] as $menu ){
					if( $menu['com'] == $com || ( is_array($menu['subcom']) && in_array($com,$menu['subcom']) )  ){
						return $menu;
					}
				}
			}
		} 
		return array();
	}
		
 	/**
	 * 加载菜单
	 */
	function load()
	{
		 //快捷菜单
		$submenu = array();
		$submenu[] = array(
				'link'=>"index.php?com=orders",
				'text'=>"订单管理",
				'id'=>"menu_orders",
				'com'=>'modules',
				'pid'=>1,
			);
		$submenu[] = array(
				'link'=>"index.php?com=advers",
				'text'=>"网站配置",
				'id'=>"menu_adver",
				'com'=>'configs',
				'pid'=>1,
			);
		 

		$menudata = array(
				1=>array(
					'link'=>"index.php?com=cpanel",
					'text'=>"后台",
					'type'=>'home',
					'id'=>"cpanel",
					'com'=>'cpanel',//'submenu'=>$submenu,
					'pid'=>1,	//根栏目和子栏目是一样的ID
					//'isalias'=>1,	//根栏目只是一个别名
				)
		);
 
		//-----------------订单菜单
		$submenu = array();
		$submenu[] = array(
				'link'=>"index.php?com=orders",
				'text'=>"订单管理",
				'id'=>"orders",
				'com'=>'orders',
				'pid'=>7,
			);
		$submenu[] = array(
				'link'=>"index.php?com=order_pay",
				'text'=>"收款单",
				'id'=>"order_pay",
				'com'=>'order_pay',
				'pid'=>7,
			);
		$submenu[] = array(
				'link'=>"index.php?com=order_refund",
				'text'=>"退款单",
				'id'=>"order_refund",
				'com'=>'order_refund',
				'pid'=>7,
			);
		$submenu[] = array(
				'link'=>"index.php?com=order_ship",
				'text'=>"发货单",
				'id'=>"order_ship",
				'com'=>'order_ship',
				'pid'=>7,
			);
		$submenu[] = array(
				'link'=>"index.php?com=order_reship",
				'text'=>"退货单",
				'id'=>"order_reship",
				'com'=>'order_reship',
				'pid'=>7,
			);



		$menudata[7] = array(
					'link'=>"index.php?com=orders",
					'text'=>"订单",
					'id'=>"orders",
					'com'=>'orders',
					'submenu'=>$submenu,'type'=>'dropmenu',
					'pid'=>7,
					'isalias'=>1,
				);





		 //组件菜单
		$submenu = array();

		$submenu[] = array(
				'link'=>"index.php?com=products",
				'text'=>"商品管理",
 				'com'=>'products',
				'pid'=>2,
		);
		//$submenu[] = array(
		//		'link'=>"index.php?com=series",
		////		'text'=>"商品系列图片",
 		//		'com'=>'series',
		//		'pid'=>2,
		//);
		$submenu[] = array(
				'link'=>"index.php?com=category",
				'text'=>"商品分类管理",
 				'com'=>'category',
				'pid'=>2,
		);
		$submenu[] = array(
				'link'=>"index.php?com=products_type",
				'text'=>"商品属性类型",
 				'com'=>'products_type',
				'subcom'=>array('products_attribute'),
				'pid'=>2,
		);
 		$submenu[] = array(
				'link'=>"index.php?com=brands",
				'text'=>"商品品牌",
 				'com'=>'brands',
				'pid'=>2,
		);
		//$submenu[] = array(
		//		'link'=>"index.php?com=products_specification",
		//		'text'=>"商品规格",
 		//		'com'=>'products_specification',
 		//	'pid'=>2,
		//);

		$submenu[] = array(
				'link'=>"index.php?com=products_comment",
				'text'=>"商品咨询",
 				'com'=>'products_comment',
 			'pid'=>2,
		);
		$submenu[] = array(
				'link'=>"index.php?com=evaluation",
				'text'=>"商品评价",
 				'com'=>'evaluation',
 			'pid'=>2,
		);


		//商品根目录
		$menudata[2] = array(
					'link'=>"index.php?com=products",
					'text'=>"商品",
					'id'=>"menu_menu",
					'com'=>'root_component',
					'submenu'=>$submenu,'type'=>'dropmenu',
					'pid'=>2,
					'isalias'=>1,
				);


		///////////////////////////----------营销推广-----------////////////////////
		$submenu = array();

		$submenu[] = array(
				'link'=>"index.php?com=elites",
				'text'=>"推荐商品",
				'id'=>"elites",
				'com'=>'elites',
				'pid'=>8,
			);

		$submenu[] = array(
				'link'=>"index.php?com=activities",
				'text'=>"活动信息",
				'id'=>"activities",
				'com'=>'activities',
				'pid'=>8,
			);
		$submenu[] = array(
				'link'=>"index.php?com=present",
				'text'=>"限时抢购",
				'id'=>"present",
				'com'=>'present',
				'pid'=>8,
			);
		$submenu[] = array(
				'link'=>"index.php?com=tuans",
				'text'=>"团购信息",
				'id'=>"tuans",
				'com'=>'tuans',
				'pid'=>8,
			);
		$submenu[] = array(
				'link'=>"index.php?com=seckill",
				'text'=>"秒杀活动",
				'id'=>"seckill",
				'com'=>'seckill',
				'pid'=>8,
			);
		$submenu[] = array(
				'link'=>"index.php?com=questions",
				'text'=>"秒杀问答",
				'id'=>"questions",
				'com'=>'questions',
				'pid'=>8,
			);

		$submenu[] = array(
				'link'=>"index.php?com=coupon",
				'text'=>"优惠券列表",
				'id'=>"coupon",
				'com'=>'coupon',
				'pid'=>8,
			);
		$submenu[] = array(
				'link'=>"index.php?com=imall",
				'text'=>"积分商城",
				'id'=>"tuan",
				'com'=>'tuan',
				'pid'=>8,
			);
		//营销
		$menudata[8] = array(
					'link'=>"index.php?com=activities",
					'text'=>"营销",
					'id'=>"activities",
					'com'=>'activities',
					'submenu'=>$submenu,'type'=>'dropmenu',
					'pid'=>8,
					'isalias'=>1,
				);

		///////////////////////////----------营销推广-----------////////////////////



		//页面管理
		$submenu = array();
		$submenu[] = array(
				'link'=>"index.php?com=menu",
				'text'=>"菜单管理",
				'id'=>"menu",
				'com'=>'menu',
				'pid'=>6,
			);
		$submenu[] = array(
				'link'=>"index.php?com=menutype",
				'text'=>"菜单分类",
				'id'=>"menu_type",
				'com'=>'menutype',
				'pid'=>6,
			);
		$submenu[] = array(
				'link'=>"index.php?com=contents",
				'text'=>"文章管理",
				'id'=>"contents",
				'com'=>'contents',
				'pid'=>6,
			);
		$submenu[] = array(
				'link'=>"index.php?com=pages",
				'text'=>"单页内容",
				'id'=>"pages",
				'com'=>'pages',
				'pid'=>6,
			);

		$menudata[6] = array(
					'link'=>"index.php?com=contents",
					'text'=>"内容",
					'id'=>"contents",
					'com'=>'contents',
					'submenu'=>$submenu,'type'=>'dropmenu',
					'pid'=>6,
					'isalias'=>1,
				);







		//组件子菜单============================
		$submenu = array();

 
		$submenu[] = array(
				'link'=>"index.php?com=advers",
				'text'=>"广告管理",
				'id'=>"menu_adver",
				'com'=>'advers',
				'pid'=>5,
			);
 
		$submenu[] = array(
				'link'=>"index.php?com=feedbacks",
				'text'=>"留言管理",
				'id'=>"menu_feed",
				'com'=>'feedbacks',
				'pid'=>5,
			);
		$submenu[] = array(
				'link'=>"index.php?com=links",
				'text'=>"友情链接",
				'id'=>"menu_link",
				'com'=>'links',
				'pid'=>5,
			);
		$menudata[5] = array(
					'link'=>"index.php?com=advers",
					'text'=>"组件",
					'id'=>"advers",
					'com'=>'advers',
					'submenu'=>$submenu,'type'=>'dropmenu',
					'pid'=>5,
					'isalias'=>1,
				);





		//设置菜单
		$submenu = array();
		$submenu[] = array(
				'link'=>"index.php?com=configs",
				'text'=>"网站设置",
				'id'=>"menu_config",
				'com'=>'configs',
				'pid'=>3,
			);
		$submenu[] = array(
				'link'=>"index.php?com=payments",
				'text'=>"支付方式",
				'id'=>"payments",
				'com'=>'payments',
				'pid'=>3,
			);

		$submenu[] = array(
				'link'=>"index.php?com=shippings",
				'text'=>"货运方式",
				'id'=>"shippings",
				'com'=>'shippings',
				'pid'=>3,
			);

		//$submenu[] = array(
		//		'link'=>"index.php?com=languages",
		//		'text'=>"语言管理",
		//		'id'=>"menu_config",
		//		'com'=>'languages',
		//		'pid'=>3,
		//	);

		$submenu[] = array(
				'link'=>"index.php?com=dealer",
				'text'=>"经销商管理",
				'id'=>"dealer",
				'com'=>'dealer',
				'pid'=>3,
			);

		$submenu[] = array(
				'link'=>"index.php?com=users",
				'text'=>"会员管理",
				'id'=>"menu_users",
				'com'=>'users',
				'pid'=>3,
			);
		$submenu[] = array(
				'link'=>"index.php?com=level",
				'text'=>"会员等级",
				'id'=>"menu_level",
				'com'=>'level',
				'pid'=>3,
			);

		//$submenu[] = array(
		//		'link'=>"index.php?com=group",
		//		'text'=>"会员组管理",
		//		'id'=>"group",
		//		'com'=>'group',
		//		'pid'=>3,
		//	);

		$submenu[] = array(
				'link'=>"index.php?com=companies",
				'text'=>"企业信息",
				'id'=>"menu_companies",
				'com'=>'companies',
				'pid'=>3,
			);
		$submenu[] = array(
				'link'=>"index.php?com=area",
				'text'=>"城市管理",
				'id'=>"area",
				'com'=>'area',
				'pid'=>3,
			);

		$submenu[] = array(
				'link'=>"index.php?com=modules",
				'text'=>"模块管理",
				'id'=>"menu_modules",
				'com'=>'modules',
				'pid'=>3,
			);
		$submenu[] = array(
				'link'=>"index.php?com=templates",
				'text'=>"模板选择",
				'id'=>"menu_css",
				'com'=>'templates',
				'pid'=>3,
			);
		$submenu[] = array(
				'link'=>"index.php?com=configs_option",
				'text'=>"配置选项",
				'id'=>"configs_option",
				'com'=>'configs_option',
				'pid'=>3,
			);
		
		$menudata[3] = array(
					'link'=>"index.php?com=configs",
					'text'=>"设置",
					'id'=>"menu_menu",
					'com'=>'root_set',
					'submenu'=>$submenu,'type'=>'dropmenu',
					'pid'=>3,
					'isalias'=>1,
				);



		//设置菜单
		$submenu = array();

			$submenu[] = array(
				'link'=>"index.php?com=cache",
				'text'=>"缓存工具",
				'id'=>"cache",
				'com'=>'cache',
				'pid'=>4,
			);
			$submenu[] = array(
				'link'=>"index.php?com=database",
				'text'=>"数据库管理",
				'id'=>"database",
				'com'=>'database',
				'pid'=>4,
			);
			$submenu[] = array(
				'link'=>"index.php?com=media",
				'text'=>"图片管理",
				'id'=>"media",
				'com'=>'media',
				'pid'=>4,
			);
			$menudata[4] = array(
					'link'=>"#",
					'text'=>"工具",
					'id'=>"menu_menu",
					'com'=>'root_tool',
					'submenu'=>$submenu,'type'=>'dropmenu',
					'pid'=>4,
					'isalias'=>1,
				);
		$this->menus = $menudata;
	}

 
	function getMenus($tid = 0 )
	{
	
		if( $tid > 0 ){
			$menus = array();
			foreach( $this->menus as $m)
			{
				if( $tid == $m['pid'] ){
					$menus[] = $m;
				}
			}
		}else{
			$menus = $this->menus;
		}

		return $menus;
	}

 

	/**
	 * 设置菜单项
	 */
	function setDefault($id)
	{
		if(isset($this->menus[$id])) {
			$this->_default = $id;
			return true;
		}

		return false;
	}

	/**
	 * 通过ID取默认的菜单项
	 */
	function &getDefault()
	{
 		$item =& $this->menus[$this->_default];
		return $item;
	}

	/**
	 * 通过ID设定当前菜单
	 */
	function &setActive($id)
	{
		if(isset($this->menus[$id]))
		{
			$this->_active = $id;
			$result = &$this->menus[$id];
			return $result;
		}

		$result = null;
		return $result;
	}

	/**
	 * 取当前菜单项
	 */
	function &getActive()
	{
		if ($this->_active) {
			$item =& $this->menus[$this->_active];
			return $item;
		}

		$result = null;
		return $result;
	}
}

?>