<?php
get_header();
$title = get_field('title');
$image = get_field('image');
$price = get_field('price');
$transmission = get_field('transmission');
$engine_cc = get_field('engine_cc');
$colors = get_field('color');
$description = get_field('description');
?>
<section class="sngle">
  <div class="container">
    <div class="sngle__top grid grid--2">
      <div class="sngle__left">
        <?php if ($image) : ?>
        <img 
          src="<?php echo esc_url($image['sizes']['large']); ?>"
          alt="<?php echo esc_attr($image['alt']); ?>"
        >
        <?php endif; ?>
      </div>
      <div class="sngle__right">
        <h1><?php echo esc_html($title); ?></h1>
        <div class="sngle__right__content">
          <h2><?php echo br_format_rupiah(esc_html($price)); ?></h2>
          <div class="flex">
            <div class="sngle__right__content__item">
              <p class="sngle__right__content__title">Transmisi: </p>
              <p class="badge badge--primary"><?php echo esc_html($transmission->name); ?></p>
            </div>
            <div class="sngle__right__content__item">
              <p class="sngle__right__content__title">CC: </p>
              <p class="badge badge--primary"><?php echo esc_html($engine_cc); ?></p>
            </div>
          </div>
          <div class="sngle__right__content__item">
            <p class="sngle__right__content__title">Color: </p>
            <div class="colors">
              <?php foreach($colors as $key => $color):?>
                <div class="color" style="background-color:<?php echo esc_html($color->name); ?>"></div>
              <?php endforeach;?>
            </div>
          </div>
        </div>
        <a href="<?php echo esc_url(br_whatsapp_message($title)); ?>" target="_blank" class="btn btn--primary">
          Booking via WhatsApp
        </a>
      </div>
    </div>
    <div class="sngle__bottom">
      <h3>Description</h3>
      <p>
        <?php echo esc_html($description); ?>
      </p>
    </div>
  </div>
</section>

<!-- Recommendation -->
 <?php get_template_part('template-parts/bike-recommendation');?>
<!-- Recommendation -->

<?php
    get_footer(); 