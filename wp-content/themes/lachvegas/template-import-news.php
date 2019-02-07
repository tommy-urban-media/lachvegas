<?php
/**
 * Template Name: Import News
 */

get_header(); 


function isLocal() {
	return in_array($_SERVER['REMOTE_ADDR'], array('127.0.0.1', '::1'));
}
function splitLine($str, $delimiter = ';') {
	return explode($delimiter, $str);
}
function savePost($arr) {
	return wp_insert_post($arr);
}

$filepath = dirname(__FILE__) . '/_KURZMELDUNGEN_CSV.csv';
//$filepath = '/Users/Tommykrueger/Desktop/Websiteinhalte/LachVegas/_KURZMELDUNGEN_CSV.csv';
$file = fopen($filepath, 'r');

$data = array();
$postIDs = array();

while (($line = fgetcsv($file)) !== FALSE) {
	if (is_array($line) && count($line) === 1) {
		if (strlen($line[0]) >= 10) {
			$data[] = $line[0];
		}
	}
	
}
fclose($file);


$newsArgs = array(
	'post_status' => 'any',
	'post_type' => 'news',
	'posts_per_page' => 100
);
$newsQuery = new WP_Query($newsArgs);


$news = array();
$count_new = 0;



for ($i=1; $i<count($data)-1; $i++) {
	$d = splitLine($data[$i]);

	$categories = array_values(explode('.', $d[4]));
	$tags = array_values(explode('.', $d[5]));
	$persons = array_values(explode('.', $d[6]));

	$imported = false;

	while ($newsQuery->have_posts()) {
		$newsQuery->the_post(); 
		setup_postdata($post);

		$id = $post->ID;
		$import_date = get_post_meta($id, 'import_date', true);
		$import_hash = get_post_meta($id, 'import_hash', true);

		if (!empty($import_date) && !empty($import_hash)) {

			$title_hash = wp_hash($d[2]);

			if ($import_hash === $title_hash) {
				$imported = true;
				$d[0] = $id;
			}
		}
	} 

	$date = $d[3];
	if (empty($date)) {
		$date = date('Y-m-d 06:00:00');

		$year = rand(2018, 2019);
		$month = rand(1, 12);
		$day = rand(1, 30);

		if ($month == 1 && $day >= 28) {
			$day = rand(1, 28);
		}

		$datetime = mktime(0,0,0, $month, $day, $year);
		$date = date('Y-m-d', $datetime);
		$post_data['post_date'] = $date;
		//var_dump($post_data['post_date']);
	}

	// the post is new => save it as a new news post
	if (!empty($d[2])) {

		$post_data = array(
			'ID' => $d[0],
			'post_date' => $date,
			'post_title' => $d[2],
			'post_type' => $d[7],
			'tags_input' => $tags,
			'post_status' => 'publish'
		);

		if (isset($_REQUEST['import_news']) && !empty($_REQUEST['import_news'])) {
			
			$savedID = savePost($post_data);
			$hash = wp_hash($d[2]);
			wp_set_object_terms( $savedID, $categories, 'category' );
			wp_set_object_terms( $savedID, $persons, 'people' );

			update_post_meta($savedID, 'post_date', date('Y-m-d H:i:s'));
			update_post_meta($savedID, 'import_date', date('Y-m-d H:i:s'));
			update_post_meta($savedID, 'import_hash', $hash);
		
		}

		if (is_numeric($d[0])) {
			update_post_meta($d[0], 'import_update', date('Y-m-d H:i:s'));
		}

	}

	if (!$imported) {
		$post_data['is_new'] = true;
		$count_new++;
	} else {
		$post_data['is_new'] = false;
	}

	$news[] = $post_data;
}

/*
$fpath = dirname( __FILE__ ) . '_postids.csv';
$f = fopen($fpath, 'w');
foreach ($postIDs as $postID) {
	fputcsv($f, $postID);
}
fclose($f);
*/



?>


<div class="content">
	<div class="content__area">
		<div class="content__area--wide">

			<h3>NEWS</h3>
			<p>insgesamt: <?= count($news) ?></p>
			<p>neu: <?= $count_new ?></p>

			<br><br><br>

			<form class="form" action="" method="post">
				<input type="submit" name="import_news" value="Import News" />
			</form>

			<br><br><br>

			<table class="table table-striped">
				<tr>
					<th>ID</th>
					<th>Date</th>
					<th>Title</th>
					<th>Is New</th>
				</tr>
				<?php foreach($news as $entry): ?>
					<tr>
						<td><?= $entry['ID'] ?></td>
						<td><?= $entry['post_date'] ?></td>
						<td><?= $entry['post_title'] ?></td>
						<td><?= $entry['is_new'] ? 'ja' : 'nein' ?></td>
					</tr>
				<?php endforeach ?>
			</table>

		</div>

	</div>
</div>

<?php get_footer(); ?>
