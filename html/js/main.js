function is_mobile() {
  return (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent))
}
$(window).on('load', function() {
  if (!is_mobile()) {
    $('.wrapper-loader').fadeOut(300);
  }
});

jQuery(document).ready(function($) {
  if (is_mobile()) {
    $('.wrapper-loader').fadeOut(1000);
  }

  $(".hamburger").on("click", function() {
    $(this).toggleClass('is-active');
    $('.head-nav').slideToggle(100);
    if (is_mobile()) {
      $('html').toggleClass('is-hidden');
    }
  });

  $(window).resize(function() {
    if ($(window).width() > 767) {
      $('.sidebar-filter').removeAttr('style');
    }
    if ($(window).width() > 577) {
      $('.head-nav').removeAttr('style');
      $(".hamburger").removeClass('is-active');
    }
  });

  if (is_mobile()) {
    $('.head-catalog').on('click', function() {
      $(this).toggleClass('is-active');
      $('html').toggleClass('is-hidden');
    });

    $('.catalog-dropdown_menu  li.parent > a').on('click', function() {
      if ($(this).parent('li').hasClass('parent')) {
        var active = false;
        if ($(this).parent('li').hasClass('is-active')) active = true;
        $('.catalog-dropdown_menu  li.parent').removeClass('is-active');
        if (!active) $(this).parent('li').toggleClass('is-active');
        return false;
      }
    });

    $('.category-item_list-title').on('click', function() {
      var active = false;
      if ($(this).hasClass('is-active')) active = true;
      $('.category-item_list-title').removeClass('is-active');
      if (!active) $(this).toggleClass('is-active');
    });
  }

  $('.head_search_icon').on('click', function() {
    $('.head_form-search').toggleClass('is-active');
  });

  $('.category-item_view-categories').on('click', function() {
    $(this).closest('.category-item_mod').find('.category-item_list').slideToggle(100);
    $(this).closest('.category-item_mod').toggleClass('is-active');
  });

  $('.show-all-filter-btn').on('click', function() {
    if ($(this).html() == 'Свернуть') {
      $(this).removeClass('is-active');
      $(this).siblings('.sidebar-filter_parameters').find('.hidden-filter_parameter').slideUp(100);
      $(this).text('Показать все');
    } else {
      $(this).addClass('is-active');
      $(this).siblings('.sidebar-filter_parameters').find('.hidden-filter_parameter').slideDown(100);
      $(this).text('Свернуть');
    }
  });

  $('.sidebar-filter_block-title').on('click', function() {
    if ($(this).closest('.sidebar-filter_block').hasClass('is-hidden')) {} else {
      $(this).toggleClass('is-active');
    }
    $(this).siblings('.sidebar-filter_block-content').slideToggle(150);
    $(this).closest('.sidebar-filter_block.is-hidden').removeClass('is-hidden');
  });

  $('.hidden_filter-paremeter_btn').on('click', function() {
    $(this).closest('.filter-panel_item').removeClass('is-active');
  });

  $('.filter-panel_item-title').on('click', function() {
    $(this).closest('.filter-panel_item').addClass('is-active');
  });

  $('.sidebar-show_mobile-btn').on('click', function() {
    if ($(this).find('.text').text() == 'Скрыть фильтры') {
      $('.sidebar-filter').slideUp(100);
      $(this).find('.text').text('Показать фильтры');
    } else {
      $('.sidebar-filter').slideDown(100);
      $(this).find('.text').text('Скрыть фильтры');
    }
  });

  $('.head-cart_services-header').on('click', function() {
    $('.head-cart_services-list').slideToggle(100);
    $(this).toggleClass('is-active');
  });

  $(".action-timer").countdown({
    dataAttr: 'cdate',
    template: '<span class="time_number">%d <span class="time_name">Дней </span></span><span class="time_number">%h <span class="time_name">Часов</span></span><span class="time_number">%i <span class="time_name">%ti</span></span>',
    leadingZero: true,
    dayText: 'Дней',
    hourText: 'Часов',
    minText: 'Минут',
    secText: 'Секунд',
    onComplete: function(event) {
      $(this).html('<div class="action-item_time-title">Акция завершена</div>');
      $(this).parents('.action-item_desc').find('.action-item_date').remove();
      $(this).parents('.action-item_desc').find('.timer').remove();
    }
  });

  $('.wrapper-counter-btn').each(function() {
    $(this).find('.product-count').on('input', function() {
      var rep = (/^0/);
      var value = $(this).val();
      if (rep.test(value)) {
        value = value.replace(rep, '');
        $(this).val(value);
      }
      var value2 = $(this).val();
      var rep2 = /[a-zA-Zа-яА-Я]/;
      if (rep2.test(value)) {
        value2 = value2.replace(rep, '');
        $(this).val(value2);
      }
      if ($(this).val() == '') {
        $(this).val(0);
      }
      var msg = $(this).val();
    });
  });
  $('.wrapper-counter-btn').each(function() {
    $(this).find('.counter-back').on("click", function(e) {
      var valPlus = $(this).siblings('.product-count').val();
      var result = parseInt(valPlus) - 1;
      if (result >= 0) {
        $(this).siblings('.product-count').val(result);
      }
      return false;
    });
  });
  $('.wrapper-counter-btn').each(function() {
    $(this).find('.counter-forward').on("click", function(e) {
      var valPlus = $(this).siblings('.product-count').val();
      var result = parseInt(valPlus) + 1;
      if (result >= 0) {
        $(this).siblings('.product-count').val(result);
      }
      return false;
    });
  });

  $('.js-select').selectric({
    maxHeight: 200,
    disableOnMobile: false,
    nativeOnMobile: false,
  });

  /***UI-SLIDER*/
  $("#price-min").on('input', function() {
    var min = 0
    var max = 3000
    var value1 = $("#price-min").val();
    var value2 = $("#price-max").val();
    if (parseInt(value1) > parseInt(value2)) {
      value1 = value2;
      $("#price-min").val(value1);
    }
    var rep = /[a-zA-Zа-яА-Я]/;
    if (rep.test(value1)) {
      value1 = value1.replace(rep, '');
      $("#price-min").val(value1);
    }
    if (Number($("#price-min").val()) > max) $(this).val(max);
    if (Number($("#price-min").val()) < min) $(this).val(min);
    $("#slider-range").slider("values", 0, value1);
  });
  $("#price-max").on('input', function() {
    var min = 0
    var max = 3000
    var value1 = $("#price-min").val();
    var value2 = $("#price-max").val();
    if (parseInt(value1) > parseInt(value2)) {
      value1 = value2;
      $("#price-max").val(value2)
    }
    var rep = /[a-zA-Zа-яА-Я]/;
    if (rep.test(value2)) {
      value2 = value2.replace(rep, '');
      $("#price-max").val(value2);
    }
    if (Number($("#price-max").val()) > max) $(this).val(max);
    if (Number($("#price-max").val()) < min) $(this).val(min);
    $("#slider-range").slider("values", 1, value2);
  });
  $("#slider-range").slider({
    animate: true,
    range: true,
    min: 0,
    max: 3000,
    values: [0, 3000],
    slide: function(event, ui) {
      $("#price-min").val(ui.values[0]);
      $("#price-max").val(ui.values[1]);
    }
  });
  $("#price-min2").on('input', function() {
    var min = 0
    var max = 4
    var value1 = $("#price-min2").val();
    var value2 = $("#price-max2").val();
    if (parseInt(value1) > parseInt(value2)) {
      value1 = value2;
      $("#price-min2").val(value1);
    }
    var rep = /[a-zA-Zа-яА-Я]/;
    if (rep.test(value1)) {
      value1 = value1.replace(rep, '');
      $("#price-min2").val(value1);
    }
    if (Number($("#price-min2").val()) > max) $(this).val(max);
    if (Number($("#price-min2").val()) < min) $(this).val(min);
    $("#slider-range2").slider("values", 0, value1);
  });
  $("#price-max2").on('input', function() {
    var min = 0
    var max = 4
    var value1 = $("#price-min2").val();
    var value2 = $("#price-max2").val();
    if (parseInt(value1) > parseInt(value2)) {
      value1 = value2;
      $("#price-max2").val(value2)
    }
    var rep = /[a-zA-Zа-яА-Я]/;
    if (rep.test(value2)) {
      value2 = value2.replace(rep, '');
      $("#price-max2").val(value2);
    }
    if (Number($("#price-max2").val()) > max) $(this).val(max);
    if (Number($("#price-max2").val()) < min) $(this).val(min);
    $("#slider-range2").slider("values", 1, value2);
  });
  $("#slider-range2").slider({
    animate: true,
    range: true,
    min: 0,
    max: 4,
    values: [0, 4],
    slide: function(event, ui) {
      $("#price-min2").val(ui.values[0]);
      $("#price-max2").val(ui.values[1]);
    }
  });
  $("#price-min3").on('input', function() {
    var min = 0
    var max = 30
    var value1 = $("#price-min3").val();
    var value2 = $("#price-max3").val();
    if (parseInt(value1) > parseInt(value2)) {
      value1 = value2;
      $("#price-min3").val(value1);
    }
    var rep = /[a-zA-Zа-яА-Я]/;
    if (rep.test(value1)) {
      value1 = value1.replace(rep, '');
      $("#price-min3").val(value1);
    }
    if (Number($("#price-min3").val()) > max) $(this).val(max);
    if (Number($("#price-min3").val()) < min) $(this).val(min);
    $("#slider-range2").slider("values", 0, value1);
  });
  $("#price-max3").on('input', function() {
    var min = 0
    var max = 30
    var value1 = $("#price-min3").val();
    var value2 = $("#price-max3").val();
    if (parseInt(value1) > parseInt(value2)) {
      value1 = value2;
      $("#price-max3").val(value2)
    }
    var rep = /[a-zA-Zа-яА-Я]/;
    if (rep.test(value2)) {
      value2 = value2.replace(rep, '');
      $("#price-max3").val(value2);
    }
    if (Number($("#price-max3").val()) > max) $(this).val(max);
    if (Number($("#price-max3").val()) < min) $(this).val(min);
    $("#slider-range3").slider("values", 1, value2);
  });
  $("#slider-range3").slider({
    animate: true,
    range: true,
    min: 0,
    max: 30,
    values: [0, 30],
    slide: function(event, ui) {
      $("#price-min3").val(ui.values[0]);
      $("#price-max3").val(ui.values[1]);
    }
  });

  $(".work-item").each(function(i) {
    $(this).find(".work-item_video-btn").attr("href", "#feedback-" + i);
    $(this).find(".work-item_video-box").attr("id", "feedback-" + i);
  });

  $('.view-mode_list-item').on('click', function() {
    $('.view-mode_list-item').removeClass('is-active');
    $(this).addClass('is-active');
    if ($(this).hasClass('news_view-mode_table')) {
      $('.news-item').removeClass('news-item_list');
      $('.news-mod_content').removeClass('is-active');
    } else {
      $('.news-item').addClass('news-item_list');
      $('.news-mod_content').addClass('is-active');
    }
  });

  $('.js-product-view ').on('click', function() {
    $('.view-mode_list-item').removeClass('is-active');
    $(this).addClass('is-active');
    if ($(this).hasClass('product_view-mode_table')) {
      $('.product-item').removeClass('product-item_list');
      $('.catalog-product_content').removeClass('is-active');
    } else {
      $('.product-item').addClass('product-item_list');
      $('.catalog-product_content').addClass('is-active');
    }
  });

  $('.news-detailed_services-item_header').on('click', function() {
    $(this).closest('.news-detailed_services-item').siblings().removeClass('is-active');
    $(this).closest('.news-detailed_services-item').toggleClass('is-active');
  })

  $('.services-detailed_work-item_header').on('click', function() {
    // $(this).closest('.services-detailed_work-item').siblings().removeClass('is-active');
    $(this).closest('.services-detailed_work-item').toggleClass('is-active');
  })

  function rowHeight() {
    $('.delivery-section_content').find('.right-column').find('.delivery-section_box').each(function(i) {
      var priceLi = $('.delivery-section_content').find('.left-column').find('.delivery-section_box').get(i);
      var height = $(priceLi).outerHeight();
      if ($(this).outerHeight() < height) {
        $(this).outerHeight(height);
      }
    });
  }

  function rowHeight2() {
    $('.delivery-section_content').find('.left-column').find('.delivery-section_box').each(function(i) {
      var priceLi = $('.delivery-section_content').find('.right-column').find('.delivery-section_box').get(i);
      var height = $(priceLi).outerHeight();
      if ($(this).outerHeight() < height) {
        $(this).outerHeight(height);
      }
    });
  }
  if ($(window).width() > 767) {
    rowHeight();
    rowHeight2()
  }
  $(window).resize(function() {
    if ($('.delivery-section_content').length > 0 && $(window).width() > 767) {
      rowHeight();
      rowHeight2()
    }
  });

  function lazyLoad($content) {
    $content.find('img[data-src], source[data-src], audio[data-src], iframe[data-src]').each(function() {
      $(this).attr('src', $(this).data('src'));
      $(this).removeAttr('data-src');
      if ($(this).is('source')) {
        $(this).closest('video').get(0).load();
      }
    });
  }
  lazyLoad($('body'));

  $('.main-slider').slick({
    slidesToShow: 1,
    slidesToScroll: 1,
    fade: true,
    dots: true,
    arrows: false,
  });
  $('.product-slider').slick({
    slidesToShow: 2,
    slidesToScroll: 1,
    dots: true,
    responsive: [{
      breakpoint: 9999,
      settings: "unslick"
    }, {
      breakpoint: 1200,
      settings: {
        slidesToShow: 3,
        slidesToScroll: 1,
      }
    }, {
      breakpoint: 992,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 1,
      }
    }, {
      breakpoint: 767,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 1,
        arrows: false,
        autoplay: true,
        autoplaySpeed: 6000,
      }
    }, {
      breakpoint: 440,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: false,
        autoplay: true,
        autoplaySpeed: 6000,
      }
    }, ]
  });
  $('.product-unified_slider').slick({
    slidesToShow: 4,
    slidesToScroll: 1,
    responsive: [{
      breakpoint: 1200,
      settings: {
        slidesToShow: 3,
        slidesToScroll: 1,
      }
    }, {
      breakpoint: 992,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 1,
      }
    }, {
      breakpoint: 767,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 1,
        dots: true,
        arrows: false,
        autoplay: true,
        autoplaySpeed: 6000,
      }
    }, {
      breakpoint: 440,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1,
        dots: true,
        arrows: false,
        autoplay: true,
        autoplaySpeed: 6000,
      }
    }, ]
  });
  $('.services-slider').slick({
    slidesToShow: 2,
    slidesToScroll: 1,
    dots: true,
    arrows: false,
    autoplay: true,
    autoplaySpeed: 6000,
    responsive: [{
      breakpoint: 9999,
      settings: "unslick"
    }, {
      breakpoint: 767,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 1,
        arrows: false,
        autoplay: true,
        autoplaySpeed: 6000,
      }
    }, {
      breakpoint: 440,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 6000,
      }
    }, ]
  });
  $('.sidebar-services').slick({
    slidesToShow: 2,
    slidesToScroll: 1,
    dots: true,
    arrows: false,
    autoplay: true,
    autoplaySpeed: 6000,
    responsive: [{
      breakpoint: 9999,
      settings: "unslick"
    }, {
      breakpoint: 767,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 1,
        arrows: false,
        autoplay: true,
        autoplaySpeed: 6000,
      }
    }, {
      breakpoint: 440,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 6000,
      }
    }, ]
  });
  $('.news-slider').slick({
    slidesToShow: 2,
    slidesToScroll: 1,
    dots: true,
    responsive: [{
      breakpoint: 9999,
      settings: "unslick"
    }, {
      breakpoint: 1200,
      settings: {
        slidesToShow: 3,
        slidesToScroll: 1,
      }
    }, {
      breakpoint: 992,
      settings: {
        slidesToShow: 3,
        slidesToScroll: 1,
      }
    }, {
      breakpoint: 767,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 1,
        arrows: false,
        autoplay: true,
        autoplaySpeed: 6000,
      }
    }, {
      breakpoint: 440,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: false,
        autoplay: true,
        autoplaySpeed: 6000,
      }
    }, ]
  });
  $('.brands-slider').slick({
    slidesToShow: 4,
    slidesToScroll: 1,
    responsive: [{
      breakpoint: 992,
      settings: {
        slidesToShow: 3,
        slidesToScroll: 1,
      }
    }, {
      breakpoint: 767,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 1,
        autoplay: true,
        arrows: false,
        dots: true,
        autoplaySpeed: 6000,
      }
    }, ]
  });
  $('.js-big-slider-img').slick({
    slidesToShow: 1,
    slidesToScroll: 1,
    arrows: true,
    fade: true,
    asNavFor: '.js-miniature-pictures',
  });
  $('.js-miniature-pictures').slick({
    slidesToShow: 4,
    slidesToScroll: 1,
    arrows: false,
    focusOnSelect: true,
    asNavFor: '.js-big-slider-img',
    responsive: [{
      breakpoint: 767,
      settings: {
        slidesToShow: 3,
      }
    }, {
      breakpoint: 575,
      settings: {
        slidesToShow: 3,
      }
    }, ]
  });
  $('.products_same-series_list').slick({
    slidesToShow: 2,
    slidesToScroll: 1,
    dots: true,
    responsive: [{
      breakpoint: 9999,
      settings: "unslick"
    }, {
      breakpoint: 577,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 1,
        arrows: false,
        autoplay: true,
        autoplaySpeed: 6000,
      }
    }, {
      breakpoint: 400,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: false,
        autoplay: true,
        autoplaySpeed: 6000,
      }
    }, ]
  });

   if (!is_mobile()) {
    $('.product-unified_slider .product-item').hover(function() {
      var item = $(this).outerHeight();
      var item2 = $(this).find('.product-item_hidden').outerHeight();
      $('.product-unified_slider .slick-list').outerHeight(item + item2);
    });
    $('.product-unified_slider').hover(function() {}, function() {
      var item = $(this).find('.product-item').outerHeight();
      $('.product-unified_slider .slick-list').outerHeight(item);
    });
  }

  $('.tab-container').on('click', '.tab:not(.active)', function() {
    $(this).addClass('active').siblings().removeClass('active')
    $(this).closest('.tab-container').find('.tab-item').removeClass('is-visible').eq($(this).index()).addClass('is-visible');
  });

  ( function() {
    var youtube = document.querySelectorAll( ".youtube" );
    for (var i = 0; i < youtube.length; i++) {
        var source = "https://img.youtube.com/vi/"+ youtube[i].dataset.embed +"/sddefault.jpg";
        var image = new Image();
                image.src = source;
                image.addEventListener( "load", function() {
                    youtube[ i ].appendChild( image );
                }( i ) );
        
                youtube[i].addEventListener( "click", function() {
                    var iframe = document.createElement( "iframe" );
                    iframe.setAttribute( "frameborder", "0" );
                    iframe.setAttribute( "allowfullscreen", "" );
                    iframe.setAttribute( "src", "https://www.youtube.com/embed/"+ this.dataset.embed +"?rel=0&showinfo=0&autoplay=1" );
                    this.innerHTML = "";
                    this.appendChild( iframe );
                } );    
    };
} )();

  $(".fancybox").fancybox({
    afterLoad: function(instance, current) {
      if (!is_mobile()) {
        $('.fixed-menu').addClass('is-overflow');
        $('.scroll-to-top').addClass('is-hidden');
      }
    },
    afterClose: function(instance, current) {
      if (!is_mobile()) {
        $('.fixed-menu').removeClass('is-overflow');
        $('.scroll-to-top').removeClass('is-hidden');
      }
    }
  });

  if (!is_mobile()) {
    $('.js-modal').on('show.bs.modal', function(event) {
      $('.fixed-menu').addClass('is-overflow');
      $('.scroll-to-top').addClass('is-hidden');
    });
    $('.js-modal').on('hidden.bs.modal', function(event) {
      $('.fixed-menu').removeClass('is-overflow');
      $('.scroll-to-top').removeClass('is-hidden');
    });
  }

  var heightTopHead = $('.ui-header').outerHeight();
  var lastScrollTop = 0;
  jQuery(window).on("scroll load resize", function() {
    if ($(window).scrollTop() > heightTopHead) {
       $('.ui-header').addClass('fixed-menu');
       $('.global-wrapper').addClass('global-pad');
       setTimeout(function() {
         $('.ui-header').addClass('scroll-transform');
       }, 100);
    } else {
      $('.ui-header').removeClass('fixed-menu');
      $('.ui-header').removeClass('scroll-transform');
      $('.global-wrapper').removeClass('global-pad');
    }
    if ($(window).scrollTop() > $(window).height()) {
      $('.scroll-to-top').addClass('scroll-to-top-visible');
    } else {
      $('.scroll-to-top').removeClass('scroll-to-top-visible');
    }
  });
  $('.scroll-to-top').on('click', function() {
    $('html, body').animate({
      scrollTop: 0
    }, 800);
    return false;
  });

  $('input[type="tel"]').inputmask("+7 (999) 999 99 99", {
    "clearIncomplete": true,
    showMaskOnHover: false,
  });
});
if ($('.map-container').length) {
  YaMapsShown = false;
  $(window).on("scroll load resize", function() {
    if (!YaMapsShown) {
      if ($(window).scrollTop() + $(window).height() > $('.map-container').offset().top - 100) {
        showYaMaps();
        YaMapsShown = true;
      }
    }
  });

  function showYaMaps() {
    var script = document.createElement("script");
    script.type = "text/javascript";
    script.src = "https://api-maps.yandex.ru/2.1/?lang=ru_RU";
    document.getElementById("map").appendChild(script);
    script.onload = function() {
      ymaps.ready(init);
      var myMap,
        myPlacemark;

      function init() {
        myMap = new ymaps.Map("map", {
          center: [51.64389407230797, 39.29436749999995],
          zoom: 13,
          behaviors: ['default', 'scrollZoom'],
        });
        myMap.behaviors.disable('scrollZoom');
        myMap.geoObjects.add(new ymaps.Placemark([51.64389407230797, 39.29436749999995], {
          iconCaption: 'г. Воронеж, Монтажный проезд, д. 26',
        }, {
          // Опции.
          // Необходимо указать данный тип макета.
          preset: 'islands#redDotIconWithCaption',
          // iconImageHref: 'img/icons/marker-icon.png',
          // Размеры метки.
        }));
        myMap.geoObjects.add(myPlacemark);
        // }
      }
    }
  }
}