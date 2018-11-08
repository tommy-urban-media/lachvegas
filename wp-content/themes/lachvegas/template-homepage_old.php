<?php
/**
 * Template Name: Homepage
 */

get_header(); ?>


<main class="main" role="main">

	<div class="content content-home">

		<section class="section section--home">
			<div class="section__area">
				<div class="grid">
					<div class="grid-box grid-box--item-1">
						<div class="grid-box__content"><a href="<?= home_url()?>/news">News</a></div>
					</div>
					<div class="grid-box grid-box--item-2 grid-box--inverted">
						<span class="fa fa-mars grid-box__icon"></span>
						<div class="grid-box__content">Für Männer</div>
					</div>
					<div class="grid-box grid-box--item-3">
						<iframe style="width: 100%; height: 100%;" width="560" height="315" src="https://www.youtube-nocookie.com/embed/1O7905zonUA" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
					</div>
					<div class="grid-box grid-box--item-4">
						<div class="animator">
							<div class="">Du weißt wofür die Abkürzung LV steht?</div>
							<div class="large">RICHTIG!</div>
							<div class="">Lach Vegas</div>
						</div>
					</div>
					<div class="grid-box grid-box--item-5">
						<div class="grid-box__content">
							Newsletter: Erhalte jeden Tag die lustigsten Kurzmeldungen kostenlos per E-Mail
							Jetzt anmelden <input type="text" id="newsletter" class="newsletter" placeholder="E-Mail-Adresse" />
						</div>
					</div>
					<div class="grid-box grid-box--item-6">
						<span class="fa fa-venus grid-box__icon"></span>
						<div class="grid-box__content">Für Frauen</div>
					</div>
					<div class="grid-box grid-box--item-7">
						<span class="fa fa-genderless grid-box__icon"></span>
						<div class="grid-box__content">Für Geschlechtslose / Geistesgestörte </div>
						<!-- <img src="http://localhost/lachvegas/wp-content/uploads/2017/07/italienische_nationalmannschaft-384x240.png" /> -->
					</div>
					<div class="grid-box grid-box--item-8">
						<div class="grid-box__content">
							Du hast eine Gute Idee für LachVegas.de? 
							Melde dich <a href="#">hier</a> 
						</div>
					</div>
					<div class="grid-box grid-box--item-9">
						<div class="grid-box__content"><a href="#">Sensationelles</a></div>
					</div>
					<div class="grid-box grid-box--item-10">
						<div class="grid-box__content"><a href="#">Wetter</a></div>
					</div>

				</div>
			</div>
		</section>



		<section class="section section--news">
			<div class="section__area">
				<div class="section__content">
					<h3 class="section__title">Neu im Dezember</h3>
					<h1>Der ultimative Weihnachtskalender für Dummies</h1>
					<p>24 Türchen warten darauf täglich geöffnet zu werden. <br/><br/><br/></p>
					<a class="button" href="<?php echo home_url()?>/weihachtskalender">Zum Weihnachtskalender</a>
				</div>
			</div>
		</section>


						
		<section class="section section--news">
			<div class="section__area">
				<div class="section__content">
					<h3 class="section__title">Kurzmeldungen</h3>
					<?php $query = new WP_Query( array('posts_per_page' => 10, 'post_type' => 'news') ); ?>
					<?php if ( $query->have_posts() ) : ?>
						<ol class="list list--news">
							<?php while ( $query->have_posts() ) : $query->the_post(); setup_postdata($post)?>
								<li class="list-item">
									<span class="news-date"><?php the_date('d.m.Y') ?></span>
									<a href="<?php echo get_the_permalink($post->ID) ?>">
										<span class="news-title"><?php the_title() ?></span>
									</a>
									<div class="news-excerpt">
										<?php echo custom_excerpt(get_the_excerpt($post->ID), 24) ?>
									</div>
								</li>
							<?php endwhile; ?>
							</ol>
						<?php wp_reset_postdata(); ?>
					<?php endif ?>
					<a class="button" href="<?php echo home_url()?>/kurzmeldungen">Alle Kurzmeldungen</a>
				</div>
			</div>
		</section>



		<section class="section section--diverse">
			<div class="section__area">
				<div class="grid grid--diverse">
					<div class="grid-box">
						<div class="grid-box__content">Tier der Woche: Die Kaiserratte</div>
					</div>
					<div class="grid-box grid-box--inverted">
						<div class="grid-box__content">Buch des Monats</div>
					</div>
					<div class="grid-box">
						Buch des Monats: Man klaut anderen Flaschensammlern keine Flaschen aus seiner Mülltonne
					</div>
					<div class="grid-box">
						<div class="grid-box__content">
							<div class="animator">
								<div class="">Du weißt wofür die Abkürzung LV steht?</div>
								<div class="">RICHTIG!</div>
								<div class="">Lach Vegas</div>
							</div>
						</div>
					</div>
					<div class="grid-box">
						<div class="grid-box__content">
						<img src="http://localhost/lachvegas/wp-content/uploads/2018/10/question2.png" alt="Random Article" />
						</div>
					</div>
					<div class="grid-box">
						<div class="grid-box__content">Für Frauen</div>
					</div>
					<div class="grid-box">
					<img src="http://localhost/lachvegas/wp-content/uploads/2018/10/question2.png" alt="Random Article" />
					</div>
					<div class="grid-box">
						<div class="grid-box__content">
							<h3>Der ultimative IQ-Test</h3>
							<p>Wenn du diesen Test besteht bist du schlauer als Albert Einstein mit einem IQ von mindestens .. sagen wir 5</p>
							<a href="#" class="button">Quiz jetzt starten</a>
						</div>
					</div>
					<div class="grid-box">
						<div class="grid-box__content">Produkte die die Welt unbedingt braucht</div>
					</div>
					<div class="grid-box">
						<div class="grid-box__content"><a href="#">Alle Kurzmeldungen</a></div>
					</div>
					<div class="grid-box">
						<div class="grid-box__content">
							Alle 11 Minuten legt 007 irgendwo auf der Welt ein Bondgirl flach
							<br/><a href="#"> &raquo; mehr davon</a>
						</div>
					</div>
					<div class="grid-box">
						Finde den Fehler
						<img src="http://localhost/lachvegas/wp-content/uploads/2018/10/bild_001_gruppenfoto.jpg" />
					</div>
				</div>
			</div>
		</section>



		<section class="section">
			<div class="section__area">
				<h3 class="section__title">10 Dinge die ...</h3>
				<div class="section__content">
					<?php $query = new WP_Query( array('posts_per_page' => 5, 'category_name' => '10-dinge') ); ?>
					<?php if ( $query->have_posts() ) : ?>
						<ol class="list list--links">
							<?php while ( $query->have_posts() ) : $query->the_post(); setup_postdata($post)?>
								<li class="list-item">
									<a href="<?php echo get_the_permalink($post->ID) ?>"><?php the_title(); ?></a>
								</li>
							<?php endwhile; ?>
							</ol>
						<?php wp_reset_postdata(); ?>
					<?php endif ?>
					<a class="button" href="/10-dinge-die">Mehr aus diesem Bereich</a>
				</div>
			</div>
		</section>


		<section class="section section--people">
			<div class="section__area">
				<div class="section__content">
					<ol class="list list--people">
						
						<?php 
						
						$people = [
							
							[
								'name' => 'Angela Merkel',
								'role' => 'Rautenwächterin',
								'url' => '/thema/angela-merkel',
								'image' => 'http://localhost/lachvegas/wp-content/uploads/2018/10/merkel-150x150.jpg'
							],
							[
								'name' => 'Donald Trump',
								'role' => 'Quatschkopp',
								'image' => 'http://localhost/lachvegas/wp-content/uploads/2018/10/donald-trump-loeste-er-fast-150x150.jpg'
							],
							[
								'name' => 'Adolf Hitler',
								'role' => 'Jahrhunderverbrecher',
								'image' => 'http://localhost/lachvegas/wp-content/uploads/2018/10/merkel-150x150.jpg'
							],
							[
								'name' => 'Heid Klum',
								'role' => 'Schnatter-Tante',
								'image' => 'http://localhost/lachvegas/wp-content/uploads/2018/10/merkel-150x150.jpg'
							],
							[
								'name' => 'Horst Seehofer',
								'role' => 'Störenfried',
								'image' => 'http://localhost/lachvegas/wp-content/uploads/2018/10/merkel-150x150.jpg'
							],
							[
								'name' => 'Kim Jong-Un',
								'role' => 'Raketenmann',
								'image' => 'http://localhost/lachvegas/wp-content/uploads/2018/10/Borowitz-Trumps-Worst-Hair-Day-150x150.jpg'
							]
			
						];
						?>

						<?php foreach ($people as $person): ?>
							
							<li class="list-item">
								<a href="<?= home_url() ?>/thema/angela-merkel">
									<span class="image-wrapper">
										<img src="<?= $person['image'] ?>" />
									</span>
									<span class="person-role"><?= $person['role'] ?></span>
									<span class="person-name"><?= $person['name'] ?></span>
								</a>
							</li>

						<?php endforeach ?>

					</ol>
				</div>
			</div>
		</section>


		<section class="section">
			<div class="section__area">
				<div class="section__content">

					<ul class="list list--featured">
						<?php $query = new WP_Query( array('posts_per_page' => 2, 'category_name' => 'featured') ); ?>
						<?php if ( $query->have_posts() ) : ?>
							<?php while ( $query->have_posts() ) : $query->the_post(); setup_postdata($post)?>
								<li class="list-item">
									<article class="article-teaser">
										<a href="<?php echo get_the_permalink($post->ID) ?>">
											<span class="image-wrapper">
												<?php the_post_thumbnail('article_thumbnail'); ?>
											</span>
											<span class="article-teaser__content-block">
												<span class="article-teaser__title"><?php the_title(); ?></span>
												<?php if(isset(wp_get_post_tags($post->ID)[0]->name)): ?>
												<span class="article-teaser__tag"><?= wp_get_post_tags($post->ID)[0]->name ?></span>		
												<?php endif ?>									
											</span>
										</a>
										<span class="article-teaser__content">
											<p><?php echo custom_excerpt(get_the_excerpt($post->ID), 24) ?></p>
											<a href="<?php echo get_the_permalink($post->ID) ?>">mehr</a>
										</span>
									</article>
								</li>
							<?php endwhile; ?>
							<?php wp_reset_postdata(); ?>
						<?php endif ?>

						<li class="list-item">
							<h3 class="headline">Kurzmeldungen</h3>
							<?php $queryShortNews = new WP_Query( array('post_type' => 'news', 'posts_per_page' => -1, 'category_name' => 'kurzmeldungen') ); ?>
							<?php if ( $queryShortNews->have_posts() ) : ?>
								<ul class="list list--shortnews">
									<?php while ( $queryShortNews->have_posts() ) : $queryShortNews->the_post(); setup_postdata($post)?>
										<li class="list-item">	
											<a href="<?php echo get_the_permalink($post->ID) ?>"><?php the_title(); ?></a>
										</li>
									<?php endwhile; ?>
								</ul>
								<?php wp_reset_postdata(); ?>
							<?php endif ?>	
						</li>
					</ul>
						
				</div>
			</div>
		</section>

						
		<section class="section section--featured-post">
			<div class="section__area">
				<div class="section__content">
					<h3 class="section__title">Frag Dr. Winter - Lustige Fragen rund um das Thema Liebe, Sex und Partnerschaft</h3>
				</div>
			</div>
		</section>



		<section class="section section--question">
			<div class="section__area">
				<div class="section__content">
					<h3 class="section__title">Frage des Tages</h3>

					<span class="fteatured-title">Wieviel ist</span>
					<span class="featured-title--large">1 x 1</span>

					<p>13% haben diese Frage falsch beantwortet</p>

				</div>
			</div>
		</section>



		<section class="section section--question">
			<div class="section__area">
				<div class="section__content">
					<h3 class="section__title">Frage des Tages</h3>

					<span class="fteatured-title">In welchem Tor befindet sich der ZONK?</span>
					
					<p>Tor 1</p>
					<p>Tor 2</p>
					<p>Tor 3</p>

				</div>
			</div>
		</section>



		<section class="section section--statistic">
			<div class="section__area">
				<div class="section__content">
					<h3 class="section__title">Diverse Satire</h3>

					<p>Lustige Krankmeldungen</p>
					<p>Das perfekte Bewerbungsschreiben</p>
					<p>Neujahrstag im Kanzleramt</p>
					<p>Neues von den Promis</p>
					<p>Lustige Chat-Nachrichten</p>

				</div>
			</div>
		</section>



		<section class="section section--featured-post">
			<div class="section__area">
				<div class="section__content">
					<h3 class="section__title">Statistik</h3>

					<?php $p = get_posts( array('posts_per_page' => 1, 'post_type' => 'statistic') ); ?>
					<?php if ( $p ) : ?>
						<?= apply_filters( 'the_content', $p[0]->post_content) ?>
					<?php endif ?>
					

					<div class="grid grid--4x">
						<div>
							<span class="number">50%</span>
							<p>aller Menschen auf der Welt haben noch nie ein Telefon gesehen</p>
						</div>
						<div>

							<!--
							<svg width="100%" height="100%" viewBox="0 0 42 42" class="donut">
								<circle class="donut-hole" cx="21" cy="21" r="15.91549430918954" fill="#fff"></circle>
								<circle class="donut-ring" cx="21" cy="21" r="15.91549430918954" fill="transparent" stroke="#d2d3d4" stroke-width="3"></circle>

								<circle class="donut-segment" cx="21" cy="21" r="15.91549430918954" fill="transparent" stroke="#ce4b99" stroke-width="3" stroke-dasharray="85 15" stroke-dashoffset="25"></circle>
							</svg>
							-->

						</div>
						<div>dfgdsf</div>
						<div>dfgdsf</div>
					</div>

					

				</div>
			</div>
		</section>



		<section class="section section--eleven-minutes">
			<div class="section__area">
				<h3 class="section__title">Alle 11 Minuten</h3>
				<div class="section__content">
					<ol class="list list--people">
						
						<?php 
						
						$elevenMinutes = [
							
							[
								'text' => 'Alle 11 Minuten verstrickt sich sich eine verzweifelte Hausfrau beim Stricken',
							],
							[
								'text' => 'Alle 11 Minuten lässt Heidi Bums irgendwo auf Instakram ihre Hüllen fallen'
							],
							[
								'text' => 'Alle 11 Minuten verbreitet Donald Dump auf Splitter eine Fake News'
							],
							[
								'text' => 'Alle 11 Minuten öffnet eine eiserne Jungfrau ihren Keuschheitsgürtel'
							],
							[
								'text' => 'Alle 11 Minuten klingelt mein Nachbar und fragt nach seinem Scheiß Paket'
							],
							[
								'text' => 'Alle 11 Minuten verklickt sich eine Shopping Queen bei Gammazon und kauft'
							]
			
						];
						?>

						<?php foreach ($elevenMinutes as $m): ?>
							<li class="list-item">
								<p><?= $m['text'] ?></p>
							</li>
						<?php endforeach ?>

					</ol>
				</div>
			</div>
		</section>

	</div>

	<?php // echo get_template_part('sidebar'); ?>

</main>

<?php get_footer(); ?>
