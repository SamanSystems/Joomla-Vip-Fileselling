<?php
include("config.php");

$file = 'dl/download/.htaccess';

if (file_exists("$file")) {echo "فایل وجود دارد ..." . "<br/><hr/>";}


if (!unlink($file))
  {
  echo ("ناتوان در حذف اطلاعات");
  }
else
  {
  echo ("اطلاعات داخل فایل حذف شد .... ");
  }

$time=time();
$query	=	mysql_query("select * from `users` where endtime<=$time AND active=1");
for ( $i = 0 ; $i < mysql_num_rows($query) ; $i++ )
	{
	$id			=  	@mysql_result($query,$i,"id")				;
		if ( $id != "" )
			{
$user_p = mysql_fetch_array(mysql_query("SELECT * FROM `users` where id='$id'"));
$username=$user_p['user'];
$password=$user_p['pass'];
$update_user=del_user($id,$username,$password);
if($update_user==1){
$sql_del=mysql_query("UPDATE `users` SET `active` = '0' WHERE `id` =$id LIMIT 1");
}
			}
	}

function creat($name,$file)
{
	$fp = fopen($name,"w") or $error=1;
	fputs($fp,$file);
	fclose($fp) or $error=1;
	if($error){$status= '0';}else{ $status= '1';}
	return ($status);
	}
		$hash =  date('l jS \of F Y').$_SERVER['SERVER_SIGNATURE'];
		$hash = md5($hash);
				$insidehtaccess = 'RewriteEngine On
RewriteBase /
RewriteCond %{HTTP_COOKIE} !vipdownload=' . $hash .'  [NC]
RewriteRule .* - [L,F]';
		creat('dl/download/.htaccess', $insidehtaccess);	
?>
