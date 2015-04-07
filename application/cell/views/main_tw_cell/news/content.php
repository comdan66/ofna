<?php
  if ($news) { ?>
    <div id='news'>
      <div>
        <div class='l'>NEWS</div>
        <div class='r'>
    <?php foreach ($news as $new) { ?>
            <div class='n'>
              <img src='<?php echo $new->pic->name->url ('221x155c');?>' />
              <div class='d'><?php echo $new->date->format ('Y-m-d');?></div>
              <div class='t'><?php echo $new->$title;?></div>
              <div class='c'><?php echo $new->$description;?></div>
              <div class='m'>+ More</div>
            </div>
    <?php } ?>
        </div>
      </div>
    </div>
<?php
  }