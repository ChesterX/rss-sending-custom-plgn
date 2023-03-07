<?php

/*
  Plugin Name: Activate RSS Thumbnail Images
  Description: Custom code for Activate RSS Thumbnail Images
  Version: 1.0
  License: A "Slug" license name e.g. GPL2
*/

defined('ABSPATH') or die('No script kiddies please!');

function add_custom_rss_image_size($content)
{
    global $post;

    // Check if the 'image' query parameter is set
    if (!isset($_GET['image'])) return $content;

    // Check image size
    $image_type = $_GET['image'];
    if ($image_type != 'thumbnail' && $image_type != 'full') return $content;

    // Set image size
    $image = get_the_post_thumbnail($post->ID, $image_type);
    if ($image) {
        $content = $image . $content;
    }

    return $content;
}

add_filter('the_excerpt_rss', 'add_custom_rss_image_size');
add_filter('the_content_feed', 'add_custom_rss_image_size');


// Update Checker
require_once plugin_dir_path( __FILE__ ) . 'inc/plugin-update-checker.php';
$myUpdateChecker = Puc_v4_Factory::buildUpdateChecker(
    'https://github.com/ChesterX/rss-sending-custom-plgn/',
    __FILE__,
    'rss-sending-custom-plgn'
);