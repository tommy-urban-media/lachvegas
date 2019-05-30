<header class="header">
	
	<div class="header__inner">
		
		<p class="page-title">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
					<span class="page-name">
						<img src="<?= get_bloginfo('template_url')?>/app/images/eyes.svg" style="width: 36px;" width="36px" />
						<span class="page-name-num">Lach</span><span class="page-name-txt">Vegas</span>
					</span>
				<span class="page-slogan"><?php // echo get_bloginfo('description') ?></span>
			</a>
		</p>
		
		<div class="header__right">

			<!--
			<nav class="headermenu" data-component="Menu">
				<span class="menu-icon"></span>
				<?php wp_nav_menu( array('theme_location' => 'headermenu', 'title' => false) ); ?>
			</nav>
			-->

			<div class="mainmenu-wrapper">
				<nav class="mainmenu" role="navigation" data-component="Menu">
					<span class="menu-icon"></span>
					<?php wp_nav_menu( array('theme_location' => 'mainmenu', 'title' => false) ); ?>
				</nav>
			</div>
			
			<div class="action-bar">
				<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
					<label class="search-label" for="search-input" data-modal="modal-search"><i class="fa fa-search"></i></label>
					<!--
					<div class="search-area">
						<div class="search-group">
							<input type="search" id="search-input" class="search-field" placeholder="Suchbegriff eingeben" value="<?php echo get_search_query(); ?>" name="s" />
							<button type="submit" class="search-submit">Suchen &raquo; </button>
						</div>
					</div>
					-->
				</form>
			</div>
		</div>
	</div>

</header>