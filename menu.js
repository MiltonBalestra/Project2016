//funzione per selezionare il testo
function getSelectionText() {	
	var iframe= document.getElementById('article');
	alert(iframe.contentWindow.getSelection().toString());
	
	if (window.getSelection != null) {
		text = window.getSelection().toString();
	} else if (document.selection && document.selection.type != "Control") {
		text = document.selection;
	}
	
	/*	
	if (document.selection)
		alert(document.selection.createRange().parentElement());
    	return document.selection.createRange().parentElement();
    else
    {
    	var selection = window.getSelection();
    	if (selection.rangeCount > 0){
			alert(selection.getRangeAt(0).startContainer.parentNode);
    		return selection.getRangeAt(0).startContainer.parentNode;
		}
    }*/
	return text;
}
function Highlight(){
	//var currSelection = document.getElementById('article').contentWindow.getSelection();
	var currSelection = window.getSelection();
	if (currSelection) {
		var currSelection = window.getSelection();
		var start = currSelection.getRangeAt(0).startContainer.parentNode;
		var end = currSelection.getRangeAt(0).endContainer.parentNode;
		var ancestor = currSelection.getRangeAt(0).commonAncestorContainer;
		//alert(currSelection);
		//alert(start);
		//alert(end);
		//alert(ancestor.innerHTML);
		//alert(currSelection.getRangeAt(0).startOffset);
		//alert(currSelection.getRangeAt(0).endOffset);
		
		if (start.innerHTML == end.innerHTML)
			b = true;
		else if (ancestor.innerHTML == start.innerHTML) //il padre è lo start
		{
			//alert("b");
			while (end.parentNode != start)
				end = end.parentNode;
			
			var range = document.createRange();
			range.selectNodeContents(end);
			currSelection.addRange(range);
		}
		else if (ancestor.innerHTML == end.innerHTML) {//il padre è l'end
			//alert("c");
			while (start.parentNode != end)
				start = end.parentNode;
			
			var range = document.createRange();
			range.selectNodeContents(start);
			currSelection.addRange(range);
		}
		else
		{
			//alert("d");
			var range = document.createRange();
			range.selectNodeContents(ancestor);
			currSelection.removeAllRanges();
			currSelection.addRange(range);
		}
	} else {
		alert ("Your browser does not support this example!");
	}
}
document.onmouseup = Highlight;
/* BOX SOPRA TESTO
$('div').on('activate', function() {
	$(this).empty();
	var range, sel;
	if ( (sel = document.selection) && document.body.createTextRange) {
		range = document.body.createTextRange();
		range.moveToElementText(this);
		range.select();
	}
});
$('div').focus(function() {	
	if (this.hasChildNodes() && document.createRange && window.getSelection) {
		$(this).empty();
		var range, sel;
		range = document.createRange();
		range.selectNodeContents(this);
		sel = window.getSelection();
		sel.removeAllRanges();
		sel.addRange(range);
	}
});
*/
/* TROVA ID BY CLICK
$(document).on('click','*',function (e) {
	var tag = this.tagName;
	var id = $(tag).attr('id');  // it now works
	alert('#'+id);
	$('#'+id).attr('class', 'comment');
});
*/
function createAnnotation() {
	$.ajax({
	   url: 'insert.php',
	   success: function (response) 
	   {
		 alert(response);
	   }
	});
} 