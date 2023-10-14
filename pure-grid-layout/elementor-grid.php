<?php

/*
Plugin Name: Pure Grid Layout
Plugin URI: https://shamimhasan.com
Description: Count Words from any WordPress Post
Version: 1.0
Author: Shamim
Author URI: https://shamimhasanshohid
License: GPLv2 or later
Text Domain: pure-grid-layout
Domain Path: /languages/
*/

class Elementor_Grid_Widget {
    public function __construct() {
        add_action('wp_enqueue_scripts', [$this, 'elementor_widget_dependencies']);
        add_action('elementor/widgets/register', [$this, 'load_grid_widgets']);
    }

    function load_grid_widgets($widgets_manager) {
        require_once(__DIR__ . '/widgets/widgets-grid.php');
        $widgets_manager->register(new \Grid_Widget);
    }

    function elementor_widget_dependencies() {
        wp_enqueue_style('grid-css', plugins_url('assets/css/grid-style.css', __FILE__), null, time());
    }
}

new Elementor_Grid_Widget();
