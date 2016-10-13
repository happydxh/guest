<?php

//定义一个常量，用来授权includes里面的文件
define('IN_TG',true);
//定义个常量，用来指定本页的内容
define('SCRIPT','q');

//引入公共文件
require dirname(__FILE__).'/includes/common.inc.php';//转换为硬路径，速度更快
//初始化
if(isset($_GET['num']) && $_GET['path']){
	if(!is_dir(ROOT_PATH.$_GET['path'])){
		_alert_back('非法操作');
	}
}else{
	_alert_back('非法操作');
}
	
?>

<!DOCTYPE html>
<html>
	<head>
		<link rel="shortcut icon" href="favicon.ico" />
		<link rel="stylesheet" type="text/css" href="css/1/basic.css"/>
		<link rel="stylesheet" type="text/css" href="css/1/face.css"/>
		<meta charset="UTF-8">
		<title><?php echo $_system['webname']; ?></title>
		<script src="js/qopeners.js" type="text/javascript" charset="utf-8"></script>
	</head>
	<body>
		<div id="face">
			<h3>选择贴图</h3>
			<ul>
				<?php
				   foreach(range(1, $_GET['num']) as $num){?>
				   	  <li><img style="cursor: pointer;" src="<?php echo $_GET['path'].$num ?>.gif" alt="<?php echo $_GET['path'].$num ?>.gif" title="头像<?php echo $num?>"/></li>
				 <?php } ?>
			
			</ul>
			
		</div>
	</body>
</html>