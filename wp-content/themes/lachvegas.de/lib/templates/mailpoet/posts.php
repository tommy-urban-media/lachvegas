<?php global $post, $mail_query; ?>

<?php if ($mail_query->have_posts()): ?>

    <h2>Aktuelle Beiträge</h2>

    <?php while ( $mail_query->have_posts() ): $mail_query->the_post(); setup_postdata($post); ?>
        
        <?php $subtitle = get_post_meta($post->ID, 'subtitle', true); ?>
        <div style="margin-bottom: 20px; padding-bottom: 20px; border-bottom: 1px solid #f0f0f0;">
            <?php if ($subtitle): ?>
                <span style="display: block; color: #c0c0c0; font-size: 13px;"><?= $subtitle ?></span>
            <?php endif ?>
            <a style="color: #303030; font-weight: bold; text-decoration: none;" href="<?= get_the_permalink($post->ID) ?>">

                <?php if (has_post_thumbnail($post->ID)): ?>
                    <div style="display: block; margin-bottom: 20px; border: 1px solid #e0e0e0;">
                        <?php $img = get_the_post_thumbnail_url($post->ID, '16_9_large') ?>
                        <img width="100%" src="<?= get_the_post_thumbnail_url($post->ID, '16_9_large') ?>" alt="<?= get_the_title($post->ID) ?>" />
                    </div>
                <?php endif ?>

                <span style="display: block; font-size: 18px;"><?= get_the_title($post->ID) ?></span>
            </a>
        </div>

    <?php endwhile ?>
<?php endif ?>
