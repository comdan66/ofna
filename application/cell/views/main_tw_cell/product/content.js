/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2015 OA Wu Design
 */

$(function () {
  var body_overflow = $('body').css ('overflow');

  function getData (id, page) {
    $.ajax ({
      url: $('#get_products_url').val (),
      data: { id: id, page: page },
      async: true, cache: false, dataType: 'json', type: 'POST',
      beforeSend: function () {
        $('#product .ds').css ({
          'background': 'url(data:image/gif;base64,R0lGODlhEAALAPQAAP///wAAANra2tDQ0Orq6gYGBgAAAC4uLoKCgmBgYLq6uiIiIkpKSoqKimRkZL6+viYmJgQEBE5OTubm5tjY2PT09Dg4ONzc3PLy8ra2tqCgoMrKyu7u7gAAAAAAAAAAACH/C05FVFNDQVBFMi4wAwEAAAAh/hpDcmVhdGVkIHdpdGggYWpheGxvYWQuaW5mbwAh+QQJCwAAACwAAAAAEAALAAAFLSAgjmRpnqSgCuLKAq5AEIM4zDVw03ve27ifDgfkEYe04kDIDC5zrtYKRa2WQgAh+QQJCwAAACwAAAAAEAALAAAFJGBhGAVgnqhpHIeRvsDawqns0qeN5+y967tYLyicBYE7EYkYAgAh+QQJCwAAACwAAAAAEAALAAAFNiAgjothLOOIJAkiGgxjpGKiKMkbz7SN6zIawJcDwIK9W/HISxGBzdHTuBNOmcJVCyoUlk7CEAAh+QQJCwAAACwAAAAAEAALAAAFNSAgjqQIRRFUAo3jNGIkSdHqPI8Tz3V55zuaDacDyIQ+YrBH+hWPzJFzOQQaeavWi7oqnVIhACH5BAkLAAAALAAAAAAQAAsAAAUyICCOZGme1rJY5kRRk7hI0mJSVUXJtF3iOl7tltsBZsNfUegjAY3I5sgFY55KqdX1GgIAIfkECQsAAAAsAAAAABAACwAABTcgII5kaZ4kcV2EqLJipmnZhWGXaOOitm2aXQ4g7P2Ct2ER4AMul00kj5g0Al8tADY2y6C+4FIIACH5BAkLAAAALAAAAAAQAAsAAAUvICCOZGme5ERRk6iy7qpyHCVStA3gNa/7txxwlwv2isSacYUc+l4tADQGQ1mvpBAAIfkECQsAAAAsAAAAABAACwAABS8gII5kaZ7kRFGTqLLuqnIcJVK0DeA1r/u3HHCXC/aKxJpxhRz6Xi0ANAZDWa+kEAA7AAAAAAAAAAAA) no-repeat center center'
        }).children ('div').empty ();
        $('#product .ps').css ({
          'background': 'url(data:image/gif;base64,R0lGODlhEAALAPQAAP///wAAANra2tDQ0Orq6gYGBgAAAC4uLoKCgmBgYLq6uiIiIkpKSoqKimRkZL6+viYmJgQEBE5OTubm5tjY2PT09Dg4ONzc3PLy8ra2tqCgoMrKyu7u7gAAAAAAAAAAACH/C05FVFNDQVBFMi4wAwEAAAAh/hpDcmVhdGVkIHdpdGggYWpheGxvYWQuaW5mbwAh+QQJCwAAACwAAAAAEAALAAAFLSAgjmRpnqSgCuLKAq5AEIM4zDVw03ve27ifDgfkEYe04kDIDC5zrtYKRa2WQgAh+QQJCwAAACwAAAAAEAALAAAFJGBhGAVgnqhpHIeRvsDawqns0qeN5+y967tYLyicBYE7EYkYAgAh+QQJCwAAACwAAAAAEAALAAAFNiAgjothLOOIJAkiGgxjpGKiKMkbz7SN6zIawJcDwIK9W/HISxGBzdHTuBNOmcJVCyoUlk7CEAAh+QQJCwAAACwAAAAAEAALAAAFNSAgjqQIRRFUAo3jNGIkSdHqPI8Tz3V55zuaDacDyIQ+YrBH+hWPzJFzOQQaeavWi7oqnVIhACH5BAkLAAAALAAAAAAQAAsAAAUyICCOZGme1rJY5kRRk7hI0mJSVUXJtF3iOl7tltsBZsNfUegjAY3I5sgFY55KqdX1GgIAIfkECQsAAAAsAAAAABAACwAABTcgII5kaZ4kcV2EqLJipmnZhWGXaOOitm2aXQ4g7P2Ct2ER4AMul00kj5g0Al8tADY2y6C+4FIIACH5BAkLAAAALAAAAAAQAAsAAAUvICCOZGme5ERRk6iy7qpyHCVStA3gNa/7txxwlwv2isSacYUc+l4tADQGQ1mvpBAAIfkECQsAAAAsAAAAABAACwAABS8gII5kaZ7kRFGTqLLuqnIcJVK0DeA1r/u3HHCXC/aKxJpxhRz6Xi0ANAZDWa+kEAA7AAAAAAAAAAAA) no-repeat center center'
        }).empty ();
        $('.product_pop').remove ();
      }
    })
    .done (function (result) {
      var $ds = $('#product .ds').css ({'background': '#fff'}).children ('div');
      for (var i = 0; i < result.page_count; i++)
       $ds.append ($('<div />').addClass ('d').addClass (i == page ? 'n' : null));
      console.error (result);

      $('#product .ps').css ({'background': '#fff'}).append (result.products.map (function (t) {
        
        var obj = {
          title: t.title,
          description: t.description,
          src: t.pics.length > 0 ? t.pics[0].url.c240x175 : '',
          pis: t.prices.map (function (t) {return _.template ($('#_pi').html (), t) (t);}).join (''),
          lbs: t.blocks.filter (function (t, i) {return (i % 2) === 0;}).map (function (t) {return _.template ($('#_pb').html (), t) (t);}).join (''),
          rbs: t.blocks.filter (function (t, i) {return i % 2;}).map (function (t) {return _.template ($('#_pb').html (), t) (t);}).join (''),
        };
        var $pp = $(_.template ($('#_pp').html (), obj) (obj)).insertAfter ($('#product'));

        $pp.find ('.cr .p .r').css ({
          'height': $pp.find ('.cr .p .l').height () + 'px'
        });
        $pp.find ('.c span').click (function () {
          $('body').css('overflow', body_overflow);
          $pp.fadeOut ();
        });

        obj = {
          id: t.id,
          title: t.title,
          description: t.description,
          src: t.pics.length > 0 ? t.pics[0].url.c240x175 : ''
        };
        return $(_.template ($('#_p').html (), obj) (obj)).click (function () {
          $('body').css('overflow', 'hidden');
          $pp.fadeIn ().find ('.p .r').css ({
            'height': $pp.find ('.p .l').height () + 'px'
          });
        });
      }));
      
    }.bind ($(this)))
    .fail (function (result) { $('#product').remove (); window.ajaxError (result); })
    .complete (function (result) { });
  }

  $('#product .ts .t').click (function () {
    $(this).addClass ('a').siblings ().removeClass ('a');
    var page = $('#product .ds > div .d').index ($('#product .ds > div .n'));
    page = page < 0 ? 0 : page;
    getData ($(this).data ('id'), page);
  }).eq (0).click ();

  $('body').on ('click', '#product .ds > div .d', function () {
    var page = $('#product .ds > div .d').index ($(this));
    console.error (page);
    page = page < 0 ? 0 : page;
    getData ($('#product .ts .a').data ('id'), page);
  });
});