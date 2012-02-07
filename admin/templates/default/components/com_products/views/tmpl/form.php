<?php
include($this->path.DS.'tmpl'.DS.'toolbar_form.php');
import('html.editor');
$editor = Editor::getInstance($GLOBALS['config']['editor']);
?>
<style type="text/css" >
.formtable tr td.form_text{ width:15%; }
.pimg_table{ width:100%}
.pimg_table tr td{ border:0px; }
.sv,.sv2,.s_v{ border:1px solid #3366CC; padding:2px 5px; background:#FFFFCC; text-align:center; cursor:pointer;   }
.s_v{ float:left; margin:5px 0px 5px 5px;white-space:nowrap; }
.sv2{ background:white; }
#spec_sel{ border:1px solid #3366CC; width:185px; position:absolute; display:none;
	min-height:30px;background:#fcfcfc;padding:5px;
}
.a_thumb{  height:50px;width:50px;float:left;border-right:1px solid #aaa;}
.atext{  height:20px; overflow:hidden;   background:#f0f0f0; border-bottom:1px solid #aaa; }
.asimg{ cursor:pointer; }
.aimg{ width:95px;height:50px;border:border:1px solid #3366CC; border:1px solid #3366CC; text-align:center; float:left; margin-right:5px;}
</style>

<form action="index.php?com=products"  method="post" name="menage_form"  id="menage_form"  >

	<ul class="switch_con" >
	<li class="con active" > 
	<table class="formtable "     > 
		<tr  >
			<td class="form_text"  ><span class="tips" >*</span>商品名称</td>
			<td>
				<input type="text" name="name" size=60 value="<?php echo $item['name'];?>" />
			</td>
			<td rowspan=11 style="width:32%;vertical-align:top;padding:0px;"   >
			<table class="pimg_table"  >			
			<tr  >
				<td  style="background:#eee;">
 				<input type="button" class="btn2"	 value="上传" onclick="uploadIMG('addpimg',1,'products')" /></td>
				<td  style="background:#eee;" >
					<input type="checkbox" onclick="openThumb()" />上传缩略图
				</td>
			</tr>
			<tr id="uploadthumb" style="display:none;" >
				<td colspan=2 >
					<div class="help" >
					注：列表页商品图片默认由系统自动生成.您也可以上传一张商品图片来覆盖默认的.
					</div>
					<input type="text" id="thumbnail"  name="thumbnail" size=20 value="" /> 
					<input type="button" name="" value="上传图片" onclick="upload('thumbnail',1)" />
					<input type="button" name="" value=".." onclick="selectImage('thumbnail')" />
					<input type="hidden"  name="oldthumbnail"  value="<?php echo $item['thumbnail'];?>" />
				</td>
			</tr>
			<?php
			  if( $item['images'] ){
				 $images = explode(',',$item['images']);
				 $n = count($images);
				}else{ 
				 $images = array();
				 $n=0;
				}
			?>

			<tr>
				<td colspan=2 align=center  style="min-height:150px;" id="pimg"  >


				<?php 
				if( $n < 1 ){
				?> 
				此处显示商品页默认图片<br>
				[您还未上传商品图片！] 

				<?php }else{ 

				if( $pos = strpos($item['images'],'|1') ){
					$tmp=substr($item['images'],0,$pos);
					$tmp_a = explode(',',$tmp);
					$outimg = $tmp_a[count($tmp_a)-1];
				}else{
					$outimg = $images[0];
				}

				?> 
				<img src="<?php echo $outimg;?>" width=200 /> 

				<?php } ?>
		 
				<?php
				  /**
				  foreach( $images as $k=> $img )
				  {
				 ?> 
						 
					<input type="text" id="images<?php echo $k;?>"  name="images[]" size=20 value="<?php echo $img;?>" />
					<input type="button" name="" value="上传图片" onclick="upload('images<?php echo $k;?>')" />

					<span onclick="addTR(this)" class="addtr" >+</span>
					<span onclick="delTR(this)" class="deltr" >-</span>
					 
				 <?php
				  }
				  **/
				?>
			</td>
			</tr>
			<tr>
				<td colspan=2 >
				<div class="pimg_list" >
					<ul>
					<?php
					  foreach( $images as $k=> $v )
					  {
						 if( $v ){
							$img = explode('|',$v);
						 ?> 
							<li>
							<div class="pimg_thumb 
							<?php if( $img[1] == '1' ){ echo 'active def'; }?>" onclick="selectPIMG(this)" >
							<img src="<?php echo $img[0];?>" width=50 height=50 />
							</div>
							
							<div class="del" >
							<a  onclick="delpimg(this);" >删</a>  
							<a onclick="setThumb(this);" >缩</a>  
							<a onclick="setDefault(this);" >默</a>
							</div>
							</li>
						 <?php
						  }
					  }
					?>
					</ul>
				</div>

				<input type="hidden"  value="<?php echo $item['images'];?>" name="images" id="images" />
	 		</td>
			</tr>
		  </table>
			</td>
		</tr>
 


 		<tr  >
			<td class="form_text" ><span class="tips" >*</span>商品分类</td>
			<td>		
					<?php 
					$data_type = array(0=>'请选择...');
					$data_type = Form::_buildTreeOptions($type,0,0,0,$data_type);
					echo Form::dropdown('catid',$data_type,$item['catid'],' onchange="changeAttr(this.value,\''.$item['id'].'\')"');
					//print_r($data);
					?> 

					更改商品分类后，扩展属性内容会改变.
			</td>
		</tr>

 		<tr  >
			<td class="form_text" >扩展分类</td>
			<td>		
			<input type="button" class="btn2" onclick="addOtherCat(this.parentNode)" value="添加">
			<?php
			if( count($item['other_cat'])>0 ){
				foreach( $item['other_cat'] as $k=>$v ){
					echo Form::dropdown('other_cat[]',$data_type,$v['cat_id'],'  ');
				}
			}
			?>
			</td>
		</tr>
 		<tr  >
			<td class="form_text" > 所属品牌</td>
			<td>		
					<?php 
					$brands_data = array(0=>'请选择...');
					$brands_data += $brands;
					echo Form::dropdown('brand_id',$brands_data,$item['brand_id'],' onchange="changeAttr(this.value,\''.$item['brand_id'].'\')"');
					//print_r($data);
					?>  
 			</td>
		</tr>
		<tr  >
			<td class="form_text" >商品编号</td>
			<td>
				<input type="text" name="model" size=30 value="<?php echo $item['model'];?>" />
			</td>
		</tr>


 		<tr  >
			<td class="form_text" >本店售价</td>
			<td>
				<input type="text"  name="shop_price" size=30 value="<?php echo $item['shop_price'];?>" />
			</td>
		</tr>


		<tr  >
			<td class="form_text" >市场售价</td>
			<td>
				<input type="text"   name="market_price" size=30 value="<?php echo $item['market_price'];?>" />
			</td>
		</tr>
 

		<tr >
			<td class="form_text" >重量</td>
			<td>
				<input type="text"   name="wei" size=30 value="<?php echo $item['weight'];?>" id="weight"  /> 
		 

			</td>
		</tr>
		<tr >
			<td class="form_text" >库存</td>
			<td>
				<input type="text"   name="sto" size=30 value="<?php echo $item['store'];?>" id="store"  /> 
		 

			</td>
		</tr>
	 




 		<tr >
			<td class="form_text" >上市时间</td>
			<td>
				<input type="text"   name="market_time" size=30 value="<?php echo $item['market_time'];?>" id="market_time"  />
				<input type="button" class="btn" value="选择" onclick="return showCalendar('market_time', '%Y-%m-%d', '24', false, 'selbtn1');" id="selbtn1" name="selbtn1" >
		 

			</td>
		</tr>
	 		<?php
		//print_r($GLOBALS['config']['options']);
		if( $GLOBALS['config']['options']['integralway'] == 2 ){ ?>
		<tr >
			<td class="form_text" >赠送积分</td>
			<td>
				<input type="text"   name="give_integral" size=30 value="<?php echo $item['give_integral'];?>" id="give_integral"  /> 
				<div class="help" >
					注：购买该商品后会赠送相应的积分.
				</div>
			</td>
		</tr>
		<?php } ?>
	 
		

	</table>



<?php

$model = &$this->getModel();
$type_id= (int)$product_type['type_id'];
$attribs = (array)unserialize( $item['attribs'] );
$aimg = $attribs['aimg'];
$attribs = $attribs['attr'];

//已选择的类型
$spec = array();


//该商品分类有相关的商品属性 
$attr = $model->getAttr( $type_id ); 

$specs_list = array();
foreach( $attr as $row ){
	if( $row['attr_type']>1 ){
		$specs_list[] = &$row;
	}
}
?>

 <div id="attrlist" >
	<?php 
	if( $type_id>0 ){  
	//print_r($attribs);

		if( count($specs_list)>0 ){
 	?>

			相关规格
			<table class="formtable attrtable" >
			<?php
			//关联的商品值 
			$attr_v= $model->getAttrV($item['id']); 
			$attr_select = array();
			


			$n=0;

 			foreach( $specs_list as $row ){
 			//已加载的相关图片
			$attr_img = '';
			?>
			<tr>
				<td   class="form_text" >
					<?php echo $row['attr_name'];?>
				</td>
				<td class="at<?php echo $n++;?>" >
					<?php
					$values = explode("\n",$row['attr_values']); 
					foreach( $values  as $va ){
						$v2  = explode(':',$va);
						$v = isset($v2[1])?trim($v2[1]):trim($v2[0]);
						 ?>
							<input type="checkbox"  onclick="loadSpec(this);" title="<?php echo $v;?>" aid="<?php echo $v2[0];?>" name="attr_value_id[<?php echo $v2[0];?>]" value="<?php echo $row['attr_id'];?>"
							
							<?php 
							//选取对应的值，用于扩展属性	
							if( isset($attr_v[$v2[0]]) ){ 
								echo ' checked '; 
								$attr_select[$row['attr_id']][] = $v;
							} ?>
							/>
						 <?php
							 echo $v;
							 echo '&nbsp;&nbsp;';

							if( isset($aimg[$v2[0]]) ){
								$attr_img.='<div class="aimg" id="'.$v2[0].'" ><span class="a_thumb" >';
								if( !empty( $aimg[$v2[0]] ) ){
								$attr_img.='<img src="'.$aimg[$v2[0]].'" width=50 />';
								}
								$attr_img.='</span><div class="atext" >'.$v.'</div><div onclick="selectRelated(this)" class="asimg"   >选图</div><input type="hidden" name="attr_img_list['.$v2[0].']" value="'.$aimg[$v2[0]].'" size=10 class="i_thumb" /></div>';
							}
					}
					?>
					
					<?php if( $n<2 ){ ?>
					<div class="attrimg" >
					<?php 
						echo $attr_img;
					?>
					
					</div>
					<?php } ?>

				</td>
			</tr>

			<?php
			 
		}

		//print_r($attr_select);
		?>

		<tr>
			<td class="form_text">
			规格

			</td>
			<td>
		<table class="listtable spec"  style="margin:0px;" >
			<tr>
			<th>
				货号
			</th> 
			<?php
			$n = 0;
			$spec_ids = array();

			
			foreach( $attr as $k2=>$row ){

				if( count($attr_select[$row['attr_id']]) < 1 ){
					//continue;
				}
			  if( $row['attr_type']>1 ){ 

				
				$values = (array)$attr_select[$row['attr_id']];

 				//$data=array(0=>'请选择..');
				
				$vals = array();
				foreach( $values as $k=>$v ){ $vals[$v]=$v;}
				 
				$row['data'] = $vals;
			  ?>
				<th width="60" ><?php echo $row['attr_name'];?></th>
				<?php	
				//$addTR .= '<td>'.Form::dropdown('spec_['.$row['attr_id'].'][]',$vals,'',' class="spec_option" ' ).'</td>';
			  $addTR .= '<td><div class="sv2" onclick="selSpec(this,'.$k2.');" >选择</div><input type="hidden" class="svinput" name="spec_['.$row['attr_id'].'][]" value="" /></td>';
				$spec_ids[] = $row['attr_id'];	//附加的规格ID
				$spec[] = $row;
			  }
			}
			?> 
  
			<th>
				销售价
			</th>
			<th>
				市场价
			</th>
			<th>
				重量
			</th>
			<th>
				库存
			</th>
			<th>
				操作
			</th>
			</tr> 
			<?php
			$spec_value = (array)unserialize( $item['specs'] );// $model->getSpecValue($item['id']);
			

			 
				//print_r($spec_value);
		    foreach( $spec_value as $k=>$v ){
				if( empty( $v ) ){ continue; }
				$sv = explode(',',$v['attr']);
				
				//print_r($sv);
 				?>
				<tr>
					<td><input type="text" name="pn[]" size=10  value="<?php echo $v['pn'];?>" /></td>
					<?php
					$n=0;
					foreach( $spec as $k=>$v2 ){ 
					?>
					<td>
						<?php 
						//echo Form::dropdown('spec_['.$v2['attr_id'].'][]',$v2['data'],$sv[$n++],' class="spec_option" ' );

						if( empty( $sv[$k] ) ){
						?>
						<div class="sv2" onclick="selSpec(this,<?php echo $k;?>)" >
							选择
						</div>
						<?php
						}else{
						?>
						<div class="sv" onclick="selSpec(this,<?php echo $k;?>)" >
						<?php echo $sv[$k];?>
						</div>
						<?php
						}
						?>

						<input type="hidden" name="spec_[<?php echo $v2['attr_id'];?>][]" value="<?php echo $sv[$k];?>" class="svinput" />


					</td>
					<?php	 
					}

					?>	
					<td><input type="text" name="price[]" size=5 value="<?php echo $v['price'];?>" /></td>
					<td><input type="text" name="cost[]" size=5 value="<?php echo $v['cost'];?>" /></td>
					
					<td><input type="text" name="weight[]" size=5 value="<?php echo $v['weight'];?>" /></td> <td><input type="text" name="store[]" size=5 value="<?php echo $v['store'];?>" /></td>
					<td><a href="javascript:;;" onclick="delSpec(this.parentNode,0);" >删除</a>
					<input type="hidden" name="products_spec_id[<?php echo $v['products_spec_id'];?>]" value="<?php echo $v['products_spec_id'];?>" /> 
					</td>
				</tr>
				<?php
			}
			?>
		</table>

		<input type="hidden" name="delspec" value=""/>
		<input type="hidden" name="spec_id_str" value="<?php echo implode(',',$spec_ids);?>"/>
 
		<input type="button" class="btn" value="添加规格" onclick="addSpec();" />
	</table>	

					</td>
				</tr>
			</table>


		<?php } ?>


		<?php if( count($attr)>0 ){ ?>
		商品扩展属性：

		<table class="formtable attrtable" >

 
			<?php  
			foreach( $attr as $row ){

				if( $row['attr_type']>1 ) continue; 
				//$values = (array)$attr_values[$row['attr_id']]; 
				$values = (array)$attribs[$row['attr_id']]; 

 				 if( $row['attr_type'] >0 ){
				?>
				<tr>
					<td class="form_text" >
						-
					<?php echo $row['attr_name'];?>
					</td>

					<td>
					<?php

					//print_r($values);
					$vals = explode("\n",$row['attr_values']); 
					?>
					<select name="attr_value_id2[<?php echo $row['attr_id'];?>]" onchange="setAttrValue(this)"  >
					<option value="" >请选择..</option>
					<?php 
					foreach( $vals  as $va ){
						$v  = explode(':',$va);
						$v2 = isset($v[1])?trim($v[1]):trim($v[0]);
						$data[$v[0]] = $v2;
						?>
						<option value="<?php echo $v[0];?>" <?php if( $values[0]==$v2 ){ echo 'selected';}?> ><?php echo $v2;?></option>
						<?php
					}

					?>
					</select>
					<input type="hidden" value="<?php echo $values[0];?>" class="avl"  name="attr_value_list[]" />
					<?php
					//',$data,$values[0],'  ' );
					echo Form::hidden('attr_id_list[]',$row['attr_id']);
 
					?>
					
					</td>
				</tr>
				<?php

				}else{
				?>
				<tr>
					<td class="form_text" >
 
					<?php echo $row['attr_name'];?></td>
					<td><?php 
					//echo $attr_values[$row['attr_id']][0]['attr_value'];
 
					//echo $this->attrForm(&$row,$values[0]['attr_value'],$values[0]['attr_price'],$values[0]['tb']);

					echo $this->attrForm($row,$values[0]);
					
					?></td>
				</tr>
				<?php
				}
				
			} ?>
		</table>
		
	<?php
	}
 }
	?>
	<input type="hidden" name="type_id" id="type_id" value="<?php echo $product_type['type_id'];?>" />
</div>

	</li>

	<li class="con" >
		<?php
		echo $editor->display('fulltext',$item['fulltext'],'100%','450');
		?> 
	</li>
	<li class="con" >
		<?php
		echo $editor->display('packaging',$item['packaging'],'100%','450');
		?> 
	</li>

 
	<li class="con" >
		<table class="formtable"     > 

 		<tr  >
			<td class="form_text" valign=top   >商品页面标题：</td>
			<td class="db-pt5 db-pb5">
				<textarea cols=50 rows=2 name="title" ><?php echo $item['title'];?></textarea>(留空则默认显示商品名称)
			</td>
		</tr>

		<tr  >
			<td class="form_text" valign=top   >META_KEYWORDS：
(页面关键词</td>
			<td class="db-pt5 db-pb5">
				<textarea cols=50 rows=2 name="metakey" ><?php echo $item['metakey'];?></textarea> (留空则默认继承分类或全局设置的KEYWORDS内容)
			</td>
		</tr>

 		<tr>
			<td  class="form_text db-pt5"  valign=top  >META_DESCRIPTION：
(页面描述)</td>
			<td  class="db-pt5 db-pb5">
				<textarea cols=50 rows=5 name="metadesc" ><?php echo $item['metadesc'];?></textarea>  (留空则默认继承分类或全局设置的DESCRIPTION内容)
			</td>
		</tr>
		</table>


	</li>
	<li class="con" >


	<table width="90%" align="center" style="display: table;" class="linkproducts-table">
          <!-- 商品搜索 -->
          <tbody><tr>
            <td colspan="3">
              <img height="22" width="26" border="0" alt="SEARCH" src="templates/default/images/icon_search.gif"> 
			<?php  
			 echo Form::dropdown('cat_id1',$data_type,$item['catid'],'   ');
			 
			//print_r($data);
			?> 
              <input type="text" name="keyword1">
              <input type="button" onclick="searchProducts(sz1,'cat_id1','keyword1')" class="btn" value=" 搜索 ">
            </td>
          </tr>
          <!-- 商品列表 -->
          <tr>
            <th>可选商品</th>
            <th>操作</th>
            <th>跟该商品关联的商品</th>
          </tr>
          <tr>
            <td width="42%" valign=top >
              <select multiple="true" ondblclick="sz1.addItem(false, 'addlink')" style="width: 100%;" size="20" name="source_select1">
              </select>
            </td>
            <td align="center">
              <p><input type="radio" checked="checked" value="0" name="is_single">单向关联<br><input type="radio" value="1" name="is_single">双向关联</p>
              <p><input type="button" class="btn" onclick="sz1.addItem(true, 'addlink')" value="&gt;&gt;"></p>
              <p><input type="button" class="btn" onclick="sz1.addItem(false, 'addlink')" value="&gt;"></p>
              <p><input type="button" class="btn" onclick="sz1.dropItem(false,'droplink')" value="&lt;"></p>
              <p><input type="button" class="btn" onclick="sz1.dropItem(true,'droplink')" value="&lt;&lt;"></p>
            </td>
            <td width="42%">
              <select ondblclick="sz1.dropItem(false,'droplink')" multiple="" style="width: 100%;" size="20" name="target_select1">
			  <?php
			  if( $item['id'] ){
				  $selected = $model->getSelected($item['id']);
				  foreach(  $selected as $k=>$v ){
					  ?>
					  <option value="<?php echo $v['id'];?>" ><?php echo $v['name'];if( $v['is_double']>0){ echo '[双向联接]'; }else{ echo '[单向联接]'; }?></option>
					  <?php
				  }
			  }
			  ?>
			 </select>
            </td>
          </tr>
        </tbody></table>
	
	</li>
	<li class="con" >
	<table width="90%" align="center" style="display: table;" class="linkproducts-table">
          <!-- 商品搜索 -->
          <tbody><tr>
            <td colspan="3">
              <img height="22" width="26" border="0" alt="SEARCH" src="templates/default/images/icon_search.gif">
              <?php  echo Form::dropdown('cat_id2',$data_type,$item['catid'],'   ');  ?>
              <input type="text" name="keyword2">
              <input type="button" class="btn" onclick="searchProducts(sz2, 'cat_id2', 'keyword2')" value=" 搜索 ">
            </td>
          </tr>
          <!-- 商品列表 -->
          <tr>
            <th>可选商品</th>
            <th>操作</th>
            <th>该商品的配件</th>
          </tr>
          <tr>
            <td width="42%">
              <select ondblclick="sz2.addItem(false, 'addgroup' )" onchange="sz2.priceObj.value = this.options[this.selectedIndex].id" style="width: 100%;" size="20" name="source_select2">
              </select>
            </td>
            <td align="center">
              <p>价格<br><input type="text" size="6" name="price2"></p>
              <p><input type="button"  class="btn" onclick="sz2.addItem(false, 'addgroup' )" value="&gt;"></p>
              <p><input type="button"  class="btn" onclick="sz2.dropItem(false, 'dropgroup' )" value="&lt;"></p>
              <p><input type="button"  class="btn" onclick="sz2.dropItem(true, 'dropgroup' )" value="&lt;&lt;"></p>
            </td>
            <td width="42%">
              <select ondblclick="sz2.dropItem(false, 'dropgroup' )" multiple="" style="width: 100%;" size="20" name="target_select2">
			 <?php
			  if( $item['id'] ){
				  $grouped = $model->getGroup($item['id']);
				  foreach(  $grouped as $k=>$v ){
					  ?>
					  <option value="<?php echo $v['id'];?>" ><?php echo $v['name'];?>-<?php echo $v['products_price'];?></option>
					  <?php
				  }
			  }
			  ?>
              </select>
            </td>
          </tr>
        </tbody></table>
	
	</li>
	<li class="con" ></li>
	<li class="con" ></li>
	</ul>

	<div class="formbtn" >
		<input type="button" class="submit_btn" value="保存"/>
		<input type="button" class="apply_btn" value="应用" />
		<input type="reset" class="cancel_btn" value="取消" />
		
	</div>
				<input type="hidden" value="save" name="task" id="task" />
				<input type="hidden" value="<?php echo $item['id'];?>" id="productid" name="id" />
				<input type="hidden" value="<?php echo $this->menuid;?>" name="menuid" />
				<input type="hidden" value="" name="return" id="return"  />
				<input type="hidden" value="<?php echo $_REQUEST['tmpl'];?>" name="tmpl" />
				<input type="hidden" value="0" name="recreate" id="recreate" />



</form>

<div id="spec_sel" >

</div>
<script language="javascript" >

	var spec = [<?php
	$n=0;$c=count($spec)-1;
	foreach( $spec as $k=>$v2 ){ 
	 echo '[\'',implode('\',\'',$v2['data']),'\']'; 
	 if( $n++ < $c){ echo ',';}
	} 
	?>];

	var baseuri = '<?php echo $this->baseuri;?>';
	var product_id = '<?php echo $item['id'];?>';
	var url_current ='<?php echo URI::current();?>';
	var addTR = '<?php echo str_replace("\n","",$addTR);?>';
	var com='products';


	$(function(){

			$('.selectseries').click(function(){
 
				// 继承属性
				var options = {title:'请选择图集',width:800,height:450,
					url:'index.php?com=series&tmpl=component',
					isget:true,
					reload:true,
					iframe:true
				};
				$.w.createDialog(options,3);
			});
			$('.submit_btn').click(function(){	
				if( checkForm() ){
					$('#menage_form').get(0).submit();
				} 
			});

			$('.apply_btn').click(function(){	
				if( checkForm() ){
					$('#return').attr('value',url_current);
					$('#menage_form').get(0).submit();
				} 
			});

			$('.cancel_btn').click(function(){
				location.href='index.php?com=products<?php if( $_REQUEST['tmpl'] != '' ){ echo "&tmpl=".$_REQUEST['tmpl'];}?>&menuid=<?php echo $this->menuid;?>';
			});
	 
			$('body').click(function(event){
				//alert(event.target.className);
				if( event.target.className.indexOf('sv') ==-1 ){
					$('#spec_sel').hide();
				}
			});

			
		});
	
	function checkForm(){
		var name = $('input[name=name]').val();
		var type = $('select[name=catid]').val();
		if( name == '' || type=='' || type== '0' ){
			alert('请填写必填项.');
			return false;
		}
		return true;
	}

	function setAttrValue(obj){
		var index = obj.selectedIndex;
		var text = obj.options[index].text;
		var value = obj.options[index].value;

 		$('.avl',obj.parentNode).val( text );
		//alert($('.avl',obj.parentNode).val());
	}

	var cSelSpec;

	//选择属性
	function selSpec(obj,n){
		cSelSpec = obj;
		
		var offset = $(obj).offset();
		$('#spec_sel').css({top:(offset.top+28),left:offset.left,display:'block'});
		var s='';
		var is = false;
		for(i=0;i<spec[n].length;i++){

			//$('.sv').each(function(k,v){
				//alert(v.innerHTML);
				//if($.trim(v.innerHTML) == spec[n][i] ){
					//is=true;
					 
				//}
			//});

			if(spec[n][i] ){
				s+='<div class="s_v" >'+spec[n][i]+'</div>';
			}
			is=false;
		}
		if( s.length < 2 ){ s='<div align=center>该项属性已选择完【<span onclick="reSelSpec(this)" >重设</span>】</div>'; }
		$('#spec_sel').html(s);
		$('#spec_sel .s_v').click(function(){ 
			//alert( this.innerHTML);
			if( cSelSpec ){
				cSelSpec.innerHTML=this.innerHTML;
				cSelSpec.className='sv';
				$('.svinput',cSelSpec.parentNode).val(this.innerHTML);
			}
		}); 
	}

	function reSelSpec(obj){
		var p = cSelSpec;
		p.className="sv2";
		p.innerHTML='选择';
	}


	function loadSpec(obj){ 

		if( obj.checked == false ){
 			var s = false;
			var t = $(obj).attr('title');
			$('.sv').each(function(k,o){
				if( $.trim(o.innerHTML)==t){
					if( !confirm( "将删除对应的规格信息,请确认. ") && s==false ){ s=true; return false; }
				     $(o.parentNode.parentNode).remove();
					
				}
			});
		}

			var tag=false;
			$(".aimg",obj.parentNode).each(function(){
				
					if( $(this).attr('id')==$(obj).attr('aid') ){
						if( obj.checked == true ){
							tag=true;
						}else{
							$(this).remove();
						}
					}  
			});
			if( tag == false &&  obj.checked == true  && $(".attrimg",obj.parentNode) ){
				$(".attrimg",obj.parentNode).append('<div class="aimg" id="'+$(obj).attr('aid')+'" ><span class="a_thumb" ></span><div class="atext" >'+$(obj).attr('title')+'</div><div onclick="selectRelated(this)" class="asimg"   >选图</div><input type="hidden" name="attr_img_list['+$(obj).attr('aid')+']" value="" size=10 class="i_thumb" /></div>');
			}else{

			}
	
		var s;
		for(i=0;i<spec.length;i++){
			s=[]; 
			var k=0;
			$('.at'+i+' input').each(function(k,o){
 				if( o.checked == true){
					s[k++]=$(o).attr('title');
				}
			});
 			spec[i]=s;
		}
	}

	  /**
   * 添加扩展分类
   */
  function addOtherCat(conObj)
  {
      var sel = document.createElement("SELECT");
      var selCat = document.forms['menage_form'].elements['catid'];

      for (i = 0; i < selCat.length; i++)
      {
          var opt = document.createElement("OPTION");
          opt.text = selCat.options[i].text;
          opt.value = selCat.options[i].value;
          if ($.browser.msie)
          {
              sel.add(opt);
          }
          else
          {
              sel.appendChild(opt);
          }
      }
      conObj.appendChild(sel);
      sel.name = "other_cat[]";
      sel.onChange = function() {checkIsLeaf(this);};
  }

    /**
     * 检查是否底级分类
     */
    function checkIsLeaf(selObj)
    {
        if (selObj.options[selObj.options.selectedIndex].className != 'leafCat')
        {
            alert('您选择的商品分类不是底级分类，请选择底级分类');
            selObj.options.selectedIndex = 0;
        }
    }

</script>
<script type="text/javascript" src="templates/default/js/product.js"></script>
<script type="text/javascript" src="templates/default/js/calendar/calendar.js"></script>

<link href="templates/default/js/calendar/calendar.css" rel="stylesheet" type="text/css" />
