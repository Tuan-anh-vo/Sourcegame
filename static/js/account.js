$(document).ready(function() {

    $('.li_tab_sel').click(function(){
        var tab = $(this).children('a').data('tab');
        $('.li_tab_sel').removeClass('cg_current_login');
        $(this).addClass('cg_current_login');
        $('.cg_tab_content_login').hide();
        $(tab).show();
    })
    
    $('.pp_keydown_dn').keydown(function (e) {
        if (e.keyCode == 13){
            loginUser('#form-login','.kq_login');
        }
    });
    $('.pp_keydown_dk').keydown(function (e) {
        if (e.keyCode == 13){
            registerUser('#form-register','.kq_reg');
        }
    });
    $('.keydown_h').keydown(function (e) {
        if (e.keyCode == 13){
            loginUser('#login-home','.kq_login_h');
        }
    });
});

function loginUser(idUname, idPass, idRemember, idThongBao, returnUrl){
    var username = $(idUname).val();
    var password = $(idPass).val();
    var isRemember = false;

    if ($(idRemember).is(':checked')) {
        isRemember = true;
    }

    if (username == '' || password == '') {
        thongbao(idThongBao, "Nhập đầy đủ các trường thông tin !");
        return;
    }

    if (!CommonValid.ValidateUserName(username)) {
        thongbao(idThongBao, "Tên đăng nhập không hợp lệ !");
        return;
    }

    if (!CommonValid.ValidateLetterPassword(password)) {
        thongbao(idThongBao, "Mật khẩu không hợp lệ !");
        flag = false;
        return;
    }

    $.ajax({
        type:"POST",
        dataType: "json",
        url:root+"user/ajaxLogin",
        data: {
            username: username,
            password: password,
            isRemember: isRemember,
            returnURL: returnUrl,
        },
        success:function(result){
            if(result.status == 1){
                // setConfirmUnload(false);

                thongbao(idThongBao, "<span style='color: blue;'>"+result.msg+"</span>");

                setTimeout(function(){
                    location.href = root
                },2000);

            }else{
                thongbao(idThongBao, result.msg);
            }
        }
    });
}
function registerUser(idUname, idEmail, idPass, idCaptchaInput, checkbox_dongy, idThongBao, returnUrl){
    var username = $(idUname).val();
    var email = $(idEmail).val();
    var password = $(idPass).val();
    var captcha = $(idCaptchaInput).val();
    var dongy = false;
    if ($(checkbox_dongy).is(':checked')) {
        dongy = true;
    }
    else {
        thongbao(idThongBao, "Bạn chưa đồng ý với thỏa thuận sử dụng.");
        return;
    }
    if (username == '' || email == '' || password == '' || captcha == '') {
        thongbao(idThongBao, "Hãy nhập đầy đủ các trường thông tin");
        return;
    }
    if (!CommonValid.ValidateUserName(username)) {
        thongbao(idThongBao, "Tên không hợp lệ");
    }
    if (!CommonValid.ValidateLetterPassword(password)) {
        thongbao(idThongBao, "Mật khẩu không hợp lệ");
        return;
    }
    if (!ValidatePassRegister(idPass, idThongBao)) { //m?t kh?u ph?i có d? dài t? 6-18 g?m ch? hoa,thu?ng và s?.
        return;
    }

    $.ajax({
        type:"POST",
        dataType: "json",
        url:root+"user/ajaxRegister",
        data: {
            username: username,
            email: email,
            password: password,
            capt: captcha,
            dongy: dongy,
            returnURL: returnUrl,
        },
        success:function(result){
            if(result.status){
                check_register_convertion();
                // setConfirmUnload(false);
                thongbao(idThongBao, "<span style='color: blue;'>"+result.msg+"</span>");
                setTimeout(function(){location.href = root }, 3000);
            }else{
                thongbao(idThongBao, result.msg);
            }
        }
    });
}

function ValidatePassRegister(idPass, idThongBao) {
    var pass = $(idPass).val();
    if (pass.length < 4 || pass.length > 18) { $(idThongBao).html("Mật khẩu có độ dài 4-18 ký tự."); return false; }
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
    $(idThongBao).html("");
    return true;
}

function thongbao(idThongBao, content) {
    $(idThongBao).html(content);
    setTimeout(function(){
        $(idThongBao).html("");
    },3000);
}
/* START OF VALIDATE ------------------------------------------------------- */
var CommonValid = new function () {
    this.ValidateEmail = function (_email) { var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/; return filter.test(_email); };
    this.ValidateOnlyLetter = function (_text) { var filter = /^[a-zA-Z]+$/; return filter.test(_text); };
    this.ValidateLetter = function (_text) { var filter = /^[a-zA-Z0-9]+$/; return filter.test(_text); };
    this.ValidateLetterPassword = function (_text) { var filter = /^[a-zA-Z0-9\.\_~!@#$%^&*(:)-+=]+$/; return filter.test(_text); };
    this.ValidateUserName = function (_text) { var filter = /^[a-zA-Z0-9._]+$/; return filter.test(_text); };
    this.ValidateNumberOnly = function (_text) { var filter = /^[0-9]+$/; return filter.test(_text); };

    this.InputExtender = function (id, type) {
        try {
            var val = $('#' + id).val();
            //alert(val);
            if (val == '' || val == 'undefined') {
                return;
            }

            var str = '';
            switch (type) {
                case 0:
                    for (var index = 0; index < val.length; index++) {
                        if (CommonValid.ValidateLetter(val.charAt(index))) {
                            str += val.charAt(index);
                        }
                        $('#' + id).val(str);
                    }

                    break;
                case 1:
                    for (var index = 0; index < val.length; index++) {
                        if (CommonValid.ValidateNumberOnly(val.charAt(index))) {

                            str += val.charAt(index);
                        }
                    }

                    $('#' + id).val(str);

                    break;
                case 2:
                    for (var index = 0; index < val.length; index++) {
                        if (CommonValid.ValidateOnlyLetter(val.charAt(index))) {
                            str += val.charAt(index);
                        }
                        $('#' + id).val(str);
                    }

                    break;
                case 3:
                    for (var index = 0; index < val.length; index++) {
                        if (CommonValid.ValidateLetterPassword(val.charAt(index))) {
                            str += val.charAt(index);
                        }
                        $('#' + id).val(str);
                    }
                    break;
                case 4:
                    for (var index = 0; index < val.length; index++) {
                        if (CommonValid.ValidateUserName(val.charAt(index))) {
                            str += val.charAt(index);
                        }
                        $('#' + id).val(str);
                    }
                    break;
            }
        }
        catch (err) { alert(err); }
    };
}