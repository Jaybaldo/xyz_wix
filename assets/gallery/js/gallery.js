function gallery_start(srcs_array, data){
	var parent = data[0];
	var success_function = data[1];
	var gallery_tittle = data[2];
	
	$(parent).load('assets/gallery/gallery.html', function(){
		gallery_create_positions(srcs_array, $('#gallery_positions'));
	    gallery_create_gallery(srcs_array, $('.gallery'));

	    $('#gallery_modal_tittle').html(gallery_tittle);

		$('.gallery_open').click(function(){
			var gallery_position = parseInt($(this).attr('gallery_position'));
			var src = $($('#gallery_positions').children()[gallery_position]).attr('src');

			$('#gallery_positions').attr({'gallery_position':gallery_position});	
			$('#gallery_modal_img').css({'background-image':"url('"+src+"')"});
			$('#gallery_modal').removeClass('hidden');
		});

		$('.gallery_next').click(function(){
			get_gallery_next();						
		});

		function get_gallery_next(){
			var gallery_total = parseInt($('#gallery_positions').attr('gallery_total'));
			var current_position = parseInt($('#gallery_positions').attr('gallery_position'));
			var new_position = (current_position == gallery_total-1)?0:(current_position + 1);
			var src = $($('#gallery_positions').children()[new_position]).attr('src');

			$('#gallery_positions').attr({'gallery_position':new_position});			
			$('#gallery_modal_img').css({'background-image':"url('"+src+"')"});
			$('#gallery_modal').removeClass('hidden');
		}

		$('.gallery_prev').click(function(){
			get_gallery_prev();						
		});

		function get_gallery_prev(){
			var gallery_total = parseInt($('#gallery_positions').attr('gallery_total'));
			var current_position = parseInt($('#gallery_positions').attr('gallery_position'));
			var new_position = (current_position == 0)?(gallery_total - 1):(current_position - 1);
			var src = $($('#gallery_positions').children()[new_position]).attr('src');

			$('#gallery_positions').attr({'gallery_position':new_position});			
			$('#gallery_modal_img').css({'background-image':"url('"+src+"')"});
			$('#gallery_modal').removeClass('hidden');
		}

		$('#gallery_modal').click(function(){
			$(this).addClass('hidden');
		});

		$('#gallery_modal_content').click(function(e){
			e.stopPropagation();
		});

		$('.gallery_close').click(function(){
			$('#gallery_modal').addClass('hidden');
		});

		$(document).keyup(function(event){
			if(!$('#gallery_modal').hasClass('hidden')){
				if(event.which == 27){
		            $('#gallery_modal').addClass('hidden');
		        }else if(event.which == 37){
		            get_gallery_prev();
		        }else if(event.which == 39){
		            get_gallery_next();
		        }
			}
	    });

	    if(success_function != null){
	    	success_function(srcs_array, parent);
	    }

	    function gallery_create_positions(srcs_array, gallery_positions){
			var x = srcs_array.length;
			var gallery_position;

			$(gallery_positions).attr({'gallery_total':x});
			for(var i=0; i<x; i++){
				gallery_position = document.createElement('div');		
				$(gallery_position).attr({'gallery_position':i,'src':srcs_array[i]}).appendTo(gallery_positions);
			}
		}

		function gallery_create_gallery(srcs_array, gallery){
			var x = srcs_array.length;

			if(x==1){
				var col_1 = gallery_create_element_gallery(0, srcs_array[0]);
				$(col_1).addClass('col-xs-12 col-sm-6 col-sm-offset-3').appendTo('.row', gallery);
			}else if(x==2){
				var col_1 = gallery_create_element_gallery(0, srcs_array[0]);
				$(col_1).addClass('col-xs-6').appendTo('.row', gallery);

				var col_2 = gallery_create_element_gallery(1, srcs_array[1]);
				$(col_2).addClass('col-xs-6').appendTo('.row', gallery);
			}else if(x==3){
				var col_1 = gallery_create_element_gallery(0, srcs_array[0]);
				$(col_1).addClass('col-xs-6').appendTo('.row', gallery);

				var col_2 = gallery_create_element_gallery(1, srcs_array[1]);
				$(col_2).addClass('col-xs-6').appendTo('.row', gallery);

				var col_3 = gallery_create_element_gallery(2, srcs_array[2]);
				$(col_3).addClass('col-xs-12 col-sm-6 col-sm-offset-3').appendTo('.row', gallery);
			}else if(x==4){
				var col_1 = gallery_create_element_gallery(0, srcs_array[0]);
				$(col_1).addClass('col-xs-12 col-sm-6').appendTo('.row', gallery);

				var col_2 = gallery_create_element_gallery(1, srcs_array[1]);
				$(col_2).addClass('col-xs-6').appendTo('.row', gallery);

				var col_3 = gallery_create_element_gallery(2, srcs_array[2]);
				$(col_3).addClass('col-xs-6').appendTo('.row', gallery);

				var col_4 = gallery_create_element_gallery(3, srcs_array[3]);
				$(col_4).addClass('col-xs-12 col-sm-6').appendTo('.row', gallery);
			}else if(x>=5){
				var col_1 = gallery_create_element_gallery(0, srcs_array[0]);
				$(col_1).addClass('col-xs-6').appendTo('.row', gallery);

				var col_2 = gallery_create_element_gallery(1, srcs_array[1]);
				$(col_2).addClass('col-xs-6').appendTo('.row', gallery);

				var col_3 = gallery_create_element_gallery(2, srcs_array[2]);
				$(col_3).addClass('col-xs-12 col-sm-4').appendTo('.row', gallery);

				var col_4 = gallery_create_element_gallery(3, srcs_array[3]);
				$(col_4).addClass('col-xs-6 col-sm-4').appendTo('.row', gallery);

				var col_5 = gallery_create_element_gallery(4, srcs_array[4]);
				$(col_5).addClass('col-xs-6 col-sm-4').appendTo('.row', gallery);
			}
		}

		function gallery_create_element_gallery(gallery_position, src){
			var col = document.createElement('div');
			var gallery_element = document.createElement('div');		

			$(gallery_element).addClass('gallery_open').attr({'gallery_position':gallery_position}).css({'background-image':"url('"+src+"')"}).appendTo(col);

			return col;
		}
	});
}