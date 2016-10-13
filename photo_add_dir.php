<?php
	session_start();
	//定义个常量，用来授权调用includes里面的文件
	define('IN_TG',true);
	//定义个常量，用来指定本页的内容
	define('SCRIPT','photo_add_dir');
	//引入公共文件
	require dirname(__FILE__).'/includes/common.inc.php';
	//只有管理员才能登入
	if ((!isset($_COOKIE['username'])) || (!isset($_SESSION['admin']))) {
		_alert_back('非法登录！');
	}
	
	//添加目录
	if($_GET['action'] == 'adddir'){
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
		//创建一个空数组，用来存放提交过来的合法数据
		$_clean = array();
		$_clean['username'] = $_POST['name'];
		$_clean['type'] = $_POST['type'];
		$_clean['password'] = sha1($_POST['password']);
		$_clean['content'] = $_POST['content'];
		$_clean['dir'] = time();
		$_clean = _mysql_string($_clean);
		//先检查一下主目录是否存在
		if(!is_dir('photo')){
			mkdir('photo',0777);
		}
		//再在这个主目录里面创建你定义的相册目录
		if (!is_dir('photo/'.$_clean['dir'])) {
			mkdir('photo/'.$_clean['dir']);
		}
		
		//把当前目录的信息写入数据库
		if(empty($_clean['type'])){
			mysql_query("INSERT INTO tg_dir (
			                                  dg_username,
			                                  dg_type,
			                                  dg_content,
			                                  dg_dir,
			                                  dg_date
			                                ) 
			                         VALUES (
			                                  '{$_clean['username']}',
											  '{$_clean['type']}',
											  '{$_clean['content']}',
											  'photo/{$_clean['dir']}',
											   NOW()
									        ) 
                        ") or die(mysql_error());
		}else{
			mysql_query("INSERT INTO tg_dir (
			                                  dg_username,
			                                  dg_type,
			                                  dg_content,
			                                  dg_dir,
			                                  dg_password,
			                                  dg_date
			                                ) 
			                         VALUES (
			                                  '{$_clean['username']}',
											  '{$_clean['type']}',
											  '{$_clean['content']}',
											  'photo/{$_clean['dir']}',
											  '{$_clean['password']}',
											   NOW()
									        ) 
                        ");
		}
		
		//判断是否写入数据库
		if(mysql_affected_rows() == 1){
			mysql_close();
		    _location('目录添加成功','photo.php');
		}else{
			mysql_close();
			_alert_back('目录添加失败！');
		}
		
		
		}else{
			_alert_back('非法登录！');
		}
		
		
		
		

	}	

?>
<!DOCTYPE html>
<html>
	<head>
		<link rel="shortcut icon" href="favicon.ico" />
		<link rel="stylesheet" type="text/css" href="css/1/basic.css"/>
		<link rel="stylesheet" type="text/css" href="css/1/blog.css"/>
		<link rel="stylesheet" type="text/css" href="css/1/photo_add_dir.css"/>
		<meta charset="UTF-8">
		<title><?php echo $_system['webname']; ?></title>
		<script src="js/photo_add_dir.js" type="text/javascript" charset="utf-8"></script>
	</head>
	<body>
	<?php 
		require ROOT_PATH.'includes/header.inc.php';
	?>
	
	<div id="photo">
		<h2>相册</h2>
			<form method="post" action="?action=adddir">
			<dl>
				<dd>相册名称：<input type="text" name="name" class="text" /></dd>
				<dd>相册类型：<input type="radio" name="type" value="0" checked="checked" /> 公开 <input type="radio" name="type" value="1" /> 私密</dd>
				<dd id="pass">相册密码：<input type="password" name="password" class="text" /></dd>
				<dd>相册描述：<textarea name="content"></textarea></dd>
				<dd><input type="submit" class="submit" value="添加目录" /></dd>
			</dl>
			</form>
			
	</div>
	
	
	
	<?php 
		require ROOT_PATH.'includes/footer.inc.php';
	?>
</body>
</html>
