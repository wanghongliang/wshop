<?php
class GroupHelper
{
 
 


	/**
		* Description
		* @var         
		* @since         1.0
		* @access     private
		*/
	var $db;


	/**
		* Description
		* @var         
		* @since         1.0
		* @access     private
		*/
	var $tablefix;


	var $typeWhere;

	/**
		* Short description. 
		* 构造函数,引入数据库操作类函数
		* Detail description
		* @param         none
		* @global         none
		* @since         1.0
		* @access         private
		* @return         void
		* @update         date time
	*/
	function GroupHelper()
	{
		global $app;
		$this->db= &Factory::getDB();
		$this->table = '#__group';

		/**
		if( ($tid = $_REQUEST['mtid']) ){
			$this->typeWhere ="  uid='".$app->uid."' and tid ='".$tid."'  ";
		}else{
			$this->typeWhere ="  uid='".$app->uid."' ";
		}
		**/

	} // end func

	

	function bWhere( $string = null )
	{
		if( $string )
		{
			return " where ".$string;
		}

		return '';
	}
	/**
		* Short description. 
		* 增加新的分类
		* Detail description
		* @param         none
		* @global         none
		* @since         1.0
		* @access         private
		* @return         void
		* @update         date time
	*/
	function addsort($CatagoryID,$data)
	{
		global $app;

 
		if($CatagoryID==0){
			$this->db->query("select max(rgt) as n from  `".$this->table."` ".$this->bWhere());
			$row = $this->db->getRow();
			
			
 			$lft=intval($row['n'])+1;
			$rgt=$lft;
			$parent_id = 0;	//父栏ID

			//echo $lft; 
			//echo $rgt;
			//exit;
		}else{
			$Result=$this->checkcatagory($CatagoryID);
			//取得父类的左值,右值
			$lft=$Result['lft'];
			$rgt=$Result['rgt'];
			$parent_id = $Result['id'];
			$this->db->query("UPDATE `".$this->table."` SET `lft`=`lft`+2  ".$this->bWhere(" `lft`>$rgt "));
			$this->db->query("UPDATE `".$this->table."` SET `rgt`=`rgt`+2  ".$this->bWhere(" `rgt`>=$rgt "));
		}
		
		$sql= "INSERT INTO `".$this->table."` SET `lft`='$rgt',`rgt`='$rgt'+1, `parent_id`='$parent_id' ".$this->db->arrayToField($data);


		//插入
		if($this->db->query($sql)){
 			//$this->referto("成功增加新的类别","javascript :HISTORY.BACK(1)",3);
			return $this->db->insertid();
		}else{
			//$this->referto("增加新的类别失败了","javascript :HISTORY.BACK(1)",3);
			return -1;
		}


	} // end func 

	/**
	 * 更新
	 */
	function update($id,$data)
	{
		$Result=$this->checkcatagory($id);
		if( $Result['parent_id'] != $data['parent_id'] )
		{
			if( $data['parent_id']>0 ){	//指定移动到某一个栏目下面
				$this->movecatagory( $id , $data['parent_id'],$data);
			}else{
				//移动为父级栏目
				$this->moveTop($id,$data);
			}
		}else{
			return $this->db->updateArray($this->table,$data," id='$id' " );
		}
	}


	/**
		* Short description. 
		* 删除类别
		* Detail description
		* @param         none
		* @global         none
		* @since         1.0
		* @access         private
		* @return         void
		* @update         date time
	*/
	function deletesort($CatagoryID)
	{
		//取得被删除类别的左右值,检测是否有子类,如果有就一起删除
		$Result=$this->checkcatagory($CatagoryID);
		$lft=$Result['lft'];
		$rgt=$Result['rgt'];
		//执行删除
		if( $this->db->query("DELETE FROM `".$this->table."`  ".$this->bWhere("  `lft`>=$lft AND `rgt`<=$rgt") )){
			$Value=$rgt-$lft+1;
			//更新左右值
			$this->db->query("UPDATE `".$this->table."` SET `lft`=`lft`-$Value ".$this->bWhere("  `lft`>$lft"  ));
			$this->db->query("UPDATE `".$this->table."` SET `rgt`=`rgt`-$Value ".$this->bWhere("  `rgt`>$rgt" ));
			//$this->referto("成功删除类别","javascript :history.back(1)",3);
			return 1;
		}else{
			//$this->referto("删除类别失败了","javascript :history.back(1)",3);
			return -1;
		}
	} // end func


		


	/**
		* 查找对应的分类
		* Short description. 
		* 1,所有子类,不包含自己;2包含自己的所有子类;3不包含自己所有父类4;包含自己所有父类
		* Detail description
		* @param         none
		* @global         none
		* @since         1.0
		* @access         private
		* @return         void
		* @update         date time
	*/
	function getcatagory($CatagoryID,$type=1)
	{
		$Result=$this->checkcatagory($CatagoryID);
		$lft=$Result['lft'];
		$rgt=$Result['rgt'];
		$SeekSQL="SELECT * FROM `".$this->table."`  ";
		switch ($type) {
			 case "1":
			$condition="`lft`>$lft AND `rgt`<$rgt";
			break;
			case "2":
			$condition="`lft`>=$lft AND `rgt`<=$rgt";
			break;
			 case "3":
				 $condition="`lft`<$lft AND `rgt`>$rgt";
				 break; 
			case "4":
			$condition="`lft`<=$lft AND `rgt`>=$rgt";
			break;
			default :
			$condition="`lft`>$lft AND `rgt`<$rgt";
			;
			} 
		$SeekSQL.=$this->bWhere($condition)." ORDER BY `lft` ASC";
		$this->db->query($SeekSQL);
		$Sorts=$this->db->getResult();
		return $Sorts;
	} // end func



	/**
		* Short description. 
		* 取得直属父类
		* Detail description
		* @param         none
		* @global         none
		* @since         1.0
		* @access         private
		* @return         void
		* @update         date time
	*/
	function getparent($CatagoryID)
	{
		$Parent=$this->getcatagory($CatagoryID,3);
		return $Parent;
	} // end func

	/**
		* Short description. 
		* 移动类,如果类有子类也一并移动
		* Detail description
		* @param         none
		* @global         none
		* @since         1.0
		* @access         private
		* @return         void
		* @update         date time
	*/
	function movecatagory($SelfCatagoryID,$ParentCatagoryID,$data)
	{
		$SelfCatagory=$this->checkcatagory($SelfCatagoryID);
		$NewCatagory=$this->checkcatagory($ParentCatagoryID);

		$Selflft=$SelfCatagory['lft'];
		$Selfrgt=$SelfCatagory['rgt'];
		//print_r($SelfCatagory);
		//print_r($NewCatagory);
		//return;

		$Value=($Selfrgt-$Selflft+1);

		//取得所有分类的ID方便更新左右值
		$CatagoryIDS=$this->getcatagory($SelfCatagoryID,2);
		foreach($CatagoryIDS as $v){
			$IDS[]=$v['id'];
		}
		$InIDS=implode(",",$IDS);


		$Parentlft=$NewCatagory['lft'];
		$Parentrgt=$NewCatagory['rgt'];
		if($Parentrgt>$Selfrgt){	//当向后移动时


			//更新当前分类后面的分类 右边(包括父类) , 向前就 - 值
			$UpdateRightSQL="UPDATE `".$this->table."` SET `rgt`=`rgt`-$Value ".$this->bWhere("  `rgt`>$Selfrgt " );
			//更新当前分类后面的分类 左边(不包父类)
			$UpdateLeftSQL="UPDATE `".$this->table."` SET `lft`=`lft`- $Value ".$this->bWhere("  `lft`>$Selfrgt " );
			$this->db->query($UpdateRightSQL);
			$this->db->query($UpdateLeftSQL);


			//重新查询，因为左右值已经改变
			$NewCatagory=$this->checkcatagory($ParentCatagoryID);
			$Parentlft=$NewCatagory['lft'];
			$Parentrgt=$NewCatagory['rgt'];


 			//更新指定父类的左边 (不包父类 )
			$middleLeftSQL = "UPDATE `".$this->table."` SET `lft`=`lft`+$Value ".$this->bWhere("  `lft`>$Parentrgt   and  id NOT IN($InIDS)" );

			//更新指定父类的右边 (包父类 )
			$middleRightSQL = "UPDATE `".$this->table."` SET `rgt`=`rgt`+$Value ".$this->bWhere("  `rgt`>=$Parentrgt  and id  NOT IN($InIDS)" );

			
			$tmpValue =$Selflft - ( $Parentrgt ) ;	//父类和子类中间的个数
			$tmpValue = $tmpValue;	//当更新父类的后面所有分类时，把当前的分类左右都更新了，所以要再加上更新的值
			$UpdateSelfSQL="UPDATE `".$this->table."` SET `lft`=`lft`-$tmpValue,`rgt`=`rgt`-$tmpValue ".$this->bWhere("  `id` IN($InIDS)" );
		
		
			$this->db->query($middleLeftSQL);
			$this->db->query($middleRightSQL);
			$this->db->query($UpdateSelfSQL);
			$this->db->updateArray($this->table,$data," id ='$SelfCatagoryID' ");

			return 1;

		}else{	//当向前移动时
			
			//更新当前分类后面的分类 右边
			$UpdateRightSQL="UPDATE `".$this->table."` SET `rgt`=`rgt`-$Value ".$this->bWhere("  `rgt`>$Selfrgt ");
			//更新当前分类后面的分类 左边
			$UpdateLeftSQL="UPDATE `".$this->table."` SET `lft`=`lft`- $Value ".$this->bWhere("  `lft`>$Selfrgt ");

			$middleLeftSQL = "UPDATE `".$this->table."` SET `lft`=`lft`+$Value ".$this->bWhere(" `lft`>$Parentrgt and  id NOT IN($InIDS)");
			$middleRightSQL = "UPDATE `".$this->table."` SET `rgt`=`rgt`+$Value ".$this->bWhere("  `rgt`>=$Parentrgt and id NOT IN($InIDS)");


			//更新当前分类到父分类之间的分类
			//$UpdateLeftSQL="UPDATE `".$this->table."` SET `lft`=`lft`+$Value  WHERE `lft`>=$Selfrgt ";
			$tmpValue = $Selflft-$Parentrgt ;	//父类和子类中间的个数
			$tmpValue = $tmpValue;	//当更新父类的后面所有分类时，把当前的分类左右都更新了，所以要再加上更新的值
			$UpdateSelfSQL="UPDATE `".$this->table."` SET `lft`=`lft`-$tmpValue,`rgt`=`rgt`-$tmpValue ".$this->bWhere("  `id` IN($InIDS)");
		}

		//echo $UpdateRightSQL;
		//echo '<br>'.$UpdateLeftSQL;

		//echo '<br>'.$middleLeftSQL;
		//echo '<br>'.$middleRightSQL;

		//echo '<br>'.$UpdateSelfSQL;

	 		$this->db->query($UpdateRightSQL);
			$this->db->query($UpdateLeftSQL);
 			$this->db->query($middleLeftSQL);
			$this->db->query($middleRightSQL);
			$this->db->query($UpdateSelfSQL);
		$this->db->updateArray($this->table,$data," id ='$SelfCatagoryID' ");

		//$this->referto("成功移动类别","javascript :history.back(1)",3);
		return 1; //更新算法
 
	} // end func



	/**
	 * 当移动为父分类时
	 */
	function moveTop($SelfCatagoryID,$data=array())
	{
		$SelfCatagory=$this->checkcatagory($SelfCatagoryID);

		$Selflft=$SelfCatagory['lft'];
		$Selfrgt=$SelfCatagory['rgt'];
		//print_r($SelfCatagory);
		//print_r($NewCatagory);
		//return;

		$Value=($Selfrgt-$Selflft+1);

		//取得所有分类的ID方便更新左右值
		$CatagoryIDS=$this->getcatagory($SelfCatagoryID,2);
		foreach($CatagoryIDS as $v){
			$IDS[]=$v['id'];
		}
		$InIDS=implode(",",$IDS);


 


		//更新当前分类后面的分类 右边(包括父类) , 向前就 - 值
		$UpdateRightSQL="UPDATE `".$this->table."` SET `rgt`=`rgt`-$Value ".$this->bWhere("  `rgt`>$Selfrgt " );
		//更新当前分类后面的分类 左边(不包父类)
		$UpdateLeftSQL="UPDATE `".$this->table."` SET `lft`=`lft`- $Value  ".$this->bWhere("  `lft`>$Selfrgt ");
		$this->db->query($UpdateRightSQL);
		$this->db->query($UpdateLeftSQL);

		$sql =" select * from `".$this->table."` ".$this->bWhere("  `id` NOT IN($InIDS) ")." order by rgt desc limit 1 ";
		$this->db->query($sql);
		$NewCatagory	= $this->db->getRow();
		$Parentlft=$NewCatagory['lft'];
		$Parentrgt=$NewCatagory['rgt'];
		
		//print_r($NewCatagory);
		$tmpValue =$Selflft - ( $Parentrgt ) - 1 ;	//父类和子类中间的个数
		$tmpValue = $tmpValue;	//当更新父类的后面所有分类时，把当前的分类左右都更新了，所以要再加上更新的值
		$UpdateSelfSQL="UPDATE `".$this->table."` SET `lft`=`lft`-$tmpValue,`rgt`=`rgt`-$tmpValue ".$this->bWhere("  `id` IN($InIDS)" );
 

		//echo $UpdateSelfSQL;
		$this->db->query($UpdateSelfSQL);

		$data['parent_id'] = 0;
		$this->db->updateArray($this->table,$data," id ='$SelfCatagoryID' ");

		return 1;
 
	}


	/** 排序移动 **/
	function moveup($SelfCatagoryID)
	{
		$SelfCatagory=$this->checkcatagory($SelfCatagoryID);

		$Selflft=$SelfCatagory['lft'];
		$Selfrgt=$SelfCatagory['rgt'];


		$SelfParentID = $SelfCatagory['parent_id'];
		

		//print_r($SelfCatagory);
		//print_r($NewCatagory);
		//return;

		$Value=($Selfrgt-$Selflft+1);

		//取得所有分类的ID方便更新左右值
		$CatagoryIDS=$this->getcatagory($SelfCatagoryID,2);
		foreach($CatagoryIDS as $v){
			$IDS[]=$v['id'];
		}
		$InIDS=implode(",",$IDS);

		
		//取上一个样目
		$sql =" select * from  `".$this->table."` ".$this->bWhere("  rgt='".($Selflft-1)."' and parent_id=".$SelfParentID);
		//echo $sql;
		$this->db->query($sql);
		$NewCatagory = $this->db->getRow();

		//有上一个样目，就向上移
		if( is_array($NewCatagory) )
		{

			$Newrgt = $NewCatagory['rgt'];
			$Newleft = $NewCatagory['lft'];

			//更新当前分类后面的分类 右边(包括父类) , 向前就 - 值
			$UpdateRightSQL="UPDATE `".$this->table."` SET `lft`=`lft`+$Value,`rgt`=`rgt`+$Value ".$this->bWhere("  `rgt`<=$Newrgt and `lft`>=$Newleft  ");

 
			$tmpValue =$Newrgt-$Newleft+1;	//父类和子类中间的个数
 
			$UpdateSelfSQL="UPDATE `".$this->table."` SET `lft`=`lft`-$tmpValue,`rgt`=`rgt`-$tmpValue ".$this->bWhere("  `id` IN($InIDS)");

			//echo $UpdateRightSQL.'<br>';
			//echo $UpdateSelfSQL;
			//exit;
			$this->db->query($UpdateRightSQL);
			$this->db->query($UpdateSelfSQL);
		}
		//print_r($NewCatagory);

		//exit;

	}

	/** 向下排序移动 **/
	function movedown($SelfCatagoryID)
	{
		$SelfCatagory=$this->checkcatagory($SelfCatagoryID);

		$Selflft=$SelfCatagory['lft'];
		$Selfrgt=$SelfCatagory['rgt'];


		$SelfParentID = $SelfCatagory['parent_id'];
		

		//print_r($SelfCatagory);
		//print_r($NewCatagory);
		//return;

		$Value=($Selfrgt-$Selflft+1);

		//取得所有分类的ID方便更新左右值
		$CatagoryIDS=$this->getcatagory($SelfCatagoryID,2);
		foreach($CatagoryIDS as $v){
			$IDS[]=$v['id'];
		}
		$InIDS=implode(",",$IDS);

		
		//取上一个样目
		$sql =" select * from  `".$this->table."`".$this->bWhere("  lft='".($Selfrgt+1)."' and parent_id=".$SelfParentID);
 		$this->db->query($sql);
		$NewCatagory = $this->db->getRow();

		//有上一个样目，就向上移
		if( is_array($NewCatagory) )
		{

			$Newrgt = $NewCatagory['rgt'];
			$Newleft = $NewCatagory['lft'];

			//更新当前分类后面的分类 右边(包括父类) , 向前就 - 值
			$UpdateRightSQL="UPDATE `".$this->table."` SET `lft`=`lft`-$Value,`rgt`=`rgt`-$Value ".$this->bWhere("  `rgt`<=$Newrgt and `lft`>=$Newleft  ");

 
			$tmpValue =$Newrgt-$Newleft+1;	//父类和子类中间的个数
 
			$UpdateSelfSQL="UPDATE `".$this->table."` SET `lft`=`lft`+$tmpValue,`rgt`=`rgt`+$tmpValue ".$this->bWhere("  `id` IN($InIDS)");

			//echo $UpdateRightSQL.'<br>';
			//echo $UpdateSelfSQL;
			//exit;
			$this->db->query($UpdateRightSQL);
			$this->db->query($UpdateSelfSQL);
		}
		//print_r($NewCatagory);

		//exit;

	}

	/**
		* Short description. 
		*
		* Detail description
		* @param         none
		* @global         none
		* @since         1.0
		* @access         private
		* @return         void
		* @update         date time
	*/
	function checkcatagory($CatagoryID)
	{
		//检测父类ID是否存在
		$sql="SELECT * FROM `".$this->table."` ".$this->bWhere("  `id`='$CatagoryID' ")." LIMIT 1";
		$this->db->query($sql);
		$Result=$this->db->getRow();

		if(count($Result)<1){
			Error::throwError("父类ID不存在,请检查","javascript :history.back(1)",3);
		}
		return $Result;     
	} // end func


	/** 
	 * 获取所有信息
	 */
	function getAll( $where = null,$order=null )
	{
		$sql="SELECT * FROM `".$this->table."` ";
 			$sql.=$this->bWhere( $where );
 
		$sql.=" order by lft  ";

		if( trim($order) )
		{
			$sql.=" ,".$order;
		}


		$this->db->query($sql);
		return $this->db->getResult('parent_id',true);
	}


	/**
		* Short description. 
		*
		* Detail description
		* @param         none
		* @global         none
		* @since         1.0
		* @access         private
		* @return         array($Catagoryarray,$Deep)
		* @update         date time
	*/
	function sort2array($CatagoryID=0)
	{
		$Output = array();
		if($CatagoryID==0){
			$CatagoryID=$this->getrootid();
		}

		if(empty($CatagoryID)){
			return array();
			exit;
		}


		 $Result = $this->db->query('SELECT lft, rgt FROM `'.$this->tablefix.
									 'catagory` '.$this->bWhere('  `id`='.$CatagoryID)); 
		 if($Row = $this->db->fetch_array($Result)) {
			 $Right = array(); 
			 $Query = 'SELECT * FROM `'.$this->tablefix.
						 'catagory` '.$this->bWhere('  lft BETWEEN '.$Row['lft'].' AND '. 
						 $Row['rgt']).' ORDER BY lft ASC';
			 
			 $Result = $this->db->query($Query); 
			 while ($Row = $this->db->fetch_array($Result)) { 
				 if (count($Right)>0) { 
					while ($Right[count($Right)-1]<$Row['rgt']) { 
					array_pop($Right);
					} 
				 }
				$Output[]=array('Sort'=>$Row,'Deep'=>count($Right));
				 $Right[] = $Row['rgt'];
			 }
		 }
		 return $Output;     
	} // end func



	/**
		* Short description. 
		*
		* Detail description
		* @param         none
		* @global         none
		* @since         1.0
		* @access         private
		* @return         void
		* @update         date time
	*/
	function getrootid()
	{
		$Query="SELECT * FROM`".$this->table."` ".$this->bWhere()."  ORDER BY `lft` ASC LIMIT 1";
		$RootID=$this->db->getrow($Query);
		if(count($RootID)>0){
			return $RootID['id'];
		}else{
			return 0;
		}
	} // end func


	/**
		* Short description. 
		*
		* Detail description
		* @param         none
		* @global         none
		* @since         1.0
		* @access         private
		* @return         void
		* @update         date time
	*/
	function referto($msg,$url,$sec)
	{
		echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">";
		echo "<meta http-equiv=refresh content=$sec;URL=$url>";
			 if(is_array($msg)){
		foreach($msg as $key=>$value){
		echo $key."=>".$value."<br>";
				 }
				 }else{
				 echo $msg;
				 }
		 exit;
	} // end func



	} // end class

?>