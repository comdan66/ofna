/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2015 OA Wu Design
 */

$(function() {
  var price_index = $('table.table_prices').length;
  var block_index = $('table.table_blocks').length;

  $('#add_price').click (function () {
    var obj = {index: price_index++};
    $(_.template ($('#_price').html (), obj) (obj)).insertAfter ($('table.table_prices').length ? $('table.table_prices').last () : $('table').last ());
  });

  $('#add_block').click (function () {
    var obj = {index: block_index++};
    $(_.template ($('#_block').html (), obj) (obj)).insertAfter ($('table.table_blocks').length ? $('table.table_blocks').last () : $('table').last ());
  });

  $('body').on ('click', '.delete', function () {
    $(this).parents ('table').remove ();
  });

  $('.add_pic').click (function () {
    $('.files').append (_.template ($('#_file').html (), {}) ({}));
  }).click ();

  $('.del_pic').click (function () {
    $(this).parents ('li').remove ();
  });
});