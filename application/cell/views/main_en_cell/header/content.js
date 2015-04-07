/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2015 OA Wu Design
 */

$(function () {
  var headerHeight = 80;
  $('#header .m .i').click (function () {
    if ($(this).data ('go'))
      $("html, body").stop ().animate ({ scrollTop: $('#' + $(this).data ('go')).offset ().top - headerHeight }, 1000);
    else
      $("html, body").stop ().animate ({ scrollTop: 0 }, 1000);
  });
});