function vote(pId, value){
	$.get('/vote?pId=' + pId + '&value=' + value);
}