<script type="text/javascript">
	$(document).ready(function(){
		// var checkcookie = getCookie("checkcookie");
	 //    if (checkcookie != "on") {
	 //        $("#box").slideToggle();
	 //        $("#button").html("+");
	 //    }
	 //    else
	 //    {
	 //    	$("#button").html("-");
	 //    }
		   $("#box").slideToggle();
	        $("#button").html("+");
		setTimeout(function(){
			$("#widnow").show();
		}, 1000);
		$('#wrapper').scrollTop(3000);
		$("#text-bar").click(function(){
		    if($("#button").html() == "-"){
		        $("#button").html("+");
		    }
		    else{
		        $("#button").html("-");
		    }
		    $("#box").slideToggle();
		});
		$("#button").click(function(){
		    if($(this).html() == "-"){
		        $(this).html("+");
		    }
		    else{
		        $(this).html("-");
		    }
		    $("#box").slideToggle();
		    var checkcookie = getCookie("checkcookie");
		    if (checkcookie == "on") {
		    	setCookie("checkcookie", "off", "100");
		    }
		    else{
		    	setCookie("checkcookie", "on", "100");
		    }
		});
	});
function setCookie(cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays*24*60*60*1000));
    var expires = "expires="+d.toGMTString();
    document.cookie = cname + "=" + cvalue + "; " + expires +";"+"path=/";
}
function getCookie(cname) {
    var name = cname + "=";
    var ca = document.cookie.split(';');
    for(var i=0; i<ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1);
        if (c.indexOf(name) != -1) return c.substring(name.length,c.length);
    }
    return "";
}
</script>
<style type="text/css">
#widnow{z-index: 9999;width: 320px;border: solid 1px #444A4C;position: fixed;right: 0px;bottom: 0px;background: #17313D;}
#title_bar{background: #000;height: 25px;width: 100%;padding: 7px 0px;cursor: pointer;}
#text-bar{font-family: 'Roboto Condensed', sans-serif;float: left;width: 286px;line-height: 22px;text-align: center;font-weight: bold;color: #fff;}
#button{border: #000 solid 1px;width: 25px;height: 23px;float: right;cursor: pointer;background: #000;text-align: center;color: #fff;}
#box{height: 519px;background: #DFDFDF;overflow: auto;}
</style>
<style type="text/css">
  .comment-fb{position: fixed;bottom: 0px;right: 0px;z-index: 99;height: 520px;background: #fff;}
</style>
<?php
if($this->session->userdata("username") )
   $username = $this->session->userdata("username");
else
   $username = htmlentities("Khách");
?>

<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/vi_VN/sdk.js#xfbml=1&appId=1511025905813079&version=v2.0";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<div id="widnow"  style="display:none">
    <div id="title_bar">
       <div id="text-bar">Tám Truy Mộng</div><div id="button">+</div>
    </div>
    <div id="box">
    	<div class="chatlive">
			<div class="fb-comments comment-fb" data-href="https://www.facebook.com/truymongvn" data-width="320" data-numposts="5" data-colorscheme="light"></div>
		</div>
    </div>
</div>





