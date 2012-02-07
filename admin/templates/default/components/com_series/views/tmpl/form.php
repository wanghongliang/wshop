<?php
include($this->path.DS.'tmpl'.DS.'toolbar_form.php');
import('html.editor');
$editor = Editor::getInstance($GLOBALS['config']['editor']);
?>
<style type="text/css" >
.formtable tr td.form_text{ width:15%; }
.pimg_table{ width:100%}
.pimg_table tr td{ border:0px; }
</style>

<form action="index.php?com=series"  method="post" name="menage_form"  id="menage_form"  >

	<ul class="switch_con" >
	<li class="con active" > 
	<table class="formtable"     > 
		<tr  >
			<td class="form_text"  ><span class="tips" >*</span>系列名称</td>
			<td>
				<input type="text" name="name" size=50 value="<?php echo $item['name'];?>" />
			</td>
		</tr>
		<tr>
			<td colspan=2   >


			<table class="pimg_table"  >			
			<tr  >
				<td  style="background:#eee;"><input type="button" class="btn"	 value="上传图片" onclick="uploadIMG('addpimg',1,'products')" /></td>
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
				</td>
			</tr>


			<tr class="" >
				<td>
					图片列表
				</td>
				<td>
					图片预览
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
				<td valign=top >
				<div class="pimg_list" >
					<ul>
					<?php
					  foreach( $images as $k=> $v )
					  {
						 if( $v ){
							$img = explode('|',$v);
						 ?> 
							<li>
							<div class="pimg_thumb <?php if( $img[1] == '1' ){ echo 'active def'; }?>" onclick="selectPIMG(this)" ><img src="<?php echo $img[0];?>" width=50 height=50 /></div><div class="del" ><a  onclick="delpimg(this);" >删</a>  <a onclick="setThumb(this);" >缩</a>  <a onclick="setDefault(this);" >默</a></div>
							</li>
						 <?php
						  }
					  }
					?>
					</ul>
				</div>

				<input type="hidden"  value="<?php echo $item['images'];?>" name="images" id="images" />
	 		</td>
			<td   align=center  style="min-height:150px;" id="pimg"  >


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
		  </table>
 
	
				<input type="hidden" value="save" name="task" id="task" />
				<input type="hidden" value="<?php echo $item['id'];?>" id="productid" name="id" />
				<input type="hidden" value="<?php echo $this->menuid;?>" name="menuid" />
				<input type="hidden" value="" name="return" id="return"  />
				<input type="hidden" value="<?php echo $_REQUEST['tmpl'];?>" name="tmpl" />
				<input type="hidden" value="0" name="recreate" id="recreate" />
			</td>
		</tr>
	</table>
 

	</li>


	</ul>

	<div class="formbtn" >
		<input type="button" class="submit_btn" value="保存"/>
		<input type="button" class="apply_btn" value="应用" />
		<input type="reset" class="cancel_btn" value="取消" />
	</div>
</form>
<script language="javascript" >
	var baseuri = '<?php echo $this->baseuri;?>';
	var product_id = '<?php echo $item['id'];?>';
	var url_current ='<?php echo URI::current();?>';
	var addTR = '<?php echo str_replace("\n","",$addTR);?>';
	var com = 'series';
	$(function(){
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
				location.href='index.php?com=series<?php if( $_REQUEST['tmpl'] != '' ){ echo "&tmpl=".$_REQUEST['tmpl'];}?>&menuid=<?php echo $this->menuid;?>';
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
</script>
<script type="text/javascript" src="templates/default/js/product.js"></script>
