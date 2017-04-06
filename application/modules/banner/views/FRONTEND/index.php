<?php if($banner){
    echo "<a class='popup_cb' href=".getPathViewImage($banner->image).">
    </a>" ;
    ?>
    <script type="text/javascript">
    $(document).ready(function() {
        setTimeout(function(){
            $('.popup_cb').fancybox({
              beforeShow : function(){
                  $(".fancybox-inner").find("img").addClass("linkBanner").attr('onclick','linkBanner()');
              }
            }).trigger('click');
        },200);

    });

    function linkBanner(){
        if(user_login){
            window.open('<?php echo $banner->linkimage;?>','_blank');
        }else{
            PopupCtrl.PlayNow();
        }
    }

</script>
<?php }?>




