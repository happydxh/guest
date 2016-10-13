window.onload = function(){
	
	//选择头像
	var faces = document.getElementById('face');
	var face = faces.getElementsByTagName('img');
	
	for(var i=0;i<face.length;i++){
		face[i].onclick=function(){
		
		links(this.src);
		
		attrs(this.alt);
		
	}
	}
	
	
	function links(src){
		var faceImage = opener.document.getElementById('faceImg');
		faceImage.src = src;
	}
	
	//将alt传入input
	function attrs(alt){
		var inputImage = opener.document.getElementById('imputImg');
		inputImage.value = alt;
	}
	

	
	
	
}
