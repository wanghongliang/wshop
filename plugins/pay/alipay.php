<?php
$GLOBALS['path'] = dirname(__FILE__);
require_once( $GLOBALS['path'].DS."alipay".DS."class/alipay_service.php");


//include(dirname(__FILE__).DS.'ckeditor'.DS.'ckeditor.php');
/**
 * 在线支付方式
 */
class plgPayalipay extends Pay
{
	var $_pay = null;	//支付参数
	function plgPayalipay( $params = null )
	{
 		$this->_pay = $params; 
	}

	function display($out_trade_no,$subject,$body,$total_fee,$pay_mode="directPay")
	{
		//require_once( $GLOBALS['path'].DS."alipay".DS."alipay_config.php");

		//print_r( $this->_pay);exit;

		//以下是配置信息
		//↓↓↓↓↓↓↓↓↓↓请在这里配置您的基本信息↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓
		//合作身份者ID，以2088开头的16位纯数字
		$partner		= $this->_pay['partner'];//"2088302448712140";

		//安全检验码，以数字和字母组成的32位字符
		$key   			= $this->_pay['key'];//"x0tibk2qs2ubq2wq8x4t7j19dw9q4yer";

		//签约支付宝账号或卖家支付宝帐户
		$seller_email	= $this->_pay['accout'];//"13530253280";
 

		//交易过程中服务器通知的页面 要用 http://格式的完整路径，不允许加?id=123这类自定义参数
		$notify_url		= URI::base().'/component/cart/notify_url';//."http://www.xxx.com/js_php_utf8/notify_url.php";

		//付完款后跳转的页面 要用 http://格式的完整路径，不允许加?id=123这类自定义参数
		$return_url		= URI::base().'/component/cart/return_url';//"http://www.xxx.com/js_php_utf8/return_url.php";

		//网站商品的展示地址，不允许加?id=123这类自定义参数
		$show_url		= URI::base().'?com=users';//"http://www.alipay.com";

		//收款方名称，如：公司名称、网站名称、收款人姓名等
		$mainname		= "greenonline";

		//↑↑↑↑↑↑↑↑↑↑请在这里配置您的基本信息↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑



		//签名方式 不需修改
		$sign_type		= "MD5";

		//字符编码格式 目前支持 GBK 或 utf-8
		$_input_charset	= "utf-8";

		//访问模式,根据自己的服务器是否支持ssl访问，若支持请选择https；若不支持请选择http
		$transport		= "http";




		/*以下参数是需要通过下单时的订单数据传入进来获得*/
		//必填参数
		$out_trade_no = empty($out_trade_no)?date(Ymdhms):$out_trade_no;		//请与贵网站订单系统中的唯一订单号匹配
		$subject      = $subject;	//订单名称，显示在支付宝收银台里的“商品名称”里，显示在支付宝的交易管理的“商品名称”的列表里。
		$body         = $body;	//订单描述、订单详细、订单备注，显示在支付宝收银台里的“商品描述”里
		$total_fee    = $total_fee;	//订单总金额，显示在支付宝收银台里的“应付总额”里

		$pay_mode ="CMB";


		//扩展功能参数——默认支付方式 
		if ($pay_mode == "directPay") {
			$paymethod    = "directPay";	//默认支付方式，四个值可选：bankPay(网银); cartoon(卡通); directPay(余额); CASH(网点支付)
			$defaultbank  = "";
		}
		else {
			$paymethod    = "bankPay";		//默认支付方式，四个值可选：bankPay(网银); cartoon(卡通); directPay(余额); CASH(网点支付)
			$defaultbank  = $pay_mode;		//默认网银代号，代号列表见http://club.alipay.com/read.php?tid=8681379
		}
			
		 

		//扩展功能参数——防钓鱼
		//请慎重选择是否开启防钓鱼功能
		//exter_invoke_ip、anti_phishing_key一旦被使用过，那么它们就会成为必填参数
		//开启防钓鱼功能后，服务器、本机电脑必须支持远程XML解析，请配置好该环境。
		//若要使用防钓鱼功能，请打开class文件夹中alipay_function.php文件，找到该文件最下方的query_timestamp函数，根据注释对该函数进行修改
		//建议使用POST方式请求数据
		$anti_phishing_key  = '';			//防钓鱼时间戳
		$exter_invoke_ip = '';				//获取客户端的IP地址，建议：编写获取客户端IP地址的程序
		//如：
		//$exter_invoke_ip = '202.1.1.1';
		//$anti_phishing_key = query_timestamp($partner);		//获取防钓鱼时间戳函数

		//扩展功能参数——其他
		$extra_common_param = '';			//自定义参数，可存放任何内容（除=、&等特殊字符外），不会显示在页面上
		$buyer_email		= '';			//默认买家支付宝账号

		//扩展功能参数——分润(若要使用，请按照注释要求的格式赋值)
		$royalty_type		= "";			//提成类型，该值为固定值：10，不需要修改
		$royalty_parameters	= "";
		//提成信息集，与需要结合商户网站自身情况动态获取每笔交易的各分润收款账号、各分润金额、各分润说明。最多只能设置10条
		//各分润金额的总和须小于等于total_fee
		//提成信息集格式为：收款方Email_1^金额1^备注1|收款方Email_2^金额2^备注2
		//如：
		//royalty_type = "10"
		//royalty_parameters	= "111@126.com^0.01^分润备注一|222@126.com^0.01^分润备注二"


		/////////////////////////////////////////////////


		//$subject = '格力在线支付测试';
		//$body = " 测试内容 ";
		//$total_fee = 0.1; //金额
		//$paymethod = "bankPay";



		//构造要请求的参数数组，无需改动
		$parameter = array(
				"service"			=> "create_direct_pay_by_user",	//接口名称，不需要修改
				"payment_type"		=> "1",               			//交易类型，不需要修改

				//获取配置文件(alipay_config.php)中的值
				"partner"			=> $partner,
				"seller_email"		=> $seller_email,
				"return_url"		=> $return_url.'/'.$out_trade_no,
				"notify_url"		=> $notify_url.'/'.$out_trade_no,
				"_input_charset"	=> $_input_charset,
				"show_url"			=> $show_url,

				//从订单数据中动态获取到的必填参数
				"out_trade_no"		=> $out_trade_no,
				"subject"			=> $subject,
				"body"				=> $body,
				"total_fee"			=> $total_fee,

				//扩展功能参数——网银提前
				"paymethod"			=> $paymethod,
				"defaultbank"		=> $defaultbank,

				//扩展功能参数——防钓鱼
				"anti_phishing_key"	=> $anti_phishing_key,
				"exter_invoke_ip"	=> $exter_invoke_ip,

				//扩展功能参数——自定义参数
				"buyer_email"		=> $buyer_email,
				"extra_common_param"=> $extra_common_param,
				
				//扩展功能参数——分润
				"royalty_type"		=> $royalty_type,
				"royalty_parameters"=> $royalty_parameters
		);


		//print_r($parameter);

		//exit;
		//构造请求函数
		$alipay = new alipay_service($parameter,$key,$sign_type);
		$sHtmlText = $alipay->build_form(); 

		return $sHtmlText;
	}

}
 
?>