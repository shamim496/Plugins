<?php

/*
Plugin Name: Elementor Widget
Plugin URI: https://shamimhasan.com
Description: Count Words from any WordPress Post
Version: 1.0
Author: Shamim
Author URI: https://shamimhasanshohid
License: GPLv2 or later
Text Domain: elementor-widget
Domain Path: /languages/
*/


add_action('elementor/widgets/register', 'load_widgets');

function load_widgets($widgets_manager) {
    require_once(__DIR__ . '/widgets/first-widget.php');
    $widgets_manager->register(new \First_Widget);
}


add_action('wp_enqueue_scripts', 'elementor_widget_dependencies');

function elementor_widget_dependencies() {
    wp_enqueue_style('uikit-css', plugins_url('assets/css/uikit.min.css', __FILE__), null,);
    wp_enqueue_style('first-widget-css', plugins_url('assets/css/first-widget.css', __FILE__), null, time());
}
