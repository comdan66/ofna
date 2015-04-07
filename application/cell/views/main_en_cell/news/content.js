/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2015 OA Wu Design
 */

$(function () {
  var body_overflow = $('body').css ('overflow');

  $('.news_pop .c span').click (function () {
    $('body').css('overflow', body_overflow);
    $(this).parents ('.news_pop').fadeOut ();
  });

  $('#news .p').click (function () {
    $('body').css('overflow', 'hidden');
    $('.news_pop[data-id="' + $(this).parents ('.n').data ('id') + '"]').fadeIn ();
  });
});