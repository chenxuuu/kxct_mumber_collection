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
$truename = mysqli_real_escape_string(htmlspecialchars($conn,$_POST['truename']));
$year = mysqli_real_escape_string(htmlspecialchars($conn,$_POST['year']));
$learn = mysqli_real_escape_string(htmlspecialchars($conn,$_POST['learn']));
$work = mysqli_real_escape_string(htmlspecialchars($conn,$_POST['work']));
$location = mysqli_real_escape_string(htmlspecialchars($conn,$_POST['location']));
$tel = mysqli_real_escape_string(htmlspecialchars($conn,$_POST['tel']));
$email = mysqli_real_escape_string(htmlspecialchars($conn,$_POST['email']));

mysqli_query($conn,"update user set truename='$truename',year='$year',learn='$learn',work='$work',location='$location',tel='$tel',email='$email' where username='$username'");
if(mysqli_affected_rows($conn)>0)
    echo '<script>alert("个人资料修改成功！");window.location.href = "index.php";</script><br/>';
else
    echo '服务器返回值异常，个人资料修改失败<br/>';
echo '点击此处 <a href="javascript:history.back(-1);">返回</a><br />';
?>
</body>
</html>
