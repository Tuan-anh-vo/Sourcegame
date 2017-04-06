<?php
    if($result)
    {
    ?>
<table class="useronline">
    <tr>
        <th>Số Thứ Tự</th>
        <th>Thời Gian</th>
        <th>Tên Server</th>
        <th>Online</th>
    </tr>
    <?php
        foreach ($result as $key => $value) {
    
    ?>
    <tr <?=($key % 2 == 00)? "class='row1'":""  ?> >
        <td><?=$value->id?></td>
        <td><?=date("h:i:s d-m-Y", strtotime($value->created))?></td>
        <td><?php
                foreach ($servers as $key2 => $server) {
                    if($server->id == $value->sid)
                    {
                        echo $server->name;
                    }
                }
            ?></td>
        <td><?php
            if($value->total == -1)
                echo "Không có dữ liệu";
            else
                echo $value->total;
            ?></td>
        <?php
        }
        ?>
    </tr>
</table>
<?=$pageLink?>

<?php
    }
?>
<script type="text/javascript">
    $(document).ready(function(){
        // $(function(){
        //      $(".pagination a").click(function(e){
        //         e.preventDefault();
        //         alert("aaa");
        //         var page = $(this).html();
        //         getajax2();
        //     });
        // });

        
    });
    
</script>