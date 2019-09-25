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
    $user_query = mysqli_query($conn,"select * from user where uid=$userid limit 1");
    $row = mysqli_fetch_array($user_query,MYSQLI_ASSOC);
    $user_type = $row['usr_type']; //建表的时候打错了，而且懒得改了。。。
    if($user_type != 'owner' && $user_type != 'admin')
        exit('你没有管理用户的权限，另外你是怎么找到这个页面的？快点忘掉！');
}else
{
    exit('你登陆了吗？');
}

if(!empty($_GET['uid']))
{
    $uid = $_GET['uid'];
}
else
{
    exit('参数错误');
}

$user_query = mysqli_query($conn,"select * from user where uid=$uid limit 1");
$row = mysqli_fetch_array($user_query,MYSQLI_ASSOC);
$username = $row['username'];

mysqli_query($conn,"delete from user where uid=$uid");
$mark  = mysqli_affected_rows($conn);//返回影响行数
if($mark>0)
{
    exit('<script>alert("用户'.$username.' 删除成功！");window.location.href = "manage.php";</script>');
}
else
{
    echo '抱歉！数据修改失败：',mysqli_error($conn),'<br />';
	echo '点击此处 <a href="javascript:history.back(-1);">返回</a> 重试';
}
?>
</body>
</html>
