<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta charset="utf-8">
</head>
<body>
<?php
$page_start_time = microtime();
session_start();
if(isset($_SESSION['userid'])){
    include('../conn.php');
    $userid = $_SESSION['userid'];
    $username = $_SESSION['username'];
    $user_query = mysqli_query($conn,"select * from user where uid=$userid limit 1");
    $row = mysqli_fetch_array($user_query,MYSQLI_ASSOC);
    $user_type = $row['usr_type']; //建表的时候打错了，而且懒得改了。。。
    $true_name = $row['truename'];
    $email = $row['email'];
    $year = $row['year'];
    $learn = $row['learn'];
    $work = $row['work'];
    $tel = $row['tel'];
    $location = $row['location'];
    $time = $row['regdate'];
  	$imei = $row['eink_imei'];
    $eink_set = $row['eink_set'];
    $api = $row['eink_api'];
    $pic = $row['eink_pic'];
}else
{
    echo <<<html
<script>alert("请先登录！");</script>
<a href="https://www.chenxublog.com/kxct/">点我去登陆</a>
html;
  exit(0);
}
?>
<?php
  echo $imei.$eink_set.$api.$pic;
?>



test
</body>
