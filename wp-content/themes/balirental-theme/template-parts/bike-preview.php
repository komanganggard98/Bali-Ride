<?php

$default = [
    'post_type' => 'bike',
    'posts_per_page' => 4,
    'paged' => 1,
    'post_status' => 'publish',
    'orderby'        => 'date',
    'order'          => 'DESC', // terbaru dulu
];
$query = new WP_Query($default);

if ($query->have_posts()) : ?>

<section class="bike-preview section">
    <div class="container">
        <h2 class="section__title has-text-align-center">Available Bikes for Rent</h2>
        <p class="section__description">Browse our selection of scooters and motorbikes available for rent in Bali.</p>
        <div class="grid grid--4">

            <?php while ($query->have_posts()) : $query->the_post(); ?>
                <?php get_template_part('template-parts/bike-card'); ?>
            <?php endwhile; ?>

        </div>

        <div class="btn__all-container">
            <a href="<?php echo esc_url(get_post_type_archive_link('bike')); ?>" class="btn btn--secondary">
                View All Bikes
            </a>
        </div>

    </div>
</section>

<?php endif;

wp_reset_postdata();