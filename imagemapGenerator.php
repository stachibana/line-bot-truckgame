<?php

define("GD_BASE_SIZE", 700);

$stageid = urldecode(explode("|", $_REQUEST["para"])[0]);
$treasures = json_decode(urldecode(explode("|", $_REQUEST["para"])[1]), true);
$carpos = json_decode(urldecode(explode("|", $_REQUEST["para"])[2]), true);
$cardirection = urldecode(explode("|", $_REQUEST["para"])[3]);
$canTap = (bool)(urldecode(explode("|", $_REQUEST["para"])[4]));

$base = "http://" . $_SERVER["HTTP_HOST"] . "/stages/stage_" .  str_pad($stageid + 1, 2, 0, STR_PAD_LEFT) . ".png";
$dst_im = imagecreatefrompng($base);

foreach($treasures as $pos) {
  $overlay = imagecreatefrompng("http://" . $_SERVER["HTTP_HOST"] . "/stages/overlay.png");
  ImageCopyResampled($dst_im, $overlay, 117 * $pos[1], 117 * $pos[0], 0, 0, 117, 117, 117, 117);
}

$car = imagecreatefrompng("http://" . $_SERVER["HTTP_HOST"] . "/stages/car.png");

if($cardirection == "l") {
  $rotate = ImageRotate($car, 90, 0);
} else if($cardirection == "d") {
  $rotate = ImageRotate($car, 180, 0);
} else if($cardirection == "r") {
  $rotate = ImageRotate($car, 270, 0);
} else {
  $rotate = $car;
}
ImageCopyResampled($dst_im, $rotate, 117 * $carpos[1], 117 * $carpos[0], 0, 0, 117, 117, 117, 117);

if($canTap) {
  $arrow = imagecreatefrompng("http://" . $_SERVER["HTTP_HOST"] . "/stages/arrow.png");
  ImageCopyResampled($dst_im, $arrow, 0, 0, 0, 0, 700, 700, 700, 700);
}

$size = $_REQUEST["size"];
if($size == GD_BASE_SIZE) {
	$out = $dst_im;
} else {
	$out = ImageCreateTrueColor($size ,$size);
	ImageCopyResampled($out, $dst_im, 0, 0, 0, 0, $size, $size, GD_BASE_SIZE, GD_BASE_SIZE);
}

ob_start();
imagepng($out, null, 9);
$content = base64_encode(ob_get_contents());
ob_end_clean();

header('Content-type: image/png');
header('Cache-Control: no-cache, must-revalidate');
echo base64_decode($content);

 ?>
