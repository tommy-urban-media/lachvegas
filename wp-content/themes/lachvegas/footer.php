<?php
/**
 * The template for displaying the footer.
 */
?>

</main>

<footer class="footer">
	<div class="footer__inner">
		<div class="footer__menu">
			<?php if (has_nav_menu('footermenu')):?>
				<nav class="footermenu">
					<?php wp_nav_menu(array('menu' => 'footermenu')); ?>
				</nav>
			<?php endif;?>

			<div class="footer-copyright">
				<p>&copy; 2016 - <?php echo date('Y') ?> <a href="http://lachvegas.de">lachvegas.de</a></p>
			</div>
		</div>
		<?php // get_template_part('template-parts/socials'); ?>
	</div>

	<!--
	<div class="weather">
		Berlin, Deutschland 0,0°C
	</div>
	-->

</footer>



<!--
	<div id="footer-bottom">

		<ul id="social-list">
			<li class="facebook-share">
				<iframe src="https://www.facebook.com/plugins/like.php?href=<?php echo get_bloginfo('url')?>&width=170&layout=button_count&action=like&size=small&show_faces=true&share=true&height=80&appId" width="170" height="80" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true"></iframe>
			</li>
			<li class="twitter-share">
				<a href="https://twitter.com/share" class="twitter-share-button" data-url="<?php bloginfo('url')?>" data-lang="de">Tweet</a>
			</li>
			<li class="google-share">
				<div class="g-plusone" data-size="medium" data-href="<?php echo get_bloginfo('url')?>"></div>
			</li>
			<li class="xing-share">
				<script type="XING/Share" data-counter="right" data-lang="de" data-url="<?php bloginfo('url')?>"></script>
			</li>
		</ul>

	</div>
-->


<div class="ticker">

	<?php
		$tickerQuery = new WP_Query(
			array(
				'posts_per_page' => 10,
				'post_type' => 'news',
				'orderby' => 'date',
				'order' => 'DESC'
			)
		);
	?>

	<?php if ( $tickerQuery->have_posts() ) : ?>
		<div class="ticker__head">
			<span class="ticker__title">Nachrichten</span>
		</div>
		<div class="ticker__body">
			<div class="ticker__list-wrapper">
				<ol class="ticker__list">
					<?php while ( $tickerQuery->have_posts() ) : $tickerQuery->the_post(); setup_postdata($post)?>
						<li class="ticker__list-item">
							<a href="<?= get_the_permalink($post->ID) ?>"><?php the_title() ?></a>
						</li>
					<?php endwhile; ?>
				</ol>
			</div>
		</div>
		<?php wp_reset_postdata(); ?>
	<?php endif ?>

</div>



<div id="lightbox-overlay"></div>
<div id="lightbox">

  <span id="close-btn">×</span>
	<div id="lightbox-loader"></div>

	<div id="lightbox-content">
		<h1><i class="fa fa-hand-o-right"></i> Get in Touch</h1>
		<?php // echo do_shortcode('[contact-form-7 id="18" title="Kontaktformular"]');?>
	</div>

	<div id="lightbox-message"></div>

</div>


<input id="blogurl" type="hidden" value="<?php bloginfo('url');?>" />
<input id="templateurl" type="hidden" value="<?php bloginfo('template_url');?>" />

<?php wp_footer(); ?>

<script defer src="https://use.fontawesome.com/releases/v5.3.1/js/all.js"></script>
<script type="text/javascript" src="<?php echo get_bloginfo('template_url')?>/app/public/js/vendor.js"></script>
<script type="text/javascript" src="<?php echo get_bloginfo('template_url')?>/app/public/js/app.js"></script>
<script>require('src/js/app')</script>

</body>
</html>
