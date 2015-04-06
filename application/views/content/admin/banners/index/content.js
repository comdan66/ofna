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
      result.status && $li.remove () && $.jGrowl ('刪除成功');;
    })
    .fail (function (result) {  })
    .complete (function (result) { });
  });
});