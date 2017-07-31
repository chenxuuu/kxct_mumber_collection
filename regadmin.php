<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta charset="utf-8">
</head>
<body>
<?php
function getRandom($param){
    $str="0123456789abcdefghijklmnopqrstuvwxyz";
    $key = "";
    for($i=0;$i<$param;$i++)
     {
         $key .= $str{mt_rand(0,35)};
     }
     return $key;
}

if(!isset($_POST['submit'])){
	exit('非法访问!');
}
session_start();
if(isset($_SESSION['userid'])){
    include('conn.php');
    $userid = $_SESSION['userid'];
    $user_query = mysql_query("select * from user where uid=$userid limit 1");
    $row = mysql_fetch_array($user_query);
    $user_type = $row['usr_type']; //建表的时候打错了，而且懒得改了。。。
    if($user_type != 'owner')
        exit('你没有添加用户的权限，另外你是怎么找到这个页面的？快点忘掉！');
}else
{
    exit('你登陆了吗？');
}


$username = $_POST['username'];
//注册信息判断
if(!preg_match('/^[a-zA-Z0-9]{1,15}$/', $username)){
	exit('错误：用户名不符合规定，用户名必须是纯英文字母、数字。<a href="javascript:history.back(-1);">返回</a>');
}

$check_query = mysql_query("select uid from user where username='$username' limit 1");
if(mysql_fetch_array($check_query)){
	echo '错误：用户名 ',$username,' 已存在。<a href="javascript:history.back(-1);">返回</a>';
	exit;
}
//写入数据
$passwordt = getRandom(6);
$password = MD5($passwordt);
$regdate = time();
$user_type = 'admin';
$sql = "INSERT INTO user(username,password,regdate,usr_type)VALUES('$username','$password',$regdate,'$user_type')";
if(mysql_query($sql,$conn)){
	exit('用户添加成功！密码是：'.$passwordt.'<br/>请记下自动生成的密码，以免忘记<br/>点击此处 <a href="javascript:history.back(-1);">返回</a>');
} else {
	echo '抱歉！添加数据失败：',mysql_error(),'<br />';
	echo '点击此处 <a href="javascript:history.back(-1);">返回</a> 重试';
}
?>
</body>
</html>