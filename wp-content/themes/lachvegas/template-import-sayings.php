<?php
/**
 * Template Name: Import Sprüche
 */

get_header(); 

include_once(__DIR__ . '/lib/models/saying.php');

// load data from csv file
// load all posts and combine with csv data
// render all posts


function isLocal() {
	return in_array($_SERVER['REMOTE_ADDR'], array('127.0.0.1', '::1'));
}
function splitLine($str, $delimiter = ';') {
	return explode($delimiter, $str);
}
function savePost($arr) {
	return wp_insert_post($arr);
}

$filepath = dirname(__FILE__) . '/data/Sprueche/Sheet 3-Sprüche.csv';
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
	'post_type' => 'saying',
	'posts_per_page' => 1000
);
$newsQuery = new WP_Query($newsArgs);


$entries = array();
$count_new = 0;


for ($i=1; $i<count($data); $i++) {
	$d = splitLine($data[$i]);

	$categories = array_values(explode('.', $d[2]));
	$tags = array_values(explode('.', $d[3]));
	$image = $d[4];

	$imported = false;

	while ($newsQuery->have_posts()) {
		$newsQuery->the_post(); 
		setup_postdata($post);

		$id = $post->ID;
		$import_date = get_post_meta($id, 'import_date', true);
        $import_hash = get_post_meta($id, 'import_hash', true);
        
        $saying_id = get_post_meta($id, 'saying_id', true);
        
        if ($saying_id && $saying_id == $d[0]) {
            var_dump($saying_id);
            $imported = true;
        }
	} 

	// the post is new => save it as a new news post
	if (!empty($d[1])) {

		$post_data = array(
			'ID' => $d[0],
			// 'post_date' => $date,
			'post_title' => $d[1],
			'post_type' => 'saying',
			'tags_input' => $tags,
            'post_status' => 'publish',
            'category' => $categories,
            'image' => $d[3]
		);

		if (isset($_REQUEST['import_news']) && !empty($_REQUEST['import_news'])) {
			
			$savedID = savePost($post_data);
			$hash = wp_hash($d[1]);
			wp_set_object_terms( $savedID, $categories, 'category' );
			//wp_set_object_terms( $savedID, $persons, 'people' );

			update_post_meta($savedID, 'post_date', date('Y-m-d H:i:s'));
			update_post_meta($savedID, 'import_date', date('Y-m-d H:i:s'));
			update_post_meta($savedID, 'import_hash', $hash);
		
		}

		if (is_numeric($d[0])) {
			update_post_meta($d[0], 'import_update', date('Y-m-d H:i:s'));
		}

	}

	if ($imported) {
		$post_data['is_new'] = false;
	} else {
        $count_new++;
		$post_data['is_new'] = true;
	}

	$entries[] = $post_data;
}

?>


<div class="content">
	<div class="content__area">
		<div class="content__area--wide entry-content">

			<h3>Sprüche</h3>
			<p>insgesamt: <?= count($entries) ?></p>
			<p>neu: <?= $count_new ?></p>

			<br>

			<form class="form" action="<?php echo admin_url('admin-ajax.php') ?>" method="post">
				<input type="submit" name="import_news" value="Import All" />
			</form>

			<br>

			<table class="table table-striped" cellspacing="0" cellpadding="0">
				<tr>
					<th>ID</th>
					<th>Title</th>
					<th>Category</th>
                    <th>Tags</th>
                    <th>Image</th>
                    <th>Action</th>
				</tr>
				<?php foreach($entries as $entry): ?>
					<tr>
						<td <?php if(isset($entry['is_new']) && $entry['is_new'] === true):?> style="background-color: red;" <?php endif ?>"><?= $entry['ID'] ?></td>
						<td><?= $entry['post_title'] ?></td>
                        <td><?= implode($entry['category'], '.') ?></td>
                        <td><?= implode($entry['tags_input'], '.') ?></td>
						<td><?= isset($entry['image']) ? $entry['image'] : '-' ?></td>
                        <td>
                            <?php var_dump($entry['is_new']) ?>
                            <button type="button" class="button" name="save_saying" 
                                data-id="<?= $entry['ID'] ?>" 
                                data-title="<?= $entry['post_title']?>"
                                data-categories="<?= implode($entry['category'], '.')?>"
                                data-tags="<?= implode($entry['tags_input'], '.')?>"
                                data-image="<?= $entry['image'] ?>">Save</button>
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
                action: 'save_post',
                id: id,
                type: 'saying',
                title: $(this).data('title'),
                categories: $(this).data('categories'),
                tags: $(this).data('tags'),
                image: $(this).data('image'),
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
