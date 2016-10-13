<?php
	session_start();
	//定义个常量，用来授权调用includes里面的文件
	define('IN_TG',true);
	//定义个常量，用来指定本页的内容
	define('SCRIPT','photo_add_img');
	//引入公共文件
	require dirname(__FILE__).'/includes/common.inc.php';
	//会员才能进入
	if (!$_COOKIE['username']) {
		_alert_back('非法登录！');
	}
	
	//将图片信息写入数据库
	if($_GET['action'] == 'addimg'){
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
	$_clean['name'] = _check_dir_name($_POST['name'],2,20);
	$_clean['url'] = _check_photo_url($_POST['url']);
	$_clean['sid'] = $_POST['sid'];
	$_clean['content'] = $_POST['content'];
	$_clean = _mysql_string($_clean);
	
	//把当前目录的信息写入数据库
		mysql_query("INSERT INTO tg_photo (
		                                  dg_name,
		                                  dg_url,
		                                  dg_content,
		                                  dg_sid,
		                                  dg_username,
		                                  dg_date
		                                ) 
		                         VALUES (
		                                 
										'{$_clean['name']}',
										'{$_clean['url']}',
										'{$_clean['content']}',
										'{$_clean['sid']}',
										'{$_COOKIE['username']}',
										NOW()
								        ) 
                    ") or die(mysql_error());

	
	//判断是否写入数据库
	if(mysql_affected_rows() == 1){
		mysql_close();
	    _location('图片添加成功','photo_show.php?id='.$_clean['sid']);
	}else{
		mysql_close();
		_alert_back('图片添加失败！');
	}
	
	
	}else{
		_alert_back('非法登录！');
	}
	
	
	
	

   }	
	
	//取值
	if(isset($_GET['id'])){
		$_result = mysql_query("SELECT 
		                               dg_id,
		                               dg_dir
		                          FROM
		                               tg_dir
		                         WHERE 
		                               dg_id = '{$_GET['id']}' 
		                         LIMIT 
		                               1  
		                             ");
		$_rows = mysql_fetch_array($_result,MYSQL_ASSOC);
		if($_rows){
			$_html = array();
			$_html['id'] = $_rows['dg_id'];
			$_html['dir'] = $_rows['dg_dir'];
			$_html = _html($_html);
		}else{
			_alert_back("不存在此相册");
		}
	}else{
		_alert_back("非法操作");
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
		<script src="js/photo_add_img.js" type="text/javascript" charset="utf-8"></script>
	</head>
	<body>
	<?php 
		require ROOT_PATH.'includes/header.inc.php';
	?>
	
	<div id="photo">
		<h2>相册</h2>
			<form method="post" action="?action=addimg">
				<input type="hidden" name="sid"  value="<?php echo $_html['id']?>" />
			<dl>
				<dd>图片名称：<input type="text" name="name" class="text" /></dd>
				<dd>图片地址：<input type="text" name="url" id="url" readonly="readonly" class="text" /><a href="javascript:;" title="<?php echo $_html['dir'] ?>"  id="up">上传</a></dd>
				<dd>图片描述：<textarea name="content"></textarea></dd>
				<dd><input type="submit" class="submit" value="添加图片" /></dd>
			</dl>
			</form>
			
	</div>
	
	
	
	<?php 
		require ROOT_PATH.'includes/footer.inc.php';
	?>
</body>
</html>
