<div id='content'>
  <div class='big_title'>Dynamic!</div>
  <div class='small_title'>您還沒有登入喔! 趕快登入進來吧!</div>
  <div class='divider'></div>

  <div id='sign_in'>
    <div class='title'>登入</div>
    <form id='sign_in_form'>

      <div class="form-group">
        <input type='text' id='account' placeholder="你的 帳號" class='form-control' maxlength='30' />
      </div>
      <div class="form-group">
        <input type='password' id='password' placeholder="你的 密碼" class='form-control' maxlength='30' />
      </div>

      <div id='alert' class="alert alert-danger"></div>
      
      <div class="bottoms row">
        <div class="col-md-4">
          <button type="button" id='signin' class="btn btn-info btn-sm" data-loading-text="登入中請稍候..." >登入</button>
        </div>
        <div class="col-md-4">
          <button type="button" id='register' data-url='<?php echo $register_url?>' class="btn btn-danger btn-sm">我要註冊!</button>
        </div>
        <div class="col-md-4">
          <button type="button" id='facebook' data-url='<?php echo $facebook_url?>' class="btn btn-primary btn-sm">Facebook 登入</button>
        </div>
      </div>
    </form>
  </div>
</div>