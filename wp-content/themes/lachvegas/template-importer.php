<?php
/**
 * Template Name: IMPORTER
 */

include_once __DIR__ . '/lib/models/csv_reader.php';
//include __DIR__ . '/lib/models/job.php';
//include __DIR__ . '/lib/models/news.php';
include_once __DIR__ . '/lib/models/saying.php';

get_header(); 

$path = dirname(__FILE__) . '/data/csv/DATEN/';

$datasets = [
	[
		'name' => 'News',
		'file' => 'News.csv',
		'post_type' => 'news',
		'field_id' => 'news_id',
		'taxonomies' => []
	],
	[
		'name' => 'Partnerboerse',
		'file' => 'Partnerboerse-Partnerboerse.csv'
	],
	[
		'name' => 'Sprueche',
		'file' => 'Sprueche-Sprueche.csv',
		'post_type' => 'saying',
		'field_id' => 'saying_id',
		'fields' => [
			'ID', 'Img', 'Title', 'Categories', 'Tags', 'Action'
		]
	],
	[
		'name' => 'Stellenangebote',
		'file' => 'Stellenangebote-Stellenangebote.csv',
		'post_type' => 'job',
		'field_id' => 'job_id',
	]
];


$DATA = null;

if (isset($_REQUEST['dataset'])) {
	$selectedDataset = $_REQUEST['dataset'];
	
	foreach($datasets as $d) {
		if ($d['name'] === $selectedDataset) {
			$DATA = $d;
		}
	}

	$DATA = (object)$DATA;

	if (isset($DATA->name)) {
		$csvReader = new CSVReader($path . $DATA->file);
		$csvReader->readAll();

		var_dump( $DATA->entries = $csvReader->getData() );

		// read all previously imported posts and merge them with the csv data
		$args = array(
			'post_status' => 'any',
			'post_type' => $DATA->post_type,
			'posts_per_page' => -1
		);
		$query = new WP_Query($args);

		for ($i=1; $i<count($DATA->entries)-1; $i++) {

			$d = $DATA->entries[$i];
	
			$imported = false;
	
			while ($query->have_posts()) {
				$query->the_post(); 
				setup_postdata($post);
	
				$id = $post->ID;
				$field_id = get_post_meta($id, $DATA->field_id, true);
				//$import_hash = get_post_meta($id, 'import_hash', true);
	
				if (!empty($field_id) && (int)$d->id == (int)$field_id) {
					$imported = true;
				}
			} 
	
			if (isset($_REQUEST['import_all']) && !empty($_REQUEST['import_all'])) {

				// echo 'import all data from post type ' . $DATA->post_type;
				if ((int)$d->id == 16) {
					switch ($DATA->post_type) {
						case 'saying':
							//echo 'import saying';
							//var_dump($d);
							$saying = new Saying($d);
							$saying->save();
							break;
					}
				}

			}
	
			if ($imported) {
				$d->imported = true;
			} else {
				$d->imported = false;
			}

		}
	}

}

?>


<div class="content">
	<div class="content__area">
		<div class="content__area--wide entry-content" style="padding: 0 40px;">

			<select id="datasets">
				<option value="">Bitte wählen</option>
				<?php foreach($datasets as $dataset): ?>
					<option value="<?= $dataset['name'] ?>"><?= $dataset['file'] ?></option>
				<?php endforeach ?>	
			</select>

			<?php if ($DATA): ?>

				<h1><?= $DATA->name ?></h1>
				<p>insgesamt: <?= count($DATA->entries) ?></p>

				<br><br><br>

				<form class="form" action="" method="post">
					<!-- <input type="hidden" name="post_type" value="<?= $DATA->post_type ?>" />-->
					<input type="submit" name="import_all" value="Alle Importieren" />
				</form>

				<br><br><br>

				<table class="table table-striped" cellspacing="0" cellpadding="0">
					<tr>
						<?php foreach($DATA->fields as $field): ?>
							<th><?= $field ?></th>
						<?php endforeach ?>
					</tr>
					<?php foreach($DATA->entries as $entry): ?>
						<?php if (is_object($entry)): ?>
						<tr>
							<?php foreach($entry as $key => $value): ?>
								<?php $bgClass = false; ?>
								<?php if (isset($entry->imported) && $entry->imported === true): $bgClass = 'style="background-color: lightgreen;"'; endif ?>
								<td <?= $bgClass ?>><?= $value ?></td>
							<?php endforeach ?>
							<td <?= $bgClass ?>>
								<button type="button" class="button" data-post-type="<?= $DATA->post_type ?>" data-id="<?= $post->ID ?>"><?= ($entry->imported) ? 'Update' : 'Import' ?></button>
							</td>
						</tr>
						<?php endif ?>
					<?php endforeach ?>
				</table>

			<?php else: ?>
				<p><br><br>KEINE Daten - Bitte wählen Sie einen Datensatz aus</p>
			<?php endif ?>

		</div>

	</div>
</div>



<script
  src="https://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous"></script>

<script type="text/javascript">

jQuery(document).ready(function($) {

	console.log(window.location);

	$('#datasets').change(function(e) {
		var selectedDataset = $(this).children("option:selected").val();
		console.log('changed', selectedDataset);
		window.location.href = window.location.origin + window.location.pathname + '?dataset=' + selectedDataset;
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
				action: 'import_job'
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
