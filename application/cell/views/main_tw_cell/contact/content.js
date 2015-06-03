/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2015 OA Wu Design
 */

$(function () {
  $('#contact .f').submit (function () {
    var $name = $(this).find ('input[name="name"]');
    var $email = $(this).find ('input[name="email"]');
    var $textarea = $(this).find ('textarea');

    $.ajax ({
      url: '/send',
      data: { name: $name.val (), email: $email.val (), comment: $textarea.val () },
      async: true, cache: false, dataType: 'json', type: 'POST',
      beforeSend: function () {}
    })
    .done (function (result) { })
    .fail (function (result) { })
    .complete (function (result) {
      $name.val ('');
      $email.val ('');
      $textarea.val ('');
    });

    alert ($(this).data ('info'));

    return false;
  });
});