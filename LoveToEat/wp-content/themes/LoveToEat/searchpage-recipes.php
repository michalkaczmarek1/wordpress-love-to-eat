<?php 

/*

	Template Name: Wyszukiwanie po składnikach

*/

 ?>

 <?php 

 	$search_ingr = true;

 	if(isset($_GET['ingredients'])){
 		$ingredients = array_keys($_GET['ingredients']);
 	} else {
 		$ingredients = [];
 	}

 	$loop = new WP_Query([
 		'post_type' => 'recipes',
 		'tax_query' => [
 			[
 				'taxonomy' => 'ingredients',
 				'field' => 'slug',
 				'terms' => $ingredients
 			]
 		]
	]);

 	get_template_part('archive', 'recipes');

  ?>