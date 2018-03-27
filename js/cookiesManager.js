function setCookie(json, data){
	var cookieName = data[0];
	var successFunction = data[1];
	var days = data[2];
	json = JSON.stringify(json);

	removeCookie(cookieName);

	if(days == null){
		$.cookie(cookieName, json);
	}else $.cookie(cookieName, json, {expires: days});

	if(successFunction != null){
		successFunction();
	}
}

function getCookie(cookieName){
	try{
		var json = $.cookie(cookieName);
		return (JSON.parse(json));
	}catch(e){
		return false;
	}
}

function removeCookie(cookieName){
	$.removeCookie(cookieName);
}

function removeAllCookies(){
	removeCookie('wixplorUser');
	removeCookie('wixplorCurrency');
	removeCookie('wixplorUserProfileGeneral');
	removeCookie('wixplorUserMode');
}
