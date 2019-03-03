<?php

use GDText\Box;
use GDText\Color;

use \Treinetic\ImageArtist\lib\Shapes\Triangle;
use \Treinetic\ImageArtist\lib\Shapes\PolygonShape;
use \Treinetic\ImageArtist\lib\Commons\Node;
//use \Treinetic\ImageArtist\lib\Text\Color;
use \Treinetic\ImageArtist\lib\Overlays\Overlay;
use \Treinetic\ImageArtist\lib\Shapes\CircularShape;
use \Treinetic\ImageArtist\lib\Text\TextBox;
use \Treinetic\ImageArtist\lib\Text\Font;


class Image {

  private $width;
  private $height;
  private $sizeFactor;

  private $path;

  public function __construct( $options = [] ) {
    if ($options) {
      $this->width = $options->width;
      $this->height = $options->height;
      $this->sizeFactor = $options->sizeFactor;
      $this->text = $options->text;
      $this->slug = $options->slug;
      $this->postImage = $options->postImage;
    }
  }


  public function generate() {

    if ( file_exists("../app/generated_images/_default_640_640.png")) {
      // continue;
    }
  

    if ($this->postImage) {
      $canvas = imagecreatefrompng(get_template_directory() . '/app/generated_images/_default_with_image_640_640.png');
    } else {
      $canvas = imagecreatefrompng(get_template_directory() . '/app/generated_images/_default_640_640.png');
      //$canvas = imagecreatefromjpeg('images/_default.jpg');
    }
  
    $black = imagecolorallocate( $canvas, 0, 0, 0 ); 
    $white = imagecolorallocate( $canvas, 255, 255, 255 ); 
  
    //imagefilledrectangle( $canvas, 9, 9, 189, 89, $white ); 
  
    $font = "/Library/Fonts/Arial+Bold.ttf"; 
    $fontSize = 32; 
  
    $wordCount = strlen($this->text);
    // var_dump($wordCount);
  
    if ($wordCount <= 200) {
      $fontSize = 24;
    }
    if ($wordCount <= 150) {
      $fontSize = 40;
    }
    if ($wordCount <= 100) {
      $fontSize = 60;
    }
    if ($wordCount <= 50) {
      $fontSize = 64;
    }
  
    $fontSize *= $this->sizeFactor; 
    $font_color = imagecolorallocate($canvas, 255, 255, 255);
    $stroke_color = imagecolorallocate($canvas, 0, 0, 0);
  
    $box = new Box($canvas);
    $box->setFontFace('/Library/Fonts/Arial Bold.ttf'); // http://www.dafont.com/pacifico.font
    $box->setFontSize($fontSize);
    $box->setFontColor(new Color(255, 255, 255));
    $box->setTextShadow(new Color(0, 0, 0, 50), 12, 12);
    $box->setBox(200, 200, $this->width*$this->sizeFactor - 400, $this->height*$this->sizeFactor - 600);
    $box->setTextAlign('center', 'center');
    $box->draw($this->text);
  
    $text = wordwrap($this->text, 28, "\n");
  
    $box = imagettfbbox( $fontSize, 0, $font, $text ); 
    $x = ($this->width*$this->sizeFactor - ($box[2] - $box[0])) / 2; 
    $y = ($this->height*$this->sizeFactor - ($box[1] - $box[7])) / 2; 
    $y -= $box[7]; 
  
    $y -= 120;
  
    //imageTTFText( $canvas, $fontSize, 0, $x, $y, $black, $font, $text ); 
    //imagettfstroketext($canvas, $fontSize, 0, $x, $y, $font_color, $stroke_color, $font, $text, 4);
  
    imagealphablending($canvas, true);
    imagesavealpha($canvas, true);
  
    $imageResized = imagecreatetruecolor($this->width, $this->height);
  
    imagealphablending($imageResized, false);
    imagesavealpha($imageResized, true);
  
    imagecopyresampled($imageResized, $canvas, 0, 0, 0, 0, $this->width, $this->height, $this->width*$this->sizeFactor, $this->height*$this->sizeFactor);
  
    //imagejpeg( $canvas, "images/imagetest.jpg", 100 ); 

    $dir = get_template_directory() . "/app/generated_images/";
    $this->path = $this->slug . "_640_640.png";
    $this->path2 = $this->slug . "_640_640_mick.png";
    
    $t = imagepng($imageResized, $dir . $this->path, 9, PNG_ALL_FILTERS); 

    if ($this->postImage) {

      if (stristr($this->postImage, '.jpg') != FALSE) {
        $c_image = imagecreatefromjpeg($this->postImage);
      }
      else if (stristr($this->postImage, '.png') != FALSE) {
        $c_image = imagecreatefrompng($this->postImage);
      }

      imagealphablending($c_image, true);
      imagesavealpha($c_image, true);
      
      $imageResized2 = imagecreatetruecolor($this->width, $this->height);
      imagealphablending($imageResized2, true);
      imagesavealpha($imageResized2, true);
      imagecopyresampled($imageResized2, $c_image, 0, 0, 0, 0, 640, 640, $this->width, $this->height);

      $left = 80 * $this->sizeFactor;
      $top = 60 * $this->sizeFactor;
      $w = $this->width * $this->sizeFactor - $left*2;
      $h = $this->height * $this->sizeFactor - $top*2;

      //imagecopyresampled($c_image, $imageResized, 0, 0, 0, 0, 640, 640, 640, 640);
      //imagecopy($canvas, $tmp, 0, 0, 0, 0, $this->width*2, $this->height*2);
      //imagepng($c_image, $dir . $this->path2, 9, PNG_ALL_FILTERS); 

      //imagecopyresampled($canvas, $c_image, $left, $top, 0, 0, $w, $h, 480, 480);
      imagecopyresampled($imageResized2, $canvas, 0, 0, 0, 0, $this->width, $this->width, $this->width*$this->sizeFactor, $this->height*$this->sizeFactor);
      //imagecopy($canvas, $tmp, 0, 0, 0, 0, $this->width*2, $this->height*2);
      imagepng($imageResized2, $dir . $this->path2, 9, PNG_ALL_FILTERS); 

      imagedestroy($c_image);
    }

    imagedestroy( $canvas ); 

  }


  public function getPath() {
    return $this->path;
  }

}