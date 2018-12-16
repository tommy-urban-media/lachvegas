<?php
/**
 * Template Name: Kalender
 */

get_header(); 

$calendar = array(

	array(
		'date' => '2019-04-14',
		'text' => 'Frischer Hasenbraten',
		'is_opened' => true
	),
	array(
		'date' => '2019-04-15',
		'text' => 'Vorschlaghammer: zum Zerschlagen von zu hart gekochten Ostereiern',
		'is_opened' => true
	),
	array(
		'date' => '2019-04-16',
		'text' => 'Vorschlaghammer: zum Zerschlagen von zu hart gekochten Ostereiern',
		'is_opened' => true
	),
	array(
		'date' => '2019-04-17',
		'text' => '<b>Vorschlaghammer</b> zum Zerschlagen von zu hart gekochten Ostereiern',
		'is_opened' => true
	),
	array(
		'date' => '2019-04-18',
		'title' => 'Gründonnerstag',
		'text' => 'Vorschlaghammer: zum Zerschlagen von zu hart gekochten Ostereiern',
		'is_opened' => true
	),
	array(
		'date' => '2019-04-19',
		'title' => 'Karfreitag',
		'text' => 'Ein Bündel Karotten um den Osterhasen anzulocken. Sollte er dennoch nicht kommen können Sie die Karotten mit Ihren Hasenzähnchen selbst futtern',
		'is_opened' => true
	),
	array(
		'date' => '2019-04-20',
		'title' => 'Karsamstag',
		'text' => '<b>Hasenskelett am Galgen</b> <p>Ideal zur Abschreckung böser Osterhasen die keine Geschenke mitbringen</p>',
		'is_opened' => true
	),
	array(
		'date' => '2019-04-21',
		'title' => 'Ostersonntag',
		'text' => '<b>Frischer Hasenbraten</b> <p>Der Osterhase wurde offenbar geschnappt.</p>',
		'is_opened' => true
	),
	array(
		'date' => '2019-04-22',
		'title' => 'Ostermontag',
		'text' => '1 weibliches Hasenkostüm zum Verkleiden. Damit locken Sie jeden Hasen an',
		'is_opened' => true
	),
	array(
		'date' => '2019-04-23',
		'text' => 'Vorschlaghammer: zum Zerschlagen von zu hart gekochten Ostereiern',
		'is_opened' => true
	)

);

?>


<div class="content">
	<div class="content__area">
		<div class="content__area--wide">

			<?php get_template_part('template-parts/article-socials')?>

			<h1 class="page-title"><?php the_title()?></h1>

			<div><?php the_content() ?></div>

			<div class="calendar-wrapper">
				<div class="calendar" data-component="Calendar">
					<ol>
						<?php foreach($calendar as $entry):?>
							<li class="calendar__item <?php echo $entry['is_opened'] ? 'calendar__item--cracked' : '' ?>" title="Osterei für diesen Tag öffnen">
								<div class="calendar__item__viewport"></div>
								<div class="calendar__item__date">
									<?= date('d.m.', strtotime($entry['date']))?>
									<?php if (isset($entry['title'])):?>
									<div class="calendar__item__date--day"><?= $entry['title'] ?></div>
									<?php endif ?>
								</div>
								<div class="calendar__item__text"><?= $entry['text']?></div>
							</li>
						<?php endforeach ?>
					</ol>
				</div>
			</div>

		</div>

	</div>
</div>

<?php get_footer(); ?>
