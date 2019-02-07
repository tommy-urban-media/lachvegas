<?php
/**
 * Template Name: Homepage
 */

get_header(); ?>


<div class="content content-404">
  <div class="content__area">
    <div class="content__area--primary">

      <div class="entry-content">

        <h1>Ditt is doch KACKE!</h1>
        <p>Immer diese bekloppten 404-Seiten. Man hat angeblich was gesucht und die Scheiß Seite findet nüscht. 
        Stattdessen zeigt der mir diese dumme Seite hier an. Ohne mich Leute. Ick hau jetzt hier ab...
        </p>
        <p>Oder warte.. Halt! Nein, nicht weglaufen! </p>

        <p> <a href="<?= home_url('/')?>">Hier</a> geht's weiter. </p>

      </div>

    </div>

    <div class="content__area--secondary">
      <?php echo get_template_part('sidebar')?>
    </div>
  </div>
</div>

<?php get_footer(); ?>
