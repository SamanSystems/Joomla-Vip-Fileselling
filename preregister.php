<?php
include("config.php");
?>
<!DOCTYPE HTML>
<html lang="en">
<head>
<title>تائیدیه مشخصات جهت اشتراک</title>
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
			<a id="site-title" href="#">تائیدیه مشخصات پرداخت </a>
		</div>
	</div>
</header>
<div class="container_12 clearfix">
<div id="desc" class="grid_12"><p>در ادامه مشخصاتی که با ان ثبت نام نموده اید درج شده است با تائید مشخصات وارد شده وارد درگاه بانکی میشوید و پس از پرداخت بلافاصله اکانت شما فعال میگردد</p>
</div>
</div>
<div class="container_12 clearfix">
   <div class="grid_2">&nbsp;</div>
   
   <div class="box2 grid_8">
   	<div class="regiter_title">
    
    اطلاعات ثبت شده 
    </div>
    <form action="pay.php" name="pay" method="post">
   		<dt><label for="useremail" class="font">ایمیل :</label></dt>
						<dd><input type="text" readonly  size="30" id="useremail" name="useremail" value="<?php echo 
						$_POST['useremail']?>" dir="ltr"></dd>
                        
                        <input type="hidden" readonly  size="30" id="pass" name="password" value="<?php echo 
						$_POST['password']?>" dir="ltr">
                        
						<dt><label for="newstitle1" class="font">نام کاربری</label></dt>
						<dd><input type="text"  readonly value="<?php echo $_POST[username]?>" id="newstitle1" name="username" dir="ltr"></dd>
						<dt><label for="newstitle">نوع اکانت</label></dt>
						<dd>
<?php
		$cat =$_POST[cat];
		$result = mysql_fetch_array(mysql_query("SELECT * FROM `cat` where `id`='$cat'"));
		
		echo $result['title'];

		
?>
					<input type="hidden" value="<?php echo $_POST['cat']?>" id="newstitle1" name="cat" dir="ltr">
                
               <dt> <button class="button gray" type="submit" value="submit" name="submit2" 
                      >پرداخت حق اشتراک</button>
                    
                    <a class="button red" href="index.php">انصراف</a>
                    
                </dt>
                      </dd>	    
   </form>
    </div>

</div>


</body>