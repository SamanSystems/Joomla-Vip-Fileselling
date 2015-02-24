
<?php

@session_start();
@ob_start();
include("config.php");
// register form 


if ($_POST['submit2']) {
	
    if(!$_POST['username']) echo '<div class="error msg">'.'نام کاربری خالی رها شده است لطفا آن را پر نمایید'.'</div>';
	if(!$_POST['useremail']) echo '<div class="error msg">'.'لطفا ایمیل خود را وارد نمایید'.'</div>';
	if(!$_POST['cat']) echo '<div class="error msg">'.'لطفا مدت زمان اشتراک خود را تعیین کنید'.'</div>';
	if(!$_POST['password']) echo '<div class="error msg">'.'رمز خود را وارد نکرده اید . لطفا رمز را وارد کنید'.'</div>';
	if($_POST['password']!=$_POST['password2']) echo '<div class="error msg">'.'رمز های وارد شده تطابق ندارد لطفا دوباره سعی کنید'.'</div>';
	
	$username=$_POST['username'];
	   $useremail=$_POST['useremail'];
	   $uservalidate = mysql_fetch_array(mysql_query("SELECT * FROM `users` where `user`='$username'"));
	   $emailvalidate = mysql_fetch_array(mysql_query("SELECT * FROM `users` where `useremail`='$useremail'"));
	
	   if (isset($uservalidate['user'])) { echo '<div class="error msg">'.'این نام کاربری قبلا توسط شخص دیگری انتخاب شده است لطفا نام دیگری برگزینید'.'</div>';
	    } elseif ($emailvalidate['useremail']) { 
	     echo '<div class="error msg">'.'این ایمیل قبلا توسط شخص دیگری انتخاب شده است لطفا ایمیل دیگری برگزینید'.'</div>'; }
	
   if( ($_POST['password'] == $_POST['password2'])  and ($_POST['password']) and  ($_POST['cat'])  and 
    (!$emailvalidate)  and   (!$uservalidate)) {
	  
	   
	    ?>
		 
		<form action="preregister.php" method="post" name="registerform">
         		<input type="hidden" id="useremail" name="useremail" dir="ltr" value="<?php echo $_POST['useremail'] ?>">
                <input type="hidden" id="useremail" name="username" dir="ltr" value="<?php echo $_POST['username'] ?>">
                 <input type="hidden" id="useremail" name="password" dir="ltr" value="<?php  echo $_POST['password'] ?>">
                  <input type="hidden" id="useremail" name="cat" dir="ltr" value="<?php echo $_POST['cat'] ?>">
                  
         </form>
				<script type="text/javascript">
               document.forms["registerform"].submit()
                </script>		   <?php  } ; 
	   
	  
	   
	};




//register form
if (isset($_GET['p']) && $_GET['p'] == "login") {
$username=$_POST['username'];
$password=$_POST['password'];
$login_user = mysql_fetch_array(mysql_query("SELECT * FROM `users` where `user`='$username'"));
$username_check=$login_user['user'];
$password_check=$login_user['pass'];
if($_SESSION['img']==$_POST['security'])
{
if(!$username || !$password)
{
  $error="<p align=right><font color='#FF0000' face='Tahoma' style='font-size: 8pt'>لطفا تمامي فيل ها را كامل كنيد.</font></p>";

}else{
	if ($username == $username_check AND $password==$password_check) {

$_SESSION["resller_on"]="true";
$_SESSION["resller_username"]=$username_check;
$_SESSION["resller_password"]=$password_check;
if($username_check=="admin")
{
echo <<<HTML
<meta http-equiv="refresh" content="0; url= admin.php">
HTML;
}else{
echo <<<HTML
<meta http-equiv="refresh" content="0; url= user.php">
HTML;
}
   } else {

      $error= "<p align=right><font color='#FF0000' face='Tahoma' style='font-size: 8pt'>&#1605;&#1578;&#1575;&#1587;&#1601;&#1575;&#1606;&#1607; &#1705;&#1604;&#1605;&#1607; &#1593;&#1576;&#1608;&#1585; / &#1606;&#1575;&#1605; &#1705;&#1575;&#1585;&#1576;&#1585;&#1740; &#1588;&#1605;&#1575; &#1605;&#1580;&#1575;&#1586; &#1606;&#1740;&#1587;&#1578;</font></p>";

   }
}
}else{
  $error="<p align=right><font color='#FF0000' face='Tahoma' style='font-size: 8pt'>كد امنيتي اشباه است.</font></p>";
}
}
if ($_SESSION["resller_on"] == "true") {
if(check()=="user_1")
{
echo <<<HTML
<meta http-equiv="refresh" content="0; url= user.php">
HTML;
}else if(check()=="admin_1")
{
echo <<<HTML
<meta http-equiv="refresh" content="0; url= admin.php">
HTML;
}
 }else{
?>
<!DOCTYPE HTML>
<html lang="en">
<head>
<title>سامانه مشترکین سایت - VIP Service</title>
<meta charset="utf-8">
<link rel="stylesheet" type="text/css" href="css/style.css">
<link rel="icon" type="image/x-icon" href="favicon.ico" />
<!--[if lte IE 8]>
<script type="text/javascript" src="js/html5.js"></script>
<![endif]-->
<script type="text/javascript" src="js/gen_validatorv4.js"></script>
 <script  type="text/javascript">
function DoCustomValidation()
{
  var frm = document.forms["register"];
  if(frm.password.value != frm.password2.value)
  {
    sfm_show_error_msg('The Password and verified password does not match!',frm.password);
    return false;
  }
  else
  {
    return true;
  }
}
</script>
</head>
<body>

<header id="top">
	<div class="container_12 clearfix">
		<div id="logo" class="grid_12">
			<!-- replace with your website title or logo -->
			<a id="site-title" href="#">ثبت نام / ورود اعضا در سامانه مشترکین</a>
		</div>
	</div>
</header>
<div class="container_12 clearfix">
<div id="desc" class="grid_12">
<p>درصورتی که پیش تر حق اشتراک خریداری نموده اید مشخصات کاربری خود را وارد نمایید در غیر اینصورت ابتدا ثبت نام نمایید . به محض اینکه فرآیند ثبت نام شما کامل شد میتوانید از فایل های دانلودی مخصو اعضا استفاده نمایید</p>
</div>

<!--  make account -->
<div class="box2 grid_7">
	<div class="regiter_title">
     ثبت نام 
    </div>
  <div class="reg">
  <ul>
  	<li>استفاده از دانلود رایگان دارای محدودیت هایی است</li>
    <li>هم اکنون ثبت نام کنید و اکانت خود را خریداری نمایید</li>
    <li>چنانچه در مراحل پرداخت دچار مشکل شدید میتوانید از قسمت تماس با ما سایت با ما در میان بگذارید</li>
    <li>اکانت شما پس از پرداخت به صورت آنی و با مشخصاتی که خودتان در فرم زیر انتخاب میکنید فعال خواهد شد</li>
    <li>پس از پرداخت به صفحه ای هدایت میشوید که شماره تراکنش شما را نمایش خواهد داد لطفا این شما را نزد خود نگه دارید</li>
    <li></li>
  </ul>

  </div>
  <div class="formregister">
  <form action="" method="post" name="register" >
  	
    <table>
    <tr>
    <td>
    				<label for="useremail" class="font">ایمیل :</label>
                    </td>
                    <td>
					<input type="text"  id="useremail" name="useremail" dir="ltr">
        </td>
        <td>                
                        
                        
						<label for="newstitle1" class="font">نام کاربری</label>
                        </td>
                        <td>
						<input type="text" value="<?php echo $username;?>" id="newstitle1" name="username" dir="ltr">
			</td>
            <tr>
            <td>			
						<label for="newstitle2" class="font">رمز عبور</label>
                        </td>
                        <td>
						<input type="password" value="<?php echo $password;?>"  id="newstitle2" name="password" dir="ltr">
                  </td>
                  <td>      
                        <label for="newstitle3" class="font">تائیدیه رمز عبور</label>
                        </td>
                        <td>
						<input type="password" value="<?php echo $password;?>"  id="newstitle3" name="password2" dir="ltr">
                </td>
                </tr>
                </table>        
                       
                        
						<?php if(!$submit)
						{?>
                        
						<label for="newstitle">نوع اکانت</label>
		<ul>				
<?php
$result = mysql_query("SELECT * FROM cat");
while($r=mysql_fetch_array($result))
{
	?>
    <li>
	<?php
	
$id=$r["id"];
$title=$r["title"];
echo <<<HTM
				<input type="radio" name="cat" value="$id">$title
				
HTM;
}				
?>
</li>
</ul>
<?php 
}else{
$my_endtime=jgetgmdate($endtime);
$endtime=$my_endtime['year'] .'/'.$my_endtime['mon'] .'/'.$my_endtime['mday'] ;
echo <<<HTML
<dt><label for="endtime">تاریخ اتمام</label></dt>
						<dd><input type="text" value="$endtime" size="8" class="big" id="endtime" name="endtime" dir="ltr"></dd>
HTML;
}
 ?>
						</dd>
				

                    <p>
						<button class="button gray" type="submit" value="submit2" name="submit2" 
                      >ثبت نام</button>
						
					</p>
  
  
  </form>
  <script  type="text/javascript">
 var frmvalidator = new Validator("register");
 frmvalidator.addValidation("useremail","req","لطفا ایمیل خود را وارد کنید");
 frmvalidator.addValidation("useremail","email",
        "لطفا ایمیل معتبری وارد کنید");
	 frmvalidator.addValidation("userename","req","لطفا نام کاربری خود را وارد کنید");	
frmvalidator.setAddnlValidationFunction("DoCustomValidation");
 
 frmvalidator.addValidation("cat","req","dove");
</script>

</div>

</div>


<div class="grid_5">
  <div class="box2">
   <div class="regiter_title">ورود به سامانه</div>
    <section>
      <form action="?p=login" method="post">
        <dl>
          <dt>
            <label for="username" class="font">نام کاربری</label>
          </dt>
          <dd>
            <input id="username" name="username" type="text" />
          </dd>
          <dt>
            <label for="adminpassword" class="font">رمز عبور</label>
          </dt>
          <dd>
            <input name="password" id="adminpassword" type="password" />
          </dd>
          <dt>
            <label for="sec" class="font">کد امنیتی</label>
          </dt>
          <dd><img id="sec" border="0" src="img/img.php" /> <a href="#" onClick="document.getElementById('sec').src = 'img/img.php?id='+randnumber(); return false"><img src="images/refresh.png" width="20" height="20"/></a> </dd>
          <dt>
            <label for="secnum">کد امنیتی را در کادر پایین وارد نمایید</label>
          </dt>
          <dd>
            <input name="security" id="secnum" type="text" />
          </dd>
        </dl>
        <p>
          <button type="submit" name="login" class="button gray" id="loginbtn">ورود</button>
          <button type="reset" name="reset" class="button red" id="loginbtn">انصراف</button>
        </p>
        <?php
echo $error;
$error='';
?>
        <p>آی پی شما <?php echo $_SERVER['REMOTE_ADDR'];?> می باشد. تمامی اطلاعات شما در سایت ذخیره خواهد شد</p>
      </form>
    </section>
  </div>
</div>
</div>
<br>

<footer id="bottom">
	<section class="container_12 clearfix">
		  <p>&copy;اسکریپت حق عضویت VIP - توسعه داده شده توسط <a style="color: #FC0" href="http://joomina.ir" target="_blank">joomina.ir</a> </p>
		
	</section>
</footer>

</body>

</html>
<?php }?>