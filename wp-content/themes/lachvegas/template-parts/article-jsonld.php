<?php

  global $post;

  $postThumbnailID = get_post_thumbnail_id( $post->ID );
  $postThumbnail = wp_get_attachment_image_src($postThumbnailID, 'large');

?>


<script type="application/ld+json">
{
  "@context" : "http://schema.org",
  "@type" : "Article",
  "mainEntityOfPage" : {
    "@type" : "WebPage",
    "@id" : "https://google.com/article",
    "url" : "<?php echo get_the_permalink()?>"
  },
  "headline" : "<?php the_title(); ?>",
  "datePublished" : "<?php echo get_the_date('Y-m-d')?>",
  "dateModified" : "<?php echo get_the_modified_date('Y-m-d')?>",
  "publisher" : {
    "@type" : "Organization",
    "name" : "Lachvegas",
    "logo" : {
      "@type" : "ImageObject",
      "url" : "<?php echo get_bloginfo('template_url') ?>/images/layout/logo.png",
      "width" : 228,
      "height" : 60
    }
  },
  "image" : {
    "@type" : "ImageObject",
    "url" : "<?php echo $postThumbnail[0] ?>",
    "width" : "<?php echo $postThumbnail[1] ?>",
    "height" : "<?php echo $postThumbnail[2] ?>"
  },
  "description" : <?php echo wp_json_encode(get_the_excerpt()) ?>,
  "articleSection": "<?php echo get_the_category()[0]->name ?>",
  "articleBody" : <?php echo wp_json_encode(get_the_content()) ?>,
  "author" : {
    "@type" : "Person",
    "name" : "Tommy Krüger"
  }
}
</script>
