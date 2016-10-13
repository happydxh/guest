window.onload = function(){
		//刷新验证码
		var yzmImg = document.getElementById('code');
		yzmImg.onclick=function(){
			this.src = 'code.php?tm='+Math.random();
		}
		
		//表单验证
		var form = document.getElementsByTagName('form')[0];
		form.onsubmit = function(){
			
			//验证密码
			if(form.pass.value.length != ''){
				if(form.pass.value.length < 6){
					alert('密码不得小于六位');
					form.pass.value = '';
					form.pass.focus();
					return false;
				}
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
