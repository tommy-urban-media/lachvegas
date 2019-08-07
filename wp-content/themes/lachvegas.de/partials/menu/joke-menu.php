<?php 
    $categories = get_categories(array('child_of' => get_category_by_slug('witze')->term_id, 'hide_empty' => false));
?>
            
<div class="joke-menu">
    <?php foreach ($categories as $category): ?>
        <div class="joke-menu__item">
            <a href="<?= get_category_link($category) ?>"><?= $category->name ?></a>
        </div>
    <?php endforeach ?>
</div>