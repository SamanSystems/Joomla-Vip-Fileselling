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
<?php 
include("config.php");
$username = $_GET['username'];
$user_ver =  mysql_fetch_array(mysql_query("SELECT * FROM `users` where `user`='$username'"));
$useremail = $user_ver['useremail'];
$active = $user_ver['active'];
$time=jgetgmdate($user_ver['time']);
$endtime=jgetgmdate($user_ver['endtime']);?>
<header id="top">
	<div class="container_12 clearfix">
		<div id="logo" class="grid_12">
			<!-- replace with your website title or logo -->
			<a id="site-title" href="#">تائید فرم پرداخت</a>
		</div>
	</div>
</header>

<div class="container_12 clearfix">
<div id="desc" class="grid_12">
وضعیت پرداخت شما :
</div>
</div>

<div class="container_12 clearfix">
<div id="desc" class="grid_12">
<table border="0" width="100%">
	<tr>
		<td width="132"><font face="Tahoma" size="2">&nbsp;نام کاربری</font></td>
		<td><?php echo $username; ?></td>
	</tr>
	<tr>
		<td width="102"><font face="Tahoma" size="2">&nbsp;تاریخ ایجاد حساب</font></td>
		<td><?php echo $time['year'] .'/'.$time['mon'] .'/'.$time['mday'];?></td>
	</tr>
	<tr>
		<td width="102"><font face="Tahoma" size="2">&nbsp;تاریخ پایان اعتبار</font></td>
		<td><?php echo $endtime['year'] .'/'.$endtime['mon'] .'/'.$endtime['mday'];?></td>
	</tr>
	<!--<tr>
		<td width="102"><font face="Tahoma" size="2">&nbsp;وضعیت</font></td>
		<td><?php echo ($active==1)? "فعال" : "غیر فعال"; ?></td>
	</tr> !-->
</table>
</div>
</div>
<?php
require_once('lib/nusoap.php');
	
	$cat_p = mysql_fetch_array(mysql_query("SELECT * FROM `cat` where id=".$user_ver['cat']));
	$Amount = $cat_p['price']; //Amount will be based on Toman
	$Authority = $_GET['Authority'];
	
	if($_GET['Status'] == 'OK'){
		// URL also Can be https://ir.zarinpal.com/pg/services/WebGate/wsdl
		$client = new nusoap_client('https://de.zarinpal.com/pg/services/WebGate/wsdl', 'wsdl'); 
		$client->soap_defencoding = 'UTF-8';
		$result = $client->call('PaymentVerification', array(
															array(
																	'MerchantID'	 => $MerchantID,
																	'Authority' 	 => $Authority,
																	'Amount'	 	 => $Amount
																)
															)
		);
		
		if($result['Status'] == 100){
			
			?>
            <div class="container_12 clearfix">
            <div id="desc" class="grid_12">
             <div class="success msg">
             <p>پرداخت شما با موفقیت انجام شد</p>
				<p>شماره تراکنش شما : <?php echo $result['RefID'] ?></p>
                <p>لطفا در حذف این شماره تراکنش دقت فرمایید</p>
            </div>
            </div>
            </div>
	
	<?php
	$id= $user_ver['id'];
	//save in htaccess
	$password=$user_ver['pass'];
$save_user=save_user($username,$password);
if($save_user==1){
	$sql_del=mysql_query("UPDATE `users` SET `active` = '1' WHERE `id` ='".$id."';");
	
				$to      = $useremail;
				$subject = 'اکانت شما فعال شد';
				$message = "
					<b>از اینکه اشتراک ما را پذیرفته اید متشکریم </b><br/>
<p> ما همواره در تلاشیم تا بتوانیم بهترین خدمات را برای شما فرآهم آوریم </p>
<table border='0' width='100%'>
	<tr>
		<td width='132'><font face='Tahoma' size='2'>&nbsp;نام کاربری</font></td>
		<td>". $username . "</td>
	</tr>
	<tr>
		<td width='102'><font face='Tahoma' size='2'>&nbsp;تاریخ ایجاد حساب</font></td>
		<td>" .  $time['year'] .'/'.$time['mon'] .'/'.$time['mday'] . "</td>
	</tr>
	<tr>
		<td width='102'><font face='Tahoma' size='2'>&nbsp;تاریخ پایان اعتبار</font></td>
		<td>".$endtime['year'] .'/'.$endtime['mon'] .'/'.$endtime['mday'] . "</td>
	</tr>
    </table><br />
 <p> هم اکنون شما میتوانید با رمز عبور: <b>" . $user_ver['pass'] ."</b> در سایت وارد شوید</p>
 <b>شماره تراکنش پرداخت شما : <span style='color:#900'>". $result['RefID'] ."</span> میباشد </b>
									
				
				";
		
				
				mail($to, $subject, $message);
};
		} else {
			?>
               <div class="error msg">
			<?php echo 'تراکنش پرداختی با شکست مواجه شد'. $result['Status']; ?>
				</div>
       <?php  }

	} else {
		?>
               <div class="error msg">
               <?php
		echo 'شما از پرداخت انصراف داده اید ';
 ?>
 </div>
 <?php 	}
	?>
</body>
