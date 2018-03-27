function createButtonPlus(){
	var icon;
	var button;

	icon = document.createElement('i');
	$(icon).addClass("ace-icon fa fa-plus-square");
	$(icon).css("color","#686873");

	button = document.createElement('button');
	$(button).css({'padding':'0', 'width':'30', 'text-align':'center'});
	$(button).append(icon);

	return button;
}