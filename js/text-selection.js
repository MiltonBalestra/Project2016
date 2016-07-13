//{ Gestisce la selezione del testo (effettuando modifiche alla selezione) per la creazione di annotazioni
function Highlight(){
	var selection = window.getSelection();
	if (selection && selection != ""){
		selectedRange = selection.getRangeAt(0);
		changeSelection(selection);
	}
}

//cambia la selezione e restituisce i nodi selezionati
function changeSelection(selection){
	var range = selection.getRangeAt(0);
	var start = range.startContainer;
	var end = range.endContainer;
	var ancestor = range.commonAncestorContainer;
	
	//se selezioni pi� paragrafi -> ANNULLARE l'intera selezione
	if(ancestor.id == "paperdiv"){
		selection.removeAllRanges();
		return;
	}
	
	//se la selezione parte o finisce da elementi con queste classi -> ANNULLARE l'intera selezione
	var ignore = ["cgen", "title", "author_name", "email", "lead authors", "keywords", "acm_subject_categories"];
	for (var i = 0; i < ignore.length; i++)
		if (start.parentNode.className.indexOf(ignore[i]) > -1 || end.parentNode.className.indexOf(ignore[i]) > -1) {
			selection.removeAllRanges();
			return;
		}
	
	if (start.parentNode == end.parentNode) //se hanno entrambi i nodi lo stesso padre
		return;
	else if (ancestor == start.parentNode){ //il padre � lo start
		while (end.parentNode != start.parentNode)
			end = end.parentNode;
		addSelection(selection, end);
	}
	else if (ancestor == end.parentNode){ //il padre � l'end
		while (start.parentNode != end.parentNode)
			start = start.parentNode;
		addSelection(selection, start);
	}
	else if (start.parentNode != end.parentNode){
		selection.removeAllRanges();
		addSelection(selection, ancestor);
	}
}

//aggiunge nodi alla selezione
function addSelection(selection, node){
	var range = document.createRange();
	range.selectNodeContents(node);
	selection.addRange(range);
	
	selectedRange = selection.getRangeAt(0); //aggiorna il range selezionato
}
//}
