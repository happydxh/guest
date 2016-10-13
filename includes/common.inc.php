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
//设置编码格式
header('Content-Type:text/html; charset=utf-8');

//防止恶意调用
if (!defined('IN_TG')) {
	exit('Access Defined!');
}

//转换硬路径常量
define('ROOT_PATH',substr(dirname(__FILE__),0,-8));

//创建一个自动转义状态的常量
define('GPC', get_magic_quotes_gpc());

//拒绝PHP低版本
if (PHP_VERSION < '4.1.0') {
	exit('Version is to Low!');
}

//引入全局函数
require ROOT_PATH.'includes/global.func.php';

//执行耗时
$start_time = _runtime();

//链接数据库
define('DB_HOST','localhost');
define('DB_USER','root');
define('DB_PWD','123456');
define('DB_NAME','guest');

//创建数据库链接
$_conn = @mysql_connect(DB_HOST,DB_USER,DB_PWD) or die('数据库链接失败');

//选择一个数据库
mysql_select_db(DB_NAME) or die('指定的数据库不存在');

//选择字符集
mysql_query('SET NAMES UTF8') or die('字符集错误');

//消息提醒
$_query = mysql_query("  SELECT 
                                 COUNT(dg_id) 
                             AS 
                                 count
                           FROM 
                                 tg_message WHERE dg_state = 0 
                            AND 
                                 dg_touser = '{$_COOKIE['username']}' 
                       ");
$_rows = mysql_fetch_array($_query,MYSQL_ASSOC);
if(empty($_rows['count'])){
	$_GLOBALS['message'] = '<strong class="noread"><a href="member_message.php">(0)</a></strong>';
}else{
	$GLOBALS['message'] = '<strong class="read"><a href="member_message.php">('.$_rows['count'].')</a></strong>';
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
	$_system = array();
	$_system['webname'] = $_rows['dg_webname'];
	$_system['article'] = $_rows['dg_article'];
	$_system['blog'] = $_rows['dg_blog'];
	$_system['photo'] = $_rows['dg_photo'];
	$_system['skin'] = $_rows['dg_skin'];
	$_system['string'] = $_rows['dg_string'];
	$_system['post'] = $_rows['dg_post'];
	$_system['re'] = $_rows['dg_re'];
	$_system['code'] = $_rows['dg_code'];
	$_system['register'] = $_rows['dg_register'];
	$_system = _html($_system);
	

	
	
}else{
	_alert_back('系统表读取错误！请联系管理员检查！');
}	


?>