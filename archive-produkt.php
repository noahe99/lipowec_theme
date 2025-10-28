<?php
/**
 * Template for CPT Archive: Produkte
 */

get_header();

$term = get_queried_object(); // Für spätere SEO-Anpassungen falls nötig
?>

<div class="container py-5">

  <!-- Breadcrumbs -->
  <nav class="breadcrumbs mb-4">
    <a href="<?= esc_url(home_url('/')); ?>">Startseite</a> &gt;
    <span class="active">Produkte</span>
  </nav>

  <!-- Main Title -->
  <h1 class="fw-semibold h3 mb-4">Unsere Produkte</h1>

  <div class="row g-4">
    <?php if (have_posts()) : ?>
      <?php while (have_posts()) : the_post(); ?>

        <div class="col-12 col-sm-6 col-lg-3">
          <a href="<?php the_permalink(); ?>" class="text-decoration-none">
            <div class="card h-100 shadow-sm border-0">

              <?php if (has_post_thumbnail()) : ?>
                <div class="ratio ratio-1x1">
                  <?php the_post_thumbnail('medium', [
                    'class' => 'card-img-top object-fit-cover'
                  ]); ?>
                </div>
              <?php else : ?>
                <div class="ratio ratio-1x1 bg-light"></div>
              <?php endif; ?>

              <div class="card-body text-center">
                <h3 class="h6 text-dark fw-semibold mb-0">
                  <?php the_title(); ?>
                </h3>
              </div>

            </div>
          </a>
        </div>

      <?php endwhile; ?>
    <?php else : ?>

      <p>Aktuell keine Produkte verfügbar.</p>

    <?php endif; ?>
  </div>

  <!-- Pagination -->
  <div class="mt-5">
    <?php
    echo paginate_links([
      'mid_size' => 2,
      'prev_text' => '&laquo;',
      'next_text' => '&raquo;',
    ]);
    ?>
  </div>

</div>

<?php get_footer(); ?>
