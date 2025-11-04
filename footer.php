			<?php
			wp_enqueue_style('footer-style', get_stylesheet_directory_uri() . '/assets/css/footer.css');

			?>
			</main><!-- /#main -->

			<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
<a href="https://wa.me/4367763520292" class="float" target="_blank">
<i class="fa fa-whatsapp my-float"></i>
</a>

			<footer id="footer">
							<div class="footer-image-column d-none d-md-block">
				<img src="/wp-content/uploads/2025/07/LIPOWEC_seit_1918.jpg" alt="Dekoratives Bild" class="footer-image">
			</div>
				<div class="container">
					<div class="row">
						<div class="col-md-6">
							<?php
							// get lipowec logo
							$logo_url = get_theme_mod('header_logo');
							?>
							<img src=<?php echo $logo_url ?> class="footer-logo" alt="Lipowec Logo">

							<?php
							// renders footer menu from wp 
							if (has_nav_menu('footer-menu')) : // See function register_nav_menus() in functions.php
								wp_nav_menu(
									array(
										'container'       => 'nav',
										'container_class' => 'col-md-6',
										'container_id'    => 'footer-navigation',
										'container_aria_label' => 'Footer Navigation',
										//'fallback_cb'     => 'WP_Bootstrap4_Navwalker_Footer::fallback',
										'walker'          => new WP_Bootstrap4_Navwalker_Footer(),
										'theme_location'  => 'footer-menu',
										'items_wrap'      => '<ul class="nav-footer">%3$s</ul>',
									)
								);
							endif;
							?>

							<ul class="social-media">
									<li>
											<a rel="noopener noreferrer" href="https://www.instagram.com/lipowec_sonnenschutz/" class="social-links" aria-label="Lipowec auf Instagram">
													<i class="fa-brands fa-instagram" aria-hidden="true"></i>
													<span class="sr-only">Instagram</span>
											</a>
									</li>
									<li>
											<a rel="noopener noreferrer" href="https://www.facebook.com/lipowecsonnenschutz/?locale=de_DE" class="social-links" aria-label="Lipowec auf Facebook">
													<i class="fa-brands fa-facebook" aria-hidden="true"></i>
													<span class="sr-only">Facebook</span>
											</a>
									</li>
									<li>
											<a rel="noopener noreferrer" href="https://at.linkedin.com/company/lipowec-gmbh" class="social-links" aria-label="Lipowec auf LinkedIn">
													<i class="fa-brands fa-linkedin" aria-hidden="true"></i>
													<span class="sr-only">LinkedIn</span>
											</a>
									</li>
							</ul>



						</div>
						<div class="col-md-3 footer">
							<h4>Kontakt</h4>
							<div class="footer-contact">
								<p class="type mb-0"><i class="fa-solid fa-envelope" style="margin-right: 5px;"></i>Email </p>
								<a href="mailto:info@lipowec.at" class="text-decoration-none">info@lipowec.at</a>
								<p class="type mb-0"><i class="fa-solid fa-phone" style="margin-right: 5px;"></i>Telefon </p>
								<a href="tel:+43316682659" class="text-decoration-none" style="margin-top: -15px">+43 316 682659</a>
							</div>

							<a href="/kontaktieren-sie-uns/" class="btn btn-secondary mt-3">Kontakformular</a>
						</div>
						<div class="col-md-3 footer">
							<h4>Öffnungszeiten</h4>
							<p><i class="fa-solid fa-clock" style="margin-right: 5px;"></i>Öffnungszeiten</p>
							<p style="margin-top: -15px;">Montag bis Donnerstag:<br>
								8:00 - 12:00 & 13:00 - 16:00</p>
							<p><i class="fa-solid fa-location-dot" style="margin-right: 5px"></i>Adresse</p>
							<p style="margin-top: -15px;">Eggenberger Gürtel 49 <br>
								A-8020 Graz</p>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<p class="copyright"><?php printf(esc_html__('&copy; %1$s Lipowec GmbH. Alle Rechte vorbehalten.', 'lipo_bootstrap'), wp_date('Y')); ?></p>
							<p class="host-info">Betreuung & Design, Online-Marketing & Hosting von LIPOWEC Handels GmbH & Dieter Biernat, perfectnet.at </p>
						</div>
					</div><!-- /.row -->
				</div><!-- /.container -->

			</footer><!-- /#footer -->
			</div><!-- /#wrapper -->
			<?php
			wp_footer();
			?>
			</body>

			<script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
			<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/glightbox/dist/css/glightbox.min.css">
			<script src="https://cdn.jsdelivr.net/npm/glightbox/dist/js/glightbox.min.js"></script>

			<script>
				AOS.init();

				document.addEventListener('DOMContentLoaded', function() {
					const dropdown = document.getElementById('anfrage-art');
					const adressFields = document.getElementById('adress-cf7');
					const infoBox = document.getElementById('info-cf7');

					if (dropdown) {
						dropdown.addEventListener('change', function() {
							adressFields.style.display = "none";
							infoBox.style.display = "none";


							if (this.value === 'Produktanfrage') {
								adressFields.style.display = "flex";
								infoBox.style.display = "block";

							}
						});
					}
				});

				document.addEventListener('DOMContentLoaded', function() {
					const lightbox = GLightbox({ selector: '.glightbox' });
				});

			</script>

			</html>