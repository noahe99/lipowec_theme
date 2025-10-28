
document.querySelectorAll('[data-bs-toggle="dropdown"]').forEach(el => {
  el.removeAttribute('data-bs-toggle');
});


document.addEventListener('DOMContentLoaded', function() {
  const allDropdownLinks = document.querySelectorAll('.navbar-nav .dropdown > a, .navbar-nav .dropdown-submenu > a');

  allDropdownLinks.forEach(link => {
    link.dataset.tapped = 'false';

    link.addEventListener('click', function(e) {
      const parent = link.parentElement;
      const submenu = parent.querySelector('.dropdown-menu');
      const isMobile = window.innerWidth < 992; // ab wann Touch-Modus aktiv ist

      if (isMobile) {
        if (link.dataset.tapped === 'false') {
          // Erster Klick -> Menü öffnen
          e.preventDefault();
          link.dataset.tapped = 'true';
          parent.classList.toggle('show');
          if (submenu) submenu.classList.toggle('show');

          // Nach 1,5 Sekunde zurücksetzen, falls kein zweiter Klick kommt
          setTimeout(() => link.dataset.tapped = 'false', 1500);
        } else {
          // Zweiter Klick -> weiterleiten
          window.location = link.href;
        }
      }
    });
  });
});