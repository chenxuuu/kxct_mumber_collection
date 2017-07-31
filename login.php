<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta charset="utf-8">
</head>
<body>
<?php
session_start();
if(isset($_SESSION['userid'])){
	$islogin = 1;
}else
{
    $islogin = 0;
}

//注销登录
if($islogin == 1)
if($_GET['action'] == "logout"){
	unset($_SESSION['userid']);
	unset($_SESSION['username']);
	echo '注销登录成功！点击此处 <a href="javascript:history.back(-1);">返回</a>';
	exit;
}

//登录
if(!isset($_POST['submit'])){
	exit('非法访问!');
}
$username = htmlspecialchars($_POST['username']);
$password = MD5($_POST['password']);
if(!preg_match('/^[a-zA-Z0-9]{1,15}$/', $username)){
	exit('错误：用户名异常。<a href="javascript:history.back(-1);">返回</a>');
}
//包含数据库连接文件
include('conn.php');
//检测用户名及密码是否正确
$check_query = mysql_query("select uid from user where username='$username' and password='$password' limit 1");
if($result = mysql_fetch_array($check_query)){
	//登录成功
	$_SESSION['username'] = $username;
	$_SESSION['userid'] = $result['uid'];
	echo '用户 '.$username,' 登陆成功！<br />';
	echo '点击此处 <a href="javascript:history.back(-1);">返回</a><br />';
	exit;
} else {
	exit('登录失败！点击此处 <a href="javascript:history.back(-1);">返回</a> 重试');
}
?>
</body>
</html>