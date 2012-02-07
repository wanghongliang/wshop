<?php
function getBanner($tid,$output=true){
	static $banners;

	if( empty($banners) ){ 
		$sql = "select * from #__banners  "; 
		$db = &Factory::getDB();
		$db->query($sql);
		$banners = $db->getResult('tid'); 
	}

	//print_r($banners);exit;
	if( isset($banners[$tid]) ){ 

		if( $output  ){
			$banner = $banners[$tid];
			$params = unserialize( $banner['params'] );

			
			if( $params[0]['thumb'] ){
				 
				if( empty( $params[0]['http'] ) ){
					$link = '#';
				}else{
				$link = Router::_( $params[0]['http'] );
				}
			?>
				<div class="fsbox">
				<a href="<?php echo $link;?>" target="_blank" ><img src="<?php echo $params[0]['thumb'];?>" alt="" /></a>
				</div>
			<?php 
			}

		}else{
			return $banners[$tid];
		}
	}else{

		return false;
	}
	return null; 
}
?>