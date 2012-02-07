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
					<div class="status" >
					<wdoc:include type="modules" name="status" />
					</div>
					<wdoc:include type="modules" name="menu" />
				</div>
				<div class="component" >
					<div class="com2" >
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
		<?php /**
		<div id="doc"  >
			<div id="doc3" >
				<div id="header">
					<div class="status" >
					<wdoc:include type="modules" name="status" />
					</div>
					<wdoc:include type="modules" name="menu" />
				</div>
				<div id="cpanelhome"  >
					<div class="contentmenu" ><wdoc:include type="modules" name="cleft" /></div>
					<div class="com2" style=""  >
						<div  class="com" >
						<wdoc:include type="message" />
						<wdoc:include type="component" />
						</div>
					</div>
				</div>
 				<div class="clr"></div>
				<div class="footer">
					<wdoc:include type="modules" name="footer" />
				</div>
			</div>
		</div>
		**/ ?>
		<script type="text/javascript" src="<?php echo $this->baseurl;?>/js/jqWDialog.js"></script>
		<script type="text/javascript" src="<?php echo $this->baseurl;?>/js/menu.js"></script>
		<script type="text/javascript" src="<?php echo $this->baseurl;?>/js/jquery.tablednd_0_5.js"></script>
		<script type="text/javascript" src="<?php echo $this->baseurl;?>/js/admin.js"></script>
		<script type="text/javascript" src="<?php echo $this->baseurl;?>/js/jQuery.textSlider.js"></script>

	</body>
</html>