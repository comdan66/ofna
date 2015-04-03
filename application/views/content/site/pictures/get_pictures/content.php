<?php 
  if (verifyNotNull ($picture)) { ?>
    <div class='picture fancybox' data-id='<?php echo $picture->id;?>' data-fancybox-group='fancybox-group' title='<?php echo $picture->description;?>' style='height: <?php echo 310/floatval ($picture->proportion);?>px' href='<?php echo $picture->file_name->url();?>'>
      <img src='<?php echo $picture->file_name->url ('310xW');?>' />
      <div class='bottom_area row'>
        <div class="col-md-8 title">
          <?php echo $picture->title;?>
        </div>
        <div class="col-md-4 like">
          <div class="fb-like" data-href="<?php echo base_url (array ('pictures', 'id', $picture->id));?>" data-width="120" data-send="false" data-layout="button_count" data-action="like" data-show-faces="false" data-share="false"></div>
        </div>
      </div>
      <div class='top_area'>

        <div class='user' data-url='https://www.facebook.com/profile.php?id=<?php echo $picture->user_uid;?>'>
          <div class='avatar'>
            <img src='<?php echo 'https://graph.facebook.com/' . $picture->user_uid . '/picture?width=40&height=40';?>' />
          </div>
          <?php echo $picture->user_name;?>
        </div>
        <div class='detail icon-search8' data-url='<?php echo base_url (array ('pictures', 'id', $picture->id));?>'></div>
      </div>
    </div>
<?php 
  }