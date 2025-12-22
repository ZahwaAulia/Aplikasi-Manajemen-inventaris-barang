// Basic Argon Dashboard JavaScript
(function() {
  'use strict';

  // Sidenav toggler
  var sidenavToggler = document.querySelector('#iconNavbarSidenav');
  if (sidenavToggler) {
    sidenavToggler.addEventListener('click', function() {
      var body = document.querySelector('body');
      var sidenav = document.querySelector('.sidenav');
      var togglerInner = document.querySelector('.sidenav-toggler-inner');

      if (body.classList.contains('g-sidenav-show')) {
        body.classList.remove('g-sidenav-show');
        if (togglerInner) {
          togglerInner.classList.remove('toggled');
        }
      } else {
        body.classList.add('g-sidenav-show');
        if (togglerInner) {
          togglerInner.classList.add('toggled');
        }
      }
    });
  }

  // Close sidenav on mobile when clicking outside
  var sidenavMain = document.querySelector('#sidenav-main');
  if (sidenavMain) {
    document.addEventListener('click', function(event) {
      var body = document.querySelector('body');
      var toggler = document.querySelector('#iconNavbarSidenav');

      if (body.classList.contains('g-sidenav-show') &&
          !sidenavMain.contains(event.target) &&
          event.target !== toggler &&
          !toggler.contains(event.target)) {
        body.classList.remove('g-sidenav-show');
        var togglerInner = document.querySelector('.sidenav-toggler-inner');
        if (togglerInner) {
          togglerInner.classList.remove('toggled');
        }
      }
    });
  }

  // Initialize tooltips
  var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
  var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl);
  });

  // Initialize popovers
  var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'));
  var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
    return new bootstrap.Popover(popoverTriggerEl);
  });

  // Dropdown menu positioning
  var dropdowns = document.querySelectorAll('.dropdown');
  dropdowns.forEach(function(dropdown) {
    var menu = dropdown.querySelector('.dropdown-menu');
    if (menu) {
      dropdown.addEventListener('shown.bs.dropdown', function() {
        var rect = menu.getBoundingClientRect();
        var viewportWidth = window.innerWidth;
        var viewportHeight = window.innerHeight;

        if (rect.right > viewportWidth) {
          menu.style.left = 'auto';
          menu.style.right = '0';
        }

        if (rect.bottom > viewportHeight) {
          menu.style.top = 'auto';
          menu.style.bottom = '100%';
        }
      });
    }
  });

  // Form validation
  var forms = document.querySelectorAll('.needs-validation');
  Array.prototype.slice.call(forms).forEach(function(form) {
    form.addEventListener('submit', function(event) {
      if (!form.checkValidity()) {
        event.preventDefault();
        event.stopPropagation();
      }
      form.classList.add('was-validated');
    }, false);
  });

  // Auto-hide alerts
  var alerts = document.querySelectorAll('.alert');
  alerts.forEach(function(alert) {
    if (!alert.classList.contains('alert-permanent')) {
      setTimeout(function() {
        var bsAlert = new bootstrap.Alert(alert);
        bsAlert.close();
      }, 5000);
    }
  });

  // Initialize any charts if Chart.js is available
  if (typeof Chart !== 'undefined') {
    // Chart initialization would go here
  }

  // Copy to clipboard functionality
  var copyButtons = document.querySelectorAll('[data-copy]');
  copyButtons.forEach(function(button) {
    button.addEventListener('click', function() {
      var text = button.getAttribute('data-copy');
      if (text) {
        navigator.clipboard.writeText(text).then(function() {
          // Show success feedback
          var originalText = button.textContent;
          button.textContent = 'Copied!';
          setTimeout(function() {
            button.textContent = originalText;
          }, 2000);
        });
      }
    });
  });

  // Search functionality
  var searchInput = document.querySelector('.input-group input[type="text"]');
  if (searchInput) {
    searchInput.addEventListener('input', function() {
      var query = searchInput.value.toLowerCase();
      var searchableItems = document.querySelectorAll('[data-searchable]');

      searchableItems.forEach(function(item) {
        var text = item.textContent.toLowerCase();
        if (text.includes(query)) {
          item.style.display = '';
        } else {
          item.style.display = 'none';
        }
      });
    });
  }

  // Table sorting
  var sortableHeaders = document.querySelectorAll('th[data-sort]');
  sortableHeaders.forEach(function(header) {
    header.style.cursor = 'pointer';
    header.addEventListener('click', function() {
      var table = header.closest('table');
      var tbody = table.querySelector('tbody');
      var rows = Array.from(tbody.querySelectorAll('tr'));
      var column = header.getAttribute('data-sort');
      var direction = header.getAttribute('data-direction') || 'asc';

      rows.sort(function(a, b) {
        var aVal = a.querySelector('[data-' + column + ']').textContent.trim();
        var bVal = b.querySelector('[data-' + column + ']').textContent.trim();

        if (direction === 'asc') {
          return aVal.localeCompare(bVal);
        } else {
          return bVal.localeCompare(aVal);
        }
      });

      if (direction === 'asc') {
        header.setAttribute('data-direction', 'desc');
      } else {
        header.setAttribute('data-direction', 'asc');
      }

      rows.forEach(function(row) {
        tbody.appendChild(row);
      });
    });
  });

  // Modal enhancements
  var modals = document.querySelectorAll('.modal');
  modals.forEach(function(modal) {
    modal.addEventListener('shown.bs.modal', function() {
      var autofocus = modal.querySelector('[autofocus]');
      if (autofocus) {
        autofocus.focus();
      }
    });
  });

  // Progress bars animation
  var progressBars = document.querySelectorAll('.progress-bar');
  var observer = new IntersectionObserver(function(entries) {
    entries.forEach(function(entry) {
      if (entry.isIntersecting) {
        var bar = entry.target;
        var width = bar.getAttribute('data-width') || bar.style.width;
        bar.style.width = '0%';
        setTimeout(function() {
          bar.style.width = width;
        }, 100);
      }
    });
  });

  progressBars.forEach(function(bar) {
    observer.observe(bar);
  });

  // Ripple effect for buttons
  var buttons = document.querySelectorAll('.btn');
  buttons.forEach(function(button) {
    button.addEventListener('click', function(e) {
      var ripple = document.createElement('span');
      ripple.className = 'ripple-effect';
      ripple.style.left = (e.offsetX - 10) + 'px';
      ripple.style.top = (e.offsetY - 10) + 'px';
      button.appendChild(ripple);

      setTimeout(function() {
        ripple.remove();
      }, 600);
    });
  });

  // Add ripple effect styles
  var style = document.createElement('style');
  style.textContent = `
    .ripple-effect {
      position: absolute;
      border-radius: 50%;
      background: rgba(255, 255, 255, 0.4);
      transform: scale(0);
      animation: ripple 0.6s linear;
      pointer-events: none;
    }

    @keyframes ripple {
      to {
        transform: scale(4);
        opacity: 0;
      }
    }

    .btn {
      position: relative;
      overflow: hidden;
    }
  `;
  document.head.appendChild(style);

  // Initialize on page load
  document.addEventListener('DOMContentLoaded', function() {
    console.log('Argon Dashboard initialized');
  });

})();
