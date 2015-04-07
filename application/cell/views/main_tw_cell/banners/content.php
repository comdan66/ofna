<?php 
  if ($banners) { ?>
    <div id="banners">
      <div class='banners'>
  <?php foreach ($banners as $banner) { ?>
          <div class='banner'><img src='<?php echo $banner->name->url ('1200x800c');?>' /></div>
  <?php } ?>
      </div>
      <div class='points'>
        <div class='points_c'>
    <?php foreach ($banners as $banner) { ?>
            <div class='point'></div>
    <?php } ?>
        </div>
      </div>
    </div>
<?php 
  }