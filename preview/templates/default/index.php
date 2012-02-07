<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN" "http://www.w3.org/TR/1999/REC-html401-19991224/loose.dtd">
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
 		<meta name="keywords" content="<?php echo $this->keywords;?>">
		<meta name="description" content="<?php echo $this->description;?>">
		<title><?php echo $this->title;?></title> 
		<link rel="stylesheet" type="text/css" href="<?php echo $this->baseurl;?>/css/public.css" />
 		<script type="text/javascript" src="<?php echo $this->baseurl;?>/js/jquery.js"></script>
   	</head> 
	<body >
	<div id="mainbox">
		<wdoc:include type="modules" name="top" />
		<div id="header">
			<wdoc:include type="modules" name="header" /> 
		</div>
		<div id="menudiv" >
		<wdoc:include type="modules" name="navigation" /> 
		</div>
		<div id="pcontent">
			<wdoc:include type="component" />
		</div> 

		<div class="footer" >
 			<div id="hbotm">
					<wdoc:include type="modules" name="footer" />
			</div>
		</div>
	</div>
		<script type="text/javascript" src="<?php echo $this->baseurl;?>/js/common.js"></script>
    </body>
</html>