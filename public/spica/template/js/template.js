(function ($) {
  'use strict';
  $(function () {
    var body = $('body');
    var sidebar = $('.sidebar');
    var navbar = $('.navbar').not('.top-navbar');
    var currentUrl = window.location.pathname.toLowerCase();

    // =============================
    // 🌟 1. Highlight Menu Aktif
    // =============================
    function addActiveClass(element) {
      const href = (element.attr('href') || '').toLowerCase();
      if (!href || href === '#') return;

      // Jika URL sama persis dengan href
      if (currentUrl === href) {
        element.addClass('active');
        element.parents('.nav-item').addClass('active');
        const parentCollapse = element.closest('.collapse');
        if (parentCollapse.length) parentCollapse.addClass('show');
      }
      // Jika URL mengandung href (misal /barang)
      else if (currentUrl.includes(href) && href !== '#') {
        element.addClass('active');
      }
    }

    $('.nav li a', sidebar).each(function () {
      addActiveClass($(this));
    });

    // Pastikan hanya 1 collapse yang terbuka (menu aktif)
    var firstActive = sidebar.find('.nav-link.active').first();
    if (firstActive.length) {
      sidebar.find('.collapse').removeClass('show');
      firstActive.closest('.collapse').addClass('show');
    }

    // =============================
    // 🌟 2. Sidebar Collapse Manual
    // =============================
    sidebar.on('show.bs.collapse', '.collapse', function () {
      sidebar.find('.collapse.show').not(this).collapse('hide');
    });

    // =============================
    // 🌟 3. Sidebar Toggle (minimize / icon-only)
    // =============================
    $('[data-toggle="minimize"]').on("click", function () {
      if (body.hasClass('sidebar-toggle-display')) {
        body.toggleClass('sidebar-hidden');
      } else {
        body.toggleClass('sidebar-icon-only');
      }
    });

    // =============================
    // 🌟 4. Checkbox dan Radio Custom
    // =============================
    $(".form-check label, .form-radio label").append('<i class="input-helper"></i>');

    // =============================
    // 🌟 5. Fixed Navbar di Scroll
    // =============================
    $(window).scroll(function () {
      if (window.matchMedia('(min-width: 991px)').matches) {
        if ($(window).scrollTop() >= 197) {
          navbar.addClass('navbar-mini fixed-top');
          body.addClass('navbar-fixed-top');
        } else {
          navbar.removeClass('navbar-mini fixed-top');
          body.removeClass('navbar-fixed-top');
        }
      } else {
        navbar.addClass('navbar-mini fixed-top');
        body.addClass('navbar-fixed-top');
      }
    });

    // =============================
    // 🌟 6. Banner Promo (Spica)
    // =============================
    if ($.cookie('spica-free-banner') !== "true") {
      document.querySelector('#proBanner')?.classList.add('d-flex');
    } else {
      document.querySelector('#proBanner')?.classList.add('d-none');
    }

    document.querySelector('#bannerClose')?.addEventListener('click', function () {
      document.querySelector('#proBanner')?.classList.add('d-none');
      document.querySelector('#proBanner')?.classList.remove('d-flex');
      var date = new Date();
      date.setTime(date.getTime() + 24 * 60 * 60 * 1000);
      $.cookie('spica-free-banner', "true", { expires: date });
    });

    // =============================
    // 🌟 7. Animasi Arrow (rotate)
    // =============================
    $('.sidebar .nav-item a[data-bs-toggle="collapse"]').on('click', function () {
      const arrow = $(this).find('.menu-arrow');
      const parentCollapse = $($(this).attr('href'));

      // Tutup semua arrow lain
      $('.menu-arrow').not(arrow).removeClass('rotate');

      // Toggle arrow aktif
      if (parentCollapse.hasClass('show')) {
        arrow.removeClass('rotate');
      } else {
        arrow.addClass('rotate');
      }
    });
  });
})(jQuery);
