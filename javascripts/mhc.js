Element.prototype.hasClass = function(className) {
  return this.className && new RegExp("(^|\\s)" + className + "(\\s|$)").test(this.className);
};


(function() {
  'use strict';

  var body = document.getElementsByTagName('body')[0],
  mhc = {
    init: function() {
      this.scrollHeader();
      this.offscreenNav();
    },
    scrollHeader: function() {
      var featured = document.getElementById('featured-image'),
          f_text   = featured.getElementsByClassName('js-featured_text')[0];
    
      window.onscroll = function() {
        if (window.pageYOffset <= featured.offsetHeight) {
          f_text.style.top = 55 - ( (window.pageYOffset / 4) * 0.2) + "%";
        }
      };
    },
    offscreenNav: function() {
      var mobile_trigger = document.getElementById('menu-trigger'),
          close_mobile   = document.getElementById('close-button'),
          content        = document.querySelector('.content-wrap'),
          is_open = false;

      function toggleMenu() {
        if ( is_open ) { body.classList.remove('show-menu'); }
        else { body.classList.add('show-menu'); }
        is_open = !is_open;
      }

      mobile_trigger.addEventListener('click', toggleMenu);
      if (close_mobile) { close_mobile.addEventListener('click', toggleMenu); }

      content.addEventListener( 'click', function(ev) {
        var target = ev.target;
        if( is_open && target !== mobile_trigger ) { toggleMenu(); }
      });
    }
  };
  
  mhc.init();
  
})();