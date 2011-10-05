<?php
session_start();

class CaptchaSecurityImages {

	function generateCode($chars) {
		/* list all possible characters, similar looking characters and vowels have been removed */
		$possible = '23456789bcdfghjkmnpqrstvwxyz';
		$code = '';
		$i = 0;
		while ($i < $chars) {
			$code .= substr($possible, mt_rand(0, strlen($possible)-1), 1);
			$i++;
		}
		return $code;
	}

	function CaptchaSecurityImages($width,$height,$chars,$rotate,$font,$bgrgb,$txrgb,$nrgb) {
		$code = $this->generateCode($chars);
		/* font size will be 50% of the image height */
		$font_size = $height * 0.5;
		$image = @imagecreate($width, $height) or die('Cannot initialize new GD image stream');
		/* set the colours */
		$background_color = imagecolorallocate($image, $bgrgb[0], $bgrgb[1], $bgrgb[2]); //background color
		$text_color = imagecolorallocate($image, $txrgb[0], $txrgb[1], $txrgb[2]);   //text color
		$noise_color = imagecolorallocate($image, $nrgb[0], $nrgb[1], $nrgb[2]);  //noise color
		/* generate random dots in background */
		for( $i=0; $i<($width*$height)/3; $i++ ) {
			imagefilledellipse($image, mt_rand(0,$width), mt_rand(0,$height), 1, 1, $noise_color);
		}
		/* generate random lines in background */
		for( $i=0; $i<($width*$height)/150; $i++ ) {
			imageline($image, mt_rand(0,$width), mt_rand(0,$height), mt_rand(0,$width), mt_rand(0,$height), $noise_color);
		}
		/* create textbox and add text */
    $angle = $rotate * (5*rand(0,4) - 10); // random rotation -10 to +10 degrees
		$textbox = imagettfbbox($font_size, $angle, $font, $code) or die('Error in imagettfbbox function');
		$x = ($width - $textbox[4])/2;
		$y = ($height - $textbox[5])/2;
		imagettftext($image, $font_size, $angle, $x, $y, $text_color, $font , $code) or die('Error in imagettftext function');
		/* output captcha image to browser */
		header('Content-Type: image/jpeg');
		imagejpeg($image);
		imagedestroy($image);
		$_SESSION['security_code'] = $code;
	}
}

function html2rgb($color){
    if ($color[0] == '#') $color = substr($color, 1);
    if (strlen($color) == 6) list($r, $g, $b) = array($color[0].$color[1], $color[2].$color[3], $color[4].$color[5]);
    elseif (strlen($color) == 3) list($r, $g, $b) = array($color[0], $color[1], $color[2]);
    else return false;
    $r = hexdec($r); $g = hexdec($g); $b = hexdec($b);
    return array($r, $g, $b);
}
$width = isset($_GET['width']) ? $_GET['width'] : '120';
$height = isset($_GET['height']) ? $_GET['height'] : '40';
$chars = isset($_GET['chars']) && $_GET['chars'] > 1 ? $_GET['chars'] : '6';
$rotate = isset($_GET['rotate']) ? $_GET['rotate'] : '0';
$font = isset($_GET['font']) ? $_GET['font'] : 'monofont.ttf';
$bghex = isset($_GET['bghex']) ? $_GET['bghex'] : '#FF0000';
$txhex = isset($_GET['txhex']) ? $_GET['txhex'] : '#FFFFFF';
$nhex = isset($_GET['nhex']) ? $_GET['nhex'] : '#000000';
$bgrgb = html2rgb($bghex);
$txrgb = html2rgb($txhex);
$nrgb = html2rgb($nhex);

$captcha = new CaptchaSecurityImages($width,$height,$chars,$rotate,$font,$bgrgb,$txrgb,$nrgb);

?>