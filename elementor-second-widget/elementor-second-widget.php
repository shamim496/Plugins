<?php

/*
Plugin Name: Elementor Second Widget
Plugin URI: https://shamimhasan.com
Description: Count Words from any WordPress Post
Version: 1.0
Author: Shamim
Author URI: https://shamimhasanshohid
License: GPLv2 or later
Text Domain: elementor-widget
Domain Path: /languages/
*/


add_action('elementor/widgets/rergister', 'load_second_widgets');

function load_second_widgets($widgets_manager) {
    require_once(__DIR__ . 'widgets/second-widget.php');
    $widgets_manager->register(new \Second_Widget);
}


add_action('wp_enqueue_scripts', 'elementor_widget_denpend');

function elementor_widget_denpend() {
    wp_enqueue_style('uikit-css', plugins_url('assset/css/uikit.css', __FILE__), null,);
    wp_enqueue_style('first-widget-css', plugins_url('assets/css/first-widget.css', __FILE__), null, time());
}
