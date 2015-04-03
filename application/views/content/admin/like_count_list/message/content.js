/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2014 OA Wu Design
 */
$(function(){showAlert($("#title").val(),$("#message").val(),function(){window.location.assign($("#redirect").val())})});