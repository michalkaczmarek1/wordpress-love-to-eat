<?php

/*
Plugin Name: LTE Recent Comments
Plugin URI: http://www.eduweb.pl/
Description: Ostatnio dodane komentarze w postaci listy. Copyright 2013.
Author: Eduweb
Version: 1.0
Author URI: http://www.eduweb.pl/
*/


class LoveToEat_RecentComments extends WP_Widget{
    
    private $widget_name = 'lte-recent-comments-widget';
    
    function __construct(){

        $widget_options = array(
            'classname' => $this->widget_name,
            'description' => 'Ostatnio dodane komentarze w postaci listy'
        );
        
        parent::__construct($this->widget_name, 'LoveToEat Najnowsze Komentarze', $widget_options);
    }
    
    function widget($args, $instance){
        extract($args);
                
        $title1 = (!empty($instance['title1'])) ? $instance['title1'] : 'Nowe komentarze';
        $title2 = (!empty($instance['title2'])) ? $instance['title2'] : 'Co myślą inni?';
        $comments_count = (!empty($instance['comments_count'])) ? (int)$instance['comments_count'] : 2;
        
        
        $recent_comments = fetchRecentComments($comments_count);
        
        
        echo "
<style>
    .widget.{$this->widget_name} section{
        position: relative;
        margin-bottom: 45px;
    }

     .widget.{$this->widget_name} section.last{
        margin-bottom: 0px;
    }

     .widget.{$this->widget_name} section header{
        margin-bottom: 20px;
        font-family: 'MuseoSlab500Regular';
        font-size: 16px;
        color: #170901;
    }

     .widget.{$this->widget_name} section header small{
        display: block;
        color: #858585;
        font-size: 14px;
    }

     .widget.{$this->widget_name} section img{
        -webkit-border-radius: 50%;
        border-radius: 50%;
        position: absolute;
        left: -80px;
        top: -10px
    }

     .widget.{$this->widget_name} section blockquote{
        font-style: italic;
    }
</style>";
        
        echo $before_widget;
        echo $before_title.$title1.$after_title;
        echo $before_title2.$title2.$after_title2;
        
        foreach($recent_comments as $comment){
            $date = new \DateTime($comment->comment_date_gmt);
            ?>
                <section>
                    <header>
                        <small><?php echo $comment->comment_author; ?> w dniu <?php echo $date->format('d.m.Y'); ?></small>
                        <?php echo $comment->post_title; ?>
                    </header>
                    <?php echo get_avatar($comment->user_id, 69); ?>
                    <blockquote>
                        <?php echo $comment->comment_content; ?>
                    </blockquote>
                </section>
            <?php
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

        <label for="<?php echo $this->get_field_id('comments_count') ?>">
            Ilość komentarzy:
            <select 
                name="<?php echo $this->get_field_name('comments_count') ?>"
                id="<?php echo $this->get_field_id('comments_count') ?>"
                >
                <?php
                    $opts = array(2, 3, 5);
                    $curr = (int)esc_attr($instance['comments_count']);
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

function lte_recent_comments_init(){
    register_widget('LoveToEat_RecentComments');
}

add_action('widgets_init', 'lte_recent_comments_init');

?>
