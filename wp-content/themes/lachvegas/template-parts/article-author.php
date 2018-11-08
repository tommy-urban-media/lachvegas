<?php

  global $post;
  $userData = get_userdata($post->post_author);

?>

<address class="article-author">

  <div class="author-image">

    <img src="<?php bloginfo('template_url')?>/public/tommy_krueger.jpg" />

  </div>

  <div class="author-content">

    <h3 class="author-name">

      <?php _e('Author:')?>
      <?php echo $userData->user_firstname?>
      <?php echo $userData->user_lastname?>

    </h3>

    <span class="author-subheading">Anbieter und Autor von polithema.de</span>

    <div class="author-description">

      "Nur wer die Vergangeheit kennt, kann die Gegenwart verstehen und die Zukunft gestalten".
      Nach diesem Motto habe ich polithema.de ins Leben gerufen.
      Eigentlich bin Webentwickler und habe Internationale Medieninformatik studiert. Aufgrund der
      politischen Entwicklungen in den letzten Jahren habe ich mich jedoch dazu entschlossen meine
      Meinung im Internet zu verbreiten. Ich konnte mich einfach nicht mehr zurückhalten und
      habe daher polithema.de gegründet.
      <br />
      <a href="<?php echo get_bloginfo('url') ?>/ueber-uns">Lesen Sie hier mehr</a>

    </div>

  </div>

</address>
