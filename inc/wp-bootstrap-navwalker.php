<?php
if ( ! class_exists( 'WP_Bootstrap_Navwalker' ) ) :

class WP_Bootstrap_Navwalker extends Walker_Nav_Menu {

	private $current_item;
	private $dropdown_menu_alignment_values = [
		'dropdown-menu-start',
		'dropdown-menu-end',
		'dropdown-menu-sm-start',
		'dropdown-menu-sm-end',
		'dropdown-menu-md-start',
		'dropdown-menu-md-end',
		'dropdown-menu-lg-start',
		'dropdown-menu-lg-end',
		'dropdown-menu-xl-start',
		'dropdown-menu-xl-end',
		'dropdown-menu-xxl-start',
		'dropdown-menu-xxl-end'
	];

	// Start der UL
	function start_lvl( &$output, $depth = 0, $args = null ) {
		$dropdown_menu_class = [];

		if ( isset( $this->current_item->classes ) ) {
			foreach ( $this->current_item->classes as $class ) {
				if ( in_array( $class, $this->dropdown_menu_alignment_values, true ) ) {
					$dropdown_menu_class[] = $class;
				}
			}
		}

		$indent = str_repeat( "\t", $depth );
		$submenu_class = ( $depth > 0 ) ? ' dropdown-submenu' : '';
		$output .= "\n$indent<ul class=\"dropdown-menu$submenu_class " . esc_attr( implode( ' ', $dropdown_menu_class ) ) . " depth_$depth\">\n";
	}

	// Start der LI
	function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {
		$this->current_item = $item;

		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
		$li_attributes = '';
		$value = '';

		$classes = empty( $item->classes ) ? [] : (array) $item->classes;

		// Dropdown-Logik
		if ( isset( $args->has_children ) && $args->has_children ) {
			$classes[] = ( $depth === 0 ) ? 'dropdown' : 'dropdown-submenu';
		}

		$classes[] = 'nav-item';
		$classes[] = 'nav-item-' . $item->ID;

		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
		$class_names = ' class="' . esc_attr( $class_names ) . '"';

		$id = apply_filters( 'nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args );
		$id = strlen( $id ) ? ' id="' . esc_attr( $id ) . '"' : '';

		$output .= $indent . '<li' . $id . $value . $class_names . $li_attributes . '>';

		// Link-Attribute
		$attributes = '';
		$attributes .= ! empty( $item->attr_title ) ? ' title="' . esc_attr( $item->attr_title ) . '"' : '';
		$attributes .= ! empty( $item->target ) ? ' target="' . esc_attr( $item->target ) . '"' : '';
		$attributes .= ! empty( $item->xfn ) ? ' rel="' . esc_attr( $item->xfn ) . '"' : '';
		$attributes .= ! empty( $item->url ) ? ' href="' . esc_attr( $item->url ) . '"' : '';

		// Klassen für Link
		$active_class = ( $item->current || $item->current_item_ancestor || in_array( "current_page_parent", $item->classes, true ) || in_array( "current-post-ancestor", $item->classes, true ) ) ? 'active' : '';
		$nav_link_class = ( $depth > 0 ) ? 'dropdown-item ' : 'nav-link ';

		// Dropdown Toggle für alle Ebenen
		if ( isset( $args->has_children ) && $args->has_children ) {
			$attributes .= ' class="' . $nav_link_class . $active_class . ' dropdown-toggle"';
			$attributes .= ' data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"';
		} else {
			$attributes .= ' class="' . $nav_link_class . $active_class . '"';
		}

		// Linkausgabe
		$item_output  = $args->before;
		$item_output .= '<a' . $attributes . '>';
		$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
		$item_output .= '</a>';
		$item_output .= $args->after;

		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}

	// Children-Erkennung
	function display_element( $element, &$children_elements, $max_depth, $depth = 0, $args = [], &$output = '' ) {
		if ( !$element ) return;

		$id_field = $this->db_fields['id'];
		$args[0]->has_children = ! empty( $children_elements[ $element->$id_field ] );

		parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
	}
}

endif;
