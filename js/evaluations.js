function evaluations(json, data){
    var parent = data[0];
    var successFunction = data[1];
    var x = json.length;
    var divMain;
    var evaluation;

    $(parent).attr({'loaded':'0', 'total':x});

    for(var i=0; i<x; i++){
        evaluation = json[i];
        divMain = document.createElement('div');

        $(divMain)
            .addClass('evaluation_main')
            .attr({'activity_name_eng':evaluation.activity_name_eng,
                'activity_name_spa':evaluation.activity_name_spa,
                'id_activity':evaluation.id_activity,
                'img':evaluation.img,
                'review':evaluation.review,
                'review_id':evaluation.review_id,
                'time_review':evaluation.time_review,
                'type':evaluation.type,
                'user_id':evaluation.user_id,
                'user_name':evaluation.user_name})

            .load("assets/external/_evaluation.html", function(){
                var date = $(this).attr('time_review').substring(0, 9);
                var time = $(this).attr('time_review').substring(10);

                $('.imgUser', $(this)).attr({'href':'http://wixplor.com/test/profile.html?userid=' + $(this).attr('user_id')});
                $('.imgUser div', $(this)).css({'background-image':"url('"+$(this).attr('img')+"')"});
                $('.userName', $(this)).attr({'href':'http://wixplor.com/test/profile.html?userid=' + $(this).attr('user_id')});
                $('.userName strong', $(this)).html($(this).attr('user_name'));
                $('.activityTime', $(this)).html(time);
                $('.activityName', $(this)).attr({'href':'http://wixplor.com/test/item-detail.html?activityid=' + $(this).attr('id_activity')});
                $('.activityName .es', $(this)).html($(this).attr('activity_name_spa'));
                $('.activityName .en', $(this)).html($(this).attr('activity_name_eng'));
                $('.activityDate', $(this)).html(date);
                $('.activityMsj', $(this)).html($(this).attr('review'));

                $(this).appendTo(parent);
                $(parent).attr({'loaded':(parseInt($(parent).attr('loaded'))+1)});

                if(successFunction != null && parseInt($(parent).attr('loaded')) == parseInt($(parent).attr('total'))){
                    successFunction(json, parent);
                }
            });
    }
}