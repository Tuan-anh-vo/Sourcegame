var HEADER_URL= root;
var ConfigHeader = {
    HEADER_URL: HEADER_URL,
};

Static_AddReference = function (url, type) {
    var fileref = "";
    if (type == "js") {
        fileref = document.createElement("script");
        fileref.setAttribute("type", "text/javascript");
        fileref.setAttribute("src", url);
    } else if (type == "css") {
        fileref = document.createElement("link");
        fileref.setAttribute("rel", "stylesheet");
        fileref.setAttribute("type", "text/css");
        fileref.setAttribute("href", url);
    }
    if (typeof fileref != "undefined")
        document.getElementsByTagName("head")[0].appendChild(fileref);
};

Static_AddReference(ConfigHeader.HEADER_URL + 'static/teaser/css/headerCSS.css', 'css');
Static_AddReference(ConfigHeader.HEADER_URL + 'static/teaser/js/AccountRegister.js', 'js');

//Static_AddReference(ConfigHeader.HEADER_URL + 'static/teaser/js/commonHead.js', 'js');
//Static_AddReference(ConfigHeader.HASH_URL, 'js');
//Static_AddReference(ConfigHeader.HEADER_URL + 'css/bootstrap.min.css', 'css');
//Static_AddReference(ConfigHeader.HEADER_URL + 'css/component.css', 'css');
//Static_AddReference(ConfigHeader.HEADER_URL + 'css/default.css', 'css');
//Static_AddReference(ConfigHeader.HEADER_URL + 'CSS.css', 'css');

//I get this code from here http://stackoverflow.com/questions/901115/how-can-i-get-query-string-values-in-javascript
function getUrlParameterByName(name, url) {
    if (!url) url = window.location.href;
    name = name.replace(/[\[\]]/g, "\\$&");
    var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
        results = regex.exec(url);
    if (!results) return null;
    if (!results[2]) return '';
    return decodeURIComponent(results[2].replace(/\+/g, " "));
}
//Static_AddReference(ConfigHeader.HEADER_URL + 'Scripts/jquery-1.10.2.js', 'js');
function calPopLogin(returnUrl) {
    var urlPopup = ConfigHeader.HEADER_URL + "popup/popup_login";
    if (returnUrl != null && returnUrl.length > 0) {
        urlPopup = urlPopup + '?returnUrl=' + returnUrl;
    }
    $.ajax({
        type: "POST",
        url: urlPopup,
        crossDomain: true,
        xhrFields: {
            withCredentials: true
        },
        success: function (data) {
            if (data) {
                $("#LogAndReg").html(data);
            }
        }
    });
}
function calPopReg(returnUrl) {
    var urlPopup = ConfigHeader.HEADER_URL + "home/PopupRegister";
    if (returnUrl != null && returnUrl.length > 0) {
        urlPopup = urlPopup + '?returnUrl=' + returnUrl;
    }
    $.ajax({
        type: "POST",
        url: urlPopup,
        crossDomain: true,
        xhrFields: {
            withCredentials: true
        },
        success: function (data) {
            if (data) {
                $("#LogAndReg").html(data);

            }
        }
    });
}
function RemovePopLogReg() {
    $("#LogAndReg").html("");
}
function showLogin() {
    $("#popLogin").css("display", "block");
}
function showRegister() {
    $(".tab-container").css("display", "block");
}

function LoginHead(idUname, idPass, idCaptcha, idImageCaptcha, idHidverify, idRemember, idOtp, idOtpType, idFrameCaptcha, idThongBao, returnUrl) {
    var flag = true;
    var username = $("#" + idUname).val();
    var pass = $("#" + idPass).val();
    var captcha = $("#" + idCaptcha).val();
    var hidverify = $("#" + idHidverify).val();
    var isRemember = false;

    if ($("#" + idRemember).is(':checked')) {
        isRemember = true;
    }
    var otp = $("#" + idOtp).val();
    var otpType = $("#" + idOtpType).find('option:selected').val();

    var key = $("#key").val();
    if (username == '' || pass == '') {
        thongbao(idThongBao, "Nh?p d?y d? các tru?ng thông tin");
        return;
    }
    if (!CommonValid.ValidateUserName(username)) {
        thongbao(idThongBao, "Tên không h?p l?");
        flag = false;
        flag = false;
        return;
    }
    if (!CommonValid.ValidateLetterPassword(pass)) {
        thongbao(idThongBao, "M?t kh?u không h?p l?");
        flag = false;
        return;
    }
    //var action = 'Login';
    //if ($("#" + idOtp).is(":visible")) {
    //    action = 'oauthOTP';
    //}
    $.ajax({
        beforeSend: function () {
            return flag;
        },
        type: "POST",
        url: ConfigHeader.HEADER_URL + "Handler/Process.ashx?act=Login",
        crossDomain: true,
        xhrFields: {
            withCredentials: true
        },
        data: {
            conten: btoa(username),
            value: btoa(pass),
            capt: captcha,
            hidverify: hidverify,
            isRemember: isRemember,
            key: key,
            otp: otp,
            otpType: otpType,
            returnURL: "http://localhost:3955/",
        },
        success: function (data) {
            if (data) {
                if (data.ResponseStatus > 0) {
                    var redirecUrl = returnUrl;
                    if (redirecUrl == null || redirecUrl == '') {
                        redirecUrl = getUrlParameterByName('returnUrl');
                    }
                    try {
                        if (typeof HeaderRedirecUrl != undefined && (redirecUrl == null || redirecUrl == '')) {
                            redirecUrl = HeaderRedirecUrl.RedirecUrl;
                        }
                    }
                    catch (e) {
                        console.log("reload this page");
                    }
                    if (redirecUrl != null && redirecUrl.length > 0) {
                        window.top.location = redirecUrl;
                    } else {
                        window.top.location.reload();
                    }
                }
                else {
                    if (data.errorCode == -1000) {
                        $("#" + idOtpType).css("display", "block");
                        $("#" + idOtp).css("display", "block");
                        $("#" + idImageCaptcha).attr("src", "data:image/jpeg;base64," + data.imageData);
                        $("#" + idHidverify).val(data.Verify);
                    }
                    else if (data.ResponseStatus == -1005) {
                        $("#" + idFrameCaptcha).css("display", "block");
                        $("#" + idImageCaptcha).attr("src", "data:image/jpeg;base64," + data.imageData);
                        $("#" + idHidverify).val(data.Verify);
                        thongbao(idThongBao, data.errorMessage);
                    }
                    else {
                        $("#" + idImageCaptcha).attr("src", "data:image/jpeg;base64," + data.imageData);
                        $("#" + idHidverify).val(data.Verify);
                        thongbao(idThongBao, data.errorMessage);
                    }
                }

            }
        }
    });
}
function LoginO_Auth(provider, url) {
    var redirecUrl = url;
    if (redirecUrl == null || redirecUrl == '') {
        redirecUrl = window.location.href;
    }
    try {
        if (typeof HeaderRedirecUrl != undefined && (redirecUrl == null || redirecUrl == '')) {
            redirecUrl = HeaderRedirecUrl.RedirecUrl;
        }
    }
    catch (e) {
        console.log("reload this page");
    }
    var serveridck = "";
    var linkgenck = "";
    try {
        if (typeof HeaderChackingObj != undefined) {
            serveridck = HeaderChackingObj.ServiceId;
            linkgenck = HeaderChackingObj.LinkGen;
        }
    }
    catch (e) {

    }

    //returnUrl = encodeURI(returnUrl)
    switch (provider) {
        case "facebook":
            
            window.location = ConfigHeader.HEADER_URL + 'Handler/Process.ashx?act=facebook&ReturnUrlFromExtend=' + encodeURIComponent(redirecUrl) + '&serveridck=' + serveridck + '&linkgenck=' + linkgenck;
            break;
        case "google":
            //console.log(ConfigHeader.HEADER_URL + 'Handler/Process.ashx?act=google&ReturnUrlFromExtend=' + encodeURIComponent(redirecUrl) + '&serveridck=' + serveridck + '&linkgenck=' + linkgenck);
            window.location = ConfigHeader.HEADER_URL + 'Handler/Process.ashx?act=google&ReturnUrlFromExtend=' + encodeURIComponent(redirecUrl) + '&serveridck=' + serveridck + '&linkgenck=' + linkgenck;
            break;
        case "yahoo":
            window.location = 'https://vtcgame.vn/account.sso.api/api/openid/login?openid_identifier=http://yahoo.com/&ReturnUrl=' + encodeURIComponent(utm.returnUrl + "&provider=yahoo") + '&sid=' + utm.sid + '&utm_source=' + utm.utm_source + '&utm_medium=' + utm.utm_medium + '&utm_campaign=' + utm.utm_campaign + '&serveridck=' + serveridck + '&linkgenck=' + linkgenck;
            break;
    }

}
function Logout() {
    $.ajax({
        type: "POST",
        url: ConfigHeader.HEADER_URL + "Handler/Process.ashx?act=Logout",
        crossDomain: true,
        xhrFields: {
            withCredentials: true
        },
        data: {

        },
        success: function (data) {
            if (data) {
                if (data.ResponseStatus > 0) {
                    window.top.location.reload();
                }
            }
        }
    });
}
function HeaderLogout() {
    $.ajax({
        type: "POST",
        url: ConfigHeader.HEADER_URL + "Handler/Process.ashx?act=Logout",
        crossDomain: true,
        xhrFields: {
            withCredentials: true
        },
        data: {

        },
        success: function (data) {
            if (data) {
                if (data.ResponseStatus > 0) {
                    window.top.location.reload();
                }
            }
        }
    });
}
function popupHeader(content) {
    alert(content);
    calPopLogin();
}
function thongbao(idThongBao, content) {
    $("#" + idThongBao).html(content);
}

function RegisterHead(idUname, idPass, idPass2, idCaptchaInput, idHidverify, idImgCaptcha, checkbox_dongy, idThongBao, returnUrl) {
    var flag = true;
    var username = $("#" + idUname).val();
    var pass = $("#" + idPass).val();
    var pass2 = ''//$("#" + idPass2).val();
    var captcha = $("#" + idCaptchaInput).val();
    var HidverifyVal = $("#" + idHidverify).val();

    var dongy = false;

    if ($("#" + checkbox_dongy).is(':checked')) {
        dongy = true;
    }
    else {
        thongbao(idThongBao, "B?n chua d?ng ý v?i th?a thu?n s? d?ng.");
        flag = false;
        return;
    }
    if (username == '' || pass == '' || captcha == '') {
        thongbao(idThongBao, "Hãy nh?p d?y d? các tru?ng thông tin");
        flag = false;
        return;
    }
    if (!CommonValid.ValidateUserName(username)) {
        thongbao(idThongBao, "Tên không h?p l?");
        flag = false;
    }
    if (!CommonValid.ValidateLetterPassword(pass)) {
        thongbao(idThongBao, "M?t kh?u không h?p l?");
        flag = false;
        return;
    }
    //if (pass2 != pass) {
    //    thongbao(idThongBao, "Nh?p l?i m?t kh?u không kh?p");
    //    flag = false;
    //    return;
    //}

    if (!ValidatePassRegister(idPass, idThongBao)) //m?t kh?u ph?i có d? dài t? 6-18 g?m ch? hoa,thu?ng và s?.
    {
        flag = false;
        return;
    }

    var key = $("#key").val();
    var serveridck = "";
    var linkgenck = "";
    try {
        if (typeof HeaderChackingObj != undefined) {
            serveridck = HeaderChackingObj.ServiceId;
            linkgenck = HeaderChackingObj.LinkGen;
        }
    }
    catch (e) {

    }
    $.ajax({
        beforeSend: function () {
            return flag;
        },
        type: "POST",
        url: ConfigHeader.HEADER_URL + "/Handler/Process.ashx?act=Register",
        crossDomain: true,
        xhrFields: {
            withCredentials: true
        },
        data: {
            conten: btoa(username),
            value: btoa(pass),
            value2: btoa(pass2),
            capt: captcha,
            hidverify: HidverifyVal,
            dongy: dongy,
            key: key,
            ServiceId: serveridck,
            LinkGen: linkgenck,
        },
        success: function (data) {
            if (data) {
                if (data.ResponseStatus > 0) {
                    var redirecUrl = returnUrl;
                    if (redirecUrl == null || redirecUrl == '') {
                        redirecUrl = getUrlParameterByName('returnUrl');
                    }
                    try {
                        if (typeof HeaderRedirecUrl != undefined && (redirecUrl == null || redirecUrl == '')) {
                            redirecUrl = HeaderRedirecUrl.RedirecUrl;
                        }
                    }
                    catch (e) {
                        console.log("reload this page");
                    }
                    if (redirecUrl != null && redirecUrl.length > 0) {
                        window.top.location = redirecUrl;
                    } else {
                        window.top.location.reload();
                    }
                }
                else {
                    $("#" + idHidverify).val(data.Verify);
                    $("#" + idImgCaptcha).attr("src", "data:image/jpeg;base64," + data.imageData);
                    thongbao(idThongBao, data.errorMessage);
                }
            }
        }
    });
}
function ValidatePassRegister(idPass, idThongBao) {
    var pass = $('#' + idPass).val();
    if (pass.length < 4 || pass.length > 18) { $('#' + idThongBao).html("M?t kh?u có d? dài 4-18 ký t?."); return false; }
    //var fliter = /^(?=.*\d)(?=.*[a-zA-Z]).{4,18}$/;
    //if (!fliter.test(pass)) { $('#' + idThongBao).html("M?t kh?u có d? dài 4-18 ký t?."); return false; }
    //for (var index = 0; index < pass.length; index++) {
    //    if (!CommonValid.ValidateLetterPassword(pass.charAt(index))) {
    //        $('#' + idThongBao).html("M?t kh?u có d? dài 4-18 ký t?."); return false;
    //    }
    //}
    //if (!CommonValid.ValidateLetterPassword(pass)) { $('#' + idThongBao).html("M?t kh?u có d? dài 4-18 ký t?."); return false; }
    //else {
    //    $('#' + idThongBao).html("");
    //    return true;
    //}
    $('#' + idThongBao).html("");
    return true;
}
function CheckAccount(idUname, idThongBao, accountName) {
    if (accountName.length < 4 || accountName.length > 16) {
        $('#' + idUname).focus();
        thongbao(idThongBao, "Tên tài khoản từ 4 - 16 ký từ và b?t d?u b?ng ch? cái");
        return false;
    }
    if (accountName.endsWith('.') || accountName.endsWith('_')) {
        $('#' + idUname).focus();
        thongbao(idThongBao, "Tên dang nh?p không du?c k?t thúc b?ng d?u '.' ho?c '_'");
        return false;
    }
    for (var index = 0; index < accountName.length; index++) {
        if (!CommonValid.ValidateUserName(accountName.charAt(index))) {
            $('#' + idUname).focus();
            thongbao(idThongBao, "Tên tài kho?n không du?c ch?a ký t? d?c bi?t");
            return false;
        }
    }
    var key = $("#key").val();
    $.ajax({
        type: "POST",
        url: ConfigHeader.HEADER_URL + "Handler/Process.ashx?act=CheckAccount",
        crossDomain: true,
        xhrFields: {
            withCredentials: true
        },
        data: {
            account_name: accountName,
            key: key,
        },
        success: function (data) {
            if (data) {
                if (data.ResponseStatus > 0) {
                    thongbao(idThongBao, "Tài kho?n dã t?n t?i.");
                    return false;
                }
                else if (data.ResponseStatus == -50) {
                    thongbao(idThongBao, "");
                    return true;
                }

            }
        }
    });

};
function encrypt(txt) {
    var key = CryptoJS.enc.Utf8.parse('8080808080808080');
    var iv = CryptoJS.enc.Utf8.parse('8080808080808080');

    var encryptedlogin = CryptoJS.AES.encrypt(CryptoJS.enc.Utf8.parse(txt), key,
    {
        keySize: 128 / 8,
        iv: iv,
        mode: CryptoJS.mode.CBC,
        padding: CryptoJS.pad.Pkcs7
    });
    return encryptedlogin;
}
function LoginOTP(name, passw) {

    $("#lbThongBao").html("------------------");
    var flag = true;
    if (name == null || name == undefined || passw == null || passw == undefined) {
        var username = $("#txtUserName").val();
        var pass = $("#txtPass").val();
        var otp = $("#otp").val();
        if ($("#txtUserName").val() == '' || $("#txtPass").val() == '' || otp == '') {
            //$("#lbThongBao").html("(*) Nh?p d?y d? các tru?ng thông tin");
            console.log("hay nhap day du cac truong thong tin");
            flag = false;
            return;
        }
    }
    else {
        var username = name;
        var pass = passw;
        flag = true;
    }

    $.ajax({
        beforeSend: function () {
            return flag;
        },
        type: 'POST',
        dataType: 'json',
        crossDomain: true,
        url: "http://localhost:1158/Handler/Authen.ashx",
        data: {
            act: "LoginOTP",
            username: username,
            pass: pass,
            OTP: otp,

        },
        success: function (data) {
            if (data) {//data.AccId > 0) {
                if (data.status == 11) {

                    alert("login success, please redirect to header index setForm authen");
                }
                else {
                    window.top.location.href = "http://localhost:1158/home/index"
                }


            } else {
                console.log("login fail")

            }
        }


    });
}

function showPopupOtp() {
    $(".tab-container2").css("display", "block");
}

function pThongBao(content) {
    alert(content);
    window.top.location.reload();
}
function RefreshCaptcha(idImages, idVerify) {

    $.ajax({
        type: "GET",
        url: ConfigHeader.HEADER_URL + 'Handler/Process.ashx?act=getCaptcha',
        data: {
        },
        crossDomain: true,
        xhrFields: {
            withCredentials: true
        },
        success: function (data) {

            if (data) {
                $(idImages).attr("src", "data:image/jpeg;base64," + data.imageData);
                $(idVerify).val(data.verify);
            }
        }
    });
}
function DKVip() {

    $.ajax({
        type: "GET",
        url: ConfigHeader.HEADER_URL + 'Handler/Process.ashx?act=VipRegister',
        data: {
        },
        crossDomain: true,
        xhrFields: {
            withCredentials: true
        },
        success: function (data) {

            if (data) {
                if (data.ResponseStatus > 0) {
                    alert("Kích Ho?t Vip Thành Công!");
                }
                else {
                    alert("kích ho?t vip th?t b?i.");
                }
            }
        }
    });
}