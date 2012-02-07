<?php
import('application.component.view');
class CategorysView extends View
{
 	var $rows;
	var $type = array();
	var $depth = 0;

	var $n = 0; //计数器，记录菜单数量

	function CategorysView()
	{
		$this->baseuri = 'index.php?com=category';
	}

	function display()
	{
		$this->rows = $this->get('list');
		$this->path = dirname(__FILE__);
		$this->type = $this->get('type');
		include($this->path.DS.'tmpl'.DS.'list.php');
	}


	/**
	 * 递归循环输出信息
	 */
	function _showRow($pid,$depth=0)
	{
 
 		if( is_array( $this->rows[$pid] ) )
		{
			$depth++;	//加一个深度,当启动递归时
			$items = $this->rows[$pid];
			$len = count($items)-1;
			foreach( $items as $k=> $item )
			{
				//if( $depth == 1 ){   $this->n++;  }
				$this->n++;

				?>
				<tr >
					<td>
						<input type="checkbox" name="id[]" class="ids" value="<?php echo $item['id'];?>" />
					</td>

					<td class="fb">
						<?php

						for($i=1;$i<$depth;$i++){
							echo '&nbsp;<font color=#aaaaaa > </font>&nbsp;';
						}

						?>
						<?php
							//echo $item['id'];
							echo $item['name'];// 名称
							//echo $item['parent_id'];
						?>
					</td>
					<td> 
						<?php
						echo $item['alias'];// 名称
						?>
					</td>
					<td> 
						<?php
						echo $this->type[$item['type_id']];// 类型名称
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
							<a href="javascript:del('<?php echo $this->baseuri;?>&task=del&id=<?php echo $item['id'];?>');"  class="list_del" >
								删除
							</a>
							<?php 
							}
							?>
						</td>
			 
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