/* Quote & Reply */
function insertStr(string){	
	var textBox = document.getElementById('comment');
	if (document.selection){
		textBox.focus();
		sel = document.selection.createRange();
		sel.text = string;
	} else if (textBox.selectionStart != 'undefined' && textBox.selectionEnd != 'undefined'){
		var startPos = textBox.selectionStart;
			endPos = textBox.selectionEnd;
		textBox.value = textBox.value.substring(0, startPos) + string + textBox.value.substring(endPos, textBox.value.length);
	} else {
		textBox.value += string;
	}
	textBox.focus();
}

function reply(object){
	 var replyID = object.attr('id');
	 	 replyName = object.attr('title');
	 	 
	 var string = '<a href="#' + replyID + '">@' + replyName.replace(/\t|\n|\r\n/g, "") + '</a> \n';
	 insertStr(string);
}

function quote(author,commentID,commentBody){
	var authorID = author.attr('id');
		authorName = author.attr('title');
		commentBodyID = commentBody.attr('id');
		comment = commentBody.html();
	
	var string = '<blockquote cite="#' + commentBodyID + '">';
		string += '\n<strong><a href="#' + commentID + '">' + authorName.replace(/\t|\n|\r\n/g, "") + '</a> :</strong>';
		string += comment.replace(/\t/g, "");
		string += '</blockquote>\n';
		
		insertStr(string);
}

function replyAction(){
	jQuery('.comment-reply-link').click(function(){
		var author = jQuery(this).parent().parent().children('.author');
		reply(author);
	});
	jQuery('#cancel-comment-reply-link').click(function(){
		jQuery('#comment').val('');
	});
}

jQuery(document).ready(function($){
	$('.comment-quote-link').click(function(){
		var author = $(this).parent().parent().children('.author');
		var commentID = $(this).parent().parent().parent().attr('id');
		var commentBody = $(this).parent().parent().next();
		quote(author,commentID,commentBody);
	});
	var mouseover_tid = [];
	var mouseout_tid = [];
	/* Comment Tooltip */
	$('li.comment .comment-meta .function a').each(function(index){
			$(this).hover(
				function(){
					var _self = this;
					clearTimeout(mouseout_tid[index]);
					mouseover_tid[index] = setTimeout(function() {
						$(_self).animate({width: 35},100);
					}, 200);
				},
				function(){
					var _self = this;
					clearTimeout(mouseover_tid[index]);
					mouseout_tid[index] = setTimeout(function() {
						$(_self).animate({width: 0},100);
					}, 200);
				}
	
			);
		});
});