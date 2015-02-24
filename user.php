<?php

@session_start();
@ob_start();
include("config.php");
if(check()!="user_1")
{
echo <<<HTML
<meta http-equiv="refresh" content="0; url= index.php">
HTML;
exit();
}
?>
<!DOCTYPE HTML>
<html lang="en">
<head>
<title>پنل کاربران</title>
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
			<a id="site-title" href="#"><span>کاربر گرامی ،</a>
			<a id="view-site" href="logout.php">خروج</a>
		</div>
		


		
	</div>
</header>
<?php
$username_check=$_SESSION["resller_username"];
$password_check=$_SESSION["resller_password"];
$setting_user = mysql_fetch_array(mysql_query("SELECT * FROM `users` where `user`='$username_check' AND `pass`='$password_check'"));
$time=jgetgmdate($setting_user['time']);
$endtime=jgetgmdate($setting_user['endtime']);
$active=$setting_user['active'];
?>

<section id="content">
	<div class="container_12 clearfix">
		<div id="main" class="grid_9">
			<article id="settings">
				<h1>اطلاعات اکانت شما</h1>
                <?php 
				$tt=time();
				if ($setting_user['endtime'] < time() ) {
				
					?>
                
                  <div class="error msg">
                    مدت زمان اعتبار اشتراک شما به پایان رسیده است
                  </div>
                  
                
                <?php } 
				 ?>
				<table border="0" width="100%">
	<tr>
		<td width="132"><font face="Tahoma" size="2">&nbsp;نام کاربری</font></td>
		<td><?php echo $username_check; ?></td>
	</tr>
	<tr>
		<td width="102"><font face="Tahoma" size="2">&nbsp;تاریخ ایجاد حساب</font></td>
		<td><?php echo $time['year'] .'/'.$time['mon'] .'/'.$time['mday'];?></td>
	</tr>
	<tr>
		<td width="102"><font face="Tahoma" size="2">&nbsp;تاریخ پایان اعتبار</font></td>
		<td><?php echo $endtime['year'] .'/'.$endtime['mon'] .'/'.$endtime['mday'];?></td>
	</tr>
	<tr>
		<td width="102"><font face="Tahoma" size="2">&nbsp;وضعیت</font></td>
		<td><?php echo ($active==1)? "فعال" : "غیر فعال"; ?></td>
	</tr>
</table>
				
				
		
				
			</article>
          
<style>
	#desc2 {
		background-color:#900 ; padding:10px;
		margin:10px;
		color:#FFF;
		font-size:22px;
		  font-family: 'BKoodakBold';}
</style>
            	
            <?php if (($setting_user['endtime'] < time()) || ($setting_user['active']=='0') ) {
				
					?>
                  <div id="desc2" class="grid_9">
                <p>برای تمدید اکانت خود <a style="color:#FC0" href="renewe.php">کلیــک</a> نمایید</p>
    				</div>              
	                
                <?php } 
?>

		</section>



		
	</section>
</section>



<footer id="bottom">
	<section class="container_12 clearfix">
		
		<div class="grid_6 alignright">
			سیستم حق اشتراک کاربران | VIP 
			<font color="red">توسعه داده شده توسط joomina.ir</font> 
		</div>
	</section>
</footer>

</body>

</html>