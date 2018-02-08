<?php

define("GD_BASE_SIZE", 700);

$clearArray = json_decode(urldecode(explode("|", $_REQUEST["para"])[0]), true);
$parArray = json_decode(urldecode(explode("|", $_REQUEST["para"])[1]), true);

$base = "http://" . $_SERVER["HTTP_HOST"] . "/stages/stage_select.png";
$dst_im = imagecreatefrompng($base);

foreach($clearArray as $index) {
  $row = floor($index / 5);
  $col = $index % 5;
  $overlay = imagecreatefrompng("http://" . $_SERVER["HTTP_HOST"] . "/stages/clear_01.png");
  ImageCopyResampled($dst_im, $overlay, 114 + 121 * $col, 23 + 116 * $row, 0, 0, 40, 40, 40, 40);
}

foreach($parArray as $index) {
  $row = floor($index / 5);
  $col = $index % 5;
  $overlay = imagecreatefrompng("http://" . $_SERVER["HTTP_HOST"] . "/stages/clear_02.png");
  ImageCopyResampled($dst_im, $overlay, 114 + 121 * $col, 23 + 116 * $row, 0, 0, 40, 40, 40, 40);
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
