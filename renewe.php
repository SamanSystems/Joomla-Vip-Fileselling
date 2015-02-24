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
$username=$_SESSION["resller_username"];
$password = $_SESSION ["resller_password"];

?>
<!DOCTYPE HTML>
<html lang="en">
<head>
<title>سامانه مشترکین سایت - VIP Service</title>
<meta charset="utf-8">
<link rel="stylesheet" type="text/css" href="css/style.css">
<!--[if lte IE 8]>
<script type="text/javascript" src="js/html5.js"></script>
<![endif]-->

</head>
<body>
<header id="top">
	<div class="container_12 clearfix">
		<div id="logo" class="grid_12">
			<!-- replace with your website title or logo -->
			<a id="site-title" href="#">تمدید اشتراک در سامانه</a>
		</div>
	</div>
</header>
<div class="container_12 clearfix">
<div id="desc" class="grid_12">
<p><?php echo $username ;?> , عزیز  </p>
<p>از اینکه دوباره تصمیم به تمدید اشتراک خود در سامانه مشترکین ما گرفته اید متشکریم لطفا از طرح های زیر یکی را انتخاب نمایید .</p>
</div>

<!--  make account -->
<div class="box3 grid_12">
	
<?php
if($_POST['submitrenew'] and !$_POST['cat']) echo '<div class="error msg">'.'لطفا مدت زمان اشتراک خود را تعیین کنید'.'</div>';
if($_POST['cat'] and $_POST['submitrenew']){
	$cat = $_POST['cat'];
	$username=$_SESSION["resller_username"];	
	$cat_p = mysql_fetch_array(mysql_query("SELECT * FROM `cat` where id='$cat'"));
	$user_p =  mysql_num_rows(mysql_query("SELECT * FROM `users` where `user`='$username'"));
	$catid = $cat_p['id'];
	// this is for check sesion verfy cat
	$_SESSION["catid"]=$catid;
	//// sending to the bank for renew
	require_once('lib/nusoap.php');
	
	$url='http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
	$url = explode('/renewe.php', $url);
	$CallbackURL = $url[0].'/renewverify.php?username='.$username;
	
	$Amount = $cat_p['price']; //Amount will be based on Toman  - Required
	$Description = $cat_p['title'].'/'.$username;  // Required
	$Email = $user_p['useremail']; // Optional
	$Mobile =" "; // Optional
	
	//echo '$Amount='.$Amount . '$MerchantID='.$MerchantID.'$Description='.$Description.'$Email='.$Email.'$Mobile='.$Mobile.$CallbackURL ;die();
	// URL also Can be https://ir.zarinpal.com/pg/services/WebGate/wsdl
	$client = new nusoap_client('https://de.zarinpal.com/pg/services/WebGate/wsdl', 'wsdl'); 
	$client->soap_defencoding = 'UTF-8';
	$result = $client->call('PaymentRequest', array(
													array(
															'MerchantID' 	=> $MerchantID,
															'Amount' 		=> $Amount,
															'Description' 	=> $Description,
															'Email' 		=> $Email,
															'Mobile' 		=> $Mobile,
															'CallbackURL' 	=> $CallbackURL
														)
													)
	);

	//Redirect to URL You can do it also by creating a form
	if($result['Status'] == '100')
	{
		Header('Location: https://www.zarinpal.com/pg/StartPay/'.$result['Authority']);
	} else {
		echo'ERR: '.$result['Status'];
	}


	
	}// if submit
?>
</div>

<div class="box2 grid_12">
	<div class="regiter_title">
     دوره های موجود جهت تمدید اشتراک 
    </div>
  <div class="reg">
  <form action="" method="post">
  <dt><label for="newstitle" style="color:#06C;font-family: 'BKoodakBold'; font-size:18px">نوع اکانت</label></dt>
						<div style="margin:10px; background-color:#ebebeb; padding:10px">
                      
                        <dd>
<?php
$result = mysql_query("SELECT * FROM cat");
while($r=mysql_fetch_array($result))
{
$id=$r["id"];
$title=$r["title"];
echo <<<HTM
				<b><input type="radio" name="cat" value="$id">$title</b><hr>
				
HTM;
}				
?>
  </dd>
  </div>
  <button class="button red" type="submit" value="submitrenew" name="submitrenew" 
                      >تمدید اشتراک</button>
  
  </form>
  
  </div>
  </div>
  </div>
  </body>
  </html>