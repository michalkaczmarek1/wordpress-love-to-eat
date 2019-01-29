<?php 

/*
    
    Template Name: Strona główna

*/

?>

<?php get_header(); ?>
        
        <section id="header" class="home-slider">

            <div class="wooden">
                <div class="pos-center">
                    
                    <div class="slides">

                        <div class="item pepers">
                            <div class="caption">
                                <h3>Czerwone papryczki!</h3>
                                <p>
                                    Papryka ostra – ogólna nazwa, jaką określa się owoce niektórych odmian, kultywarów i mieszańców papryki (Capsicum) o bardzo ostrym smaku
                                    <a href="#">Czytaj artykuł</a>
                                </p>
                            </div>
                            <img src="<?php echo site_url(); ?>/wp-content/themes/LoveToEat/content/header-big-peppers1.png" alt="" />
                        </div>

                        <div class="item pepers">
                            <div class="caption">
                                <h3>Czerwone papryczki!</h3>
                                <p>
                                    Papryka ostra – ogólna nazwa, jaką określa się owoce niektórych odmian, kultywarów i mieszańców papryki (Capsicum) o bardzo ostrym smaku
                                    <a href="#">Czytaj artykuł</a>
                                </p>
                            </div>
                            <img src="<?php echo site_url(); ?>/wp-content/themes/LoveToEat/content/header-big-peppers2.png" alt="" />
                        </div>

                        <div class="item pepers">
                            <div class="caption">
                                <h3>Czerwone papryczki!</h3>
                                <p>
                                    Papryka ostra – ogólna nazwa, jaką określa się owoce niektórych odmian, kultywarów i mieszańców papryki (Capsicum) o bardzo ostrym smaku
                                    <a href="#">Czytaj artykuł</a>
                                </p>
                            </div>
                            <img src="<?php echo site_url(); ?>/wp-content/themes/LoveToEat/content/header-big-peppers3.png" alt="" />
                        </div>

                        <div class="item pepers">
                            <div class="caption">
                                <h3>Czerwone papryczki!</h3>
                                <p>
                                    Papryka ostra – ogólna nazwa, jaką określa się owoce niektórych odmian, kultywarów i mieszańców papryki (Capsicum) o bardzo ostrym smaku
                                    <a href="#">Czytaj artykuł</a>
                                </p>
                            </div>
                            <img src="<?php echo site_url(); ?>/wp-content/themes/LoveToEat/content/header-big-peppers4.png" alt="" />
                        </div>
                    </div>

                    <div class="pagination">
                        <ul>
                            <li><a href="#">1</a></li>
                            <li><a href="#">2</a></li>
                            <li class="active"><a href="#">3</a></li>
                            <li><a href="#">4</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <section class="caption quote">
                <div class="pos-center">
                    <blockquote>
                        <p>“W gospodarce opartej na wiedzy możemy mieć ciastko, zjeść ciastko i upiec jeszcze trzecie.”</p>
                    </blockquote>
                </div>
            </section>

            <div class="gradient">
                <div class="pos-center">&nbsp;</div>
            </div>
        </section>

        <section id="home" class="content">
            <section class="boxes">
                <div class="pos-center">
                    <section class="box first">
                        <div class="step1">
                            <h2>Witaj w lovetoeat!</h2>
                            <p>Witaj w świecie prawdziwych kulinarnych inspiracji! Jesteśmy pasjonatami dobrego jedzenia i chcemy w pięknej formie podzielić się z Tobą naszymi zainteresowaniami.</p>
                        </div>
                    </section>

                    <section class="box second">
                        <div class="step1">
                            <h2>Przepisy i Dieta</h2>
                            <p>Na lovetoeat.pl znajdziesz między innymi dziesiątki zdrowych przepisów, które przygotowali dla Ciebie nasi dietetycy. Najlepsze przepisy wyślij znajomym!</p>
                        </div>
                        <div class="step2 hidden">
                            <h2>Ostatnio dodane:</h2>
                            <?php 

                            $recipes = new Wp_Query([
                                'numberposts' => 7,
                                'orderby' => 'post_date',
                                'order' => 'DESC',
                                'post_type' => 'recipes',
                                'post_status' => 'publish'
                            ]);

                            if($recipes->have_posts()) {

                             ?>
                            
                            <ul class="icons-list">
                                <?php while($recipes->have_posts()) { ?>
                                <?php $recipes->the_post(); ?>
                                <li class="chicken"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
                                <?php } ?>
                            </ul>

                             <?php } ?>
                            <a href="#">Wszystkie przepisy</a>
                        </div>
                    </section>

                    <section class="box third">
                        <div class="step1">
                            <h2>Dobre Restauracje</h2>
                            <p>Odkryj ciekawe miejsca i dowiedz się, które potrawy warto zjeść w restauracjach, które dla Ciebie recenzujemy. Sprawdź restauracje w których bywają Twoi znajomi.</p>
                        </div>
                        <div class="step2 hidden">
                            <h2>Ostatnio dodane:</h2>

                           <?php 

                            $restuarants = new Wp_Query([
                                'numberposts' => 7,
                                'orderby' => 'post_date',
                                'order' => 'DESC',
                                'post_type' => 'restuarants',
                                'post_status' => 'publish'
                            ]);

                            if($restuarants->have_posts()) {

                             ?>
                            
                            <ul class="icons-list">
                                <?php while($restuarants->have_posts()) { ?>
                                <?php $restuarants->the_post(); ?>
                                <li class="chicken"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
                                <?php } ?>
                            </ul>

                             <?php } ?>
                            <a href="#">Wszystkie</a>
                        </div>
                    </section>

                </div>
            </section>

            <section class="inspirations">
                <div class="pos-center">
                    <header>
                        <h2>Kulinarne inspiracje</h2>
                        <h4>Zobacz wszystkie artykuły</h4>
                    </header>

                    <div class="slider">
                        <a class="prev" href="#">&LeftArrow;</a>
                        <div class="slides-container">
                            <div class="items">

                            <?php $recent_recipes = new Wp_Query([
                                'post_type' => 'recipes',
                                'post_per_page' => 6
                            ]);

                            while($recent_recipes->have_posts()) {
                                $recent_recipes->the_post();
                            ?>

                                <div>
                                <?php the_post_thumbnail(); ?>
                                    <h2>
                                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                    </h2>
                                    <p><?php the_excerpt_max_charlength(94); ?></p>
                                    <a class="more" href="<?php the_permalink(); ?>">...</a>
                                </div>

                            <?php } ?>

                            </div>
                        </div>
                        <a class="next" href="#">&RightArrow;</a>
                    </div>

                </div>
            </section>

            <section class="comments">
                <div class="pos-center">
                    <header>
                        <h2>Poznaj opinie innych</h2>
                        <h4><a href="#">Zobacz wszystkie komentarze</a></h4>
                    </header>

                    <section class="container">
                        <span class="flyer">&uArr;</span>

                        <?php 

                        $recent_comms = fetchRecentComments(3);

                        foreach ($recent_comms as $comment) :
                            $date = new \DateTime($comment->comment_date_gmt);


                         ?>
                        <section class="first">
                            <header>
                                <small><?php echo $comment->comment_author; ?> w dniu <?php echo $date->format('d.m.Y'); ?></small>
                                <?php echo cutText($comment->post_title, 27); ?>
                            </header>
                            <?php echo get_avatar($comment->user_id, 69) ?>                        
                            <blockquote><?php echo $comment->comment_content; ?></blockquote>
                        </section>
                        <?php endforeach ?>


                        <div class="clear"></div>
                    </section>
                </div>
            </section>
        </section>

<?php get_footer('home'); ?>

    </body>
</html>