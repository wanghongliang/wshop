<div class="shiftcontent"  >
	<span >
 
		该菜单下有 <?php echo $_REQUEST['max'];?> 项内容，改变菜单类型时，请选择下列处理方式:
 
	</span>

	<ul>
		<li> <input type="radio"  name="next"  onclick="loadAllMenu(1)" /> 删除内容 </li>
		<li> <input type="radio"  name="next"   onclick="loadAllMenu(2)"  /> 放入回收站 </li>
		<li id="selectmenu" > <input type="radio"  name="next"  onclick="loadAllMenu(3)" />
		转移到其它同类菜单 
		<div></div>
		</li>
 	</ul>
</div>

<script language="javascript" >
 	function loadAllMenu(n)
	{
			/** 设置清空方式 **/
			$('input[name=shiftway]').attr('value',n);

			/** 如果是前两种直接转向 **/
			if( n == 1 || n==2 ){ 
				$.w.loadDialog('<?php echo 'index.php?com=menu&next=no&id='.$_REQUEST['id'].'&mtid='.$this->menutypeid.'&task=selectcomtype&no_html=1&url[com]='.$_REQUEST['url']['com'];?>',0);	
				return;
			}
			

			/** ajax加载需要选择的菜单项，然后选择一个菜单 **/
			if( !this.isload ){
				this.isload = true;
				
				var uri = 'index.php?com=menu&mtid=<?php echo $this->menutypeid;?>&id=<?php echo  $_REQUEST['id'];?>&no_html=1&task=ajaxselectmenu&url[com]=<?php echo $_REQUEST['url']['com'];?>';

				/** AJAX方式加载 **/
				$.get(uri,function(data){

					/** 成功后直接选择组件类型 **/
					$('#selectmenu').find('div').get(0).innerHTML += data;

				
					$.w.loadTop(0);
					$('#selectmenu').find('select').change(function(){
						/** 设置选择菜单的ID **/
						$('input[name=shiftmenuid]').attr('value',this.value);	
						$.w.loadDialog('<?php echo 'index.php?com=menu&next=no&mtid='.$this->menutypeid.'&task=selectcomtype&no_html=1&url[com]='.$_REQUEST['url']['com'].'&id='.$_REQUEST['id'];?>',0);
						
					});
				});
		 
		}

		/** **/
	}
 
</script>