<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN" "http://www.w3.org/TR/1999/REC-html401-19991224/loose.dtd">
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
 		<meta name="keywords" content="<?php echo $this->keywords;?>">
		<meta name="description" content="<?php echo $this->description;?>">
		<title><?php echo $this->title;?></title> 
		<link rel="stylesheet" type="text/css" href="<?php echo $this->baseurl;?>/css/public.css" />
		<LINK href="<?php echo $this->baseurl;?>/css/index.css" type="text/css" rel="stylesheet">
		<script type="text/javascript" src="<?php echo $this->baseurl;?>/js/jquery.js"></script>
   	</head>
	<body>
	<div id="mainbox">
		<wdoc:include type="modules" name="top" />
		<div id="header">
			<wdoc:include type="modules" name="header" /> 
		</div>
		<div id="menudiv" >
		<wdoc:include type="modules" name="navigation" /> 
		</div>
		<div class="fleft190">
			<wdoc:include type="modules" name="hlft" />
 
		</div>

		<div id="hcenter">
			<wdoc:include type="modules" name="hcenter" /> 
		</div>

		<div class="fright190">
			<wdoc:include type="modules" name="hrgt" />

		</div>
		<wdoc:include type="modules" name="main" /> 
		<wdoc:include type="modules" name="footer" /> 
	</div>


	<?php /*
 	<iframe src="http://weather.news.qq.com/inc/ss292.htm" width="190" height="200" frameborder="no" border="0" marginwidth="0" marginheight="0" scrolling="no"></iframe>
	*/?>
 
	<script type="text/javascript" src="<?php echo $this->baseurl;?>/js/common.js"></script>

	</body>
</html>
