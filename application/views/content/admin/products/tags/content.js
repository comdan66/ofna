/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2015 OA Wu Design
 */

$(function() {
  $('.del_cate').click (function () {
    if ($(this).parents ('table').find ('tr').length <= 2)
      $(this).parents ('table').append ($('<tr />').append ($('<td />').attr ('colspan', 4).text ('沒有任何產品分類')));

    $.ajax ({
      url: $('#get_del_tag_url').val (),
      data: { id: $(this).parents ('tr').data ('id') },
      async: true, cache: false, dataType: 'json', type: 'POST',
      beforeSend: function () {}
    })
    .done (function (result) {
      $.jGrowl (result.status && $(this).parents ('tr').remove () ? '刪除成功!' : '刪除失敗!');
      location.reload ();
    }.bind ($(this)))
    .fail (function (result) { window.ajaxError (result); })
    .complete (function (result) { });
  });
});