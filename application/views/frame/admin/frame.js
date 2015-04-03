/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2014 OA Wu Design
 */
$(function(){$("#target_index_list_search").click(function(){$("#search_form").is(":visible")?$("#search_form").hide("blind"):$("#search_form").show("blind")}),$("#sortable").sortable({handle:".handle",stop:function(){var e=$(this).children(".item").length,n=$.makeArray($(this).children(".item").map(function(n,t){return $(t).data("id")+"_"+(e-n+1)}));n.length&&$.ajax({url:$("#sort_url").val(),data:{sorts:n},async:!0,cache:!1,dataType:"json",type:"POST",beforeSend:function(){}}).done(function(){}).fail(function(e){ajaxError(e)}).complete(function(){})}}).disableSelection()});