<?php
@session_start();
@ob_start();
function cpass($pass)
{
$password = crypt($pass, base64_encode($pass));
if($GLOBALS["localhost"]==1)
return $pass;
else
return $password;
}
function check()
{
if($_SESSION["resller_on"]=="true")
{
$username_check=$_SESSION["resller_username"];
$password_check=$_SESSION["resller_password"];
$login_user = mysql_num_rows(mysql_query("SELECT * FROM `users` where `user`='$username_check' AND `pass`='$password_check'"));
if($login_user==0)
{
return 0;
}else{
if($username_check=="admin")
{
return "admin_1";
}else{
return "user_1";
}
}
}
}
function save_user($username,$password)
{
$fn = "dl/.htpasswd";
$file = file_get_contents('dl/.htpasswd');
$file.=$username.':'.cpass($password)."\n";
$fp = fopen($fn,"w") or $error="Error opening file in write mode!";
fputs($fp,$file);
fclose($fp) or $error="Error closing file!";
if(!$error)
return 1;
else
return $error;
}
function del_user($id,$username,$password)
{
$fn = "dl/.htpasswd";
$file = file_get_contents('dl/.htpasswd');
$del=$username.':'.cpass($password);
$file=str_replace($del,'delete_'.$del.$id,$file);
$fp = fopen($fn,"w") or $error="Error opening file in write mode!";
fputs($fp,$file);
fclose($fp) or $error="Error closing file!";
if(!$error)
return 1;
else
return $error;
}
function update_user($id,$username,$password,$action)
{
$fn = "dl/.htpasswd";
$file = file_get_contents('dl/.htpasswd');
$del=$username.':'.cpass($password);
if($action=='del'){
$file=str_replace('delete_'.$del.$id,$del,$file);
}else
{
$edit_cart = mysql_fetch_array(mysql_query("SELECT * FROM `users` where `id`='$id'"));
$username_old=$edit_cart['user'];
$password_old=$edit_cart['pass'];
$active=$edit_cart['active'];
if($active==0)
{
$user_old='delete_'.$username_old.':'.cpass($password_old).$id;
$user_new='delete_'.$username.':'.cpass($password).$id;
}else{
$user_old=$username_old.':'.cpass($password_old);
$user_new=$username.':'.cpass($password);
}
if($username_old)
$file=str_replace($user_old,$user_new,$file);
else
$error="not found User";
}
$fp = fopen($fn,"w") or $error="Error opening file in write mode!";
fputs($fp,$file);
fclose($fp) or $error="Error closing file!";
if(!$error)
return 1;
else
return $error;
}
?>