<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>电子墨水屏挂饰设置页</title>

    <meta name="description" content="Source code generated using layoutit.com">
    <meta name="author" content="LayoutIt!">

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

  </head>
  <body>
  <?php
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

if ($api == "")
{
	$api = "https://qq.papapoi.com/e-ink/weather_report.php?t=2&";
}

if($eink_set == "pic")
{
	$api_a = "";
	$pic_a = "active show";
}
else
{
	$api_a = "active show";
	$pic_a = "";
}
?>
    <div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<h3>
				电子墨水屏挂饰设置页
			</h3>
<?php
if($imei=="")
{
	echo <<<html
			<div class="alert alert-warning alert-dismissable">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">
					×
				</button>
				<h4>
					提示！
				</h4>检测到你还没有绑定设备，请将屏幕上的15位imei号输入在下方进行绑定！
			</div>
html;
}
			?>
			<div class="alert alert-warning alert-dismissable">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">
					×
				</button>
				<h4>
					使用须知！
				</h4>1.挂饰到手后，请先充电<br/>
				2.挂饰每个月流量为5M，所以请勿频繁开机，会迅速消耗流量<br/>
				3.流量费一年2元，如果觉得流量不够用，可以提升套餐<br/>
				4.国外用不了<br/>
				5.提供的官方api，都是每隔两小时刷新一次，且21:00-6:00不进行刷新；如果设置的是固定图片，那么不会自动刷新，需要手动开机刷新<br/>
				6.可以自己写api，测试时请注意流量消耗；php可以发代码给晨旭，放到这里的服务器上<br/>
				7.开机方式：按开机键两秒，然后松开<br/>
				8.其他问题请在群内问
			</div>
			<form role="form" method="post" action="setimei.php">
				<div class="form-group">
					<label for="imei">
						设备imei号
					</label>
					<input type="text" class="form-control" name="imei" value="<?php echo $imei;?>">
				</div>
				<button type="submit" class="btn btn-primary btn-block btn-outline-primary">
					绑定/更换设备
				</button>
			</form>
			<br/><br/><br/>
			<h3>
				墨水屏显示设置，当前设置：<?php echo $eink_set;?>
			</h3>
			<div class="tabbable" id="tabs-338008">
				<ul class="nav nav-tabs">
					<li class="nav-item">
						<a class="nav-link <?php echo $pic_a;?>" href="#panel-759280" data-toggle="tab">显示静态图片</a>
					</li>
					<li class="nav-item">
						<a class="nav-link <?php echo $api_a;?>" href="#panel-596795" data-toggle="tab">使用自定义api接口</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="#panel-295230" data-toggle="tab">查看该模块的历史数据记录</a>
					</li>
				</ul>
				<div class="tab-content">
					<div class="tab-pane <?php echo $pic_a;?>" id="panel-759280">
						<form role="form" method="post" action="setpic.php">
							<div class="form-group">
								<label for="imei">
									图片转换后的数据：
								</label>
								<input type="text" class="form-control" name="pic" value="<?php echo $pic;?>">
							</div>
							<button type="submit" class="btn btn-primary btn-block btn-outline-primary">
								设置/更改自定义图片
							</button>
						</form>
						图片转换帮助：<br>
						首先准备一个200*200分辨率的图片，例如：<br/>
						<img src="pic/example.png"><br/><br/>
						然后下载图片数据快速生成工具：<a href="picDataConvert.7z" target="_blank">点我下载</a><br/>
						打开工具，导入准备好的图片：<br/>
						<img src="pic/s1.png"><br/><br/>
						根据需要，调整好阈值：<br/>
						<img src="pic/s2.png"><br/><br/>
						点击“复制图片数据”，粘贴到网站输入框，点击设置即可<br/>
						<img src="pic/set.png" width="800"><br/><br/><br/>
					</div>
					<div class="tab-pane <?php echo $api_a;?>" id="panel-596795">
						<form role="form" method="post" action="setapi.php">
							<div class="form-group">
								<label for="imei">
									http/https接口（https接口可能不兼容，请自行测试）
								</label>
								<input type="text" class="form-control" name="api" value="<?php echo $api;?>">
							</div>
							<button type="submit" class="btn btn-primary btn-block btn-outline-primary">
								设置/更改api接口
							</button>
						</form>
						本站提供的api接口：<br>
						1.天气显示，可自动识别位置，显示当前的气温、天气、风力等信息，api接口是晨旭自行申请的<br/>
						把这段网址复制下来，把t进行替换（该参数代表多少小时自动开机刷新一次数据，设置为0禁用，晚9点-早6点禁止刷新）<br/>
						https://qq.papapoi.com/e-ink/weather_report.php?t=2& <br/>
						然后填写到上面的输入框，设置，即可<br/><br/>
						2.一言，取自一言网(Hitokoto.cn)<br/>
						把这段网址复制下来，把t进行替换（该参数代表多少小时自动开机刷新一次数据，设置为0禁用，晚9点-早6点禁止刷新）<br/>
						cc参数代表类型，可留空（类型说明见https://hitokoto.cn/api的第三小节）<br/>
						例如：https://qq.papapoi.com/e-ink/hitokoto.php?t=2&cc=a& <br/>
						然后填写到上面的输入框，设置，即可<br/>
						<br/><br/><br/><br/>
						使用自己的的api接口（如果是用php写的，没服务器的话，可以联系晨旭代挂）：<br>
						模块使用的是http get请求命令，请求格式：你的api网址?imei=模块的imei&lat=维度&lng=经度&v=电池电压（单位mV）&c=当前和临近位置区、小区、mcc、mnc、以及信号强度的拼接字符串<br/>
						例如：http://qq.papapoi.com/e-ink/weather_report.php?t=2&?&imei=123456789012345&lat=31&lng=110&v=4100&c=460.01.6311.49234.30;460.01.6311.49233.23;460.02.6322.49232.18<br/>
						服务器返回的应为一段数据，不能夹杂其他任何数据，格式参考下面示例代码生成的数据：<br/>
						具体可以参考我写的php版demo，希望对你有所帮助：<br/><br/><br/><br/>
						基础的api代码，不包括任何实用性功能：<br/>
						<script src='https://gitee.com/chenxuuu/codes/5bzq4n1yoxic9s2j7u8et59/widget_preview?title=%E5%9F%BA%E7%A1%80demo%EF%BC%8C%E5%8F%AF%E6%98%BE%E7%A4%BA%E4%B8%AD%E6%96%87%E4%B8%8E%E8%8B%B1%E6%96%87%EF%BC%8C%E5%AD%97%E4%BD%93%E8%AF%B7%E4%B8%8D%E8%A6%81%E5%BF%98%E4%BA%86%E5%8A%A0%E4%B8%8A'></script>
						<br/><br/><br/>
						一言api的完整代码，可能有不合理之处，仅供参考：<br/>
						<script src='https://gitee.com/chenxuuu/codes/5bzq4n1yoxic9s2j7u8et59/widget_preview?title=%E4%B8%80%E8%A8%80api%E4%BB%A3%E7%A0%81%EF%BC%8C%E4%BE%9B%E5%8F%82%E8%80%83'></script>
					</div>
					<div class="tab-pane" id="panel-295230">
						imei值为<?php echo $imei;?>模块的历史刷新记录：<br>
						<?php
						$q = "SELECT * FROM e_ink_log where imei=$imei ORDER BY uid DESC"; //SQL 查询语句
						$result = mysqli_query($conn,$q); // 获取数据集
						$temp_count=0;
						while($row = mysqli_fetch_array($result,MYSQLI_ASSOC))
						{
							if($temp_count>500){break;}else{$temp_count++;}
							echo "时间：".$row["time"].",imei：".$row["imei"].",返回类型：".$row["type"].",返回数据：".$row["data"]."<br/>";
						}
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<br><br><br><br>
by <a href="https://www.chenxublog.com/" target="_blank">晨旭</a>
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/scripts.js"></script>
  </body>
</html>
