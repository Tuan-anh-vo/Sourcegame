<div class="right-content-title">THỐNG KÊ LEVEL NGƯỜI CHƠI</div>
<div class="right-content-d3">
    <div class="right-content-d1-server">Chọn Server</div>
    <div class="right-content-d1-input-server">
        <select name="server" id="slcServer">
            <option value="0">Chọn Server</option>
            <?=htmlSelect($servers, 'id','name')?>
        </select>
    </div>
    <div class="right-content-d2-btxem viewajax"><a href="javascript:;" class="viewajax">XEM</a></div>

    <div class="clear"></div>

</div>

<div class="right-content-thongke">
    <div class="contentajax"></div>
    <div class="clear"></div>
</div>
<div class="clear"></div>

<script type="text/javascript">
    $(document).ready(function(){
        $( ".name" ).keypress(function( event ) {
            if ( event.which == 13 ) {
                event.preventDefault();
                getajax();
            }
        });
        $(".viewajax").click(function(){
            getajax();
        });
    });
    function getajax(){
        var sid = $('#slcServer').val();
        if(sid > 0){
            $.get(
                root + 'gametool/ajax_thongkelevel',
                {
                    server : sid
                },
                function(rs){
                    $('.contentajax').html(rs);
                }
                )
        }
    }
</script>