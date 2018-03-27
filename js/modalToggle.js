function modalToggle(modalID, parentID) {
	if(parentID){
		$("#"+parentID).find("div#"+modalID).modal();
	}
	else{
		$('body').find("div#"+modalID).modal();
	}
	
}