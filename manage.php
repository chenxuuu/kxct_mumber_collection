<!DOCTYPE html>
<html lang="zh-cn">
<head>
<title>网站账号管理</title>
<meta charset="UTF-8"/>
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
?>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<script type="text/javascript" src="js/jquery-1.12.4.js"></script>
<script type="text/javascript" src="js/jquery.dataTables.min.js" /></script>
<link rel="stylesheet" href="css/jquery.dataTables.min.css"/>
<link rel="stylesheet" href="css/bootstrap.min.css" type="text/css" />
<script src="js/bootstrap.min.js" type="text/javascript"></script>
<script src="js/pace.min.js" type="text/javascript"></script>
<link rel="stylesheet" href="css/pace.css"/>
<link rel="shortcut icon" href="favicon.ico">
</head>
<body>
<table id="kxct_list" class="display" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th>用户UID</th>
            <th>用户ID</th>
            <th>注册时间</th>
            <th>操作</th>
            <th>毕业年份</th>
            <th>姓名</th>
            <th>电话</th>
            <th>邮箱</th>
        </tr>
    </thead>
    <tbody>
<?php
include('conn.php');
if (!$conn)
{
	die('数据库读取失败！' . mysqli_error($conn));
}

$q = "SELECT * FROM user"; //SQL 查询语句

$result = mysqli_query($conn,$q); // 获取数据集

while($row = mysqli_fetch_array($result,MYSQLI_ASSOC))
{
    echo "<tr>",
    "<td>",$row['uid'],"</td>",
    "<td>",$row['username'],"</td>",
    "<td>",date("Y-m-d,H:i:s",$row['regdate']),"</td>",
    "<td>","<a onclick='delete_confirm(".$row['uid'].")'>删除该用户</a>","</td>",
    "<td>",$row['year'],"</td>",
    "<td>",$row['truename'],"</td>",
    "<td>",$row['tel'],"</td>",
    "<td>",$row['email'],"</td>",
    "</tr>";

}

mysqli_close($conn);
?>
    </tbody>
</table>
<script>
$(document).ready(function() {
$('#kxct_list').DataTable();
} );
function delete_confirm(e)
{
    if(confirm("删除是不可恢复的，你确认要删除吗？"))
    {
        window.location.href = "del.php?uid="+e;
    }
}
</script>
</body>
</html>
