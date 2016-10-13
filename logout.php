<?php
session_start();
//定义个常量，用来授权调用includes里面的文件
define('IN_TG',true);
//引入公共文件
require dirname(__FILE__).'/includes/common.inc.php';
setcookie('username','', time()-1);
setcookie('uniqid','', time()-1);
session_destroy();
header("Location:index.php");

	
	
?>