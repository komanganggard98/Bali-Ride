<?php
   $title = get_field('title');
   $image = get_field('image');
   $price = get_field('price');
   $transmission = get_field('transmission');
   $engine_cc = get_field('engine_cc');
   $colors = get_field('color');
   $description = get_field('description');
?>
<article class="card" itemscope itemtype="https://schema.org/Product">
  <a href="<?php the_permalink(); ?>" class="card__link">
  <div class="card__image">
      <?php if ($image) : ?>
      <img 
        src="<?php echo esc_url($image['sizes']['medium']); ?>"
        alt="<?php echo esc_attr($image['alt']); ?>"
      >
      <?php endif; ?>
  </div>
  </a>
  <div class="card__body">
    <a href="<?php the_permalink(); ?>" class="card__link">
      <div class="card__body-head">
        <p class="badge badge--primary"><?php echo esc_html($transmission->name); ?></p>
        <div class="colors">
          <?php foreach($colors as $key => $color):?>
            <?php if($key > 2):?>
            <div class="color" style="background-color:#e0f5f7; color:#0e7694; font-weight:600;>"><?php echo "+" . (count($colors) - ($key + 1)); ?></div>
            <?php  break; ?>
            <?php else: ?>
            <div class="color" style="background-color:<?php echo esc_html($color->name); ?>"></div>
            <?php endif; ?>
          <?php endforeach;?>
        </div>
      </div>
      <h3 class="card__title"><?php echo esc_html($title); ?></h3>
      <p class="card__price"><?php echo br_format_rupiah($price); ?></p>
      <p class="card__description"><?php echo esc_html($description); ?></p>
    </a>
  </div>
  <a href="<?php echo esc_url(br_whatsapp_message($title))?>" target="_blank" class="btn btn--green">Booking via WA</a>
</article>