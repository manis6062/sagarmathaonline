<?php 
	$offsetsmall = 0;
?>
<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->
<html lang="en">
<!--<![endif]-->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-16">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>
<meta name="Keywords" content="Nepali Online NewsPaper sagarmatha online news all news nepal news"/>
<meta name="Description" content="Nepali Online NewsPaper"/>
<meta name="google-site-verification" content="r2Y4dUJhaTKnnK6E0xb3hfwPusIvnwtsydCZndDnmNo" />
<meta name="copyright" content="sagarmatha online"/>
<meta name="robots" CONTENT="all">
<meta name="email" content="info@eshantimarga.com"/>
<title>Sagarmatha online | Online News paper </title>
<link href="<?php echo base_url();?>style/front/bootstrap.css" rel="stylesheet">
<link href="<?php echo base_url();?>style/front/sagarmatha.css" rel="stylesheet">
<link href="<?php echo base_url();?>style/front/responsive-slider.css" rel="stylesheet">
<!-- <link href='http://fonts.googleapis.com/css?family=Open+Sans&subset=latin,greek,greek-ext' rel='stylesheet' type='text/css'>-->
<!--[if lt IE 9]>
		<script src="js/html5shiv.js"></script>
        <![endif]-->
<!--[if IE 7]><link rel="stylesheet" href="css/ie/ie7.css" type="text/css" media="screen">
<script type="text/javascript" src="http://info.template-help.com/files/ie6_warning/ie6_script_other.js"></script>
<![endif]-->
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.0";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
  ga('create', 'UA-54834161-1', 'auto');
  ga('send', 'pageview');
</script>
<body>
  <div class="container">
    <iframe style="float:right; text-align:right; margin-top: 5px;" scrolling="no" border="0" frameborder="0" marginwidth="0" marginheight="0" allowtransparency="true" src="http://www.ashesh.com.np/linknepali-time.php?dwn=only&font_color=333333&font_size=12&bikram_sambat=0&api=222294e021" width="130" height="22"></iframe>
        <div class="pull-right" style="margin-top:5px; margin-right:5px;">  
    <?php
echo date("Y-M-d");
?>
        </div>
  </div>
<div class="container">
	<div class="header">
      <div class="col-lg-4">
        <div class="logo"><img src="<?php echo base_url();?>style/images/logo.png"></div>
        </div>
      <div class="col-lg-8 add noright">
    		<?php 
    		$path = ADVERTISEMENT_IMAGE_PATH;
      		$data = $this -> Advertisement_model -> getmediumadvertisment(); if(!empty($data)){?>
            		<img src="<?php echo base_url() . $path . $data -> path; ?>">
            	<?php }?>
            </div>
</div>
</div>
