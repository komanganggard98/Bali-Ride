<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>

<meta charset="<?php bloginfo('charset'); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>

<header class="header">

    <div class="container">
        <div class="header__top">
            <div class="header__logo">
                <a href="<?php echo esc_url(home_url('/')); ?>">
                    <?php bloginfo('name'); ?>
                </a>
            </div>
    
            <button
                type="button"
                class="mobile-nav-button"
            >
                <i class="fa-solid fa-bars"></i>
            </button>
        </div>

        <nav class="header__nav">
            <?php
            wp_nav_menu([
                'theme_location' => 'primary',
                'container' => false,
                'menu_class' => 'menu'
            ]);
            ?>
        </nav>

    </div>

</header>

<main class="site-main">