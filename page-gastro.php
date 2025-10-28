<<<<<<< HEAD
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

<div class="container mt-5">

  <?php $content_1 = get_field('content_1'); ?>
  <div class="row gastro">
    <h1 class="fw-bold"><?= $content_1['headline'] ?></h1>
    <p><?= $content_1['content'] ?></p>
  </div>



  <?php $products_1 = json_decode( get_field('products_1'), true ); ?>

  <div class="row g-4 pb-3">
  <?php
    foreach($products_1 as $product)
    {
      $template = locate_template( 'template-parts/product-card.php' );
      if ($template) {
        require $template;
      }
    }
  ?>
  </div>


  <?php $content_2 = get_field('content_2'); ?>
  <div class="row text-align-center pt-5 gastro">
    <h3 class="fw-semibold" ><?= $content_2['headline'] ?></h3>
    <p><?= $content_2['content'] ?></p>
  </div>

    <div class="row text-center py-3">
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



  <?php $products_1 = json_decode( get_field('products_2'), true ); ?>
  <div class="row g-4 pb-3">
  <?php
    foreach($products_1 as $product)
    {
      $template = locate_template( 'template-parts/product-card.php' );
      if ($template) {
        require $template;
      }
    }
  ?>
  </div>
  
  
  <?php $content_3 = get_field('content_3'); ?>
  <div class="row text-align-center pt-5 gastro">
    <h3 class="fw-semibold" ><?= $content_3['headline'] ?></h3>
    <p><?= $content_3['content'] ?></p>
  </div>


  <?php $products_1 = json_decode( get_field('products_3'), true ); ?>
  <div class="row g-5">
  <?php
    foreach($products_1 as $product)
    {
      $template = locate_template( 'template-parts/product-card.php' );
      if ($template) {
        require $template;
      }
    }
  ?>
  </div>


  <?php $content_4 = get_field('content_4'); ?>
  <div class="row text-align-center py-5">
    <h3><?= $content_4['headline'] ?></h3>
    <p><?= $content_4['content'] ?></p>
  </div>



</div>



=======
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

<div class="container mt-5">

  <?php $content_1 = get_field('content_1'); ?>
  <div class="row gastro">
    <h1 class="fw-bold"><?= $content_1['headline'] ?></h1>
    <p><?= $content_1['content'] ?></p>
  </div>



  <?php $products_1 = json_decode( get_field('products_1'), true ); ?>

  <div class="row g-4 pb-3">
  <?php
    foreach($products_1 as $product)
    {
      $template = locate_template( 'template-parts/product-card.php' );
      if ($template) {
        require $template;
      }
    }
  ?>
  </div>


  <?php $content_2 = get_field('content_2'); ?>
  <div class="row text-align-center pt-5 gastro">
    <h3 class="fw-semibold" ><?= $content_2['headline'] ?></h3>
    <p><?= $content_2['content'] ?></p>
  </div>

    <div class="row text-center py-3">
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



  <?php $products_1 = json_decode( get_field('products_2'), true ); ?>
  <div class="row g-4 pb-3">
  <?php
    foreach($products_1 as $product)
    {
      $template = locate_template( 'template-parts/product-card.php' );
      if ($template) {
        require $template;
      }
    }
  ?>
  </div>
  
  
  <?php $content_3 = get_field('content_3'); ?>
  <div class="row text-align-center pt-5 gastro">
    <h3 class="fw-semibold" ><?= $content_3['headline'] ?></h3>
    <p><?= $content_3['content'] ?></p>
  </div>


  <?php $products_1 = json_decode( get_field('products_3'), true ); ?>
  <div class="row g-5">
  <?php
    foreach($products_1 as $product)
    {
      $template = locate_template( 'template-parts/product-card.php' );
      if ($template) {
        require $template;
      }
    }
  ?>
  </div>


  <?php $content_4 = get_field('content_4'); ?>
  <div class="row text-align-center py-5">
    <h3><?= $content_4['headline'] ?></h3>
    <p><?= $content_4['content'] ?></p>
  </div>



</div>



>>>>>>> master
<?php get_footer(); ?>