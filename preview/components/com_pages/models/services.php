<?php
import( 'application.component.model');

class ServicesModel extends Model
{
	function getItems()
	{
		global $app;


		//查询的类型
		$type =  array(
			'qappo'=>1,'qcons'=>2,'qcomp'=>3	
		);

		if( $app->uid > 0 ){
				if( empty($_GET['a']) ) $_GET['a']='qappo';
				$where = " where mid='".$app->uid."' and type='".(int)$type[$_GET['a']]."'  ";
				$sql = "select * from #__feedbacks  ";
				$sql .= $where; 
				$this->db->query($sql); 
				return $this->db->getResult();
		}else{ 

			$key = $_GET['k']; 
			if( !empty($key) )
			{
				import('utilities.securimage'); 
				if( !Simge::check($_REQUEST['code']) ){
					$app->enqueueMessage( '验证码错误.' );
					return array();
				}
				$field = '';
				switch($_GET['w']){
					case '1':
					$field = 'username';
					break;

					case '2':
					$field = 'order_sn';
					break;

					case '3':
					$field = 'phone';
					break;

					case '4':
					$field = 'mobile';
					break;

				}
				$where = " where type='".(int)$type[$_GET['a']]."'  ";
				if( $field ){
					$where .= " and ".$field." ='".$key."' ";
				}


				
				$sql = "select * from #__feedbacks  ";
				$sql .= $where;
			 
				$this->db->query($sql);

				return $this->db->getResult();
			}
		}

		return array();
	}


	function save()
	{
		global $app;
		
		import('utilities.securimage'); 
		if( Simge::check($_REQUEST['code']) ){


			$type =  array(
				'appo'=>1,'cons'=>2,'comp'=>3	
			);	
			$data = array(
				'order_sn'=>$_REQUEST['order_sn'],
				'username'=>$_REQUEST['username'],
				'author'=>$_REQUEST['name'],
				'email'=>$_REQUEST['email'],
				'phone'=>$_REQUEST['phone'],
				'mobile'=>$_REQUEST['mobile'],
				'address'=>$_REQUEST['address'],
				'title'=>$_REQUEST['title'],
				'content'=>$_REQUEST['content'],
 				'release_date'=>date('Y-m-d H:i:s'),
				'type'=>$type[$_REQUEST['a']],
				'mid'=>$app->uid,
				'uid'=>$GLOBALS['USERID']
			);
			$db = &Factory::getDB();
			$db->insertArray('#__feedbacks',$data);
			$msg = '提交成功,感谢您的留言.';

			$data = array();
 		}else{
			//$app->enqueueMessage
			$msg = '验证码错误,请重新输入验证码.';
		}


		if( $_REQUEST['return'] ){
			$data = array(
				'a'=>$_REQUEST['a'],
				'order_sn'=>$_REQUEST['order_sn'],
				'username'=>$_REQUEST['username'],
				'author'=>$_REQUEST['name'],
				'email'=>$_REQUEST['email'],
				'phone'=>$_REQUEST['phone'],
				'mobile'=>$_REQUEST['mobile'],
				'address'=>$_REQUEST['address'],
				'title'=>$_REQUEST['title'],
				'content'=>$_REQUEST['content'] 
			);
			$pos = strpos($_REQUEST['return'],'?');
			if( $pos>0 ){
				$app->redirect(substr($_REQUEST['return'],0,$pos) . '?'.http_build_query($data) , $msg);
			}else{
				$app->redirect($_REQUEST['return']. '?'.http_build_query($data) , $msg);
			}

		}
		$app->enqueueMessage( $msg );
	}


	function getComment(){
		$sql =" select  count(*) as num from #__products_comment where  parent_id=0 ";
		$this->db->query($sql);
		$rows = $this->db->getRow(); 
		import('html.navigations');
		$lists['nav'] = new Navigations(5,$rows['num']);
		$lists['rows'] = array();
	 
		$order=" order by e.comment_id desc ";
		$sql = " select e.*,re.content as recontent from #__products_comment as e left join #__products_comment as re on e.comment_id=re.parent_id where e.parent_id=0 ";
		$sql .= $order;
		$sql.= $lists['nav']->getLimit($_REQUEST['page']);
		 
		$this->db->query($sql);
		$lists['rows'] = $this->db->getResult();

		return $lists;
	}

	function getEvaluation(){
	 
		$order=" order by e.id desc ";
		$sql = " select e.*,p.id,p.catid,p.thumbnail from #__evaluation as e left join #__products as p on e.product_id=p.id		";
		$sql .= $order;
		$sql.= " limit 10 "; 
		$this->db->query($sql);
		$lists['rows'] = $this->db->getResult();

		return $lists;
	}

	function getArticle($id){ 
		$order=" order by c.id desc ";
		$sql = " select c.id,c.title,c.menuid from #__contents as c where c.menuid={$id}		";
		$sql .= $order;
		$sql.= " limit 10 "; 
		$this->db->query($sql);
		$lists['rows'] = $this->db->getResult();

		return $lists;
	}
}
?>