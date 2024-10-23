(function($) {
  'use strict';
  
  $(function() {
    var body = $('body');
    var sidebar = $('.sidebar');

    // Function to add active class to nav-link based on the current URL
    function addActiveClass() {
      var currentPath = window.location.pathname; // Get the current path
      $('.nav li a', sidebar).each(function() {
        var link = $(this);
        // Check if the link's href matches the current path
        if (link.attr('href') === currentPath) {
          link.parents('.nav-item').last().addClass('active'); // Add active class to parent nav item
          if (link.parents('.sub-menu').length) {
            link.closest('.collapse').addClass('show'); // Expand the submenu if necessary
            link.addClass('active'); // Add active class to the link
          }
        }
      });
    }

    // Initialize the active class
    addActiveClass();

    // Close other submenu in sidebar when opening a new one
    sidebar.on('show.bs.collapse', '.collapse', function() {
      sidebar.find('.collapse.show').collapse('hide');
    });

    // Apply Perfect Scrollbar to specific elements if applicable
    function applyScrollbar() {
      if (!body.hasClass("rtl")) {
        if ($('.settings-panel .tab-content .tab-pane.scroll-wrapper').length) {
          new PerfectScrollbar('.settings-panel .tab-content .tab-pane.scroll-wrapper');
        }
        if ($('.chats').length) {
          new PerfectScrollbar('.chats');
        }
        if (body.hasClass("sidebar-fixed") && $('#sidebar').length) {
          new PerfectScrollbar('#sidebar .nav');
        }
      }
    }

    // Event for minimizing the sidebar
    $('[data-bs-toggle="minimize"]').on("click", function() {
      body.toggleClass('sidebar-hidden sidebar-icon-only', !body.hasClass('sidebar-toggle-display') && !body.hasClass('sidebar-absolute'));
    });

    // Checkbox and radio button enhancements
    $(".form-check label, .form-radio label").append('<i class="input-helper"></i>');

    // Horizontal menu toggle for mobile
    $('[data-toggle="horizontal-menu-toggle"]').on("click", function() {
      $(".horizontal-menu .bottom-navbar").toggleClass("header-toggled");
    });

    // Horizontal menu navigation click behavior
    $('.horizontal-menu .page-navigation > .nav-item').on("click", function(event) {
      if (window.matchMedia('(max-width: 991px)').matches) {
        var $this = $(this);
        if (!$this.hasClass('show-submenu')) {
          $('.horizontal-menu .page-navigation > .nav-item').removeClass('show-submenu');
        }
        $this.toggleClass('show-submenu');
      }        
    });

    // Fixed header on scroll
    $(window).scroll(function() {
      if (window.matchMedia('(min-width: 992px)').matches) {
        $('.horizontal-menu').toggleClass('fixed-on-scroll', $(window).scrollTop() >= 70);
      }
    });

    // Focus on search input when the icon is clicked
    $('#navbar-search-icon').click(function() {
      $("#navbar-search-input").focus();
    });

    // Apply styles and scrollbars
    applyScrollbar();
  });
})(jQuery);
