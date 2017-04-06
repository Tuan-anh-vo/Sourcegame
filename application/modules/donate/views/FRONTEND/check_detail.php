<div id="popup-checkdetail">
    <div class="wrapper-popup-checkdetail" >
        <h2>Tình trạng của phiên giao dịch</h2>
        <table cellspacing="0" cellpadding="0">
            <tr><th>Tình trạng nạp cổng thanh toán</th><th>Tình trạng nạp vào game</th></tr>
            <tr><td><?php if(is_numeric($bool_transaction)) echo "<span style='color:red'>Thành công</span>. Số tiền: ".$bool_transaction; else echo $bool_transaction;?></span></td><td><?php if(is_numeric($bool_insertknb)) echo "<span style='color:#FF0000;'>ĐÃ</span> nạp vào game"; else  echo $bool_insertknb;?></span></td></tr>
        </table>
        <div class="clear"></div>
        <div style="padding: 10px 0px; text-align: center;">
            <!-- <a class="myButton bt-ignore">Bỏ Qua</a>  -->
            <?php if(is_numeric($bool_transaction) && !is_numeric($bool_insertknb) ){ ?>
            <a class="myButton" id="bt-resend" data-id="<?=$id?>">Nạp Lại</a>
            <?php } ?>
        </div>
        <div class="clear"></div>
    </div>
</div>

<style>
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