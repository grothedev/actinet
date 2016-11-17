function renderCommentTree(comment){
	comment = comment.replace(/&quot;/g, '"'); //fixing string formatting
	
	comment = JSON.parse(comment);
	comment = comment[Object.keys(comment)[0]]; //fixing the object
	
	renderTree(comment);

}

function renderTree(comment){

	if (comment.children.length == 0){
		document.write('<li>' + comment.text + '</li>');
	} else {
		document.write('<li>' + comment.text);
		document.write('<ul>');

		for (i = 0; i < comment.children.length; i++){
			renderTree(comment.children[i]);
		}

		document.write('</ul></li>');

	}
}