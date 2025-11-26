<?php
function enqueue_home_assets()
{
  wp_enqueue_style('home-style', get_stylesheet_directory_uri() . '/assets/css/home.css');
  wp_enqueue_script('home-script', get_stylesheet_directory_uri() . '/assets/js/home.js', array('jquery'), null, true);
}
add_action('wp_enqueue_scripts', 'enqueue_home_assets');

get_header();
?>

<main class="home">

  <?php $hero_slides = get_field('hero_section') ?>
  
  

<section class="d-block d-md-none hp-padding">
    <div class="container mobile-hero d-flex align-items-center position-relative" style="background-image: url('/wp-content/uploads/2025/07/hero_aiola.webp');">
        
        <div class="position-absolute w-100 h-100" style="top: 0; left: 0; background-color: rgba(0, 0, 0, 0.25); z-index: 1;"></div>
        <div class="" style="z-index: 2;">
            <h1 class="display-6 fw-bold mb-3 text-white">
                Sonnen- & Wetterschutz
            </h1>
            <p class="mobile-p">
              Von der persönlichen Beratung über die Planung bis zur fachgerechten Montage - wir realisieren individuelle Lösungen für private und gewerbliche Außenbereiche.
            </p>
            <a href="#produkte" class="btn btn-primary">
                Produkte entdecken
            </a>
        </div>
    </div>
</section>



<section id="heroImageSlider" class="carousel slide carousel-fade hero-slider d-none d-md-block" data-bs-ride="carousel">


  <div class="carousel-indicators">
    <?php foreach ($hero_slides as $key => $slide): ?>
      <button type="button" 
              data-bs-target="#heroImageSlider" 
              data-bs-slide-to="<?php echo $key; ?>"
              class="<?php if ($key == 0) echo 'active'; ?>"
              aria-current="<?php if ($key == 0) echo 'true'; ?>"
              aria-label="Slide <?php echo $key + 1; ?>">
      </button>
    <?php endforeach; ?>
  </div>

  <!-- Wrapper für die Slides -->
  <div class="carousel-inner">
    <?php foreach ($hero_slides as $key => $slide): 
      $image = $slide['image'];
      $headline = $slide['heading'];
      $subheadline = $slide['subheading'];
      $cta_url = $slide['cta_url'];
    ?>
      <div class="carousel-item <?php if ($key == 0) echo 'active'; ?>" 
          style="background-image: url('<?php echo esc_url($image['url']); ?>'); position: relative;">

        <div class="hero-overlay"></div>

        <!-- Centered headline only for first slide -->
        <?php if ($key === 0): ?>
            <div class="hero-headline-first container">
                <h2 class="text-white fw-bold display-2 mb-0">
                    <?= $headline ?>
                </h2>
            </div>
        <?php endif; ?>


        <!-- Bottom card (always stays at bottom) -->
        <div class="container h-100 d-flex align-items-end text-white">
        <div class="hero-card <?php if ($key != 0) { echo 'mb-5'; } ?> <?php if ($key === 0) { echo 'hero-card-first'; } ?>">

            <?php if ($key !== 0): ?>
              <h2><?= $headline; ?></h2>
            <?php endif; ?>

            <p><?= $subheadline ?></p>

            <div class="hero-buttons">
              <a href="/kontaktieren-sie-uns/" class="btn btn-primary px-4">
                Jetzt unverbindlich beraten lassen
              </a>
              <a href="<?= $cta_url; ?>" class="btn btn-outline-light px-4">
                <?php if ($key === 0) {
                  echo "Mehr über Lipowec erfahren";
                }
                else {
                  echo "Produkte entdecken";
                }
                ?>
              </a>
            </div>
          </div>
        </div>

      </div>
    <?php endforeach; ?>
  </div>



  <!-- Vorherige/Nächste Steuerelemente -->
  <button class="carousel-control-prev" type="button" data-bs-target="#heroImageSlider" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Nächste</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#heroImageSlider" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Zurück</span>
  </button>

</section>

<div class="d-block d-md-none"></div>

  <div class="container-lg">
    <div class="row mt-5 mb-0" id="categories">
      <div class="col-md-6">
        <h1 class="fw-bold home-lead d-none d-md-block">
            Entdecken Sie unsere Lösungen für Terrasse, Garten & mehr
        </h1>

        <h1 class="fw-bold home-lead d-block d-md-none py-3">
            Unsere Produktkategorien
        </h1>
        </div>
        <div class="col-md-6 d-none d-md-block">
          <p>LIPOWEC bietet hochwertigen Sonnen- und Wetterschutz für Ihren Außenbereich - ob Zuhause, 
            im Gastgarten oder auf der Hotelterrasse. Unsere Lösungen wie Terrassenüberdachungen, Großschirm-Systeme, 
            Windschutz, Heizstrahler, Möbel und Pavillons vereinen Qualität, Design und Funktionalität</p>
      </div>
    </div>
        
    <div class="container-lg px-0 position-relative">
      <div class="scroll-wrapper">
        <div class="row flex-nowrap g-0">

          <?php $categories_new = get_field('product_categories'); ?>
          <?php foreach($categories_new as $cat): ?>
            <div class="col-8 col-md-6 col-lg-3 p-1">
              <a href="<?= esc_url( $cat['link'] ) ?>">
                <?php $image = wp_get_attachment_image_src( $cat['image'], 'large' );
                  if ($image && isset($image[0])) {
                    $image_url = esc_url($image[0]);
                  } ?>
                <div class="category has-bg-img" style="background-image: url( <?= $image_url ?> )">
                  <div class="overlay-cat"></div>
                  <span class="card-title"><?= $cat['name'] ?><i class="fa fa-chevron-right"></i></span>
                </div>
              </a>
            </div>

          <?php endforeach; ?>

        </div>
      </div>
    </div>

    <?php $section1 = get_field('content_section_1'); ?>
    <div class="row align-items-center about pt-5">
      <div class="col-md-6">
        <h3 class="fw-semibold"><?= $section1['h3']; ?></h3>
        <p class="mb-4"><?= $section1['paragraph']; ?></p>
        <a href="/kontaktieren-sie-uns/" class="cnt-btn-front">Kostenlose Kontaktanfrage senden</a>
      </div> <!-- /col-12 -->
      <?php $image_ids = $section1['images']; ?>
      <div class="col-md-6 position-relative about_img_wrapper d-none d-md-block">
          
        <?php render_image($image_ids[0], 'about_img main', 'large'); ?>
        <?php render_image($image_ids[1], 'about_img top-right', 'large'); ?>
        <?php render_image($image_ids[2], 'about_img bottom-left', 'large'); ?>
          
      </div>
    </div>






  <?php 
      $features = get_field('features');
  ?>

  <section class="py-5 position-relative">
    <div class="container">
      <div class="row text-center mb-5">
        <div class="col d-none d-md-block">
          <h3 class="fw-semibold mb-2"><?= $features['heading'] ?></h3>
          <p class="text-muted mb-0"><?= $features['subheading'] ?></p>
        </div>
      </div>

      <div class="row text-center g-4">
      <?php
        $points = $features['points'];

        foreach($points as $point) : 
      ?>
        <div class="col-md-3">
          <div 
            class="feature-box p-4 shadow rounded-4 h-100 position-relative overflow-hidden" 
            style="--bg-img: url('<?= esc_url( $point['background']['url'] ) ?>');"
          >
            <div class="mb-3">
              <i class="bi bi-geo-alt display-5 text-primary"></i>
            </div>
            <h4 class="fw-bold mb-2 point-heading"><?= $point['heading'] ?></h4>
            <p class="text-muted mb-0">
              <?= $point['content'] ?>
            </p>
          </div>
        </div>
      <?php endforeach; ?>
      </div>
  </section>

    <?php $showroom = get_field('showroom'); ?>
    <section class="container-fluid py-5">
      <div class="row align-items-center">
        <div class="col-md-6 d-none d-md-block">
        <?php render_image($showroom['image'], 'showroom', 'large'); ?>  
        </div>

        <div class="col-md-6 p-4">
          <h3 class="fw-semibold"><?= $showroom['headline'] ?></h3>
          <p class="mb-4"> <?= $showroom['paragraph'] ?> </p>
          <a href="/kontaktieren-sie-uns/" class="cnt-btn-front">Kostenlose Kontaktanfrage senden</a>
        </div>
      </div>
    </section>
    
    <div class="py-5">
    <?php echo do_shortcode('[trustindex no-registration=google]'); ?>
    </div>

    <div class="row py-5">
      <div class="col-sm">
        <h3 class="fw-bold mb-0">Beratung & Service</h3>
        <p class="lead mt-0 sub">Wir helfen Ihnen gerne weiter</p>

        <div class="row">
          <div class="col-sm">
            <p>
              Das Wohlbefinden Ihrer Gäste und die Gestaltung Ihres Outdoor-Bereiches
              ist uns wichtig, deshalb legen wir großen Wert auf persönliche Beratung
              - gemeinsam realisieren wir Ihre Vorstellungen mit Kompetenz,
              Professionalität und Freundlichkeit.
            </p>
          </div>
          <div class="col-sm">
            Unsere speziell geschulten Mitarbeiter beraten Sie persönlich bei der
            Auswahl des passenden Produktes, so schaffen wir traumhafte Wirklichkeiten
            in höchster Qualität. Zugleich bieten wir Ihnen faire Preise und einen
            Kundenservice, der jeden Tag Herausragendes leistet.
          </div>
        </div>

        <div class="row">
          <p><strong>Telefon</strong><br>Gerne können Sie uns auch direkt telefonisch erreichen.
            Unsere Service Zeiten sind Montag bis Donnerstag von 8:00 Uhr bis 12:00 Uhr. Außerhalb dieser
            Zeit bleiben wir weiterhin per E-Mail oder Kontaktformular erreichbar.</p>
          <div class="phone-box d-none d-xl-flex align-items-center gap-3">
            <img src="/wp-content/uploads/2025/07/service-telefon.jpg" alt="Profilbild" class="profile-img" />
            <div class="d-flex flex-column">
              <div class="phone-number mb-0">+43 316 682659</div>
              <div class="d-flex align-items-center gap-2 text-muted small status-box">
                <span class="status-dot red" id="status-dot"></span>
                <span id="available-text">Zurzeit nicht erreichbar</span>
              </div>
            </div>
          </div>
        </div>

        <div class="row mt-4">
          <p><strong>E-Mail <br> </strong>
            Sie können uns auch direkt per E-Mail erreichen. Wir bemühen uns Ihr Anliegen schnelltsmöglich zu bearbeiten.</p>
          <p class="type"><i class="fa fa-envelope" style="margin-right: 5px;"></i><a href="mailto:info@lipowec.at">info@lipowec.at</a></p>
        </div>
      </div>
      <div class="col-sm">
        <div class="simple_contact">
          <h3>Kontaktieren Sie uns</h3>
          <?php echo do_shortcode('[forminator_form id="6169"]'); ?>
        </div>
      </div>
    </div>

   

  </div>
</main>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    const statusDot = document.getElementById('status-dot');
    const span = document.getElementById('available-text');
    const now = new Date();

    const day = now.getDay();
    const hour = now.getHours();

    const isWeekday = day >= 1 && day <= 4;
    const isWorkingHours = hour >= 8 && hour < 12;

    if (isWeekday && isWorkingHours) {
      statusDot.classList.add('green');
      statusDot.classList.remove('red');
      span.innerHTML = "Jetzt erreichbar"
    } else {
      statusDot.classList.add('red');
      statusDot.classList.remove('green');
      span.innerHTML = "Zurzeit nicht erreichbar"
    }
  });


  
</script>
<?php get_footer() ?>