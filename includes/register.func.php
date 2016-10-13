<?php

	//防止恶意调用
	if (!defined('IN_TG')) {
		exit('Access Defined!');
	}
	
	//检查函数是否存在
	if (!function_exists('_alert_back')) {
	   exit('_alert_back()函数不存在，请检查!');
    }
	
	
	function _check_uniqid($_first_uniqid,$_end_uniqid) {
		
		if ($_first_uniqid != $_end_uniqid) {
			_alert_back('唯一标识符异常');
		}
		
		return _mysql_string($_first_uniqid);
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
		
		//限制敏感用户名
		$_mg[0] = '李彦宏';
		$_mg[1] = '马云';
		$_mg[2] = '周鸿祎';
		$_mg[3] = '马化腾';
		//限制敏感用户名
		//$_mg = explode(',',$_system['string']);
		//告诉用户，有哪些不能够注册
		foreach ($_mg as $value) {
			$_mg_string .= '[' . $value . ']' . '\n';
		}
		//这里采用的绝对匹配
		if (in_array($_string,$_mg)) {
			_alert_back($_mg_string.'以上敏感用户名不得注册');
		}
		
		return _mysql_string($_string);
		
		
	 }
	 
	 /**
	 * _check_password验证密码
	 * @access public
	 * @param string $_first_pass
	 * @param string $_end_pass
	 * @param int $_min_num
	 * @return string $_first_pass 返回一个加密后的密码
	 */
	 function _check_password($_first_pass,$_end_pass,$_num){
	 	if(strlen($_first_pass)<6){
	 		_alert_back('密码不得小于'.$_num.'位');
	 	}
		//判断密码是否一致
		if($_first_pass != $_end_pass){
			_alert_back('密码不一致');
		}
		
		//对密码进行加密
		return _mysql_string(sha1($_first_pass));
	 }
	 
	 function _check_modify_password($_first_pass,$_num){
	 	if(!empty($_first_pass)){
	 		if(strlen($_first_pass)<6){
		 		_alert_back('密码不得小于'.$_num.'位');
		 	}
	 	}else{
	 		return null;
	 	}
	 	
		
		//对密码进行加密
		return _mysql_string(sha1($_first_pass));
	 }
	 
	 /**
	 * _check_question 返回密码提示
	 * @access public
	 * @param string $_string
	 * @param int $_min_num
	 * @param int $_max_num
	 * @return string $_string 返回密码提示
	 */
	 function _check_question($_string,$_min_num,$_max_num){
	 	//长度小于两位或者大于20位
		if(mb_strlen($_string,'utf-8')<$_min_num || mb_strlen($_string,'utf-8')>$_max_num){
			_alert_back('长度不得小于'.$_min_num.'位或者大于'.$_max_num.'位');
		}
		
		return _mysql_string($_string);
	 }
	 
	 /**
	 *_check_answer()
	 *@access public 
	 * @param string $_ques
	 * @param string $_answ
	 * @param int $_min_num
	 * @param int $_max_num
	 * @return $_answ
	 */
	 function _check_answer($ques,$ans,$min_num,$max_num){
	 	if(mb_strlen($ans,'utf-8')<$min_num || mb_strlen($ans,'utf-8')>$max_num){
	 		_alert_back('密码回答不得小于'.$min_num.'位和不得大于'.$max_num.'位');
	 	}
		
		if($ques == $ans){
			_alert_back('密码提示和回答不得相同');
		}
		
		//密码加密
		return _mysql_string(sha1($ans));
	 }
	 
	 /**
	 * _check_email() 检查邮箱是否合法
	 * @access public
	 * @param string $_string 提交的邮箱地址
	 * @return string $_string 验证后的邮箱
	 */
	 function _check_email($_string){
	 	
	 		if(!preg_match('/^[\w\_\.]+@[\w\_\.]+(\.\w+)+$/', $_string)){
	 			_alert_back('邮箱格式不正确');
	 		}
	 
		return _mysql_string($_string);
	 }
	 
	 /**
	 * _check_qq ....
	 * @access public
	 * @param int $_string
	 * @return int $_string  QQ号码
	 */
	 function _check_qq($_string){
	 	if(empty($_string)){
	 		return null;
	 	}else{
	 		if(!preg_match('/^[1-9]{1}[\d]{4,9}$/', $_string)){
	 			_alert_back('QQ号格式不正确');
	 		}
	 	}
		return _mysql_string($_string);
	 }
	 
	 function _check_url($_string){
	 	if(empty($_string)){
	 		return null;
	 	}else{
	 		if(!preg_match('/^https?:\/\/(\w+\.)?[\w\-\.]+(\.\w+)+$/', $_string)){
	 			_alert_back('网址号格式不正确');
	 		}
	 	}
		return _mysql_string($_string);
	 }
	 
	 function _check_content($_string) {
		if (mb_strlen($_string,'utf-8') < 10 || mb_strlen($_string,'utf-8') > 200) {
			_alert_back('短信内容不得小于10位或者大于200位！');
		}
		return $_string;
	}
	 
	function _check_post_title($_string,$_min,$_max){
		if (mb_strlen($_string,'utf-8') < $_min || mb_strlen($_string,'utf-8') > $_max) {
			_alert_back('发帖标题不得小于'.$_min.'位或者大'.$_max.'位！');
		}
		return $_string;
	}
	
	function _check_post_content($_string,$_num){
		if (mb_strlen($_string,'utf-8') < $_num) {
			_alert_back('帖子内容不得小于'.$_num.'位！');
		}
		return $_string;
	}
	
	function _check_dir_name($_string,$_min,$_max) {
		if (mb_strlen($_string,'utf-8') < $_min || mb_strlen($_string,'utf-8') > $_max ) {
			_alert_back('名称不得小于'.$_min.'位或者不能大于'.$_max.'位！');
		}
		return $_string;
	}
	
	function _check_dir_password($_string,$_num) {
		if (strlen($_string) < $_num) {
			_alert_back('密码不得小于'.$_num.'位！');
		}
		return sha1($_string);
	}
	
	function _check_photo_url($_string) {
		if (empty($_string)) {
			_alert_back('地址不能为空！');
		}
		return $_string;
	}
		
	
?>