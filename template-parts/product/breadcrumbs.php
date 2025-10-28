<?php
/**
 * Template Part: Breadcrumbs Custom Taxonomy
 */

$taxonomy = 'produkt_kategorie'; // <--- Deine Taxonomie hier anpassen
$terms = get_the_terms(get_the_ID(), $taxonomy);

if (is_single() && !empty($terms) && !is_wp_error($terms)) {
    echo "<nav class='breadcrumbs mb-0'>";

    // Home
    echo '<a href="' . esc_url(home_url('/')) . '">Startseite</a> ';

    // Letzter Term soll active sein
    $last = end($terms);

    // Loop durch Terms
    foreach ($terms as $term) {
        $active_class = ($term->term_id == $last->term_id) ? 'active' : '';
        echo "&gt; <a href='" . esc_url(get_term_link($term)) . "' class='breadcrumb-link $active_class'>" . esc_html($term->name) . "</a> ";
    }

    echo "</nav>";
}
?>
