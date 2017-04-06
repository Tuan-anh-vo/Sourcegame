
<div class="right-content-title">THỐNG KÊ SỐ LƯỢT CLICK VÀO CHƠI GAME Ở MỘT SERVER</div>
<div class="right-content-d1">
    <form method="POST">
    <div class="right-content-d1-tennv"></div>
   
    <div class="right-content-d1-server">Server</div>
    <div class="right-content-d1-input-server">

        <select name="server" class="server">
            <option value="0">Chọn Server</option>
            <?php if($servers){
                foreach($servers as $item){?>
                    <option value="<?=$item->id?>"> <?=$item->name?> </option>
                <?php } } ?>
        </select>
    </div>
    <div class="clear"></div>
</div>
<div style="margin-top: 0px;"  class="right-content-d2">
    <input style="padding:4px 7px;" type="submit" value="Xem">
</div>
</form>

<div class="right-content-thongke">
    <table id="sort_table" class="gmGrid">
<?php if($result){ ?>
    
    <thead> 
    <tr>
        <th  class="center">Tên Server</th>
        <th  class="center">Số lượt click</th>
    </tr>
    </thead>
<tr class="right-content-thongke>">
    <td class="center"><?=$server_name?></td>
    <td class="center"><?=$result?></td>
</tr>
<?php }else echo "Kết nối thất bại";?>  
</table>
    <div class="clear"></div>
</div>
<div class="clear"></div>
</div>