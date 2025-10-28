<?php
/**
 * Template Name: About Us
 */

 function enqueue_about_assets() {
  wp_enqueue_style('about-style', get_stylesheet_directory_uri() . '/assets/css/about.css');
}
add_action('wp_enqueue_scripts', 'enqueue_about_assets');


get_header();
?>


<main>

<div class="container mt-5">
  <?php the_content() ?>
</div>

<?php get_footer() ?>
