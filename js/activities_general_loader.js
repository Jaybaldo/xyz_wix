function count_activities_index(size, id){

    var a = $('#activities-slider').attr("number_activities"+id+"-handler");

    if(size == a){
        var children_actv = $("#activities-slider").children();

        $(children_actv[0]).css({"padding":0, "top":0, "position":"relative"});



        $(".variable"+id).slick({
            dots: false,
            arrows: false,
            infinite: true,
            variableWidth: true,
            opacity: .9,
            slidesToScroll: 1,
            autoplay: true,
            autoplaySpeed: 5000,
            responsive: [{
                breakpoint: 823,
                settings: {
                    autoplay: false
                }
            }]
        });

        if(window.innerWidth > 768){
            $("body").find(".slick-list").each(function () {
                var width_sl = $(".city-headers-activity").width() - 1;
                console.log($(".city-headers-activity").width(), width_sl)
                $(this).css("width",width_sl);
            });
        }


        if(language){
            if(language.language == "es" ){
                switch_to_spanish();
            }
            else if(language.language == "en"){
                switch_to_english();
            }
        }
        else{
            switch_navbar_language("es");
        }
    }
}

function after_process_activities(len, back_function, div_master, json, data) {
    var numact = $(div_master).attr("num_activities");
    numact = 1*numact;
    if(len == numact){
        if(back_function){
            back_function(json, data);
        }
    }

}

function check_activity_user_favorites(json, data) {
    var dom_class_actvs = data[0];
    $("."+dom_class_actvs ).find(".like-activity").each(function () {
        for (var i = 0; i < json.length; i++) {
            var activity_id_favorited = json[i].id_activity;
            var curr_act = $(this).parent().attr("id_actv_hr");
            if(curr_act == activity_id_favorited){
                $(this).find(".noliked").addClass("hidden");
                $(this).find(".liked").removeClass("hidden");
            }
        }
    });
}


function activities_general_loader(json, data) {

    var activity;
    var div_master = data[0]; //Div where activities need to be loaded
    $(div_master).attr("num_activities",0);
    var css_surround = data[1]; //CSS code in json format that will aply to the item
    var class_surround = data[2]; //String with class or classes (plain text) that will recieve the item
    if(data[4]){
        var id_pre_city = data[4];
    }
    else{
        var id_pre_city = 0;
    }
    $('#activities-slider').attr('number_activities'+id_pre_city+'-handler',0);





    for (var i = 0; i < json.length; i++) {

        activity = json[i];

        var div = document.createElement('div');
        $(div).css(css_surround);
        $(div).addClass(class_surround);

        $(div).attr({'id':activity.id, 'id_wixer':activity.id_wixer, 'city':activity.city, 'reservation-type_es':activity.reservation_type_es,
        'reservation-type_en':activity.reservation_type_en, 'id_category':activity.id_category, 'wixer_langs':activity.wixer_langs,
        'name_spa':activity.name_spa, 'name_eng':activity.name_eng, 'id_city':activity.id_city, 'main_category_eng':activity.main_category_eng,
        'description_spa':activity.description_spa, 'description_eng':activity.description_eng, 'main_category_spa':activity.main_category_spa,
        'price':activity.price, 'banner':activity.banner, 'type':activity.type, 'max_persons':activity.max_persons, 'status':activity.status,
        'short_desc_spa':activity.short_desc_spa, 'short_desc_eng':activity.short_desc_eng, 'minimun_age':activity.minimun_age,
        'tips_spa':activity.tips_spa, 'tips_eng':activity.tips_eng, 'duration':activity.duration, 'global_score':activity.global_score,
        'veracity':activity.veracity, 'communication':activity.communication, 'puntuality':activity.puntuality, 'activity':activity.quality,
        'meeting_point_latitude':activity.meeting_point_latitude, 'meeting_point_longitude':activity.meeting_point_longitude, 'num_rat': activity.num_rat,
        'user_id':activity.user_id, 'name':activity.name, 'email':activity.email, 'mobile':activity.mobile, 'img_src':activity.img_src,
        'id_activity_unused':activity.id_activity_unused, 'wixer_desc_en':activity.wixer_desc_en, 'wixer_desc_es':activity.wixer_desc_es,
        'activity_reservation_type':activity.activity_reservation_type});


        $(div).load("assets/external/_activity.html", function () {
            var currnum = $('#activities-slider').attr('number_activities'+id_pre_city+'-handler');
            currnum = 1*currnum;
            currnum = 1+currnum;
            $('#activities-slider').attr('number_activities'+id_pre_city+'-handler',currnum);


            var num_activities = $(div_master).attr("num_activities");
            num_activities = 1*num_activities;
            num_activities = num_activities + 1;

            $(div_master).attr("num_activities",num_activities);

            var id_city = $(this).attr('id_city');
            $(div_master).append($(this));

            var url = "item-detail.html?activityid="+$(this).attr('id');
            var id_actv_fav = $(this).attr('id');

            //$(this).find("a.url-to-itemdetail").attr("href",url);
            $(this).find(".img-activity-main").click(function () {
                window.location.href=url;
            });

            $(this).find(".like-activity").parent().attr("id_actv_hr",id_actv_fav).click(function (e) {
                e.stopPropagation();
                if(user){
                    var dataPHP = {"case":1, "id_user":user[0].user_id, "id_activity":id_actv_fav};
                    var data = [];
                    data[0] = $(this);
                    ajax_favorite(dataPHP, favoriteAddedCallbackFun, data);
                }
                else{
                    $("#li_sign_in_as").attr("sign_in_as","explorer");
                    $("#modal_sign_in").modal("show");
                }

            });


            //$(this).find('img.img-activity-main').attr('src', $(this).attr('img_src'));
            $(this).find('.img-activity-main').css("background-image","url("+$(this).attr('img_src')+")");

            $(this).find("span.category.es").append($(this).attr('main_category_spa'));
            $(this).find("span.category.en").append($(this).attr('main_category_eng'));

            var tittle_eng =$(this).attr('name_eng');
            var tittle_spa =$(this).attr('name_spa');
            if(tittle_eng.length > 31){
                tittle_eng = tittle_eng.substring(0, 30) + "...";
            }
            if(tittle_spa.length > 31){
                tittle_spa = tittle_eng.substring(0, 30) + "...";
            }


            $(this).find("h5.activity-tittle.en").append(tittle_eng);
            $(this).find("h5.activity-tittle.es").append(tittle_spa);

            if($(this).attr("activity_reservation_type") == 1){

                img_src_res = "assets/icons/rsv_reserva_inmediata.png";
            }
            else{
                img_src_res ="assets/icons/rsv_confirmacion.png";
            }
            $(this).find("p.reservation-type.es").append("<img class='mouse-modal-show' src="+img_src_res+" style=' float:left;height:15px; width:15px;'>");
            $(this).find("p.reservation-type.en").append("<img class='mouse-modal-show' src="+img_src_res+" style=' float:left;height:15px; width:15px;'>");


            $(this).find("span.ciudad").append($(this).attr('city'));

            $(this).find("h4.es.desc_header").append($(this).attr('description_spa'));
            $(this).find("h4.en.desc_header").append($(this).attr('description_eng'));

            $(this).find(".price.mxn").append($(this).attr('price'));
            var price_usd = $(this).attr('price')
            price_usd = (1*price_usd)*19;
            $(this).find(".price.usa").append(price_usd);

            var global_score_specific = $(this).attr('global_score');

            $(this).find("div.rateYo").rateYo({
                rating: global_score_specific,
                starWidth: "17px",
                readOnly: true
            });

            $(this).find(".num_rat").append("("+$(this).attr('num_rat')+")");

            if(data[3]){ //Exclusive for index
                if(data[4]){
                    var curr_num_activities = count_activities_index(json.length, id_city);
                }
                else{
                    var curr_num_activities = count_activities_index(json.length, 0);
                }
            }
            var fun = data[7];
            after_process_activities(json.length, fun, data[0], json, data);


            if(data[5]){
                //Get all users's favorite activities
                if(user){
                    var dataPHP = {"case":2, "id":user[0].user_id};
                    var dataf = [];
                    dataf[0] = data[6];
                    ajax_favorite(dataPHP, check_activity_user_favorites, dataf);
                }
            }

        });

    }
}

function favoriteAddedCallbackFun(json, data) {
    console.log(json);
    var heart = data[0];
    if(json.Deleted){
        $(heart).find(".noliked").removeClass("hidden");
        $(heart).find(".liked").addClass("hidden");
        //$(heart).find(":first-child").css("color","rgba(0,0,0,.6)");
    }
    else{
        $(heart).find(".noliked").addClass("hidden");
        $(heart).find(".liked").removeClass("hidden");
        //$(heart).find(":first-child").css("color","#F44336");
    }

}
