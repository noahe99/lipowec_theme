<<<<<<< HEAD
<?php get_header(); ?>

<main class="container">
  <?php
    if (is_tax('produkt_kategorie')) {
          $term = get_queried_object();
          $ancestors = get_ancestors($term->term_id, 'produkt_kategorie');

          echo "<nav class='breadcrumbs mt-4'>";
          echo '<a href="' . esc_url(home_url('/')) . '">Startseite</a>';
          echo ' &gt; <a href="' . esc_url(home_url('/produkte')) . '">Produkte</a>';

          // Gib die Eltern der aktuellen Kategorie aus (in richtiger Reihenfolge)
          $ancestors = array_reverse($ancestors);
          foreach ($ancestors as $ancestor_id) {
              $ancestor = get_term($ancestor_id, 'produkt_kategorie');
              echo ' &gt; <a href="' . esc_url(get_term_link($ancestor)) . '">' . esc_html($ancestor->name) . '</a>';
          }

          // Aktueller Term
          echo ' &gt; <span class="active">' . esc_html($term->name) . '</span>';
          echo "</nav>";
      }
    ?>

    <?php if (have_posts()) : ?>
        <?php echo do_shortcode('[category_overview]'); ?>
    <?php else : ?>
        <p>Keine Produkte in dieser Kategorie gefunden.</p>
    <?php endif; ?>
</main>

<?php get_footer(); ?>
=======
<?php get_header(); ?>

<main class="container">
  <?php
    if (is_tax('produkt_kategorie')) {
          $term = get_queried_object();
          $ancestors = get_ancestors($term->term_id, 'produkt_kategorie');

          echo "<nav class='breadcrumbs mt-4'>";
          echo '<a href="' . esc_url(home_url('/')) . '">Startseite</a>';
          echo ' &gt; <a href="' . esc_url(home_url('/produkte')) . '">Produkte</a>';

          // Gib die Eltern der aktuellen Kategorie aus (in richtiger Reihenfolge)
          $ancestors = array_reverse($ancestors);
          foreach ($ancestors as $ancestor_id) {
              $ancestor = get_term($ancestor_id, 'produkt_kategorie');
              echo ' &gt; <a href="' . esc_url(get_term_link($ancestor)) . '">' . esc_html($ancestor->name) . '</a>';
          }

          // Aktueller Term
          echo ' &gt; <span class="active">' . esc_html($term->name) . '</span>';
          echo "</nav>";
      }
    ?>

    <?php if (have_posts()) : ?>
        <?php echo do_shortcode('[category_overview]'); ?>
    <?php else : ?>
        <p>Keine Produkte in dieser Kategorie gefunden.</p>
    <?php endif; ?>
</main>

<?php get_footer(); ?>
>>>>>>> master
