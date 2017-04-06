<div class="wrapper">
    <div class="popupteaser">
        <div class="popupvideo" style="height:auto;">
            <a href="javascript:;" onclick="PopupCtrl.HidePopup()"><img src="https://dolongky.vtcgame.vn/teaser/images/close-popup.png" alt=""></a>

            <iframe width="625" height="340" src="https://www.youtube.com/embed/jIoFN4XS31k?autoplay=1" frameborder="0" allowfullscreen style="margin-bottom: -3px;"></iframe>

        </div><!--  end popuptuong -->
    </div>
</div> <!-- end popup -->
<script>
    var width = 460;
    var height = 178;
    var topOffset = (((windowHeight() - height) / 2) * 100) / windowHeight();
    var leftOffset = (((windowWidth() - width) / 2) * 100) / windowWidth();
    $('#popupwrap').css('width', width + 'px');
    $('#popupwrap').css('left', leftOffset + "%");
    $('#popupwrap').css("top", topOffset + "%");
    $('#popupwrap').css('z-index', 9999999);
    $('#popupwrap').css('position', 'fixed');
</script>