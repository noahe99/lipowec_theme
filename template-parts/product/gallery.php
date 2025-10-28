<?php

/**
 * Tempalte Part: Product Gallery
 * 
 * @param
 * &args['kundentyp'] = 'privat' | 'gastro'
 */


if (!isset($args)) $args = [];
$kundentyp = $args['kundentyp'] ?? 'privat';

// retrieve image gallery
$gallery_field = $kundentyp === 'gastro' ? 'image_gallery_gastro' : 'image_gallery_privat';
$images = get_field($gallery_field);
$video_url = get_field('video_url');



// Fallbacks
if (empty($images)) {
  $images = get_field('image_gallery_gastro'); // if product only relevant for gastro
}

if (empty($images)) {
  return;
}
?>

<?php if (sizeof($images) > 1): ?> <!-- only display thumbnails if images > 1 -->

  <div class="container image-container mt-3">
    <div class="row align-items-start image-row">
      <!-- Hauptbild -->
      <div class="col-12 col-md-9 h-100 position-relative">
        <div class="main-image-wrapper h-100">
          <?php if (!empty($video_url)): ?>
              <video class="hero-bg-video" autoplay muted loop playsinline poster="<?= $images[0]['url']  ?>">
                <source src="<?= $video_url ?>" type="video/mp4">
                Dein Browser unterstützt kein HTML5-Video.
              </video>
          <?php else: ?>

            <img
            src="<?= esc_url($images[0]['url']); ?>"
            alt="<?= esc_attr($images[0]['alt']); ?>"
            class="img-fluid h-100 w-100 object-fit-cover border rounded"
            id="mainImage">

          <?php endif; ?>

          <button class="arrow arrow-left" aria-label="Vorheriges Bild">
            <i class="fa-solid fa-chevron-left"></i>
          </button>

          <button class="arrow arrow-right" aria-label="Nächstes Bild">
            <i class="fa-solid fa-chevron-right"></i>
          </button>
        </div>
      </div>

      <!-- Thumbnails (Desktop) -->
      <div class="col-3 h-100 d-none d-xl-flex flex-column thumbnail-column">
        <?php foreach ($images as $image): ?>
          <img
            src="<?= esc_url($image['url']); ?>"
            alt="<?= esc_attr($image['alt']); ?>"
            class="thumb mb-2">
        <?php endforeach; ?>
      </div>

      <!-- Thumbnails (Mobil) -->
      <div class="col-12 d-md-none image-scroll mt-2">
        <?php foreach ($images as $image): ?>
          <img
            src="<?= esc_url($image['url']); ?>"
            alt="<?= esc_attr($image['alt']); ?>"
            class="thumb thumb-mobile">
        <?php endforeach; ?>
      </div>
    </div>
  </div>
<?php endif; ?>

<!-- only display one big image --> 
<?php if (sizeof($images) == 1) : ?>
  <div class="container image-container mt-3">
    <div class="row align-items-start image-row">
      <div class="main-image-wrapper h-100">
        <img
          src="<?= esc_url($images[0]['url']); ?>"
          alt="<?= esc_attr($images[0]['alt']); ?>"
          class="img-fluid h-100 w-100 object-fit-cover border rounded"
          id="mainImage">
      </div>
    </div>
  </div>
  </div>
<?php endif; ?>

<?php $image_urls = array_map(fn($img) => esc_url($img['url']), $images); ?>
<script>
document.addEventListener('DOMContentLoaded', function () {
  const images = <?= json_encode($image_urls); ?>;
  const mainWrapper = document.querySelector('.main-image-wrapper');
  const videoUrl = <?= $video_url ? json_encode($video_url) : 'null'; ?>;
  const prevBtn = document.querySelector('.arrow-left');
  const nextBtn = document.querySelector('.arrow-right');
  const thumbs = document.querySelectorAll('.thumb');

  console.log(thumbs.length);
  let currentIndex = 0;

  if (!mainWrapper || !images.length) return;

  // 1st pic should not autoply image

  function showVideo() {
    mainWrapper.innerHTML = `
      <video class="hero-bg-video" autoplay muted loop playsinline poster="${images[0]}">
        <source src="${videoUrl}" type="video/mp4">
      </video>
    `;
  }

  function showImage(index) {
    mainWrapper.innerHTML = `
      <img
        src="${images[index]}"
        alt="Produktbild"
        class="img-fluid h-100 w-100 object-fit-cover border rounded"
        id="mainImage">
    `;
  }

  function updateMain(index) {
    currentIndex = index;

    if (videoUrl && index === 0) {
      showVideo();
    } else {
      showImage(index);
    }

    thumbs.forEach((thumb, i) => {
      thumb.classList.toggle('active', i === index);
    });
  }

  if (prevBtn) {
    prevBtn.addEventListener('click', () => {
      const newIndex = (currentIndex - 1 + images.length) % images.length;
      updateMain(newIndex);
    });
  }

  if (nextBtn) {
    nextBtn.addEventListener('click', () => {
      const newIndex = (currentIndex + 1) % images.length;
      updateMain(newIndex);
    });
  }

  if (thumbs.length > 0) {
    thumbs.forEach((thumb, index) => {
      thumb.addEventListener('click', () => updateMain(index));
    });
  }


  
  updateMain(0);
});

</script>
