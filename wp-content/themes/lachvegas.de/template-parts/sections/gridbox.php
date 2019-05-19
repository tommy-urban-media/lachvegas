<section class="gridbox">
    <div class="gridbox__item">
        <span>Tier der Woche</span> 
        <h3>Der Ohrwurm</h3>
        <p>Dieses Tier bohrt sich blitzartig in dein Ohr und ist kaum wieder wegzukriegen. Er ist hoch ansteckend und kann tagelang sein Unwesen treiben. Manchmal ist er nur sehr schwer wieder wegzukriegen.</p>
        <!-- <p>Kaiserratte: Sie ist die Eine von 40 Milliarden. Die Allmächtige, die die die Macht hat</p> -->
    </div>
    
    <div class="gridbox__item">
        <!-- <span>Spruch des Tages</span> -->
        <img src="http://localhost/lachvegas/wp-content/uploads/5198_640_640-150x150.png" />
        <!-- Heute den Füller schon angespitzt? -->
    </div>
    
    <div class="gridbox__item">
        <span>Promi der Woche</span> 
        <h3>Angela Merkel</h3>
        <span class="image-wrapper">
            <img src="http://localhost/lachvegas/wp-content/uploads/2018/10/merkel-150x150.jpg" alt="Angela Merkel">
        </span>
        <a href="#">Mehr</a>
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
        <span>Die Lotto-Glückszahl des Tages</span>
        <span class="lotto-number">1</span>
        <span class="lotto-number">2</span>
        <span class="lotto-number">3</span>
        <span class="lotto-number">4</span>
        <span class="lotto-number">5</span>
        <span class="lotto-number">6</span>

        <p>Zusatzzahl: 0</p>
    </div>

    <!--
    <div class="gridbox__item">    
        <span class="gridbox__headline">Ratgeber</span>
        <?php 
            $posts = get_posts([
                'posts_per_page' => 1,
                'category_name' => '10-dinge',
                'orderby' => 'rand',
            ]);

            $p = $posts[0];
        ?>

        <a href="<?= get_the_permalink($p->ID) ?>"><?= get_the_title($p->ID); ?></a>
        
    </div>

    <div class="gridbox__item">    
        <span class="gridbox__headline">Unsere Helden</span>
    </div>
    -->

</section>