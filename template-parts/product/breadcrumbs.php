<?php
/**
 * Tempalte Part: Breadcrumbs
 */

$categories = get_the_category(); 
if (is_single() && !empty($categories)) {
    echo "<nav class='breadcrumbs mb-0'>";

    // Home link
    echo '<a href="' . get_home_url() . '">Startseite</a> ';

    // Last category to mark as 'active'
    $last = end($categories);

    // Loop through categories
    foreach ($categories as $category) {
        $active_class = ($category->term_id == $last->term_id) ? 'active' : '';

        // Display each category link with a separator
        echo "&gt; <a href='" . get_category_link($category->term_id) . "' class='breadcrumb-link " . $active_class . "'>" . $category->name . "</a> ";
    }

    echo "</nav>";
}
?>