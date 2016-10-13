<?php
	session_start();
	//定义个常量，用来授权调用includes里面的文件
	define('IN_TG',true);
	//定义个常量，用来指定本页的内容
	define('SCRIPT','photo_modify_dir');
	//引入公共文件
	require dirname(__FILE__).'/includes/common.inc.php';
	//只有管理员才能登入
	if ((!isset($_COOKIE['username'])) || (!isset($_SESSION['admin']))) {
		_alert_back('非法登录！');
	}
	
	//修改数据
    if($_GET['action'] == 'modify'){
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
	$_clean = array();
	$_clean['id'] = $_POST['id'];
	$_clean['name'] = _check_dir_name($_POST['name'],2,20);
	$_clean['type'] = $_POST['type'];
	if (!empty($_clean['type'])) {
		$_clean['password'] = _check_dir_password($_POST['password'],6);
	}
	$_clean['face'] = $_POST['face'];
	$_clean['content'] = $_POST['content'];
	$_clean = _mysql_string($_clean);
	//修改资料
	if(empty($_clean['type'])){
		mysql_query("UPDATE tg_dir SET 
		                                dg_id = '{$_clean['id']}',
		                                dg_username = '{$_clean['name']}',
		                                dg_type = '{$_clean['type']}',
		                                dg_password = null,
		                                dg_face = '{$_clean['face']}',
		                                dg_content = '{$_clean['content']}'
                                    WHERE
                                         dg_id = '{$_clean['id']}'   
		            ") or die('SQL执行错误'.mysql_error());
	}else{
		mysql_query("UPDATE tg_dir SET 
		                                dg_id = '{$_clean['id']}',
		                                dg_username = '{$_clean['name']}',
		                                dg_type = '{$_clean['type']}',
		                                dg_password ='{$_clean['password']}',
		                                dg_face = '{$_clean['face']}',
		                                dg_content = '{$_clean['content']}'
                                    WHERE
                                         dg_id = '{$_clean['id']}'   
		            ") or die('SQL执行错误'.mysql_error());
	}
	
	//判断是否修改成功
	if(mysql_affected_rows() == 1){
		mysql_close();
		//session_destroy();
	    _location('目录修改成功','photo.php');
	}else{
		mysql_close();
		//session_destroy();
		 _alert_back("目录修改失败");
	}
	
	}else{
		_alert_back("非法登录");
	}
	
	
	
	
}
	
	//获取数据
	if(isset($_GET[id])){
		$_query = mysql_query("      SELECT 
		                                     dg_id,
		                                     dg_username,
		                                     dg_face,
		                                     dg_type,
		                                     dg_content
		                               FROM
		                                     tg_dir
		                               WHERE
		                                     dg_id='{$_GET[id]}' 
		                               LIMIT
		                                     1
		                       ");
		$_rows = mysql_fetch_array($_query,MYSQL_ASSOC);
		if($_rows){
			$_html = array();
			$_html['id'] = $_rows['dg_id'];
			$_html['name'] = $_rows['dg_username'];
			$_html['face'] = $_rows['dg_face'];
			$_html['type'] = $_rows['dg_type'];
			$_html['content'] = $_rows['dg_content'];
			$_html = _html($_html);
			
			//相册类型
			if($_html['type'] == 0){
				$_html['type_html'] = '<input type="radio" name="type" value="0" checked="checked" /> 公开 <input type="radio" name="type" value="1" /> 私密';
			}elseif($_html['type'] == 1){
				$_html['type_html'] = '<input type="radio" name="type" value="0"  /> 公开 <input type="radio" name="type" value="1" checked="checked"/> 私密';
			}
		}else{
			_alert_back("不存在此相册");
		}
	   
	}else {
		_alert_back('非法操作！');
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
		<h2>修改相册信息</h2>
			<form method="post" action="?action=modify">
			<dl>
				<dd>相册名称：<input type="text" name="name" value="<?php echo $_html['name'] ?>" class="text" /></dd>
				<dd>相册类型：<?php echo $_html['type_html']?></dd>
				<dd id="pass">相册密码：<input type="password" name="password" class="text" /></dd>
				<dd>相册封面：<input type="text" name="face" value="<?php echo $_html['face']?>" class="text" /></dd>
				<dd>相册描述：<textarea name="content"><?php echo $_html['content'] ?></textarea></dd>
				<dd><input type="submit" class="submit" value="添加目录" /></dd>
			</dl>
			<input type="hidden" name="id" value="<?php echo $_html['id']?>" />
			</form>
			
	</div>
	
	
	
	<?php 
		require ROOT_PATH.'includes/footer.inc.php';
	?>
</body>
</html>
