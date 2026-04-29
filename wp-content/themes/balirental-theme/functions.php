<?php
// Prevent direct access
defined('ABSPATH') || exit;

require_once get_template_directory() . '/inc/setup.php';
require_once get_template_directory() . '/inc/security.php';
require_once get_template_directory() . '/inc/enqueue.php';
require_once get_template_directory() . '/inc/helper.php';

require_once get_template_directory() . '/inc/api/bike-controller.php';
require_once get_template_directory() . '/inc/cache/cache-manager.php';
require_once get_template_directory() . '/inc/cache/bike-cache.php';
require_once get_template_directory() . '/inc/repository/bike-repository.php';