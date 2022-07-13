;$(function() {
  !function(a){a.fn.equalHeights=function(){var b=0,c=a(this);return c.each(function(){var c=a(this).innerHeight();c>b&&(b=c)}),c.css("height",b)},a("[data-equal]").each(function(){var b=a(this),c=b.data("equal");b.find(c).equalHeights()})}(jQuery);

  $('#search-toggle').click(function() {
    $('.search__modal').toggleClass('search__modal--active')
  })

  $('#search-close').click(function() {
    $('.search__modal').removeClass('search__modal--active')
  })

  var navbar = $('.header-top__social').html();

  var $menu = $(".menu").mmenu({
    extensions: [
      // "fx-menu-slide",
      // "pagedim-black",
      "position-right",
      // "theme-dark",
      "position-front"
    ],
    // slidingSubmenus: false,
    navbar: {
      title: '<img src="/images/Logo.svg"/>',
    },
    navbars: [
      {
         "position": "bottom",
         "content": [
           navbar
         ]
      },
      // {
      //    "position": "top",
      //    "content": [
      //      navbar2
      //    ]
      // }
   ]
  }, {
      clone: true,
  });

  var $hamburger = $(".hamburger");
  var apiMmenu = $menu.data( "mmenu" );

  $hamburger.on( "click", function() {
    if ($(this).hasClass("is-active")) {
      apiMmenu.close();
    } else {
      apiMmenu.open();
    }
  });

  apiMmenu.bind( "open:finish", function() {
     setTimeout(function() {
        $hamburger.addClass( "is-active" );
     }, 100);
  });
  apiMmenu.bind( "close:finish", function() {
     setTimeout(function() {
        $hamburger.removeClass( "is-active" );
     }, 100);
  });

  // $('.mm-listview li .mm-listitem__text').click(function() {
  //   apiMmenu.close();
  // });

  $('.mm-panels').prepend('<div class="mm-close-btn"><svg width="10" height="10" viewBox="0 0 10 10" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M5.00005 3.93955L8.71255 0.227051L9.77305 1.28755L6.06055 5.00005L9.77305 8.71255L8.71255 9.77305L5.00005 6.06055L1.28755 9.77305L0.227051 8.71255L3.93955 5.00005L0.227051 1.28755L1.28755 0.227051L5.00005 3.93955Z" fill="#B3B3B3"/></svg></div>')

  var $li = $('.header-bottom__menu').find('li:nth-child(n+7)');
  $li.wrapAll('<li class="has-sub menu-additional"><ul></ul></li>')
  // console.log($li);
  $('.news-item__title').equalHeights();

  function setBodyPadding() {
    var $body = $('body');
    var $header = $('header.header');
    var headerHeight = $header.height();
    $body.removeAttr('style');
    $body.css('padding-top', headerHeight);
  }

  setBodyPadding();

  $(window).load(function() {
    setBodyPadding();
  })

  $(window).resize(function() {
    setBodyPadding()
  })

  $('body').on('click', function () {
    $('.phone').removeClass('phone--active-modal');
  });

  $('.phone__toggle-modal').click(function(e) {
    e.stopPropagation();
    $(this).closest('.phone').toggleClass('phone--active-modal');
  })

  $('.reviews-list').on('click', '.reviews-item__read-all', function() {
    var $wrap = $(this).closest('.reviews-item__text');
    var $full = $wrap.find('.reviews-item__full');
    var $preview = $wrap.find('.reviews-item__preview');

    if ($wrap.hasClass('reviews-item__text--full')) {
      $wrap.removeClass('reviews-item__text--full');
      $wrap.height($preview.height());
      setTimeout(function() {
        $wrap.removeAttr('style');
      }, 500);
    } else {
      $wrap.addClass('reviews-item__text--full');
      $wrap.height($wrap.height());
      $wrap.height($full.height());
    }
  })

  $('.header-bottom__menu [class^="has-sub"] > a').click(function() {
    return false;
  });
  // $('.contact-button').fancybox({
  //   autofocus: false
  // })

  $('.mm-listitem[class^="has-sub"] .mm-listitem__text').click(function(e) {
    $(this).next('.mm-btn_next').trigger('click');
    e.preventDefault();
  });
});
