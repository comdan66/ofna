<div id='content'>
  <div class='big_title'>啓動帳號!</div>
  <div class='small_title'>
    以下是您由 <?php echo $platform; ?> 所提供的個人資料!
    <br />
    請確認以下資料正確性後就可以開始使用囉!
  </div>
  <div class='divider'></div>

  <div id='register_div'>
    <form id='register_form'>

      <div class="form-group">
        <span class="input-group-title">帳號</span>
        <input type='text' id='account' value='<?php echo $user->account;?>' data-correct='false' placeholder="你的 帳號，使用非特殊符號的英文字母以及數字" maxlength='30' class='form-control' x-webkit-speech />
        <span class="input-group-note"></span>
      </div>
      <div class="form-group">
        <span class="input-group-title">E-mail</span>
        <input type='text' id='email' value='<?php echo $user->email;?>' data-correct='<?php echo $user->email != '' ? 'true': 'false';?>' placeholder="你的 E-mail，請輸入正確的 E-mail 格式" class='form-control' maxlength='250'<?php echo $user->email != '' ? ' readonly': ' x-webkit-speech';?>/>
        <span class="input-group-note"></span>
      </div>
      <div class="form-group">
        <span class="input-group-title">暱稱</span>
        <input type='text' id='nickname' value='<?php echo $user->nickname;?>' data-correct='<?php echo $user->nickname != '' ? 'true': 'false';?>' placeholder="你的 暱稱" class='form-control' maxlength='30' x-webkit-speech />
        <span class="input-group-note"></span>
      </div>
      <div class="form-group">
        <span class="input-group-title">生日</span>
        <input type='text' id='birthday' value='<?php echo $user->birthday->format ('Y-m-d');?>' data-correct='<?php echo $user->birthday != '' ? 'true': 'false';?>' placeholder="你的 生日" class='form-control' x-webkit-speech readonly />
        <span class="input-group-note"></span>
      </div>
      <div class="form-group">
        <span class="input-group-title">性別</span>
        <select id="gender" data-correct='true' class="form-control">
          <option value="girl"<?php echo $user->gender == 'girl' ? ' selected': '';?>>女生 - 我是個美麗小女孩!</option>
          <option value="boy"<?php echo $user->gender == 'boy' ? ' selected': '';?>>男生 - 我是個帥氣大男孩!</option>
        </select>
        <span class="input-group-note"></span>
      </div>

      <div id='alert' class="alert alert-danger"></div>
      
      <div class="bottoms row">
        <div class="col-md-7">
          <button type="button" id='register' class="btn btn-info btn-sm" data-loading-text="正在申請，請稍候..." >送出資料</button>
        </div>
        <div class="col-md-5">
          <button type="reset" id='clear' class="btn btn-warning btn-sm">重新填寫</button>
        </div>
      </div>
    </form>
  </div>
</div>