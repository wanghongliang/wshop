<?php
import('html.html');
import('application.component.view');
class MenusView extends View
{
 	var $rows;
	var $menutypeid;	//当前菜单分类ID
	var $menucom = array(); //菜单分类组件
	var $depth = 0;
	function MenusView()
	{
		$this->menutypeid = intval( $_REQUEST['mtid'] );
		$this->baseuri = 'index.php?com=menu&mtid='.$this->menutypeid;
	}

	function display()
	{
		$lists = $this->get('list');
		$this->rows = $lists['result'];
		$this->menucom = $this->get('menucom');

		$this->path = dirname(__FILE__);

		//菜单分类
		$types = $this->get('types');
		include($this->path.DS.'tmpl'.DS.'list.php');
	}

	/**
	 * 递归循环输出信息
	 */
	function _showRow($pid,$depth=0)
	{
		static $n=1;
 		if( is_array( $this->rows[$pid] ) )
		{
			$depth++;	//加一个深度,当启动递归时
			$items = $this->rows[$pid];
			$len = count($items)-1;
			foreach( $items as $k=> $item )
			{
				if( $depth == 1 ){   $n++;  }
				?>
				<tr >
					<td>
						<input type="checkbox" name="id[]" class="ids" value="<?php echo $item['id'];?>" />
					</td>

					<td  class="fb" >
						<?php

						for($i=1;$i<$depth;$i++){
							echo '&nbsp;<font color=#aaaaaa > </font>&nbsp;';
						}

						?>

						<a href="<?php echo $this->baseuri;?>&task=edit&id=<?php echo $item['id'];?>"  >
						<?php
							//echo $item['id'];
							echo $item['name'];// 名称
							//echo $item['parent_id'];
						?>
						</a>
					</td>
					<td> 
						<?php
						if( $item['home'] == 1 ){ echo '*'; }
						?>	
					</td>
				<td>
				<?php
				if($item['published'] == 1 ){
					?>
					<a href="<?php echo $this->baseuri;?>&task=toggle&attr=published&value=0&id=<?php echo $item['id'];?>" >
					<img src="templates/default/images/tick.png" >
					</a>
					<?php
				}else{
					?>
					<a href="<?php echo $this->baseuri;?>&task=toggle&attr=published&value=1&id=<?php echo $item['id'];?>" >
					<img src="templates/default/images/publish_x.png" >
					</a>
					<?php
				}?>

				</td>



					<td>
						<?php
						if( $k>0){
						?>
						<a href="<?php echo $this->baseuri;?>&task=moveup&id=<?php echo $item['id'];?>" >
						<img src="templates/default/images/uparrow.gif" />
						</a>
						<?php
						}
						?>
					</td>

					<td>
						<?php
						if( $k<$len){
						?>
						<a href="<?php echo $this->baseuri;?>&task=movedown&id=<?php echo $item['id'];?>" >

						<img src="templates/default/images/downarrow.gif" />
						 
						</a>
						<?php
						}
						?>
					</td>


					<td >
 

							<div class="manage_<?php echo $item['component']?$item['component']:$item['type'];?> " >
								<?php
								if( $item['home'] ){
								?>
									<a  class="v"  url="index.php?com=<?php echo $item['component'];?>&menuid=<?php echo $item['id'];?>&mtid=<?php echo $item['tid'];?>"   >
									<?php
										echo '首页内容'; 
									?>
									</a>
								<?php

								}else{
								?>
									<a class="v"  url="index.php?com=<?php echo $item['component'];?>&menuid=<?php echo $item['id'];?>&mtid=<?php echo $item['tid'];?>"   >
									<?php
										echo $item['view_path'];// 视图路径
									?>
									</a>

									<?php
									if($item['iscontent'] == 1 ){
										?>
										<a  class="v"  url="index.php?com=pages&menuid=<?php echo $item['id'];?>&mtid=<?php echo $item['tid'];?>"   >
										 页面内容
										</a>
										<?php
									 
									}?>



								<?php
								}
								?>
 							</div>
 
 
						<?php
						//商品分类为独立的

						/**	2010-2-20
						//if( $icom == 'products' ){
							?>
							&nbsp;

							|
							<a  url="index.php?com=product_types&tmpl=component&menuid=<?php echo $item['id'];?>" class="v"  >
								分类
							</a>

							<?php
								
						//}

						**/

						?>
 

					</td>
					
					<?php 
					
					$icom = $item['component'];	//菜单项的组件名称

 					//如果是组件，删除时提示
					  if(  isset($this->menucom[$icom]) || $icom == 'pages' ){?>




						<td>
							<a href="<?php echo $this->baseuri;?>&task=edit&id=<?php echo $item['id'];?>" class="list_edit">
							编辑
							</a>

							&nbsp;
							<?php
							//是否有子栏
							if( is_array( $this->rows[$item['id']] ) ){

							}else{
							?>
								<a href="javascript:delmenu('<?php echo $this->baseuri;?>&task=delmenu&no_html=1&del[com]=<?php echo $item['component']?>&id=<?php echo $item['id'];?>');" class="list_del"  >
									删除
								</a>
							<?php 
							}	
							?>

						</td>
					<?php }else{ ?>
 
						<td>
							<a href="<?php echo $this->baseuri;?>&task=edit&id=<?php echo $item['id'];?>" class="list_edit" >
							编辑
							</a>

							&nbsp;
	 
							<a href="javascript:del('<?php echo $this->baseuri;?>&task=del&id=<?php echo $item['id'];?>');"  class="list_del" >
								删除
							</a>

						</td>


					<?php } ?>
				
 

					<td>
						<?php
						echo $item['id'];
						?>
					</td>

				</tr>
				<?
				 $this->_showRow($item['id'],$depth);
  			}
		}

	}

}
?>