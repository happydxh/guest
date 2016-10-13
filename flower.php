<?php
    session_start();
	//定义个常量，用来授权调用includes里面的文件
	define('IN_TG',true);
	//定义个常量，用来指定本页的内容
	define('SCRIPT','flower');
	//引入公共文件
	require dirname(__FILE__).'/includes/common.inc.php';
	//判断是否登录了
	if (!isset($_COOKIE['username'])) {
		_alert_close('请先登录！');
	}
	//发信息
	if ($_GET['action'] == 'send') {
		//判断数据库是否存在此用户唯一标示符
		$_query_uniqid = mysql_query("SELECT dg_uniqid FROM tg_user WHERE dg_username = '{$_COOKIE['username']}' LIMIT 1 ");
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
			$_clean['touser'] = $_POST['touser'];
			$_clean['fromuser'] = $_COOKIE['username'];
			$_clean['flower'] = $_POST['flower'];
			$_clean['content'] = _check_content($_POST['content']);
			$_clean = _mysql_string($_clean);
			//写入数据库
			mysql_query("INSERT INTO tg_flower (
			                                         dg_touser,
			                                         dg_fromuser,
			                                         dg_flower,
			                                         dg_content,
			                                         dg_date
			                                     )  
			                             VALUES (
			                                         '{$_clean['touser']}',
			                                         '{$_clean['fromuser']}',
			                                         '{$_clean['flower']}',
			                                         '{$_clean['content']}',
			                                         NOW()
			                                     )
			             ");
	        //判断是否新增数据成功
			if(mysql_affected_rows() == 1){
				mysql_close();
				//session_destroy();
			    _alert_close('送花成功');
			}else{
				mysql_close();
				//session_destroy();
				_alert_back('送花失败');
			}
		}else{
			_alert_close('非法登录！');
		}
	}
	//获取数据  传递要发送消息的用户名
	if(isset($_GET['id'])){
		$_query = mysql_query("SELECT dg_username FROM tg_user WHERE dg_id='{$_GET['id']}' LIMIT 1 ");
		$_rows = mysql_fetch_array($_query,MYSQL_ASSOC);
		if(!!$_rows){
			$_html = array();
			$_html['touser'] = $_rows['dg_username'];
			$_html = _html($_html);
		}else{
			_alert_back('此用户不存在');
		}
	}else {
		_alert_close('非法操作！');
	}
		
?>
<!DOCTYPE html>
<html>
	<head>
		<link rel="shortcut icon" href="favicon.ico" />
		<link rel="stylesheet" type="text/css" href="css/1/basic.css"/>
		<link rel="stylesheet" type="text/css" href="css/1/message.css"/>
		<meta charset="UTF-8">
		<title><?php echo $_system['webname']; ?></title>
		<script src="js/login.js" type="text/javascript" charset="utf-8"></script>
	</head>
	<body>
		
		<div id="message">
			<h3>送花</h3>
			<form method="post" action="?action=send">
				<input type="hidden" name="touser" value="<?php echo $_html['touser']?>" />
			<dl>
				<dd><input type="text" readonly="readonly"  value="TO:<?php echo $_html['touser']?>" class="text" />
					<select name="flower">
						<?php
					       foreach(range(1, 100) as $_num){
					       	   echo '<option  value="'.$_num.'"> x'.$_num.'朵</option>';
					       }
					    ?>
					</select>
				</dd>
				<dd><textarea name="content">灰常欣赏你哦！给你送花了！！！</textarea></dd>
				<dd><input type="submit" class="submit" value="送花" /></dd>
			</dl>
			</form>
		</div>
		
	</body>
</html>