<?php

defined('ABSPATH') || exit;

function br_clear_bike_cache($post_id) {

    if (get_post_type($post_id) !== 'bike') {
        return;
    }

    wp_cache_flush_group('bike');

}

add_action('save_post_bike', 'br_clear_bike_cache');
add_action('deleted_post', 'br_clear_bike_cache');