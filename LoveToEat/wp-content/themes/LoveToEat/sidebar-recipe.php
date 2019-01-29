<div class="right">
     <section class="overview">
        <div class="difficulty">
            Trudność:
            <ul class="difficulty big">
               <?php echo printRanking($post->ID); ?>
            </ul>
        </div>
        <div class="time middle"><?php echo printPreparationTime($post->ID); ?> min</div>
        <div class="diet">Dieta: <?php echo get_post_meta($post->ID, 'dieta', true); ?> kcal</div>
    </section>

    <section class="ingredients">
        <h2>Składniki</h2>
        <a class="print" href="#">Wydrukuj</a>
       <?php printRecipeIngredients($post->ID); ?>
    </section>

    <?php dynamic_sidebar('recipe-details-widget'); ?>

</div>