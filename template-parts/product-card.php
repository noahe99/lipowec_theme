<?php
// Template part for product cards – angepasst an das Startseiten-Design
?>

<div class="col">
  <div class="card border-0 bg-white h-100 overflow-hidden">
    <div class="position-relative">
      <img 
        src="<?php echo $product['image']; ?>" 
        alt="" 
        class="img-fluid w-100" 
        style="object-fit: cover; height: 260px;">
      <div class="position-absolute bottom-0 start-0 w-100 p-3" 
           style="background: linear-gradient(to top, rgba(0,0,0,0.6), transparent);">
        <h5 class="text-white fw-bold mb-0"><?php echo $product['title']; ?></h5>
      </div>
    </div>
    <div class="card-body px-3 py-4 d-flex flex-column justify-content-between">
      <p class="text-muted mb-3" style="min-height: 60px;">
        <?php echo $product['info']; ?>
      </p>
      <a href="<?php echo BASE_URL . $product['link']; ?>" class="fw-semibold text-dark text-decoration-none">
        Mehr erfahren <i class="bi bi-arrow-right-short"></i>
      </a>
    </div>
  </div>
</div>
