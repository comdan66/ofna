/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2015 OA Wu Design
 */

$(function () {
  $('#contact .f').submit (function () {
    $(this).find ('input[name="name"]').val ('');
    $(this).find ('input[name="email"]').val ('');
    $(this).find ('textarea').val ('');

    alert ($(this).data ('info'));
    return false;
  });
});