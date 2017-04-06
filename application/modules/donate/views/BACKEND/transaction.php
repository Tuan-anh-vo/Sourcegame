<div class="chart">
    <h3 style="padding-bottom:5px;float:left;margin-top:10px;font-weight: bold;font-size: 16px;text-transform: uppercase;color: #00aeef;">TRA CỨU THẺ NẠP</h3>
    <div class="static" style="margin-top:20px; float: left; width: 100%; position: relative;">
        <div class="well" style="overflow: auto">
            <div class="data-input">
                <p style="float: left; padding: 0 20px 0 10px;  margin: 0; line-height: 32px;">
                    <label style="margin: 0 10px 0 0; font-weight: bold; color: #00AEEF; width: 180px; float: left; line-height: 32px; text-align: right;">Mã thẻ :</label>
                    <input type="text" name="mathe" id="mathe" style="height: 26px; border: 1px solid #d9d9d9; padding: 0 3px;" onkeypress="if(event.keyCode==13){transaction(1);}">
                </p>
                <p style="float: left;margin: 0; line-height: 32px;">
                    <label style="margin: 0 10px 0 0; font-weight: bold; color: #00AEEF; width: 80px; float: left; line-height: 32px; text-align: right">Số Serial: </label>
                    <input type="text" name="seri" id="seri" style="height: 26px; border: 1px solid #d9d9d9; padding: 0 3px" onkeypress="if(event.keyCode==13){transaction(1);}">
                </p>

                <p style="float: left;margin: 0; line-height: 32px;">
                    <label style="margin: 0 10px 0 0; font-weight: bold; color: #00AEEF; width: 80px; float: left; line-height: 32px; text-align: right;">Username: </label>
                    <input type="text" name="username" id="username" style="height: 26px; border: 1px solid #d9d9d9; padding: 0 3px" onkeypress="if(event.keyCode==13){transaction(1);}">
                </p>

            </div>
            <div class="data-input">
                <p style="float: left; padding: 0 20px 0 10px;  margin: 0; line-height: 32px;">
                    <label style="margin: 0 10px 0 0; font-weight: bold; color: #00AEEF; width: 180px; float: left; line-height: 32px; text-align: right;">Chọn server: </label>
                    <select id="server" style="width: 158px; height: 26px">
                        <option value="0">Chọn server</option>
                        <?php if($servers)
                        foreach ($servers as $key => $value) {
                            ?>
                            <option value="<?=$value->id?>"><?=$value->name?></option>
                            <?php
                        }
                        ?>
                    </select>
                </p>
                 <p style="float: left; line-height: 32px;">
                    <label style="text-align: right; margin: 0 10px 0 0; font-weight: bold; color: #00AEEF; width: 80px; float: left; line-height: 32px;">Trạng thái: </label>
                    <select style='height: 26px; width: 156px;' id="status">
                        <option value="0">Chọn trạng thái</option>
                        <option value="1">Thành công</option>
                        <option value="2">Đang chuyển KNB</option>
                        <option value="3">Thất bại</option>
                    </select>
                </p>

                <p style="float: left;margin: 0; line-height: 32px;  padding: 0 20px 0 10px;"><input type="button" id="thongke" value="Tìm" style="padding: 2px 4px; border: 1px solid #c2c2c2; font-weight: bold; color: #00AEEF; height: 30px; width:60px; cursor: pointer;"></p>
            </div>
        </div>
        <div class="kq-error" style="color: red;"></div>
        <div id="indexView" class="table">
            <div class="head_table">
                <div class="head_title_table">Kết Quả</div>
                <div class="head_search">
                    <div class="head_search_title fontface" style="margin-top: 9px"></div>
                </div>
            </div>
            <div class="clearAll"></div>
            <div id="kq"></div>
            <div class="clearAll"></div>
        </div>
    </div>
</div>
</div>
<script type="text/javascript">
    var access = "<?php echo $this->session->userdata('userGroup');?>";
    $('#thongke').click(function() {
        var page= 1;
        transaction(page);
    });
    function transaction(page){
        $('.kq-error').html('');
        $('#kq').html('<img class="loading" alt="Ajax Loader" src="<?=PATH_URL?>static/images/admin/ajax-loader.gif"/>');
        if(access == 3 && $('#mathe').val() == "" && $('#seri').val() == "" && $('#username').val() == "" && $('#server').val() == ""){
            $('.kq-error').html("Vui lòng nhập dữ liệu cần tìm!!!");
            $('#kq').html('');
        }
        else{
            var mathe      = $('#mathe').val();
            var seri       = $('#seri').val();
            var username   = $('#username').val();
            var server = $('#server').val();
            var month  = $('#month-time').val();
            var status = $('#status').val();
            $.post(
                root+'donate/lookup/',
                {
                    page: page,
                    server : server,
                    month : month,
                    mathe : mathe,
                    seri : seri,
                    username : username,
                    status: status
                },
                function(response){
                    if(response.length>0){
                        $('#kq').html(response);
                    }
                }
            )
        }
    }
</script>
<style type="text/css">
    #kq .loading{padding: 50px 0 50px 50%;}
    .data-input{width: 100%; height: 40px;}
    .ui-datepicker{top: 234px;}
    .ui-datepicker .ui-datepicker-header{
        background: #fff; border: none;
    }
    .ui-datepicker .ui-datepicker-header tr{
        height: 40px;
    }
    .ui-datepicker select.mtz-monthpicker{
        border: 1px solid #cccccc; margin-top: 6px;
    }
.mtz-monthpicker .ui-state-default, .ui-widget-content .ui-state-default {
    background: #fff; height: 30px;
    -webkit-box-shadow: 0px 0px 0px #ffffff;
    -moz-box-shadow: 0px 0px 0px #ffffff;
    -box-shadow: 0px 0px 0px #ffffff;
    -webkit-border-radius: 0;
    -moz-border-radius: 0;
    border-radius: 0px;
    font-family: Arial;
    color: #333333; cursor: pointer !important;
    font-size: 13px;
    padding: 10px 20px 10px 20px;
    text-decoration: none;
}
.mtz-monthpicker .ui-state-default, .ui-widget-content .ui-state-default:hover{
    background: #eeeeee;
}
.mtz-monthpicker .ui-state-default, .ui-widget-content .ui-state-active{background: #fff;}

</style>