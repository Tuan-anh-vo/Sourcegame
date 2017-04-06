<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<body style="font-family: arial;background: #000;">
    <div class="detail_page" style="background: #fff;width: 500px;margin: 37px auto;">
        <div class="noidung" style="height: 160px;padding-top: 21px;">
            <?php if(!$result || $result == -1){ ?>
            <h4 style="text-align: center;color: red;font-weight: bold;">Bạn đến từ 1 liên kết không rõ ràng hoặc bạn đã nhận GIFTCODE EMAIL này</h4>
            <?php } else { ?>
                <p style="text-align: center;color: red;font-weight: bold;">Bạn vừa kích hoạt thành công GIFTCODE EMAIL</p>
                <p style="text-align: center;color: #00008D;font-weight: bold;">Giftcode của bạn là</p>
                <strong class="show-code-mail" style="text-align: center;display: block;border: 1px solid red;padding: 9px;width: 253px;margin:  auto;margin-bottom: 20px;"><?php echo $result;?></strong>
            <?php } ?>
        </div>
    </div>
    <script type="text/javascript">
        setTimeout(function(){
            location.href = '<?php echo PATH_URL?>';
        }, 10000);
    </script>
</body>