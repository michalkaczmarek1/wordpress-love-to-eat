<?php 


add_action('init', 'lovetoeat_init_posttypes');

function lovetoeat_init_posttypes(){

	// Rejestrujemy przepisy

	$recipes_args = [
		'labels' => [
			'name' => 'Przepisy',
			'singular_name' => 'Przepisy',
			'all_items' => 'Wszystkie przepisy',
			'add_new' => 'Dodaj nowy przepis',
			'add_new_item' => 'Dodaj nowy przepis',
			'edit_item' => 'Edytuj przepis',
			'new_item' => 'Nowy przepis',
			'view_item' => 'Zobacz przepis',
			'search_items' => 'Szukaj w przepisach',
			'not_found' => 'Nie znaleziono przepisów',
			'not_found_in_trash' => 'Brak przepisów w koszu',
			'parent_item_colon' => ''
		],
		'public' => true,
		'public_queryable' => true,
		'show_ui' => true,
		'query_var' => true,
		'rewrite' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
		'menu_position' => 5,
		'supports' => [
			'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments', 'custom-fields'
		],
		'has_archive' => true
	];

	register_post_type('recipes', $recipes_args);

	$restuarants_args = [
		'labels' => [
			'name' => 'Restauracje',
			'singular_name' => 'Restauracje',
			'all_items' => 'Wszystkie restauracje',
			'add_new' => 'Dodaj nowa restauracje',
			'add_new_item' => 'Dodaj nowa restauracje',
			'edit_item' => 'Edytuj restauracje',
			'new_item' => 'Nowa restauracja',
			'view_item' => 'Zobacz restauracje',
			'search_items' => 'Szukaj w restauracjach',
			'not_found' => 'Nie znaleziono restauracji',
			'not_found_in_trash' => 'Brak restauracji w koszu',
			'parent_item_colon' => ''
		],
		'public' => true,
		'public_queryable' => true,
		'show_ui' => true,
		'query_var' => true,
		'rewrite' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
		'menu_position' => 5,
		'supports' => [
			'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments', 'custom-fields', 'post-formats'
		],
		'has_archive' => true
	];

	register_post_type('restuarants', $restuarants_args);

}

add_action('init', 'lovetoeat_init_taxonomies');

function lovetoeat_init_taxonomies() {

	register_taxonomy(
		'ingredients',
		['recipes'],
		[
			'hierarchical' => true,
			'labels' => [
				'name' => 'Składniki',
				'singular_name' => 'Składniki',
				'search_items' => 'Wyszukaj składniki',
				'popular_items' => 'Popularne składniki',
				'all_items' => 'Wszystkie składniki',
				'edit_item' => 'Edytuj składnik',
				'update_item' => 'Aktualizuj składnik',
				'add_new_item' => 'Dodaj nowy składnik',
				'new_item_name' => 'Nazwa nowego składnika',
				'separate_items_with_commas' => 'Oddziel składniki przecinkiem',
				'add_or_remove_items' => 'Dodaj lub usun składniki',
				'choose_from_most_used' => 'Wybierz spośród najcześciej wybieranych składników',
				'menu_name' => 'Składniki'
			],
			'show_ui' => true,
			'update_count_callback' => '_update_post_term_count',
			'query_var' => true,
			'rewrite' => ['slug' => 'ingredient']
		]
	);

 // Meal Types
    register_taxonomy(
        'meal-type',
        array('recipes', 'restuarants'),
        array(
            'hierarchical' => true,
            'labels' => array(
                'name' => 'Typ Dania', 'taxonomy general name',
                'singular_name' => 'Typ Dania', 'taxonomy singular name',
                'search_items' =>  'Wyszukaj typ dania',
                'popular_items' => 'Najpopularniejsze typy dań',
                'all_items' => 'Wszystkie typy dań',
                'most_used_items' => null,
                'parent_item' => null,
                'parent_item_colon' => null,
                'edit_item' => 'Edytuj typ dania', 
                'update_item' => 'Aktualizuj',
                'add_new_item' => 'Dodaj nowy typ dania',
                'new_item_name' => 'Nazwa nowego typu dania',
                'separate_items_with_commas' => 'Oddziel typy dań przecinkiem',
                'add_or_remove_items' => 'Dodaj lub usuń typ dania',
                'choose_from_most_used' => 'Wybierz spośród najczęścież używanych typów dań',
                'menu_name' => 'Typ Dania',
            ),
            'show_ui' => true,
            'update_count_callback' => '_update_post_term_count',
            'query_var' => true,
            'rewrite' => array('slug' => 'meal-type' )
    ));
    
    
    
    // Cousine Types
    register_taxonomy(
        'cousine-type',
        array('recipes', 'restuarants'),
        array(
            'hierarchical' => true,
            'labels' => array(
                'name' => 'Rodzaj kuchni',
                'singular_name' => 'Rodzaj kuchni',
                'search_items' =>  'Wyszukaj rodzaj kuchni',
                'popular_items' => 'Najpopularniejsze rodzaje kuchni',
                'all_items' => 'Wszystkie rodzaje kuchni',
                'most_used_items' => null,
                'parent_item' => null,
                'parent_item_colon' => null,
                'edit_item' => 'Edytuj rodzaj kuchni', 
                'update_item' => 'Aktualizuj',
                'add_new_item' => 'Dodaj nowy rodzaj kuchni',
                'new_item_name' => 'Nazwa nowego rodzaju kuchni',
                'separate_items_with_commas' => 'Oddziel rodzaje kuchni przecinkiem',
                'add_or_remove_items' => 'Dodaj lub usuń rodzaj kuchni',
                'choose_from_most_used' => 'Wybierz spośród najczęściej używanych rodzajów kuchni',
                'menu_name' => 'Rodzaj kuchni',
            ),
            'show_ui' => true,
            'update_count_callback' => '_update_post_term_count',
            'query_var' => true,
            'rewrite' => array('slug' => 'cousine-type' )
    ));
    
    
    // Cities
    register_taxonomy(
        'city',
        array('restuarants'),
        array(
            'hierarchical' => FALSE,
            'labels' => array(
                'name' => 'Miasto',
                'singular_name' => 'Miasto',
                'search_items' =>  'Wyszukaj miasto',
                'popular_items' => 'Najpopularniejsze miasto',
                'all_items' => 'Wszystkie miasta',
                'most_used_items' => null,
                'parent_item' => null,
                'parent_item_colon' => null,
                'edit_item' => 'Edytuj miasto', 
                'update_item' => 'Aktualizuj',
                'add_new_item' => 'Dodaj nowe miasto',
                'new_item_name' => 'Nazwa nowego miasta',
                'separate_items_with_commas' => 'Oddziel miasta przecinkiem',
                'add_or_remove_items' => 'Dodaj lub usuń miasto',
                'choose_from_most_used' => 'Wybierz spośród najczęściej używanych miast',
                'menu_name' => 'Miasto',
            ),
            'show_ui' => true,
            'update_count_callback' => '_update_post_term_count',
            'query_var' => true,
            'rewrite' => array('slug' => 'city' )
    ));
}

add_action('admin_head', 'lte_admin_icons');

function lte_admin_icons() {

	$ICON_URL = LOVETOEAT_THEME_URL.'img/admin/';

?>

<style>
	  /* po to żeby w panelu admina zmienić domyślne ikonki custom post types*//* dla menu */
	
    #menu-posts-recipes .wp-menu-image,
    #menu-posts-restaurants .wp-menu-image,
    #menu-posts-foodfight .wp-menu-image{
        background-repeat: no-repeat;
        background-position: center -17px!important;
    }
    
    #menu-posts-recipes:hover .wp-menu-image,
    #menu-posts-restaurants:hover .wp-menu-image,
    #menu-posts-foodfight:hover .wp-menu-image,
    #menu-posts-recipes.wp-has-current-submenu .menu-icon-recipes,
    #menu-posts-restaurants.wp-has-current-submenu .menu-icon-restuarants,
    #menu-posts-foodfight.wp-has-current-submenu .menu-icon-food_fights{
        background-repeat: no-repeat;
        background-position: center 6px!important;
    }

    /*wp-has-submenu wp-has-current-submenu wp-menu-open menu-top menu-icon-recipes

    wp-has-submenu wp-not-current-submenu menu-top menu-icon-restuarants

    wp-has-submenu wp-not-current-submenu menu-top menu-icon-food_fights*/
    
    .menu-icon-recipes .dashicons-before.dashicons-admin-post{
        background-image: url('<?php echo $ICON_URL.'icon-recipes-menu.png' ?>');
    }

    .menu-icon-recipes .dashicons-admin-post:before,.dashicons-format-standard:before {
    	content: "";
	}

	.menu-icon-restuarants .dashicons-before.dashicons-admin-post{
        background-image: url('<?php echo $ICON_URL.'icon-restaurants-header.png' ?>');
    }

    .menu-icon-restuarants .dashicons-admin-post:before,.dashicons-format-standard:before {
    	content: "";
	}

	.menu-icon-food_fights .dashicons-before.dashicons-admin-post{
        background-image: url('<?php echo $ICON_URL.'icon-recipes-header.png' ?>');
    }

    .menu-icon-food_fights .dashicons-admin-post:before,.dashicons-format-standard:before {
    	content: "";
	}

</style>

<?php } ?>