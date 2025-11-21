<!DOCTYPE html>
<html lang="de">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="/assets/aos/aos.css">
	<?php wp_head(); ?>

</head>

<?php	
	$navbar_scheme   = get_theme_mod( 'navbar_scheme', 'navbar-light bg-light' ); // Get custom meta-value.
	$navbar_position = get_theme_mod( 'navbar_position', 'static' ); // Get custom meta-value.

	$search_enabled  = get_theme_mod( 'search_enabled', '1' ); // Get custom meta-value.
?>

<body <?php body_class(); ?>>

<?php wp_body_open(); ?>

<a href="#main" class="visually-hidden-focusable"><?php esc_html_e( 'Skip to main content', 'lipo_bootstrap' ); ?></a>

<div id="wrapper">
	<header>
	<nav style="padding: 0;" class="navbar navbar-expand-xl fixed-top custom-navbar <?php echo is_front_page() ? 'navbar-home' : 'navbar-default'; ?>">
		<div class="container">
			<?php $header_logo = get_theme_mod( 'header_logo' )  ?>
			<!-- Logo -->
			<?php if ( is_front_page() ) : ?>
				<h2 class="navbar-brand">
					<a href="<?php echo esc_url( home_url() ); ?>">
						<img id="header-logo" src="<?php echo esc_url( $header_logo ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" />
					</a>
				</h2>
			<?php else : ?>
				<a class="navbar-brand" href="<?php echo esc_url( home_url() ); ?>">
					<img id="header-logo" src="<?php echo esc_url( $header_logo ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" />
				</a>
			<?php endif; ?>


			<!-- Burger -->
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav" aria-controls="mainNav" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>

			<!-- Menu -->
			<div class="collapse navbar-collapse justify-content-center" id="mainNav">
				<?php
					wp_nav_menu( array(
						'theme_location'  => 'main-menu',
						'depth'           => 3,
						'container'       => false,
						'menu_class'      => 'navbar-nav me-auto',
						'fallback_cb'     => 'WP_Bootstrap_Navwalker::fallback',
						'walker'          => new WP_Bootstrap_Navwalker(),
					) );
				?>
				
				<a href="<?php echo BASE_URL . "/kontaktieren-sie-uns/" ?>">
					<button id="contact-nav">Kontaktieren Sie uns</button>
				</a>
			</div>

			</div>
		</nav>
	</header>
					

	<?php if (is_front_page()) : ?>
	<script>
		window.addEventListener("scroll", function () {
			const navbar = document.querySelector(".custom-navbar");

			if (window.scrollY > 100) {
				navbar.classList.remove("navbar-home");
				navbar.classList.add("navbar-default");
			} else {
				navbar.classList.add("navbar-home");
				navbar.classList.remove("navbar-default");
			}
		});


	</script>
	<?php endif; ?>