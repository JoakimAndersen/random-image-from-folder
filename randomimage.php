<?php

$allowed_extensions = array('jpg', 'png', 'gif');

$dirname = dirname(__FILE__);
$dir = dir($dirname);

$images = array();

while ($entry = $dir->read()) {
	if ($entry[0] != '.') {
		if (in_array(substr(strtolower($entry), -3), $allowed_extensions)) {
			array_push($images, $entry);
		}
	}
}


if (!count($images)) {
	$img = imagecreatetruecolor(32, 32);
	$color = imagecolorallocate($img, 255, 255, 255);
	imagefill($img, 0, 0, $color);
	header('Content-Type: image/png');
	imagepng($img);
	exit;
}

$key = array_rand($images, 1);

$fullpath = $dirname . DIRECTORY_SEPARATOR . $images[$key];

$imagesize = getimagesize($fullpath);

header('Content-Type: ' . $imagesize['mime']);
header('Content-Length: ' . filesize($fullpath));
header('Cache-Control: no-cache');
header('Expires: -1');

readfile($fullpath);

?>
