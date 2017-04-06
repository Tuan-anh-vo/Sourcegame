<style type="text/css">
    .useronline{
        width: 100%;
        display: block;
        padding: 10px;
    }
    .useronline .row1{
        background: #EBEBEB;
    }
    .useronline th{
        font-weight: bold;
    }
    .useronline td, .useronline th{
        min-width: 58px;
        padding: 8px;
    }
</style>

<link rel="stylesheet" href="<?=PATH_URL?>static/css/validationEngine.jquery.css" type="text/css"/> 
<script src="<?=PATH_URL?>static/js/languages/jquery.validationEngine-vi.js" type="text/javascript" charset="utf-8"></script> 
<script src="<?=PATH_URL?>static/js/jquery.validationEngine.js" type="text/javascript" charset="utf-8"></script>  
<script type="text/javascript" src="<?=PATH_URL.'static/js/admin/jquery-ui-1.10.3.custom.min.js'?>"></script>
 <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css">
<script type="text/javascript">
    $(document).ready(function(){
        $('body').on('click', '.pagination a',function(e){
            e.preventDefault();
            var page = $(this).html();
            getajax2(page);
        });
        $("#caledar_from").datepicker({
            changeMonth : true,
            changeYear : true,
            dateFormat : "yy-mm-dd",
            yearRange : "1930:2050"
        });
        $( "#caledar_to" ).datepicker({
            changeMonth : true,
            changeYear : true,
            dateFormat : "yy-mm-dd",
            yearRange : "1930:2050"
        });
        $(".bt-check").click(function(){
            getajax();
        });
    });

    function getajax(){
        $.ajax({
            url: root+'gametool/useronlineAjax',
            type: 'POST',
            cache: false,
            data: "server="+$(".server option:selected").val()+"&caledar_from="+$("#caledar_from").val()+"&caledar_to="+$("#caledar_to").val(),
            dataType: 'Text',
            success: function(result){
                $(".right-content-thongke").html(result);
                $(".right-content-thongke").show();

            },
            error: function (){

            }
        });
    }

    function getajax2(page){

            $.ajax({
                url: root+'gametool/useronlineAjax',
                type: 'POST',
                cache: false,
                data: "server="+$(".server option:selected").val()+"&caledar_from="+$("#caledar_from").val()+"&caledar_to="+$("#caledar_to").val()+"&page="+page,
                dataType: 'Text',
                success: function(result){
                    $(".right-content-thongke").html(result);
                },
                error: function (){

                }
            });
    }

</script>

<div class="right-content-title">User Online</div>
<div class="right-content-d1">
    <div class="right-content-d1-server">Chọn Server</div>
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
</div>
<div class="head_search">
            <div class="head_search_title">From:</div>
            <div class="head_search_input"><input onkeypress="return enterSearch(event)" id="caledar_from" type="text" /></div>
            <div class="head_search_title">To:</div>
            <div class="head_search_input"><input onkeypress="return enterSearch(event)" id="caledar_to" type="text" /></div>
            <div class="head_search_title">Content:</div>
            <div class="head_search_input">
                <input onkeypress="return enterSearch(event)" id="search_content" onclick="if(this.value=='type here...'){this.value=''}" onblur="if(this.value==''){this.value='type here...'}" class="input_last" type="text" value="type here..." />
                <div onclick="getajax()" class="bt_search">
                <img alt="Button search" src="<?=PATH_URL.'static/images/admin/icons/searchSmall.png'?>" />
                </div>
            </div>
</div>
<div class="clear"></div>

<div class="right-content-thongke">

        <?php
            if(isset($result))
            {
            ?>
        <!--<table class="useronline">
            <tr>
                <th>Hiện Tại</th>
                  <?php
                    if($serversnow && $resultnow)
                    {
                        foreach ($resultnow as $key => $value) 
                         {
                            echo "<th>";
                            foreach($servers as $item)
                            {
                               if($value->sid == $item->id) echo $item->name;
                            }
                            echo "</th>";
                        }
                    }
                    ?>
                    <th>Tổng User Online</th>
            </tr>
            <tr>

                <td><?=date("Y-m-d H:i:s", time())?></td>
                <?php
                    if($resultnow)
                    {
                        $tempnow = 0;
                        foreach ($resultnow as $key => $value) 
                        {
                ?>
                        <td>
                        <?
                        if($value->total == -1) 
                                echo "0"; 
                        else 
                            {
                                echo $value->total;
                                $tempnow = $tempnow + $value->total;
                            }
                        ?></td>
                <?php
                        }


                        ?>
                        <td><?=$tempnow?></td>        
                <?php   
                    }
                ?>
                
            </tr>
        </table>
        -->



        <table class="useronline">
            <tr>
                <th>Thời Gian</th>
                  <?php
                    if($servers)
                    {
                        foreach($servers as $item)
                        {
                            ?>
                            <th> <?=$item->name?> </th>
                        <?php
                        }
                    }
                    ?>
                    <th>Tổng User Online</th>
            </tr>
            <?
                if($time)
                {
                    $row = 0;
                        ?>
                        <?php  
                            foreach($time as $item)
                            {
                                $sumtmp = 0;

                         ?>
                        <tr <?php if($row++ % 2 == 0)  echo "class='row1'"  ;?> >
                            <td><?=$item->created?></td>
                            <?php
                                foreach($servers as $key => $value)
                                {
                                    echo "<td class='count'>";
                                    if(isset($result[$item->created."__".$value->id])){
                                        if($result[$item->created."__".$value->id]->total==-1){
                                            echo "0";    
                                        }else{
                                            echo $result[$item->created."__".$value->id]->total;
                                        }
                                    }else{
                                        
                                    }
                                    /* foreach($result as $key2 => $value2)
                                    {
                                        if($value2->created == $item->created && $value2->sid == $value->id)
                                        {      
                                            if($value2->total == -1 )
                                                echo "0";
                                            else
                                                {
                                                    echo $value2->total;
                                                    $sumtmp = $sumtmp + $value2->total;
                                                }
                                            // continue;   
                                        }
                                    }
                                    */
                                    echo "</td>";
                                }  
                                ?>
                                <td class="total_jquery"></td>
                        
                        <?php   }   ?>
                        </tr>
                    
            <?php
                }
            ?>
        </table>
        <?php
            }
        ?>
    <div class="clear"></div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        var sr_tr='';  
        var co=0; 
        $('.useronline tr').each(function(){
            co=0; 
            sr_tr=$(this);
            $(this).find('.count').each(function(){
                if(parseInt($(this).text()))
                co=co+(parseInt($(this).text()));
            })
            sr_tr.find('.total_jquery').text(co);
        })
    });

</script>


<div class="error" title="Thông Báo">
    <div class="text_error"></div>
</div>
