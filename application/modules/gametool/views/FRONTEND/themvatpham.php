<div class="right-content-title">Thêm Vật Phẩm</div>
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
<div class="clear"></div>
<div class="right-content-d1">
    <div class="right-content-d1-tennv">Nickname</div>
    <div class="right-content-d1-input-tennv"><input class="name" type="text"/></div>
</div>

<div class="right-content-d1">
    <div class="right-content-d1-tennv">itemId:</div>
    <div class="right-content-d1-input-tennv"><input class="itemid" type="text"/></div>
</div>

<div class="right-content-d1">
    <div class="right-content-d1-tennv">Số lượng</div>
    <div class="right-content-d1-input-tennv"><input class="soluong" type="text"/></div>
</div>

<div class="clear"></div>
<div class="table_tk_nt">
    <table>
        <tr>
            <th>Tên</th>
            <th>Vật phẩm</th>
            <th>Số lượng</th>
            <th>Server</th>
            <th>Ngày</th>
        </tr>
        <?php 
  		foreach ($servers as $key=>$value){
  			$servers_fix[$value->id]=$value;
  		}
  		
        if(!empty($result)) foreach ($result as $key=>$value){
        	?>
        <tr>
            <td><?=$value->name ?></td>
            <td><?=$value->item ?></td>
             <td><? if($value->total==-1){
            		echo "Không thành công";
            	   }else{
            	   echo $value->total; 
            	   }
            	 ?>
           	</td>
            <td><? if(isset($servers_fix[$value->sid]->name)) echo $servers_fix[$value->sid]->name;?></td>
            <td><?=date("d/m/Y H:i-s",strtotime($value->created) ) ?></td>
        </tr>
        <?php } ?>
        <tr><?=$pageLink?></tr>
    </table>
</div>

<form method="post" id="formItems" onsubmit="return jQuery(this).validationEngine('validate');">
    <div class="row_items"></div>
    <div class="submiterror"></div>
<div class="clear"></div>
<div class="right-content-d4">
    <input class="right-content-d4-btadd" value="Thêm" type="submit">
    <input class="sum" type="hidden" value="0">
</div>
</form>
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
                themvatpham();
            }
        });
        $( ".knb" ).keypress(function( event ) {
            if ( event.which == 13 ) {
                event.preventDefault();
                themvatpham();
            }
        });
        $(".right-content-d4-btadd").click(function(e){
            e.preventDefault();
            themvatpham();
        });
    });

    function check(){
        if($(".server").val() == 0)
        {
            $(".text_error").html("Bạn chưa chọn server");
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
        }
        if($(".name").val() =='')
        {
            $(".text_error").html("Bạn chưa nhập tài khoản");
            $(".error").dialog({
                  modal: true,
                  buttons: {
                    Ok: function() {
                      $( this ).dialog( "close" );
                    }
                  }
            });
            $(".name").focus();
            return false;
        }
        if($(".itemid").val() =='')
        {
            $(".text_error").html("Bạn chưa nhập số lượng Knb");
            $(".error").dialog({
                  modal: true,
                  buttons: {
                    Ok: function() {
                      $( this ).dialog( "close" );
                    }
                  }
            });
            $(".itemid").focus();
            return false;
        }
        if($(".soluong").val() =='')
        {
            $(".text_error").html("Bạn chưa nhập số lượng Knb");
            $(".error").dialog({
                  modal: true,
                  buttons: {
                    Ok: function() {
                      $( this ).dialog( "close" );
                    }
                  }
            });
            $(".soluong").focus();
            return false;
        }
    }

    function themvatpham(){
        check();
       $(".showcontent").html("");
        if($(".server").val() != 0 && $(".name").val() !='' && $(".knb").val() !='')
        {
            $.ajax({
                url: root+'gametool/themvatphamAjax',
                type: 'POST',
                cache: false,
                data: 'soluong='+ $(".soluong").val() +'&name='+$(".name").val() +'&itemid='+$(".itemid").val() + "&server="+$(".server option:selected").val(),
                dataType: 'Text',
                success: function(string){
                    if(string == 'success')
                    {
                        $(".showcontent").html("Thêm Vật Phẩm thành công!");
                    }
                    else
                    {
                        $(".showcontent").html(string);
                        
                    }
                },
                error: function (){

                }
            });
        }
    }
</script>