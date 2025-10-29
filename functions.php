<?php

/**
 * Include Theme Customizer.
 *
 * @since v1.0
 */
$theme_customizer = __DIR__ . '/inc/customizer.php';
if ( is_readable( $theme_customizer ) ) {
	require_once $theme_customizer;
}

if ( ! function_exists( 'lipo_bootstrap_setup_theme' ) ) {
	/**
	 * General Theme Settings.
	 *
	 * @since v1.0
	 *
	 * @return void
	 */
	function lipo_bootstrap_setup_theme() {
		// Make theme available for translation: Translations can be filed in the /languages/ directory.
		load_theme_textdomain( 'lipo_bootstrap', __DIR__ . '/languages' );

		/**
		 * Set the content width based on the theme's design and stylesheet.
		 *
		 * @since v1.0
		 */
		global $content_width;
		if ( ! isset( $content_width ) ) {
			$content_width = 800;
		}

		// Theme Support.
		add_theme_support( 'title-tag' );
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'post-thumbnails' );
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'script',
				'style',
				'navigation-widgets',
			)
		);

		// Add support for Block Styles.
		add_theme_support( 'wp-block-styles' );
		// Add support for full and wide alignment.
		add_theme_support( 'align-wide' );
		// Add support for Editor Styles.
		add_theme_support( 'editor-styles' );
		// Enqueue Editor Styles.
		add_editor_style( 'style-editor.css' );

		// Default attachment display settings.
		update_option( 'image_default_align', 'none' );
		update_option( 'image_default_link_type', 'none' );
		update_option( 'image_default_size', 'large' );

		// Custom CSS styles of WorPress gallery.
		add_filter( 'use_default_gallery_style', '__return_false' );
	}
	add_action( 'after_setup_theme', 'lipo_bootstrap_setup_theme' );

	/**
	 * Enqueue editor stylesheet (for iframed Post Editor):
	 * https://make.wordpress.org/core/2023/07/18/miscellaneous-editor-changes-in-wordpress-6-3/#post-editor-iframed
	 *
	 * @since v3.5.1
	 *
	 * @return void
	 */
	function lipo_bootstrap_load_editor_styles() {
		if ( is_admin() ) {
			wp_enqueue_style( 'editor-style', get_theme_file_uri( 'style-editor.css' ) );
		}
	}
	add_action( 'enqueue_block_assets', 'lipo_bootstrap_load_editor_styles' );

	// Disable Block Directory: https://github.com/WordPress/gutenberg/blob/trunk/docs/reference-guides/filters/editor-filters.md#block-directory
	remove_action( 'enqueue_block_editor_assets', 'wp_enqueue_editor_block_directory_assets' );
	remove_action( 'enqueue_block_editor_assets', 'gutenberg_enqueue_block_editor_assets_block_directory' );
}

if ( ! function_exists( 'wp_body_open' ) ) {
	/**
	 * Fire the wp_body_open action.
	 *
	 * Added for backwards compatibility to support pre 5.2.0 WordPress versions.
	 *
	 * @since v2.2
	 *
	 * @return void
	 */
	function wp_body_open() {
		do_action( 'wp_body_open' );
	}
}

if ( ! function_exists( 'lipo_bootstrap_add_user_fields' ) ) {
	/**
	 * Add new User fields to Userprofile:
	 * get_user_meta( $user->ID, 'facebook_profile', true );
	 *
	 * @since v1.0
	 *
	 * @param array $fields User fields.
	 *
	 * @return array
	 */
	function lipo_bootstrap_add_user_fields( $fields ) {
		// Add new fields.
		$fields['facebook_profile'] = 'Facebook URL';
		$fields['twitter_profile']  = 'Twitter URL';
		$fields['linkedin_profile'] = 'LinkedIn URL';
		$fields['xing_profile']     = 'Xing URL';
		$fields['github_profile']   = 'GitHub URL';

		return $fields;
	}
	add_filter( 'user_contactmethods', 'lipo_bootstrap_add_user_fields' );
}

/**
 * Test if a page is a blog page.
 * if ( is_blog() ) { ... }
 *
 * @since v1.0
 *
 * @global WP_Post $post Global post object.
 *
 * @return bool
 */
function is_blog() {
	global $post;
	$posttype = get_post_type( $post );

	return ( ( is_archive() || is_author() || is_category() || is_home() || is_single() || ( is_tag() && ( 'post' === $posttype ) ) ) ? true : false );
}

/**
 * Disable comments for Media (Image-Post, Jetpack-Carousel, etc.)
 *
 * @since v1.0
 *
 * @param bool $open    Comments open/closed.
 * @param int  $post_id Post ID.
 *
 * @return bool
 */
function lipo_bootstrap_filter_media_comment_status( $open, $post_id = null ) {
	$media_post = get_post( $post_id );

	if ( 'attachment' === $media_post->post_type ) {
		return false;
	}

	return $open;
}
add_filter( 'comments_open', 'lipo_bootstrap_filter_media_comment_status', 10, 2 );

/**
 * Style Edit buttons as badges: https://getbootstrap.com/docs/5.0/components/badge
 *
 * @since v1.0
 *
 * @param string $link Post Edit Link.
 *
 * @return string
 */
function lipo_bootstrap_custom_edit_post_link( $link ) {
	return str_replace( 'class="post-edit-link"', 'class="post-edit-link badge bg-secondary"', $link );
}
add_filter( 'edit_post_link', 'lipo_bootstrap_custom_edit_post_link' );

/**
 * Style Edit buttons as badges: https://getbootstrap.com/docs/5.0/components/badge
 *
 * @since v1.0
 *
 * @param string $link Comment Edit Link.
 */
function lipo_bootstrap_custom_edit_comment_link( $link ) {
	return str_replace( 'class="comment-edit-link"', 'class="comment-edit-link badge bg-secondary"', $link );
}
add_filter( 'edit_comment_link', 'lipo_bootstrap_custom_edit_comment_link' );

/**
 * Responsive oEmbed filter: https://getbootstrap.com/docs/5.0/helpers/ratio
 *
 * @since v1.0
 *
 * @param string $html Inner HTML.
 *
 * @return string
 */
function lipo_bootstrap_oembed_filter( $html ) {
	return '<div class="ratio ratio-16x9">' . $html . '</div>';
}
add_filter( 'embed_oembed_html', 'lipo_bootstrap_oembed_filter', 10 );

if ( ! function_exists( 'lipo_bootstrap_content_nav' ) ) {
	/**
	 * Display a navigation to next/previous pages when applicable.
	 *
	 * @since v1.0
	 *
	 * @param string $nav_id Navigation ID.
	 */
	function lipo_bootstrap_content_nav( $nav_id ) {
		global $wp_query;

		if ( $wp_query->max_num_pages > 1 ) {
			?>
			<div id="<?php echo esc_attr( $nav_id ); ?>" class="d-flex mb-4 justify-content-between">
				<div><?php next_posts_link( '<span aria-hidden="true">&larr;</span> ' . esc_html__( 'Older posts', 'lipo_bootstrap' ) ); ?></div>
				<div><?php previous_posts_link( esc_html__( 'Newer posts', 'lipo_bootstrap' ) . ' <span aria-hidden="true">&rarr;</span>' ); ?></div>
			</div><!-- /.d-flex -->
			<?php
		} else {
			echo '<div class="clearfix"></div>';
		}
	}

	/**
	 * Add Class.
	 *
	 * @since v1.0
	 *
	 * @return string
	 */
	function posts_link_attributes() {
		return 'class="btn btn-secondary btn-lg"';
	}
	add_filter( 'next_posts_link_attributes', 'posts_link_attributes' );
	add_filter( 'previous_posts_link_attributes', 'posts_link_attributes' );
}

/**
 * Init Widget areas in Sidebar.
 *
 * @since v1.0
 *
 * @return void
 */
function lipo_bootstrap_widgets_init() {
	// Area 1.
	register_sidebar(
		array(
			'name'          => 'Primary Widget Area (Sidebar)',
			'id'            => 'primary_widget_area',
			'before_widget' => '',
			'after_widget'  => '',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		)
	);

	// Area 2.
	register_sidebar(
		array(
			'name'          => 'Secondary Widget Area (Header Navigation)',
			'id'            => 'secondary_widget_area',
			'before_widget' => '',
			'after_widget'  => '',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		)
	);

	// Area 3.
	register_sidebar(
		array(
			'name'          => 'Third Widget Area (Footer)',
			'id'            => 'third_widget_area',
			'before_widget' => '',
			'after_widget'  => '',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		)
	);
}
add_action( 'widgets_init', 'lipo_bootstrap_widgets_init' );

if ( ! function_exists( 'lipo_bootstrap_article_posted_on' ) ) {
	/**
	 * "Theme posted on" pattern.
	 *
	 * @since v1.0
	 */
	function lipo_bootstrap_article_posted_on() {
		printf(
			wp_kses_post( __( '<span class="sep">Posted on </span><a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s">%4$s</time></a><span class="by-author"> <span class="sep"> by </span> <span class="author-meta vcard"><a class="url fn n" href="%5$s" title="%6$s" rel="author">%7$s</a></span></span>', 'lipo_bootstrap' ) ),
			esc_url( get_the_permalink() ),
			esc_attr( get_the_date() . ' - ' . get_the_time() ),
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() . ' - ' . get_the_time() ),
			esc_url( get_author_posts_url( (int) get_the_author_meta( 'ID' ) ) ),
			sprintf( esc_attr__( 'View all posts by %s', 'lipo_bootstrap' ), get_the_author() ),
			get_the_author()
		);
	}
}

/**
 * Template for Password protected post form.
 *
 * @since v1.0
 *
 * @global WP_Post $post Global post object.
 *
 * @return string
 */
function lipo_bootstrap_password_form() {
	global $post;
	$label = 'pwbox-' . ( empty( $post->ID ) ? wp_rand() : $post->ID );

	$output                  = '<div class="row">';
		$output             .= '<form action="' . esc_url( site_url( 'wp-login.php?action=postpass', 'login_post' ) ) . '" method="post">';
		$output             .= '<h4 class="col-md-12 alert alert-warning">' . esc_html__( 'This content is password protected. To view it please enter your password below.', 'lipo_bootstrap' ) . '</h4>';
			$output         .= '<div class="col-md-6">';
				$output     .= '<div class="input-group">';
					$output .= '<input type="password" name="post_password" id="' . esc_attr( $label ) . '" placeholder="' . esc_attr__( 'Password', 'lipo_bootstrap' ) . '" class="form-control" />';
					$output .= '<div class="input-group-append"><input type="submit" name="submit" class="btn btn-primary" value="' . esc_attr__( 'Submit', 'lipo_bootstrap' ) . '" /></div>';
				$output     .= '</div><!-- /.input-group -->';
			$output         .= '</div><!-- /.col -->';
		$output             .= '</form>';
	$output                 .= '</div><!-- /.row -->';

	return $output;
}
add_filter( 'the_password_form', 'lipo_bootstrap_password_form' );


if ( ! function_exists( 'lipo_bootstrap_comment' ) ) {
	/**
	 * Style Reply link.
	 *
	 * @since v1.0
	 *
	 * @param string $link Link output.
	 *
	 * @return string
	 */
	function lipo_bootstrap_replace_reply_link_class( $link ) {
		return str_replace( "class='comment-reply-link", "class='comment-reply-link btn btn-outline-secondary", $link );
	}
	add_filter( 'comment_reply_link', 'lipo_bootstrap_replace_reply_link_class' );

	/**
	 * Template for comments and pingbacks:
	 * add function to comments.php ... wp_list_comments( array( 'callback' => 'lipo_bootstrap_comment' ) );
	 *
	 * @since v1.0
	 *
	 * @param object $comment Comment object.
	 * @param array  $args    Comment args.
	 * @param int    $depth   Comment depth.
	 */
	function lipo_bootstrap_comment( $comment, $args, $depth ) {
		$GLOBALS['comment'] = $comment;
		switch ( $comment->comment_type ) :
			case 'pingback':
			case 'trackback':
				?>
		<li class="post pingback">
			<p>
				<?php
					esc_html_e( 'Pingback:', 'lipo_bootstrap' );
					comment_author_link();
					edit_comment_link( esc_html__( 'Edit', 'lipo_bootstrap' ), '<span class="edit-link">', '</span>' );
				?>
			</p>
				<?php
				break;
			default:
				?>
		<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
			<article id="comment-<?php comment_ID(); ?>" class="comment">
				<footer class="comment-meta">
					<div class="comment-author vcard">
						<?php
							$avatar_size = ( '0' !== $comment->comment_parent ? 68 : 136 );
							echo get_avatar( $comment, $avatar_size );

							/* Translators: 1: Comment author, 2: Date and time */
							printf(
								wp_kses_post( __( '%1$s, %2$s', 'lipo_bootstrap' ) ),
								sprintf( '<span class="fn">%s</span>', get_comment_author_link() ),
								sprintf(
									'<a href="%1$s"><time datetime="%2$s">%3$s</time></a>',
									esc_url( get_comment_link( $comment->comment_ID ) ),
									get_comment_time( 'c' ),
									/* Translators: 1: Date, 2: Time */
									sprintf( esc_html__( '%1$s ago', 'lipo_bootstrap' ), human_time_diff( (int) get_comment_time( 'U' ), current_time( 'timestamp' ) ) )
								)
							);

							edit_comment_link( esc_html__( 'Edit', 'lipo_bootstrap' ), '<span class="edit-link">', '</span>' );
						?>
					</div><!-- .comment-author .vcard -->

					<?php if ( '0' === $comment->comment_approved ) { ?>
						<em class="comment-awaiting-moderation">
							<?php esc_html_e( 'Your comment is awaiting moderation.', 'lipo_bootstrap' ); ?>
						</em>
						<br />
					<?php } ?>
				</footer>

				<div class="comment-content"><?php comment_text(); ?></div>

				<div class="reply">
					<?php
						comment_reply_link(
							array_merge(
								$args,
								array(
									'reply_text' => esc_html__( 'Reply', 'lipo_bootstrap' ) . ' <span>&darr;</span>',
									'depth'      => $depth,
									'max_depth'  => $args['max_depth'],
								)
							)
						);
					?>
				</div><!-- /.reply -->
			</article><!-- /#comment-## -->
				<?php
				break;
		endswitch;
	}

	/**
	 * Custom Comment form.
	 *
	 * @since v1.0
	 * @since v1.1: Added 'submit_button' and 'submit_field'
	 * @since v2.0.2: Added '$consent' and 'cookies'
	 *
	 * @param array $args    Form args.
	 * @param int   $post_id Post ID.
	 *
	 * @return array
	 */
	function lipo_bootstrap_custom_commentform( $args = array(), $post_id = null ) {
		if ( null === $post_id ) {
			$post_id = get_the_ID();
		}

		$commenter     = wp_get_current_commenter();
		$user          = wp_get_current_user();
		$user_identity = $user->exists() ? $user->display_name : '';

		$args = wp_parse_args( $args );

		$req      = get_option( 'require_name_email' );
		$aria_req = ( $req ? " aria-required='true' required" : '' );
		$consent  = ( empty( $commenter['comment_author_email'] ) ? '' : ' checked="checked"' );
		$fields   = array(
			'author'  => '<div class="form-floating mb-3">
							<input type="text" id="author" name="author" class="form-control" value="' . esc_attr( $commenter['comment_author'] ) . '" placeholder="' . esc_html__( 'Name', 'lipo_bootstrap' ) . ( $req ? '*' : '' ) . '"' . $aria_req . ' />
							<label for="author">' . esc_html__( 'Name', 'lipo_bootstrap' ) . ( $req ? '*' : '' ) . '</label>
						</div>',
			'email'   => '<div class="form-floating mb-3">
							<input type="email" id="email" name="email" class="form-control" value="' . esc_attr( $commenter['comment_author_email'] ) . '" placeholder="' . esc_html__( 'Email', 'lipo_bootstrap' ) . ( $req ? '*' : '' ) . '"' . $aria_req . ' />
							<label for="email">' . esc_html__( 'Email', 'lipo_bootstrap' ) . ( $req ? '*' : '' ) . '</label>
						</div>',
			'url'     => '',
			'cookies' => '<p class="form-check mb-3 comment-form-cookies-consent">
							<input id="wp-comment-cookies-consent" name="wp-comment-cookies-consent" class="form-check-input" type="checkbox" value="yes"' . $consent . ' />
							<label class="form-check-label" for="wp-comment-cookies-consent">' . esc_html__( 'Save my name, email, and website in this browser for the next time I comment.', 'lipo_bootstrap' ) . '</label>
						</p>',
		);

		$defaults = array(
			'fields'               => apply_filters( 'comment_form_default_fields', $fields ),
			'comment_field'        => '<div class="form-floating mb-3">
											<textarea id="comment" name="comment" class="form-control" aria-required="true" required placeholder="' . esc_attr__( 'Comment', 'lipo_bootstrap' ) . ( $req ? '*' : '' ) . '"></textarea>
											<label for="comment">' . esc_html__( 'Comment', 'lipo_bootstrap' ) . '</label>
										</div>',
			/** This filter is documented in wp-includes/link-template.php */
			'must_log_in'          => '<p class="must-log-in">' . sprintf( wp_kses_post( __( 'You must be <a href="%s">logged in</a> to post a comment.', 'lipo_bootstrap' ) ), wp_login_url( esc_url( get_the_permalink( get_the_ID() ) ) ) ) . '</p>',
			/** This filter is documented in wp-includes/link-template.php */
			'logged_in_as'         => '<p class="logged-in-as">' . sprintf( wp_kses_post( __( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>', 'lipo_bootstrap' ) ), get_edit_user_link(), $user->display_name, wp_logout_url( apply_filters( 'the_permalink', esc_url( get_the_permalink( get_the_ID() ) ) ) ) ) . '</p>',
			'comment_notes_before' => '<p class="small comment-notes">' . esc_html__( 'Your Email address will not be published.', 'lipo_bootstrap' ) . '</p>',
			'comment_notes_after'  => '',
			'id_form'              => 'commentform',
			'id_submit'            => 'submit',
			'class_submit'         => 'btn btn-primary',
			'name_submit'          => 'submit',
			'title_reply'          => '',
			'title_reply_to'       => esc_html__( 'Leave a Reply to %s', 'lipo_bootstrap' ),
			'cancel_reply_link'    => esc_html__( 'Cancel reply', 'lipo_bootstrap' ),
			'label_submit'         => esc_html__( 'Post Comment', 'lipo_bootstrap' ),
			'submit_button'        => '<input type="submit" id="%2$s" name="%1$s" class="%3$s" value="%4$s" />',
			'submit_field'         => '<div class="form-submit">%1$s %2$s</div>',
			'format'               => 'html5',
		);

		return $defaults;
	}
	add_filter( 'comment_form_defaults', 'lipo_bootstrap_custom_commentform' );
}

if ( function_exists( 'register_nav_menus' ) ) {
	/**
	 * Nav menus.
	 *
	 * @since v1.0
	 *
	 * @return void
	 */
	register_nav_menus(
		array(
			'main-menu'   => 'Main Navigation Menu',
			'footer-menu' => 'Footer Menu',
		)
	);
}

// Custom Nav Walker: wp_bootstrap_navwalker().
$custom_walker = __DIR__ . '/inc/wp-bootstrap-navwalker.php';
if ( is_readable( $custom_walker ) ) {
	require_once $custom_walker;
}

$custom_walker_footer = __DIR__ . '/inc/wp-bootstrap-navwalker-footer.php';
if ( is_readable( $custom_walker_footer ) ) {
	require_once $custom_walker_footer;
}

/**
 * Loading All CSS Stylesheets and Javascript Files.
 *
 * @since v1.0
 *
 * @return void
 */
function lipo_bootstrap_scripts_loader() {
	$theme_version = wp_get_theme()->get( 'Version' );

	// 1. Styles.
	wp_enqueue_style( 'main', get_theme_file_uri( 'build/main.css' ), array(), $theme_version, 'all' ); // main.scss: Compiled Framework source + custom styles.
	wp_enqueue_style( 'style', get_theme_file_uri( 'style.css' ), array(), $theme_version, 'all' );

	if ( is_rtl() ) {
		wp_enqueue_style( 'rtl', get_theme_file_uri( 'build/rtl.css' ), array(), $theme_version, 'all' );
	}

	// 2. Scripts.
	wp_enqueue_script( 'mainjs', get_theme_file_uri( 'build/main.js' ), array(), $theme_version, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'lipo_bootstrap_scripts_loader' );


function theme_enqueue_fonts() {
	wp_enqueue_style('theme-fonts', get_template_directory_uri() . '/assets/fonts/fonts.css');
}
add_action('wp_enqueue_scripts', 'theme_enqueue_fonts');

// CUSTOM POST TYPES

function register_produkt_taxonomy() {
    register_taxonomy(
        'produkt_kategorie',
        'produkt',
        [
            'label' => 'Produktkategorien',
            'hierarchical' => true, // wie normale Kategorien
            'public' => true,
            'show_ui' => true,
            'show_in_rest' => true, // für Gutenberg & REST API
            'rewrite' => ['slug' => 'produkt-kategorie'],
        ]
    );
}
add_action('init', 'register_produkt_taxonomy');

// Spalte für die Taxonomie in der Post-Übersicht hinzufügen
add_filter('manage_produkt_posts_columns', function($columns) {
    // Füge die Spalte direkt nach dem Titel ein
    $new_columns = [];
    foreach ($columns as $key => $value) {
        $new_columns[$key] = $value;
        if ($key === 'title') {
            $new_columns['produkt_kategorie'] = 'Produktkategorien';
        }
    }
    return $new_columns;
});

// Inhalte der Taxonomie-Spalte füllen
add_action('manage_produkt_posts_custom_column', function($column, $post_id) {
    if ($column === 'produkt_kategorie') {
        $terms = get_the_terms($post_id, 'produkt_kategorie');
        if (!empty($terms) && !is_wp_error($terms)) {
            $term_links = [];
            foreach ($terms as $term) {
                $link = esc_url(add_query_arg([
                    'post_type' => 'produkt',
                    'produkt_kategorie' => $term->slug,
                ], 'edit.php'));
                $term_links[] = '<a href="' . $link . '">' . esc_html($term->name) . '</a>';
            }
            echo implode(', ', $term_links);
        } else {
            echo '—';
        }
    }
}, 10, 2);


function register_custom_post_type_produkte() {
	$labels = array(
			'name'               => 'Produkt',
			'singular_name'      => 'Produkt',
			'menu_name'          => 'Produkte',
			'name_admin_bar'     => 'Produkt',
			'add_new'            => 'Neues Produkt hinzufügen',
			'add_new_item'       => 'Neues Produkt hinzufügen',
			'new_item'           => 'Neues Produkt',
			'edit_item'          => 'Produkt bearbeiten',
			'view_item'          => 'Produkt ansehen',
			'all_items'          => 'Alle Produkte',
			'search_items'       => 'Produkte suchen',
			'not_found'          => 'Keine Produkte gefunden',
			'not_found_in_trash' => 'Keine Produkte im Papierkorb gefunden'
	);

	$args = array(
			'labels'             => $labels,
			'public'             => true,
			'has_archive'        => true,
			'rewrite'            => array('slug' => 'produkt'),
			'menu_icon'          => 'dashicons-cart',
			'supports'           => array('title', 'editor', 'thumbnail', 'excerpt'),
			'show_in_rest'       => true,
			'taxonomies' 				 => ['produkt_kategorie']
	);

	register_post_type('produkt', $args);
}
add_action('init', 'register_custom_post_type_produkte');

function category_overview_shortcode($atts)
{
    ob_start();

    // Versuche, aktuellen Term-Slug automatisch zu ermitteln (wenn kein Attribut übergeben)
    if (!isset($atts['category'])) {
        if (is_tax('produkt_kategorie')) {
            $queried_object = get_queried_object();
            if ($queried_object && !is_wp_error($queried_object)) {
                $atts['category'] = $queried_object->slug;
            }
        }
    }

    // Falls immer noch keine Kategorie, abbrechen
    if (empty($atts['category'])) {
        echo '<div class="container"><p>Keine Kategorie angegeben.</p></div>';
        return ob_get_clean();
    }

    // Hole den Term
    $term = get_term_by('slug', $atts['category'], 'produkt_kategorie');

    if (!$term) {
        echo '<div class="container"><p>Kategorie nicht gefunden.</p></div>';
        return ob_get_clean();
    }

    // Hole Produkte mit Tax Query
    $posts = get_posts([
        'post_type' => 'produkt',
        'posts_per_page' => -1,
        'tax_query' => [
            [
                'taxonomy' => 'produkt_kategorie',
                'field' => 'slug',
                'terms' => $atts['category'],
            ],
        ],
    ]);

    if (empty($posts)) {
        echo '<div class="container"><p>Keine Produkte in der Kategorie "' . esc_html($term->name) . '" gefunden.</p></div>';
        return ob_get_clean();
    }

		usort($posts, function ($a, $b) {
				$a_value = get_field('sort', $a->ID);
				$b_value = get_field('sort', $b->ID);

				$a_value = is_numeric($a_value) ? (float) $a_value : null;
				$b_value = is_numeric($b_value) ? (float) $b_value : null;

				if ($a_value === null && $b_value === null) return 0;

				if ($a_value === null) return 1;
				if ($b_value === null) return -1;

				return $a_value <=> $b_value;
		});

    echo '<div class="container my-3">';
    echo '<h3 class="mb-2 fw-semibold">'. esc_html($term->name) .'</h3>';
    if (!empty($term->description)) {
        echo '<p class="text-muted">' . esc_html($term->description) . '</p>';
    }
    
		//echo '<p>' . count($posts) . ' Produkte gefunden.</p>';
    echo '<div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-4">';


		foreach ($posts as $post) {
				setup_postdata($post);
				$thumbnail = get_the_post_thumbnail_url($post->ID, 'large');
				$title = get_the_title($post->ID);
				$permalink = get_permalink($post->ID);
				$excerpt = wp_trim_words(get_the_excerpt($post->ID), 30, '...');

				echo '<div class="col">';
				echo '  <div class="card border-0 bg-white h-100 overflow-hidden">';
				
				if ($thumbnail) {
						echo '    <div class="position-relative">';
						echo '      <img src="' . esc_url($thumbnail) . '" class="img-fluid w-100" style="object-fit: cover; height: 240px;" alt="' . esc_attr($title) . '">';
						echo '      <div class="position-absolute bottom-0 start-0 w-100 p-3" style="background: linear-gradient(to top, rgba(0,0,0,0.6), transparent);">';
						echo '        <h5 class="text-white fw-bold mb-0">' . esc_html($title) . '</h5>';
						echo '      </div>';
						echo '    </div>';
				}

				echo '    <div class="card-body px-3 py-4 d-flex flex-column justify-content-between">';
				echo '      <p class="text-muted mb-3" style="min-height: 60px;">' . esc_html($excerpt) . '</p>';
				echo '      <a href="' . esc_url($permalink) . '" class="fw-semibold text-dark text-decoration-none">';
				echo '        Mehr erfahren <i class="bi bi-arrow-right-short"></i>';
				echo '      </a>';
				echo '    </div>';
				echo '  </div>';
				echo '</div>';
		}
		wp_reset_postdata();



    echo '</div>'; // row
    echo '</div>'; // container

    return ob_get_clean();
}
add_shortcode('category_overview', 'category_overview_shortcode');



add_action('wpcf7_mail_sent', 'custom_email_response');
function custom_email_response($contact_form) {

    $submission = WPCF7_Submission::get_instance();
    if (!$submission) return;

    $data = $submission->get_posted_data();
    
    if (empty($data['your-email']) || !is_email($data['your-email'])) {
        return;
    }

    $recipient = sanitize_email($data['your-email']);

    // HTML Template laden
    $template_path = get_template_directory() . '/mail/mail_template.html';
    if (!file_exists($template_path)) return;

    $body = file_get_contents($template_path);

    // HTML Header setzen
    $headers = [
        'Content-Type: text/html; charset=UTF-8',
        'From: LIPOWEC <info@lipowec.at>'
    ];

    // Auto-Response senden
    wp_mail(
        $recipient,
        'Vielen Dank für Ihre Anfrage!',
        $body,
        $headers
    );
}



define('BASE_URL', 'https://lipowec.www12.perfectnet.at');


if (!isset($_COOKIE['kundentyp'])) {
    setcookie('kundentyp', 'privat', time() + 3600 * 24 * 30, '/'); // 30 Tage gültig
    $_COOKIE['kundentyp'] = 'privat'; // Damit PHP ihn sofort nutzen kann
}

function get_image_attributes($relative_path)
{
    global $wpdb;

    $attachment_id = $wpdb->get_var( $wpdb->prepare( "
        SELECT ID FROM $wpdb->posts
        WHERE guid LIKE %s AND post_type = 'attachment'
        LIMIT 1
    ", '%' . $wpdb->esc_like($relative_path) . '%' ) );

    if ($attachment_id) {
        $image_url = wp_get_attachment_url($attachment_id);
        $alt_text = get_post_meta($attachment_id, '_wp_attachment_image_alt', true);

        return [
            'url' => $image_url,
            'alt' => $alt_text
        ];
    }

		// fallback if attachment not found, relative_path always valid
    return [
			'url' => $relative_path,
			'alt' => ""
		];
}



add_filter( 'the_seo_framework_generated_description', 'my_tsf_generated_description', 10, 2 );

function my_tsf_generated_description( $desc, $args ) {

	// If ACF isn't activated, don't do anything.
	if ( ! function_exists( 'get_field' ) ) return $desc;

	if ( isset( $args ) ) {
		// Admin area.
		switch ( The_SEO_Framework\get_query_type_from_args( $args ) ) {
			case 'term':
				$term = get_term( $args['id'], $args['tax'] );
				break;
			case 'single':
				$post_id = $args['id'];
		}
	} else {
		// On the front-end.
		$tsfquery = tsf()->query();

		if ( $tsfquery->is_editable_term() ) {
			$term = get_queried_object();
		} elseif ( $tsfquery->is_singular() ) {
			$post_id = $tsfquery->get_the_real_id();
		}
	}

	if ( ! empty( $term ) ) {
		$desc = wp_strip_all_tags( get_field( 'content_privat', $term ) ) ?: $desc;
	} elseif ( ! empty( $post_id ) ) {
		$desc = wp_strip_all_tags( get_field( 'synopsis', $post_id ) ) ?: $desc;
	}

	return $desc;
}

wp_enqueue_script('custom-menu', get_theme_file_uri( 'assets/js/custom-menu.js' ), null, null, true);


add_action('pre_get_posts', 'sort_produkte_by_acf_int');
function sort_produkte_by_acf_int($query) {

    if (!is_admin()
        && $query->is_main_query()
        && (is_post_type_archive('produkt') || is_tax('produkt_kategorie'))
    ) {

        $query->set('meta_key', 'sort');

        $query->set('orderby', [
            'meta_value_num' => 'ASC',
            'date' => 'DESC',
        ]);

        $query->set('meta_type', 'NUMERIC');

        $query->set('meta_query', [
            'relation' => 'OR',
            [
                'key'     => 'sort',
                'compare' => 'EXISTS'
            ],
            [
                'key'     => 'sort',
                'compare' => 'NOT EXISTS'
            ]
        ]);
    }
}

/**
 * Register Custom Navigation Walker
 */

 if ( ! file_exists( get_template_directory() . '/class-wp-bootstrap-navwalker.php' ) ) {
	// File does not exist... return an error.
	return new WP_Error( 'class-wp-bootstrap-navwalker-missing', __( 'It appears the class-wp-bootstrap-navwalker.php file may be missing.', 'wp-bootstrap-navwalker' ) );
} else {
	// File exists... require it.
	require_once get_template_directory() . '/class-wp-bootstrap-navwalker.php';
}




