<?php

/*
Plugin Name: LTE Recent Entries
Plugin URI: http://www.eduweb.pl/
Description: Najnowsze wpisy. Copyright 2013.
Author: Eduweb
Version: 1.0
Author URI: http://www.eduweb.pl/
*/


class LoveToEat_RecentEntries extends WP_Widget{
    
    function __construct(){

        $widget_options = array(
            'classname' => 'lte-recent-entries-widget',
            'description' => 'Najnowsze wpisy'
        );
        
        parent::__construct('lte-recent-entries-widget', 'LoveToEat Najnowsze Wpisy', $widget_options);
    }
    
    function widget($args, $instance){
        
        extract($args);
                
        $title1 = (!empty($instance['title1'])) ? $instance['title1'] : 'Najnowsze wpisy';
        $title2 = (!empty($instance['title2'])) ? $instance['title2'] : 'Jeszcze ciepłe';
        
        $entries_count = (!empty($instance['entries_count'])) ? (int)$instance['entries_count'] : 5;
        $entry_type = (!empty($instance['entry_type'])) ? $instance['entry_type'] : 'post';
        
        
        echo $before_widget;
        echo $before_title.$title1.$after_title;
        echo $before_title2.$title2.$after_title2;
        
        
        $loop = new WP_Query(array(
                    'post_type' => $entry_type,
                    'posts_per_page' => $entries_count
                ));
        
        if(!$loop->have_posts()){
            echo '<p>Brak wpisów</p>';
        }else{
            
            echo '<ul>';
            while($loop->have_posts()){
                $loop->the_post();
                
                ?><li><a href="<?php the_permalink(); ?>"><?php the_title() ?></a></li><?php
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
        <br/>
        <label for="<?php echo $this->get_field_id('title2') ?>">
            Nagłówek 2:
            <input 
                type="text" 
                name="<?php echo $this->get_field_name('title2') ?>"
                id="<?php echo $this->get_field_id('title2') ?>"
                value="<?php echo esc_attr($instance['title2']); ?>" />
        </label>
        <br/>
        <label for="<?php echo $this->get_field_id('entry_type') ?>">
            Typ wpisów:
            <select 
                name="<?php echo $this->get_field_name('entry_type') ?>"
                id="<?php echo $this->get_field_id('entry_type') ?>"
                >
                <?php
                
                    $entries_types_list = get_post_types(NULL, 'object');
                    $exclude = array('attachment', 'revision', 'nav_menu_item');
                    
                    $curr_type = $instance['entry_type'];
                    
                    foreach($entries_types_list as $type){
                        $name = $type->name;
                        if(!in_array($name, $exclude)){
                            $label = $type->labels->name;
                            if($curr_type == $name){
                                echo '<option selected="selected" value="'.$name.'">'.$label.'</selected>';
                            }else{
                                echo '<option value="'.$name.'">'.$label.'</selected>';
                            }
                        }
                    }
                ?>
            </select>
        </label>
        <br/>
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

function lte_recent_entries_init(){
    register_widget('LoveToEat_RecentEntries');
}

add_action('widgets_init', 'lte_recent_entries_init');

?>
