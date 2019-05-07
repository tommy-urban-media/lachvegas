<?php global $post, $mail_query; ?>

<?php if ($mail_query->have_posts()): ?>

    <h3>Statistik des Tages</h3>

    <?php while ( $mail_query->have_posts() ): $mail_query->the_post(); setup_postdata($post); ?>
        
        <?php $subtitle = get_post_meta($post->ID, 'subtitle', true); ?>
        <div style="margin-bottom: 10px; padding-bottom: 10px; border-bottom: 1px solid #f0f0f0;">
            <?php if ($subtitle): ?>
                <span style="display: block; color: #c0c0c0; font-size: 13px;"><?= $subtitle ?></span>
            <?php endif ?>
            <p style="margin-top: 0; color: #303030; font-weight: bold; text-decoration: none;" href="<?= get_the_permalink($post->ID) ?>"><?= get_the_title($post->ID) ?></p>
        </div>

    <?php endwhile ?>
<?php endif ?>