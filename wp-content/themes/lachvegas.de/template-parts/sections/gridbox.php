<section class="gridbox">
    <div class="gridbox__item">
        <span class="gridbox__headline">Tier der Woche</span> 

        <div class="teaser-compact">
            <div class="teaser-compact__image"><img src="<?= get_bloginfo('template_url')?>/app/images/crazy-face.png" /></div>
            <div class="teaser-compact__content">
                <h3 class="teaser-compact__title">Der Ohrwurm</h3>
                <div class="teaser-compact__content">Dieses Tier bohrt sich blitzartig in dein Ohr und ist kaum wieder wegzukriegen. Er ist hoch ansteckend und kann tagelang sein Unwesen treiben. Manchmal ist er nur sehr schwer wieder wegzukriegen.</div>
            </div>
        </div>
        
        
        
        <!-- <p>Kaiserratte: Sie ist die Eine von 40 Milliarden. Die Allmächtige, die die die Macht hat</p> -->
        
    </div>
    
    <div class="gridbox__item">
        <span class="gridbox__headline">Bekloppter Spruch</span>

        <?php 
            $sayingQuery = new WP_Query( 
              array(
                'posts_per_page' => 1, 
                'post_type' => array('saying'),
                'orderby' => 'rand'
              ) 
            ); 
        ?>
            
        <?php if ($sayingQuery->have_posts()): ?>
            <div class="statistic">
                <?php while ( $sayingQuery->have_posts() ) : $sayingQuery->the_post(); setup_postdata($post)?>
                    <div class="statistic__text">"<?php the_title() ?>"</div>
                <?php endwhile ?>
            </div>
        <?php endif ?>

        <!-- <img src="http://localhost/lachvegas/wp-content/uploads/5198_640_640-150x150.png" /> -->
        <!-- Heute den Füller schon angespitzt? -->
    </div>
    
    <div class="gridbox__item">
        <span class="gridbox__headline">Promi der Woche</span> 

        <div class="teaser-compact">
            <div class="teaser-compact__image">
                <img src="http://localhost/lachvegas/wp-content/uploads/2018/10/merkel-150x150.jpg" alt="Angela Merkel">
            </div>
            <div class="teaser-compact__content">
                <h3 class="teaser-compact__title">Angela Merkel</h3>
                <div class="teaser-compact__content">
                "Die Digitale Welt ist für uns alle Neuland." Das gilt insbesondere für mich, meine Minister und alle die da noch so im Kanzleramt rumschwirren.
                </div>
            </div>
        </div>

        <div class="teaser-compact">
            <div class="teaser-compact__image">
                <img src="http://localhost/lachvegas/wp-content/uploads/2018/10/merkel-150x150.jpg" alt="Angela Merkel">
            </div>
            <div class="teaser-compact__content">
                <h3 class="teaser-compact__title">Donald Trump</h3>
                <div class="teaser-compact__content">
                    "Am Dritten Tag erschuf Gott - MICH"
                    "Gott hat mich entsandt um die Menschheit vor ihrer eigenen Unfähigkeit zu befreien"
                </div>
            </div>
        </div>

        Jong-Un: "Die Beste Erfindung des 20. Jahrhunderts war die Atombombe. Und das Gulag."
        Andrea Anales: "Wenn ihr mir nicht zuhören wollt dann SCHREI ICH EUCH AN!".
        Chuck Norris: "Ich weiß nicht woher diese Informationen kommen aber mir soll es recht sein dass die Leute glauben dass ich alles kann und auch noch das Gegenteil davon kenne."

        <!-- <a href="/angela-merkel" class="box-link">Mehr</a> -->
    </div>

    <div class="gridbox__item">
        <?php //$post = get_post(2090); get_template_part('template-parts/common/poll'); ?>

        <span class="gridbox__headline">Statistik des Tages</span>
        <div class="statistic">
            <!-- <div class="statistic__subtitle">Mit dem Nachbarn hat es geklappt</div> -->
            <div class="statistic__text"><strong>0,00002%</strong> aller Ehefrauen schleichen sich in der Nacht aus der Wohnung und besuchen für eine halbe Stunde den Nachbarn ohne dass der Ehemann etwas davon merkt.</div>
        </div>
    </div>

    <div class="gridbox__item">
        <span class="gridbox__headline">Zitat des Tages</span>
        <div class="statistic">
            <div class="statistic__text">
                "Es gibt nichts schöneres als einer 70-Jährigen mit einer 45er das Schießen beizubringen 
                damit sie sich selbst verteidigen kann. Es ist einfach großartig."
            </div>
            - Zitat eines Mitglieds der NRA
        </div>
    </div>

    <div class="gridbox__item">    
        <span class="gridbox__headline">Das Unnütze Wissen / das ungenutze Wissen</span>
        <?php 
            $factQuery = new WP_Query( 
              array(
                'posts_per_page' => 1, 
                'post_type' => array('fact'),
                'orderby' => 'rand'
              ) 
            ); 
        ?>
            
        <?php if ($factQuery->have_posts()): ?>
            <div class="statistic">
                <?php while ( $factQuery->have_posts() ) : $factQuery->the_post(); setup_postdata($post)?>
                    <div class="statistic__text"><?php the_content() ?></div>
                <?php endwhile ?>
            </div>
        <?php endif ?>
        
    </div>

    <!--
    <div class="gridbox__item">    
        <span class="gridbox__headline">Unsere Helden</span>
    </div>
    -->

</section>