<div class="right">
     <section class="overview restaurant">
        <div class="difficulty">
            Ocena:
            <ul class="difficulty big">
               <?php echo printRanking($post->ID); ?>
            </ul>
        </div>
        <div class="middle">Miasto: <?php echo printRestaurationCity($post->ID); ?></div>
        <div>Obiad: <?php echo get_post_meta($post->ID, 'cena obiadu', true); ?> </div>
    </section>

    <?php dynamic_sidebar('restuarant-details-widget'); ?>

</div>