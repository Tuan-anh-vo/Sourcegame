
<div class="right-content-title">THỐNG KÊ LEVEL SERVER</div>
<div class="right-content-d1">
    <form method="POST">
    <div class="right-content-d1-tennv"></div>
   
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
<div style="margin-top:0px;" class="right-content-d2">
    <input style="padding:4px 7px;" type="submit" value="Xem">
</div>
</form>

<div class="right-content-thongke">
    <table id="sort_table" class="gmGrid">
<?php
if($result)
{
    ?>
    
    <thead> 
    <tr>
        <th  class="center">Tên Server</th>
        <th  class="center">Level</th>
        <th  class="center">Số lượng</th> 
    </tr>
    </thead>
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
<tr class="right-content-thongke>">

    <td class="center"><?=$server_name?></td>
    <td class="center"><?=$item->Level?></td>
    <td class="center"><?=$item->Total?></td>
</tr>
<?php
    }
?>      
   
<?php
}

else
    echo "Kết nối thất bại";
?>

  
</table>


    <div class="clear"></div>
</div>
<div class="clear"></div>
</div>

<script type="text/javascript">
    addClassSort();
    function addClassSort(){
        $('.gmGrid').find('tr').removeClass('right-content-thongke-rowle');       
        $('.gmGrid').find('tr:odd').addClass('right-content-thongke-rowle');
        $('.gmGrid').find('th').css({'cursor':'pointer'});

    }

    $('.gmGrid th').click(function(){
        setTimeout(function(){
            addClassSort();
        },500);
        
    })
    $(document).ready(function() { 
       $("#sort_table").tablesorter({
       }); 
    }); 


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