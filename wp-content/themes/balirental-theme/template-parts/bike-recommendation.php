<?php

$current_post_id = get_the_ID();
$default = [
    'post_type' => 'bike',
    'posts_per_page' => 4,
    'paged' => 1,
    'post_status' => 'publish'
];

if($current_post_id){
    $default['post__not_in'] = [$current_post_id]; 
}
$query = new WP_Query($default);

if ($query->have_posts()) : ?>

<section class="bike-preview section">
    <div class="container">
        <h2 class="section__title has-text-align-center">Recommended Bikes for You</h2>
        <p class="section__description">Discover the best bikes that match your style and needs.</p>
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