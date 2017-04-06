<div id="ajax_loadContent" style="border-bottom: 1px solid">
    <div class="content_table">
        <table cellspacing="0" cellpadding="0" border="0" width="100%">
            <tr>
                <th class="th_no_cursor" width="40">No.</th>
                <th class="th_left"><div id="username" class="sort icon_no_sort">Username</div></th>
                <th class="th_left"><div id="card_amount" class="sort icon_no_sort">Mệnh giá</div></th>
                <th class="th_left"><div id="card_serial" class="sort icon_no_sort">Serial</div></th>
                <th class="th_left"><div id="card_pin" class="sort icon_no_sort">Mã thẻ</div></th>
                <th class="th_left"><div id="card_type" class="sort icon_no_sort">Loại thẻ</div></th>
                <th class="th_left"><div id="created" class="sort icon_no_sort">Thời gian</div></th>
                <th class="th_left"><div id="pay_method" class="sort icon_no_sort">Loại</div></th>
                <th class="th_left"><div id="pay_method" class="sort icon_no_sort">Cổng thanh toán</div></th>
                <th class="th_left"><div id="flag" class="sort icon_no_sort">Trạng thái</div></th>
                <th class="th_left"><div id="sum" class="sort icon_no_sort">Kiểm tra</div></th>
                <!-- <th class="th_left"><div id="sum" class="sort icon_no_sort">Action</div></th> -->
                
            </tr>
            <?php
            $stt==1? $i=1: $i=10*$stt;
            
            if($result){
                foreach($result as $key => $value){?>
                    <tr class="item_row delete-<?=$value->id?>">
                        <td class="td_center"><?=$i?></td>
                        <td class="td_center"><a href="<?=PATH_URL.'admincp/donate/update_transaction?id='.$value->id?>"><?=$value->username?></a></td>
                        <td class="th_left"><?=number_format($value->card_amount,0,'.','.');?></a></td>
                        <td class="th_left"><?=$value->card_serial;?></td>
                        <td class="th_left"><?=$value->card_pin;?></td>
                        <td class="th_left"><?=$value->card_type;?></td>
                        <td class="th_left"><?=date('H:i:s d-m-Y', strtotime($value->created));?></td>
                        <td class="th_left"><?php if($value->payment_type == 1) echo "Thẻ Cào"; else echo "ATM"; ?></td>
                        <td class="th_left"><?=$value->payfrom?></td>
                        <td class="th_left"><?php
                             // if($value->flag == 1) echo "<p style='color: blue;'>Thành công</p>";
                             // else{
                             //    if($value->card_amount > 0){
                             //        echo "<p style='color: #FF9A00;'>Đang chuyển KNB</p>";
                             //    }
                             //    else echo "<p style='color: red;'>".$value->message."</p>";
                             //}

                        echo $value->message;
                        ?>
                        </td>
                        <td class="th_left"><a href="<?=PATH_URL.'donate/check_detail?id='.$value->id?>" class="action_checkdetail" data-detail="<?=$value->id?>">Kiểm tra</a></td>
                        <!-- <td class="th_left"><a href="<?=PATH_URL.'donate/delete_transaction?id='.$value->id?>" class="action_del" data-link="delete-<?=$value->id?>">Xóa</a></td> -->

                    </tr>
                    <?php $i++;}
            }else{ ?>
                <tr class="row1">
                    <td class="th_last td_center" colspan="50" style="font-size: 20px; padding: 50px 0">No data</td>
                </tr>
            <?php }?>
        </table>
    </div>
</div>
    <?php if($pageLink) echo $pageLink;?>
<style>
    .page{height: 30px;}    
    .page ul{height: 30px;}
    .page ul li{padding: 0 12px; line-height: 30px; float: left;}

    #popup-checkdetail {

    }
    #popup-checkdetail h2{
        padding: 10px;
        text-align: center;
    }
    #popup-checkdetail table{
        margin: 10px 0px;
    }
    #popup-checkdetail th{
        text-align: center;
        color: #C43A3A !important;
    }
    #popup-checkdetail tr{

    }
    #popup-checkdetail th, #popup-checkdetail td{
        border: 1px solid #BAD5E3;
        padding: 10px;
        font-weight: bold;
        color: #22A3DA;
    }
    .myButton {
        background-color:#599bb3;
        -moz-border-radius:10px;
        -webkit-border-radius:10px;
        border-radius:10px;
        border:1px solid #29668f;
        cursor:pointer;
        color:#ffffff;
        font-family:arial;
        font-size: 14px;
        padding: 6px 15px;
        text-decoration:none;
        text-shadow:0px 1px 0px #3d768a;
        margin: 0px 50px;   
    }
    .myButton:hover {
        background-color:#408c99;
    }
    .myButton:active {
        position:relative;
        top:1px;
    }

</style>
<script type="text/javascript">
    $(document).ready(function(){
        $(".clickpopup-checkdetail").fancybox();
        $('.action_del').click(function(e){
            e.preventDefault();
            if(confirm('Bạn có chắc muốn xóa?'))
                var delete_id = $(this).data('link');
                $('.'+delete_id).remove();
                $.get($(this).attr('href'));
        });
        $('.action_checkdetail').click(function(e){
            e.preventDefault();
            checkdetail = $(this).data('detail');
            //alert(checkdetail);
            jQuery.ajax({
                type:"POST",
                url:root+"donate/check_detail",
                data: "checkdetail="+checkdetail,
                success:function(html){
                jQuery("#content-ajax").html(html);
                    $(".clickpopup-checkdetail").trigger("click");
                }
            });
            
            //$.get($(this).attr('href'));

        });


        $("body").on( "click", "#bt-resend", function() {
            $(this).attr("disabled","disabled");
            checkdetail = $(this).data("id");
            jQuery.ajax({
                type:"POST",
                url:root+"donate/resendMissDonate",
                data: "checkdetail="+checkdetail,
                success:function(html){
                    jQuery("#content-ajax").html(html);
                    $(".clickpopup-checkdetail").trigger("click");
                    $("#bt-resend").removeAttr("disabled");
                }
            });
        });
})
</script>
<a class="clickpopup-checkdetail" href="#content-ajax"></a>
<div style="display:none">
<div id="content-ajax"></div>
</div>
