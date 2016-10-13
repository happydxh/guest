<?php
    session_start();
	//定义个常量，用来授权调用includes里面的文件
	define('IN_TG',true);
	//定义个常量，用来指定本页的内容
	define('SCRIPT','friend');
	//引入公共文件
	require dirname(__FILE__).'/includes/common.inc.php';
	//判断是否登录了
	if (!isset($_COOKIE['username'])) {
		_alert_close('请先登录！');
	}


    //将添加好友的信息写入数据库
    if($_GET['action'] == 'add'){
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
			$_clean['content'] = _check_content($_POST['content']);
			$_clean = _mysql_string($_clean);
			//不能添加自己
			if($_clean['touser'] == $_clean['fromuser']){
				_alert_close('请不要添加自己！');
			}
			//数据库验证好友是否已经添加,传过来的好友双方名不能和数据库中的好友双方名重复
			$_qur = mysql_query("   SELECT 
					                        dg_id 
					                  FROM 
					                        tg_friend 
					                 WHERE 
					                       
											(dg_touser='{$_clean['touser']}' AND dg_fromuser='{$_clean['fromuser']}')
									OR
											(dg_touser='{$_clean['fromuser']}' AND dg_fromuser='{$_clean['touser']}')
					               LIMIT 
					                        1
					           ") ;
		    $_ro = mysql_fetch_array($_qur,MYSQL_ASSOC);
			
			if($_ro){
				_alert_close('你们已经是好友了！或者是未验证的好友！无需添加！');
			}else{
				//写入数据库
				mysql_query("INSERT INTO tg_friend (
				                                         dg_touser,
				                                         dg_fromuser,
				                                         dg_content,
				                                         dg_date
				                                     )  
				                             VALUES (
				                                         '{$_clean['touser']}',
				                                         '{$_clean['fromuser']}',
				                                         '{$_clean['content']}',
				                                         NOW()
				                                     )
				             ");
				 //判断是否新增数据成功
				if(mysql_affected_rows() == 1){
					mysql_close();
					//session_destroy();
				    _alert_close('好友添加成功，请等待验证');
				}else{
					mysql_close();
					//session_destroy();
					_alert_back('好友添加失败');
				}
			}
		}else{
			_alert_close('非法登录！');
		}
    }
    

	//获取数据  传递要发送消息的用户名
	if(isset($_GET['id'])){
		$_query = mysql_query("SELECT dg_username  FROM tg_user WHERE dg_id='{$_GET['id']}' LIMIT 1 ");
		$_rows = mysql_fetch_array($_query,MYSQL_ASSOC);
		if(!!$_rows){
			$_html = array();
			$_html['touser'] = $_rows['dg_username'];
			$_html = _html($_html);
		}else{
			_alert_back('此用户不存在');
		}
		$_querys = mysql_query("SELECT dg_username  FROM tg_user WHERE dg_username='{$_COOKIE['username']}' LIMIT 1 ");
		$_row = mysql_fetch_array($_querys,MYSQL_ASSOC);
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
			<h3>添加好友</h3>
			<form method="post" action="?action=add">
				<input type="hidden" name="touser" value="<?php echo $_html['touser']?>" />
			<dl>
				<dd><input type="text" readonly="readonly"  value="TO:<?php echo $_html['touser']?>" class="text" /></dd>
				<dd><textarea name="content">我是<?php echo $_row['dg_username']?>,我想和你交朋友</textarea></dd>
				<dd><input type="submit" class="submit" value="添加好友" /></dd>
			</dl>
			</form>
		</div>
		
	</body>
</html>