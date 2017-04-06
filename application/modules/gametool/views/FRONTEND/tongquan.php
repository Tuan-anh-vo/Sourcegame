<div class="right-content-title">TỔNG QUAN</div>
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
           getajax();
        $(".viewajax").click(function(){
            getajax();
        });
        getajax();
    });
    function getajax(){
        var sid = $('#slcServer').val();
        // if(sid > 0){
            $.get(
                root + 'gametool/ajax_tongquan',
                {
                    server : sid
                },
                function(rs){
                    $('.contentajax').html(rs);
                }
                )
        // }
    }
</script>