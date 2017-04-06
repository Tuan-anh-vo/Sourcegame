<!-- START OF LOAD POPUP ACCOUNT -->
<style>
.cg_tab_danhnhap_dangky:before{border-bottom:none;background-color:transparent}
#popLogin{width:393px;background-color:transparent;border:none;top:30%}
.logoandclose{position:relative;top:0;left:0;margin-bottom:50px}
.cg_all_form_popup_dangnhap{width:355px}
.cg_tabs_menu_login{margin:0;width:100%}
.cg_tabs_menu_login li{width:50%;height:55px;background-color:#CCC;border-bottom:1px #ccc solid}
.cg_tabs_menu_login li a{text-transform:uppercase;font-weight:700;font-size:20px;padding:10px 0}

.cg_tabs_menu_login li a:hover{color:#fff;background-color:#C00}

.cg_css_checkbox_popup_dangky,.cg_css_checkbox_xacnhan_popup_dangky{border:1px #CCC solid;padding:12px;width:100%;font-family:Arial,Helvetica,sans-serif;height:41px}
.cg_btn_popup_dangky{float:none;margin:auto;margin-bottom:10px;border:none;background-color:#C00;color:#fff;font-weight:700;padding:2px 25px;text-transform:uppercase; border-radius:0;width:150px;height:39px}
.cg_btn_popup_dangky:hover{background-color:#d51414; text-decoration:none; color:#fff}
.cg_text_mau_dangky{float:none;margin:auto;display:block;text-align:center;font-size:13px}
.cg_text_mau_dangky a{color:#C00}
.cg_text_mau_dangky a:hover{text-decoration:underline}
.cg_social_popup_dangky{width:100%;background-color:#CCC;text-align:center;margin-bottom:0;padding:10px 0;margin-top:10px;line-height:35px}
.cg_icon_google_popup_dangnhap{float:none}
.cg_icon_face_popup_dangnhap{float:none}
.ghinho-thongin{
    font-size:13px;margin-bottom:15px;color:#666
}
.cg_tabs_menu_login{
    display:inline-flex;
}
.showpass-inclickdn{position: absolute;width: 41px;height: 41px;left:50%;margin-left: 133px;}

#popRegister{width:393px;background-color:transparent;border:none;top:30%}

.cg_all_form_popup_dangky{width:355px}

.showpass-inclickdk{position: absolute;width: 41px;height: 41px;left:50%;margin-left: 133px;}

</style>
<div class="cg_nenden_popup" id='pp_account' onclick="RemovePopLogReg()" style="display:none;">
    <div id="popLogin" class="cg_tab_danhnhap_dangky" style=''>
        <div class="logoandclose">
            <img style="float:left; top:0; left:0;width:150px;display:none" src="https://header.vtcgame.vn/images/logo184.png">
            <img style="float:right; position:absolute; top:10px; right:0; width:30px; height:30px; cursor:pointer;" onclick="RemovePopLogReg()" src="https://header.vtcgame.vn/images/close-button.png">
        </div>
        <ul class="cg_tabs_menu_login">
            <li class="cg_current_login li_tab_sel"><a data-tab="#cg_tab1_login" href='javascript:;'>Đăng nhập</a></li>
            <li class="li_tab_sel"><a data-tab="#cg_tab2_login" href='javascript:;'>Đăng ký</a></li>
        </ul>
        <div class="cg_tab_login" style="background-color:#fff">
            <div id="cg_tab1_login" class="cg_tab_content_login">
                <div class="cg_all_form_popup_dangnhap">
                    <div class="erro" style="display: block;"></div>
                    <label id="thongbaoDN" style="color: red; width: 296px;" class="cg_css_label_popup_dangky"></label>
                    <input type="text" id="txtUserName" class="cg_css_checkbox_popup_dangky pp_keydown_dn" placeholder="Tên đăng nhập">
                    <input type="password" id="txtPass" class="cg_css_checkbox_popup_dangky pp_keydown_dn" placeholder="Mật khẩu (4-18 ký tự)">
                    <i href="javascript:;" onmousedown="document.getElementById('txtPass').type = 'txt'" onmouseup="document.getElementById('txtPass').type = 'password'" class="showpass-inclickdn"><img style="padding: 8px;" src="<?=PATH_URL?>static/teaser/images/eye-icon.png"></i>
                    <div class="clear" style="height:10px;"></div>
                    <p class="ghinho-thongin">
                        <input id="checkbox_dangky" type="checkbox">
                        <label for="checkbox_dangky" name="checkbox68_lbl_dangky" class="css_label_dangky">
                            Nhớ thông tin đăng nhập <a href="javascript:;" class="cg_text_mau_dangky"></a>
                        </label>
                    </p>
                    <div class="clear"></div>
                    <a class="cg_btn_popup_dangky" onclick="loginUser('#txtUserName', '#txtPass', '#checkbox_dangky', '#thongbaoDN','');" href="javascript:;">đăng nhập</a>
                    <div class="clear"></div>
                    <p class="cg_text_mau_dangky"><a href="<?=PATH_URL?>quen-mat-khau">Quên mật khẩu?</a></p>
                    
                    <div class="clear"></div>
                    <!-- <p style="margin:10px" class="cg_text_mau_dangky">Bạn chưa có tài khoản <a href="#" onclick="calPopReg(''); return false">Đăng kí tại đây?</a></p> -->
                    <div class="clear"></div>
                </div>
                <p class="cg_social_popup_dangky" style='display:none'>
                    Hoặc đăng nhập qua tài khoản<br />
                    <a class="cg_icon_face_popup_dangnhap" onclick="LoginO_Auth('facebook', '')" href='javascript:;'><img src="<?=PATH_URL?>static/teaser/images/facebook-button.png"></a>
                    <a class="cg_icon_google_popup_dangnhap" onclick="LoginO_Auth('google','')" href='javascript:;'><img src="<?=PATH_URL?>static/teaser/images/google-button.png"></a>
                </p>
            </div>
            <div id="cg_tab2_login" class="cg_tab_content_login" style="display: none;">
                <div class="cg_all_form_popup_dangky">
                    <label id="thongbaoDK" style="color: red;" class="cg_css_label_popup_dangky"></label>
                    <input type="text" id="txtUserNameDK" class="cg_css_checkbox_popup_dangky" placeholder="Tên đăng nhập">
                    <input type="text" id="txtEmailDK" class="cg_css_checkbox_popup_dangky" placeholder="Email">
                    <input type="password" id="txtPassDK" class="cg_css_checkbox_popup_dangky" placeholder="Mật khẩu (4-18 ký tự)">
                    <i href="javascript:;" onmousedown="document.getElementById('txtPassDK').type = 'txt'" onmouseup="document.getElementById('txtPassDK').type = 'password'" class="showpass-inclickdk"><img style="padding: 8px;" src="<?=PATH_URL?>static/teaser/images/eye-icon.png"></i>
                    
                    <div class="cg_all_maxacnhan">
                        <input type="text" id="txCaptchaInput" placeholder="Mã xác nhận" style="text-transform:uppercase; width:195px" class="cg_css_checkbox_xacnhan_popup_dangky">
                        <span class="cg_ma_capcha_popup_dangky" style="margin-top:5px">
                            <img onclick="RefreshCaptcha('#ImgcaptchaDK', '#hidVerifyCapchaDK')" src="data:image/jpeg;base64,/9j/4AAQSkZJRgABAQEAYABgAAD/2wBDAAIBAQIBAQICAgICAgICAwUDAwMDAwYEBAMFBwYHBwcG
BwcICQsJCAgKCAcHCg0KCgsMDAwMBwkODw0MDgsMDAz/2wBDAQICAgMDAwYDAwYMCAcIDAwMDAwM
DAwMDAwMDAwMDAwMDAwMDAwMDAwMDAwMDAwMDAwMDAwMDAwMDAwMDAwMDAz/wAARCAAQADwDASIA
AhEBAxEB/8QAHwAAAQUBAQEBAQEAAAAAAAAAAAECAwQFBgcICQoL/8QAtRAAAgEDAwIEAwUFBAQA
AAF9AQIDAAQRBRIhMUEGE1FhByJxFDKBkaEII0KxwRVS0fAkM2JyggkKFhcYGRolJicoKSo0NTY3
ODk6Q0RFRkdISUpTVFVWV1hZWmNkZWZnaGlqc3R1dnd4eXqDhIWGh4iJipKTlJWWl5iZmqKjpKWm
p6ipqrKztLW2t7i5usLDxMXGx8jJytLT1NXW19jZ2uHi4+Tl5ufo6erx8vP09fb3+Pn6/8QAHwEA
AwEBAQEBAQEBAQAAAAAAAAECAwQFBgcICQoL/8QAtREAAgECBAQDBAcFBAQAAQJ3AAECAxEEBSEx
BhJBUQdhcRMiMoEIFEKRobHBCSMzUvAVYnLRChYkNOEl8RcYGRomJygpKjU2Nzg5OkNERUZHSElK
U1RVVldYWVpjZGVmZ2hpanN0dXZ3eHl6goOEhYaHiImKkpOUlZaXmJmaoqOkpaanqKmqsrO0tba3
uLm6wsPExcbHyMnK0tPU1dbX2Nna4uPk5ebn6Onq8vP09fb3+Pn6/9oADAMBAAIRAxEAPwD9dP8A
gqz+13r37CP7B3jb4qeGrfQbrWPC8mmiKPWo5JLHZcaja2srSCOSNvljmdgQ4AYAnIBB8l8Vf8Fq
Ph2P2ydF8MeFPiF8K/G3wu0/4b+IPHHi/V/DuqR63e6M+mtbFEDWs7oqtFJM3ltGzuUG0jBB9e/4
KnfsneIv24P2GPGXwx8J3ui6fr3iKfTJLa41aaWGzQW2pWt0+9o45HGY4HAwhyxUHAyRxP7Y/wCx
T4s+K/7WGh/E/TfD3gzx54f8O/C7xJ4PvPCOs6rLp7eI7jUHtHjtzJ9mmjSB0gkR5G5UuvykZK4z
lOMHJb3n0b/5dPluldtc9rJK9++xtFQain3jfbbnhe17JPl5tW7WuepfsmftoWv7V3hvUtUHw9+J
Xw/t7C0s9St5PFGn2v2XWLK7g8+G5s7uyuLq0uF2ZDokxkjOA6JuXd3nwM+OHhf9pP4R6D478Fap
/bXhXxPai80y++zS232mIkgN5cypIvIPDKD7V8U/8Egf2JPHX7GkvxY0e20H4k+AfghqlrbzeDvA
XjbxHp2vX3h3UHNzLfrZSWM9xHHYMZYVjWSYzO6SO67m3v7V/wAEbfAeufC//gl98FfD/ibRdW8O
69pXh2OC903U7SS0vLOQSOSkkUgDo3I4YA812VFDmnybLlstL68972um1yrZ2187Llp83KubV3ev
R6R1V7NbvR6q1ru139MUUUViaBRRRQB//9k=" id="ImgcaptchaDK" style="display: block; width: 95px; margin: 0; cursor: pointer"><input type="hidden" id="hidVerifyCapchaDK" value="636111695608599960-9052fd0e2fd6244ea66dc1a442c7a375" />
                        </span>
                        <a href="javascript:;" onclick="RefreshCaptcha('#ImgcaptchaDK', '#hidVerifyCapchaDK')" class="cg_btn_reload_popup_dangky"><img src="https://header.vtcgame.vn/images/refresh.png" style="width:30px; height:30px" alt=""></a>
                    </div>
                    <div class="clear"></div>
                    <p style="font-size:13px;margin-bottom:15px;color:#666; margin-top:10px">
                        <input id="checkbox_dongy" checked="checked" type="checkbox">
                        <label for="checkbox_dongy" id="checkboxRegister" class="css_label_dongy">Tôi đã đọc và<a href="" target="_blank"><em class="cg_text_mau_dongy"> Đồng ý với điều khoản sử dụng</em></a></label>
                    </p>
                    <div class="clear"></div>
                    <a class="cg_btn_popup_dangky" onclick="registerUser('#txtUserNameDK','#txtEmailDK','#txtPassDK','#txCaptchaInput','#checkbox_dongy','#thongbaoDK','')" href="javascript:;">đăng ký</a>
                </div>
                <p class="cg_social_popup_dangky" style='display:none'>
                    Hoặc tạo tài khoản qua<br />
                    <a class="cg_icon_face_popup_dangnhap" onclick="LoginO_Auth('facebook', '')" href='javascript:;'><img src="<?=PATH_URL?>static/teaser/images/facebook-button.png"></a>
                    <a class="cg_icon_google_popup_dangnhap" onclick="LoginO_Auth('google','')" href='javascript:;'><img src="<?=PATH_URL?>static/teaser/images/google-button.png"></a>
                </p>
            </div>
        </div>
    </div>
    <script type="text/javascript">
         //$("#popLogin").click(function () {
         //    event.stopPropagation();
        //});
        $("#popLogin").click(function (e) {
            e.stopPropagation();
        });
        $('#cg_tab1_login input[type="text"],#cg_tab1_login input[type="password"]').on('keypress', function (event) {
            if (event.which === 13) {

                LoginHead('txtUserName', 'txtPass', 'captcha', 'ImgcaptchaDN', 'hidVerifyCapchaDN', 'checkbox_dangky', 'otp', 'optType', 'frameCapcha', 'thongbaoDN', '');
            }
        });
    </script>
</div>
<!-- END OF LOAD POPUP ACCOUNT -->