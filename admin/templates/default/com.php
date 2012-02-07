<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>系统管理</title>
		<link href="<?php echo $this->baseurl;?>/css/reset.css" type="text/css" rel="stylesheet" />
		<link href="<?php echo $this->baseurl;?>/css/daybillion.css" type="text/css" rel="stylesheet" />
		<link href="<?php echo $this->baseurl;?>/css/admin.css" type="text/css" rel="stylesheet" />

		<script type="text/javascript" src="<?php echo $this->baseurl;?>/js/jquery-1.2.6.min.js"></script>
	</head>
	<body>
		<div id="doc"  >
			<div id="doc3" >
				<div id="header">
					<wdoc:include type="modules" name="status" />
				</div>
				<div class="component" >
					<div class="contentmenu" ><wdoc:include type="modules" name="left" /></div>
					<div class="com2" style="float:left;width:85%;margin-left:10px;"  >
					<wdoc:include type="message" />
					<wdoc:include type="component" />
					</div>
				</div>
 				<div class="clr"></div>
				<div class="footer">
					<wdoc:include type="modules" name="footer" />
				</div>
			</div>
		</div>
		<script>
		var w=0;
		function setWidth()
		{
			//alert($('.contentmenu').width());
			/** 设定后台的两条宽度 **/

			w=($('body').width() - $('.contentmenu').width()-32 );
			$('#doc').width($('body').width());
 			 if($.browser.msie  ) {
				 w -= 23;
			 }

			 
 			$('.com2').width(  w );
		}
		setWidth();	//设定界面的宽度
		$(window).resize(function(){ setWidth(); });
 		</script>
		<script type="text/javascript" src="<?php echo $this->baseurl;?>/js/jqWDialog.js"></script>
		<script type="text/javascript" src="<?php echo $this->baseurl;?>/js/menu.js"></script>
		<script type="text/javascript" src="<?php echo $this->baseurl;?>/js/jquery.tablednd_0_5.js"></script>
		<script type="text/javascript" src="<?php echo $this->baseurl;?>/js/admin.js"></script>
		
	</body>
</html>

