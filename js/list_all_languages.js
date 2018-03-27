function list_all_languages(json, data){
	var parent = data[0]; //Contenedor padre
	var successFunction = data[1]; //Función que se llamará al llenar el contenedor padre
	var clickButtonFunction = data[2]; //Función que se llamará al dar click al boton de más
	var clickRowFunction = data[3]; //Función que se llamará al dar click al renglón

	var tr, tr2, td, button;

	$(parent).load('tablesViews.html .containerLanguages', function(){
		for(var i=0; i<json.length; i++){
			tr = document.createElement('tr');
			$(tr).attr('id', json[i].id_lang).addClass('main');

			tr2 = document.createElement('tr');
			$(tr2).attr('id', json[i].id_lang + '-' + json[i].id_lang);
			$(tr2).addClass('myinvisible');

			$(tr).append("<td class='language'>" + json[i].lang_name + "</td>");
			$(tr).append("<td class='button'></td>");
			$(':last-child', tr).css({'width':'40', 'text-align':'center'}).append(createButtonPlus());

			$(tr).appendTo($('.containerLanguages tbody', parent));

			$(tr2).append('<td colspan="2"></td>');
			$(tr2).appendTo($('.containerLanguages tbody', parent));

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
