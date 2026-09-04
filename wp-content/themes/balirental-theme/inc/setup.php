<?php
defined('ABSPATH') || exit;

/**
 * Theme Setup
 */
function br_setup() {

    // Title tag support
    add_theme_support('title-tag');

    // Featured image
    add_theme_support('post-thumbnails');

    // HTML5 markup
    add_theme_support('html5', [
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
    ]);

    // Custom logo
    add_theme_support('custom-logo');

    // Register Menu
    register_nav_menus([
        'primary' => __('Primary Menu', 'br'),
        'footer'  => __('Footer Menu', 'br'),
    ]);

    // Image size
    add_image_size('br-thumb', 400, 300, true);
}
add_action('after_setup_theme', 'br_setup');

function br_fix_bike_active($classes, $item) {

    if (is_post_type_archive('bike') && $item->url == get_post_type_archive_link('bike')) {
        $classes[] = 'current-menu-item';
    }

    return $classes;
}
add_filter('nav_menu_css_class', 'br_fix_bike_active', 10, 2);
