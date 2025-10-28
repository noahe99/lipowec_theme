<<<<<<< HEAD
<?php
/**
 * Template Name: Category Overview
 */

function enqueue_category_assets() {
    wp_enqueue_style('category-ov-style', get_stylesheet_directory_uri() . '/assets/css/category-ov.css');
}
add_action('wp_enqueue_scripts', 'enqueue_category_assets');

get_header();
?>

<div class="container">
  <?php the_content( );  ?>
</div>


<?php get_footer(); ?>
=======
<?php
/**
 * Template Name: Category Overview
 */

function enqueue_category_assets() {
    wp_enqueue_style('category-ov-style', get_stylesheet_directory_uri() . '/assets/css/category-ov.css');
}
add_action('wp_enqueue_scripts', 'enqueue_category_assets');

get_header();
?>

<div class="container">
  <?php the_content( );  ?>
</div>


<?php get_footer(); ?>
>>>>>>> master
