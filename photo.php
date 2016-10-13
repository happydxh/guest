<?php
	session_start();
	//定义个常量，用来授权调用includes里面的文件
	define('IN_TG',true);
	//定义个常量，用来指定本页的内容
	define('SCRIPT','photo');
	//引入公共文件
	require dirname(__FILE__).'/includes/common.inc.php';
	
	//删除目录
	if($_GET['action'] == 'delete' || isset($_GET['id'])){
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
			
			$_jgs = mysql_query("SELECT 
		                               dg_dir 
		                          FROM 
		                               tg_dir 
		                         WHERE 
		                               dg_id = '{$_GET['id']}'
		                        LIMIT
		                               1
		                               ");
			$_jg = mysql_fetch_array($_jgs,MYSQL_ASSOC);
			if($_jg){
				$_html = array();
				$_html['url'] = $_jg['dg_dir'];
				$_html = _html($_html);
				//删除磁盘目录
				if (file_exists($_html['url'])) {
					if (_remove_Dir($_html['url'])) {
						//1.删除目录里的数据库图片
						mysql_query("DELETE FROM tg_photo WHERE dg_sid='{$_GET['id']}'");
						//2.删除这个目录的数据库
						mysql_query("DELETE FROM tg_dir WHERE dg_id='{$_GET['id']}'");
						mysql_close();
						_location('目录删除成功!','photo.php');
					} else {
						mysql_close();
						_alert_back('目录删除失败!');
					}
				}else{
					_alert_back("不存在此路径");
				}
			}else{
				_alert_back("不存在此路径");
			}
			
			
		}else{
			_alert_back("非法操作");
		}
	}
	
	
	//读取目录数据
	//分页模块
	global $_pagesize,$_pagenum;
	_page("SELECT dg_id FROM tg_dir",$_system['photo']);
	$result = mysql_query("        SELECT
				                               dg_id, dg_username,dg_type,dg_face
				                         FROM  
				                               tg_dir 
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
		<link rel="stylesheet" type="text/css" href="css/1/blog.css"/>
		<link rel="stylesheet" type="text/css" href="css/1/photo.css"/>
		<meta charset="UTF-8">
		<title><?php echo $_system['webname']; ?></title>
		<script src="js/blog.js" type="text/javascript" charset="utf-8"></script>
	</head>
	<body>
	<?php 
		require ROOT_PATH.'includes/header.inc.php';
	?>
	
	<div id="photo">
		<h2>相册</h2>
		<?php
		   $_html = array();
		    while  ($rows = mysql_fetch_array($result,MYSQL_ASSOC)) {
			 $_html['id'] = $rows['dg_id'];
			 $_html['name'] = $rows['dg_username'];
			 $_html['type'] = $rows['dg_type'];
			 $_html['face'] = $rows['dg_face'];
			 $_html = _html($_html);
			 
			 if(empty($_html['type'])){
			 	$_html['type_html'] = '(公开)';
			 }else{
			 	$_html['type_html'] = '(私密)';
			 }
			 
			 if (empty($_html['face'])) {
					$_html['face_html'] = '';
				} else {
					$_html['face_html'] = '<img src="'.$_html['face'].'" alt="'.$_html['tg_name'].'" />';
				}
				
			//统计该相册图片数量
            $_query = mysql_query("SELECT COUNT(*) AS count FROM tg_photo WHERE dg_sid = '{$_html['id']}' ");
			$row = mysql_fetch_array($_query,MYSQL_ASSOC);
			$_html['count'] = $row['count'];
		?>
		   	<dl>
				<dt><a href="photo_show.php?id=<?php echo $_html['id']?>"><?php echo $_html['face_html'];?></a></dt>
				<dd><a href="photo_show.php?id=<?php echo $_html['id']?>"><?php echo $_html['name']?> <?php echo '['.$_html['count'].']'.$_html['type_html'] ?></a></dd>
				<?php if (isset($_SESSION['admin']) && isset($_COOKIE['username'])) {?>
				<dd>[<a href="photo_modify_dir.php?id=<?php echo $_html['id'] ?>">修改</a>] [<a href="photo.php?action=delete&id=<?php echo $_html['id'] ?>">删除</a>]</dd>
				<?php }?>
			</dl> 
		<?php }?>
		
		
		<?php if (isset($_SESSION['admin']) && isset($_COOKIE['username'])) {?>
		<p><a href="photo_add_dir.php">添加目录</a></p>
		<?php }?>
			
	</div>
	
	
	
	<?php 
		require ROOT_PATH.'includes/footer.inc.php';
	?>
</body>
</html>
