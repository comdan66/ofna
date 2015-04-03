/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2014 OA Wu Design
 */
$(function(){$("#create_form").submit(function(){return""==$("#title").val()?(alert("有欄位沒填!"),!1):""==$("#picture").val()?(alert("有欄位沒填!"),!1):!0})});