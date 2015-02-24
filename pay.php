<?php
@ob_start();
include("config.php");
?>
<!DOCTYPE HTML>
<html lang="en">
<head>
<title>ورود به درگاه بانکی</title>
<meta charset="utf-8">
<link rel="stylesheet" type="text/css" href="css/style.css">
<!--[if lte IE 8]>
<script type="text/javascript" src="js/html5.js"></script>
<![endif]-->

</head>
<?php

$url='http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
$url = explode('/pay.php', $url);




$useremail= $_POST['useremail'];
$username=$_POST['username'];
$password=$_POST['password'];
$CallbackURL = $url[0].'/verify.php?username='.$username;
$cat = $_POST['cat'];
$active = '0';
$cat_p = mysql_fetch_array(mysql_query("SELECT * FROM `cat` where id='$cat'"));
$cat_time=$cat_p['time'];
$user_p =  mysql_num_rows(mysql_query("SELECT * FROM `users` where `user`='$username'"));
$time=time();

if(is_numeric($cat_time)) 
 {
	 $endtime= $time + ($cat_time * 24 * 60 * 60) ; }
	  
if ($useremail && $username && $password && $cat ) {
$sqli = mysql_query("INSERT INTO `users` (`user`,`pass`,`time`,`endtime`,`useremail`,`cat`,`active` ) VALUES ('$username','$password','$time','$endtime','$useremail','$cat','0')");
} else {
	echo "اطلاعات ارسالی کامل نیست ...";	
}




//// sending to the bank
	require_once('lib/nusoap.php');
	
	
	$Amount = $cat_p['price']; //Amount will be based on Toman  - Required
	$Description = $cat_p['title'];  // Required
	$Email = $useremail; // Optional
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

?>