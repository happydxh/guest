<?php
session_start();
//定义个常量，用来授权调用includes里面的文件
define('IN_TG',true);
//定义个常量，用来指定本页的内容
define('SCRIPT','menber');
//引入公共文件
require dirname(__FILE__).'/includes/common.inc.php';
//判断是否正常登录
if(isset($_COOKIE['username'])){
	//获取数据
	$_query = mysql_query("SELECT dg_username,dg_sex,dg_face,dg_email,dg_url,dg_qq,dg_reg_time,dg_level FROM tg_user WHERE dg_username='{$_COOKIE['username']}'  ");
    $_rows = mysql_fetch_array($_query,MYSQL_ASSOC);
	if($_rows){
		$_html = array();
		$_html['username'] = $_rows['dg_username'];
		$_html['sex'] = $_rows['dg_sex'];
		$_html['face'] = $_rows['dg_face'];
		$_html['email'] = $_rows['dg_email'];
		$_html['url'] = $_rows['dg_url'];
		$_html['qq'] = $_rows['dg_qq'];
		$_html['reg_time'] = $_rows['dg_reg_time'];
		switch($_rows['dg_level']){
			case 0:
			    $_html['level'] = '普通会员';
			    break;
			case 1:
				$_html['level'] = '管理员';
				break;
			default:
				$_html['level'] = '管理员';	
		}
		$_html = _html($_html);
	}else{
		_alert_back('此用户不存在');
	}
}else{
	_alert_back('非法登录');
}


	
	
?>
<!DOCTYPE html>
<html>
	<head>
		<link rel="shortcut icon" href="favicon.ico" />
		<link rel="stylesheet" type="text/css" href="css/1/basic.css"/>
		<link rel="stylesheet" type="text/css" href="css/1/member.css"/>
		<meta charset="UTF-8">
		<title><?php echo $_system['webname']; ?></title>
	</head>
	<body>
		<!--header-->
		<?php
		   require ROOT_PATH.'includes/header.inc.php';
		?>
		
        <div id="member">
        	
			<div id="member_sidebar">
				<h2>中心导航</h2>
				<dl>
					<dt>账号管理</dt>
					<dd style="background: #CCCCCC;"><a href="member.php">个人信息</a></dd>
					<dd><a href="member.modify">修改资料</a></dd>
				</dl>
				<dl>
					<dt>其他管理</dt>
					<dd><a href="member_message.php">短信查阅</a></dd>
					<dd><a href="member_friend.php">好友设置</a></dd>
					<dd><a href="member_flower.php">查询花朵</a></dd>
					<dd><a href="###">个人相册</a></dd>
				</dl>
			</div>
			
			<div id="member_main">
				<h2>会员管理中心</h2>
				<dl>
					<dd>用 户 名：<?php echo $_html['username']?></dd>
					<dd>性　　别：<?php echo $_html['sex']?></dd>
					<dd>头　　像：<?php echo $_html['face']?></dd>
					<dd>电子邮件：<?php echo $_html['email']?></dd>
					<dd>主　　页：<?php echo $_html['url']?></dd>
					<dd>Q 　 　Q：<?php echo $_html['qq']?></dd>
					<dd>注册时间：<?php echo $_html['reg_time']?></dd>
					<dd>身　　份：<?php echo $_html['level']?></dd>
				</dl>
			</div>
		</div>
		
		<!--footer-->
		<?php
		   require ROOT_PATH.'includes/footer.inc.php';
		?>
	</body>
</html>