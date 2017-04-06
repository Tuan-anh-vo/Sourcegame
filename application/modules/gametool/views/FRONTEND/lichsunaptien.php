<div class="right-content-title">THỐNG KÊ NẠP TIỀN</div>
<div class="right-content-d1">
    <div class="right-content-d1-tennv">Chọn ngày</div>
    <div class="right-content-d1-input-tennv"><input id="date" type="text"/></div>
    <div class="right-content-d1-input-tennv"><input type="hidden" class="startDate"><input type="hidden" class="endDate"></div>
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
                    <option value="<?=$item->id?>"> <?=$item->name?> </option>
                <?php
                }
            }
            ?>
        </select>
    </div>
    <div class="clear"></div>
</div>
<div class="right-content-d3">
    <div class="right-content-d1-tennv">Tên NV</div>
    <div class="right-content-d1-input-tennv"><input class="namecharacter" type="text"/></div>
    <div class="clear"></div>

</div>
<div class="right-content-d2">
    <div class="right-content-d2-btxem">XEM</div>
</div>
<div class="right-content-thongke">
    <table class="gmGrid">
<?php
if($result)
{
    ?>
    <tbody><tr>
        <th  class="center">Tên Server</th>
        <th  class="center">Tên TK</th>
        <th  class="center">Số Tiền</th>
        <th  class="center">Số Kim Bảo</th>
        <th  class="center">Ngày Nạp</th>
    </tr>
<?php
    $chan = 0;
    $row = "rowle";
    foreach($result as $item)
    {
        if($chan%2 == 0)
        {
            $chan++;
            $row = "rowchan";
        }
        else
        {
            $chan++;
            $row = "rowle";   
        }
        ?>
<tr class="right-content-thongke-<?=$row?>">

    <td class="center">
        <?php
                foreach($servers as $serv)
                {
                    if($item->server_id == $serv->id)
                    {
                        echo $serv->name;
                        break;
                    }
                }
                ?>
    </td>
    <td class="center"><?=$item->username?></td>
    <td class="center"><?=$item->gamecoin*10?></td>
    <td class="center"><?=$item->gamecoin?></td>
    <td class="center"><?=date("h:i:s d-m-Y",strtotime($item->created) )?></td>
</tr>
<?php
    }
?>      
    <div class="ajaxpagin">
        <?=$pageLink?>
    </div>
<?php
}

else
    echo "Không tìm thấy";
?>

    </tbody>
</table>


    <div class="clear"></div>
</div>
<div class="clear"></div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $('#date').daterangepicker({
                format: 'DD/MM/YYYY'
            },
            function(start, end) {
                $('.startDate').val(start.format('MM/DD/YYYY'));
                $('.endDate').val(end.format('MM/DD/YYYY'));
            });
        $(".right-content-d2-btxem").click(function(){
            getajaxCheck();
        });
    });

    function checkdata(){

        if($("#date").val() =='')
        {
            alert("Bạn chưa chọn ngày");
            $("#date").focus();
            return false;
        }
        if($(".namecharacter").val() =='')
        {
            alert("Bạn chưa điền Username");
            $(".namecharacter").focus();
            return false;
        }
        if($(".server").val() == 0)
        {
            alert("Bạn chưa chọn server");
            $(".server").focus();
            return false;
        }
    }
    function getajaxCheck(){
        checkdata();

        if( $(".namecharacter").val() !='' && $(".server").val() != 0 )
        {
            $.ajax({
                url: root+'gametool/lichsunaptienAjax',
                type: 'POST',
                cache: false,
                data: "name=" + $(".namecharacter").val() + "&server="+$(".server option:selected").val() + "&startDate=" + $(".startDate").val() + "&endDate=" + $(".endDate").val(),
                dataType: 'Text',
                success: function(value){
                    $(".right-content-thongke").html(value);
                },
                error: function (){

                }
            });
        }
    }

</script>