<?PHP
  // Adapted for The Art of Web: www.the-art-of-web.com
  // Please acknowledge use of this code by including this header.

  // initialize image with dimensions of 120 x 30 pixels
  $image = @imagecreatetruecolor(120, 30) or die("Cannot Initialize new GD image stream");
  
/// new code
  imageantialias($image, true);
 
  $colors = [];
   
  $red = rand(125, 175);
  $green = rand(125, 175);
  $blue = rand(125, 175);
   
  for($i = 0; $i < 5; $i++) {
    $colors[] = imagecolorallocate($image, $red - 20*$i, $green - 20*$i, $blue - 20*$i);
  }
   
  imagefill($image, 0, 0, $colors[0]);
   
  for($i = 0; $i < 10; $i++) {
    imagesetthickness($image, rand(2, 10));
    $rect_color = $colors[rand(1, 4)];
    imagerectangle($image, rand(-10, 190), rand(-10, 10), rand(-10, 190), rand(40, 60), $rect_color);
  }
  //// end of new code
  
  // set background to white and allocate drawing colours
  $linecolor = imagecolorallocate($image, 0xCC, 0xCC, 0xCC);
  //$textcolor = imagecolorallocate($image, 0x33, 0x33, 0x33);

  $black = imagecolorallocate($image, 0, 0, 0);
  $white = imagecolorallocate($image, 255, 255, 255);
  $textcolors = [$black, $white];

  //$textcolor = imagecolorallocate($image, $green, $blue, $red);
  //draw random lines on canvas
  for($i=0; $i < 5; $i++) {
    imagesetthickness($image, rand(1,3));
    imageline($image, 0, rand(0,30), 120, rand(0,30), $linecolor);
  }

  session_start();
   
  // add random digits to canvas
  $digit = '';
  for($x = 15; $x <= 95; $x += 20) {
    $digit .= ($num = rand(0, 9));
    imagechar($image, rand(5, 8), $x, rand(2, 14), $num, $textcolors[rand(0, 1)]);
  }

  // record digits in session variable
  $_SESSION['digit'] = $digit;

  // display image and clean up
  header('Content-type: image/png');
  imagepng($image);
  imagedestroy($image);
?>