<?php
session_start();

$width = 200;
$height = 50;
$image = imagecreatetruecolor($width, $height);

imagesavealpha($image, true);
$transparentColor = imagecolorallocatealpha($image, 0, 0, 0, 127);
imagefill($image, 0, 0, $transparentColor);

$background = imagecreatefrompng('captcha.png');
imagecopyresampled($image, $background, 0, 0, 0, 0, $width, $height, imagesx($background), imagesy($background));
imagedestroy($background);

$captchaCode = generateCaptchaCode($image);
$_SESSION['captcha_code'] = $captchaCode;

function generateCaptchaCode($image, $length = 5) {
    $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    $captchaCode = '';

    $colorBrightness = 200;
    $contrast = 200;

    for ($i = 0; $i < $length; $i++) {
        $rotation = rand(-15, 15);
        
        $textColor = imagecolorallocatealpha($image, rand($contrast, $colorBrightness), rand($contrast, $colorBrightness), rand($contrast, $colorBrightness), 0);
        $textColorShadow = imagecolorallocatealpha($image, 0, 0, 0, 63);

        $rot = rand(0,5);
        $char = $characters[rand(0, strlen($characters)-1)];
        $captchaCode .= drawRotatedText($image, 25 - $rot, $rotation, 45 + $i * 30, 55, $textColorShadow, 'font.ttf', $char);
        $captchaCode .= drawRotatedText($image, 25 - $rot, $rotation, 45 + $i * 30, 50, $textColor, 'font.ttf', $char);
    }

    return $captchaCode;
}

function drawRotatedText($image, $size, $angle, $x, $y, $color, $font, $text) {
    $bbox = imagettfbbox($size, 0, $font, $text);
    $width = $bbox[2] - $bbox[0];
    $height = $bbox[3] - $bbox[5];
    
    $x -= $width / 2;
    $y -= $height / 2;
    
    imagettftext($image, $size, $angle, $x, $y, $color, $font, $text);
    
    return $text;
}

header('Content-Type: image/png');
imagepng($image);

imagedestroy($image);
?>
