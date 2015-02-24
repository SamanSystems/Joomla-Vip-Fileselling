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
if($_POST['submit']=='go')
{
$oldpass=$_POST['oldpass'];
$passnew=$_POST['passnew'];
$tpassnew=$_POST['tpassnew'];
if(!$oldpass || !$passnew || !$tpassnew || $passnew !=$tpassnew)
$error='لطفا تمامی فیلد ها را کامل کنید';
else{
$p = mysql_fetch_array(mysql_query("SELECT * FROM `users` where id='1'"));
$pass=$p['pass'];
if($pass==$oldpass)
{
$sqli = mysql_query("UPDATE `users` SET `pass` = '$passnew' WHERE `id` =1 LIMIT 1");
if($sqli)
$sus='اطلاعات با موفقیت ثبت شد';
else
$error='ثبت اطلاعات با مشکل روبرو شد!';
}else{
$error='پسورد قبلی اشتباه است';
}
}

}
if($error)
$status='<div class="error msg">'.$error.'</div>';
else if($sus)
$status='<div class="success msg">'.$sus.'</div>';
?>
<!DOCTYPE HTML>
<html lang="en">
<head>
<title>تغییر رمز عبور - پنل مدیریت</title>
<meta charset="utf-8">

<link rel="stylesheet" type="text/css" href="css/style.css">
<link rel="stylesheet" type="text/css" href="css/skins/red.css" title="gray">
<link rel="stylesheet" type="text/css" href="css/superfish.css">
<!--[if lte IE 8]>
<script type="text/javascript" src="js/html5.js"></script>
<script type="text/javascript" src="js/selectivizr.js"></script>
<script type="text/javascript" src="js/excanvas.min.js"></script>
<![endif]-->
<script type="text/javascript" src="js/gen_validatorv4.js"></script>
<script type="text/javascript" src="js/jquery-1.4.4.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.8.custom.min.js"></script>
<script type="text/javascript" src="js/jquery.validate.min.js"></script>
<script type="text/javascript" src="js/jquery.uniform.min.js"></script>
<script type="text/javascript" src="js/jquery.wysiwyg.js"></script>
<script type="text/javascript" src="js/superfish.js"></script>


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
		<section id="main" class="grid_9">
			<article id="settings">
				<h1>تغییر رمز عبور</h1>
				<?php echo $status;?>
				<form class="uniform" name="news" method="post" action="">
				<input type="hidden" name="go" value="">
			
					<dl>
						<dt><label for="newstitle">رمز عبور قبلی</label></dt>
						<dd><input type="text" value="" class="big" id="newstitle" name="oldpass" dir="ltr"></dd>
						
						<dt><label for="newstitle">رمز عبور جدید</label></dt>
						<dd><input type="text" value="" size="8" class="big" id="newstitle" name="passnew" dir="ltr"></dd>
						
						<dt><label for="newstitle">تکرار رمز عبور جدید</label></dt>
						<dd><input type="text" value="" size="8" class="big" id="newstitle" name="tpassnew" dir="ltr"></dd>
						
					<p>
						<button class="button big" type="submit" value="go" name="submit">ارســال</button>
						<button class="button white" type="button">لــغـو</button>
					</p>
				</form>
					<script language="JavaScript" type="text/javascript">
				 var frmvalidator  = new Validator("news");
				 frmvalidator.addValidation("oldpass","req","رمز عبور قبلی را وارد نمایید");
				 frmvalidator.addValidation("passnew","req","رمز عبور جدید را وارد نمایید");
				 frmvalidator.addValidation("tpassnew","req","تکرار رمز عبور جدید را وارد نمایید");
				 frmvalidator.addValidation("tpassnew","eqelmnt=passnew","پسورد جدید با تکرار آن برابر نیست");
				

				 </script>
				
				
				
				
			</article>
		</section>
		
		<?php include('theme/sidebar.php');?>
		
	</section>
</section>

<footer id="bottom">
	<section class="container_12 clearfix">
		
		<div class="grid_6 alignright">
			سیستم حق اشتراک کاربران | VIP 
			<font color="red">توسعه داده شده توسط<a href="http://joomina.ir" target="_blank"> joomina.ir</a></font> 
		</div>
	</section>
</footer>

</body>

</html>