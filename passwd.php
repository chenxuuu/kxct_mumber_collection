<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta charset="utf-8">
</head>
<body>
<?php
session_start();
if(isset($_SESSION['userid'])){
    include('conn.php');
    $userid = $_SESSION['userid'];
    $username = $_SESSION['username'];
    $user_query = mysql_query("select * from user where uid=$userid limit 1");
    $row = mysql_fetch_array($user_query);
}else
{
    exit('你登陆了吗？');
}

//登录
if(!isset($_POST['submit'])){
	exit('非法访问!');
}
$password = MD5($_POST['psdold']);
$password_new = MD5($_POST['psdnew1']);

//包含数据库连接文件
//include('conn.php');
//检测用户名及密码是否正确
$check_query = mysql_query("select uid from user where username='$username' and password='$password' limit 1");
if($result = mysql_fetch_array($check_query)){
	//登录成功
	echo '用户 '.$username,' 验证成功！<br />';
    mysql_query("update user set password='$password_new' where username='$username'");
//    echo mysql_affected_rows().'<br/>';
    if(mysql_affected_rows()>0)
        echo '密码修改成功！<br/>';
    else
        echo '服务器返回值异常，密码修改失败<br/>';
	echo '点击此处 <a href="javascript:history.back(-1);">返回</a><br />';
} else {
	exit('原密码错误！点击此处 <a href="javascript:history.back(-1);">返回</a> 重试');
}
?>
</body>
</html>