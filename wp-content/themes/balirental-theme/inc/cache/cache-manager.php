<?php
defined('ABSPATH') || exit;

function br_cache_get($key, $group = 'br_cache') {
    return wp_cache_get($key, $group);
}

function br_cache_set($key, $data, $group = 'br_cache', $ttl = 3600) {
    return wp_cache_set($key, $data, $group, $ttl);
}

function br_cache_delete($key, $group = 'br_cache') {
    return wp_cache_delete($key, $group);
}