<?php
session_start();
header("Content-type: image/png");
$captchaImage = imagecreatefrompng("captcha.png") or die("Cannot Initialize new GD image stream");
$captchaFont = imageloadfont("font.gdf");
$captchaText = substr(md5(uniqid('')),-9,9);
$_SESSION['session_captchaText'] = $captchaText;
$captchaColor = imagecolorallocate($captchaImage,200,200,200);
imagestring($captchaImage,$captchaFont,15,5,$captchaText,$captchaColor);
imagepng($captchaImage);
imagedestroy($captchaImage);
?>