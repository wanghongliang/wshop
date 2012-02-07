<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
 		<meta name="keywords" content="<?php echo $this->keywords;?>">
		<meta name="description" content="<?php echo $this->description;?>">
		<title><?php echo $this->title;?></title> 
		<link rel="stylesheet" type="text/css" href="<?php echo $this->baseurl;?>/css/public.css" />
		<link href="<?php echo $this->baseurl;?>/style/member.css" type="text/css" rel="stylesheet"/>
 		<script type="text/javascript" src="<?php echo $this->baseurl;?>/js/jquery.js"></script>
		<script type="text/javascript" src="<?php echo $this->baseurl;?>/js/member.js"></script>
  	</head>
	<body class="bg" topmargin="0" marginheight="0" >

	<div id="mainbox">
	<wdoc:include type="modules" name="top" />
	<div id="header">
		<wdoc:include type="modules" name="header" /> 
	</div>
		<div id="menudiv" >
		<wdoc:include type="modules" name="navigation" /> 
		</div>
	<div id="pcontent">
		<div id="listroot"> <wdoc:include type="modules"  name="breadcrumbs"  /> </div>
		<div class="flv">
			<div class="u_left">
				<h3 class="u_title"> </h3>
				<wdoc:include type="modules"  name="userleft"  /> 
			</div> 
			<div class="u_right">
				<wdoc:include type="component" />
			</div>
		</div> 
	</div>


  	<div class="footer" >
		<div class="cln">&nbsp;</div> 
		<div id="hbotm">
				<wdoc:include type="modules" name="footer" />
		</div>
	</div>
	</div>

 	</body>
</html>