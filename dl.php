<?php 
session_start();
ob_start();
include("config.php");
// register form 
if(isset($_COOKIE['vipdownload'])) {
  unset($_COOKIE['vipdownload']);}


if ($_POST['submit2']) {
	
    if(!$_POST['username']) echo '<div class="error msg">'.'نام کاربري خالي رها شده است لطفا آن را پر نماييد'.'</div>';
	if(!$_POST['useremail']) echo '<div class="error msg">'.'لطفا ايميل خود را وارد نماييد'.'</div>';
	if(!$_POST['cat']) echo '<div class="error msg">'.'لطفا مدت زمان اشتراک خود را تعيين کنيد'.'</div>';
	if(!$_POST['password']) echo '<div class="error msg">'.'رمز خود را وارد نکرده ايد . لطفا رمز را وارد کنيد'.'</div>';
	if($_POST['password']!=$_POST['password2']) echo '<div class="error msg">'.'رمز هاي وارد شده تطابق ندارد لطفا دوباره سعي کنيد'.'</div>';
	
	$username=$_POST['username'];
	   $useremail=$_POST['useremail'];
	   $uservalidate = mysql_fetch_array(mysql_query("SELECT * FROM `users` where `user`='$username'"));
	   $emailvalidate = mysql_fetch_array(mysql_query("SELECT * FROM `users` where `useremail`='$useremail'"));
	
	   if (isset($uservalidate['user'])) { echo '<div class="error msg">'.'اين نام کاربري قبلا توسط شخص ديگري انتخاب شده است لطفا نام ديگري برگزينيد'.'</div>';
	    } elseif ($emailvalidate['useremail']) { 
	     echo '<div class="error msg">'.'اين ايميل قبلا توسط شخص ديگري انتخاب شده است لطفا ايميل ديگري برگزينيد'.'</div>'; }
	
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
	$username = $_POST['username'];
	$password =  $_POST['password'];
	if ($_SESSION["resller_username"]) $username = $_SESSION["resller_username"] ; 
	if ($_SESSION["resller_password"]) $password = $_SESSION["resller_password"] ; 
	
	$setting_user = mysql_fetch_array(mysql_query("SELECT * FROM `users` where `user`='$username' AND `pass`='$password'"));
$time=jgetgmdate($setting_user['time']);
$endtime=jgetgmdate($setting_user['endtime']);
$active=$setting_user['active'];
?>


                <?php 
				$tt=time();
				
				
				if (($setting_user['endtime'] < time()) or ($setting_user['active']=='0') ) {
				echo <<<HTML
<meta http-equiv="refresh" content="0; url= user.php">
HTML;
				}else {
// download file
$add =$_GET['file'];
$add2 = $_POST['file'];
if (!$add) $add = $add2 ;
$mime=explode("." , $add);
$filename = explode ('/',$add);
$filename = end($filename);
$file_name = $filename ;
//header("'Content-type: application/". $mime[1]  . "'");

// argc http://localhost:1080/tttest/dl/download/vip/v.zip
 $url = $add;

$parsedUrl = parse_url($url);
$path1 = $parsedUrl['path'];///tttest/dl/download/vip/v.zi
//curent folder
$pathfolder =  basename(__DIR__);// will return the current directory name only
$pathfolder = $pathfolder.'/';
$path = explode($pathfolder , $path1);
$filename =$path[1];
$mime=$mime[2];

$url = explode ('./' , $url);
$filename = 'dl/'. $url[1];
// echo $filename;
if (file_exists("$filename")) {
	/////////////////////////////////////////
			
			$name_file=$file_name;
			$hash =  date('l jS \of F Y').$_SERVER['SERVER_SIGNATURE'];
			$hash = md5($hash);
			$admin_cookie_code=$hash;
			
			setcookie("vipdownload",$hash,0,"/");
			$cur_dir = explode('\\', getcwd());
			if (empty($_SERVER['HTTPS']) || $_SERVER['HTTPS'] === 'off') {
			$protocol = 'http://';
			} else {
			$protocol = 'https://';
			}
			$base_url = $protocol . $_SERVER['SERVER_NAME'] . dirname($_SERVER['PHP_SELF']);
			$url =  $base_url.'/'.$filename;
			header("Location:". $url );

		?>
 <script type='text/javascript'>
    self.close();
    </script>  
	<?php
    ////////////////////////////////////////////	
	 }
				};



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
<title>دانلود سيستم فايل هاي مشترکين ...</title>
<meta charset="utf-8">
<link rel="stylesheet" type="text/css" href="css/style.css">
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
			<a id="site-title" href="#">ثبت نام / ورود اعضا در سامانه مشترکين</a>
		</div>
	</div>
</header>
<div class="container_12 clearfix">
<div id="desc2" class="grid_12">
<style>
	#desc2 {
		background-color:#900 ; padding:10px;
		margin:10px;
		color:#FFF;
		font-size:22px;
		  font-family: 'BKoodakBold';}
</style>

<p> به نظر ميايد شما حق اشتراک خريداري ننموده ايد و يا به سامانه وارد نشده ايد لطفا  مشخصاتي  که در سامانه ثبت نموده ايد را در قسمت ورود وارد نموده و يا جهت استفاده از فايلهايي که جهت مشترکين تدارک ديده شده است در سامانه ثبت نام نماييد</p>
</div>

<!--  make account -->
<div class="box2 grid_7">
	<div class="regiter_title">
     ثبت نام 
    </div>
  <div class="reg">
  <ul>
  	<li>استفاده از دانلود رايگان داراي محدوديت هايي است</li>
    <li>هم اکنون ثبت نام کنيد و اکانت خود را خريداري نماييد</li>
    <li>چنانچه در مراحل پرداخت دچار مشکل شديد ميتوانيد از قسمت تماس با ما سايت با ما در ميان بگذاريد</li>
    <li>اکانت شما پس از پرداخت به صورت آني و با مشخصاتي که خودتان در فرم زير انتخاب ميکنيد فعال خواهد شد</li>
    <li>پس از پرداخت به صفحه اي هدايت ميشويد که شماره تراکنش شما را نمايش خواهد داد لطفا اين شما را نزد خود نگه داريد</li>
    <li></li>
  </ul>

  </div>
  <div class="formregister">
  <form action="" method="post" name="register" >
  	<dl>
    					<dt><label for="useremail" class="font">ايميل :</label></dt>
						<dd><input type="text"  id="useremail" name="useremail" dir="ltr"></dd>
                        
                        
                        
						<dt><label for="newstitle1" class="font">نام کاربري</label></dt>
						<dd><input type="text" value="<?php echo $username;?>" id="newstitle1" name="username" dir="ltr"></dd>
						
						<dt><label for="newstitle2" class="font">رمز عبور</label></dt>
						<dd><input type="password" value="<?php echo $password;?>"  id="newstitle2" name="password" dir="ltr"></dd>
                        
                        <dt><label for="newstitle3" class="font">تائيديه رمز عبور</label></dt>
						<dd><input type="password" value="<?php echo $password;?>"  id="newstitle3" name="password2" dir="ltr"></dd>
                        
                       
                        
						<?php if(!$submit)
						{?>
                        
						<dt><label for="newstitle">نوع اکانت</label></dt>
						<dd>
<?php
$result = mysql_query("SELECT * FROM cat");
while($r=mysql_fetch_array($result))
{
$id=$r["id"];
$title=$r["title"];
echo <<<HTM
				<input type="radio" name="cat" value="$id">$title
				
HTM;
}				
?>
<?php 
}else{
$my_endtime=jgetgmdate($endtime);
$endtime=$my_endtime['year'] .'/'.$my_endtime['mon'] .'/'.$my_endtime['mday'] ;
echo <<<HTML
<dt><label for="endtime">تاريخ اتمام</label></dt>
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
 frmvalidator.addValidation("useremail","req","لطفا ايميل خود را وارد کنيد");
 frmvalidator.addValidation("useremail","email",
        "لطفا ايميل معتبري وارد کنيد");
	 frmvalidator.addValidation("userename","req","لطفا نام کاربري خود را وارد کنيد");	
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
            <label for="username" class="font">نام کاربري</label>
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
            <label for="sec" class="font">کد امنيتي</label>
          </dt>
          <dd><img id="sec" border="0" src="img/img.php" /> <a href="#" onClick="document.getElementById('sec').src = 'img/img.php?id='+randnumber(); return false"><img src="images/refresh.png" width="20" height="20"/></a> </dd>
          <dt>
            <label for="secnum">کد امنيتي را در کادر پايين وارد نماييد</label>
          </dt>
          <dd>
         
          <input type="hidden" name="file"  value=" <?php echo "file=".$_GET['file']; ?>"/>
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
        <p>آي پي شما <?php echo $_SERVER['REMOTE_ADDR'];?> مي باشد. تمامي اطلاعات شما در سايت ذخيره خواهد شد</p>
      </form>
    </section>
  </div>
</div>
</div>



</body>

</html>
<?php }?>
