window.onload=function(){
	//弹出选择头像窗口
	var faceImg = document.getElementById('faceImg');
	faceImg.onclick=function(){
		var a = window.open('face.php','face','width=400,height=400,top=0,left=0,scrollbars=1');
	}
	
	//刷新验证码
	var yzmImg = document.getElementById('yzmimg');
	yzmImg.onclick=function(){
		this.src = 'code.php?tm='+Math.random();
	}
	
	//表单验证
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
		//验证密码不同
		if(form.pass.value != form.notpass.value){
			alert('密码不一致');
			form.notpass.value = '';
			form.notpass.focus();
			return false;
		}
		
		//密码提示验证
		if(form.question.value.length < 2 || form.question.value.length > 20){
			alert('密码提示必须大于2位和小于20位');
			form.question.value = '';
			form.question.focus();
			return false;
		}
		//密码回答验证
		if(form.answer.value.length < 2 || form.answer.value.length > 20){
			alert('密码提示必须大于2位和小于20位');
			form.answer.value = '';
			form.answer.focus();
			return false;
		}
		//验证question 和 answer 不能一致
		if(form.question.value == form.answer.value){
			alert('密码提示与回答不得相同');
			form.answer.value = '';
			form.answer.focus();
			return false;
		}
		//邮箱验证
		if(!/^[\w\_\.]+@[\w\_\.]+(\.\w+)+$/.test(form.email.value)){
			alert('邮箱格式不正确');
			form.email.value = '';
			form.email.focus();
			return false;
		}
		//qq验证
		if(form.qq.value != ''){
			if(!/^[1-9]{1}[\d]{4,9}$/.test(form.qq.value)){
				alert('qq号格式不正确');
				form.qq.value = '';
				form.qq.focus();
				return false;
			}
		}
		
		//网址验证
		if(form.url.value != ''){
			if(!/^https?:\/\/(\w+\.)?[\w\-\.]+(\.\w+)+$/.test(form.url.value)){
				alert('网址号格式不正确');
				form.url.value = '';
				form.url.focus();
				return false;
			}
		}
		
		
		
		
		return true;
	}
	
	
}
