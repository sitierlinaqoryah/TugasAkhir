<?php

function generateCaptchaString($length = 5) {
  return strtoupper(substr(md5(rand()), 0, $length));
}

function getFontPath() {
  $files = glob('fonts/*.ttf');
  $file = array_rand($files);
  return $files[$file];
}

function getFontColor($image) {
  return imagecolorallocate($image, 0x00, 0x66, 0x99);
}

function isCaptchaValid() {
  if (!isset($_REQUEST['captcha']))
    return false;

  if (!isset($_SESSION['captcha']))
    return false;

  return strtoupper($_REQUEST['captcha']) == strtoupper($_SESSION['captcha']);
}