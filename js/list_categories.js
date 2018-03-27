function list_categories(json, data){
	var parent = data[0]; //Contenedor padre
	var successFunction = data[1]; //Función que se llamará al llenar el contenedor padre
	var clickButtonFunction = data[2]; //Función que se llamará al dar click al boton de más
	var clickRowFunction = data[3]; //Función que se llamará al dar click al renglón

	var tr, tr2, td, button;

	$(parent).load('tablesViews.html .containerCategories', function(){
		for(var i=0; i<json.length; i++){
			tr = document.createElement('tr');
			$(tr).attr('id', json[i].id).addClass('main');

			tr2 = document.createElement('tr');
			$(tr2).attr('id', json[i].id + '-' + json[i].id);
			$(tr2).addClass('myinvisible');

			$(tr).append("<td class='category'><span class='es'>"+ json[i].name_spa +"</span><span class='en hidden'>"+ json[i].name_eng +"</span></td>");
			//$(tr).append("<td class='button'></td>");
			//$(':last-child', tr).css({'width':'40', 'text-align':'center'}).append(createButtonPlus());

			$(tr).appendTo($('.containerCategories tbody', parent));

			$(tr2).append('<td colspan="2"></td>');
			$(tr2).appendTo($('.containerCategories tbody', parent));

			if(clickButtonFunction != null){
				$('button', tr).click(function(){
					clickButtonFunction($(this).parent().parent());
				});
			}

			if(clickRowFunction != null){
				$(tr).click(function(){
					clickRowFunction($(this));
				});
			}
		}

		if(successFunction != null){
			successFunction(json, parent);
		}
	});
}
