
<div class="right-content-title">TRA TÊN NHÂN VẬT TỪ TÀI KHOẢN</div>
<div class="right-content-d1">
    <form method="POST">

   
    <div class="right-content-d1-server">Server</div>
    <div class="right-content-d1-input-server">

        <select name="server" class="server">
            <option value="0">Chọn Server</option>
            <?php
            if($servers)
            {
                foreach($servers as $item)
                {
                    ?>
                    <option value="<?=$item->id?>" <?php if(isset($server_name)) if($item->name == $server_name) echo "selected='selected'"; ?> > <?=$item->name?> </option>
                <?php
                }
            }
            ?>
        </select>
    </div>

    <div class="right-content-d1-tennv">Tên NV</div>
    <div class="right-content-d1-input-tennv"><input name="name" class="namecharacter" value="<?php if(isset($username)) echo $username ?>" type="text"/></div>
    
    <div class="clear"></div>
</div>
<div style="margin-top: 0px;" class="right-content-d2">
    <input style="padding:4px 7px;" type="submit" value="Xem">
</div>
</form>

<div class="right-content-thongke">

<?php  if(isset($url_service)) echo $url_service;?>
    

    <div class="clear"></div>
</div>
<div class="clear"></div>
</div>
