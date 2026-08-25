function is_mobile() {
  return (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent))
}
$(window).on('load', function() {
  if (!is_mobile()) {
    $('.wrapper-loader').fadeOut(300);
  }
});

jQuery(document).on("click", ".unified-checkbox a", function () {
	$(this).parent('.checkbox-text').trigger( "click" );
	return false;
});

jQuery(document).on("click", ".unified-radio a", function () {
	$(this).parent('.radio-text').trigger( "click" );
	return false;
});

jQuery(document).ready(function($) {
  if (is_mobile()) {
    $('.wrapper-loader').fadeOut(1000);
  }

    $('.slider_product_show_all#tag_menu_b').slick({
        slidesToShow: 6,
        slidesToScroll: 1,
        arrows: true,
        dots: false,
        infinite: true,
  variableWidth: true,

        responsive: [
            {
                breakpoint: 1319,
                settings: {
                    arrows: true,
                    slidesToShow: 3
                }
            },
            {
                breakpoint: 1019,
                settings: {
                    arrows: true,
                    slidesToShow: 3
                }
            }
            ,
            {
                breakpoint: 660,
                settings: {
                    arrows: true,
                    slidesToShow: 1
                }
            }
        ]
    })

    $('.navi .open').on('click',function(){
        $('.tag_menu_bc').hide();
        $('.tag_menu_all').show();
        $('.navi .open').removeClass('is-act');
        $('.navi .closem').addClass('is-act');
        return false;
    });

    $('.navi .closem').on('click',function(){
        $('.tag_menu_bc').show();
        $('.tag_menu_all').hide();
        $('.navi .open').addClass('is-act');
        $('.navi .closem').removeClass('is-act');
        return false;
    });

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



  $('.js-select').selectric({
    maxHeight: 200,
    disableOnMobile: false,
    nativeOnMobile: false,
  });


  var minPrice = parseFloat(filterPrice.minPrice);
  var maxPrice = parseFloat(filterPrice.maxPrice);

  var minPrice_2 = parseFloat(filterPrice_2.minPrice);
  var maxPrice_2 = parseFloat(filterPrice_2.maxPrice);

  var minPrice_3 = parseFloat(filterPrice_3.minPrice);
  var maxPrice_3 = parseFloat(filterPrice_3.maxPrice);

  var minPrice_4 = parseFloat(filterPrice_4.minPrice);
  var maxPrice_4 = parseFloat(filterPrice_4.maxPrice);

  var minPrice_5 = parseFloat(filterPrice_5.minPrice);
  var maxPrice_5 = parseFloat(filterPrice_5.maxPrice);

  var minPrice_6 = parseFloat(filterPrice_6.minPrice);
  var maxPrice_6 = parseFloat(filterPrice_6.maxPrice);

  var minPrice_7 = parseFloat(filterPrice_7.minPrice);
  var maxPrice_7 = parseFloat(filterPrice_7.maxPrice);

  var minPrice_8 = parseFloat(filterPrice_8.minPrice);
  var maxPrice_8 = parseFloat(filterPrice_8.maxPrice);

  var minPrice_9 = parseFloat(filterPrice_9.minPrice);
  var maxPrice_9 = parseFloat(filterPrice_9.maxPrice);

  var minPrice_10 = parseFloat(filterPrice_10.minPrice);
  var maxPrice_10 = parseFloat(filterPrice_10.maxPrice);

  var minPrice_11 = parseFloat(filterPrice_11.minPrice);
  var maxPrice_11 = parseFloat(filterPrice_11.maxPrice);

  var minPrice_12 = parseFloat(filterPrice_12.minPrice);
  var maxPrice_12 = parseFloat(filterPrice_12.maxPrice);

  var minPrice_13 = parseFloat(filterPrice_13.minPrice);
  var maxPrice_13 = parseFloat(filterPrice_13.maxPrice);

  var minPrice_14 = parseFloat(filterPrice_14.minPrice);
  var maxPrice_14 = parseFloat(filterPrice_14.maxPrice);

  var minPrice_15 = parseFloat(filterPrice_15.minPrice);
  var maxPrice_15 = parseFloat(filterPrice_15.maxPrice);

  var minPrice_16 = parseFloat(filterPrice_16.minPrice);
  var maxPrice_16 = parseFloat(filterPrice_16.maxPrice);

  var minPrice_17 = parseFloat(filterPrice_17.minPrice);
  var maxPrice_17 = parseFloat(filterPrice_17.maxPrice);

  var minPrice_18 = parseFloat(filterPrice_18.minPrice);
  var maxPrice_18 = parseFloat(filterPrice_18.maxPrice);

  var minPrice_19 = parseFloat(filterPrice_19.minPrice);
  var maxPrice_19 = parseFloat(filterPrice_19.maxPrice);

  var minPrice_20 = parseFloat(filterPrice_20.minPrice);
  var maxPrice_20 = parseFloat(filterPrice_20.maxPrice);

  var minPrice_21 = parseFloat(filterPrice_21.minPrice);
  var maxPrice_21 = parseFloat(filterPrice_21.maxPrice);

  var minPrice_22 = parseFloat(filterPrice_22.minPrice);
  var maxPrice_22 = parseFloat(filterPrice_22.maxPrice);

  var minPrice_23 = parseFloat(filterPrice_23.minPrice);
  var maxPrice_23 = parseFloat(filterPrice_23.maxPrice);

  var minPrice_24 = parseFloat(filterPrice_24.minPrice);
  var maxPrice_24 = parseFloat(filterPrice_24.maxPrice);

  var minPrice_25 = parseFloat(filterPrice_25.minPrice);
  var maxPrice_25 = parseFloat(filterPrice_25.maxPrice);

  var minPrice_26 = parseFloat(filterPrice_26.minPrice);
  var maxPrice_26 = parseFloat(filterPrice_26.maxPrice);

  var minPrice_27 = parseFloat(filterPrice_27.minPrice);
  var maxPrice_27 = parseFloat(filterPrice_27.maxPrice);

  var minPrice_28 = parseFloat(filterPrice_28.minPrice);
  var maxPrice_28 = parseFloat(filterPrice_28.maxPrice);

  var minPrice_29 = parseFloat(filterPrice_29.minPrice);
  var maxPrice_29 = parseFloat(filterPrice_29.maxPrice);

  var minPrice_30 = parseFloat(filterPrice_30.minPrice);
  var maxPrice_30 = parseFloat(filterPrice_30.maxPrice);

  var minPrice_31 = parseFloat(filterPrice_31.minPrice);
  var maxPrice_31 = parseFloat(filterPrice_31.maxPrice);

  var minPrice_32 = parseFloat(filterPrice_32.minPrice);
  var maxPrice_32 = parseFloat(filterPrice_32.maxPrice);

  var minPrice_33 = parseFloat(filterPrice_33.minPrice);
  var maxPrice_33 = parseFloat(filterPrice_33.maxPrice);

  var minPrice_34 = parseFloat(filterPrice_34.minPrice);
  var maxPrice_34 = parseFloat(filterPrice_34.maxPrice);

  var minPrice_35 = parseFloat(filterPrice_35.minPrice);
  var maxPrice_35 = parseFloat(filterPrice_35.maxPrice);

  var minPrice_36 = parseFloat(filterPrice_36.minPrice);
  var maxPrice_36 = parseFloat(filterPrice_36.maxPrice);

  var minPrice_37 = parseFloat(filterPrice_37.minPrice);
  var maxPrice_37 = parseFloat(filterPrice_37.maxPrice);

  var minPrice_38 = parseFloat(filterPrice_38.minPrice);
  var maxPrice_38 = parseFloat(filterPrice_38.maxPrice);

  var minPrice_39 = parseFloat(filterPrice_39.minPrice);
  var maxPrice_39 = parseFloat(filterPrice_39.maxPrice);

  var minPrice_40 = parseFloat(filterPrice_40.minPrice);
  var maxPrice_40 = parseFloat(filterPrice_40.maxPrice);
  /***UI-SLIDER*/

if(maxPrice_2){
  $("#price-min_2").on('input', function() {
    var min = minPrice_2
    var max = maxPrice_2
    var value1 = $("#price-min_2").val();
    var value2 = $("#price-max_2").val();
    if (parseInt(value1) > parseInt(value2)) {
      value1 = value2;
      $("#price-min_2").val(value1);
    }
    var rep = /[a-zA-Zа-яА-Я]/;
    if (rep.test(value1)) {
      value1 = value1.replace(rep, '');
      $("#price-min_2").val(value1);
    }
    if (Number($("#price-min_2").val()) > max) $(this).val(max);
    if (Number($("#price-min_2").val()) < min) $(this).val(min);
    $("#slider-range_2").slider("values", 0, value1);
  });

  $("#price-max_2").on('input', function() {
    var min = minPrice_2
    var max = maxPrice_2
    var value1 = $("#price-min_2").val();
    var value2 = $("#price-max_2").val();
    if (parseInt(value1) > parseInt(value2)) {
      value1 = value2;
      $("#price-max_2").val(value2)
    }
    var rep = /[a-zA-Zа-яА-Я]/;
    if (rep.test(value2)) {
      value2 = value2.replace(rep, '');
      $("#price-max_2").val(value2);
    }
    if (Number($("#price-max_2").val()) > max) $(this).val(max);
    if (Number($("#price-max_2").val()) < min) $(this).val(min);
    $("#slider-range_2").slider("values", 1, value2);
  });

  $("#slider-range_2").slider({
    animate: true,
    range: true,
    min: minPrice_2,
    max: maxPrice_2,
    values: [minPrice_2, maxPrice_2],
    slide: function(event, ui) {
      $("#price-min_2").val(ui.values[0]);
      $("#price-max_2").val(ui.values[1]);
    },
    stop: function( event, ui ) {
      $("#price-min_2").trigger('keyup');
    }
  });
}

if(maxPrice_3){
  $("#price-min_3").on('input', function() {
    var min = minPrice_3
    var max = maxPrice_3
    var value1 = $("#price-min_3").val();
    var value2 = $("#price-max_3").val();
    if (parseInt(value1) > parseInt(value2)) {
      value1 = value2;
      $("#price-min_3").val(value1);
    }
    var rep = /[a-zA-Zа-яА-Я]/;
    if (rep.test(value1)) {
      value1 = value1.replace(rep, '');
      $("#price-min_3").val(value1);
    }
    if (Number($("#price-min_3").val()) > max) $(this).val(max);
    if (Number($("#price-min_3").val()) < min) $(this).val(min);
    $("#slider-range_3").slider("values", 0, value1);
  });

  $("#price-max_3").on('input', function() {
    var min = minPrice_3
    var max = maxPrice_3
    var value1 = $("#price-min_3").val();
    var value2 = $("#price-max_3").val();
    if (parseInt(value1) > parseInt(value2)) {
      value1 = value2;
      $("#price-max_3").val(value2)
    }
    var rep = /[a-zA-Zа-яА-Я]/;
    if (rep.test(value2)) {
      value2 = value2.replace(rep, '');
      $("#price-max_3").val(value2);
    }
    if (Number($("#price-max_3").val()) > max) $(this).val(max);
    if (Number($("#price-max_3").val()) < min) $(this).val(min);
    $("#slider-range_3").slider("values", 1, value2);
  });

  $("#slider-range_3").slider({
    animate: true,
    range: true,
    min: minPrice_3,
    max: maxPrice_3,
    values: [minPrice_3, maxPrice_3],
    slide: function(event, ui) {
      $("#price-min_3").val(ui.values[0]);
      $("#price-max_3").val(ui.values[1]);
    },
    stop: function( event, ui ) {
      $("#price-min_3").trigger('keyup');
    }
  });
}
if(maxPrice_4){
  $("#price-min_4").on('input', function() {
    var min = minPrice_4
    var max = maxPrice_4
    var value1 = $("#price-min_4").val();
    var value2 = $("#price-max_4").val();
    if (parseInt(value1) > parseInt(value2)) {
      value1 = value2;
      $("#price-min_4").val(value1);
    }
    var rep = /[a-zA-Zа-яА-Я]/;
    if (rep.test(value1)) {
      value1 = value1.replace(rep, '');
      $("#price-min_4").val(value1);
    }
    if (Number($("#price-min_4").val()) > max) $(this).val(max);
    if (Number($("#price-min_4").val()) < min) $(this).val(min);
    $("#slider-range_4").slider("values", 0, value1);
  });

  $("#price-max_4").on('input', function() {
    var min = minPrice_4
    var max = maxPrice_4
    var value1 = $("#price-min_4").val();
    var value2 = $("#price-max_4").val();
    if (parseInt(value1) > parseInt(value2)) {
      value1 = value2;
      $("#price-max_4").val(value2)
    }
    var rep = /[a-zA-Zа-яА-Я]/;
    if (rep.test(value2)) {
      value2 = value2.replace(rep, '');
      $("#price-max_4").val(value2);
    }
    if (Number($("#price-max_4").val()) > max) $(this).val(max);
    if (Number($("#price-max_4").val()) < min) $(this).val(min);
    $("#slider-range_4").slider("values", 1, value2);
  });

  $("#slider-range_4").slider({
    animate: true,
    range: true,
    min: minPrice_4,
    max: maxPrice_4,
    values: [minPrice_4, maxPrice_4],
    slide: function(event, ui) {
      $("#price-min_4").val(ui.values[0]);
      $("#price-max_4").val(ui.values[1]);
    },
    stop: function( event, ui ) {
      $("#price-min_4").trigger('keyup');
    }
  });
}

if(maxPrice_5){
  $("#price-min_5").on('input', function() {
    var min = minPrice_5
    var max = maxPrice_5
    var value1 = $("#price-min_5").val();
    var value2 = $("#price-max_5").val();
    if (parseInt(value1) > parseInt(value2)) {
      value1 = value2;
      $("#price-min_5").val(value1);
    }
    var rep = /[a-zA-Zа-яА-Я]/;
    if (rep.test(value1)) {
      value1 = value1.replace(rep, '');
      $("#price-min_5").val(value1);
    }
    if (Number($("#price-min_5").val()) > max) $(this).val(max);
    if (Number($("#price-min_5").val()) < min) $(this).val(min);
    $("#slider-range_5").slider("values", 0, value1);
  });

  $("#price-max_5").on('input', function() {
    var min = minPrice_5
    var max = maxPrice_5
    var value1 = $("#price-min_5").val();
    var value2 = $("#price-max_5").val();
    if (parseInt(value1) > parseInt(value2)) {
      value1 = value2;
      $("#price-max_5").val(value2)
    }
    var rep = /[a-zA-Zа-яА-Я]/;
    if (rep.test(value2)) {
      value2 = value2.replace(rep, '');
      $("#price-max_5").val(value2);
    }
    if (Number($("#price-max_5").val()) > max) $(this).val(max);
    if (Number($("#price-max_5").val()) < min) $(this).val(min);
    $("#slider-range_5").slider("values", 1, value2);
  });

  $("#slider-range_5").slider({
    animate: true,
    range: true,
    min: minPrice_5,
    max: maxPrice_5,
    values: [minPrice_5, maxPrice_5],
    slide: function(event, ui) {
      $("#price-min_5").val(ui.values[0]);
      $("#price-max_5").val(ui.values[1]);
    },
    stop: function( event, ui ) {
      $("#price-min_5").trigger('keyup');
    }
  });
}

if(maxPrice_6){
  $("#price-min_6").on('input', function() {
    var min = minPrice_6
    var max = maxPrice_6
    var value1 = $("#price-min_6").val();
    var value2 = $("#price-max_6").val();
    if (parseInt(value1) > parseInt(value2)) {
      value1 = value2;
      $("#price-min_6").val(value1);
    }
    var rep = /[a-zA-Zа-яА-Я]/;
    if (rep.test(value1)) {
      value1 = value1.replace(rep, '');
      $("#price-min_6").val(value1);
    }
    if (Number($("#price-min_6").val()) > max) $(this).val(max);
    if (Number($("#price-min_6").val()) < min) $(this).val(min);
    $("#slider-range_6").slider("values", 0, value1);
  });

  $("#price-max_6").on('input', function() {
    var min = minPrice_6
    var max = maxPrice_6
    var value1 = $("#price-min_6").val();
    var value2 = $("#price-max_6").val();
    if (parseInt(value1) > parseInt(value2)) {
      value1 = value2;
      $("#price-max_6").val(value2)
    }
    var rep = /[a-zA-Zа-яА-Я]/;
    if (rep.test(value2)) {
      value2 = value2.replace(rep, '');
      $("#price-max_6").val(value2);
    }
    if (Number($("#price-max_6").val()) > max) $(this).val(max);
    if (Number($("#price-max_6").val()) < min) $(this).val(min);
    $("#slider-range_6").slider("values", 1, value2);
  });

  $("#slider-range_6").slider({
    animate: true,
    range: true,
    min: minPrice_6,
    max: maxPrice_6,
    values: [minPrice_6, maxPrice_6],
    slide: function(event, ui) {
      $("#price-min_6").val(ui.values[0]);
      $("#price-max_6").val(ui.values[1]);
    },
    stop: function( event, ui ) {
      $("#price-min_6").trigger('keyup');
    }
  });
}

if(maxPrice_7){
  $("#price-min_7").on('input', function() {
    var min = minPrice_7
    var max = maxPrice_7
    var value1 = $("#price-min_7").val();
    var value2 = $("#price-max_7").val();
    if (parseInt(value1) > parseInt(value2)) {
      value1 = value2;
      $("#price-min_7").val(value1);
    }
    var rep = /[a-zA-Zа-яА-Я]/;
    if (rep.test(value1)) {
      value1 = value1.replace(rep, '');
      $("#price-min_7").val(value1);
    }
    if (Number($("#price-min_7").val()) > max) $(this).val(max);
    if (Number($("#price-min_7").val()) < min) $(this).val(min);
    $("#slider-range_7").slider("values", 0, value1);
  });

  $("#price-max_7").on('input', function() {
    var min = minPrice_7
    var max = maxPrice_7
    var value1 = $("#price-min_7").val();
    var value2 = $("#price-max_7").val();
    if (parseInt(value1) > parseInt(value2)) {
      value1 = value2;
      $("#price-max_7").val(value2)
    }
    var rep = /[a-zA-Zа-яА-Я]/;
    if (rep.test(value2)) {
      value2 = value2.replace(rep, '');
      $("#price-max_7").val(value2);
    }
    if (Number($("#price-max_7").val()) > max) $(this).val(max);
    if (Number($("#price-max_7").val()) < min) $(this).val(min);
    $("#slider-range_7").slider("values", 1, value2);
  });

  $("#slider-range_7").slider({
    animate: true,
    range: true,
    min: minPrice_7,
    max: maxPrice_7,
    values: [minPrice_7, maxPrice_7],
    slide: function(event, ui) {
      $("#price-min_7").val(ui.values[0]);
      $("#price-max_7").val(ui.values[1]);
    },
    stop: function( event, ui ) {
      $("#price-min_7").trigger('keyup');
    }
  });
}
if(maxPrice_8){
  $("#price-min_8").on('input', function() {
    var min = minPrice_8
    var max = maxPrice_8
    var value1 = $("#price-min_8").val();
    var value2 = $("#price-max_8").val();
    if (parseInt(value1) > parseInt(value2)) {
      value1 = value2;
      $("#price-min_8").val(value1);
    }
    var rep = /[a-zA-Zа-яА-Я]/;
    if (rep.test(value1)) {
      value1 = value1.replace(rep, '');
      $("#price-min_8").val(value1);
    }
    if (Number($("#price-min_8").val()) > max) $(this).val(max);
    if (Number($("#price-min_8").val()) < min) $(this).val(min);
    $("#slider-range_8").slider("values", 0, value1);
  });

  $("#price-max_8").on('input', function() {
    var min = minPrice_8
    var max = maxPrice_8
    var value1 = $("#price-min_8").val();
    var value2 = $("#price-max_8").val();
    if (parseInt(value1) > parseInt(value2)) {
      value1 = value2;
      $("#price-max_8").val(value2)
    }
    var rep = /[a-zA-Zа-яА-Я]/;
    if (rep.test(value2)) {
      value2 = value2.replace(rep, '');
      $("#price-max_8").val(value2);
    }
    if (Number($("#price-max_8").val()) > max) $(this).val(max);
    if (Number($("#price-max_8").val()) < min) $(this).val(min);
    $("#slider-range_8").slider("values", 1, value2);
  });

  $("#slider-range_8").slider({
    animate: true,
    range: true,
    min: minPrice_8,
    max: maxPrice_8,
    values: [minPrice_8, maxPrice_8],
    slide: function(event, ui) {
      $("#price-min_8").val(ui.values[0]);
      $("#price-max_8").val(ui.values[1]);
    },
    stop: function( event, ui ) {
      $("#price-min_8").trigger('keyup');
    }
  });
}

if(maxPrice_9){
  $("#price-min_9").on('input', function() {
    var min = minPrice_9
    var max = maxPrice_9
    var value1 = $("#price-min_9").val();
    var value2 = $("#price-max_9").val();
    if (parseInt(value1) > parseInt(value2)) {
      value1 = value2;
      $("#price-min_9").val(value1);
    }
    var rep = /[a-zA-Zа-яА-Я]/;
    if (rep.test(value1)) {
      value1 = value1.replace(rep, '');
      $("#price-min_9").val(value1);
    }
    if (Number($("#price-min_9").val()) > max) $(this).val(max);
    if (Number($("#price-min_9").val()) < min) $(this).val(min);
    $("#slider-range_9").slider("values", 0, value1);
  });

  $("#price-max_9").on('input', function() {
    var min = minPrice_9
    var max = maxPrice_9
    var value1 = $("#price-min_9").val();
    var value2 = $("#price-max_9").val();
    if (parseInt(value1) > parseInt(value2)) {
      value1 = value2;
      $("#price-max_9").val(value2)
    }
    var rep = /[a-zA-Zа-яА-Я]/;
    if (rep.test(value2)) {
      value2 = value2.replace(rep, '');
      $("#price-max_9").val(value2);
    }
    if (Number($("#price-max_9").val()) > max) $(this).val(max);
    if (Number($("#price-max_9").val()) < min) $(this).val(min);
    $("#slider-range_9").slider("values", 1, value2);
  });

  $("#slider-range_9").slider({
    animate: true,
    range: true,
    min: minPrice_9,
    max: maxPrice_9,
    values: [minPrice_9, maxPrice_9],
    slide: function(event, ui) {
      $("#price-min_9").val(ui.values[0]);
      $("#price-max_9").val(ui.values[1]);
    },
    stop: function( event, ui ) {
      $("#price-min_9").trigger('keyup');
    }
  });
}
if(maxPrice_10){
  $("#price-min_10").on('input', function() {
    var min = minPrice_10
    var max = maxPrice_10
    var value1 = $("#price-min_10").val();
    var value2 = $("#price-max_10").val();
    if (parseInt(value1) > parseInt(value2)) {
      value1 = value2;
      $("#price-min_10").val(value1);
    }
    var rep = /[a-zA-Zа-яА-Я]/;
    if (rep.test(value1)) {
      value1 = value1.replace(rep, '');
      $("#price-min_10").val(value1);
    }
    if (Number($("#price-min_10").val()) > max) $(this).val(max);
    if (Number($("#price-min_10").val()) < min) $(this).val(min);
    $("#slider-range_10").slider("values", 0, value1);
  });

  $("#price-max_10").on('input', function() {
    var min = minPrice_10
    var max = maxPrice_10
    var value1 = $("#price-min_10").val();
    var value2 = $("#price-max_10").val();
    if (parseInt(value1) > parseInt(value2)) {
      value1 = value2;
      $("#price-max_10").val(value2)
    }
    var rep = /[a-zA-Zа-яА-Я]/;
    if (rep.test(value2)) {
      value2 = value2.replace(rep, '');
      $("#price-max_10").val(value2);
    }
    if (Number($("#price-max_10").val()) > max) $(this).val(max);
    if (Number($("#price-max_10").val()) < min) $(this).val(min);
    $("#slider-range_10").slider("values", 1, value2);
  });

  $("#slider-range_10").slider({
    animate: true,
    range: true,
    min: minPrice_10,
    max: maxPrice_10,
    values: [minPrice_10, maxPrice_10],
    slide: function(event, ui) {
      $("#price-min_10").val(ui.values[0]);
      $("#price-max_10").val(ui.values[1]);
    },
    stop: function( event, ui ) {
      $("#price-min_10").trigger('keyup');
    }
  });
}

if(maxPrice_11){
  $("#price-min_11").on('input', function() {
    var min = minPrice_11
    var max = maxPrice_11
    var value1 = $("#price-min_11").val();
    var value2 = $("#price-max_11").val();
    if (parseInt(value1) > parseInt(value2)) {
      value1 = value2;
      $("#price-min_11").val(value1);
    }
    var rep = /[a-zA-Zа-яА-Я]/;
    if (rep.test(value1)) {
      value1 = value1.replace(rep, '');
      $("#price-min_11").val(value1);
    }
    if (Number($("#price-min_11").val()) > max) $(this).val(max);
    if (Number($("#price-min_11").val()) < min) $(this).val(min);
    $("#slider-range_11").slider("values", 0, value1);
  });

  $("#price-max_11").on('input', function() {
    var min = minPrice_11
    var max = maxPrice_11
    var value1 = $("#price-min_11").val();
    var value2 = $("#price-max_11").val();
    if (parseInt(value1) > parseInt(value2)) {
      value1 = value2;
      $("#price-max_11").val(value2)
    }
    var rep = /[a-zA-Zа-яА-Я]/;
    if (rep.test(value2)) {
      value2 = value2.replace(rep, '');
      $("#price-max_11").val(value2);
    }
    if (Number($("#price-max_11").val()) > max) $(this).val(max);
    if (Number($("#price-max_11").val()) < min) $(this).val(min);
    $("#slider-range_11").slider("values", 1, value2);
  });

  $("#slider-range_11").slider({
    animate: true,
    range: true,
    min: minPrice_11,
    max: maxPrice_11,
    values: [minPrice_11, maxPrice_11],
    slide: function(event, ui) {
      $("#price-min_11").val(ui.values[0]);
      $("#price-max_11").val(ui.values[1]);
    },
    stop: function( event, ui ) {
      $("#price-min_11").trigger('keyup');
    }
  });
}
if(maxPrice_12){
  $("#price-min_12").on('input', function() {
    var min = minPrice_12
    var max = maxPrice_12
    var value1 = $("#price-min_12").val();
    var value2 = $("#price-max_12").val();
    if (parseInt(value1) > parseInt(value2)) {
      value1 = value2;
      $("#price-min_12").val(value1);
    }
    var rep = /[a-zA-Zа-яА-Я]/;
    if (rep.test(value1)) {
      value1 = value1.replace(rep, '');
      $("#price-min_12").val(value1);
    }
    if (Number($("#price-min_12").val()) > max) $(this).val(max);
    if (Number($("#price-min_12").val()) < min) $(this).val(min);
    $("#slider-range_12").slider("values", 0, value1);
  });

  $("#price-max_12").on('input', function() {
    var min = minPrice_12
    var max = maxPrice_12
    var value1 = $("#price-min_12").val();
    var value2 = $("#price-max_12").val();
    if (parseInt(value1) > parseInt(value2)) {
      value1 = value2;
      $("#price-max_12").val(value2)
    }
    var rep = /[a-zA-Zа-яА-Я]/;
    if (rep.test(value2)) {
      value2 = value2.replace(rep, '');
      $("#price-max_12").val(value2);
    }
    if (Number($("#price-max_12").val()) > max) $(this).val(max);
    if (Number($("#price-max_12").val()) < min) $(this).val(min);
    $("#slider-range_12").slider("values", 1, value2);
  });

  $("#slider-range_12").slider({
    animate: true,
    range: true,
    min: minPrice_12,
    max: maxPrice_12,
    values: [minPrice_12, maxPrice_12],
    slide: function(event, ui) {
      $("#price-min_12").val(ui.values[0]);
      $("#price-max_12").val(ui.values[1]);
    },
    stop: function( event, ui ) {
      $("#price-min_12").trigger('keyup');
    }
  });
}

if(maxPrice_13){
  $("#price-min_13").on('input', function() {
    var min = minPrice_13
    var max = maxPrice_13
    var value1 = $("#price-min_13").val();
    var value2 = $("#price-max_13").val();
    if (parseInt(value1) > parseInt(value2)) {
      value1 = value2;
      $("#price-min_13").val(value1);
    }
    var rep = /[a-zA-Zа-яА-Я]/;
    if (rep.test(value1)) {
      value1 = value1.replace(rep, '');
      $("#price-min_13").val(value1);
    }
    if (Number($("#price-min_13").val()) > max) $(this).val(max);
    if (Number($("#price-min_13").val()) < min) $(this).val(min);
    $("#slider-range_13").slider("values", 0, value1);
  });

  $("#price-max_13").on('input', function() {
    var min = minPrice_13
    var max = maxPrice_13
    var value1 = $("#price-min_13").val();
    var value2 = $("#price-max_13").val();
    if (parseInt(value1) > parseInt(value2)) {
      value1 = value2;
      $("#price-max_13").val(value2)
    }
    var rep = /[a-zA-Zа-яА-Я]/;
    if (rep.test(value2)) {
      value2 = value2.replace(rep, '');
      $("#price-max_13").val(value2);
    }
    if (Number($("#price-max_13").val()) > max) $(this).val(max);
    if (Number($("#price-max_13").val()) < min) $(this).val(min);
    $("#slider-range_13").slider("values", 1, value2);
  });

  $("#slider-range_13").slider({
    animate: true,
    range: true,
    min: minPrice_13,
    max: maxPrice_13,
    values: [minPrice_13, maxPrice_13],
    slide: function(event, ui) {
      $("#price-min_13").val(ui.values[0]);
      $("#price-max_13").val(ui.values[1]);
    },
    stop: function( event, ui ) {
      $("#price-min_13").trigger('keyup');
    }
  });
}

if(maxPrice_14){
  $("#price-min_14").on('input', function() {
    var min = minPrice_14
    var max = maxPrice_14
    var value1 = $("#price-min_14").val();
    var value2 = $("#price-max_14").val();
    if (parseInt(value1) > parseInt(value2)) {
      value1 = value2;
      $("#price-min_14").val(value1);
    }
    var rep = /[a-zA-Zа-яА-Я]/;
    if (rep.test(value1)) {
      value1 = value1.replace(rep, '');
      $("#price-min_14").val(value1);
    }
    if (Number($("#price-min_14").val()) > max) $(this).val(max);
    if (Number($("#price-min_14").val()) < min) $(this).val(min);
    $("#slider-range_14").slider("values", 0, value1);
  });

  $("#price-max_14").on('input', function() {
    var min = minPrice_14
    var max = maxPrice_14
    var value1 = $("#price-min_14").val();
    var value2 = $("#price-max_14").val();
    if (parseInt(value1) > parseInt(value2)) {
      value1 = value2;
      $("#price-max_14").val(value2)
    }
    var rep = /[a-zA-Zа-яА-Я]/;
    if (rep.test(value2)) {
      value2 = value2.replace(rep, '');
      $("#price-max_14").val(value2);
    }
    if (Number($("#price-max_14").val()) > max) $(this).val(max);
    if (Number($("#price-max_14").val()) < min) $(this).val(min);
    $("#slider-range_14").slider("values", 1, value2);
  });

  $("#slider-range_14").slider({
    animate: true,
    range: true,
    min: minPrice_14,
    max: maxPrice_14,
    values: [minPrice_14, maxPrice_14],
    slide: function(event, ui) {
      $("#price-min_14").val(ui.values[0]);
      $("#price-max_14").val(ui.values[1]);
    },
    stop: function( event, ui ) {
      $("#price-min_14").trigger('keyup');
    }
  });
}

if(maxPrice_15){
  $("#price-min_15").on('input', function() {
    var min = minPrice_15
    var max = maxPrice_15
    var value1 = $("#price-min_15").val();
    var value2 = $("#price-max_15").val();
    if (parseInt(value1) > parseInt(value2)) {
      value1 = value2;
      $("#price-min_15").val(value1);
    }
    var rep = /[a-zA-Zа-яА-Я]/;
    if (rep.test(value1)) {
      value1 = value1.replace(rep, '');
      $("#price-min_15").val(value1);
    }
    if (Number($("#price-min_15").val()) > max) $(this).val(max);
    if (Number($("#price-min_15").val()) < min) $(this).val(min);
    $("#slider-range_15").slider("values", 0, value1);
  });

  $("#price-max_15").on('input', function() {
    var min = minPrice_15
    var max = maxPrice_15
    var value1 = $("#price-min_15").val();
    var value2 = $("#price-max_15").val();
    if (parseInt(value1) > parseInt(value2)) {
      value1 = value2;
      $("#price-max_15").val(value2)
    }
    var rep = /[a-zA-Zа-яА-Я]/;
    if (rep.test(value2)) {
      value2 = value2.replace(rep, '');
      $("#price-max_15").val(value2);
    }
    if (Number($("#price-max_15").val()) > max) $(this).val(max);
    if (Number($("#price-max_15").val()) < min) $(this).val(min);
    $("#slider-range_15").slider("values", 1, value2);
  });

  $("#slider-range_15").slider({
    animate: true,
    range: true,
    min: minPrice_15,
    max: maxPrice_15,
    values: [minPrice_15, maxPrice_15],
    slide: function(event, ui) {
      $("#price-min_15").val(ui.values[0]);
      $("#price-max_15").val(ui.values[1]);
    },
    stop: function( event, ui ) {
      $("#price-min_15").trigger('keyup');
    }
  });
}
if(maxPrice_16){
  $("#price-min_16").on('input', function() {
    var min = minPrice_16
    var max = maxPrice_16
    var value1 = $("#price-min_16").val();
    var value2 = $("#price-max_16").val();
    if (parseInt(value1) > parseInt(value2)) {
      value1 = value2;
      $("#price-min_16").val(value1);
    }
    var rep = /[a-zA-Zа-яА-Я]/;
    if (rep.test(value1)) {
      value1 = value1.replace(rep, '');
      $("#price-min_16").val(value1);
    }
    if (Number($("#price-min_16").val()) > max) $(this).val(max);
    if (Number($("#price-min_16").val()) < min) $(this).val(min);
    $("#slider-range_16").slider("values", 0, value1);
  });

  $("#price-max_16").on('input', function() {
    var min = minPrice_16
    var max = maxPrice_16
    var value1 = $("#price-min_16").val();
    var value2 = $("#price-max_16").val();
    if (parseInt(value1) > parseInt(value2)) {
      value1 = value2;
      $("#price-max_16").val(value2)
    }
    var rep = /[a-zA-Zа-яА-Я]/;
    if (rep.test(value2)) {
      value2 = value2.replace(rep, '');
      $("#price-max_16").val(value2);
    }
    if (Number($("#price-max_16").val()) > max) $(this).val(max);
    if (Number($("#price-max_16").val()) < min) $(this).val(min);
    $("#slider-range_16").slider("values", 1, value2);
  });

  $("#slider-range_16").slider({
    animate: true,
    range: true,
    min: minPrice_16,
    max: maxPrice_16,
    values: [minPrice_16, maxPrice_16],
    slide: function(event, ui) {
      $("#price-min_16").val(ui.values[0]);
      $("#price-max_16").val(ui.values[1]);
    },
    stop: function( event, ui ) {
      $("#price-min_16").trigger('keyup');
    }
  });
}

if(maxPrice_17){
  $("#price-min_17").on('input', function() {
    var min = minPrice_17
    var max = maxPrice_17
    var value1 = $("#price-min_17").val();
    var value2 = $("#price-max_17").val();
    if (parseInt(value1) > parseInt(value2)) {
      value1 = value2;
      $("#price-min_17").val(value1);
    }
    var rep = /[a-zA-Zа-яА-Я]/;
    if (rep.test(value1)) {
      value1 = value1.replace(rep, '');
      $("#price-min_17").val(value1);
    }
    if (Number($("#price-min_17").val()) > max) $(this).val(max);
    if (Number($("#price-min_17").val()) < min) $(this).val(min);
    $("#slider-range_17").slider("values", 0, value1);
  });

  $("#price-max_17").on('input', function() {
    var min = minPrice_17
    var max = maxPrice_17
    var value1 = $("#price-min_17").val();
    var value2 = $("#price-max_17").val();
    if (parseInt(value1) > parseInt(value2)) {
      value1 = value2;
      $("#price-max_17").val(value2)
    }
    var rep = /[a-zA-Zа-яА-Я]/;
    if (rep.test(value2)) {
      value2 = value2.replace(rep, '');
      $("#price-max_17").val(value2);
    }
    if (Number($("#price-max_17").val()) > max) $(this).val(max);
    if (Number($("#price-max_17").val()) < min) $(this).val(min);
    $("#slider-range_17").slider("values", 1, value2);
  });

  $("#slider-range_17").slider({
    animate: true,
    range: true,
    min: minPrice_17,
    max: maxPrice_17,
    values: [minPrice_17, maxPrice_17],
    slide: function(event, ui) {
      $("#price-min_17").val(ui.values[0]);
      $("#price-max_17").val(ui.values[1]);
    },
    stop: function( event, ui ) {
      $("#price-min_17").trigger('keyup');
    }
  });
}

if(maxPrice_18){
  $("#price-min_18").on('input', function() {
    var min = minPrice_18
    var max = maxPrice_18
    var value1 = $("#price-min_18").val();
    var value2 = $("#price-max_18").val();
    if (parseInt(value1) > parseInt(value2)) {
      value1 = value2;
      $("#price-min_18").val(value1);
    }
    var rep = /[a-zA-Zа-яА-Я]/;
    if (rep.test(value1)) {
      value1 = value1.replace(rep, '');
      $("#price-min_18").val(value1);
    }
    if (Number($("#price-min_18").val()) > max) $(this).val(max);
    if (Number($("#price-min_18").val()) < min) $(this).val(min);
    $("#slider-range_18").slider("values", 0, value1);
  });

  $("#price-max_18").on('input', function() {
    var min = minPrice_18
    var max = maxPrice_18
    var value1 = $("#price-min_18").val();
    var value2 = $("#price-max_18").val();
    if (parseInt(value1) > parseInt(value2)) {
      value1 = value2;
      $("#price-max_18").val(value2)
    }
    var rep = /[a-zA-Zа-яА-Я]/;
    if (rep.test(value2)) {
      value2 = value2.replace(rep, '');
      $("#price-max_18").val(value2);
    }
    if (Number($("#price-max_18").val()) > max) $(this).val(max);
    if (Number($("#price-max_18").val()) < min) $(this).val(min);
    $("#slider-range_18").slider("values", 1, value2);
  });

  $("#slider-range_18").slider({
    animate: true,
    range: true,
    min: minPrice_18,
    max: maxPrice_18,
    values: [minPrice_18, maxPrice_18],
    slide: function(event, ui) {
      $("#price-min_18").val(ui.values[0]);
      $("#price-max_18").val(ui.values[1]);
    },
    stop: function( event, ui ) {
      $("#price-min_18").trigger('keyup');
    }
  });
}
if(maxPrice_19){
  $("#price-min_19").on('input', function() {
    var min = minPrice_19
    var max = maxPrice_19
    var value1 = $("#price-min_19").val();
    var value2 = $("#price-max_19").val();
    if (parseInt(value1) > parseInt(value2)) {
      value1 = value2;
      $("#price-min_19").val(value1);
    }
    var rep = /[a-zA-Zа-яА-Я]/;
    if (rep.test(value1)) {
      value1 = value1.replace(rep, '');
      $("#price-min_19").val(value1);
    }
    if (Number($("#price-min_19").val()) > max) $(this).val(max);
    if (Number($("#price-min_19").val()) < min) $(this).val(min);
    $("#slider-range_19").slider("values", 0, value1);
  });

  $("#price-max_19").on('input', function() {
    var min = minPrice_19
    var max = maxPrice_19
    var value1 = $("#price-min_19").val();
    var value2 = $("#price-max_19").val();
    if (parseInt(value1) > parseInt(value2)) {
      value1 = value2;
      $("#price-max_19").val(value2)
    }
    var rep = /[a-zA-Zа-яА-Я]/;
    if (rep.test(value2)) {
      value2 = value2.replace(rep, '');
      $("#price-max_19").val(value2);
    }
    if (Number($("#price-max_19").val()) > max) $(this).val(max);
    if (Number($("#price-max_19").val()) < min) $(this).val(min);
    $("#slider-range_19").slider("values", 1, value2);
  });

  $("#slider-range_19").slider({
    animate: true,
    range: true,
    min: minPrice_19,
    max: maxPrice_19,
    values: [minPrice_19, maxPrice_19],
    slide: function(event, ui) {
      $("#price-min_19").val(ui.values[0]);
      $("#price-max_19").val(ui.values[1]);
    },
    stop: function( event, ui ) {
      $("#price-min_19").trigger('keyup');
    }
  });
}

if(maxPrice_20){
  $("#price-min_20").on('input', function() {
    var min = minPrice_20
    var max = maxPrice_20
    var value1 = $("#price-min_20").val();
    var value2 = $("#price-max_20").val();
    if (parseInt(value1) > parseInt(value2)) {
      value1 = value2;
      $("#price-min_20").val(value1);
    }
    var rep = /[a-zA-Zа-яА-Я]/;
    if (rep.test(value1)) {
      value1 = value1.replace(rep, '');
      $("#price-min_20").val(value1);
    }
    if (Number($("#price-min_20").val()) > max) $(this).val(max);
    if (Number($("#price-min_20").val()) < min) $(this).val(min);
    $("#slider-range_20").slider("values", 0, value1);
  });

  $("#price-max_20").on('input', function() {
    var min = minPrice_20
    var max = maxPrice_20
    var value1 = $("#price-min_20").val();
    var value2 = $("#price-max_20").val();
    if (parseInt(value1) > parseInt(value2)) {
      value1 = value2;
      $("#price-max_20").val(value2)
    }
    var rep = /[a-zA-Zа-яА-Я]/;
    if (rep.test(value2)) {
      value2 = value2.replace(rep, '');
      $("#price-max_20").val(value2);
    }
    if (Number($("#price-max_20").val()) > max) $(this).val(max);
    if (Number($("#price-max_20").val()) < min) $(this).val(min);
    $("#slider-range_20").slider("values", 1, value2);
  });

  $("#slider-range_20").slider({
    animate: true,
    range: true,
    min: minPrice_20,
    max: maxPrice_20,
    values: [minPrice_20, maxPrice_20],
    slide: function(event, ui) {
      $("#price-min_20").val(ui.values[0]);
      $("#price-max_20").val(ui.values[1]);
    },
    stop: function( event, ui ) {
      $("#price-min_20").trigger('keyup');
    }
  });
}

if(maxPrice_21){
  $("#price-min_21").on('input', function() {
    var min = minPrice_21
    var max = maxPrice_21
    var value1 = $("#price-min_21").val();
    var value2 = $("#price-max_21").val();
    if (parseInt(value1) > parseInt(value2)) {
      value1 = value2;
      $("#price-min_21").val(value1);
    }
    var rep = /[a-zA-Zа-яА-Я]/;
    if (rep.test(value1)) {
      value1 = value1.replace(rep, '');
      $("#price-min_21").val(value1);
    }
    if (Number($("#price-min_21").val()) > max) $(this).val(max);
    if (Number($("#price-min_21").val()) < min) $(this).val(min);
    $("#slider-range_21").slider("values", 0, value1);
  });

  $("#price-max_21").on('input', function() {
    var min = minPrice_21
    var max = maxPrice_21
    var value1 = $("#price-min_21").val();
    var value2 = $("#price-max_21").val();
    if (parseInt(value1) > parseInt(value2)) {
      value1 = value2;
      $("#price-max_21").val(value2)
    }
    var rep = /[a-zA-Zа-яА-Я]/;
    if (rep.test(value2)) {
      value2 = value2.replace(rep, '');
      $("#price-max_21").val(value2);
    }
    if (Number($("#price-max_21").val()) > max) $(this).val(max);
    if (Number($("#price-max_21").val()) < min) $(this).val(min);
    $("#slider-range_21").slider("values", 1, value2);
  });

  $("#slider-range_21").slider({
    animate: true,
    range: true,
    min: minPrice_21,
    max: maxPrice_21,
    values: [minPrice_21, maxPrice_21],
    slide: function(event, ui) {
      $("#price-min_21").val(ui.values[0]);
      $("#price-max_21").val(ui.values[1]);
    },
    stop: function( event, ui ) {
      $("#price-min_21").trigger('keyup');
    }
  });
}

if(maxPrice_22){
  $("#price-min_22").on('input', function() {
    var min = minPrice_22
    var max = maxPrice_22
    var value1 = $("#price-min_22").val();
    var value2 = $("#price-max_22").val();
    if (parseInt(value1) > parseInt(value2)) {
      value1 = value2;
      $("#price-min_22").val(value1);
    }
    var rep = /[a-zA-Zа-яА-Я]/;
    if (rep.test(value1)) {
      value1 = value1.replace(rep, '');
      $("#price-min_22").val(value1);
    }
    if (Number($("#price-min_22").val()) > max) $(this).val(max);
    if (Number($("#price-min_22").val()) < min) $(this).val(min);
    $("#slider-range_22").slider("values", 0, value1);
  });

  $("#price-max_22").on('input', function() {
    var min = minPrice_22
    var max = maxPrice_22
    var value1 = $("#price-min_22").val();
    var value2 = $("#price-max_22").val();
    if (parseInt(value1) > parseInt(value2)) {
      value1 = value2;
      $("#price-max_22").val(value2)
    }
    var rep = /[a-zA-Zа-яА-Я]/;
    if (rep.test(value2)) {
      value2 = value2.replace(rep, '');
      $("#price-max_22").val(value2);
    }
    if (Number($("#price-max_22").val()) > max) $(this).val(max);
    if (Number($("#price-max_22").val()) < min) $(this).val(min);
    $("#slider-range_22").slider("values", 1, value2);
  });

  $("#slider-range_22").slider({
    animate: true,
    range: true,
    min: minPrice_22,
    max: maxPrice_22,
    values: [minPrice_22, maxPrice_22],
    slide: function(event, ui) {
      $("#price-min_22").val(ui.values[0]);
      $("#price-max_22").val(ui.values[1]);
    },
    stop: function( event, ui ) {
      $("#price-min_22").trigger('keyup');
    }
  });
}
if(maxPrice_23){
  $("#price-min_23").on('input', function() {
    var min = minPrice_23
    var max = maxPrice_23
    var value1 = $("#price-min_23").val();
    var value2 = $("#price-max_23").val();
    if (parseInt(value1) > parseInt(value2)) {
      value1 = value2;
      $("#price-min_23").val(value1);
    }
    var rep = /[a-zA-Zа-яА-Я]/;
    if (rep.test(value1)) {
      value1 = value1.replace(rep, '');
      $("#price-min_23").val(value1);
    }
    if (Number($("#price-min_23").val()) > max) $(this).val(max);
    if (Number($("#price-min_23").val()) < min) $(this).val(min);
    $("#slider-range_23").slider("values", 0, value1);
  });

  $("#price-max_23").on('input', function() {
    var min = minPrice_23
    var max = maxPrice_23
    var value1 = $("#price-min_23").val();
    var value2 = $("#price-max_23").val();
    if (parseInt(value1) > parseInt(value2)) {
      value1 = value2;
      $("#price-max_23").val(value2)
    }
    var rep = /[a-zA-Zа-яА-Я]/;
    if (rep.test(value2)) {
      value2 = value2.replace(rep, '');
      $("#price-max_23").val(value2);
    }
    if (Number($("#price-max_23").val()) > max) $(this).val(max);
    if (Number($("#price-max_23").val()) < min) $(this).val(min);
    $("#slider-range_23").slider("values", 1, value2);
  });

  $("#slider-range_23").slider({
    animate: true,
    range: true,
    min: minPrice_23,
    max: maxPrice_23,
    values: [minPrice_23, maxPrice_23],
    slide: function(event, ui) {
      $("#price-min_23").val(ui.values[0]);
      $("#price-max_23").val(ui.values[1]);
    },
    stop: function( event, ui ) {
      $("#price-min_23").trigger('keyup');
    }
  });
}
if(maxPrice_24){
  $("#price-min_24").on('input', function() {
    var min = minPrice_24
    var max = maxPrice_24
    var value1 = $("#price-min_24").val();
    var value2 = $("#price-max_24").val();
    if (parseInt(value1) > parseInt(value2)) {
      value1 = value2;
      $("#price-min_24").val(value1);
    }
    var rep = /[a-zA-Zа-яА-Я]/;
    if (rep.test(value1)) {
      value1 = value1.replace(rep, '');
      $("#price-min_24").val(value1);
    }
    if (Number($("#price-min_24").val()) > max) $(this).val(max);
    if (Number($("#price-min_24").val()) < min) $(this).val(min);
    $("#slider-range_24").slider("values", 0, value1);
  });

  $("#price-max_24").on('input', function() {
    var min = minPrice_24
    var max = maxPrice_24
    var value1 = $("#price-min_24").val();
    var value2 = $("#price-max_24").val();
    if (parseInt(value1) > parseInt(value2)) {
      value1 = value2;
      $("#price-max_24").val(value2)
    }
    var rep = /[a-zA-Zа-яА-Я]/;
    if (rep.test(value2)) {
      value2 = value2.replace(rep, '');
      $("#price-max_24").val(value2);
    }
    if (Number($("#price-max_24").val()) > max) $(this).val(max);
    if (Number($("#price-max_24").val()) < min) $(this).val(min);
    $("#slider-range_24").slider("values", 1, value2);
  });

  $("#slider-range_24").slider({
    animate: true,
    range: true,
    min: minPrice_24,
    max: maxPrice_24,
    values: [minPrice_24, maxPrice_24],
    slide: function(event, ui) {
      $("#price-min_24").val(ui.values[0]);
      $("#price-max_24").val(ui.values[1]);
    },
    stop: function( event, ui ) {
      $("#price-min_24").trigger('keyup');
    }
  });
}

if(maxPrice_25){
  $("#price-min_25").on('input', function() {
    var min = minPrice_25
    var max = maxPrice_25
    var value1 = $("#price-min_25").val();
    var value2 = $("#price-max_25").val();
    if (parseInt(value1) > parseInt(value2)) {
      value1 = value2;
      $("#price-min_25").val(value1);
    }
    var rep = /[a-zA-Zа-яА-Я]/;
    if (rep.test(value1)) {
      value1 = value1.replace(rep, '');
      $("#price-min_25").val(value1);
    }
    if (Number($("#price-min_25").val()) > max) $(this).val(max);
    if (Number($("#price-min_25").val()) < min) $(this).val(min);
    $("#slider-range_25").slider("values", 0, value1);
  });

  $("#price-max_25").on('input', function() {
    var min = minPrice_25
    var max = maxPrice_25
    var value1 = $("#price-min_25").val();
    var value2 = $("#price-max_25").val();
    if (parseInt(value1) > parseInt(value2)) {
      value1 = value2;
      $("#price-max_25").val(value2)
    }
    var rep = /[a-zA-Zа-яА-Я]/;
    if (rep.test(value2)) {
      value2 = value2.replace(rep, '');
      $("#price-max_25").val(value2);
    }
    if (Number($("#price-max_25").val()) > max) $(this).val(max);
    if (Number($("#price-max_25").val()) < min) $(this).val(min);
    $("#slider-range_25").slider("values", 1, value2);
  });

  $("#slider-range_25").slider({
    animate: true,
    range: true,
    min: minPrice_25,
    max: maxPrice_25,
    values: [minPrice_25, maxPrice_25],
    slide: function(event, ui) {
      $("#price-min_25").val(ui.values[0]);
      $("#price-max_25").val(ui.values[1]);
    },
    stop: function( event, ui ) {
      $("#price-min_25").trigger('keyup');
    }
  });
}

if(maxPrice_26){
  $("#price-min_26").on('input', function() {
    var min = minPrice_26
    var max = maxPrice_26
    var value1 = $("#price-min_26").val();
    var value2 = $("#price-max_26").val();
    if (parseInt(value1) > parseInt(value2)) {
      value1 = value2;
      $("#price-min_26").val(value1);
    }
    var rep = /[a-zA-Zа-яА-Я]/;
    if (rep.test(value1)) {
      value1 = value1.replace(rep, '');
      $("#price-min_26").val(value1);
    }
    if (Number($("#price-min_26").val()) > max) $(this).val(max);
    if (Number($("#price-min_26").val()) < min) $(this).val(min);
    $("#slider-range_26").slider("values", 0, value1);
  });

  $("#price-max_26").on('input', function() {
    var min = minPrice_26
    var max = maxPrice_26
    var value1 = $("#price-min_26").val();
    var value2 = $("#price-max_26").val();
    if (parseInt(value1) > parseInt(value2)) {
      value1 = value2;
      $("#price-max_26").val(value2)
    }
    var rep = /[a-zA-Zа-яА-Я]/;
    if (rep.test(value2)) {
      value2 = value2.replace(rep, '');
      $("#price-max_26").val(value2);
    }
    if (Number($("#price-max_26").val()) > max) $(this).val(max);
    if (Number($("#price-max_26").val()) < min) $(this).val(min);
    $("#slider-range_26").slider("values", 1, value2);
  });

  $("#slider-range_26").slider({
    animate: true,
    range: true,
    min: minPrice_26,
    max: maxPrice_26,
    values: [minPrice_26, maxPrice_26],
    slide: function(event, ui) {
      $("#price-min_26").val(ui.values[0]);
      $("#price-max_26").val(ui.values[1]);
    },
    stop: function( event, ui ) {
      $("#price-min_26").trigger('keyup');
    }
  });
}

if(maxPrice_27){
  $("#price-min_27").on('input', function() {
    var min = minPrice_27
    var max = maxPrice_27
    var value1 = $("#price-min_27").val();
    var value2 = $("#price-max_27").val();
    if (parseInt(value1) > parseInt(value2)) {
      value1 = value2;
      $("#price-min_27").val(value1);
    }
    var rep = /[a-zA-Zа-яА-Я]/;
    if (rep.test(value1)) {
      value1 = value1.replace(rep, '');
      $("#price-min_27").val(value1);
    }
    if (Number($("#price-min_27").val()) > max) $(this).val(max);
    if (Number($("#price-min_27").val()) < min) $(this).val(min);
    $("#slider-range_27").slider("values", 0, value1);
  });

  $("#price-max_27").on('input', function() {
    var min = minPrice_27
    var max = maxPrice_27
    var value1 = $("#price-min_27").val();
    var value2 = $("#price-max_27").val();
    if (parseInt(value1) > parseInt(value2)) {
      value1 = value2;
      $("#price-max_27").val(value2)
    }
    var rep = /[a-zA-Zа-яА-Я]/;
    if (rep.test(value2)) {
      value2 = value2.replace(rep, '');
      $("#price-max_27").val(value2);
    }
    if (Number($("#price-max_27").val()) > max) $(this).val(max);
    if (Number($("#price-max_27").val()) < min) $(this).val(min);
    $("#slider-range_27").slider("values", 1, value2);
  });

  $("#slider-range_27").slider({
    animate: true,
    range: true,
    min: minPrice_27,
    max: maxPrice_27,
    values: [minPrice_27, maxPrice_27],
    slide: function(event, ui) {
      $("#price-min_27").val(ui.values[0]);
      $("#price-max_27").val(ui.values[1]);
    },
    stop: function( event, ui ) {
      $("#price-min_27").trigger('keyup');
    }
  });
}
if(maxPrice_28){
  $("#price-min_28").on('input', function() {
    var min = minPrice_28
    var max = maxPrice_28
    var value1 = $("#price-min_28").val();
    var value2 = $("#price-max_28").val();
    if (parseInt(value1) > parseInt(value2)) {
      value1 = value2;
      $("#price-min_28").val(value1);
    }
    var rep = /[a-zA-Zа-яА-Я]/;
    if (rep.test(value1)) {
      value1 = value1.replace(rep, '');
      $("#price-min_28").val(value1);
    }
    if (Number($("#price-min_28").val()) > max) $(this).val(max);
    if (Number($("#price-min_28").val()) < min) $(this).val(min);
    $("#slider-range_28").slider("values", 0, value1);
  });

  $("#price-max_28").on('input', function() {
    var min = minPrice_28
    var max = maxPrice_28
    var value1 = $("#price-min_28").val();
    var value2 = $("#price-max_28").val();
    if (parseInt(value1) > parseInt(value2)) {
      value1 = value2;
      $("#price-max_28").val(value2)
    }
    var rep = /[a-zA-Zа-яА-Я]/;
    if (rep.test(value2)) {
      value2 = value2.replace(rep, '');
      $("#price-max_28").val(value2);
    }
    if (Number($("#price-max_28").val()) > max) $(this).val(max);
    if (Number($("#price-max_28").val()) < min) $(this).val(min);
    $("#slider-range_28").slider("values", 1, value2);
  });

  $("#slider-range_28").slider({
    animate: true,
    range: true,
    min: minPrice_28,
    max: maxPrice_28,
    values: [minPrice_28, maxPrice_28],
    slide: function(event, ui) {
      $("#price-min_28").val(ui.values[0]);
      $("#price-max_28").val(ui.values[1]);
    },
    stop: function( event, ui ) {
      $("#price-min_28").trigger('keyup');
    }
  });
}

if(maxPrice_29){
  $("#price-min_29").on('input', function() {
    var min = minPrice_29
    var max = maxPrice_29
    var value1 = $("#price-min_29").val();
    var value2 = $("#price-max_29").val();
    if (parseInt(value1) > parseInt(value2)) {
      value1 = value2;
      $("#price-min_29").val(value1);
    }
    var rep = /[a-zA-Zа-яА-Я]/;
    if (rep.test(value1)) {
      value1 = value1.replace(rep, '');
      $("#price-min_29").val(value1);
    }
    if (Number($("#price-min_29").val()) > max) $(this).val(max);
    if (Number($("#price-min_29").val()) < min) $(this).val(min);
    $("#slider-range_29").slider("values", 0, value1);
  });

  $("#price-max_29").on('input', function() {
    var min = minPrice_29
    var max = maxPrice_29
    var value1 = $("#price-min_29").val();
    var value2 = $("#price-max_29").val();
    if (parseInt(value1) > parseInt(value2)) {
      value1 = value2;
      $("#price-max_29").val(value2)
    }
    var rep = /[a-zA-Zа-яА-Я]/;
    if (rep.test(value2)) {
      value2 = value2.replace(rep, '');
      $("#price-max_29").val(value2);
    }
    if (Number($("#price-max_29").val()) > max) $(this).val(max);
    if (Number($("#price-max_29").val()) < min) $(this).val(min);
    $("#slider-range_29").slider("values", 1, value2);
  });

  $("#slider-range_29").slider({
    animate: true,
    range: true,
    min: minPrice_29,
    max: maxPrice_29,
    values: [minPrice_29, maxPrice_29],
    slide: function(event, ui) {
      $("#price-min_29").val(ui.values[0]);
      $("#price-max_29").val(ui.values[1]);
    },
    stop: function( event, ui ) {
      $("#price-min_29").trigger('keyup');
    }
  });
}
if(maxPrice_30){
  $("#price-min_30").on('input', function() {
    var min = minPrice_30
    var max = maxPrice_30
    var value1 = $("#price-min_30").val();
    var value2 = $("#price-max_30").val();
    if (parseInt(value1) > parseInt(value2)) {
      value1 = value2;
      $("#price-min_30").val(value1);
    }
    var rep = /[a-zA-Zа-яА-Я]/;
    if (rep.test(value1)) {
      value1 = value1.replace(rep, '');
      $("#price-min_30").val(value1);
    }
    if (Number($("#price-min_30").val()) > max) $(this).val(max);
    if (Number($("#price-min_30").val()) < min) $(this).val(min);
    $("#slider-range_30").slider("values", 0, value1);
  });

  $("#price-max_30").on('input', function() {
    var min = minPrice_30
    var max = maxPrice_30
    var value1 = $("#price-min_30").val();
    var value2 = $("#price-max_30").val();
    if (parseInt(value1) > parseInt(value2)) {
      value1 = value2;
      $("#price-max_30").val(value2)
    }
    var rep = /[a-zA-Zа-яА-Я]/;
    if (rep.test(value2)) {
      value2 = value2.replace(rep, '');
      $("#price-max_30").val(value2);
    }
    if (Number($("#price-max_30").val()) > max) $(this).val(max);
    if (Number($("#price-max_30").val()) < min) $(this).val(min);
    $("#slider-range_30").slider("values", 1, value2);
  });

  $("#slider-range_30").slider({
    animate: true,
    range: true,
    min: minPrice_30,
    max: maxPrice_30,
    values: [minPrice_30, maxPrice_30],
    slide: function(event, ui) {
      $("#price-min_30").val(ui.values[0]);
      $("#price-max_30").val(ui.values[1]);
    },
    stop: function( event, ui ) {
      $("#price-min_30").trigger('keyup');
    }
  });
}

if(maxPrice_31){
  $("#price-min_31").on('input', function() {
    var min = minPrice_31
    var max = maxPrice_31
    var value1 = $("#price-min_31").val();
    var value2 = $("#price-max_31").val();
    if (parseInt(value1) > parseInt(value2)) {
      value1 = value2;
      $("#price-min_31").val(value1);
    }
    var rep = /[a-zA-Zа-яА-Я]/;
    if (rep.test(value1)) {
      value1 = value1.replace(rep, '');
      $("#price-min_31").val(value1);
    }
    if (Number($("#price-min_31").val()) > max) $(this).val(max);
    if (Number($("#price-min_31").val()) < min) $(this).val(min);
    $("#slider-range_31").slider("values", 0, value1);
  });

  $("#price-max_31").on('input', function() {
    var min = minPrice_31
    var max = maxPrice_31
    var value1 = $("#price-min_31").val();
    var value2 = $("#price-max_31").val();
    if (parseInt(value1) > parseInt(value2)) {
      value1 = value2;
      $("#price-max_31").val(value2)
    }
    var rep = /[a-zA-Zа-яА-Я]/;
    if (rep.test(value2)) {
      value2 = value2.replace(rep, '');
      $("#price-max_31").val(value2);
    }
    if (Number($("#price-max_31").val()) > max) $(this).val(max);
    if (Number($("#price-max_31").val()) < min) $(this).val(min);
    $("#slider-range_31").slider("values", 1, value2);
  });

  $("#slider-range_31").slider({
    animate: true,
    range: true,
    min: minPrice_31,
    max: maxPrice_31,
    values: [minPrice_31, maxPrice_31],
    slide: function(event, ui) {
      $("#price-min_31").val(ui.values[0]);
      $("#price-max_31").val(ui.values[1]);
    },
    stop: function( event, ui ) {
      $("#price-min_31").trigger('keyup');
    }
  });
}

if(maxPrice_32){
  $("#price-min_32").on('input', function() {
    var min = minPrice_32
    var max = maxPrice_32
    var value1 = $("#price-min_32").val();
    var value2 = $("#price-max_32").val();
    if (parseInt(value1) > parseInt(value2)) {
      value1 = value2;
      $("#price-min_32").val(value1);
    }
    var rep = /[a-zA-Zа-яА-Я]/;
    if (rep.test(value1)) {
      value1 = value1.replace(rep, '');
      $("#price-min_32").val(value1);
    }
    if (Number($("#price-min_32").val()) > max) $(this).val(max);
    if (Number($("#price-min_32").val()) < min) $(this).val(min);
    $("#slider-range_32").slider("values", 0, value1);
  });

  $("#price-max_32").on('input', function() {
    var min = minPrice_32
    var max = maxPrice_32
    var value1 = $("#price-min_32").val();
    var value2 = $("#price-max_32").val();
    if (parseInt(value1) > parseInt(value2)) {
      value1 = value2;
      $("#price-max_32").val(value2)
    }
    var rep = /[a-zA-Zа-яА-Я]/;
    if (rep.test(value2)) {
      value2 = value2.replace(rep, '');
      $("#price-max_32").val(value2);
    }
    if (Number($("#price-max_32").val()) > max) $(this).val(max);
    if (Number($("#price-max_32").val()) < min) $(this).val(min);
    $("#slider-range_32").slider("values", 1, value2);
  });

  $("#slider-range_32").slider({
    animate: true,
    range: true,
    min: minPrice_32,
    max: maxPrice_32,
    values: [minPrice_32, maxPrice_32],
    slide: function(event, ui) {
      $("#price-min_32").val(ui.values[0]);
      $("#price-max_32").val(ui.values[1]);
    },
    stop: function( event, ui ) {
      $("#price-min_32").trigger('keyup');
    }
  });
}
if(maxPrice_33){
  $("#price-min_33").on('input', function() {
    var min = minPrice_33
    var max = maxPrice_33
    var value1 = $("#price-min_33").val();
    var value2 = $("#price-max_33").val();
    if (parseInt(value1) > parseInt(value2)) {
      value1 = value2;
      $("#price-min_33").val(value1);
    }
    var rep = /[a-zA-Zа-яА-Я]/;
    if (rep.test(value1)) {
      value1 = value1.replace(rep, '');
      $("#price-min_33").val(value1);
    }
    if (Number($("#price-min_33").val()) > max) $(this).val(max);
    if (Number($("#price-min_33").val()) < min) $(this).val(min);
    $("#slider-range_33").slider("values", 0, value1);
  });

  $("#price-max_33").on('input', function() {
    var min = minPrice_33
    var max = maxPrice_33
    var value1 = $("#price-min_33").val();
    var value2 = $("#price-max_33").val();
    if (parseInt(value1) > parseInt(value2)) {
      value1 = value2;
      $("#price-max_33").val(value2)
    }
    var rep = /[a-zA-Zа-яА-Я]/;
    if (rep.test(value2)) {
      value2 = value2.replace(rep, '');
      $("#price-max_33").val(value2);
    }
    if (Number($("#price-max_33").val()) > max) $(this).val(max);
    if (Number($("#price-max_33").val()) < min) $(this).val(min);
    $("#slider-range_33").slider("values", 1, value2);
  });

  $("#slider-range_33").slider({
    animate: true,
    range: true,
    min: minPrice_33,
    max: maxPrice_33,
    values: [minPrice_33, maxPrice_33],
    slide: function(event, ui) {
      $("#price-min_33").val(ui.values[0]);
      $("#price-max_33").val(ui.values[1]);
    },
    stop: function( event, ui ) {
      $("#price-min_33").trigger('keyup');
    }
  });
}
if(maxPrice_34){
  $("#price-min_34").on('input', function() {
    var min = minPrice_34
    var max = maxPrice_34
    var value1 = $("#price-min_34").val();
    var value2 = $("#price-max_34").val();
    if (parseInt(value1) > parseInt(value2)) {
      value1 = value2;
      $("#price-min_34").val(value1);
    }
    var rep = /[a-zA-Zа-яА-Я]/;
    if (rep.test(value1)) {
      value1 = value1.replace(rep, '');
      $("#price-min_34").val(value1);
    }
    if (Number($("#price-min_34").val()) > max) $(this).val(max);
    if (Number($("#price-min_34").val()) < min) $(this).val(min);
    $("#slider-range_34").slider("values", 0, value1);
  });

  $("#price-max_34").on('input', function() {
    var min = minPrice_34
    var max = maxPrice_34
    var value1 = $("#price-min_34").val();
    var value2 = $("#price-max_34").val();
    if (parseInt(value1) > parseInt(value2)) {
      value1 = value2;
      $("#price-max_34").val(value2)
    }
    var rep = /[a-zA-Zа-яА-Я]/;
    if (rep.test(value2)) {
      value2 = value2.replace(rep, '');
      $("#price-max_34").val(value2);
    }
    if (Number($("#price-max_34").val()) > max) $(this).val(max);
    if (Number($("#price-max_34").val()) < min) $(this).val(min);
    $("#slider-range_34").slider("values", 1, value2);
  });

  $("#slider-range_34").slider({
    animate: true,
    range: true,
    min: minPrice_34,
    max: maxPrice_34,
    values: [minPrice_34, maxPrice_34],
    slide: function(event, ui) {
      $("#price-min_34").val(ui.values[0]);
      $("#price-max_34").val(ui.values[1]);
    },
    stop: function( event, ui ) {
      $("#price-min_34").trigger('keyup');
    }
  });
}

if(maxPrice_35){
  $("#price-min_35").on('input', function() {
    var min = minPrice_35
    var max = maxPrice_35
    var value1 = $("#price-min_35").val();
    var value2 = $("#price-max_35").val();
    if (parseInt(value1) > parseInt(value2)) {
      value1 = value2;
      $("#price-min_35").val(value1);
    }
    var rep = /[a-zA-Zа-яА-Я]/;
    if (rep.test(value1)) {
      value1 = value1.replace(rep, '');
      $("#price-min_35").val(value1);
    }
    if (Number($("#price-min_35").val()) > max) $(this).val(max);
    if (Number($("#price-min_35").val()) < min) $(this).val(min);
    $("#slider-range_35").slider("values", 0, value1);
  });

  $("#price-max_35").on('input', function() {
    var min = minPrice_35
    var max = maxPrice_35
    var value1 = $("#price-min_35").val();
    var value2 = $("#price-max_35").val();
    if (parseInt(value1) > parseInt(value2)) {
      value1 = value2;
      $("#price-max_35").val(value2)
    }
    var rep = /[a-zA-Zа-яА-Я]/;
    if (rep.test(value2)) {
      value2 = value2.replace(rep, '');
      $("#price-max_35").val(value2);
    }
    if (Number($("#price-max_35").val()) > max) $(this).val(max);
    if (Number($("#price-max_35").val()) < min) $(this).val(min);
    $("#slider-range_35").slider("values", 1, value2);
  });

  $("#slider-range_35").slider({
    animate: true,
    range: true,
    min: minPrice_35,
    max: maxPrice_35,
    values: [minPrice_35, maxPrice_35],
    slide: function(event, ui) {
      $("#price-min_35").val(ui.values[0]);
      $("#price-max_35").val(ui.values[1]);
    },
    stop: function( event, ui ) {
      $("#price-min_35").trigger('keyup');
    }
  });
}

if(maxPrice_36){
  $("#price-min_36").on('input', function() {
    var min = minPrice_36
    var max = maxPrice_36
    var value1 = $("#price-min_36").val();
    var value2 = $("#price-max_36").val();
    if (parseInt(value1) > parseInt(value2)) {
      value1 = value2;
      $("#price-min_36").val(value1);
    }
    var rep = /[a-zA-Zа-яА-Я]/;
    if (rep.test(value1)) {
      value1 = value1.replace(rep, '');
      $("#price-min_36").val(value1);
    }
    if (Number($("#price-min_36").val()) > max) $(this).val(max);
    if (Number($("#price-min_36").val()) < min) $(this).val(min);
    $("#slider-range_36").slider("values", 0, value1);
  });

  $("#price-max_36").on('input', function() {
    var min = minPrice_36
    var max = maxPrice_36
    var value1 = $("#price-min_36").val();
    var value2 = $("#price-max_36").val();
    if (parseInt(value1) > parseInt(value2)) {
      value1 = value2;
      $("#price-max_36").val(value2)
    }
    var rep = /[a-zA-Zа-яА-Я]/;
    if (rep.test(value2)) {
      value2 = value2.replace(rep, '');
      $("#price-max_36").val(value2);
    }
    if (Number($("#price-max_36").val()) > max) $(this).val(max);
    if (Number($("#price-max_36").val()) < min) $(this).val(min);
    $("#slider-range_36").slider("values", 1, value2);
  });

  $("#slider-range_36").slider({
    animate: true,
    range: true,
    min: minPrice_36,
    max: maxPrice_36,
    values: [minPrice_36, maxPrice_36],
    slide: function(event, ui) {
      $("#price-min_36").val(ui.values[0]);
      $("#price-max_36").val(ui.values[1]);
    },
    stop: function( event, ui ) {
      $("#price-min_36").trigger('keyup');
    }
  });
}

if(maxPrice_37){
  $("#price-min_37").on('input', function() {
    var min = minPrice_37
    var max = maxPrice_37
    var value1 = $("#price-min_37").val();
    var value2 = $("#price-max_37").val();
    if (parseInt(value1) > parseInt(value2)) {
      value1 = value2;
      $("#price-min_37").val(value1);
    }
    var rep = /[a-zA-Zа-яА-Я]/;
    if (rep.test(value1)) {
      value1 = value1.replace(rep, '');
      $("#price-min_37").val(value1);
    }
    if (Number($("#price-min_37").val()) > max) $(this).val(max);
    if (Number($("#price-min_37").val()) < min) $(this).val(min);
    $("#slider-range_37").slider("values", 0, value1);
  });

  $("#price-max_37").on('input', function() {
    var min = minPrice_37
    var max = maxPrice_37
    var value1 = $("#price-min_37").val();
    var value2 = $("#price-max_37").val();
    if (parseInt(value1) > parseInt(value2)) {
      value1 = value2;
      $("#price-max_37").val(value2)
    }
    var rep = /[a-zA-Zа-яА-Я]/;
    if (rep.test(value2)) {
      value2 = value2.replace(rep, '');
      $("#price-max_37").val(value2);
    }
    if (Number($("#price-max_37").val()) > max) $(this).val(max);
    if (Number($("#price-max_37").val()) < min) $(this).val(min);
    $("#slider-range_37").slider("values", 1, value2);
  });

  $("#slider-range_37").slider({
    animate: true,
    range: true,
    min: minPrice_37,
    max: maxPrice_37,
    values: [minPrice_37, maxPrice_37],
    slide: function(event, ui) {
      $("#price-min_37").val(ui.values[0]);
      $("#price-max_37").val(ui.values[1]);
    },
    stop: function( event, ui ) {
      $("#price-min_37").trigger('keyup');
    }
  });
}
if(maxPrice_38){
  $("#price-min_38").on('input', function() {
    var min = minPrice_38
    var max = maxPrice_38
    var value1 = $("#price-min_38").val();
    var value2 = $("#price-max_38").val();
    if (parseInt(value1) > parseInt(value2)) {
      value1 = value2;
      $("#price-min_38").val(value1);
    }
    var rep = /[a-zA-Zа-яА-Я]/;
    if (rep.test(value1)) {
      value1 = value1.replace(rep, '');
      $("#price-min_38").val(value1);
    }
    if (Number($("#price-min_38").val()) > max) $(this).val(max);
    if (Number($("#price-min_38").val()) < min) $(this).val(min);
    $("#slider-range_38").slider("values", 0, value1);
  });

  $("#price-max_38").on('input', function() {
    var min = minPrice_38
    var max = maxPrice_38
    var value1 = $("#price-min_38").val();
    var value2 = $("#price-max_38").val();
    if (parseInt(value1) > parseInt(value2)) {
      value1 = value2;
      $("#price-max_38").val(value2)
    }
    var rep = /[a-zA-Zа-яА-Я]/;
    if (rep.test(value2)) {
      value2 = value2.replace(rep, '');
      $("#price-max_38").val(value2);
    }
    if (Number($("#price-max_38").val()) > max) $(this).val(max);
    if (Number($("#price-max_38").val()) < min) $(this).val(min);
    $("#slider-range_38").slider("values", 1, value2);
  });

  $("#slider-range_38").slider({
    animate: true,
    range: true,
    min: minPrice_38,
    max: maxPrice_38,
    values: [minPrice_38, maxPrice_38],
    slide: function(event, ui) {
      $("#price-min_38").val(ui.values[0]);
      $("#price-max_38").val(ui.values[1]);
    },
    stop: function( event, ui ) {
      $("#price-min_38").trigger('keyup');
    }
  });
}

if(maxPrice_39){
  $("#price-min_39").on('input', function() {
    var min = minPrice_39
    var max = maxPrice_39
    var value1 = $("#price-min_39").val();
    var value2 = $("#price-max_39").val();
    if (parseInt(value1) > parseInt(value2)) {
      value1 = value2;
      $("#price-min_39").val(value1);
    }
    var rep = /[a-zA-Zа-яА-Я]/;
    if (rep.test(value1)) {
      value1 = value1.replace(rep, '');
      $("#price-min_39").val(value1);
    }
    if (Number($("#price-min_39").val()) > max) $(this).val(max);
    if (Number($("#price-min_39").val()) < min) $(this).val(min);
    $("#slider-range_39").slider("values", 0, value1);
  });

  $("#price-max_39").on('input', function() {
    var min = minPrice_39
    var max = maxPrice_39
    var value1 = $("#price-min_39").val();
    var value2 = $("#price-max_39").val();
    if (parseInt(value1) > parseInt(value2)) {
      value1 = value2;
      $("#price-max_39").val(value2)
    }
    var rep = /[a-zA-Zа-яА-Я]/;
    if (rep.test(value2)) {
      value2 = value2.replace(rep, '');
      $("#price-max_39").val(value2);
    }
    if (Number($("#price-max_39").val()) > max) $(this).val(max);
    if (Number($("#price-max_39").val()) < min) $(this).val(min);
    $("#slider-range_39").slider("values", 1, value2);
  });

  $("#slider-range_39").slider({
    animate: true,
    range: true,
    min: minPrice_39,
    max: maxPrice_39,
    values: [minPrice_39, maxPrice_39],
    slide: function(event, ui) {
      $("#price-min_39").val(ui.values[0]);
      $("#price-max_39").val(ui.values[1]);
    },
    stop: function( event, ui ) {
      $("#price-min_39").trigger('keyup');
    }
  });
}
if(maxPrice_40){
  $("#price-min_40").on('input', function() {
    var min = minPrice_40
    var max = maxPrice_40
    var value1 = $("#price-min_40").val();
    var value2 = $("#price-max_40").val();
    if (parseInt(value1) > parseInt(value2)) {
      value1 = value2;
      $("#price-min_40").val(value1);
    }
    var rep = /[a-zA-Zа-яА-Я]/;
    if (rep.test(value1)) {
      value1 = value1.replace(rep, '');
      $("#price-min_40").val(value1);
    }
    if (Number($("#price-min_40").val()) > max) $(this).val(max);
    if (Number($("#price-min_40").val()) < min) $(this).val(min);
    $("#slider-range_40").slider("values", 0, value1);
  });

  $("#price-max_40").on('input', function() {
    var min = minPrice_40
    var max = maxPrice_40
    var value1 = $("#price-min_40").val();
    var value2 = $("#price-max_40").val();
    if (parseInt(value1) > parseInt(value2)) {
      value1 = value2;
      $("#price-max_40").val(value2)
    }
    var rep = /[a-zA-Zа-яА-Я]/;
    if (rep.test(value2)) {
      value2 = value2.replace(rep, '');
      $("#price-max_40").val(value2);
    }
    if (Number($("#price-max_40").val()) > max) $(this).val(max);
    if (Number($("#price-max_40").val()) < min) $(this).val(min);
    $("#slider-range_40").slider("values", 1, value2);
  });

  $("#slider-range_40").slider({
    animate: true,
    range: true,
    min: minPrice_40,
    max: maxPrice_40,
    values: [minPrice_40, maxPrice_40],
    slide: function(event, ui) {
      $("#price-min_40").val(ui.values[0]);
      $("#price-max_40").val(ui.values[1]);
    },
    stop: function( event, ui ) {
      $("#price-min_40").trigger('keyup');
    }
  });
}
  $("#price-min").on('input', function() {
    var min = minPrice
    var max = maxPrice
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
    var min = minPrice
    var max = maxPrice
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
    min: minPrice,
    max: maxPrice,
    values: [minPrice, maxPrice],
    slide: function(event, ui) {
      $("#price-min").val(ui.values[0]);
      $("#price-max").val(ui.values[1]);
    },
    stop: function( event, ui ) {
      $("#price-min").trigger('keyup');
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
      $('.product-itemclass').removeClass('product-item_list');
      $('.catalog-product_contentclass').removeClass('is-active');
    } else {
      $('.product-itemclass').addClass('product-item_list');
      $('.catalog-product_contentclass').addClass('is-active');
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

  $('input[type="tel"]').inputmask("+7-999-999-99-99", {
    "clearIncomplete": true,
    showMaskOnHover: false,
    showMaskOnFocus: true,
    placeholder: '_',
    onBeforeMask: function(value) {
      var digits = String(value || '').replace(/\D/g, '');
      if (digits.charAt(0) === '8') digits = '7' + digits.substr(1);
      if (digits.charAt(0) === '7') digits = digits.substr(1);
      return digits;
    }
  });

  // phone mask for dynamically rendered order form fields
  $(document).on('focus', '#bx-soa-order input[type="tel"], #bx-soa-order input[autocomplete="tel"]', function () {
    var $input = $(this);
    if ($input.data('soa-phone-masked') || !$.fn.inputmask) {
      return;
    }
    $input.inputmask("+7-999-999-99-99", {
      clearIncomplete: true,
      showMaskOnHover: false,
      showMaskOnFocus: true,
      placeholder: '_',
      onBeforeMask: function(value) {
        var digits = String(value || '').replace(/\D/g, '');
        if (digits.charAt(0) === '8') digits = '7' + digits.substr(1);
        if (digits.charAt(0) === '7') digits = digits.substr(1);
        return digits;
      }
    });
    $input.data('soa-phone-masked', true);
  });

  //add to cart product
  $('body').on('click', '.main-btn', function () {
      if($(this).data('id')){
        $.get("/ajax/add.php", { id : $(this).data('id') }).done(function(data) {
          $.get("/ajax/basket.small.php").done(function (cart) {
            $('#small_cart').html(cart);
            lazyLoad($('#small_cart'));
          });
          alertify.success(data);
        });

        return false;
      }
  });

  $('.catalog_service').change(function () {
    $.get("/ajax/service.php", {name : $(this).val()}).done(function (data) {
      alertify.success('Услуга добавлена');
    });
  });

  $('#success_msg').modal('show');


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
          center: [51.70402407229258, 39.195462999999954],
          zoom: 17,
          behaviors: ['default', 'scrollZoom'],
        });
        myMap.behaviors.disable('scrollZoom');
        myMap.geoObjects.add(new ymaps.Placemark([51.70402407229258, 39.195462999999954], {
          iconCaption: 'г. Воронеж, Шишкова, д. 73',
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