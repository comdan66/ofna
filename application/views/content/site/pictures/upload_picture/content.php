<?php 
  
?>
<form id="create_form" method="post" action="<?php echo $upload_picture_url; ?>" enctype="multipart/form-data">
  <input type='hidden' id='duration' name='duration' value='<?php echo config ('d4_config', 'upload_picture', 'duration'); ?>' />
  <input type='hidden' id='enable' name='enable' value='<?php echo $enable ? 'true' : 'false'; ?>' />
  <div class='root row'>
    <div class="col-md-3 picture_area">
      <div class='picture_panel'>
        <img src='https://graph.facebook.com/<?php echo $that->identity->get_session ('fb_uid') ?>/picture?width=160&height=145'>
      </div>
    </div>
    <div class="col-md-9 form_area">
      
      <div class="input-group">
        <span class="input-group-addon">照片標題</span>
        <input type="text" class="form-control" placeholder="請輸入照片標題!" name="title" id="title" value="<?php echo $title; ?>" maxlength="<?php echo config ('d4_config', 'upload_picture', 'title_max_length'); ?>" title="請輸入照片標題!" />
      </div>
      <div class="input-group">
        <span class="input-group-addon">照片敘述</span>
        <input type="text" class="form-control" placeholder="請輸入照片敘述!" name="description" id="description" value="<?php echo $description; ?>" maxlength="<?php echo config ('d4_config', 'upload_picture', 'description_max_length'); ?>" title="請輸入照片敘述!" />
      </div>

      <div class="input-group">
        <span class="input-group-addon">選擇照片</span>
        <input type="file" class="form-control" placeholder="請選擇大小不超過3MB的照片!" accept="<?php echo implode (', ', config ('d4_config', 'upload_picture', 'format_2s')); ?>" name="picture" id="picture" title="請選擇大小不超過 <?php echo (config ('d4_config', 'upload_picture', 'max_size') / 1024 / 1024); ?>MB 的照片!" data-formats="<?php echo implode ('|', config ('d4_config', 'upload_picture', 'format_1s')); ?>" data-max_size="<?php echo config ('d4_config', 'upload_picture', 'max_size'); ?>" />
      </div>
      <div class="input-group-note">
        ※ 照片格式必須為 .jpg 檔案，並且小於 <?php echo (config ('d4_config', 'upload_picture', 'max_size') / 1024 / 1024); ?>MB
      </div>

      <div class="form-group sync_facebook-group">
          <div class="checkbox">
            <label>
              <input type="checkbox" id='sync_facebook' name='sync_facebook'<?php echo $sync_facebook ? ' checked': ''; ?>/> 將圖片同步發佈到臉書
            </label>
          </div>
      </div>
    </div>
  </div>

  <div class='root bottom_area'>
    <div class="bottoms row">
      <div class="col-md-8 alert_area">
        <div id='alert' class="alert alert-danger"><?php echo $message;?></div>
      </div>
      <div class="col-md-4">
        <button type="button" id='create' class="btn btn-info btn-sm" data-loading-text="正在上傳，請稍候..." >確定上傳</button>
        <button type="reset" id='clear' class="btn btn-warning btn-sm" data-loading-text="重新填寫" >重新填寫</button>
      </div>
    </div>
  </div>
</form>