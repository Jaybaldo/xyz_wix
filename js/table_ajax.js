function ajax_user(dataPHP, successFunction, dataSuccessFunction){
	$.ajax({
		'type':"POST",
		'dataType':"json",
		'url':'php/user.php',
		'data':dataPHP,

		success: function(json){
			if(successFunction != null){
				successFunction(json, dataSuccessFunction);
			}
		}
	});
}

function ajax_activity(dataPHP, successFunction, dataSuccessFunction){
	$.ajax({
		'type':"POST",
		'dataType':"json",
		'url':'php/activity.php',
		'data':dataPHP,

		success: function(json){
			if(successFunction != null){
				successFunction(json, dataSuccessFunction);
			}
		}
	});
}

function ajax_sale_activity(dataPHP, successFunction, dataSuccessFunction){
	$.ajax({
		'type':"POST",
		'dataType':"json",
		'url':'php/sale_activity.php',
		'data':dataPHP,

		success: function(json){
			if(successFunction != null){
				successFunction(json, dataSuccessFunction);
			}
		}
	});
}

function ajax_city(dataPHP, successFunction, dataSuccessFunction){
	$.ajax({
		'type':"POST",
		'dataType':"json",
		'url':'php/city.php',
		'data':dataPHP,

		success: function(json){
			if(successFunction != null){
				successFunction(json, dataSuccessFunction);
			}
		}
	});
}

function ajax_category(dataPHP, successFunction, dataSuccessFunction){
	$.ajax({
		'type':"POST",
		'dataType':"json",
		'url':'php/category.php',
		'data':dataPHP,

		success: function(json){
			if(successFunction != null){
				successFunction(json, dataSuccessFunction);
			}
		}
	});
}

function ajax_images(dataPHP, successFunction, dataSuccessFunction){
	$.ajax({
		'url': 'php/images.php',
    	'data': dataPHP,
    	'cache': false,
    	'contentType': false,
    	'processData': false,
    	'method': 'POST',

		success: function(json){
			if(successFunction != null){
				successFunction(json, dataSuccessFunction);
			}
		}
	});
}

function ajax_images_info(dataPHP, successFunction, dataSuccessFunction){
	$.ajax({
		'type':"POST",
		'dataType':"json",
		'url':'php/images.php',
		'data':dataPHP,

		success: function(json){
			if(successFunction != null){
				successFunction(json, dataSuccessFunction);
			}
		}
	});
}

function ajax_status(dataPHP, successFunction, dataSuccessFunction){
	$.ajax({
		'type':"POST",
		'dataType':"json",
		'url':'php/status.php',
		'data':dataPHP,

		success: function(json){
			if(successFunction != null){
				successFunction(json, dataSuccessFunction);
			}
		}
	});
}

function ajax_favorite(dataPHP, successFunction, dataSuccessFunction){
	$.ajax({
		'type':"POST",
		'dataType':"json",
		'url':'php/favorite.php',
		'data':dataPHP,

		success: function(json){
			if(successFunction != null){
				successFunction(json, dataSuccessFunction);
			}
		}
	});
}

function ajax_languages(dataPHP, successFunction, dataSuccessFunction){
	$.ajax({
		'type':"POST",
		'dataType':"json",
		'url':'php/languages.php',
		'data':dataPHP,

		success: function(json){
			if(successFunction != null){
				successFunction(json, dataSuccessFunction);
			}
		}
	});
}

function ajax_evaluation(dataPHP, successFunction, dataSuccessFunction){
	$.ajax({
		'type':"POST",
		'dataType':"json",
		'url':'php/evaluation.php',
		'data':dataPHP,

		success: function(json){
			if(successFunction != null){
				successFunction(json, dataSuccessFunction);
			}
		}
	});
}

function ajax_explorer(dataPHP, successFunction, dataSuccessFunction){
	$.ajax({
		'type':"POST",
		'dataType':"json",
		'url':'php/explorer.php',
		'data':dataPHP,

		success: function(json){
			if(successFunction != null){
				successFunction(json, dataSuccessFunction);
			}
		}
	});
}

function ajax_wixer(dataPHP, successFunction, dataSuccessFunction){
	$.ajax({
		'type':"POST",
		'dataType':"json",
		'url':'php/wixer.php',
		'data':dataPHP,

		success: function(json){
			if(successFunction != null){
				successFunction(json, dataSuccessFunction);
			}
		}
	});
}
