function chekZZZ() {
	PopupCtrl.PopupMessage("B?n dã di?m danh ngày này r?i");
}


window.PopupCtrl = {
    PopupMessage: function (Message) {
        var input = {
            Message: Message
        };
        $.ajax({
            type: 'POST',
            url: appPath + "Home/PopupMessage",
            data: JSON.stringify(input),
            contentType: "application/json; charset=utf-8",
            dataType: "html",
            success: function (data) {
                $("#popupwrap").remove(); $("#overlayPopup").remove();
                $('BODY').append('<div id="popupwrap"></div><div id="overlayPopup" onclick="PopupCtrl.HidePopup()" style="height:' + documentHeight() + 'px; width:' + documentWidth() + 'px; position: absolute;z-index: 1200;top: 0;left: 0;width: 100%;display: block;opacity: .80;background: #222;filter: alpha(opacity=60);-moz-opacity: 0.8;"></div>');
                $("#popupwrap").html(data);
            }
        });
    },

    PopupVideo: function () {
        $.ajax({
            type: 'POST',
            url: root + "popup/popup_video",
            contentType: "application/json; charset=utf-8",
            dataType: "html",
            success: function (data) {
                $("#popupwrap").remove(); $("#overlayPopup").remove();
                $('BODY').append('<div id="popupwrap"></div><div id="overlayPopup" onclick="PopupCtrl.HidePopup()" style="height:' + documentHeight() + 'px; width:' + documentWidth() + 'px; position: absolute;z-index: 1200;top: 0;left: 0;width: 100%;display: block;opacity: .80;background: #222;filter: alpha(opacity=60);-moz-opacity: 0.8;"></div>');
                $("#popupwrap").html(data);
            }
        });

    },

    PopupVideoKiemKhach: function () {
        $.ajax({
            type: 'POST',
            url: appPath + "Home/PopupVideoKiemKhach",
            contentType: "application/json; charset=utf-8",
            dataType: "html",
            success: function (data) {
                $("#popupwrap").remove(); $("#overlayPopup").remove();
                $('BODY').append('<div id="popupwrap"></div><div id="overlayPopup" onclick="PopupCtrl.HidePopup()" style="height:' + documentHeight() + 'px; width:' + documentWidth() + 'px; position: absolute;z-index: 1200;top: 0;left: 0;width: 100%;display: block;opacity: .80;background: #222;filter: alpha(opacity=60);-moz-opacity: 0.8;"></div>');
                $("#popupwrap").html(data);
            }
        });
    },

    PopupVideoDaoKhach: function () {
        $.ajax({
            type: 'POST',
            url: appPath + "Home/PopupVideoDaoKhach",
            contentType: "application/json; charset=utf-8",
            dataType: "html",
            success: function (data) {
                $("#popupwrap").remove(); $("#overlayPopup").remove();
                $('BODY').append('<div id="popupwrap"></div><div id="overlayPopup" onclick="PopupCtrl.HidePopup()" style="height:' + documentHeight() + 'px; width:' + documentWidth() + 'px; position: absolute;z-index: 1200;top: 0;left: 0;width: 100%;display: block;opacity: .80;background: #222;filter: alpha(opacity=60);-moz-opacity: 0.8;"></div>');
                $("#popupwrap").html(data);
            }
        });
    },

    PopupVideoPhienKhach: function () {
        $.ajax({
            type: 'POST',
            url: appPath + "Home/PopupVideoPhienKhach",
            contentType: "application/json; charset=utf-8",
            dataType: "html",
            success: function (data) {
                $("#popupwrap").remove(); $("#overlayPopup").remove();
                $('BODY').append('<div id="popupwrap"></div><div id="overlayPopup" onclick="PopupCtrl.HidePopup()" style="height:' + documentHeight() + 'px; width:' + documentWidth() + 'px; position: absolute;z-index: 1200;top: 0;left: 0;width: 100%;display: block;opacity: .80;background: #222;filter: alpha(opacity=60);-moz-opacity: 0.8;"></div>');
                $("#popupwrap").html(data);
            }
        });
    },

    PopupKiemKhach: function () {
        $.ajax({
            type: 'POST',
            url: appPath + "Home/PopupKiemKhach",
            contentType: "application/json; charset=utf-8",
            dataType: "html",
            success: function (data) {
                $("#popupwrap").remove(); $("#overlayPopup").remove();
                $('BODY').append('<div id="popupwrap"></div><div id="overlayPopup" onclick="PopupCtrl.HidePopup()" style="height:' + documentHeight() + 'px; width:' + documentWidth() + 'px; position: absolute;z-index: 1200;top: 0;left: 0;width: 100%;display: block;opacity: .80;background: #222;filter: alpha(opacity=60);-moz-opacity: 0.8;"></div>');
                $("#popupwrap").html(data);
            }
        });
    },

    PopupDaoKhach: function () {
        $.ajax({
            type: 'POST',
            url: appPath + "Home/PopupDaoKhach",
            contentType: "application/json; charset=utf-8",
            dataType: "html",
            success: function (data) {
                $("#popupwrap").remove(); $("#overlayPopup").remove();
                $('BODY').append('<div id="popupwrap"></div><div id="overlayPopup" onclick="PopupCtrl.HidePopup()" style="height:' + documentHeight() + 'px; width:' + documentWidth() + 'px; position: absolute;z-index: 1200;top: 0;left: 0;width: 100%;display: block;opacity: .80;background: #222;filter: alpha(opacity=60);-moz-opacity: 0.8;"></div>');
                $("#popupwrap").html(data);
            }
        });
    },

    PopupPhienKhach: function () {
        $.ajax({
            type: 'POST',
            url: appPath + "Home/PopupPhienKhach",
            contentType: "application/json; charset=utf-8",
            dataType: "html",
            success: function (data) {
                $("#popupwrap").remove(); $("#overlayPopup").remove();
                $('BODY').append('<div id="popupwrap"></div><div id="overlayPopup" onclick="PopupCtrl.HidePopup()" style="height:' + documentHeight() + 'px; width:' + documentWidth() + 'px; position: absolute;z-index: 1200;top: 0;left: 0;width: 100%;display: block;opacity: .80;background: #222;filter: alpha(opacity=60);-moz-opacity: 0.8;"></div>');
                $("#popupwrap").html(data);
            }
        });
    },

    PopupIntroHero: function () {
        $.ajax({
            type: 'POST',
            url: appPath + "Home/PopupIntroHero",
            contentType: "application/json; charset=utf-8",
            dataType: "html",
            success: function (data) {
                $("#popupwrap").remove(); $("#overlayPopup").remove();
                $('BODY').append('<div id="popupwrap"></div><div id="overlayPopup" onclick="PopupCtrl.HidePopup()" style="height:' + documentHeight() + 'px; width:' + documentWidth() + 'px; position: absolute;z-index: 1200;top: 0;left: 0;width: 100%;display: block;opacity: .80;background: #222;filter: alpha(opacity=60);-moz-opacity: 0.8;"></div>');
                $("#popupwrap").html(data);
            }
        });
    },

    PopupVoTuong: function () {
        $.ajax({
            type: 'POST',
            url: appPath + "Home/PopupVoTuong",
            contentType: "application/json; charset=utf-8",
            dataType: "html",
            success: function (data) {
                $("#popupwrap").remove(); $("#overlayPopup").remove();
                $('BODY').append('<div id="popupwrap"></div><div id="overlayPopup" onclick="PopupCtrl.HidePopup()" style="height:' + documentHeight() + 'px; width:' + documentWidth() + 'px; position: absolute;z-index: 1200;top: 0;left: 0;width: 100%;display: block;opacity: .80;background: #222;filter: alpha(opacity=60);-moz-opacity: 0.8;"></div>');
                $("#popupwrap").html(data);
            }
        });
    },

    PopupGetGiftCode: function () {
        $.ajax({
            type: 'POST',
            url: appPath + "Home/PopupGetGiftCode",
            contentType: "application/json; charset=utf-8",
            dataType: "html",
            success: function (data) {
                $("#popupwrap").remove(); $("#overlayPopup").remove();
                $('BODY').append('<div id="popupwrap"></div><div id="overlayPopup" onclick="PopupCtrl.HidePopup()" style="height:' + documentHeight() + 'px; width:' + documentWidth() + 'px; position: absolute;z-index: 1200;top: 0;left: 0;width: 100%;display: block;opacity: .80;background: #222;filter: alpha(opacity=60);-moz-opacity: 0.8;"></div>');
                $("#popupwrap").html(data);
            }
        });
    },

    BtnGetGiftCode: function () {
        var param = {
            phoneNumber: $("#phoneNumber").val()
        }
        $.ajax({
            type: 'POST',
            url: appPath + 'Home/GetGiftCodeDLK',
            data: JSON.stringify(param),
            contentType: 'application/json; charset=utf-8',
            dataType: 'json',
            async: true,
            success: function (data) {
                if (data.ResponseCode == -101) {
                    $("#alertx").html(data.Message);
                    $("#dataGiftCode").hide();
                }
                else if (data.ResponseCode == -54) {
                    $("#alertx").hide();
                    PopupCtrl.PopupMessage(data.Message);
                }
                else if (data.ResponseCode == -102) {
                    $("#alertx").html(data.Message);
                    $("#dataGiftCode").hide();
                }
                else {
                    $("#alertx").hide();
                    $("#dataGiftCode").html(data.Message);
                }
            }
        });
    },

    SetLastLogin: function () {
        $.ajax({
            type: 'POST',
            url: appPath + "Home/SetLastLogin",
            contentType: "application/json; charset=utf-8",
            dataType: "html",
            success: function (data) {
                console.log(data.Message);
                console.log("Set LastLogin : " + data.ResponseCode);
                GetListRollUp();
            }
        });
    },

    PopupLogin: function () {
        $.fancybox({
            href : '#popLogin',
            padding : 0,
            scrolling: false,
            beforeShow : function(){
                $('.fancybox-skin').css({'background':'none','box-shadow':'none'});
            },
            afterShow : function(){
                $('.fancybox-close').css({top: '7px',right: '-2px'});
            }
        });
    },

    PopupOpen: function () {
        $.fancybox({
            href : '#popup_open',
            padding : 0,
            scrolling: false,
            beforeShow : function(){
                $('.fancybox-skin').css({'background':'none','box-shadow':'none'});
            },
            afterShow : function(){
                $('.fancybox-close').css({top: '7px',right: '-2px'});
            }
        });
    },

    ShowBanner: function() {
        if( user_login ){
            window.open('https://www.facebook.com/%C4%90%E1%BB%93-Long-Pk-335698360109844/?fref=ts','_blank');
        }else{
            this.PopupLogin();
        }
    },

    HidePopup: function () {
        $("#popupwrap").remove(); $("#overlayPopup").remove();
    },

    HidePopupLogin: function () {
        $("#popupwrap").remove(); $("#overlayPopup").remove();
        calPopLogin();
    }
}