<?php
	//开启session
	session_start();
	//定义一个常量，用来授权includes里面的文件
	define('IN_TG',true);
	
//定义个常量，用来指定本页的内容
define('SCRIPT','register');
	
	//引入公共文件
	require dirname(__FILE__).'/includes/common.inc.php';//转换为硬路径，速度更快
	
	//如果已经登录，阻止使用连接直接进入
	if(isset($_COOKIE['username'])){
		_alert_back('用户已登录，无法继续操作');
	}
	     
	//判断是否提交
	if($_GET['action'] == 'register'){
		if (empty($_system['register'])) {
			exit('不要非法注册！');
		}
		//为了防止恶意注册，跨站攻击
		if(!$_POST['yzm'] == $_SESSION['code']){
			_alert_back('验证码不正确');
		}
		//引入验证文件
		include ROOT_PATH.'includes/register.func.php';
		//创建一个空数组，用来存放提交过来的合法数据
		$_clean = array();
		//通过唯一标识符来防止恶意注册，伪装表单跨站攻击等。
		//这个存放入数据库的唯一标识符还有第二个用处，就是登录cookies验证
		$_clean['uniqid'] = _check_uniqid($_POST['uniqid'],$_SESSION['uniqid']);
		//active也是一个唯一标识符，用来刚注册的用户进行激活处理，方可登录。
	    $_clean['active'] = _sha1_uniqid();
		$_clean['username'] = _check_username($_POST['user'],2,20);
		$_clean['password']= _check_password($_POST['pass'], $_POST['notpass'], 6);
		$_clean['question']= _check_question($_POST['question'], 2, 20);
		$_clean['answer'] = _check_answer($_POST['question'], $_POST['answer'], 2, 20);
		$_clean['sex'] = $_POST['sex'];
	    $_clean['face'] = $_POST['face'];
		$_clean['email'] = _check_email($_POST['email']);
		$_clean['qq'] = _check_qq($_POST['qq']);
		$_clean['url'] = _check_url($_POST['url']);
		
		//在新增用户之前，判断用户名是否重复
		$query = mysql_query("SELECT dg_username FROM tg_user WHERE dg_username='{$_clean['username']}'") or die('SQL错误');
		if(mysql_fetch_array($query,MYSQL_ASSOC)){
			_alert_back('用户名已被注册');
		}
		//新增用户  //在双引号里，直接放变量是可以的，比如$_username,但如果是数组，就必须加上{} ，比如 {$_clean['username']}
		mysql_query(
						"INSERT INTO tg_user (
																dg_uniqid,
																dg_active,
																dg_username,
																dg_password,
																dg_question,
																dg_answer,
																dg_sex,
																dg_face,
																dg_email,
																dg_qq,
																dg_url,
																dg_reg_time,
																dg_last_time,
																dg_last_ip
																) 
												VALUES (
																'{$_clean['uniqid']}',
																'{$_clean['active']}',
																'{$_clean['username']}',
																'{$_clean['password']}',
																'{$_clean['question']}',
																'{$_clean['answer']}',
																'{$_clean['sex']}',
																'{$_clean['face']}',
																'{$_clean['email']}',
																'{$_clean['qq']}',
																'{$_clean['url']}',
																NOW(),
																NOW(),
																'{$_SERVER["REMOTE_ADDR"]}'
																)"
	) or die('SQL执行错误'.mysql_error());
	//关闭
	//判断是否修改成功
	if(mysql_affected_rows() == 1){
		//获取刚刚新增的id
		$_clean['id'] = mysql_insert_id();
		mysql_close();
		//session_destroy();
		//生成XML
		_set_xml('new.xml',$_clean);
	    _location('注册成功','active.php?active='.$_clean['active']);
	}else{
		mysql_close();
		//session_destroy();
		 _location('注册失败','register.php');
	}
	
		
	}else{
		$_SESSION['uniqid'] = $_uniqid = _sha1_uniqid();
	}
	    
		 
	
         

?>

<!DOCTYPE html>
<html>
	<head>
		<link rel="shortcut icon" href="favicon.ico" />
		<link rel="stylesheet" type="text/css" href="css/1/basic.css"/>
		<link rel="stylesheet" type="text/css" href="css/1/register.css"/>
		<meta charset="UTF-8">
		<title><?php echo $_system['webname']; ?></title>
		<script src="js/register.js" type="text/javascript" charset="utf-8"></script>
	</head>
	<body>
		<!--header-->
		<?php
		   require ROOT_PATH.'includes/header.inc.php';
		?>
		
		<div id="register">
			<h2>会员注册</h2>
			<?php if($_system['register'] == 1){ ?>
			<div class="beizhu">请认真填写一下内容</div>
			<form id="zhuce" method="post" action="register.php?action=register">
				<input type="hidden" name="uniqid" value="<?php echo $_uniqid ?>" />
				<div class="wrap">
					<label for="user">用&nbsp;&nbsp;户&nbsp;&nbsp;名：</label>
					<input type="text" name="user" id="user" class="text" /> (*必填，至少两位)
				</div>
				
				<div class="wrap">
					<label for="pass">密&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;码：</label>
					<input type="password" name="pass" id="pass" class="text" /> (*必填，至少六位)
				</div>
				
				<div class="wrap">
					<label for="notpass">密码确认：</label>
					<input type="password" name="notpass" id="notpass" class="text" /> (*必填，同上)
				</div>
				
				<div class="wrap">
					<label for="passt">密码提示：</label>
					<input type="text" name="question" id="passt" class="text" /> (*必填，至少两位)
				</div>
				
				<div class="wrap">
					<label for="passd">密码回答：</label>
					<input type="text" name="answer" id="passd" class="text" /> (*必填，至少两位)
				</div>
				
				<div class="wrap wrapsex">
					<label for="sex">性别：</label>
					<input type="radio" name="sex" id="sex" checked="checked" value="男"/>男
					<input type="radio" name="sex" id="sex" value="女"/>女
					<input type="hidden" name="face" id="imputImg" value="face/m01.gif" />
					<div class="face"><img src="face/m01.gif" id="faceImg"/></div>
				</div>
				
				<div class="wrap">
					<label for="email">电子邮箱：</label>
					<input type="text" name="email" id="email" class="text" /> (*必填，用来找回密码！)
				</div>
				
				<div class="wrap">
					<label for="qq">Q&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Q：</label>
					<input type="text" name="qq" id="qq" class="text" />
				</div>
				
				<div class="wrap">
					<label for="url">主页地址：</label>
					<input type="text" name="url" value="http://" id="url" class="text" />
				</div>
				
				<div class="wrap wrapyzm">
					<label for="yzm">验&nbsp;&nbsp;证&nbsp;&nbsp;码：</label>
					<input type="text" name="yzm" id="yzm" class="text yzm" />
					<img src="code.php" alt="验证码" id="yzmimg"/>
				</div>
				<div class="wrap">
					<input type="submit" name="submit" id="submit" value="注册" class="submit"/>
				</div>
			</form>
			<?php }else{
				echo '<p style="text-align: center;margin:20px 0 0 0;">管理员暂时关闭注册功能</p>';
			}
			?>
		</div>
		
		<!--footer-->
		<?php
		   require ROOT_PATH.'includes/footer.inc.php';
		?>
	</body>
</html>