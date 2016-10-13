<?php
session_start();
//定义个常量，用来授权调用includes里面的文件
define('IN_TG',true);
//定义个常量，用来指定本页的内容
define('SCRIPT','manage');
//引入公共文件
require dirname(__FILE__).'/includes/common.inc.php';

if ((!isset($_COOKIE['username'])) || (!isset($_SESSION['admin']))) {
		_alert_back('非法登录！');
	}	

?>
<!DOCTYPE html>
<html>
	<head>
		<link rel="shortcut icon" href="favicon.ico" />
		<link rel="stylesheet" type="text/css" href="css/1/basic.css"/>
		<link rel="stylesheet" type="text/css" href="css/1/member.css"/>
		<meta charset="UTF-8">
		<title>后台管理中心</title>
	</head>
	<body>
		<!--header-->
		<?php
		   require ROOT_PATH.'includes/header.inc.php';
		?>
		
        <div id="member">
        	
			<div id="member_sidebar">
				<h2>管理导航</h2>
				<dl>
					<dt>系统管理</dt>
					<dd><a href="manage.php" style="background: #CCCCCC;">后台首页</a></dd>
					<dd><a href="manage_set.php">系统设置</a></dd>
				</dl>
				<dl>
					<dt>会员管理</dt>
					<dd><a href="manage_member.php">会员列表</a></dd>
					<dd><a href="manage_job.php">职务设置</a></dd>
				</dl>
			</div>
			
			<div id="member_main">
				<h2>后台管理中心</h2>
				<dl>
					<dd>·服务器主机名称：<?php echo $_SERVER['SERVER_NAME']; ?></dd>
					<dd>·通信协议名称/版本：<?php echo $_SERVER['SERVER_PROTOCOL']; ?></dd>
					<dd>·服务器IP：<?php echo $_SERVER["SERVER_ADDR"]; ?></dd>
					<dd>·客户端IP：<?php echo $_SERVER["REMOTE_ADDR"]; ?></dd>
					<dd>·服务器端口：<?php echo $_SERVER['SERVER_PORT']; ?></dd>
					<dd>·客户端端口：<?php echo $_SERVER["REMOTE_PORT"]; ?></dd>
					<dd>·管理员邮箱：<?php echo $_SERVER['SERVER_ADMIN'] ?></dd>
					<dd>·Host头部的内容：<?php echo $_SERVER['HTTP_HOST']; ?></dd>
					<dd>·服务器主目录：<?php echo $_SERVER["DOCUMENT_ROOT"]; ?></dd>
					<dd>·脚本执行的绝对路径：<?php echo $_SERVER['SCRIPT_FILENAME']; ?></dd>
					<dd>·Apache及PHP版本：<?php echo $_SERVER["SERVER_SOFTWARE"]; ?></dd>
				</dl>
			</div>
		</div>
		
		<!--footer-->
		<?php
		   require ROOT_PATH.'includes/footer.inc.php';
		?>
	</body>
</html>