<?php
/**
 * Plugin Name: list-events-shortcode
 * Plugin URI: http://clftest.adm.arts.ubc.ca
 * Description: Assumes that you have "The Events Calendar" plugin installed and provides a shortcode to list the events on any page/post or widget are.
 * Author: Shaffiq Rahemtulla
 * Version: 0.5
 */

function list-events-shortcode($atts) {
  //check if events plugin exists else return
  $plugin = 'the-events-calendar/the-events-calendar.php';
  include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
  if ((is_plugin_active($plugin))){
    global $wp_widget_factory;
    
    extract(shortcode_atts(array(
        'widget_name' => 'TribeEventsListWidget',
        'title' => '',
        'category' => '',
        'limit' => 5
    ), $atts));
    
    $widget_name = wp_specialchars($widget_name);
    
    if (!is_a($wp_widget_factory->widgets[$widget_name], 'WP_Widget')):
        $wp_class = 'WP_Widget_'.ucwords(strtolower($class));
        
        if (!is_a($wp_widget_factory->widgets[$wp_class], 'WP_Widget')):
            return '<p>'.sprintf(__("%s: Widget class not found. Make sure this widget exists and the class name is correct"),'<strong>'.$class.'</strong>').'</p>';
        else:
            $class = $wp_class;
        endif;
    endif;
    
    ob_start();
    the_widget($widget_name, $instance, array('category' =>$category,'limit' =>$limit,'title' =>$title,'widget_id'=>'arbitrary-instance-'.$id,
        'before_widget' => '',
        'after_widget' => '',
        'before_title' => '',
        'after_title' => ''
    ));



    $output = ob_get_contents();
    ob_end_clean();
    return $output;
  }
  else return '<p>'.sprintf(__("%s: The Events Calendar plugin not found. Make sure this plugin is activated."),'<strong>'.$title.'</strong>').'</p>';

}
add_shortcode('list-events','list-events-shortcode'); 

?>