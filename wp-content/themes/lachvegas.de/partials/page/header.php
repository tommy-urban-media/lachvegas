<header class="header">
	
	<div class="header__inner">
		
		<span class="mobile-nav-icon"></span>
		<div class="mobile-nav-wrapper" data-component="MobileNav">
			<div class="mobile-nav" data-nav>
                <div class="mobile-nav-header">LachVegas</div>
                <div class="mobile-nav-menu-wrapper">
                    <nav class="mobile-nav-menu" role="navigation" data-component="Menu">
                        <?php wp_nav_menu( array('theme_location' => 'mainmenu', 'title' => false) ); ?>
                    </nav>
                </div>
			</div>
			<div class="mobile-nav-bg" data-nav-bg></div>
		</div>
		
		<p class="page-title">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
                <span class="page-name">
                    <img src="<?= get_bloginfo('template_url')?>/app/images/eyes.svg" style="width: 36px;" width="36px" alt="Lachvegas Eyes" />
                    <span class="page-name-num">Lach</span><span class="page-name-txt">Vegas</span>
                </span>
			</a>
		</p>
		
		<div class="header__right">

			<?php /* ?>
			<nav class="headermenu" data-component="Menu">
				<span class="menu-icon"></span>
				<?php wp_nav_menu( array('theme_location' => 'headermenu', 'title' => false) ); ?>
			</nav>
			<?php */ ?>

			<div class="mainmenu-wrapper">
				<nav class="mainmenu" role="navigation" data-component="Menu">
					<span class="menu-icon"></span>
					<?php wp_nav_menu( array('theme_location' => 'mainmenu', 'title' => false) ); ?>
				</nav>
			</div>
			
			<div class="action-bar">
				<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
					<label class="search-label" for="search-input" data-modal="modal-search"><i class="fa fa-search"></i></label>
				</form>
			</div>
		</div>
	</div>

</header>