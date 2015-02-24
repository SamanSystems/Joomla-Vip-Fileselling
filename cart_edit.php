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
?>
<!DOCTYPE HTML>
<html lang="en">
<head>
<title>ویرایش اکانت ها - پنل مدیریت</title>
<meta charset="utf-8">

<link rel="stylesheet" type="text/css" href="css/style.css">
<link rel="stylesheet" type="text/css" href="css/skins/red.css" title="gray">
<link rel="stylesheet" type="text/css" href="css/superfish.css">



<link rel="stylesheet" type="text/css" href="css/smoothness/jquery-ui-1.8.8.custom.css">

<!--[if lte IE 8]>
<script type="text/javascript" src="js/html5.js"></script>
<script type="text/javascript" src="js/selectivizr.js"></script>
<script type="text/javascript" src="js/excanvas.min.js"></script>
<![endif]-->

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
				<h1>مدیریت اکانت ها</h1>
				<a href="cart_send.php"><button  class="button small red">ارسال اکانت جدید</button></a>
				<br /><br />
				<div class="warning msg">
				آخرین اکانت های ارسال شده در سایت به شرح زیر می باشد.در صورتی که قصد ارسال اکانت جدید دارید میتوانید روی دکمه بالا کلیک کنید
				</div>
<?php
$delete=$_GET['delete'];
$active=$_GET['active'];
if($delete)
{
$user_p = mysql_fetch_array(mysql_query("SELECT * FROM `users` where id='$delete'"));
$username=$user_p['user'];
$password=$user_p['pass'];
if($username)
$del_user=del_user($delete,$username,$password);
if($del_user==1){
$sql_del=mysql_query("DELETE FROM `users` WHERE id = $delete");

if($sql_del)
echo '<div class="success msg">اکانت مورد نظر با موفقیت حذف گردید</div>';
else
echo '<div class="error msg">حذف اکانت مورد نظر با مشکل روبرو شد!</div>';
}
}else if($active)
{
$user_p = mysql_fetch_array(mysql_query("SELECT * FROM `users` where id='$active'"));
$username=$user_p['user'];
$password=$user_p['pass'];
$active_u=$user_p['active'];
($active_u==1)?$active_p=0:$active_p=1;
if($username)
{
if($active_p==0)
$update_user=del_user($active,$username,$password);
else
$update_user=update_user($active,$username,$password,'del');
}
if($update_user==1){
$sql_del=mysql_query("UPDATE `users` SET `active` = '$active_p' WHERE `id` =$active LIMIT 1");
if($sql_del)
echo '<div class="success msg">اکانت مورد نظر با موفقیت تغییر یافت</div>';
else
echo '<div class="error msg">تغییر اکانت مورد نظر با مشکل روبرو شد!</div>';
}
}
?>				
				<table class="gtable sortable" id="table1">
						<thead>
							<tr>
								<th>شناسه اکانت</th>
								<th>نام کاربری</th>
								<th>تاریخ اتمام</th>
								<th>عملیات مدیریت</th>
							</tr>
						</thead>
						<tbody>
<?php
$query	=	mysql_query("select * from `users` where `user`!='admin' ORDER BY id DESC");
for ( $i = 0 ; $i < mysql_num_rows($query) ; $i++ )
	{
	$id			=  	@mysql_result($query,$i,"id");
		if ( $id != "" )
			{
	$user	=	@mysql_result($query,$i,"user");
	$endtime	=	@mysql_result($query,$i,"endtime");
	$active	=	@mysql_result($query,$i,"active");
if($active==1)
{
$active='غیر فعال کردن';
}
else{
$active='فعال کردن';
}

$my_endtime=jgetgmdate($endtime);
$endtime=$my_endtime['year'] .'/'.$my_endtime['mon'] .'/'.$my_endtime['mday'] ;
echo <<<HTML
	<tr>
								<td>$id</td>
								<td>$user</td>
								<td>$endtime</td>
								<td>
									<a href="cart_send.php?edit=$id"><img src="images/news_edit.png" border="0" title="ویرایش اکانت" />
									<a onclick="if (confirm('آیا از حذف اکانت انتخاب شده مطمئن هستید؟')) window.location = '?delete=$id';" href="#"><img src="images/news_delete.png" border="0" title="حذف اکانت" /></a>
								<a onclick="if (confirm('آیا از $active  اکانت مطمئن هستید؟')) window.location = '?active=$id';" href="#">$active</a>
								</td>
							</tr>
HTML;
			}else{break;}
	}
?>
							
							
						</tbody>
					</table>
				
				
				
			</article>
		</section>
		
		<?php include('theme/sidebar.php');?>
		
	</section>
</section>

<footer id="bottom">
	<section class="container_12 clearfix">
		
		<div class="grid_6 alignright">
			سیستم حق اشتراک کاربران | VIP 
			<font color="red">توسعه داده شده توسط joomina.ir</font> 
		</div>
	</section>
</footer>

</body>

</html>

