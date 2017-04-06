<?php
if(!session_id())
	session_start();
$capt = md5(strtolower(@$_GET['inputCode']) . "maXMU@123");
if($capt == $_SESSION['captcha'])
	echo 'true';
else
	echo "Mã kiểm tra không đúng";