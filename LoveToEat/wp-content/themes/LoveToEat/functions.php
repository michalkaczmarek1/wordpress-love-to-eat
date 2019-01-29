<?php


// if(!define('LOVETOEAT_THEME_DIR')) {

	// define('LOVETOEAT_THEME_DIR', ABSPATH.'/wp-content/themes/'.get_template().'/');
	define('LOVETOEAT_THEME_DIR', get_theme_root().'/'.get_template().'/');

// }

// if(!define('LOVETOEAT_THEME_URL')) {

	define('LOVETOEAT_THEME_URL', WP_CONTENT_URL.'/themes/'.get_template().'/');

// }

require_once(LOVETOEAT_THEME_DIR.'libs/posttypes.php');
require_once(LOVETOEAT_THEME_DIR.'libs/utils.php');

add_theme_support('post-formats', ['gallery']);
add_theme_support('post-thumbnails', ['post', 'recipes', 'restuarants']);

function printRestaurantCategories($post_id){

	printPostCategories($post_id, ['cousine-type', 'city']);
	
}

function printRanking($post_id){
	$rate = (int)get_post_meta($post_id, 'ranking', true); 

   for($i = 1; $i < 5; $i++){

   		if($i <= $rate){
   			echo "<li class='active'></li>";
   		} else {
   			echo "<li></li>";
   		}

   }

}

// register_sidebar([
//    'name' => 'Restauracje (listing)',
//    'id' => 'restuarants-archive-widget',
//    'description' => 'Widgety w sidebarze w archiwum restauracji',
//    'before_widget' => '<div id="%1$s" class="box widget %2$s">',
//    'after_widget' => '</div>',
//    'before_title' => '<h2 class="widgettitle">',
//    'after_title' => '</h2>'
// ]);

if(function_exists(register_sidebar)){

   $sidebar_list = [
      [
         'name' => 'Restauracje (listing)',
         'id' => 'restuarants-archive-widget',
         'description' => 'Widgety w sidebarze w archiwum restauracji'
      ],
      [
         'name' => 'Restauracje (szczegóły)',
         'id' => 'restuarant-details-widget',
         'description' => 'Widgety w sidebarze w pojedynczej restauracji'
      ],
      [
         'name' => 'Przepisy (listing)',
         'id' => 'recipes-archive-widget',
         'description' => 'Widgety w sidebarze w archiwum przepisów'
      ],
      [
         'name' => 'Przepisy (szczegóły)',
         'id' => 'recipe-details-widget',
         'description' => 'Widgety w sidebarze w pojedynczym przepisie'
      ],
      [
         'name' => 'Domyślny',
         'id' => 'default-widget',
         'description' => 'Domyśłny pasek z widgetami'
      ]
   ];

   $sidebar_opts = [
      'before_widget' => '<div id="%1$s" class="box widget %2$s">',
      'after_widget' => '</div>',
      'before_title' => '<h2 class="widgettitle">',
      'after_title' => '</h2>'
   ];

   foreach ($sidebar_list as $sidebar) {
      
      register_sidebar(array_merge($sidebar, $sidebar_opts));

   }
   
}

//dane do mapy

function getRestaurantsCountByCities(){

   $cities = get_terms('city');
   $arr_ret = [];

   foreach ($cities as $city) {
      
      $arr_ret[] = [
         'city' => $city->name,
         'restaurantsCount' => $city->count
      ];

   }

   return $arr_ret;

}

function show_admin_panel_message(){
   
   $key = esc_attr(get_option('lte_gmap_api_key'));

   if(empty($key)){
      echo "<div id='message' class='error'><strong>Szablon LoveToEat wymaga podania klucza Google Maps API</strong></div>";
   }
}

add_action('admin_notices', 'show_admin_panel_message');

function lte_admin_init(){
   register_setting('lte_theme_options', 'lte_gmap_api_key');
}

add_action('admin_init', 'lte_admin_init');

function lte_settings_page(){
   ?>
      <div class="wrap">
         <?php screen_icon(); ?>
         <h2>Ustawienia szablonu LoveToEat</h2>

         <form action="options.php" method="post" id="lte-options-form">
            <?php settings_fields('lte_theme_options'); ?>
            <h3>
               <label for="lte_gmap_api_key">Klucz Google Maps</label>
               <input type="text" name="lte_gmap_api_key" id="lte_gmap_api_key" style="width: 500px;" value="<?php echo esc_attr(get_option('lte_gmap_api_key')); ?>">
               <input type="submit" class="button button-primary" value="Zapisz">
            </h3>
         </form>
      </div>
   <?php 
}

function lte_settings_menu(){
   add_theme_page('LoveToEat - Ustawienia', 'Szablon LoveToEat', 'manage_options', 'lte-theme-options', 'lte_settings_page');
}

add_action('admin_menu', 'lte_settings_menu');

if(function_exists('register_nav_menus')){
   register_nav_menus([
      'main_nav' => 'Główne menu nawigacji'
   ]);
}

function printPreparationTime($post_id){
   $minutes = (int)get_post_meta($post_id, 'time', true);

   if($minutes > 60){
      $hours = floor($minutes/60);
      $minutes = (int)$minutes-$hours*60;

      if($minutes > 0){
         echo "{$hours}h {$minutes}min";
      } else {
         echo "{$hours}h";
      }
   } else {
      echo "{$minutes}";
   }
}

function getTopTaxonomies($taxonomy, $number = ""){

   $result = get_terms($taxonomy, [
      'orderby' => 'count',
      'hide_empty' => 0,
      'number' => $number
   ]);

   return $result;

}

function getHierarchicalTaxonomies($taxonomy){

   $top_level = get_terms($taxonomy, [
      'parent' => 0,
      'hide_empty' => 0
   ]);

   $return = [];
   
   foreach ($top_level as $tag) {
      
      $tag->childs = get_terms($taxonomy, [
         'parent' => $tag->term_id,
         'hide_empty' => 0
      ]);

      $return[$tag->slug] = $tag;

   }

   return $return;

}

function the_post_breadcrumb() {
      global $post;
      
      echo '<a href="'.home_url().'">Główna</a>';
      
      echo '<span></span>';
      
      $post_type_name = get_post_type();
      $post_type_url = get_post_type_archive_link(get_post_type());
      
      echo '<a href="'.$post_type_url.'">'.ucfirst($post_type_name).'</a>';
      
      $recipe_cats = get_the_terms($post->ID, 'meal-type');
      
      echo '<span></span>';
      
      if(count($recipe_cats) > 0 ) {
         
         $recipe_meal_type = array_shift(array_values($recipe_cats));
         $term_link = get_term_link($recipe_meal_type->slug, 'meal-type');
         
         echo '<a href="'.$term_link.'">'.ucfirst($recipe_meal_type->name).'</a>';
         
         echo '<span></span>';
      }  

      the_title();

   }

   function getRecipeIngredients($post_id){
      
      $ingredients = (string)get_post_meta($post_id, 'skladniki', true);

      $ing_list = explode("\n", trim($ingredients));

      $return = [];

      foreach ($ing_list as $row) {
         
         $parts = explode(":", $row);
         $name = trim($parts[0]);

         if(!empty($name)){
            $return[$name] = trim($parts[1]);
         }

      }

      return $return;

   }


   function printRecipeIngredients($post_id){

      $ingredients = getRecipeIngredients($post_id);

      echo "<ul>";

      if(count($ingredients) < 1){
         
         echo '<li>Brak składników</li>';

      } else {

         foreach ($ingredients as $name => $value) {
            $css_class = getIngredientCssClass($name);
            echo "<li class=\"{$css_class}\">{$name}<span>{$value}</span></li>";

         }

      }

      echo "</ul>";

   }

   function getCssClass($item, $type){
        $item = mb_strtolower($item);
        
        $classes_list = array(
         
            'chicken' => array(
                'ingredients' => array('mięso', 'ziemniaki', 'por', 'kurczak', 'inne'),
                'cousine-type' => array('kuchnia japońska', 'kuchnia polska')
            ),
            
            'soup' => array(
                'ingredients' => array('ryby', 'ryż', 'seler', 'pomidor', 'owoce'),
                'cousine-type' => array('włoskie smaki', 'kuchnia tajska')
            ),
            
            'cake' => array(
                'ingredients' => array('warzywa', 'pieczywo', 'sałata', 'pietruszka', 'warzywa'),
                'cousine-type' => array('kuchnia francuska')
            ),
            
            'fish' => array(
                'ingredients' => array('makaron', 'rzodkiewka', 'pomidory', 'mięso', 'ryby'),
                'cousine-type' => array('hiszpańskie tapas')
            )
        );
      
        foreach($classes_list as $class => $types_list){
            if(isset($types_list[$type])){
                if(in_array($item, $types_list[$type])){
                    return $class;
                }
            }
        }
        return '';
    }
    
    function getIngredientCssClass($ingredient){
        return getCssClass($ingredient, 'ingredients');
    }
    
    function getCousineTypeCssClass($type){
        return getCssClass($type, 'cousine-type');
    }

    function lovetoeat_comment_theme($comment, $args, $depth){

      $GLOBALS['comment'] = $comment;
      $tag = $args['style'];

    ?>
            <<?php echo $tag; ?> <?php comment_class(empty($args['has-children']) ? '' : 'parent'); ?> id="li-comment-<?php comment_ID() ?>">
              <div id="div-comment-<?php comment_ID(); ?>" class="inner">
                  <?php echo get_avatar($comment, $args['avatar_size']); ?>             
                  <h4>
                  <?php echo get_comment_author_link(); ?>
                  <?php echo 'w dniu ' . get_comment_date() . ' o ' . get_comment_time() ?>
                  <?php comment_reply_link(array_merge($args, ['depth' => $depth, 'max_depth' => $args['max_depth']])) ?>
                  </h4>
                  <?php comment_text(); ?>

                  <?php if($comment->comment_approved == '0') { ?>
                      <div class="comment-avaiting-moderation">Twoj komentarz oczekuje na moderacje</div>
                  <?php } ?>

              </div>
      
  <?php  
  }

  function printRestaurationCity($post_id){

    $cities = get_the_terms($post_id, ['city']);

    if(isset($cities)){
      return $cities[0]->name;
    } 

    return null;

  }

  function getFoodFight($post_id){

    $post_id = (int)$post_id;
    global $wpdb;

    $post_row = $wpdb->get_row('
        SELECT *
        FROM {$wpdb->posts}    
        WHERE ID = {$post_id}
    ');

    if(empty($post_row->ID)){
      return NULL;
    }

    $FoodFight = new FoodFight($post_row);

    return $FoodFight;
    
  }

?>

