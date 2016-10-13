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
//防止恶意调用
if (!defined('IN_TG')) {
	exit('Access Defined!');
}


?>

        <header id="header">
			<h1><a href="index.php">瓢城Web俱乐部多用户留言系统</a></h1>
			<ul>
				<li><a href="index.php">首页</a></li>
				<?php 
					if (isset($_COOKIE['username'])){
						echo '<li><a href="member.php">'.$_COOKIE['username'].'•个人中心 </a>'.$GLOBALS['message'].'</li>';
						echo "\n";
					} else {	
						echo '<li><a href="register.php">注册</a></li>';
						echo "\n";
						echo "\t\t";
						echo '<li><a href="login.php">登录</a></li>';
						echo "\n";
					}
				?>
				<li><a href="blog.php">博友</a></li>
				<li><a href="photo.php">相册</a></li>
				<li><a href="#">风格</a></li>
				
				<?php
				   if (isset($_COOKIE['username']) && isset($_SESSION['admin'])) {
						echo '<li><a href="manage.php" class="manage" style = "color:red;">后台管理</a></li> ';
					}
			       if(isset($_COOKIE['username'])){
			       	echo ' <li><a href="logout.php">退出</a></li>';
			       }
			
				?>
				
			</ul>
		</header>