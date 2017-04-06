<table class="gmGrid">
<?php
if($result)
{
    ?>
    <tbody><tr>
        <th  class="center">Tên Server</th>
        <th  class="center">Tên TK</th>
        <th  class="center">Số Tiền</th>
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



<script type="text/javascript">

    $(document).ready(function() {
        $(".ajaxpagin a").click(function(e){
            e.preventDefault();
            data = "&startajax=" + $(this).text();
            ajaxpagin(data);

        });
    });

    function ajaxpagin(data){
        checkdata();
        if( $(".namecharacter").val() !='' && $(".server").val() != 0 )
        {
            $.ajax({
                url: root+'gametool/lichsunaptienAjax',
                type: 'POST',
                cache: false,
                data: "name=" + $(".namecharacter").val() + "&server="+$(".server option:selected").val() + "&startDate=" + $(".startDate").val() + "&endDate=" + $(".endDate").val() + data,
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