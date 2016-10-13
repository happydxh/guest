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
    //关闭
	mysql_close();

?>

        <footer id="footer">
        	<p>本程序执行耗时为:<?php echo round((_runtime()-$start_time),4) ?></p>
			<p>版权所有 翻版必究</p>
	        <p>本程序由<span>51Web俱乐部</span>提供 源代码可以任意修改或发布 (c) yc51.com</p>
		</footer>