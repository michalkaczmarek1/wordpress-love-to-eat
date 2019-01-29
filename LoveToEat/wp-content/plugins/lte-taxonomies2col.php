<?php

/*
Plugin Name: LTE Taxonomies Two Columns
Plugin URI: http://www.eduweb.pl/
Description: Składniki i kuchnia w postaci dwóch list. Copyright 2013.
Author: Eduweb
Version: 1.0
Author URI: http://www.eduweb.pl/
*/


class LoveToEat_Taxonomies2Col extends WP_Widget{
    
    private $widget_name = 'lte-taxonomies2col-widget';
    
    function __construct(){

        $widget_options = array(
            'classname' => $this->widget_name,
            'description' => 'Składniki i kuchnia w postaci dwóch list'
        );
        
        parent::__construct($this->widget_name, 'LoveToEat Składniki i kuchnia', $widget_options);
    }
    
    function widget($args, $instance){
        extract($args);
                
        $title1 = (!empty($instance['title1'])) ? $instance['title1'] : 'Składniki i kuchnia';
        $title2 = (!empty($instance['title2'])) ? $instance['title2'] : 'Najbardziej popularne';
        $entries_count = (!empty($instance['entries_count'])) ? (int)$instance['entries_count'] : 5;
        
        $args = array(
            'orderby'    => 'count',
            'hide_empty' => 0,
            'number' => $entries_count
         );
        
        $terms_list = array(
            'ingredients' => get_terms('ingredients', $args),
            'cuisines' => get_terms('cousine-type', $args)
        );
        
        echo "
<style>
    .widget.{$this->widget_name}{
        overflow: hidden;
        margin-top: 40px;
    }


    .widget.{$this->widget_name} ul{
        float: left;
    }

    .widget.{$this->widget_name} .ingredients{
        width: 123px;
        margin-right: 10px;
    }
</style>";
        
        echo $before_widget;
        echo $before_title.$title1.$after_title;
        echo $before_title2.$title2.$after_title2;
                
        foreach($terms_list as $term_title => $list){
            echo '<ul class="icons-list '.$term_title.'">';
            
            foreach($list as $ingr){
                $url = get_term_link($ingr->slug, $ingr->taxonomy);
                $name = ucfirst(mb_strtolower($ingr->name));
                $css_class = getCssClass($ingr->name, $ingr->taxonomy);

                echo '<li class="'.$css_class.'"><a href="'.$url.'">'.$name.'</a></li>';
            }
            
            echo '</ul>';
        }
        
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

function lte_taxonomies2col_init(){
    register_widget('LoveToEat_Taxonomies2Col');
}

add_action('widgets_init', 'lte_taxonomies2col_init');

?>
