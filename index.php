<?php
session_start();
if(isset($_SESSION['userid'])){
	$islogin = 1;
    include('conn.php');
    $userid = $_SESSION['userid'];
    $username = $_SESSION['username'];
    $user_query = mysql_query("select * from user where uid=$userid limit 1");
    $row = mysql_fetch_array($user_query);
    $user_type = $row['usr_type']; //建表的时候打错了，而且懒得改了。。。
    $true_name = $row['truename'];
    $email = $row['email'];
    $year = $row['year'];
    $learn = $row['learn'];
    $work = $row['work'];
    $tel = $row['tel'];
    $location = $row['location'];
    $time = $row['regdate'];
}else
{
    $islogin = 0;
}
?>
<!DOCTYPE html>
<html lang="zh-CN">
<!-- 因为水平有限，没系统性学过网页设计，所以网站可能有bug和低效率代码，求哪位大佬看见了能帮忙优化一下😂 -->
<head>
<meta charset="utf-8">
<meta name="renderer" content="webkit">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="万方科技学院科技创新室历届成员联系方式与成员信息收集计划">
<meta name="keywords" content="万方科技学院, 科技创新室">
<meta name="author" content="晨旭 <lolicon@papapoi.com>">
<title>科创成员联系方式收集</title>
<!--[if lte IE 8]>
<script>alert("您的浏览器版本过老，无法兼容本网站，为了兼容性和您的安全，请升级您的浏览器或使用webkit内核的浏览器。");
window.location.href = 'http://www.chenxublog.com/explorer.html';</script>
<![endif]-->
<link rel="shortcut icon" href="favicon.ico">
<link rel="stylesheet" href="//cdn.bootcss.com/bootstrap/2.3.2/css/bootstrap.min.css">
<link rel="stylesheet" href="css/bootstrap-responsive.min.css"><!--自适应要用到的css-->
<script src="//cdn.bootcss.com/jquery/1.11.3/jquery.min.js"></script>
<script src="//cdn.bootcss.com/bootstrap/2.3.2/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container-fluid">
	<div class="row-fluid">
		<div class="span2">
			<img alt="140x140" src="images/logo.png" />
			<ul class="nav nav-list">
				<li class="nav-header">
					导航菜单
				</li>
				<li class="active">
					<a href="index.php">首页</a>
				</li>
                <?php
                if($islogin == 1){
                    echo <<<html
				<li>
					<a href="list.php" target="_blank">科创成员查询</a>
				</li>
				<li>
					<a href="#modal-container-80097" data-toggle="modal">修改个人资料</a>
                    <div id="modal-container-80097" class="modal hide fade" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-header">
                             <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h3 id="myModalLabel">
                                修改个人资料
                            </h3>
                        </div>
                        <div class="modal-body">
                            <p>
                                <form name="info" method="post" action="infochange.php">
                                    用户名：$username<br/>
html;
                                    echo '账号权限：';if($user_type == 'owner'){echo '站长';}elseif($user_type == 'admin'){echo '管理员';}else{echo '普通成员';}echo '<br/>';
                                    echo <<<html
                                    姓名：<br/>
                                    <input type="text" name="truename" value="$true_name"/><br/>
                                    毕业年份：<br/>
                                    <input type="text" name="year" value="$year"/><br/>
                                    所读专业：<br/>
                                    <input type="text" name="learn" value="$learn"/><br/>
                                    现在的工作/情况：<br/>
                                    <input type="text" name="work" value="$work"/><br/>
                                    所在地点：<br/>
                                    <input type="text" name="location" value="$location"/><br/>
                                    电话：<br/>
                                    <input type="text" name="tel" value="$tel"/><br/>
                                    邮箱：<br/>
                                    <input type="text" name="email" value="$email"/><br/>
                                    <button type="submit" name="submit" class="btn btn-info">修改个人资料</button>
                                </form>
                            </p>
                        </div>
                        <div class="modal-footer">
                             <button class="btn" data-dismiss="modal" aria-hidden="true">关闭</button>
                        </div>
                    </div>
				</li>
				<li>
					<a href="#modal-container-80096" data-toggle="modal">修改密码</a>
                    <div id="modal-container-80096" class="modal hide fade" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-header">
                             <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h3 id="myModalLabel">
                                修改密码
                            </h3>
                        </div>
                        <div class="modal-body" style="text-align:center">
                            <p>
                                <form name="ChangePassword" method="post" action="passwd.php" onSubmit="return psdCheck(this)">
                                    原密码：<br/>
                                    <input type="password" name="psdold"/><br/>
                                    新密码：<br/>
                                    <input type="password" name="psdnew1"/><br/>
                                    再次输入新密码：<br/>
                                    <input type="password" name="psdnew2"/><br/>
                                    <button type="submit" name="submit" class="btn btn-info">修改密码</button>
                                </form>
<script>function psdCheck(RegForm){
    if (ChangePassword.psdnew1.value != ChangePassword.psdnew2.value){alert("两次密码输入不一致");return (false);}
    if (ChangePassword.psdnew1.value == ""){alert("请输入要修改的密码");return (false);}
    if (ChangePassword.psdold.value == ""){alert("请输入原密码");return (false);}}</script>
                            </p>
                        </div>
                        <div class="modal-footer">
                             <button class="btn" data-dismiss="modal" aria-hidden="true">关闭</button>
                        </div>
                    </div>
				</li>
html;
                }
                else
                {
                    echo <<<html
				<li>
					<a href="#">请先登陆</a>
				</li>
html;
                }
                ?>
                <?php
                if($islogin == 1){
                if($user_type == 'owner' || $user_type == 'admin')
                {
                    echo <<<html
				<li class="nav-header">
					用户管理（社长权限）
				</li>
				<li>
					<a href="#modal-container-80094" data-toggle="modal">添加成员</a>
                    <div id="modal-container-80094" class="modal hide fade" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-header">
                             <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h3 id="myModalLabel">
                                添加成员
                            </h3>
                        </div>
                        <div class="modal-body" style="text-align:center">
                            <p>
                                <form name="RegForm" method="post" action="reg.php">
                                    用户名（非姓名，仅允许英文字母或数字）：<br/>
                                    <input type="text" name="username"/><br/>
                                    <button type="submit" name="submit" class="btn btn-info">添加新账号</button>
                                </form>
                            </p>
                        </div>
                        <div class="modal-footer">
                             <button class="btn" data-dismiss="modal" aria-hidden="true">关闭</button>
                        </div>
                    </div>
				</li>
				<li>
					<a href="#">管理成员（开发中）</a>
				</li>
html;
                }
                if($user_type == 'owner')
                {
                    echo <<<html
				<li>
					<a href="#modal-container-80095" data-toggle="modal">添加社长</a>
                    <div id="modal-container-80095" class="modal hide fade" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-header">
                             <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h3 id="myModalLabel">
                                添加社长
                            </h3>
                        </div>
                        <div class="modal-body" style="text-align:center">
                            <p>
                                <form name="RegAdminForm" method="post" action="regadmin.php">
                                    用户名（非姓名，仅允许英文字母或数字）：<br/>
                                    <input type="text" name="username"/><br/>
                                    <button type="submit" name="submit" class="btn btn-info">添加新账号</button>
                                </form>
                            </p>
                        </div>
                        <div class="modal-footer">
                             <button class="btn" data-dismiss="modal" aria-hidden="true">关闭</button>
                        </div>
                    </div>
				</li>
html;
                }}
                ?>
				<li class="divider">
				</li>
				<li>
					<a href="#modal-container-80093" data-toggle="modal">关于本站</a>
                    <div id="modal-container-80093" class="modal hide fade" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-header">
                             <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h3 id="myModalLabel">
                                关于本站
                            </h3>
                        </div>
                        <div class="modal-body">
                            <p>
                                科技创新室往届成员信息和联系方式收集的计划是由现在的负责老师（李卫贤老师）提出的，因为涉及的人员较多，咱们组织成立的时间也有相当长的一段时间了，所以我就临时制作了一个网站，方便本计划的实施。<br/>
                                因本人技术水平有限，没有系统性学过php与前端，所有内容都是用网上找来的资料进行模仿与拼凑出来的，所以本站可能存留有许多设计不合理的地方，如有发现请及时指出。<br/>
                                如果你愿意参与本站的维护，请联系我，谢谢！<br/>
                                本站作者：晨旭<br/>
                                联系邮箱：m@owo.email<br/>
                                网站源码：<a href="https://github.com/chenxuuu/kxct_mumber_collection" target="_blank">https://github.com/chenxuuu/kxct_mumber_collection</a>
                            </p>
                        </div>
                        <div class="modal-footer">
                             <button class="btn" data-dismiss="modal" aria-hidden="true">关闭</button>
                        </div>
                    </div>
				</li>
			</ul>
		</div>
		<div class="span6">
			<h3>
                <?php 
                if($islogin == 1)
                {
                    if($user_type == 'owner'){echo '站长';}elseif($user_type == 'admin'){echo '管理员';}else{echo '用户';}
                    echo $username.'，你好!';
                }
                else
                {
                    echo '未登录用户你好！';
                }
                ?><br/>
			</h3>
            <?php 
            if($islogin == 0)
            {
                echo <<<html
            <a id="modal-80092" href="#modal-container-80092" role="button" class="btn btn-primary btn-block" data-toggle="modal">登陆账号</a>
			
			<div id="modal-container-80092" class="modal hide fade" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-header">
					 <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					<h3 id="myModalLabel">
						登陆账号
					</h3>
				</div>
				<div class="modal-body" style="text-align:center">
					<p>
                        <form name="LoginForm" method="post" action="login.php">
                            用户名：　<input type="text" name="username"/><br/>
                            密码：　　<input type="password" name="password"/><br/>
                            <button type="submit" class="btn btn-info" name="submit">登陆</button>
                        </form>
					</p>
				</div>
				<div class="modal-footer">
					 <button class="btn" data-dismiss="modal" aria-hidden="true">关闭</button>
				</div>
			</div>
            <br/>
			<a id="modal-80091" href="#modal-container-80091" role="button" class="btn btn-block" data-toggle="modal">注册账号</a>
			
			<div id="modal-container-80091" class="modal hide fade" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-header">
					 <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					<h3 id="myModalLabel">
						注册须知
					</h3>
				</div>
				<div class="modal-body">
					<p>
						为了成员信息资料的安全，本站不开放注册，请联系历届社长添加账号。<br/>
                        需要提供反馈请查看“关于本站”
					</p>
				</div>
				<div class="modal-footer">
					 <button class="btn" data-dismiss="modal" aria-hidden="true">关闭</button>
				</div>
			</div>
html;
            }
            else
            {
                echo '<a href="login.php?action=logout" role="button" class="btn btn-block" data-toggle="modal">注销登陆</a>';
            }?>

		</div>
		<div class="span4">
        <br/><br/>
			<div class="alert alert-info">
				 <button type="button" class="close" data-dismiss="alert">×</button>
				<h4>
					注意!
				</h4>请注意个人账号安全，以防因账号密码泄露而引发的网站信息泄露问题。
			</div>
			<div class="accordion" id="accordion-345084">
				<div class="accordion-group">
					<div class="accordion-heading">
						 <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion-345084" href="#accordion-element-577650">功能待定</a>
					</div>
					<div id="accordion-element-577650" class="accordion-body collapse">
						<div class="accordion-inner">
							功能块...
						</div>
					</div>
				</div>
				<div class="accordion-group">
					<div class="accordion-heading">
						 <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion-345084" href="#accordion-element-795852">功能待定</a>
					</div>
					<div id="accordion-element-795852" class="accordion-body collapse">
						<div class="accordion-inner">
							功能块...
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</body>
</html>