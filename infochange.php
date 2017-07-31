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
}else
{
    exit('你登陆了吗？');
}

//登录
if(!isset($_POST['submit'])){
	exit('非法访问!');
}
$truename = mysql_real_escape_string(htmlspecialchars($_POST['truename']));
$year = mysql_real_escape_string(htmlspecialchars($_POST['year']));
$learn = mysql_real_escape_string(htmlspecialchars($_POST['learn']));
$work = mysql_real_escape_string(htmlspecialchars($_POST['work']));
$location = mysql_real_escape_string(htmlspecialchars($_POST['location']));
$tel = mysql_real_escape_string(htmlspecialchars($_POST['tel']));
$email = mysql_real_escape_string(htmlspecialchars($_POST['email']));

mysql_query("update user set truename='$truename',year='$year',learn='$learn',work='$work',location='$location',tel='$tel',email='$email' where username='$username'");
if(mysql_affected_rows()>0)
    echo '个人资料修改成功！<br/>';
else
    echo '服务器返回值异常，个人资料修改失败<br/>';
echo '点击此处 <a href="javascript:history.back(-1);">返回</a><br />';
?>
</body>
</html>