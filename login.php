<?php
//开启session
session_start();
//定义个常量，用来授权调用includes里面的文件
define('IN_TG',true);
//引入公共文件
require dirname(__FILE__).'/includes/common.inc.php';

//如果已经登录，阻止使用连接直接进入
if(isset($_COOKIE['username'])){
	_alert_back('用户已登录，无法继续操作');
}

//开始处理登录状态

//判断是否提交
if($_GET['action'] == 'login'){
	//后台管理设置
	if (!empty($_system['code'])) {
		//为了防止恶意注册，跨站攻击
		if(!$_POST['yzm'] == $_SESSION['code']){
			_alert_back('验证码不正确');
		}
	}
	//引入验证文件
	include ROOT_PATH.'includes/login.func.php';
	//创建一个空数组，用来存放提交过来的合法数据
	$_clean = array();
	$_clean['username'] =  _check_username($_POST['user'],2,20);
	$_clean['password'] =  _check_password($_POST['pass'],6);
	$_clean['time'] = $_POST['time'];
	//到数据库中验证用户名和密码是否正确以及该账户是否被激活
	$_result = @mysql_query(" SELECT
	                                  dg_username,
	                                  dg_uniqid,
	                                  dg_level 
	                            FROM 
	                                  tg_user
	                           WHERE 
	                                  dg_username='{$_clean['username']}'
	                             AND 
	                                  dg_password ='{$_clean['password']}' 
	                             AND 
	                                  dg_active = '' LIMIT 1  ");
	
//	print_r($_rows);
	if($_rows = mysql_fetch_array($_result,MYSQL_ASSOC)){
		//登录成功后，记录登录信息
		mysql_query("UPDATE tg_user SET 
		                                 dg_last_time = NOW(),
		                                 dg_last_ip = '{$_SERVER["REMOTE_ADDR"]}',
		                                 tg_login_count=tg_login_count+1
		                            WHERE 
		                                 dg_username = '{$_rows['dg_username']}'     
		                                 ");
		
		//session_destroy();
		_setcookie($_rows["dg_username"], $_rows["dg_uniqid"],$_clean['time']);
		if ($_rows['dg_level'] == 1) {
			$_SESSION['admin'] = $_rows['dg_username'];
		}
		mysql_close();
		_location(null,'index.php');
	}else{
		mysql_close();
		//session_destroy();
		_location('用户名密码不正确或者该账户未被激活！','login.php');
	}
	
}


	
	
?>
<!DOCTYPE html>
<html>
	<head>
		<link rel="shortcut icon" href="favicon.ico" />
		<link rel="stylesheet" type="text/css" href="css/1/basic.css"/>
		<link rel="stylesheet" type="text/css" href="css/1/login.css"/>
		<meta charset="UTF-8">
		<title><?php echo $_system['webname']; ?></title>
		<script src="js/login.js" type="text/javascript" charset="utf-8"></script>
	</head>
	<body>
		<!--header-->
		<?php
		   require ROOT_PATH.'includes/header.inc.php';
		?>
		
		<div id="login">
			<h2>会员登录</h2>
			<form id="zhuce" method="post" action="login.php?action=login">
				
				<div class="wrap">
					<label for="user">用&nbsp;&nbsp;户&nbsp;&nbsp;名：</label>
					<input type="text" name="user" id="user" class="text" /> 
				</div>
				
				<div class="wrap">
					<label for="pass">密&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;码：</label>
					<input type="password" name="pass" id="pass" class="text" /> 
				</div>
				
				<div class="wrap wrapsex">
					<label for="time">保&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;留：</label>
					<input type="radio" name="time" id="time" checked="checked" value="0"/>不保留
					<input type="radio" name="time" id="time" value="1"/>一天
					<input type="radio" name="time" id="time" value="2"/>一周
					<input type="radio" name="time" id="time" value="3"/>一月
				</div>
				<?php
				if($_system['code'] == 1){
				?>
				<div class="wrap wrapyzm">
					<label for="yzm">验&nbsp;&nbsp;证&nbsp;&nbsp;码：</label>
					<input type="text" name="yzm" id="yzm" class="text yzm" />
					<img src="code.php" alt="验证码" id="yzmimg"/>
				</div>
				<?php } ?>
				<div class="wrap wrapbtn">
					<input type="submit" name="button" id="button" value="登录" class="button"/>
					<input type="submit" name="button" id="button" value="注册" class="button"/>
				</div>
			</form>
		</div>
		
		<!--footer-->
		<?php
		   require ROOT_PATH.'includes/footer.inc.php';
		?>
	</body>
</html>