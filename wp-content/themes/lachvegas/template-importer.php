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
$pathnews = dirname(__FILE__) . '/data/csv/News/';

$datasets = [
	[
		'name' => 'News 2018',
		'file' => $pathnews . '2018-Table 1.csv',
		'post_type' => 'news',
		'field_id' => 'news_id',
		'fields' => [
			'id', 'date', 'title', 'subtitle', 'content', 'categories', 'tags', 'person', 'repeatable', 'teasable', 'image'
		]
	],
	[
		'name' => 'News 2019',
		'file' => $pathnews . '2019-Table 1.csv',
		'post_type' => 'news',
		'field_id' => 'news_id',
		'fields' => [
			'id', 'date', 'title', 'subtitle', 'content', 'categories', 'tags', 'person', 'repeatable', 'teasable', 'image'
		]
	],
	[
		'name' => 'Partnerboerse',
		'file' => $path . 'Partnerboerse-Partnerboerse.csv',
		'post_type' => 'partner',
		'field_id' => 'partner_id',
		'fields' => [
			'id', 'date', 'name', 'description', 'male', 'female', 'divers', 'place', 'age', 'size'
		]
	],
	[
		'name' => 'Sprueche',
		'file' => $path . 'Sprueche-Sprueche.csv',
		'post_type' => 'saying',
		'field_id' => 'saying_id',
		'fields' => [
			'id', 'img', 'title', 'categories', 'tags'
		]
	],
	[
		'name' => 'Stellenangebote',
		'file' => $path . 'Stellenangebote-Stellenangebote.csv',
		'post_type' => 'job',
		'field_id' => 'job_id',
		'fields' => [
			'id', 'date', 'name', 'category', 'company', 'description', 'is_parttime', 'male', 'female', 'divers', 'place', 'Features'
		]
	]
];


if (isset($_REQUEST['update_repeatable_posts'])) {
	
	$oldPostsQuery = new WP_Query(array(
		'posts_per_page' => -1,
		'post_type' => array('guide', 'news', 'post', 'poem', 'statistic', 'quiz'),
		'date_query' => array(
			'relation' => 'OR',
			'before' => date('Y', time()) // past years
		),
		'tax_query' => array(
			'relation' => 'OR',
			array(
				'taxonomy' => 'post_settings',
				'field' => 'name',
				'terms' => array('repeatable')
			)
		),
	));

	while ($oldPostsQuery->have_posts()) {
		$oldPostsQuery->the_post(); 
		setup_postdata($post);
		
		//var_dump($post->post_date);
		update_post_meta($post->ID, 'original_date', $post->post_date);

		$newYear = date('Y-m-d H:i:s', strtotime(date('Y-m-d H:i:s', strtotime($post->post_date)) . "+365 days"));
		//var_dump($newYear);

		wp_update_post(array(
			'ID' => $post->ID,
			'post_date' => $newYear
		));

	} 

	echo $oldPostsQuery->post_count . ' News aktualisiert.';
}




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
		$csvReader = new CSVReader($DATA->file);
		$csvReader->readAll();

		$DATA->entries = $csvReader->getData();
		// var_dump($DATA->entries);
		

		// read all previously imported posts and merge them with the csv data
		$args = array(
			'post_status' => 'any',
			'post_type' => $DATA->post_type,
			'posts_per_page' => -1
		);
		$query = new WP_Query($args);

		$posts = [];

		while ($query->have_posts()) {
			$query->the_post(); 
			setup_postdata($post);
			$posts[] = $post;
		} 


		for ($i=1; $i<count($DATA->entries)-1; $i++) {

			$d = $DATA->entries[$i];
	
			$imported = false;

			foreach($posts as $p) {
				$id = $p->ID;
				$field_id = get_post_meta($id, $DATA->field_id, true);
				//$import_hash = get_post_meta($id, 'import_hash', true);
	
				if (!empty($field_id) && (int)$d->id == (int)$field_id) {
					$imported = true;
				}
			}
	
			if (isset($_REQUEST['import_all']) && !empty($_REQUEST['import_all'])) {

				// echo 'import all data from post type ' . $DATA->post_type;
				//if ((int)$d->id == 698) {

					//var_dump($d);

					switch ($DATA->post_type) {
						case 'news':
							//echo 'import saying';
							//var_dump($d);
							$news = new News($d);
							$news->save();
							break;
						case 'saying':
							//echo 'import saying';
							//var_dump($d);
							$saying = new Saying($d);
							$saying->save();
							break;
					}
				//}

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
          <input type="hidden" name="ajax_url" value="<?php echo admin_url('admin-ajax.php') ?>" />
					<input type="submit" name="import_all" value="Alle Importieren" />
				</form>

				<br><br><br>

				<table class="table table-striped" cellspacing="0" cellpadding="0">
					<tr>
						<?php foreach($DATA->fields as $field): ?>
							<th><?= $field ?></th>
						<?php endforeach ?>
						<th>Action</th>
					</tr>
					<?php foreach($DATA->entries as $entry): ?>
						<?php if (is_object($entry)): ?>
						<tr>
							<?php foreach($DATA->fields as $field): ?>
								<?php $bgClass = false; ?>
								<?php if (isset($entry->imported) && $entry->imported === true): $bgClass = 'style="background-color: lightgreen;"'; endif ?>

								<?php if (isset($entry->{$field})): ?>
										<td <?= $bgClass ?>><?= $entry->{$field} ?></td>
								<?php endif ?>
							<?php endforeach ?>
							<td <?= $bgClass ?>>
								<button type="button" class="button" data-post-type="<?= $DATA->post_type ?>" data-param='<?= json_encode($entry) ?>' data-id="<?= $post->ID ?>"><?= ($entry->imported) ? 'Update' : 'Import' ?></button>
							</td>
						</tr>
						<?php endif ?>
					<?php endforeach ?>
				</table>

			<?php else: ?>
				<p><br><br>KEINE Daten - Bitte wählen Sie einen Datensatz aus</p>

				<form class="form" action="" method="post">
          <input type="hidden" name="ajax_url" value="<?php echo admin_url('admin-ajax.php') ?>" />
					<input type="submit" name="update_repeatable_posts" value="Alte Beiträge aktualisieren" />
				</form>

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

	$('#datasets').change(function(e) {
		var selectedDataset = $(this).children("option:selected").val();
		console.log('changed', selectedDataset);
		window.location.href = window.location.origin + window.location.pathname + '?dataset=' + selectedDataset;
	});

	$('.button').on('click', function(e) {
		e.preventDefault();

		var id = $(this).data('id');
		var post_type = $(this).data('post-type');
        var params = $(this).data('param');

		console.log('sending', id);

		$.ajax({
			url: $('[name="ajax_url"]').val(),
			type: 'POST',
			dataType: 'json',
			data: {
				id: id,
				action: 'save_post',
                post_type: post_type,
                params: params
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
