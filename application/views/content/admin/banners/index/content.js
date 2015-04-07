/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2015 OA Wu Design
 */

$(function() {
  $('.del_banner').click (function () {
    var $li = $(this).parents ('li');
    $.ajax ({
      url: $('#get_delete_url').val (),
      data: { id: $li.data ('id') },
      async: true, cache: false, dataType: 'json', type: 'POST',
      beforeSend: function () {}
    })
    .done (function (result) {
      $.jGrowl (result.status && $(this).parents ('tr').remove () ? '刪除成功!' : '刪除失敗!');
      location.reload ();
    })
    .fail (function (result) { window.ajaxError (result); })
    .complete (function (result) { });
  });
});