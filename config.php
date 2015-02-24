<?php 
include("tarikh.php");
include("fun.php");
error_reporting(0);
$usernamedb = "dbname"; 
$passworddb = ""; 
$serverdb = "";
$db_conn = "";
$GLOBALS["localhost"]="0";
$MerchantID= "";

if ($usernamedb=='dbname') {
	?>

<h2 style="text-align:center; color:#FFF ; background-color:#000; padding:10px; width:80%; margin:10 auto"> به نظر میاید اسکریپت بدرستی نصب نشده است  برای نصب اسکریپت <a style="color: #FC0" href="install">کلیــک</a> کنید</h2>

<?php

	}else{
mysql_connect("$serverdb","$usernamedb","$passworddb") or die(mysql_error()); 
@mysql_select_db("$db_conn") or die(mysql_error()); 
}
?>
