<div id='content'>
  <div class='big_title'>Dynamic!</div>
  <div class='small_title'>還沒有 Dynamic 帳號嘛!? 趕快來加入吧!</div>
  <div class='divider'></div>

  <div id='register_div'>
    <form id='register_form'>

      <div class='title'>重要資料</div>
      <div class="form-group">
        <input type='text' id='account' data-correct='false' placeholder="你的 帳號，使用非特殊符號的英文字母以及數字" maxlength='30' class='form-control' x-webkit-speech />
        <span class="input-group-note"></span>
      </div>
      <div class="form-group">
        <input type='password' id='password' data-correct='false' placeholder="你的 密碼，可以使用任意符號" class='form-control' maxlength='30' />
        <span class="input-group-note"></span>
      </div>
      <div class="form-group">
        <input type='password' id='re_password' data-correct='false' placeholder="確認 密碼，請再次確認密碼正確性" class='form-control' maxlength='30' />
        <span class="input-group-note"></span>
      </div>

      <div class='title'>基本資料</div>
      <div class="form-group">
        <input type='text' id='email' data-correct='false' placeholder="你的 E-mail，請輸入正確的 E-mail 格式" class='form-control' maxlength='250' x-webkit-speech />
        <span class="input-group-note"></span>
      </div>
      <div class="form-group">
        <input type='text' id='nickname' data-correct='false' placeholder="你的 暱稱" class='form-control' maxlength='30' x-webkit-speech />
        <span class="input-group-note"></span>
      </div>
      <div class="form-group">
        <input type='text' id='birthday' data-correct='false' placeholder="你的 生日" class='form-control' x-webkit-speech readonly />
        <span class="input-group-note"></span>
      </div>
      <div class="form-group">
        <select id="gender" data-correct='true' class="form-control">
          <option value="girl">女生 - 我是個美麗小女孩!</option>
          <option value="boy">男生 - 我是個帥氣大男孩!</option>
        </select>
        <span class="input-group-note"></span>
      </div>

      <div id='alert' class="alert alert-danger"></div>
      <div class="bottoms row">
        <div class="col-md-4">
          <button type="button" id='register' class="btn btn-info btn-sm" data-loading-text="正在申請，請稍候..." >送出資料</button>
        </div>
        <div class="col-md-4">
          <button type="reset" id='clear' class="btn btn-warning btn-sm">重新填寫</button>
        </div>
        <div class="col-md-4">
          <button type="reset" id='facebook' data-url='<?php echo $facebook_url?>' class="btn btn-primary btn-sm">Facebook 登入</button>
        </div>
      </div>
    </form>
  </div>
</div>