<?php
session_start();
//定义个常量，用来授权调用includes里面的文件
define('IN_TG',true);
//定义个常量，用来指定本页的内容
define('SCRIPT','manage');
//引入公共文件
require dirname(__FILE__).'/includes/common.inc.php';

if ((!isset($_COOKIE['username'])) || (!isset($_SESSION['admin']))) {
		_alert_back('非法登录！');
	}



//修改数据
if($_GET['action'] == 'set'){
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
	//引入验证文件
	include ROOT_PATH.'includes/register.func.php';
	//创建一个空数组，用来存放提交过来的合法数据
	$_clean = array();
	$_clean['webname']= $_POST['webname'];
	$_clean['article']= $_POST['article'];
	$_clean['blog']= $_POST['blog'];
	$_clean['photo']= $_POST['photo'];
	$_clean['skin']= $_POST['skin'];
	$_clean['string']= $_POST['string'];
	$_clean['post']= $_POST['post'];
	$_clean['re']= $_POST['re'];
	$_clean['code']= $_POST['code'];
	$_clean['register']= $_POST['register'];
	$_clean = _mysql_string($_clean);
	//修改资料
	mysql_query("UPDATE tg_system SET 
		                                dg_webname ='{$_clean['webname']}',
		                                dg_article = '{$_clean['article']}',
		                                dg_blog = '{$_clean['blog']}',
		                                dg_photo = '{$_clean['photo']}',
		                                dg_skin = '{$_clean['skin']}',
		                                dg_string = '{$_clean['string']}',
		                                dg_post='{$_clean['post']}',
										dg_re='{$_clean['re']}',
		                                dg_code = '{$_clean['code']}',
		                                dg_register = '{$_clean['register']}'
                                WHERE
                                        dg_id = 1
                                LIMIT
                                        1
                                 
	            ") or die('SQL执行错误'.mysql_error()) ;
	
	}
	
	//判断是否修改成功
	if(mysql_affected_rows() == 1){
		mysql_close();
		//session_destroy();
	    _location('恭喜你，修改成功!','manage_set.php');
	}else{
		mysql_close();
		//session_destroy();
		 _location('很遗憾，没有任何数据被修改！','manage_set.php');
	}
	
	
}



//获取数据
$_query = mysql_query("   SELECT 
                                    dg_webname,
									dg_article,
									dg_blog,
									dg_photo,
									dg_skin,
									dg_string,
									dg_post,
									dg_re,
									dg_code,
									dg_register 
                            FROM 
                                    tg_system 
                           WHERE
                                    dg_id=1
                           LIMIT
                                 1
                      ");

if($_rows = mysql_fetch_array($_query,MYSQL_ASSOC)){
	$_html = array();
	$_html['webname'] = $_rows['dg_webname'];
	$_html['article'] = $_rows['dg_article'];
	$_html['blog'] = $_rows['dg_blog'];
	$_html['photo'] = $_rows['dg_photo'];
	$_html['skin'] = $_rows['dg_skin'];
	$_html['string'] = $_rows['dg_string'];
	$_html['post'] = $_rows['dg_post'];
	$_html['re'] = $_rows['dg_re'];
	$_html['register'] = $_rows['dg_register'];
	$_html['code'] = $_rows['dg_code'];
	$_html = _html($_html);
	
	//文章
	if($_html['article'] == 10){
		$_html['article_html'] = '<select name="article">
		                             <option value="10"  selected="selected" >每页10篇</option>
		                             <option value="15" >每页15篇</option>
		                          </select>';
	}elseif($_html['article'] == 15){
		$_html['article_html'] = '<select name="article">
		                             <option value="10"   >每页10篇</option>
		                             <option value="15" selected="selected">每页15篇</option>
		                          </select>';
	}
	
	//博文
	if($_html['blog'] == 15){
		$_html['blog_html'] = '<select name="blog">
		                             <option value="15"  selected="selected" >每页15篇</option>
		                             <option value="20" >每页20篇</option>
		                          </select>';
	}elseif($_html['blog'] == 20){
		$_html['blog_html'] = '<select name="blog">
		                             <option value="15"   >每页15篇</option>
		                             <option value="20" selected="selected">每页20篇</option>
		                          </select>';
	}
    
	//相册
	if ($_html['photo'] == 8) {
		$_html['photo_html'] = '<select name="photo">
		                             <option value="8" selected="selected">每页8张</option>
		                             <option value="12">每页12张</option>
		                        </select>';
	} elseif ($_html['photo'] == 12) {
		$_html['photo_html'] = '<select name="photo">
		                             <option value="8">每页8张</option>
		                             <option value="12" selected="selected">每页12张</option>
		                         </select>';
	}
	
	//皮肤
	if ($_html['skin'] == 1) {
		$_html['skin_html'] = '<select name="skin">
		                            <option value="1" selected="selected">一号皮肤</option>
		                            <option value="2">二号皮肤</option>
		                            <option value="3">三号皮肤</option>
		                        </select>';
	} elseif ($_html['skin'] == 2) {
		$_html['skin_html'] = '<select name="skin">
		                            <option value="1">一号皮肤</option>
		                            <option value="2" selected="selected">二号皮肤</option>
		                            <option value="3">三号皮肤</option>
		                        </select>';
	} elseif ($_html['skin'] == 3) {
		$_html['skin_html'] = '<select name="skin">
		                             <option value="1">一号皮肤</option>
		                             <option value="2">二号皮肤</option>
		                             <option value="3" selected="selected">三号皮肤</option>
		                        </select>';
	}
	
	//发帖
	if ($_html['post'] == 30) {
		$_html['post_html'] = '<input type="radio" name="post" value="30" checked="checked" /> 30秒 
		                       <input type="radio" name="post" value="60" /> 1分钟 
		                       <input type="radio" name="post" value="180" /> 3分钟';
	} elseif ($_html['post'] == 60) {
		$_html['post_html'] = '<input type="radio" name="post" value="30" /> 30秒 
		                       <input type="radio" name="post" value="60" checked="checked" /> 1分钟
		                       <input type="radio" name="post" value="180" /> 3分钟';
	} elseif ($_html['post'] == 180) {
		$_html['post_html'] = '<input type="radio" name="post" value="30" /> 30秒
		                       <input type="radio" name="post" value="60" /> 1分钟 
		                       <input type="radio" name="post" value="180" checked="checked" /> 3分钟';
	}
	
	//回帖
	if ($_html['re'] == 15) {
		$_html['re_html'] = '<input type="radio" name="re" value="15" checked="checked" /> 15秒
		                     <input type="radio" name="re" value="30" /> 30秒 
		                     <input type="radio" name="re" value="45" /> 45秒';
	} elseif ($_html['re'] == 30) {
		$_html['re_html'] = '<input type="radio" name="re" value="15" /> 15秒
		                     <input type="radio" name="re" value="30" checked="checked" /> 30秒
		                     <input type="radio" name="re" value="45" /> 45秒';
	} elseif ($_html['re'] == 45) {
		$_html['re_html'] = '<input type="radio" name="re" value="15" /> 15秒
		                     <input type="radio" name="re" value="30" /> 30秒 
		                     <input type="radio" name="re" value="45" checked="checked" /> 45秒';
	}
	
	//验证码
	if ($_html['code'] == 1) {
		$_html['code_html'] =  '<input type="radio" name="code" value="1" checked="checked" /> 启用 
		                        <input type="radio" name="code" value="0" /> 禁用';
	} else {
		$_html['code_html'] =  '<input type="radio" name="code" value="1" /> 启用 
		                        <input type="radio" name="code" value="0" checked="checked"  /> 禁用';
	}
	
	//放开注册
	if ($_html['register'] == 1) {
		$_html['register_html'] =  '<input type="radio" name="register" value="1" checked="checked" /> 启用
		                            <input type="radio" name="register" value="0" /> 禁用';
	} else {
		$_html['register_html'] =  '<input type="radio" name="register" value="1" /> 启用 
		                            <input type="radio" name="register" value="0" checked="checked" /> 禁用';
	}
	
	
}else{
	_alert_back('系统表读取错误！请联系管理员检查！');
}	

?>
<!DOCTYPE html>
<html>
	<head>
		<link rel="shortcut icon" href="favicon.ico" />
		<link rel="stylesheet" type="text/css" href="css/1/basic.css"/>
		<link rel="stylesheet" type="text/css" href="css/1/member.css"/>
		<link rel="stylesheet" type="text/css" href="css/1/manage_set.css"/>
		<meta charset="UTF-8">
		<title>后台管理中心</title>
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
					<dd><a href="manage.php">后台首页</a></dd>
					<dd><a href="manage_set.php" style="background: #CCCCCC;">系统设置</a></dd>
				</dl>
				<dl>
					<dt>会员管理</dt>
					<dd><a href="manage_member.php">会员列表</a></dd>
					<dd><a href="manage_job.php">职务设置</a></dd>
				</dl>
			</div>
			
			<div id="member_main">
				<h2>后台管理中心</h2>
				<form method="post" action="?action=set" >
				<dl>
					<dd>·网 站 名 称：<input type="text" name="webname" class="text" value="<?php echo $_html['webname'];?>" /></dd>
					<dd>·文章每页列表数：<?php echo $_html['article_html'];?></dd>
					<dd>·博客每页列表数：<?php echo $_html['blog_html'];?></dd>
					<dd>·相册每页列表数：<?php echo $_html['photo_html'];?></dd>
					<dd>·站点 默认 皮肤：<?php echo $_html['skin_html'];?></dd>
					<dd>·非法 字符 过滤：<input type="text" name="string" class="text" value="<?php echo $_html['string'];?>" /> (*请用,线隔开)</dd>
					<dd>·每次 发帖 限制：<?php echo $_html['post_html'];?></dd>
					<dd>·每次 回帖 限制：<?php echo $_html['re_html'];?></dd>
					<dd>·是否 启用 验证：<?php echo $_html['code_html'];?></dd>
					<dd>·是否 开放 注册：<?php echo $_html['register_html'];?></dd>
					<dd><input type="submit" value="修改系统设置" class="submit" /></dd>
				</dl>
				</form>
			</div>
		</div>
		
		<!--footer-->
		<?php
		   require ROOT_PATH.'includes/footer.inc.php';
		?>
	</body>
</html>