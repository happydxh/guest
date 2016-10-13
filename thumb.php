<?php

	session_start();
	//定义个常量，用来授权调用includes里面的文件
	define('IN_TG',true);
	//定义个常量，用来指定本页的内容
	define('SCRIPT','thumb.php');
	//引入公共文件
	require dirname(__FILE__).'/includes/common.inc.php';
	
	//微缩图
	_thumb($_GET['filename'],$_GET['percent']);
?>