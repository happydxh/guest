window.onload = function(){
	//刷新验证码
	var yzmImg = document.getElementById('yzmimg');
	yzmImg.onclick=function(){
		this.src = 'code.php?tm='+Math.random();
	}
	
	//登录验证
	var form = document.getElementsByTagName('form')[0];
	form.onsubmit = function(){
		
		//验证user;
		if(form.user.value.length < 2 || form.user.value.length > 20){
			alert('用户名必须大于2位和小于20位');
			form.user.value = '';
			form.user.focus();
			return false;
		}
		if(/[<>\'\"\ ]/.test(form.user.value)){
			alert('用户名不得包含特殊字符');
			form.user.value = '';
			form.user.focus();
			return false;
		}
		
		//验证密码
		if(form.pass.value.length < 6){
			alert('密码不得小于六位');
			form.pass.value = '';
			form.pass.focus();
			return false;
		}
	
	
		
		return true;
	}
}
