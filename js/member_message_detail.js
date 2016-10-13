window.onload = function(){
	var rut = document.getElementById('return');
	var del = document.getElementById('delete');
	rut.onclick = function(){
		history.back();
	}
	del.onclick = function(){
		if(confirm('确定要删除此信息吗')){
			location.href = '?action=delete&id='+this.name;
		}
	}
}
