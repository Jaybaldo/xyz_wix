function reservations(json, data){
    var parent = data[0];
    var successFunction = data[1];
    var x = json.length;
    var divMain;
    var reservation;

    $(parent).attr({'loaded':'0', 'total':x});

    for(var i=0; i<x; i++){
        reservation = json[i];
        divMain = document.createElement('div');

        $(divMain)
            .addClass('reservation_main')
            .attr({'activity_date':reservation.activity_date,
                'activity_img':reservation.activity_img,
                'current_status_date':reservation.current_status_date,
                'explorer_img':reservation.explorer_img,
                'explorer_name':reservation.explorer_name,
                'global_score':reservation.global_score,
                'id_activity':reservation.id_activity,
                'id_explorer':reservation.id_explorer,
                'id_sale_activity':reservation.id_sale_activity,
                'id_wixer':reservation.id_wixer,
                'name_eng':reservation.name_eng,
                'name_spa':reservation.name_spa,
                'num_persons':reservation.num_persons,
                'payment_type':reservation.payment_type,
                'reservation_date':reservation.reservation_date,
                'status':reservation.status,
                'total':reservation.total,
                'wixer_img':reservation.wixer_img,
                'wixer_name':reservation.wixer_name})

            .load("assets/external/_reservation.html", function(){
                var activity_date = $(this).attr('activity_date').substring(0, 10);
                var activity_time = $(this).attr('activity_date').substring(11, 16);
                var current_status_date = $(this).attr('current_status_date').substring(0, 10);
                var current_status_time = $(this).attr('current_status_date').substring(11, 16);
                var reservation_date = $(this).attr('reservation_date').substring(0, 10);
                var reservation_time = $(this).attr('reservation_date').substring(11, 16);

                $('.experience_link', $(this)).attr({'href':'item-detail.html?activityid=' + $(this).attr('id_activity')});
                $('.experience_img', $(this)).css({'background-image':"url('"+$(this).attr('activity_img')+"')"});
                $('.experience_name_es', $(this)).html($(this).attr('name_spa'));
                $('.experience_name_en', $(this)).html($(this).attr('name_eng'));
                $('.experience_price_mxn .mxn', $(this)).html($(this).attr('total'));
                $('.experience_price_usd .usd', $(this)).html($(this).attr('total'));
                $('.reservation_status', $(this)).html($(this).attr('status'));               

                $('.explorer_link', $(this)).attr({'href':'profile.html?userid=' + $(this).attr('id_explorer')});
                $('.explorer_img', $(this)).css({'background-image':"url('"+$(this).attr('explorer_img')+"')"});
                $('.explorer_name', $(this)).html($(this).attr('explorer_name'));

                $('.wixer_link', $(this)).attr({'href':'profile.html?userid=' + $(this).attr('id_wixer')});
                $('.wixer_img', $(this)).css({'background-image':"url('"+$(this).attr('wixer_img')+"')"});
                $('.wixer_name', $(this)).html($(this).attr('wixer_name'));

                $('.activity_date', $(this)).html(activity_date);
                $('.activity_time', $(this)).html(activity_time + ' hrs');
                $('.reservation_date', $(this)).html(reservation_date);
                $('.current_status_date', $(this)).html(current_status_date);

                $('.chat_xs', $(this)).click(function(){
                    var divMain = $(this).parent().parent().parent().parent();
                });

                $('.reservation_report_xs', $(this)).click(function(){
                    var divMain = $(this).parent().parent().parent().parent();
                });

                $('.reservation_cancel_xs', $(this)).click(function(){
                    var divMain = $(this).parent().parent().parent().parent();
                });

                $('.chat_lg', $(this)).click(function(){
                    var divMain = $(this).parent().parent().parent().parent().parent().parent();
                });

                $('.reservation_report_lg', $(this)).click(function(){
                    var divMain = $(this).parent().parent().parent().parent().parent();
                });

                $('.reservation_cancel_lg', $(this)).click(function(){
                    var divMain = $(this).parent().parent().parent().parent().parent();
                });

                $(this).appendTo(parent);
                $(parent).attr({'loaded':(parseInt($(parent).attr('loaded'))+1)});

                if(successFunction != null && parseInt($(parent).attr('loaded')) == parseInt($(parent).attr('total'))){
                    successFunction(json, parent);
                }
            });
    }
}