<!DOCTYPE html>
<html lang="zh-cn">
<head>
<title>科创成员信息</title>
<meta charset="UTF-8"/>
<?php
session_start();
if(isset($_SESSION['userid'])){
    include('conn.php');
    $userid = $_SESSION['userid'];
    $user_query = mysql_query("select * from user where uid=$userid limit 1");
    $row = mysql_fetch_array($user_query);
    $user_type = $row['usr_type']; //建表的时候打错了，而且懒得改了。。。
    if($user_type != 'owner' && $user_type != 'admin')
        exit('你没有管理用户的权限，另外你是怎么找到这个页面的？快点忘掉！');
}else
{
    exit('你登陆了吗？');
}
?>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
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
	die('数据库读取失败！' . mysql_error());
}

$q = "SELECT * FROM user"; //SQL 查询语句

$result = mysql_query($q); // 获取数据集

while($row = mysql_fetch_array($result))
{
    echo "<tr>",
    "<td>",$row['uid'],"</td>",
    "<td>",$row['username'],"</td>",
    "<td>",date("Y-m-d,H:i:s",$row['regdate']),"</td>",
    "<td>","<a href='del.php?uid=".$row['uid']."'>删除该用户</a>","</td>",
    "<td>",$row['year'],"</td>",
    "<td>",$row['truename'],"</td>",
    "<td>",$row['tel'],"</td>",
    "<td>",$row['email'],"</td>",
    "</tr>";
	
}
	
mysql_close($conn);
?>
    </tbody>
</table>
</body>
</html>