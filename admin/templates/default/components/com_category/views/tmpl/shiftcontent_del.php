<div class="shiftcontent"  >
	<span >
 
		该菜单下有 <?php echo $_REQUEST['max'];?> 项内容，删除时，请选择下列处理方式:
	</span>

	<ul>
		<li> <input type="radio"  name="next"  value=1   /> 删除内容 </li>
		<li> <input type="radio"  name="next" value=2     /> 放入回收站 </li>
		<li id="selectmenu" > 
			<input type="radio"  value=3  name="next"  onclick="loadAllMenu(3)" />
			转移到其它同类菜单 
		<div></div>
		</li>
 	</ul>
	<div>
	<span class="yes" onclick="confirmDel()" >确认</span>
	<span class="no" onclick="cancelDel()"  >取消</span>
	</div>
</div>

<script language="javascript" >
 	function loadAllMenu(n)
	{
			if( $('#selectmenu').find('div').get(0).innerHTML.length > 10 ){ return false; }
			
				var uri = 'index.php?com=menu&mtid=<?php echo $this->menutypeid;?>&id=<?php echo  $_REQUEST['id'];?>&no_html=1&task=ajaxselectmenu&url[com]=<?php echo $_REQUEST['del']['com'];?>';

				/** AJAX方式加载 **/
				$.get(uri,function(data){

					/** 成功后直接选择组件类型 **/
					$('#selectmenu').find('div').get(0).innerHTML += data;
					$.w.loadTop(0);
					$('#selectmenu').find('select').change(function(){
						/** 设置选择菜单的ID **/
						//$('input[name=shiftmenuid]').attr('value',this.value);	

					});
				});
		 
 

		/** **/
	}

	/** 确认删除菜单 **/
	function confirmDel(){
		var v = 0;
		$('input[name=next]').each(function(k,obj){
			if( obj.checked )
			{
				v = parseInt(obj.value);
			}

		});	
		
		if( v < 1 ){
			alert('请选择处理方式!');
			return false;
		}

		//alert(v);
		if( v == 3 )	//选择删除，请选择菜单
		{
			var menuid = parseInt( $('#selectmenu').find('select').get(0).value );
 			
			if( !menuid  )
			{
				alert('请选择菜单!');
				return false;
			}
			location.href="index.php?com=menu&task=delmenuconfirm&mtid=<?php echo $this->menutypeid;?>&shiftway="+v+"&shiftmenuid="+menuid+"&id=<?php echo $_REQUEST['id'];?>";
		}else{
			location.href="index.php?com=menu&task=delmenuconfirm&mtid=<?php echo $this->menutypeid;?>&shiftway="+v+"&id=<?php echo $_REQUEST['id'];?>";
		}

		
	}

	/** 取消删除 **/
	function cancelDel()
	{
		$.w.closeN(10);
	}

  
</script>