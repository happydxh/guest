<?php
session_start();
//定义个常量，用来授权调用includes里面的文件
define('IN_TG',true);
//定义个常量，用来指定本页的内容
define('SCRIPT','menber_message_detail.php');
//引入公共文件
require dirname(__FILE__).'/includes/common.inc.php';
//判断是否登录了
if (!isset($_COOKIE['username'])) {
	_alert_back('请先登录！');
}


//显示信息细节
if(isset($_GET['id'])){
	$_query = mysql_query("   SELECT  
	                                  dg_id,dg_fromuser,dg_content,dg_state,dg_date
	                            FROM 
	                                  tg_message 
	                           WHERE 
	                                  dg_id = '{$_GET['id']}'
	                      ");
	$_rows = mysql_fetch_array($_query,MYSQL_ASSOC);
	//将dg_state改为1
	if(empty($_rows['dg_state'])){
		mysql_query("   UPDATE 
		                        tg_message
		                   SET 
		                        dg_state = 1 
		                 WHERE
		                        dg_id = '{$_GET['id']}' 
		                 LIMIT 1 
		            ");
	     if(!mysql_affected_rows()){
	     	_alert_back('异常！');
	     }
	}
	$_html = array();
	$_html['id'] = $_rows['dg_id'];
	$_html['fromuser'] = $_rows['dg_fromuser'];
	$_html['content'] = $_rows['dg_content'];
	$_html['date'] = $_rows['dg_date'];
	$_html = _html($_html);
}else{
	_alert_back('非法登录');
}

//删除短信模块
if($_GET['action'] == 'delete' && isset($_GET['id'])){
	//这是验证短信是否合法
	$_query_uniqid = mysql_query("    SELECT 
	                                          dg_id 
	                                    FROM  
	                                          tg_message 
	                                   WHERE  dg_id = '{$_GET['id']}'
	                                   LIMIT 1 
	                               ");
	$_results = mysql_fetch_array($_query_uniqid,MYSQL_ASSOC);
	if($_results){
		//危险操作，为了防止cookies伪造，还要比对一下唯一标识符uniqid()
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
			//删除操作
			mysql_query("DELETE FROM tg_message WHERE dg_id = '{$_GET['id']}' LIMIT 1 ");
			//判断是否删除成功
			if(mysql_affected_rows() == 1){
				mysql_close();
//				if(session_start()){
//					session_destroy();
//				}
			    _location('删除成功成功','member_message.php');
			}else{
				mysql_close();
//				if(session_start()){
//					session_destroy();
//				}
				_alert_back('短信删除失败');
			}
		}
	}else{
		_alert_back('此用户不存在');
	}
}


	
?>
<!DOCTYPE html>
<html>
	<head>
		<link rel="shortcut icon" href="favicon.ico" />
		<link rel="stylesheet" type="text/css" href="css/1/basic.css"/>
		<link rel="stylesheet" type="text/css" href="css/1/member.css"/>
		<link rel="stylesheet" type="text/css" href="css/1/member_message_detail.css"/>
		<meta charset="UTF-8">
		<title><?php echo $_system['webname']; ?></title>
		<script src="js/member_message_detail.js" type="text/javascript" charset="utf-8"></script>
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
					<dd><a href="member.php">个人信息</a></dd>
					<dd><a href="member.modify">修改资料</a></dd>
				</dl>
				<dl>
					<dt>其他管理</dt>
					<dd style="background: #CCCCCC;"><a href="member_message.php">短信查阅</a></dd>
					<dd><a href="###">好友设置</a></dd>
					<dd><a href="###">查询花朵</a></dd>
					<dd><a href="###">个人相册</a></dd>
				</dl>
			</div>
			
			<div id="member_main">
				<h2>信息详情</h2>
				<dl>
					<dd>发 信 人：<?php echo $_html['fromuser']?></dd>
					<dd>内　　容：<strong><?php echo $_html['content']?></strong></dd>
					<dd>发信时间：<?php echo $_html['date']?></dd>
					<dd class="button"><input type="button"  value="返回列表" id="return"  /> <input type="button" id="delete" name="<?php echo $_html['id'] ?>" value="删除信息" /></dd>
				</dl>
			</div>
		</div>
		
		<!--footer-->
		<?php
		   require ROOT_PATH.'includes/footer.inc.php';
		?>
	</body>
</html>