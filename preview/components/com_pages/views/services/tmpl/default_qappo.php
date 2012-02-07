 <div class="sright">
 		<div><a href="/shouhoufuwu/193.html"><img src="/media/89/banners/media.jpg" width="790" /></a></div>
        <h2 class="stitle2 mag-t10">预约查询</h2>
        <div class="sgform">
           <?php include($p.DS.'default_form.php');?>
        </div>
        <div class="mag-t10">
            <h2 class="stitle2">预约查询结果</h2>
            <table width="100%" cellpadding="0" cellspacing="0" border="1" bordercolor="#e3e3e3" style="border-collapse:collapse;" class="sgtab">
                <tr>
                    <th>预约信息</th><th width="120">预约日期</th><th  width="120" >状态</th>
                </tr>
                <?
				 

					if( count($rows)>0 ){
						foreach( $rows as $k=>$v ){
							?>
							<tr>
								<td>
									<h3><?php echo $v['title'];?></h3>
									<div>
										<?php echo $v['content'];?>
									</div>
								</td>
								<td><?php echo $v['release_date'];?>
								</td>
								<td>
									等待受理
								</td>
							</tr>
							<?php
						}
					}else{
						echo '<tr><td colspan=3 height=200 style="text-align:center;"  > 没有相关记录，请按其它查询条件试试，谢谢.</td></tr>';
					}
                ?>
            </table>
        </div>
    </div>