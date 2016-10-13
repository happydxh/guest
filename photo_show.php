<?php
	session_start();
	//定义个常量，用来授权调用includes里面的文件
	define('IN_TG',true);
	//定义个常量，用来指定本页的内容
	define('SCRIPT','photo_show');
	//引入公共文件
	require dirname(__FILE__).'/includes/common.inc.php';
	
	//删除图片
	if($_GET['action'] == 'delete' && isset($_GET['id'])){
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
		                               dg_username,dg_url,dg_sid,dg_id 
		                          FROM 
		                               tg_photo 
		                         WHERE 
		                               dg_id = '{$_GET['id']}'
		                        LIMIT
		                               1
		                               ");
			$_jg = mysql_fetch_array($_jgs,MYSQL_ASSOC);
			if($_jg){
				$_htmlimg = array();
				$_htmlimg['id'] = $_jg['dg_id'];
				$_htmlimg['username'] = $_jg['dg_username'];
				$_htmlimg['url'] = $_jg['dg_url'];
				$_htmlimg['sid'] = $_jg['dg_sid'];
				$_htmlimg = _html($_htmlimg);
				if($_COOKIE['username'] == $_htmlimg['username'] || isset($_SESSION['idmin']) ){
					//首先删除数据库的信息
					mysql_query("DELETE FROM tg_photo WHERE dg_id = '{$_htmlimg['id']}' ");
					//判断是否删除成功
					if(mysql_affected_rows() == 1){
						if(file_exists($_htmlimg['url'])){
							unlink($_htmlimg['url']);
						}else{
							_alert_back("磁盘中不存在此图");
						}
						mysql_close();
					    _location('图片删除成功','photo_show.php?id='.$_htmlimg['sid']);
					}else{
						mysql_close();
						_alert_back('图片删除失败！');
					}
					
				}else{
					_alert_back("非法操作");
				}
			}else{
				_alert_back("不存在此图片");
			}
		
		
		}else{
			_alert_back("非法操作");
		}
	}
	
	//取值
	if(isset($_GET['id'])){
		$_result = mysql_query("SELECT 
		                               dg_id,
		                               dg_username,
		                               dg_type
		                          FROM
		                               tg_dir
		                         WHERE 
		                               dg_id = '{$_GET['id']}' 
		                         LIMIT 
		                               1  
		                             ");
		$_rows = mysql_fetch_array($_result,MYSQL_ASSOC);
		if($_rows){
			$_dirhtml = array();
			$_dirhtml['id'] = $_rows['dg_id'];
			$_dirhtml['name'] = $_rows['dg_username'];
			$_dirhtml['type'] = $_rows['dg_type'];
			$_dirhtml = _html($_dirhtml);
			$_dirhtml['password'] = sha1($_POST['password']);
			
			//将表单中的密码与数据库中的密码进行对比
			if($_POST[password]){
				$_result = mysql_query("SELECT 
				                               dg_id
				                          FROM
				                               tg_dir
				                         WHERE 
				                               dg_password='{$_dirhtml['password']}'
				                         LIMIT 
				                               1  
				                             ");
				$_rows = mysql_fetch_array($_result,MYSQL_ASSOC);
				if($_rows){
					//生成cookie
					setcookie('photo'.$_dirhtml['id'],$_dirhtml['name']);
					//重定向
					_location(null,'photo_show.php?id='.$_dirhtml['id']);
				}else{
					_alert_back('相册密码不正确!');
				}
			}
			
		}else{
			_alert_back("不存在此相册");
		}
	}else{
		_alert_back("非法操作");
	}
	
	//微缩图
	$_filename = 'photo\1471827366/1471914402.jpg';
    $_percent = 0.3;
	
	//显示图片列表
	//分页模块
	global $_pagesize,$_pagenum,$_system,$_id;
    $_id = 'id='.$_dirhtml['id'].'&';
	_page("SELECT dg_id FROM tg_photo WHERE dg_sid ='{$_dirhtml['id']}' ",$_system['photo']);	
	
	//从数据库中取出数据
		$result = mysql_query("        SELECT
				                               dg_id, 
				                               dg_name,
				                               dg_url,
				                               dg_username,
				                               dg_readcount,
				                               dg_commendcount
				                         FROM  
				                               tg_photo
				                        WHERE 
				                               dg_sid ='{$_dirhtml['id']}'
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
		<link rel="stylesheet" type="text/css" href="css/1/photo_show.css"/>
		<meta charset="UTF-8">
		<title><?php echo $_system['webname']; ?></title>
		<script src="js/blog.js" type="text/javascript" charset="utf-8"></script>
	</head>
	<body>
	<?php 
		require ROOT_PATH.'includes/header.inc.php';
	?>
	
	<div id="photo">
		
		<h2><?php echo $_dirhtml['name']?></h2>
		<?php 
		
		    if(empty($_dirhtml['type']) || $_COOKIE['photo'.$_dirhtml['id']] == $_dirhtml['name'] || isset($_SESSION['admin'])) {
		
		     $_html = array();
		     while  ($rows = mysql_fetch_array($result,MYSQL_ASSOC)) {
			 $_html['id'] = $rows['dg_id'];
			 $_html['name'] = $rows['dg_name'];
			 $_html['url'] = $rows['dg_url'];
		     $_html['username'] = $rows['dg_username'];
		     $_html['readcount'] = $rows['dg_readcount'];
		     $_html['commendcount'] = $rows['dg_commendcount'];
			 $_html = _html($_html);
		?>
		  	<dl>
				<dt><a href="photo_detail.php?id=<?php echo $_html['id'] ?>"><img src="thumb.php?filename=<?php echo $_html['url'] ?>&percent=<?php echo $_percent?>"/></a></dt>
				<dd><a href="photo_detail.php?id=<?php echo $_html['id'] ?>"><?php echo $_html['name']?></a></dd>
				<dd>阅(<strong><?php echo $_html['readcount'] ?></strong>) 评(<strong><?php echo $_html['commendcount'] ?></strong>) 上传者：<?php echo $_html['username']?></dd>
				<?php if($_COOKIE['username'] == $_html['username'] || isset($_SESSION['admin'])){ ?>
				   <dd><a href="photo_show.php?action=delete&id=<?php echo $_html['id'] ?>">[删除]</a></dd>
				<?php } ?>
			</dl>
	    <?php } 
	    	mysql_free_result($result);
		   _paging(1);
	    ?>
		
		<p><a href="photo_add_img.php?id=<?php echo$_dirhtml['id'] ?>">上传图片</a></p>
		
		<?php 
		    }else{
		    	echo '<form method="post" action="photo_show.php?id='.$_dirhtml['id'].'">';
				echo '<p>请输入密码：<input type="password" name="password" /> <input type="submit" value="确认" /></p>';
				echo '</form>';
		    }
		?>
	</div>
	
	
	
	<?php 
		require ROOT_PATH.'includes/footer.inc.php';
	?>
</body>
</html>
