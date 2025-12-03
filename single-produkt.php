<?php

function enqueue_single_product_styles()
{
    wp_enqueue_style('single-product-style', get_stylesheet_directory_uri() . '/assets/css/single-produkt.css');
    wp_enqueue_script('single-product-script', get_stylesheet_directory_uri() . '/assets/js/single-product.js', array('jquery'), null, true);
}
add_action('wp_enqueue_scripts', 'enqueue_single_product_styles');

$kundentyp = $_COOKIE['kundentyp'] ?? 'privat';

get_header(); 

?>

<main class="produkt-wrap mt-3">

    <div class="container">
        <?php
            get_template_part('template-parts/product/breadcrumbs', null);
            get_template_part('template-parts/product/header', null);
        ?>
    </div> <!-- /container -->


    <?php
    get_template_part('template-parts/product/gallery', null, ['kundentyp' => $kundentyp]);
    ?>

    <div class="container">
        <?php if (get_field('has_gastro_info')) : ?>
            <div class="row">
                <div class="col-12 col-md-9">
                    <div class="row d-flex align-items-center justify-content-between my-4 switch-section">
                        <div class="col-auto d-flex align-items-center">
                            <p class="mb-0 fw-semibold">Informationen anzeigen für</p>
                        </div>
                        <div class="col-auto">
                            <div class="switch-toggle">
                                <input class="switch-toggle-checkbox" type="checkbox" id="gastro-info-switch" />
                                <label class="switch-toggle-label" for="gastro-info-switch">
                                    <span>Privatkunden</span>
                                    <span>Gastrokunden</span>
                                </label>
                            </div>
                        </div>
                    </div> <!-- /row d-flex -->
                </div> <!-- /col-12 -->
            </div> <!-- /row -->
        <?php endif; ?>

        <div class="row <?= !get_field('has_gastro_info') ? 'mt-3' : '' ?>">
            <div class="col-12 col-md-9">

            <div class="pt-4"></div>
            <?php
            // Fallback-Logik für Inhalte
            if ($kundentyp === 'gastro' && get_field('has_gastro_info')) {
                $content = get_field('content_gastro');
                // Wenn gastro-content leer ist, fallback auf privat
                if (empty($content)) {
                    $content = get_field('content_privat');
                }
            } else {
                // Immer privat, wenn kein Gastro oder has_gastro_info = 0
                $content = get_field('content_privat');
            }

            // Ausgabe
            echo '<div' . ($kundentyp === 'gastro' ? ' data-nosnippet' : '') . '>';
            echo $content;
            echo '</div>';
            ?>


            </div> <!-- col-12 -->

            <div class="col-3 d-none d-md-block">
                <h3 class="sim-products-heading">Ähnliche Produkte</h3>

                <?php
                // Hole alle Begriffe der Taxonomie 'produkt_kategorie' des aktuellen Produkts
                $terms = get_the_terms(get_the_ID(), 'produkt_kategorie');

                if (!empty($terms) && !is_wp_error($terms)) {
                    // Nehmen wir hier z.B. den letzten Term (wie du es mit Kategorien gemacht hast)
                    $last_term = end($terms);
                    $term_id = $last_term->term_id;

                    $args = [
                        'post_type'      => 'produkt',
                        'posts_per_page' => 6,
                        'post__not_in'   => [get_the_ID()],
                        'tax_query'      => [
                            [
                                'taxonomy' => 'produkt_kategorie',
                                'field'    => 'term_id',
                                'terms'    => $term_id,
                            ],
                        ],
                    ];

                    $query = new WP_Query($args);
                    if ($query->have_posts()) {
                        echo '<div class="related-products">';
                        while ($query->have_posts()) {
                            $query->the_post();
                ?>
                            <a href="<?php the_permalink(); ?>" class="related-product-item">
                                <?php
                                if (has_post_thumbnail()) {
                                    the_post_thumbnail('thumbnail', ['class' => 'related-thumb']);
                                }
                                ?>
                                <p><?php the_title(); ?></p>
                            </a>
                <?php
                        }
                        echo '</div>';
                        wp_reset_postdata();
                    }
                } else {
                    echo '<p>Keine verwandten Produkte gefunden.</p>';
                }
                ?>

            </div> <!-- col-3 -->
        </div> <!-- /container -->
    </div>
    <script>

        document.addEventListener('DOMContentLoaded', function() {
            const productTitle = document.getElementById('product-name');
            const formField = document.getElementById('product-title');

            if (productTitle && formField) {
                formField.value = productTitle.textContent.trim();
            }
        });
    </script>

    <?php get_footer(); ?>