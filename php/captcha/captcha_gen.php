<?php
    session_start();
    header("Content-type: image/jpeg");
    $text   = $_SESSION['code'] = mt_rand(1111,9999);
    $font_size   = 25;
    $width      = 200;
    $height      = 50;
    $image      = imagecreate($width,$height);
    imagecolorallocate($image,215,215,215);
    $font_color = imagecolorallocate($image,0,0,0);
    imagettftext($image,$font_size,0,20,40,$font_color, "font.ttf",$text);
    imagejpeg($image);
?>