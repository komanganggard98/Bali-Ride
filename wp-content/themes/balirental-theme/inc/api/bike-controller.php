<?php

defined('ABSPATH') || exit;

function br_register_bike_rest_route() {

    register_rest_route('br/v1', '/bike', [
        'methods'  => 'GET',
        'callback' => 'br_rest_get_bikes',
        'args' => [
            'category' => [
                'required' => false,
            ],
            'paged' => [
                'required' => false,
            ],
            'posts_per_page' => [
                'required' => false,
            ],
            'search' => [
                'required' => false,
            ],
        ]
    ]);

}

add_action('rest_api_init', 'br_register_bike_rest_route');


function br_rest_get_bikes($request) {

    $transmission = sanitize_text_field($request->get_param('transmission'));
    $colors = sanitize_text_field($request->get_param('colors'));
    $sort_price = sanitize_text_field($request->get_param('sort_price'));
    $paged = (int) ($request->get_param('paged') ?: 1);
    $posts_per_page = (int) ($request->get_param('posts_per_page') ?: 10);
    $search = $request->get_param('search');

    $args = [
        'post_type' => 'bike',
        'posts_per_page' => $posts_per_page,
        'paged' => $paged,
        'search' => $search,
        'transmission' => $transmission,
        'colors' => $colors,
        'sort_price' => $sort_price
    ];

    return rest_ensure_response(
        br_get_bikes($args)
    );

}