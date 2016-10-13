window.onload = function(){
	
	//选择头像
	var faces = document.getElementById('face');
	var face = faces.getElementsByTagName('img');
	
	for(var i=0;i<face.length;i++){
		face[i].onclick=function(){
		
	
		_opener(this.alt);
	}
	}
	
	

	
	function _opener(src) {
		//opener表示父窗口.document表示文档
		opener.document.getElementsByTagName('form')[0].content.value += '[img]'+src+'[/img]';
	}
	
	
	
}