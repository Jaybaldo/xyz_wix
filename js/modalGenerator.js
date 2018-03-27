function alertModal(divParent, message, id, redirectPage, clickFunction, dataClickFunction, buttonID ) {

	$(divParent).empty();

	var modal = document.createElement('div');
		$(modal).addClass('modal fade');
		$(modal).attr('id', id);
		$(modal).attr('role',"dialog");

	var modal_dialog = document.createElement('div');
		$(modal_dialog).addClass('modal-dialog');

	var modal_content = document.createElement('div');
		$(modal_content).addClass('modal-content');


	var modal_body = document.createElement('div');
		$(modal_body).addClass('modal-body');
		$(modal_body).append("<h4 id='modal_message'>"+message+"</h4>");


	var modal_footer = document.createElement('div');
		$(modal_footer).addClass('modal-footer');


	if(!(redirectPage == '0' && !clickFunction && !dataClickFunction && !buttonID)){
		var button = document.createElement('button');
		$(button).click(function () {
			console.log(redirectPage);
			if((redirectPage != '0') && !clickFunction && !dataClickFunction && !buttonID){
				window.location.href = redirectPage;
			}
			else if((redirectPage != '0') && clickFunction && !buttonID){
				clickFunction(dataClickFunction);
				window.location.href = redirectPage;

			}
			else if((redirectPage != '0') && clickFunction && buttonID){
				clickFunction(dataClickFunction);
				$('body').find('button#'+buttonID).remove();
				window.location.href=redirectPage;
			}
			else if(clickFunction && buttonID && (redirectPage == '0')){
				clickFunction(dataClickFunction);
				$('body').find('button#'+buttonID).remove();
			}
			else if(clickFunction && redirectPage == '0'){
				clickFunction(dataClickFunction);
			}
			else if(buttonID && (redirectPage != '0') && !clickFunction){
				$('body').find('button#'+buttonID).remove();
				window.location.href =redirectPage;
			}
		});

		$(button).addClass('btn btn-info');
		$(button).append('Aceptar');
		$(button).attr('data-dismiss', id);
		$(button).appendTo(modal_footer);

		var button2 = document.createElement('button');
			$(button2).addClass('btn btn-info');
			$(button2).attr('id', 'cancel_modal');
			$(button2).append('cancelar');
			$(button2).attr('data-dismiss', 'modal');
			$(button2).appendTo(modal_footer);
	}
	else if(redirectPage == '0'){
		var button2 = document.createElement('button');
			$(button2).addClass('btn btn-info');
			$(button2).append('cerrar');
			$(button2).attr('data-dismiss', 'modal');
			$(button2).appendTo(modal_footer);
	}



	$(modal_body).appendTo(modal_content);
	$(modal_footer).appendTo(modal_content);
	$(modal_content).appendTo(modal_dialog);
	$(modal_dialog).appendTo(modal);
	$(modal).appendTo(divParent);
}

function inputDescModal(divParent, message, redirectPage, clickFunction, dataClickFunction, buttonID ) {

	$(divParent).empty();

	var modal = document.createElement('div');
		$(modal).addClass('modal fade');
		$(modal).attr('id', 'modal');
		$(modal).attr('role',"dialog");

	var modal_dialog = document.createElement('div');
		$(modal_dialog).addClass('modal-dialog');

	var modal_content = document.createElement('div');
		$(modal_content).addClass('modal-content');


	var modal_body = document.createElement('div');
		$(modal_body).addClass('modal-body');
		$(modal_body).append("<h4 id='modal_message'>"+message+"</h4>");
		$(modal_body).append("<div class='row'><div class='col-xs-12 space-12'></div></div>");

		var form = document.createElement('form');
			$(form).attr('id','submitDesc');
			var row = document.createElement('div');
				$(row).addClass('row');
				var sur = document.createElement('div');
					$(sur).addClass('col-xs-11 col-xs-offset-1');
					var input_desc = document.createElement('textarea');
						$(input_desc).attr('type','text');
						$(input_desc).attr('id','desc');
						$(input_desc).attr('placeholder', 'Razon de acción');
						$(input_desc).addClass('col-xs-6');
						$(input_desc).css({'font-size':'.9em','widh':'100%'});
					$(input_desc).appendTo(sur);
				$(sur).appendTo(row);
			$(row).appendTo(form);
		$(form).appendTo(modal_body);

	var modal_footer = document.createElement('div');
		$(modal_footer).addClass('modal-footer');

	var button = document.createElement('button');
		if(clickFunction && !buttonID){
			$(button).click(function () {
				var user_input = $('body').find('textarea#desc').val();
				dataClickFunction.desc = user_input;
				clickFunction(dataClickFunction);
				setTimeout(function () {
					if((redirectPage != '0')){ window.location.href="http://devland.mx/uzy/index.html";}
				},2000);
			});
		}
		else if(buttonID){
			if(clickFunction){
				$(button).click(function () {
					var user_input = $('body').find('textarea#desc').val();
					dataClickFunction.desc = user_input;
					clickFunction(dataClickFunction);
					$('body').find('button#'+buttonID).remove();
					setTimeout(function () {
						if((redirectPage != '0')){ window.location.href="http://devland.mx/uzy/index.html";}
					},2000);

				});
			}
			else{
				$(button).click(function () {
					var user_input = $('body').find('textarea#desc').val();
					dataClickFunction.desc = user_input;
					clickFunction(dataClickFunction);
					setTimeout(function () {
						if((redirectPage != '0')){ window.location.href="http://devland.mx/uzy/index.html";}
					},2000);
				});
			}
		}

		$(button).addClass('btn btn-info');
		$(button).append('Enviar');
		$(button).attr('data-dismiss', 'modal');//has to redirect
		$(button).appendTo(modal_footer);



	var button2 = document.createElement('button');
		$(button2).addClass('btn btn-info');
		$(button2).attr('id', 'cancel_modal');
		$(button2).append('cancelar');
		$(button2).attr('data-dismiss', 'modal');
		$(button2).appendTo(modal_footer);


	$(modal_body).appendTo(modal_content);
	$(modal_footer).appendTo(modal_content);
	$(modal_content).appendTo(modal_dialog);
	$(modal_dialog).appendTo(modal);
	$(modal).appendTo(divParent);
}


function carTypeAssigner(divParent, message, redirectPage, clickFunction, dataClickFunction, buttonID ) {
	$(divParent).empty();

	var modal = document.createElement('div');
		$(modal).addClass('modal fade');
		$(modal).attr('id', 'modal');
		$(modal).attr('role',"dialog");

	var modal_dialog = document.createElement('div');
		$(modal_dialog).addClass('modal-dialog');

	var modal_content = document.createElement('div');
		$(modal_content).addClass('modal-content');


	var modal_body = document.createElement('div');
		$(modal_body).addClass('modal-body');
		$(modal_body).append("<h4 id='modal_message'>"+message+"</h4>");
		$(modal_body).append("<div class='row'><div class='col-xs-12 space-12'></div></div>");

		var form = document.createElement('form');
			$(form).attr('id','submitDesc');
			var row = document.createElement('div');
				$(row).addClass('row');
				$(row).attr('id','fareSelectors');
				var sur2 = document.createElement('div');
					$(sur2).addClass('col-xs-11 col-xs-offset-1');
					var select = document.createElement('select');
						$(select).attr('id', 'tipo');
						$(select).append("<option value='0'>Seleccione tipo</option>");
						$(select).append("<option value='UZY X'>UZY X</option>");
						$(select).append("<option value='UZY DELUXE'>UZY Deluxe</option>");
					$(select).appendTo(sur2);
				$(sur2).appendTo(row);

			$(row).appendTo(form);
		$(form).appendTo(modal_body);

	var modal_footer = document.createElement('div');
		$(modal_footer).addClass('modal-footer');

	var button = document.createElement('button');
		if(clickFunction){
			$(button).click(function () {

				var fareID = $('body').find('select#ciudad').val();
				var car_type = $('body').find('select#tipo').val();
				if(fareID != '0' && car_type != '0'){
					var idCar = $('body').find('div.carId').attr('id');
					var dataPHP = {'element':'car','fareID':fareID, 'car_type':car_type, 'id':idCar};
					updateStatus(dataPHP);
					if(redirectPage != '0'){
						window.location.href=redirectPage;
					}
				}
				else{
					$('body').find('div#err_msg').remove();
					$('body').find('div#fareSelectors').append("<div id='err_msg' class='col-xs-12 col-xs-offset-1 red'>Seleccione ciudad y tipo</div>");
				}
			});
		}

		$(button).addClass('btn btn-info');
		$(button).append('Enviar');

		$(button).appendTo(modal_footer);

	var button2 = document.createElement('button');
		$(button2).addClass('btn btn-info');
		$(button2).attr('id', 'cancel_modal');
		$(button2).append('cancelar');
		$(button2).attr('data-dismiss', 'modal');
		$(button2).appendTo(modal_footer);


	$(modal_body).appendTo(modal_content);
	$(modal_footer).appendTo(modal_content);
	$(modal_content).appendTo(modal_dialog);
	$(modal_dialog).appendTo(modal);
	$(modal).appendTo(divParent);
}
