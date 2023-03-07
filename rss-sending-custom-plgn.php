<?php
/*
  Plugin Name: Activate RSS Thumbnail Images
  Description: Custom code for Activate RSS Thumbnail Images
  Version: 1.4
  License: A "Slug" license name e.g. GPL2
*/

defined('ABSPATH') or die('No script kiddies please!');

function add_custom_rss_image_size($content)
{
    if ($_GET['image'] != 'thumbnail' && $_GET['image'] != 'full')
        return $content;

    global $post;
    // Set image size
    $image = get_the_post_thumbnail($post->ID, $_GET['image']);
    if ($image) {
        $content = $image . $content;
    }

    return $content;
}

// Check if the 'image' query parameter is set
if (isset($_GET['image'])) {
    add_filter('the_excerpt_rss', 'add_custom_rss_image_size');
    add_filter('the_content_feed', 'add_custom_rss_image_size');
}

// Update Checker
require 'plugin-update-checker/plugin-update-checker.php';

use YahnisElsts\PluginUpdateChecker\v5\PucFactory;

$myUpdateChecker = PucFactory::buildUpdateChecker(
    'https://github.com/ChesterX/rss-sending-custom-plgn',
    __FILE__,
    'rss-sending-custom-plgn'
);

$myUpdateChecker->setBranch('main');
