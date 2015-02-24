
<?php
error_reporting(0);
function creat($name,$file)
{
$fp = fopen($name,"w") or $error=1;
fputs($fp,$file);
fclose($fp) or $error=1;
if($error){$status= '0';}else{ $status= '1';}
return ($status);
}
?>
<!DOCTYPE html>
<html lang="fa" dir="rtl">
  <head>
    <meta charset="utf-8">
    <title>نصب کننده خودکار اسکریپت VIP</title>
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le HTML5 shim, for IE6-8 support of HTML elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- Le styles -->
    <link href="bootstrap.css" rel="stylesheet">
    <style type="text/css">
      /* Override some defaults */
      html, body {
        background-color: #eee;
      }
     
      .container > footer p {
        text-align: center; /* center align it with the container */
      }
      .container {
        width: 820px; /* downsize our container to make the content feel a bit tighter and more cohesive. NOTE: this removes two full columns from the grid, meaning you only go to 14 columns and not 16. */
      }

      /* The white background content wrapper */
      .container > .content {
        background-color: #fff;
        padding: 20px;
        margin: 0 -20px; /* negative indent the amount of the padding to maintain the grid system */
        -webkit-border-radius: 0 0 6px 6px;
           -moz-border-radius: 0 0 6px 6px;
                border-radius: 0 0 6px 6px;
        -webkit-box-shadow: 0 1px 2px rgba(0,0,0,.15);
           -moz-box-shadow: 0 1px 2px rgba(0,0,0,.15);
                box-shadow: 0 1px 2px rgba(0,0,0,.15);
      }

      /* Page header tweaks */
      .page-header {
        background-color: #f5f5f5;
        padding: 20px 20px 10px;
        margin: -20px -20px 20px;
      }

      /* Styles you shouldn't keep as they are for displaying this base example only */
      .content .span10,
      .content .span4 {
        min-height: 500px;
      }
      /* Give a quick and non-cross-browser friendly divider */
      .content .span4 {
        margin-left: 0;
        padding-left: 19px;
        border-left: 1px solid #eee;
      }

      .topbar .btn {
        border: 0;
      }

    </style>


  </head>

  <body>

    <div class="topbar">
      <div class="fill">
        <div class="container">
          <a class="brand" href="#">نصب کننده خودکار اسکریپت</a>
          <ul class="nav">
           <li><a href="http://www.joomina.ir/" target="_blank">پشتیبانی</a></li>
          </ul>
          
        </div>
      </div>
    </div>
<br>
<br>

    <div class="container">

      <div class="content">
        <div class="page-header">
          <h1>نصب کننده خودکار</h1>
        </div>
        <div class="row">
          <div class="span18">
		     <ul class="breadcrumb">
<?php
$do=$_GET['step'];
if(!$do)
$view='صفحه اصلی';
else if($do==2)
$view='مرحله دوم';
else if($do==3)
$view='مرحله سوم';
else if($do==4)
$view='مرحله چهارم';
else if($do==5)
$view='مرحله پنجم';
?>
					<li><a href="index.php">صفحه اصلی</a> <span class="divider">/</span></li>
					<li>مرحله دوم <span class="divider">/</span></li>
					<li>مرحله سوم <span class="divider">/</span></li>
					<li>مرحله چهارم <span class="divider">/</span></li>
					<li>مرحله پنجم <span class="divider">/</span></li>
					<li class="active">شما در <?php echo $view;?> هستید</li>
				</ul>   
		  
            
			
			
<?php


switch ($do)
{
case "5" :
echo <<<HTML
<div class="alert-message success">
<p>نصب اسکریپت با موفقیت انجام شد</p>
</div>
HTML;
?>
	
<p>&nbsp;</p>
<p><font face="Tahoma" size="2">توجه داشته باشید که فایل های خود را میباید در مسیر &quot;dl/download/vip&quot; بارگذاری نمایید .</font></p>
<p><font face="Tahoma" size="2">همچنین امکان پوشه بندی در این قسمت را دارا میباشید .</font></p>

<p><font face="Tahoma" size="2">مرحله آخر ک از همه مهمتره راندازی <span lang="en-us">CronJob </span>هست برای اینکه کاربرانی ک اعتبار اکانتشون تمام 
  شده غیر فعال بشه اونم ب صورت اتوماتیک.</font></p>
  <p> <font face="Tahoma" size="2">روش اول : </font></p>
  <p><font face="Tahoma" size="2"> در   هاست به قسمت cron job رفته و آدرس  yourdomain.com/cron.php را وارد نمایید . شما میتوانید این تنظیم را به صورت شبانه قرار دهید </font></p>
  <p> <font face="Tahoma" size="2">روش دوم : </font></p>
<p><font face="Tahoma" size="2">1. به این سایت رفته
<a target="_blank" href="http://cronless.com/">کلیک کنید</a>!</font></p>
<p><font face="Tahoma" size="2">2. بعد عضو شوید.</font></p>
<p><font face="Tahoma" size="2">3. بعدش وارد حساب خود شوید و از منوی بالا روی
<span lang="en-us">job </span>کلیک کنید</font></p>
<p><font face="Tahoma" size="2">4. بعد از باز شدن صفحه روی <span lang="en-us">
new job </span>کلیک کنید.</font></p>
<p><font face="Tahoma" size="2">5. تو فیلد <span lang="en-us">name </span>یه اسم 
بزارید، و در فیلد <span lang="en-us">Web Page Url </span>این آدرس رو بزارید</font></p>
<p><font face="Tahoma" size="2"><span lang="en-us"><?php  echo str_replace('install/index.php','cron.php','http://'.$_SERVER['SERVER_NAME'].$_SERVER["SCRIPT_NAME"]);?></span></font></p>
<p><font face="Tahoma" size="2">و Interval روی <span lang="en-us">Once a Day
</span>بزارید و بعدش روی دکمه <span lang="en-us">Create Job </span>کلیک کنید !</font></p>
<p><font face="Tahoma" size="2">6. <span lang="en-us">cron job </span>شما با 
موفقیت ثبت و انجام شد</font></p>
<p><font face="Tahoma" size="2">7. لطفا پوشه <span lang="en-us">install </span>
رو حذف کنید !</font></p>
<p style="color:#C00"><font face="Tahoma" size="2">8. نام کاربری و رمز عبور مدیریت admin می باشد</font></p>
<p><font face="Tahoma" size="2">موفق باشید</font></p>
<b style="color:#900"> حال میتوانید پوشه install را حذف کنید </b>
<?php
break;
case "4" :
echo <<<HTML
<h2>مرحله چهارم</h2>

HTML;


echo <<<HTML
<div class="alert-message success">
<p>
فایل ها با موفقیت ساخته شد
</p></div>
<a href="?step=5"><button  class="btn primary">مرحله بعد</button></a>
HTML;

break;
case "3" :
include("../config.php");
echo <<<HTML
<h2>مرحله سوم</h2>

HTML;
$sql1 = mysql_query("CREATE TABLE `users` (
`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
`user` TEXT NOT NULL ,
`pass` TEXT NOT NULL ,
`time` TEXT NOT NULL ,
`endtime` TEXT NOT NULL ,
`useremail` varchar(100) NOT NULL,
`cat` TEXT NOT NULL ,
`active` TEXT NOT NULL ) ENGINE = innodb;");
if($sql1)
$sus='جدول کاربر با موفقیت ذخیره شد'.'<br>';
else
$error='ذخیره جدول کاربر با مشکل روبرو شد !'.'<br>';
$sql2 = mysql_query("CREATE TABLE IF NOT EXISTS `cat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` text NOT NULL,
  `time` text NOT NULL,
  `price` int(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ;");
if($sql2)
$sus.='جدول دسته ها با موفقیت ذخیره شد'.'<br>';
else
$error.='ذخیره جدول دسته ها با مشکل روبرو شد'.'<br>';
$sql3 = mysql_query("INSERT INTO `users` (`id` ,`user` ,`pass` ,`time` ,`endtime` ,`cat`,`active`)
VALUES ('1', 'admin', 'admin', '', '', '','');");
if($sql3)
$sus.='اضافه کردن ادمین با موفقیت انجام شد'.'<br>';
else
$error.='اضافه کردن ادمین با مشکل روبرو شد'.'<br>';
if($sus)
{
echo <<<HTML
<div class="alert-message success">
<p>
$sus
</p></div>
<a href="?step=4"><button  class="btn primary">مرحله بعد</button></a>
HTML;
}else if($error){
echo <<<HTML
<div class="alert-message error">
<p>
$error
</p>
</div>
HTML;
}
break;
case "2" :
echo <<<HTML
<h2>مرحله دوم</h2>

HTML;
$serverdb=$_POST['serverdb'];
$usernamedb=$_POST['usernamedb'];
$passworddb=$_POST['passworddb'];
$db_conn=$_POST['db_conn'];
$server=$_POST['server'];
$MerchantID= $_POST['MerchantID'];
mysql_connect($serverdb,$usernamedb,$passworddb) or $error="اطلاعات وارد شده برای متصل شدن به سرور اشتباه است<br>"; 
@mysql_select_db($db_conn) or $error.="بانک اطلاعاتی مورد نظر یا قبلا ثبت شده یا اصلا به ثبت نرسیده !";
if(!$error)
{
$conf=creat('../config.php','<?php 
include("tarikh.php");
include("fun.php");
error_reporting(0);
$usernamedb = "'.$usernamedb.'"; 
$passworddb = "'.$passworddb.'"; 
$serverdb = "'.$serverdb.'";
$db_conn = "'.$db_conn.'";
$GLOBALS["localhost"]="'.$server.'";
$MerchantID= "'.$MerchantID .'";

mysql_connect("$serverdb","$usernamedb","$passworddb") or die(mysql_error()); 
@mysql_select_db("$db_conn") or die(mysql_error()); 
?>
');
$hash =  date('l jS \of F Y').$_SERVER['SERVER_SIGNATURE'];
		$hash = md5($hash);
				$insidehtaccess = 'RewriteEngine On
RewriteBase /
RewriteCond %{HTTP_COOKIE} !vipdownload=' . $hash .'  [NC]
RewriteRule .* - [L,F]';
		$htaccess = creat('../dl/download/.htaccess', $insidehtaccess);	
if($conf && $htaccess)
{
echo <<<HTML
<div class="alert-message success">
<p>
فایل کانفینگ با موفقیت ساخته شد
</p></div>
<a href="?step=3"><button  class="btn primary">مرحله بعد</button></a>
HTML;
}else{
echo <<<HTML
<div class="alert-message error">
<p>
ساخت فایل کانفینگ با مشکل روبرو شد !
</p>
</div>
HTML;
}

}else{
echo <<<HTML
<div class="alert-message error">
			<p>$error</p>
			</div>
HTML;
}
break;
default:

?>			
<h2>مرحله اول</h2>

			<form method="POST" action="?step=2">
	

	
        <fieldset>
        
          <div class="clearfix">
            <label for="title">آدرس سرور بانک اطلاعاتی</label>
            <div class="input">
              <input value="localhost" type="text" size="30" name="serverdb" id="serverdb" class="xlarge" dir="ltr">
            </div>
          </div>
		  <div class="clearfix">
            <label for="title">بانک اطلاعاتی</label>
            <div class="input">
              <input value="" type="text" size="30" name="db_conn" id="db_conn" class="xlarge" dir="ltr" placeholder="اسم بانک اطلاعاتی">
            </div>
          </div>
		  <div class="clearfix">
            <label for="title">نام کاربری</label>
            <div class="input">
              <input value="" type="text" size="30" name="usernamedb" id="usernamedb" class="xlarge" dir="ltr" placeholder="نام کاربری بانک اطلاعاتی">
            </div>
          </div>
		  <div class="clearfix">
            <label for="title">پسورد</label>
            <div class="input">
              <input value="" type="text" size="30" name="passworddb" id="passworddb" class="xlarge" dir="ltr" placeholder="رمز عبور بانک اطلاعاتی">
            </div>
          </div>
		  <div class="clearfix">
           <label for="mediumSelect">نوع سرور خود</label>
           <div class="input">
             <select id="server" name="server" class="xlarge" dir="ltr">
               <option value="0">Linux (Cpanel,Directadmin,....)</option>
               <option value="1">Windows (Localhost , windows server 2003 ,...)</option>
               
             </select>
           </div>
        
         </div>
         <hr/>
	 <label for="title" style="color:#06C">کد درگاه زرین پال را وارد کنید</label>
            <div class="input"> 
              <input value="" type="text" size="60" name="MerchantID" id="MerchantID" class="xlarge" dir="ltr" placeholder="xxx-xxxxxx-xxxxxxxxx">
    	<hr/>
    	  <div class="actions">
            <input type="submit" value="ارسال" class="btn primary">&nbsp;<button class="btn" type="reset">لغو</button>
          </div>
   
    
        </fieldset>
       
      </form>
<?php }?>
          </div>
          
        </div>
      </div>

      <footer>
        <p>&copy;اسکریپت حق عضویت VIP - توسعه داده شده توسط <a style="color:#900" href="http://joomina.ir" target="_blank">joomina.ir</a> </p>
      </footer>

    </div> <!-- /container -->

  </body>
</html>
