<div class="right-content-title">THông Báo TRONG GAME </div>
<div class="clear"></div>
<div class="right-content-thongke" style="display:none;">
    <div class="contentajax"></div>
    <div class="clear"></div>
</div>
<div class="clear"></div>
<div class="right-content-d2">
    <div class="right-content-d2-left">
        <div class="right-content-d2-left-title">Nhập Thông Báo người chơi game</div>
        <textarea name="id-nguoichoi" class="thongbao"><?php if(isset($thongbao->content)) echo $thongbao->content?></textarea>
    </div> 
    <div class="clear"></div>
</div>
<div class="right-content-d2">
   <div class="right-content-d2-left">
        <div class="right-content-d2-left-title">Tình trạng bật       <input name="status" class="status" type="checkbox" <?php if(isset($thongbao->status) && ($thongbao->status == 1) ) echo "checked=checked";?>/></div>
  
    </div>
    <div class="clear"></div>
</div>

<div class="right-content-d4">
    <input class="right-content-d4-btadd save" value="Lưu" type="submit">
</div>
<div class="clear"></div>

<div class="showcontent"></div>
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
        $( ".name" ).keypress(function( event ) {
            if ( event.which == 13 ) {
                event.preventDefault();
                getajax();
            }
        });
        $(".save").click(function(e){
            e.preventDefault();
            //alert("a");
            getajax();
        });
    });

    function getajax(){
         if($(".thongbao").val() == '')
        {
            $(".text_error").html("Bạn chưa nhập thông báo!");
            $(".error").dialog({
                  modal: true,
                  buttons: {
                    Ok: function() {
                      $( this ).dialog( "close" );
                    }
                  }
            });

            $(".thongbao").focus();
            return false;
        }
        $.ajax({
                url: root+'gametool/thongbaogameAjax',
                type: 'POST',
                cache: false,
                data: 'status='+$(".status:checkbox:checked").val() + "&thongbao="+$(".thongbao").val(),
                dataType: 'Text',
                success: function(string){
                    if(string == 'success')
                        $(".showcontent").html("Lưu thành công");
                    else
                        $(".showcontent").html("Lưu không thành công");
                },
                error: function (){

                }
            });
    }
</script>