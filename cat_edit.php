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
<title>ویرایش دسته ها - پنل مدیریت</title>
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
			<a id="site-title" href="#"><span>کاربر گرامی ،</a>
			<a id="view-site" href="logout.php">خروج</a>
		</div>
		


		
	</div>
</header>


<section id="content">
	<section class="container_12 clearfix">
		<section id="main" class="grid_9">
			<article id="settings">
				<h1>مدیریت دسته ها</h1>
				<a href="cat_send.php"><button  class="button small red">ارسال دسته جدید</button></a>
				<br /><br />
				<div class="warning msg">
				آخرین دسته های ارسال شده در سایت به شرح زیر می باشد.در صورتی که قصد ارسال دسته جدید دارید میتوانید روی دکمه بالا کلیک کنید
				</div>
<?php
$delete=$_GET['delete'];
if($delete)
{
$sql_del=mysql_query("DELETE FROM `cat` WHERE id = $delete");
if($sql_del)
echo '<div class="success msg">دسته مورد نظر با موفقیت حذف گردید</div>';
else
echo '<div class="error msg">حذف دسته مورد نظر با مشکل روبرو شد!</div>';
}
?>				
				<table class="gtable sortable" id="table1">
						<thead>
							<tr>
								<th>شناسه دسته</th>
								<th>عنوان دسته</th>
								<th>عملیات مدیریت</th>
							</tr>
						</thead>
						<tbody>
<?php
$query	=	mysql_query("select * from `cat`");
for ( $i = 0 ; $i < mysql_num_rows($query) ; $i++ )
	{
	$id			=  	@mysql_result($query,$i,"id");
		if ( $id != "" )
			{
	$title	=	@mysql_result($query,$i,"title");
echo <<<HTML
	<tr>
								<td>$id</td>
								<td>$title</td>
								<td>
									<a href="cat_send.php?edit=$id"><img src="images/news_edit.png" border="0" title="ویرایش دسته" />
									<a onclick="if (confirm('ایا از حذف دسته انتخاب شده مطمئن هستید؟')) window.location = '?delete=$id';" href="#"><img src="images/news_delete.png" border="0" title="حذف دسته" /></a>
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