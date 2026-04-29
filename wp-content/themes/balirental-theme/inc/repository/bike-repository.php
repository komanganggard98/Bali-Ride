<?php

defined('ABSPATH') || exit;

function br_get_bikes($args = []) {

    $default = [
        'post_type'      => 'bike',
        'posts_per_page' => 10,
        'paged'          => 1,
        'post_status'    => 'publish',
        'search'         => '',
        'meta_query'     => []
    ];

    $args = wp_parse_args($args, $default);

    // Example filter ACF (transmission)
    if (!empty($args['transmission'])) {

        if (!isset($args['tax_query'])) {
            $args['tax_query'] = [];
        }

        $args['tax_query'][] = [
            'taxonomy' => 'bike-transmission',
            'field'    => 'name', // atau 'name' atau 'term_id'
            'terms' => sanitize_text_field($args['transmission']),
            'compare' => '='
        ];

    }

    // Example filter Taxonomy (colors) = Blue,Red,Yellow
    if (!empty($args['colors'])) {

        // taxonomy key = bike-color
        $colors = explode(',', sanitize_text_field($args['colors']));

        if (!isset($args['tax_query'])) {
            $args['tax_query'] = [];
        }

        $args['tax_query'][] = [
            'taxonomy' => 'bike-color',
            'field'    => 'name', // atau 'name' atau 'term_id'
            'terms'    => $colors,
            'operator' => 'IN'
        ];

    }

    // Sort price
    if (!empty($args['sort_price'])) {

        $args['meta_key'] = 'price';
        $args['orderby']  = 'meta_value_num';
        $args['order']    = strtolower($args['sort_price']) === 'desc' ? 'DESC' : 'ASC';

    }

    if ($args['search']) {
        $args['s'] = sanitize_text_field($args['search']);
    }

    $cache_key = 'bike_query_' . md5(serialize($args));

    $cached = br_cache_get($cache_key, 'bike');
    $status = 200;
    if ($cached !== false) {
        return $cached;
    }

    $query = new WP_Query($args);

    ob_start();

    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            get_template_part('template-parts/bike','card');
        }
    }else{
        if($args['paged'] == 1){
            get_template_part('./components/not_found');
            $status = 404;
        }
    }

    wp_reset_postdata();
    $html = ob_get_clean();

    $response = [
        'html' => $html,
        'has_more' => $query->max_num_pages > $args['paged'],
        'status' => $status,
    ];

    br_cache_set($cache_key, $response, 'bike', 3600);

    return rest_ensure_response($response);
}