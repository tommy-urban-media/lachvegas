<?php

  global $post;
  $post_thumbnail = null;
  $url = get_the_permalink($post->ID);

  if (has_post_thumbnail()) {
    $post_thumbnail_id = get_post_thumbnail_id( $post->ID );
    $post_thumbnail = wp_get_attachment_image_src($post_thumbnail_id, 'full');
    $post_thumbnail = $post_thumbnail[0];
  }

?>

<div class="socials-wrapper">
  <h4 class="socials__title">Propaganda verbreiten: </h4>
  <ul class="socials socials--post">
    <li class="socials__item facebook" title="Auf Facebook posten">
      <a class="socials__item-link" target="_blank" href="http://www.facebook.com/sharer.php?u=<?php echo urlencode($url)?>"><i class="fab fa-facebook-square fa-sm"></i></a>
    </li>
    <li class="socials__item twitter" title="Auf Twitter zwitschern">
      <a class="socials__item-link" target="_blank" href="https://twitter.com/share?url=<?php echo urlencode($url) ?>"><i class="fab fa-twitter-square fa-sm"></i></a>
    </li>
    <li class="socials__item email" title="Per E-Mail versenden">
      <a class="socials__item-link" href="mailto:?subject=<?php echo rawurlencode(htmlspecialchars_decode(get_the_title()))?>&body=Hallo ich habe einen interessanten Artikel gefunden: <?php echo urlencode($url)?>"><i class="fas fa-envelope-square fa-sm"></i></a>
    </li>
    <li class="socials__item linkedin" title="Auf LinkdeIn Propaganda verlinken">
      <a class="socials__item-link" target="_blank" href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo urlencode($url)?>&title=<?php echo htmlspecialchars_decode(get_the_title())?>&summary=Artikel von LachVegas&source=http%3A//lachvegas.de"><i class="fab fa-linkedin fa-sm"></i></a>
    </li>
    
    <?php if ($post_thumbnail): ?>
    <li class="socials__item pinterest" title="Auf Pinterest pinnen">
      <a class="socials__item-link" target="_blank" href="https://pinterest.com/pin/create/button/?url=<?php echo $post_thumbnail?>&media=<?php echo $post_thumbnail?>"><i class="fab fa-pinterest-square fa-sm"></i></a>
    </li>
    <?php endif ?>

    <li class="socials__item whatsapp" title="WhatsAppen">
      <a class="socials__item-link" target="_blank" href="whatsapp://send?text=<?php echo rawurlencode(htmlspecialchars_decode(get_the_title()))?>: <?php echo urlencode($url)?>"><i class="fab fa-whatsapp-square fa-sm"></i></a>
    </li>
  </ul>
</div>


<!--
<div class="xm-social-bookmarks">

<h3>Empfehlen Sie uns weiter</h3>

<ul class="xm-social-bar">

    <li class="facebook">

        <a data-command="popup trackEvent" data-event="click" data-category="article" data-action="click" data-label="facebook_share" data-value="<?php echo get_permalink()?>" href="http://www.facebook.com/sharer.php?u=<?php echo urlencode(get_permalink()) ?>" data-url="<?php echo urlencode(get_permalink()) ?>">empfehlen</a>

    </li>

    <li class="twitter">

        <a data-command="popup trackEvent" data-event="click" data-category="article" data-action="click" data-label="twitter_share" data-value="<?php echo get_permalink()?>" href="https://twitter.com/share?url=<?php echo urlencode(get_permalink()) ?>" data-url="<?php echo urlencode(get_permalink()) ?>">twittern</a>

    </li>

    <li class="email">

        <a data-command="trackEvent" data-event="click" data-category="article" data-action="click" data-label="email_share" data-value="<?php echo get_permalink()?>" href="mailto:?subject=<?php echo rawurlencode(htmlspecialchars_decode(get_the_title()))?>&body=Hallo ich habe einen interessanten Artikel gefunden: <?php echo urlencode(get_permalink())?>">mailen</a>

    </li>

    <li class="whatsapp">

        <a data-command="trackEvent" data-event="click" data-category="article" data-action="click" data-label="whatsapp_share" data-value="<?php echo get_permalink()?>" href="whatsapp://send?text=<?php echo rawurlencode(htmlspecialchars_decode(get_the_title()))?>: <?php echo urlencode(get_permalink())?>">whatsApp</a>

    </li>

</ul>

</div>
-->