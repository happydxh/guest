<?php
session_start();
//定义个常量，用来授权调用includes里面的文件
define('IN_TG',true);
//定义个常量，用来指定本页的内容
define('SCRIPT','menber.modify');
//引入公共文件
require dirname(__FILE__).'/includes/common.inc.php';
//修改数据
if($_GET['action'] == 'modify'){
	//为了防止恶意注册，跨站攻击
	if(!$_POST['yzm'] == $_SESSION['code']){
		_alert_back('验证码不正确');
	}
	//判断数据库是否存在需要修改的此用户唯一标示符
	$_query_uniqid = mysql_query("    SELECT 
	                                          dg_uniqid 
	                                    FROM  
	                                          tg_user 
	                                   WHERE  dg_username = '{$_COOKIE['username']}' 
	                                   LIMIT 1 
	                               ");
	$_results = mysql_fetch_array($_query_uniqid,MYSQL_ASSOC);
	if($_results){
	//为了防止cookies伪造，还要比对一下唯一标识符uniqid()
	if($_results['dg_uniqid'] != $_COOKIE['uniqid']){
		_alert_back('唯一标示符异常');
	}
	//引入验证文件
	include ROOT_PATH.'includes/register.func.php';
	//创建一个空数组，用来存放提交过来的合法数据
	$_clean = array();
	$_clean['password']= _check_modify_password($_POST['pass'], 6);
	$_clean['sex'] = $_POST['sex'];
	$_clean['face'] = $_POST['face'];
	$_clean['email'] = _check_email($_POST['email']);
	$_clean['qq'] = _check_qq($_POST['qq']);
	$_clean['url'] = _check_url($_POST['url']);
	$_clean['switch'] = $_POST['switch'];
	$_clean['autograph'] = $_POST['autograph'];
	//修改数据库资料
	if(empty($_clean['password'])){
		mysql_query("UPDATE tg_user SET 
		                                dg_sex = '{$_clean['sex']}',
		                                dg_face = '{$_clean['face']}',
		                                dg_email = '{$_clean['email']}',
		                                dg_qq = '{$_clean['qq']}',
		                                dg_url = '{$_clean['url']}',
		                                dg_switch = '{$_clean['switch']}',
		                                dg_autograph = '{$_clean['autograph']}'
                                    WHERE
                                         dg_username = '{$_COOKIE['username']}'   
		            ") or die('SQL执行错误'.mysql_error());
	}else{
		mysql_query("UPDATE tg_user SET 
		                                dg_password ='{$_clean['password']}',
		                                dg_sex = '{$_clean['sex']}',
		                                dg_face = '{$_clean['face']}',
		                                dg_email = '{$_clean['email']}',
		                                dg_qq = '{$_clean['qq']}',
		                                dg_url = '{$_clean['url']}'
		                                dg_switch = '{$_clean['switch']}',
		                                dg_autograph = '{$_clean['autograph']}'
                                    WHERE
                                         dg_username = '{$_COOKIE['username']}'   
		            ") or die('SQL执行错误'.mysql_error());
	}
	}
	
	//判断是否修改成功
	if(mysql_affected_rows() == 1){
		mysql_close();
		//session_destroy();
	    _location('修改成功','member.php');
	}else{
		mysql_close();
		//session_destroy();
		 _location('修改失败','member.modify.php');
	}
	
	
}

//判断是否正常登录
if(isset($_COOKIE['username'])){
	//获取数据
	$_query = mysql_query("      SELECT 
	                                     dg_username,
	                                     dg_sex,
	                                     dg_face,
	                                     dg_email,
	                                     dg_url,
	                                     dg_qq,
	                                     dg_reg_time,
	                                     dg_level,
	                                     dg_switch,
	                                     dg_autograph 
	                               FROM  
	                                     tg_user 
	                              WHERE  
	                                     dg_username='{$_COOKIE['username']}'  
	                       ");
    $_rows = mysql_fetch_array($_query,MYSQL_ASSOC);
	if($_rows){
		$_html = array();
		$_html['username'] = $_rows['dg_username'];
		$_html['sex'] = $_rows['dg_sex'];
		$_html['face'] = $_rows['dg_face'];
		$_html['email'] = $_rows['dg_email'];
		$_html['url'] = $_rows['dg_url'];
		$_html['qq'] = $_rows['dg_qq'];
		$_html['switch'] = $_rows['dg_switch'];
		$_html['autograph'] = $_rows['dg_autograph'];
		$_html = _html($_html);
		//性别选择
		if ($_html['sex'] == '男') {
			$_html['sex_html'] = '<input type="radio" name="sex" value="男" checked="checked" /> 男 <input type="radio" name="sex" value="女" /> 女';
		} elseif ($_html['sex'] == '女') {
			$_html['sex_html'] = '<input type="radio" name="sex" value="男" /> 男 <input type="radio" name="sex" value="女" checked="checked" /> 女';
		}
		//头像选择
		$_html['face_html'] = '<select name="face">';
		foreach(range(1,9) as $_num){
			$_html['face_html'].= '<option value="face/m0'.$_num.'.gif">face/m0'.$_num.'.gif</option>';
		}
		foreach(range(10,64) as $_num){
			$_html['face_html'].= '<option value="face/m'.$_num.'.gif">face/m'.$_num.'.gif</option>';
		}
		$_html['face_html'].= '</select>';
		//个性签名开启禁用
		if ($_html['switch'] == 1) {
			$_html['switch_html'] = '<input type="radio" name="switch" value="0"  /> 启用 <input type="radio" name="switch" value="1" checked="checked" /> 禁用';
		    $_html['autograph_html'] = null;
		} elseif ($_html['switch'] == 0) {
			$_html['switch_html'] = '<input type="radio" name="switch" value="0" checked="checked" /> 启用 <input type="radio" name="switch" value="1"  /> 禁用';
		    $_html['autograph_html'] = $_html['autograph'];
		}
		
		
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
		<link rel="stylesheet" type="text/css" href="css/1/member.modify.css"/>
		<meta charset="UTF-8">
		<title><?php echo $_system['webname']; ?></title>
		<script src="js/member.modify.js" type="text/javascript" charset="utf-8"></script>
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
					<dd ><a href="member.php">个人信息</a></dd>
					<dd style="background: #CCCCCC;"><a href="member.modify">修改资料</a></dd>
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
				<form method="post" action="?action=modify">
				<dl>
					<dd>用  户  名：<?php echo $_html['username']?></dd>
					<dd>密　　码：<input type="password" class="text" name="pass"/> (留空则不修改密码)</dd>
					<dd>性　　别：<?php echo $_html['sex_html']?></dd>
					<dd>头　　像：<?php echo $_html['face_html']?></dd>
					<dd>电子邮件：<input type="text" class="text" name="email" value="<?php echo $_html['email']?>" /></input?></dd>
					<dd>主　　页：<input type="text" class="text" name="url" value="<?php echo $_html['url']?>"/></dd>
					<dd>Q 　 　Q：<input type="text" class="text" name="qq" value="<?php echo $_html['qq']?>"/></dd>
					<dd>
						个性签名：<?php echo $_html['switch_html']?> (可以使用UBB代码)
						<p><textarea name="autograph"><?php echo $_html['autograph_html']?></textarea></p>
					</dd>
					<dd>验  证  码：<input type="text" class="text yzm" name="yzm" /><img src="code.php" id="code"/><input type="submit" class="submit" value="修改资料" /></dd>
				   
				</dl>
				</form>
			</div>
		</div>
		
		<!--footer-->
		<?php
		   require ROOT_PATH.'includes/footer.inc.php';
		?>
	</body>
</html>