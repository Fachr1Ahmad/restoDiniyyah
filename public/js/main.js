(function ($) {
  ("use strict");

  // Dropdown on mouse hover
  $(document).ready(function () {
    function toggleNavbarMethod() {
      if ($(window).width() > 992) {
        $(".navbar .dropdown")
          .on("mouseover", function () {
            $(".dropdown-toggle", this).trigger("click");
          })
          .on("mouseout", function () {
            $(".dropdown-toggle", this).trigger("click").blur();
          });
      } else {
        $(".navbar .dropdown").off("mouseover").off("mouseout");
      }
    }
    toggleNavbarMethod();
    $(window).resize(toggleNavbarMethod);
  });

  // Back to top button
  $(window).scroll(function () {
    // Menampilkan tombol Back to Top saat scroll
    if ($(this).scrollTop() > 100) {
      $(".back-to-top").addClass("show"); // Menambahkan kelas show untuk menampilkan tombol
    } else {
      $(".back-to-top").removeClass("show"); // Menghapus kelas show untuk menyembunyikan tombol
    }
  });

  $(".back-to-top").click(function () {
    // Animasi scroll kembali ke atas
    $("html, body").animate({ scrollTop: 0 }, 1500, "easeInOutExpo");
    return false; // Mencegah default action
  });

  // Date and time picker
  $(".date").datetimepicker({
    format: "L",
  });
  $(".time").datetimepicker({
    format: "LT",
  });
  // Testimonials carousel
  $(".testimonial-carousel").owlCarousel({
    autoplay: true,
    smartSpeed: 1500,
    margin: 30,
    dots: true,
    loop: true,
    center: true,
    responsive: {
      0: {
        items: 1,
      },
      576: {
        items: 1,
      },
      768: {
        items: 2,
      },
      992: {
        items: 3,
      },
    },
  });
  // Menu carousel dengan peningkatan modern
  $(".menu-carousel").owlCarousel({
    autoplay: true, // Menambahkan auto play
    smartSpeed: 1000, // Menurunkan waktu smart speed untuk transisi lebih halus
    margin: 30,
    dots: true, // Menampilkan navigasi titik
    loop: true,
    center: true,
    responsive: {
    0: {
        items: 1, // Untuk perangkat sangat kecil, menampilkan 1 item
    },
    576: {
    items: 1, // Menampilkan 1 item pada perangkat kecil
    },
    768: {
    items: 2, // Menampilkan 2 item pada perangkat dengan ukuran lebih besar
    },
    992: {
    items: 3, // Menampilkan 3 item untuk ukuran layar besar
    },
    },
    nav: true, // Menambahkan tombol navigasi sebelumnya dan berikutnya
    navText: [
    '<span class="prev">&#10094;</span>',
    '<span class="next">&#10095;</span>',
    ], // Membuat ikon navigasi custom
    animateOut: "fadeOut", // Efek fade saat transisi antar item
    animateIn: "fadeIn", // Efek fade saat masuknya item
});

  // Testimonials carousel
  $(".testimonial-carousel").owlCarousel({
    autoplay: true,
    smartSpeed: 1500,
    margin: 30,
    dots: true,
    loop: true,
    center: true,
    responsive: {
      0: {
        items: 1,
      },
      576: {
        items: 1,
      },
      768: {
        items: 2,
      },
      992: {
        items: 3,
      },
    },
  });
})(jQuery);

