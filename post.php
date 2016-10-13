<?php
	session_start();
	//定义一个常量，用来授权includes里面的文件
	define('IN_TG',true);
	
	//定义个常量，用来指定本页的内容
	define('SCRIPT','post');
	
	//引入公共文件
	require dirname(__FILE__).'/includes/common.inc.php';//转换为硬路径，速度更快
	//判断是否登录了
	if (!isset($_COOKIE['username'])) {
		_location('发帖前，必须登录','login.php');
	}
	//发表贴子
	if ($_GET['action'] == 'post') {
	//判断数据库是否存在此用户唯一标示符
	$_query_uniqid = mysql_query("SELECT dg_uniqid FROM tg_user WHERE dg_username = '{$_COOKIE['username']}' LIMIT 1 ");
	$_results = mysql_fetch_array($_query_uniqid,MYSQL_ASSOC);
	if($_results){
		//为了防止cookies伪造，还要比对一下唯一标识符uniqid()
		if($_results['dg_uniqid'] != $_COOKIE['uniqid']){
			_alert_back('唯一标示符异常');
		}
        //验证限时发帖
        if((time() - $_COOKIE['post_time']) < $_system['post']){
        	_alert_back("请阁下休息一会儿再发帖！");
        }
		//引入验证文件
		include ROOT_PATH.'includes/register.func.php';
		//创建一个空数组，用来存放提交过来的合法数据
		$_clean = array();
		$_clean['username'] = $_COOKIE['username'];
		$_clean['type'] = $_POST['type'];
		$_clean['title'] = _check_post_title($_POST['title'],2,40);
		$_clean['content'] =_check_post_content($_POST['content'],10);
		$_clean = _html($_clean);
		//写入数据库
		mysql_query("INSERT INTO tg_article (
		                                         dg_username,
		                                         dg_type,
		                                         dg_title,
		                                         dg_content,
		                                         dg_date
		                                     )  
		                             VALUES (
		                                         '{$_clean['username']}',
		                                         '{$_clean['type']}',
		                                         '{$_clean['title']}',
		                                         '{$_clean['content']}',
		                                         NOW()
		                                     )
		             ");
        //判断是否新增数据成功
		if(mysql_affected_rows() == 1){
			$_clean['id'] = mysql_insert_id();
			setcookie("post_time",time());
			mysql_close();
		   _location('帖子发表成功！','article.php?id='.$_clean['id']);
		}else{
			mysql_close();
			_alert_back('帖子发表失败');
		}
	}else{
		_alert_close('非法登录！');
	}
}
	
	     
	
         

?>

<!DOCTYPE html>
<html>
	<head>
		<link rel="shortcut icon" href="favicon.ico" />
		<link rel="stylesheet" type="text/css" href="css/1/basic.css"/>
		<link rel="stylesheet" type="text/css" href="css/1/register.css"/>
		<link rel="stylesheet" type="text/css" href="css/1/post.css""/>
		<meta charset="UTF-8">
		<title><?php echo $_system['webname']; ?></title>
		<script src="js/post.js" type="text/javascript" charset="utf-8"></script>
	</head>
	<body>
		<!--header-->
		<?php
		   require ROOT_PATH.'includes/header.inc.php';
		?>
		
		<div id="post">
			<h2>发表帖子</h2>
		    <form method="post" name="post" action="?action=post">
				<dl>
					<dt>请认真填写一下内容</dt>
					<dd>
						类　　型：
						<?php 
							foreach (range(1,16) as $_num) {
								if ($_num == 1) {
									echo '<label for="type'.$_num.'"><input type="radio" id="type'.$_num.'" name="type" value="'.$_num.'" checked="checked" /> ';
								} else {
									echo '<label for="type'.$_num.'"><input type="radio" id="type'.$_num.'" name="type" value="'.$_num.'" /> ';
								}
								echo ' <img src="images/icon'.$_num.'.gif" alt="类型" /></label>';
								if ($_num == 8) {
									echo '<br />　　　 　　';
								}
							}
						?>
					</dd>
					<dd>标　　题：<input type="text" name="title" class="text" /> (*必填，2-40位)</dd>
					<dd id="q">贴　　图：　<a href="javascript:;">Q图系列[1]</a>　 <a href="javascript:;">Q图系列[2]</a>　 <a href="javascript:;">Q图系列[3]</a></dd>
					<dd>
						<?php include ROOT_PATH.'includes/ubb.inc.php'; ?>
						<textarea name="content" rows="9"></textarea>
					</dd>
					<dd><input type="submit" class="submit" value="发表帖子" /></dd>
				</dl>
			</form>
		</div>
		
		<!--footer-->
		<?php
		   require ROOT_PATH.'includes/footer.inc.php';
		?>
	</body>
</html>