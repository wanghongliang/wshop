<?php
/**
 * ��������ֵ�����ṹ
 * ���ߣ�������
 * ʱ�䣺2010-1-6
 * ��ע��2010-1-6 ���Գɹ������ܰ�������ӣ�ɾ�����ƶ�������������������
 */
class Tree
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
		* ���캯��,�������ݿ�����ຯ��
		* Detail description
		* @param         none
		* @global         none
		* @since         1.0
		* @access         private
		* @return         void
		* @update         date time
	*/
	function Tree()
	{
		global $app;
		$this->db= &Factory::getDB();
		$this->table = '#__menu';

		if( ($tid = $_REQUEST['mtid']) ){
			$this->typeWhere ="  uid='".$app->uid."' and tid ='".$tid."'  ";
		}else{
			$this->typeWhere ="  uid='".$app->uid."' ";
		}

	} // end func

	

	/**
		* Short description. 
		* �����µķ���
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

		if( ($tid = $data['tid']) ){
			$this->typeWhere ="  uid='".$app->uid."' and tid ='".$tid."'  ";
		}


		if($CatagoryID==0){
			$this->db->query("select max(rgt) as n from  `".$this->table."` where ".$this->typeWhere." ");
			$row = $this->db->getRow();
			
			
 			$lft=intval($row['n'])+1;
			$rgt=$lft;
			$parent_id = 0;	//����ID

			//echo $lft; 
			//echo $rgt;
			//exit;
		}else{
			$Result=$this->checkcatagory($CatagoryID);
			//ȡ�ø������ֵ,��ֵ
			$lft=$Result['lft'];
			$rgt=$Result['rgt'];
			$parent_id = $Result['id'];
			$this->db->query("UPDATE `".$this->table."` SET `lft`=`lft`+2 WHERE  ".$this->typeWhere." and `lft`>$rgt ");
			$this->db->query("UPDATE `".$this->table."` SET `rgt`=`rgt`+2 WHERE  ".$this->typeWhere." and `rgt`>=$rgt");
		}
		
		$sql= "INSERT INTO `".$this->table."` SET `lft`='$rgt',`rgt`='$rgt'+1, `parent_id`='$parent_id' ".$this->db->arrayToField($data);


		//����
		if($this->db->query($sql)){
 			//$this->referto("�ɹ������µ����","javascript :HISTORY.BACK(1)",3);
			return $this->db->insertid();
		}else{
			//$this->referto("�����µ����ʧ����","javascript :HISTORY.BACK(1)",3);
			return -1;
		}


	} // end func 

	/**
	 * ����
	 */
	function update($id,$data)
	{
		$Result=$this->checkcatagory($id);
		if( $Result['parent_id'] != $data['parent_id'] )
		{
			if( $data['parent_id']>0 ){	//ָ���ƶ���ĳһ����Ŀ����
				$this->movecatagory( $id , $data['parent_id'],$data);
			}else{
				//�ƶ�Ϊ������Ŀ
				$this->moveTop($id,$data);
			}
		}else{
			return $this->db->updateArray($this->table,$data," id='$id' " );
		}
	}


	/**
		* Short description. 
		* ɾ�����
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
		//ȡ�ñ�ɾ����������ֵ,����Ƿ�������,����о�һ��ɾ��
		$Result=$this->checkcatagory($CatagoryID);
		$lft=$Result['lft'];
		$rgt=$Result['rgt'];
		//ִ��ɾ��
		if($this->db->query("DELETE FROM `".$this->table."` WHERE  ".$this->typeWhere." and `lft`>=$lft AND `rgt`<=$rgt")){
			$Value=$rgt-$lft+1;
			//��������ֵ
			$this->db->query("UPDATE `".$this->table."` SET `lft`=`lft`-$Value WHERE  ".$this->typeWhere." and `lft`>$lft");
			$this->db->query("UPDATE `".$this->table."` SET `rgt`=`rgt`-$Value WHERE  ".$this->typeWhere." and `rgt`>$rgt");
			//$this->referto("�ɹ�ɾ�����","javascript :history.back(1)",3);
			return 1;
		}else{
			//$this->referto("ɾ�����ʧ����","javascript :history.back(1)",3);
			return -1;
		}
	} // end func


		


	/**
		* ���Ҷ�Ӧ�ķ���
		* Short description. 
		* 1,��������,�������Լ�;2�����Լ�����������;3�������Լ����и���4;�����Լ����и���
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
		$SeekSQL="SELECT * FROM `".$this->table."` WHERE  ".$this->typeWhere." and ";
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
		$SeekSQL.=$condition." ORDER BY `lft` ASC";
		$this->db->query($SeekSQL);
		$Sorts=$this->db->getResult();
		return $Sorts;
	} // end func



	/**
		* Short description. 
		* ȡ��ֱ������
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
		* �ƶ���,�����������Ҳһ���ƶ�
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

		//ȡ�����з����ID�����������ֵ
		$CatagoryIDS=$this->getcatagory($SelfCatagoryID,2);
		foreach($CatagoryIDS as $v){
			$IDS[]=$v['id'];
		}
		$InIDS=implode(",",$IDS);


		$Parentlft=$NewCatagory['lft'];
		$Parentrgt=$NewCatagory['rgt'];
		if($Parentrgt>$Selfrgt){	//������ƶ�ʱ


			//���µ�ǰ�������ķ��� �ұ�(��������) , ��ǰ�� - ֵ
			$UpdateRightSQL="UPDATE `".$this->table."` SET `rgt`=`rgt`-$Value WHERE  ".$this->typeWhere." and `rgt`>$Selfrgt ";
			//���µ�ǰ�������ķ��� ���(��������)
			$UpdateLeftSQL="UPDATE `".$this->table."` SET `lft`=`lft`- $Value  WHERE  ".$this->typeWhere." and `lft`>$Selfrgt ";
			$this->db->query($UpdateRightSQL);
			$this->db->query($UpdateLeftSQL);


			//���²�ѯ����Ϊ����ֵ�Ѿ��ı�
			$NewCatagory=$this->checkcatagory($ParentCatagoryID);
			$Parentlft=$NewCatagory['lft'];
			$Parentrgt=$NewCatagory['rgt'];


 			//����ָ���������� (�������� )
			$middleLeftSQL = "UPDATE `".$this->table."` SET `lft`=`lft`+$Value WHERE  ".$this->typeWhere." and `lft`>$Parentrgt   and  id NOT IN($InIDS)";

			//����ָ��������ұ� (������ )
			$middleRightSQL = "UPDATE `".$this->table."` SET `rgt`=`rgt`+$Value WHERE  ".$this->typeWhere." and `rgt`>=$Parentrgt  and id  NOT IN($InIDS)";

			
			$tmpValue =$Selflft - ( $Parentrgt ) ;	//����������м�ĸ���
			$tmpValue = $tmpValue;	//�����¸���ĺ������з���ʱ���ѵ�ǰ�ķ������Ҷ������ˣ�����Ҫ�ټ��ϸ��µ�ֵ
			$UpdateSelfSQL="UPDATE `".$this->table."` SET `lft`=`lft`-$tmpValue,`rgt`=`rgt`-$tmpValue WHERE  ".$this->typeWhere." and `id` IN($InIDS)";
		
		
			$this->db->query($middleLeftSQL);
			$this->db->query($middleRightSQL);
			$this->db->query($UpdateSelfSQL);
			$this->db->updateArray($this->table,$data," id ='$SelfCatagoryID' ");

			return 1;

		}else{	//����ǰ�ƶ�ʱ
			
			//���µ�ǰ�������ķ��� �ұ�
			$UpdateRightSQL="UPDATE `".$this->table."` SET `rgt`=`rgt`-$Value WHERE  ".$this->typeWhere." and `rgt`>$Selfrgt ";
			//���µ�ǰ�������ķ��� ���
			$UpdateLeftSQL="UPDATE `".$this->table."` SET `lft`=`lft`- $Value  WHERE  ".$this->typeWhere." and `lft`>$Selfrgt ";

			$middleLeftSQL = "UPDATE `".$this->table."` SET `lft`=`lft`+$Value WHERE  ".$this->typeWhere." and `lft`>$Parentrgt and  id NOT IN($InIDS)";
			$middleRightSQL = "UPDATE `".$this->table."` SET `rgt`=`rgt`+$Value WHERE  ".$this->typeWhere." and `rgt`>=$Parentrgt and id NOT IN($InIDS)";


			//���µ�ǰ���ൽ������֮��ķ���
			//$UpdateLeftSQL="UPDATE `".$this->table."` SET `lft`=`lft`+$Value  WHERE `lft`>=$Selfrgt ";
			$tmpValue = $Selflft-$Parentrgt ;	//����������м�ĸ���
			$tmpValue = $tmpValue;	//�����¸���ĺ������з���ʱ���ѵ�ǰ�ķ������Ҷ������ˣ�����Ҫ�ټ��ϸ��µ�ֵ
			$UpdateSelfSQL="UPDATE `".$this->table."` SET `lft`=`lft`-$tmpValue,`rgt`=`rgt`-$tmpValue WHERE  ".$this->typeWhere." and `id` IN($InIDS)";
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

		//$this->referto("�ɹ��ƶ����","javascript :history.back(1)",3);
		return 1; //�����㷨
 
	} // end func



	/**
	 * ���ƶ�Ϊ������ʱ
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

		//ȡ�����з����ID�����������ֵ
		$CatagoryIDS=$this->getcatagory($SelfCatagoryID,2);
		foreach($CatagoryIDS as $v){
			$IDS[]=$v['id'];
		}
		$InIDS=implode(",",$IDS);


 


		//���µ�ǰ�������ķ��� �ұ�(��������) , ��ǰ�� - ֵ
		$UpdateRightSQL="UPDATE `".$this->table."` SET `rgt`=`rgt`-$Value WHERE  ".$this->typeWhere." and `rgt`>$Selfrgt ";
		//���µ�ǰ�������ķ��� ���(��������)
		$UpdateLeftSQL="UPDATE `".$this->table."` SET `lft`=`lft`- $Value  WHERE  ".$this->typeWhere." and `lft`>$Selfrgt ";
		$this->db->query($UpdateRightSQL);
		$this->db->query($UpdateLeftSQL);

		$sql =" select * from `".$this->table."` where  ".$this->typeWhere." and `id` NOT IN($InIDS) order by rgt desc limit 1 ";
		$this->db->query($sql);
		$NewCatagory	= $this->db->getRow();
		$Parentlft=$NewCatagory['lft'];
		$Parentrgt=$NewCatagory['rgt'];
		
		//print_r($NewCatagory);
		$tmpValue =$Selflft - ( $Parentrgt ) - 1 ;	//����������м�ĸ���
		$tmpValue = $tmpValue;	//�����¸���ĺ������з���ʱ���ѵ�ǰ�ķ������Ҷ������ˣ�����Ҫ�ټ��ϸ��µ�ֵ
		$UpdateSelfSQL="UPDATE `".$this->table."` SET `lft`=`lft`-$tmpValue,`rgt`=`rgt`-$tmpValue WHERE  ".$this->typeWhere." and `id` IN($InIDS)";
 

		//echo $UpdateSelfSQL;
		$this->db->query($UpdateSelfSQL);

		$data['parent_id'] = 0;
		$this->db->updateArray($this->table,$data," id ='$SelfCatagoryID' ");

		return 1;
 
	}


	/** �����ƶ� **/
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

		//ȡ�����з����ID�����������ֵ
		$CatagoryIDS=$this->getcatagory($SelfCatagoryID,2);
		foreach($CatagoryIDS as $v){
			$IDS[]=$v['id'];
		}
		$InIDS=implode(",",$IDS);

		
		//ȡ��һ����Ŀ
		$sql =" select * from  `".$this->table."` WHERE  ".$this->typeWhere." and rgt='".($Selflft-1)."' and parent_id=".$SelfParentID;
		//echo $sql;
		$this->db->query($sql);
		$NewCatagory = $this->db->getRow();

		//����һ����Ŀ����������
		if( is_array($NewCatagory) )
		{

			$Newrgt = $NewCatagory['rgt'];
			$Newleft = $NewCatagory['lft'];

			//���µ�ǰ�������ķ��� �ұ�(��������) , ��ǰ�� - ֵ
			$UpdateRightSQL="UPDATE `".$this->table."` SET `lft`=`lft`+$Value,`rgt`=`rgt`+$Value WHERE  ".$this->typeWhere." and `rgt`<=$Newrgt and `lft`>=$Newleft  ";

 
			$tmpValue =$Newrgt-$Newleft+1;	//����������м�ĸ���
 
			$UpdateSelfSQL="UPDATE `".$this->table."` SET `lft`=`lft`-$tmpValue,`rgt`=`rgt`-$tmpValue WHERE  ".$this->typeWhere." and `id` IN($InIDS)";

			//echo $UpdateRightSQL.'<br>';
			//echo $UpdateSelfSQL;
			//exit;
			$this->db->query($UpdateRightSQL);
			$this->db->query($UpdateSelfSQL);
		}
		//print_r($NewCatagory);

		//exit;

	}

	/** ���������ƶ� **/
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

		//ȡ�����з����ID�����������ֵ
		$CatagoryIDS=$this->getcatagory($SelfCatagoryID,2);
		foreach($CatagoryIDS as $v){
			$IDS[]=$v['id'];
		}
		$InIDS=implode(",",$IDS);

		
		//ȡ��һ����Ŀ
		$sql =" select * from  `".$this->table."` WHERE  ".$this->typeWhere." and lft='".($Selfrgt+1)."' and parent_id=".$SelfParentID;
 		$this->db->query($sql);
		$NewCatagory = $this->db->getRow();

		//����һ����Ŀ����������
		if( is_array($NewCatagory) )
		{

			$Newrgt = $NewCatagory['rgt'];
			$Newleft = $NewCatagory['lft'];

			//���µ�ǰ�������ķ��� �ұ�(��������) , ��ǰ�� - ֵ
			$UpdateRightSQL="UPDATE `".$this->table."` SET `lft`=`lft`-$Value,`rgt`=`rgt`-$Value WHERE  ".$this->typeWhere." and `rgt`<=$Newrgt and `lft`>=$Newleft  ";

 
			$tmpValue =$Newrgt-$Newleft+1;	//����������м�ĸ���
 
			$UpdateSelfSQL="UPDATE `".$this->table."` SET `lft`=`lft`+$tmpValue,`rgt`=`rgt`+$tmpValue WHERE  ".$this->typeWhere." and `id` IN($InIDS)";

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
		//��⸸��ID�Ƿ����
		$sql="SELECT * FROM `".$this->table."` WHERE  ".$this->typeWhere." and `id`='$CatagoryID' LIMIT 1";
		$this->db->query($sql);
		$Result=$this->db->getRow();

		if(count($Result)<1){
			Error::throwError("����ID������,����","javascript :history.back(1)",3);
		}
		return $Result;     
	} // end func


	/** 
	 * ��ȡ������Ϣ
	 */
	function getAll( $where = null,$order=null )
	{
		$sql="SELECT * FROM `".$this->table."` ";
		if( $where )
		{
			$sql.=" where  ".$this->typeWhere . $where;
		}else{
			$sql.=" where  ".$this->typeWhere;
		}

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
									 'catagory` WHERE  ".$this->typeWhere." and `id`='.$CatagoryID); 
		 if($Row = $this->db->fetch_array($Result)) {
			 $Right = array(); 
			 $Query = 'SELECT * FROM `'.$this->tablefix.
						 'catagory` WHERE  ".$this->typeWhere." and lft BETWEEN '.$Row['lft'].' AND '. 
						 $Row['rgt'].' ORDER BY lft ASC';
			 
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
		$Query="SELECT * FROM`".$this->table."` where  ".$this->typeWhere."  ORDER BY `lft` ASC LIMIT 1";
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
