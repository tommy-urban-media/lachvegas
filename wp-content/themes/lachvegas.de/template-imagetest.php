<?php
/**
 * Template Name: Image Test
 */

get_header(); 


$args = array(
	'post_status' => 'any',
	'post_type' => 'saying',
	'posts_per_page' => -1
);
$sayingsQuery = new WP_Query($args);



require __DIR__ . '/app/vendor/autoload.php';

use GDText\Box;
use GDText\Color;

$width = 640;
$height = 640;
$sizeFactor = 4;

$texts = [
	'Veganer müssen beim Essen immer die Extrawurst spielen',
	/*
'Herrentag
Meine Frau wartet heute Nacht auf mich... 
Ganz Sicher!
',
'Ich bin wer ich bin',
'Und nicht vergessen:

Selbst wenn du nichts kannst und zu nichts zu gebrauchen bist. Deine Organe werden immer auf dem Schwarzmarkt gebraucht.',
	'Den Menschen gibt es seit 120000 Jahren. Die totale Verblödung gibt es seitdem es lachvegas.de gibt.',
	'Seit 120000 Jahren gibt es den Menschen. Seitdem das Internet erfunden wurde gibt es die totale Verblödung.',
	'Der Mann ist so böse er würde sogar dem Weihnachtsmann den Sack klauen und dem Osterhasen die Ohren zusammenknoten',
	'Männer sind wie muskulöse Frauen mit Penissen und flachen Brüsten',
	'Ich bin zwar kein Gynäkologe aber ich weiß wie eine Fotze aussieht wenn ich sie sehe',
	'Warum benehmen sich Jungs immer anders wenn keine Frauen in der Nähe sind? Weil sie dann glauben Mama würde nicht bemerken was sie machen'
	*/
];


for ($i=0; $i<count($texts); $i++) {

	$imageName = sanitize_title($texts[$i]);

	if ( file_exists("images/". $imageName .".png")) {
		// continue;
	}

	$canvas = imagecreatefrompng('images/_default_640_640.png');
	//$canvas = imagecreatefromjpeg('images/_default.jpg');

	$black = imagecolorallocate( $canvas, 0, 0, 0 ); 
	$white = imagecolorallocate( $canvas, 255, 255, 255 ); 

	//imagefilledrectangle( $canvas, 9, 9, 189, 89, $white ); 

	$font = "/Library/Fonts/Arial+Bold.ttf"; 
	$text = $texts[$i];
	//$text = strtoupper($texts[$i]);
	$fontSize = 32; 

	$wordCount = strlen($text);
	// var_dump($wordCount);

	if ($wordCount <= 200) {
		$fontSize = 28;
	}
	if ($wordCount <= 150) {
		$fontSize = 48;
	}
	if ($wordCount <= 100) {
		$fontSize = 64;
	}
	if ($wordCount <= 50) {
		$fontSize = 68;
	}

	$fontSize *= $sizeFactor; 
	$font_color = imagecolorallocate($canvas, 255, 255, 255);
	$stroke_color = imagecolorallocate($canvas, 0, 0, 0);

	$box = new Box($canvas);
	$box->setFontFace('/Library/Fonts/Arial.ttf'); // http://www.dafont.com/pacifico.font
	$box->setFontSize($fontSize);
	$box->setFontColor(new Color(255, 255, 255));
	$box->setTextShadow(new Color(0, 0, 0, 50), 2, 2);
	$box->setBox(200, 200, $width*$sizeFactor - 400, $height*$sizeFactor - 600);
	$box->setTextAlign('center', 'center');
	$box->draw($text);

	$text = wordwrap($text, 28, "\n");

	$box = imagettfbbox( $fontSize, 0, $font, $text ); 
	$x = ($width*$sizeFactor - ($box[2] - $box[0])) / 2; 
	$y = ($height*$sizeFactor - ($box[1] - $box[7])) / 2; 
	$y -= $box[7]; 

	$y -= 120;

	//imageTTFText( $canvas, $fontSize, 0, $x, $y, $black, $font, $text ); 
	//imagettfstroketext($canvas, $fontSize, 0, $x, $y, $font_color, $stroke_color, $font, $text, 4);

	imagealphablending($canvas, false);
	imagesavealpha($canvas, true);

	$imageResized = imagecreatetruecolor($width, $height);

	imagealphablending($imageResized, false);
	imagesavealpha($imageResized, true);

	imagecopyresampled($imageResized, $canvas, 0, 0, 0, 0, $width, $height, $width*$sizeFactor, $height*$sizeFactor);

	//imagejpeg( $canvas, "images/imagetest.jpg", 100 ); 
	
	imagepng( $imageResized, "images/". $imageName ."_640_640.png", 9, PNG_ALL_FILTERS); 

	ImageDestroy( $canvas ); 

}


function imagettfstroketext(&$image, $size, $angle, $x, $y, &$textcolor, &$strokecolor, $fontfile, $text, $px) {
	for($c1 = ($x-abs($px)); $c1 <= ($x+abs($px)); $c1++)
			for($c2 = ($y-abs($px)); $c2 <= ($y+abs($px)); $c2++)
					$bg = imagettftext($image, $size, $angle, $c1, $c2, $strokecolor, $fontfile, $text);
 return imagettftext($image, $size, $angle, $x, $y, $textcolor, $fontfile, $text);
}


?>

<div class="content">
	<div class="content__area content__area--full">
		<section class="sec">
			<h1>Image Tests</h1>

			<?php if(have_posts()): ?>
			<?php while (have_posts()) : the_post(); setup_postdata($post)?>
				<?php the_content() ?>
			<?php endwhile ?>
			<?php endif ?>

			<form class="form" action="<?php echo admin_url('admin-ajax.php') ?>" method="post">
			<div class="actions" style="margin: 20px 0; padding: 20px; border-top: 1px solid #f0f0f0; border-bottom: 1px solid #f0f0f0">
				<input type="submit" class="button" name="generate_all_images" value="Alle Bilder generieren" />
			</div>

			<br><br><br><br>

			<table class="table">
				<tr>
					<th>ID</th>
					<th>PostThumb</th>
					<th>Bild</th>
					<th>Merged</th>
					<th>Spruch</th>
					<th>Aktion</th>
				</tr>
			<?php if($sayingsQuery->have_posts()): ?>
			<?php while ($sayingsQuery->have_posts()) : $sayingsQuery->the_post(); setup_postdata($post)?>
				<tr style="">
					<td>
						<?= $post->ID ?>
						<input type="hidden" class="post_id" data-post-id="<?= $post->ID ?>" value="<?= $post->ID ?>" />
					</td>

					<td width="128px">
						<?php if(has_post_thumbnail()): ?>
							<?php the_post_thumbnail('thumbnail')?>
						<?php endif ?>
					</td>

					<td width="128px">
						<?php if ($image = get_post_meta($post->ID, 'image_name', true)): ?>
							<img src="<?= get_bloginfo('template_url')?>/app/generated_images/<?= $image ?>" width="128" height="128" style="width: 128px; height: 128px; display: block; border: 1px solid #fff; margin: 0 auto;" />
						<?php else: ?>
							---
						<?php endif ?>
					</td>
					<td width="128px">
						<?php if (has_post_thumbnail() && $image = get_post_meta($post->ID, 'image_name', true)): ?>
							<img src="<?= get_bloginfo('template_url')?>/app/generated_images/<?= str_replace('.png', '_mick.png', $image) ?>" width="128" height="128" style="width: 128px; height: 128px; display: block; border: 1px solid #fff; margin: 0 auto;" />
						<?php else: ?>
							---
						<?php endif ?>
					</td>

					<td><?= get_the_title($post->ID) ?></td>
					<td><button type="button" class="button" name="generate_single_image" data-single-image data-id="<?= $post->ID ?>">Bild generieren</button></td>
				</tr>
			<?php endwhile ?>
			<?php endif ?>
			</table>

			</form>

			<!--
			<?php foreach($texts as $text): ?>
				<li style="margin: 50px auto; text-align: center;">
					<img src="../images/<?php echo sanitize_title($text)?>_640_640.png" width="320" height="320" alt="<?= $text ?>" style="width: 320px; height: 320px; border: 1px solid #fff; margin: 0 auto;" />
				</li>
			<?php endforeach ?>
			</ul>
			-->

		</section>
	</div>
</div>


<script
  src="https://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous"></script>

<script type="text/javascript">

jQuery(document).ready(function($) {

	$('.form').on('submit', function(e){
		console.log('submitting');
		e.preventDefault();

	});

	$('.button').on('click', function(e) {
		e.preventDefault();

		var id = $(this).data('id');

		console.log('sending', id);

		$.ajax({
			url: $('.form').attr('action'),
			type: 'POST',
			dataType: 'json',
			data: {
				id: id,
				action: 'generate_image_from_post_title'
			},
			success: function(d) {
				console.log(d);
			},
			error: function(jqXHR, textStatus, errorThrown) {
				console.log(jqXHR + " :: " + textStatus + " :: " + errorThrown);
			}
		})

	});

});
</script>

<?php get_footer(); ?>
