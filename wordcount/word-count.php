<?php
/*
Plugin Name: Word Count
Plugin URI: https://shamimhasan.com
Description: Count Words from any WordPress Post
Version: 1.0
Author: Shamim
Author URI: https://shamimhasanshohid
License: GPLv2 or later
Text Domain: word-count
Domain Path: /languages/
*/



// function wordcount_activation_hook(){}
// register_activation_hook(__FILE__,"wordcount_activation_hook");


// function wordcount_deactivation_hook(){}
// register_deactivation_hook(__FILE__,"word_deactivatrion_hook");

function word_count_textdomain() {
    load_plugin_textdomain('word-count', false, dirname(__FILE__) . "/languages");
}
add_action("plugin_loaded", 'word_count_textdomain');


function wordcount_count_words($content) {
    $stripped_content = strip_tags($content);
    $wordn = str_word_count($stripped_content);
    $label = __('Total Number of Words');
    printf('<h1>%s</h1>', $wordn);
}
add_filter('the_content', 'wordcount_count_words');
