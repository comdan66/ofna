<div id='picture'>
  <div class='image_border fancybox' title='<?php echo $picture->description;?>' href='<?php echo $picture->file_name->url();?>'>
    <img src='<?php echo $picture->file_name->url ();?>' />
  </div>
  <div class='info_area'>
    <div class='row'>
      <div class='col-md-3 avatar_area'>
        <div class='avatar' data-url='https://www.facebook.com/profile.php?id=<?php echo $picture->user_uid;?>'>
          <img src='<?php echo 'https://graph.facebook.com/' . $picture->user_uid . '/picture?width=70&height=60';?>' />
        </div>
      </div>
      <div class='col-md-9 values'>
        <div class='value name'><a href='https://www.facebook.com/profile.php?id=<?php echo $picture->user_uid;?>' target='_blank'><?php echo $picture->user_name;?></a></div>
        <div class='value row'>
          <div class='col-md-7 like'>
            <div class="fb-like" data-href="<?php echo base_url (array ('pictures', 'id', $picture->id));?>" data-width="120" data-send="false" data-layout="button_count" data-action="like" data-show-faces="false" data-share="true"></div>
          </div>
          <div class='col-md-5 created_at' data-time='<?php echo $picture->created_at;?>'>
            <?php echo $picture->created_at;?>
          </div>
        </div>
  <?php if ($is_admins) { ?>
          <div class='delete glyphicon glyphicon-remove' data-id='<?php echo $picture->id;?>'></div>
 <?php  } ?>
      </div>
    </div>
    <div class='comment'>
      <div class='title'><?php echo $picture->title;?></div>
      <div class='description'><?php echo $picture->description;?></div>
    </div>
  </div>
</div>