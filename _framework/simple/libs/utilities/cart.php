<?php

class Cart{
	var $cartName;
	var $merchandises;
	function &getInstance($name='d'){
		static $cart; 
		if( empty( $cart ) ){
			$name = RouterSite::getMemberName();
			if( empty($name) ){ $name='sz'; }
			if(!is_array($_SESSION[$name])){
				$_SESSION[$name]=array();
			}

			$cart = new Cart($name);
		}
 		return $cart;
	}
	function Cart($name){
		$this->cartName=$name; 
	}
	
	function getNum(){ 
		$n  = 0;
		if( is_array($_SESSION[$this->cartName]) ){
			foreach( $_SESSION[$this->cartName] as $v ){
				$n += $v['number'];
			}
		}
		return $n;
	}
	//���һ����Ʒ
	function addMerchandises($id,$number=1,$attr=null,$img=null){

		if( $id< 1 ){ return false; }
		if( is_array($attr) ){
			//print_r($attr);
			//echo  implode(",",$attr).$id;
			$md5 = md5( implode(",",$attr).$id );
		}else{
			$md5 = md5(($id.$attr));
		}
		//echo $md5;
		//exit;
 		if( isset($_SESSION[$this->cartName][$md5])){
			$_SESSION[$this->cartName][$md5]['number'] = intval($_SESSION[$this->cartName][$md5]['number'])+$number;
		}else{
			
			$_SESSION[$this->cartName][$md5] = array(
				'id'=>(int)$id,
				'number'=>$number,
				'attr'=>$attr,
				'img'=>$img
			); 

		}
		return true;
	}
	
	//�޸�ĳ����Ʒ������
	function modificationMerchandiesNumber($id,$n){
		if(isset($_SESSION[$this->cartName][$id])){
			$_SESSION[$this->cartName][$id]['number']=$n;
		}
		return true;
	}

	
	//ɾ��һ������
	function deleteMerchandise($id){
		unset($_SESSION[$this->cartName][$id]);
	}



	function issetM($id,$number=1,$attr=null,$img=null){
		if( is_array($attr) ){
			//print_r($attr);
			//echo  implode(",",$attr).$id;
			$md5 = md5( implode(",",$attr).$id );
		}else{
			$md5 = md5(($id.$attr));
		}
		return isset($_SESSION[$this->cartName][$md5]);
	}
	
	//ȡ�ù��ﳵ�е���������
	function getMerchandises(){
		static $ms; 
		if( empty($ms) ){
			global $app;
			$ms =  $_SESSION[$this->cartName];
			$uid =$GLOBALS['USERID'];
 			if( is_array( $ms ) && count($ms) > 0 ){
				$db = &Factory::getDB();
				$keys = array();
  				foreach( $ms as $k=>$v ){
					$keys[] = $v['id'];
 				}

				$sql = " select p.id, p.name, p.introtext,p.catid,p.thumbnail,p.shop_price as price from  #__products as p ";
				$sql .= " where p.id in(".implode(',',$keys).") "; 
				
				$db->query($sql);
				$rows = $db->getResult('id');


				foreach( $ms as $k=>$v ){
					$ms[$k]['info'] = $rows[$v['id']];

					if( !empty($ms[$k]['img'])  ){
						$ms[$k]['info']['thumbnail']=$ms[$k]['img'];
					}

					$price = number_format($ms[$k]['attr']['actual_price'],2);
					if( $price > 0 ){
						$ms[$k]['info']['price'] = $price;
					}
				}
				
 				unset($keys);
	 
			}
		}
		return $ms;
	}

	//�������ﳵ
	function deleteCart(){
		unset($_SESSION[$this->cartName]);
		session_unregister($_SESSION[$this->cartName]);
	}

}
 
?>