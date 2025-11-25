<?php

/**
 * Tempalte Part: Product Header
 */
?>
<div class="row align-items-center">
  <div class="col-md mt-3">
    <?php $content_title = get_field('content-title'); ?>
    <h1 class="mb-0 product-title" id="product-name">
      <?= $content_title ? esc_html($content_title) : get_the_title(); ?>
    </h1>
    <h3 class="lead mt-0"><?php the_field('tagline'); ?></h3>
  </div>
  <div class="col-md d-flex flex-row-reverse">

    <!-- Trigger Button -->
    <button id="openContactModal" data-bs-toggle="modal" data-bs-target="#cnt-modal" class="cnt-btn align-self-center">
      <i class="fa fa-envelope" style="margin-right: 1rem"></i>
      Kostenloses Angebot anfordern
    </button>

    <!-- modal -->
    <div class="modal fade" id="cnt-modal" tabindex="-1" role="dialog">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Kostenloses Angebot anfordern</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>
          <div class="modal-body">
            <?php
            echo do_shortcode('[contact-form-7 id="e8f1edd" title="Simple Contact"]');
            ?>
          </div>
        </div>
      </div>
    </div>
    <!-- /modal -->

    <div class="phone-box d-none d-xl-block">
      <div class="d-flex flex-column">
        <div class="phone-number mb-0">+43 316 682659</div>
        <div class="d-flex align-items-center gap-2 text-muted small status-box">
          <span class="status-dot" id="status-dot"></span>
          <span id="available-text">Jetzt erreichbar</span>
        </div>
      </div>
    </div>
  </div>
</div>

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