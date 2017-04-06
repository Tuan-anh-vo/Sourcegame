<div class="right-content-title">ADD KNB, TIỀN ĐỒNG, VẬT PHẨM </div>
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
<div class="right-content-d2">
    <div class="right-content-d2-left">
        <div class="right-content-d2-left-title">Nickname ( Xuống dòng để nhập nhiều người chơi )</div>
        <textarea name="name" class="name"></textarea>
    </div>
 
    <div class="clear"></div>
</div>
<div class="right-content-thongke" style="display:none;">
    <div class="contentajax"></div>
    <div class="clear"></div>
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
  		
        foreach ($result as $key=>$value){
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

<div class="clear"></div>
<form method="post" id="formItems" onsubmit="return jQuery(this).validationEngine('validate');">
    <div class="row_items"></div>
    <div class="submiterror"></div>
<div class="clear"></div>
<input type="button" value="Thêm Vật Phẩm" style="padding: 5px; margin: 21px 0px 0px;" onclick="addNew()" />
<div class="clear"></div>

<div class="right-content-d4">
    <input class="right-content-d4-btadd" value="ADD" type="submit">
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
            $(".text_error").html("Bạn chưa nhập tên tài khoản");
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
        
    }

    function themvatpham(){
        check();
       
        if($(".server").val() != 0 && $(".name").val() !='')
        {
            $.ajax({
                url: root+'gametool/themnhieuvatphamAjax',
                type: 'POST',
                cache: false,
                data: "server="+$(".server option:selected").val() + "&"+$("#formItems").serialize()+ "&name="+$(".name").val() + "&sum="+$(".sum").val(),
                dataType: 'Text',
                success: function(string){
                        $(".showcontent").html(string);
                },
                error: function (){

                }
            });
        }
    }
    function addNew(){
        var sum = $(".sum").val();
        $(".sum").val(++sum);

        var appendStr=  '<div class="right-content-d3">'+
                            '<div class="right-content-d3-label">ID VẬT PHẨM</div>'+
                             '<input type="text" name="idItem_'+sum+'" data-errormessage-value-missing="Nhập Id"  class="validate[required] idItem right-content-d3-input"/>'+
                            '<div class="right-content-d3-labelsoluong">SỐ LƯỢNG</div>'+
                            '<input type="text" name="sumItem_'+sum+'" data-errormessage-value-missing="Nhập số lượng" class="validate[required,custom[integer],min[0]] sumItem right-content-d3-txtsoluong"/>'+
                            '<div class="clear"></div>'+
                        '</div>';
        $('.row_items').append(appendStr);
    }
</script>