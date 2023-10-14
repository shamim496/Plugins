<?php

/*
Plugin Name: Post Layout
Plugin URI: https://shamimhasan.com
Description: Count Words from any WordPress Post
Version: 1.0
Author: Shamim
Author URI: https://shamimhasanshohid
License: GPLv2 or later
Text Domain: post-layout
Domain Path: /languages/
*/

class Elementor_Layout_Widget {
    public function __construct() {
        add_action('elementor/widgets/register', [$this, 'load_layout_widget']);
        add_action('wp_enqueue_scripts', [$this, 'elementor_layout_dependencies']);
    }


    function load_layout_widget($widgets_manager) {
        require_once(__DIR__ . '/widgets/post-layout-widget.php');
        $widgets_manager->register(new \Layout_Widget);
    }

    function elementor_layout_dependencies() {
        wp_enqueue_style('layout-css', plugins_url('assets/css/style.css', __FILE__), null, time());
    }
}

new Elementor_Layout_Widget();
