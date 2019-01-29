<?php 

function generate_favicon() {
	echo "<link rel='shortcut icon' type='image/x-icon' href='http://localhost/wordpress/favicon.ico'"."\n";
}

add_action('wp_head', 'generate_favicon');

 ?>