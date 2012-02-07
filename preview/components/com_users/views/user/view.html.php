<?php
import( 'application.component.view');
class UserView extends View
{

	var $baseurl = null;
	var $categroy = array();
 	function display($tpl = null)
	{
		global $app,$com;
 		if( $_GET['act'] == 'success' ){
			include(dirname(__FILE__).DS.'tmpl'.DS.'success.php');
		}else{
		 
			//会员已登陆，进入会员中心
			if( $app->uid>0 ){ 
				$tpl = '';
				$_REQUEST['tmpl'] = 'user';
				switch($_GET['act']){
					case 'info':
						$this->info=$this->get('info');

						//print_r($this->info);
						$tpl ='info';
						break;
					case 'setpwd':
						$tpl ='setpwd';
						if( $_POST['act2'] == 'save' ){
							$this->get('setpwd');
						}
						break;
					default:
						$this->info=$this->get('info');
						$tpl ='panel';
						$this->setLayout('default');
						break;
				}
				
 	 
			}else{
				$_REQUEST['tmpl'] = 'login';	//设定模板名称
				//$_REQUEST['return'] = URI::current();
				//样式路径
				$this->baseurl = URI_PATH.'templates/'.$app->getTemplate().'/';//components/com_'.$com;
			}
 
			parent::display($tpl);
		}
	}

 
	/** 注册添加资料 **/
	function reg(){
		global $app,$com;

		if( $_POST['username'] == '' ){
			$app->redirect('index.php?com=users&view=user&layout=registor');
		}

		$doc = &Factory::getDocument();
		$_REQUEST['tmpl'] = 'content';	//设定模板名称

		//样式路径
		$this->baseurl = URI_PATH.'templates/'.$app->getTemplate().'/';//components/com_'.$com;
		$layout = $this->getLayout();//当前布局
		$doc->addStyleSheet($this->baseurl.'css/register.css');

		//行业分类
		$menu = & $app->getMenu();
		$this->category = $menu->getChildItem(0);	//第一级目录


		//省市分类
		$province = $this->get('province');
		
  		//样式路径
		//$this->baseurl = URI_PATH.'templates/'.$app->getTemplate().'/components/com_'.$com;
		//$doc->addStyleSheet($this->baseurl.'/css/system.css');
		//$doc->addStyleSheet($this->baseurl.'/css/register.css');
			
		include(dirname(__FILE__).DS.'tmpl'.DS.'registor2.php');
	}
	function activateemail()
	{
		global $app,$com;
		$doc = &Factory::getDocument();
		$_REQUEST['tmpl'] = 'content';	//设定模板名称

		//样式路径
		$this->baseurl = URI_PATH.'templates/'.$app->getTemplate().'/';//components/com_'.$com;
		$layout = $this->getLayout();//当前布局
		$doc->addStyleSheet($this->baseurl.'/css/register.css');

		//样式路径
		//$this->baseurl = URI_PATH.'templates/'.$app->getTemplate().'/components/com_'.$com;
		//$doc->addStyleSheet($this->baseurl.'/css/system.css');
		//$doc->addStyleSheet($this->baseurl.'/css/register.css');
			
		include(dirname(__FILE__).DS.'tmpl'.DS.'activateemail.php');
 	}
	function activateemail_success()
	{
		global $app,$com;
		$doc = &Factory::getDocument();
		$_REQUEST['tmpl'] = 'content';	//设定模板名称

		//样式路径
		$this->baseurl = URI_PATH.'templates/'.$app->getTemplate().'/';//components/com_'.$com;
		$layout = $this->getLayout();//当前布局
		$doc->addStyleSheet($this->baseurl.'/css/register.css');


		//样式路径
		//$this->baseurl = URI_PATH.'templates/'.$app->getTemplate().'/components/com_'.$com;
		//$doc->addStyleSheet($this->baseurl.'/css/system.css');
		//$doc->addStyleSheet($this->baseurl.'/css/register.css');
			
		include(dirname(__FILE__).DS.'tmpl'.DS.'activateemail_success.php');
 	}

	//提交激活模板
	function repass(){
		include(dirname(__FILE__).DS.'tmpl'.DS.'repass.php');
	}


	//已发送激活
	function sendpassactive(){
		include(dirname(__FILE__).DS.'tmpl'.DS.'sendpassactive.php');
	}

	//发送重设密码激活
	function sepass(){
		if( $this->username ){
			include(dirname(__FILE__).DS.'tmpl'.DS.'sepass.php');
		}else{
			include(dirname(__FILE__).DS.'tmpl'.DS.'sepass_error.php');
		}
	}


	function showMemeberStatus(){
		include(dirname(__FILE__).DS.'tmpl'.DS.'memeberstatus.php');

	}

}
?>
