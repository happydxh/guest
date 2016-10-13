<?php
	/**
	* Guest Version1.0
	* ================================================
	* Copy 2016-2017 yc51
	* Web: http://www.yc51.com
	* ================================================
	* Author: deng
	* Date: 2016-8-10
	*/
	session_start();
	//定义一个常量，用来授权includes里面的文件
	define('IN_TG',true);
	
	//定义个常量，用来指定本页的内容
	define('SCRIPT','index');
	
	//引入公共文件
	require dirname(__FILE__).'/includes/common.inc.php';//转换为硬路径，速度更快
	//读取XML文件
	$_html = _html(_get_xml('new.xml'));
	//显示帖子列表
	//分页模块
	global $_pagesize,$_pagenum;
	_page("SELECT dg_id FROM tg_article WHERE reid=0",$_system['article']);
	//从数据库中取出数据
	$results = mysql_query("        SELECT
			                               dg_id,dg_title,dg_type,dg_readcount,dg_commendcount  
			                         FROM  
			                               tg_article
			                         WHERE 
			                               reid = 0 
			                     ORDER BY 
			                               dg_date 
			                         DESC 
			                        LIMIT 
			                               $_pagenum,$_pagesize
                        ");	
	//最新图片,找到时间点最后上传的那张图片，并且是非公开的
    $_results = mysql_query("        SELECT
			                               dg_id,dg_name,dg_url
			                         FROM  
			                               tg_photo
			                         WHERE 
			                               dg_sid in (SELECT dg_id FROM tg_dir WHERE dg_type=0)
			                     ORDER BY 
			                               dg_date 
			                         DESC 
			                        LIMIT 
			                              1
                        ");
    $_ro = mysql_fetch_array($_results,MYSQL_ASSOC);
    if($_ro){
    	$_htmlnew = array();
    	$_htmlnew['id'] = $_ro['dg_id'];
    	$_htmlnew['name'] = $_ro['dg_name'];
    	$_htmlnew['url'] = $_ro['dg_url'];
    	$_htmlnew = _html($_htmlnew);
    }
?>
<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="css/1/basic.css"/>
		<link rel="stylesheet" type="text/css" href="css/1/index.css"/>
		<link rel="shortcut icon" href="favicon.ico" />
		<meta charset="utf-8" />
		<title><?php echo $_system['webname']; ?></title>
		<script src="js/blog.js" type="text/javascript" charset="utf-8"></script>
	</head>
	<body>
		<!--header-->
		<?php
		   require ROOT_PATH.'includes/header.inc.php';
		?>
		
		<!--content-->
		<div id="content">
			<div class="content_left">
				<div id="user" class="users">
					<h2>新进会员</h2>
					<dl>
						<dd class="user"><?php echo $_html['username']?>(<?php echo $_html['sex']?>)</dd>
						<dt><img src="<?php echo $_html['face']?>" alt="<?php echo $_html['username']?>" /></dt>
						<dd class="message"><a href="javascript:;" name="message" title="<?php echo $_html['id']?>">发消息</a></dd>
						<dd class="friend"><a href="javascript:;" name="friend" title="<?php echo $_html['id']?>">加为好友</a></dd>
						<dd class="guest">写留言</dd>
						<dd class="flower"><a href="javascript:;" name="flower" title="<?php echo $_html['id']?>">给他送花</a></dd>
						<dd class="email">邮件：<a href="mailto:<?php echo $_html['email']?>"><?php echo $_html['email']?></a></dd>
						<dd class="url">网址：<a href="<?php echo $_html['url']?>" target="_blank"><?php echo $_html['url']?></a></dd>
					</dl>
				</div>
				
				<div class="newImgs">
					<h2>最新图片--<?php echo $_htmlnew['name'] ?></h2>
					<a href="photo_detail.php?id=<?php echo $_htmlnew['id']?>"><img src="thumb.php?filename=<?php echo $_htmlnew['url']?>&percent=0.4" alt="<?php echo $_htmlnew['name']?>" /></a>
				</div>
			</div>
			
			<div id="list" class="list">
				    <h2>帖子列表</h2>
				    <a href="post.php" class="post">发表帖子</a>
					<ul class="article">
						<?php
						     $_htmllist = array();
			                 while($_rows = mysql_fetch_array($results,MYSQL_ASSOC)){
			                    $_htmllist['id'] = $_rows['dg_id'];
								$_htmllist['type'] = $_rows['dg_type'];
								$_htmllist['readcount'] = $_rows['dg_readcount'];
								$_htmllist['commendcount'] = $_rows['dg_commendcount'];
								$_htmllist['title'] = $_rows['dg_title'];
								$_htmllist = _html($_htmllist);
								echo '<li class="icon'.$_htmllist['type'].'"><em>阅读数(<strong>'.$_htmllist['readcount'].'</strong>) 评论数(<strong>'.$_htmllist['commendcount'].'</strong>)</em> <a href="article.php?id='.$_htmllist['id'].'">'.$_htmllist['title'].'</a></li>';	
			                 };
					    ?>
					      
					</ul>
					<?php
					  //分页
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