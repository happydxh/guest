<?php

	//防止恶意调用
	if (!defined('IN_TG')) {
		exit('Access Defined!');
	}
	
	//检查函数是否存在
	if (!function_exists('_alert_back')) {
	   exit('_alert_back()函数不存在，请检查!');
    }
	
	/**
	 * _check_username表示检测并过滤用户名
	 * @access public 
	 * @param string $_string 受污染的用户名
	 * @param int $_min_num  最小位数
	 * @param int $_max_num 最大位数
	 * @return string  过滤后的用户名 
	 */
	 function _check_username($_string,$_min_num,$_max_num){
	 	//去掉两边的空格
	 	$_string = trim($_string);
		
		//长度小于两位或者大于20位
		if(mb_strlen($_string,'utf-8')<$_min_num || mb_strlen($_string,'utf-8')>$_max_num){
			_alert_back('长度不得小于'.$_min_num.'位或者大于'.$_max_num.'位');
		}
		
		//限制敏感字符
		$_char_pattern = '/[<>\'\"\ ]/';
		if(preg_match($_char_pattern, $_string)){
			_alert_back('用户名不得包含敏感字符');
		}
		
		
		return _mysql_string($_string);
		
		
	 }
	 
	  /**
	 * _check_password验证密码
	 * @access public
	 * @param string $_first_pass
	 * @param int $_min_num
	 * @return string $_first_pass 返回一个加密后的密码
	 */
	 function _check_password($_first_pass,$_num){
	 	if(strlen($_first_pass)<6){
	 		_alert_back('密码不得小于'.$_num.'位');
	 	}
		
		//对密码进行加密
		return _mysql_string(sha1($_first_pass));
	 }
	
	
	//设置cookie
	function _setcookie($username, $uniqid,$time){
		setcookie('uesrname',$username);
		setcookie('uniqid',$uniqid);
		switch($time){
			case '0'://浏览器进程
			      setcookie('username',$username);
		          setcookie('uniqid',$uniqid);
				  break;
			case '1':
				  setcookie('username',$username,time()+84600);
		          setcookie('uniqid',$uniqid,time()+84600);
				  break;
			case '2':
				  setcookie('username',$username,time()+84600*7);
		          setcookie('uniqid',$uniqid,time()+84600*7);
				  break;
			case '3':
				  setcookie('username',$username,time()+84600*30);
		          setcookie('uniqid',$uniqid,time()+84600*30);
				  break;
		}
	}
	
	
	
?>