<?php global $post, $mail_query; ?>

<?php if ($mail_query->have_posts()): ?>

    <h3>Schlagzeilen</h3>

    <?php while ( $mail_query->have_posts() ): $mail_query->the_post(); setup_postdata($post); ?>
        
        <?php $subtitle = get_post_meta($post->ID, 'subtitle', true); ?>
        <div style="margin-bottom: 10px; padding-bottom: 10px; border-bottom: 1px solid #f0f0f0;">
            
            <table cellspacing="0" cellpadding="0" border="0">
                <tr>
                <?php if ( has_post_thumbnail( $post->ID )): ?>
                    <td width="74px">
                        <img src="<?php echo get_the_post_thumbnail_url( $post->ID, 'thumbnail' ); ?>" width="64px" height="64px" />
                    </td>
                <?php endif ?>
            
                <td width="*">
                    <?php if ($subtitle): ?>
                        <span style="display: block; color: #c0c0c0; font-size: 13px;"><?= $subtitle ?></span>
                    <?php endif ?>
                    <a style="color: #303030; font-weight: normal; text-decoration: none;" href="<?= get_the_permalink($post->ID) ?>"><?= get_the_title($post->ID) ?></a>
                </td>
                </tr>
            </table>
        </div>

    <?php endwhile ?>
<?php endif ?>
