<?php
//定义个常量，用来授权调用includes里面的文件
define('IN_TG',true);
//引入公共文件
require dirname(__FILE__).'/includes/common.inc.php';

//开始激活处理
if (!isset($_GET['active'])) {
	_alert_back('非法操作');
}
if( isset($_GET['action']) && isset($_GET['active']) && $_GET['action'] == 'ok' ){
	$_active = _mysql_string($_GET['active']);
	$result = @mysql_query("SELECT dg_active FROM tg_user WHERE dg_active='$_active' LIMIT 1");
	if(mysql_fetch_array($result,MYSQL_ASSOC)){
		mysql_query("UPDATE tg_user SET dg_active=NULL WHERE dg_active='$_active' LIMIT 1");
		if(mysql_affected_rows() == 1){
			mysql_close();
		    _location('账户激活成功','login.php');
		}else{
			mysql_close();
			 _location('账户激活失败','register.php');
		}
	} else {
		_alert_back('非法操作');
	}
}

	
	
?>
<!DOCTYPE html>
<html>
	<head>
		<link rel="shortcut icon" href="favicon.ico" />
		<link rel="stylesheet" type="text/css" href="css/1/basic.css"/>
		<link rel="stylesheet" type="text/css" href="css/1/active.css"/>
		<meta charset="UTF-8">
		<title><?php echo $_system['webname']; ?></title>
		<script src="js/register.js" type="text/javascript" charset="utf-8"></script>
	</head>
	<body>
		<!--header-->
		<?php
		   require ROOT_PATH.'includes/header.inc.php';
		?>
		
	<div id="active">
		<h2>激活账户</h2>
		<p>本页面是为了模拟您的邮件的功能，点击以下超级连接激活您的账户</p>
		<p><a href="active.php?action=ok&amp;active=<?php echo $_GET['active']?>"><?php echo 'http://'.$_SERVER["HTTP_HOST"].$_SERVER["PHP_SELF"]?>active.php?action=ok&amp;active=<?php echo $_GET['active']?></a></p>
	</div>
		
		<!--footer-->
		<?php
		   require ROOT_PATH.'includes/footer.inc.php';
		?>
	</body>
</html>
