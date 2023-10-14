<?php
/*
Plugin Name: post-to-qrcode
Plugin URI: https://shamimhasan.com
Description: Display QR Code under every post
Version: 1.0
Author: Shamim
Author URI: https://shamimhasanshohid
License: GPLv2 or later
Text Domain: post-qr-code
Domain Path: /languages/
*/



// function wordcount_activation_hook(){}
// register_activation_hook(__FILE__,"wordcount_activation_hook");


// function wordcount_deactivation_hook(){}
// register_deactivation_hook(__FILE__,"word_deactivatrion_hook");

function word_count_textdomain() {
    load_plugin_textdomain('post-qr-code', false, dirname(__FILE__) . "/languages");
}

function pqc_display_qr_code($content) {
    $current_post_id    = get_the_ID();
    $current_post_title = get_the_title($current_post_id);
    $current_post_url   = urlencode(get_the_permalink($current_post_id));
    $image_src          = sprintf('//api.qrserver.com/v1/create-qr-code/?data=%s', $current_post_url);
    $content            = sprintf('<div class="qrcode"><img src="%1$s" alt="%2$s" title="%2$s"/></div>', $image_src, $current_post_title);
    return $content;
}
add_filter('the_content', 'pqc_display_qr_code');
