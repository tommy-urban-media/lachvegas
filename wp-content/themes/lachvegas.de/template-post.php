<?php
/**
 * Template Name: Save New Post
 */
get_header(); 

$postTypes = ['job', 'news', 'saying'];

// get all people taxonomy terms
$people = get_terms(array(
    'taxonomy' => 'people',
    'hide_empty' => false,
));
// get all tags
$tags = get_terms(array(
    'taxonomy' => 'post_tag',
    'hide_empty' => false,
));

// get all categories
$categories = get_categories(array(
    'hide_empty' => false
));

?>


<div class="content">
    <div class="content__area">
        <div class="content__area--wide entry-content">

			<?php while ( have_posts() ) : the_post(); ?>
				<h1 class="page-title"><?php the_title() ?></h1>
				<div class="article__content"><?php the_content() ?></div>
			<?php endwhile ?>

			<br><br><br>

			<form class="form" method="post" action="<?php echo admin_url('admin-ajax.php') ?>">

                <div class="form-group">
                    <div class="field-group">
                        <label class="label" for="post_type">Post Type</label>
                        <select class="select" name="post_type" id="post_type">
                            <?php foreach($postTypes as $postType): ?>
                                <option value="<?= $postType ?>"><?= $postType ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <div class="field-group">
                        <label class="label" for="relation_category">Category</label>
                        <select class="select" multiple="multiple" name="relation_category" id="relation_category">
                            <?php foreach($categories as $category): ?>
                                <option value="<?= $category->term_id ?>"><?= $category->name ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div class="field-group">
                        <label class="label" for="relation_tag">Tags</label>
                        <select class="select" multiple="multiple" name="relation_tag" id="relation_tag">
                            <?php foreach($tags as $tag): ?>
                                <option value="<?= $tag->term_id ?>"><?= $tag->name ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div class="field-group">
                        <label class="label" for="relation_people">People</label>
                        <select class="select" multiple="multiple" name="relation_people" id="relation_people">
                            <?php foreach($people as $person): ?>
                                <option value="<?= $person->term_id ?>"><?= $person->name ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <input type="text" name="post_title" placeholder="Title" />
                </div>
                
                <div class="form-group">
                    <input type="text" name="post_date" placeholder="Date" />
                </div>

                <div class="form-group">
                    <textarea name="post_content" placeholder="Content"></textarea>
                </div>

                <div class="form-group">
                    <h3>Custom Fields</h3>
                    <div class="field-group">
                        <input type="text" name="job_company" placeholder="Job Company" />
                    </div>
                </div>

                <div class="form-group">
                    <button type="submit" class="button">Speichern</button>
                </div>

            </form>

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
            e.preventDefault();
        });

        $('.button').on('click', function(e) {
            e.preventDefault();

            var data = {
                id: id,
                action: 'save_new_post'
            };

            $.ajax({
                url: $('.form').attr('action'),
                type: 'POST',
                dataType: 'json',
                data: data,
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
