<?php if (is_home() || is_front_page()): ?>

<nav class="topicmenu" role="navigation" data-component="Menu">
  <span class="topicmenu__title">Top Themen:</span>
  <span class="menu-icon"></span>
  <?php wp_nav_menu( array('theme_location' => 'topicmenu') ); ?>
</nav>

<?php endif ?>