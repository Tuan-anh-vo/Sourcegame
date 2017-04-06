<div class="right-content-title">KHÓA/MỞ KHÓA TÀI KHOẢN</div>
<div class="right-content-d1">
    <div class="right-content-d1-tennv">Tên NV</div>
    <div class="right-content-d1-input-tennv"><input class="namecharacter" type="text"/></div>
    <div class="right-content-d1-orid">OR ID</div>
    <div class="right-content-d1-input-orid"><input class="idcharacter" type="text" /></div>
    <div class="right-content-d1-server">Server</div>
    <div class="right-content-d1-input-server">
        <select name="server" class="server">
            <option value="0">Chọn Server</option>
            <?php
            if($server)
            {
                foreach($server as $item)
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
<div class="right-content-d2">
    <div class="right-content-d2-btkiemtra">KIỂM TRA</div>
    <div class="right-content-d2-btkhoa">KHÓA</div>
    <div class="right-content-d2-btmo">MỞ</div>
    <div class="clear"></div>
</div>
<div class="right-content-listnv">

</div>


<script type="text/javascript">
    $(document).ready(function(){
        $( ".name" ).keypress(function( event ) {
            if ( event.which == 13 ) {
                event.preventDefault();
            }
        });
        $(".right-content-d2-btkiemtra").click(function(){
            getajaxCheck();
        });

        $(".right-content-d2-btmo").click(function(){
            getajaxBlock(0);
        });

        $(".right-content-d2-btkhoa").click(function(){
            getajaxBlock(1);
        });

    });

    function checkdata(){
        if($(".idcharacter").val() =='' &&  $(".namecharacter").val() =='')
        {
            alert("Bạn chưa điền Username hoặc Id");
            $(".namecharacter").focus();
            return false;
        }
        if($(".server").val() == 0)
        {
            alert("Bạn chưa chọn server");
            $(".server").focus();
            return false;
        }
        if($(".idcharacter").val() !='' &&  $(".namecharacter").val() =='')
        {
            name = $(".idcharacter").val();
        }
        else
        {
            name = $(".namecharacter").val();
        }
    }
    function getajaxCheck(){
        checkdata();
        if( ($(".idcharacter").val() !='' ||  $(".namecharacter").val() !='') && $(".server").val() != 0 )
        {
            $.ajax({
                url: root+'gametool/checkUser',
                type: 'POST',
                cache: false,
                data: "name=" + name  + "&server="+$(".server option:selected").val(),
                dataType: 'Text',
                success: function(string){
                    if(string == "1")
                    {
                        alert("Tồn tại tài khoản");
                    }
                    else
                    {
                        alert("Không tìm thấy tài khoản");
                    }
                },
                error: function (){

                }
            });
        }
    }

    function getajaxBlock(status){
        checkdata();
        if( ($(".idcharacter").val() !='' ||  $(".namecharacter").val() !='') && $(".server").val() != 0 )
        {
            $.ajax({
                url: root+'gametool/blockAccountAjax',
                type: 'POST',
                cache: false,
                data: "name=" + name  + "&server="+$(".server option:selected").val() + "&status=" + status,
                dataType: 'Text',
                success: function(string){
                   if(string == "1")
                   {
                        alert("Thao tác thành công");
                   }
                   else
                   {
                       alert("Thao tác thất bại");
                   }
                },
                error: function (){

                }
            });
        }
    }
</script>

