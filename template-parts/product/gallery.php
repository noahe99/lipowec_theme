<?php
if (!isset($args)) $args = [];
$kundentyp = $args['kundentyp'] ?? 'privat';

$gallery_field = $kundentyp === 'gastro' ? 'image_gallery_gastro' : 'image_gallery_privat';
$image_ids = get_field($gallery_field); // ACF-Gallery gibt IDs zurück (so einstellen!)
$video_url = get_field('video_url');

if (empty($image_ids)) {
  $image_ids = get_field('image_gallery_gastro');
}

if (empty($image_ids)) return;
?>

<?php if (count($image_ids) > 1): ?>
  <div class="container image-container mt-3">
    <div class="row align-items-start image-row">
      <!-- Hauptbild -->
      <div class="col-12 col-md-9 h-100 position-relative">
        <div class="main-image-wrapper h-100">
          <?php if (!empty($video_url)): ?>
            <video class="hero-bg-video" autoplay muted loop playsinline poster="<?= esc_url(wp_get_attachment_image_url($image_ids[0], 'large')) ?>" preload="none">
              <source src="<?= esc_url($video_url) ?>" type="video/mp4">
            </video>
          <?php else: ?>
            <?= wp_get_attachment_image($image_ids[0], 'large', false, [
              'class' => 'img-fluid h-100 w-100 object-fit-cover',
              'id'    => 'mainImage',
            ]); ?>
          <?php endif; ?>

          <button class="arrow arrow-left" aria-label="Vorheriges Bild"><i class="fa-solid fa-chevron-left"></i></button>
          <button class="arrow arrow-right" aria-label="Nächstes Bild"><i class="fa-solid fa-chevron-right"></i></button>
        </div>
      </div>

      <!-- Thumbnails (Desktop) -->
      <div class="col-3 h-100 d-none d-xl-flex flex-column thumbnail-column">
        <?php foreach ($image_ids as $id): ?>
          <?php render_image($id, 'thumb mb-2', 'medium'); ?>
        <?php endforeach; ?>
      </div>

      <!-- Thumbnails (Mobil) -->
      <div class="col-12 d-md-none image-scroll mt-2">
        <?php foreach ($image_ids as $id_mobile): ?>
          <?php render_image($id_mobile, 'thumb thumb-mobile', 'thumbnail'); ?>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
<?php endif; ?>

<?php if (count($image_ids) == 1): ?>
  <div class="container image-container mt-3">
    <div class="row align-items-start image-row">
      <div class="main-image-wrapper h-100">
        <?= wp_get_attachment_image($image_ids[0], 'large', false, [
          'class' => 'img-fluid h-100 w-100 object-fit-cover border rounded',
          'id'    => 'mainImage',
        ]); ?>
      </div>
    </div>
  </div>
<?php endif; ?>

<?php
// Für das JS: große URLs für das Hauptbild
$image_urls = array_map(fn($id) => esc_url(wp_get_attachment_image_url($id, 'full')), $image_ids);
?>
<script>

document.addEventListener('DOMContentLoaded', function () {
  const images = <?= json_encode($image_urls); ?>;
  const mainWrapper = document.querySelector('.main-image-wrapper');
  const videoUrl = <?= $video_url ? json_encode($video_url) : 'null'; ?>;
  const prevBtn = document.querySelector('.arrow-left');
  const nextBtn = document.querySelector('.arrow-right');
  const thumbs = document.querySelectorAll('.thumb');

  console.log(images);

  let currentIndex = 0;
  if (!mainWrapper || !images.length) return;

  function showVideo() {
    mainWrapper.innerHTML = `
      <video class="hero-bg-video" autoplay muted loop playsinline poster="${images[0]}">
        <source src="${videoUrl}" type="video/mp4">
      </video>`;
  }

  function showImage(index) {
    console.log("Display img with: ", index);
    mainWrapper.innerHTML = `
      <img src="${images[index]}" alt="Produktbild"
           class="img-fluid h-100 w-100 object-fit-cover border rounded"
           id="mainImage">`;
  }

  function isMobile() {
    return window.matchMedia("(max-width: 767px)").matches;
  }

  function updateMain(index, initial) {

    if (!initial) {
      if (isMobile()) {
        index = index - images.length;
      }
    }


    currentIndex = index;
    if (videoUrl && index === 0) showVideo();
    else showImage(index);
    thumbs.forEach((t, i) => t.classList.toggle('active', i === index));
  }

  prevBtn?.addEventListener('click', () => updateMain((currentIndex - 1 + images.length) % images.length));
  nextBtn?.addEventListener('click', () => updateMain((currentIndex + 1) % images.length));
  thumbs.forEach((t, i) => t.addEventListener('click', () => updateMain(i, false)));

  updateMain(0, true);
});
</script>
