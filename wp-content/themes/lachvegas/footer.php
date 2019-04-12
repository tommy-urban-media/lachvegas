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
		<?php get_template_part('template-parts/socials'); ?>
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
	</ul>
</div>
-->

<!--
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
-->


<input id="blogurl" type="hidden" value="<?php bloginfo('url');?>" />
<input id="templateurl" type="hidden" value="<?php bloginfo('template_url');?>" />

<?php wp_footer(); ?>

<script defer src="https://use.fontawesome.com/releases/v5.3.1/js/all.js"></script>
<script type="text/javascript" src="<?php echo get_bloginfo('template_url')?>/app/public/js/vendor.js"></script>
<script type="text/javascript" src="<?php echo get_bloginfo('template_url')?>/app/public/js/app.js"></script>
<script>require('src/js/app')</script>

<?php // get_template_part('template-parts/modal/modal') ?>

<?php /* ?>
<button class="modal-trigger" data-modal="modal-1">Modal Trigger</button>
<?php */ ?>

<!--
<script
    type="text/javascript"
    async defer
    src="//assets.pinterest.com/js/pinit.js"
		data-pin-do="buttonBookmark" data-pin-hover="true"
></script>
-->


</body>
</html>
