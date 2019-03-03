<?php
/**
 * Template Name: Stellenangebote (Importer)
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

$filepath = dirname(__FILE__) . '/Stellenangebote.csv';
$file = fopen($filepath, 'r');

$data = array();
$postIDs = array();

while (($line = fgetcsv($file)) !== FALSE) {
	if (is_array($line) && count($line) === 1) {
		if (strlen($line[0]) >= 3) {
			$data[] = $line[0];
		}
	}
}
fclose($file);

$jobsArgs = array(
	'post_status' => 'any',
	'post_type' => 'job',
	'posts_per_page' => -1
);
$jobsQuery = new WP_Query($jobsArgs);

$entries = array();
$count_new = 0;
$count_title = 0;


for ($i=1; $i<count($data)-1; $i++) {
	$d = splitLine($data[$i]);

	$imported = false;

	while ($jobsQuery->have_posts()) {
		$jobsQuery->the_post(); 
		setup_postdata($post);

		$id = $post->ID;
		$job_id = get_post_meta($id, 'job_id', true);
		//$import_hash = get_post_meta($id, 'import_hash', true);

		if (!empty($job_id) && $d[0] == $job_id) {
			$imported = true;
		}
	} 

	$post_data = array(
		'id' => $d[0],
		'date' => $d[1],
		'title' => $d[2],
		'category' => $d[3],
		'company' => $d[4],
		'description' => $d[5]
	);

	if (isset($_REQUEST['import_jobs']) && !empty($_REQUEST['import_jobs'])) {
		//if ($post_data['id'] <= 100) {
			$job = new Job($post_data);
			$job->save();
		//}
	}

	if ($imported) {
		$post_data['imported'] = true;
		
	} else {
		$count_new++;
		$post_data['imported'] = false;
	}

	if (!empty($post_data['title'])) {
		$count_title++;
	}

	$entries[] = $post_data;
}

/*
$fpath = dirname( __FILE__ ) . '_postids.csv';
$f = fopen($fpath, 'w');
foreach ($postIDs as $postID) {
	fputcsv($f, $postID);
}
fclose($f);
*/


class Job {

	protected $_ID;
	protected $_data;
	protected $_post_type = 'job';

	public function __construct($data = []) {
		$this->set('_data', $data);
	}

	public function set($property, $value) {
		if (isset($value))
			$this->{$property} = $value;
	}

	public function get($id = null) {
		if ($id) {
			
		}
	}

	public function save() {

		$arr = [
			'post_date' => date('Y-m-d', strtotime($this->_data['date'])),
			'post_title' => $this->_data['title'],
			'post_content' => $this->_data['description'],
			'post_type' => $this->_post_type,
			'post_status' => 'publish'
		];

		$p = get_posts(
			array(
				'post_status' => 'any',
				'post_type' => $this->_post_type,
				'meta_query' => array(
					array(
						'key' => 'job_id',
						'value' => $this->_data['id'],
						'compare' => '=='
					)
				)
			)
		);

		if (is_array($p)) {
			// check if there is a post with a give job_id already stored
			if (!isset($p[0]->ID)) {
				var_dump('save new');
				$this->_ID = wp_insert_post($arr);
			}
			else {
				var_dump('update old');
				$arr['ID'] = $p[0]->ID;
				$this->_ID = $p[0]->ID;
				wp_update_post($arr);

				update_post_meta($this->_ID, 'import_update', date('Y-m-d H:i:s'));
			}
		}
		

		$this->saveRelation($this->_data['category']);
		$this->saveField('job_id', $this->_data['id']);
		$this->saveField('job_company', $this->_data['company']);

		return $this->_ID;
	}

	public function saveRelation($category) {
		if ($this->_ID) {
			wp_set_object_terms($this->_ID, $category, 'job_categories' );
		}
	}
	
	public function saveField($key, $value) {
		if ($this->_ID) {
			update_post_meta($this->_ID, $key, $value);
		}
	}

}


?>


<div class="content">
	<div class="content__area">
		<div class="content__area--wide entry-content">

			<h3>Stellenangebote</h3>
			<p>insgesamt: <?= count($entries) ?></p>
			<p>davon mit Titel: <?= $count_title ?></p>
			<p>neu: <?= $count_new ?></p>

			<br><br><br>

			<form class="form" action="" method="post">
				<input type="submit" name="import_jobs" value="Alle Importieren" />
			</form>

			<br><br><br>

			<table class="table table-striped" cellspacing="0" cellpadding="0">
				<tr>
					<th>ID</th>
					<th>Date</th>
					<th>Title</th>
					<th>Category</th>
					<th>Imported</th>
					<th>Action</th>
				</tr>
				<?php foreach($entries as $entry): ?>
					<tr>
						<td><?= $entry['id'] ?></td>
						<td><?= date('d.m.Y', strtotime($entry['date'])) ?></td>
						<td><?= $entry['title'] ?></td>
						<td><?= $entry['category'] ?></td>
						<td><?= $entry['imported'] ? 1 : 0 ?></td>
						<td>
							<?php if ($entry['imported']): ?>
								<button type="button" class="button" name="generate_single_job" data-single-job data-id="<?= $post->ID ?>">Update</button>
							<?php else: ?>		
								<button type="button" class="button" name="generate_single_job" data-single-job data-id="<?= $post->ID ?>">Import</button>
							<?php endif ?>
						</td>
					</tr>
				<?php endforeach ?>
			</table>

		</div>

	</div>
</div>



<script
  src="https://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous"></script>

<script type="text/javascript">

jQuery(document).ready(function($) {

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
