<?php
get_header();

$transmission = get_terms([
    'taxonomy' => 'bike-transmission',
    'hide_empty' => true,
]);

$bike_colors = get_terms([
    'taxonomy' => 'bike-color',
    'hide_empty' => true,
]);

$paged = get_query_var('paged') ? get_query_var('paged') : 1;
$post_per_page = 8;
$args = [
    'post_type'      => 'bike',
    'posts_per_page' => $post_per_page,
    'paged'          => $paged,
];

$query = new WP_Query($args);

?>

<section class="bikes">
    <div class="container">
        <!-- HEADER SECTION -->
        <header class="bikes__header">
            <section class="bikes__header__top">
                <h1><?php post_type_archive_title(); ?></h1>
                <!-- FILTER -->
                <div class="bikes__filter">
                    <div>
                        <input type="text" class="bikes__search" placeholder="search bike .." id="bike-search"/>
                    </div>
                    <button
                        type="button"
                        class="btn btn--outline"      
                        id="bike-filter-form-btn"              
                    >
                        <i class="fa-solid fa-filter"></i>
                        Filter
                    </button>
                </div>
            </section>
            <section class="bikes__header__bottom" id="bike-filter-form">
                <div class="bikes__filter__container">
                    <div class="bikes__filter__item">
                        <p class="bikes__filter__item__label">Color</p>
                        <div class="colors__input">
                            <?php foreach($bike_colors as $color): ?>
                                <button
                                    type="button"
                                    data-type="color-input"
                                    data-value="<?php echo esc_html($color->name); ?>"
                                    class="btn btn--sm btn--outline"
                                >
                                    <span style="background-color:<?php echo esc_html($color->name); ?>"></span> <?php echo esc_html($color->name); ?>
                                </button>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <div class="bikes__filter__item">
                        <p class="bikes__filter__item__label">Price</p>
                        <div class="price__input">
                            <button
                                type="button"
                                data-type="price-input"
                                data-value="asc"
                                class="btn btn--sm btn--outline"
                            >
                                <i class="fa-solid fa-arrow-up"></i>
                                Low to High
                            </button>
                            <button
                                type="button"
                                data-type="price-input"
                                data-value="desc"
                                class="btn btn--sm btn--outline"
                            >
                                <i class="fa-solid fa-arrow-down"></i>
                                High to Low 
                            </button>
                        </div>
                    </div>
                    <div class="bikes__filter__item">
                        <p class="bikes__filter__item__label">Transmission</p>
                        <div class="transmission__input">
                            <button
                                type="button"
                                data-type="transmission-input"
                                data-value="Manual"
                                class="btn btn--sm btn--outline"
                            >
                                Manual
                            </button>
                            <button
                                type="button"
                                data-type="transmission-input"
                                data-value="Matic"
                                class="btn btn--sm btn--outline"
                            >
                                Matic 
                            </button>
                        </div>
                    </div>
                </div>
                <div class="bikes__filter__btn__container">
                    <button
                        type="button"
                        class="btn btn--primary"      
                        id="bike-apply-filter-btn"              
                    >
                        Apply Filter
                    </button>
                </div>
            </section>
        </header>
    
        <!-- BIKE LIST -->
        <div id="bike-list" class="grid grid--4">
    
            <?php if ($query->have_posts()): ?>
                <?php while ($query->have_posts()): $query->the_post(); ?>
                    <?php get_template_part('template-parts/bike','card'); ?>
                <?php endwhile; ?>
            <?php else: ?>
                <?php get_template_part('./components/not_found'); ?>
            <?php endif; ?>
    
        </div>
        
        
        <div id="bike-loader" style="display:none;">
            <?php get_template_part('./components/loading'); ?>
        </div>
    </div>
    <div id="bike-sentinel"></div>
</section>

<script>
window.bikeSettings = {
    currentPage: <?php echo $paged; ?>,
    postPerPage: <?php echo $post_per_page; ?>,
    hasMore: <?php echo ($paged < $query->max_num_pages ? 1 : 0); ?>,
};
</script>

<?php
    wp_reset_postdata();
    get_footer(); 