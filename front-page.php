<<<<<<< HEAD
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
  
  
<section id="heroImageSlider" class="carousel slide hero-slider" data-bs-ride="carousel">

  <!-- Indikatoren (die kleinen Punkte am unteren Rand) -->
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
      // Holen Sie die Werte aus den Sub-Feldern für den aktuellen Slide.
      $image = $slide['image'];
      $headline = $slide['heading'];
      $subheadline = $slide['subheading'];
      $cta_url = $slide['cta_url'];
    ?>
      <div class="carousel-item <?php if ($key == 0) echo 'active'; ?>" style="background-image: url('<?php echo esc_url($image['url']); ?>');">        
        <div class="container h-100 d-flex align-items-center text-white">
          <div>
            <h2 class="display-5 fw-bold mb-3"><?php echo $headline; ?></h2>
            <p class="muted mb-5"><?php echo $subheadline; ?></p>
            <div class="d-flex flex-column flex-md-row gap-3">
              <a href="/kontaktieren-sie-uns/" class="btn btn-primary px-4">Jetzt unverbindlich beraten lassen</a>
              <a href="<?php echo $cta_url; ?>" class="btn btn-outline-light px-4">Unsere Produkte entdecken</a>
            </div>
          </div>
        </div>

      </div>
    <?php endforeach; ?>
  </div>

  <!-- Vorherige/Nächste Steuerelemente -->
  <button class="carousel-control-prev" type="button" data-bs-target="#heroImageSlider" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#heroImageSlider" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>

</section>

  
  <!--
  <section class="position-relative text-white d-flex align-items-center"
    style="height: 75vh; background: linear-gradient(to bottom, rgba(0,0,0,0.15), rgba(0,0,0,0.05)), url('<?= $hero_content['background_image'] ?>') center center / cover no-repeat;">
    <div id="hero-container" class="container z-1">
      <h1 class="display-5 fw-bold mb-3"><?= $hero_content['headline']; ?></h1>
      <p class="muted mb-5"><?= $hero_content['subheadline']; ?></p>
      <div class="d-flex flex-column flex-md-row gap-3">
        <a href="/kontaktieren-sie-uns/" class="btn btn-primary px-4">Jetzt unverbindlich beraten lassen</a>
        <a href="#categories" class="btn btn-outline-light px-4">Unsere Produkte entdecken</a>
      </div>
    </div>
  </section>
  -->




  <div class="container-lg">
    <?php $categories = get_field('categories'); ?>
    <div class="row mt-5 mb-0" id="categories">
      <div class="col-md-6">
        <h2 class="fw-bold home-lead"><?= $categories['h2']; ?></h2>
      </div>
      <div class="col-md-6">
        <p><?= $categories['paragraph']; ?></p>
      </div>
    </div>

    <div class="container-lg position-relative">
      <div class="scroll-wrapper">
        <div class="row flex-nowrap g-0">
          <?php
          
          $category_json = json_decode($categories['category_json'], true);

          foreach ($category_json as $cat) {
            echo '<div class="col-12 col-md-6 col-lg-3">';
            echo '<a href="' . $cat['link'] . '">';
            echo '<div class="category has-bg-img" style="background-image: url(\'' . $cat['image'] . '\')">';

            echo '<div class="overlay-cat"></div>';
            echo '<span class="card-title">' . $cat['name'] . '<i class="fa-solid fa-chevron-right"></i></span>';

            echo '</div>';
            echo '</a>';
            echo '</div>';
          }
          ?>
        </div>
      </div>
    </div>

    <?php $section1 = get_field('content_section_1'); ?>
    <div class="row align-items-center about pt-5" data-aos="fade-up">
      <div class="col-md-6">
        <h3 class="fw-semibold"><?= $section1['h3']; ?></h3>
        <p class="mb-4"><?= $section1['paragraph']; ?></p>
        <a href="/kontaktieren-sie-uns/" class="cnt-btn-front">Kostenlose Kontaktanfrage senden</a>
      </div> <!-- /col-12 -->

      <?php $images = json_decode($section1['image_json'], true); ?>
      <div class="col-md-6 position-relative about_img_wrapper d-none d-md-block">
        <img src="<?= $images[0]; ?>" class="img-fluid about_img main" alt="Lipowec Allwetter Schirme Gastro">
        <img src="<?= $images[1]; ?>" class="img-fluid about_img top-right" alt="Lipowec Pergola System Renderbild Gastro">
        <img src="<?= $images[2]; ?>" class="img-fluid about_img bottom-left" alt="Lipowec Markise wasserdicht Gastro">
      </div>
    </div>



  <?php 
      $features = get_field('features');
  ?>

  <section class="py-5 position-relative" data-aos="fade-up">
    <div class="container">
      <div class="row text-center mb-5">
        <div class="col">
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
            <h5 class="fw-bold mb-2"><?= $point['heading'] ?></h5>
            <p class="text-muted mb-0">
              <?= $point['content'] ?>
            </p>
          </div>
        </div>
      <?php endforeach; ?>
      </div>
  </section>

    <?php $showroom = get_field('showroom'); ?>
    <section class="container-fluid py-5" data-aos="fade-up">
      <div class="row align-items-center">
        <div class="col-md-6 d-none d-md-block showroom" style="background-image: url('<?= $showroom['image']; ?>'); background-size: cover; background-position: center; min-height: 400px;">
        </div>

        <div class="col-md-6 p-4">
          <h3 class="fw-semibold"><?= $showroom['headline'] ?></h3>
          <p class="mb-4"> <?= $showroom['paragraph'] ?> </p>
          <a href="/kontaktieren-sie-uns/" class="cnt-btn-front">Kostenlose Kontaktanfrage senden</a>
        </div>
      </div>
    </section>
    
    <div data-aos="fade-up" class="py-5">
    <?php echo do_shortcode('[trustindex no-registration=google]'); ?>
    </div>

    <div class="row py-5" data-aos="fade-up">
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
          <p class="type"><i class="fa-solid fa-envelope" style="margin-right: 5px;"></i><a href="mailto:info@lipowec.at">info@lipowec.at</a></p>
        </div>
      </div>
      <div class="col-sm">
        <div class="simple_contact">
          <h3>Kontaktieren Sie uns</h3>
          <?php echo do_shortcode('[contact-form-7 id="e8f1edd" title="Simple Contact"]'); ?>
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
=======
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
  
  
<section id="heroImageSlider" class="carousel slide hero-slider" data-bs-ride="carousel">

  <!-- Indikatoren (die kleinen Punkte am unteren Rand) -->
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
      // Holen Sie die Werte aus den Sub-Feldern für den aktuellen Slide.
      $image = $slide['image'];
      $headline = $slide['heading'];
      $subheadline = $slide['subheading'];
      $cta_url = $slide['cta_url'];
    ?>
      <div class="carousel-item <?php if ($key == 0) echo 'active'; ?>" style="background-image: url('<?php echo esc_url($image['url']); ?>');">        
        <div class="container h-100 d-flex align-items-center text-white">
          <div>
            <h2 class="display-5 fw-bold mb-3"><?php echo $headline; ?></h2>
            <p class="muted mb-5"><?php echo $subheadline; ?></p>
            <div class="d-flex flex-column flex-md-row gap-3">
              <a href="/kontaktieren-sie-uns/" class="btn btn-primary px-4">Jetzt unverbindlich beraten lassen</a>
              <a href="<?php echo $cta_url; ?>" class="btn btn-outline-light px-4">Unsere Produkte entdecken</a>
            </div>
          </div>
        </div>

      </div>
    <?php endforeach; ?>
  </div>

  <!-- Vorherige/Nächste Steuerelemente -->
  <button class="carousel-control-prev" type="button" data-bs-target="#heroImageSlider" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#heroImageSlider" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>

</section>

  
  <!--
  <section class="position-relative text-white d-flex align-items-center"
    style="height: 75vh; background: linear-gradient(to bottom, rgba(0,0,0,0.15), rgba(0,0,0,0.05)), url('<?= $hero_content['background_image'] ?>') center center / cover no-repeat;">
    <div id="hero-container" class="container z-1">
      <h1 class="display-5 fw-bold mb-3"><?= $hero_content['headline']; ?></h1>
      <p class="muted mb-5"><?= $hero_content['subheadline']; ?></p>
      <div class="d-flex flex-column flex-md-row gap-3">
        <a href="/kontaktieren-sie-uns/" class="btn btn-primary px-4">Jetzt unverbindlich beraten lassen</a>
        <a href="#categories" class="btn btn-outline-light px-4">Unsere Produkte entdecken</a>
      </div>
    </div>
  </section>
  -->




  <div class="container-lg">
    <?php $categories = get_field('categories'); ?>
    <div class="row mt-5 mb-0" id="categories">
      <div class="col-md-6">
        <h2 class="fw-bold home-lead"><?= $categories['h2']; ?></h2>
      </div>
      <div class="col-md-6">
        <p><?= $categories['paragraph']; ?></p>
      </div>
    </div>

    <div class="container-lg position-relative">
      <div class="scroll-wrapper">
        <div class="row flex-nowrap g-0">
          <?php
          
          $category_json = json_decode($categories['category_json'], true);

          foreach ($category_json as $cat) {
            echo '<div class="col-12 col-md-6 col-lg-3">';
            echo '<a href="' . $cat['link'] . '">';
            echo '<div class="category has-bg-img" style="background-image: url(\'' . $cat['image'] . '\')">';

            echo '<div class="overlay-cat"></div>';
            echo '<span class="card-title">' . $cat['name'] . '<i class="fa-solid fa-chevron-right"></i></span>';

            echo '</div>';
            echo '</a>';
            echo '</div>';
          }
          ?>
        </div>
      </div>
    </div>

    <?php $section1 = get_field('content_section_1'); ?>
    <div class="row align-items-center about pt-5" data-aos="fade-up">
      <div class="col-md-6">
        <h3 class="fw-semibold"><?= $section1['h3']; ?></h3>
        <p class="mb-4"><?= $section1['paragraph']; ?></p>
        <a href="/kontaktieren-sie-uns/" class="cnt-btn-front">Kostenlose Kontaktanfrage senden</a>
      </div> <!-- /col-12 -->

      <?php $images = json_decode($section1['image_json'], true); ?>
      <div class="col-md-6 position-relative about_img_wrapper d-none d-md-block">
        <img src="<?= $images[0]; ?>" class="img-fluid about_img main" alt="Lipowec Allwetter Schirme Gastro">
        <img src="<?= $images[1]; ?>" class="img-fluid about_img top-right" alt="Lipowec Pergola System Renderbild Gastro">
        <img src="<?= $images[2]; ?>" class="img-fluid about_img bottom-left" alt="Lipowec Markise wasserdicht Gastro">
      </div>
    </div>



  <?php 
      $features = get_field('features');
  ?>

  <section class="py-5 position-relative" data-aos="fade-up">
    <div class="container">
      <div class="row text-center mb-5">
        <div class="col">
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
            <h5 class="fw-bold mb-2"><?= $point['heading'] ?></h5>
            <p class="text-muted mb-0">
              <?= $point['content'] ?>
            </p>
          </div>
        </div>
      <?php endforeach; ?>
      </div>
  </section>

    <?php $showroom = get_field('showroom'); ?>
    <section class="container-fluid py-5" data-aos="fade-up">
      <div class="row align-items-center">
        <div class="col-md-6 d-none d-md-block showroom" style="background-image: url('<?= $showroom['image']; ?>'); background-size: cover; background-position: center; min-height: 400px;">
        </div>

        <div class="col-md-6 p-4">
          <h3 class="fw-semibold"><?= $showroom['headline'] ?></h3>
          <p class="mb-4"> <?= $showroom['paragraph'] ?> </p>
          <a href="/kontaktieren-sie-uns/" class="cnt-btn-front">Kostenlose Kontaktanfrage senden</a>
        </div>
      </div>
    </section>
    
    <div data-aos="fade-up" class="py-5">
    <?php echo do_shortcode('[trustindex no-registration=google]'); ?>
    </div>

    <div class="row py-5" data-aos="fade-up">
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
          <p class="type"><i class="fa-solid fa-envelope" style="margin-right: 5px;"></i><a href="mailto:info@lipowec.at">info@lipowec.at</a></p>
        </div>
      </div>
      <div class="col-sm">
        <div class="simple_contact">
          <h3>Kontaktieren Sie uns</h3>
          <?php echo do_shortcode('[contact-form-7 id="e8f1edd" title="Simple Contact"]'); ?>
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
>>>>>>> master
<?php get_footer() ?>