<?php
@session_start();
@ob_start();
include("config.php");
$price=$_POST['price'];
if(check()!="admin_1")
{
echo <<<HTML
<meta http-equiv="refresh" content="0; url= index.php">
HTML;
exit();
}
$edit_id=$_GET['edit'];
if($_POST['cancel']){ 
	header('Location: admin.php?msg=cancel');
};

if($_POST['submit']=='go')
{
 $title=$_POST['title'];
 $time=$_POST['time'];
 $price=$_POST['price'];
if(!$title || !$time || !$price)
$error='لطفا تمامی فیلد ها را کامل کنید';
else{
$sqli = mysql_query("INSERT INTO `cat` (`title`,`time` , `price` ) VALUES ('$title','$time','$price')");
if($sqli)
$sus='اطلاعات با موفقیت ثبت شد';
else
$error='ثبت اطلاعات با مشکل روبرو شد!';
}

}else if($_POST['submit']=='update')
{
$title=$_POST['title'];
$time=$_POST['time'];
$price=$_POST['price'];
if(!$title || !$time || !$price)
$error='لطفا تمامی فیلد ها را کامل کنید';
else{
$sqli= mysql_query("UPDATE `cat` SET `title` = '$title',`time` = '$time' ,`price` = '$price' WHERE `id` =$edit_id LIMIT 1");
if($sqli)
$sus='اطلاعات با موفقیت ویرایش شد.';
else
$error='ویرایش اطلاعات با مشکل روبرو شد!';
}
}
if($edit_id)
{
$edit_cat = mysql_fetch_array(mysql_query("SELECT * FROM `cat` where `id`='$edit_id'"));
if(!$edit_cat['title'])
{
echo <<<HTML
<meta http-equiv="refresh" content="0; url= cat_edit.php">
HTML;
}else{
$title=$edit_cat['title'];
$time=$edit_cat['time'];
$price=$edit_cat['price'];
$submit='update';
}
}
if($error)
$status='<div class="error msg">'.$error.'</div>';
else if($sus){
$status='<div class="success msg">'.$sus.'</div>';
header('Location: admin.php?msg=sucsecc');
};
?>
<!DOCTYPE HTML>
<html lang="en"><head>
<title>ایجاد دسته جدید - پنل مدیریت</title>
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
			<a id="site-title" href="#"><span>کاربر گرامی،</a>
			<a id="view-site" href="logout.php">خروج</a>
		</div>
		


		
	</div>
</header>


<section id="content">
	<section class="container_12 clearfix">
		<section id="main" class="grid_9">
			<article id="settings">
				<h1>ایجاد دسته جدید</h1>
				<?php echo $status;?>
				<form class="uniform" name="news" method="post" action="<?php if($submit)echo '?edit='.$edit_id;?>">
				<input type="hidden" name="go" value="">
			
					<dl>
						<dt><label for="newstitle">عنوان دسته</label></dt>
						<dd><input type="text" value="<?php echo $title;?>" class="big" id="newstitle" name="title"></dd>
						
						<dt><label for="newstitle">چند روزه</label></dt>
						<dd><input type="text" value="<?php echo $time;?>" size="8" class="big" id="newstitle" name="time" dir="ltr"></dd>
                        	<div class="warning msg">
				در فیلد "چند روزه" باید عدد وارد شود بطور مثال یک ماه 30 رو وارد میکنید
				</div>
                        <dt><label for="price">قیمت</label></dt>
						<dd><input type="text" value="<?php echo $price;?>" size="8" class="big" id="price" name="price" dir="ltr"></dd>
                        <div class="warning msg">
                        قیمت ها را به تومان وارد کنید
                        </div>

					
					<p>
						<button class="button big" type="submit" value="<?php echo ($submit) ? $submit : 'go';?>" name="submit">ارســال</button>
						<button class="button white" type="submit" name="cancel"  value="cancel">لــغـو</button>
					</p>
				</form>
					<script language="JavaScript" type="text/javascript">
				 var frmvalidator  = new Validator("news");
				 frmvalidator.addValidation("title","req","عنوان دسته را وارد نمایید");
				 frmvalidator.addValidation("time","req","چند روزه را وارد کنید");
				 frmvalidator.addValidation("price","req","قیمت را وارد کنید");
				

				 </script>
				
				
				
				
			</article>
		</section>
		
		<?php include('theme/sidebar.php');?>
		
	</section>
</section>

<footer id="bottom">
	<section class="container_12 clearfix">
		
		<div class="grid_6 alignright">
			سامانه vip توسعه داده شده توسط 
			<font color="red">Joomina.ir</font> 

		</div>
	</section>
</footer>

</body>

</html>