<!DOCTYPE html>
<html lang="zh-cn">
<head>
<title>科创成员信息</title>
<meta charset="UTF-8"/>
<?php
session_start();
if(!isset($_SESSION['userid'])){
    exit('请登录后再看');
}
include('conn.php');
$userid = $_SESSION['userid'];
$username = $_SESSION['username'];
$user_query = mysql_query("select * from user where uid=$userid limit 1");
$row = mysql_fetch_array($user_query);
$user_type = $row['usr_type'];
if($user_type=="")
    exit('<script>alert("你没有该权限");</script>');
?>
<meta name="renderer" content="webkit">
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
            <th>毕业年份</th>
            <th>姓名</th>
            <th>所读专业</th>
            <th>现在的情况</th>
            <th>地点</th>
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
    "<td>",$row['year'],"</td>",
    "<td>",$row['truename'],"</td>",
    "<td>",$row['learn'],"</td>",
    "<td>",$row['work'],"</td>",
    "<td>",$row['location'],"</td>",
    "<td>",$row['tel'],"</td>",
    "<td>",$row['email'],"</td>",
    "</tr>";

}

mysql_close($conn);
?>
    </tbody>
</table>
<script>
$(document).ready(function() {
$('#kxct_list').DataTable();
} );
</script>
</body>
</html>
