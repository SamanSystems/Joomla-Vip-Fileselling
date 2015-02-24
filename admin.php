<?php
@session_start();
@ob_start();
include("config.php");
if(check()!="admin_1")
{
echo <<<HTML
<meta http-equiv="refresh" content="0; url= index.php">
HTML;
exit();
}
$msg = $_GET['msg'];

?>
<html lang="en">
<head>
<title>پنل مدیریت</title>
<meta charset="utf-8">

<link rel="stylesheet" type="text/css" href="css/style.css">
<link rel="stylesheet" type="text/css" href="css/skins/red.css" title="gray">
<link rel="stylesheet" type="text/css" href="css/superfish.css">
<!--[if lte IE 8]>
<script type="text/javascript" src="js/html5.js"></script>
<script type="text/javascript" src="js/selectivizr.js"></script>
<script type="text/javascript" src="js/excanvas.min.js"></script>
<![endif]-->



</head>
<body>



<header id="top">
	<div class="container_12 clearfix">
		<div id="logo" class="grid_5">
			<!-- replace with your website title or logo -->
			<a id="site-title" href="#"><span>مديريت سايت</a>
			<a id="view-site" href="logout.php">خروج</a>
		</div>
		


		
	</div>
</header>


<section id="content">
	<section class="container_12 clearfix">
		
		
		<?php include('theme/sidebar.php');?>
		
        <section id="main" class="grid_9">
			<article id="settings">
				<h1>پنل مدیریت</h1>
				به پنل مدیریت خوش آمدید<br>
				برای استفاده از امکانات ساید از منوی اصلی سایت که در سمت راست قرار دارد استفاده کنید<br>
				<br>

                <?php if ($msg=='sucsecc'){?>
                
                <div class="success msg">
                تغییرات شما با موفقیت اعمال شد .
                </div>
                <?php }?>	
                
                <?php if ($msg=='cancel'){?>
                <div class="error msg">
                	شما از ادامه کار انصراف داده اید 
                </div>
                <?php } ?>
                				
				
				
				
				
			</article>
		</section>
	</section>
</section>

<footer id="bottom">
	<section class="container_12 clearfix">
		  <p>&copy;اسکریپت حق عضویت VIP - توسعه داده شده توسط <a style="color:#900" href="http://joomina.ir" target="_blank">joomina.ir</a> </p>
		
	</section>
</footer>

</body>

</html>