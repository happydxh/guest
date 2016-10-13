<?php
session_start();
//定义个常量，用来授权调用includes里面的文件
define('IN_TG',true);
//定义个常量，用来指定本页的内容
define('SCRIPT','manage_member');
//引入公共文件
require dirname(__FILE__).'/includes/common.inc.php';
//管理员才能登录
if ((!isset($_COOKIE['username'])) || (!isset($_SESSION['admin']))) {
		_alert_back('非法登录！');
	}

//删除会员
if($_GET['action'] == 'del' && isset($_GET['id'])){
//危险操作，为了防止cookies伪造，还要比对一下唯一标识符uniqid()
	$_query_uniqid = mysql_query("    SELECT 
	                                          dg_uniqid 
	                                    FROM  
	                                          tg_user 
	                                   WHERE  
	                                          dg_username = '{$_COOKIE['username']}' 
	                                   LIMIT 1 
	                               ");
	 $_results = mysql_fetch_array($_query_uniqid,MYSQL_ASSOC);
	 if($_results){
	 	//为了防止cookies伪造，还要比对一下唯一标识符uniqid()
		if($_results['dg_uniqid'] != $_COOKIE['uniqid']){
			_alert_back('唯一标示符异常');
		}
		//删除操作
	    mysql_query("DELETE FROM tg_user WHERE dg_id = '{$_GET['id']}'  ");
		
		//判断是否删除成功
			if(mysql_affected_rows()){
				mysql_close();
			    _location('删除成功','manage_member.php');
			}else{
				mysql_close();
				_alert_back('短信删除失败');
			}
		
	 }else{
	 	_alert_back('非法登录');
	 }
}
	
//分页模块
	_page("SELECT dg_id FROM tg_user  ",15);
	//显示短信
	$result = mysql_query("                SELECT
					                               dg_id, 
					                               dg_username,
					                               dg_email,
					                               dg_reg_time
					                         FROM  
					                               tg_user
					                           
					                     ORDER BY 
					                               dg_reg_time
					                         DESC 
					                        LIMIT 
					                               $_pagenum,$_pagesize
		                        ");


	
	
?>
<!DOCTYPE html>
<html>
	<head>
		<link rel="shortcut icon" href="favicon.ico" />
		<link rel="stylesheet" type="text/css" href="css/1/basic.css"/>
		<link rel="stylesheet" type="text/css" href="css/1/member.css"/>
		<link rel="stylesheet" type="text/css" href="css/1/member_message.css"/>
		<meta charset="UTF-8">
		<title>后台管理中心</title>
		<script src="js/member_message.js" type="text/javascript" charset="utf-8"></script>
	</head>
	<body>
		<!--header-->
		<?php
		   require ROOT_PATH.'includes/header.inc.php';
		?>
		
        <div id="member">
        	
			<div id="member_sidebar">
				<h2>管理导航</h2>
				<dl>
					<dt>系统管理</dt>
					<dd><a href="manage.php" >后台首页</a></dd>
					<dd><a href="manage_set.php">系统设置</a></dd>
				</dl>
				<dl>
					<dt>会员管理</dt>
					<dd><a href="manage_member.php" style="background: #CCCCCC;">会员列表</a></dd>
					<dd><a href="manage_job.php">职务设置</a></dd>
				</dl>
			</div>
			
			<div id="member_main">
				<h2>会员管理中心</h2>
				<form method="post" action="?action=delete">
				<table cellspacing="1">
					<tr><th>ID号</th><th>会员名</th><th>邮件</th><th>注册时间</th><th>操作</th></tr>
		            <?php
		               $_html = array();
		               while($_rows = mysql_fetch_array($result,MYSQL_ASSOC)){
		               $_html['id'] = $_rows['dg_id'];
					   $_html['username'] = $_rows['dg_username'];
					   $_html['email'] = $_rows['dg_email'];
					   $_html['re_time'] = $_rows['dg_reg_time'];
					   $_html = _html($_html);	
		            ?>
		               <tr>
		               	   <th><?php echo $_html['id'] ?></th>
		               	   <th><?php echo $_html['username'] ?></th>
		               	   <th><?php echo $_html['email'] ?></th>
		               	   <th><?php echo $_html['re_time'] ?></th>
		               	   <th>[<a href="?action=del&id=<?php echo $_html['id']?>">删</a>] [改]</th>
		               	</tr>
					<?php } ?>
				</table>
				</form>
				<?php
				mysql_free_result($result);
                 _paging(2);
				 ?>
			</div>
		</div>
		
		<!--footer-->
		<?php
		   require ROOT_PATH.'includes/footer.inc.php';
		?>
	</body>
</html>