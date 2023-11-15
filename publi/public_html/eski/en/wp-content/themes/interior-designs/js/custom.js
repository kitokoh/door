jQuery(function($){
  "use strict";
  jQuery('.main-menu-navigation > ul').superfish({
    delay:       500,
    animation:   {opacity:'show',height:'show'},
    speed:       'fast'
  });
});

function interior_designs_menu_open() {
  jQuery(".side-menu").addClass('open');
}
function interior_designs_menu_close() {
  jQuery(".side-menu").removeClass('open');
}

function interior_designs_search_show() {
  jQuery(".search-outer").addClass('show');
  jQuery(".search-outer").fadeIn();
}
function interior_designs_search_hide() {
  jQuery(".search-outer").removeClass('show');
  jQuery(".search-outer").fadeOut();
}

(function( $ ) {
  $(window).scroll(function(){
    var sticky = $('.sticky-header'),
    scroll = $(window).scrollTop();
    if (scroll >= 100) sticky.addClass('fixed-header');
    else sticky.removeClass('fixed-header');
  });

  // Back to top
  jQuery(document).ready(function () {
    jQuery(window).scroll(function () {
      if (jQuery(this).scrollTop() > 0) {
        jQuery('.scrollup').fadeIn();
      } else {
        jQuery('.scrollup').fadeOut();
      }
    });
    jQuery('.scrollup').click(function () {
      jQuery("html, body").animate({
        scrollTop: 0
      }, 600);
      return false;
    });
  });

  // Window load function
  window.addEventListener('load', (event) => {
    $(".preloader").delay(2000).fadeOut("slow");
  });
 
})( jQuery );

( function( window, document ) {
  function interior_designs_keepFocusInMenu() {
    document.addEventListener( 'keydown', function( e ) {
      const interior_designs_nav = document.querySelector( '.side-menu' );

      if ( ! interior_designs_nav || ! interior_designs_nav.classList.contains( 'open' ) ) {
        return;
      }

      const elements = [...interior_designs_nav.querySelectorAll( 'input, a, button' )],
        interior_designs_lastEl = elements[ elements.length - 1 ],
        interior_designs_firstEl = elements[0],
        interior_designs_activeEl = document.activeElement,
        tabKey = e.keyCode === 9,
        shiftKey = e.shiftKey;

      if ( ! shiftKey && tabKey && interior_designs_lastEl === interior_designs_activeEl ) {
        e.preventDefault();
        interior_designs_firstEl.focus();
      }

      if ( shiftKey && tabKey && interior_designs_firstEl === interior_designs_activeEl ) {
        e.preventDefault();
        interior_designs_lastEl.focus();
      }
    } );
  }

  function interior_designs_keepfocus_search() {
    document.addEventListener( 'keydown', function( e ) {
      const interior_designs_search = document.querySelector( '.search-outer' );

      if ( ! interior_designs_search || ! interior_designs_search.classList.contains( 'show' ) ) {
        return;
      }

      const elements = [...interior_designs_search.querySelectorAll( 'input, a, button' )],
        interior_designs_lastEl = elements[ elements.length - 1 ],
        interior_designs_firstEl = elements[0],
        interior_designs_activeEl = document.activeElement,
        tabKey = e.keyCode === 9,
        shiftKey = e.shiftKey;

      if ( ! shiftKey && tabKey && interior_designs_lastEl === interior_designs_activeEl ) {
        e.preventDefault();
        interior_designs_firstEl.focus();
      }

      if ( shiftKey && tabKey && interior_designs_firstEl === interior_designs_activeEl ) {
        e.preventDefault();
        interior_designs_lastEl.focus();
      }
    } );
  }

  interior_designs_keepFocusInMenu();

  interior_designs_keepfocus_search();
} )( window, document );