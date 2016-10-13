<?php
session_start();
//定义个常量，用来授权调用includes里面的文件
define('IN_TG',true);
//定义个常量，用来指定本页的内容
define('SCRIPT','member_flower');
//引入公共文件
require dirname(__FILE__).'/includes/common.inc.php';
//判断是否正常登录
if(!isset($_COOKIE['username'])){
_alert_back('请先登录');
}
//批删除信息
if ($_GET['action'] == 'delete' && isset($_POST['ids'])) {
	$_clean = array();
	$_clean['ids'] = _mysql_string(implode(',',$_POST['ids']));
	
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
	    mysql_query("DELETE FROM tg_flower WHERE dg_id IN ({$_clean['ids']}) ");
		
		//判断是否删除成功
			if(mysql_affected_rows()){
				mysql_close();
			    _location('删除成功','member_flower.php');
			}else{
				mysql_close();
				_alert_back('删除失败');
			}
		
	 }else{
	 	_alert_back('非法登录');
	 }
}
//分页模块
	_page("SELECT dg_id FROM tg_message WHERE dg_touser = '{$_COOKIE['username']}' ",10);	
//显示短信
$result = mysql_query("                SELECT
				                               dg_id, dg_fromuser,dg_content,dg_flower,dg_date 
				                         FROM  
				                               tg_flower
				                         WHERE
				                               dg_touser = '{$_COOKIE['username']}'       
				                     ORDER BY 
				                               dg_date
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
		<title><?php echo $_system['webname']; ?></title>
		<script src="js/member_message.js" type="text/javascript" charset="utf-8"></script>
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
					<dd><a href="member_friend.php">好友设置</a></dd>
					<dd><a href="member_flower.php">查询花朵</a></dd>
					<dd><a href="###">个人相册</a></dd>
				</dl>
			</div>
			
			<div id="member_main">
				<h2>花朵管理中心</h2>
				<form method="post" action="?action=delete">
				<table cellspacing="1">
					<tr><th>送花人</th><th>送花赠言</th><th>时间</th><th>花朵数目</th><th>操作</th></tr>
					<?php 
					     $_html = array();
					     while  ($rows = mysql_fetch_array($result,MYSQL_ASSOC)) {
						 $_html['id'] = $rows['dg_id'];
						 $_html['fromuser'] = $rows['dg_fromuser'];
						 $_html['content'] = $rows['dg_content'];
						 $_html['flower'] = $rows['dg_flower'];
					     $_html['date'] = $rows['dg_date'];
						 $_html = _html($_html);
						 $_html['num']+=$_html['flower']
					?>
					<tr>
						<td><?php echo $_html['fromuser']?></td>
						<td><a href="member_message_detail.php?id=<?php echo $_html['id']?>" title="<?php echo $_html['content']?>"><?php echo _title($_html['content']) ?></a></td>
						<td><?php echo $_html['date']?></td>
						<td><?php echo $_html['flower']?></td>
						<td><input type="checkbox" name="ids[]" value="<?php echo $_html['id'] ?>" /></td>
					</tr>
					<?php } ?>
						<tr ><td colspan="5">共<?php echo $_html['num'] ?>朵花</td></tr>
						<tr>
							<td colspan="5"><label for="all">全选 <input type="checkbox" name="chkall" id="all" /></label> <input type="submit" value="批删除" /></td>
						</tr>
				</table>
				</form>
                <?php _paging(2);?>
			</div>
		</div>
		
		<!--footer-->
		<?php
		   require ROOT_PATH.'includes/footer.inc.php';
		?>
	</body>
</html>