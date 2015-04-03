var objs = ['#account', '#password', '#re_password', '#email', '#nickname', '#birthday', '#gender'];
    
var error = function (msg, $obj) {

  $obj.parent ('.form-group').addClass ('has-error');
  $('#alert').empty ().text (msg).show ();

  $('#register_div').effect("shake");
  $obj.data ('correct', false);
  $obj.nextAll ('.input-group-note').removeClass ('true').removeClass ('loading').addClass ('false');
  
  clearTimeout (timer);
  var timer = setTimeout (function () {
    jQuery.map (objs, function (n, i) {
      $(n).parent ('.form-group').removeClass ('has-error');
      $(n).nextAll ('.input-group-note').removeClass ('true').removeClass ('false').removeClass ('loading');
    });
    $('#alert').empty ().hide ('blind');
  }, 3000);
}

var checkAccountFormat = function ($obj) {
  if (($obj.val ().length == 0) || ($obj.val ().length == '')) return error ('沒有輸入帳號，請輸入帳號!', $obj);
  if(!$obj.val ().match (/^[A-Za-z]+[_0-9]*$/)) return error ('輸入帳號格式不符合，請重新輸入帳號!', $obj);
  return true;
}

var checkPasswordFormat = function ($obj) {
  if (($obj.val ().length == 0) || ($obj.val ().length == '')) return error ('沒有輸入密碼，請輸入密碼!', $obj);
  return true;
}

var checkNicknameFormat = function ($obj) {
  if (($obj.val ().length == 0) || ($obj.val ().length == '')) return error ('沒有輸入暱稱，請輸入暱稱!', $obj);
  return true;
}
var checkBirthdayFormat = function ($obj) {
  if (($obj.val ().length == 0) || ($obj.val ().length == '')) return error ('沒有選擇生日，請選擇生日!', $obj);
  return true;
}

var checkRePasswordFormat = function ($obj) {
  if (($obj.val ().length == 0) || ($obj.val ().length == '')) return error ('沒有確認密碼，確認密碼!', $obj);
  if ($obj.val () != $('#password').val ()) return error ('確認密碼與密碼不符，請確認密碼是否正確!', $obj);
  return true;
}

var checkEmailFormat = function ($obj) {
  if (($obj.val ().length == 0) || ($obj.val ().length == '')) return error ('沒有輸入帳號，請輸入帳號!', $obj);
  if(!$obj.val ().match (/^\w+((-\w+)|(\.\w+))*\@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z0-9]+$/)) return error ('輸入帳號格式不符合，請重新輸入帳號!', $obj);
  return true;
}

$(function () {
  $('#birthday').datepicker ({
    changeMonth: true,
    changeYear: true,
    firstDay: 0,
    dateFormat: 'yy-mm-dd',
    yearRange: '1901:2030',
    maxDate: 0
  });

  $('#account').change (function () { 
    var $obj = $(this);
    if (checkAccountFormat ($obj)) {
      var account = $obj.val ();
      var note    = $obj.nextAll ('.input-group-note').removeClass ('true').removeClass ('false').addClass ('loading');

      $.ajax ({
        url: $('#check_account_double_url').val (),
        data: { account: account },
        async: true, cache: false, dataType: 'json', type: 'POST',
        beforeSend: function () {}
      })
      .done (function (result) {
        if (!result.status){
          note.removeClass ('loading').removeClass ('false').addClass ('true');
          $obj.data ('correct', true);
        } else { error (result.message, $obj); }
      })
      .fail (function (result) { ajaxError (result); })
      .complete (function (result) {});
    }
  });

  $('#password').change (function () {
    var $obj = $(this);
    var note = $obj.nextAll ('.input-group-note').removeClass ('true').removeClass ('false').addClass ('loading');

    if (checkPasswordFormat ($obj)) {
      $obj.data ('correct', true);
      note.removeClass ('loading').removeClass ('false').addClass ('true');
    }
  });


  $('#re_password').change (function () {
    var $obj = $(this);
    var note = $obj.nextAll ('.input-group-note').removeClass ('true').removeClass ('false').addClass ('loading');

    if (checkRePasswordFormat ($obj)) {
      $obj.data ('correct', true);
      note.removeClass ('loading').removeClass ('false').addClass ('true');
    }
  });

  $('#email').change (function () { 
    var $obj = $(this);
    if (checkEmailFormat ($obj)) {
      var email = $obj.val ();
      var note  = $obj.nextAll ('.input-group-note').removeClass ('true').removeClass ('false').addClass ('loading');

      $.ajax ({
        url: $('#check_email_double_url').val (),
        data: { email: email },
        async: true, cache: false, dataType: 'json', type: 'POST',
        beforeSend: function () {}
      })
      .done (function (result) {
        if (!result.status) {
          note.removeClass ('loading').removeClass ('false').addClass ('true');
          $obj.data ('correct', true);
        } else { error (result.message, $obj); }
      })
      .fail (function (result) { ajaxError (result); })
      .complete (function (result) {});
    }
  });

  $('#nickname').change (function () {
    var $obj = $(this);
    var note = $obj.nextAll ('.input-group-note').removeClass ('true').removeClass ('false').addClass ('loading');

    if (checkNicknameFormat ($obj)) {
      $obj.data ('correct', true);
      note.removeClass ('loading').removeClass ('false').addClass ('true');
    }
  });

  $('#birthday').change (function () {
    var $obj = $(this);
    var note = $obj.nextAll ('.input-group-note').removeClass ('true').removeClass ('false').addClass ('loading');

    if (checkBirthdayFormat ($obj)) {
      $obj.data ('correct', true);
      note.removeClass ('loading').removeClass ('false').addClass ('true');
    }
  });

  $('#register').click (function () {
    var correct = true;

    jQuery.map (objs, function (n, i) {
      var $obj = $(n);
      if (correct) {
        correct = correct && (($obj.data ('correct') == 'true')||($obj.data ('correct') == true) ? true : false);
        if (!correct) error ('有欄位資料不正確，請再次檢查!', $obj);
      }
    });

    if (correct) {
      var account    = $('#account').val (),
          password   = $('#password').val (),
          email      = $('#email').val (),
          nickname   = $('#nickname').val (),
          birthday   = $('#birthday').val (),
          gender     = $('#gender').val (),
          $waitDialog = showWait ('處理中...', '請稍候，系統處理中 ...<br/><br/><center><img src="data:image/gif;base64,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" /></center>', false);
        
      $.ajax ({
        url: $('#base_method_url').val (),
        data: { account: account, password: password, email: email, nickname: nickname, birthday: birthday, gender: gender },
        async: true, cache: false, dataType: 'json', type: 'POST',
        beforeSend: function () { $('#register').bs_button('loading'); $waitDialog.OA_Dialog('open'); }
      })
      .done (function (result) { if (result.status) showAlert (result.title, result.message, eval ('(' + result.action + ')')); else error (result.message, $(objs.join(', '))); })
      .fail (function (result) { ajaxError (result); })
      .complete (function (result) { $('#register').bs_button('reset'); $waitDialog.OA_Dialog('close'); });
    }
  });

  $('#facebook').click (function () { window.location.assign ($(this).data ('url')); });
});