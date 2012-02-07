<html>
	<head>
		<title>错误页</title>
		<link href="<?php echo $this->baseurl;?>/css/reset.css" type="text/css" rel="stylesheet" />
		<link href="<?php echo $this->baseurl;?>/css/daybillion.css" type="text/css" rel="stylesheet" />
		<link href="<?php echo $this->baseurl;?>/css/admin.css" type="text/css" rel="stylesheet" />
		<script type="text/javascript" src="<?php echo $this->baseurl;?>/js/jquery-1.2.6.min.js"></script>

		<style type="text/css" >
		#doc3{ font-family:Courier New; 
			
		}
		a{ text-decoration:none; color:gray; }
		.error_path{}
		.error_path{
			font-weight:bold;
			line-height:30px;
			height:40px;
		}
		.error_message_i{
			min-height:50px;
			_height:50px;
			background:#FFFFCC;
			border:1px solid #EDEDDE;
			padding-left:10px;
			line-height:30px;
		}

		.error_t{
			color:red;
			font-weight:bold;
			line-height:28px;
		}

		/** trace **/
		.error_trace{
			border-collapse:collapse;
			border:1px solid #eee;
			display:bold;
			text-align:left;
			background:#F1F1F1;
			padding:5px;
		}
		</style>
	</head>
	<body>
		<div id="doc"  >
			<div id="doc3" style="border:1px solid #eee;min-height:600px;_height:600px;" >
			<?php
			//
			global $app;
			
			$msg = $app->getMessageQueue();	//错误信息
			//$msg_backtrace = Error::getBacktrace();	//错误队列
			

			?>
			
			<h1 style="margin:0px;font-family:黑体;line-height:55px;padding-left:10px;"  >系统发生错误</h1>
			<div style="border-top:1px solid #eee;padding-left:10px;font-size:14px;line-height:50px;font-family:宋体; " />
				你可以选择 [<a href="javascript:location.reload();" >重试</a>] [<a href="javascript:javascript:history.back()" >返回</a>] 或者 [<a href="index.php" >回到首页</a>]
			</div>
		

			<div style="padding:0px 10px;font-size:12px; " >


				<div class="error_path" >
				错误位置：
				<?php
				echo $msg[1]['message'][0]['file'];
				?>
				<font style="font-weight:normal"; >
				&nbsp;&nbsp;LINE:
				<?php
 				echo $msg[1]['message'][0]['line'];
				?>
				</font>

				</div>



				<div class="error_t"  >
					<strong>[错误信息]</strong>


				</div>
				<div class="error_message_i">
					<?php echo $msg[0]['message']; ?>
				</div>

				<div class="error_t" >[TRACE]</div>
				<div class="error_trace" >
				 
				
				<?php
				//错误信息
				if ( is_array( $msg[1]['message'] ) )
				{
					$backtrace = $msg[1]['message'];
				 
 					for( $i = count( $backtrace ) - 1; $i >= 0; --$i )
					{
						echo '<div>';
						if (isset( $backtrace[$i]['file'] )) {
							echo ' '.$backtrace[$i]['file'].' ';
						}
						if (isset( $backtrace[$i]['line'] )) {
							echo ' ('.$backtrace[$i]['line'].') ';
						}
						if (isset( $backtrace[$i]['class'] )) {
							echo ' &nbsp; '. $backtrace[$i]['class'].'::';
						}
	 
						if (isset( $backtrace[$i]['function'] )) {
							echo ' '. $backtrace[$i]['function'].' ';
						}

						echo '</div>';
					}
				}





				?>
				</div>

				</div>

			</div>
		</div>

 
	</body>
</html>