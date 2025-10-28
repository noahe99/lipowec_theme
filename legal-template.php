<?php
/**
 * Template Name: Legal
 */
get_header();
?>

<style>
h1.position-relative::after {
  content: "";
  position: absolute;
  bottom: -12px;
  left: 50%;
  width: 200px;
  height: 2px;
  background-color: #dee2e6;
  transform: translateX(-50%);
  border-radius: 2px;
}

.page-content p {
  margin-bottom: 1rem;
  line-height: 1.7;
}

.page-content strong {
  color: #212529;
}

.page-content a {
  color: #0d6efd;
  text-decoration: none;
}

.page-content a:hover {
  text-decoration: underline;
}
</style>

<div class="container-lg my-5">
  <div class="bg-white shadow-sm rounded-3 p-5 mx-auto" style="max-width: 900px;">
    <main>
      <h1 class="fw-semibold h3 mb-5 text-center position-relative">
        <?php the_title(); ?>
      </h1>
      <div class="page-content fs-5 text-body">
        <?php the_content(); ?>
      </div>
    </main>
  </div>
</div>

<?php get_footer(); ?>
