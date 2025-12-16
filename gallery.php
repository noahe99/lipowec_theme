<?php

/**
 * Template Name: Gallerie
 */

wp_enqueue_style('gallery-style', get_stylesheet_directory_uri() . '/assets/css/gallery.css');

get_header();

?>

<?php $galleries = get_field('gallery') ?>




<div class="container py-5">

  <?php foreach ($galleries as $gallery): ?>
    <?php $images = $gallery['images']; ?>

    <div class="mb-5">
      <?= $gallery['gallery_content']; ?>

      <div class="row g-3">
        <?php foreach ($images as $image): ?>
          <div class="col-6 col-md-4 col-lg-3 text-center">

            <a
              href="<?= esc_url($image['image']['url']); ?>"
              class=l"glightbox d-block"
              data-gallery="gallery-<?= esc_attr($gallery['gallery_content']); ?>">
              <img
                src="<?= esc_url($image['image']['url']); ?>"
                alt="<?= esc_attr($image['image']['alt'] ?? ''); ?>"
                class="gallery-img img-fluid">
            </a>


          </div>
        <?php endforeach; ?>
      </div>
    </div>

  <?php endforeach; ?>

  <div class="row g-3">
  <?php
    
    $bulk_images = get_field('images_bulk');
            
    foreach($bulk_images as $image):
  ?>
  <div class="col-6 col-md-4 col-lg-3 text-center">
    <a
      href="<?= esc_url($image['url'])?>"
      class="glightbox d-block"
      data-gallery="gallery-<?= esc_attr($gallery['gallery_content']); ?>">
      <img
        src="<?= esc_url($image['url']); ?>"
        alt="<?= esc_attr($image['alt'] ?? ''); ?>"
        class="gallery-img img-fluid">
    </a>
  </div>
  <?php endforeach; ?>
  </div>


  <p class="pt-3"><strong>Experten-Tipp:</strong> Nutzen Sie die kostenlose Fachberatung von LIPOWEC Gastrostar direkt bei Ihnen vor Ort! 
    Fordern Sie Ihr maßgeschneidertes Angebot an!<br>
    <a href="/kontaktieren-sie-uns/">>>>> kostenloses Angebot anfordern</a>
  </p>

</div>


<style>
  .gallery-img {
    height: 240px;
    width: 100%;
    object-fit: cover;
    border-radius: 4px;
    transition: transform 0.2s ease;
  }

  .gallery-img:hover {
    transform: scale(1.03);
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
  }


  .gallery-caption {
    font-size: 0.9rem;
    color: #555;
  }
</style>





<?php get_footer(); ?>