<?php
include 'functions.php';
session_start();

$captcha = generateCaptchaString();
$_SESSION['captcha'] = $captcha;

$fontPath = getFontPath();

$imageWidth = 160;
$imageHeight = 50;
$fontSize = 30;
$angle = rand(-5, 5);

$image = imagecreatetruecolor($imageWidth, $imageHeight);
$fontColor = getFontColor($image);
$backgroundColor = imagecolorallocate($image, 255, 255, 255);
imagefilledrectangle($image, 0, 0, $imageWidth, $imageHeight, $backgroundColor);

$box = imagettfbbox($fontSize, $angle, $fontPath, $captcha);
$textwidth = abs($box[4] - $box[0]);
$x = ($imageWidth - $textwidth) / 2;
$textHeight = abs($box[5] - $box[1]);
$y = ($imageHeight + $textHeight) / 2 -5;

imagettftext($image, $fontSize, $angle, $x, $y, $fontColor, $fontPath, $captcha);

header("Content-type: image/png");
imagepng($image);