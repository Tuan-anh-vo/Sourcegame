<?//php die('hasdsa');?>
<div class="right-content-title">Tùy chọn vào game</div>
<div class="right-content-d1">
    <div class="right-content-d1-server">Chọn Server :</div>
    <div class="right-content-d1-input-server">
        <select name="server" class="server">
            <option value=""> -- Server -- </option>
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
<div class="right-content-d1">
    <div class="right-content-d1-tennv">Port :</div>
    <div class="right-content-d1-input-tennv"><input class="name" type="numberic" id="port_game"></div>
</div>
<div class="clear"></div>
<div class="right-content-d1">
    <div class="right-content-d1-tennv">Nickname</div>
    <div class="right-content-d1-input-tennv"><input class="name" type="text" id="g_username"/></div>
    <div class="clear"></div>
</div>
<div class="right-content-d1" style="margin:4px 0 0 90px;">
    <!-- <input typpe="submit" value="Vào game" id="bt_playgame"/> -->
    <a id="bt_playgame">Vào game</a>
    <div class="clear"></div>
</div>
<div class="clear"></div>

<!-- <div class="showcontent"></div> -->

<div class="error" title="Thông Báo">
    <div class="text_error"></div>
</div>
<link rel="stylesheet" href="<?=PATH_URL?>static/css/validationEngine.jquery.css" type="text/css"/> 
<script src="<?=PATH_URL?>static/js/languages/jquery.validationEngine-vi.js" type="text/javascript" charset="utf-8"></script> 
<script src="<?=PATH_URL?>static/js/jquery.validationEngine.js" type="text/javascript" charset="utf-8"></script>  
<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
 <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css">
<script type="text/javascript">
$(document).ready(function(){
    $('#bt_playgame').click(function(e){
        e.preventDefault();
        playgame();
    });
});
function playgame(){
    if($('.server').val()== ""){
        $(".text_error").html("Bạn chưa chọn server!");
            $(".error").dialog({
                  modal: true,
                  buttons: {
                    Ok: function() {
                      $( this ).dialog( "close" );
                    }
                  }
            });

            $(".server").focus();
            return false;
    }else if(is_number($('#port_game').val()) == false){
        $(".text_error").html("Port bạn nhập vào phải là số!");
            $(".error").dialog({
                  modal: true,
                  buttons: {
                    Ok: function() {
                      $( this ).dialog( "close" );
                    }
                  }
            });

            $("#port_game").focus();
            return false;
    }else if($('#g_username').val() == ""){
        $(".text_error").html("Bạn chưa nhập vào Username");
            $(".error").dialog({
                  modal: true,
                  buttons: {
                    Ok: function() {
                      $( this ).dialog( "close" );
                    }
                  }
            });

            $("#g_username").focus();
            return false;
    }else{
        url = root+'gametool/ajax_playgame?'+'server='+$('.server').val()+"&port="+$('#port_game').val()+"&username="+$('#g_username').val();

        window.location.href = url ;
    }
}

function is_number(s){
    test="0123456789";
    i=0;
    len=s.length;
    if((s.substring(0,1)=='-'||s.substring(0,1)=='+')&&len!=1)
    i=1;
        isnum=true;
    while(i<len&&isnum){
        c=s.substring(i,i+1);
        if(test.indexOf(c,0)==-1)
            isnum=false;
        else
            ++i;
    }
    return isnum;
}

</script>