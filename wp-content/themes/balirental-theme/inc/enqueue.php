<?php
defined('ABSPATH') || exit;

function br_enqueue_assets() {
    $version = wp_get_theme()->get('Version');

     // Google Font
    wp_enqueue_style(
        'br-google-fonts',
        'https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap',
        [],
        null
    );
    
    wp_enqueue_style(
        'br-style',
        get_template_directory_uri() . '/dist/style.css',
        [],
        filemtime(get_template_directory() . '/dist/style.css'),
        'all'
    );

    wp_enqueue_style(
        'fontawesome',
        get_template_directory_uri() . '/assets/fontawesome/css/all.min.css',
        [],
        filemtime(get_template_directory() . '/assets/fontawesome/css/all.min.css'),
        'all'
    );

    wp_enqueue_script(
        'br-main',
        get_template_directory_uri() . '/dist/main.js',
        [],
        filemtime(get_template_directory() . '/dist/style.css'),
        true
    );

    wp_localize_script('br-main', 'BikeAPI', [
        'url' => esc_url_raw(rest_url('br/v1/bike')),
    ]);
}

add_action('wp_enqueue_scripts', 'br_enqueue_assets');