<?php
/**
 * Passwordgenerator PHP
 */

wp_enqueue_script( 'underscore', get_bloginfo('template_url') . '/js/underscore.min.js' );
wp_enqueue_script( 'passwordgenerator', get_bloginfo('template_url') . '/js/passwordgenerator.js' );

?>


<?php

$options = array(
	array('id' => 'a-z', 'title' => 'a-z', 'type' => 'checkbox'),
	array('id' => 'A-Z', 'title' => 'A-Z', 'type' => 'checkbox'),
	array('id' => '0-9', 'title' => '0-9', 'type' => 'checkbox'),
	array('id' => 'specialchars', 'title' => 'Sonderzeichen', 'type' => 'checkbox'),
	array('id' => 'german_chars', 'title' => 'Umlaute', 'type' => 'checkbox')
);
$settings = array(
	array('id' => 'unique', 'title' => 'Zeichen nur einmal verwenden', 'type' => 'checkbox')
);

?>

<div class="tools-block">
<form id="passwordgenerator-form" name="passwordgenerator-form" class="content-form" action="">

	<span class="input-block">
		<label for="pw-length">L&auml;nge</label><br/>
		<input class="input-small" type="text" id="pw-length" name="pw-length" value="10"/>
	</span>
	<span class="input-block">
		<label for="pw-amount">Anzahl</label><br/>
		<input class="input-small" type="text" id="pw-amount" name="pw-amount" value="1"/>
	</span>

	<br/><br/>
	<p id="options-btn">Optionen:</p>

	<div id="options">
		<?php foreach($options as $option):?>
			<span class="option">
				<input type="<?php echo $option['type']?>" name="<?php echo $option['title']?>" id="<?php echo $option['id']?>" class="options" checked="checked"/>
				<label for="<?php echo $option['id']?>"><?php echo $option['title']?></label>
			</span>
		<?php endforeach;?>

		<?php foreach($settings as $setting):?>
			<span class="option">
				<input type="<?php echo $setting['type']?>" name="<?php echo $setting['title']?>" id="<?php echo $setting['id']?>" class="settings" checked="checked"/>
				<label for="<?php echo $setting['id']?>"><?php echo $setting['title']?></label>
			</span>
		<?php endforeach;?>
	</div>

	<br/><br/>
	<input class="button orange" type="submit" name="submit" id="submit" value="Passwort erzeugen"/>
	<span id="password-output"></span>
	<span id="clear-password-list">Liste Leeren</span>
	<div id="password-list"></div>

	<?php
		//for($i=0; $i<10000; $i++){
			//echo '<p id="'.$i.'">&#'.$i.'</p>';
		//}
	?>
</form>
</div>
