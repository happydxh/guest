<?php
	session_start();
	//定义个常量，用来授权调用includes里面的文件
	define('IN_TG',true);
	//定义个常量，用来指定本页的内容
	define('SCRIPT','article');
	//引入公共文件
	require dirname(__FILE__).'/includes/common.inc.php';
	//将回帖内容写进数据库
	if ($_GET['action'] == 'rearticle') {
	//判断数据库是否存在此用户唯一标示符
	$_query_uniqid = mysql_query("SELECT dg_uniqid FROM tg_user WHERE dg_username = '{$_COOKIE['username']}' LIMIT 1 ");
	$_results = mysql_fetch_array($_query_uniqid,MYSQL_ASSOC);
	if($_results){
		//为了防止cookies伪造，还要比对一下唯一标识符uniqid()
		if($_results['dg_uniqid'] != $_COOKIE['uniqid']){
			_alert_back('唯一标示符异常');
		}
		
		//验证回帖限时时间
		if((time() - $_COOKIE['re_time']) < $_system['re']){
			_alert_back("请阁下休息一会儿再回帖");
		}
        
		//引入验证文件
		include ROOT_PATH.'includes/register.func.php';
		//创建一个空数组，用来存放提交过来的合法数据
		$_clean = array();
		$_clean['username'] = $_COOKIE['username'];
		$_clean['type'] = $_POST['type'];
		$_clean['reid'] = $_POST['reid'];
		$_clean['title'] = $_POST['title'];
		$_clean['content'] =$_POST['content'];
		$_clean = _html($_clean);
		//写入数据库
		mysql_query("INSERT INTO tg_article (
		                                         dg_username,
		                                         dg_type,
		                                         reid,
		                                         dg_title,
		                                         dg_content,
		                                         dg_date
		                                     )  
		                             VALUES (
		                                         '{$_clean['username']}',
		                                         '{$_clean['type']}',
		                                         '{$_clean['reid']}',
		                                         '{$_clean['title']}',
		                                         '{$_clean['content']}',
		                                         NOW()
		                                     )
		             ");
        //判断是否新增数据成功
		if(mysql_affected_rows() == 1){
			setcookie("re_time",time());
			mysql_query("UPDATE tg_article SET dg_commendcount=dg_commendcount+1 WHERE reid = 0 AND dg_id='{$_clean['reid']}' ");
			mysql_close();
		   _location('回帖成功！','article.php?id='.$_clean['reid']);
		}else{
			mysql_close();
			_alert_back('帖子发表失败');
		}
	}else{
		_alert_close('非法登录！');
	}
}
	//读出数据
	if($_GET['id']){
		$_query = mysql_query("    SELECT
		                                   dg_id,
										   dg_username,
										   dg_title,
										   dg_type,
										   dg_content,
										   dg_readcount,
										   dg_commendcount,
										   dg_date,
										   dg_last_modify_date 
		                              FROM 
											tg_article 
							WHERE
							                reid=0
									   AND
											dg_id='{$_GET['id']}'
		                      ");
		$_rows = mysql_fetch_array($_query,MYSQL_ASSOC);
		
		if($_rows){
			//累积阅读量
			mysql_query("UPDATE tg_article SET dg_readcount = dg_readcount+1 WHERE dg_id='{$_GET['id']}' ");
			$_html = array();
			$_html['reid'] = $_rows['dg_id'];//供回帖使用，确定回复谁
			$_html['username_subject'] = $_rows['dg_username'];
			$_html['title'] = $_rows['dg_title'];
			$_html['type'] = $_rows['dg_type'];
			$_html['content'] = $_rows['dg_content'];
			$_html['readcount'] = $_rows['dg_readcount'];
			$_html['commendcount'] = $_rows['dg_commendcount'];
			$_html['date'] = $_rows['dg_date'];
			$_html['last_modify_date'] = $_rows['dg_last_modify_date'];
			//拿出用户名，去寻找用户信息
			$_result = mysql_query("     SELECT 
			                                   dg_id,
											   dg_sex,
											   dg_face,
											   dg_email,
											   dg_url,
											   dg_switch,
											   dg_autograph 
			                              FROM 
			                                   tg_user 
			                             WHERE 
			                                   dg_username = '{$_html['username_subject']}' 
			                      ");
			$_rows = mysql_fetch_array($_result,MYSQL_ASSOC);
			if($_rows){
				$_html['userid'] = $_rows['dg_id'];
				$_html['usersex'] = $_rows['dg_sex'];
				$_html['userface'] = $_rows['dg_face'];
				$_html['useremail'] = $_rows['dg_email'];
				$_html['userurl'] = $_rows['dg_url'];
				$_html['switch'] = $_rows['dg_switch'];
				$_html['autograph'] = $_rows['dg_autograph'];
				$_html = _html($_html);
				
		    //主题帖子修改
		    if( $_html['username_subject'] == $_COOKIE['username'] ){
		    	$_html['subject_modify'] = '[<a href="article_modify.php?id='.$_html['reid'].'">修改</a>]';
		    }

            //读取最后修改信息
			if ($_html['last_modify_date'] != '0000-00-00 00:00:00') {
				$_html['last_modify_date_string'] = '本贴已由['.$_html['username_subject'].']于'.$_html['last_modify_date'].'修改过！';
			}
			
			//回复楼主
			if($_COOKIE['username']){
				$_html['re'] = '<span>[<a href="#ree"  id="link" name="re" title="回复1楼的'.$_html['username_subject'].'">回复</a>]</span>';
			}
            //个性签名
            if($_html['switch'] == 0){
            	$_html['autograph_html'] = '<p class="autograph">个性签名：'._ubb($_html['autograph']).'</p>';
            }
				
		    //读取回帖
		    //创建一个全局变量，做个带参的分页
			global $_pagesize,$_pagenum， $_id;
			$_id = 'id='.$_html['reid'].'&';
	       _page("SELECT dg_id FROM tg_article WHERE reid='{$_html['reid']}'",2); 
		    $_results = mysql_query("  SELECT 
			                                   dg_username,
			                                   dg_type,
			                                   dg_title,
			                                   dg_content,
			                                   dg_date 
			                            FROM 
			                                   tg_article
			                            WHERE 
			                                   reid = '{$_html['reid']}' 
			                        ORDER BY 
												dg_date ASC 
									   LIMIT 
												$_pagenum,$_pagesize
			                      ");
			
				
			}else{
				//这个用户已经被删除
			}
		}else{
			_alert_back('不存在这个主题！');
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
		<link rel="stylesheet" type="text/css" href="css/1/article.css"/>
		<meta charset="UTF-8">
		<title><?php echo $_system['webname']; ?></title>
		<script src="js/blog.js" type="text/javascript" charset="utf-8"></script>
		<script src="js/post.js" type="text/javascript" charset="utf-8"></script>
	</head>
	<body>
	<?php 
		require ROOT_PATH.'includes/header.inc.php';
	?>
	
	<div id="article">
		<h2>帖子详情</h2>
		<?php
		    if($_page == 1){
		?>
		<div id="subject">
			<dl>
				<dd class="user"><?php echo $_html['username_subject'] ?>(<?php echo $_html['usersex'] ?>)[楼主]</dd>
				<dt><img src="<?php echo $_html['userface'] ?>" alt="<?php echo $_html['username_subject'] ?>" /></dt>
				<dd class="message"><a href="javascript:;" name="message" title="<?php echo $_html['userid'] ?>">发消息</a></dd>
				<dd class="friend"><a href="javascript:;" name="friend" title="<?php echo $_html['userid'] ?>">加为好友</a></dd>
				<dd class="guest">写留言</dd>
				<dd class="flower"><a href="javascript:;" name="flower" title="<?php echo $_html['userid'] ?>">给他送花</a></dd>
				<dd class="email">邮件：<a href="mailto:<?php echo $_html['useremail'] ?>"><?php echo $_html['useremail'] ?></a></dd>
				<dd class="url">网址：<a href="<?php echo $_html['userurl'] ?>" target="_blank"><?php echo $_html['userurl'] ?></a></dd>
			</dl>
			<div class="content">
				<div class="user">
					<span><?php echo $_html['subject_modify'] ?>1#</span><?php echo $_html['username_subject'] ?> | 发表于：<?php echo $_html['date'] ?>
				</div>
				<h3>主题：<?php echo $_html['title'] ?> <img src="images/icon<?php echo $_html['type'] ?>.gif" alt="icon" /><?php echo $_html['re']?></h3>
				<div class="detail">
					<?php echo _ubb($_html['content'])?> 
					<?php echo $_html['autograph_html']?>
				</div>
				<div class="read">
					<p><?php echo $_html['last_modify_date_string']?></p>
					阅读量：(<?php echo $_html['readcount']?>) 评论量：(<?php echo $_html['commendcount']?>)
				</div>
			</div>
		</div>
		
		<?php }?>
			
		<p class="line"></p>
		<?php
		    $_i = 2;
		    while($_row = mysql_fetch_array($_results,MYSQL_ASSOC)){
		    $_html['username'] = $_row['dg_username'];
			$_html['type'] = $_row['dg_type'];
			$_html['retitle'] = $_row['dg_title'];
			$_html['content'] = $_row['dg_content'];
			$_html['date'] = $_row['dg_date'];
			$_html = _html($_html);
			//拿出用户名，去寻找用户信息
			$_result = mysql_query("     SELECT 
			                                   dg_id,
											   dg_sex,
											   dg_face,
											   dg_email,
											   dg_url,
											   dg_switch,
											   dg_autograph  
			                              FROM 
			                                   tg_user 
			                             WHERE 
			                                   dg_username = '{$_html['username']}' 
			                      ");
			$_rows = mysql_fetch_array($_result,MYSQL_ASSOC);
			if($_rows){
				$_html['userid'] = $_rows['dg_id'];
				$_html['usersex'] = $_rows['dg_sex'];
				$_html['userface'] = $_rows['dg_face'];
				$_html['useremail'] = $_rows['dg_email'];
				$_html['userurl'] = $_rows['dg_url'];
				$_html['switch'] = $_rows['dg_switch'];
				$_html['autograph'] = $_rows['dg_autograph'];
				$_html = _html($_html);
				//设置沙发
               if ($_i == 2 && $_page == 1) {
					if ($_html['username'] == $_html['username_subject']) {
						$_html['username_html'] = $_html['username'].'(楼主)';
					} else {
						$_html['username_html'] = $_html['username'].'(沙发)';
					}
				}else{
					   $_html['username_html'] = $_html['username'];
				}
				
				//跟帖回复
				if($_COOKIE['username']){
					$_html['re'] = '<span>[<a href="#ree"  id="link" name="re" title="回复'.($_i + (($_page-1) * $_pagesize)).'楼的'.$_html['username'].'">回复</a>]</span>';
				}
			}
			
	    ?>
		<div class="re">
			<dl>
				<dd class="user"><?php echo $_html['username_html'] ?>(<?php echo $_html['usersex'] ?>)</dd>
				<dt><img src="<?php echo $_html['userface'] ?>" alt="<?php echo $_html['username'] ?>" /></dt>
				<dd class="message"><a href="javascript:;" name="message" title="<?php echo $_html['userid'] ?>">发消息</a></dd>
				<dd class="friend"><a href="javascript:;" name="friend" title="<?php echo $_html['userid'] ?>">加为好友</a></dd>
				<dd class="guest">写留言</dd>
				<dd class="flower"><a href="javascript:;" name="flower" title="<?php echo $_html['userid'] ?>">给他送花</a></dd>
				<dd class="email">邮件：<a href="mailto:<?php echo $_html['useremail'] ?>"><?php echo $_html['useremail'] ?></a></dd>
				<dd class="url">网址：<a href="<?php echo $_html['userurl'] ?>" target="_blank"><?php echo $_html['userurl'] ?></a></dd>
			</dl>
			<div class="content">
				<div class="user">
					<span><?php echo  $_i + (($_page-1) * $_pagesize);?>#</span><?php echo $_html['username'] ?> | 发表于：<?php echo $_html['date'] ?>
				</div>
				<h3>主题：<?php echo $_html['retitle'] ?> <img src="images/icon<?php echo $_html['type'] ?>.gif" alt="icon" /><?php echo $_html['re']?></h3>
				<div class="detail">
					<?php echo _ubb($_html['content'])?>
					<?php
			            if($_html['switch'] == 0){
			            	 echo  '<p class="autograph">个性签名：'._ubb($_html['autograph']).'</p>';
			            }
					?>
				</div>
			</div>
		</div>
		
		<p class="line"></p>
	     <?php 
          $_i++;
         }
           mysql_free_result($_result);
	     	_paging(2);
	     ?>
	     
	     
		
		<?php if (isset($_COOKIE['username'])) {?>
			
			<form method="post"  action="?action=rearticle">
				    <a name="ree"></a>
				    <input type="hidden" name="reid" value="<?php echo $_html['reid'] ?>" />
				    <input type="hidden" name="type" value="<?php echo $_html['type'] ?>" />
					<dl>
						<dd>标　　题：<input id="inputlink" type="text" name="title" class="text" value="RE:<?php echo $_html['title'] ?>"/> (*必填，2-40位)</dd>
						<dd id="q">贴　　图：　<a href="javascript:;">Q图系列[1]</a>　 <a href="javascript:;">Q图系列[2]</a>　 <a href="javascript:;">Q图系列[3]</a></dd>
						<dd>
							<?php include ROOT_PATH.'includes/ubb.inc.php'; ?>
							<textarea name="content" rows="9"></textarea>
						</dd>
						<dd><input type="submit" class="submit" value="发表帖子" /></dd>
					</dl>
			</form>
			
		<?php } ?>
	</div>
	
	
	
	<?php 
		require ROOT_PATH.'includes/footer.inc.php';
	?>
</body>
</html>
