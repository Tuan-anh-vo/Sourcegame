RegisterAccount = new function () {
    this.TimmerGameId;
    this.AccountId;
    this.Gender;
    this.LocationID;
    this.DistrictID;
    this.WardID;
    this.Day;
    this.Month;
    this.Year;
    this.Address;

    this.HtmlTag = new function () {
        this.AccountNameValid = false;
        this.EmailValid = false;
        this.inputFullName = $('#inputFullName');
        this.inputPhoneNumber = $('#inputPhoneNumber');
        this.ddlLocation = $('#ddlLocation');
        this.ddlDistrict = $('#dllDistrict');
        this.ddlVillage = $('#ddlVillage');
        this.inputDetail = $('#inputDetail');
        this.ddlDay = $('#ddlDay');
        this.ddlMonth = $('#ddlMonth');
        this.ddlYear = $('#ddlYear');
    };

    this.SetWaring = function (id, imgName, text) {
        //EbankUtility.UnLoading();
        $('#' + id).empty();
        $('#' + id).append('<img width="16" height="16" class="tick" src="' + EbankUtility.ResourcesUrl + 'images/ebank21/' + imgName + '.png">');
        $('.erro').html(text);
        if (text.length <= 0)
            $('.erro').hide();
        else
            $('.erro').show();
    };
    this.CheckAccount = function (accountName) {
        if (accountName.length < 4 || accountName.length > 16) {
            $('#txtAccountName').focus();
            RegisterAccount.SetWaring('noteAccount', 'cancel', RegisterContent.AccountValid);
            return;
        }
        for (var index = 0; index < accountName.length; index++) {
            if (!EbankUtility.ValidateUserName(accountName.charAt(index))) {
                $('#txtAccountName').focus();
                RegisterAccount.SetWaring('noteAccount', 'cancel', RegisterContent.UserNameInvalid);
                return;
            }
        }

        var data = { t: "CheckAccountExist", accName: accountName };
        EbankUtility.GetPublisherJson(EbankUtility.eBank21Url + "Handler/AccountHandler.ashx", data, function (data) {
            if (data != null && data != 'undefined') {
                var status = data[0].Status;
                if (status > 0) {
                    RegisterAccount.SetWaring('noteAccount', 'cancel', RegisterContent.AccountExisted);
                }
                else {
                    RegisterAccount.SetWaring('noteAccount', 'tick', '');
                    $('#txtAccountName').parent().next().show();
                }
            }
        });



    };
    this.CheckCaptcha = function (code) {
        if (code.length < 6) {
            $('#txtCaptcha').focus();
            $('.code').attr('src', EbankUtility.Url + 'handler/Captcha.ashx?t=' + new Date().getTime());
            RegisterAccount.SetWaring('noteCaptcha', 'cancel', RegisterContent.SecurityCodeInvalid);
            return;
        }

        var Idata = { data: '[{"Captcha":"' + code + '"}]', dataverify: '', asign: $("#txtCaptcha").attr('rel') };
        Idata.dataverify = calcMD5(Idata.data);
        EbankUtility.GetPublisherWebService(EbankUtility.Url + 'webServices/RegisterService.asmx', Idata, function (result) {
            switch (result.d) {
                case -41:
                    $('#txtCaptcha').focus();
                    $('.code').attr('src', EbankUtility.Url + 'handler/Captcha.ashx?t=' + new Date().getTime());
                    RegisterAccount.SetWaring('noteCaptcha', 'cancel', RegisterContent.EmailExisted);
                    break;
                case 1:
                    RegisterAccount.SetWaring('noteCaptcha', 'tick', '');
                    break;
                case -1000:
                    //sai chu ky
                    $('.code').attr('src', EbankUtility.Url + 'handler/Captcha.ashx?t=' + new Date().getTime());
                    RegisterAccount.SetWaring('noteCaptcha', 'cancel', RegisterContent.AsingInvalid);
                    break;
                case -1001:
                    //verify data invalid
                    $('.code').attr('src', EbankUtility.Url + 'handler/Captcha.ashx?t=' + new Date().getTime());
                    RegisterAccount.SetWaring('noteCaptcha', 'cancel', RegisterContent.DataverifyInvalid);
                    break;
                case -1006:
                    //Lenght < 4
                    $('#txtCaptcha').focus();
                    $('.code').attr('src', EbankUtility.Url + 'handler/Captcha.ashx?t=' + new Date().getTime());
                    RegisterAccount.SetWaring('noteCaptcha', 'cancel', RegisterContent.SecurityCodeInvalid);
                    break;

            }
        }, 'CheckSecurityCode');
    };
    this.Register = function () {
        var account = $('#txtAccountName').val().trim();
        if (account.length < 4 || account.length > 16) {
            $('#txtAccountName').focus();
            RegisterAccount.SetWaring('noteAccount', 'cancel', RegisterContent.AccountInvalid);
            return;
        }
        var pass = $('#txtPassword').val().trim();
        if (pass.length < 6 || pass.length > 18) { $('#txtPassword').focus(); RegisterAccount.RefreshCaptcha(); RegisterAccount.SetWaring('notePassword', 'cancel', RegisterContent.PasswordInvalid); return; }
        var fliter = /^(?=.*\d)(?=.*[a-zA-Z]).{6,16}$/;
        if (!fliter.test(pass)) { RegisterAccount.SetWaring('notePassword', 'cancel', RegisterContent.PasswordInvalid); return; }
        var Repass = $('#txtRePassword').val();
        if (Repass != pass) { $('#txtRePassword').focus(); RegisterAccount.RefreshCaptcha(); RegisterAccount.SetWaring('noteRePassword', 'cancel', RegisterContent.RePassInvalid); return; }
        var code = $('#txtCaptcha').val();
        if (code.length < 6) {
            $('#txtCaptcha').focus();
            RegisterAccount.RefreshCaptcha();
            RegisterAccount.SetWaring('noteCaptcha', 'cancel', RegisterContent.SecurityCodeInvalid);
            return;
        }
        var cbagree = $('input[id=cbAgree]').is(':checked');
        if (!cbagree) {
            $('.erro').html(RegisterContent.CheckAgree);
            $('.erro').show();
            EbankUtility.ScrollTop();
            return;
        }
        var GameList = '';
        $("input[name='options[]']:checked").each(function () {
            GameList += $(this).val() + ',';
        });
        if (GameList.length > 0)
            GameList = GameList.substr(0, GameList.length - 1);

        var Idata = { data: '[{"AccountName":"' + account + '","Password":"' + pass + '","Email":"' + '' + '","Passport":"' + '' + '","QuestionID":' + 0 + ',"Answer":"' + '' + '","JoinFrom":' + joinFrom + ',"Captcha":"' + code + '","ReceiveEMail":' + ($('input[id=cbReceive]').is(':checked') ? true : false) + ',"GameService":"' + GameList + '"}]', dataverify: '' };
        Idata.dataverify = calcMD5(Idata.data);


        EbankUtility.Loading();
        EbankUtility.GetPublisherWebService(EbankUtility.Url + 'webServices/RegisterService.asmx', Idata, function (result) {
            //EbankUtility.UnLoading();
            var info = eval(result.d);
            if (info[0].Status > 0) {
                RegisterAccount.AccountId = info[0].Status;
                window.location = EbankUtility.Url + EbankUtility.InsertAccountInfoURL;
                return;
            }
            else {
                RegisterAccount.RefreshCaptcha();

                switch (info[0].Status) {
                    case -46:
                        $('#txtAccountName').focus();
                        RegisterAccount.SetWaring('noteAccount', 'cancel', RegisterContent.AccountExisted);
                        break;
                    case -1000:

                        RegisterAccount.SetWaring('noteEmail', 'cancel', RegisterContent.AsingInvalid);
                        break;
                    case -1001:
  
                        RegisterAccount.SetWaring('noteEmail', 'cancel', RegisterContent.DataverifyInvalid);
                        break;
                    case -1004:
                        //Lenght < 4
                        RegisterAccount.SetWaring('noteAccount', 'cancel', RegisterContent.AccountInvalid);
                        break;
                    case -1006:
                        $('#txtCaptcha').focus();
                        RegisterAccount.SetWaring('noteCaptcha', 'cancel', RegisterContent.SecurityCodeInvalid);
                        break;
                    case -3: 
                        $('#txtPassword').focus();
                        RegisterAccount.SetWaring('notePassword', 'cancel', RegisterContent.PasswordInvalid);
                        break;
                }
            }

        }, 'Register');
    };

    this.RefreshCaptcha = function () { $('.code').attr('src', EbankUtility.Url + 'handler/Captcha.ashx?t=' + new Date().getTime()); };

    $("#txtAccountName").change(function () { RegisterAccount.CheckAccount($('#txtAccountName').val()); });

    $('#txtPassword').change(function () {
        var pass = $('#txtPassword').val();
        if (pass.length < 6 || pass.length > 16) { RegisterAccount.SetWaring('notePassword', 'cancel', RegisterContent.PasswordInvalid); return; }
        var fliter = /^(?=.*\d)(?=.*[a-zA-Z]).{6,16}$/;
        if (!fliter.test(pass)) { RegisterAccount.SetWaring('notePassword', 'cancel', RegisterContent.PasswordInvalid); return; }
        for (var index = 0; index < pass.length; index++) {
            if (!EbankUtility.ValidateLetterPassword(pass.charAt(index))) {
                RegisterAccount.SetWaring('notePassword', 'cancel', RegisterContent.PasswordInvalid); return;
            }
        }
        if (!EbankUtility.ValidateLetterPassword(pass)) { RegisterAccount.SetWaring('notePassword', 'cancel', RegisterContent.PasswordInvalid); return; }
        else {
            RegisterAccount.SetWaring('notePassword', 'tick', '');
        }
    });

    $('#txtRePassword').change(function () {
        if ($('#txtPassword').val().length <= 0) { $('#txtPassword').focus(); $('#txtPassword').val(''); return; }
        var pass = $('#txtRePassword').val();
        if (pass != $('#txtPassword').val()) { RegisterAccount.SetWaring('noteRePassword', 'cancel', RegisterContent.RePassInvalid); return; }
        else {
            RegisterAccount.SetWaring('noteRePassword', 'tick', '');
            $('#txtRePassword').parent().next().show();
        }
    });

    $("#txtCaptcha").change(function () { RegisterAccount.CheckCaptcha($('#txtCaptcha').val()); });

    $("#btnRegister").click(function () { RegisterAccount.Register(); });

    $('#btnConfirm').click(function () { RegisterAccount.Register(); });



    this.checkInput = function () {
        var account = $('#txtAccountName');
        if (account.val().trim().length < 4 || account.val().trim().length > 16) {
            account.parent().next().show();
            return;
        }

        var pass = $('#txtPassword');
        if (pass.val().trim().length < 6 || pass.val().trim().length > 16) {
            pass.parent().next().show();
            return;
        }

        var fliter = /^(?=.*\d)(?=.*[a-zA-Z]).{6,16}$/;
        if (!fliter.test(pass.val().trim())) {
            pass.parent().next().show();
            return;
        }

        var Repass = $('#txtRePassword');
        if (Repass.val().trim() != pass.val().trim()) {
            Repass.parent().next().show();
            return;
        }
    };


    
}

$('#txtPassDK').change(function () {
    var pass = $('#txtPassDK').val();
    if (pass.length < 4 || pass.length > 18) { $('#thongbaoDK').html("Mật khẩu có độ dài 4-18 ký tự."); return; } else { $('#thongbaoDK').html(""); }
    //var fliter = /^(?=.*\d)(?=.*[a-zA-Z]).{6,14}$/;
    //if (!fliter.test(pass)) { $('#thongbaoDK').html("Mật khẩu có độ dài 4-18 ký tự."); return; }
    //for (var index = 0; index < pass.length; index++) {
    //    if (!CommonValid.ValidateLetterPassword(pass.charAt(index))) {
    //        $('#thongbaoDK').html("Mật khẩu có độ dài 4-18 ký tự."); return;
    //    }
    //}
    //if (!CommonValid.ValidateLetterPassword(pass)) { $('#thongbaoDK').html("Mật khẩu có độ dài 4-18 ký tự."); return; }
    //else {
    //    $('#thongbaoDK').html("");
    //}
});