<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta charset="utf-8">
</head>
<body>
<?php
session_start();
if(isset($_SESSION['userid'])){
    include('../conn.php');
    $userid = $_SESSION['userid'];
    $username = $_SESSION['username'];
}else
{
    exit('你登陆了吗？');
}

$api = mysqli_real_escape_string($conn,htmlspecialchars($_POST['api']));
mysqli_query($conn,"update user set eink_api='$api' ,eink_set='api' where uid=$userid");
if(mysqli_affected_rows($conn)>0)
    echo '<script>alert("api修改成功！");window.location.href = "index.php";</script><br/>';
else
    echo '服务器返回值异常，api修改失败<br/>';
echo '点击此处 <a href="javascript:history.back(-1);">返回</a><br />';
echo $api;
?>
</body>
</html>
