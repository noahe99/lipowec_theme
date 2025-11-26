<?php
/**
 * Template Name: Category
 */

 function enqueue_category_assets() {
  wp_enqueue_style('category-style', get_stylesheet_directory_uri() . '/assets/css/category.css');
}
add_action('wp_enqueue_scripts', 'enqueue_category_assets');

get_header();
?>


<?php the_content(  ) ?> <!-- use for ad banner etc. -->
<div class="container-lg">

  

  <?php 
    $json_file = get_field('product_display_json');
    $json_path = get_template_directory() . $json_file;

    $json_data = json_decode(file_get_contents( $json_path ), true);
  ?>

<?php foreach ($json_data as $category_group): ?>
  <?php foreach ($category_group as $category): ?>
    <section class="mb-5 mt-5">
      <div class="row mb-4 align-items-center justify-content-between">
        <div class="col-md-auto">
          <h2 class="fw-bold h3 mb-1"><?php echo $category['category_name']; ?></h2>
          <p class="text-muted mb-0"><?php echo $category['category_paragraph']; ?></p>
        </div>
        <div class="col-md-auto text-md-end mt-3 mt-md-0">
          <a href="<?=  $category['categor_url'] ?>" class="text-primary text-decoration-none fw-medium">
            Alle Produkte der Kategorie</i>
          </a>
        </div>
      </div>

      <div class="row g-4">
        <?php 
          foreach ($category['products'] as $product) {
            $template = locate_template('/template-parts/product-card.php');
            if ($template) {
              require $template;
            }
          }
        ?>
      </div>
    </section>
  <?php endforeach; ?>
<?php endforeach; ?>





</div>




<?php get_footer(); ?>