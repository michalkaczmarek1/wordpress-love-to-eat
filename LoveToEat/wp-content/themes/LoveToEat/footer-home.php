<footer>
            <div class="pos-center">
                <section class="menu">
                    <?php 

                    $taxonomies_list = ['ingredients','meal-type', 'cousine-type'];

                    foreach ($taxonomies_list as $taxonomy) {
                        $terms_list = get_terms($taxonomy, [
                            'orderby' => 'count',
                            'hide_empty' => false,
                            'number' => 5
                        ]);
                    

                     ?>

                     <ul>
                         <?php 

                         foreach ($terms_list as $term) {
                             $url = get_term_link($term->slug, $term->taxonomy);
                             $name = ucfirst(mb_strtolower($term->name));
                         

                        ?>
                        <li><a href="<?php echo $url; ?>"><?php echo $name ?></a></li>
                        <?php } ?>
                     </ul>
                     <?php } ?>
                </section>

                <section class="tag-cloud">
                    <?php 

                    wp_tag_cloud([
                        'taxonomy' => 'ingredients',
                        'smallest' => 10,
                        'largest' => 16.5,
                        'unit' => 'px'
                    ]);



                     ?>
                </section>
            </div>
        </footer>