<?php
	session_start();
	//定义个常量，用来授权调用includes里面的文件
	define('IN_TG',true);
	//定义个常量，用来指定本页的内容
	define('SCRIPT','photo_detail');
	//引入公共文件
	require dirname(__FILE__).'/includes/common.inc.php';
	
	//将评论内容写进数据库
	if ($_GET['action'] == 'rephoto') {
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
			_alert_back("请阁下休息一会儿再评论");
		}
        
		//引入验证文件
		include ROOT_PATH.'includes/register.func.php';
		//创建一个空数组，用来存放提交过来的合法数据
		$_clean = array();
		$_clean['username'] = $_COOKIE['username'];
		$_clean['sid'] = $_POST['sid'];
		$_clean['title'] = $_POST['title'];
		$_clean['content'] =$_POST['content'];
		$_clean = _html($_clean);
		//写入数据库
		mysql_query("INSERT INTO tg_photo_comment (
		                                         dg_username,
		                                         dg_sid,
		                                         dg_title,
		                                         dg_content,
		                                         dg_date
		                                     )  
		                             VALUES (
		                                         '{$_clean['username']}',
		                                         '{$_clean['sid']}',
		                                         '{$_clean['title']}',
		                                         '{$_clean['content']}',
		                                         NOW()
		                                     )
		             ");
        //判断是否新增数据成功
		if(mysql_affected_rows() == 1){
			setcookie("re_time",time());
			mysql_query("UPDATE tg_photo SET dg_commendcount=dg_commendcount+1 WHERE dg_id='{$_clean['sid']}' ");
			mysql_close();
		   _location('评论成功！','photo_detail.php?id='.$_clean['sid']);
		}else{
			mysql_close();
			_alert_back('评论失败');
		}
	}else{
		_alert_close('非法登录！');
	}
}
	
	
	//取图片信息
	if(isset($_GET['id'])){
		$_result = mysql_query("SELECT 
                                        dg_id,
										dg_name,
										dg_url,
										dg_sid,
										dg_username,
										dg_readcount,
										dg_commendcount,
										dg_content,
										dg_date
		                          FROM
		                                tg_photo
		                         WHERE 
		                                dg_id = '{$_GET['id']}' 
		                         LIMIT 
		                               1  
		                             ");
		$_rows = mysql_fetch_array($_result,MYSQL_ASSOC);
		if($_rows){
			
			
			//防止加密相册图片穿插访问
			//可以先取得这个图片的sid，也就是它的目录，
			//然后再判断这个目录是否是加密的，
			//如果是加密的，再判断是否有对应的cookie存在，并且对于相应的值
			//管理员不受这个限制
			$_result_s = mysql_query("SELECT 
                                        dg_id,
										dg_username,
										dg_type
		                          FROM
		                                tg_dir
		                         WHERE 
		                                dg_id = '{$_rows['dg_sid']}' 
		                         LIMIT 
		                               1  
		                             ");
		    $_rows_s = mysql_fetch_array($_result_s,MYSQL_ASSOC);
		    if (!isset($_SESSION['admin'])) {
				if($_rows_s){
					if (!empty($_rows_s['dg_type']) && $_COOKIE['photo'.$_rows_s['dg_id']] != $_rows_s['dg_username']) {
						_alert_back('非法操作！');
					}
				}else{
					_alert_back('相册目录表出错了！');
				}
			}
			
			//累积阅读量
			mysql_query("UPDATE tg_photo SET dg_readcount = dg_readcount+1 WHERE dg_id='{$_GET['id']}' ");
			$_html = array();
			$_html['id'] = $_rows['dg_id'];
			$_html['name'] = $_rows['dg_name'];
			$_html['username'] = $_rows['dg_username'];
			$_html['url'] = $_rows['dg_url'];
			$_html['readcount'] = $_rows['dg_readcount'];
			$_html['commendcount'] = $_rows['dg_commendcount'];
			$_html['content'] = $_rows['dg_content'];
			$_html['date'] = $_rows['dg_date'];
			$_html['sid'] = $_rows['dg_sid'];
			$_html = _html($_html);
			
			
			//从数据库中取评论信息
			//创建一个全局变量，做个带参的分页
			global $_pagesize,$_pagenum, $_id;
			$_id = 'id='.$_html['id'].'&';
	       _page("SELECT dg_id FROM tg_photo_comment WHERE dg_sid='{$_html['id']}'",10); 
		    $_results = mysql_query("  SELECT 
			                                   dg_username,
			                                   dg_title,
			                                   dg_content,
			                                   dg_date 
			                            FROM 
			                                   tg_photo_comment
			                            WHERE 
			                                   dg_sid = '{$_html['id']}' 
			                        ORDER BY 
												dg_date ASC 
									   LIMIT 
												$_pagenum,$_pagesize
			                      ");
								  
								  
		    //上一页，取得比自己大的ID中，最小的那个即可。
		    $_zhi = mysql_query("SELECT
		                                 min(dg_id) 
		                             AS
		                                 id 
		                           FROM 
		                                 tg_photo 
		                           WHERE
		                                  dg_sid = '{$_html['sid']}' 
		                             AND
		                                  dg_id > '{$_html['id']}' 
		                           LIMIT
		                                  1
		                          ");
		    $_jg = mysql_fetch_array($_zhi,MYSQL_ASSOC);
		    $_html['preid'] = $_jg['id'];
		    if(!empty($_html['preid'])){
		    	$_html['preid_html'] =  '<a href="photo_detail.php?id='.$_html['preid'].'#pre">上一页</a>';
		    }else{
		    	$_html['preid_html'] = '<span>到头了</span>';
		    }
			
			//下一页，取得比自己小的ID中，最大的那个即可。
		    $_zhi = mysql_query("SELECT
		                                 max(dg_id) 
		                             AS
		                                 id 
		                           FROM 
		                                 tg_photo 
		                           WHERE
		                                  dg_sid = '{$_html['sid']}' 
		                             AND
		                                  dg_id < '{$_html['id']}' 
		                           LIMIT
		                                  1
		                          ");
		    $_jg = mysql_fetch_array($_zhi,MYSQL_ASSOC);
		    $_html['nextid'] = $_jg['id'];
		    if(!empty($_html['nextid'])){
		    	$_html['nextid_html'] =  '<a href="photo_detail.php?id='.$_html['nextid'].'#pre">下一页</a>';
		    }else{
		    	$_html['nextid_html'] = '<span>到头了</span>';
		    }
			
		}else{
			_alert_back("不存在此图片");
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
		<link rel="stylesheet" type="text/css" href="css/1/photo_detail.css"/>
		<meta charset="UTF-8">
		<title><?php echo $_system['webname']; ?></title>
		<script src="js/blog.js" type="text/javascript" charset="utf-8"></script>
		<script src="js/post.js" type="text/javascript" charset="utf-8"></script>
	</head>
	<body>
	<?php 
		require ROOT_PATH.'includes/header.inc.php';
	?>
	
	<div id="photo">
		<h2>图片详情</h2>
		<dl class="detail">
			<dd class="name"><?php echo $_html['name']?></dd>
			<dt><?php echo $_html['preid_html'] ?><img src="<?php echo $_html['url']?>" /><?php echo $_html['nextid_html']?></dt>
			<dd><a href="photo_show.php?id=<?php echo $_html['sid']?>">[返回列表]</a></dd>
			<dd>浏览量(<strong><?php echo $_html['readcount'];?></strong>) 评论量(<strong><?php echo $_html['commendcount'];?></strong>) 发表于：<?php echo $_html['date']?> 上传者：<?php echo $_html['username']?></dd>
			<dd>简介：<?php echo $_html['content']?></dd>
		</dl>
		
		
		
			
		<p class="line"></p>
		<?php
		    $_i = 1;
		    while($_row = mysql_fetch_array($_results,MYSQL_ASSOC)){
		    $_html['username'] = $_row['dg_username'];
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
				
				
				
			}
			
	    ?>
		<div class="re">
			<dl>
				<dd class="user"><?php echo $_html['username'] ?>(<?php echo $_html['usersex'] ?>)</dd>
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
				<h3>主题：<?php echo $_html['retitle'] ?> </h3>
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
		<p class="line"></p>
		<form method="post" action="?action=rephoto">
			<input type="hidden" name="sid" value="<?php echo $_html['id']?>" />
			<dl class="rephoto">
				<dd>标　　题：<input type="text" name="title" class="text" value="RE:<?php echo $_html['name']?>" /> (*必填，2-40位)</dd>
				<dd id="q">贴　　图：　<a href="javascript:;">Q图系列[1]</a>　 <a href="javascript:;">Q图系列[2]</a>　 <a href="javascript:;">Q图系列[3]</a></dd>
				<dd>
					<?php include ROOT_PATH.'includes/ubb.inc.php'?>
					<textarea name="content" rows="9"></textarea>
				</dd>
				
				<dd>
				   <input type="submit" class="submit" value="发表帖子" />
				</dd>
			</dl>
		</form>
		<?php }?>
		
	</div>
	
	
	
	<?php 
		require ROOT_PATH.'includes/footer.inc.php';
	?>
</body>
</html>
