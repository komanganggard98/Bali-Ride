<?php
// Disable XML-RPC
add_filter('xmlrpc_enabled', '__return_false');

// Hide WP version
remove_action('wp_head', 'wp_generator');

// Disable file editing
define('DISALLOW_FILE_EDIT', true);