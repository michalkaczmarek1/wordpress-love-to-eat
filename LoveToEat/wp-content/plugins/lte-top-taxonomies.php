<?php

/*
Plugin Name: LTE Top Taxonomies
Plugin URI: http://www.eduweb.pl/
Description: Najpopularniejsze taksonomie. Copyright 2013.
Author: Eduweb
Version: 1.0
Author URI: http://www.eduweb.pl/
*/


class LoveToEat_TopTaxonomies extends WP_Widget{
    
    private $widget_name = 'lte-top-taxonomies-widget';
    
    function __construct(){

        $widget_options = array(
            'classname' => $this->widget_name,
            'description' => 'Najpopularniejsze taksonomie'
        );
        
        parent::__construct($this->widget_name, 'LoveToEat Najpopularniejsze taksonomie', $widget_options);
    }
    
    function widget($args, $instance){
        extract($args);
                
        $title1 = (!empty($instance['title1'])) ? $instance['title1'] : 'Najbardziej popularne';
        $title2 = (!empty($instance['title2'])) ? $instance['title2'] : 'Taksonomie';
        $taxonomy = (!empty($instance['taxonomy'])) ? $instance['taxonomy'] : 'ingredients';
        $entries_count = (!empty($instance['entries_count'])) ? (int)$instance['entries_count'] : 5;
        
        $args = array(
            'orderby'    => 'count',
            'hide_empty' => 0,
            'number' => $entries_count
         );
        
        $terms_list = get_terms($taxonomy, $args);
        
        
        echo $before_widget;
        echo $before_title.$title1.$after_title;
        echo $before_title2.$title2.$after_title2;
            
        echo '<ul class="icons-list">';
        foreach($terms_list as $term){
            $url = get_term_link($term->slug, $term->taxonomy);
            $name = ucfirst(mb_strtolower($term->name));
            $css_class = getCssClass($term->name, $term->taxonomy);

            echo '<li class="'.$css_class.'"><a href="'.$url.'">'.$name.'</a></li>';
        }
        echo '</ul>';
        
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
        <label for="<?php echo $this->get_field_id('entries_count') ?>">
            Ilość wpisów:
            <select 
                name="<?php echo $this->get_field_name('entries_count') ?>"
                id="<?php echo $this->get_field_id('entries_count') ?>"
                >
                <?php
                    $opts = array(5, 10, 15);
                    $curr = (int)esc_attr($instance['entries_count']);
                    foreach($opts as $val){
                        if($curr == $val){
                            echo '<option selected="selected" value="'.$val.'">'.$val.'</selected>';
                        }else{
                            echo '<option value="'.$val.'">'.$val.'</selected>';
                        }
                    }
                ?>
            </select>
        </label>
        <?php
    }
    
}

function lte_top_taxonomies_init(){
    register_widget('LoveToEat_TopTaxonomies');
}

add_action('widgets_init', 'lte_top_taxonomies_init');

?>
