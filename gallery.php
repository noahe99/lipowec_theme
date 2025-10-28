<<<<<<< HEAD
<?php
/**
 * Template Name: Gallerie
 */

 wp_enqueue_style('gallery-style', get_stylesheet_directory_uri() . '/assets/css/gallery.css');

 get_header();

?>

<?php $galleries = get_field('gallery') ?>


<?php
  foreach($galleries as $gallery) {
    echo "<script>console.log('". json_encode($gallery['images'][0]) ."')</script>";
  }
?>

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
              class="glightbox d-block" 
              data-gallery="gallery-<?= esc_attr($gallery['gallery_content']); ?>"
            >
              <img 
                src="<?= esc_url($image['image']['url']); ?>" 
                alt="<?= esc_attr($image['image']['alt'] ?? ''); ?>" 
                class="gallery-img img-fluid"
              >
            </a>

            <?php if (!empty($image['text'])): ?>
              <p class="gallery-caption small mt-2 mb-0">
                <?= esc_html($image['text']); ?>
              </p>
            <?php endif; ?>

          </div>
        <?php endforeach; ?>
      </div>
    </div>

  <?php endforeach; ?>

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
  box-shadow: 0 6px 12px rgba(0,0,0,0.15);
}


.gallery-caption {
  font-size: 0.9rem;
  color: #555;
}
</style>





=======
<?php
/**
 * Template Name: Gallerie
 */

 wp_enqueue_style('gallery-style', get_stylesheet_directory_uri() . '/assets/css/gallery.css');

 get_header();

?>

<?php $galleries = get_field('gallery') ?>


<?php
  foreach($galleries as $gallery) {
    echo "<script>console.log('". json_encode($gallery['images'][0]) ."')</script>";
  }
?>

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
              class="glightbox d-block" 
              data-gallery="gallery-<?= esc_attr($gallery['gallery_content']); ?>"
            >
              <img 
                src="<?= esc_url($image['image']['url']); ?>" 
                alt="<?= esc_attr($image['image']['alt'] ?? ''); ?>" 
                class="gallery-img img-fluid"
              >
            </a>

            <?php if (!empty($image['text'])): ?>
              <p class="gallery-caption small mt-2 mb-0">
                <?= esc_html($image['text']); ?>
              </p>
            <?php endif; ?>

          </div>
        <?php endforeach; ?>
      </div>
    </div>

  <?php endforeach; ?>

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
  box-shadow: 0 6px 12px rgba(0,0,0,0.15);
}


.gallery-caption {
  font-size: 0.9rem;
  color: #555;
}
</style>





>>>>>>> master
<?php get_footer(); ?>