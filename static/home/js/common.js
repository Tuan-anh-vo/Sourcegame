var appPath = "https://hoathiencot.vtcgame.vn/";

$(document).ready(function () {
    // Đầu trang
    $('body').append('<div id="backtop"></div>');
    $(window).scroll(function () {
        if ($(window).scrollTop() != 0) {
            $('#backtop').fadeIn();
        } else {
            $('#backtop').fadeOut();
        }
    });
    $('#backtop').click(function () {
        $('html, body').animate({ scrollTop: 0 }, 500);
    });

    HomeCtrl.Init();
});

window.LoginAPI = {
    RegisterAPI: "https://vtcgame.vn/account.sso.api/",      //https://id.vtc.vn/account.sso.api/
    ServiceID: '881348',
    UTM_SOURCE: 'homepage',
    UTM_MEDIUM: 'default',
    UTM_CAMPAIGN: 'default',
    LinkSSORegister: appPath + "dang-ky?status=1",
    LinkSSOLogin: appPath + "dang-nhap?status=1",

    getCaptchaFastRegister: function () {
        var time = new Date().getTime();
        var imgSrc = LoginAPI.RegisterAPI + "Handler/captcha.ashx?t=" + time;
        $('#imageData').attr("src", imgSrc);
        $('#imgCaptchaPopup').attr("src", imgSrc);
    },

    PostRegisterOpenId: function (provider) {
        var utm = {
            sid: LoginAPI.ServiceID,
            utm_source: utils.getParameterByName("utm_source"),
            utm_medium: utils.getParameterByName("utm_medium"),
            utm_campaign: utils.getParameterByName("utm_campaign"),
            returnUrl: LoginAPI.LinkSSOLogin
        };

        // https://id.vtc.vn/account.sso.api/api/openid/login
        switch (provider) {
            case "facebook":
                window.location = 'https://vtcgame.vn/account.sso.api/api/openid/login?ReturnUrl=' + encodeURIComponent(utm.returnUrl + "&provider=facebook") + '&sid=' + utm.sid + '&utm_source=' + utm.utm_source + '&utm_medium=' + utm.utm_medium + '&utm_campaign=' + utm.utm_campaign + '';
                break;
            case "google":
                window.location = 'https://vtcgame.vn/account.sso.api/api/openid/login?openid_identifier=https://www.google.com/accounts/o8/id&ReturnUrl=' + encodeURIComponent(utm.returnUrl + "&provider=google") + '&sid=' + utm.sid + '&utm_source=' + utm.utm_source + '&utm_medium=' + utm.utm_medium + '&utm_campaign=' + utm.utm_campaign + '';
                break;
            case "yahoo":
                window.location = 'https://vtcgame.vn/account.sso.api/api/openid/login?openid_identifier=http://yahoo.com/&ReturnUrl=' + encodeURIComponent(utm.returnUrl + "&provider=yahoo") + '&sid=' + utm.sid + '&utm_source=' + utm.utm_source + '&utm_medium=' + utm.utm_medium + '&utm_campaign=' + utm.utm_campaign + '';
                break;
        }
    },

    PostRegister: function () {
        var accountName = $("#txtAccountName").val();
        var password = $("#txtPassword").val();
        var rePassword = $("#txtRePassword").val();
        var captcha = $("#txtCaptchaPopUp").val();
        var verify = $("#txtVerify").val();

        if (accountName == null || accountName == '') {
            $("#txtAccountName").focus();
            utils.errorMessageRegis('Vui lòng nhập tên tài khoản');
            return;
        }

        if (accountName.length < 4 || accountName.length > 16) {
            $("#txtAccountName").focus();
            utils.errorMessageRegis('Tên tài khoản từ 4-16 ký tự và bắt đầu bằng chữ cái');
            return;
        }

        if (password == null || password == '') {
            $("#txtPassword").focus();
            utils.errorMessageRegis('Vui lòng nhập mật khẩu');
            return;
        }

        if (password.length < 6 || password.length > 30) {
            $("#txtPassword").focus();
            utils.errorMessageRegis('Mật khẩu có độ dài từ 6-30 ký tự');
            return;
        }

        if (rePassword == null || rePassword == '') {
            $("#txtRePassword").focus();
            utils.errorMessageRegis('Vui lòng nhập lại mật khẩu');
            return;
        }

        if (password != rePassword) {
            $("#txtRePassword").focus();
            utils.errorMessageRegis('Mật khẩu nhập lại không đúng');
            return;
        }

        if (captcha == null || captcha == '') {
            $("#txtCaptchaPopUp").focus();
            utils.errorMessageRegis('Vui lòng nhập mã kiểm tra');
            return;
        }

        utils.loading();
        $.ajax({
            type: "POST",
            url: LoginAPI.RegisterAPI + "api/CreateAccountChanneling/FastRegisterEvent",
            data: {
                ServiceID: LoginAPI.ServiceID,
                AccountName: accountName.toLowerCase(),
                Password: password,
                Captcha: captcha,
                utm_source: utils.getParameterByName('utm_source') != '' ? utils.getParameterByName('utm_source') : LoginAPI.UTM_SOURCE,
                utm_medium: utils.getParameterByName('utm_medium') != '' ? utils.getParameterByName('utm_medium') : LoginAPI.UTM_MEDIUM,
                utm_campaign: utils.getParameterByName('utm_campaign') != '' ? utils.getParameterByName('utm_campaign') : LoginAPI.UTM_CAMPAIGN,
                UserAgent: navigator.userAgent,
                RegisterType: 1
            },
            cache: false,
            xhrFields: {
                withCredentials: true
            },
            success: function (data) {
                if (data.responseCode > 0) {
                    window.location = LoginAPI.LinkSSORegister + "&provider=normal";
                }

                utils.errorMessageRegis(data.description);
                LoginAPI.getCaptchaFastRegister();
                utils.unLoading();
            }
        });
    }
}

window.HomeCtrl = {
    Init: function () {
        var type = parseInt(typePopup, 10);
        var status_ = parseInt(status1, 10);
        if (type > 0) {
            switch (type) {
                case 1: // login                    
                    switch (status_) {
                        case 1:
                            //PopupCtrl.PopupListServer();

                            window.location = Urlsso;
                            //$("#popupwrap").remove(); $("#overlayPopup").remove();
                            //$('BODY').append('<div id="popupwrap"><iframe style="border:none;" width="440" height="260" src="' + Urlsso + '"></iframe></div><div id="overlayPopup" onclick="window.location=\'' + appPath + '\'" style="height:' + utils.documentHeight() + 'px; width:' + utils.documentWidth() + 'px; position: absolute;z-index: 1200;top: 0;left: 0;width: 100%;display: block;opacity: .80;background: #222;filter: alpha(opacity=60);-moz-opacity: 0.8;"></div>');
                            //var width = 440;
                            //var height = 260;
                            //var topOffset = (((utils.windowHeight() - height) / 2) * 100) / utils.windowHeight();
                            //var leftOffset = (((utils.windowWidth() - width) / 2) * 100) / utils.windowWidth();
                            //$('#popupwrap').css('left', leftOffset + "%");
                            //$('#popupwrap').css("top", topOffset + '%');
                            //$('#popupwrap').css('z-index', 9999999);
                            //$('#popupwrap').css('position', 'fixed');

                            break;
                        default:
                            PopupCtrl.PopupRegisterLogin(1);
                            break;
                    }
                    break;
                case 2: // register
                    switch (status_) {
                        case 1:
                            window.location = Urlsso;
                            break;
                        default:
                            PopupCtrl.PopupRegisterLogin(2);
                            break;
                    }
                    break;
                case 5: // popuplistserver
                    PopupCtrl.PopupListServer(); 
                    break;
                 
                 case 6: // popupgiftCode
                    PopupCtrl.PopupGiftCodeHTC();
                    break;

                case 7: // popup Top BXH
                    PopupCtrl.PopupTopBXH();
                    break;

                case 3: // recharge money                                                              
                    if (paymentStatus == null || paymentStatus == '') {
                        RechargeCard.PopupRechargeCard();
                    } else {
                        paymentStatus = parseInt(paymentStatus, 10);
                        var lblResult = '';
                        switch (paymentStatus) {
                            case 1:
                                lblResult = "Chúc mừng bạn nạp Vàng thành công";
                                break;
                            case -1:
                                lblResult = "Giao dịch không thành công";
                                break;
                            case -2:
                                lblResult = "Thông tin thẻ không hợp lệ";
                                break;
                            case -7:
                                lblResult = "Giao dịch chưa được duyệt";
                                break;
                            case -3:
                                lblResult = "Giao dịch không thành công, vui lòng liên hệ với Ngân hàng phát hành thẻ để được biết chi tiết ";
                                break;
                            case -4:
                                lblResult = "Thẻ bị từ chối thanh toán, vui lòng gọi điện đến số 1900 1530 để được hỗ trợ. Ngân hàng sẽ hoàn trả số tiền giao dịch về tài khoản thẻ trong vòng 7 ngày làm việc.";
                                break;
                            case -5: // Chữ ký không hợp lệ
                                lblResult = "Chữ ký không hợp lệ";
                                break;
                            case -8:
                            case -9:
                                lblResult = "Bạn đã nhập sai nhiều lần, vui lòng kiểm tra lại";
                                break;
                            case -48:
                                lblResult = "Tài khoản bị khóa";
                                break;
                            case -49:
                                lblResult = "Tài khoản chưa được kích hoạt";
                                break;
                            case -51:
                            case -54:
                                lblResult = "Số dư không đủ thực hiện giao dịch";
                                break;
                            case -6010:
                                lblResult = "Thông tin giao dịch không hợp lệ";
                                break;
                            case -6011:
                                lblResult = "Giao dịch không tồn tại trên hệ thống";
                                break;
                            case -6012:
                                lblResult = "Mệnh giá nạp không hợp lệ";
                                break;
                            case -6013:
                                lblResult = "Dữ liệu không hợp lệ";
                                break;
                            case -99:
                                lblResult = "Nạp Vàng không thành công, vui lòng quay lại sau";
                                break;
                            case -6998:
                                lblResult = "Mã kiểm tra không hợp lệ";
                                break;
                            case -9001:
                                lblResult = "Tài khoản nạp không tồn tại";
                                break;
                            default:
                                lblResult = "Nạp Vàng không thành công, vui lòng quay lại sau";
                                break;
                        }
                        PopupCtrl.PopupMessage(lblResult);
                    }
                    break;
            }
        }
    },

    GetListServer: function (currentPage, pageSize) {
        $.ajax({
            type: "GET",
            url: appPath + "Home/ListServerPartial",
            cache: false,
            data: {
                currentPage: currentPage == null ? 1 : currentPage,
                pageSize: 10
            },
            contentType: "application/json; charset=utf-8",
            dataType: "html",
            success: function (data) {
                if (data != null) {
                    $("#ListServerPartial").html(data);
                }
            },
            error: function () {
                console.log("Hệ thống bận vui lòng quay lại sau");
            }
        })
    },

    ViewName: "GetRank",
    GetRank: function (viewName) {
        viewName = (viewName == null || viewName == "") ? "GetRank" : viewName;
        var serverId = $("#idServer").val();
        console.log(serverId);
        HomeCtrl.ViewName = viewName;
        $.ajax({
            type: "GET",
            url: appPath + "Home/" + viewName,
            cache: false,
            data: {
                serverId: (serverId == null || serverId == '' || serverId == 'NaN') ? 1 : parseInt(serverId, 10)
            },
            contentType: "application/json; charset=utf-8",
            success: function (data) {
                if (data != null) {
                    $("#ListRank").html(data);
                }
            },
            error: function () {
                console.log("Hệ thống bận vui lòng quay lại sau");
            }
        });
    },

    GetRank_Change: function () {
        var serverId = $("#idServer").val();
        var viewName = HomeCtrl.ViewName;
        HomeCtrl.GetRank(viewName, serverId);
    }
}

window.LabrariesCtrl = {
    GetListImage: function (cateId, currentPage) {
        $.ajax({
            type: "GET",
            url: appPath + "Libraries/ListImage",
            cache: false,
            data: {
                cateId: cateId,
                currentPage: currentPage == null ? 1 : currentPage
            },
            contentType: "application/json; charset=utf-8",
            dataType: "html",
            success: function (data) {
                if (data != null) {
                    //$("#popupwrap").remove(); $("#overlayPopup").remove();
                    //$('BODY').append('<div id="popupwrap"><div class="popupContent"></div></div><div id="overlayPopup" onclick="utils.hidePoup()" style="height:' + utils.documentHeight() + 'px; width:' + utils.documentWidth() + 'px; position: absolute;z-index: 1200;top: 0;left: 0;width: 100%;display: block;opacity: .80;background: #222;filter: alpha(opacity=60);-moz-opacity: 0.8;"></div>');
                    //$(".popupContent").html(data);
                    //var width = 405;
                    //var height = 436;
                    //var topOffset = (((utils.windowHeight() - height) / 2) * 100) / utils.windowHeight();
                    //var leftOffset = (((utils.windowWidth() - width) / 2) * 100) / utils.windowWidth();
                    //$('#popupwrap').css('left', leftOffset + "%");
                    //$('#popupwrap').css("top", topOffset + '%');
                    //$('#popupwrap').css('z-index', 9999999);
                    //$('#popupwrap').css('position', 'fixed');
                    //$(".gallery:first a[rel^='prettyPhoto']").prettyPhoto({ animation_speed: 'normal', theme: 'light_square', slideshow: 3000, autoplay_slideshow: false, social_tools: false });
                }
            },
            error: function () {
                console.log("Hệ thống bận vui lòng quay lại sau");
            }
        });
    },

    GetListVideo: function (cateId, currentPage) {
        $.ajax({
            type: "GET",
            url: appPath + "Libraries/ListVideo",
            cache: false,
            data: {
                cateId: cateId,
                currentPage: currentPage == null ? 1 : currentPage
            },
            contentType: "application/json; charset=utf-8",
            dataType: "html",
            success: function (data) {
                if (data != null) {
                    $("#popupwrap").remove(); $("#overlayPopup").remove();
                    $('BODY').append('<div id="popupwrap"><div class="popupContent"></div></div><div id="overlayPopup" onclick="utils.hidePoup()" style="height:' + utils.documentHeight() + 'px; width:' + utils.documentWidth() + 'px; position: absolute;z-index: 1200;top: 0;left: 0;width: 100%;display: block;opacity: .80;background: #222;filter: alpha(opacity=60);-moz-opacity: 0.8;"></div>');
                    $(".popupContent").html(url);
                    var width = 405;
                    var height = 436;
                    var topOffset = (((utils.windowHeight() - height) / 2) * 100) / utils.windowHeight();
                    var leftOffset = (((utils.windowWidth() - width) / 2) * 100) / utils.windowWidth();
                    $('#popupwrap').css('left', leftOffset + "%");
                    $('#popupwrap').css("top", topOffset + '%');
                    $('#popupwrap').css('z-index', 9999999);
                    $('#popupwrap').css('position', 'fixed');
                }
            },
            error: function () {
                console.log("Hệ thống bận vui lòng quay lại sau");
            }
        });
    }
}

window.AccountCtrl = {
    PostLoginOpenId: function (provider) {
        utils.loading();
        $.ajax({
            type: "POST",
            cache: false,
            url: appPath + "Account/LoginOpenId",
            data: {
                provider: provider
            },
            dataType: "json",
            success: function (data) {
                //switch (provider) {
                //    case "facebook":
                //        window.location = 'https://sandbox.vtcgame.vn/accountapi/api/openid/login?ReturnUrl=' + encodeURIComponent(data.UrlLogin);
                //        break;
                //    case "google":
                //        window.location = 'https://sandbox.vtcgame.vn/accountapi/api/openid/login?openid_identifier=https://www.google.com/accounts/o8/id&ReturnUrl=' + encodeURIComponent(data.UrlLogin);
                //        break;
                //    case "yahoo":
                //        window.location = 'https://sandbox.vtcgame.vn/accountapi/api/openid/login?openid_identifier=http://yahoo.com/&ReturnUrl=' + encodeURIComponent(data.UrlLogin);
                //        break;
                //}

                switch (provider) {
                    case "facebook":
                        window.location = 'https://vtcgame.vn/account.sso.api/api/openid/login?ReturnUrl=' + encodeURIComponent(data.UrlLogin);
                        break;
                    case "google":
                        window.location = 'https://vtcgame.vn/account.sso.api/api/openid/login?openid_identifier=https://www.google.com/accounts/o8/id&ReturnUrl=' + encodeURIComponent(data.UrlLogin);
                        break;
                    case "yahoo":
                        window.location = 'https://vtcgame.vn/account.sso.api/api/openid/login?openid_identifier=http://yahoo.com/&ReturnUrl=' + encodeURIComponent(data.UrlLogin);
                        break;
                }
            },
            error: function () {
                console.log("PostLoginOpenId Error");
            }
        });
    },

    PostLoginFB: function () {
        utils.loading();
        $.ajax({
            type: "POST",
            cache: false,
            url: appPath + "Account/LoginFB",
            dataType: "json",
            success: function (data) {
                window.location.href = "https://vtcgame.vn/account.sso.api/api/openid/login?ReturnUrl=" + encodeURIComponent(data.UrlLogin);
            },
            error: function () {
                console.log("PostLoginOpenId Error");
            }
        });
    },

    PostLogout: function () {
        $.ajax({
            type: "POST",
            cache: false,
            url: appPath + "Account/Logout",
            data: {
                logout: "Logout"
            },
            dataType: "json",
            success: function (data) {
                window.location = appPath;
            },
            error: function () {
                window.location = appPath;
            }
        });
    },

    refreshCaptchaLogin: function () {
        var dateTime = new Date().getTime();
        $.ajax({
            type: 'GET',
            url: appPath + "Account/GetCatCha",
            dataType: "json",
            contentType: "application/json; charset=utf-8",
            success: function (jsonData) {
                var verify = jsonData.verify;
                var imageData = jsonData.imageData;
                $("#txtVerifyLogin").val(verify);
                $("#ImgcaptchaLogin").attr('src', "data:image/jpeg;base64," + imageData + "");
            }
        });
    },

    refreshCaptcha: function () {
        var dateTime = new Date().getTime();
        $.ajax({
            type: 'GET',
            url: appPath + "Account/GetCatCha",
            dataType: "json",
            contentType: "application/json; charset=utf-8",
            success: function (jsonData) {
                var verify = jsonData.verify;
                var imageData = jsonData.imageData;
                $("#txtVerify").val(verify);
                $("#Imgcaptcha").attr('src', "data:image/jpeg;base64," + imageData + "");
            }
        });
    },

    // captcha for popup
    refreshCaptcha_popup: function () {
        var dateTime = new Date().getTime();
        $.ajax({
            type: 'GET',
            url: appPath + "Account/GetCatCha",
            dataType: "json",
            contentType: "application/json; charset=utf-8",
            success: function (jsonData) {
                var verify = jsonData.verify;
                var imageData = jsonData.imageData;
                $("#txtVerify").val(verify);
                $("#Imgcaptcha_popup").attr('src', "data:image/jpeg;base64," + imageData + "");
            }
        });
    }
}

window.PopupCtrl = {
    Napthe: function () {
        // console.log('ádsdsd');
        if( !user_login ) {
            this.PopupLogin();
        }else{
            window.open(root+'nap-the','_blank');
        }
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

    HomeRegister: function(){
        if( !user_login ) {
            this.PopupLogin();
        }else{
            alert('Bạn đã đăng nhập rồi !');
        }
    },

    PlayNow: function(){
        if( !user_login ){
            this.PopupLogin();
        }else{
            window.open(root + 'vao-game', '_blank');
        }
    },

    PopupMessage: function (msg) {
        var input = {
            msg: msg
        };

        utils.loading();
        $.ajax({
            type: 'POST',
            url: appPath + "Popup/PopupMessage",
            data: JSON.stringify(input),
            contentType: "application/json; charset=utf-8",
            dataType: "html",
            success: function (data) {
                utils.unLoading();
                $("#popupwrap").remove(); $("#overlayPopup").remove();
                $('BODY').append('<div id="popupwrap"></div><div id="overlayPopup" onclick="utils.hidePoup()" style="height:' + utils.documentHeight() + 'px; width:' + utils.documentWidth() + 'px; position: absolute;z-index: 1200;top: 0;left: 0;width: 100%;display: block;opacity: .80;background: #222;filter: alpha(opacity=60);-moz-opacity: 0.8;"></div>');
                $("#popupwrap").html(data);
            }
        });
    },

    PopupFastResister: function () {
        $.ajax({
            type: "GET",
            url: appPath + "Popup/PopupFastResister",
            data: {},
            contentType: "application/json; charset=utf-8",
            dataType: "html",
            success: function (data) {
                $("#tabs1-DN").html(data);
            }
        });
    },

    PopupRegisterSuccess: function (obj) {
        $.ajax({
            type: 'POST',
            url: appPath + "Popup/PopupRegisterSuccess",
            contentType: "application/json; charset=utf-8",
            dataType: "html",
            data: JSON.stringify(obj),
            success: function (data) {
                $("#popupwrap").remove(); $("#overlayPopup").remove();
                $('BODY').append('<div id="popupwrap"></div><div id="overlayPopup" onclick="window.location=' + obj.linkPlay + '" style="height:' + utils.documentHeight() + 'px; width:' + utils.documentWidth() + 'px; position: absolute;z-index: 1200;top: 0;left: 0;width: 100%;display: block;opacity: .80;background: #222;filter: alpha(opacity=60);-moz-opacity: 0.8;"></div>');
                $("#popupwrap").html(data);
                var width = 302;
                var height = 135;
                var topOffset = (((utils.windowHeight() - height) / 2) * 100) / utils.windowHeight();
                var leftOffset = (((utils.windowWidth() - width) / 2) * 100) / utils.windowWidth();
                $('#popupwrap').css('left', leftOffset + "%");
                $('#popupwrap').css("top", topOffset + '%');
                $('#popupwrap').css('z-index', 9999999);
                $('#popupwrap').css('position', 'fixed');
            }
        });
    },

    PopupGiftCode: function () {
        utils.loading();
        $.ajax({
            type: "GET",
            url: appPath + "Popup/PopupGiftCode",
            data: {},
            contentType: "application/json; charset=utf-8",
            dataType: "html",
            success: function (data) {
                utils.unLoading();
                $("#popupwrap").remove(); $("#overlayPopup").remove();
                $('BODY').append('<div id="popupwrap"></div><div id="overlayPopup" onclick="utils.hidePoup()" style="height:' + utils.documentHeight() + 'px; width:' + utils.documentWidth() + 'px; position: absolute;z-index: 1200;top: 0;left: 0;width: 100%;display: block;opacity: .80;background: #222;filter: alpha(opacity=60);-moz-opacity: 0.8;"></div>');
                $("#popupContent").html(data); $("#popupwrap").html(data);
                var width = 450;
                var height = 250;
                var topOffset = (((utils.windowHeight() - height) / 2) * 100) / utils.windowHeight();
                var leftOffset = (((utils.windowWidth() - width) / 2) * 100) / utils.windowWidth();
                $('#popupwrap').css('left', leftOffset + "%");
                $('#popupwrap').css("top", topOffset + '%');
                $('#popupwrap').css('z-index', 1201);
                $('#popupwrap').css('position', 'fixed');
            }
        });
    },

    PopupListServer: function () {
		setCookie('pop_lsv', 'true', 1);
        utils.loading();
        $.ajax({
            type: "GET",
            url: appPath + "Popup/PopupListServer",
            data: {},
            contentType: "application/json; charset=utf-8",
            dataType: "html",
            success: function (data) {
                utils.unLoading();
                $("#popupwrap").remove(); $("#overlayPopup").remove();
                $('BODY').append('<div id="popupwrap"></div><div id="overlayPopup" onclick="utils.hidePoup()" style="height:' + utils.documentHeight() + 'px; width:' + utils.documentWidth() + 'px; position: absolute;z-index: 1200;top: 0;left: 0;width: 100%;display: block;opacity: .80;background: #222;filter: alpha(opacity=60);-moz-opacity: 0.8;"></div>');
                $("#popupContent").html(data); $("#popupwrap").html(data);
                var width = 450;
                var height = 250;
                var topOffset = 100 ;//(((utils.windowHeight() - height) / 14) * 100) / utils.windowHeight();
                var leftOffset = (((utils.windowWidth() - width) / 3) * 100) / utils.windowWidth();
                $('#popupwrap').css('left', leftOffset + "%");
                $('#popupwrap').css("top", '100px');
                $('#popupwrap').css('z-index', 1201);
                $('#popupwrap').css('position', 'fixed');
            }
        });
    },

    PopupGiftCodeHTC: function (account_name) {
        //console.log(account_name);
        utils.loading();
        $.ajax({
            type: "GET",
            url: appPath + "HomeHTC/GiftCodeHTC",
            data: {
                account_name: account_name
            },
            contentType: "application/json; charset=utf-8",
            dataType: "html",
            success: function (data) {
                utils.unLoading();
                $("#popupwrap").remove(); $("#overlayPopup").remove();
                $('BODY').append('<div id="popupwrap"></div><div id="overlayPopup" onclick="utils.hidePoup()" style="height:' + utils.documentHeight() + 'px; width:' + utils.documentWidth() + 'px; position: absolute;z-index: 1200;top: 0;left: 0;width: 100%;display: block;opacity: .80;background: #222;filter: alpha(opacity=60);-moz-opacity: 0.8;"></div>');
                $("#popupContent").html(data); $("#popupwrap").html(data);
                var width = 450;
                var height = 250;
                var topOffset = (((utils.windowHeight() - height) / 2) * 100) / utils.windowHeight();
                var leftOffset = (((utils.windowWidth() - width) / 2) * 100) / utils.windowWidth();
                $('#popupwrap').css('left', leftOffset + "%");
                $('#popupwrap').css("top", topOffset + '%');
                $('#popupwrap').css('z-index', 1201);
                $('#popupwrap').css('position', 'fixed');
            }
        });
    },

     // update 20160119
    PopupTopBXH: function (account_name) {
        //console.log(account_name);
    utils.loading();
    $.ajax({
        type: "GET",
        url: appPath + "Popup/TopBXH",
        data: {
            account_name: account_name
        },
        contentType: "application/json; charset=utf-8",
        dataType: "html",
        success: function (data) {
            utils.unLoading();
            $("#popupwrap").remove(); $("#overlayPopup").remove();
            $('BODY').append('<div id="popupwrap"></div><div id="overlayPopup" onclick="utils.hidePoup()" style="height:' + utils.documentHeight() + 'px; width:' + utils.documentWidth() + 'px; position: absolute;z-index: 1200;top: 0;left: 0;width: 100%;display: block;opacity: .80;background: #222;filter: alpha(opacity=60);-moz-opacity: 0.8;"></div>');
            $("#popupContent").html(data); $("#popupwrap").html(data);
            var width = 450;
            var height = 250;
            var topOffset = (((utils.windowHeight() - height) / 6) * 100) / utils.windowHeight();
            var leftOffset = (((utils.windowWidth() - width) / 2) * 100) / utils.windowWidth();
            $('#popupwrap').css('left', leftOffset + "%");
            $('#popupwrap').css("top", topOffset + '%');
            $('#popupwrap').css('z-index', 1201);
            $('#popupwrap').css('position', 'fixed');
        }
    });
    }


}

window.RechargeCard = {
    PopupRechargeToCard: function (type) {
        var input = {
            type: type
        };
        utils.loading();
        $.ajax({
            type: "GET",
            url: appPath + "RechargeCard/RechargeToCard",
            data: input,
            contentType: "application/json; charset=utf-8",
            dataType: "html",
            success: function (data) {
                utils.unLoading();
                $("#popupwrap").remove(); $("#overlayPopup").remove();
                $('BODY').append('<div id="popupwrap"></div><div id="overlayPopup" onclick="utils.hidePoup()" style="height:' + utils.documentHeight() + 'px; width:' + utils.documentWidth() + 'px; position: absolute;z-index: 1200;top: 0;left: 0;width: 100%;display: block;opacity: .80;background: #222;filter: alpha(opacity=60);-moz-opacity: 0.8;"></div>');
                $("#popupContent").html(data); $("#popupwrap").html(data);
                var width = 450;
                var height = 500;
                var topOffset = (((utils.windowHeight() - height) / 2) * 100) / utils.windowHeight();
                var leftOffset = (((utils.windowWidth() - width) / 2) * 100) / utils.windowWidth();
                $('#popupwrap').css('left', leftOffset + "%");
                $('#popupwrap').css("top", topOffset + '%');
                $('#popupwrap').css('z-index', 1201);
                $('#popupwrap').css('position', 'fixed');
            }
        });
    },

    ChooseRechargeCard: function (view, type) { // 1: Nội địa; 2: Quốc tế
        var url = type == null ? appPath + "RechargeCard/" + view : appPath + "RechargeCard/" + view + "?type=" + type;
        $.ajax({
            type: "GET",
            url: url,
            data: {},
            contentType: "application/json; charset=utf-8",
            dataType: "html",
            success: function (data) {
                $("#rechargeCard").html(data);

                $("#popnav li").removeClass("active");
                if (type != 2) {
                    $("#" + view).addClass("active");
                } else {
                    $("#" + view + "_").addClass("active");
                }
            }
        });
    },

    CheckExistsAccountName: function () {
        var accountName = $("#txtAccountName").val();

        if (accountName == null || accountName == "") {
            //utils.errorMessage("Vui lòng nhập Ví điện tử VTC Pay");   
            utils.errorMessage_Recharge("Vui lòng nhập Ví điện tử VTC Pay");    // new for Recharge
            return;
        }

        utils.loading();
        $.ajax({
            type: "POST",
            cache: false,
            url: appPath + "RechargeCard/CheckExistsAccountNameID",
            data: {
                accountName: accountName
            },
            success: function (data) {
                utils.unLoading();
                if (data == "True") {
                    //utils.successMessage("Tài khoản hợp lệ");
                    utils.successMessage_Recharge("Tài khoản hợp lệ");
                } else {
                    //utils.errorMessage("Tài khoản không hợp lệ");
                    utils.errorMessage_Recharge("Tài khoản không hợp lệ");  // new for Recharge
                }
            },
            error: function () {
                console.log("CheckExistsAccountName Error");
            }
        });
    },

    btnPaymentByPay: function (isAuthen) {
        var serverId = $("#ddlServer").val();
        var payname = $("#txtPayName").val();
        var payPass = $("#txtPassPay").val();
        var captcha = $("#txtCaptCha").val();
        var verrify = $("#txtVerify").val();
        var timValue = $("#ddlVcoin").val();
        var accountName = "";
        if (isAuthen == "False")
            accountName = $("#txtAccountName").val();

        if (isAuthen == "False" && (accountName == null || accountName == "")) {
            //utils.errorMessage("Bạn vui lòng nhập tài khoản cần nạp.");
            utils.errorMessage_Recharge("Bạn vui lòng nhập tài khoản cần nạp.");
            return;
        }

        if (serverId == null || serverId == -1) {
            //utils.errorMessage("Vui lòng chọn máy chủ nạp tiền");
            utils.errorMessage_Recharge("Vui lòng chọn máy chủ nạp tiền");
            return;
        }
        if (payname == null || payname == "") {
            //utils.errorMessage("Vui lòng nhập Ví điện tử VTC Pay");
            utils.errorMessage_Recharge("Vui lòng nhập Ví điện tử VTC Pay");
            return;
        }
        if (payPass == null || payPass == "") {
            //utils.errorMessage("Vui lòng nhập mật khẩu Ví điện tử VTC Pay");
            utils.errorMessage_Recharge("Vui lòng nhập mật khẩu Ví điện tử VTC Pay");
            return;
        }
        if (timValue == null || timValue == 0) {
            //utils.errorMessage("Vui lòng chọn số Tim cần nạp");
            utils.errorMessage_Recharge("Vui lòng chọn số Tim cần nạp");
            return;
        }
        if (captcha == null || captcha == "") {
            //utils.errorMessage("Vui lòng nhập mã kiểm tra");
            utils.errorMessage_Recharge("Vui lòng nhập mã kiểm tra");
            return;
        }
        var antiforgeytoken = $('input[name=__RequestVerificationToken]').val();

        utils.loading();
        $.ajax({
            type: 'POST',
            url: appPath + 'RechargeCard/AuthenPay',
            data: {
                accountName: accountName,
                serverId: serverId,
                payName: payname,
                payPass: payPass,
                captcha: captcha,
                verrify: verrify,
                tim: timValue,
                __RequestVerificationToken: antiforgeytoken
            },
            success: function (data) {
                if (data.ResponseCode > 0) {
                    $.ajax({
                        type: 'GET',
                        url: appPath + 'RechargeCard/RechargeToPayStep2',
                        success: function (dataStep2) {
                            $("#rechargeCard").html(dataStep2);
                            utils.unLoading();
                        }
                    });
                } else {
                    utils.unLoading();
                    //utils.errorMessage(data.Msg);
                    utils.errorMessage_Recharge(data.Msg);
                    $("#txtVerify").val(data.CaptchaVerify);
                    $("#Imgcaptcha").attr('src', 'data:image/jpeg;base64,' + data.CaptchaImg);
                }
            }
        });
    },

    btnPaymentByPay2: function (odpStatus) {
        var odp = $("#txtOdp").val();
        if (odpStatus == 1 && (odp == null || odp == "")) {
            //utils.errorMessage("Vui lòng nhập mã xác nhận");
            utils.errorMessage_Recharge("Vui lòng nhập mã xác nhận");
            return;
        }
        var antiforgeytoken = $('input[name=__RequestVerificationToken]').val();
        utils.loading();
        $.ajax({
            type: 'POST',
            url: appPath + 'RechargeCard/TopupVcoinByPaygate',
            data: {
                odp: odp,
                __RequestVerificationToken: antiforgeytoken
            },
            success: function (data) {
                utils.unLoading();
                if (data.ResponseCode > 0) {
                    PopupCtrl.PopupMessage(data.Msg);
                } else {
                    //utils.errorMessage(data.Msg);
                    utils.errorMessage_Recharge(data.Msg);
                }
            },
            error: function () {
                utils.unLoading();
                //utils.errorMessage("Hệ thống đang bận. Bạn vui lòng quay lại sau");
                utils.errorMessage_Recharge("Hệ thống đang bận. Bạn vui lòng quay lại sau");
            }
        });
    },

    btnPaymentByVcoin: function (blance) {
        var serverGame = $("#ddlServer").val();
        var cardType = 1;
        var cardSerialTelco = "";
        var cardSerialVcoin = "";
        var cardCode = "";
        var captCha = $("#txtCaptCha").val();
        var verify = $("#txtVerify").val();
        var tim = $("#ddlVcoin").val();
        var voinType = "";

        if (blance == 0) {
            //utils.errorMessage("Bạn không đủ vcoin để nạp");
            utils.errorMessage_Recharge("Bạn không đủ vcoin để nạp");
            return;
        }
        if (tim == 0) {
            //utils.errorMessage("Bạn vui lòng chọn số Vàng muốn nạp");
            utils.errorMessage_Recharge("Bạn vui lòng chọn số Vàng muốn nạp");
            return;
        }
        if (serverGame == null || serverGame == -1) {
            //utils.errorMessage("Bạn vui lòng chọn máy chủ");
            utils.errorMessage_Recharge("Bạn vui lòng chọn máy chủ");
            return;
        }
        if (captCha == null || captCha == "") {
            //utils.errorMessage("Bạn vui lòng nhập mã xác nhận");
            utils.errorMessage_Recharge("Bạn vui lòng nhập mã xác nhận");
            return;
        }
        var cardSerial;
        if (cardType == 1) {
            cardSerial = voinType + cardSerialVcoin;
        } else {
            cardSerial = cardSerialTelco;
        }
        var vcoin = parseInt(tim) / 10;
        var antiforgeytoken = $('input[name=__RequestVerificationToken]').val();
        utils.loading();
        $.ajax({
            type: 'POST',
            url: appPath + 'RechargeCard/BillingTopupGame',
            data: {
                billingType: 5,
                serverId: serverGame,
                vcoin: vcoin,
                cardSerial: cardSerial,
                cardCode: cardCode,
                captcha: captCha,
                verify: verify,
                __RequestVerificationToken: antiforgeytoken
            },
            success: function (data) {
                utils.unLoading();
                if (data.ResponseCode > 0) {
                    PopupCtrl.PopupMessage(data.Msg);
                } else {
                    utils.unLoading();
                    //utils.errorMessage(data.Msg);
                    utils.errorMessage_Recharge(data.Msg);
                    $("#txtVerify").val(data.CaptchaVerify);
                    $("#Imgcaptcha").attr('src', 'data:image/jpeg;base64,' + data.CaptchaImg);
                }
            },
            error: function () {
                utils.unLoading();
                //utils.errorMessage("Hệ thống đang bận. Bạn vui lòng quay lại sau");
                utils.errorMessage_Recharge("Hệ thống đang bận. Bạn vui lòng quay lại sau");
            }
        });
    },

    btnPaymentByGoldChange: function () {
        var serverGame = $("#ddlServer").val(); 
        var captCha = $("#txtCaptCha").val();
        var verify = $("#txtVerify").val();
        var gold = $("#ddlGold").val(); 

        if (captCha == null || captCha == "") {
            //utils.errorMessage("Bạn vui lòng nhập mã xác nhận");
            utils.errorMessage_Recharge("Bạn vui lòng nhập mã xác nhận");
            return;
        }

        if (serverGame == null || serverGame == -1) {
            //utils.errorMessage("Bạn vui lòng chọn máy chủ");
            utils.errorMessage_Recharge("Bạn vui lòng chọn máy chủ");
            return;
        }

        if (gold == 0) {
            //utils.errorMessage("Bạn vui lòng chọn số Vàng muốn nạp");
            utils.errorMessage_Recharge("Bạn vui lòng chọn số Vàng muốn đổi");
            return;
        }

        var antiforgeytoken = $('input[name=__RequestVerificationToken]').val();
        utils.loading();
        $.ajax({
            type: 'POST',
            url: appPath + 'RechargeCard/BillingTopupGameGoldChange',
            data: {
                gold : gold,
                serverId: serverGame, 
                captcha: captCha,
                verify: verify,
                __RequestVerificationToken: antiforgeytoken
            },
            success: function (data) {
                utils.unLoading();
                if (data.ResponseCode > 0) {
                    PopupCtrl.PopupMessage(data.Msg);
                }
                else {
                    utils.unLoading();
                    //utils.errorMessage(data.Msg);
                    utils.errorMessage_Recharge(data.Msg);
                    $("#txtVerify").val(data.CaptchaVerify);
                    $("#Imgcaptcha").attr('src', 'data:image/jpeg;base64,' + data.CaptchaImg);
                }
            },
            error: function () {
                utils.unLoading();
                //utils.errorMessage("Hệ thống đang bận. Bạn vui lòng quay lại sau");
                utils.errorMessage_Recharge("Hệ thống đang bận. Bạn vui lòng quay lại sau");
            }
        });
    },

    btnPaymentByCardClick: function (isAuthen) {
        var serverGame = $("#ddlServer").val();
        var cardType = $("#serviceCardProvider").val();
        var cardSerialTelco = $("#txtCardSerialTelco").val();
        var cardSerialVcoin = $("#txtCardSerialVcoin").val();
        var cardCode = $("#txtCardCode").val();
        var captCha = $("#txtCaptCha").val();
        var verify = $("#txtVerify").val();
        var voinType = $("#ddlVcoinType").val();
        var accountName = "";
        if (isAuthen == "False")
            accountName = $("#txtAccountName").val();

        if (isAuthen == "False" && (accountName == null || accountName == "")) {
            //utils.errorMessage("Bạn vui lòng nhập tài khoản cần nạp.");
            utils.errorMessage_Recharge("Bạn vui lòng nhập tài khoản cần nạp.");
            return;
        }
        if (serverGame == null || serverGame == -1) {
            //utils.errorMessage("Bạn vui lòng chọn máy chủ.");
            utils.errorMessage_Recharge("Bạn vui lòng chọn máy chủ.");
            return;
        }
        if (cardType == 0) {
            //utils.errorMessage("Bạn vui lòng chọn loại thẻ.");
            utils.errorMessage_Recharge("Bạn vui lòng chọn loại thẻ.");
            return;
        }
        if (cardType == 1 && (cardSerialVcoin == null || cardSerialVcoin == "")) {
            //utils.errorMessage("Bạn vui lòng nhập số Sêri thẻ.");
            utils.errorMessage_Recharge("Bạn vui lòng nhập số Sêri thẻ.");
            return;
        }
        if (cardType != 1 && (cardSerialTelco == null || cardSerialTelco == "")) {
            //utils.errorMessage("Bạn vui lòng nhập số Sêri thẻ.");
            utils.errorMessage_Recharge("Bạn vui lòng nhập số Sêri thẻ.");
            return;
        }
        if (cardCode == null || cardCode == "") {
            //utils.errorMessage("Bạn vui lòng nhập mã thẻ.");
            utils.errorMessage_Recharge("Bạn vui lòng nhập mã thẻ.");
            return;
        }
        if (captCha == null || captCha == "") {
            //utils.errorMessage("Bạn vui lòng nhập mã xác nhận.");
            utils.errorMessage_Recharge("Bạn vui lòng nhập mã xác nhận.");
            return;
        }
        var cardSerial;
        if (cardType == 1) {
            cardSerial = voinType + cardSerialVcoin;
        } else {
            cardSerial = cardSerialTelco;
        }
        var antiforgeytoken = $('input[name=__RequestVerificationToken]').val();
        utils.loading();
        $.ajax({
            type: 'POST',
            url: appPath + 'RechargeCard/BillingTopupGame',
            data: {
                accountName: accountName,
                billingType: cardType,
                vcoin: 0,
                serverId: serverGame,
                cardSerial: cardSerial,
                cardCode: cardCode,
                captcha: captCha,
                verify: verify,
                __RequestVerificationToken: antiforgeytoken
            },
            success: function (data) {
                utils.unLoading();
                if (data.ResponseCode > 0) {
                    PopupCtrl.PopupMessage(data.Msg);
                } else {
                    utils.unLoading();
                    //utils.errorMessage(data.Msg);
                    utils.errorMessage_Recharge(data.Msg);
                    $("#txtVerify").val(data.CaptchaVerify);
                    $("#Imgcaptcha").attr('src', 'data:image/jpeg;base64,' + data.CaptchaImg);
                }
            },
            error: function () {
                utils.unLoading();
                //utils.errorMessage("Hệ thống đang bận. Bạn vui lòng quay lại sau");
                utils.errorMessage_Recharge("Hệ thống đang bận. Bạn vui lòng quay lại sau");
            }
        });
    },

    btnPaymentByBankGate: function (isAuthen) {
        var serverId = $("#ddlServer").val();
        var bankid = $("#hdBankId").val();
        var captcha = $("#txtCaptCha").val();
        var verrify = $("#txtVerify").val();
        var timValue = $("#ddlVcoin").val();
        var accountName = $("#txtAccountName").val();

        if (accountName == null || accountName == "") {
            //utils.errorMessage("Bạn vui lòng nhập tài khoản cần nạp.");
            utils.errorMessage_Recharge("Bạn vui lòng nhập tài khoản cần nạp.");
            return;
        }
        if (serverId == null || serverId == -1) {
            //utils.errorMessage("Vui lòng chọn máy chủ nạp tiền");
            utils.errorMessage_Recharge("Vui lòng chọn máy chủ nạp tiền");
            return;
        }
        if (bankid == null || bankid == '') {
            //utils.errorMessage("Bạn vui lòng chọn thẻ ngân hàng.");
            utils.errorMessage_Recharge("Bạn vui lòng chọn thẻ ngân hàng.");
            return;
        }
        if (timValue == null || timValue == 0) {
            //utils.errorMessage("Vui lòng chọn số Vàng cần nạp");
            utils.errorMessage_Recharge("Vui lòng chọn số Vàng cần nạp");
            return;
        }
        if (captcha == null || captcha == "") {
            //utils.errorMessage("Vui lòng nhập mã kiểm tra");
            utils.errorMessage_Recharge("Vui lòng nhập mã kiểm tra");
            return;
        }
        var antiforgeytoken = $('input[name=__RequestVerificationToken]').val();
        utils.loading();
        $.ajax({
            type: 'POST',
            url: appPath + 'RechargeCard/PaymentByBankGate',
            data: {
                accountName: accountName,
                serverId: serverId,
                bankType: 1,
                bankRef: bankid,
                quantityTim: timValue,
                captcha: captcha,
                verify: verrify,
                __RequestVerificationToken: antiforgeytoken
            },
            success: function (data) {
                if (data.ResponseCode > 0) {
                    if (data.ResponseCode == 10 && data.RedirectUrl != '') {
                        var html = decodeURIComponent((data.RedirectUrl + '').replace(/\+/g, '%20'));
                        utils.loading();
                        var decoded = $('<div/>').html(html).text();
                        document.body.innerHTML = decoded;
                        window.onload = document.FormTransfer.submit();
                    }
                    else {
                        window.location = data.RedirectUrl;
                    }
                } else {
                    utils.unLoading();
                    //utils.errorMessage(data.Msg);
                    utils.errorMessage_Recharge(data.Msg);
                    $("#txtVerify").val(data.CaptchaVerify);
                    $("#Imgcaptcha").attr('src', 'data:image/jpeg;base64,' + data.CaptchaImg);
                }
            },
            error: function () {
                utils.unLoading();
                //utils.errorMessage("Hệ thống đang bận. Bạn vui lòng quay lại sau");
                utils.errorMessage_Recharge("Hệ thống đang bận. Bạn vui lòng quay lại sau");
            }
        });
    },

    resendOdp: function (accountName) {
        $.ajax({
            type: 'POST',
            url: appPath + 'RechargeCard/ReSendOdp',
            data: {
                accountName: accountName
            },
            success: function (data) {
                utils.unLoading();

                //$("#lblError").html(data.Msg);
                $("#lblError_Recharge").html(data.Msg);
            },
            error: function () {
                utils.unLoading();
                $("#lblError_Recharge").html("Hệ thống đang bận. Bạn vui lòng quay lại sau");
            }
        });
    },

    // Event gold exchange
    Gold_Exchange: function (type) {
        var input = {
            type: type
        };
        utils.loading();
        $.ajax({
            type: "GET",
            url: appPath + "RechargeCard/Gold_Exchange",
            data: input,
            contentType: "application/json; charset=utf-8",
            dataType: "html",
            success: function (data) {
                utils.unLoading();
                $("#popupwrap").remove(); $("#overlayPopup").remove();
                $('BODY').append('<div id="popupwrap"></div><div id="overlayPopup" onclick="utils.hidePoup()" style="height:' + utils.documentHeight() + 'px; width:' + utils.documentWidth() + 'px; position: absolute;z-index: 1200;top: 0;left: 0;width: 100%;display: block;opacity: .80;background: #222;filter: alpha(opacity=60);-moz-opacity: 0.8;"></div>');
                $("#popupContent").html(data); $("#popupwrap").html(data);
                var width = 450;
                var height = 500;
                var topOffset = (((utils.windowHeight() - height) / 2) * 100) / utils.windowHeight();
                var leftOffset = (((utils.windowWidth() - width) / 2) * 100) / utils.windowWidth();
                $('#popupwrap').css('left', leftOffset + "%");
                $('#popupwrap').css("top", topOffset + '%');
                $('#popupwrap').css('z-index', 1201);
                $('#popupwrap').css('position', 'fixed');
            }
        });
    },

    // Event recharge history
    RechargeHistory: function (type) {
    var input = {
        type: type
    };
    utils.loading();
    $.ajax({
        type: "GET",
        url: appPath + "RechargeCard/RechargeHistory",
        data: input,
        contentType: "application/json; charset=utf-8",
        dataType: "html",
        success: function (data) {
            utils.unLoading();
            $("#popupwrap").remove(); $("#overlayPopup").remove();
            $('BODY').append('<div id="popupwrap"></div><div id="overlayPopup" onclick="utils.hidePoup()" style="height:' + utils.documentHeight() + 'px; width:' + utils.documentWidth() + 'px; position: absolute;z-index: 1200;top: 0;left: 0;width: 100%;display: block;opacity: .80;background: #222;filter: alpha(opacity=60);-moz-opacity: 0.8;"></div>');
            $("#popupContent").html(data); $("#popupwrap").html(data);
            var width = 450;
            var height = 500;
            var topOffset = (((utils.windowHeight() - height) / 2) * 100) / utils.windowHeight();
            var leftOffset = (((utils.windowWidth() - width) / 2) * 100) / utils.windowWidth();
            $('#popupwrap').css('left', leftOffset + "%");
            $('#popupwrap').css("top", topOffset + '%');
            $('#popupwrap').css('z-index', 1201);
            $('#popupwrap').css('position', 'fixed');
        }
    });
    }
}

// tienpx add modul cookie 17/03/2016
function setCookie(cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
    var expires = " Path=/; expires=" + d.toUTCString();
    document.cookie = cname + "=" + cvalue + "; " + expires;
}
function getCookie(cname) {
    var name = cname + "=";
    var ca = document.cookie.split(';');
    for (var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') c = c.substring(1);
        if (c.indexOf(name) == 0) return c.substring(name.length, c.length);
    }
    return "";
}
function del_cookie(name) {
    document.cookie = name +
    '=; Path=/; expires=Thu, 01-Jan-70 00:00:01 GMT;';
}
// end add modul cookie