<?php
/**
 * Template Name: Gastronomie
 */

 function enqueue_about_assets() {
  wp_enqueue_style('gastro-style', get_stylesheet_directory_uri() . '/assets/css/gastro.css');
}
add_action('wp_enqueue_scripts', 'enqueue_about_assets');


get_header();
?>

<?php $hero_images = get_field("hero_images"); ?>

<section id="gastroSlider" class="carousel slide carousel-fade gastro-slider mt-0" data-bs-ride="carousel">

  <!-- Indicators -->
  <div class="carousel-indicators">
    <?php foreach ($hero_images as $index => $image): ?>
      <button 
        type="button"
        data-bs-target="#gastroSlider"
        data-bs-slide-to="<?= $index; ?>"
        class="<?= $index === 0 ? 'active' : ''; ?>"
        <?= $index === 0 ? 'aria-current="true"' : ''; ?>>
      </button>
    <?php endforeach; ?>
  </div>

  <!-- Slides -->
  <div class="carousel-inner">

    <?php foreach ($hero_images as $index => $image): ?>
      <div class="carousel-item <?= $index === 0 ? 'active' : ''; ?>" 
           style="background-image: url('<?= esc_url($image); ?>');">

        <div class="overlay"></div>
        <div class="container h-100 d-flex align-items-end">
          <div class="gastro-caption mb-5">
            <h3 class="herotextbox mb-0">365 Tage Freiluftsaison</h3>
            <p class="subherotextbox mb-0">Umsatz auch bei schlechtem Wetter</p>
          </div>
        </div>

      </div>
    <?php endforeach; ?>
  </div>

</section>



<?php $productContent = get_field('content_products'); ?>

<div class="container mt-5">
  <div class="row gastro">
    <h1 class="fw-bold"><?=  $productContent[0]['headline']; ?></h1>
    <p><?= $productContent[0]['content'];  ?></p>
  </div>
</div>


<!--  PRODUCTS 1 --> 
<div class="container py-5">
  <?php 
  if( have_rows('products_1') ): ?>
      <div class="row g-4 pb-3">
          <?php 
          while( have_rows('products_1') ): the_row(); 

              $product_group = get_sub_field('product');

              $product = array(
                  'title' => $product_group['title'],
                  'info'  => $product_group['info'],
                  'image' => wp_get_attachment_image_url($product_group['img'], 'full'),
                  'link'  => $product_group['url']
              );

              $template = locate_template( 'template-parts/product-card.php' );
              if ($template) {
                  require $template;
              }
          endwhile; 
          ?>
      </div>
  <?php endif; ?>
</div>

<div class="container">
  <div class="row gastro mt-3">
    <h3 class="fw-semibold"><?=  $productContent[1]['headline']; ?></h3>
    <?= $productContent[1]['content'];  ?>
  </div>
</div>
    
<div class="container py-5">
  <div class="row text-center">
    <?php
      $icons = json_decode(get_field('icon_json'), true);

      foreach($icons as $icon)
      {
        echo '<div class="col-3 d-flex flex-column align-items-center">';
        echo '<img src="'. $icon['icon'] .'" class="mb-2" alt="icon">';
        echo '<p><strong>'. $icon['text'] .'</strong></p>';
        echo '</div>';
      }
    ?>
  </div>
</div>


<div class="container">
  <div class="row gastro">
    <h3 class="fw-semibold"><?=  $productContent[2]['headline']; ?></h3>
    <?= $productContent[2]['content'];  ?>
  </div>
</div>


<!-- PRODUCTS 2 -->

<div class="container py-5">
  <?php 
  if( have_rows('products_2') ): ?>
      <div class="row g-4 pb-3">
          <?php 
          while( have_rows('products_2') ): the_row(); 

              $product_group = get_sub_field('product');

              $product = array(
                  'title' => $product_group['title'],
                  'info'  => $product_group['info'],
                  'image' => wp_get_attachment_image_url($product_group['img'], 'full'),
                  'link'  => $product_group['url']
              );

              $template = locate_template( 'template-parts/product-card.php' );
              if ($template) {
                  require $template;
              }
          endwhile; 
          ?>
      </div>
  <?php endif; ?>
</div>    
  
<div class="container">
  <div class="row gastro">
    <h3 class="fw-semibold"><?=  $productContent[3]['headline']; ?></h3>
    <?= $productContent[3]['content'];  ?>
  </div>

  <div class="row gastro mt-3">
    <h3 class="fw-semibold"><?=  $productContent[4]['headline']; ?></h3>
    <?= $productContent[4]['content'];  ?>
  </div>
</div>

<!-- PRODUCCTS 3 -->

<div class="container py-5">
  <?php 
  if( have_rows('products_3') ): ?>
      <div class="row g-4 pb-3">
          <?php 
          while( have_rows('products_3') ): the_row(); 

              $product_group = get_sub_field('product');

              $product = array(
                  'title' => $product_group['title'],
                  'info'  => $product_group['info'],
                  'image' => wp_get_attachment_image_url($product_group['img'], 'full'),
                  'link'  => $product_group['url']
              );

              $template = locate_template( 'template-parts/product-card.php' );
              if ($template) {
                  require $template;
              }
          endwhile; 
          ?>
      </div>
  <?php endif; ?>
</div>    

<section class="py-5">
  <div class="container">
    <div class="row mb-3">
      <div class="col text-center">
        <h3 class="fw-semibold">Warum LIPOWEC der ideale Partner ist</h3>
        <p class="text-muted mt-1">Ihre Vorteile auf einen Blick</p>
      </div>
    </div>

    <div class="row g-4">
      <div class="col-md-6 col-lg-4">
        <div class="card-padding h-100 border rounded bg-white number-box" data-number="01">
          <h5 class="fw-bold">Langjährige Erfahrung</h5>
          <p class="mb-0">Wir kennen die Herausforderungen von Hoteliers und Gastronomen - von saisonalen Schwankungen bis hin zu technischen Anforderungen für große Terrassenflächen.</p>
        </div>
      </div>

      <div class="col-md-6 col-lg-4">
        <div class="card-padding h-100 border rounded bg-white number-box" data-number="02">
          <h5 class="fw-bold">Fundierte Marktkenntnisse</h5>
          <p class="mb-0">Lipowec arbeitet seit vielen Jahren mit Betrieben jeder Größe zusammen und weiß genau, welche Trends, Materialien und Systeme gefragt sind. Wir beraten Sie zielgerichtet und praxisnah.</p>
        </div>
      </div>

      <div class="col-md-6 col-lg-4">
        <div class="card-padding h-100 border rounded bg-white number-box" data-number="03">
          <h5 class="fw-bold">Alles aus einer Hand</h5>
          <p class="mb-0">Von der ersten Idee über die<br>Planung bis hin zur Montage und Nachbetreuung - Lipowec steht für komplette Projektrealisierung ohne Kompromisse.</p>
        </div>
      </div>

      <div class="col-md-6 col-lg-6">
        <div class="card-padding h-100 border rounded bg-white number-box" data-number="04">
          <h5 class="fw-bold">Hochwertige, langlebige Produkte</h5>
          <p class="mb-0">Unsere Lösungen sind robust, wartungsarm und auf lange Lebenszyklen ausgelegt. Das bedeutet: weniger Aufwand, mehr Stabilität, mehr Ertrag.</p>
        </div>
      </div>

      <div class="col-md-6 col-lg-6">
        <div class="card-padding h-100 border rounded bg-white number-box" data-number="05">
          <h5 class="fw-bold">Individuelle Lösungen statt Standardprodukte</h5>
          <p class="mb-0">Jeder Außenbereich ist anders. Wir entwickeln Systeme, die exakt zu Ihrem Betrieb, Ihrem Budget und Ihren architektonischen Anforderungen passen.</p>
        </div>
      </div>
    </div>
  </div>
</section>


<div class="container mt-5">
  <div class="row gastro">
    <h3 class="fw-semibold"><?=  $productContent[5]['headline']; ?></h3>
    <?= $productContent[5]['content'];  ?>
  </div>
</div>







<?php get_footer(); ?>