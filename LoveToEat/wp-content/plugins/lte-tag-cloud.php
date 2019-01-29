<?php

/*
Plugin Name: LTE Tag Cloud
Plugin URI: http://www.eduweb.pl/
Description: Najczęściej używane tagi w formie chmurki. Copyright 2013.
Author: Eduweb
Version: 1.0
Author URI: http://www.eduweb.pl/
*/


class LoveToEat_TagCloud extends WP_Widget{
    
    function __construct(){

        $widget_options = array(
            'classname' => 'lte-tag-cloud-widget',
            'description' => 'Najczęściej używane tagi w formie chmurki'
        );
        
        parent::__construct('lte-tag-cloud-widget', 'LoveToEat Chmurka Tagów', $widget_options);
    }
    
    function widget($args, $instance){
        extract($args);
                
        $title1 = (!empty($instance['title1'])) ? $instance['title1'] : 'Chmurka tagów';
        $title2 = (!empty($instance['title2'])) ? $instance['title2'] : 'Wybierz tag';
        $taxonomy = (!empty($instance['taxonomy'])) ? $instance['taxonomy'] : 'category';
        
        
        echo $before_widget;
        echo $before_title.$title1.$after_title;
        echo $before_title2.$title2.$after_title2;
        
        echo '<div class="tag-cloud">';
        
        wp_tag_cloud(array(
            'taxonomy' => $taxonomy,
            'smallest' => 11,
            'largest' => 16.5,
            'unit' => 'px'
        )); 
        
        echo '</div>';
        
        echo $after_widget;        
    }
    
    
    function form($instance){
        ?>
        <label for="<?php echo $this->get_field_id('title1') ?>">
            Nagłówek 1:
            <input 
                type="text" 
                name="<?php echo $this->get_field_name('title1') ?>"
                id="<?php echo $this->get_field_id('title1') ?>"
                value="<?php echo esc_attr($instance['title1']); ?>" />
        </label>

        <label for="<?php echo $this->get_field_id('title2') ?>">
            Nagłówek 2:
            <input 
                type="text" 
                name="<?php echo $this->get_field_name('title2') ?>"
                id="<?php echo $this->get_field_id('title2') ?>"
                value="<?php echo esc_attr($instance['title2']); ?>" />
        </label>

        <label for="<?php echo $this->get_field_id('taxonomy') ?>">
            Taksonomia:
            <select 
                name="<?php echo $this->get_field_name('taxonomy') ?>"
                id="<?php echo $this->get_field_id('taxonomy') ?>"
                >
                <?php
                
                    $taxonomies_list = get_taxonomies(NULL, 'object');
                    $exclude = array('', 'type');
                    
                    $curr_taxonomy = $instance['taxonomy'];
                    
                    foreach($taxonomies_list as $taxonomy){
                        $name = $taxonomy->name;
                        if(!in_array($name, $exclude)){
                            $label = $taxonomy->labels->name;
                            if($curr_taxonomy == $name){
                                echo '<option selected="selected" value="'.$name.'">'.$label.'</selected>';
                            }else{
                                echo '<option value="'.$name.'">'.$label.'</selected>';
                            }
                        }
                    }
                ?>
            </select>
        </label>
        <?php
    }
    
}

function lte_tag_cloud_init(){
    register_widget('LoveToEat_TagCloud');
}

add_action('widgets_init', 'lte_tag_cloud_init');

?>
