<?
class WTypeHtml extends WHtml{

	//菜单按钮
	function showMenu(){
		?>
			<div class="dot_new" ><a href="<?echo $this->_uri->get(array('act'=>'create'));?>" >新建</a></div>

			<div class="dot_load" ><a href="javascript:window.location.reload();" >刷新</a> </div>
			<div class="dot_home" ><a href="<?echo $this->_uri->get(array('act'=>'showlist'));?>" >列表</a></div>
		<?
	}

	//显示树状结构
	function createTypeTree( &$v  ){
			
		   $is_depth=$v['depth'];
		   if($v['next_id']>0)
			{
			  $is_line[$is_depth]=1;
			}else
			{
			  $is_line[$is_depth]=0;
			}
			//如果是子栏目，会输出相应小图标
			if($is_depth>0){
			echo '<div class=line5></div>';
			for($i=1;$i<=$is_depth;$i++){

				if($i==$is_depth)
				{
					if($v['next_id']!=0)
					{
						echo '<div class=line1></div>';
					}else{
						echo '<div class=line2></div>';
					}
				}else{
					if($is_line[$i]==1){
						echo '<div class=line3></div>';
					}else{
						echo '<div class=line3></div>';
					}
				}
				//echo  "&nbsp;&nbsp;&nbsp;" ;
			}
			}
			echo '<div class="tframe" >';
			if($v['child']>0){
				echo "<div class=folder2></div>" ;
			}else{
				echo "<div class=folder1></div>" ;
			}
			?>
			<a href="<?echo $this->_uri->get(array('id'=>$v[$par['id']],'act'=>'edit'));?>" >
			<?
				echo ($v['child']>0 || 0==$v['parent_id'])?'<b>'.$v['title_name'].'</b>':$v['title_name'];
			?>
			</a>
			</div>
	<?
	}

	//状态
	function showState($var,$id ){
		if(1==$var){?>
			<a href="<?echo $this->_uri->set(array('id'=>$id,'act'=>'lock'));?>" >
				<div class="stateok" ></div>
			</a>
		<?}else{?>			
			<a href="<?echo $this->_uri->set(array('id'=>$id,'act'=>'unlock'));?>"  >
				<div class="stateno" ></div>
			</a>
		<?}
	}
	
	//操作
	function showOperation(){
		echo '<a href="'.$this->_uri->get(array('act'=>'create')).'"  ><div class="addsub" >添加子栏</div></a>';
		echo '<a href="'.$this->_uri->get(array('act'=>'edit')).'" ><div class="edit" title="编辑" ></div></a>';
		echo '<a href="'.$this->_uri->get(array('act'=>'del')).'" ><div class="drop" title="删除" ></div></a>';
	}
	
	//选择所属栏目
	function showSelectList(&$data){
		?>
		<select name="parent_id" >

		 <option value="" >一级栏目</option>
          <?
			foreach($data as $k=>$v)
			{
				$is_depth=$v['depth'];

				$is_tem.='<option value="'.$v['title_id'].'" ';
				if($x==$v['title_id']){
					$is_tem.=' selected ';
				}
				$is_tem.='>';
		
				if($v['next_id']>1)
				{
					$is_line[$is_depth]=1;
				}else
				{
					$is_line[$is_depth]=0;
				}
				if($is_depth >0){
					$is_tem.="";
					for($i=1;$i<=$is_depth;$i++){
						if($i==$is_depth){
							if($v['next_id']>0){
								$is_tem.="├";
							}else{
								$is_tem.="└";
							}
						}else{
							if($is_line[$i]==1)
								$is_tem.="│";
							else
								$is_tem.="&nbsp;";
						}
					}
				}
			
		
		
			$is_tem.=$v['title_name'];
			if($v['http']!='')
				$is_tem.='[外部]';
			$is_tem.='</option>';
			}
			echo $is_tem;
		    echo '</select>';

	}
}
?>