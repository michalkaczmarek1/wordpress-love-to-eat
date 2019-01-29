
    <footer class="boxes">
        <div class="pos-center">
            <div class="flyer">&nbsp;</div>
            <section class="spaghetti">
                <h2>Przepisy i Dieta</h2>
                <ul>
                    <?php 

                    $recipes = new Wp_Query([
                        'post_type' => 'recipes',
                        'post_per_page' => 5
                    ]);

                    while($recipes->have_posts()) {
                        $recipes->the_post();
                     ?>
                    <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
                     <?php } ?>
                </ul>
            </section>

            <section class="bread">
                
            </section>

            <section class="dinner last">
                <h2>Restauracje</h2>
                <ul>
                    <?php 

                    $restuarants = new Wp_Query([
                        'post_type' => 'restuarants',
                        'post_per_page' => 5
                    ]);

                    while($restuarants->have_posts()) {
                        $restuarants->the_post();
                     ?>
                    <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
                     <?php } ?>
                </ul>
            </section>
        </div>
    </footer>
    
</body>
</html>