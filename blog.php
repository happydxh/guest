<?php
	session_start();
	//定义个常量，用来授权调用includes里面的文件
	define('IN_TG',true);
	//定义个常量，用来指定本页的内容
	define('SCRIPT','blog');
	//引入公共文件
	require dirname(__FILE__).'/includes/common.inc.php';
	//分页模块
	global $_pagesize,$_pagenum;
	_page("SELECT dg_id FROM tg_user",$_system['blog']);	
	
	//从数据库中取出数据
		$result = mysql_query("        SELECT
				                               dg_id, dg_username,dg_sex,dg_face 
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
		<link rel="stylesheet" type="text/css" href="css/1/blog.css"/>
		<meta charset="UTF-8">
		<title><?php echo $_system['webname']; ?></title>
		<script src="js/blog.js" type="text/javascript" charset="utf-8"></script>
	</head>
	<body>
	<?php 
		require ROOT_PATH.'includes/header.inc.php';
	?>
	
	<div id="blog">
		<h2>博友列表</h2>
		<?php 
		     $_html = array();
		     while  ($rows = mysql_fetch_array($result,MYSQL_ASSOC)) {
			 $_html['id'] = $rows['dg_id'];
			 $_html['username'] = $rows['dg_username'];
			 $_html['sex'] = $rows['dg_sex'];
		     $_html['face'] = $rows['dg_face'];
			 $_html = _html($_html);
		?>
		<dl>
			<dd class="user"><?php echo $_html['username'] ?>(<?php echo $_html['sex'] ?>)</dd>
			<dt><img src="<?php echo $_html['face'] ?>" alt="<?php echo $_html['face'] ?>" /></dt>
			<dd class="message"><a href="javascript:;" name="message" title="<?php echo $_html['id']?>">发消息</a></dd>
			<dd class="friend"><a href="javascript:;" name="friend" title="<?php echo $_html['id']?>">加为好友</a></dd>
			<dd class="guest">写留言</dd>
			<dd class="flower"><a href="javascript:;" name="flower" title="<?php echo $_html['id']?>">给他送花</a></dd>
		</dl>
		<?php }?>
			
		<?php
		  //分页
		   _paging(1);
		
		?>	
			
			
			
	</div>
	
	
	
	<?php 
		require ROOT_PATH.'includes/footer.inc.php';
	?>
</body>
</html>
