/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2015 OA Wu Design
 */

$(function() {
  var price_index = 0;
  var block_index = 0;

  $('#add_price').click (function () {
    var obj = {index: price_index++};
    $(_.template ($('#_price').html (), obj) (obj)).insertAfter ($('table').last ());
  });

  $('#add_block').click (function () {
    var obj = {index: block_index++};
    $(_.template ($('#_block').html (), obj) (obj)).insertAfter ($('table').last ());
  });

  $('body').on ('click', '.delete', function () {
    $(this).parents ('table').remove ();
  });

  $('.add_pic').click (function () {
    $('.files').append (_.template ($('#_file').html (), {}) ({}));
  }).click ();

});