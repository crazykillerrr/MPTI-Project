(function() {
  "use strict";
  function toggleScrolled() {
    const selectBody = document.querySelector('body');
    const selectHeader = document.querySelector('#header');
    if (!selectHeader.classList.contains('scroll-up-sticky') && !selectHeader.classList.contains('sticky-top') && !selectHeader.classList.contains('fixed-top')) return;
    window.scrollY > 100 ? selectBody.classList.add('scrolled') : selectBody.classList.remove('scrolled');
  }

  document.addEventListener('scroll', toggleScrolled);
  window.addEventListener('load', toggleScrolled);

  /**
   * Preloader
   */
  const preloader = document.querySelector('#preloader');
  if (preloader) {
    window.addEventListener('load', () => {
      preloader.remove();
    });
  }

  /**
   * Scroll top button
   */
  let scrollTop = document.querySelector('.scroll-top');

  function toggleScrollTop() {
    if (scrollTop) {
      window.scrollY > 100 ? scrollTop.classList.add('active') : scrollTop.classList.remove('active');
    }
  }  
  scrollTop.addEventListener('click', (e) => {
    e.preventDefault();
    window.scrollTo({
      top: 0,
      behavior: 'smooth'
    });
  });

  window.addEventListener('load', toggleScrollTop);
  document.addEventListener('scroll', toggleScrollTop);

  document.addEventListener('DOMContentLoaded', function () {
    const searchToggle = document.getElementById('searchToggle');
    const searchContainer = document.querySelector('.search-container');
    const searchInput = document.getElementById('searchInput');
  
    // Toggle input pencarian
    searchToggle.addEventListener('click', function (e) {
      e.stopPropagation();
      searchContainer.classList.toggle('active');
      if (searchContainer.classList.contains('active')) {
        searchInput.focus();
      } else {
        searchInput.blur();
      }
    });
  
    // Tutup saat klik di luar input
    document.addEventListener('click', function (e) {
      if (!searchContainer.contains(e.target)) {
        searchContainer.classList.remove('active');
      }
    });
  });
  



  /**
   * Animation on scroll function and init
   */
  function aosInit() {
    AOS.init({
      duration: 600,
      easing: 'ease-in-out',
      once: true,
      mirror: false
    });
  }
  window.addEventListener('load', aosInit);

 
  /**
   * Correct scrolling position upon page load for URLs containing hash links.
   */
  window.addEventListener('load', function(e) {
    if (window.location.hash) {
      if (document.querySelector(window.location.hash)) {
        setTimeout(() => {
          let section = document.querySelector(window.location.hash);
          let scrollMarginTop = getComputedStyle(section).scrollMarginTop;
          window.scrollTo({
            top: section.offsetTop - parseInt(scrollMarginTop),
            behavior: 'smooth'
          });
        }, 100);
      }
    }
  });

  /**
   * Navmenu Scrollspy
   */
  let navmenulinks = document.querySelectorAll('.navmenu a');

  function navmenuScrollspy() {
    navmenulinks.forEach(navmenulink => {
      if (!navmenulink.hash) return;
      let section = document.querySelector(navmenulink.hash);
      if (!section) return;
      let position = window.scrollY + 200;
      if (position >= section.offsetTop && position <= (section.offsetTop + section.offsetHeight)) {
        document.querySelectorAll('.navmenu a.active').forEach(link => link.classList.remove('active'));
        navmenulink.classList.add('active');
      } else {
        navmenulink.classList.remove('active');
      }
    })
  }
  window.addEventListener('load', navmenuScrollspy);
  document.addEventListener('scroll', navmenuScrollspy);

  document.addEventListener('DOMContentLoaded', () => {
  const selectAll = document.getElementById('selectAll');
  const cartItemsContainer = document.getElementById('cart-items');
  const itemChecks = () => cartItemsContainer.querySelectorAll('.item-check');
  const totalPriceEl = document.getElementById('total-price');
  const itemCountEl = document.getElementById('item-count');
  const emptyCartEl = document.querySelector('.empty-cart');

  function updateSummary() {
    let total = 0, count = 0;
    const items = cartItemsContainer.querySelectorAll('.cart-item');

    items.forEach(item => {
      const cb = item.querySelector('.item-check');
      const qty = parseInt(item.querySelector('.quantity').value);
      const price = parseInt(item.dataset.price);
      if (cb.checked) {
        total += price * qty;
        count++;
      }
    });

    totalPriceEl.textContent = total.toLocaleString('id-ID');
    itemCountEl.textContent = count;

    // Tampilkan pesan kosong
    emptyCartEl.classList.toggle('d-none', items.length > 0);
  }

  cartItemsContainer.addEventListener('click', e => {
    let btn;
    if (e.target.matches('.increase, .increase *')) {
      btn = e.target.closest('.increase');
      const qty = btn.previousElementSibling;
      qty.value = parseInt(qty.value) + 1;
      updateSummary();
    }
    if (e.target.matches('.decrease, .decrease *')) {
      btn = e.target.closest('.decrease');
      const qty = btn.nextElementSibling;
      if (parseInt(qty.value) > 1) qty.value = parseInt(qty.value) - 1;
      updateSummary();
    }
    if (e.target.matches('.delete, .delete *')) {
      btn = e.target.closest('.delete');
      btn.closest('.cart-item').remove();
      updateSummary();
    }
  });

  cartItemsContainer.addEventListener('change', e => {
    if (e.target.matches('.item-check')) updateSummary();
  });

  selectAll.addEventListener('change', () => {
    itemChecks().forEach(cb => cb.checked = selectAll.checked);
    updateSummary();
  });

  updateSummary();
});

  let jumlah = 1;
  const harga = 3000000;

  function updateSubtotal() {
    document.getElementById("jumlah").innerText = jumlah;
    document.getElementById("subtotal").innerText = "Rp" + (jumlah * harga).toLocaleString("id-ID");
  }

  // Buat fungsi bisa diakses dari HTML dengan window
  window.tambahJumlah = function () {
    jumlah++;
    updateSubtotal();
  }

  window.kurangiJumlah = function () {
    if (jumlah > 1) {
      jumlah--;
      updateSubtotal();
    }
  }

  window.addEventListener('load', updateSubtotal);

  window.toggleProfileDropdown = function () {
    const dropdown = document.getElementById('profileDropdown');
    dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
  }
  document.addEventListener('click', function (e) {
    const dropdown = document.getElementById('profileDropdown');
    const button = e.target.closest('button[title="Profile"]');
    const insideDropdown = e.target.closest('.profile-dropdown');

    if (!button && !insideDropdown) {
      dropdown.style.display = 'none';
    }
  });

  document.addEventListener('DOMContentLoaded', function () {
    const container = document.querySelector('.slider-container');
    const next = document.getElementById('nextBtn');
    const prev = document.getElementById('prevBtn');
  
    next.addEventListener('click', () => {
      container.scrollBy({ left: 300, behavior: 'smooth' });
    });
  
    prev.addEventListener('click', () => {
      container.scrollBy({ left: -300, behavior: 'smooth' });
    });
  });


  document.addEventListener('DOMContentLoaded', function() {
    const statusButtons = document.querySelectorAll('.status-buttons button');

    statusButtons.forEach(button => {
        button.addEventListener('click', function() {
            statusButtons.forEach(btn => btn.classList.remove('active'));
            this.classList.add('active');
        });
    });

    const shopButton = document.querySelector('.empty-state button');
    shopButton.addEventListener('click', function() {
        alert('Belanja Sekarang!');
    });
});


})();